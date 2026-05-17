<?php

session_start();

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

$username = trim($_POST["username"] ?? "");

if (empty($username)) {
    exit();
}

$userId = $_SESSION["user"]["UserId"];



// CHECK IF USERNAME EXISTS


$sql = "
    SELECT *
    FROM Users
    WHERE Username = ?
    AND UserId != ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $username,
    $userId
]);

if ($stmt->fetch()) {
    die("Username already taken");
}



//  UPDATE


$sql = "
    UPDATE Users
    SET Username = ?
    WHERE UserId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $username,
    $userId
]);



$_SESSION["user"]["Username"] = $username;

header("Location: ../includes/settings.php");