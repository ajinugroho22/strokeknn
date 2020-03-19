<?php 
session_start();
$_SESSION['username']="";
$_SESSION['password']="";
$_SESSION['login']="";
header("location:index.php");
?>