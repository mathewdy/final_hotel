<?php
ob_start();

include "email_status.php";
include "../connection.php";
include "./includes/header.php";

if(isset($_GET['b']) && isset($_GET['id'])){
  $room_id = $_GET['id'];
  if(empty($room_id)){
    header("Location:index.php");
  }
}else{
  header("Location:index.php");
}
//sample
?>

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
<div class="container d-flex">


<div class="container mt=0 pt-0">
  <p class="display-3 lead text-muted pt-0 mt-0">Fill up Form</p>
  <hr class="featurette-divider">
  <form action="" method="POST" enctype="multipart/form-data">
    <input class="form-control" type="text" name="first_name" placeholder="First name"><br>
    <input class="form-control" type="text" name="last_name" placeholder="Last name"><br>
    <input class="form-control" type="email" name="email" placeholder="Email"><br>
    <input class="form-control" type="number" name="mobile_number" placeholder="Mobile #"><br>
    <input class="form-control" type="number" name="guest" placeholder="No. of guest"><br>
    <select class="form-select" name="id_type" id="">
            <option value="">-Select ID-</option>
            <option value="1">SSS</option>
            <option value="2">UMID</option>
            <option value="3">Driver`s License</option>
            <option value="4">Professional ID</option>
        </select><br>
    <input class="form-control" type="number" name="id_number" placeholder="ID Number"><br>
    <input class="form-control" type="file" name="id_image" id="id_image"><br>
    <p class="lead text-muted mb-0">Check in</p>
    <span class="hstack">
      <input class="form-control" type="date" name="check_in">
      <input class="form-control" type="time" name="time_in"><br>
    </span>
    <p class="lead text-muted mb-0">Check out</p>
    <span class="hstack">
      <input class="form-control" type="date" name="check_out">
      <input class="form-control" type="time" name="time_out"><br><br>
    </span>
    <span class="d-flex justify-content-between">
      <a class="btn btn-light" href="index.php">Back</a>
      <button class="btn btn-primary" type="submit" name="request_book">Next</button>
    </span>
   
    </form>
</div>
<div class="container">


    <?php 
    $display_room = "SELECT rooms.id,rooms.room_number, room_types.name_of_room, room_types.price, room_types.image, packages.name_package, packages.description
    FROM rooms 
    LEFT JOIN room_types ON rooms.room_type_id = room_types.id
    LEFT JOIN packages ON room_types.package_id = packages.id
    WHERE rooms.id = $room_id";
    $query_room = mysqli_query($conn, $display_room);
    if(mysqli_num_rows($query_room) > 0){
      $rows = mysqli_fetch_array($query_room);
    ?>
      <div class="accordion" id="accordionExample">
      <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion" aria-expanded="true" aria-controls="collapseOne">
      ROOM INFORMATION
      </button>
      </h2>
      <div id="accordion" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      
      <div class="accordion-body">
    
      <div class="row">

      <div class="col-lg-12 pb-0">

      <img src="<?php echo "../Photos/hotel_rooms/" . $rows ['image']?>" height="250" width="100%" alt="image">
      </div>
      <div class="col-lg-12">

      <span class="d-flex">
      <p class="lead p-0 m-0">Room Type:</p>
      <input type="hidden" name="room_id" value="<?php echo $row ['id']?>">     
      <p class="lead p-0 px-sm-1 m-0"><?php echo $rows ['name_of_room']?></p>
      </span>

      <span class="d-flex">
      <p class="lead p-0 m-0">Room Number: </p>
      <p class="lead p-0 px-sm-1 m-0"> <?php echo $rows ['room_number']?></p>
      </span>

      <span class="d-flex">
      <p class="lead p-0 m-0">Price: </p>
      <p class="lead p-0 px-sm-1 m-0"><?php echo $rows ['price']?></p>
      </span>

      <span class="d-flex">
      <p class="lead p-0 m-0">Package: </p>
      <p class="lead p-0 px-sm-1 m-0"> <?php echo $rows ['name_package']?></p>
      </span>

      </div>
      </div>
      </div>
      </div>
      <div class="accordion-footer p-2 px-3 position-relative">
      <p class="lead m-0">Inclusions:</p>
      <p class="lead m-0"><?php echo $rows ['description']?></p>
      </div>
      </div>
      </div>
      </div>
    <?php
    }
    ?>
</div>

<?php
include "./includes/footer.php";
?>

<?php 
if(isset($_POST['request_book'])){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $mobile_number = $_POST['mobile_number'];
  $guest = $_POST['guest'];
  $id_type = $_POST['id_type'];
  $id_number = $_POST['id_number'];
  $id_image = $_FILES['id_image']['name'];
  $check_in = $_POST['check_in'];
  $time_in = $_POST['time_in'];
  $time_in = date("H:i:s", strtotime($time_in));
  $check_out = $_POST['check_out'];
  $time_out = $_POST['time_out'];
  $time_out = date("H:i:s", strtotime($time_out));
  
  $time_in_format = "".$check_in." ".$time_in."";
  $time_out_format = "".$check_out." ".$time_out."";
  
  date_default_timezone_set('Asia/Manila');
  $added_on = date('Y-m-d H:i:s');

  $date = date("ymd");
  $rand_no = rand('000', '999');

  // verification code
  $vcode = "".$date."".$rand_no."";

  
  $select_count = "SELECT * FROM users";
  $query = mysqli_query($conn, $select_count);
  $count = mysqli_num_rows($query);

  // account id
  $acc_id = rand('00', '99');
  $account_id = "".$acc_id."".$date."".$count."";


  $default_email_status = 0;

  $allowed_extension = array('png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG');
  $filename = $id_image;
  $file_extension = pathinfo($filename , PATHINFO_EXTENSION);
  
   if(empty($_POST['first_name']) && empty($_POST['last_name']) && empty($_POST['email']) && empty($_POST['mobile_number'])
   && empty($_POST['guest']) && empty($_POST['id_type']) && empty ($_POST['id_number']) && empty($_POST['id_image'])
   && empty($_POST['check_in']) && empty($_POST['time_in']) && empty($_POST['check_out']) && empty($_POST['time_out'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Please fill up the form',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['first_name'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your first name',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['last_name'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your last name',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['email'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your email',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['mobile_number'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your mobile number',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['guest'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input how many guest',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['id_type'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Choose ID Type',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['id_number'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Input your ID Number',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($id_image)){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Attached your ID Image',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(!in_array($file_extension, $allowed_extension)){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Invalid image format',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['check_in'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Select your check in date',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['time_in'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Select your time-in',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['check_out'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Select your check out date',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else if(empty($_POST['time_out'])){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Select your time-out',
        icon: 'warning',
        }).then(function() {
        // Redirect the user
        window.location.href='book.php?b&id=$room_id';
        });</script>";
    }else{
      $check_user_book = "SELECT users.id FROM transactions
      LEFT JOIN users ON transactions.users_id = users.id
      WHERE users.email = '$email' AND users.first_name = '$first_name' AND users.last_name = '$last_name' AND users.mobile_number = '$mobile_number'";
      $query_user_book = mysqli_query($conn, $check_user_book);
      if(mysqli_num_rows($query_user_book) == 1){
        echo "<script>swal({
          title: 'Oops invalid request!',
          text: 'You already have requested room',
          icon: 'warning',
          }).then(function() {
          // Redirect the user
          window.location.href='book.php?b&id=$room_id';
          });</script>";
      }else{

        $validate_user = "SELECT * FROM users WHERE email = '$email'";
        $query_validate = mysqli_query($conn, $validate_user);

        if(mysqli_num_rows($query_validate) == 1){
          $rows = mysqli_fetch_array($query_validate);
          $update_vcode = "UPDATE users SET `v_code` = '$vcode' WHERE email = '$email'";
          $query_update = mysqli_query($conn, $update_vcode) && sendMail($last_name,$email,$vcode);
          if($query_update){
            header("Location:otp.php?id=$room_id&uid=".$rows['id']."&g=$guest&in=$time_in_format&out=$time_out_format");
          }else{
            echo "<script>swal({
              title: 'Oops invalid request!',
              text: 'Something went wrong',
              icon: 'warning',
              }).then(function() {
              // Redirect the user
              window.location.href='book.php?b&id=$room_id';
              });</script>";
          }
        }else{
         
          $sql = "INSERT INTO users (account_id, first_name, last_name, email, email_status, v_code, mobile_number, added_on) VALUES ('$account_id', '$first_name', '$last_name', '$email', '$default_email_status', '$vcode', '$mobile_number', '$added_on')";
          $query = mysqli_query ($conn,$sql) ;

          if($query){
            $insert_id_fk = $conn->insert_id;
            $query_fk = "INSERT INTO id_info (id_type,number,image,users_id,added_on)
            VALUES('$id_type', '$id_number', '$id_image','$insert_id_fk', '$added_on')";
            move_uploaded_file($_FILES["id_image"]["tmp_name"], "../back_end/clients_image/" . $id_image);
            $run_fk = mysqli_query($conn,$query_fk) && sendMail($last_name,$email,$vcode);
            if($run_fk){
              header("Location:otp.php?id=$room_id&uid=$insert_id_fk&g=$guest&in=$time_in_format&out=$time_out_format");
            }else{
              echo "<script>swal({
                title: 'Oops invalid request!',
                text: 'Something went wrong',
                icon: 'warning',
                }).then(function() {
                // Redirect the user
                window.location.href='book.php?b&id=$room_id';
                });</script>";
            }
            }else{

            echo "error" . $conn->error;
          }
        }
      }
    }
  }
?>