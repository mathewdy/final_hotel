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
  <link rel="stylesheet" href="../css/global-style.css">
  <title>Admin</title>
</head>
<body style="background:rgba(0,0,0, 0.9);">
  <div class="container">
    <div class="row align-middle" style="display:grid; place-items:center; height:40em;">
      <div class="col-lg-4"></div>
      <div class="col-lg-4 mb-lg-3 text-center bg-light p-lg-5 rounded">
          <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
          <p class="display-3">Admin</p>
          <hr class="featurette-divider">
                <input class="form-control my-3" type="text" name="username" placeholder="Username">     
                <input  class="form-control my-3" type="password" name="password" placeholder="Password">
            
            <hr class="featurette-divider">
                <span class="d-flex justify-content-end"> 
                <button class="btn btn-primary w-100" type="submit" name="admin_login">Sign in</button>
            </span>
            <?php if (isset($error)):?> 
                <?php echo $error?>
            <?php endif?>
            </form>
      </div>
      <div class="col-lg-4"></div>
    </div>
  </div>
</body>
</html>