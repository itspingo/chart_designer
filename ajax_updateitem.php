
<?php include_once("config.php");

	$vdivid = $_POST["vdivid"];  
	$vchart_type = $_POST["vchart_type"];    
	
	$vChart_title = $_POST["vChart_title"];  
	$vXTitle = $_POST["vXTitle"];  
	$vYTitle = $_POST["vYTitle"]; 
	$vApplicationId = $_POST["vApplicationId"];  
	$vModuleId = $_POST["vModuleId"]; 
	$vXcolumnId = $_POST["vXcolumnId"];  
	$vYcolumnId = $_POST["vYcolumnId"]; 
	$isActive = $_POST["isActive"];

    $vlabel_colors = $_POST['vlabel_colors'];
	$chart_background = $_POST['chart_background'];
	$vcolors = $_POST["vcolors"];
	$vdatalabels = $_POST["vdatalabels"];
	$vdatalabel_colors = $_POST["vdatalabel_colors"];
	$vmarkers = $_POST["vmarkers"];
	$vmarker_size = $_POST["vmarker_size"];
	$vmarker_colors = $_POST["vmarker_colors"];
	$vmarker_shape = $_POST["vmarker_shape"];
	$vstrokeStyle = $_POST['vstrokeStyle'];
	$vstroke_colors = $_POST['vstroke_colors'];
	$vstroke_width = $_POST['vstroke_width'];
	$vchart_toolbar_show = $_POST["vchart_toolbar_show"];
	$vchart_shadow_enabled = $_POST["vchart_shadow_enabled"];

    $vbar_horizontal = $_POST['vbar_horizontal'];
    $vbar_radius = $_POST['vbar_radius'];





		
	$sqlexist = "select count(1) as recs from sys_charts where divid = '".$vdivid."' ";
	$resexist = mysqli_query($dbcon, $sqlexist);
	$rowexist = mysqli_fetch_assoc($resexist);
	
	if($rowexist['recs'] == 0){
		$sqlinsrt = "INSERT INTO sys_charts
		(divid,chart_type, chart_title,  label_x, label_y, application_id, module_id, data_column_id_x, data_column_id_y,  active) 
		VALUES ('".$vdivid."','".$vchart_type."','".$vChart_title."','".$vXTitle."','".$vYTitle."','".$vApplicationId."','".$vModuleId."','".$vXcolumnId."','".$vYcolumnId."','".$isActive."')";
			
		$resinsrt = mysqli_query($dbcon, $sqlinsrt);
		if($resinsrt){
			$lastInsertedID = mysqli_insert_id($dbcon);
			$sqlinsrt2="INSERT INTO `sys_chart_properties`( `sys_chart_id`, `label_colors` ,`chart_background`, `chart_shadow_enabled`, `chart_tooblbar_show`, `colors`, `datalabel_colors`, `datalabel_enabled`, `stroke_curve`,`stroke_colors`,`stroke_width`,`markers_enabled`, `markers_size`, `marker_colors`, `marker_shape`,`bar_horizontal`,`bar_radius`) VALUES ('".$lastInsertedID."','".$vlabel_colors."','".$chart_background."','".$vchart_shadow_enabled."','".$vchart_toolbar_show."','".$vcolors."','".$vdatalabel_colors."','".$vdatalabels."','".$vstrokeStyle."','".$vstroke_colors."','".$vstroke_width."','".$vmarkers."','".$vmarker_size."','".$vmarker_colors."','".$vmarker_shape."','".$bar_horizontal."','".$vbar_radius."')";
			//echo $sqlinsrt2;
			$resinsrt2 = mysqli_query($dbcon, $sqlinsrt2);
		}
			
	}else{
	
		$sqlupdt="UPDATE `sys_charts` SET 
		chart_title='".$vChart_title."',
		chart_type='".$vchart_type."',
		label_x='".$vXTitle."',
		label_y='".$vYTitle."',
		application_id='".$vApplicationId."',
		module_id='".$vModuleId."',
		data_column_id_x='".$vXcolumnId."',
		data_column_id_y='".$vYcolumnId."',
		active='".$isActive."' 
		where divid = '".$vdivid."' ";
		//echo $sqlupdt;
		$resupdt=mysqli_query($dbcon, $sqlupdt);
		if ($resupdt) {
    
   
   $grabchart = mysqli_query($dbcon, "SELECT id FROM `sys_charts` WHERE divid = '$vdivid'");
$grabChartId = mysqli_fetch_assoc($grabchart)['id'];
    $sqlupdate2 = "UPDATE `sys_chart_properties` SET 
    			  `label_colors` = '" . $vlabel_colors . "',
                  `chart_background` = '" . $chart_background . "',
                  `chart_shadow_enabled` = '" . $vchart_shadow_enabled . "',
                  `chart_tooblbar_show` = '" . $vchart_toolbar_show . "',
                  `colors` = '" . $vcolors . "',
                  `datalabel_colors` = '" . $vdatalabel_colors . "',
                  `datalabel_enabled` = '" . $vdatalabels . "',
                  `stroke_curve` = '" . $vstrokeStyle . "',
                  `stroke_colors` = '" . $vstroke_colors . "',
                  `stroke_width` = '" . $vstroke_width . "',
                  `markers_enabled` = '" . $vmarkers . "',
                  `markers_size` = '" . $vmarker_size . "',
                  `marker_colors` = '" . $vmarker_colors . "',
                  `marker_shape` = '" . $vmarker_shape . "',
                  `bar_horizontal` = '".$vbar_horizontal."',
                  `bar_radius` = '".$vbar_radius."'
                  WHERE `sys_chart_id` = '".$grabChartId."'";
                  //echo $sqlupdate2;
    $resupdate2 = mysqli_query($dbcon, $sqlupdate2);
}







	}
		
	
