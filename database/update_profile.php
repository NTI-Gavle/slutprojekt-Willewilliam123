<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "db.php";

// CHECK IF CORRECT USER

if (!isset($_SESSION["user"])) {
    exit();
}

$userId = $_SESSION["user"]["UserId"];

//CLEAN UP/STRIP INFORMATION

$displayName = trim($_POST["displayName"] ?? "");
$bio = trim($_POST["bio"] ?? "");
$avatarUrl = trim($_POST["avatarUrl"] ?? "");

// CHANGES VALUES OF DATABASE

$sql = "

    UPDATE Users

    SET

        DisplayName = ?,
        Bio = ?,
        AvatarUrl = ?

    WHERE UserId = ?

";

// EXECUTES CHANGES TO THE SITE

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $displayName,
    $bio,
    $avatarUrl,
    $userId
]);



// UPDATE SESSION

$_SESSION["user"]["DisplayName"] = $displayName;
$_SESSION["user"]["Bio"] = $bio;
$_SESSION["user"]["AvatarUrl"] = $avatarUrl;



header(
    "Location: ../includes/profile.php?user=" .
    $_SESSION["user"]["Username"]
);