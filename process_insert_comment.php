<?php
include "functions.php";
include "DbConnection.php";

if(isset($_POST['p_id'])){
	$p_id=$_POST['p_id'];
	$comment=$_POST['comment'];
	$insert_comment_sql="INSERT INTO comments 
	(comment_id,comment,p_id)
	VALUES ('','$comment','$p_id')";
	//insert the new post using the $db object
if ($mysqli->query($insert_comment_sql)) {
     
    $message = "your comment has been posted - logging you out.";
        echo "<script type='text/javascript'>alert('$message');</script>";
  header("location: index.php");
}
}
?>