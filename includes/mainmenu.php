<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: login.php");
    echo "yo";
}

include "Botstrap.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=90shjciodpsqI UWI, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
include "nav.php"
?>