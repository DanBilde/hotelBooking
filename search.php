<?php
//JESPER
session_start();
ob_start();
include 'DbConnection.php';
include 'functions.php';
$username = $_SESSION['username'];
$hotel = $_POST['hotel'];
$from_date = $_POST['from'];
$to_date = $_POST['to'];
$sql = "SELECT * FROM hotels WHERE hotel_name='$hotel'";

$result = $mysqli->query($sql);

while ($row = $result->fetch_object()) {
    //echo "$_SESSION[admin]";
    $hotel_id = $row->hotel_id;

    $foundhotel = "<h1>" . $row->hotel_name . "</h1></br>";
    $foundhotel.= $row->hotel_adress . "</br>";
    $foundhotel.= $row->hotel_postal_code . "</br>";
    $foundhotel.= $row->description . "</br>";
    $foundhotel.="<img src='userfiles/$row->hotel_img'/>" . "</br>";
    
 
    //echo "$foundhotel";
    if ($_SESSION['admin'] == "yes") {
        $room_form = "<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $room_form.="<legend>New room</legend>";

        $room_form.="hotel: " . $row->hotel_name . " <form method =\"post\" action=\"insert_room.php\">";
        $room_form.="<input type=\"number\" name=\"hotel_id\" style=\"display:none\" value=\"$row->hotel_id\"  />";
        $room_form.="roomID: <input type=\"number\" name=\"roomId\" class=\"form-control\"  /><br/>";
        $room_form.="description:<input type=\"text\"class=\"form-control\" name=\"description\" /><br/>";
        $room_form.="beds:<input type=\"number\" class=\"form-control\" name=\"beds\" /><br/>";
        $room_form.="AC?:<input type=\"radio\" name=\"AC\"  value=\"yes\">Yes <input type=\"radio\" name=\"AC\" value=\"no\">No<br/>";
        $room_form.="roomNo: <input type=\"number\" name=\"roomNo\" class=\"form-control\"  /><br/>";       
        $room_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"create\" />";
        $room_form.="</form>";
        $room_form.="</fieldset>";
        
        
        
        //$room_form.= echo insert_room_form();
       // echo $room_form;
        
        
        $delete_room_form = "<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $delete_room_form.="<legend>Delete room</legend>";
        $delete_room_form.="hotel: " . $row->hotel_name . " <form method =\"post\" action=\"delete_room.php\">";
        $delete_room_form.="<input type=\"number\" name=\"hotel_id\" style=\"display:none\" value=\"$row->hotel_id\"  />";

        $deletesql = " SELECT * FROM rooms WHERE hotel_id='$hotel_id'";
        //$bookingsql ="SELECT * FROM rooms WHERE hotel_id='$hotel_id'";
        $delete_room_form.="<select name=\"roomNo\" class=\"form-control\">";
        if ($object = $mysqli->query($deletesql)) {


            /* fetch object array */
            while ($obj = $object->fetch_object()) {
                $foundroom = "<option>" . $obj->room_no . "</option>";
                $found_room_id = $obj->room_id;
                $delete_room_form.="$foundroom";
            }
            /* free result set */
            $object->close();
        }
        
        $delete_room_form.="</select>";
        $delete_room_form.="<input type=\"number\" name=\"room_id\" style=\"display:none\" value=\"$found_room_id\"  />";
        
        //$booking_form.="roomNo: <input type=\"number\" name=\"roomNo\"  /><br/>";
        $delete_room_form.="<input type=\"date\" class=\"form-control\" style=\"display:none\" name=\"from\" value=\"$from_date\" >";
        $delete_room_form.="<input type=\"date\" class=\"form-control\" style=\"display:none\" name=\"to\" value=\"$to_date\" >";

        $delete_room_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"delete room\" />";
        $delete_room_form.="</form>";
        $delete_room_form.="</fieldset>";
        
        
          $booking_form_admin = "<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $booking_form_admin.="<legend>New booking</legend>";
        $booking_form_admin.="hotel: " . $row->hotel_name . " <form method =\"post\" action=\"room_state.php\">";
        $booking_form_admin.="<input type=\"number\" name=\"hotel_id\" style=\"display:none\" value=\"$row->hotel_id\"  />";
        $bookingsql = " SELECT * FROM rooms WHERE hotel_id='$hotel_id' AND rooms.room_no NOT IN ( 
        select fk_room_no from bookings where from_time between'$from_date' AND '$to_date'
        OR
        to_time BETWEEN '$from_date' AND '$to_date'
        )";
        //$bookingsql ="SELECT * FROM rooms WHERE hotel_id='$hotel_id'";
        $booking_form_admin.="<select name=\"roomNo\" class=\"form-control\">";
        if ($object = $mysqli->query($bookingsql)) {

            
            /* fetch object array */
            while ($obj = $object->fetch_object()) {
                $foundhotel = "<option>" . $obj->room_no . "</option>";
                $found_room_id = $obj->room_id;
                $booking_form_admin.="$foundhotel";
            }
            /* free result set */
            $object->close();
        }
        
        $booking_form_admin.="</select>";
        $booking_form_admin.="state:<input type=\"radio\" name=\"state\" value=\"3\">Cleaning <input type=\"radio\" name=\"state\" value=\"4\">Repair<br/>";
        $booking_form_admin.="<input type=\"number\" name=\"room_id\" style=\"display:none\" value=\"$found_room_id\"  />";
        //$booking_form.="roomNo: <input type=\"number\" name=\"roomNo\"  /><br/>";
        $booking_form_admin.="<input type=\"date\" class=\"form-control\" style=\"display:none\" name=\"from\" value=\"$from_date\" >";
        $booking_form_admin.="<input type=\"date\" class=\"form-control\" style=\"display:none\" name=\"to\" value=\"$to_date\" >";

        $booking_form_admin.="<input class=\"btn btn-primary\" type=\"submit\" value=\"Change state\" />";
        $booking_form_admin.="</form>";
        $booking_form_admin.="</fieldset>";
    function showAllComments($mysqli){
	$result = $mysqli->query( "select * from comments" );
	while ( $row = $result->fetch_row() ){
		echo "<div class=\"booking\"> <br><p>Comment : $row[1]  [<a href='deleteComment.php?action=deleteComment&id=$row[0]'>"." Delete "." </a>]  \n </div>";
	}
}
          
       // 
    } else {

        $booking_form = "<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $booking_form.="<legend>New booking</legend>";
        $booking_form.="hotel: " . $row->hotel_name . " <form method =\"post\" action=\"bookroom.php\">";
        $booking_form.="<input type=\"number\" name=\"hotel_id\" style=\"display:none\" value=\"$row->hotel_id\"  />";
        $bookingsql = " SELECT * FROM rooms WHERE hotel_id='$hotel_id' AND rooms.room_no NOT IN ( 
        select fk_room_no from bookings where from_time between'$from_date' AND '$to_date'
        OR
        to_time BETWEEN '$from_date' AND '$to_date'
        )";
        //$bookingsql ="SELECT * FROM rooms WHERE hotel_id='$hotel_id'";
        $booking_form.="<select name=\"roomNo\" class=\"form-control\">";
        if ($object = $mysqli->query($bookingsql)) {

            
            /* fetch object array */
            while ($obj = $object->fetch_object()) {
                $foundroom = "<option>" . $obj->room_no . "</option>";
                $found_room_id = $obj->room_id;
                $booking_form.="$foundroom";
            }
            /* free result set */
            $object->close();
        }
        
        $booking_form.="</select>";
        $booking_form.="<input type=\"number\" name=\"room_id\" style=\"display:none\" value=\"$found_room_id\"  />";
        //$booking_form.="roomNo: <input type=\"number\" name=\"roomNo\"  /><br/>";
        $booking_form.="<input type=\"date\" class=\"form-control\" style=\"display:none\" name=\"from\" value=\"$from_date\" >";
        $booking_form.="<input type=\"date\" class=\"form-control\" style=\"display:none\" name=\"to\" value=\"$to_date\" >";

        $booking_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"Book\" />";
        $booking_form.="</form>";
        $booking_form.="</fieldset>";
 
        
        function showAllComments($mysqli){
	$result = $mysqli->query( "select * from comments" );
	while ( $row = $result->fetch_row() ){
		echo "<div class=\"booking\"> <br><p>Comment: $row[1] </p> \n </div>";
	}
}
        //echo $booking_form;
        //echo "<a href=\"home.php\">back</a>";
    }
    
    
       function comment_form($post_id) {
         include 'DbConnection.php';
        $comment_form = "<form method=\"post\" action=\"process_insert_comment.php\">";
        $comment_form .="<div class=\"box\">";
        $comment_form .="<br /><textarea name=\"comment\" class=\"form-control\" placeholder=\"Comment...\" cols=\"20\" rows=\"2\">";
        $comment_form .="</textarea>";
        $comment_form .="<input type=\"hidden\" name=\"p_id\" value=\"$post_id\">";
        $comment_form .="<input type=\"submit\" class=\"btn btn-primary\" value=\"Save Comment\">";
        $comment_form .="</div>";
        $comment_form.="</form>";
        return $comment_form;
    }
    
     
}


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
                    
                    <?php 
                    echo $foundhotel;
                    echo showAllComments($mysqli);
                    echo comment_form($post_id);
                    echo $room_form;
                    echo $booking_form;
                    echo $delete_room_form;
                    echo $booking_form_admin;
                    
                        
                    ?>
                    
                    <form action="?action=unsetUsername" method="post">
                        <input type="submit" class="btn btn-primary" value="Logout <?php echo $username ?>">
                    </form>
                    <a href="admin_home.php?action=displayHotels"
                </div>


            </div>


        </div> <!--end of container-->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="bank.js"></script>

    </body>



</html>


