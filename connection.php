<?php

$server="localhost";
$user="root";
$passwd="";
$database="snoobix5";
$dbcon = mysqli_connect($server, $user, $passwd) or die("Could not connect : " . mysqli_error()); 
mysqli_select_db($dbcon, $database); 
//@mysqli_query($dbcon, "SET NAMES 'UTF8'");
 
?>