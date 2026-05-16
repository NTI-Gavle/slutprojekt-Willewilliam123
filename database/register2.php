<?php

session_start();

include("db.php");

if(isset($_POST["username"])){
    $user = $_POST["username"];
}

if(isset($_POST["password"])){
    $pass = $_POST["password"];
}

if(!(isset($pass) && isset($user))){    
    header("Location: ../includes/login.php");
    exit();
}
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $dbconn->prepare($sql);

$data = array($user);
$stmt->execute($data);

$res = $stmt->fetch(PDO::FETCH_ASSOC);

if(!empty($res)) {
    $_SESSION["registerError"]="User already exists";
    header("Location: register.php");
    die();
}

$sql = "INSERT INTO users (Username,PasswordHash) VALUES (?, ?)";
$stmt = $dbconn->prepare($sql);

$data = array($user, password_hash($pass, PASSWORD_DEFAULT));
$stmt->execute($data);

header("Location: ../includes/login.php")

?>