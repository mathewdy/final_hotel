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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
  <title>Document</title>
</head>
<body>
      <a href="logout.php">Logout</a> 
      <br>
      <a href="home.php">Clients</a>
      <a href="pending.php">Pending Requests</a>
      <a href="reserved.php">Reserved Rooms</a>
      <a href="book-history.php">Booking History</a>


      <form action="" method="POST">
      <input type="date" name="date">
      <button type="submit" name="searchDate">Search</button>
      </form>

      <?php 
      if(isset($_POST['searchDate'])){
      $date = $_POST['date'];
      $format_date = date('Y-m-d', strtotime($date));

      $get_date = "SELECT users.id, users.account_id, rooms.room_number, book_info.image,
      book_info.room_id, book_info.check_in, book_info.check_out, book_info.bank, book_info.status, book_info.added_on 
      FROM book_info 
      LEFT JOIN rooms ON book_info.room_id = rooms.id
      LEFT JOIN users ON book_info.users_id = users.id 
      WHERE DATE_FORMAT(book_info.check_in,'%Y-%m-%d') = '$format_date' AND book_info.status = 'pending'
      ORDER BY book_info.added_on DESC";
      $query_date = mysqli_query($conn, $get_date);
      if(mysqli_num_rows($query_date) > 0){
        while($rows = mysqli_fetch_array($query_date)){
      ?>
      <br>
      <span>Account ID: <?php echo $rows['account_id']?></span><br>
      <span>Booked Room: <?php echo $rows['room_number']?></span><br>
      <span>Check in: <?php echo $rows['check_in']?></span><br>
      <span>Check out: <?php echo $rows['check_out']?></span><br>
      <span>Status: <?php echo $rows['status']?></span><br>
      <span>Added on: <?php echo $rows['added_on']?></span><br>
      <a href="pending.php?p&id=<?php echo $rows['id']?>&rid=<?php echo $rows['room_id']?>">Confirm</a><br>
      <?php }}else{?>
        No Data Found
      <?php }?>
      <?php }else{?>
    
<?php 
    $sql = "SELECT users.id, users.account_id, rooms.room_number, book_info.image,
    book_info.room_id, book_info.check_in, book_info.check_out, book_info.bank, book_info.status, book_info.added_on FROM book_info 
    LEFT JOIN rooms ON book_info.room_id = rooms.id
    LEFT JOIN users ON book_info.users_id = users.id 
    WHERE book_info.payment_method = 'bank' AND book_info.status = 'pending'
    ORDER BY book_info.added_on DESC";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
      while($rows = mysqli_fetch_array($query)){
    ?>
    <br>
    <form action="" method="POST">
    <input type="date" name="date">
    <button type="submit" name="searchDate">Search</button>
    </form>
    <br>
    <span>Account ID: <?php echo $rows['account_id']?></span><br>
    <span>Booked Room: <?php echo $rows['room_number']?></span><br>
    <span>Check in: <?php echo $rows['check_in']?></span><br>
    <span>Check out: <?php echo $rows['check_out']?></span><br>
    <span>Proof of Transaction: <img src="../back_end/receipt/<?php echo $rows['image']?>"></span><br>
    <span>Paid via: <?php echo $rows['bank']?></span><br>
    <span>Status: <?php echo ucwords($rows['status'])?></span><br>
    <span>Added on: <?php echo $rows['added_on']?></span><br>
    <a href="pending.php?p&id=<?php echo $rows['id']?>&rid=<?php echo $rows['room_id']?>">Confirm</a><br>
    <?php
    }
    }else{
    ?>
    <h3>No Pending Request Yet</h3>
    <?php
      }}
   ?>
</body>
</html>
<?php 
if(isset($_GET['p']) && isset($_GET['id']) && isset($_GET['rid'])){
  $user_id = $_GET['id'];
  $room_id = $_GET['rid'];
  $status = "reserved";
  $update_status = "UPDATE book_info SET `status` = '$status' WHERE users_id = '$user_id' AND room_id = '$room_id'";
  $query_change = mysqli_query($conn, $update_status);
  if($query_change){
    
    echo '<script>swal({
      title: "Update Success!",
      text: "Status has been change!",
      icon: "success",
      }).then(function() {
      // Redirect the user
      window.location.href="pending.php";
  });</script>';
  }else{
    echo '<script>swal({
      title: "Oops!",
      text: "Something went wrong please try again!",
      icon: "warning",
      }).then(function() {
      // Redirect the user
      window.location.href="pending.php";
  });</script>';
  }

  
}?>
<?php }else{
  header("Location:index.php");
  exit();
}