<?php 
function addaccessrights( $usrid, $usrtype, $applicid, $module){
	global $dbcon;
	$sqlaplicid = "select * from applications where id = '".$applicid."'";
	
	$resaplicid = mysqli_query($dbcon, $sqlaplicid);
	$rowaplicid = mysqli_fetch_assoc($resaplicid);
	$applicname = $rowaplicid['applicname'];
	$clientid = $rowaplicid['clientid'];
	
	$sqlexist = "select * from access_rights 
					where  user_id = '".$usrid."' 
					  and user_type = '".$usrtype."' 
					  and applicname = '".$applicname."' 
					  and module_name = '".$module."' 
					  and clientid='".$clientid."' 
					  ";
	$resexist = mysqli_query($dbcon, $sqlexist);
	$nrecs = mysqli_num_rows($resexist);
	if($nrecs == 0){
		$sqlinsrt ="insert into access_rights  set
					  clientid='".$clientid."',
					  user_id = '".$usrid."' , 
					  user_type = '".$usrtype."', 
					  applicname = '".$applicname."' , 
					  module_name = '".$module."'  ";
		$resinsrt = mysqli_query($dbcon, $sqlinsrt);
	}

}
function addaplicmodule( $clientid, $applicid, $module, $tablename){
	global $dbcon;
	/*$sqlaplicid = "select * from applications where id = '".$applicid."'";
	
	$resaplicid = mysqli_query($dbcon, $sqlaplicid);
	$rowaplicid = mysqli_fetch_assoc($resaplicid);
	$aplicid = $rowaplicid['id'];
	*/
	
	$sqlexist = "select count(1) as recs from appmodules 
					where appid = '".$applicid."'
					  and module = '".$module."' ";
	//echo $sqlexist;
	$resexist = mysqli_query($dbcon, $sqlexist);
	$rowexist = mysqli_fetch_assoc($resexist);
	$nrecs = $rowexist['recs'];
	if($nrecs == 0){
			
		$sqlmodule = "insert into appmodules set
						appid = '".$applicid."',
						module = '".$module."',
						table_name = '".$tablename."',
						clientid = '".$clientid."'";
		//echo $sqlmodule;
		$resmodule = mysqli_query($dbcon, $sqlmodule);
	
	}
}

function update_aplicmodule( $clientid, $applicid, $module, $tablename){  //never called this function
	global $dbcon;
	/*$sqlaplicid = "select * from applications where id = '".$applicid."'";
	
	$resaplicid = mysqli_query($dbcon, $sqlaplicid);
	$rowaplicid = mysqli_fetch_assoc($resaplicid);
	$aplicid = $rowaplicid['id'];
	*/
	
	$sqlexist = "select count(1) as recs from appmodules 
					where appid = '".$applicid."'
					  and module = '".$module."' ";
	//echo $sqlexist;
	$resexist = mysqli_query($dbcon, $sqlexist);
	$rowexist = mysqli_fetch_assoc($resexist);
	$nrecs = $rowexist['recs'];
	if($nrecs == 0){
			
		$sqlmodule = "insert into appmodules set
						appid = '".$applicid."',
						module = '".$module."',
						table_name = '".$tablename."',
						clientid = '".$clientid."'";
		//echo $sqlmodule;
		$resmodule = mysqli_query($dbcon, $sqlmodule);
	
	}
}

function addusermenu($applicid, $scriptfile, $module, $menutype){
	global $dbcon;
	
	$sqlaplicid = "select * from applications where id = '".$applicid."'";
	
	$resaplicid = mysqli_query($dbcon, $sqlaplicid);
	$rowaplicid = mysqli_fetch_assoc($resaplicid);
	$applicname = $rowaplicid['applicname'];
	$clientid = $rowaplicid['clientid'];


	$sqlexist = "select * from usermenu 
					where applicname = '".$applicname."' 
					  and scriptfile = '".$scriptfile."' 
					  and modulename =  '".$module."' 
					  ";
	$resexist = mysqli_query($dbcon, $sqlexist);
	$nrecs = mysqli_num_rows($resexist);
	if($nrecs == 0){
		$sqlinsrt ="insert into usermenu  set
					  clientid = '".$clientid."' , 
					  applicname = '".$applicname."' , 
					  scriptfile = '".$scriptfile."' , 
					  menutype = '".$menutype."' , 
					  modulename = '".$module."'  ";
		$resinsrt = mysqli_query($dbcon, $sqlinsrt);
	}

}


function update_usermenu($applicid, $scriptfile, $module, $menutype){
	global $dbcon;
	
	$sqlaplicid = "select * from applications where id = '".$applicid."'";
	
	$resaplicid = mysqli_query($dbcon, $sqlaplicid);
	$rowaplicid = mysqli_fetch_assoc($resaplicid);
	$applicname = $rowaplicid['applicname'];
	$clientid = $rowaplicid['clientid'];


	$sqlexist = "select * from usermenu 
					where applicname = '".$applicname."' 
					  and scriptfile = '".$scriptfile."' 
					  and modulename =  '".$module."' 
					  ";
	$resexist = mysqli_query($dbcon, $sqlexist);
	$nrecs = mysqli_num_rows($resexist);
	if($nrecs == 0){
		$sqlinsrt ="insert into usermenu  set
					  clientid = '".$clientid."' , 
					  applicname = '".$applicname."' , 
					  scriptfile = '".$scriptfile."' , 
					  menutype = '".$menutype."' , 
					  modulename = '".$module."'  ";
		$resinsrt = mysqli_query($dbcon, $sqlinsrt);
	}

}

