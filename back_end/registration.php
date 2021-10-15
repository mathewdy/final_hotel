<?php
session_start();
include ('../connection.php');
include ('../guest/includes/header.php');
?>


    
    <?php    
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
            $mail->Username   = 'cmdyzxcvbnm123@gmail.com';                     //SMTP username
            $mail->Password   = 'mathewpogi123';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('cmdyzxcvbnm@gmail.com', 'Hotel ProCreations');
            $mail->addAddress($email);     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification from ProCreations';
            $mail->Body    = "Thanks for registration ! Hello $email welcome to Our Hotel
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
<div class="container-fluid pt-5">
    <div class="container p-5 pt-5 bg-light" style="display:grid; place-items:center;">
    <p class="display-3 text-muted">Registration</p>
    <form action="registration.php" method="POST" enctype="multipart/form-data">
        <label for="">First Name</label>
        <input class="form-control" type="text" name="first_name" > <br>
        <label for="">Last Name</label>
        <input class="form-control" type="text" name="last_name"> <br>
        <label for="">Email</label>
        <input class="form-control"type="email" name="email"> <br>
        <label for="">Mobile Number</label>
        <input  class="form-control"type="text" name="mobile_number"> <br>
        <label for="">Select Id:</label>
        <select class="form-select" name="id_type" id=""> 
            <option value="">-Select Id-</option>
            <option value="1">SSS</option>
            <option value="2">UMID</option>
            <option value="3">Driver's License </option>
            <option value="4">Professional ID Card</option>
        </select> <br>
        <label for="">Id Picture</label>
        <input class="form-control" type="file" name="id_image" id=""> <br>
        <label for="">ID Number</label>
        <input class="form-control"type="text" name="id_number"> <br>
        <span class="d-flex justify-content-between">
            <input class="btn btn-dark" type="submit" name="register" value="Register">
            <a class="btn btn-light" href="../guest/index.php">Log In</a>
        </span>
       
    </form>
    </div>
</div>

<?php
include "../guest/includes/footer.php";
?>

<?php

if(isset($_POST['register'])){
    
   
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];

   

    $id_number = $_POST['id_number'];

 

    $vcode = md5(rand('00000' , '99959' ));

    $id_type = $_POST['id_type'];

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

    if(empty($_POST['first_name']) && empty($_POST['last_name']) && empty($_POST['email']) && empty($_POST['mobile_number'])
    && empty($_POST['id_type']) && empty ($_POST['id_number']) && empty($_POST['id_image'])){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Please fill up the form',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(empty($_POST['first_name'])){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your first name',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(empty($_POST['last_name'])){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your last name',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(empty($_POST['email'])){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your email',
        icon: 'warning',
        }).then(function() {
         // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(empty($_POST['mobile_number'])){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your mobile number',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(empty($_POST['id_type'])){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Choose ID Type',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(empty($_POST['id_number'])){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your ID Number',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(empty($id_image)){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Attached your ID Image',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else if(!in_array($file_extension, $allowed_extension)){
    echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Invalid image format',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='registration.php';
        });</script>";
    }else{
    $validate = "SELECT * FROM users WHERE email='$email' AND account='$account_id'";
    $run_validate = mysqli_query($conn,$validate);
    if($run_validate){
        if(mysqli_num_rows($run_validate) > 0){
            echo  "<script>alert('Email already used') </script>";
          exit();
        }
    }
  
    $validate_id = "SELECT * FROM id_info WHERE number='$id_number'";
    $run_validate_id = mysqli_query($conn,$validate_id);
    if(mysqli_num_rows($run_validate_id) > 0){
        echo "<script>alert('Id already used') </script>";
        exit();
    }


    $query_insert = "INSERT INTO users (account_id,first_name,last_name,email,email_status,v_code,mobile_number,added_on)
    VALUES ('$account_id','$first_name', '$last_name', '$email',$email_status,'$vcode', '$mobile_number', '$added_on')";
    $run_insert = mysqli_query ($conn,$query_insert);

    if($run_insert){
        $insert_id_fk = $conn->insert_id;
        $query_fk = "INSERT INTO id_info (id_type,number,image,users_id,added_on)
        VALUES('$id_type', '$id_number', '$id_image','$insert_id_fk', '$added_on')";
        move_uploaded_file($_FILES["id_image"]["tmp_name"], "clients_image/" . $_FILES["id_image"] ["name"]);
        $run_fk = mysqli_query($conn,$query_fk) && sendMail($email,$vcode,$account_id);

        if($run_fk){
            echo "<script>alert('Registration Successful') </script>";
        }else{
            echo "error" . $conn->error;
        }
    }
}
}
?>
