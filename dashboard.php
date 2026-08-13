<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

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
                10 XD
            </h1>

            <p class="balance-info">
                Your balance updates automatically.
            </p>

        </section>


        <div class="wallet-grid">

            <!-- SEND TOKENS -->

            <section class="wallet-card">

                <h2>Send XD</h2>

                <p class="wallet-subtitle">
                    Send tokens to another student.
                </p>

                <form action="" method="POST">

                    <div class="form-group">

                        <label for="receiver">
                            Receiver
                        </label>

                        <input
                            type="text"
                            id="receiver"
                            name="receiver"
                            placeholder="Search for a user..."
                            autocomplete="off"
                        >

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
                        ></textarea>

                    </div>


                    <button type="submit" class="btn btn-primary">
                        Send XD
                    </button>

                </form>

            </section>


            <!-- RECENT TRANSACTIONS -->

            <section class="wallet-card">

                <div class="transactions-heading">

                    <div>
                        <h2>Recent transactions</h2>

                        <p class="wallet-subtitle">
                            Your latest sent and received tokens.
                        </p>
                    </div>

                </div>


                <div class="transaction-list">

                    <!-- RECEIVED -->

                    <a href="transaction.php?id=1" class="transaction-item">

                        <div class="transaction-icon received-icon">
                            ↓
                        </div>

                        <div class="transaction-info">

                            <strong>
                                Nick sent you XD
                            </strong>

                            <span>
                                Thanks for helping with my design.
                            </span>

                        </div>

                        <div class="transaction-amount received-amount">
                            +5 XD
                        </div>

                    </a>


                    <!-- SENT -->

                    <a href="transaction.php?id=2" class="transaction-item">

                        <div class="transaction-icon sent-icon">
                            ↑
                        </div>

                        <div class="transaction-info">

                            <strong>
                                You sent XD to Sarah
                            </strong>

                            <span>
                                Lunch yesterday.
                            </span>

                        </div>

                        <div class="transaction-amount sent-amount">
                            -3 XD
                        </div>

                    </a>


                    <!-- RECEIVED -->

                    <a href="transaction.php?id=3" class="transaction-item">

                        <div class="transaction-icon received-icon">
                            ↓
                        </div>

                        <div class="transaction-info">

                            <strong>
                                Emma sent you XD
                            </strong>

                            <span>
                                Thanks!
                            </span>

                        </div>

                        <div class="transaction-amount received-amount">
                            +2 XD
                        </div>

                    </a>

                </div>

            </section>

        </div>

    </main>

</body>
</html>