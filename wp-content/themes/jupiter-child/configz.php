<?php

// $hostname='localhost';
// $username='ronthewebsiteguy';
// $password='3FigNewtons';
// $dbname='cbn';

//mysql_connect($hostname, $username, $password) OR DIE('Unable to connect to database! Please try again later.');
//mysql_select_db($dbname);

$hostname='localhost';
$username='root';
$password='';
$dbname='cbn';

$con=mysqli_connect($hostname, $username, $password);

mysqli_connect($hostname, $username, $password) OR DIE('Unable to connect to database! Please try again later.');
mysqli_select_db($con, $dbname);