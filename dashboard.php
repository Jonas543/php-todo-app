<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require_once "classes/Database.php";
require_once "classes/Transaction.php";

$database = new Database();
$conn = $database->connect();

$transaction = new Transaction($conn);

$error = "";
$success = "";

$userId = $_SESSION["user_id"];


/* =========================
   SEND TRANSACTION
========================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $receiverUsername = trim($_POST["receiver"] ?? "");
    $amount = (int)($_POST["amount"] ?? 0);
    $reason = trim($_POST["reason"] ?? "");

    try {

        $receiver = $transaction->findUserByUsername($receiverUsername);

        if (!$receiver) {
            throw new Exception("User not found.");
        }

        $transaction->setSenderId($userId);
        $transaction->setReceiverId($receiver["id"]);
        $transaction->setAmount($amount);
        $transaction->setReason($reason);

        $transaction->send();

        $success = "XD sent successfully.";

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}


/* =========================
   GET BALANCE
========================= */

$balance = $transaction->getBalance($userId);


/* =========================
   GET TRANSACTIONS
========================= */

$statement = $conn->prepare(
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

$transactions = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>XD Wallet</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="main-header">

        <div class="header-container">

            <a href="dashboard.php" class="logo">
                XD Wallet
            </a>

            <div class="header-right">

                <span class="welcome-text">
                    Hi, <?= htmlspecialchars($_SESSION["username"]); ?>
                </span>

                <a href="logout.php" class="btn-logout">
                    Logout
                </a>

            </div>

        </div>

    </header>


    <main class="wallet-container">

        <!-- BALANCE -->

        <section class="balance-card">

            <p class="balance-label">
                Current balance
            </p>

            <h1 class="balance-amount">
                <?= htmlspecialchars($balance); ?> XD
            </h1>

            <p class="balance-info">
                Your balance updates when you send or receive XD.
            </p>

        </section>


        <div class="wallet-grid">

            <!-- SEND XD -->

            <section class="wallet-card">

                <h2>Send XD</h2>

                <p class="wallet-subtitle">
                    Send tokens to another student.
                </p>


                <?php if (!empty($error)): ?>

                    <p class="message error-message">
                        <?= htmlspecialchars($error); ?>
                    </p>

                <?php endif; ?>


                <?php if (!empty($success)): ?>

                    <p class="message success-message">
                        <?= htmlspecialchars($success); ?>
                    </p>

                <?php endif; ?>


                <div class="form-group receiver-group">

                    <label for="receiver">
                        Receiver
                    </label>

                    <input
                        type="text"
                        id="receiver"
                        name="receiver"
                        placeholder="Search for a user..."
                        autocomplete="off"
                        required
                    >

                <div id="userSuggestions" class="user-suggestions"></div>

            </div>


                    <div class="form-group">

                        <label for="amount">
                            Amount
                        </label>

                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            placeholder="Enter amount"
                            min="1"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="reason">
                            Reason
                        </label>

                        <textarea
                            id="reason"
                            name="reason"
                            placeholder="Why are you sending these tokens?"
                            rows="4"
                            required
                        ></textarea>

                    </div>


                    <button type="submit" class="btn btn-primary">
                        Send XD
                    </button>

                </form>

            </section>


            <!-- TRANSACTIONS -->

            <section class="wallet-card">

                <h2>Recent transactions</h2>

                <p class="wallet-subtitle">
                    Your latest sent and received tokens.
                </p>


                <div class="transaction-list">

                    <?php if (empty($transactions)): ?>

                        <p class="no-transactions">
                            No transactions yet.
                        </p>

                    <?php else: ?>


                        <?php foreach ($transactions as $item): ?>


                            <?php if ($item["receiver_id"] == $userId): ?>

                                <!-- RECEIVED -->

                                <a
                                    href="transaction.php?id=<?= $item["id"]; ?>"
                                    class="transaction-item"
                                >

                                    <div class="transaction-icon received-icon">
                                        ↓
                                    </div>

                                    <div class="transaction-info">

                                        <strong>
                                            <?= htmlspecialchars($item["sender_name"]); ?>
                                            sent you XD
                                        </strong>

                                        <span>
                                            <?= htmlspecialchars($item["reason"]); ?>
                                        </span>

                                    </div>

                                    <div class="transaction-amount received-amount">
                                        +<?= htmlspecialchars($item["amount"]); ?> XD
                                    </div>

                                </a>


                            <?php else: ?>

                                <!-- SENT -->

                                <a
                                    href="transaction.php?id=<?= $item["id"]; ?>"
                                    class="transaction-item"
                                >

                                    <div class="transaction-icon sent-icon">
                                        ↑
                                    </div>

                                    <div class="transaction-info">

                                        <strong>
                                            You sent XD to
                                            <?= htmlspecialchars($item["receiver_name"]); ?>
                                        </strong>

                                        <span>
                                            <?= htmlspecialchars($item["reason"]); ?>
                                        </span>

                                    </div>

                                    <div class="transaction-amount sent-amount">
                                        -<?= htmlspecialchars($item["amount"]); ?> XD
                                    </div>

                                </a>

                            <?php endif; ?>


                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>

            </section>

        </div>

    </main>
    
    <script src="assets/js/app.js"></script>

</body>
</html>