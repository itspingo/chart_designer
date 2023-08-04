<?php
include_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $output='<option value="">--Select an Option--</option>';
     $AppId=$_POST['AppId'];
    $sqlApp = "SELECT * FROM sys_modules WHERE application_id=$AppId";
	$resApp = mysqli_query($dbcon, $sqlApp);
	while( $rowApp=mysqli_fetch_assoc($resApp)){

		$output.="
			<option value='".$rowApp['id']."'>".
				$rowApp['module_name']."
			</option>";
		}
echo $output;	
} 

else {
    // Request method is not GET
    echo 'This is not a Post request.';
}
