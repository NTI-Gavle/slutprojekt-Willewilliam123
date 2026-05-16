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
        Users.AvatarUrl
    FROM Comments
    JOIN Users
        ON Comments.CommenterId = Users.UserId
    WHERE Comments.PostId = ?
    ORDER BY Comments.CommentId ASC
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$postId]);

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);



// RENDER COMMENTS

foreach($comments as $comment):
?>

<div class="comment-card">

    <div class="comment-top">

        <img
            src="<?= htmlspecialchars($comment["AvatarUrl"] ?: 'https://i.pravatar.cc/50') ?>"
            class="comment-avatar"
        >

        <div>

            <h4>
                @<?= htmlspecialchars($comment["Username"]) ?>
            </h4>

        </div>

    </div>



    <p class="comment-content">
        <?= htmlspecialchars($comment["CommentText"]) ?>
    </p>



    <!-- REPLY BUTTON -->

    <button
        type="button"
        onclick="toggleReplyForm(<?= $comment['CommentId'] ?>)">

        Reply

    </button>



    <!-- HIDDEN REPLY FORM -->

    <div
        id="reply-form-<?= $comment['CommentId'] ?>"
        style="display:none; margin-top:10px;">

        <form
            hx-post="/Project%20Ultimo/slutprojekt-Willewilliam123/database/create_comment.php"
            hx-target="#comments-section"
            hx-swap="innerHTML">

            <input
                type="hidden"
                name="postId"
                value="<?= $postId ?>">

            <input
                type="hidden"
                name="parentCommentId"
                value="<?= $comment['CommentId'] ?>">

            <textarea
                name="commentText"
                placeholder="Write a reply..."
                required>
            </textarea>

            <button type="submit">
                Reply
            </button>

        </form>

    </div>

</div>

<?php endforeach; ?>



<script>

function toggleReplyForm(commentId) {

    const form = document.getElementById(
        "reply-form-" + commentId
    );

    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }

}

</script>