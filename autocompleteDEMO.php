<?php

$q=$_GET['q'];

//call DATABASE, and ask for this name(s)
$mysqli_connection=mysqli_connect("localhost","root","","modul2");

//if($mysql_connection->errno !=0){
//echo $mysqli_conn->error;
//} else {
//    echo "DB connection is fine.";
//}
$names=array();
$sql="SELECT name FROM names WHERE name LIKE '$q%'";
$result = mysqli_query($mysqli_connection,$sql);

$xml = new SimpleXMLElement('<xml/>');
while($row = mysqli_fetch_assoc($result)){
    $xml->addChild("name",$row['name']);
}

header('Content-type:text/xml');
print($xml->asXML());



