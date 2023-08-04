<?php include_once("config.php");
	$vdivid = $_POST['item_id'];    
	$modulename = $_POST['module_name'];    
		// first check if the vdivid has a child if it has a child then return to the user and tell them to delete the child first then delete the parent 
	$checkChildSql="SELECT * FROM `dznr_module_fields` WHERE `parent_grid_id`= $vdivid";
	$res=mysqli_query($dbcon,$checkChildSql);
	$count=mysqli_num_rows($res);
	if($count==0){
		$sqlexist = "delete from dznr_module_fields where divid = '".$vdivid."' and module_name = '".$modulename."' ";
		if(mysqli_query($dbcon, $sqlexist)){
			echo 'success';
		}else{
			echo 'fail';
		}
	}else{
		echo "3";// this message represents that a child exists in the database
	}
	
	
	
?>

