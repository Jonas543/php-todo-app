<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | TripTask</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="auth-page">

    <div class="auth-container">

        <div class="auth-logo">
            <h1>TripTask</h1>
            <p>Plan your trip, one task at a time.</p>
        </div>

        <div class="auth-card">

            <h2>Create account</h2>

            <p class="auth-subtitle">
                Create an account to start planning.
            </p>

            <form action="" method="POST">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Your name"
                    >
                </div>

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
                        placeholder="Create a password"
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Create account
                </button>

            </form>

            <p class="auth-switch">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </div>

    </div>

</body>
</html>