?>



<?php if($vchart_type=='line_basic'){ 
     
     //grab the table name from module id
	 $moduleTable = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT table_name FROM sys_modules WHERE id= '".$vModuleId."' "));
	 $moduleTable =$moduleTable['table_name'];

	 // grab the coloum name from module field id
	 $columnX = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vXcolumnId."' "));
	 $columnX =$columnX['field_name'];
	 $columnY = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vYcolumnId."' "));
	 $columnY =$columnY['field_name'];

	
		// create a query

	 $sqlgraph=mysqli_query($dbcon,"SELECT $columnX, $columnY FROM $moduleTable ");
	 $jsonEncodeX="";
	 $jsonEncodeY="";
	 while ($sqlres=mysqli_fetch_assoc($sqlgraph)) {

	 	 $jsonEncodeX .= '"' . $sqlres[$columnX] . '",';
        $jsonEncodeY .='"' .  $sqlres[$columnY] . '",';

	 }

$jsonEncodeX = rtrim($jsonEncodeX, ",");
$jsonEncodeY = rtrim($jsonEncodeY, ",");


	?>

			<span>
					<span class="row">						
						<span id="<?php echo 'controls_'.$vdivid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;" align="right" >
							<a style="cursor:pointer;color:blue;"  onClick="showattribs('line_basic', <?php echo $vdivid; ?>)" ><i class="bi bi-gear"></i></a>	
							<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $vdivid; ?>)" ><i class="bi bi-trash"></i></a>
							
						</span>
					</span>
					<span class="row">
						<span class="col-12 float-left" id="<?php echo 'label_'.$vdivid; ?>" >
							<span  id="line_basic2" style="display: block;"></span>
						</span>
					</span>
				</span>

				  <script>
var options = {
      chart: {
        type: 'line',
        height: 350,
        background: '<?php echo $chart_background; ?>',
        toolbar: {
        show: <?php echo $vchart_toolbar_show ? "true" : "false"; ?>, 
      	},
      	dropShadow: {
	      enabled: <?php echo $vchart_shadow_enabled ? "true" : "false"; ?>,
	    },
      },
      series: [
      {
        name: '<?php echo $vYTitle; ?>',
        data: [<?php echo $jsonEncodeY; ?>]
      },
      ],
      
      colors: [<?php echo $vcolors; ?>] ,
      stroke: {
          curve: '<?php echo $vstrokeStyle  ?>',
        },
     dataLabels:
     {
    	enabled: <?php echo $vdatalabels ? "true" : "false"; ?>,
    	style:{
    		colors:[<?php echo $vdatalabel_colors  ?>],
    	}
	 },
	 markers: {
	 	  show: <?php echo $vmarkers ? "true" : "false"; ?>,
          <?php if($vmarker_size!=''){  echo "size:".$vmarker_size.","; }  ?>
          colors: [<?php echo $vmarker_colors  ?>],
          shape: '<?php echo $vmarker_shape  ?>',
        },
      xaxis: {
        categories: [<?php echo $jsonEncodeX; ?>],
        title: {
        	text: '<?php echo $vYTitle; ?>',
        	style: { color: "<?php echo $vlabel_colors; ?>",   },
        },
        labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
      },        
      yaxis: {
          title: {
          	text: '<?php echo $vXTitle; ?>',
      		style: { color: "<?php echo $vlabel_colors; ?>",   },
      	},
           labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
      },

      

      
    };

    var chart = new ApexCharts(document.querySelector("#line_basic2"), options);
    chart.render();
      		</script>
			
			
 <?php }


