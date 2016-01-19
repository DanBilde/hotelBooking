<?php
//JESPER
session_start();
ob_start();
include_once 'DbConnection.php';
include 'functions.php';
$user_id = $_POST['user_id'];
$user_rigths = $_POST['user_rights'];
if($user_rights == "no"){


$sql ="UPDATE users SET admin='yes' WHERE user_id=$user_id";


$result = $mysqli->query($sql);
if ($mysqli->query($sql)) {
     $message = "He is now an admin";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: admin_home.php?action=showUsers");
}else{
    echo 'something went wrong';
}



} 

if($user_rigths = 'yes') {
    $sql ="UPDATE users SET admin='no' WHERE user_id=$user_id";


$result = $mysqli->query($sql);
if ($mysqli->query($sql)) {
     $message = "He is now a user";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: admin_home.php?action=showAdmins");
}else{
    echo 'something went wrong';
}
}

