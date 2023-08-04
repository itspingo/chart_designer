<?php include_once("config.php");

$divid =  $_POST["divid"];

$sqldb="update dznr_module_fields set 
			action = 'delete'
		where divid = '".$divid."'";

//echo $sqldb;
mysqli_query($dbcon, $sqldb);

			
?>