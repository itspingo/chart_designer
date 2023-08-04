let dragged;
let vsidepanel;

// Note : Added by hoor 
// this funtion add space before the item 

 // Starts here
function updateSpacing(){
	if (event.target.classList.contains("dropzone")) {
    if(event.target.getElementsByClassName("list-group-item").length > 0){
	   const afterElement = getDragAfterElement(event.target, event.clientY);
		  if (afterElement != null) 
		  {
		    $("#"+afterElement.id+"").addClass("myPlaceholder");
		  } 
    } 
	}
}
// Ends here


// Note : Added by hoor 

// This function grabs the element that is next to the item being dragged in between 
// e.g. The items on the dropzones are 1,2 and 3 is being dreeged between 1 & 2 
// the function will grab 2


 // Starts here

function getDragAfterElement(container, y) {
  const draggableElements = [...container.querySelectorAll('.list-group-item:not(.dragging)')];

  return draggableElements.reduce((closest, child) => {
    const box = child.getBoundingClientRect();
    const offset = y - box.top - box.height / 2;

    if (offset < 0 && offset > closest.offset) {
      return { offset: offset, element: child };
    } else {
      return closest;
    }
  }, { offset: Number.NEGATIVE_INFINITY }).element;
}

 // Ends here

/* events fired on the draggable target */
document.addEventListener("drag", event => {
  //console.log("dragging");
});

document.addEventListener("dragstart", event => {
	// vsidepanel = document.getElementById('sidepanel').innerHTML;
  // store a ref. on the dragged elem
  event.dataTransfer.effectAllowed = "move";
  dragged = event.target;   
  // make it half transparent
  event.target.classList.add("dragging");

});
 
document.addEventListener("dragend", event => {
  // reset the transparency
  event.target.classList.remove("dragging");
 
  
});

/* events fired on the drop targets */
document.addEventListener("dragover", event => {
  // prevent default to allow drop
   updateSpacing();
   assignGridSequence();
  event.preventDefault();
}, false);

document.addEventListener("dragenter", event => {
  // highlight potential drop target when the draggable element enters it
  if (event.target.classList.contains("dropzone")) {
     event.target.classList.add("dragover");

  }

});

document.addEventListener("dragleave", event => {
  // reset background of potential drop target when the draggable element leaves it
  if (event.target.classList.contains("dropzone")) {
    event.target.classList.remove("dragover");
  }
});

document.addEventListener("drop", event => {
  // prevent default action (open as link for some elements)
    event.preventDefault();

  	
		const draggableItem = document.querySelector('.dragging');
  // move dragged element to the selected drop target
  if (event.target.classList.contains("dropzone")) {
  	let originalString =draggableItem.id;
    let newString = originalString.replace("iconItem_", "");
		dragged= document.getElementById(newString);
		event.target.appendChild(dragged);
		get_item(dragged);
		show_controls(dragged);
	//console.log(dragged.id);
	//console.log(event.target.id);
  }
  
});





function get_item(item){
	//alert('item id: '+item.id+' , item name: '+item.name+' , item type: '+item.type);
	       
        $.ajax({
            type: 'GET',
            data: {
                
            },
            url: 'sidepanel.php',
            success: function(result) {
                //ret_max_bid = result;
                ///console.log('ret_max_bid: '+ret_max_bid);
                //localStorage.setItem(recid, ret_max_bid);
                 $('#sidepanel').html(result);
                //$('#hfields_list').html(result);
                //alert('new list: '+result);
            }
        });
		
	//document.getElementById("sidepanel").innerHTML.reload;
	//console.log(document.getElementById('sortablelist').innerHTML);
}

