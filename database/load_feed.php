<?php

session_start();

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

    <div class="post-actions">

        <button>Like</button>

        <button>Reply</button>

        <button>Repost</button>

    </div>

</article>

<?php endforeach; ?>