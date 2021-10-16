<?php

session_start();


unset($_SESSION['email']);

session_destroy();

echo "<script>alert('log out') </script> ";
echo "<script>window.location.href='../guest/index.php' </script>";
?>