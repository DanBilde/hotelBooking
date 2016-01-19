<?php
session_start();
ob_start();
include "DbConnection.php";
$username=$_SESSION['username'];
function editUser($mysqli,$id) {
	
	if ($id==0){
		$first_name = "";
		$last_name = "";
                $email = "";
                $password="";
		$admin = "";
                $blocked="";
		$formAction="insertUser";
	} 
	else {  $sql="select * from users where user_id=$id";
		$result = $mysqli->query($sql);
		while ($row = $result->fetch_row()) {
			$first_name = $row[1];
                        $last_name = $row[2];
			$email = $row[3];
			$password = $row[4];
                        $admin = $row[5];
                        $blocked= $row[6];
                        
			$formAction="updateUser";
		}
	}
	?>
        <div>
	<form action="?action=<?php echo $formAction?>" method="post">
            <p>first name</p><input name="first name" class="form-control" value="<?php echo $first_name?>">
                <p>last name</p><input name="last name" class="form-control" value="<?php echo $last_name?>">
		<p>email</p><input name="email" class="form-control" value="<?php echo $email?>"> 
		<p>password</p><input name="password" class="form-control" value="<?php echo $password?>">
                <p>admin</p><input name="admin" class="form-control" value="<?php echo $admin?>">
                <p>blocked</p><input name="blocked" class="form-control" value="<?php echo $blocked?>">
		<input name="id" type="hidden" value="<?php echo $id?>"> 
		<input class="btn btn-primary" type="submit">
	</form>
        </div>
	<?php
}

function updateUser($mysqli) {
                echo $_POST["first_name"];
                echo $_POST["last_name"];
                echo $_POST["email"];
                echo $_POST["password"];
                echo $_POST["admin"];
                echo $_POST["blocked"];
                echo $_POST["id"];
	$str = "update users set first_name='".$_POST["first_name"]."',".
                                        " last_name='".$_POST["last_name"]."',".
					" email='".$_POST["email"]."',". 
					" password='".$_POST["password"]."',".
                                        " admin='".$_POST["admin"]."',".
                                        " blocked='".$_POST["blocked"]."'". 
				" where user_id=".$_POST["id"];
	// cdump($str);
	$mysqli->query( $str );
}
/*
function insertUser($mysqli) {
	$str = "insert into users (name,email,password) values('".$_POST["name"]."',".
														"'".$_POST["email"]."',".
														"'".$_POST["password"]."')";
	// cdump($str);
	$mysqli->query( $str );
}
*/
function deleteUser($mysqli) {
	$str = "delete from users where user_id=" . $_GET["id"];
	//cdump($str);
	$mysqli->query( $str );
        header("location: admin_home.php?action=showUsers");
}



function showAllUsers($mysqli){
	$result = $mysqli->query( "select * from users" );
	while ( $row = $result->fetch_row() ) {
		echo "<div class=\"booking\"><br><p>first name: $row[1]</p><p>last name:  $row[2]</p><p>email: $row[3]</p> <p>password: $row[4]</p><p>admin: $row[5]</p> <p>blocked: $row[6]</p> [<a href='?action=editUser&id=$row[0]'>Edit</a>] [<a href='?action=deleteUser&id=$row[0]'>Delete</a>]\n</div>";
	}
	echo "<br><br><a class=\"btn btn-block btn-primary\" href='?action=createUser'>Create a new user</a>";
}

/*if (isset($_GET["action"])) {
	switch ($_GET["action"]) {
		case "createUser" :
			editUser($mysqli,0);
			break;		
		case "editUser" :
			editUser($mysqli,$_GET["id"]);
			break;
		case "updateUser" :
			updateUser($mysqli);
			break;			
		case "insertUser" :
			insertUser($mysqli);
			break;
		case "deleteUser" :
			deleteUser($mysqli);
			break;
	}
}*/


//showAllUsers($mysqli);
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


                <?php
                
                if (isset($_GET["action"])) {
	switch ($_GET["action"]) {
		case "createUser" :
			editUser($mysqli,0);
			break;		
		case "editUser" :
			editUser($mysqli,$_GET["id"]);
			break;
		case "updateUser" :
			updateUser($mysqli);
			break;			
		case "insertUser" :
			insertUser($mysqli);
			break;
		case "deleteUser" :
			deleteUser($mysqli);
			break;
                case "unsetUsername":
                                unset($_SESSION['username']);
                                unset($_SESSION['password']);
                                unset($_SESSION['admin']);
                                header("location: index.php");
                                break;
	}
}
                
                showAllUsers($mysqli);
                ?>
                    
                    <form action="?action=unsetUsername" method="post">
                        <input type="submit" class="btn btn-block btn-primary" value="Logout <?php echo $username; ?>">
                    </form>
                <a class="btn btn-block backbutton btn-primary" href="admin_home.php">back</a>
                    </div>


            </div>


        </div> <!--end of container-->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="bank.js"></script>

    </body>



</html>
