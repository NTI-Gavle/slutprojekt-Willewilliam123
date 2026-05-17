<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../database/db.php";



// GET USER

if (!isset($_GET["user"])) {
    die("User not found");
}

$username = $_GET["user"];



// LOAD PROFILE

$sql = "
    SELECT *
    FROM Users
    WHERE Username = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$username]);

$profile = $stmt->fetch(PDO::FETCH_ASSOC);



// USER NOT FOUND

if (!$profile) {
    die("User not found");
}



// CHECK OWN PROFILE

$isOwnProfile = false;

if (
    isset($_SESSION["user"]) &&
    $_SESSION["user"]["UserId"] == $profile["UserId"]
) {
    $isOwnProfile = true;
}



// LOAD POSTS

$sql = "

    SELECT *

    FROM Posts

    WHERE UserId = ?

    ORDER BY CreatedAt DESC

";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $profile["UserId"]
]);

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);



// LOAD REPLIES


$sql = "

    SELECT
        Comments.*,
        Posts.PostId

    FROM Comments

    JOIN Posts
        ON Comments.PostId = Posts.PostId

    WHERE Comments.CommenterId = ?

    ORDER BY Comments.CreatedAt DESC

";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $profile["UserId"]
]);

$replies = $stmt->fetchAll(PDO::FETCH_ASSOC);

$activity = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <?php include "../includes/skeleton/head.php" ?>
    <script src="../public/js/profile.js"></script>
    <script src="../public/js/comments.js"></script>
</head>
<body class="<?= $_SESSION["user"]["Theme"] ?? 'purple' ?>">

    <div class="app-layout">

        <aside>

            <?php include "nav.php" ?>

        </aside>



        <!-- PROFILE PAGE -->

        <main class="profile-page">



            <!-- PROFILE HEADER --> 

            <div class="profile-header">

                <img class="profile-avatar" src="<?= htmlspecialchars($profile["AvatarUrl"]?: 'https://i.pravatar.cc/150') ?>">
            
                 <div class="profile-info">

                    <h1>
                        <?= htmlspecialchars($profile["DisplayName"]?: $profile["Username"]) ?>
                    </h1>   

                    <p class="profile-handle">@<?= htmlspecialchars($profile["Username"]) ?></p>

                    <p class="profile-bio"><?= nl2br(htmlspecialchars($profile["Bio"] ?? "")) ?></p>

                </div>

                <?php if ($isOwnProfile): ?>

                    <button onclick="toggleEditProfile()">
                        Edit Profile
                    </button>

                    <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["UserId"] == $profile["UserId"]): ?>

    <div class="profile-buttons">

        <button
            type="button"
            onclick="toggleEditProfile()"
            class="edit-profile-button"
        >
            Edit Profile
        </button>

        <a
            href="../database/logout.php"
            class="logout-button"
        >
            Log Out
        </a>

    </div>

<?php endif; ?>
        
                <?php endif; ?>
                
            </div>



            <!-- EDIT PROFILE -->

            <?php if ($isOwnProfile): ?>

            <div id="edit-profile-form" style="display:none;">

                <form action="../database/update_profile.php" method="POST">

                    <input type="text" name="displayName" placeholder="Display Name" maxlength="64" value="<?= htmlspecialchars( $profile["DisplayName"] ?? "") ?>">

                    <textarea name="bio" placeholder="Bio" maxlength="500"><?= htmlspecialchars($profile["Bio"] ?? "") ?></textarea>

                    <input type="text" name="avatarUrl" placeholder="Profile Picture URL"  value="<?= htmlspecialchars(  $profile["AvatarUrl"] ?? "") ?>">

                    <button type="submit">

                        Save Profile

                    </button>

                </form>

            </div>
                    
            <?php endif; ?>

            <section class="profile-tabs">

                <button class="profile-tab-button active-tab" onclick="showProfileTab('posts-tab', this)">
                    Posts
                </button>

                <button class="profile-tab-button" onclick="showProfileTab('replies-tab', this)">
                    Replies
                </button>

            </section>



            <!-- POSTS TAB -->

            <section id="posts-tab" class="profile-tab-content">

                <?php foreach($posts as $post): ?>

                    <a href="../includes/post.php?postId=<?= $post["PostId"] ?>" class="profile-post-link">

                        <div class="profile-post-card">

                            <p>
                                <?= htmlspecialchars($post["PostText"]) ?>
                            </p>

                            <span class="profile-post-date">
                                <?= htmlspecialchars($post["CreatedAt"]) ?>
                            </span>

                        </div>

                    </a>

                <?php endforeach; ?>

            </section>



            <!-- REPLIES TAB -->

            <section id="replies-tab" class="profile-tab-content" style="display:none;">

                <?php foreach($replies as $reply): ?>

                    <a href="../includes/post.php?postId=<?= $reply["PostId"] ?>" class="profile-post-link">

                        <div class="profile-post-card">

                            <span class="reply-label">
                                Reply
                            </span>

                            <p>
                                <?= htmlspecialchars($reply["CommentText"]) ?>
                            </p>

                            <span class="profile-post-date">
                                <?= htmlspecialchars($reply["CreatedAt"]) ?>
                            </span>

                        </div>

                    </a>

                <?php endforeach; ?>

            </section>

        </main>

    </div>

</body>
</html>