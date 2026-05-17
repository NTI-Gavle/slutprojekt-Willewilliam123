<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";

$sql = "
    SELECT
        Posts.*,
        Users.Username,
        Users.AvatarUrl
    FROM Posts
    JOIN Users
        ON Posts.UserId = Users.UserId
    ORDER BY Posts.PostId DESC
";

$stmt = $dbconn->prepare($sql);

$stmt->execute();

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($posts as $post):
?>

<article class="post-card">



    <!-- CLICKABLE POST -->

    <a href="../includes/post.php?postId=<?= $post["PostId"] ?>" class="post-clickable">

            <div class="post-top">

        <img
            src="<?= htmlspecialchars($post["AvatarUrl"] ?: 'https://i.pravatar.cc/50') ?>"
        >

        <div>

            <h4>
                @<?= htmlspecialchars($post["Username"]) ?>
            </h4>

            <span>
                <?= htmlspecialchars($post["CreatedAt"]) ?>
            </span>

        </div>

    </div>

    <p class="post-content">
        <?= htmlspecialchars($post["PostText"]) ?>
    </p>

    </a>

    <!-- POST ACTIONS -->

    <div class="post-actions">


        
        <!-- DELETE BUTTON -->

        <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["UserId"] == $post["UserId"]): ?>

            <button type="button" hx-post="../database/delete_post.php" hx-confirm="Delete this post?" hx-vals='{"postId": "<?= $post["PostId"] ?>"}' hx-target="#discover-feed" hx-swap="innerHTML">
                Delete
            </button>

        <?php endif; ?>

        <button>Like</button>

        <a
            href="../includes/post.php?postId=<?= $post["PostId"] ?>">

            <button type="button">

                Reply

            </button>

        </a>

        <button>Repost</button>

    </div>

</article>

<?php endforeach; ?>