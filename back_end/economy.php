<?php

include('../connection.php');

session_start();

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
    <link rel="stylesheet" href="../css/global-style.css"/>
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
<div class="container py-lg-4">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item" ><a href="all.php">All</a></li>
        <li class="breadcrumb-item active" aria-current="page">Economy Rooms</li>
        <li class="breadcrumb-item" ><a href="deluxe.php">Deluxe Rooms</a></li>
        <li class="breadcrumb-item" ><a href="executive.php">Executive Rooms</a></li>
    </ol>
    <!--filter-->
    
</nav>
</div>


    <?php

        $query_economy = "SELECT rooms.id , rooms.room_number,rooms.room_type_id, rooms.status, room_types.id,  room_types.image,
        room_types.name_of_room, room_types.price,room_types.package_id, packages.id,packages.name_package,packages.description
        FROM room_types
        LEFT JOIN rooms ON rooms.room_type_id = room_types.id
        LEFT JOIN packages ON room_types.package_id = packages.id 
        WHERE rooms.room_type_id = 1 ORDER BY rooms.room_number ASC;";
        $run_economy = mysqli_query($conn,$query_economy);

        if(mysqli_num_rows($run_economy) > 0){
                ?>

                <div class="container">
                    <div class="row">
                <?php foreach($run_economy as $row) {?>
                    
                    <div class="col-md-3 pb-3">
                        <div class="card">
                    <div class="card-body">
                    <img class="card-img-top" src="<?php echo "./Photos/hotel_rooms/" . $row ['image']?>" alt="economy room">
                        <p class="p-0 m-0">Room number : <?php echo $row ['room_number']?></p>
                        <p class="p-0 m-0">Price : <?php echo $row ['price']?></p>
                        <p class="p-0 m-0">Package : <?php echo $row ['name_package']?></p>
                        <p class="p-0 m-0">Description : <?php echo $row ['description']?></p>
                        <p class="p-0 m-0">Status : <?php echo $row ['status']?></p>

                        <a class="btn btn-dark w-100" href="book-now.php?id=<?php echo $row ['room_number']?>">View</a>
                    </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
            </div>
        <?php }
    ?>
    <script src="./js/bootstrap.js"></script>
</body>
</html>

