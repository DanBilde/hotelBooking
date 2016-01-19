<?php
//JESPER
ob_start();
session_start();
include_once 'DbConnection.php';
$room_no = $_POST['roomNo'];
$room_id = $_POST['room_id'];
$hotel_id = $_POST['hotel_id'];
$from_date = $_POST['from'];
$to_date = $_POST['to'];
$user_id = $_SESSION['id'];


/* $insert_post_sql="INSERT INTO user
  (userid, firstname, password)
  VALUES (null, '$name', '$pw',)"; */

$date_checker_sql ="SELECT * FROM bookings WHERE hotel_id = $hotel_id";

$result = $mysqli->query($date_checker_sql);
/*
while($row = $result->fetch_object()){
    echo $row->booking_id;
    if($row->from_time <= $from_date && $row->to_date >= $to_date && $row->room_no = $room_no){
        $message = "booking if works.";
echo "<script type='text/javascript'>alert('$message');</script>";
    }else{ $message = "something wrong";
echo "<script type='text/javascript'>alert('$message');</script>";
    }
    
    
}
*/
//REVISIT THE ABOVE STATEMENTS TO CHECK IF THE ROOM IS AVAILABLE

$insert_post_sql = "INSERT INTO bookings
                    SET fk_room_no='$room_no', fk_room_id='$room_id', hotel_id='$hotel_id', from_time='$from_date', to_time='$to_date', user_id='$user_id'
						";
//update the post
if ($mysqli->query($insert_post_sql)) {
     $message = "hello.";
echo "<script type='text/javascript'>alert('$message');</script>";
    //header("location: index.php");
}else{
    echo 'something went wrong';
}

$update_booking_sql = "SELECT * FROM rooms WHERE hotel_id = $hotel_id AND room_no = $room_no";
$gotten = $mysqli->query($update_booking_sql);
while ($row = $gotten->fetch_object()) {
    $bookings = $row->times_booked+1;
}
$update_post_sql = "UPDATE rooms
                    SET times_booked='$bookings' WHERE hotel_id = $hotel_id AND room_no = $room_no
						";
if ($mysqli->query($update_post_sql)) {
     $message = "Room Booked, thank you.";
echo "<script type='text/javascript'>alert('$message');</script>";
header("location: home.php");
}
