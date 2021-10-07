<?php

//di pa to tapos
session_start();
include('../connection.php');

if(isset($_POST['proof_of_transaction'])){
    $id = $_POST['id'];
    $account_id = $_POST['account_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile_number = $_POST['mobile_number'];

    $room_id = $_POST['room_id'];
    $check_in = date('y-m-d', strtotime($_POST['check_in']));
    $check_out = date('y-m-d' , strtotime($_POST['check_out']));

    $time_check_in = $_POST['time_check_in'];
    $time_check_out = $_POST['time_check_out'];

    $number_of_guests = $_POST['number_of_guest'];
    $name_of_room = $_POST['name_of_room'];
    $room_number = $_POST['room_number'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $name_package = $_POST['name_package'];

}

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
    <a href="home.php">Cancel</a>
    <h3>Send a Proof of transaction</h3>
    <form action="#" method=POST enctype="multipart/form-data">

        <label for="">Upload Image</label>
        <input type="file" name="image_transaction"> <br>
        <label for="">Select Bank</label>
        <!---di pa to tapos--->
        <!---yung deposit slip dapat to -->
        <select name="bank" id="">
            <option value="">-Select-</option>
            <option value="BDO">BDO Unibank Inc.</option>
            <option value="Metro bank">Metropolitan Bank and Trust Company</option>
            <option value="BPI">Bank of the Philippine Islands</option>
            <option value="Land Bank">Land Bank of the Philippines</option>
            <option value="PNB">Philippine National Bank</option>
            <option value="Security Bank">Security Bank Corporation</option>
            <option value="China Bank">China Banking Corporation</option>
            <option value="DBP">Development Bank of the Philippines</option>
            <option value="Union Bank">Union Bank of the Philippines</option>
            <option value="Rizal Bank">Rizal Commercial Banking and Corporation</option>
        </select>

        <input type="hidden" name="id" value="<?php echo $id?>">
        <input type="hidden" name="account_id"  value="<?php echo $account_id?>" >
        <input type="hidden" name="email" value="<?php echo $email?>">
        <input type="hidden" name="first_name" value="<?php echo $first_name?>">
        <input type="hidden" name="last_name" value="<?php echo $last_name?>">
        <input type="hidden" name="mobile_number" value="<?php echo $mobile_number?>">
        <input type="hidden" name="room_id" value="<?php echo $room_id?>">
        <input type="hidden" name="check_in" value="<?php echo $check_in?>">
        <input type="hidden" name="check_out" value="<?php echo $check_out?>">
        <input type="hidden" name="time_check_in" value="<?php echo $time_check_in?>">
        <input type="hidden" name="time_check_out" value="<?php echo $time_check_out?>">
        <input type="hidden" name="number_of_guests" value="<?php echo $number_of_guests?>">
        <input type="hidden" name="name_of_room" value="<?php echo $name_of_room?>">
        <input type="hidden" name="status" value="<?php echo $status?>">
        <input type="hidden" name="price" value="<?php echo $price?>">
        <input type="hidden" name="description" value="<?php echo $description?>"> 
        <input type="hidden" name="name_package" value="<?php echo $name_package?>">
        <input type="hidden" name="room_number" value="<?php echo $room_number?>"> 
        <br>
       

        <input type="submit" name="payment" value="Pay">
    </form>

</body>
</html>

<?php

//di pa to taposssss!!

if(isset($_POST['payment'])){ 
    //user_id to   `
    
    $id = $_POST['id'];
    $account_id = $_POST['account_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile_number = $_POST['mobile_number'];

    $room_id = $_POST['room_id'];
    $check_in = date('y-m-d', strtotime($_POST['check_in']));
    $check_out = date('y-m-d' , strtotime($_POST['check_out']));

    $time_check_in = $_POST['time_check_in'];
    $time_check_out = $_POST['time_check_out'];

    $number_of_guests = $_POST['number_of_guests'];
    $name_of_room = $_POST['name_of_room'];
    $room_number = $_POST['room_number'];
    //room status ito
    $status = $_POST['status'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $name_package = $_POST['name_package'];

    $bank = $_POST['bank'];
    //transaction status
    $transaction_status = "pending";

    $image_transaction = $_FILES['image_transaction']['name'];
    $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
    $filename = $_FILES ['image_transaction']['name'];
    $file_extension = pathinfo($filename , PATHINFO_EXTENSION);

    $added_on = date("Y-m-d H:i:s");

    $query_insert = "INSERT INTO proof_of_transaction (user_id,image,bank,added_on,room_id,status)
    VALUES ('$id' , '$image_transaction','$bank', '$added_on','$room_id', '$transaction_status')";    
    $run_insert = mysqli_query($conn,$query_insert);
    move_uploaded_file($_FILES["image_transaction"]["tmp_name"], "receipt/" . $_FILES["image_transaction"] ["name"]);

    if($run_insert){
        echo "added receipt" . " your receipt is pending, wait for transaction ";

        //dapat mareredirect sa home page. 
        // pano kami gagawa ng notification kapag okay na? email? 
    }else{
        echo "error". $conn->error;
    }

}

?>