<?php 
  session_start();
  include("../connection.php");
  include("./includes/header.php");
  require('../back_end/fpdf184/fpdf.php');
  require_once __DIR__.'/vendor/autoload.php';
  if(empty($_SESSION['username']) && empty($_SESSION['password'])){
      header("Location:index.php");
      exit();
    }
  //asdfghjkl
?>

<?php
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
  
   function sendPDF($send_pdf, $email, $full_name, $account_id){
       require ("PHPMailer.php");
       require("SMTP.php");
       require("Exception.php");

       $mail = new PHPMailer(true);

       try {
           //Server settings
          
           $mail->isSMTP();                                            //Send using SMTP
           $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
           $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
           $mail->Username   = 'cmdyzxcvbnm123@gmail.com';                     //SMTP username
           $mail->Password   = 'mathewpogi123';                               //SMTP password
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
<div class="container bg-white vh-100">
<ul class="nav nav-pills nav-fill">
  <li class="nav-item"> 
    <a class="nav-link" href="home.php">Clients</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link active" href="pending.php">Pending Requests</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="reserved.php">Reserved Rooms</a>
  </li>
  <li class="nav-item"> 
    <a class="nav-link" href="book-history.php">Booking History</a>
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
      WHERE DATE_FORMAT(transactions.check_in,'%Y-%m-%d') = '$format_date' AND transactions.status = 'pending'
      ORDER BY transactions.added_on DESC";
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
      </div>
      <a href="pending.php?p&id=<?php echo $rows['id']?>&rid=<?php echo $rows['room_id']?>">Confirm</a><br>
      <?php }}else{?>
        No Data Found
      <?php }?>
      <?php }else{?>
    
<?php 
    $sql = "SELECT users.id, users.account_id, rooms.room_number, transactions.image,
    transactions.room_id, transactions.check_in, transactions.check_out, transactions.bank, transactions.status, transactions.added_on FROM transactions 
    LEFT JOIN rooms ON transactions.room_id = rooms.id
    LEFT JOIN users ON transactions.users_id = users.id 
    WHERE transactions.payment_method = 'bank' AND transactions.status = 'pending'
    ORDER BY transactions.added_on DESC"; ?>
      <div class="container pt-0">
        <table class="table table-hover text-center">
          <thead class="text-muted">
            <tr>
              <th scope="col"><small>Account ID</small></th>
              <th scope="col"><small>Booked Room</small></th>
              <th scope="col"><small>Check In</small></th>
              <th scope="col"><small>Check Out</small></th>
              <th scope="col"><small>Payment method</small></th>
              <th scope="col"><small>Status</small></th>
              <th scope="col"><small>Proof of transaction</small></th>
              <th scope="col"><small>Added On</small></th>
              <th scope="col"><small>Action</small></th>
            </tr>
          </thead>
    <?php $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
      while($rows = mysqli_fetch_array($query)){
    ?>
    <br>
    <tbody>
      <tr>
        <td><?php echo $rows['account_id']?></td>
        <td><?php echo $rows['room_number']?></td>
        <td><?php echo $rows['check_in']?></td>
        <td><?php echo $rows['check_out']?></td>
        <td> <?php echo $rows['bank']?></td>
        <td> <?php echo ucwords($rows['status'])?></td>
        <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">View Image</a></td>
        <td> <?php echo $rows['added_on']?></td>
        <td> <a href="pending.php?p&id=<?php echo $rows['id']?>&rid=<?php echo $rows['room_id']?>">Confirm</a><br></td>
      </tr>
    </tbody>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
             <div class="modal-body">
              <span>Proof of Transaction: <br> <img src="../back_end/receipt/<?php echo $rows['image']?>"></span><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    }else{
    ?>
    <h3>No Pending Request Yet</h3>
    <?php
      }}
   ?>
   </div>
</div>
<script src="../js/bootstrap.js"></script>
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
      room_types.price, transactions.payment_method, transactions.bank, transactions.guest, transactions.check_in,
      transactions.check_out, transactions.status
      FROM rooms
      JOIN users
      LEFT JOIN room_types ON rooms.room_type_id = room_types.id
      LEFT JOIN packages ON room_types.package_id = packages.id
      LEFT JOIN transactions ON transactions.room_id = rooms.id
      WHERE users.id = '$user_id' AND rooms.id = '$room_id' AND transactions.status = 'pending'";
      $query = mysqli_query($conn, $sql);
      if(mysqli_num_rows($query) > 0){
      $rows = mysqli_fetch_array($query);
      $first_name = ucwords($rows['first_name']);
      $last_name = ucwords($rows['last_name']);
      $full_name = "".$first_name." ".$last_name."";
      $date_in = date('Y-m-d', strtotime($rows['check_in']));
      $time_in = date('h:i A', strtotime($rows['check_in']));
      $date_out = date('Y-m-d', strtotime($rows['check_out']));
      $time_out = date('h:i A', strtotime($rows['check_out']));
      $mobile_number = $rows['mobile_number'];
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

      $update_status = "UPDATE transactions SET `status` = '$status' WHERE users_id = '$user_id' AND room_id = '$room_id'";
      $query_change = mysqli_query($conn, $update_status) && sendPDF($send_pdf, $email, $full_name, $account_id);
      if($query_change){
        $messagebird = new MessageBird\Client('okQatVAkP79a8QPdkQaUcuoig');
        $message = new MessageBird\Objects\Message;
        $message->originator = '+639156915704';
        $message->recipients = $mobile_number;
        $message->body = "Dear Mr/Mrs: $last_name, we would like you to inform your reservation from ProCreations is from $date_in $time_in to $date_out $time_out. Please check your email to inbox/spam, thank you.";
        $response = $messagebird->messages->create($message);
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
