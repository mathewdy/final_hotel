<?php

session_start();
include('../connection.php');

if(empty($_SESSION['email'])){
    echo "<script> window.location.href='index.php'</script>";
}

if(isset($_POST['review_details'])){
    $id = $_POST['id'];
    $account_id = $_POST['account_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile_number = $_POST['mobile_number'];

    $room_id = $_POST['room_id'];
    $check_in = date('Y-m-d', strtotime($_POST['check_in']));
    $check_out = date('Y-m-d' , strtotime($_POST['check_out']));

    $time_check_in = $_POST['time_check_in'];
    $time_check_out = $_POST['time_check_out'];

    $number_of_guests = $_POST['number_of_guest'];
    $name_of_room = $_POST['name_of_room'];
    $room_number = $_POST['room_number'];
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
    <link rel="stylesheet" href="./css/global-style.css"/>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-xxl">
                <a class="navbar-brand" href="home.php">
                ProCreation Hotel
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active" aria-current="page" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg> Home</a>
                        <a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                            <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                        </svg> Rooms</a>
                        <a class="nav-link" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg> Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    
<div class="container mt-5">
    <h3>Review Details</h3>
    <form action="paypal.php" method="POST">
    
    
<!---info user-->
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="account_id" value="<?php echo $account_id ?>">
    <input type="hidden" name="email" value="<?php echo $email?>">
    <input type="hidden" name="first_name" value="<?php echo $first_name?>">
    <input type="hidden" name="last_name" value="<?php echo $last_name?>">
    <input type="hidden" name="mobile_number" value="<?php echo $mobile_number?>">
    <input type="hidden" name="room_id" value="<?php echo $room_id?>">

    <div class="row">
        <div class="col-md-4">
            <label for="">Date of Check In</label>
            <input class="form-control" type="text" name="check_in" value="<?php echo $check_in?>" readonly>
            <input type="text" name="time_check_in" value="<?php echo $time_check_in?>" readonly>
        </div>
        <div class="col-md-4">
            <label for="">Date of Check Out</label>
            <input class="form-control" type="text" name="check_out" value="<?php echo $check_out?>"  readonly> 
            <input type="text" name="time_check_out" value="<?php echo $time_check_out?>" readonly> 
        </div>
        <div class="col-md-4">
            <label for="">Number of Guests</label>
            <input class="form-control" type="text" name="number_of_guest" value="<?php echo $number_of_guests?>" readonly>
        </div>
        <div class="col-md-6">
            <label for="">Name of Room</label>
            <input class="form-control" type="text" name="name_of_room" value="<?php echo $name_of_room?>"  readonly>
        </div>
        <div class="col-md-6">
            <label for="">Room Number</label>
            <input class="form-control" type="text" name="room_number" value="<?php echo $room_number?>"  readonly>
            <input type="hidden" name="status" value="<?php echo $status?>" >
        </div>
        <div class="col-md-6">
            <label for="">Package Details</label>
            <input class="form-control" type="text" name="name_package" value="<?php echo $name_package?>"readonly >
        </div>
        <div class="col-md-6">
            <label for="">Price</label>
            <input class="form-control" type="text" name="price" value="<?php echo $price?>"  readonly>
        </div>
        <div class="col-md-12">
            <label for="">Description</label>
            <input class="form-control" type="text" name="description" value="<?php echo $description?>" readonly>
        </div>
        <div class="col-md-12 py-lg-4">
            <input class="btn btn-primary" type="submit" name="paypal" value="Paypal Payment">
            <a class="btn btn-light" href="home.php">Cancel</a>
        </div>
</div>
</form>


<!-----di pa to sure-- at di pa to tapos--->
<form action="proof_of_transaction.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="account_id" value="<?php echo $account_id ?>">
    <input type="hidden" name="email" value="<?php echo $email?>">
    <input type="hidden" name="first_name" value="<?php echo $first_name?>">
    <input type="hidden" name="last_name" value="<?php echo $last_name?>">
    <input type="hidden" name="mobile_number" value="<?php echo $mobile_number?>">
    <input type="hidden" name="room_id" value="<?php echo $room_id?>">

    <input class="form-control" type="hidden" name="check_in" value="<?php echo $check_in?>" readonly>
    <input type="hidden" name="time_check_in" value="<?php echo $time_check_in?>" readonly>
    <input class="form-control" type="hidden" name="check_out" value="<?php echo $check_out?>"  readonly> 
    <input type="hidden" name="time_check_out" value="<?php echo $time_check_out?>" readonly> 
    <input class="form-control" type="hidden" name="number_of_guest" value="<?php echo $number_of_guests?>" readonly>
    <input class="form-control" type="hidden" name="name_of_room" value="<?php echo $name_of_room?>"  readonly>
    <input class="form-control" type="hidden" name="room_number" value="<?php echo $room_number?>"  readonly>
    <input type="hidden" name="status" value="<?php echo $status?>" >
    <input class="form-control" type="hidden" name="name_package" value="<?php echo $name_package?>"readonly >
    <input class="form-control" type="hidden" name="price" value="<?php echo $price?>"  readonly>
    <input class="form-control" type="hidden" name="description" value="<?php echo $description?>" readonly>
    <input type="submit" name="proof_of_transaction" value="Proof of transaction">
</form>

<?php



?>


</div>
</body>
</html>
