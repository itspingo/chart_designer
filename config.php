<?php session_start(); ob_start(); 
error_reporting(E_ALL && ~E_WARNING && ~E_NOTICE);
//ini_set('date.timezone', 'Europe/London');
//date_default_timezone_set('Europe/London');

include_once("connection.php");
include_once("functions.php");
include_once("designer_functions.php");

	// $website = $_SERVER['SERVER_NAME'];
	// if($website == 'localhost'){
		// $curpath = "http://localhost:8080/snoobix";
	// }else{
		// $curpath = "http://snoobix.com";
	// }
	
// if( $_SESSION['clientid'] == ''){
	// header('location:'.$curpath.'/logout.php');
// }


// $usrid = $_SESSION['usrid'];
// $clientid  = (isset($_SESSION['clientid']) ? $_SESSION['clientid'] : ''); 
// $usrname  = (isset($_SESSION['uname']) ? $_SESSION['uname'] : '');  
// $usrtype  = (isset($_SESSION['usrtype']) ? $_SESSION['usrtype'] : '');  
// $applicname  = $_SESSION['applicname']; 

// $sqlaplid = "select * from applications where applicname = '".$applicname."'";			
// $resaplid = mysqli_query($dbcon, $sqlaplid);
// $rowaplic = mysqli_fetch_assoc($resaplid);
// $applicid = $rowaplic['id'];
// $applicname = 	$rowaplic['applicname'];
				
// define("LAST",'Last');
// define("FIRST",'First');
// define("PREV",'Prev');
// define("NEXT",'Next');

// define("TITLE","Snoobix");
// define("APPLICATIONAME",'Designer');


?>