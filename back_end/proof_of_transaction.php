<?php

//di pa to tapos , paki ayos ung oras ng check_in at check_out

include('../connection.php');
include('./includes/header.php');
if(empty($_SESSION['email'])){
    echo "<script>window.location.href='../guest/index.php' </script>";
  }

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
    
    
    <form action="#" method=POST enctype="multipart/form-data">
    <div class="container-lg p-lg-5 mt-lg-3  d-flex align-items-center justify-content-center ">
        <div class="shadow p-3 mb-5 bg-body rounded">
        <h2>Bank Partners</h2>
                <div class="row d-flex align-items-center justify-content-center">

                    
                
                        
                    <div class="col-md-7 position-relative">
                        <div class="shadow-sm p-3 mb-5 bg-body rounded">
                            <label for="exampleDataList" class="form-label">Search fucking bank</label>
                                <input class="form-control" list="datalistOptions" id="exampleDataList" name="bank" placeholder="Select Bank">
                                    <datalist id="datalistOptions">
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
                                    </datalist>
                                </div>

                    </div>

                    <div class="col-md-7 position-relative box">
                        <div class="shadow-sm p-3 mb-5 bg-body rounded">
                    
                            <div class="col-md-12">
                            <label for="formFile" class="form-label">Upload Image </label>
                            <input class="form-control" type="file" id="formFile" name="image_transaction">
                            </div>
                            </div>
                        </div>


                        <div class="col-md-10 position-relative">
                    
                            <div class="col-md-12  align-items-center" style="padding-top: 10%; padding-left: 60%; " >
                                
                                <input type="submit" name="payment" class="btn btn-primary" value="Pay">
                                <a type="button" href="home.php" class="btn btn-danger">Cancel</a>
                        
                               
                            </div>

                            
                        </div>
                        

                        </div>
                   
                        </div>
                        
                        </div>  
        

       

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

    $date_time_check_in = "".$check_in." ".$time_check_in."";
    $date_time_check_out = "".$check_out." ".$time_check_out."";

    $number_of_guests = $_POST['number_of_guests'];
    $name_of_room = $_POST['name_of_room'];
    $room_number = $_POST['room_number'];
    //room status ito
    $status = "pending";
    $price = $_POST['price'];
    $description = $_POST['description'];
    $name_package = $_POST['name_package'];

    $bank = $_POST['bank'];
    //transaction status
    $transaction_status = "pending";

    $payment_method = "bank";

    $image_transaction = $_FILES['image_transaction']['name'];
    $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
    $filename = $_FILES ['image_transaction']['name'];
    $file_extension = pathinfo($filename , PATHINFO_EXTENSION);

    $added_on = date("Y-m-d H:i:s");

    $query_insert = "INSERT INTO transactions (room_id,users_id,guest,check_in,check_out,added_on,status,payment_method,image,bank)
    VALUES ('$room_id','$id' , '$number_of_guests','$date_time_check_in','$date_time_check_out', '$added_on','$status', '$payment_method','$image_transaction','$bank')";    
    $run_insert = mysqli_query($conn,$query_insert);
    move_uploaded_file($_FILES["image_transaction"]["tmp_name"], "receipt/" . $_FILES["image_transaction"] ["name"]);

    if($run_insert){
        echo "<script>alert('Your Transaction Sent, please wait for confirmation on Email Thank you ') </script>";
        echo "<script>window.location.href='home.php' </script>";
    }else{
        echo "error". $conn->error;
    }

}

?>