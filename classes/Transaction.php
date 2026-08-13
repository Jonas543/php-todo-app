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

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

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

    public function getBalance($userId)
    {
        $statement = $this->conn->prepare(
            "SELECT balance FROM users WHERE id = :id"
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
}