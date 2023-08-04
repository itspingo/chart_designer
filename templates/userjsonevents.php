<?php
include_once("../../config.php");

	if($_GET['rid'] != ''){
			$sqlcols = "select * from usercalendar where id = '".$_GET['rid']."'";
			$rescols = mysqli_query($dbcon, $sqlcols);
			$rowcols = mysqli_fetch_assoc($rescols);
	
		$sqlcal = "select ".$rowcols['col4descr']." as title , ".$rowcols['col4start']." as start , ".$rowcols['col4end']." as end from ".$rowcols['caltable']." where 1";
		
	}

    $result = mysqli_query($dbcon, $sqlcal);     
    
	$table = array();
	if (mysqli_num_rows($result) > 0) {
		$i = 0;
		while($i <= mysqli_num_rows($result)){
			$table[$i] = mysqli_fetch_assoc($result); 
			$i++;
			unset($table[$i]);                              
		}		
	}

	mysqli_free_result($result);

	echo json_encode($table);
?>
