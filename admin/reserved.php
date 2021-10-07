<?php 
include("../connection.php");
session_start();
  if(isset($_SESSION['username']) && isset($_SESSION['password'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
</head>
<body>
   <a href="logout.php">Logout</a> 
   <br>
   <a href="home.php">Clients</a>
   <a href="pending.php">Pending Requests</a>
   <a href="reserved.php">Reserved Rooms</a>

   <?php 
    $sql = "SELECT rooms.room_number, rooms.status, room_types.name_of_room, book_info.room_id,
    book_info.users_id, book_info.check_in, book_info.check_out FROM book_info
    LEFT JOIN rooms ON book_info.room_id = rooms.id
    LEFT JOIN users ON book_info.users_id = users.id
    LEFT JOIN room_types ON rooms.room_type_id = room_types.id WHERE rooms.status = 'reserved' ORDER BY book_info.added_on DESC";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
    ?>
    <table>
					<thead>
					<tr>
					<th>Rooms</th>
					<th>Room Types</th>
					<th>Status</th>
					<th>Operation</th>
					</tr>
					</thead>
				
					<?php 
						while($rows = mysqli_fetch_array($query)){
					?>
					<tbody>
					<tr>
					<td><?php echo $rows['room_number'];?></td>
					<td><?php echo $rows['name_of_room'];?></td>
					<td><?php echo $rows['status'];?></td>
					<td><a href="details.php?r&rid=<?php echo $rows['room_id']?>&id=<?php echo $rows['users_id']?>">View</a>
					</td>
					</tr>
					</tbody>
					<?php
					}
					?>
					</table>
    
    <?php
    }
    else{
    ?>
    <h3>No Reserved Rooms Yet</h3>
    <?php
    }
   ?>
</body>
</html>
<?php }else{
  header("location:index.php");
  exit();
}
?>
