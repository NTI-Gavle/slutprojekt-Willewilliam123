<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

if (!isset($_POST["postId"])) {
    exit();
}
    
$postId = $_POST["postId"];

$userId = $_SESSION["user"]["UserId"];

$sql = "
    SELECT *
    FROM Posts
    WHERE PostId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$postId]);

$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    exit();
}

if ($post["UserId"] != $userId) {
    exit();
}

$sql = "
    DELETE FROM Posts
    WHERE PostId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$postId]);

require "load_feed.php";