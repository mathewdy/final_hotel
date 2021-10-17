<?php
include "email_status.php";
include "../connection.php";
include "./includes/header.php";
if(isset($_GET['id']) && isset($_GET['uid']) && isset($_GET['g']) && isset($_GET['in']) && isset($_GET['out'])){
  $room_id = $_GET['id'];
  $user_id = $_GET['uid'];
  $guest = $_GET['g'];
  $check_in = $_GET['in'];
  $check_out = $_GET['out'];

  $date_in = date("Y-m-d", strtotime($check_in));
  $time_in = date("h:i A", strtotime($check_in));
  
  $date_out = date("Y-m-d", strtotime($check_out));
  $time_out = date("h:i A", strtotime($check_out));
  if(empty($room_id) && empty($user_id) && empty($guest) && empty($check_in) && $check_out){
    header("Location:index.php");
  }else{
    $check_account = "SELECT id FROM users WHERE id = '$user_id'";
    $query_check = mysqli_query($conn, $check_account);
    if(mysqli_num_rows($query_check) == 0){
      echo "wala sa db";
    }
  }
}else{
  echo "error";
}
?>
  <?php
  $get_request_room = "SELECT rooms.id,rooms.room_number, room_types.name_of_room, room_types.price, room_types.image, packages.name_package, packages.description
  FROM rooms 
  LEFT JOIN room_types ON rooms.room_type_id = room_types.id
  LEFT JOIN packages ON room_types.package_id = packages.id
  WHERE rooms.id = $room_id";
  $query_request_room = mysqli_query($conn, $get_request_room);
  $rows = mysqli_fetch_array($query_request_room);
  ?>
<div class="container px-lg-5">
  <h2 class=" display-1 p-3 text-muted text-center">Summary Details</h2>
  <hr class="featurette-divider">
  <div class="container w-75">
  <p class="fw-bold">Date of Check In: <?php echo "".$date_in." ".$time_in.""?></p>
  <p class="fw-bold">Date of Check Out: <?php echo "".$date_out." ".$time_out.""?></p>
  <p class="fw-bold">Number of Guest: <?php echo $guest?></p>
  <p class="fw-bold">Name of Room: <?php echo $rows['name_of_room']?></p>
  <p class="fw-bold">Room Number: <?php echo $rows['room_number']?></p>
  <p class="fw-bold">Package: <?php echo $rows['name_package']?></p>
  <p class="fw-bold">Price: <?php echo $rows['price']?></p>
  <p class="fw-bold pb-5">Description: <?php echo $rows['description']?></p>
  <a class="btn btn-danger" href="index.php">Cancel</a>
  <a class="btn btn-primary" href="payment.php?paypal&id=<?php echo $room_id?>&uid=<?php echo$user_id?>&g=<?php echo $guest?>&in=<?php echo $check_in?>&out=<?php echo $check_out?>">Pay via Paypal</a>
  <a class="btn btn-outline-dark" href="payment.php?other&id=<?php echo $room_id?>&uid=<?php echo$user_id?>&g=<?php echo $guest?>&in=<?php echo $check_in?>&out=<?php echo $check_out?>">Others</a>
</div>
</div>
  
</body>
</html>