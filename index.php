<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Drag and Drop with Mozilla</title>
	
		
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/NicEdit/0.93/nicEdit.min.js"></script>
	
	<!-- source code followed : http://www.marcorpsa.com/ee/t1154.html -->
	<link rel="stylesheet" href="http://www.marcorpsa.com/ee/plugins/fancybox/jquery.fancybox.css" type="text/css" media="screen"/> 
	<link rel="stylesheet" href="http://www.marcorpsa.com/ee/plugins/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" /> 
	<script src="http://www.marcorpsa.com/ee/plugins/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="http://www.marcorpsa.com/ee/plugins/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="http://www.marcorpsa.com/ee/plugins/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script src="https://kit.fontawesome.com/1d1d009a49.js" crossorigin="anonymous"></script>
	<script>
	$(function() {  $(".fancybox").fancybox({  'type' : 'iframe' });		  });
	  
	</script>
	  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
	 <style>
		
		.dropzone{
			border:1px black dashed; 
			background-color: white;
			min-height:30px;
		}
		
		.list-group .list-group-item {
		  border-radius: 0;
		  cursor: move;
		}

		.list-group .list-group-item:hover {
		  background-color: #f7f7f7;
		}


a#addTabBtn:hover,
a#addTabBtn:focus 
   {
    border-color: transparent;
    box-shadow:transparent;
}

a#addTabBtn {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

	</style>

	<style>
#divfields_list 
{
     /*position: fixed;*/
	   overflow-y: scroll; 
	   height:550px;
	   width:100%;
	 	   /*margin-top: -18%;*/
}
	#sidepanel{
/*		width:240px;*/
		margin-left:5px;
	}	
	#divfields_list2 
{
     /*position: fixed;*/
	   overflow-x: scroll; 
	   overflow-y: ;
	   height:100px;
	   width:100%;
	 	   /*margin-top: -18%;*/
}
	#sidepanel2{
/*		width:240px;*/
		margin-left:5px;
	}
	#divfields_list::-webkit-scrollbar {
  width: 5px;

  margin-left: 10px;
}
#divfields_list::-webkit-scrollbar-track {
  background-color: transparent;

}
#divfields_list::-webkit-scrollbar-thumb {
   box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
   background-color:  rgba(12, 99, 228, 0.8);
   border-radius: 5px;
   max-height: 5px;
}
	#sortablelist{
		min-height: 550px;
	}
	.nicEdit-panelContain:has(div){
		width: 100%;
	}
	.mobile-menu{
		display: none;
	}
@media (max-width: 575px) {
  .window-menu {
    display: none;
  }
  .mobile-menu {
    display: block;
  }
}

.myPlaceholder {
      margin-top: 50px;
    }
    .icon-box{
 background-color: #e7f1ff;
    border-radius: 5px;
    border-color: #bdd8ff;
    border-width: 1px;
    border-style: solid;
   
    }
 .name {
    font-size: .8125rem;
}
    .icon-box i{
    	color: #0c63e4;
    	font-size: 30px;
    }


</style>

  </head>
  <body>

  <?php error_reporting(E_ALL && ~E_WARNING && ~E_NOTICE);  ?>
	<div class="container-fluid " >
	
	<ul class="nav nav-tabs" id="myTab" role="tablist">
	
  <div class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Module Info</button>
  </div>
  <div class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Module Items</button>
  </div>
  
</ul>


