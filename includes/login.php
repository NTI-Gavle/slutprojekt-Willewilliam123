<?php
session_start();
    $errorMSG = "";
if(isset($_SESSION["loginError"])) {
    $errorMSG = $_SESSION["loginError"];
    unset($_SESSION["loginError"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
<div id="loginthang">

    <?php
    if($errorMSG != "") {
        echo "<p>" . $errorMSG . "<p>";
    }
    
    ?>
    <h1>Log in:</h1>    
    <div class="form">
        <form action="../database/signin.php" method="POST" id="signinform">
            <label for="username">Username:</label>
            <input type="text" name="username">
            <label for="password">Password:</label>
            <input type="password" name="password">
            
            <button type="submit" id="loginbtn">Log in</button>
        </form>
    </div>
    <h3>Dont have an account?</h3> <a href="register.php">Click here to sign in</a>
</div>
</body>
</html>