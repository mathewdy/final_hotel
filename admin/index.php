<?php 
include("../connection.php");
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])){
  header("location:home.php");
}
  if(isset($_POST['admin_login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(empty($_POST['username']) && empty($_POST['password'])){
      $error = "please input username & password";
     
    }
    else if(empty($_POST['username'])){
      $error = "please input username";

    }
    else if(empty($_POST['password'])){
      $error = "please input password";

    }else{
      $sql_admin = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
      $query_admin = mysqli_query($conn, $sql_admin);
      if(mysqli_num_rows($query_admin) == 1){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("location:home.php");
        exit();
      }else{
        $error = "Credentials not found";
      }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
</head>
<body>
    <h2>Admin Login</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit" name="admin_login">Login</button>
    <?php if (isset($error)):?> 
        <?php echo $error?>
    <?php endif?>
    </form>
</body>
</html>