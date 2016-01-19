<?php
include 'DbConnection.php';
//JESPER
function login_form1(){
	$log_form="Login: <form method =\"post\" action=\"login.php\">";
	$log_form.="email:<input class=\"form-control\" type=\"text\" name=\"email\" /> ";
	$log_form.="pass:<input class=\"form-control\" type=\"password\" name=\"pw\" />";
	$log_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"login\" />";
	$log_form.="</form>";

	return $log_form; 
	
}


function hotel_login(){
	$hotel_log_form="Login: <form method =\"post\" action=\"hotel_login.php\">";
	$hotel_log_form.="email:<input class=\"form-control\" type=\"text\" name=\"email\" /> ";
	$hotel_log_form.="pass:<input class=\"form-control\" type=\"password\" name=\"pw\" />";
	$hotel_log_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"login\" />";
	$hotel_log_form.="</form>";

	return $hotel_log_form; 
	
}

//JESPER
function insert_user_form(){
    
    
    if ($_SESSION['admin'] == "yes") {
        $user_form="<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $user_form.="<legend>New user</legend>";
        $user_form.="Login: <form method =\"post\" action=\"insert_user.php\">";
        $user_form.="firstname:<input class=\"form-control\" type=\"text\" name=\"firstname\" /> ";
        $user_form.="lastname:<input class=\"form-control\" type=\"text\" name=\"lastname\" /> ";
	$user_form.="email:<input class=\"form-control\" type=\"text\" name=\"email\" /> ";
	$user_form.="pass:<input class=\"form-control\" type=\"password\" name=\"pw\" />";
        $user_form.="admin?:<input type=\"radio\" name=\"rights\" value=\"yes\">Yes <input type=\"radio\" name=\"rights\" value=\"no\">No<br/>";
        
	$user_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"create\" />";
	$user_form.="</form>";
        $user_form.="</fieldset>";
        return $user_form;
    } else {
        
        
        
        
        
        $user_form="<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $user_form.="<legend>New user</legend>";
        $user_form.="Register: <form method =\"post\" action=\"insert_user.php\">";
        
        $user_form.="firstname:<input class=\"form-control\" type=\"text\" onkeyup=\"showHint(this.value)\" name=\"firstname\" /> ";
        
        $user_form.="<p>Suggestions: <span id=\"txtHint\"></span></p>";

        $user_form.="lastname:<input class=\"form-control\" type=\"text\" name=\"lastname\" /> ";
	$user_form.="email:<input class=\"form-control\" type=\"text\" name=\"email\" /> ";
	$user_form.="pass:<input class=\"form-control\" type=\"password\" name=\"pw\" />";
        
	$user_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"create\" />";
	$user_form.="</form>";
        $user_form.="</fieldset>";
        return $user_form;
    }
}

//JESPER
function insert_hotel_form(){
        $hotel_form="<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $hotel_form.="<legend>New hotel</legend>";
        $hotel_form.="hotel: <form method =\"post\" enctype=\"multipart/form-data\" action=\"insert_hotel.php\">";
        $hotel_form.="hotel name:<input class=\"form-control\" type=\"text\" name=\"hotel_name\" /> ";
        $hotel_form.="adress:<input class=\"form-control\" type=\"text\" name=\"adress\" /> ";
	$hotel_form.="postal_code:<input class=\"form-control\" type=\"text\" name=\"postal_code\" /> ";
	$hotel_form.="description:<input class=\"form-control\" type=\"text\" name=\"description\" />";
        $hotel_form.="rooms:<input class=\"form-control\" type=\"number\" name=\"rooms\" />";
        $hotel_form.="telephone:<input class=\"form-control\" type=\"tel\" name=\"telephone\" />";
        $hotel_form.="hotel image:<input class=\"form-control\" type=\"file\" name=\"image\" />";
        
	$hotel_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"create\" />";
	$hotel_form.="</form>";
        $hotel_form.="</fieldset>";
        return $hotel_form;
}

//JESPER
function insert_room_form(){
        $room_form="<fieldset style=\"border-radius: 5px; padding: 5px; min-height:100px;\">";
        $room_form.="<legend>New room</legend>";
        $room_form.="hotel: <form method =\"post\" action=\"insert_room.php\">";
        
        
	$room_form.="description:<input type=\"text\" name=\"description\" /><br/>";
        $room_form.="rooms:<input type=\"number\" name=\"rooms\" /><br/>";
        $room_form.="AC?:<input type=\"radio\" name=\"AC\" value=\"yes\">Yes <input type=\"radio\" name=\"AC\" value=\"no\">No>";
        
        
        
        
	$room_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"create\" />";
	$room_form.="</form>";
        $room_form.="</fieldset>";
        return $room_form;
}


