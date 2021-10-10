<?php
session_start();
include('../connection.php');
include('./includes/header.php');

?>
<div class="container">

    <a href="#">Home</a>
    <a href="all.php">Rooms</a>
    
    <a href="economy.php">Economy</a>
    <a href="executive.php">Executive</a>
    <a href="deluxe.php">Deluxe</a>

    <!---para sa history Transactions ng user--->
    <a href="transactions.php">Transactions</a>

</div>
<script src="../js/bootstrap.js"></script>
</body>
</html>