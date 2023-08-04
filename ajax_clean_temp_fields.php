<?php include_once("config.php");

$clientid = '10' ;

	$sqlclean = "delete from dznr_module_fields where clientid = '".$clientid."' ";
	$resclean = mysqli_query($dbcon, $sqlclean);



?>