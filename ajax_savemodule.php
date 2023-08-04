<?php include_once("config.php");

$vmodule_id =  $_POST["module_id"]; 
$vmodule_name =  $_POST["module_name"]; 
$vmodule_type =  $_POST["module_type"]; 
$vmodule_descr =  $_POST["module_descr"]; 
$vshow_menu =  $_POST["show_menu"]; 
$vfrontend_module =  $_POST["frontend_module"]; 
$vusrid =  $_POST["usrid"]; 
$vdznr_code =  $_POST["dznr_code"]; 
$vform_code =  $_POST["dznr_code"]; 


if($vmodule_id != ''){
	$sqlfldids = "select * from dznr_module_fields where moduleid = '".$vmodule_id."'";
}else{
	$sqlfldids = "select * from dznr_module_fields where moduleid = '' or moduleid is null";
}

$resfldids = mysqli_query($dbcon, $sqlfldids);
while($rowfldids = mysqli_fetch_assoc($resfldids)){
	$vform_code = str_replace('id=&quot;label_'.$rowfldids['divid'].'&quot;','',$vform_code);
	$vform_code = str_replace('id=&quot;input_'.$rowfldids['divid'].'&quot;','',$vform_code);
	$vform_code = str_replace('id=&quot;controls_'.$rowfldids['divid'].'&quot; class=&quot;col-6 float-right item_icons item_icons_show&quot; style=&quot;align:right;&quot; align=&quot;right&quot;','',$vform_code);
	$vform_code = str_replace('name=&quot;date_input&quot; id=&quot;'.$rowfldids['divid'].'&quot; draggable=&quot;false&quot; class=&quot;list-group-item dragging&quot;','',$vform_code);
	$vform_code = str_replace('&lt;a style=&quot;cursor:pointer;color:blue;&quot; onclick=&quot;showattribs(&apos;date_input&apos;, '.$rowfldids['divid'].')&quot;&gt;&lt;i class=&quot;bi bi-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;','',$vform_code);
	$vform_code = str_replace('&lt;a style=&quot;cursor:pointer;color:red;&quot; onclick=&quot;remove_item('.$rowfldids['divid'].')&quot;&gt;&lt;i class=&quot;bi bi-trash&quot;&gt;&lt;/i&gt;&lt;/a&gt;','',$vform_code);
	$vform_code = str_replace('&lt;p&gt;','',$vform_code);
	$vform_code = str_replace('&lt;p&gt;','',$vform_code);
}


if($vmodule_id != ''){

	$sqlupdt="update dznr_modules set 
				module_name = '".$vmodule_name."', 
				module_type = '".$vmodule_type."', 
				module_descr = '".$vmodule_descr."', 
				table_name = '".strtolower(str_replace(' ','_',$vmodule_name))."', 
				user_id = '".$vusrid."', 
				form_code = '".$vform_code."', 
				dznr_code = '".$vdznr_code."'	
			where id = '".$vmodule_id."'  ";

	echo $sqlupdt;
	if(mysqli_query($dbcon, $sqlupdt)){
		$sqlflds = "update dznr_module_fields set
						moduleid = '".$vmodule_id."',
						module_name='".$vmodule_name."'
					where (moduleid = '' or
						  moduleid is NULL)
					 /* and user_id = '".$vusrid."' */
					";
		mysqli_query($dbcon, $sqlflds);
	}

}else{

	$sqlinst="insert into dznr_modules set 
				module_name = '".$vmodule_name."', 
				module_type = '".$vmodule_type."', 
				module_descr = '".$vmodule_descr."', 
				table_name = '".strtolower(str_replace(' ','_',$vmodule_name))."', 
				user_id = '".$vusrid."', 
				form_code = '".$vform_code."', 
				dznr_code = '".$vdznr_code."'	
			";

	echo $sqlinst;
	
	if(mysqli_query($dbcon, $sqlinst)){
		$vmodule_id2 = mysqli_insert_id($dbcon);
		$sqlflds = "update dznr_module_fields set
						moduleid = '".$vmodule_id2."',
						module_name='".$vmodule_name."'
					where (moduleid = '' or
						  moduleid is NULL)
					 /* and user_id = '".$vusrid."' */
					";
		mysqli_query($dbcon, $sqlflds);
	}
}




			
?>