<?php
//JESPER
session_start();
ob_start();
include 'DbConnection.php';
include 'functions.php';
$username = $_SESSION['username']

//echo insert_user_form();//put where-ever needed
/*
if (isset($_GET['action'])) {
    switch ($_GET['action']) {

        case "unsetUsername":
            unset($_SESSION['username']);
            unset($_SESSION['password']);
            unset($_SESSION['admin']);
            header("location: index.php");
            break;
    }
}


if (isset($_SESSION['username'], $_SESSION['password'], $_SESSION['admin'])) {
    $username = $_SESSION['username'];

    //echo $username;
} else {
    echo "You are not logged in! AT ALL";
}*/
?>



<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="newcss.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="jumbotron">
            </div>
            <div class="tables">



                <div>
                     <form  action="?action=show_hotels" method="post">
                        <input type="submit"  class="btn btn-block btn-primary searchhotelbutton" value="search for a hotel">
                    </form>   
                    
                    
                    <form action="?action=showBookings" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="show 10 least booked rooms">
                </form>
                    <form action="?action=showtopBookings" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="show 10 Top booked rooms">
                </form>
                    </form>
                    <form action="?action=showMyBookings" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="show my booked rooms">
                </form>
                    <form action="?action=showRoomBooking" method="post">
                        
                    <input type="submit" class="btn btn-block btn-primary" value="show a rooms booking">
                </form>                    
                    <form action="?action=unsetUsername" method="post">
                        <input type="submit" class="btn btn-block btn-primary" value="Logout <?php echo $username ?>">
                    </form>
                    
                    
                    <?php
                    if (isset($_GET['action'])) {
                        switch ($_GET['action']) {

                            case "unsetUsername":
                                unset($_SESSION['username']);
                                unset($_SESSION['password']);
                                unset($_SESSION['admin']);
                                header("location: index.php");
                                break;
                            
                            case "show_hotels":
                                echo hotels_from_db_picker();
                                
                                break;
                            case "showBookings":
                            echo show_bookings_least();
                            break;
                        case "showtopBookings":
                            echo show_bookings_top();
                            break;
                        
                        case "showMyBookings":
                            echo show_bookings_mine();
                            break;
                        case "showRoomBooking":
                            echo show_room_bookings();
                            break;
                        }
                    }
                    if (isset($_SESSION['username'], $_SESSION['password'], $_SESSION['admin'])) {
                        $username = $_SESSION['username'];

                    } else {
                        echo "You are not logged in! AT ALL";
                    }
                    ?>

                </div>


            </div>


        </div> <!--end of container-->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="bank.js"></script>

    </body>



</html>




