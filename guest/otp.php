<?php
ob_start();
include "email_status.php";
include "../connection.php";

if(isset($_GET['id']) && isset($_GET['uid']) && isset($_GET['g']) && isset($_GET['in']) && isset($_GET['out'])){
  $room_id = $_GET['id'];
  $user_id = $_GET['uid'];
  $guest = $_GET['g'];
  $check_in = $_GET['in'];
  $check_out = $_GET['out'];
  if(empty($room_id) && empty($user_id) && empty($guest) && empty($check_in) && $check_out){
    header("Location:index.php");
    exit();
  }else{
    $check_account = "SELECT id FROM users WHERE id = '$user_id'";
    $query_check = mysqli_query($conn, $check_account);
    if(mysqli_num_rows($query_check) == 0){
      header("location:index.php");
      exit();
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

function sendMail($last_name,$email,$vcode){
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
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        //modified code for guest
       
        $mail->Subject = 'Email Verification from ProCreation Hotel';
        $mail->Body    = "Good Day $last_name!<br><p>Your Email Verification is <b style=font-size: 30px;> $vcode </b></p>";
       
    
        $mail->send();
        return true;
    }  catch (Exception $e) {
     echo $e->errorMessage(); //Pretty error messages from PHPMailer
   } catch (Exception $e) {
     echo $e->getMessage(); //Boring error messages from anything else!
   }
    
}

echo NULL;
?> 
    <a href="index.php">Home</a>
    <a href="rooms.php">Rooms</a>
    <a href="economy.php">Economy</a>
    <a href="deluxe.php">Deluxe</a>
    <a href="executive.php">Executive</a>
    <a href="">Sign in</a>
 <h2>OTP CODE</h2>
 <p>We sent a verification code in your email</p>
 <form action="" method="POST">
 <input type="number" name="otp_number">
 <button type="submit" name="check_otp">Submit</button>
 <button type="submit" name="resend_code">Resend Code</button>
 </form>
</body>
</html>
<?php
  if(isset($_POST['check_otp'])){
    $otp_number = $_POST['otp_number'];

    if(empty($_POST['otp_number'])){
      echo "<script>swal({
        title: 'Oops!',
        text: 'Input your code',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='otp.php?id=$room_id&uid=$user_id&g=$guest&in=$check_in&out=$check_out';
        });</script>";
    }else{
      $sql = "SELECT * FROM users WHERE id = '$user_id'";
      $query = mysqli_query($conn, $sql);
      if(mysqli_num_rows($query) > 0 ){
        $rows = mysqli_fetch_array($query);
        if($otp_number == $rows['v_code']){
          $update_code = "UPDATE users SET `v_code` = 0, `email_status` = 1 WHERE id = '$user_id'";
          $query_update = mysqli_query($conn, $update_code);
          if($query_update){
            header("Location:details.php?id=$room_id&uid=$user_id&g=$guest&in=$check_in&out=$check_out");
            exit();
          }else{
            echo "error" . $conn->error;
          }
          }else{
          echo "<script>swal({
            title: 'Oops!',
            text: 'Invalid code, try again',
            icon: 'warning',
            }).then(function() {
            // Redirect the user
            window.location.href='otp.php?id=$room_id&uid=$user_id&g=$guest&in=$check_in&out=$check_out';
            });</script>";
        }
      }
    }
  }
?>
<?php 
  if(isset($_POST['resend_code'])){
    
    date_default_timezone_set('Asia/Manila');
    $date = date("ymd");
    $rand_no = rand('000', '999');

    // verification code
    $vcode = "".$date."".$rand_no."";

    $get_email = "SELECT * FROM users WHERE id = '$user_id'";
    $query_email = mysqli_query($conn, $get_email);
    if(mysqli_num_rows($query_email) > 0){
    $rows = mysqli_fetch_array($query_email);
    $last_name = $rows['last_name'];
    $email = $rows['email'];
    $sql = "UPDATE users SET `v_code` = '$vcode' WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sql) && sendMail($last_name,$email,$vcode);
    if($query){
      header("Location:otp.php?id=$room_id&uid=$user_id&g=$guest&in=$check_in&out=$check_out");
      exit();
    }else{
      echo "<script>swal({
        title: 'Oops!',
        text: 'Something went wrong',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='otp.php?id=$room_id&uid=$user_id&g=$guest&in=$check_in&out=$check_out';
        });</script>";
    }
  }
}
?>
