<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";



// LOG-IN CHECK

if (!isset($_SESSION["user"])) {
    exit();
}



// MUST RECEIVE COMMENT ID

if (!isset($_POST["commentId"])) {
    exit();
}

$commentId = $_POST["commentId"];

$userId = $_SESSION["user"]["UserId"];



//  FIND COMMENT

$sql = "
    SELECT *
    FROM Comments
    WHERE CommentId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$commentId]);

$comment = $stmt->fetch(PDO::FETCH_ASSOC);



// COMMENT DOESN'T EXIST

if (!$comment) {
    exit();
}



// USER DOESN'T OWN COMMENT

if ($comment["CommenterId"] != $userId) {
    exit();
}



//  DELETE CHILD REPLIES FIRST

$sql = "
    DELETE FROM Comments
    WHERE ParentCommentId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$commentId]);



// DELETE MAIN COMMENT

$sql = "
    DELETE FROM Comments
    WHERE CommentId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$commentId]);



// RELOAD COMMENTS

$_GET["postId"] = $comment["PostId"];

require "load_comments.php";