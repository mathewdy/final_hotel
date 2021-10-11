<?php
include "email_status.php";
include "../connection.php";
include "./includes/header.php";
?>
<div class="container mt-0 p-xxl-3">
<a href="index.php" class="btn btn-dark mb-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
<path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
</svg><small>Back</small></a>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a href="rooms.php" class="nav-link"><small>All</small></a>
    </li>
    <li class="nav-item">
        <a href="economy.php" class="nav-link active"><small>Economy Rooms</small></a>
    </li>
    <li class="nav-item">
        <a href="deluxe.php" class="nav-link"><small>Deluxe Rooms</small></a>
    </li>
    <li class="nav-item">
        <a href="executive.php" class="nav-link"><small>Executive Rooms</small></a>
    </li>
</ul> 
<hr class="featurette-divider">
</div>
  <?php
  $sql = "SELECT rooms.id , rooms.room_number,rooms.room_type_id, room_types.id, room_types.image,
  room_types.name_of_room, room_types.price,room_types.package_id, packages.id,packages.name_package,packages.description
  FROM room_types
  LEFT JOIN rooms ON rooms.room_type_id = room_types.id
  LEFT JOIN packages ON room_types.package_id = packages.id 
  WHERE rooms.room_type_id = 1
  ORDER BY rooms.room_type_id ASC";?>
  <div class="container pt-0 mt-0">
  <div class="row">
  <?php
  $query = mysqli_query($conn, $sql);
  if(mysqli_num_rows($query) > 0){
    while($rows = mysqli_fetch_array($query)){?>
    <div class="col-lg-3 pb-3">
    <div class="card">
    <div class="card-body">
      <img class="card-img-top" src="<?php echo "../Photos/hotel_rooms/" . $rows ['image']?>" alt="<?php echo $rows['name_of_room']?>">
          <p class="p-0 m-0">Room number : <?php echo $rows ['room_number']?></p>
          <p class="p-0 m-0">Price : <?php echo $rows ['price']?></p>
          <p class="p-0 m-0">Package : <?php echo $rows ['name_package']?></p>
          <p class="p-0 m-0 mb-3">Description : <?php echo $rows ['description']?></p>

          <a class="btn btn-dark w-100" href="book.php?b&id=<?php echo $rows['id']?>">Book Now</a>
    </div>
    </div>
    </div>
  <?php }
  ?>
  </div>
  <?php }else{ ?>
    No Data Found
  <?php }?>
</div>

<?php
include "./includes/footer.php";
?>