function savefield($ptable_name, $pfield_name, $pfield_descr, $pfield_type){
//echo "within savefiled() function"."<br>";
	global $database; 
	global $clientid;
	global $dbcon;
		if($pfield_name != ''){
			
			$sqlfieldexist = "SELECT count(1) as fieldscnt
						FROM INFORMATION_SCHEMA.COLUMNS
					   WHERE table_name = '".$ptable_name."'
						 AND table_schema = '".$database."'
						 AND column_name = '".$pfield_name."' ";
			//echo "sqlfieldexist=".$sqlfieldexist."<br>";
			$resfieldexist = mysqli_query($dbcon, $sqlfieldexist);
			$rowfieldexist = mysqli_fetch_assoc($resfieldexist);
			 
			if($rowfieldexist['fieldscnt'] == '0' && ( $pfield_type != 'display_input' && $pfield_type != 'column_heading' && $pfield_type != 'nondb_input' && $pfield_type != 'submodule' )){
				
				$sqlfield="alter table ".$ptable_name." add ( ". $pfield_name;
				
				if($pfield_type == "text_input"){
					$sqlfield .= " varchar(200) ";
				}elseif($pfield_type == "check_box"){
					$sqlfield .= " varchar(5) ";
				}elseif($pfield_type == "date_input"){
					$sqlfield .= " date ";
				}elseif($pfield_type == "datetime"){
					$sqlfield .= " datetime ";
				}elseif($pfield_type == "number_input"){
					$sqlfield .= " int(11) ";
				}elseif($pfield_type == "text_area"){
					$sqlfield .= " text ";
				}elseif($pfield_type == "rich_text_editor"){
					$sqlfield .= " text ";
				}elseif($pfield_type == "password_input"){
					$sqlfield .= " varchar(50) ";
				}elseif($pfield_type == "referenced_data"){
					$sqlfield .= " varchar(10) ";
				
				}elseif($pfield_type == "codes_list"){
					$sqlfield .= " varchar(10) ";
				}elseif($pfield_type == "new_codes_list"){
					$sqlfield .= " varchar(100) ";
				}elseif($pfield_type == "radio_button"){
					$sqlfield .= " varchar(10) ";
				}elseif($pfield_type == "check_box"){
					$sqlfield .= " varchar(10) ";
				}elseif($pfield_type == "email_input"){
					$sqlfield .= " varchar(100) ";
					
				}else{
					$sqlfield .= " varchar(200) ";
				}
				
				$sqlfield .= " ); ";
					
				//echo "sqlfield=".$sqlfield."<br>";
				$resfield = mysqli_query($dbcon, $sqlfield);

				if($resfield){
					$sqlfld = "select count(1) as fldcnt from rptusrfields
								where table_name = '".$ptable_name."'
								and field_name = '".$pfield_name."'
								and	field_type = '".$pfield_type."'
								and	field_descr = '".$pfield_descr."'
								and	clientid = '".$clientid."' ";
					$resfld = mysqli_query($dbcon, $sqlfld);
					$rowfld = mysqli_fetch_assoc($resfld);
					
					if($rowfld['fldcnt']==0){
						$sqlrptfield = "insert into rptusrfields set
										table_name = '".$ptable_name."',
										field_name = '".$pfield_name."',
										field_type = '".$pfield_type."',
										field_descr = '".$pfield_descr."', 
										clientid = '".$clientid."' ";
						//echo "sqlrptfield=".$sqlrptfield."<br>"; 
						$resrptfield = mysqli_query($dbcon, $sqlrptfield);
					}
					if($resrptfield){
						return(true);
					}else{
						return($sqlrptfield);
					}
				}
			}
			
		}
	
	
}
	
	
function update_field($ptable_name, $dznr_module_recid, $rowtempfields){
//echo "within function update_field()"."<br>";
	global $database; 
	global $dbcon;		
	if($rowtempfields['action']=='add' ){
		//echo "within if action==add "."<br>";
		
		$sqlfieldexist = "SELECT count(1) as fieldscnt
					FROM INFORMATION_SCHEMA.COLUMNS
				   WHERE table_name = '".$ptable_name."'
					 AND table_schema = '".$database."'
					 AND column_name = '".$rowtempfields['field_name']."' ";
		//echo "sqlfieldexist=".$sqlfieldexist."<br>";
		$resfieldexist = mysqli_query($dbcon, $sqlfieldexist);
		$rowfieldexist = mysqli_fetch_assoc($resfieldexist);
		
		
		$sql2="INSERT INTO dznr_module_fields set 
				field_label='".$rowtempfields['field_label']."',
				field_name='".strtolower(str_replace(' ','_',$rowtempfields['field_label']))."',
				field_type='".$rowtempfields['field_type']."',
				isrequired='".$rowtempfields['isrequired']."',
				display_pos='".$rowtempfields['display_pos']."', 
				default_value='".$rowtempfields['default_value']."', 
				range_min='".$rowtempfields['range_min']."', 
				range_max='".$rowtempfields['range_max']."', 
				
				list_type='".$rowtempfields['list_type']."', 
				staticlist='".$rowtempfields['staticlist']."', 
				codelist='".$rowtempfields['codelist']."', 
				newcodelist='".$rowtempfields['newcodelist']."', 
				listmodulename='".$rowtempfields['listmodulename']."', 
				listmoduleitem='".$rowtempfields['listmoduleitem']."', 
				
				onlistpag='".$rowtempfields['onlistpag']."', 
				clientid='".$rowtempfields['clientid']."', 
				dznr_moduleid = '".$dznr_module_recid."' "; 
				
		//echo $sql2."<br>";
		$sql_query=mysqli_query($dbcon, $sql2);
	
	
	
	
			if($rowfieldexist['fieldscnt'] == '0' && ( $pfield_type != 'display_input' && $pfield_type != 'column_heading' && $pfield_type != 'nondb_input' && $pfield_type != 'submodule' )){
				
				$sqlfield="alter table ".$ptable_name." add ( ". $rowtempfields['field_name'];
				
				if($rowtempfields == "text_input"){
					$sqlfield .= " varchar(200) ";
				}elseif($rowtempfields == "check_box"){
					$sqlfield .= " varchar(5) ";
				}elseif($rowtempfields == "date_input"){
					$sqlfield .= " date ";
				}elseif($rowtempfields == "datetime"){
					$sqlfield .= " datetime ";
				}elseif($rowtempfields == "number_input"){
					$sqlfield .= " int(11) ";
				}elseif($rowtempfields == "text_area"){
					$sqlfield .= " text ";
				}elseif($rowtempfields == "rich_text_editor"){
					$sqlfield .= " text ";
				}elseif($rowtempfields == "password_input"){
					$sqlfield .= " varchar(50) ";
					
				}elseif($rowtempfields == "codes_list"){
					$sqlfield .= " varchar(10) ";
				}elseif($rowtempfields == "new_codes_list"){
					$sqlfield .= " varchar(100) ";
				}elseif($rowtempfields == "radio_button"){
					$sqlfield .= " varchar(10) ";
				}elseif($rowtempfields == "check_box"){
					$sqlfield .= " varchar(10) ";
				}elseif($rowtempfields == "email_input"){
					$sqlfield .= " varchar(100) ";
					
				}else{
					$sqlfield .= " varchar(200) ";
				}
				
				$sqlfield .= " ); ";
					
				//echo "sqlfield=".$sqlfield."<br>";
				$resfield = mysqli_query($dbcon, $sqlfield);

				if($resfield){
					
				
					$sqlrptfield = "insert into rptusrfields set
									table_name = '".$ptable_name."',
									field_name = '".$rowtempfields['field_name']."',
									field_type = '".$rowtempfields['field_type']."',
									field_descr = '".$rowtempfields['field_descr']."',
									clientid = '".$rowtempfields['clientid']."' ";
					//echo "sqlrptfield=".$sqlrptfield."<br>";  
					$resrptfield = mysqli_query($dbcon, $sqlrptfield);
					/*if($resrptfield){
						return(1);
					}else{
						return($sqlrptfield);
					}*/
				}
			} 
			
		
	
	
	}else if($rowtempfields['action']=='update' || $rowtempfields['action']=='edit'){
		//echo "within if action==update | edit "."<br>";
		$sqlfieldexist = "SELECT count(1) as fieldscnt
					FROM INFORMATION_SCHEMA.COLUMNS
				   WHERE table_name = '".$ptable_name."'
					 AND table_schema = '".$database."'
					 AND column_name = '".$rowtempfields['old_field_name']."' ";
		//echo "sqlfieldexist=".$sqlfieldexist."<br>";
		$resfieldexist = mysqli_query($dbcon, $sqlfieldexist);
		$rowfieldexist = mysqli_fetch_assoc($resfieldexist);
		
		
		$sql2="update dznr_module_fields set 
				field_label='".$rowtempfields['field_label']."',
				field_name='".strtolower(str_replace(' ','_',$rowtempfields['field_label']))."',
				field_type='".$rowtempfields['field_type']."',
				isrequired='".$rowtempfields['isrequired']."',
				display_pos='".$rowtempfields['display_pos']."', 
				default_value='".$rowtempfields['default_value']."', 
				range_min='".$rowtempfields['range_min']."', 
				range_max='".$rowtempfields['range_max']."', 
				
				list_type='".$rowtempfields['list_type']."', 
				staticlist='".$rowtempfields['staticlist']."', 
				codelist='".$rowtempfields['codelist']."', 
				newcodelist='".$rowtempfields['newcodelist']."', 
				listmodulename='".$rowtempfields['listmodulename']."', 
				listmoduleitem='".$rowtempfields['listmoduleitem']."', 
				
				onlistpag='".$rowtempfields['onlistpag']."'
				
			 where id = '".$rowtempfields['fieldid']."' "; 
				
		//echo $sql2."<br>";
		$sql_query=mysqli_query($dbcon, $sql2);
		
		
		if($rowfieldexist['fieldscnt'] == '1'){	
			
			if($rowtempfields['old_field_name'] != $rowtempfields['field_name']){
				
				$sqlfield = " alter table ".$ptable_name." change ".$rowtempfields['old_field_name']."  ".$rowtempfields['field_name'] ;
				
				if($rowtempfields['field_type'] == "text"){
					$sqlfield .= " varchar(200) ";
				}elseif($rowtempfields['field_type'] == "checkbox"){
					$sqlfield .= " varchar(5) ";
				}elseif($rowtempfields['field_type'] == "date"){
					$sqlfield .= " date ";
				}elseif($rowtempfields['field_type'] == "datetime"){
					$sqlfield .= " datetime ";
				}elseif($rowtempfields['field_type'] == "number_input"){
					$sqlfield .= " int(11) ";
				}elseif($rowtempfields['field_type'] == "textarea"){
					$sqlfield .= " text ";
				}elseif($rowtempfields['field_type'] == "textareaweditor"){
					$sqlfield .= " text ";
				}else{
					$sqlfield .= " varchar(200) ";
				}
				
				$sqlfield .= " ; ";
					
				//echo "sqlfield=".$sqlfield."<br>";
				$resfield = mysqli_query($dbcon, $sqlfield);

				if($resfield){
				
							
					$sqlrptfield = "update rptusrfields set
										field_name = '".$rowtempfields['field_name']."',
										field_type = '".$rowtempfields['field_type']."',
										field_descr = '".$rowtempfields['field_descr']."'
									where field_name = '".$rowtempfields['old_field_name']."'
									and table_name = '".$ptable_name."'
									and clientid = '".$rowtempfields['clientid']."' ";
									
					//echo "sqlrptfield=".$sqlrptfield."<br>";  //die();
					$resrptfield = mysqli_query($dbcon, $sqlrptfield);
					/*if($resrptfield){
						return(1);
					}else{
						return($sqlrptfield);
					}*/
				}
			}
		}else if($rowfieldexist['fieldscnt'] == '0' && $rowtempfields['action']=='update' && ( $pfield_type != 'display_input' && $pfield_type != 'column_heading' && $pfield_type != 'nondb_input' && $pfield_type != 'submodule' )){
				
				$sqlfield="alter table ".$ptable_name." add ( ". $rowtempfields['field_name'];
				
				
				
				if($rowtempfields['field_type'] == "text"){
					$sqlfield .= " varchar(200) ";
				}elseif($rowtempfields['field_type'] == "checkbox"){
					$sqlfield .= " varchar(5) ";
				}elseif($rowtempfields['field_type'] == "date"){
					$sqlfield .= " date ";
				}elseif($rowtempfields['field_type'] == "datetime"){
					$sqlfield .= " datetime ";
				}elseif($rowtempfields['field_type'] == "number_input"){
					$sqlfield .= " int(11) ";
				}elseif($rowtempfields['field_type'] == "textarea"){
					$sqlfield .= " text ";
				}elseif($rowtempfields['field_type'] == "textareaweditor"){
					$sqlfield .= " text ";
				}else{
					$sqlfield .= " varchar(200) ";
				}
				
				$sqlfield .= " ); ";
					
				//echo "sqlfield=".$sqlfield."<br>";
				$resfield = mysqli_query($dbcon, $sqlfield);

				if($resfield){
				
							
					$sqlrptfield = "update rptusrfields set
										field_name = '".$rowtempfields['field_name']."',
										field_type = '".$rowtempfields['field_type']."',
										field_descr = '".$rowtempfields['field_descr']."'
									where field_name = '".$rowtempfields['old_field_name']."'
									and table_name = '".$ptable_name."'
									and clientid = '".$rowtempfields['clientid']."' ";
									
					//echo "sqlrptfield=".$sqlrptfield."<br>";  //die();
					$resrptfield = mysqli_query($dbcon, $sqlrptfield);
					/*if($resrptfield){
						return(1);
					}else{
						return($sqlrptfield);
					}*/
				}
			
		}	
		
	
	}else if($rowtempfields['action']=='delete'){
		//echo "within if action==delete "."<br>";
		
		$sqlfieldexist = "SELECT count(1) as fieldscnt
				FROM INFORMATION_SCHEMA.COLUMNS
			   WHERE table_name = '".$ptable_name."'
				 AND table_schema = '".$database."'
				 AND column_name = '".$rowtempfields['field_name']."' ";
				 
		//echo "sqlfieldexist=".$sqlfieldexist."<br>";
		$resfieldexist = mysqli_query($dbcon, $sqlfieldexist);
		$rowfieldexist = mysqli_fetch_assoc($resfieldexist);
			
			if($rowfieldexist['fieldscnt'] == '1'){
			
				$sqlfield="alter table ".$ptable_name." drop column  ".$rowtempfields['field_name']."; " ;
				//echo "sqlfield=".$sqlfield."<br>";
				$resfield = mysqli_query($dbcon, $sqlfield);

				$sql2="delete from dznr_module_fields 
						 where id = '".$rowtempfields['fieldid']."' "; 
				//echo $sql2."<br>";
				$sql_query=mysqli_query($dbcon, $sql2);
			
			
				$sqlrptfield = "delete from rptusrfields 
								where table_name = '".$ptable_name."'
								 and  field_name = '".$rowtempfields['field_name']."'
								 and clientid = '".$rowtempfields['clientid']."'
								";
				//echo "sqlrptfield=".$sqlrptfield."<br>"; 
				$resrptfield = mysqli_query($dbcon, $sqlrptfield);
			
				/*if($resrptfield){
					return(1);
				}else{
					return(0);
				}*/
					
			
			}
		
	
	}
	
	
}
	

	
function savetable($ptable_name, $module_descr,  $application, $module_name, $menutype){
		global $clientid;
		global $dbcon;
		$sqldroptable ="DROP TABLE IF EXISTS ".$ptable_name; 
		$resdroptable = mysqli_query($dbcon, $sqldroptable);
		
		$sqlcrtable = "create table  if not exists ".$ptable_name." (  
						id int(11) NOT NULL AUTO_INCREMENT,
						userid varchar(10) ,  ";
	
		if($menutype == 'submodule'){	
			$sqlcrtable .= " parentid varchar(5), ";
		}
		$sqlcrtable .= " active varchar(5) DEFAULT 'Y',
						recdate timestamp DEFAULT CURRENT_TIMESTAMP ,
						PRIMARY KEY (id)
					);";
	//echo "sqlcrtable=".$sqlcrtable."<br>";
	$rescrtable = mysqli_query($dbcon, $sqlcrtable);
	if($rescrtable){
		$sqlrptablexist = "select count(1) cntr from rptusrtables where table_name = '".$ptable_name."' and clientid = '".$clientid."'";   
		$resrptablexist = mysqli_query($dbcon, $sqlrptablexist);
		$rowrptablexist = mysqli_fetch_assoc($resrptablexist);
		if($rowrptablexist['cntr'] == '0'){
			$sqltable = "insert into rptusrtables set
							table_name = '".$ptable_name."',
							table_descr = '".$module_descr."',
							table_aliase = '".$ptable_name."',
							table_type = 'user_defined',
							applicid = '".$application."',
							clientid = '".$clientid."',
							active = 'Y' ";
			//echo $sqltable."<br>";
			$restable = mysqli_query($dbcon, $sqltable);
			// if($restable){
				// return(1);
			// }else{
				// return(0);
			// }
		}
	}
	addaplicmodule( $clientid, $application, $module_name, $ptable_name);
	
}


	
function update_table($ptable_name, $module_descr,  $application, $module_name, $field_name, $action){ //never used this function
	global $clientid;
	global $dbcon;
	if($action='delete'){
		$sqlupdtable ="alter table ".$ptable_name." 
					drop ".$field_name."; ";
	
	}else if($action='add'){
		$sqlupdtable ="alter table ".$ptable_name." 
					ADD ".$field_name." VARCHAR(200) ; ";
		
	}
	
	//echo "sqlupdtable=".$sqlupdtable."<br>";
	$resupdtable = mysqli_query($dbcon, $sqlupdtable);
	
	
	//update_aplicmodule( $clientid, $application, $module_name, $ptable_name);
	
}