//JESPER
function date_pick_form(){
    
                $search_form="<form method=\"post\" action=\"search.php\">";
                $search_form.="<select name=\"hotel\" class=\"form-control\">";
                $search_form.="<option>Fredensborg</option>";
                $search_form.="<option>salmon</option>";
                $search_form.="<option>beer</option>";
                $search_form.="</select>";
                $search_form.="from<input type=\"date\" name=\"from\">";
                $search_form.="to<input type=\"date\" name=\"to\">";
                $search_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"search\" />";
                $search_form.="</form>";
                return $search_form;
}
//JESPER
function hotels_from_db() {
    include 'DbConnection.php';
    $sql = "select * from hotels";

    if ($result = $mysqli->query($sql)) {

        /* fetch object array */
        while ($obj = $result->fetch_object()) {
            $foundhotel = "<h1>" . $obj->hotel_name . "</h1></br>";
            $foundhotel.= $obj->hotel_adress . "</br>";
            $foundhotel.= $obj->hotel_postal_code . "</br>";
            $foundhotel.= $obj->description;
            echo "$foundhotel";        
        }

        /* free result set */
        $result->close();
    }
}
//JESPER
function hotels_from_db_picker() {
    include 'DbConnection.php';
    $user_rights = $_SESSION['admin'];
    $sql = "select * from hotels";
    if($user_rights=='no'){
    $search_form = "<form method=\"post\" action=\"search.php\">";
    $search_form.="<select name=\"hotel\" class=\"form-control\">";
    if ($result = $mysqli->query($sql)) {

        /* fetch object array */
        while ($obj = $result->fetch_object()) {
            $foundhotel = "<option>" . $obj->hotel_name . "</option>";

            $search_form.="$foundhotel";
        }

        /* free result set */
        $result->close();
    }

    $search_form.="</select>";
    $search_form.="from<input class=\"form-control\" type=\"date\" name=\"from\">";
    $search_form.="to<input class=\"form-control\" type=\"date\" name=\"to\">";
    $search_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"search\" />";
    $search_form.="</form>";
    return $search_form;
    
    }else{
        $search_form = "<form method=\"post\" action=\"search.php\">";
    $search_form.="<select name=\"hotel\" class=\"form-control\">";
    if ($result = $mysqli->query($sql)) {

        /* fetch object array */
        while ($obj = $result->fetch_object()) {
            $foundhotel = "<option>" . $obj->hotel_name . "</option>";

            $search_form.="$foundhotel";
        }

        /* free result set */
        $result->close();
    }

    $search_form.="</select>";
    $search_form.="from<input class=\"form-control\" type=\"date\" name=\"from\">";
    $search_form.="to<input class=\"form-control\" type=\"date\" name=\"to\">";
    
    $search_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"search\" />";
    $search_form.="</form>";
    return $search_form;
    }
    
        }

//JESPER
function show_bookings_least() {
    include 'DbConnection.php';
    $sql = "SELECT * FROM rooms ORDER BY times_booked ASC LIMIT 10";
    if ($result = $mysqli->query($sql)) {
        $foundbooking = "";
        /* fetch object array */
        while ($obj = $result->fetch_object()) {
            $foundbooking.= "<div class=\"booking\"><p>hotel id: " . $obj->hotel_id . "</p>";
            $foundbooking.= "<p>room no:" . $obj->room_no . "</p>";
            $foundbooking.= "<p>times booked: " . $obj->times_booked . "</p></div>";
            
                     
        }

        /* free result set */
        $result->close();
    }
     return $foundbooking;
}
//JESPER
function show_bookings_top() {
    include 'DbConnection.php';
    $sql = "SELECT * FROM rooms ORDER BY times_booked DESC LIMIT 10";
    if ($result = $mysqli->query($sql)) {
        $foundbooking = "";
        /* fetch object array */
        while ($obj = $result->fetch_object()) {
            $foundbooking.= "<div class=\"booking\"><p>hotel id: " . $obj->hotel_id . "</p>";
            $foundbooking.= "<p>room no:" . $obj->room_no . "</p>";
            $foundbooking.= "<p>times booked: " . $obj->times_booked . "</p></div>";
            
                     
        }

        /* free result set */
        $result->close();
    }
     return $foundbooking;
}
//JESPER
function show_bookings_mine() {
    include 'DbConnection.php';
    $user_id = $_SESSION['id'];
    //$sql = "SELECT * FROM bookings WHERE user_id = $user_id";
    $sql ="SELECT * FROM bookings INNER JOIN hotels ON bookings.hotel_id = hotels.hotel_id WHERE bookings.user_id = $user_id";
    
    
    if ($result = $mysqli->query($sql)) {
        $foundbooking = "";
        /* fetch object array */
        while ($obj = $result->fetch_object()) {
            
            
            $foundbooking.= "<div class=\"booking\"><p>hotel name: " . $obj->hotel_name . "</p>";
            $foundbooking.= "<p>room no: " . $obj->fk_room_no . "</p>";
            $foundbooking.= "<p>room adress: " . $obj->hotel_adress . "</p>";
            $foundbooking.= "<p>postal code: " . $obj->hotel_postal_code . "</p>";
            $foundbooking.= "<p>booked from: " . $obj->from_time . "</p>";
            $foundbooking.= "<p>booked to: " . $obj->to_time . "</p>";
            $foundbooking.= "<form method=\"post\" action=\"delete_booking.php\">";
            $foundbooking.= "<input type=\"num\" name=\"booking_id\" style=\"display:none\" value=\"$obj->booking_id\">";
            $foundbooking.="<input class=\"btn btn-primary\" type=\"submit\" value=\"delete\" />";
            $foundbooking.= "</form></div>";
                     
        }

        /* free result set */
        $result->close();
    }
     return $foundbooking;
}
//JESPER
function show_room_bookings() {
    include 'DbConnection.php';
    $sql = "select * from rooms";

    $search_form = "<form method=\"post\" action=\"bookings_of_a_room.php\">";
    $search_form.="<select name=\"room\" class=\"form-control\">";
    if ($result = $mysqli->query($sql)) {

        /* fetch object array */
        while ($obj = $result->fetch_object()) {
            $foundhotel = "<option>" . $obj->room_no . "</option>";

            $search_form.="$foundhotel";
        }

        /* free result set */
        $result->close();
    }

    $search_form.="</select>";
    
    $search_form.="<input class=\"btn btn-primary\" type=\"submit\" value=\"search by Room No:\" />";
    $search_form.="</form>";
    return $search_form;
}

