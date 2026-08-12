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

            <form action="" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="you@example.com"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
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