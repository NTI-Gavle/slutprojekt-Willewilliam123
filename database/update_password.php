<?php

session_start();

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

$currentPassword = $_POST["currentPassword"] ?? "";
$newPassword = $_POST["newPassword"] ?? "";

$userId = $_SESSION["user"]["UserId"];



$sql = "
    SELECT *
    FROM Users
    WHERE UserId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$userId]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);



if (!password_verify(
    $currentPassword,
    $user["PasswordHash"]
)) {
    die("Wrong password");
}



//  UPDATE PASSWORD


$sql = "
    UPDATE Users
    SET PasswordHash = ?
    WHERE UserId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    password_hash($newPassword, PASSWORD_DEFAULT),
    $userId
]);

header("Location: ../includes/settings.php");