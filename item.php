<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for passport | TripTask</title>
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

        <a href="list.php?id=1" class="back-link">
            ← Back to Portugal Trip
        </a>

        <div class="item-header">
            <div>
                <h1>Apply for passport</h1>
                <p>Make sure the passport is valid before travelling.</p>
            </div>

            <span class="priority priority-high">High</span>
        </div>

        <div class="item-grid">

            <!-- LEFT SIDE -->

            <div class="item-main">

                <section class="detail-card">
                    <h2>Task details</h2>

                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="status-badge todo-badge">Todo</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Priority</span>
                        <span class="priority priority-high">High</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">List</span>
                        <span>Portugal Trip</span>
                    </div>
                </section>


                <!-- COMMENTS -->

                <section class="detail-card">
                    <h2>Comments</h2>

                    <div class="comment">
                        <div class="comment-top">
                            <strong>Jonas</strong>
                            <span>12 August 2026</span>
                        </div>

                        <p>
                            Don't forget to bring a passport photo.
                        </p>
                    </div>

                    <div class="comment">
                        <div class="comment-top">
                            <strong>Jonas</strong>
                            <span>13 August 2026</span>
                        </div>

                        <p>
                            Check the opening hours of the city hall first.
                        </p>
                    </div>

                    <form action="" method="POST" class="comment-form">

                        <label for="comment">Add comment</label>

                        <textarea
                            id="comment"
                            name="comment"
                            placeholder="Write a comment..."
                            rows="4"
                        ></textarea>

                        <button type="submit" class="btn btn-add">
                            Add Comment
                        </button>

                    </form>
                </section>

            </div>


            <!-- RIGHT SIDE -->

            <aside class="item-sidebar">

                <section class="detail-card">
                    <h2>Documents</h2>

                    <div class="document-item">
                        <div>
                            <strong>passport-info.pdf</strong>
                            <span>PDF document</span>
                        </div>

                        <button class="delete-btn">
                            Delete
                        </button>
                    </div>

                    <form
                        action=""
                        method="POST"
                        enctype="multipart/form-data"
                        class="upload-form"
                    >

                        <label for="document">Upload document</label>

                        <input
                            type="file"
                            id="document"
                            name="document"
                        >

                        <button type="submit" class="btn btn-add">
                            Upload
                        </button>

                    </form>
                </section>

            </aside>

        </div>

    </main>

</body>
</html>