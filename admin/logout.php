<?php
include("../connection.php");
session_start();
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
	header("Location:index.php");
	exit();
}
if (isset($_SESSION['username']) && isset($_SESSION['password'])){
	session_unset();
	session_destroy();
	header("location:index.php");
	exit();
}
?>