function checkduplicate($arvalus){
	
	$totitems = count($arvalus);
	$duplpos = "";
	for($i=0; $i<$totitems; $i++){
		for($j=$i; $j<$totitems; $j++){
			if($arvalus[$i]==$arvalus[$j] and $i!=$j){
				$duplpos .= $j.'|';
			}
		}
	}
	return($duplpos);
}


function gettablprefix($papplication){
	global $dbcon;
	$sqlprefx = "select * from applications 
					where applicname = '".$papplication."'";
	$resprefx = mysqli_query($dbcon, $sqlprefx);
	$rowprefx = mysqli_fetch_assoc($resprefx);
	return($rowprefx['table_prefix']);

}


function show_field_info($rowfield){
	global $clientid;
	global $dbcon;
	$vdivid = $rowfield["divid"];    
	$vfieldid = $rowfield["id"];    
	$vfieldstatus = 'edit';
	$vmoduleid = $rowfield["moduleid"]; 
	$vmodule_name = $rowfield["module_name"];    
	$vitemtype = $rowfield["itemtype"];    
	$vdisplay_pos = $rowfield["display_pos"];    
	$vfield_label = $rowfield["field_label"];   
	$vfield_name =  $rowfield["field_name"];    
	$vfield_type = $rowfield["field_type"];    
	$visrequired = $rowfield["isrequired"];
	$vdisplay_seq = $rowfield["display_seq"];    
	$vdefault_value = $rowfield["default_value"];    
	$vrange_min = $rowfield["range_min"];    
	$vrange_max = $rowfield["range_max"];    
	$vitem_values = $rowfield["item_values"];    
	$vlist_type = $rowfield["list_type"];   
	$vstaticlist = $rowfield["staticlist"];    
	$vcodelist = $rowfield["codelist"];    
	$vnewcodelist = $rowfield["newcodelist"];    
	$vlistmodulename = $rowfield["listmodulename"];    
	$vlistmoduleitem = $rowfield["listmoduleitem"];    
	$vonlistpag = $rowfield["onlistpag"];
		
	//echo "vfield_name = ".$vfield_name." , field type=".$vfield_type."<br>";



 if($vfield_type=='column_heading'){ ?>
	
		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<table width="100%"><tr bgcolor="#ccccff"><td><h3 align="left"><b><?php echo $vfield_label; ?></b></h3></td></tr></table>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
			
<?php } else if($vfield_type=='display_input'){ ?>
 
		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="text" disabled name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level"  value="<?php echo $vdefault_value; ?>" />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
					
<?php } else if($vfield_type=='nondb_input'){ ?>
 
		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="text" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level"  value="<?php echo $vdefault_value; ?>" />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
			
<?php } else if($vfield_type=='text_input'){ ?>
 
		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="text" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level"  value="<?php echo $vdefault_value; ?>"
						<?php if($visrequired=='Y'){echo ' required '; } ?>  />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
			
<?php } else if($vfield_type=='url_input'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="text" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level"  value="<?php echo $vdefault_value; ?>"
						<?php if($visrequired=='Y'){echo ' required '; } ?>  />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
				
<?php } else if($vitemtype=='display_input'){ ?>
		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
			<label class="strong"><?php echo $vfield_label; ?> </label>
			<input type="text" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level" disabled value="<?php echo $vdefault_value; ?>" />
			<?php // echo "<p style='color:red;font-size:12px;'>".$error[$vfield_name].'</p>'; ?>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>

			
<?php } else if($vfield_type=='date_input'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="date" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level"  value=""
						<?php if($visrequired=='Y'){echo ' required '; } ?>  />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
				

<?php } else if($vfield_type=='text_area'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<textarea  name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level"><?php echo $vdefault_value; ?></textarea>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>

<?php } else if($vfield_type=='rich_text_editor'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<img src="images/nicedit.png" >
				<textarea  name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level nicedit" ></textarea>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>

			
<?php } else if($vfield_type=='password_input'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="password" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level2"  value=""
						<?php if($visrequired=='Y'){echo ' required '; } ?>  />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
				
				
				
<?php } else if($vfield_type=='single_file') {?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="file" name="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>"  id="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>"  class="input-block-level"  />
				</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>	
		
<?php } else if($vfield_type=='multiple_files'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="file" multiple name="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>[]"  id="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>"  class="input-block-level" />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
		
<?php } else if($vfield_type=='single_image'){  ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="file" name="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>"  id="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>"  class="input-block-level"  />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
		
<?php } else if($vfield_type=='multiple_images'){  ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="file" multiple  name="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>[]"  id="<?php echo strtolower(str_replace(' ','_',$vfield_label)); ?>"  class="input-block-level" />
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
		
<?php } else if($vfield_type=='check_box'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<input type="checkbox" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level2"  value="1"
							<?php if($visrequired=='Y'){echo ' required '; } ?>  /> <strong><?php echo $vfield_label; ?> </strong>
				
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>

<?php } else if($vfield_type=='number_input'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<input type="number" name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>" min="<?php echo $vrange_min; ?>" max="<?php if($vrange_max>0){ echo $vrange_max; } ?>"  class="input-block-level2"  value=""
							<?php if($visrequired=='Y'){echo ' required '; } ?>  />
				
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
			
<?php } else if($vfield_type=='multi_choice'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<select name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>" multiple="multiple"  class="input-block-level2"  	<?php if($visrequired=='Y'){echo ' required '; } ?>  >
					<?php 
						$aritem_values = explode(',',$vitem_values);
						for( $i=0; $i<count($aritem_values); $i++ ){
							echo '<option value="'.strtolower(str_replace(' ','_',$aritem_values[$i])).'">'.$aritem_values[$i].'</option>';
						}
					?>
				</select>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
		
<?php } else if($vfield_type=='drop_down'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">

				<label class="strong"><?php echo $vfield_label; ?> </label>
				<select name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level2"  	<?php if($visrequired=='Y'){echo ' required '; } ?>  >
				<option value="">--Select--</option>
				<?php 
					$aritem_values = explode(',',$vitem_values);
					for( $i=0; $i<count($aritem_values); $i++ ){
						echo '<option value="'.strtolower(str_replace(' ','_',$aritem_values[$i])).'">'.$aritem_values[$i].'</option>';
					}
				?>
				</select>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
		
<?php } else if($vfield_type=='new_codes_list'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">

				<label class="strong"><?php echo $vfield_label; ?> </label>
				<?php 
				$sqlcodelist = "select m.lov_name,  d.data_entry, d.label 
								from lov_master m, lov_details d
								where m.id = d.lov_masterid 
								and m.lov_name = '".$vnewcodelist."'";
				$rescodelist = mysqli_query($dbcon, $sqlcodelist);
				?>
				<select  name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level2"  	<?php if($visrequired=='Y'){echo ' required '; } ?>  >
					<option value="">--Select--</option>
					<?php while($rowcodelist = mysqli_fetch_assoc($rescodelist)){ ?>
						<option value="<?php echo $rowcodelist['data_entry']; ?>" ><?php echo $rowcodelist['label']; ?></option>
					<?php } ?>
				</select>
				<a style="cursor:pointer;" class="btn btn-primary btn-icon glyphicons circle_plus" ><i></i> Add</a>	
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
				
<?php } else if($vfield_type=='codes_list'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">

				<label class="strong"><?php echo $vfield_label; ?> </label>
				<?php 
				$sqlcodelist = "select m.lov_name,  d.data_entry, d.label 
								from lov_master m, lov_details d
								where d.lov_masterid = m.id
								and m.id = '".$vcodelist."'";
				$rescodelist = mysqli_query($dbcon, $sqlcodelist);
				?>
				<select  name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level2"  	<?php if($visrequired=='Y'){echo ' required '; } ?>  >
					<option value="">--Select--</option>
					<?php while($rowcodelist = mysqli_fetch_assoc($rescodelist)){ ?>
						<option value="<?php echo $rowcodelist['data_entry']; ?>" ><?php echo $rowcodelist['label']; ?></option>
					<?php } ?>
				</select>
				<a style="cursor:pointer;" class="btn btn-primary btn-icon glyphicons circle_plus" ><i></i> Add</a>	
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>
		
<?php } else if($vfield_type=='referenced_data'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">

				<label class="strong"><?php echo $vfield_label; ?> </label>
				<select name="<?php echo $vfield_name; ?>"  id="<?php echo $vfield_name; ?>"  class="input-block-level2"  	<?php if($visrequired=='Y'){echo ' required '; } ?>  >
				<option value="">--Select--</option>
				<?php 
					$sqlrefdata = "select ".$vlistmoduleitem." from ".$vlistmodulename. " where active='Y' ";
					$resrefdata = mysqli_query($dbcon, $sqlrefdata);
					while($rowrefdata = mysqli_fetch_array($resrefdata, mysqli_NUM)){ 
						echo '<option value="'.strtolower(str_replace(' ','_',$rowrefdata[0])).'">'.$rowrefdata[0].'</option>';
					}
				?>
				</select>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>	
			
			

<?php } else if($vfield_type=='radio_button'){ ?>

		<li class="sortit"> 
			<div id="<?php echo $vdivid; ?>">
				<label class="strong"><?php echo $vfield_label; ?> </label>
				<?php 
					$aritem_values = explode(',',$vitem_values);
					for( $i=0; $i<count($aritem_values); $i++ ){
						echo '<input type="radio" name="'.strtolower(str_replace(' ','_',$vfield_label)).'" value="'.strtolower(str_replace(' ','_',$aritem_values[$i])).'">'.$aritem_values[$i].'<br> ';
					}
				?>
			</div> 
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
		</li>

<?php } else if($vfield_type=='submodule'){ 
			$sqlmodl = "select 	m.module_name, m.page_name, m.module_type, m.menutype, m.add_page, m.edit_page, m.view_page, m.duplicate_page, m.list_page, m.application, m.module_descr, m.table_name, m.clientid, m.sql_script_file, m.php_script_files, m.config_file, 
							f.dznr_moduleid, f.field_label, f.field_name, f.field_type, f.isrequired, f.display_pos, f.default_value, f.range_min, f.range_max, f.list_type, f.item_values, f.staticlist, f.codelist, f.newcodelist, f.listmodulename, f.listmoduleitem, f.codes_list_name, f.onlistpag
						from dznr_modules m, dznr_module_fields f 
						where m.id = f.dznr_moduleid
						  and m.id = '".$vdefault_value."'
						  and m.active='Y' and f.active='Y'
						  and m.clientid = '".$clientid."'
						  ";
			//echo $sqlmodl;
			$resmodl = mysqli_query($dbcon, $sqlmodl);
		while($rowmodl = mysqli_fetch_assoc($resmodl)){
		
			$submodule_tmplt = getFieldInfo4Table($rowmodl['field_type']);
			
			if($submodule_tmplt != ""){
				//echo "submodule_tmplt has value";
				//$submodule_tmplt = str_replace("#label",$rowmodl["field_label"], $submodule_tmplt);
				$submodule_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $submodule_tmplt);
				$submodule_tmplt = str_replace("#tablename",$rowmodl["table_name"], $submodule_tmplt);
				
				if($rowmodl["isrequired"] == 'Y'){
					$submodule_tmplt = str_replace("#isrequired"," required ", $submodule_tmplt);
				}else{
					$submodule_tmplt = str_replace("#isrequired"," ", $submodule_tmplt);
				}
				
			
					if($rowmodl["field_type"] == 'multi_choice'){
						$submodule_tmplt = str_replace("#liststaticvalues",$rowmodl["item_values"], $submodule_tmplt);
					}else if($rowmodl["field_type"] == 'drop_down'){
						$submodule_tmplt = str_replace("#liststaticvalues",$rowmodl["item_values"], $submodule_tmplt);
					}else if($rowmodl["field_type"] == 'codes_list'){
						$submodule_tmplt = str_replace("#codelistname",$rowmodl["codelist"], $submodule_tmplt);
					}else if($rowmodl["field_type"] == 'new_codes_list'){
						
						$sqlnewcodechk = "select * from lov_master where lov_name = '".strtolower(str_replace(' ','_',$rowmodl["newcodelist"]))."' ";
						$resnewcodechk = mysqli_query($dbcon, $sqlnewcodechk);
						$cntnewcodechk = mysqli_num_rows($resnewcodechk);
						if($cntnewcodechk == 0){
							$sqlnewcodadd = "insert into lov_master set 
												lov_name = '".strtolower(str_replace(' ','_',$rowmodl["newcodelist"]))."',
												lov_desc = '".$rowmodl["newcodelist"]."', 
												module_name = '".$module_name."', 
												clientid = '".$clientid."'";
							$resnewcodeadd = mysqli_query($dbcon, $sqlnewcodadd);
						}
						$submodule_tmplt = str_replace("#codelistname",strtolower(str_replace(' ','_',$rowmodl["newcodelist"])), $submodule_tmplt);
						
					}else if($rowmodl["field_type"] == 'referenced_data'){
						$submodule_tmplt = str_replace("#moduletablename",$rowmodl["listmodulename"], $submodule_tmplt);
						$submodule_tmplt = str_replace("#modulefieldname",$rowmodl["listmoduleitem"], $submodule_tmplt);
					}
				
				 
				if($rowmodl["field_type"] == 'single_image'){
					
					$submodule_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $submodule_tmplt);
					$simage_upload_tmplt = str_replace("#tablename",$table_name, $simage_upload_tmplt);
					$simage_upload_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $simage_upload_tmplt);
					$file_upload_tmplt = $simage_upload_tmplt;
				}
				
				if($rowmodl["field_type"] == 'multiple_images'){
					
					$submodule_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $submodule_tmplt);
					$mimage_upload_tmplt = str_replace("#tablename",$table_name, $mimage_upload_tmplt);
					$mimage_upload_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $mimage_upload_tmplt);
					$file_upload_tmplt = $mimage_upload_tmplt;
				}
				
				if($rowmodl["field_type"] == 'single_file'){
					
					$submodule_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $submodule_tmplt);
					$sfile_upload_tmplt = str_replace("#tablename",$table_name, $sfile_upload_tmplt);
					$sfile_upload_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $sfile_upload_tmplt);
					$file_upload_tmplt = $sfile_upload_tmplt;
				}
				
				if($rowmodl["field_type"] == 'multiple_files'){
					
					$submodule_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $submodule_tmplt);
					$mfile_upload_tmplt = str_replace("#tablename",$table_name, $mfile_upload_tmplt);
					$mfile_upload_tmplt = str_replace("#fieldname",$rowmodl["field_name"], $mfile_upload_tmplt);
					$file_upload_tmplt = $mfile_upload_tmplt;
				}
				
				if($rowmodl["field_type"] == 'radio_button'){
					$submodule_tmplt = str_replace("#radiostaticvalues",$rowmodl["item_values"], $submodule_tmplt);
				}
				
			}
			
			$submodule_heading_row .= '<td>'.$rowmodl["field_label"].'</td>';
			$submodule_data_row .= '<td>'.$submodule_tmplt.'</td>';
		}
		
		
			 ?>
			 <li class="sortit">
			<br>
			<div>
				<table width="100%">
				<tr bgcolor="#ccccff">
					<td><h3 align="left"><b><?php echo $vfield_label; ?></b></h3></td>
				</tr></table>
			
				<div id="row-fluid" style="overflow:scroll;">
					<table style="border: 1px solid gray;" id="table" width="100%">
						<tbody>
						<tr>
						<?php
							echo $submodule_heading_row;
						?>
						</tr>
						<tr>
						<?php
							echo $submodule_data_row;
						?>
						</tr>
						</tbody>
					</table>
					
				</div>
			</div>
			<a  id="txtinputId"  style="cursor:pointer;font-size:12px;" class="fancybox"  onClick="showattribs(<?php echo "'".$vfield_type."' , '".$vdivid."'" ; ?>); return false;" >Set Properties</a> 
			</li>

