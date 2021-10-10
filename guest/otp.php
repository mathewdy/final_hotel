<?php
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
  <title>Document</title>
</head>
<body>
    <a href="index.php">Home</a>
    <a href="rooms.php">Rooms</a>
    <a href="economy.php">Economy</a>
    <a href="deluxe.php">Deluxe</a>
    <a href="executive.php">Executive</a>
    <a href="">Sign in</a>
 <h2>OTP CODE</h2>
 <form action="" method="POST">
 <input type="number" name="otp_number">
 <button type="submit" name="check_otp">Submit</button>
 </form>
</body>
</html>
<?php
  if(isset($_POST['check_otp'])){
    date_default_timezone_set('Asia/Manila');
    $current = date('Y-m-d');
    $past = "2021-10-11";
    
    if($current > $past){
      echo "current";
    }else{
      echo "past pa";
    }
  }
?>
