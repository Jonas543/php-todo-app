<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portugal Trip | TripTask</title>
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

        <a href="dashboard.php" class="back-link">
            ← Back to lists
        </a>

        <div class="page-heading task-heading">

            <div>
                <h1>Portugal Trip</h1>

                <p>
                    Everything I need to prepare before leaving for Portugal.
                </p>
            </div>

            <button class="btn btn-add">
                + Add Task
            </button>

        </div>


        <div class="task-toolbar">

            <div>
                <span class="task-count">8 tasks</span>
            </div>

            <div class="sort-options">
                <span>Sort by:</span>

                <a href="#" class="sort-link active-sort">
                    Priority
                </a>

                <a href="#" class="sort-link">
                    Title
                </a>
            </div>

        </div>


        <div class="task-list">

            <!-- TASK 1 -->

            <div class="task-card">

                <div class="task-left">

                    <button class="status-circle"></button>

                    <a href="item.php?id=1" class="task-info">
                        <h2>Apply for passport</h2>

                        <span class="priority priority-high">
                            High
                        </span>
                    </a>

                </div>

                <div class="task-actions">
                    <span class="task-status">Todo</span>
                    <button class="delete-btn">Delete</button>
                </div>

            </div>


            <!-- TASK 2 -->

            <div class="task-card">

                <div class="task-left">

                    <button class="status-circle"></button>

                    <a href="item.php?id=2" class="task-info">
                        <h2>Book plane tickets</h2>

                        <span class="priority priority-high">
                            High
                        </span>
                    </a>

                </div>

                <div class="task-actions">
                    <span class="task-status">Todo</span>
                    <button class="delete-btn">Delete</button>
                </div>

            </div>


            <!-- TASK 3 -->

            <div class="task-card task-completed">

                <div class="task-left">

                    <button class="status-circle status-done">
                        ✓
                    </button>

                    <a href="item.php?id=3" class="task-info">
                        <h2>Book accommodation</h2>

                        <span class="priority priority-high">
                            High
                        </span>
                    </a>

                </div>

                <div class="task-actions">
                    <span class="task-status done-text">Done</span>
                    <button class="delete-btn">Delete</button>
                </div>

            </div>


            <!-- TASK 4 -->

            <div class="task-card">

                <div class="task-left">

                    <button class="status-circle"></button>

                    <a href="item.php?id=4" class="task-info">
                        <h2>Pack backpack</h2>

                        <span class="priority priority-medium">
                            Medium
                        </span>
                    </a>

                </div>

                <div class="task-actions">
                    <span class="task-status">Todo</span>
                    <button class="delete-btn">Delete</button>
                </div>

            </div>


            <!-- TASK 5 -->

            <div class="task-card task-completed">

                <div class="task-left">

                    <button class="status-circle status-done">
                        ✓
                    </button>

                    <a href="item.php?id=5" class="task-info">
                        <h2>Buy travel insurance</h2>

                        <span class="priority priority-medium">
                            Medium
                        </span>
                    </a>

                </div>

                <div class="task-actions">
                    <span class="task-status done-text">Done</span>
                    <button class="delete-btn">Delete</button>
                </div>

            </div>


            <!-- TASK 6 -->

            <div class="task-card">

                <div class="task-left">

                    <button class="status-circle"></button>

                    <a href="item.php?id=6" class="task-info">
                        <h2>Buy sunscreen</h2>

                        <span class="priority priority-low">
                            Low
                        </span>
                    </a>

                </div>

                <div class="task-actions">
                    <span class="task-status">Todo</span>
                    <button class="delete-btn">Delete</button>
                </div>

            </div>

        </div>

    </main>

</body>
</html>