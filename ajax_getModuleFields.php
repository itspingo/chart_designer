<?php
include_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
     $output='<option value="">--Select an Option--</option>';
    $moduleId=$_POST['moduleId'];
    $sqlApp = "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$moduleId";
	$resApp = mysqli_query($dbcon, $sqlApp);
	
	while( $rowApp=mysqli_fetch_assoc($resApp)){

		$output.="
			<option value='".$rowApp['id']."'>".
				$rowApp['field_label']."
			</option>";
		}
echo $output;	
} else {
    // Request method is not GET
    echo 'This is not a Post request.';
}
