<?php 
  include("../connection.php");
  session_start();
  if(empty($_SESSION['username']) && empty($_SESSION['password'])){
      header("Location:index.php");
      exit();
    }
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
<?php
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
  
   function sendPDF($send_pdf, $email, $full_name){
       require ("../PHPMailer.php");
       require("../SMTP.php");
       require("../Exception.php");

       $mail = new PHPMailer(true);

       try {
           //Server settings
          
           $mail->isSMTP();                                            //Send using SMTP
           $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
           $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
           $mail->Username   = 'cmdyzxcvbnm123@gmail.com';                     //SMTP username
           $mail->Password   = '62409176059359';                               //SMTP password
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
           $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
       
           //Recipients
           $mail->setFrom('cmdyzxcvbnm123@gmail.com', 'ProCreation');
           $mail->addAddress($email);     //Add a recipient
           //add pdf attachment
           $mail->addStringAttachment($send_pdf,'Hotel Receipt.pdf');
           //Content
           $mail->isHTML(true);
           
           //Set email format to HTML
           $mail->Subject = 'Book Receipt from Hotel De Luna ';
           $mail->Body = "<span style=font-size:18px;letter-spacing:0.5px;color:black;>Good day <b>$full_name</b>!</span><br><span style=font-size:15px;letter-spacing:0.5px;color:black;>Below of this message is your receipt please print it out before entering in our hotel thank you!</span>";
          
       
           $mail->send();
           return true;
       } catch (Exception $e) {
           return false;
       }
       
   }

   echo NULL;
   ?> 
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
      <span>Proof of Transaction: <img src="../back_end/receipt/<?php echo $rows['image']?>"></span><br>
    <span>Paid via: <?php echo $rows['bank']?></span><br>
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
    <span>Account ID: <?php echo $rows['account_id']?></span><br>
    <span>Booked Room: <?php echo $rows['room_number']?></span><br>
    <span>Check in: <?php echo $rows['check_in']?></span><br>
    <span>Check out: <?php echo $rows['check_out']?></span><br>
    <span>Paid via: <?php echo $rows['bank']?></span><br>
    <span>Status: <?php echo ucwords($rows['status'])?></span><br>
    <span>Proof of Transaction: <img src="../back_end/receipt/<?php echo $rows['image']?>"></span><br>
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
  
  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d");

  $sql = "SELECT users.account_id, users.first_name, users.last_name, users.email, users.mobile_number,
      rooms.room_number, room_types.name_of_room, packages.name_package, packages.description,
      room_types.price, book_info.payment_method, book_info.bank, book_info.guest, book_info.check_in,
      book_info.check_out, book_info.status
      FROM rooms
      JOIN users
      LEFT JOIN room_types ON rooms.room_type_id = room_types.id
      LEFT JOIN packages ON room_types.package_id = packages.id
      LEFT JOIN book_info ON book_info.room_id = rooms.id
      WHERE users.id = '$user_id' AND rooms.id = '$room_id' AND book_info.status = 'pending'";
      $query = mysqli_query($conn, $sql);
      if(mysqli_num_rows($query) > 0){
      $rows = mysqli_fetch_array($query);
      $first_name = ucwords($rows['first_name']);
      $last_name = ucwords($rows['last_name']);
      $full_name = "".$first_name." ".$last_name."";
      $chck_in = strtotime($rows['check_in']);
      $chck_out = strtotime($rows['check_out']);

      $email = $rows['email'];
      $account_id = $rows['account_id'];

        $tax = 7.4;
        $difference = $chck_out - $chck_in;
        $price = $rows['price'];
        $days = floor($difference/(60*60*24));
        $sub_total = $days * $price;
        $total = $sub_total + $tax;

      require('../back_end/fpdf184/fpdf.php');
      // Format ng pag gawa ng pdf
      // Cell(width, height, 'text', border(boolean to 1 & 0 lang), new line,'text align')
      
      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont('Arial', '', 25);
      $pdf->Ln(2);
      $pdf->Cell(140, 5, 'ProCreation', 0, 0);
      $pdf->SetFont('Arial', '', 12);
      $pdf->Cell(10, 5, 'Date', 0, 0);
      $pdf->Cell(52, 5, ': ' . $date, 0, 1);
      $pdf->SetFont('Arial', '', 9);
      $pdf->Cell(0, 5, '123 Di Makita St. Mabulag Tanga', 0, 1);
      $pdf->Cell(0, 2, 'Manila', 0, 0);
      $pdf->SetFont('Arial', '', 12);
      $pdf->Ln(14);
      $pdf->Cell(55, 5, 'Account No.', 0, 0);
      $pdf->Cell(58, 5, ': '. $rows['account_id'], 0, 1);
      $pdf->Cell(55, 5, 'Full Name', 0, 0);
      $pdf->Cell(58, 5, ': '. $full_name, 0, 1);
      $pdf->Cell(55, 5, 'Email', 0, 0);
      $pdf->Cell(58, 5, ': '. $rows['email'], 0, 1);
      $pdf->Cell(55, 5, 'Mobile No.', 0, 0);
      $pdf->Cell(58, 5, ': '. $rows['mobile_number'], 0, 1);
      $pdf->Cell(55, 5, 'Paid via', 0, 0);
      $pdf->Cell(58, 5, ': '. ucwords($rows['payment_method']) ." [". $rows['bank'] ."]" , 0, 1);
      $pdf->Line(10, 32, 200, 32);
      $pdf->Ln(6);
      $pdf->SetFont('Arial', '', 18);
      $pdf->Cell(0, 15, 'Room Info', 0, 1);
      $pdf->SetFont('Arial', '', 12);
      $pdf->Line(10, 65, 200, 65);
      $pdf->Cell(55, 5, 'Room No.', 0, 0);
      $pdf->Cell(58, 5, ': '. $rows['room_number'], 0, 1);
      $pdf->Cell(55, 5, 'Room Type', 0, 0);
      $pdf->Cell(58, 5, ': '. ucwords($rows['name_of_room']), 0, 1);
      $pdf->Cell(55, 5, 'Package', 0, 0);
      $pdf->Cell(58, 5, ': '. ucwords($rows['name_package']), 0, 1);
      $pdf->Cell(55, 5, 'Inclusive', 0, 0);
      $pdf->Cell(58, 5, ': '. $rows['description'], 0, 1);
      $pdf->Line(10, 110, 200, 110);
      $pdf->Ln(10);
      $pdf->SetFont('Arial', '', 18);
      $pdf->Cell(0, 15, 'Book Info', 0, 1);
      $pdf->SetFont('Arial', '', 12);
      $pdf->Cell(55, 5, 'No. of Guest', 0, 0);
      $pdf->Cell(58, 5, ': '. $rows['guest'], 0, 1);
      $pdf->Cell(55, 5, 'Days of Stay', 0, 0);
      $pdf->Cell(58, 5, ': '. $days, 0, 1);
      $pdf->Cell(55, 5, 'Request Status', 0, 0);
      $pdf->Cell(58, 5, ': '. ucwords($status), 0, 1);
      $pdf->SetFont('Arial', '', 14);
      $pdf->Cell(55, 5, 'Check-in', 0, 1);
      $pdf->SetFont('Arial', '', 12);
      $pdf->Cell(55, 5, 'Date', 0, 0);
      $pdf->Cell(58, 5, ': '. date('Y-m-d', strtotime($rows['check_in'])), 0, 1);
      $pdf->Cell(55, 5, 'Time', 0, 0);
      $pdf->Cell(58, 5, ': '. date('h:i A', strtotime($rows['check_in'])), 0, 1);
      $pdf->SetFont('Arial', '', 14);
      $pdf->Cell(55, 5, 'Check-out', 0, 1);
      $pdf->SetFont('Arial', '', 12);
      $pdf->Cell(55, 5, 'Date', 0, 0);
      $pdf->Cell(58, 5, ': '. date('Y-m-d', strtotime($rows['check_out'])), 0, 1);
      $pdf->Cell(55, 5, 'Time', 0, 0);
      $pdf->Cell(58, 5, ': '. date('h:i A', strtotime($rows['check_out'])), 0, 1);
      $pdf->Ln(5);
      $pdf->Cell(130, 5, '', 0, 0);
      $pdf->Cell(30, 5, 'Sub Total', 0, 0);
      $pdf->Cell(58, 5, ': $ '. $sub_total, 0, 1);
      $pdf->Cell(130, 5, '', 0, 0);
      $pdf->Cell(30, 5, 'Tax', 0, 0);
      $pdf->Cell(58, 5, ': $ '. $tax, 0, 1);
      $pdf->Cell(130, 5, '', 0, 0);
      $pdf->Cell(30, 5, 'Total', 0, 0);
      $pdf->Cell(58, 5, ': $ '. $total, 0, 1);
      $pdf->SetFont('Arial', '', 11);
      $pdf->Ln(20);
      $pdf->Cell(0, 5, 'Thank you for booking!', 0, 0, "C");
      $pdf->Line(10, 215, 84, 215);
      $pdf->Line(126, 215, 200, 215);
      $send_pdf = $pdf->Output('', 'S');

      $update_status = "UPDATE book_info SET `status` = '$status' WHERE users_id = '$user_id' AND room_id = '$room_id'";
      $query_change = mysqli_query($conn, $update_status) && sendPDF($send_pdf, $email, $full_name); ;
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
    }else{
      echo '<script>swal({
        title: "Oops!",
        text: "No Data Found!",
        icon: "warning",
        }).then(function() {
        // Redirect the user
        window.location.href="pending.php";
    });</script>';
    }

      
}?>