else if($vchart_type=='area_basic'){ 
     
     //grab the table name from module id
	 $moduleTable = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT table_name FROM sys_modules WHERE id= '".$vModuleId."' "));
	 $moduleTable =$moduleTable['table_name'];

	 // grab the coloum name from module field id
	 $columnX = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vXcolumnId."' "));
	 $columnX =$columnX['field_name'];
	 $columnY = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vYcolumnId."' "));
	 $columnY =$columnY['field_name'];

	
		// create a query

	 $sqlgraph=mysqli_query($dbcon,"SELECT $columnX, $columnY FROM $moduleTable ");
	 $jsonEncodeX="";
	 $jsonEncodeY="";
	 while ($sqlres=mysqli_fetch_assoc($sqlgraph)) {

	 	 $jsonEncodeX .= '"' . $sqlres[$columnX] . '",';
        $jsonEncodeY .='' .  $sqlres[$columnY] . ',';

	 }

$jsonEncodeX = rtrim($jsonEncodeX, ",");
$jsonEncodeY = rtrim($jsonEncodeY, ",");


	?>

			<span>
					<span class="row">						
						<span id="<?php echo 'controls_'.$vdivid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;" align="right" >
							<a style="cursor:pointer;color:blue;"  onClick="showattribs('area_basic', <?php echo $vdivid; ?>)" ><i class="bi bi-gear"></i></a>	
							<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $vdivid; ?>)" ><i class="bi bi-trash"></i></a>
							
						</span>
					</span>
					<span class="row">
						<span class="col-12 float-left" id="<?php echo 'label_'.$vdivid; ?>" >
							<span  id="area_basic2" style="display: block;"></span>
						</span>
					</span>
				</span>

				  <script>
var options = {
      chart: {
        type: 'area',
        height: 350,
        background: '<?php echo $chart_background; ?>',
        toolbar: {
        show: <?php echo $vchart_toolbar_show ? "true" : "false"; ?>, 
      	},
      	dropShadow: {
	      enabled: <?php echo $vchart_shadow_enabled ? "true" : "false"; ?>,
	    },
      },
      series: [
      {
        name: '<?php echo $vYTitle; ?>',
        data: [<?php echo $jsonEncodeY; ?>]
      },
      ],
      
      colors: [<?php echo $vcolors; ?>] ,
      stroke: {
          curve: '<?php echo $vstrokeStyle  ?>',
        },
     dataLabels:
     {
    	enabled: <?php echo $vdatalabels ? "true" : "false"; ?>,
    	style:{
    		colors:[<?php echo $vdatalabel_colors  ?>],
    	}
	 },
	 markers: {
	 	  show: <?php echo $vmarkers ? "true" : "false"; ?>,
          <?php if($vmarker_size!=''){  echo "size:".$vmarker_size.","; }  ?>
          colors: [<?php echo $vmarker_colors  ?>],
          shape: '<?php echo $vmarker_shape  ?>',
        },
      xaxis: {
        categories: [<?php echo $jsonEncodeX; ?>],
        title: {
        	text: '<?php echo $vXTitle; ?>',
        	style: { color: "<?php echo $vlabel_colors; ?>",   },
        },
        labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
      },        
      yaxis: {
          title: {
          	text: '<?php echo $vYTitle; ?>',
      		style: { color: "<?php echo $vlabel_colors; ?>",   },
      	},
           labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
      },
      

      
    };

    var chart = new ApexCharts(document.querySelector("#area_basic2"), options);
    chart.render();
      		</script>
			
			
 <?php }
















  else if($vchart_type=='bar_basic'){

   //grab the table name from module id
	 $moduleTable = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT table_name FROM sys_modules WHERE id= '".$vModuleId."' "));
	 $moduleTable =$moduleTable['table_name'];

	 // grab the coloum name from module field id
	 $columnX = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vXcolumnId."' "));
	 $columnX =$columnX['field_name'];
	 $columnY = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vYcolumnId."' "));
	 $columnY =$columnY['field_name'];

	
		// create a query

	 $sqlgraph=mysqli_query($dbcon,"SELECT $columnX, $columnY FROM $moduleTable ");
	 $jsonEncodeX="";
	 $jsonEncodeY="";
	 while ($sqlres=mysqli_fetch_assoc($sqlgraph)) {

	 	 $jsonEncodeX .= '"' . $sqlres[$columnX] . '",';
        $jsonEncodeY .='"' .  $sqlres[$columnY] . '",';

	 }

