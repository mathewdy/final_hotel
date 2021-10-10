<?php
include('../connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<body>
    <form action="login.php" method="POST">
        <label for="">Account Id</label>
        <input type="text" name="account_id">
        <label for="">Email</label>
        <input type="email" name="email">
        <input type="submit" name="login">
    </form>
    <a href="registration.php">Register</a>
</body>
</html>

<?php

if(isset($_POST['login'])){
    $account_id = $_POST['account_id'];
    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE account_id='$account_id' AND email='$email'";
    $result = mysqli_query($conn,$query);

    if($result){
        if(mysqli_num_rows($result) == 1){
            //getting array sa database
            $result_fetch = mysqli_fetch_assoc($result);
            //call out ko yung 'email_status' sa database
            //kapag == 1 makakapag log in, . 
            // validation ng password syempre SHAHSHAHS 
            if($result_fetch['email_status'] == 1)
            {
                if(($_POST['account_id'] == $result_fetch['account_id'])){
                    // makakapag login kapag tama
                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $result_fetch['email'];
                    $_SESSION['id'] = $result_fetch['id'];
                    $_SESSION['first_name'] = $result_fetch['first_name'];
                    $_SESSION['last_name'] = $result_fetch['last_name'];
                    $_SESSION['mobile_number'] = $result_fetch['mobile_number'];
                    $_SESSION['account_id'] = $result_fetch['account_id'];
                    header("Location: home.php");
                }else{
                    //incorrect id
                    echo "<script>
                    swal({
                        title: 'Incorrect Id'
                    });
                    </script>";
                 
                   
                }
            }else{  //di pa verified account
                echo "<script>swal({
                    title: 'Please verify your email address'
                });</script>";
              
                
            }
            
        }else{//walang account
            echo "<script>swal({
                title: 'Account not found'
            });</script>";
            
        }
    }

}

?>