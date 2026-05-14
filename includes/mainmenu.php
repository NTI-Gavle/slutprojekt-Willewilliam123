<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    echo "yo";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=90shjciodpsqI UWI, initial-scale=1.0">
    <title>Document</title>
    <?php include "../includes/skeleton/head.php" ?>
</head>

<body>
    <?php
    include "nav.php"
    ?>
</body>

</html>