<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";



// GET POST ID

$postId = $_GET["postId"] ?? $_POST["postId"] ?? null;

if (!$postId) {
    exit();
}



// LOAD COMMENTS

$sql = "
    SELECT
        Comments.*,

        Users.Username,
        Users.AvatarUrl,

        ParentUsers.Username AS ParentUsername

    FROM Comments

    JOIN Users 
     ON Comments.CommenterId = Users.UserId

    LEFT JOIN Comments AS ParentComment
        ON Comments.ParentCommentId = ParentComment.CommentId
    
    LEFT JOIN Users AS ParentUsers
        ON ParentComment.CommenterId = ParentUsers.UserId

    WHERE Comments.PostId = ?

    ORDER BY Comments.CommentId ASC
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$postId]);

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);



// ORGANIZE COMMENTS BY PARENT

$groupedComments = [];

foreach ($comments as $comment) {

    $parentId = $comment["ParentCommentId"] !== null
        ? (int)$comment["ParentCommentId"]
        : null;

    $groupedComments[$parentId][] = $comment;

}



// RECURSIVE RENDER FUNCTION

function renderComments($parentId, array $groupedComments, int $postId) {

    if (!isset($groupedComments[$parentId])) {
        return;
    }

    foreach ($groupedComments[$parentId] as $comment):
?>

<div class="comment-card <?= $comment["ParentCommentId"] ? 'nested-comment' : '' ?>">

    <div class="comment-top">

            <a href="../includes/profile.php?user=<?= urlencode($comment["Username"]) ?>" class="profile-link">

                <img src="<?= htmlspecialchars($comment["AvatarUrl"] ?: 'https://i.pravatar.cc/50') ?>" class="comment-avatar">

            </a>

        <div>

            <a href="../includes/profile.php?user=<?= urlencode($comment["Username"]) ?>" class="profile-link">

                <h4>
                    @<?= htmlspecialchars($comment["Username"]) ?>
                </h4>

            </a>

        </div>

    </div>



    <?php if ($comment["ParentUsername"]): ?>

    <p class="replying-to">
        Replying to @<?= htmlspecialchars($comment["ParentUsername"]) ?>
    </p>

    <?php endif; ?>



    <p class="comment-content">
        <?= htmlspecialchars($comment["CommentText"]) ?>
    </p>



    <!-- BUTTON TO DELETE REPLIES -->

    <div class="comment-actions">

    <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["UserId"] == $comment["CommenterId"]): ?>

            <button type="button" hx-post="../database/delete_comment.php" hx-confirm="Delete this reply?"  hx-vals='{"commentId": "<?= $comment["CommentId"] ?>"}' hx-target="#comments-section"  hx-swap="innerHTML">
                Delete
            </button>

        <?php endif; ?>

    </div>



    <button type="button" onclick="toggleReplyForm(<?= $comment['CommentId'] ?>)">

        Reply

    </button>



    <!-- REPLY FORM -->

    <div
        id="reply-form-<?= $comment['CommentId'] ?>"
        style="display:none; margin-top:10px;">

        <form hx-post="../database/create_comment.php" hx-target="#comments-section" hx-swap="innerHTML">

            <input type="hidden" name="postId" value="<?= $postId ?>">

            <input type="hidden" name="parentCommentId" value="<?= $comment['CommentId'] ?>">

            <textarea name="commentText" maxlength="1000" placeholder="Write a reply..." required></textarea>

            <button type="submit">
                Post
            </button>

        </form>

    </div>



    <!-- RENDER COMMENT REPLIES -->

    <div class="nested-replies">

        <?php
            renderComments(
                $comment["CommentId"],
                $groupedComments,
                $postId
            );
        ?>

    </div>

</div>

<?php
    endforeach;
}



// START RENDERING FROM TOP-LEVEL COMMENTS

renderComments(null, $groupedComments, $postId);

?>