<?php 
include("../connection.php");
include("./includes/header.php");
session_start();
  if(isset($_SESSION['username']) && isset($_SESSION['password'])){
?>
<div class="container bg-white vh-100 ">
<ul class="nav nav-pills nav-fill mb-4">
  <li class="nav-item"> 
    <a class="nav-link active" href="home.php">Clients</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="pending.php">Pending Requests</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="reserved.php">Reserved Rooms</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="book-history.php">Booking History</a>
  </li>
</ul>
<div class="container p-lg-4">
  <?php 
    $sql = "SELECT * FROM users ORDER BY added_on ASC";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
    ?>
    <div class="container p-4">
    <table class="table table-hover">
					<thead class="text-muted">
					<tr>
					<th scope="col"><small>Account ID</small></th>
					<th scope="col"><small>First Name</small></th>
					<th scope="col"><small>Last Name</small></th>
					<th scope="col"><small>Email</small></th>
					<th scope="col"><small>Mobile Number</small></th>
					</tr>
					</thead>
				
					<?php 
						while($rows = mysqli_fetch_array($query)){
					?>
					<tbody>
            <tr>
              <td><small><?php echo $rows['account_id'];?></small></td>
              <td><small><?php echo $rows['first_name'];?></small></td>
              <td><small><?php echo $rows['last_name'];?></small></td>
              <td><small><?php echo $rows['email'];?></small></td>
              <td><small><?php echo $rows['mobile_number'];?></small></td>
            </tr>
					</tbody>
					<?php
					}
					?>
					</table>
          </div>
    <?php
    }
    else{
    ?>
    <h3>No Clients Yet</h3>
    <?php
    }
   ?>
   </div>
  </div>
</body>
</html>
<?php }else{
  header("location:index.php");
  exit();
}
?>
