<?php

include ('../connection.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
</head>
<body>
    <h3>Registration</h3>
        
    <?php    
   session_start();
    include('../connection.php');
    //gumamit ako ng php mailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    // nilagay ko dito yung mga info ng user, email, verification code , at account id nya
    // mag sesend ito sa email nya
    function sendMail($email,$vcode,$account_id){
        require ("PHPMailer.php");
        require("SMTP.php");
        require("Exception.php");

        $mail = new PHPMailer(true);

        try {
            //Server settings
           
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'mathewmelendez123123@gmail.com';                     //SMTP username
            $mail->Password   = '62409176059359';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('mathewmelendez123123@gmail.com', 'Hotel ProCreations');
            $mail->addAddress($email);     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email verification code for ProCreations ';
            $mail->Body    = "Thanks for registration ! Hello $email welcome to our Hotel
            this is your account id '$account_id'
            Click the link to verify the email address. Thank you so much! ♥ 
            <a href='http://localhost/final_hotel/back_end/verify.php?email=$email&v_code=$vcode&account_id=$account_id'>Verify</a>' " ;
           
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
        
    }

    $error = NULL;

   
    ?>

    <form action="registration.php" method="POST" enctype="multipart/form-data">
        <label for="">First Name</label>
        <input type="text" name="first_name" > <br>
        <label for="">Last Name</label>
        <input type="text" name="last_name"> <br>
        <label for="">Email</label>
        <input type="email" name="email"> <br>
        <label for="">Mobile Number</label>
        <input type="text" name="mobile_number"> <br>
        <label for="">Select Id:</label>
        <select name="id_type" id=""> 
            <option value="">-Select Id-</option>
            <option value="1">SSS</option>
            <option value="2">UMID</option>
            <option value="3">Driver's License </option>
            <option value="4">Professional ID Card</option>
        </select> <br>
        <label for="">Id Picture</label>
        <input type="file" name="id_image" id=""> <br>
        <label for="">ID Number</label>
        <input type="text" name="id_number"> <br>
        
        <input type="submit" name="register" value="Register">
        <a href="login.php">Log In</a>
    </form>
</body>
</html>



<?php

if(isset($_POST['register'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];

    $vcode = md5(rand('00000' , '99959' ));

    $id_type = $_POST['id_type'];
    $id_number = $_POST['id_number'];

    $last_number = "SELECT * FROM users";
    $query_last_number = mysqli_query($conn, $last_number);
    $count = mysqli_num_rows($query_last_number);
    $rand_no = rand('00', '99');
    date_default_timezone_set('Asia/Manila');
    $date = date("ymd");
    $email_status = 0;
    $account_id = "".$rand_no."".$date."".$count."";
    $added_on = date("Y-m-d H:i:s");

    $id_image = $_FILES['id_image']['name'];

    $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
    $filename = $_FILES ['id_image']['name'];
    $file_extension = pathinfo($filename , PATHINFO_EXTENSION);

    $query_insert = "INSERT INTO users (account_id,first_name,last_name,email,email_status,v_code,mobile_number,added_on)
    VALUES ('$account_id','$first_name', '$last_name', '$email',$email_status,'$vcode', '$mobile_number', '$added_on')";
    $run_insert = mysqli_query ($conn,$query_insert) && sendMail($email,$vcode,$account_id);

    if($run_insert){
        echo "added user" . '<br>';
        $insert_id_fk = $conn->insert_id;
        $query_fk = "INSERT INTO id_info (id_type,number,image,users_id,added_on)
        VALUES('$id_type', '$id_number', '$id_image','$insert_id_fk', '$added_on')";
        move_uploaded_file($_FILES["id_image"]["tmp_name"], "clients_image/" . $_FILES["id_image"] ["name"]);
        $run_fk = mysqli_query($conn,$query_fk);

        if($run_fk){
            echo "added users";
        }else{
            echo "error" . $conn->error;
        }
    }
}

?>

