<?php

session_start();
session_destroy();

unset($_SESSION['email']);



echo "<script>alert('log out') </script> ";
echo "<script>window.location.href='../guest/index.php' </script>";
?>