$jsonEncodeX = rtrim($jsonEncodeX, ",");
$jsonEncodeY = rtrim($jsonEncodeY, ",");




  ?>

<span>
	<span class="row">						
		<span id="<?php echo 'controls_'.$vdivid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;" align="right" >
			<a style="cursor:pointer;color:blue;"  onClick="showattribs('bar_basic', <?php echo $vdivid; ?>)" ><i class="bi bi-gear"></i></a>	
			<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $vdivid; ?>)" ><i class="bi bi-trash"></i></a>
			
		</span>
	</span>
	<span class="row">
		<span class="col-12 float-left" id="<?php echo 'label_'.$vdivid; ?>" >
			<span  id="bar_basic2" style="display: block;"></span>
		</span>
	</span>
</span>

<script>


 var options = {
      series: [ {
        name: '<?php echo $vYTitle; ?>',
        data: [<?php echo $jsonEncodeY; ?>]
      },],
      chart: {
      type: 'bar',
      height: 350,
	  background: '<?php echo $chart_background; ?>',
	  dropShadow: {
	      enabled: <?php echo $vchart_shadow_enabled ? "true" : "false"; ?>,
	    },
    },
    plotOptions: {
      bar: {
     <?php 
     if($vbar_radius!=''){  echo "borderRadius:".$vbar_radius.","; }  
     ?>
        horizontal: <?php echo $vbar_horizontal ? "true" : "false";?>,
      }
    },

     dataLabels:
     {
    	enabled: <?php echo $vdatalabels ? "true" : "false"; ?>,
    	style:{
    		colors:[<?php echo $vdatalabel_colors  ?>],
    	}
	 },

     xaxis: {
        categories: [<?php echo $jsonEncodeX; ?>],
  title: {
          	text: '<?php echo $vXTitle; ?>',
      		style: { color: "<?php echo $vlabel_colors; ?>",   },
      	},
        labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
		 labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},


      },        
      yaxis: {
          title: {
        	text: '<?php echo $vYTitle; ?>',
        	style: { color: "<?php echo $vlabel_colors; ?>",   },
        },

          labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
 labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},

      },
      colors: [<?php echo $vcolors; ?>] ,
      title: { 
      	 text: '<?php echo $vChart_title; ?>',
      	 style: { color: "<?php echo $vlabel_colors; ?>",   },
      },

    };

    var chart = new ApexCharts(document.querySelector("#bar_basic2"), options);
    chart.render();


</script>
		
			

<?php } 

else if($vchart_type=='pie_basic'){

   //grab the table name from module id
	 $moduleTable = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT table_name FROM sys_modules WHERE id= '".$vModuleId."' "));
	 $moduleTable =$moduleTable['table_name'];

	 // grab the coloum name from module field id
	 $columnX = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vXcolumnId."' "));
	 $columnX =$columnX['field_name'];
	 $columnY = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vYcolumnId."' "));
	 $columnY =$columnY['field_name'];

	
		// create a query

	 $sqlgraph=mysqli_query($dbcon,"SELECT $columnX, $columnY FROM $moduleTable ");
	 $jsonEncodeX="";
	 $jsonEncodeY="";
	 $sumX = 0; // Initialize the sum variable for columnX
	 while ($sqlres=mysqli_fetch_assoc($sqlgraph)) {

		$jsonEncodeX .= '"' . $sqlres[$columnX] . '",';
		$jsonEncodeY .=$sqlres[$columnY] . ',';
	
	
	 }

