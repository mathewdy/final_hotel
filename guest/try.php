<?php
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php    
    //gumamit ako ng php mailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    // nilagay ko dito yung mga info ng user, email, verification code , at account id nya
    // mag sesend ito sa email nya
    function sendMail($email){
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
            $mail->setFrom('cmdyzxcvbnm@gmail.com', 'ProCreations');
            $mail->addAddress($email);     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification from ProCreations';
            $mail->Body    = "Penge Fried Rice pati Iced Coffee" ;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
        
    }

    $error = NULL;

   
    ?>
  Try email send
  <form action="" method="POST">
  <input type="email" name="email">
  <button type="submit" name="send_email">Send</button>
  </form>
  <div id="paypal-payment-button"></div>

 
</body>
</html>
<?php
  if(isset($_POST['send_email'])){
    $email = $_POST['email'];
    sendMail($email);
  }
?>