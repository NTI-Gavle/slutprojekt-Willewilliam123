<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../database/db.php";

if (!isset($_GET["postId"])) {
    die("Post not found");
}

$postId = $_GET["postId"];



$sql = "
    SELECT
        Posts.*,
        Users.Username,
        Users.AvatarUrl
    FROM Posts
    JOIN Users
        ON Posts.UserId = Users.UserId
    WHERE Posts.PostId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$postId]);

$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <?php include "../includes/skeleton/head.php" ?>
    <script src="../public/js/profile.js"></script>
</head>
<body>
        <div class="app-layout">
            <aside>
                <?php
                include "nav.php"
                ?>
            </aside>

        <main class="discover-page"> 

        <article class="post-card">

        <div class="post-top">

            <img
                src="<?= htmlspecialchars($post["AvatarUrl"] ?: 'https://i.pravatar.cc/50') ?>"
            >

            <div>

                <h3>
                    @<?= htmlspecialchars($post["Username"]) ?>
                </h3>

            </div>

        </div>

        <p class="post-content">
            <?= htmlspecialchars($post["PostText"]) ?>
        </p>

        </article>

        <form hx-post="../database/create_comment.php" hx-target="#comments-section" hx-swap="innerHTML">

            <input
                type="hidden"
            name="postId"
                value="<?= $postId ?>">

            <textarea name="commentText" maxlength="1000" placeholder="Write a reply..." required></textarea>

            <button type="submit">
                Post
            </button>

        </form>

            <section id="comments-section" hx-get="../database/load_comments.php?postId=<?= $postId ?>" hx-trigger="load" hx-swap="innerHTML">

            <p>Loading replies...</p>

            </section>

        </main>

    </div>

</body>
</html>