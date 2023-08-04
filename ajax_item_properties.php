<?php include_once("config.php");

	$itemtype = $_POST['itemtype'];
	$vdivid = $_POST['divid'];
	$itemSequence =$_POST['itemSequence'];
    $parentId =$_POST['parentId'];

    

	$sqlitem = "SELECT sys_charts.*,sys_chart_properties.* FROM sys_charts, sys_chart_properties WHERE divid='".$vdivid."'"."and sys_charts.id=sys_chart_properties.sys_chart_id";
	$resitem = mysqli_query($dbcon, $sqlitem);
	$rowitem = mysqli_fetch_assoc($resitem);
	
?>	


<script>


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


function showlistmoduleitems(vlistmodulename){
	
		var req = getXMLHTTP();		
		if (req) {			
			
			//var vlistmodulename = document.getElementById('listmodulename').value;
			var dataString = 'scrn='+vlistmodulename;
			//alert("data string: "+dataString);
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('divlistmoduleitems').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET","ajax_listmoduleitems.php?"+dataString, true);
			req.send(null);
		}
		//getShape(strURL);	
		//getMaxcarat(strURL);
	}

	
</script>	

	

	<?php  	if($itemtype=='line_basic'){  ?>

<div class="widget-body" style="padding: 50px 20px; ">
	<h5 >Line Chart</h5>
	<p class="text-primary" style="margin-top: -10px;">Customize your chart here</p>
	
	<div class="row">

		<div class="col-6">
			<label class="strong">Chart Title</label>
			<input type="text" name="chart_title"  id="chart_title"  class="form-control" value="<?php echo $rowitem['chart_title']; ?>" />
			<?php echo '<span style="color:red;font-size:12px;">'.$error['chart_title'].'</span>'; ?>
		</div>

		<div class="col-3">
			<label class="strong">Application</label>
			<select  name="applicationId"  id="applicationId" class="form-control" >
				<option value="">--Select Application--</option>
				<?php 
					$sqlApp = "SELECT * FROM sys_applications";
					$resApp = mysqli_query($dbcon, $sqlApp);
					while( $rowApp=mysqli_fetch_assoc($resApp))
					{
					  $selected="";
					  if($rowitem['application_id']== $rowApp['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowApp['id'] ?>"><?php echo $rowApp['applicname'] ?> </option>

			  <?php } ?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>

		<div class="col-3">
			<label class="strong">Module</label>
			<select  name="moduleId"  id="moduleId" class="form-control" >
				<?php 
				$cappId=$rowitem['application_id'];
					if($cappId==""){?>
							<option value="">--Select App First--</option>
						<?php
					}
				?>

				
					<?php 
					
					if($cappId!=""){


						$sqlModule= "SELECT * FROM sys_modules WHERE application_id=$cappId";
					
						
					$resModule = mysqli_query($dbcon,$sqlModule);
					while( $rowModule=mysqli_fetch_assoc($resModule))
					{
					  $selected="";
					  if($rowitem['module_id']== $rowModule['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowModule['id'] ?>"><?php echo $rowModule['module_name'] ?> </option>

			  <?php } 
					}
					?>
					
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>
		<div class="col-3">

			<label class="strong">Data Column X-axis</label>
			<select  name="x-columnId"  id="x-columnId" class="form-control" >
					<?php 
				$cmid=$rowitem['module_id'];
					if($cmid==""){
						?>
							<option value="">--Select Module First--</option>
						<?php
					}
					
					if($cmid!=""){
						$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
						
						
					$resCol = mysqli_query($dbcon,$sqlCol);
					while( $rowCol=mysqli_fetch_assoc($resCol))
					{
					  $selected="";
					  if($rowitem['data_column_id_x']== $rowCol['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
							<?php echo $rowCol['field_name'] ?> 
						</option>

			  <?php } 
			}

			?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>	
		</div>
		<div class="col-3">
			<label class="strong">Data Column Y-axis</label> 
			<select  name="y-columnId"  id="y-columnId" class="form-control" >
					<?php 
				$cmid=$rowitem['module_id'];
					if($cmid==""){?>
							<option value="">--Select Module First--</option>
						<?php
					}					
					if($cmid!=""){
						$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
						echo $sqlCol;
						
					$resCol = mysqli_query($dbcon,$sqlCol);
					while( $rowCol=mysqli_fetch_assoc($resCol))
					{
					  $selected="";
					  if($rowitem['data_column_id_y']== $rowCol['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
							<?php echo $rowCol['field_name'] ?> 
						</option>
			  <?php } 
			}
					
					?>
				
			</select>
		</div>
		<div class="col-3">	
			
			<label class="strong">X-Axis Label</label>
			<input type="text" name="x-title"  id="x-title"  class="form-control" value="<?php echo $rowitem['label_x']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_x'].'</p>'; ?>
		</div>
	
		<div class="col-3">
			<label class="strong">Y-Axis Label</label>
			<input type="text" name="y-title"  id="y-title"  class="form-control" value="<?php echo $rowitem['label_y']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_y'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Label Colors</label>
			<input type="text" name="label_colors"  id="label_colors"  class="form-control" value="<?php echo $rowitem['label_colors']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_colors'].'</p>'; ?>
		</div>

		
		<div class="col-3">
			<label class="strong">Background Color</label>
			<input type="text" name="chart_background"  id="chart_background"  class="form-control" value="<?php echo $rowitem['chart_background']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_background'].'</p>'; ?>
		</div>

		<div class="col-6">
			<label class="strong">Colors List (Seperated by Commas)</label>
			<textarea name="color_property" id="color_property" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['colors'] )) ?></textarea>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
		</div>
		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="datalabels" id="datalabels"  <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Enable Data Labels</label>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>

		<div class="col-6">
			<div id="dataLabelOptions" <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
				<label class="strong">Label Colors (Seperated by Commas)</label>
				<textarea name="datalabel_colors" id="datalabel_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['datalabel_colors'] )); ?></textarea>
				<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
			</div>
	    </div>


		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="markers" id="markers" class="form-control" <?php echo ($rowitem['markers_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Enable Markers</label>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>

		</div>
		<div class="col-6">
		<div id="markersOptions" <?php echo ($rowitem['markers_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
			
			<label class="strong">Markers Size</label>
			<input class="form-control" type="number" name="marker_size" id="marker_size" class="form-control" min="0" max="10" value="<?php echo $rowitem['markers_size']; ?>" >


			<label class="strong">Label Colors (Seperated by Commas)</label>
			<textarea name="marker_colors" id="marker_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['marker_colors'] )); ?></textarea>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
			
			<label class="strong">Markers Shape</label>
			<select  name="marker_shape"  id="marker_shape" class="form-control" >
			<?php 

				$mShapes = array("circle", "square");
				 foreach ($mShapes as $mShape) {
			          // Use htmlspecialchars to prevent XSS attacks
			          $encodedShape = htmlspecialchars($mShape);
			          $isSelected = ($encodedShape === $rowitem['marker_shape']) ? 'selected' : '';
			        echo "<option value='$encodedShape' $isSelected>$encodedShape</option>";}

			?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>


		</div>
		</div>


		<div class="col-6">
			<label class="strong">Stroke Style</label>
			<select  name="strokeStyle"  id="strokeStyle" class="form-control" >
				<?php 

					$sStyles = array(
								    array("value" => "straight", "label" => "Straight - Default"),
								    array("value" => "smooth", "label" => "Smooth"),
								    array("value" => "stepline", "label" => "Step_line")
								);
					 foreach ($sStyles as $sStyle) {
		
					    $encodedValue = htmlspecialchars($sStyle['value']);
					    $encodedLabel = htmlspecialchars($sStyle['label']);
					    $isSelected = ($encodedValue === $rowitem['stroke_curve']) ? 'selected' : '';
					    echo "<option value='$encodedValue' $isSelected>$encodedLabel</option>";
					}

				?>
				
			</select>
		<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>

		<div class="col-6">
			<label class="strong">Is Active</label>
			<select  name="isActive"  id="isActive" class="form-control" >
				<option value="N"  <?php if($rowitem['active'] == 'N'){ echo ' selected '; } ?> >No</option>
				<option value="Y" <?php if($rowitem['active'] == 'Y'){ echo ' selected '; } ?> >Yes</option>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>


		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="chart_toolbar_show" id="chart_toolbar_show"  <?php echo ($rowitem['chart_tooblbar_show'] == 1) ? 'checked' : ''; ?>>
			 <label class="strong">Show Toolbar</label>
		</div>
		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="chart_shadow_enabled" id="chart_shadow_enabled"  <?php echo ($rowitem['chart_shadow_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Enable Chart Shadow</label>
		</div>
		

		<!--
			 Note: These are the hidden properties used by
			 	   code 
		-->
		<div style="display:none;">
			<input type="hidden"  name="divid"  id="divid" value="<?php echo $vdivid; ?>" />
			<input type="hidden"  name="chart_type"  id="chart_type" value="<?php echo $itemtype; ?>" />
		</div>



		<div class="col-12">
		<a style="cursor:pointer;" class="btn btn-primary mt-4"  onClick="updateChart()" ><i></i>Done</a>
		</div>
	
	</div>
</div>

			
		

		<script type="text/javascript">

	$('#datalabels').change(function() {
		var dataLabelOptions = $('#dataLabelOptions');
	   if ($(this).is(':checked')) {
	   	dataLabelOptions.css('display', 'block' );
	   	$('#markers').css('display','none');
	   	$('#markers').next('label').css('display','none');
	   	$('#markersOptions').css('display', 'none' );
	   }
	    else { 
	    	dataLabelOptions.css('display',  'none' );
	    	$('#markers').css('display','inline-block');
	    	$('#markers').next('label').css('display','inline-block');
	    }
  });

	$('#markers').change(function() {
		var markersOptions = $('#markersOptions');
	   if ($(this).is(':checked')) {
	   	markersOptions.css('display', 'block' );
	   	$('#datalabels').css('display','none');
	   	$('#datalabels').next('label').css('display','none');
	   	$('#dataLabelOptions').css('display',  'none' );
	   }
	    else {
	     markersOptions.css('display',  'none' );
	     $('#datalabels').css('display','inline-block');
	     $('#datalabels').next('label').css('display','inline-block');
	 }
  });
   

   
  // Attach a change event listener to the select item
  $('#applicationId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="AppId="+currentValue;
    $.ajax({
				url: "ajax_getModule.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  {
				$("#moduleId").html(response); 
				$("#x-columnId").html('<option value="">--Select Module First--</option>');
				$("#y-columnId").html('<option value="">--Select Module First--</option>');  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });

   $('#moduleId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="moduleId="+currentValue;
    $.ajax({
				url: "ajax_getModuleFields.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  
				{
					
					$("#x-columnId").html(response);
					$("#y-columnId").html(response);  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });
		</script>


	<?php
	 }
	 else if($itemtype=='bar_basic'){
	 	?>
	 
				<div class="widget-body" style="padding: 50px 20px; " >
					
				
						
						<!-- Row -->
						<div class="row" >
						
							<!-- Column -->
								<div class="col-6">

									<label class="strong">Chart Title</label>
									<input type="text" name="chart_title"  id="chart_title"  class="form-control" value="<?php echo $rowitem['chart_title']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_title'].'</p>'; ?>

								</div>

								<div class="col-3">

									<label class="strong">Application</label>
									<select  name="applicationId"  id="applicationId" class="form-control" >
										<option value="">--Select Application--</option>
										<?php 
											$sqlApp = "SELECT * FROM sys_applications";
											$resApp = mysqli_query($dbcon, $sqlApp);
											while( $rowApp=mysqli_fetch_assoc($resApp))
											{
											  $selected="";
											  if($rowitem['application_id']== $rowApp['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowApp['id'] ?>"><?php echo $rowApp['applicname'] ?> </option>

									  <?php } ?>
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>

								</div>


									<div class="col-3">
									<label class="strong">Module</label>
									<select  name="moduleId"  id="moduleId" class="form-control" >
										<?php 
										$cappId=$rowitem['application_id'];
											if($cappId==""){?>
													<option value="">--Select App First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cappId!=""){


												$sqlModule= "SELECT * FROM sys_modules WHERE application_id=$cappId";
											
												
											$resModule = mysqli_query($dbcon,$sqlModule);
											while( $rowModule=mysqli_fetch_assoc($resModule))
											{
											  $selected="";
											  if($rowitem['module_id']== $rowModule['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowModule['id'] ?>"><?php echo $rowModule['module_name'] ?> </option>

									  <?php } 
											}
											?>
											
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
									</div>

										<div class="col-3">
									<label class="strong">Data Column X-axis</label>
									<select  name="x-columnId"  id="x-columnId" class="form-control" >
											<?php 
										$cmid=$rowitem['module_id'];
											if($cmid==""){
												?>
													<option value="">--Select Module First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cmid!=""){
												$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
												
												
											$resCol = mysqli_query($dbcon,$sqlCol);
											while( $rowCol=mysqli_fetch_assoc($resCol))
											{
											  $selected="";
											  if($rowitem['data_column_id_x']== $rowCol['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
													<?php echo $rowCol['field_name'] ?> 
												</option>

									  <?php } 
									}

									?>
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>	
									</div>
									<div class="col-3">
									<label class="strong">Data Column Y-axis</label> 

									<select  name="y-columnId"  id="y-columnId" class="form-control" >
											<?php 
										$cmid=$rowitem['module_id'];
											if($cmid==""){?>
													<option value="">--Select Module First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cmid!=""){
												$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
												echo $sqlCol;
												
											$resCol = mysqli_query($dbcon,$sqlCol);
											while( $rowCol=mysqli_fetch_assoc($resCol))
											{
											  $selected="";
											  if($rowitem['data_column_id_y']== $rowCol['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
													<?php echo $rowCol['field_name'] ?> 
												</option>
									  <?php } 
									}
											
											?>
										
									</select>
								
								</div>

								<div class="col-3">
									
									<label class="strong">X-Axis Label</label>
									<input type="text" name="x-title"  id="x-title"  class="form-control" value="<?php echo $rowitem['label_x']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['label_x'].'</p>'; ?>
									
								</div>

								<div class="col-3">									
									<label class="strong">Y-Axis Label</label>
									<input type="text" name="y-title"  id="y-title"  class="form-control" value="<?php echo $rowitem['label_y']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['label_y'].'</p>'; ?>
								</div>

								

								
									<div class="col-3">
									<label class="strong">Label Colors</label>
									<input type="text" name="label_colors"  id="label_colors"  class="form-control" value="<?php echo $rowitem['label_colors']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['label_colors'].'</p>'; ?>
									</div>
									<div class="col-3">
									<label class="strong">Chart Background Color</label>
									<input type="text" name="chart_background"  id="chart_background"  class="form-control" value="<?php echo $rowitem['chart_background']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_background'].'</p>'; ?>
									</div>



									<div class="col-6">
									<label class="strong"> Colors List (Seperated by Commas)</label>
									<textarea name="color_property" id="color_property" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['colors'] )) ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
									</div>
									<div class="col-6">
									 <input class="form-check-input" type="checkbox" name="datalabels" id="datalabels"  <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'checked' : ''; ?>>
									 <label class="strong">Data Labels</label>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
									</div>
									<div class="col-6">
									<div id="dataLabelOptions" <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
										<label class="strong">Data Label Colors (Seperated by Commas)</label>
									<textarea name="datalabel_colors" id="datalabel_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['datalabel_colors'] )); ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['datalabel_colors'].'</p>'; ?>
									</div>

									</div>
									
									
									

									<div class="col-6">

									<label class="strong">Bar Style</label>
									<select name="bar_horizontal" id="bar_horizontal" class="form-control">
								    <?php
								    $isHorizontal = ($rowitem['bar_horizontal'] == 1); 
								    ?>
								    <option value="0" <?php echo !$isHorizontal ? '' : 'selected'; ?>>Vertical - Default</option>
								    <option value="1" <?php echo $isHorizontal ? 'selected' : ''; ?>>Horizontal</option>
								</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
									</div>
									<div class="col-6">
									<label class="strong">Bar Radius</label>
										<input class="form-control" type="number" name="bar_radius" id="bar_radius" class="form-control" min="0" max="10" value="<?php echo $rowitem['bar_radius']; ?>" >

									</div>
									<div class="col-6">
									<label class="strong">Is Active</label>
									<select  name="isActive"  id="isActive" class="form-control" >
										<option value="N"  <?php if($rowitem['active'] == 'N'){ echo ' selected '; } ?> >No</option>
										<option value="Y" <?php if($rowitem['active'] == 'Y'){ echo ' selected '; } ?> >Yes</option>
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>

									</div>		
									<div class="col-6">							
									 <input class="form-check-input" type="checkbox" name="chart_shadow_enabled" id="chart_shadow_enabled"  <?php echo ($rowitem['chart_shadow_enabled'] == 1) ? 'checked' : ''; ?>>
									 <label class="strong">Enable Chart Shadow</label>
									</div>
									<br>

									<!--
										 Note: These are the hidden properties used by
										 	   code 
									-->
									<div style="display:none;">
										<input type="hidden"  name="divid"  id="divid" value="<?php echo $vdivid; ?>" />
										<input type="hidden"  name="chart_type"  id="chart_type" value="<?php echo $itemtype; ?>" />
									</div>




									<a style="cursor:pointer;" class="btn btn-primary mt-4"  onClick="updateChart()" ><i></i>Done</a>
									
								
							</div>
					
					</div>
						<!-- // Column END -->
					
		</div>


	<script type="text/javascript">

	$('#datalabels').change(function() {
		var dataLabelOptions = $('#dataLabelOptions');
	   if ($(this).is(':checked')) {
	   	dataLabelOptions.css('display', 'block' );
	   }
	    else { 
	    dataLabelOptions.css('display',  'none' );
	    	
	    }
  });


   

   
  // Attach a change event listener to the select item
  $('#applicationId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="AppId="+currentValue;
    $.ajax({
				url: "ajax_getModule.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  {
				$("#moduleId").html(response); 
				$("#x-columnId").html('<option value="">--Select Module First--</option>');
				$("#y-columnId").html('<option value="">--Select Module First--</option>');  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });

   $('#moduleId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="moduleId="+currentValue;
    $.ajax({
				url: "ajax_getModuleFields.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  
				{
					
					$("#x-columnId").html(response);
					$("#y-columnId").html(response);  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });
		</script>

	 <?php }
 			else if($itemtype=='pie_basic'){
	 	?>
	 
				<div class="widget-body" style="padding: 40px 20px; ">
					
						<!-- Row -->
						<div class="row">
						
							
								<div class="col-6">
								<label class="strong">Chart Title</label>
								<input type="text" name="chart_title"  id="chart_title"  class="form-control" value="<?php echo $rowitem['chart_title']; ?>" />
								<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_title'].'</p>'; ?>
								</div>	
								<div class="col-3">
									<label class="strong">Application</label>
									<select  name="applicationId"  id="applicationId" class="form-control" >
										<option value="">--Select Application--</option>
										<?php 
											$sqlApp = "SELECT * FROM sys_applications";
											$resApp = mysqli_query($dbcon, $sqlApp);
											while( $rowApp=mysqli_fetch_assoc($resApp))
											{
											  $selected="";
											  if($rowitem['application_id']== $rowApp['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowApp['id'] ?>"><?php echo $rowApp['applicname'] ?> </option>

									  <?php } ?>
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
								</div>
								<div class="col-3">
									<label class="strong">Module</label>
									<select  name="moduleId"  id="moduleId" class="form-control" >
										<?php 
										$cappId=$rowitem['application_id'];
											if($cappId==""){?>
													<option value="">--Select App First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cappId!=""){


												$sqlModule= "SELECT * FROM sys_modules WHERE application_id=$cappId";
											
												
											$resModule = mysqli_query($dbcon,$sqlModule);
											while( $rowModule=mysqli_fetch_assoc($resModule))
											{
											  $selected="";
											  if($rowitem['module_id']== $rowModule['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowModule['id'] ?>"><?php echo $rowModule['module_name'] ?> </option>

									  <?php } 
											}
											?>
											
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
									</div>
									<div class="col-3">
									<label class="strong">Value Labels</label>
									<select  name="x-columnId"  id="x-columnId" class="form-control" >
											<?php 
										$cmid=$rowitem['module_id'];
											if($cmid==""){
												?>
													<option value="">--Select Module First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cmid!=""){
												$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
												
												
											$resCol = mysqli_query($dbcon,$sqlCol);
											while( $rowCol=mysqli_fetch_assoc($resCol))
											{
											  $selected="";
											  if($rowitem['data_column_id_x']== $rowCol['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
													<?php echo $rowCol['field_name'] ?> 
												</option>

									  <?php } 
									}

									?>
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>	
									</div>
									<div class="col-3">
									<label class="strong">Data Values</label> 

									<select  name="y-columnId"  id="y-columnId" class="form-control" >
											<?php 
										$cmid=$rowitem['module_id'];
											if($cmid==""){?>
													<option value="">--Select Module First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cmid!=""){
												$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
												echo $sqlCol;
												
											$resCol = mysqli_query($dbcon,$sqlCol);
											while( $rowCol=mysqli_fetch_assoc($resCol))
											{
											  $selected="";
											  if($rowitem['data_column_id_y']== $rowCol['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
													<?php echo $rowCol['field_name'] ?> 
												</option>
									  <?php } 
									}
											
											?>
										
									</select>
								</div>
								

									<div class="col-6">
									<label class="strong">Background Color</label>
									<input type="text" name="chart_background"  id="chart_background"  class="form-control" value="<?php echo $rowitem['chart_background']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_background'].'</p>'; ?>

									</div>
									<div class="col-6">
									<label class="strong">Colors List (Seperated by Commas)</label>
									<textarea name="color_property" id="color_property" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['colors'] )) ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
									</div>
									<div class="col-6">
									</div>
									<div class="col-6">
									 <input class="form-check-input" type="checkbox" name="datalabels" id="datalabels"  <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'checked' : ''; ?>>
									 <label class="strong">Data Labels</label>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
									</div>
									<div class="col-6">
									<div id="dataLabelOptions" <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
										<label class="strong">Label Colors (Seperated by Commas)</label>
									<textarea name="datalabel_colors" id="datalabel_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['datalabel_colors'] )); ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
									</div>
								</div>


									
									
									
								<div class="col-3">
									
									 <input class="form-check-input" type="checkbox" name="chart_shadow_enabled" id="chart_shadow_enabled"  <?php echo ($rowitem['chart_shadow_enabled'] == 1) ? 'checked' : ''; ?>>
									 <label class="strong">Enable Chart Shadow</label>
									</div>



									<div class="col-3">
									 <input class="form-check-input" type="checkbox" name="stroke_enabled" id="stroke_enabled"  <?php echo ($rowitem['stroke_colors'] != '' || $rowitem['stroke_width'] != '' ) ? 'checked' : ''; ?>>
									 <label class="strong">Enable Border </label>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
									</div>

									<div class="col-6">
									<div id="strokeOptions" <?php echo ($rowitem['stroke_colors'] != '' || $rowitem['stroke_width'] != '' ) ? 'style="display:block"' : 'style="display:none"' ; ?>>
										<label class="strong">Border Colors (Seperated by Commas)</label>
									<textarea name="stroke_colors" id="stroke_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['stroke_colors'] )); ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>

									

									<label class="strong">Border Width </label>
									<input type="text" name="stroke_width"  id="stroke_width"  class="form-control" value="<?php echo $rowitem['stroke_width']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['stroke_width'].'</p>'; ?>
								</div>
								
								</div>

								


									
									
									

									<!--
										 Note: These are the hidden properties used by
										 	   code 
									-->
									
								
								

									<div class="col-6">
									<label class="strong">Is Active</label>
									<select  name="isActive"  id="isActive" class="form-control" >
										<option value="N"  <?php if($rowitem['active'] == 'N'){ echo ' selected '; } ?> >No</option>
										<option value="Y" <?php if($rowitem['active'] == 'Y'){ echo ' selected '; } ?> >Yes</option>
									</select>
								</div>
									
									<div style="display:none;">
										<input type="hidden"  name="divid"  id="divid" value="<?php echo $vdivid; ?>" />
										<input type="hidden"  name="chart_type"  id="chart_type" value="<?php echo $itemtype; ?>" />
									</div>
									<a style="cursor:pointer;" class="btn btn-primary mt-4"  onClick="updateChart()" ><i></i>Done</a>
								
							<!-- // Column END -->
					</div>
				</div>
		


	<script type="text/javascript">

	$('#datalabels').change(function() {
		var dataLabelOptions = $('#dataLabelOptions');
	   if ($(this).is(':checked')) {
	   	dataLabelOptions.css('display', 'block' );
	   }
	    else { 
	    dataLabelOptions.css('display',  'none' );
	    	
	    }
  });
  

   $('#stroke_enabled').change(function() {
		var strokeOptions = $('#strokeOptions');
	   if ($(this).is(':checked')) {
	   	strokeOptions.css('display', 'block' );
	   }
	    else { 
	    strokeOptions.css('display',  'none' );
	    	
	    }
  });

   
  // Attach a change event listener to the select item
  $('#applicationId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="AppId="+currentValue;
    $.ajax({
				url: "ajax_getModule.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  {
				$("#moduleId").html(response); 
				$("#x-columnId").html('<option value="">--Select Module First--</option>');
				$("#y-columnId").html('<option value="">--Select Module First--</option>');  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });

   $('#moduleId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="moduleId="+currentValue;
    $.ajax({
				url: "ajax_getModuleFields.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  
				{
					
					$("#x-columnId").html(response);
					$("#y-columnId").html(response);  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });
		</script>

	 <?php }


// Donut chart Starts here


else if($itemtype=='donut_basic'){
	 	?>
	 
				<div class="widget-body" style="padding: 40px 20px; ">
					
						<!-- Row -->
						<div class="row">
				
							<div class="col-6">
								<label class="strong">Chart Title</label>
								<input type="text" name="chart_title"  id="chart_title"  class="form-control" value="<?php echo $rowitem['chart_title']; ?>" />
								<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_title'].'</p>'; ?>
							</div>
							<div class="col-3">
								<label class="strong">Application</label>
								<select  name="applicationId"  id="applicationId" class="form-control" >
									<option value="">--Select Application--</option>
									<?php 
										$sqlApp = "SELECT * FROM sys_applications";
										$resApp = mysqli_query($dbcon, $sqlApp);
										while( $rowApp=mysqli_fetch_assoc($resApp))
										{
										  $selected="";
										  if($rowitem['application_id']== $rowApp['id'])
										  	{$selected="selected";}
										?>

									<option <?php echo $selected; ?> value="<?php echo $rowApp['id'] ?>"><?php echo $rowApp['applicname'] ?> </option>

									  <?php } ?>
								</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
								</div>
								<div class="col-3">

									<label class="strong">Module</label>
									<select  name="moduleId"  id="moduleId" class="form-control" >
										<?php 
										$cappId=$rowitem['application_id'];
											if($cappId==""){?>
													<option value="">--Select App First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cappId!=""){


												$sqlModule= "SELECT * FROM sys_modules WHERE application_id=$cappId";
											
												
											$resModule = mysqli_query($dbcon,$sqlModule);
											while( $rowModule=mysqli_fetch_assoc($resModule))
											{
											  $selected="";
											  if($rowitem['module_id']== $rowModule['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowModule['id'] ?>"><?php echo $rowModule['module_name'] ?> </option>

									  <?php } 
											}
											?>
											
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>

								</div>
								<div class="col-3">
									<label class="strong">Value Labels</label>
									<select  name="x-columnId"  id="x-columnId" class="form-control" >
											<?php 
										$cmid=$rowitem['module_id'];
											if($cmid==""){
												?>
													<option value="">--Select Module First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cmid!=""){
												$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
												
												
											$resCol = mysqli_query($dbcon,$sqlCol);
											while( $rowCol=mysqli_fetch_assoc($resCol))
											{
											  $selected="";
											  if($rowitem['data_column_id_x']== $rowCol['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
													<?php echo $rowCol['field_name'] ?> 
												</option>

									  <?php } 
									}

									?>
									</select>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>	
								</div>
								<div class="col-3">
									<label class="strong">Data Values</label> 

									<select  name="y-columnId"  id="y-columnId" class="form-control" >
											<?php 
										$cmid=$rowitem['module_id'];
											if($cmid==""){?>
													<option value="">--Select Module First--</option>
												<?php
											}
										?>

										
											<?php 
											
											if($cmid!=""){
												$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
												echo $sqlCol;
												
											$resCol = mysqli_query($dbcon,$sqlCol);
											while( $rowCol=mysqli_fetch_assoc($resCol))
											{
											  $selected="";
											  if($rowitem['data_column_id_y']== $rowCol['id'])
											  	{$selected="selected";}
											?>

												<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
													<?php echo $rowCol['field_name'] ?> 
												</option>
									  <?php } 
									}
											
											?>
										
									</select>
								</div>
								


									<div class="col-6">
									<label class="strong">Background Color</label>
									<input type="text" name="chart_background"  id="chart_background"  class="form-control" value="<?php echo $rowitem['chart_background']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_background'].'</p>'; ?>
								</div>


									<div class="col-6">
									<label class="strong">Colors List (Seperated by Commas)</label>
									<textarea name="color_property" id="color_property" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['colors'] )) ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
									</div>
									<div class="col-6"></div>

									<div class="col-6">
									 <input class="form-check-input" type="checkbox" name="datalabels" id="datalabels"  <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'checked' : ''; ?>>
									 <label class="strong">Data Labels</label>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
									</div>
								<div class="col-6">
									<div id="dataLabelOptions" <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
										<label class="strong">Label Colors (Seperated by Commas)</label>
									<textarea name="datalabel_colors" id="datalabel_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['datalabel_colors'] )); ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
									</div>

								</div>
									
									


									<div class="col-3">
									 <input class="form-check-input" type="checkbox" name="chart_shadow_enabled" id="chart_shadow_enabled"  <?php echo ($rowitem['chart_shadow_enabled'] == 1) ? 'checked' : ''; ?>>
									 <label class="strong">Enable Chart Shadow</label>
									</div>
									
									<div class="col-3">
									 <input class="form-check-input" type="checkbox" name="stroke_enabled" id="stroke_enabled"  <?php echo ($rowitem['stroke_colors'] != '' || $rowitem['stroke_width'] != '' ) ? 'checked' : ''; ?>>
									 <label class="strong">Enable Border </label>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
									</div>

									<div class="col-6">
									<div id="strokeOptions" <?php echo ($rowitem['stroke_colors'] != '' || $rowitem['stroke_width'] != '' ) ? 'style="display:block"' : 'style="display:none"' ; ?>>
										<label class="strong">Border Colors (Seperated by Commas)</label>
									<textarea name="stroke_colors" id="stroke_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['stroke_colors'] )); ?></textarea>
									<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>

									

									<label class="strong">Border Width </label>
									<input type="text" name="stroke_width"  id="stroke_width"  class="form-control" value="<?php echo $rowitem['stroke_width']; ?>" />
									<?php echo '<p style="color:red;font-size:12px;">'.$error['stroke_width'].'</p>'; ?>
								</div>
								
								</div>
									

									<div class="col-6">
									<label class="strong">Is Active</label>
									<select  name="isActive"  id="isActive" class="form-control" >
										<option value="N"  <?php if($rowitem['active'] == 'N'){ echo ' selected '; } ?> >No</option>
										<option value="Y" <?php if($rowitem['active'] == 'Y'){ echo ' selected '; } ?> >Yes</option>
									</select>
									</div>
									<!--
										 Note: These are the hidden properties used by
										 	   code 
									-->
									<div style="display:none;">
										<input type="hidden"  name="divid"  id="divid" value="<?php echo $vdivid; ?>" />
										<input type="hidden"  name="chart_type"  id="chart_type" value="<?php echo $itemtype; ?>" />
									</div>
									<a style="cursor:pointer;" class="btn btn-primary mt-4"  onClick="updateChart()" ><i></i>Done</a>
									
								
							</div>
						</div>


	<script type="text/javascript">

	$('#datalabels').change(function() {
		var dataLabelOptions = $('#dataLabelOptions');
	   if ($(this).is(':checked')) {
	   	dataLabelOptions.css('display', 'block' );
	   }
	    else { 
	    dataLabelOptions.css('display',  'none' );
	    	
	    }
  });

   $('#stroke_enabled').change(function() {
		var strokeOptions = $('#strokeOptions');
	   if ($(this).is(':checked')) {
	   	strokeOptions.css('display', 'block' );
	   }
	    else { 
	    strokeOptions.css('display',  'none' );
	    	
	    }
  });
   

   
  // Attach a change event listener to the select item
  $('#applicationId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="AppId="+currentValue;
    $.ajax({
				url: "ajax_getModule.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  {
				$("#moduleId").html(response); 
				$("#x-columnId").html('<option value="">--Select Module First--</option>');
				$("#y-columnId").html('<option value="">--Select Module First--</option>');  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });

   $('#moduleId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="moduleId="+currentValue;
    $.ajax({
				url: "ajax_getModuleFields.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  
				{
					
					$("#x-columnId").html(response);
					$("#y-columnId").html(response);  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });
		</script>

	 <?php }

// Donut Chart Ends Here


	 else if($itemtype=='area_basic'){  ?>
	
<div class="widget-body" style="padding: 20px 20px">
	<h5 >Area Chart</h5>
	<p class="text-primary" style="margin-top: -10px;">Customize your chart here</p>
	<div class="row">
		<div class="col-6">
			<label class="strong">Chart Title</label>
			<input type="text" name="chart_title"  id="chart_title"  class="form-control" value="<?php echo $rowitem['chart_title']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_title'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Application</label>
			<select  name="applicationId"  id="applicationId" class="form-control" >
				<option value="">--Select Application--</option>
				<?php 
					$sqlApp = "SELECT * FROM sys_applications";
					$resApp = mysqli_query($dbcon, $sqlApp);
					while( $rowApp=mysqli_fetch_assoc($resApp))
					{
					  $selected="";
					  if($rowitem['application_id']== $rowApp['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowApp['id'] ?>"><?php echo $rowApp['applicname'] ?> </option>

			  <?php } ?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Module</label>
			<select  name="moduleId"  id="moduleId" class="form-control" >
				<?php 
				$cappId=$rowitem['application_id'];
				if($cappId==""){?> <option value="">--Select App First--</option><?php }
				?>
				<?php 
				
				if($cappId!=""){
					$sqlModule= "SELECT * FROM sys_modules WHERE application_id=$cappId";
					$resModule = mysqli_query($dbcon,$sqlModule);
					while( $rowModule=mysqli_fetch_assoc($resModule))
					{
					  $selected="";
					  if($rowitem['module_id']== $rowModule['id'])
					  	{$selected="selected";}
					?>
					<option <?php echo $selected; ?> value="<?php echo $rowModule['id'] ?>"> <?php echo $rowModule['module_name'] ?> </option>

			<?php 
					} 
				}
			?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Data Column X-axis</label>
			<select  name="x-columnId"  id="x-columnId" class="form-control" >
			<?php 
				$cmid=$rowitem['module_id'];
				if($cmid==""){ ?>
					<option value="">--Select Module First--</option>
					<?php
				}
			?>
			<?php 
				if($cmid!=""){
					$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
					$resCol = mysqli_query($dbcon,$sqlCol);
					while( $rowCol=mysqli_fetch_assoc($resCol))
					{
					  $selected="";
					  if($rowitem['data_column_id_x']== $rowCol['id'])
					  	{$selected="selected";}
					?>
					<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
							<?php echo $rowCol['field_name'] ?> 
					</option>

			  <?php } 
			}

			?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>';?>	
		</div>
		<div class="col-3">
			<label class="strong">Data Column Y-axis</label> 
			<select  name="y-columnId"  id="y-columnId" class="form-control" >
				<?php 
					$cmid=$rowitem['module_id'];
					if($cmid==""){
				?>
					<option value="">--Select Module First--</option>
				<?php
					}
				?>
				<?php 
					if($cmid!=""){
					$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
					$resCol = mysqli_query($dbcon,$sqlCol);
					while( $rowCol=mysqli_fetch_assoc($resCol))
					{
						  $selected="";
						  if($rowitem['data_column_id_y']== $rowCol['id'])
						  	{$selected="selected";}
				?>
					<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
								<?php echo $rowCol['field_name'] ?> 
					</option>
				<?php 
					} 
				}
						
			  ?>
					
			</select>
		</div>
		<div class="col-3">
			<label class="strong">X-Axis Label</label>
			<input type="text" name="x-title"  id="x-title"  class="form-control" value="<?php echo $rowitem['label_x']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_x'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Y-Axis Label</label>
			<input type="text" name="y-title"  id="y-title"  class="form-control" value="<?php echo $rowitem['label_y']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_y'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Label Colors</label>
			<input type="text" name="label_colors"  id="label_colors"  class="form-control" value="<?php echo $rowitem['label_colors']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_colors'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Background Color</label>
			<input type="text" name="chart_background"  id="chart_background"  class="form-control" value="<?php echo $rowitem['chart_background']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_background'].'</p>'; ?>
		</div>
		<div class="col-6">
			<label class="strong">Colors List (Seperated by Commas)</label>
			<textarea name="color_property" id="color_property" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['colors'] )) ?></textarea>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
		</div>
		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="datalabels" id="datalabels"  <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Data Labels</label>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>
		<div class="col-6">
			<div id="dataLabelOptions" <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
				<label class="strong">Label Colors (Seperated by Commas)</label>
				<textarea name="datalabel_colors" id="datalabel_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['datalabel_colors'] )); ?></textarea>
				<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
			</div>
		</div>
		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="markers" id="markers" class="form-control" <?php echo ($rowitem['markers_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Markers</label>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>
		<div class="col-6">
			<div id="markersOptions" <?php echo ($rowitem['markers_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>

				<label class="strong">Markers Size</label>
				<input class="form-control" type="number" name="marker_size" id="marker_size" class="form-control" min="0" max="10" value="<?php echo $rowitem['markers_size']; ?>" >

				<label class="strong">Label Colors (Seperated by Commas)</label>
				<textarea name="marker_colors" id="marker_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['marker_colors'] )); ?></textarea>
				<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>

				<?php 
				$mShapes = array("circle", "square");?>
				<label class="strong">Markers Shape</label>
				<select  name="marker_shape"  id="marker_shape" class="form-control" >
				<?php 

					 foreach ($mShapes as $mShape) {
				          // Use htmlspecialchars to prevent XSS attacks
				          $encodedShape = htmlspecialchars($mShape);
				          $isSelected = ($encodedShape === $rowitem['marker_shape']) ? 'selected' : '';
				        echo "<option value='$encodedShape' $isSelected>$encodedShape</option>";}

				?>
				</select>
				<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>

			</div>
		</div>
		<div class="col-6">
			<label class="strong">Stroke Style</label>
			<select  name="strokeStyle"  id="strokeStyle" class="form-control" >
			<?php 

				$sStyles = array(
							    array("value" => "straight", "label" => "Straight - Default"),
							    array("value" => "smooth", "label" => "Smooth"),
							    array("value" => "stepline", "label" => "Step_line")
							);
				 foreach ($sStyles as $sStyle) {
	
				    $encodedValue = htmlspecialchars($sStyle['value']);
				    $encodedLabel = htmlspecialchars($sStyle['label']);
				    $isSelected = ($encodedValue === $rowitem['stroke_curve']) ? 'selected' : '';
				    echo "<option value='$encodedValue' $isSelected>$encodedLabel</option>";
				}

			?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>
		<div class="col-6">
			<label class="strong">Is Active</label>
			<select  name="isActive"  id="isActive" class="form-control" >
				<option value="N"  <?php if($rowitem['active'] == 'N'){ echo ' selected '; } ?> >No</option>
				<option value="Y" <?php if($rowitem['active'] == 'Y'){ echo ' selected '; } ?> >Yes</option>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>
		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="chart_toolbar_show" id="chart_toolbar_show"  <?php echo ($rowitem['chart_tooblbar_show'] == 1) ? 'checked' : ''; ?>>
			 <label class="strong">Show Toolbar</label>
		</div>
		<div class="col-6">						 
			 <input class="form-check-input" type="checkbox" name="chart_shadow_enabled" id="chart_shadow_enabled"  <?php echo ($rowitem['chart_shadow_enabled'] == 1) ? 'checked' : ''; ?>>
			 <label class="strong">Enable Chart Shadow</label>
		</div>

									

		<!--
			 Note: These are the hidden properties used by
			 	   code 
		-->
		<div style="display:none;">
			<input type="hidden"  name="divid"  id="divid" value="<?php echo $vdivid; ?>" />
			<input type="hidden"  name="chart_type"  id="chart_type" value="<?php echo $itemtype; ?>" />
		</div>
		
		<a style="cursor:pointer;" class="btn btn-primary mt-4"  onClick="updateChart()" ><i></i>Done</a>

	</div>
</div>
		

<script type="text/javascript">

	$('#datalabels').change(function() {
	var dataLabelOptions = $('#dataLabelOptions');
	if ($(this).is(':checked')) {
		dataLabelOptions.css('display', 'block' );
		$('#markers').css('display','none');
		$('#markers').next('label').css('display','none');
	}
	else { 
		dataLabelOptions.css('display',  'none' );
		$('#markers').css('display','inline-block');
		$('#markers').next('label').css('display','inline-block');
	}
	});

	$('#markers').change(function() {
	var markersOptions = $('#markersOptions');
	if ($(this).is(':checked')) {
		markersOptions.css('display', 'block' );
		$('#datalabels').css('display','none');
		$('#datalabels').next('label').css('display','none');
	}
	else {
	 markersOptions.css('display',  'none' );
	 $('#datalabels').css('display','inline-block');
	 $('#datalabels').next('label').css('display','inline-block');
	}
	});



	// Attach a change event listener to the select item
	$('#applicationId').change(function() {
	// Get the current value of the select item
	var currentValue = $(this).val();
	var postDataString="AppId="+currentValue;
	$.ajax({
			url: "ajax_getModule.php",
			type : "POST",
			cache : false,
			data : postDataString,
			success: function(response)  {
			$("#moduleId").html(response); 
			$("#x-columnId").html('<option value="">--Select Module First--</option>');
			$("#y-columnId").html('<option value="">--Select Module First--</option>');  
			//console.log(document.getElementById('contentdiv').innerHTML);
			}
		})


	});

	$('#moduleId').change(function() {
	// Get the current value of the select item
	var currentValue = $(this).val();
	var postDataString="moduleId="+currentValue;
	$.ajax({
			url: "ajax_getModuleFields.php",
			type : "POST",
			cache : false,
			data : postDataString,
			success: function(response)  
			{
				
				$("#x-columnId").html(response);
				$("#y-columnId").html(response);  
			//console.log(document.getElementById('contentdiv').innerHTML);
			}
		})


	});

</script>


	<?php
	 }

 else if($itemtype=='radar_basic')
 	{  ?>

<div class="widget-body" style="padding: 20px 20px">
	<h5 >Radar Chart</h5>
	<p class="text-primary" style="margin-top: -10px;">Customize your chart here</p>
	<div class="row">
		<div class="col-6">
			<label class="strong">Chart Title</label>
			<input type="text" name="chart_title"  id="chart_title"  class="form-control" value="<?php echo $rowitem['chart_title']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_title'].'</p>'; ?>
		</div>
		
		<div class="col-3">
			<label class="strong">Application</label>
			<select  name="applicationId"  id="applicationId" class="form-control" >
				<option value="">--Select Application--</option>
				<?php 
					$sqlApp = "SELECT * FROM sys_applications";
					$resApp = mysqli_query($dbcon, $sqlApp);
					while( $rowApp=mysqli_fetch_assoc($resApp))
					{
					  $selected="";
					  if($rowitem['application_id']== $rowApp['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowApp['id'] ?>"><?php echo $rowApp['applicname'] ?> </option>

			  <?php } ?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Module</label>
			<select  name="moduleId"  id="moduleId" class="form-control" >
				<?php 
				$cappId=$rowitem['application_id'];
					if($cappId==""){
				?>
					<option value="">--Select App First--</option>
				<?php
				 }
					if($cappId!=""){
					$sqlModule= "SELECT * FROM sys_modules WHERE application_id=$cappId";
					
						
					$resModule = mysqli_query($dbcon,$sqlModule);
					while( $rowModule=mysqli_fetch_assoc($resModule))
					{
					  $selected="";
					  if($rowitem['module_id']== $rowModule['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowModule['id'] ?>"><?php echo $rowModule['module_name'] ?> </option>

			  <?php } 
					}
					?>
					
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>
		<div class="col-3">
			<label class="strong">Data Column X-axis</label>
			<select  name="x-columnId"  id="x-columnId" class="form-control" >
					<?php 
				$cmid=$rowitem['module_id'];
					if($cmid==""){
						?>
							<option value="">--Select Module First--</option>
						<?php
					}
				?>

				
					<?php 
					
					if($cmid!=""){
						$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
						
						
					$resCol = mysqli_query($dbcon,$sqlCol);
					while( $rowCol=mysqli_fetch_assoc($resCol))
					{
					  $selected="";
					  if($rowitem['data_column_id_x']== $rowCol['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
							<?php echo $rowCol['field_name'] ?> 
						</option>

			  <?php } 
			}

			?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>	
		</div>
		<div class="col-3">
			<label class="strong">Data Column Y-axis</label> 
			<select  name="y-columnId"  id="y-columnId" class="form-control" >
					<?php 
				$cmid=$rowitem['module_id'];
					if($cmid==""){?>
							<option value="">--Select Module First--</option>
						<?php
					}
				?>

				
					<?php 
					
					if($cmid!=""){
						$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
						echo $sqlCol;
						
					$resCol = mysqli_query($dbcon,$sqlCol);
					while( $rowCol=mysqli_fetch_assoc($resCol))
					{
					  $selected="";
					  if($rowitem['data_column_id_y']== $rowCol['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
							<?php echo $rowCol['field_name'] ?> 
						</option>
			  <?php } 
			}
					
					?>
				
			</select>
		</div>
		<div class="col-3">
			<label class="strong">X-Axis Label</label>
			<input type="text" name="x-title"  id="x-title"  class="form-control" value="<?php echo $rowitem['label_x']; ?>" />
			<?php echo '<span style="color:red;font-size:12px;">'.$error['label_x'].'</span>'; ?>
		</div>
		<div class="col-3">						

			<label class="strong">Y-Axis Label</label>
			<input type="text" name="y-title"  id="y-title"  class="form-control" value="<?php echo $rowitem['label_y']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_y'].'</p>'; ?>
		</div>

		<div class="col-3">
			<label class="strong">Label Colors</label>
			<input type="text" name="label_colors"  id="label_colors"  class="form-control" value="<?php echo $rowitem['label_colors']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['label_colors'].'</p>'; ?>
		</div>
		<div class="col-3">

		<label class="strong">Background Color</label>
		<input type="text" name="chart_background"  id="chart_background"  class="form-control" value="<?php echo $rowitem['chart_background']; ?>" />
		<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_background'].'</p>'; ?>

		</div>
		<div class="col-6">
		<label class="strong">Colors List (Seperated by Commas)</label>
		<textarea name="color_property" id="color_property" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['colors'] )) ?></textarea>
		<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
		</div>
		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="datalabels" id="datalabels"  <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Data Labels</label>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>
		<div class="col-6">
			<div id="dataLabelOptions" <?php echo ($rowitem['datalabel_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
			<label class="strong">Label Colors (Seperated by Commas)</label>
			<textarea name="datalabel_colors" id="datalabel_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['datalabel_colors'] )); ?></textarea>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
			</div>
		</div>
		<div class="col-6">							
			<input class="form-check-input" type="checkbox" name="markers" id="markers" class="form-control" <?php echo ($rowitem['markers_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Markers</label>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>
		<div class="col-6">
			<div id="markersOptions" <?php echo ($rowitem['markers_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>

				<label class="strong">Markers Size</label>
				<input class="form-control" type="number" name="marker_size" id="marker_size" class="form-control" min="0" max="10" value="<?php echo $rowitem['markers_size']; ?>" >


				<label class="strong">Label Colors (Seperated by Commas)</label>
				<textarea name="marker_colors" id="marker_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['marker_colors'] )); ?></textarea>
				<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
				
				<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
			</div>
		</div>
		<div class="col-6">
			<label class="strong">Is Active</label>
			<select  name="isActive"  id="isActive" class="form-control" >
			<option value="N"  <?php if($rowitem['active'] == 'N'){ echo ' selected '; } ?> >No</option>
			<option value="Y" <?php if($rowitem['active'] == 'Y'){ echo ' selected '; } ?> >Yes</option>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>
		</div>
		<div class="col-6">
			<input class="form-check-input" type="checkbox" name="chart_shadow_enabled" id="chart_shadow_enabled"  <?php echo ($rowitem['chart_shadow_enabled'] == 1) ? 'checked' : ''; ?>>
			<label class="strong">Enable Shadow</label>
		</div>
						

		<!-- Note: These are the hidden properties used by code -->
		<div style="display:none;">
		<input type="hidden"  name="divid"  id="divid" value="<?php echo $vdivid; ?>" />
		<input type="hidden"  name="chart_type"  id="chart_type" value="<?php echo $itemtype; ?>" />
		</div>					
		<a style="cursor:pointer;" class="btn btn-primary mt-4"  onClick="updateChart()" ><i></i>Done</a>
															
	</div>
</div>
		
		

<script type="text/javascript">

	$('#datalabels').change(function() {
	var dataLabelOptions = $('#dataLabelOptions');
	if ($(this).is(':checked')) {
		dataLabelOptions.css('display', 'block' );
		$('#markers').css('display','none');
		$('#markers').next('label').css('display','none');
	}
	else { 
		dataLabelOptions.css('display',  'none' );
		$('#markers').css('display','inline-block');
		$('#markers').next('label').css('display','inline-block');
	}
	});

	$('#markers').change(function() {
	var markersOptions = $('#markersOptions');
	if ($(this).is(':checked')) {
		markersOptions.css('display', 'block' );
		$('#datalabels').css('display','none');
		$('#datalabels').next('label').css('display','none');
	}
	else {
	 markersOptions.css('display',  'none' );
	 $('#datalabels').css('display','inline-block');
	 $('#datalabels').next('label').css('display','inline-block');
	}
	});



	// Attach a change event listener to the select item
	$('#applicationId').change(function() {
	// Get the current value of the select item
	var currentValue = $(this).val();
	var postDataString="AppId="+currentValue;
	$.ajax({
			url: "ajax_getModule.php",
			type : "POST",
			cache : false,
			data : postDataString,
			success: function(response)  {
			$("#moduleId").html(response); 
			$("#x-columnId").html('<option value="">--Select Module First--</option>');
			$("#y-columnId").html('<option value="">--Select Module First--</option>');  
			//console.log(document.getElementById('contentdiv').innerHTML);
			}
		})


	});

	$('#moduleId').change(function() {
	// Get the current value of the select item
	var currentValue = $(this).val();
	var postDataString="moduleId="+currentValue;
	$.ajax({
			url: "ajax_getModuleFields.php",
			type : "POST",
			cache : false,
			data : postDataString,
			success: function(response)  
			{
				
				$("#x-columnId").html(response);
				$("#y-columnId").html(response);  
			//console.log(document.getElementById('contentdiv').innerHTML);
			}
		})


	});
	
</script>

 	<?php 
	} 



// Scattered Chart Starts Here



 else if($itemtype=='scattered_basic'){
	 	?>
	 
<div class="widget-body" style="padding: 50px 20px; " >
	<h5 >Scattered Chart</h5>
	<p class="text-primary" style="margin-top: -10px;">Customize your chart here</p>	
	<!-- Row -->
	<div class="row" >
		<div class="col-6">
			<label class="strong">Chart Title</label>
			<input type="text" name="chart_title"  id="chart_title"  class="form-control" value="<?php echo $rowitem['chart_title']; ?>" />
			<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_title'].'</p>'; ?>
		</div>

		<div class="col-3">
			<label class="strong">Application</label>
			<select  name="applicationId"  id="applicationId" class="form-control" >
				<option value="">--Select Application--</option>
				<?php 
					$sqlApp = "SELECT * FROM sys_applications";
					$resApp = mysqli_query($dbcon, $sqlApp);
					while( $rowApp=mysqli_fetch_assoc($resApp))
					{
					  $selected="";
					  if($rowitem['application_id']== $rowApp['id'])
					  	{$selected="selected";}
					?>

						<option <?php echo $selected; ?> value="<?php echo $rowApp['id'] ?>"><?php echo $rowApp['applicname'] ?> </option>

			  <?php } ?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>


		<div class="col-3">
		<label class="strong">Module</label>
		<select  name="moduleId"  id="moduleId" class="form-control" >
			<?php 
			$cappId=$rowitem['application_id'];
				if($cappId==""){?>
						<option value="">--Select App First--</option>
					<?php
				}
			?>

			
				<?php 
				
				if($cappId!=""){


					$sqlModule= "SELECT * FROM sys_modules WHERE application_id=$cappId";
				
					
				$resModule = mysqli_query($dbcon,$sqlModule);
				while( $rowModule=mysqli_fetch_assoc($resModule))
				{
				  $selected="";
				  if($rowitem['module_id']== $rowModule['id'])
				  	{$selected="selected";}
				?>

					<option <?php echo $selected; ?> value="<?php echo $rowModule['id'] ?>"><?php echo $rowModule['module_name'] ?> </option>

		  <?php } 
				}
				?>
				
		</select>
		<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>
		</div>

			<div class="col-3">
		<label class="strong">Data Column X-axis</label>
		<select  name="x-columnId"  id="x-columnId" class="form-control" >
				<?php 
			$cmid=$rowitem['module_id'];
				if($cmid==""){
					?>
						<option value="">--Select Module First--</option>
					<?php
				}
			?>

			
				<?php 
				
				if($cmid!=""){
					$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
					
					
				$resCol = mysqli_query($dbcon,$sqlCol);
				while( $rowCol=mysqli_fetch_assoc($resCol))
				{
				  $selected="";
				  if($rowitem['data_column_id_x']== $rowCol['id'])
				  	{$selected="selected";}
				?>

					<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
						<?php echo $rowCol['field_name'] ?> 
					</option>

		  <?php } 
		}

		?>
		</select>
		<?php echo '<p style="color:red;font-size:12px;">'.$error['isrequired'].'</p>'; ?>	
		</div>
		<div class="col-3">
		<label class="strong">Data Column Y-axis</label> 

		<select  name="y-columnId"  id="y-columnId" class="form-control" >
				<?php 
			$cmid=$rowitem['module_id'];
				if($cmid==""){?>
						<option value="">--Select Module First--</option>
					<?php
				}
			?>

			
				<?php 
				
				if($cmid!=""){
					$sqlCol= "SELECT * FROM sys_module_fields WHERE dznr_moduleid=$cmid";
					echo $sqlCol;
					
				$resCol = mysqli_query($dbcon,$sqlCol);
				while( $rowCol=mysqli_fetch_assoc($resCol))
				{
				  $selected="";
				  if($rowitem['data_column_id_y']== $rowCol['id'])
				  	{$selected="selected";}
				?>

					<option <?php echo $selected; ?> value="<?php echo $rowCol['id'] ?>">
						<?php echo $rowCol['field_name'] ?> 
					</option>
		  <?php } 
		}
				
				?>
			
		</select>
	
	</div>

	<div class="col-3">
		
		<label class="strong">X-Axis Label</label>
		<input type="text" name="x-title"  id="x-title"  class="form-control" value="<?php echo $rowitem['label_x']; ?>" />
		<?php echo '<p style="color:red;font-size:12px;">'.$error['label_x'].'</p>'; ?>
		
	</div>

	<div class="col-3">									
		<label class="strong">Y-Axis Label</label>
		<input type="text" name="y-title"  id="y-title"  class="form-control" value="<?php echo $rowitem['label_y']; ?>" />
		<?php echo '<p style="color:red;font-size:12px;">'.$error['label_y'].'</p>'; ?>
	</div>

	

	
		<div class="col-6">
		<label class="strong">Label Colors</label>
		<input type="text" name="label_colors"  id="label_colors"  class="form-control" value="<?php echo $rowitem['label_colors']; ?>" />
		<?php echo '<p style="color:red;font-size:12px;">'.$error['label_colors'].'</p>'; ?>
		</div>
		<div class="col-6">
		<label class="strong">Chart Background Color</label>
		<input type="text" name="chart_background"  id="chart_background"  class="form-control" value="<?php echo $rowitem['chart_background']; ?>" />
		<?php echo '<p style="color:red;font-size:12px;">'.$error['chart_background'].'</p>'; ?>
		</div>



		
		


		<div class="col-6">
		 <input class="form-check-input" type="checkbox" name="markers" id="markers" class="form-control" <?php echo ($rowitem['markers_enabled'] == 1) ? 'checked' : ''; ?>>
		 <label class="strong">Enable Markers</label>
		 </div>
		<div class="col-6">
		<div id="markersOptions" <?php echo ($rowitem['markers_enabled'] == 1) ? 'style="display:block"' : 'style="display:none"' ; ?>>
			
			<label class="strong">Markers Size</label>
			<input class="form-control" type="number" name="marker_size" id="marker_size" class="form-control" min="0" max="10" value="<?php echo $rowitem['markers_size']; ?>" >


			<label class="strong">Label Colors (Seperated by Commas)</label>
			<textarea name="marker_colors" id="marker_colors" class="form-control" placeholder="#FF000,#989887" ><?php  echo str_replace('"', '', trim($rowitem['marker_colors'] )); ?></textarea>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['default_value'].'</p>'; ?>
			<?php 
			$mShapes = array("circle", "square");?>
			<label class="strong">Markers Shape</label>
			<select  name="marker_shape"  id="marker_shape" class="form-control" >
			<?php 

				 foreach ($mShapes as $mShape) {
			          // Use htmlspecialchars to prevent XSS attacks
			          $encodedShape = htmlspecialchars($mShape);
			          $isSelected = ($encodedShape === $selectedShape) ? 'selected' : '';
			        echo "<option value='$encodedShape' $isSelected>$encodedShape</option>";}

			?>
			</select>
			<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>


		</div>

		
		

	
		<div class="col-6">
		<label class="strong">Is Active</label>
		<select  name="isActive"  id="isActive" class="form-control" >
			<option value="N"  <?php if($rowitem['active'] == 'N'){ echo ' selected '; } ?> >No</option>
			<option value="Y" <?php if($rowitem['active'] == 'Y'){ echo ' selected '; } ?> >Yes</option>
		</select>
		<?php echo '<p style="color:red;font-size:12px;">'.$error['active'].'</p>'; ?>

		</div>		
		<div class="col-6">							
		 <input class="form-check-input" type="checkbox" name="chart_shadow_enabled" id="chart_shadow_enabled"  <?php echo ($rowitem['chart_shadow_enabled'] == 1) ? 'checked' : ''; ?>>
		 <label class="strong">Enable Chart Shadow</label>
		</div>
		<br>

		<!--
			 Note: These are the hidden properties used by
			 	   code 
		-->
		<div style="display:none;">
			<input type="hidden"  name="divid"  id="divid" value="<?php echo $vdivid; ?>" />
			<input type="hidden"  name="chart_type"  id="chart_type" value="<?php echo $itemtype; ?>" />
		</div>




		<a style="cursor:pointer;" class="btn btn-primary mt-4"  onClick="updateChart()" ><i></i>Done</a>
		
	
</div>

</div>
<!-- // Column END -->

</div>


		<script type="text/javascript">



	$('#markers').change(function() {
		var markersOptions = $('#markersOptions');
	   if ($(this).is(':checked')) {
	   	markersOptions.css('display', 'block' );
	   	
	   }
	    else {
	     markersOptions.css('display',  'none' );
	    
	 }
  });
   

   
  // Attach a change event listener to the select item
  $('#applicationId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="AppId="+currentValue;
    $.ajax({
				url: "ajax_getModule.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  {
				$("#moduleId").html(response); 
				$("#x-columnId").html('<option value="">--Select Module First--</option>');
				$("#y-columnId").html('<option value="">--Select Module First--</option>');  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });

   $('#moduleId').change(function() {
    // Get the current value of the select item
    var currentValue = $(this).val();
    var postDataString="moduleId="+currentValue;
    $.ajax({
				url: "ajax_getModuleFields.php",
				type : "POST",
				cache : false,
				data : postDataString,
				success: function(response)  
				{
					
					$("#x-columnId").html(response);
					$("#y-columnId").html(response);  
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})


  });
		</script>

	 <?php }




// Scattered Chart Ends Here



	else { echo " Nothing to display 1 "; }?>