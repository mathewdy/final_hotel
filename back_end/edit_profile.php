<?php

session_start();
include('../connection.php');

if(empty($_SESSION['email'])){
    echo "<script>window.location.href='../guest/index.php' </script>";
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
    <a href="profile.php">Back</a>
    <?php

    if(isset($_GET['id'])){
        $id =  $_GET['id'];
        $query_1 = "SELECT * FROM users WHERE id='$id'";
        $run_1 = mysqli_query($conn,$query_1);

        if($run_1){
            if(mysqli_num_rows($run_1) > 0){
                foreach($run_1 as $row){
                    ?>

                    <form action="#" method="POST">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" placeholder="<?php echo  $row['first_name']?>">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" placeholder="<?php echo $row['last_name']?>">
                        <label for="">Email</label>
                        <input type="email" name="email" placeholder="<?php echo $row['email']?>">
                        <label for="">Mobile Number</label>
                        <input type="text" name="mobile_number" placeholder="<?php echo $row['mobile_number']?>">
                        <input type="submit" name="update" value="Update">
                    </form>
                
                
                <?php
                }
            }
        }
    }
    
  

    if(isset($_POST['update'])){
        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $mobile_number = $_POST['mobile_number'];


        if(empty($first_name)){
            echo "required field";
            exit();
        }else if(empty($last_name)){
            echo "required field";
        }else if (empty($email)){
            echo "required field";
            exit();
        }else if(empty($mobile_number)){
            echo "required field";
            exit();
        }else{
            $query = "UPDATE users SET first_name='$first_name', last_name='$last_name',
            email='$email', mobile_number='$mobile_number'";
            $run = mysqli_query($conn,$query);
    
            if($run){
                echo "updated";
            }else{
                echo "Error" .$conn->error;
            }

        }

       
    }

    ?>
</body>
</html>