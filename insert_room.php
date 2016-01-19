<?php
ob_start();
include_once 'DbConnection.php';
$room_id = $_POST['roomId'];
$hotel_id = $_POST['hotel_id'];
$beds = $_POST['beds'];
$AC = $_POST['AC'];
$description = $_POST['description'];
$room_no=$_POST['roomNo'];


/* $insert_post_sql="INSERT INTO user
  (userid, firstname, password)
  VALUES (null, '$name', '$pw',)"; */

$insert_post_sql = "INSERT INTO rooms
                    SET room_id='$room_id', hotel_id='$hotel_id', beds='$beds',ac='$AC' , description='$description' , room_no='$room_no' 
						";
//update the post
if ($mysqli->query($insert_post_sql)) {
     $message = "hotel created - logging you out sir.";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: index.php");
}else{
    echo 'something went wrong';
}




