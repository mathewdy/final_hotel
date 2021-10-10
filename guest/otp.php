<?php
include "../connection.php";
if(isset($_GET['id']) && isset($_GET['aid'])){
  $room_id = $_GET['id'];
  $account_id = $_GET['aid'];
  if(empty($room_id) && empty($account_id)){
    header("Location:index.php");
  }else{
    $check_account = "SELECT account_id FROM users WHERE account_id = '$account_id'";
    $query_check = mysqli_query($conn, $check_account);
    if(mysqli_num_rows($query_check) == 0){
      echo "wala sa db";
    }
  }
}else{
  echo "error";
}
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
 <?php echo $room_id?>
 <form action="" method="POST">
 <input type="number" name="otp_number">
 <button type="submit" name="check_otp">Submit</button>
 </form>
</body>
</html>
<?php
  if(isset($_POST['check_otp'])){
    $otp_number = $_POST['otp_number'];

    $sql = "SELECT * FROM users WHERE account_id = '$account_id'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0 ){
      $rows = mysqli_fetch_array($query);
      if($otp_number == $rows['v_code']){
        $update_code = "UPDATE users SET `v_code` = 0 WHERE accoount_id = '$account_id'";
        $query_update = mysqli_query($conn, $update_code);
        if($query_update){
          header("Location:details.php?id=$room_id&aid=$account_id");
          exit();
        }else{
          echo "error" . $conn->error;
        }
        }else{
        echo "<script>swal({
          title: 'Oops!',
          text: 'Invalid code, try again',
          icon: 'warning',
          }).then(function() {
          // Redirect the user
          window.location.href='otp.php?id=$room_id&aid=$account_id';
          });</script>";
      }
    }
  }
?>
