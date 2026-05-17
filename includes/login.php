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
    <title>Login</title>

    <link rel="stylesheet" href="../public/css/styles.css">

    <?php include "../includes/skeleton/head.php" ?>
</head>

<body class="<?= $_SESSION['user']['Theme'] ?? 'purple' ?> auth-page">

    <div class="auth-container">

        <div class="auth-card">

            <h1 class="auth-title">
                Welcome Back
            </h1>

            <p class="auth-subtitle">
                Log in to your account
            </p>

            <?php if($errorMSG != ""): ?>

                <div class="auth-error">
                    <?= htmlspecialchars($errorMSG) ?>
                </div>

            <?php endif; ?>

            <form action="../database/signin.php" method="POST" class="auth-form">

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
                    Log In
                </button>

            </form>

            <p class="auth-switch-text">
                Don't have an account?
            </p>

            <a href="register.php" class="auth-switch-link">
                Create Account
            </a>

        </div>

    </div>

</body>
</html>