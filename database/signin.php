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
}

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $dbconn->prepare($sql);

// parameters in array, if empty we could skip the $data-variable
$data = array($user);
$stmt->execute($data);

$res = $stmt->fetch(PDO::FETCH_ASSOC);

if ($res && password_verify($pass, $res["Password"])){
    unset($res["Password"]);
    $_SESSION["user"] = serialize($res);
    header("Location: ../includes/mainmenu.php");
    die();
}
else {
    $_SESSION["loginError"]="Wrong username or password";
    header("Location: ../includes/login.php");
}

print_r($res);
?>