<?php
//JESPER
session_start();
ob_start();
include_once 'DbConnection.php';
include 'functions.php';
$booking_id = $_POST['booking_id'];

$sql ="DELETE FROM bookings WHERE booking_id=$booking_id";
$result = $mysqli->query($sql);

if ($mysqli->query($sql)) {
     $message = "booking deleted";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: home.php?action=showMyBookings");
}else{
    echo 'something went wrong';
}


