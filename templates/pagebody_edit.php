<?php   
/*
*
* This file was initially generated by snoobix.com designer.
*
* snoobix.com is an open source project that gives you opportunity to make 
* fully functional database applications.
*
* For further enhancements and modifications according to your needs,
* Please contact us at support@snoobix.com
*
*/
if(group_access_rights($clientid, $usrid, $usrtype, $applicname, "#modulename", 'edit') != 1) {
	$_SESSION['error']="Insufficient Privileges";
	///header('Location: ' . $_SERVER['HTTP_REFERER']); exit;
}
$error=array();

if($_POST['continue'] == 'Y' AND $_POST['formname'] = "#pagename"){

	$id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : '';
	#assignment_script
	
	if(count($error)==0){

		#update_script

	if($res){
		$errmsg = "Record is updated successfully";
		#fileupload
	}else {
		$errmsg = "Record is NOT updated successfully, try again later.";
	}
	//die();
	}
}

if((isset($_POST['eid'][0])) ? $_POST['eid'][0] :((isset($_POST['id'])) ? $_POST['id'] :((isset($_GET['id'])) ? $_GET['id'] :'')) != ''){
	$colname_rs = (isset($_POST['eid'][0])) ? $_POST['eid'][0] :((isset($_POST['id'])) ? $_POST['id'] : ((isset($_GET['id'])) ? $_GET['id'] :''));

	$query = "SELECT * FROM #tablename WHERE  id ='".$colname_rs."'";
	//echo $query; 
	$result = mysqli_query($dbcon, $query);
	$row = mysqli_fetch_array($result);
	// if(mysqli_num_rows($result)==0){
		// header("location:pages.php");exit;
	// }
	
	$id=$row['id'];
	#fetchdata_script
	
}	

?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid sticky-sidebar sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid sticky-top sticky-sidebar sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid sticky-top sticky-sidebar sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid sticky-top sticky-sidebar sidebar"> <![endif]-->
<!--[if !IE]><!-->
<html class="fluid sticky-top sticky-sidebar sidebar" xmlns="http://www.w3.org/1999/xhtml"><!-- <![endif]-->

<head>
<?php include('header.php'); ?>

<script>

$(document).on('focus',".date_input", function(){
    $(this).datepicker();
});

function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	}


function golistingpage(){
		window.location = "modl.php?scrn=#listfilelink";
}

	
function saveinfo(){
	//alert('saveinfo function is called');
	var iserror = 0;
	var fail = false;
    var fail_log = '';
	
	$( '#frm' ).find( 'select, textarea, input' ).each(function(){
		if( ! $( this ).prop( 'required' )){

		} else {
			if ( ! $( this ).val() ) {
				fail = true;
				name = $( this ).attr( 'name' );
				
				document.getElementById('diverror_'+name).innerHTML  = '<p style="color:red;font-size:12px;">This item cannot be left blank</p>';
				
				field = name.replace("_"," ");
				fail_log += "'"+field+"'" + " is required \n";
				iserror = 1;
			}
		}
	});
	
	
	
	if(iserror==0){
		document.getElementById("frm").submit();
	}else{
		//alert('Please rectify the errors before saving the record');
		alert( fail_log );
	}
}

	
</script>

<link rel="stylesheet" href="jquery-ui.min.css" />
			  
</head>


<body class="">
	
	<script src="jquery.min.js"></script>
	<script src="jquery-ui.min.js"></script>

	
	<?php include('lov_popups.php'); ?>

		<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">
		
				<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">
					
		<?php include('sidebar.php'); ?>		
		<?php include('topmenu.php'); ?>
				
	<ul class="breadcrumb">
	<li>You are here</li>
	<li><a href="modl.php?scrn=dashboard.php" class="glyphicons dashboard"><i></i> <?php echo TITLE; ?></a></li>
	<li class="divider"></li>
	<li><?php echo APPLICATIONAME; ?></li>	<li class="divider"></li>
	<li>#modulename - Edit</li>
</ul>

<h3>#modulename - Edit
	<div class="buttons pull-right">
		<a style="cursor:pointer;" class="btn btn-primary btn-icon glyphicons left_arrow" onClick="golistingpage()" ><i></i>Listing Page</a>
	</div>
</h3>
<div class="innerLR">
	
	<form method="POST" action="" name="frm" id="frm" ENCTYPE="multipart/form-data" >
	
	<!-- Row -->
	<div class="widget widget-heading-simple widget-body-white">
	<div class="widget-body">
	<div class="row-fluid">
	
	<?php   
		if($errmsg != ''){
			echo $errmsg;
		}else if($mesg != ''){
			echo $mesg;
		}  
	?>
			<!-- Column -->
			<div class="span4">
				<div class="innerL">
					
					#left_fields_list
					
					
				</div>
			</div>
			
			<div class="span4">
				<div class="innerL">
					
					#middle_fields_list
					
				</div>
			</div>
			
			<div class="span4">
				<div class="innerR">
					
					#right_fields_list

					
				</div>
			</div>
			
			<!-- // Column END -->
			
		</div>
		<!-- // Row END -->
		<div class="row-fluid">
			#bottom_fields_list
		</div>
	
		<input type="button" class="btn btn-block btn-success" onclick="saveinfo()"  <?php  if((!isset($_SESSION['keyvalid'])) OR  ($_SESSION['keyvalid'] != 'Valid')) {echo ' disabled '; }   ?>  value="Save Information" >
	</div>
	
	</div>
	<input type='hidden' name='continue' id='continue' value='Y' />
	<input type='hidden' name='id' id='id' value='<?php echo $id; ?>' />
	<input type='hidden' name='formname' id='formname' value='#pagename' />
	
	</form>
		
</div>	
	
		
		</div>
		<!-- // Content END -->
		
				</div>
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->
				
		<?php //include('footer.php'); ?>
		
	</div>
	<!-- // Main Container Fluid END -->
	

<?php include('themer.php'); ?>
	
</body>
</html>