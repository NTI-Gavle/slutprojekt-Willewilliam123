<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=90shjciodpsqI UWI, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <?php include "../includes/skeleton/head.php" ?>
</head>

<body>
    <div class="app-layout">

    <aside>
    <?php
    include "nav.php"
    ?>
    </aside>

    <main class="discover-page">

        <div class="discover-search">
            <input type="text" placeholder="Search for posts or users" />
        </div>
        
        <section class="create-post-card">

            <form hx-post="../database/create_post.php" hx-target="#discover-feed" hx-swap="innerHTML">

                <textarea name="postText" maxlength="1000" placeholder="What's happening?" required></textarea>

                <button type="submit">
                     Post
                </button>

            </form>

        </section>

            <section id="discover-feed" hx-get="../database/load_feed.php" hx-trigger="load" hx-swap="innerHTML">

                <p>Loading posts...</p>

            </section>
    </main>
</div>
</body>
</html>
