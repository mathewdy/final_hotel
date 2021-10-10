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
  <title>Document</title>
</head>
<body>
  
</body>
</html>