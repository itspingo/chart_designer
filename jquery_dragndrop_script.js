
$(document).ready(function(){
	
	
	$.ajax({
		url: "ajax_clean_temp_fields.php",
		type : "POST",
		cache : false,
		success: function(response)  {
			//alert(response);
		}
	})
	
	 
	
			$(".source").draggable({
				helper: "clone",
				opacity : "0.7",
				cursor:"move",
				revert: "invalid"
			});
			
			
			$(".sortit").draggable();
				
			$( ".listitems" ).droppable({
				 drop: function( event, ui ) {
					var itemtype = ui.draggable.attr("id");
					var locationId = $(this).attr("id");
					var pdivid = Math.floor((Math.random() * 10000000) + 1);
					
					var olddivid =   $(ui.draggable).children("div").attr("id");
					//alert("olddivid: "+olddivid);
					var vmodulename = document.getElementById('module_name').value;
					$("#sortable").append(getiteminfo(pdivid, itemtype));
					//additem(pdivid,itemtype,'listitems');
					//alert('itemtype: '+itemtype);
					if(olddivid === undefined){
						//alert("function addItem is called, olddivid: "+olddivid);
						$.fn.addItem(pdivid,itemtype,'listitems',vmodulename);
					}
					
				},
				 out: function (event, ui) {
					var itemClass = ui.draggable.attr("class");
					//alert("itemClass= "+itemClass.substring(0,6));
					if(itemClass.substring(0,6) == "sortit"){
						var olddivid =   $(ui.draggable).children("div").attr("id");
						//alert("divid= "+olddivid);
						$.fn.deleteItem(olddivid);
						$(ui.draggable).fadeOut(1000, function () {
							$(this).remove();
						});
					}
				}
			});  
			
						
			
			$( "#sortable" ).sortable({ 
				stop     : function(event,ui){ 
								//alert("stop: is called at sortable");
								var divid, seqno, datastring;
								$('.sortit').each(function(i) {
									
									//alert(i+':  '+$(this).children("div").attr("id"));
									divid = $(this).children("div").attr("id");
									seqno = i;
									datastring = "divid="+divid+"&seqno="+seqno;
									$.ajax({
										url: "ajax_updatedb.php",
										type : "POST",
										cache : false,
										data : datastring,
										success: function(response)  {
											//alert(response);
										}
									})									
									
								});
						}
			});
			
			
			// alert('you are here ... 3');		
			
			$( "#sortable" ).disableSelection();
			
			
				
			
			var datastring = "";
			
			$.fn.addItem = function(divid, itemtype, vlocationid, vmodulename){
				//alert("function additem is called");
				var vdivId=divid;
				var vitemtype=itemtype;
				var vlocation=vlocationid;
				var vmodule_name=vmodulename;
				
				var vstaticlist='';
				var vcodelist='';
				var vnewcodelist='';
				var vlistmodulename='';
				var vlistmoduleitem='';
				var vfieldid='';
				var vonlistpag='Y';	
				
				
				if(itemtype=="text_input"){
					var vfield_label="Text Input";
				}else if(itemtype=="grid_1col"){
					var vfield_label="";
					vonlistpag='N';
				}else if(itemtype=="grid_2col"){
					var vfield_label="";
					vonlistpag='N';
				}else if(itemtype=="text_area"){
					var vfield_label="Text Area";
				}else if(itemtype=="column_heading"){
					var vfield_label="Column Heading";
				}else if(itemtype=="display_input"){
					var vfield_label="Display Item";
				}else if(itemtype=="nondb_input"){
					var vfield_label="Non-DB Item";
				}else if(itemtype=="rich_text_editor"){
					var vfield_label="Rich Text Editor";
				}else if(itemtype=="password_input"){
					var vfield_label="Password Input";
				}else if(itemtype=="date_input"){
					var vfield_label="Date Input";
				}else if(itemtype=="check_box"){
					var vfield_label="Check Box ";
				}else if(itemtype=="radio_button"){
					var vfield_label="Radio Button";
				}else if(itemtype=="drop_down"){
					var vfield_label="Drop Down";
				}else if(itemtype=="multi_choice"){
					var vfield_label="Multi Choice";
				}else if(itemtype=="number_input"){
					var vfield_label="Number Input";
				}else if(itemtype=="multi_choice"){
					var vfield_label="Multi Choice";
				}else if(itemtype=="single_file"){
					var vfield_label="Single File Attachment";
				}else if(itemtype=="multiple_files"){
					var vfield_label="Multiple Files Attachment";
				}else if(itemtype=="single_image"){
					var vfield_label="Single Image Attachment";
				}else if(itemtype=="multiple_images"){
					var vfield_label="Multiple Images Attachment";
				}else if(itemtype=="codes_list"){
					var vfield_label="Codes List";
				}else if(itemtype=="new_codes_list"){
					var vfield_label="New Codes List";
				}else if(itemtype=="referenced_data"){
					var vfield_label="Referenced Data";
				}else if(itemtype=="url_input"){
					var vfield_label="URL Input";
				}else if(itemtype=="submodule"){
					var vfield_label="Sub Module";
				}else {
					var vfield_label="Not Available";
				}
				
				
				if(itemtype=="radio_button"){
					var vitem_values='Radio Button Text';
				}else{
					var vitem_values='';
				}
				
				var vfield_type=itemtype;
				var vfield_name='';
				var visrequired='N';
				
				// if(vlocationid == 'divrightside'){
					// var vdisplay_pos = 'R';
				// }else if(vlocationid == 'divmiddleside'){
					// var vdisplay_pos = 'M';
				// }else if(vlocationid == 'listitems'){
					// var vdisplay_pos = 'L';
				// }else if(vlocationid == 'divbottomside'){
					// var vdisplay_pos = 'B';
				// }
			
				
				var vdisplay_seq='';
				var vdefault_value='';
				var vrange_min='';
				var vrange_max='';
							
				if(itemtype=="drop_down"){
					var vlist_type='staticlist';
				}else if(itemtype=="multi_choice"){
					var vlist_type='multi_choice';
				}else if(itemtype=="codes_list"){
					var vlist_type='codes_list';
				}else if(itemtype=="new_codes_list"){
					var vlist_type='newcodelist';
				}else if(itemtype=="referenced_data"){
					var vlist_type='referenced_data';
				}else{
					var vlist_type='';
				}
				
				
				datastring = "module_name="+vmodule_name+"&divid="+vdivId+"&fieldid"+vfieldid+"&field_label="+vfield_label+"&field_name="+vfield_name+"&field_type="+vfield_type+"&isrequired="+visrequired+
							  "&display_seq="+vdisplay_seq+"&default_value="+vdefault_value+"&range_min="+vrange_min+"&range_max="+vrange_max+"&item_values="+vitem_values+"&list_type="+vlist_type+"&staticlist="+vstaticlist+
							  "&codelist="+vcodelist+"&newcodelist="+vnewcodelist+"&listmodulename="+vlistmodulename+"&listmoduleitem="+vlistmoduleitem+"&onlistpag="+vonlistpag ;
							  
				//alert(datastring);
				
				 $.ajax({
					url: "ajax_additem.php",
					type : "POST",
					cache : false,
					data : datastring,
					success: function(response)  {
						//alert('record added: '+response);
					}
				}) 
				
				//alert("divid: "+divid+" , itemtype: "+itemtype+" , locationid: "+vlocationid);
				//// alert('hi');
			}  
		
		// alert('you are here ... 5');		
				
			$.fn.deleteItem = function(olddivid){
				datastring = "divid="+olddivid;
				$.ajax({
					url: "ajax_deleteitem.php",
					type : "POST",
					cache : false,
					data : datastring,
					success: function(response)  {
						//alert(response);
					}
				})
			}
		
		
		});  //end: $(document).ready(function()
		
