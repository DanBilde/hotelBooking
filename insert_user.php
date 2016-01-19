<?php
//JESPER
session_start();
ob_start();
include_once 'DbConnection.php';
$mysqli_connection=mysqli_connect("127.0.0.1","root","","modul2");
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$pw = $_POST['pw'];
$rights = $_POST['rights'];


if($rights!=NULL){



$insert_post_sql = "INSERT INTO users
                    SET first_name='$firstname', last_name='$lastname', email='$email', password='$pw', admin='$rights'
						";


//update the post
if ($mysqli->query($insert_post_sql)) {
     $message = "user created - try to login with it";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: admin_home.php");
}else{
    echo 'something went wrong';
}
} else {
    $insert_post_sql = "INSERT INTO users
                    SET first_name='$firstname', last_name='$lastname', email='$email', password='$pw'
						";


//update the post
if ($mysqli->query($insert_post_sql)) {
     $message = "user created - try to login with it";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: index.php");
}else{
    echo 'something went wrong';
}


}