$jsonEncodeX = rtrim($jsonEncodeX, ",");
$jsonEncodeY = rtrim($jsonEncodeY, ",");

// sum up the values 


  ?>

<span>
	<span class="row">						
		<span id="<?php echo 'controls_'.$vdivid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;" align="right" >
			<a style="cursor:pointer;color:blue;"  onClick="showattribs('pie_basic', <?php echo $vdivid; ?>)" ><i class="bi bi-gear"></i></a>	
			<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $vdivid; ?>)" ><i class="bi bi-trash"></i></a>	
		</span>
	</span>
	<span class="row">
		<span class="col-12 float-left" id="<?php echo 'label_'.$vdivid; ?>" >
			<span  id="pie_basic2" style="display: block;"></span>
		</span>
	</span>
</span>

<script>


 var pieOption = {

        labels: [<?php echo $jsonEncodeX; ?>],
        series: [<?php echo $jsonEncodeY; ?>],
		dataLabels: {
			enabled: <?php echo $vdatalabels ? "true" : "false"; ?>,
			style:{
				colors:[<?php echo $vdatalabel_colors  ?>],
			}
		},

		chart: {
			height:350,
			background: '<?php echo $chart_background; ?>',
			type: 'pie',
			dropShadow: {
				enabled: <?php echo $vchart_shadow_enabled ? "true" : "false"; ?>,
			},
		},

		stroke: {
			colors: [<?php echo $vstroke_colors; ?>],
			width:<?php echo $vstroke_width; ?>,
		},
        
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }],

        colors: [<?php echo $vcolors; ?>] ,
        title: { 
        	text: '<?php echo $vChart_title; ?>',
        	style: { color: "<?php echo $vlabel_colors; ?>",   },
        	 },

        };

    var pieChart = new ApexCharts(document.querySelector("#pie_basic2"), pieOption);
    pieChart.render();


</script>
		
			

<?php }     







else if($vchart_type=='donut_basic'){

   //grab the table name from module id
	 $moduleTable = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT table_name FROM sys_modules WHERE id= '".$vModuleId."' "));
	 $moduleTable =$moduleTable['table_name'];

	 // grab the coloum name from module field id
	 $columnX = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vXcolumnId."' "));
	 $columnX =$columnX['field_name'];
	 $columnY = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vYcolumnId."' "));
	 $columnY =$columnY['field_name'];

	
		// create a query

	 $sqlgraph=mysqli_query($dbcon,"SELECT $columnX, $columnY FROM $moduleTable ");
	 $jsonEncodeX="";
	 $jsonEncodeY="";
	 $sumX = 0; // Initialize the sum variable for columnX
	 while ($sqlres=mysqli_fetch_assoc($sqlgraph)) {

		$jsonEncodeX .= '"' . $sqlres[$columnX] . '",';
		$jsonEncodeY .=$sqlres[$columnY] . ',';
	
	
	 }

$jsonEncodeX = rtrim($jsonEncodeX, ",");
$jsonEncodeY = rtrim($jsonEncodeY, ",");

// sum up the values 


  ?>

		<span>
			<span class="row">						
				<span id="<?php echo 'controls_'.$vdivid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;" align="right" >
					<a style="cursor:pointer;color:blue;"  onClick="showattribs('donut_basic', <?php echo $vdivid; ?>)" ><i class="bi bi-gear"></i></a>	
					<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $vdivid; ?>)" ><i class="bi bi-trash"></i></a>	
				</span>
			</span>
			<span class="row">
				<span class="col-12 float-left" id="<?php echo 'label_'.$vdivid; ?>" >
					<span  id="donut_basic2" style="display: block;"></span>
				</span>
			</span>
		</span>

<script>


 var donutOption = {

        labels: [<?php echo $jsonEncodeX; ?>],
        series: [<?php echo $jsonEncodeY; ?>],
		dataLabels: {
			enabled: <?php echo $vdatalabels ? "true" : "false"; ?>,
			style:{
				colors:[<?php echo $vdatalabel_colors  ?>],
			}
		},

		chart: {
			height:350,
			background: '<?php echo $chart_background; ?>',
			type: 'donut',
			dropShadow: {
				enabled: <?php echo $vchart_shadow_enabled ? "true" : "false"; ?>,
			},
		},

		stroke: {
			colors: [<?php echo $vstroke_colors; ?>],
			width:<?php echo $vstroke_width; ?>,
		},
        
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }],

        colors: [<?php echo $vcolors; ?>] ,
        title: { 
        	text: '<?php echo $vChart_title; ?>',
        	style: { color: "<?php echo $vlabel_colors; ?>",   },
        	 },

        };

    var donutChart = new ApexCharts(document.querySelector("#donut_basic2"), donutOption);
    donutChart.render();


