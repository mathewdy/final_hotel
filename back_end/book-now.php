<?php

//di pa to tapos

session_start();
include('../connection.php');
include('./includes/header.php');

if(isset($_GET['id'])){
    $room_number = $_GET['id'];
    
}
if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}


?>
    <?php

        $query_economy = "SELECT rooms.id , rooms.room_number,rooms.room_type_id, room_types.name_of_room, room_types.image , room_types.price,room_types.package_id, packages.name_package,packages.description
        FROM rooms
        LEFT JOIN room_types ON rooms.room_type_id = room_types.id
        LEFT JOIN packages ON room_types.package_id = packages.id 
        WHERE rooms.room_number = '$room_number' ORDER BY rooms.room_number ASC;";
        $run_economy = mysqli_query($conn,$query_economy);

        if(mysqli_num_rows($run_economy) > 0){
            foreach($run_economy as $row){
                ?>
<main>
<div class="container-lg p-lg-5 mt-lg-3 vh-100">
    <div class="row">
        <div class="col-lg-7">
            <form class="row g-3 needs-validation" action="review-details.php" method="POST" novalidate>
                <input type="hidden" name="id" value="<?php echo $_SESSION['id']?>" readonly>
                <input type="hidden" name="account_id" value="<?php echo $_SESSION['account_id']?>" readonly>
                    <div class="col-lg-6 position-relative">
                        <label for="validationTooltip01" class="form-label">First name</label>
                        <input type="text" name="first_name" value="<?php echo $_SESSION['first_name']?>" class="form-control" id="validationTooltip01" readonly>
                    </div>
                    <div class="col-lg-6 position-relative">
                        <label for="validationTooltip02" class="form-label">Last name</label>
                        <input type="text" name="last_name" value="<?php echo $_SESSION['last_name']?>" class="form-control" id="validationTooltip02" readonly>
                    </div>
                    <div class="col-lg-6 position-relative">
                        <label for="validationTooltipUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <input type="Email" name="email" value="<?php echo $_SESSION['email']?>" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" readonly>
                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                    </div>
                    <div class="col-lg-6 position-relative">
                        <label for="validationTooltip03" class="form-label">Contact Number</label>
                        <input type="text" name="mobile_number" value="<?php echo $_SESSION['mobile_number']?>" class="form-control" id="validationTooltip03" readonly>
                    </div>
                    <div class="col-lg-4 position-relative">
                        <div class="form-group">
                            <label class="form-label" for="date_added">Check-In</label>
                            <div class="date input-group has-validation">
                                    <input id="check_in" name="check_in" type="text" class="form-control" onkeydown="return false" required>
                                    <input class="form-control" type="time" name="time_check_in" required>
                                    <div class="invalid-feedback">
                                        Enter your date and time of check-in.
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 position-relative">
                        <div class="form-group">
                            <label class="form-label" for="date_modified"> Check-out</label>
                            <div class="date input-group has-validation">
                                <input id="check_out" name="check_out" type="text" class="form-control" onkeydown="return false" required>
                                <input  class="form-control" type="time" name="time_check_out" required>
                                <div class="invalid-feedback">
                                        Enter your date and time of check-out.
                                    </div>
                            </div>
                        </div>
                    </div>    
                    <div class="col-lg-4 position-relative">
                        <label for="#validationTooltip03" class="form-label">No. of guests</label>
                        <input type="number" min="1" max="4" name="number_of_guest" value="1" class="form-control" id="validationTooltip03" required>
                        <div class="invalid-feedback">
                            Please fill-up this field.
                        </div>
                    </div>
                    <div class="col-12 mb-5">
                        <a class="btn btn-light" href="home.php">Cancel</a>
                        <input type="submit" name="review_details" value="Review Details" class="btn btn-primary">
                    </div>
        </div>
        <div class="col-lg-5 mb-lg-5 vh-100">
            <div class="row">
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
                                            <img src="<?php echo "../Photos/hotel_rooms/" . $row ['image']?>" height="150" width="100%" alt="image">
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="d-flex">
                                                <p class="lead p-0 m-0">Room Type:</p>
                                                <input type="hidden" name="room_id" value="<?php echo $row ['id']?>">     
                                                <p class="lead p-0 px-sm-1 m-0"><?php echo $row ['name_of_room']?></p>
                                                <input type="hidden" name="name_of_room" value="<?php echo $row ['name_of_room']?>">
                                            </span>
                                            <span class="d-flex">
                                                <p class="lead p-0 m-0">Room Number: </p>
                                                <p class="lead p-0 px-sm-1 m-0"> <?php echo $row ['room_number']?></p>
                                                <input type="hidden" name="room_number" value="<?php echo $row ['room_number']?>">   
                                            </span>
                                            <span class="d-flex">
                                                <p class="lead p-0 m-0">Price: </p>
                                                <p class="lead p-0 px-sm-1 m-0"><?php echo $row ['price']?></p>
                                                <input type="hidden" name="price" value="<?php echo $row ['price']?>">
                                            </span>
                                            <span class="d-flex">
                                                <p class="lead p-0 m-0">Package: </p>
                                                <p class="lead p-0 px-sm-1 m-0"> <?php echo $row ['name_package']?></p>
                                                <input type="hidden" name="name_package" value="<?php echo $row ['name_package']?>">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-footer p-2 px-3 position-relative">
                                    <p class="lead m-0">Inclusions:</p>
                                    <p class="lead m-0"><?php echo $row ['description']?></p>
                                    <input type="hidden" name="description" value="<?php echo $row ['description']?>">
                                    
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </form>                                      
</main>
<?php
}
}
?>
<script>
var check_in = $('#check_in');
var check_out = $('#check_out');

check_in.datepicker({
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: 'yyyy-mm-dd',
    startDate: new Date()
});
check_out.datepicker({
    keyboardNavigation: false,
    forceParse: false,
    format: 'yyyy-mm-dd',
    autoclose: true,
});
check_in.on("changeDate", function(e) {
    check_out.datepicker('setStartDate', e.date);
    check_out.prop('disabled', false);
});
    </script>
<?php
include('./includes/footer.php');
?>