//USING A VIEW HERE**************************//JESPER
function getNonAdmins(){
    include 'DbConnection.php';
    $sql ="SELECT * FROM getallnonadmin";
    if ($result = $mysqli->query($sql)) {
        $founduser="";
        while ($obj = $result->fetch_object()) {
            
            $founduser.= "<div class=\"booking\"><p>first name: " . $obj->first_name . "</p>";
            $founduser.= "<p>Last name: " . $obj->last_name . "</p>";
            $founduser.= "<p>Email: " . $obj->email . "</p>";
            //$founduser.= "<p>Admin rights: " . $obj->admin . "</p>";
            $founduser.= "<p>Blocked: " . $obj->blocked . "</p>";  
            $founduser.="<p>admin: " . $obj->admin . "</p>";
            
            $founduser.= "<form method=\"post\" action=\"formhandler.php\">";
            $founduser.= "<input type=\"num\" name=\"user_id\" style=\"display:none\" value=\"$obj->user_id\">";
            $founduser.= "<input type=\"text\" name=\"user_rights\" style=\"display:none\" value=\"no\" />";
            $founduser.="<input class=\"btn btn-primary\" type=\"submit\" value=\"Edit\" />";
            $founduser.= "</form>";
            if($obj->blocked == "no"){
            $founduser.= "<form method=\"post\" action=\"block_user.php\">";
            $founduser.= "<input type=\"num\" name=\"user_id\" style=\"display:none\" value=\"$obj->user_id\">";
            $founduser.="<input class=\"btn btn-primary\" type=\"submit\" value=\"Block User\" />";
            $founduser.= "</form></div>";
            }else{
                $founduser.="</div>";
            }
            
            
        }
        //free result set
        $result->close();
    }
    return $founduser;
    
    
}

//USING STORED PROCEDURE HERE**************//JESPER
function getAllAdmins(){
    include 'DbConnection.php';
    $sql ="CALL `getAllAdmins`()";
    if ($result = $mysqli->query($sql)) {
        $foundadmin ="";
        while ($obj = $result->fetch_object()) {
            $foundadmin.= "<div class=\"booking\"><p>first name: " . $obj->first_name . "</p>";
            $foundadmin.= "<p>Last name: " . $obj->last_name . "</p>";
            $foundadmin.= "<p>Email: " . $obj->email . "</p>";
            $foundadmin.= "<p>Admin rights: " . $obj->admin . "</p>";
            $foundadmin.= "<p>Blocked: " . $obj->blocked . "</p>"; 
           
            
            $foundadmin.= "<form method=\"post\" action=\"make_admin.php\">";
            $foundadmin.= "<input type=\"num\" name=\"user_id\" style=\"display:none\" value=\"$obj->user_id\">";
            $foundadmin.= "<input type=\"text\" name=\"user_rights\" style=\"display:none\" value=\"$obj->admin\">";
            $foundadmin.="<input class=\"btn btn-primary\" type=\"submit\" value=\"Remove admin rights\" />";
            $foundadmin.= "</form>";
            if($obj->blocked == "no"){
            $foundadmin.= "<form method=\"post\" action=\"block_user.php\">";
            $foundadmin.= "<input type=\"num\" name=\"user_id\" style=\"display:none\" value=\"$obj->user_id\">";
            $foundadmin.="<input class=\"btn btn-primary\" type=\"submit\" value=\"Block User\" />";
            $foundadmin.= "</form></div>";
            }else{
                $foundadmin.="</div>";
            }
           
        }
         $result->close();
        }
        return $foundadmin;
    }
