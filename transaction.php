<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require_once "classes/Database.php";

$database = new Database();
$conn = $database->connect();

$userId = $_SESSION["user_id"];

$transactionId = (int)($_GET["id"] ?? 0);

if ($transactionId <= 0) {
    header("Location: dashboard.php");
    exit;
}

$statement = $conn->prepare(
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

$transaction = $statement->fetch(PDO::FETCH_ASSOC);

if (!$transaction) {
    header("Location: dashboard.php");
    exit;
}

$isReceived = $transaction["receiver_id"] == $userId;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Transaction | XD Wallet</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

    <header class="main-header">

        <div class="header-container">

            <a
                href="dashboard.php"
                class="logo"
            >
                XD Wallet
            </a>

            <div class="header-right">

                <span class="welcome-text">
                    Hi, <?= htmlspecialchars($_SESSION["username"]); ?>
                </span>

                <a
                    href="logout.php"
                    class="btn-logout"
                >
                    Logout
                </a>

            </div>

        </div>

    </header>


    <main class="transaction-detail-container">

        <a
            href="dashboard.php"
            class="back-link"
        >
            ← Back to dashboard
        </a>


        <section class="transaction-detail-card">

            <div class="transaction-detail-top">

                <div
                    class="transaction-icon
                    <?= $isReceived ? "received-icon" : "sent-icon"; ?>"
                >
                    <?= $isReceived ? "↓" : "↑"; ?>
                </div>

                <div>

                    <p class="transaction-detail-label">
                        <?= $isReceived ? "Received" : "Sent"; ?>
                    </p>

                    <h1>
                        <?= $isReceived ? "+" : "-"; ?>
                        <?= htmlspecialchars($transaction["amount"]); ?> XD
                    </h1>

                </div>

            </div>


            <div class="transaction-detail-list">

                <div class="transaction-detail-row">

                    <span>From</span>

                    <strong>
                        <?= htmlspecialchars($transaction["sender_name"]); ?>
                    </strong>

                </div>


                <div class="transaction-detail-row">

                    <span>To</span>

                    <strong>
                        <?= htmlspecialchars($transaction["receiver_name"]); ?>
                    </strong>

                </div>


                <div class="transaction-detail-row">

                    <span>Amount</span>

                    <strong>
                        <?= htmlspecialchars($transaction["amount"]); ?> XD
                    </strong>

                </div>


                <div class="transaction-detail-row">

                    <span>Date</span>

                    <strong>
                        <?= htmlspecialchars($transaction["created_at"]); ?>
                    </strong>

                </div>

            </div>


            <div class="transaction-reason">

                <span>Reason</span>

                <p>
                    <?= htmlspecialchars($transaction["reason"]); ?>
                </p>

            </div>

        </section>

    </main>

</body>

</html>