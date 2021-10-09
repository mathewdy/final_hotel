<?php
include "../connection.php";
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
    <a href="index.php">Home</a>
    <a href="rooms.php">Rooms</a>
    <a href="economy.php">Economy</a>
    <a href="deluxe.php">Deluxe</a>
    <a href="executive.php">Executive</a>
    <a href="">Sign in</a>
  <?php
  $sql = "SELECT rooms.id , rooms.room_number,rooms.room_type_id, room_types.id, room_types.image,
  room_types.name_of_room, room_types.price,room_types.package_id, packages.id,packages.name_package,packages.description
  FROM room_types
  LEFT JOIN rooms ON rooms.room_type_id = room_types.id
  LEFT JOIN packages ON room_types.package_id = packages.id 
  WHERE rooms.room_type_id = 2
  ORDER BY rooms.room_type_id ASC";
  $query = mysqli_query($conn, $sql);
  if(mysqli_num_rows($query) > 0){
    while($rows = mysqli_fetch_array($query)){?>
     <img src="../Photos/hotel_rooms/<?php echo  $rows ['image']?>" alt="<?php echo $rows['name_of_room']?>">
      <p>Room number : <?php echo $rows ['room_number']?></p>
      <p>Price : <?php echo $rows ['price']?></p>
      <p>Package : <?php echo $rows ['name_package']?></p>
      <p>Description : <?php echo $rows ['description']?></p>
      <a href="book.php?b&id=<?php echo $rows['id']?>">Book now</a>

  <?php }}else{?>
    No Data Found
  <?php }?>
</body>
</html>