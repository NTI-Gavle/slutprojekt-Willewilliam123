<?php

session_start();

include("../database/db.php");

if(isset($_POST["username"])){
    $user = $_POST["username"];
}

if(isset($_POST["password"])){
    $pass = $_POST["password"];
}

if(!(isset($pass) && isset($user))){    
    header("Location: login.php");
}
$email = "john.doe@example.com";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo("$email is a valid email address");
} else {
  echo("$email is not a valid email address");
}
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $dbconn->prepare($sql);

// parameters in array, if empty we could skip the $data-variable
$data = array($user);
$stmt->execute($data);

$res = $stmt->fetch(PDO::FETCH_ASSOC);

if(!empty($res)) {
    $_SESSION["registerError"]="User already exists";
    header("Location: register.php");
    die();
}

$sql = "INSERT INTO users (Username,Password) VALUES (?, ?)";
$stmt = $dbconn->prepare($sql);

// parameters in array, if empty we could skip the $data-variable
$data = array($user, password_hash($pass, PASSWORD_DEFAULT));
$stmt->execute($data);

header("Location: ../includes/login.php")

?>