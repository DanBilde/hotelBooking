<?php
//JESPER
session_start();
ob_start();
include 'functions.php';
$email = $_POST['email'];
$pw = $_POST['pw'];
include_once "DbConnection.php";

$sql = "SELECT * FROM users WHERE email='$email'
 AND password='$pw' LIMIT 1";

$result = $mysqli->query($sql);

$count = mysqli_num_rows($result);
$row = $result->fetch_array(MYSQLI_NUM);

if ($count == 1) {
    if($row[6] == 'no'){
    if ($row[5] == 'yes') {
        $_SESSION['username'] = "$email";
        $_SESSION['password'] = "$pw";
        $_SESSION['admin'] = "yes";
        $_SESSION['id'] = "$row[0]";

        echo 'wuhuuu admin motherfucker';
        echo $row[5];
        header("location:admin_home.php");
    } else {
        $_SESSION['username'] = "$email";
        $_SESSION['password'] = "$pw";
        $_SESSION['admin'] = "no";
        $_SESSION['id'] = "$row[0]";
        header("location:home.php");
    }
} else {
    
} $message = "The user $email has been blocked, and will not go further than this.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<a href="http://www.youtube.com/watch?v=fS7w-TXinPE">Get out!?</a>';

    } else {
    $message = "wrong answer";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo 'Try again?</br>';
    echo login_form1();
}
?>