<?php
ob_start();
include_once 'DbConnection.php';
$hotel_name = $_POST['hotel_name'];
$hotel_adress = $_POST['adress'];
$postal_code = $_POST['postal_code'];
$description = $_POST['description'];
$rooms = $_POST['rooms'];
$telephone = $_POST['telephone'];
/* $insert_post_sql="INSERT INTO user
  (userid, firstname, password)
  VALUES (null, '$name', '$pw',)"; */
if (isset($_FILES["image"])){
echo 'image go';
//check if the file is uploaded to the server correctly without errors 
	if($_FILES["image"]["error"]>0)
	{
		//show eventual errors
		$hotel_form = "<p> Error: " .$_FILES["image"]["error"] ." </p>";
	} else {
	
	//create short names of file variables 
	$tmp_name=$_FILES["image"]["tmp_name"];
	$filename=$_FILES["image"]["name"];
//        $path = realpath(dirname(__FILE__))."/userfiles2";
//        echo $path;
//	//chmod($path, 0777);
//        mkdir($path, 0777, true);
	//upload and save the file on the server in a subfolder called "userfiles"
	move_uploaded_file("$tmp_name","userfiles/$filename");
	$hotel_form .="<p> The file <i>$filename</i> is now stored in <i> userfiles </i></p>";
	
	//link to the uploaded file
	$hotel_form .="<p> Open <a href=\"userfiles/$filename\">$filename</a></p>";
        
$insert_post_sql = "INSERT INTO hotels
                    SET hotel_name='$hotel_name', hotel_adress='$hotel_adress', hotel_postal_code='$postal_code', hotel_img='$filename', description='$description', hotel_phone='$telephone', hotel_total_rooms='$rooms'
						";

        }
//update the post
if ($mysqli->query($insert_post_sql)) {
     $message = "hotel created - logging you out sir.";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: admin_home.php");
}else{
    echo 'something went wrong';
}
}



