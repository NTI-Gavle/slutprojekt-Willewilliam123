<?php

session_start();

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

if (!isset($_POST["postText"])) {
    exit();
}

$postText = trim($_POST["postText"]);

if (empty($postText)) {
    exit();
}

$user = $_SESSION["user"];

$userId = $user["UserId"];

$sql = "
    INSERT INTO Posts (
        UserId,
        PostText
    )
    VALUES (?, ?)
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $userId,
    $postText
]);



/*
    AFTER INSERT:
    reload feed HTML
*/

$sql = "
    SELECT
        Posts.*,
        Users.Username
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

        <div>

            <h4>
                @<?= htmlspecialchars($post["Username"]) ?>
            </h4>

            <span>
                Just now
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