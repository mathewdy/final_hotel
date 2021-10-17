<?php 
  include("../connection.php");
  include("./includes/header.php");
  session_start();
  if(isset($_SESSION['username']) && isset($_SESSION['password'])){
?>
<div class="container bg-white vh-100">
<ul class="nav nav-pills nav-fill">
  <li class="nav-item"> 
    <a class="nav-link" href="home.php">Clients</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="pending.php">Pending Requests</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="reserved.php">Reserved Rooms</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link active" href="book-history.php">Booking History</a>
  </li>
</ul>

<div class="container">
  <form action="" method="POST">
    <span class="hstack gap-3 justify-content-end">
      <input class="form-control w-25" type="date" name="date">
      <button class="btn btn-primary" type="submit" name="searchDate">Search</button>      
    </span>
  </form>
</div>

<div class="container p-lg-5">
      <?php 
      if(isset($_POST['searchDate'])){
      $date = $_POST['date'];
      $format_date = date('Y-m-d', strtotime($date));

      $get_date = "SELECT users.id, users.account_id, rooms.room_number, transactions.image,
      transactions.room_id, transactions.check_in, transactions.check_out, transactions.bank, transactions.status, transactions.added_on 
      FROM transactions 
      LEFT JOIN rooms ON transactions.room_id = rooms.id
      LEFT JOIN users ON transactions.users_id = users.id 
      WHERE DATE_FORMAT(transactions.check_in,'%Y-%m-%d') = '$format_date' AND transactions.status = 'done'
      ORDER BY transactions.added_on DESC"; ?>
      <div class="container pt-0">
        <table class="table table-hover text-center">
          <thead class="text-muted">
            <tr>
              <th scope="col"><small>Account ID</small></th>
              <th scope="col"><small>Booked Room</small></th>
              <th scope="col"><small>Check In</small></th>
              <th scope="col"><small>Check Out</small></th>
              <th scope="col"><small>Status</small></th>
              <th scope="col"><small>Added On</small></th>
            </tr>
          </thead>
      <?php
      $query_date = mysqli_query($conn, $get_date);
      if(mysqli_num_rows($query_date) > 0){
        while($rows = mysqli_fetch_array($query_date)){
      ?>
      <tbody>
        <tr>
          <td><?php echo $rows['account_id']?></td>
          <td><?php echo $rows['room_number']?></td>
          <td><?php echo $rows['check_in']?></td>
          <td><?php echo $rows['check_out']?></td>
          <td><?php echo ucwords($rows['status'])?></td>
          <td> <?php echo $rows['added_on']?></td>
        </tr>
      </tbody>
      <?php }}else{?>
        No Data Found
      <?php }?>
      <?php }else{?>
        </table>
<?php 
    $sql = "SELECT users.id, users.account_id, rooms.room_number, transactions.image,
    transactions.bank,  transactions.check_in, transactions.check_out, transactions.status, transactions.added_on FROM transactions 
    LEFT JOIN rooms ON transactions.room_id = rooms.id
    LEFT JOIN users ON transactions.users_id = users.id 
    WHERE transactions.status = 'done'
    ORDER BY transactions.added_on DESC";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
      while($rows = mysqli_fetch_array($query)){
    ?>
    <br>
    <span>Account ID: <?php echo $rows['account_id']?></span><br>
    <span>Booked Room: <?php echo $rows['room_number']?></span><br>
    <span>Check in: <?php echo $rows['check_in']?></span><br>
    <span>Check out: <?php echo $rows['check_out']?></span><br>
    <span>Status: <?php echo ucwords($rows['status'])?></span><br>
    <span>Added on: <?php echo $rows['added_on']?></span><br>
    <?php
    }
    }else{
    ?>
    <h3>No Reserved Room Yet</h3>
    <?php
      }}
  ?>
</div>
</div>
</body>
</html>
<?php }else{
  header("Location:index.php");
  exit();
}