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
   <a href="book-history.php">Booking History</a>

   <?php 
    $sql = "SELECT * FROM users ORDER BY added_on ASC";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
    ?>
    <table>
					<thead>
					<tr>
					<th>Account ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Mobile Number</th>
					</tr>
					</thead>
				
					<?php 
						while($rows = mysqli_fetch_array($query)){
					?>
					<tbody>
					<tr>
					<td><?php echo $rows['account_id'];?></td>
					<td><?php echo $rows['first_name'];?></td>
					<td><?php echo $rows['last_name'];?></td>
					<td><?php echo $rows['email'];?></td>
					<td><?php echo $rows['mobile_number'];?></td>
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
    <h3>No Clients Yet</h3>
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
