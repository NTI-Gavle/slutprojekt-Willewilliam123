<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../database/db.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION["user"]["UserId"];



// LOAD USER

$sql = "
    SELECT *
    FROM Users
    WHERE UserId = ?
";

$stmt = $dbconn->prepare($sql);

$stmt->execute([$userId]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <?php include "../includes/skeleton/head.php"; ?>
    <script src="../public/js/settings.js"></script>
</head>
<body class="<?= $_SESSION["user"]["Theme"] ?? 'purple' ?>">

<div class="app-layout">



    <!-- SIDEBAR -->

    <aside>

        <?php include "nav.php"; ?>

    </aside>



    <!-- SETTINGS -->

    <main class="settings-page">



        <h1>

            Settings

        </h1>



        <!-- TABS -->

        <div class="settings-tabs">

            <button class="settings-tab-button active-tab" onclick="showSettingsTab('account-tab', this)">
                Account
            </button>



            <button class="settings-tab-button" onclick="showSettingsTab('appearance-tab', this)">
                Appearance
            </button>

        </div>



        <!-- ACCOUNT TAB -->

        <section id="account-tab" class="settings-tab-content">

            <div class="settings-card">

                <h2>
                    Change Username
                </h2>

                <form action="../database/update_account.php" method="POST">

                    <input type="text" name="username" maxlength="64" required value="<?= htmlspecialchars($user["Username"]) ?>">

                    <button type="submit">
                        Save Username
                    </button>

                </form>

            </div>



            <div class="settings-card">

                <h2>
                    Change Password
                </h2>

                <form  action="../database/update_password.php"  method="POST">

                    <input type="password" name="currentPassword" placeholder="Current password" required>

                    <input type="password" name="newPassword" placeholder="New password" required>

                    <button type="submit">
                        Change Password
                    </button>

                </form>

            </div>



            <!-- DELETING ACCOUNT -->

            <div class="settings-card danger-zone">

                <h2>
                    Delete Account
                </h2>

                <form action="../database/delete_account.php" method="POST" onsubmit="return confirm('Delete your account permanently?')">

                    <button type="submit" class="danger-button">
                        Delete Account
                    </button>

                </form>

            </div>

        </section>



        <!-- APPEARANCE TAB -->

        <section id="appearance-tab" class="settings-tab-content" style="display:none;">

            <div class="settings-card">

                <h2>
                    Theme
                </h2>

                <form  action="../database/update_theme.php" method="POST">

                    <select name="theme">

                        <option value="dark" <?= $user["Theme"] === "dark" ? "selected" : "" ?>>
                            Dark
                        </option>

                        <option value="light" <?= $user["Theme"] === "light" ? "selected" : "" ?>>
                            Light (death)
                        </option>

                        <option value="purple" <?= $user["Theme"] === "purple" ? "selected" : "" ?>>
                            Purple
                        </option>

                    </select>

                    <button type="submit">

                        Save Theme

                    </button>

                </form>

            </div>

        </section>

    </main>

</div>

</body>

</html>