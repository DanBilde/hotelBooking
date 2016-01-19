<?php
session_start();
ob_start();
include 'functions.php';
$email=$_POST['email'];
$pw=$_POST['pw'];
include_once "DbConnection.php";

$sql="SELECT * FROM users WHERE email='$email'
 AND password='$pw' AND rights='admin' LIMIT 1";

$result = $mysqli->query($sql);
$count=mysqli_num_rows($result); 
 if($count==1){
     
	 $_SESSION['username']="$email";
         $_SESSION['password']="$pw";
	 
         header ("location:home.php");
         
	 }else{
		 $message = "wrong answer";
echo "<script type='text/javascript'>alert('$message');</script>";
echo 'Try again?</br>';
		 echo login_form1();
}






?>