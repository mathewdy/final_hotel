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


<?php 
    $sql = "SELECT users.id, users.account_id, rooms.room_number, book_info.image,
    book_info.bank,  book_info.check_in, book_info.check_out, book_info.status, book_info.added_on FROM book_info 
    LEFT JOIN rooms ON book_info.room_id = rooms.id
    LEFT JOIN users ON book_info.users_id = users.id 
    WHERE book_info.status = 'done'
    ORDER BY book_info.added_on DESC";
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
    }
   ?>
</body>
</html>
<?php }else{
  header("Location:index.php");
  exit();
}