</script>
		
			

<?php }  






























else if($vchart_type=='radar_basic'){ 
     
     //grab the table name from module id
	 $moduleTable = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT table_name FROM sys_modules WHERE id= '".$vModuleId."' "));
	 $moduleTable =$moduleTable['table_name'];

	 // grab the coloum name from module field id
	 $columnX = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vXcolumnId."' "));
	 $columnX =$columnX['field_name'];
	 $columnY = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vYcolumnId."' "));
	 $columnY =$columnY['field_name'];

	
		// create a query

	 $sqlgraph=mysqli_query($dbcon,"SELECT $columnX, $columnY FROM $moduleTable ");
	 $jsonEncodeX="";
	 $jsonEncodeY="";
	 while ($sqlres=mysqli_fetch_assoc($sqlgraph)) 
	 {

		$jsonEncodeX .= '"' . $sqlres[$columnX] . '",';
		$jsonEncodeY .='"' .  $sqlres[$columnY] . '",';

	 }

$jsonEncodeX = rtrim($jsonEncodeX, ",");
$jsonEncodeY = rtrim($jsonEncodeY, ",");

$jsonEncodeXArray = json_decode("[" . $jsonEncodeX . "]", true);
$countJsonEncodeX = count($jsonEncodeXArray);
	?>

	<span>
		<span class="row">						
			<span id="<?php echo 'controls_'.$vdivid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;" align="right" >
			<a style="cursor:pointer;color:blue;"  onClick="showattribs('radar_basic', <?php echo $vdivid; ?>)" ><i class="bi bi-gear"></i></a>	
			<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $vdivid; ?>)" ><i class="bi bi-trash"></i></a>

			</span>
		</span>

		<span class="row">
			<span class="col-12 float-left" id="<?php echo 'label_'.$vdivid; ?>" >
				<span  id="radar_basic2" style="display: block;"></span>
			</span>
		</span>
	</span>

				  <script>
var radarOption = {
	  title: { 
	  	text: '<?php echo $vChart_title; ?>',
	  	style: { color: "<?php echo $vlabel_colors; ?>",   },
	  	 },
      chart: {
        type: 'radar',
        height: 350,
        background: '<?php echo $chart_background; ?>',
        toolbar: {
        show: <?php echo $vchart_toolbar_show ? "true" : "false"; ?>, 
      	},
      	dropShadow: {
	      enabled: <?php echo $vchart_shadow_enabled ? "true" : "false"; ?>,
	    },
      },
      series: [
      {
        name: '<?php echo $vYTitle; ?>',
        data: [<?php echo $jsonEncodeY; ?>]
      },
      ],
      
      colors: [<?php echo $vcolors; ?>] ,
      stroke: {
          curve: '<?php echo $vstrokeStyle  ?>',
        },
     dataLabels:
     {
    	enabled: <?php echo $vdatalabels ? "true" : "false"; ?>,
    	style:{
    		colors:[<?php echo $vdatalabel_colors  ?>],
    	}
	 },
	 markers: {
	 	  show: <?php echo $vmarkers ? "true" : "false"; ?>,
          <?php if($vmarker_size!=''){  echo "size:".$vmarker_size.","; }  ?>
          colors: [<?php echo $vmarker_colors  ?>],
        
        },
         xaxis: {
        categories: [<?php echo $jsonEncodeX; ?>],
  			title: {
          	text: '<?php echo $vXTitle; ?>',
      		style: { color: "<?php echo $vlabel_colors; ?>",   },
      	},
        labels: {
	      style: {
	        colors:[  <?php
                    for ($i = 0; $i < $countJsonEncodeX; $i++) {
                        echo '"' . $vlabel_colors . '",';
                    }
                    ?>], // Modify x-axis labels color here
	      },
    	},
		


      },        
      yaxis: {
          title: {
        	text: '<?php echo $vYTitle; ?>',
        	style: { color: "<?php echo $vlabel_colors; ?>",   },
        },

          labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
      },
      

      
    };

    var radarChart = new ApexCharts(document.querySelector("#radar_basic2"), radarOption);
    radarChart.render();
      		</script>
			
			
 <?php }






