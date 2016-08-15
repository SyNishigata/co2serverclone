<html>
<head>
<meta name="robots" content="noindex, nofollow">
<style>
#verify { font-size:4em; text-align:center; font-weight:bold; color: #444; letter-spacing: -3px ; font-family: arial, sans-serif; }
</style>
</head>
<body id="verify">

<?php

header( "refresh:5;url=http://www.ronlum.com/aabbcc/" );

// $srv = "localhost";
// $usr = "ronthewebsiteguy";
// $pwd = "3FigNewtons";
// $dbn = "cbn";

$srv = "localhost";
$usr = "root";
$pwd = "";
$dbn = "cbn";

//creat connection
$conn = new mysqli ($srv, $usr, $pwd, $dbn);

//check conncetion
if ($conn->connect_error) :
	die("connection failed: " .$conn->connect_error);
endif;

//insert SQL query
$sql = "INSERT INTO groups (/*group_id, */group_name, group_admin, group_privacy,group_location) VALUES ('".$_POST["name"]."','".$_POST["admin"]."','".$_POST["privacy"]."','".$_POST["location"]."')";

if ($conn->query($sql) === TRUE) : 
	echo "new record created<br>";
else : 
	echo "error". $sql . "<br>" . $conn->error;
endif;


//insert SQL query which adds member to group
$sql2 = "INSERT INTO groups_members ( group_id, member_id) VALUES ('".$_POST["id"]."', '".$_POST["admin"]."')";


if ($conn->query($sql2) === TRUE) : 
	echo "creator admin added to member list";
else : 
	echo "error". $sql2 . "<br>" . $conn->error;
endif;


$conn->close();

?>

</body></html>