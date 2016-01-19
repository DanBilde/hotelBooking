<?php
//JESPER
session_start();
ob_start();
include 'DbConnection.php';
include 'functions.php';


if (isset($_SESSION['username'], $_SESSION['password'], $_SESSION['admin'])) {
                    $username = $_SESSION['username'];
                    
                } else {
                    echo "You are not logged in! AT ALL";
                }


//echo insert_user_form();//put where-ever needed

/* if(isset($_GET['action']))
  {
  switch($_GET['action'])
  {

  case "unsetUsername":
  unset($_SESSION['username']);
  unset($_SESSION['password']);
  unset($_SESSION['admin']);
  header("location: index.php");
  break;

  case "displayHotels":
  echo hotels_from_db_picker();

  break;
  }
  } */

/*
  if(isset($_SESSION['username'], $_SESSION['password'], $_SESSION['admin']))
  {
  $username = $_SESSION['username'];
  echo $username;
  echo insert_user_form()."<br/>";//put where-ever needed
  echo insert_hotel_form();
  }else{
  echo "You are not logged in! AT ALL";
  }
 */
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
                
                <div class="nav">
                <form action="?action=unsetUsername" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="Logout <?php echo $username; ?>">
                </form>
                <form action="?action=displayHotels" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="display the hotels">
                </form>
                    <form action="?action=showBookings" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="show 10 lest booked rooms">
                </form>
                    <form action="?action=showtopBookings" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="show 10 Top booked rooms">
                </form>
                <form action="?action=newUser" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="Create a new user">
                </form>
                <form action="?action=newHotel" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="Create a new hotel">
                </form>
                    <form action="?action=showUsers" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="show users">
                </form>
                    <form action="?action=showAdmins" method="post">
                    <input type="submit" class="btn btn-block btn-primary" value="show Admins">
                </form>
                </div><!-- end of navigations-->
                
                <?php
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {

                        case "unsetUsername":
                            unset($_SESSION['username']);
                            unset($_SESSION['password']);
                            unset($_SESSION['admin']);
                            header("location: index.php");
                            break;

                        case "displayHotels":
                            echo hotels_from_db_picker();

                            break;
                        
                        case "newUser":
                            echo insert_user_form();
                            break;
                        
                        case "newHotel":
                            echo insert_hotel_form();
                            break;
                        case "showBookings":
                            echo show_bookings_least();
                            break;
                        case "showtopBookings":
                            echo show_bookings_top();
                            break;
                        case "showUsers":
                            echo getNonAdmins();
                            break;
                        case "showAdmins":
                            echo getAllAdmins();
                            break;
                        
                    }
                }



             
                ?>


                
            </div>

            <!--
                        <div class="tables">  
                            <h3>for hotels</h3>
<?php
//echo hotel_login();
?>
                        </div>-->
        </div> <!--end of container-->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="bank.js"></script>

    </body>



</html>

