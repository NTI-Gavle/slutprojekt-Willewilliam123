<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

$commentText = trim($_POST["commentText"] ?? "");
$postId = $_POST["postId"] ?? null;

$parentCommentId = $_POST["parentCommentId"] ?? null;

if (empty($commentText) || !$postId) {
    exit();
}

$userId = $_SESSION["user"]["UserId"];

$sql = "
    INSERT INTO Comments (
        CommentText,
        CommenterId,
        PostId,
        ParentCommentId
    )
    VALUES (?, ?, ?, ?)
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $commentText,
    $userId,
    $postId,
    $parentCommentId
]);

require "load_comments.php";