// Scattred Chart Starts here

else if($vchart_type=='scattered_basic'){

   //grab the table name from module id
	 $moduleTable = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT table_name FROM sys_modules WHERE id= '".$vModuleId."' "));
	 $moduleTable =$moduleTable['table_name'];

	 // grab the coloum name from module field id
	 $columnX = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vXcolumnId."' "));
	 $columnX =$columnX['field_name'];
	 $columnY = mysqli_fetch_assoc(mysqli_query($dbcon, "SELECT field_name FROM sys_module_fields WHERE id= '".$vYcolumnId."' "));
	 $columnY =$columnY['field_name'];

	
		// create a query

	 $sqlgraph=mysqli_query($dbcon,"SELECT $columnX, $columnY FROM $moduleTable ");
	 $jsonEncodeX="";
	 $jsonEncodeY="";
	 while ($sqlres=mysqli_fetch_assoc($sqlgraph)) {

	 	 $jsonEncodeX .= '"' . $sqlres[$columnX] . '",';
        $jsonEncodeY .='"' .  $sqlres[$columnY] . '",';

	 }

$jsonEncodeX = rtrim($jsonEncodeX, ",");
$jsonEncodeY = rtrim($jsonEncodeY, ",");




  ?>

	<span>
		<span class="row">						
			<span id="<?php echo 'controls_'.$vdivid; ?>" class="col-12 float-right item_icons item_icons_show" style="align:right;" align="right" >
				<a style="cursor:pointer;color:blue;"  onClick="showattribs('scattered_basic', <?php echo $vdivid; ?>)" ><i class="bi bi-gear"></i></a>	
				<a style="cursor:pointer;color:red;" onClick="remove_item(<?php echo $vdivid; ?>)" ><i class="bi bi-trash"></i></a>
				
			</span>
		</span>
		<span class="row">
			<span class="col-12 float-left" id="<?php echo 'label_'.$vdivid; ?>" >
				<span  id="scattered_basic2" style="display: block;"></span>
			</span>
		</span>
	</span>

<script>


 var options = {
      series: [ {
        name: '<?php echo $vYTitle; ?>',
        data: [<?php echo $jsonEncodeY; ?>]
      },],
      chart: {
      type: 'scatter',
      height: 350,
	  background: '<?php echo $chart_background; ?>',
	  dropShadow: {
	      enabled: <?php echo $vchart_shadow_enabled ? "true" : "false"; ?>,
	    },
    },
   
     dataLabels:
     {
    	enabled: <?php echo $vdatalabels ? "true" : "false"; ?>,
    	style:{
    		colors:[<?php echo $vdatalabel_colors  ?>],
    	}
	 },

     xaxis: {
        categories: [<?php echo $jsonEncodeX; ?>],
  title: {
          	text: '<?php echo $vXTitle; ?>',
      		style: { color: "<?php echo $vlabel_colors; ?>",   },
      	},
        labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
		 labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},


      },        
      yaxis: {
          title: {
        	text: '<?php echo $vYTitle; ?>',
        	style: { color: "<?php echo $vlabel_colors; ?>",   },
        },

          labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},
 labels: {
	      style: {
	        colors: "<?php echo $vlabel_colors; ?>", // Modify x-axis labels color here
	      },
    	},

      },
      colors: [<?php echo $vcolors; ?>] ,
      title: { 
      	 text: '<?php echo $vChart_title; ?>',
      	 style: { color: "<?php echo $vlabel_colors; ?>",   },
      },
       markers: {
	 	  show: <?php echo $vmarkers ? "true" : "false"; ?>,
          <?php if($vmarker_size!=''){  echo "size:".$vmarker_size.","; }  ?>
          colors: [<?php echo $vmarker_colors  ?>],
          shape: '<?php echo $vmarker_shape  ?>',
        },

    };

    var chart = new ApexCharts(document.querySelector("#scattered_basic2"), options);
    chart.render();


</script>
		
			

<?php }

// Scattered Chart Ends here





























 else { 

 		echo "Nothing to display for item type: ".$vchart_type;

 	  }
 	 ?>
