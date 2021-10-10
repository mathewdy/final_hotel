<?php

include('../connection.php');
include('./includes/header.php');
session_start();

if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}
?>
<div class="container py-lg-4 mt-5 p-xxl-3">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">All</li>
        <li class="breadcrumb-item"> <a href="economy.php">Economy Rooms</a></li>
        <li class="breadcrumb-item"><a href="deluxe.php">Deluxe Rooms</a></li>
        <li class="breadcrumb-item"><a href="executive.php">Executive Rooms</a></li>           
    </ol>
</nav>
</div>
    <?php
    //economy
    $query_executive = "SELECT rooms.id , rooms.room_number,rooms.room_type_id, room_types.id, room_types.image,
            room_types.name_of_room, room_types.price,room_types.package_id, packages.id,packages.name_package,packages.description
            FROM room_types
            LEFT JOIN rooms ON rooms.room_type_id = room_types.id
            LEFT JOIN packages ON room_types.package_id = packages.id 
            WHERE rooms.room_type_id = 1 ORDER BY rooms.room_number ASC;";
            $run_executive = mysqli_query($conn,$query_executive);

        if(mysqli_num_rows($run_executive)> 0){
            ?>
            
            <div class="container">
                    <div class="row">

            <?php foreach($run_executive as $row) {?>
                <div class="col-lg-3 col-md-12 pb-3">
                    <div class="card">
                    <div class="card-body">
                    <img class="card-img-top" src="<?php echo "../Photos/hotel_rooms/" . $row ['image']?>" alt="economy room">
                        <p class="p-0 m-0">Room number : <?php echo $row ['room_number']?></p>
                        <p class="p-0 m-0">Price : <?php echo $row ['price']?></p>
                        <p class="p-0 m-0">Package : <?php echo $row ['name_package']?></p>
                        <p class="p-0 m-0">Description : <?php echo $row ['description']?></p>

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

<?php
//deluxe
    $query_executive = "SELECT rooms.id , rooms.room_number,rooms.room_type_id, room_types.id, room_types.image,
            room_types.name_of_room, room_types.price,room_types.package_id, packages.id,packages.name_package,packages.description
            FROM room_types
            LEFT JOIN rooms ON rooms.room_type_id = room_types.id
            LEFT JOIN packages ON room_types.package_id = packages.id 
            WHERE rooms.room_type_id = 2 ORDER BY rooms.room_number ASC;";
            $run_executive = mysqli_query($conn,$query_executive);

        if(mysqli_num_rows($run_executive)> 0){
            ?>
            
            <div class="container">
                    <div class="row">

            <?php foreach($run_executive as $row) {?>
                <div class="col-lg-3 col-md-12 pb-3">
                    <div class="card">
                    <div class="card-body">
                    <img class="card-img-top" src="<?php echo "./Photos/hotel_rooms/" . $row ['image']?>" alt="economy room">
                        <p class="p-0 m-0">Room number : <?php echo $row ['room_number']?></p>
                        <p class="p-0 m-0">Price : <?php echo $row ['price']?></p>
                        <p class="p-0 m-0">Package : <?php echo $row ['name_package']?></p>
                        <p class="p-0 m-0">Description : <?php echo $row ['description']?></p>
                        

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

<?php
//executive 
    $query_executive = "SELECT rooms.id , rooms.room_number,rooms.room_type_id, room_types.id, room_types.image,
            room_types.name_of_room, room_types.price,room_types.package_id, packages.id,packages.name_package,packages.description
            FROM room_types
            LEFT JOIN rooms ON rooms.room_type_id = room_types.id
            LEFT JOIN packages ON room_types.package_id = packages.id 
            WHERE rooms.room_type_id = 3 ORDER BY rooms.room_number ASC;";
            $run_executive = mysqli_query($conn,$query_executive);

        if(mysqli_num_rows($run_executive)> 0){
            ?>
            
            <div class="container">
                    <div class="row">

            <?php foreach($run_executive as $row) {?>
                <div class="col-lg-4 col-md-12 pb-3">
                    <div class="card">
                    <div class="card-body">
                    <img class="card-img-top" src="<?php echo "./Photos/hotel_rooms/" . $row ['image']?>" alt="economy room">
                        <p class="p-0 m-0">Room number : <?php echo $row ['room_number']?></p>
                        <p class="p-0 m-0">Price : <?php echo $row ['price']?></p>
                        <p class="p-0 m-0">Package : <?php echo $row ['name_package']?></p>
                        <p class="p-0 m-0">Description : <?php echo $row ['description']?></p>
                       
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
    <script src="../js/bootstrap.js"></script>
</body>
</html>