
<?php


include('../connection.php');
include('./includes/header.php');

$user_id = $_SESSION['id'];


if(empty($_SESSION['email'])){
    echo "<script> window.location.href='../guest/index.php'</script>";
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

    $time_in = date('h:i A', strtotime($_POST['time_check_in']));
    $time_out = date('h:i A', strtotime($_POST['time_check_out']));

    $time_check_in = $_POST['time_check_in'];
    $time_check_out = $_POST['time_check_out'];

    $number_of_guests = $_POST['number_of_guest'];
    $name_of_room = $_POST['name_of_room'];
    $room_number = $_POST['room_number'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $name_package = $_POST['name_package'];


    $unable_to_book = "SELECT users_id FROM transactions WHERE  users_id='$user_id' ";
    $run_unable = mysqli_query($conn,$unable_to_book);

    if(mysqli_num_rows($run_unable) > 0){
        echo "<script>alert('You still have a current transaction') </script>";
        echo "<script>window.location.href='home.php' </script>";
        exit();
    }

}

?>
<div class="container mt-5">
    <p class="lead display-3 textmuted">Review Details</p>
    <hr class="featurette-divider">
    <form action="paypal.php" method="POST">
    
    
<!---info user-->
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="account_id" value="<?php echo $account_id ?>">
    <input type="hidden" name="email" value="<?php echo $email?>">
    <input type="hidden" name="first_name" value="<?php echo $first_name?>">
    <input type="hidden" name="last_name" value="<?php echo $last_name?>">
    <input type="hidden" name="mobile_number" value="<?php echo $mobile_number?>">
    <input type="hidden" name="room_id" value="<?php echo $room_id?>">
    <input type="hidden" name="time_check_in" value="<?php echo $time_check_in?>">
    <input type="hidden" name="time_check_out" value="<?php echo $time_check_out?>">
    <div class="container p-lg-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-5">
                    <h3 class="fw-thin">Check in :</h3>
                    <span class="hstack gap-0">
                        <input class="form-control-plaintext w-25" type="text" name="check_in" value="<?php echo $check_in?>" readonly>
                        <input class="form-control-plaintext w-25" type="text" name="time_check_in" value="<?php echo $time_in?>" readonly>
                    </span>
                </span>
            </div>
            <div class="col-lg-6 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-5">
                    <h3 class="fw-thin">Check out :</h3>
                <span class="hstack gap-0">
                    <input class="form-control-plaintext w-25" type="text" name="check_out" value="<?php echo $check_in?>" readonly>
                    <input class="form-control-plaintext w-25" type="text" name="time_check_out"  value="<?php echo $time_out?>" readonly>
                </span>
            </div>
            <div class="col-lg-4 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-5">
                    <h3 class="fw-thin">No. of Guests :</h3>
                    <input class="form-control-plaintext w-25" type="text" name="number_of_guest" value="<?php echo $number_of_guests?>" readonly>
                </span>
            </div>
            <div class="col-lg-4 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-5">
                    <h3 class="fw-thin">Room Type :</h3>
                    <input class="form-control-plaintext w-25" type="text" name="name_of_room" value="<?php echo $name_of_room?>"  readonly>
                </span>
            </div>
            <div class="col-lg-4 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-5">
                    <h3 class="fw-thin">Room Number :</h3>
                    <input class="form-control-plaintext w-25" type="text" name="room_number" value="<?php echo $room_number?>"  readonly>
                    <input type="hidden" name="status" value="<?php echo $status?>" >
                </span>
            </div>
            <div class="col-lg-6 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-5">
                    <h3 class="fw-thin">Package :</h3>
                    <input class="form-control-plaintext w-25" type="text" name="name_package" value="<?php echo $name_package?>"readonly >
                    </span>
            </div>
            <div class="col-lg-6 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-5">
                    <h3 class="fw-thin">Price :</h3>
                    <input class="form-control-plaintext w-25" type="text" name="price" value="<?php echo $price?>"  readonly>
                    </span>
            </div>
            <div class="col-lg-12 col-md-12 mb-4 border-bottom">
                <span class="hstack gap-2">
                    <h3 class="fw-thin w-50">Description :</h3>
                    <input class="form-control-plaintext" type="text" name="description" value="<?php echo $description?>" readonly>
                    </span>
            </div>
            
        </div>
    </div> 
    <hr class="featurette-divider">
    <input class="btn btn-primary" type="submit" name="paypal" value="Paypal Payment">
    <a class="btn btn-danger" href="home.php">Cancel</a>
    
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
    <input class="btn btn-light" type="submit" name="proof_of_transaction" value="Proof of transaction">
</form>

</div>
</div>

<?php
include('./includes/footer.php');
?>