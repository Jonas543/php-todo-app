<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | TripTask</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="main-header">
        <div class="header-container">
            <a href="dashboard.php" class="logo">TripTask</a>

            <div class="header-right">
                <span class="welcome-text">Hi, Jonas</span>
                <a href="login.php" class="btn-logout">Logout</a>
            </div>
        </div>
    </header>

    <main class="page-container">

        <div class="page-heading">
            <div>
                <h1>My Lists</h1>
                <p>Keep track of everything you need for your trips.</p>
            </div>

            <button class="btn btn-add">
                + New List
            </button>
        </div>

        <div class="list-grid">

            <a href="list.php?id=1" class="list-card">
                <div class="list-card-top">
                    <span class="list-icon">✈</span>
                    <span class="list-menu">•••</span>
                </div>

                <h2>Portugal Trip</h2>

                <p class="list-description">
                    Everything I need to prepare before leaving for Portugal.
                </p>

                <div class="list-card-footer">
                    <span>8 tasks</span>
                    <span>3 done</span>
                </div>

                <div class="progress-bar">
                    <div class="progress" style="width: 37%;"></div>
                </div>
            </a>


            <a href="list.php?id=2" class="list-card">
                <div class="list-card-top">
                    <span class="list-icon">🏄</span>
                    <span class="list-menu">•••</span>
                </div>

                <h2>Surf Camp</h2>

                <p class="list-description">
                    Things to arrange before the summer surf camp.
                </p>

                <div class="list-card-footer">
                    <span>12 tasks</span>
                    <span>7 done</span>
                </div>

                <div class="progress-bar">
                    <div class="progress" style="width: 58%;"></div>
                </div>
            </a>


            <a href="list.php?id=3" class="list-card">
                <div class="list-card-top">
                    <span class="list-icon">🏕</span>
                    <span class="list-menu">•••</span>
                </div>

                <h2>Camping Weekend</h2>

                <p class="list-description">
                    Checklist for our weekend camping trip.
                </p>

                <div class="list-card-footer">
                    <span>6 tasks</span>
                    <span>1 done</span>
                </div>

                <div class="progress-bar">
                    <div class="progress" style="width: 17%;"></div>
                </div>
            </a>

        </div>

    </main>

</body>
</html>