<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
  <div class="container mt-5" >
		<div class="row " >
								
			<!-- Column -->
			<div class="col-6">
					<input type="hidden"  name="moduleid"  id="moduleid"  value="<?php echo $moduleid; ?>" />
					<input type="hidden"  name="userid"  id="userid"  value="<?php echo $usrid; ?>" />
					
					<label class="strong">Module Name</label>
					<input type="text"  name="module_name"  id="module_name" class="form-control" value="" required />
					<?php echo '<p style="color:red;font-size:12px;">'.$error['module_name'].'</p>'; ?>
					
					<label class="strong">Module Type</label>
					<select  name="module_type"  id="module_type" class="form-control"  required >
						<option value="">--Select--</option>
						<option value="application" <?php if($module_type == 'application'){ echo ' selected '; } ?> >Application</option>
						<option value="lookup" <?php if($module_type == 'lookup'){ echo ' selected '; } ?> >Lookup</option>
						<option value="submodule" <?php if($module_type == 'submodule'){ echo ' selected '; } ?> >Sub-Module</option>
					</select>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['module_type'].'</p>'; ?>
					
				

					<?php /* ?>
					<label class="strong">Application</label>
					
					<?php $sqlapplic = "select * from applications where active='Y' and clientid='".$clientid."'";
					/// check user allowed applications here ... use join with existing query
					$resapplic = mysqli_query($dbcon, $sqlapplic);
					
		
					?>
					<select  name="application"  id="application" class="form-control" required >
						<option value="2">--Select--</option>
						<?php while($rowapplic = mysqli_fetch_assoc($resapplic)){ ?>
							<option value="<?php echo $rowapplic['id']; ?>" <?php if($application == $rowapplic['id']){ ?> SELECTED <?php } ?> ><?php echo $rowapplic['appdescr']; ?></option>
						<?php } ?>
					</select>
					
					<?php echo '<p style="color:red;font-size:12px;">'.$error['application'].'</p>'; ?>
					<?php */ ?>

					
				
					
				
			</div>
			<!-- // Column END -->
			
			<!-- Column -->
			<div class="col-6">
				
				
					
					<label class="strong">Description / Comments</label>
					<textarea  name="module_descr"  id="module_descr" class="form-control" ><?php echo $mdule_descr; ?></textarea>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['module_descr'].'</p>'; ?>
					

					<label class="strong">
						<input type="checkbox"  name="show_menu"  id="show_menu"  value="Y" checked />
					Show on Menu</label>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['show_menu'].'</p>'; ?>
					
					<label class="strong">
						<input type="checkbox"  name="frontend_module"  id="frontend_module"  value="Y" checked />
					Display at front-end </label>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['frontend_module'].'</p>'; ?>
					
					

					<?php /* ?>
					<label class="strong">Generate Page for Add record</label>
					<select name="add_page"  id="add_page" class="form-control" >
						<option value="Y" <?php if($add_page=='Y'){ echo 'selected'; } ?> >Yes</option>
						<option value="N" <?php if($add_page=='N'){ echo 'selected'; } ?> >No</option>
					</select>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['add_page'].'</p>'; ?>
					
					<label class="strong">Generate Page for Edit record</label>
					<select name="edit_page"  id="edit_page" class="form-control" >
						<option value="Y" <?php if($edit_page=='Y'){ echo 'selected'; } ?> >Yes</option>
						<option value="N" <?php if($edit_page=='N'){ echo 'selected'; } ?> >No</option>
					</select>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['edit_page'].'</p>'; ?>
					
					<label class="strong">Generate Page for Duplicate record</label>
					<select name="duplicate_page"  id="duplicate_page" class="form-control" >
						<option value="Y" <?php if($duplicate_page=='Y'){ echo 'selected'; } ?> >Yes</option>
						<option value="N" <?php if($duplicate_page=='N'){ echo 'selected'; } ?> >No</option>
					</select>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['duplicate_page'].'</p>'; ?>
					
					<label class="strong">Generate Page for View record</label>
					<select name="view_page"  id="view_page" class="form-control" >
						<option value="Y" <?php if($view_page=='Y'){ echo 'selected'; } ?> >Yes</option>
						<option value="N" <?php if($view_page=='N'){ echo 'selected'; } ?> >No</option>
					</select>
					<?php echo '<p style="color:red;font-size:12px;">'.$error['view_page'].'</p>'; ?>
					
					
					<input type="hidden" name="list_page" id="list_page" value="Y" />
					
					<?php */ ?>
				
				
			</div>
			
			
		</div>
	</div>
				


  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
  	<!-- Mobile Menu Starts here -->
  
		  <!-- <div class="row" style=" margin-top:20px; margin-right: 10px;">
		    <div class="col-sm-12 mobile-menu" style=" background-color:white">
		      <div id="divfields_list2" style="display:block;" >
						<div id="sidepanel2" class="draggable content" >
							<?php include('toppanel.php'); ?>
						</div>
						<div class="container" style="margin-top:30px">
								<div class="d-grid gap-2">
										<input type="button" class="btn btn-info btn-sm" onClick="javascript:show_code();" value="Show Code" />	
										<input type="button" class="btn btn-success btn-sm" onClick="javascript:save_module();" value="Submit" />
								</div>
						</div>
					</div>
		    </div>
		  </div> -->

  <!-- Mobile Menu Ends here -->
  <div class="row" style="margin-top:20px;margin-right: 10px;">
    <div class="col-sm-4 col-md-3 col-lg-3 window-menu" style="background-color:white">
      <div id="divfields_list" style="display:block;margin-left:-10px;" >
				<div id="sidepanel" class="draggable content" >
					<?php include('sidepanel.php'); ?>
				</div>
				<div class="container" style="margin-top:30px">
						<div class="d-grid gap-2">
								<input type="button" class="btn btn-info btn-sm" onClick="javascript:show_code();" value="Show Code" />	
								<input type="button" class="btn btn-success btn-sm" onClick="javascript:save_module();" value="Submit" />
						</div>
				</div>
			</div>
    </div>
    <div id="sortablelist" class="dropzone col-sm-8 col-md-9 col-lg-9 list-group content-parent" style="min-height:250px; background-color:#F9F9F9; border:1px black dashed; min-height: 550px;"  > 
	  </div>
  </div>

		<div style="display:block;" class="fancybox">
			<div id="contentdiv"  ></div>
		</div>

	
		<div id="source_code"  ></div>
		<div id="form_code"  ></div>
	
  
  </div>
  
  