<?php } else { echo "Nothing to display-3"; }



}


function getFieldInfo4Table($rowfield){
	global $dbcon;
	if($rowfield == 'text_input'){
		$field_tmplt = file_get_contents('templates/input_column_text.txt');
	} else if($rowfield == 'email_input'){
		$field_tmplt = file_get_contents('templates/input_column_email.txt');	
	} else if($rowfield == 'display_input'){
		$field_tmplt = file_get_contents('templates/input_column_display.txt');	
	} else if($rowfield == 'column_heading'){
		$field_tmplt = file_get_contents('templates/column_heading.txt');	
	} else if($rowfield == 'password_input'){
		$field_tmplt = file_get_contents('templates/input_column_password.txt');	
	} else if($rowfield == 'text_area'){
		$field_tmplt = file_get_contents('templates/input_column_textarea.txt');
	} else if($rowfield == 'rich_text_editor'){
		$field_tmplt = file_get_contents('templates/input_column_textareaweditor.txt');	
	} else if($rowfield == 'number_input'){
				$field_tmplt = file_get_contents('templates/input_column_number.txt');
	}else if($rowfield == 'single_image'){
				$field_tmplt = file_get_contents('templates/input_column_simage.txt');
				$simage_upload_tmplt = file_get_contents('templates/simage_upload.txt');
	}else if($rowfield == 'multiple_images'){
				$field_tmplt = file_get_contents('templates/input_column_mimage.txt');
				$mimage_upload_tmplt = file_get_contents('templates/mimage_upload.txt');
	}else if($rowfield == 'single_file'){
				$field_tmplt = file_get_contents('templates/input_column_sfile.txt');
				$sfile_upload_tmplt = file_get_contents('templates/sfile_upload.txt');
	}else if($rowfield == 'multiple_files'){
				$field_tmplt = file_get_contents('templates/input_column_mfile.txt');
				$mfile_upload_tmplt = file_get_contents('templates/mfile_upload.txt');
	}else if($rowfield == 'check_box'){
				$field_tmplt = file_get_contents('templates/input_column_checkbox.txt');
	}else if($rowfield == 'radio_button'){
				$field_tmplt = file_get_contents('templates/input_column_radio.txt');
	}else if($rowfield == 'url_input'){
				$field_tmplt = file_get_contents('templates/input_column_url.txt');
	} else if($rowfield == 'datetime'){
				$field_tmplt = file_get_contents('templates/input_column_datetime.txt');
	} else if($rowfield == 'date_input'){
				$field_tmplt = file_get_contents('templates/input_column_date.txt');
	}else if($rowfield == 'multi_choice'){
		$field_tmplt = file_get_contents('templates/input_column_multichoice.txt');
	}else if($rowfield == 'drop_down'){
		$field_tmplt = file_get_contents('templates/input_column_staticlist.txt');
	}else if($rowfield == 'codes_list'){
		$field_tmplt = file_get_contents('templates/input_column_codelist.txt');
	}else if($rowfield == 'new_codes_list'){
		$field_tmplt = file_get_contents('templates/input_column_newcodelist.txt');
	}else if($rowfield == 'referenced_data'){
		$field_tmplt = file_get_contents('templates/input_column_modulefield.txt');
	}
	
	return($field_tmplt);
}



