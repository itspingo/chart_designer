<?php include_once("config.php");

$clientid = '10' ;
$module_name = $_POST["module_name"];  
$divid =  $_POST["divid"];
$colname = $_POST["colname"];
$fieldid = $_POST["fieldid"];   
$field_label = $_POST["field_label"];   
//$field_name = $_POST["field_name"];   
$field_name =  strtolower(str_replace(' ','_', $field_label ));  //$_POST["vfield_name"];    
$field_type = $_POST["field_type"];   
$isrequired = $_POST["isrequired"];   
$display_pos = $_POST["display_pos"];
//$display_seq = $_POST["display_seq"];   
$default_value = $_POST["default_value"];   

$range_min = $_POST["range_min"];   
if($range_min==''){
	$range_min=0;
}
$range_max = $_POST["range_max"];   
if($range_max==''){
	$range_max=999999999;
}

$item_values = $_POST["item_values"];   
$list_type = $_POST["list_type"];   
$staticlist = $_POST["staticlist"];
$codelist = $_POST["codelist"];   
$newcodelist = $_POST["newcodelist"];   
$listmodulename = $_POST["listmodulename"];   
$listmoduleitem = $_POST["listmoduleitem"];   
$onlistpag = $_POST["onlistpag"];

$sqlseq = "select max(display_seq) as maxseq from dznr_module_fields where clientid = '".$clientid."'";
$reseq = mysqli_query($dbcon, $sqlseq);
$nrows = mysqli_num_rows($reseq);
if($nrows > 0){
	$rowseq = mysqli_fetch_assoc($reseq);
	$display_seq = $rowseq['maxseq']+1;
}else{
	$display_seq = 0;
}


$sql="insert into dznr_module_fields(module_name, divid, field_label, fieldid, field_name, field_type, isrequired, display_pos, display_seq, default_value, range_min, range_max, item_values, list_type, staticlist, codelist, newcodelist, listmodulename, listmoduleitem, codes_list_name, onlistpag, action, clientid) values('".$module_name."', '".$divid."', '".$field_label."', '".$fieldid."', '".$field_name."', '".$field_type."', '".$isrequired."', '".$display_pos."', '".$display_seq."', '".$default_value."', '".$range_min."', '".$range_max."', '".$item_values."', '".$list_type."', '".$staticlist."', '".$codelist."', '".$newcodelist."', '".$listmodulename."', '".$listmoduleitem."', '".$codes_list_name."', '".$onlistpag."', 'add', '".$clientid."' );  ";
//echo "<script>alert(". $sql. ")</script>";
//echo $sql;

mysqli_query($dbcon, $sql);

?>