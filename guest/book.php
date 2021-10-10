<?php
include "../connection.php";

if(isset($_GET['b']) && isset($_GET['id'])){
  $room_id = $_GET['id'];
  if(empty($room_id)){
    header("Location:index.php");
  }
}else{
  header("Location:index.php");
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
           $mail->Password   = '62409176059359';                               //SMTP password
           $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
           $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
       
           //Recipients
           $mail->setFrom('cmdyzxcvbnm123@gmail.com', 'ProCreation');
           $mail->addAddress($email);     //Add a recipient
           
           //Content
           $mail->isHTML(true);                                  //Set email format to HTML
           //modified code for guest
          
           $mail->Subject = 'Email Verification from ProCreation Hotel';
           $mail->Body    = "Good Day $last_name!<br><p>Your Email Verification is: <b style=font-size: 30px;> $vcode </b></p>";
          
       
           $mail->send();
           return true;
       } catch (Exception $e) {
           return false;
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

  <h2>Fill up form</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="first_name" placeholder="First name"><br>
    <input type="text" name="last_name" placeholder="Last name"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="number" name="mobile_number" placeholder="Mobile #"><br>
    <input type="number" name="guest" placeholder="No. of guest"><br>
    <select name="id_type" id="">
            <option value="">-Select ID-</option>
            <option value="1">SSS</option>
            <option value="2">UMID</option>
            <option value="3">Driver`s License</option>
            <option value="4">Professional ID</option>
        </select><br>
    <input type="number" name="id_number" placeholder="ID Number"><br>
    <input type="file" name="id_image" id="id_image"><br>
    <h3>Check in</h3>
    <input type="date" name="check_in">
    <input type="time" name="time_in"><br>
    <h3>Check out</h3>
    <input type="date" name="check_out">
    <input type="time" name="time_out"><br><br>
    <a href="index.php">Back</a>
    <button type="submit" name="request_book">Next</button>
    </form>
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
    <h2>Room Info</h2>
    <img src="../Photos/hotel_rooms/<?php echo $rows['image']?>">
    <p>Room Number: <?php echo $rows['room_number']?></p>
    <p>Room Type: <?php echo ucwords($rows['name_of_room'])?></p>
    <p>Price: <?php echo $rows['price']?></p>
    <p>Package: <?php echo $rows['room_number']?></p>
    <p>Room Number: <?php echo $rows['room_number']?></p>
    
    <?php
    }
    ?>
</body>
</html>

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
  $check_out = $_POST['check_out'];
  $time_out = $_POST['time_out'];
  
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

  $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
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
      WHERE users.email = '$email'";
      $query_user_book = mysqli_query($conn, $check_user_book);
      if(mysqli_num_rows($query_user_book) == 1){
        echo "<script>swal({
          title: 'Oops invalid request!',
          text: 'Select your time-out',
          icon: 'warning',
          }).then(function() {
          // Redirect the user
          window.location.href='index.php';
          });</script>";
          exit();
      }else{

        $validate_user = "SELECT * FROM users WHERE email = '$email'";
        $query_validate = mysqli_query($conn, $validate_user);

        if(mysqli_num_rows($query_validate) == 1){

          $update_vcode = "UPDATE users SET `v_code` = '$vcode' WHERE email = '$email'";
          $query_update = mysqli_query($conn, $update_vcode) && sendMail($last_name,$email,$vcode);
          echo "galing";

        }else{
         
          $sql = "INSERT INTO users (account_id, first_name, last_name, email, email_status, v_code, mobile_number, added_on) VALUES ('$account_id', '$first_name', '$last_name', '$email', '$default_email_status', '$vcode', '$mobile_number', '$added_on')";
          $query = mysqli_query ($conn,$sql) ;

          if($query){
            $insert_id_fk = $conn->insert_id;
            $query_fk = "INSERT INTO id_info (id_type,number,image,users_id,added_on)
            VALUES('$id_type', '$id_number', '$id_image','$insert_id_fk', '$added_on')";
            move_uploaded_file($_FILES["id_image"]["tmp_name"], "../back_end/clients_image/" . $id_image);
            $run_fk = mysqli_query($conn,$query_fk) && sendMail($last_name,$email,$vcode);
            echo "putangina";
            }else{

            echo "error" . $conn->error;
          }
        }
      }
    }
  }
?>