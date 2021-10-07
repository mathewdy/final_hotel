<?php

//di pa to tapos

session_start();
include('../connection.php');

if(isset($_GET['id'])){
    $room_number = $_GET['id'];
    
}
if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/global-style.css"/>
    <link rel="stylesheet" href="./css/book-now.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <title>ProCreation</title>
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
                    
                    <div class="container-lg p-lg-5 mt-lg-3">
                        <div class="row">
                            <div class="col-md-7">
        
                    <form class="row g-3 needs-validation" action="review-details.php" method="POST" novalidate>
                        <input type="hidden" name="id" value="<?php echo $_SESSION['id']?>" readonly>
                        <input type="hidden" name="account_id" value="<?php echo $_SESSION['account_id']?>" readonly>

                        <div class="col-md-6 position-relative">
                            <label for="validationTooltip01" class="form-label">First name</label>
                            <input type="text" name="first_name" value="<?php echo $_SESSION['first_name']?>" class="form-control" id="validationTooltip01" readonly>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="validationTooltip02" class="form-label">Last name</label>
                            <input type="text" name="last_name" value="<?php echo $_SESSION['last_name']?>" class="form-control" id="validationTooltip02" readonly>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="validationTooltipUsername" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <input type="Email" name="email" value="<?php echo $_SESSION['email']?>" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" readonly>
                                <span class="input-group-text" id="basic-addon2">@example.com</span>
                            </div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="validationTooltip03" class="form-label">Contact Number</label>
                            <input type="text" name="mobile_number" value="<?php echo $_SESSION['mobile_number']?>" class="form-control" id="validationTooltip03" readonly>
                        </div>
                        <div class="col-md-4 position-relative">
                            <div class="form-group">
                                <label class="form-label" for="date_added">Check-In</label>
                                <div class="date input-group has-validation">
                                        <input id="check_in" name="check_in" type="text" class="form-control" onkeydown="return false" required>
                                        <input type="time" name="time_check_in">
                                        <div class="invalid-feedback">
                                            Enter your date of check-in.
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <div class="form-group">
                                <label class="form-label" for="date_modified"> Check-out</label>
                                <div class="date input-group has-validation">
                                    <input id="check_out" name="check_out" type="text" class="form-control" onkeydown="return false" required>
                                    <input type="time" name="time_check_out">
                                    <div class="invalid-feedback">
                                            Enter your date of check-out.
                                        </div>
                                </div>
                            </div>
                        </div>    
                        <div class="col-md-4 position-relative">
                            <label for="#validationTooltip03" class="form-label">No. of guests</label>
                            <input type="number" min="1" max="4" name="number_of_guest" value="1" class="form-control" id="validationTooltip03" required>
                            <div class="invalid-feedback">
                                            Please fill-up this field.
                                        </div>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-light" href="home.php">Cancel</a>
                            <input type="submit" name="review_details" value="Review Details" class="btn btn-primary">
                        </div>
                
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-12"></div>
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
                                            <div class="col-md-12 pb-0">
                                            <img src="<?php echo "./Photos/hotel_rooms/" . $row ['image']?>" height="150" width="100%" alt="image">
                                            </div>
                                            <div class="col-md-12">
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
                                    <div class="accordion-footer p-2 px-3">
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
        </div>
    </main>
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
    <script src="./js/bootstrap.js"></script>
</body>
</html>