//=================================================================================================//

		
function updateItem(){
			//$.fancybox.close();
			
	if (document.getElementById('divid').value) {	
		var vdivid = document.getElementById('divid').value;
	}else {
		var vdivid = 'NA';
	}	
	
	
	if (document.getElementById('module_name')) {	
		var vmodule_name = document.getElementById('module_name').value;
	}else {
		var vmodule_name = '';
	}
	
	if (document.getElementById('fieldid')) {
		var vfieldid = document.getElementById('fieldid').value;
	}else {
		var vfieldid = '';
	}
	
	if (document.getElementById('itemtype')) {
		var vitemtype = document.getElementById('itemtype').value;
	}else {
		var vitemtype = '';
	}
	if (document.getElementById('display_pos')) {
		var vdisplay_pos = document.getElementById('display_pos').value;
	}else {
		var vdisplay_pos = '';
	}
	
	if (document.getElementById('field_label')) {
		var vfield_label = document.getElementById('field_label').value;
	}else {
		var vfield_label = '';
	}
	if (document.getElementById('field_name')) {
		var vfield_name = document.getElementById('field_name').value;
	}else {
		var vfield_name = '';
	}
	if (document.getElementById('field_type')) {
		var vfield_type = document.getElementById('field_type').value;
	}else {
		var vfield_type = '';
	}
	if (document.getElementById('isrequired')) {
		var visrequired = document.getElementById('isrequired').value;
	}else {
		var visrequired = '';
	}
	
	if (document.getElementById('vdisplay_seq')) {
		var vdisplay_seq = document.getElementById('vdisplay_seq').value;
	}else {
		var vdisplay_seq = '';
	}
	if (document.getElementById('default_value')) {
		var vdefault_value = document.getElementById('default_value').value;
	}else {
		var vdefault_value = '';
	}
	if (document.getElementById('range_min')) {
		var vrange_min = document.getElementById('range_min').value;
	}else {
		var vrange_min = '';
	}
	if (document.getElementById('range_max')) {
		var vrange_max = document.getElementById('range_max').value;
	}else {
		var vrange_max = '';
	}
	if (document.getElementById('item_values')) {
		var vitem_values = document.getElementById('item_values').value;
	}else {
		var vitem_values = '';
	}
	if (document.getElementById('list_type')) {
		var vlist_type = document.getElementById('list_type').value;   
	}else {
		var vlist_type = '';
	}
	if (document.getElementById('staticlist')) {
		var vstaticlist = document.getElementById('staticlist').value;  
	}else {
		var vstaticlist = '';
	}
	if (document.getElementById('codelist')) {
		var vcodelist = document.getElementById('codelist').value;
	}else {
		var vcodelist = '';
	}
	if (document.getElementById('newcodelist')) {
		var vnewcodelist = document.getElementById('newcodelist').value;
	}else {
		var vnewcodelist = '';
	}
	if (document.getElementById('listmodulename')) {
		var vlistmodulename = document.getElementById('listmodulename').value;
	}else {
		var vlistmodulename = '';
	}
	if (document.getElementById('listmoduleitem')) {
		var  vlistmoduleitem = document.getElementById('listmoduleitem').value;
	}else {
		var vlistmoduleitem = '';
	}
	if (document.getElementById('onlistpag')) {
		var  vonlistpag = document.getElementById('onlistpag').value;  
	}else {
		var vonlistpag = '';
	}
	
	//alert("vdivid: "+vdivid);	
	var datastring	= "vdivid="+vdivid+"&vmodule_name="+vmodule_name+"&vfieldid"+vfieldid+"&vitemtype="+vitemtype+"&vfield_label="+vfield_label+"&vfield_name="+vfield_name+"&vfield_type="+vfield_type+"&visrequired="+visrequired+
						"&vdisplay_seq="+vdisplay_seq+"&vdefault_value="+vdefault_value+"&vrange_min="+vrange_min+"&vrange_max="+vrange_max+"&vitem_values="+vitem_values+"&vlist_type="+vlist_type+
						"&vstaticlist="+vstaticlist+"&vcodelist="+vcodelist+"&vnewcodelist="+vnewcodelist+"&vlistmodulename="+vlistmodulename+"&vlistmoduleitem="+vlistmoduleitem+"&vonlistpag="+vonlistpag;
						
						
	
	//alert("function updateItem is called, datastring: "+datastring);
	
	$.ajax({
		url: "ajax_updateitem.php",
		type : "POST",
		cache : false,
		data : datastring,
		success: function(response)  {
			//alert(response);
			$("#"+vdivid).html(response); 
		}
	})
	
	$.fancybox.close();

}		
		
		
function showattribs(itemtype, divid){
	var datastring;
	datastring = "itemtype="+itemtype+"&divid="+divid;
	
	$.ajax({    //create an ajax request to load_page.php
		type: "POST",
		data : datastring,
		url: "ajax_item_properties.php",             
		dataType: "html",   //expect html to be returned                
		cache : false,
		success: function(response){                    
			$("#contentdiv").html(response); 
			//alert(response);
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
				 'href': '#contentdiv'
			});
			
			//alert(response);
		}
	});
}
		
		
function getiteminfo(divid, itemtype){
	var iteminfo="";
	
	///alert("itemtype = "+itemtype);
	
	if(itemtype=="text_input"){
		iteminfo = '<div class="sortit"> <div id="'+divid+'"><label class="strong">Text Input</label><input type="text" name="text_input"  id="item"  class="form-control target"  value="" /></div> <a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\'); return false;" >Set Properties</a> </div>';
	}else if(itemtype=="grid_1col"){
		iteminfo = '<div class="sortit"> <div class="row" id="'+divid+'"><div class="listitems col-12" style="min-height:100px;background-color:white;border: dotted 1px black;"><b>Grid 1 Col</b></div></div>  </div>';
	}else if(itemtype=="grid_2col"){
		iteminfo = '<div class="sortit"> <div class="row" id="'+divid+'"><div class="listitems col-6" style="min-height:100px;background-color:white;border: dotted 1px black;"><b>Grid Col 1</b></div><div class="listitems col-6" style="min-height:100px;background-color:white;border: dotted 1px black;"><b>Grid Col 2</b></div></div>  </div>';
	}else if(itemtype=="display_input"){
		iteminfo = '<div class="sortit"> <div id="'+divid+'"><label class="strong">Display Item</label><input type="text" name="display_item"  id="display_input" placeholder="Display Item" class="form-control target" disabled value="" /></div> <a  id="display_input"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\'); return false;" >Set Properties</a> </div>';
	}else if(itemtype=="nondb_input"){
		iteminfo = '<div class="sortit"> <div id="'+divid+'"><label class="strong">Non DB Item</label><input type="text" name="nondb_item"  id="nondb_input" placeholder="Non DB Item" class="form-control target" value="" /></div> <a  id="nondb_input"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\'); return false;" >Set Properties</a> </div>';
	}else if(itemtype=="column_heading"){
		iteminfo = '<div class="sortit"> <div id="'+divid+'"><div style="background-color:#ccccff"><h3 align="left"><b>Column Heading</b></h3></div></div> <a  id="column_heading"  name="column_heading" class="fancybox;" style="cursor:pointer;"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\'); return false;" >Set Properties</a> </div>';
	}else if(itemtype=="url_input"){
		iteminfo = '<div class="sortit"> <div id="'+divid+'"><label class="strong">URL Input</label><input type="text" name="url_input"  id="item" placeholder="http://www.website.com" class="form-control target"  value="" /></div> <a  id="urlinput"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\'); return false;" >Set Properties</a> </div>';
	}else if(itemtype=="text_area"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Text Area</label> <textarea name="text_area"  id="text_area" class="form-control target" ></textarea></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	
	}else if(itemtype=="rich_text_editor"){
		
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Rich Text Editor</label>  \
					<img src="images/nicedit.png" > \
					<textarea name="rich_text_editor"  id="rich_text_editor" class="form-control nicedit target" ></textarea></div>  \
					<a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	
	} else if(itemtype=="password_input"){
		iteminfo = '<div class="sortit"><div class="col-6" id="'+divid+'"><label class="strong">Password Input</label> <input type="password" name="pin_no"  id="pin_no"  class="form-control target"  value="" /></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="date_input"){
		iteminfo = '<div class="sortit"><div class="col-4" id="'+divid+'"><label class="strong">Date Input</label> <input type="date" name="pin_no"  id="pin_no"  class="form-control  target"  value="" /></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
		
	}else if(itemtype=="check_box"){
		iteminfo = ' <div class="sortit"><div class="col-3" id="'+divid+'"><input type="checkbox" name="check_box"  id="check_box"  class="target"  value="1" /> <b>Check Box Text</b></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="radio_button"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Radio Button</label> <input type="radio" name="radio_button"  id="radio_button"  class="target"  value="1" /> Radio Button Text</div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="drop_down"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Drop Down List</label> <select name="circulation_group"  id="circulation_group"  class="form-control" > <option value="">--Select--</option><option value="a">Choice A</option><option value="b">Choice B</option></select></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="number_input"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Number Input</label> <input type="number" name="number_input"  id="number_input"  class="form-control  target"  value="" /></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';

	}else if(itemtype=="multi_choice"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Multichoice List</label> <select name="circulation_group"  id="circulation_group"  multiple="multiple" class="form-control" > <option value="">--Select--</option><option value="a">Choice A</option><option value="b">Choice B</option></select></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	
	}else if(itemtype=="single_file"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Single File Attachment</label> <input type="file" name="single_file"  id="single_file"  class="form-control  target" /></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="multiple_files"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Multiple Files Attachment</label> <input type="file" name="multiple_files"  id="multiple_files" multiple="multiple" class="form-control  target"  /></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	
	}else if(itemtype=="single_image"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Single Image Attachment</label> <input type="file" name="single_image"  id="single_image"  class="form-control  target" /></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="multiple_images"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Multiple Images Attachment</label> <input type="file" name="multiple_images"  id="multiple_images" multiple="multiple" class="form-control  target"  /></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	
	}else if(itemtype=="codes_list"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Codes List Item</label> <select name="circulation_group"  id="circulation_group"  class="form-control" > <option value="">--Select--</option><option value="a">Choice A</option><option value="b">Choice B</option></select>\
		<a style="cursor:pointer;" class="btn btn-primary btn-icon glyphicons circle_plus" onClick="javascript:lov_popup("list_name");" ><i></i> Add</a></div> <a style="cursor:pointer;"  class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="new_codes_list"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">New Codes List Item</label> <select name="circulation_group"  id="circulation_group"  class="form-control" > <option value="">--Select--</option></select>\
		<a style="cursor:pointer;" class="btn btn-primary btn-icon glyphicons circle_plus" onClick="javascript:lov_popup("list_name");" ><i></i> Add</a></div> <a style="cursor:pointer;"  class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="submodule"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><img src="images/submodule.png" > </div>\
		<a style="cursor:pointer;"  class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
	}else if(itemtype=="referenced_data"){
		iteminfo = '<div class="sortit"><div id="'+divid+'"><label class="strong">Referenced Data List</label> <select name="circulation_group"  id="circulation_group"  class="form-control" > <option value="">--Select--</option><option value="a">Col Val A</option><option value="b">Col Val B</option></select></div> <a style="cursor:pointer;" class="fancybox"  onClick="showattribs(\''+itemtype+'\', \''+divid+'\')" >Set Properties</a> </div>';
		
	}
	
	return(iteminfo);
}


	
function show_divfields_list(){
	var vmodulename = document.getElementById('module_name').value;
	var vmenuetype = document.getElementById('menutype').value;
	var vapplication  = document.getElementById('application').value;
	
	if(vmodulename=='' || vmenuetype=='' || vapplication=='' ){
		alert("please provide all the necessary information");
	}else{
		document.getElementById('divfields_list').style.display='block';
		document.getElementById('divfields_list').style.visibility = 'visible';
	}
}

function hide_divfields_list(){
	document.getElementById('divfields_list').style.display='none';
	document.getElementById('divfields_list').style.visibility = 'hide';
}

// function golistingpage(){
		// window.location = "modl.php?scrn=modules.php";
// }	

		
		
		
