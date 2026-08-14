<?php

class Transaction
{
    private $conn;
    private $senderId;
    private $receiverId;
    private $amount;
    private $reason;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    /* =========================
       SENDER
    ========================= */

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }


    public function getSenderId()
    {
        return $this->senderId;
    }


    /* =========================
       RECEIVER
    ========================= */

    public function setReceiverId($receiverId)
    {
        if ($receiverId == $this->senderId) {
            throw new Exception("You cannot send XD to yourself.");
        }

        $this->receiverId = $receiverId;
    }


    public function getReceiverId()
    {
        return $this->receiverId;
    }


    /* =========================
       AMOUNT
    ========================= */

    public function setAmount($amount)
    {
        if ($amount < 1) {
            throw new Exception("Amount must be at least 1 XD.");
        }

        $this->amount = $amount;
    }


    public function getAmount()
    {
        return $this->amount;
    }


    /* =========================
       REASON
    ========================= */

    public function setReason($reason)
    {
        $reason = trim($reason);

        if (empty($reason)) {
            throw new Exception("Reason cannot be empty.");
        }

        $this->reason = $reason;
    }


    public function getReason()
    {
        return $this->reason;
    }


    /* =========================
       BALANCE
    ========================= */

    public function getBalance($userId)
    {
        $statement = $this->conn->prepare(
            "SELECT balance
             FROM users
             WHERE id = :id"
        );

        $statement->execute([
            "id" => $userId
        ]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception("User not found.");
        }

        return $user["balance"];
    }


    /* =========================
       FIND USER
    ========================= */

    public function findUserByUsername($username)
    {
        $statement = $this->conn->prepare(
            "SELECT id, username
             FROM users
             WHERE username = :username"
        );

        $statement->execute([
            "username" => $username
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    /* =========================
       SEND TRANSACTION
    ========================= */

    public function send()
    {
        $balance = $this->getBalance($this->senderId);

        if ($this->amount > $balance) {
            throw new Exception("You do not have enough XD.");
        }

        try {
            $this->conn->beginTransaction();

            $statement = $this->conn->prepare(
                "UPDATE users
                 SET balance = balance - :amount
                 WHERE id = :sender_id"
            );

            $statement->execute([
                "amount" => $this->amount,
                "sender_id" => $this->senderId
            ]);

            $statement = $this->conn->prepare(
                "UPDATE users
                 SET balance = balance + :amount
                 WHERE id = :receiver_id"
            );

            $statement->execute([
                "amount" => $this->amount,
                "receiver_id" => $this->receiverId
            ]);

            $statement = $this->conn->prepare(
                "INSERT INTO transactions
                    (sender_id, receiver_id, amount, reason)
                 VALUES
                    (:sender_id, :receiver_id, :amount, :reason)"
            );

            $statement->execute([
                "sender_id" => $this->senderId,
                "receiver_id" => $this->receiverId,
                "amount" => $this->amount,
                "reason" => $this->reason
            ]);

            $this->conn->commit();

            return true;

        } catch (Exception $e) {

            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }

            throw $e;
        }
    }


    /* =========================
       TRANSACTION HISTORY
    ========================= */

    public function getTransactionsByUser($userId)
    {
        $statement = $this->conn->prepare(
            "SELECT
                transactions.id,
                transactions.sender_id,
                transactions.receiver_id,
                transactions.amount,
                transactions.reason,
                transactions.created_at,

                sender.username AS sender_name,
                receiver.username AS receiver_name

             FROM transactions

             JOIN users AS sender
                ON transactions.sender_id = sender.id

             JOIN users AS receiver
                ON transactions.receiver_id = receiver.id

             WHERE transactions.sender_id = :user_id
                OR transactions.receiver_id = :user_id

             ORDER BY transactions.created_at DESC"
        );

        $statement->execute([
            "user_id" => $userId
        ]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /* =========================
       TRANSACTION DETAILS
    ========================= */

    public function getTransactionById($transactionId, $userId)
    {
        $statement = $this->conn->prepare(
            "SELECT
                transactions.id,
                transactions.sender_id,
                transactions.receiver_id,
                transactions.amount,
                transactions.reason,
                transactions.created_at,

                sender.username AS sender_name,
                sender.email AS sender_email,

                receiver.username AS receiver_name,
                receiver.email AS receiver_email

             FROM transactions

             JOIN users AS sender
                ON transactions.sender_id = sender.id

             JOIN users AS receiver
                ON transactions.receiver_id = receiver.id

             WHERE transactions.id = :transaction_id

             AND (
                transactions.sender_id = :user_id
                OR transactions.receiver_id = :user_id
             )"
        );

        $statement->execute([
            "transaction_id" => $transactionId,
            "user_id" => $userId
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}