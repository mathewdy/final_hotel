<?php
session_start();
include('../connection.php');
include("./includes/header.php");
?>

<div class="container p-5">
<a href="home.php" class="btn btn-dark mb-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
<path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
</svg><small>Back</small></a>
<p class="lead text-muted display-2">Profile Settings</p>
<hr class="featurette-divider">
    <?php

    $query_user = "SELECT * FROM users WHERE id='$_SESSION[id]'";
    $run_user = mysqli_query($conn,$query_user);

    if($run_user){
        if(mysqli_num_rows($run_user) > 0){
            foreach($run_user as $row){
                ?>
                <div class="container">
                <span class="hstack gap-lg-5">
                    <p class="lead fw-bold">First Name :</p>
                    <p class="lead fw-regular">
                        <?php echo $row ['first_name']?>
                    </p>
                </span>
                <span class="hstack gap-lg-5">
                    <p class="lead fw-bold">Last Name :</p>
                    <p class="lead fw-regular">
                        <?php echo $row ['last_name']?>
                    </p>
                </span>
                <span class="hstack gap-lg-5">
                    <p class="lead fw-bold">Mobile Number :</p>
                    <p class="lead fw-regular">
                        <?php echo $row ['mobile_number']?>
                    </p>
                </span>
                <span class="hstack gap-lg-5 pb-lg-5">
                    <p class="lead fw-bold">Email Address :</p>
                    <p class="lead fw-regular">
                        <?php echo $row ['email']?>
                    </p>
                </span>
                <hr class="featurette-divider">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success px-4" href="edit_profile.php?id=<?php echo $row ['id']?>">Edit</a>
                </div>
                
                </div>
                <?php
            }
        }
    }

    ?>
</div>

<?php
include('./includes/footer.php')
?>