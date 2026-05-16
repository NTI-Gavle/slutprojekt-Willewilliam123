<?php
session_start();
    $errorMSG = "";
if(isset($_SESSION["registerError"])) {
    $errorMSG = $_SESSION["registerError"];
    unset($_SESSION["registerError"]);
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

    <?php
    if($errorMSG != "") {
        echo "<p>" . $errorMSG . "<p>";

    }

    ?>

    <h1>Register:</h1>¨

<div class="form">
    <form action="../database/register2.php" method="POST" class="flex col">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">

        <button type="submit">Sign in</button>
    </form>
</div>
</body>
</html>