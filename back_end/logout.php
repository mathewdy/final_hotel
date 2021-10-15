<?php

session_start();

$_SESSION['email'];
unset($_SESSION['email']);

session_destroy();

echo "<script>alert('log out') </script> ";
echo "<script>window.location.href='../guest/index.php' </script>";
?>