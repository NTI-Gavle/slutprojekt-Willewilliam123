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
    <title>Register</title>

    <link rel="stylesheet" href="../public/css/styles.css">

    <?php include "../includes/skeleton/head.php" ?>
</head>

<body class="purple auth-page">

    <div class="auth-container">

        <div class="auth-card">

            <h1 class="auth-title">
                Create Account
            </h1>

            <p class="auth-subtitle">
                Join the platform
            </p>

            <?php if($errorMSG != ""): ?>

                <div class="auth-error">
                    <?= htmlspecialchars($errorMSG) ?>
                </div>

            <?php endif; ?>

            <form action="../database/register2.php" method="POST" class="auth-form">

                <input
                    type="text"
                    name="username"
                    placeholder="Username"
                    required
                >

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                >

                <button type="submit" class="auth-button">
                    Register
                </button>

            </form>

            <p class="auth-switch-text">
                Already have an account?
            </p>

            <a href="login.php" class="auth-switch-link">
                Log In
            </a>

        </div>

    </div>

</body>
</html>