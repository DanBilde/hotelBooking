<?php
session_start();
ob_start();
include 'DbConnection.php';
include 'functions.php';


//echo insert_user_form();//put where-ever needed

if(isset($_GET['action']))
{
    switch($_GET['action'])
    {
      
        case "unsetUsername":
            unset($_SESSION['username']);
            unset($_SESSION['password']);
            header("location: index.php");
            break;
    }
}


if(isset($_SESSION['username'], $_SESSION['password']))
{
    echo $_SESSION['username'];
    //echo insert_hotel_form();//put where-ever needed
}else{
    echo "You are not logged in! AT ALL";
}


?>
<form action="?action=unsetUsername" method="post">
            <input type="submit" value="Logout!">
</form>