</div>



  
</div>


	<footer>
     
	</footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> 


	 <!-- sub-modules with tab script starts here -->


 
<!-- sub-modules with tab script ends here -->


	<script>

		new Sortable(sortablelist, {
			animation: 150,
			 ghostClass: 'blue-background-class'
		});
		
		
		
		function updateChart(){

				var vvdivid = 'NA';
				var vchart_type = '';
				var vChart_title = '';
				var vXTitle='';
				var vYTitle='';
				var vApplicationId='';
				var vModuleId='';
				var vXcolumnId='';
				var vYcolumnId='';
				var visActive='';
				var vlabel_colors='';
				var chart_background="";
				var vcolors ="";
				var vdatalabels = 0;
				var vdatalabel_colors = "";
				var vmarkers= 0;
				var vmarker_size = "";
				var vmarker_colors = "";
				var vmarker_shape = "";
				var vstrokeStyle = "";
				var vstroke_colors = "";
				var vstroke_width = 0;
				var vchart_toolbar_show = 0;
				var vchart_shadow_enabled = 0;	
				var vbar_horizontal = 0;
				var vbar_radius = "";
					
			if (document.getElementById('divid').value) {	
				 vdivid = document.getElementById('divid').value;
			}	
			
			if (document.getElementById('chart_type')) {
				 vchart_type = document.getElementById('chart_type').value;
			}
		
			if (document.getElementById('chart_title')) {
				 vChart_title = document.getElementById('chart_title').value;
			}
			
			if(document.getElementById('x-title')){
				 vXTitle = document.getElementById('x-title').value; 
			}
			if(document.getElementById('y-title')){
				 vYTitle = document.getElementById('y-title').value; 
			}

				if(document.getElementById('applicationId')){
				 vApplicationId = document.getElementById('applicationId').value; 
			}

			if(document.getElementById('moduleId')){
				 vModuleId = document.getElementById('moduleId').value; 
			}
			
			if(document.getElementById('x-columnId')){
				 vXcolumnId = document.getElementById('x-columnId').value; 
			}

			if(document.getElementById('y-columnId')){
				 vYcolumnId = document.getElementById('y-columnId').value; 
			}
			if(document.getElementById('isActive')){
				 visActive = document.getElementById('isActive').value; 
			}
			if(document.getElementById('chart_background')){
				chart_background = document.getElementById('chart_background').value;
			}

      if(document.getElementById('label_colors')){
				vlabel_colors = document.getElementById('label_colors').value;
			}
// chart type based properties functionality
			// Starts Here

			if (vchart_type == "line_basic") 
			{
    			
			    if (document.getElementById('color_property')) {
			        
			        var colorValues = document.getElementById('color_property').value.split(',');
			        var vcolors = colorValues.map(function(color) {
			            return '"' + color.trim() + '"';
			        });
			    }

			    if (document.getElementById('datalabels')) {
					      if($("#datalabels").is(':checked')){ 
					      	vdatalabels = 1; 
					      	if(document.getElementById('datalabel_colors')){
										var colorValues = document.getElementById('datalabel_colors').value.split(',');
										var vdatalabel_colors = colorValues.map(function(color) {
											return '"' + color.trim() + '"';
										});
					      	}
					      }

					      

			    }

			    if (document.getElementById('markers')) {
			  			 if($("#markers").is(':checked')){

			  			 					vmarkers = 1; 
			  			 					if(document.getElementById('marker_size')){
								      	 vmarker_size = document.getElementById('marker_size').value;
								       }

								      if(document.getElementById('marker_colors')){
												var colorValues = document.getElementById('marker_colors').value.split(',');
												var vmarker_colors = colorValues.map(function(color) {
													return '"' + color.trim() + '"';
												});
								      }

								        if(document.getElementById('marker_shape')){
								      	 vmarker_shape = document.getElementById('marker_shape').value;
								      }
			  			 }
			    }

			    if(document.getElementById('strokeStyle')){
			    	vstrokeStyle = document.getElementById('strokeStyle').value;
			    }

			    if(document.getElementById('chart_toolbar_show')){
			    	if ($("#chart_toolbar_show").is(':checked')) {
			    		vchart_toolbar_show=1;
			    	}
			    }

			    if(document.getElementById('chart_shadow_enabled')){
			    	if ($("#chart_shadow_enabled").is(':checked')) {
			    		vchart_shadow_enabled=1;
			    	}
			    }
			    
			    

			    
		}

	if (vchart_type == "area_basic") 
			{
    			
			    if (document.getElementById('color_property')) {
			        
			        var colorValues = document.getElementById('color_property').value.split(',');
			        var vcolors = colorValues.map(function(color) {
			            return '"' + color.trim() + '"';
			        });
			    }

			    if (document.getElementById('datalabels')) {
					      if($("#datalabels").is(':checked')){ 
					      	vdatalabels = 1; 
					      	if(document.getElementById('datalabel_colors')){
										var colorValues = document.getElementById('datalabel_colors').value.split(',');
										var vdatalabel_colors = colorValues.map(function(color) {
											return '"' + color.trim() + '"';
										});
					      	}
					      }

					      

			    }

			    if (document.getElementById('markers')) {
			  			 if($("#markers").is(':checked')){

			  			 					vmarkers = 1; 
			  			 					if(document.getElementById('marker_size')){
								      	 vmarker_size = document.getElementById('marker_size').value;
								       }

								      if(document.getElementById('marker_colors')){
												var colorValues = document.getElementById('marker_colors').value.split(',');
												var vmarker_colors = colorValues.map(function(color) {
													return '"' + color.trim() + '"';
												});
								      }

								        if(document.getElementById('marker_shape')){
								      	 vmarker_shape = document.getElementById('marker_shape').value;
								      }
			  			 }
			    }

			    if(document.getElementById('strokeStyle')){
			    	vstrokeStyle = document.getElementById('strokeStyle').value;
			    }

			    if(document.getElementById('chart_toolbar_show')){
			    	if ($("#chart_toolbar_show").is(':checked')) {
			    		vchart_toolbar_show=1;
			    	}
			    }

			    if(document.getElementById('chart_shadow_enabled')){
			    	if ($("#chart_shadow_enabled").is(':checked')) {
			    		vchart_shadow_enabled=1;
			    	}
			    }
			    
			    

			    
		}

			if (vchart_type == "radar_basic") 
			{
    			
			    if (document.getElementById('color_property')) {
			        
			        var colorValues = document.getElementById('color_property').value.split(',');
			        var vcolors = colorValues.map(function(color) {
			            return '"' + color.trim() + '"';
			        });
			    }

			    if (document.getElementById('datalabels')) {
					      if($("#datalabels").is(':checked')){ 
					      	vdatalabels = 1; 
					      	if(document.getElementById('datalabel_colors')){
										var colorValues = document.getElementById('datalabel_colors').value.split(',');
										var vdatalabel_colors = colorValues.map(function(color) {
											return '"' + color.trim() + '"';
										});
					      	}
					      }

					      

			    }

			    if (document.getElementById('markers')) {
			  			 if($("#markers").is(':checked')){

			  			 					vmarkers = 1; 
			  			 					if(document.getElementById('marker_size')){
								      	 vmarker_size = document.getElementById('marker_size').value;
								       }

								      if(document.getElementById('marker_colors')){
												var colorValues = document.getElementById('marker_colors').value.split(',');
												var vmarker_colors = colorValues.map(function(color) {
													return '"' + color.trim() + '"';
												});
								      }

								        if(document.getElementById('marker_shape')){
								      	 vmarker_shape = document.getElementById('marker_shape').value;
								      }
			  			 }
			    }



			    if(document.getElementById('chart_shadow_enabled')){
			    	if ($("#chart_shadow_enabled").is(':checked')) {
			    		vchart_shadow_enabled=1;
			    	}
			    }
			    
			    

			    
		}
			if (vchart_type == "bar_basic") 
			{
    			
			    if (document.getElementById('color_property')) {
			        
			        var colorValues = document.getElementById('color_property').value.split(',');
			        var vcolors = colorValues.map(function(color) {
			            return '"' + color.trim() + '"';
			        });
			    }

			    if (document.getElementById('datalabels')) {
					      if($("#datalabels").is(':checked')){ 
					      	vdatalabels = 1; 
					      	if(document.getElementById('datalabel_colors')){
										var colorValues = document.getElementById('datalabel_colors').value.split(',');
										var vdatalabel_colors = colorValues.map(function(color) {
											return '"' + color.trim() + '"';
										});
					      	}
					      }

					      

			    }

			    if (document.getElementById('markers')) {
			  			 if($("#markers").is(':checked')){

			  			 					vmarkers = 1; 
			  			 					

								      if(document.getElementById('marker_colors')){
												var colorValues = document.getElementById('marker_colors').value.split(',');
												var vmarker_colors = colorValues.map(function(color) {
													return '"' + color.trim() + '"';
												});
								      }

								        if(document.getElementById('marker_shape')){
								      	 vmarker_shape = document.getElementById('marker_shape').value;
								      }
			  			 }
			    }

			    if(document.getElementById('bar_horizontal')){
			    	vbar_horizontal = document.getElementById('bar_horizontal').value;

			    }
			    if(document.getElementById('bar_radius')){
		      	 vbar_radius = document.getElementById('bar_radius').value;
		      	 
		       }

			    if(document.getElementById('chart_shadow_enabled')){
			    	if ($("#chart_shadow_enabled").is(':checked')) {
			    		vchart_shadow_enabled=1;
			    	}
			    }
			    
			    

			    
		}

if (vchart_type == "pie_basic") 
{
		
		if (document.getElementById('color_property')) {
			if (document.getElementById('color_property').value.trim() !== '') {
					
					var colorValues = document.getElementById('color_property').value.split(',');
					
					var vcolors = colorValues.map(function(color) {
						return '"' + color.trim() + '"';
					});
			}
		}

		if (document.getElementById('datalabels')) {
			if($("#datalabels").is(':checked')){ 
				
				vdatalabels = 1;

				if(document.getElementById('datalabel_colors')){
					if (document.getElementById('datalabel_colors').value.trim() !== '') {
						var colorValues = document.getElementById('datalabel_colors').value.split(',');
						var vdatalabel_colors = colorValues.map(function(color) {
							return '"' + color.trim() + '"';
						});
					}
				}

			}
		}



    if(document.getElementById('chart_shadow_enabled')){
    	if ($("#chart_shadow_enabled").is(':checked')) {
    		vchart_shadow_enabled=1;
    	}
    }

		if (document.getElementById('stroke_enabled')) {
					if($("#stroke_enabled").is(':checked')){ 
							if (document.getElementById('stroke_colors')) {
								if (document.getElementById('stroke_colors').value.trim() !== '') {
										var colorValues = document.getElementById('stroke_colors').value.split(',');
										var vstroke_colors = colorValues.map(function(color) {
											return '"' + color.trim() + '"';
										});
								}
							}

								if(document.getElementById('stroke_width'))
									{  vstroke_width = document.getElementById('stroke_width').value; }
					}
				}
 
    
}

if (vchart_type == "donut_basic") 
{
		
		if (document.getElementById('color_property')) {
			if (document.getElementById('color_property').value.trim() !== '') {
					
					var colorValues = document.getElementById('color_property').value.split(',');
					
					var vcolors = colorValues.map(function(color) {
						return '"' + color.trim() + '"';
					});
			}
		}

		if (document.getElementById('datalabels')) {
			if($("#datalabels").is(':checked')){ 
				
				vdatalabels = 1;

				if(document.getElementById('datalabel_colors')){
					if (document.getElementById('datalabel_colors').value.trim() !== '') {
						var colorValues = document.getElementById('datalabel_colors').value.split(',');
						var vdatalabel_colors = colorValues.map(function(color) {
							return '"' + color.trim() + '"';
						});
					}
				}

			}
		}



    if(document.getElementById('chart_shadow_enabled')){
    	if ($("#chart_shadow_enabled").is(':checked')) {
    		vchart_shadow_enabled=1;
    	}
    }


    		if (document.getElementById('stroke_enabled')) {
					if($("#stroke_enabled").is(':checked')){ 
							if (document.getElementById('stroke_colors')) {
								if (document.getElementById('stroke_colors').value.trim() !== '') {
										var colorValues = document.getElementById('stroke_colors').value.split(',');
										var vstroke_colors = colorValues.map(function(color) {
											return '"' + color.trim() + '"';
										});
								}
							}

								if(document.getElementById('stroke_width'))
									{  vstroke_width = document.getElementById('stroke_width').value; }
					}
				}
    
}






// Scattered Chart Starts here


			if (vchart_type == "scattered_basic") 
			{
    			
			    if (document.getElementById('color_property')) {
			        
			        var colorValues = document.getElementById('color_property').value.split(',');
			        var vcolors = colorValues.map(function(color) {
			            return '"' + color.trim() + '"';
			        });
			    }

			    if (document.getElementById('datalabels')) {
					      if($("#datalabels").is(':checked')){ 
					      	vdatalabels = 1; 
					      	if(document.getElementById('datalabel_colors')){
										var colorValues = document.getElementById('datalabel_colors').value.split(',');
										var vdatalabel_colors = colorValues.map(function(color) {
											return '"' + color.trim() + '"';
										});
					      	}
					      }

					      

			    }

			    if (document.getElementById('markers')) {
			  			 if($("#markers").is(':checked')){

			  			 					vmarkers = 1; 
			  			 					if(document.getElementById('marker_size')){
								      	 vmarker_size = document.getElementById('marker_size').value;
								       }

								      if(document.getElementById('marker_colors')){
												var colorValues = document.getElementById('marker_colors').value.split(',');
												var vmarker_colors = colorValues.map(function(color) {
													return '"' + color.trim() + '"';
												});
								      }

								        if(document.getElementById('marker_shape')){
								      	 vmarker_shape = document.getElementById('marker_shape').value;
								      }
			  			 }
			    }

			  
			  

			    if(document.getElementById('chart_shadow_enabled')){
			    	if ($("#chart_shadow_enabled").is(':checked')) {
			    		vchart_shadow_enabled=1;
			    	}
			    }
			    
			    

			    
		}



// Scattered Chart Ends here


			// Ends Here
	
		
			//alert("vdivid: "+vdivid);	
			var datastring	= "vdivid="+vdivid+"&vchart_type="+vchart_type+"&vChart_title="+vChart_title+"&vXTitle="+vXTitle+"&vYTitle="+vYTitle+"&vApplicationId="+vApplicationId+"&vModuleId="+vModuleId+"&vXcolumnId="+vXcolumnId+"&vYcolumnId="+vYcolumnId+"&visActive="+visActive+"&vlabel_colors="+vlabel_colors+"&chart_background="+chart_background+"&vcolors="+vcolors+"&vdatalabels="+vdatalabels+"&vdatalabel_colors="+vdatalabel_colors+"&vmarkers="+vmarkers+"&vmarker_size="+vmarker_size+"&vmarker_colors="+vmarker_colors+"&vmarker_shape="+vmarker_shape+"&vstrokeStyle="+vstrokeStyle+"&vstroke_colors="+vstroke_colors+"&vstroke_width="+vstroke_width+"&vchart_toolbar_show="+vchart_toolbar_show+"&vchart_shadow_enabled="+vchart_shadow_enabled+"&vbar_horizontal="+vbar_horizontal+"&vbar_radius="+vbar_radius;
								
						// console.log(datastring);		
			
			//alert("function updateItem is called, datastring: "+datastring);
			
			$.ajax({
				url: "ajax_updateitem.php",
				type : "POST",
				cache : false,
				data : datastring,
				success: function(response)  {
					//console.log(response);
				$("#"+vdivid).html(response); 
				//console.log(document.getElementById('contentdiv').innerHTML);
				}
			})
			
			$.fancybox.close();
			

		}	
		
		function show_code(){
			var srcode = document.getElementById('sortablelist').innerHTML;
			while(srcode.includes("<")){
				srcode = srcode.replace("<", "&lt;");
			}
			while(srcode.includes(">")){
				srcode = srcode.replace(">", "&gt;");
			}
			while(srcode.includes("'")){
				srcode = srcode.replace("'", "&apos;");
			}
			while(srcode.includes('"')){
				srcode = srcode.replace('"', "&quot;");
			}
			
			//console.log(srcode);
			
			document.getElementById('source_code').innerHTML = srcode;
			
			$.fancybox.open({
				//$(me).fancybox({
				  'autoScale': true,
					'transitionIn': 'elastic',
					'transitionOut': 'elastic',
					'speedIn': 500,
					'speedOut': 300,
					'autoDimensions': true,
					'centerOnScroll': true,
					//'href' : refdiv
					'href': '#source_code',
					'width': '50%'
			});
			
		}

		function save_module(){
			alert('save_module is called');
			//location.reload();
			var vmodule_id = document.getElementById('moduleid').value;
			var vmodule_name = document.getElementById('module_name').value;
			var vmodule_type = document.getElementById('module_type').value;
			var vmodule_descr = document.getElementById('module_descr').value;
			var vusrid = document.getElementById('userid').value;

			var vdznr_code = document.getElementById('sortablelist').innerHTML;
			console.log(vdznr_code);
			while(vdznr_code.includes("<")){
				vdznr_code = vdznr_code.replace("<", "&lt;");
			}
			while(vdznr_code.includes(">")){
				vdznr_code = vdznr_code.replace(">", "&gt;");
			}
			while(vdznr_code.includes("'")){
				vdznr_code = vdznr_code.replace("'", "&apos;");
			}
			while(vdznr_code.includes('"')){
				vdznr_code = vdznr_code.replace('"', "&quot;");
			}

			//console.log(vdznr_code);
			
			var vshow_menu ; var vfrontend_module;
			if(document.getElementById('show_menu').checked == true){
				 vshow_menu ='Y';
			}
			if(document.getElementById('frontend_module').checked == true){
				vfrontend_module ='Y';
			}

			var datastring	= { module_id: vmodule_id, 
								module_name: vmodule_name, 
								module_type: vmodule_type, 
								module_descr: vmodule_descr, 
								show_menu: vshow_menu, 
								frontend_module: vfrontend_module, 
								usrid: vusrid, 
								dznr_code: vdznr_code
							}
			
			//alert("function updateItem is called, datastring: "+datastring);
			
			$.ajax({
				url: "ajax_savemodule.php",
				type : "POST",
				cache : false,
				data : datastring,
				success: function(response)  {
					//console.log(response);
					//location.reload();
				}
			})
			
		}
	  
	</script>
	
	<script src="./mozila_dragndrop_script.js"></script>
	
	
  </body>
</html>








