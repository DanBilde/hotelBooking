<?php
//JESPER
session_start();
ob_start();
include_once 'DbConnection.php';
include 'functions.php';
$room_no = $_POST['roomNo'];
$room_id = $_POST['room_id'];
$hotel_id = $_POST['hotel_id'];
$from_date = $_POST['from'];
$to_date = $_POST['to'];
$user_id = $_SESSION['id'];
$state = $_POST['state'];

$insert_post_sql = "INSERT INTO bookings
                    SET fk_room_no='$room_no', fk_room_id='$room_id', hotel_id='$hotel_id', from_time='$from_date', to_time='$to_date', user_id='$user_id', booking_state_id='$state'
						";
						

$result = $mysqli->query($insert_post_sql);
if ($mysqli->query($insert_post_sql)) {
     $message = "booking deleted";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: home.php?action=displayHotels");
}else{
    echo 'something went wrong';
}


