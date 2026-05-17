<?php

session_start();

require_once "db.php";

if (!isset($_SESSION["user"])) {
    exit();
}

$theme = $_POST["theme"] ?? "dark";

if (!in_array($theme, ["dark", "light", "purple"])) {
    exit();
}

$userId = $_SESSION["user"]["UserId"];



// UPDATE THEME

$sql = "
    UPDATE Users
    SET Theme = ?
    WHERE UserId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([
    $theme,
    $userId
]);



$_SESSION["user"]["Theme"] = $theme;

header("Location: ../includes/settings.php");