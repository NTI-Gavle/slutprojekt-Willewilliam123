<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

if (!isset($_POST["postText"])) {
    exit();
}

$postText = trim($_POST["postText"]);

if (strlen($postText) > 1000) {
    exit();
}

if (empty($postText)) {

    require "load_feed.php";
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

require "load_feed.php";