<?php


	if($_GET['rid'] != ''){
		
	
		$sqlschd = " select s.id, concat(s.schedule_code,':',s.schedule_type,',CP:',s.clinical_personnel) as title, date(s.schedule_datetime) as start 
		from ehca_schedule s, ehca_employees e
		where s.empid = e.id
		  and s.empid = '".$_GET['empid']."' ";
		
	}

    $result = mysqli_query($dbcon, $sqlschd);     
    
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
