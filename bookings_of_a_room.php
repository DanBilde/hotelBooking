<?php
//JESPER
session_start();
ob_start();
include_once 'DbConnection.php';
include 'functions.php';
$room_no = $_POST['room'];



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
         
                    <form action="?action=unsetUsername" method="post">
                        <input type="submit" class="btn btn-primary" value="Logout <?php echo $username ?>">
                    </form>
                    <a class="btn btn-primary" href="home.php">back</a>
                </div>

                <?php 
                    //$sql = "SELECT * FROM bookings WHERE fk_room_no = $room_no";
                    $sql ="SELECT * FROM bookings INNER JOIN users ON bookings.user_id = users.user_id WHERE fk_room_no = $room_no";
$result = $mysqli->query($sql);

while ($row = $result->fetch_object()) {
    //echo "$_SESSION[admin]";
    $hotel_id = $row->hotel_id;

    $foundhotel = "<div class=\"booking\"><h1>Hotel id: " . $row->hotel_id . "</h1>";
    $foundhotel.= "<p>Room Number: " . $row->fk_room_no . "</p>";
    $foundhotel.= "<p>Is booked by User_id: " . $row->user_id . "</p>";
    $foundhotel.= "<p>Is booked by User: " . $row->email . "</p>";
    $foundhotel.= "<p>From the: " . $row->from_time . "</p>";
    $foundhotel.= "<p>To the: " . $row->to_time . "</p></div>";
    
    echo $foundhotel;
    
}
        
                    ?>

            </div>


        </div> <!--end of container-->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="bank.js"></script>

    </body>



</html>

