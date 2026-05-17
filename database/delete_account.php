<?php

session_start();

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

$userId = $_SESSION["user"]["UserId"];



// DELETE USER CONTENT


$dbconn->prepare("
    DELETE FROM Comments
    WHERE CommenterId = ?
")->execute([$userId]);

$dbconn->prepare("
    DELETE FROM Posts
    WHERE UserId = ?
")->execute([$userId]);

$dbconn->prepare("
    DELETE FROM Users
    WHERE UserId = ?
")->execute([$userId]);



session_destroy();

header("Location: ../includes/login.php");