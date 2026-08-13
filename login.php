<?php

session_start();

require_once "classes/Database.php";
require_once "classes/User.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    try {
        $database = new Database();
        $conn = $database->connect();

        $user = new User($conn);

        $loggedInUser = $user->login($email, $password);

        session_regenerate_id(true);

        $_SESSION["user_id"] = $loggedInUser["id"];
        $_SESSION["username"] = $loggedInUser["username"];

        header("Location: dashboard.php");
        exit;

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TripTask</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="auth-page">

    <div class="auth-container">

        <div class="auth-logo">
            <h1>TripTask</h1>
            <p>Plan your trip, one task at a time.</p>
        </div>

        <div class="auth-card">

            <h2>Welcome back</h2>

            <p class="auth-subtitle">
                Login to continue planning your trip.
            </p>

            <?php if (!empty($error)): ?>
                <p class="message error-message">
                    <?= htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>

            <form action="" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="you@example.com"
                        value="<?= htmlspecialchars($_POST["email"] ?? ""); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Login
                </button>

            </form>

            <p class="auth-switch">
                Don't have an account?
                <a href="signup.php">Create account</a>
            </p>

        </div>

    </div>

</body>
</html>