function getFieldInfo4TableWithValues($rowfield){
	global $dbcon;
	if($rowfield == 'text_input'){
		$field_tmplt = file_get_contents('templates/input_column_value_text.txt');
	} else if($rowfield == 'email_input'){
		$field_tmplt = file_get_contents('templates/input_column_value_email.txt');	
	} else if($rowfield == 'display_input'){
		$field_tmplt = file_get_contents('templates/input_column_value_display.txt');	
	} else if($rowfield == 'column_heading'){
		$field_tmplt = file_get_contents('templates/column_value_heading.txt');	
	} else if($rowfield == 'password_input'){
		$field_tmplt = file_get_contents('templates/input_column_value_password.txt');	
	} else if($rowfield == 'text_area'){
		$field_tmplt = file_get_contents('templates/input_column_value_textarea.txt');
	} else if($rowfield == 'rich_text_editor'){
		$field_tmplt = file_get_contents('templates/input_textareaweditor.txt');	
	} else if($rowfield == 'number_input'){
				$field_tmplt = file_get_contents('templates/input_column_value_number.txt');
	}else if($rowfield == 'single_image'){
				$field_tmplt = file_get_contents('templates/input_column_value_simage.txt');
				$simage_upload_tmplt = file_get_contents('templates/simage_upload.txt');
	}else if($rowfield == 'multiple_images'){
				$field_tmplt = file_get_contents('templates/input_column_value_mimage.txt');
				$mimage_upload_tmplt = file_get_contents('templates/mimage_upload.txt');
	}else if($rowfield == 'single_file'){
				$field_tmplt = file_get_contents('templates/input_column_value_sfile.txt');
				$sfile_upload_tmplt = file_get_contents('templates/sfile_upload.txt');
	}else if($rowfield == 'multiple_files'){
				$field_tmplt = file_get_contents('templates/input_column_value_mfile.txt');
				$mfile_upload_tmplt = file_get_contents('templates/mfile_upload.txt');
	}else if($rowfield == 'check_box'){
				$field_tmplt = file_get_contents('templates/input_column_value_checkbox.txt');
	}else if($rowfield == 'radio_button'){
				$field_tmplt = file_get_contents('templates/input_column_value_radio.txt');
	}else if($rowfield == 'url_input'){
				$field_tmplt = file_get_contents('templates/input_column_value_url.txt');
	} else if($rowfield == 'datetime'){
				$field_tmplt = file_get_contents('templates/input_column_value_datetime.txt');
	} else if($rowfield == 'date_input'){
				$field_tmplt = file_get_contents('templates/input_column_value_date.txt');
	}else if($rowfield == 'multi_choice'){
		$field_tmplt = file_get_contents('templates/input_column_value_multichoice.txt');
	}else if($rowfield == 'drop_down'){
		$field_tmplt = file_get_contents('templates/input_column_value_staticlist.txt');
	}else if($rowfield == 'codes_list'){
		$field_tmplt = file_get_contents('templates/input_column_value_codelist.txt');
	}else if($rowfield == 'new_codes_list'){
		$field_tmplt = file_get_contents('templates/input_column_value_newcodelist.txt');
	}else if($rowfield == 'referenced_data'){
		$field_tmplt = file_get_contents('templates/input_column_value_modulefield.txt');
	}
	
	return($field_tmplt);
}


?>