function show_controls(dropedItem){
	//alert(dropedItem.id);
	document.getElementById('controls_'+dropedItem.id).style.display='block';
}

 function handleDrop(e) {
	 //console.log('handleDrop: ');
	 //console.log(e);
	 //e.innerHTML = '<input type="text" />';
    // if (e.stopPropagation) {
      // e.stopPropagation(); // stops the browser from redirecting.
    // }

  	
    return false;
  }
  
  
  function remove_item(itmid){
	  //alert('you are here .. 1: '+itmid);
	  //console.log(itmid);
	  if(confirm("Are you sure !")){
		  var vmodule_name = document.getElementById('module_name').value;
		  $.ajax({
				url: "ajax_removeitem.php",
				type : "POST",
				cache : false,
				data : {item_id: itmid,
						module_name: vmodule_name
				},
				success: function(response)  {
					//alert(response);
					
						var result = $.trim(response);
					if(result==="success"){
					  $("#"+itmid).remove();
					
					}else if(result=="3"){
						alert("This item has a child. Try deleting that first");
					}
				}
			})
	  }
  }
  
  function showattribs(itemtype, divid){
			var itemSequence = $("#"+divid).attr('data-item-seq');
			var parentId=$("#"+divid).closest('.grid-col').attr('id');
			if(itemtype=="tab_link"){
				parentId=$("#"+divid).closest('.child-item').attr('id');
				console.log(parentId);
			}
			// console.log(parentId);
			//console.log(itemSequence);
			var datastring;

			datastring = "itemtype="+itemtype+"&divid="+divid+"&itemSequence="+itemSequence+"&parentId="+parentId;
			//alert(datastring);			
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


		
			
			function assignGridSequence(){
				if ( dragged.classList.contains("grid-col"))
      {
					const parent = $('.content-parent');
		     //NOTE : make sure that dragged.id is not empty
				  const childIndex = parent.children().index($('#'+dragged.id+''));
				  dragged.setAttribute('data-item-seq',childIndex);
				  const element = $('#'+dragged.id+''); // Replace 'elementId' with the actual ID or selector of the target element
		      element.siblings().each(function() {
				  const siblingElement = $(this);
				  const siblingId = siblingElement.attr('id');
				  const childIndex = parent.children().index($('#' + siblingId));
				  siblingElement.attr('data-item-seq', childIndex);
		  
		  		});
      }
			
			}


// this function is for the the incremental tabs
					function assignGridSequence2(){
				if ( dragged.classList.contains("grid-col"))
      {
					const parent = $('.tab-parent');
					var parentId;
					// Iterate through each parent element
					parent.parent().each(function() {
					  // Check if the current parent element has the active class
					  if ($(this).hasClass('active')) {
					    // Retrieve the ID of the parent element
					     parentId = $(this).attr('data-tab-number');
					    
					  }
					});
					var childIndex= parentId; // grabbing the tab id
							     
				//NOTE : make sure that dragged.id is not empty
				   childIndex = childIndex+"-"+parent.children().index($('#'+dragged.id+''));
				  dragged.setAttribute('data-item-seq',childIndex);
				  const element = $('#'+dragged.id+''); // Replace 'elementId' with the actual ID or selector of the target element
		      element.siblings().each(function() {
				  const siblingElement = $(this);
				  const siblingId = siblingElement.attr('id');
				  var childIndex= parentId; 
				  childIndex = childIndex+"-"+parent.children().index($('#' + siblingId));
				  siblingElement.attr('data-item-seq', childIndex);
		  
		  		});
      }
			
			}




			function assignItemSequence(){

					const parent =dragged.parentNode.parentNode.previousElementSibling.parentElement;
		      const parentGridType=parent.getAttribute('data-item-grid');

		      	if(parentGridType!="grid-12"){
		      		var dataItemGridPosition = dragged.parentElement.dataset.gridPosition;

		      	}



		      const parentGridSequence=parent.getAttribute('data-item-seq');
		      var dataItemSequence="("+parentGridType+")-"+parentGridSequence;
		      const itemChildID=$("#"+parent.id+"").find("#"+dragged.id+"").index();
		       dataItemSequence= dataItemSequence +"-"+ itemChildID;
		       dragged.setAttribute('data-item-seq',dataItemSequence);


		       if(parentGridType!="grid-12"){
		      		var originalValue = dragged.getAttribute('data-item-seq');

							// Append the new value to the existing value
							var newValue = originalValue + '-' + dataItemGridPosition;

							// Set the attribute with the updated value
							dragged.setAttribute('data-item-seq', newValue);
		      	}


		      const element = $('#'+dragged.id+''); // Replace 'elementId' with the actual ID or selector of the target element
		      element.siblings().each(function() {
				  const siblingElement = $(this);
				  const siblingId = siblingElement.attr('id');
				  const itemChildID=$("#"+parent.id+"").find("#"+siblingId+"").index();
		      dataItemSequence= "("+parentGridType+")-"+parentGridSequence +"-"+ itemChildID;
		      siblingElement.attr('data-item-seq',dataItemSequence);
		      	
		      	if(parentGridType!="grid-12"){
		      		var originalValue = siblingElement.attr('data-item-seq');

							// Append the new value to the existing value
							var newValue = originalValue + '-' + dataItemGridPosition;

							// Set the attribute with the updated value
							siblingElement.attr('data-item-seq', newValue);
		      	}
	
		     	});


			}

			function remove_tab_item(tabId) {
  const tabLink = document.querySelector(`a[href="#tab${tabId}"]`);
  const tabContent = document.getElementById(`tab${tabId}`);

  if (tabLink && tabContent) {


		const previousTabLink = tabLink.parentNode.previousElementSibling;
		const previousTabContent = tabContent.previousElementSibling;
		const nextTabLink = tabLink.parentNode.nextElementSibling;
		const nextTabContent = tabContent.nextElementSibling;


    // Remove tab link
    tabLink.parentNode.parentNode.removeChild(tabLink.parentNode);

    // Remove tab content
    tabContent.parentNode.removeChild(tabContent);


    // Activate previous tab
    if (previousTabLink && previousTabContent) 
    {
      previousTabLink.firstChild.classList.add('active');
      previousTabContent.classList.add('active', 'show');
    }
    
    //active next child
    else if (nextTabLink && nextTabContent) 
    {
	    nextTabLink.firstChild.classList.add('active');
	    nextTabContent.classList.add('active', 'show');
    }
    remove_item(`tablink${tabId}`);
  
  }
}


function saveParent(draggedParent)
{
	console.log(draggedParent);
	// Method 1 
 
		// showattribs(dragged.getAttribute('name'),dragged.id);
		// $.fancybox.close(true); 
	  // setTimeout(()=> {
    //      updateItem();
    //   }
    //   ,30);



	// Method 2


			if (draggedParent.id) {	
				var vdivid = draggedParent.id;
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
			
			if (dragged.getAttribute('name')) {
				var vitemtype = dragged.getAttribute('name');
			}else {
				var vitemtype = '';
			}
			if (document.getElementById('display_pos')) {
				var vdisplay_pos = document.getElementById('display_pos').value;
			}else {
				var vdisplay_pos = '';
			}
			
			if (dragged.getAttribute('name')) {
				var vfield_label = dragged.getAttribute('name');
			}else {
				var vfield_label = '';
			}
			if (dragged.getAttribute('name')) {
				var vfield_name = dragged.getAttribute('name');
			}else {
				var vfield_name = '';
			}
			if (dragged.getAttribute('name')) {
				var vfield_type = dragged.getAttribute('name');
			}else {
				var vfield_type = '';
			}
			if (document.getElementById('isrequired')) {
				var visrequired = document.getElementById('isrequired').value;
			}else {
				var visrequired = '';
			}
			
			if (dragged.getAttribute('data-item-seq')) {
				var vdisplay_seq = dragged.getAttribute('data-item-seq');
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
			//added by hoor
			if (document.getElementById('parent_grid_id_input')) {
				var  vparent_grid_id_input = "";  
			}else {
				var vparent_grid_id_input = '';
			}


			if(vfield_type=="Incremental_tabs"){
				var vparent_grid_id_input= $("#"+vdivid).closest('.grid-col').attr('id');
			}
			
			//alert("vdivid: "+vdivid);	
			var datastring	= "vdivid="+vdivid+"&vmodule_name="+vmodule_name+"&vfieldid"+vfieldid+"&vitemtype="+vitemtype+"&vfield_label="+vfield_label+"&vfield_name="+vfield_name+"&vfield_type="+vfield_type+"&visrequired="+visrequired+
								"&vdisplay_seq="+vdisplay_seq+"&vdefault_value="+vdefault_value+"&vrange_min="+vrange_min+"&vrange_max="+vrange_max+"&vitem_values="+vitem_values+"&vlist_type="+vlist_type+
								"&vstaticlist="+vstaticlist+"&vcodelist="+vcodelist+"&vnewcodelist="+vnewcodelist+"&vlistmodulename="+vlistmodulename+"&vlistmoduleitem="+vlistmoduleitem+"&vonlistpag="+vonlistpag+"&vparent_grid_id_input="+vparent_grid_id_input;
								
					
			
			//alert("function updateItem is called, datastring: "+datastring);
			
			$.ajax({
				url: "ajax_updateitem.php",
				type : "POST",
				cache : false,
				data : datastring,
				success: function(response)  {
						  $("#"+vdivid).html(response); 
					
					
					//console.log(document.getElementById('contentdiv').innerHTML);
				}

			})

}