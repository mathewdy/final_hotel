<?php
  include "../connection.php";
  date_default_timezone_set('Asia/Manila');
  $added_on = date('Y-m-d');

  $check_dates = "SELECT added_on FROM users";
  $query_dates = mysqli_query($conn, $check_dates);
  if(mysqli_num_rows($query_dates) > 0){
    $ROWS = mysqli_fetch_array($query_dates);
    if($added_on > $ROWS['added_on']){
      $delete_status = "DELETE FROM users WHERE email_status = 0";
      $query_delete = mysqli_query($conn, $delete_status);
    }
  }
?>