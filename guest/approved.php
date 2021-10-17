<?php
include "email_status.php";
include "../connection.php";

if(isset($_GET['id']) && isset($_GET['uid']) && isset($_GET['g']) && isset($_GET['in']) && isset($_GET['out']) && isset($_GET['mobile_number'])){
  $room_id = $_GET['id'];
  $user_id = $_GET['uid'];
  $guest = $_GET['g'];
  $check_in = $_GET['in'];
  $check_out = $_GET['out'];
  $mobile_number = $_GET['mobile_number'];

  $date_in = date("Y-m-d", strtotime($check_in));
  $time_in = date("h:i A", strtotime($check_in));
  
  $date_out = date("Y-m-d", strtotime($check_out));
  $time_out = date("h:i A", strtotime($check_out));

  date_default_timezone_set('Asia/Manila');
  $date = date("Y-m-d h:i:s A");
  $added_on = date("Y-m-d H:i:s");

  $payment_method = 'paypal';
  $status = 'reserved';

  $in = strtotime($check_in);
  $out = strtotime($check_out);
  
  if(empty($room_id) && empty($user_id) && empty($guest) && empty($check_in) && $check_out){
    header("Location:index.php");
  }else{
    $check_account = "SELECT id FROM users WHERE id = '$user_id'";
    $query_check = mysqli_query($conn, $check_account);
    if(mysqli_num_rows($query_check) == 0){
      echo "wala sa db";
    }
  }
}else{
  echo "error";
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
    require("PHPMailer.php");
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
        $mail->Subject = 'Book Receipt from ProCreation ';
        $mail->Body = "<span style=font-size:18px;letter-spacing:0.5px;color:black;>Good day <b>$full_name</b>!</span><br><span style=font-size:15px;letter-spacing:0.5px;color:black;>Below of this message is your receipt please print it out before entering in our hotel</span>";
    
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
    
}

$error = NULL;
?>
<?php 
 $sql = "SELECT * FROM users WHERE id = '$user_id'";
 $query = mysqli_query($conn, $sql);
 if(mysqli_num_rows($query) == 1){
   $rows = mysqli_fetch_array($query);
   $first_name = ucwords($rows['first_name']);
   $last_name = ucwords($rows['last_name']);
   $full_name = "".$first_name." ".$last_name."";
   $email = $rows['email'];

   $get_room_info = "SELECT rooms.id,rooms.room_number, room_types.name_of_room, room_types.price, packages.name_package, packages.description
   FROM rooms
   LEFT JOIN room_types ON rooms.room_type_id = room_types.id
   LEFT JOIN packages ON room_types.package_id = packages.id
   WHERE rooms.id = $room_id";
   $q_get_room = mysqli_query($conn, $get_room_info);
   $room_row = mysqli_fetch_array($q_get_room);
   
   $tax = 7.4;
   $difference = $out - $in;
   $price = $room_row['price'];
   $days = floor($difference/(60*60*24));
   $sub_total = $days * $price;
   $total = $sub_total + $tax;

   $insert_booking = "INSERT INTO transactions (`room_id`, `users_id`, `guest`, `check_in`, `check_out`, `added_on`, `status`, `payment_method`) VALUES ('$room_id', '$user_id', '$guest', '$check_in', '$check_out', '$added_on', '$status', '$payment_method')";
   $sql_booking = mysqli_query($conn, $insert_booking);

   if($sql_booking){
     require('../back_end/fpdf184/fpdf.php');
 // Format ng pag gawa ng pdf
 // Cell(width, height, 'text', border(boolean to 1 & 0 lang), new line,'text align')
 
     $pdf = new FPDF();
     $pdf->AddPage();
     $pdf->SetFont('Arial', '', 25);
     $pdf->Ln(2);
     $pdf->Cell(127, 5, 'ProCreation', 0, 0);
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
     $pdf->Cell(58, 5, ': '. ucwords($payment_method) , 0, 1);
     $pdf->Line(10, 32, 200, 32);
     $pdf->Ln(6);
     $pdf->SetFont('Arial', '', 18);
     $pdf->Cell(0, 15, 'Room Info', 0, 1);
     $pdf->SetFont('Arial', '', 12);
     $pdf->Line(10, 65, 200, 65);
     $pdf->Cell(55, 5, 'Room No.', 0, 0);
     $pdf->Cell(58, 5, ': '. $room_row['room_number'], 0, 1);
     $pdf->Cell(55, 5, 'Room Type', 0, 0);
     $pdf->Cell(58, 5, ': '. ucwords($room_row['name_of_room']), 0, 1);
     $pdf->Cell(55, 5, 'Package', 0, 0);
     $pdf->Cell(58, 5, ': '. ucwords($room_row['name_package']), 0, 1);
     $pdf->Cell(55, 5, 'Inclusive', 0, 0);
     $pdf->Cell(58, 5, ': '. $room_row['description'], 0, 1);
     $pdf->Line(10, 110, 200, 110);
     $pdf->Ln(10);
     $pdf->SetFont('Arial', '', 18);
     $pdf->Cell(0, 15, 'Book Info', 0, 1);
     $pdf->SetFont('Arial', '', 12);
     $pdf->Cell(55, 5, 'No. of Guest', 0, 0);
     $pdf->Cell(58, 5, ': '. $guest, 0, 1);
     $pdf->Cell(55, 5, 'Days of Stay', 0, 0);
     $pdf->Cell(58, 5, ': '. $days, 0, 1);
     $pdf->Cell(55, 5, 'Request Status', 0, 0);
     $pdf->Cell(58, 5, ': '. ucwords($status), 0, 1);
     $pdf->SetFont('Arial', '', 14);
     $pdf->Cell(55, 5, 'Check-in', 0, 1);
     $pdf->SetFont('Arial', '', 12);
     $pdf->Cell(55, 5, 'Date', 0, 0);
     $pdf->Cell(58, 5, ': '. $date_in, 0, 1);
     $pdf->Cell(55, 5, 'Time', 0, 0);
     $pdf->Cell(58, 5, ': '. $time_in, 0, 1);
     $pdf->SetFont('Arial', '', 14);
     $pdf->Cell(55, 5, 'Check-out', 0, 1);
     $pdf->SetFont('Arial', '', 12);
     $pdf->Cell(55, 5, 'Date', 0, 0);
     $pdf->Cell(58, 5, ': '. $date_out, 0, 1);
     $pdf->Cell(55, 5, 'Time', 0, 0);
     $pdf->Cell(58, 5, ': '. $time_out, 0, 1);
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
     sendPDF($send_pdf, $email, $full_name);
     echo '<script>swal({
      title: "Transaction Success!",
      text: "Check your email for your receipt",
      type: "success",
      }).then(function() {
      // Redirect the user
      window.location.href="index.php";
       });</script>';
   }else{
    echo '<script>swal({
      title: "Transaction Success!",
      text: "Something went wrong",
      type: "warning",
      }).then(function() {
      // Redirect the user
      window.location.href="index.php";
       });</script>';
   }
 }
?>
</body>
</html>