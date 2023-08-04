<?php  


if(group_access_rights($clientid, $usrid, $usrtype, $applicname, "#modulename", 'view') != 1) {
	$_SESSION['error']="Insufficient Privileges";
	//header('Location: ' . $_SERVER['HTTP_REFERER']); exit;
}


$colname_rs = $_GET['clid'];

// if((isset($_POST['eid'][0])) ? $_POST['eid'][0] :((isset($_POST['id'])) ? $_POST['id'] :'') != ''){
	// $colname_rs = (isset($_POST['eid'][0])) ? $_POST['eid'][0] :((isset($_POST['id'])) ? $_POST['id'] :'');
// }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 fluid sticky-sidebar sidebar"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 fluid sticky-top sticky-sidebar sidebar"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 fluid sticky-top sticky-sidebar sidebar"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8 fluid sticky-top sticky-sidebar sidebar"> <![endif]-->
<!--[if !IE]><!-->
<html class="fluid sticky-top sticky-sidebar sidebar" xmlns="http://www.w3.org/1999/xhtml"><!-- <![endif]-->

<head>
	
	
	<link rel='stylesheet' type='text/css' href='../../common/fullcalendar/fullcalendar.css' />
	<link rel='stylesheet' type='text/css' href='../../common/fullcalendar/fullcalendar.print.css' media='print' />
	<script type='text/javascript' src='../../common/jquery/jquery-1.8.1.min.js'></script>
	<script type='text/javascript' src='../../common/jquery/jquery-ui-1.8.23.custom.min.js'></script>
	<script type='text/javascript' src='../../common/fullcalendar/fullcalendar.min.js'></script>

<?php include('header.php'); ?>

	<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: false,
			events: "jsonevents.php?rid=<?php echo $colname_rs; ?>"
		});
		
	});


function goback(){
    //var empid = document.getElementById('empid');
	document.myfrm.action="dashboard.php";
	document.myfrm.submit();
}	
</script>

<style type='text/css'>

	
	#calendar2 {
		width: 1200px;
		margin: 0 auto;
		}


</style>

</head>
<body class="">
	
	

	
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
	<li><?php echo APPLICATIONAME; ?></li>	
	<li class="divider"></li>
	<li>#modulename</li>
</ul>

<h3>#modulename
<div align="center">
<input type="button" class="btn btn-primary" name="goback" id="goback" value="Dashboard" onclick="goback()">
</div>
</h3>


<div class="innerLR">
	
	<div class="row-fluid">
	<form method="POST" action="" name="myfrm" id="myfrm" ENCTYPE="multipart/form-data" >
		<input type="hidden" name="id" id="id" value="<?php echo $colname_rs; ?>" />
	</form>
	
	<div class="span12">
		<!-- Widget -->
		<div class="widget">
			<div class="widget-body">
				<div id="calendar"></div>
			</div>
		</div>
		<!-- // Widget END -->
	</div>
	
	
	</div>
	
</div>	
	
		
		</div>
		<!-- // Content END -->
		
				</div>
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->
				
	
		
	
	<!-- // Main Container Fluid END -->
	

<?php include('themer.php'); ?>


</body>
</html>