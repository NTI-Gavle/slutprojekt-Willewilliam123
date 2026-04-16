<?php
session_start();

if(!isset($_SESSION["user"])){
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
    <link ref="stylesheet" href="../bootstrap/css/bootstrap-responsive.css">
    <link ref="stylesheet" href="../bootstrap/css/bootstrap.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="></div>
    
</body>
</html>
<?php
include "nav.php"
?>