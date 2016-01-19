<?php
//JESPER
session_start();
ob_start();
include_once 'DbConnection.php';
include 'functions.php';
$user_id = $_POST['user_id'];




$sql ="UPDATE users SET blocked='yes' WHERE user_id=$user_id";


$result = $mysqli->query($sql);
if ($mysqli->query($sql)) {
     $message = "He is now an admin";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: admin_home.php?action=showUsers");
}else{
    echo 'something went wrong';
}





