<?php

include('../connection.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="">Home</a>
    <a href="all.php">Rooms</a>
    
    <a href="economy.php">Economy</a>
    <a href="">Executive</a>

    <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="Log Out">
    </form>


</body>
</html>