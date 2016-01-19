<?php
//JESPER
session_start();
ob_start();
include_once 'DbConnection.php';
include 'functions.php';
$roomNo = $_POST['roomNo'];
$room_id = $_POST['room_id'];
$hotel_id = $_POST['hotel_id'];

$sql ="DELETE FROM rooms WHERE room_id=$room_id";
$delete_booking_sql ="DELETE FROM bookings WHERE fk_room_id=$room_id";

$r = $mysqli->query($delete_booking_sql);

if ($mysqli->query($delete_booking_sql)) {
     $message = "booking deleted";
echo "<script type='text/javascript'>alert('$message');</script>";
}

$result = $mysqli->query($sql);
if ($mysqli->query($sql)) {
     $message = "booking deleted";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: home.php?action=displayHotels");
}else{
    echo 'something went wrong';
}


