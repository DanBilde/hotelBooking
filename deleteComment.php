<?php
include 'DbConnection.php';
if(isset($_GET['action'])){
	switch ($_GET["action"]) {
		case "deleteComment" :
                    deleteComment($mysqli);
        	}
}
function deleteComment($mysqli) {
	$str = "delete from comments where comment_id=" . $_GET["id"];
	
	$mysqli->query( $str );
        $message = "your comment has been deleted - logging you out";
        echo $message;
        header("location: index.php");
}
?>
