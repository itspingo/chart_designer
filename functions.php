<?php 
//include_once('config.php');
error_reporting(E_ALL && ~E_WARNING && ~E_NOTICE);

if($_SERVER['HTTP_HOST'] =='localhost'){
	$path = "/snoobix/";	
}else{
	$path = "/projects/snoobix/";
}

define('SERVER','http://'.$_SERVER['HTTP_HOST'].$path);


function get_pin_no(){
	global $dbcon;
	$sqlpino = "select max(pin_no) as pinno from hse_pin_form ;";
	$respino = mysqli_query($dbcon, $sqlpino);
	$rowpino = mysqli_fetch_assoc($respino);
	if($rowpino['pinno'] == '' || $rowpino['pinno'] == 0){
		$vpin_no='0001';
		$npin_no = date('Y').'-'.$vpin_no;
	}else{
		$arpin_no = explode('-',$rowpino['pinno']);
		$pinno_digit = $arpin_no[1];
		$pinno_year = $arpin_no[0];
		$curyear = date('Y');
		if($curyear == $pinno_year){
			$vpin_no = 	str_pad($pinno_digit+1 , 4 , '0',STR_PAD_LEFT);
		}elseif($curyear > $pinno_year){
			$vpin_no = '0001';
		}
		
		$npin_no = date('Y').'-'.$vpin_no;
	}
	return($npin_no);
}


function iswarningoralaram($pid, $pvalue){
	global $dbcon;
	$sql="select * from hse_warnings_alarms where id = '".$pid."'";
	$resql = mysqli_query($dbcon, $sql);
	$rowsql = mysqli_fetch_assoc($resql);

	if($pvalue < $rowsql['warning']){
		$retval = 'green';
	}else if($pvalue >= $rowsql['warning'] && $pvalue < $rowsql['alarm']){
		$retval = 'yellow';
	}else if($pvalue >= $rowsql['alarm'] ){
		$retval = 'red';
	}else{
		$retval = 'white';
	}

}


function check_app_online($paramstr){
	if($paramstr != ''){
	
		$response = curl_get_contents('http://snoobix.com/webservice2.php?keystr='.$paramstr);
		//$response = curl_get_contents('http://localhost/snoobix/webservice2.php?keystr='.$paramstr);
		//$response = 'Valid'.'|'.$rowkey['clientid'].'|'.$rowkey['applicname'].'|'.$rowkey['appkey'];
		
		return($response);
	}
}

function stDev($arr)
{
    // Calculates the standard deviation for all non-zero items in an array
 
    $n = count(array_filter($arr));   // Counts non-zero elements in the array.
	if($n>0){
		$mean = array_sum($arr) / $n;     // Calculates the arithmetic mean.
		$sum = 0;        
	 
		foreach( $arr as $key=>$a )
		{
			$sum = $sum + pow( $a - $mean , 2 );
		}
	 
		$stdev = sqrt( $sum / $n ) ;
	}else{
		$stdev = 0;
	}
    return $stdev;
}

function send_task_email($taskid, $taskno, $asignedto, $siteinitiativeid){
	$emailto = get_user_info($asignedto,'email'); 
	$dashboardurl = "http://www.shupinc.com/modl.php?scrn=dashboard.php";
	$formurl = "http://www.shupinc.com/modl.php?scrn=tasks_edit.php&id=".$taskid;
	$mailsubj = "Your Assigned Task";
	$emailfrom = "info@shupinc.com";
	
	$emailbody = "Task No.:".$taskno."\r\n\r\n";
	
	$emailbody .="A new Task from ".getfieldval($siteinitiativeid,"hse_site_initiatives" ,"site_initiative" )." has been assigned 
					to you by ".show_user_name(getfieldval($siteinitiativeid,"hse_site_initiatives" ,"initiative_owner" ))."\r\n";  
	$emailbody .= "To view and update the task, click on the link below or sign into “SHUPinc.com” to view your dashboard."."\r\n\r\n";

	$emailbody .= " Link to Task Form: ". $formurl."\r\n"; 
	$emailbody .= " View My Dashboard: ".$dashboardurl."\r\n";

	$emailsent = sendemail($emailfrom, $emailto, $mailsubj, $emailbody);
	if($emailsent){
		return(true);
	}else{
		writemail($emailto, $emailfrom, $mailsubj, $emailbody,'email_header');
		return($emailsent);
	}
	
}

function get_task_no(){
	global $dbcon;
	$sqltaskno = "select task_number as taskno from hse_tasks where id = (select max(id) from hse_tasks)";
	//echo $sqltaskno;
	$restaskno = mysqli_query($dbcon, $sqltaskno);
	$rowtaskno = mysqli_fetch_assoc($restaskno);
	if($rowtaskno['taskno'] == '' || $rowtaskno['taskno'] == 0){
		
		$vtask_no='0001';
		$ntask_no = date('Y').'-'.$vtask_no;
	}else{
		
		$artask_no = explode('-',$rowtaskno['taskno']);
		//print_r($artask_no);  2019-0004
		$taskno_year = $artask_no[0];
		$taskno_digit = $artask_no[1];
		
		$curyear = date('Y');
		//echo "curyear: ".$curyear." , taskno_year: ".$taskno_year;
		if($curyear == $taskno_year){
			$vtask_no = str_pad($taskno_digit+1 , 4 , '0',STR_PAD_LEFT);
		}elseif($curyear > $taskno_year){
			$vtask_no = '0001';
		}
		$ntask_no = date('Y').'-'.$vtask_no;
	}
	return($ntask_no);
}


function show_user_name($pusrid){
	global $dbcon;
if($pusrid != ''){
	$squser = "select * from users where id = '".$pusrid."'";
	//echo $squser;
	$resuser = mysqli_query($dbcon, $squser);
	$rowuser = mysqli_fetch_assoc($resuser);
	$username = $rowuser['fname'].' '.$rowuser['lname'];
	return($username);
}
}
function get_user_info($pusrid,$pcolname){
	global $dbcon;
	if($pusrid != ''){
		$squser = "select $pcolname as colinfo from users where id = '".$pusrid."'";
		//echo $squser;
		$resuser = mysqli_query($dbcon, $squser);
		$rowuser = mysqli_fetch_assoc($resuser);
		$colinfo = $rowuser['colinfo'];
		return($colinfo);
	}
}

function clean($str){
	$str = trim($str);
	global $dbcon;
	if(get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
return mysqli_real_escape_string($dbcon, $str);
}


function getcodelistval($codelistname,$dataentry,$returnitem='label'){
	global $dbcon;
	$sqlcode = "select  m.lov_name, d.data_entry, d.label, d.meaning
				from lov_master m, lov_details d
				where d.lov_masterid=m.id
				and m.lov_name = '".$codelistname."'
				and d.data_entry = '".$dataentry."'
				";
	//echo $sqlcode;
	$rescode = mysqli_query($dbcon, $sqlcode);
	$rowcode =mysqli_fetch_assoc($rescode);
	return($rowcode[$returnitem]);
}

function getfieldval($recid,$tablename,$fieldname){
	global $dbcon;
	if($recid != ''){
		$sql="select * from $tablename where id = '".$recid."' "; 
		//echo $sql;
		$res=mysqli_query($dbcon, $sql);
		$row=mysqli_fetch_assoc($res);
		//return($sql);
		return($row[$fieldname]);
	}
}



function filexists($applicname, $filename){
	global $dbcon;
	global $clientid; //= $_SESSION['clientid'];
	$sqlfolder = "select * from applications where applicname = '".$applicname."'";
	//echo $sqlfolder;
	$resfolder = mysqli_query($dbcon, $sqlfolder);
	$rowfolder = mysqli_fetch_assoc($resfolder);
	$applicfolder = $rowfolder['applicfolder'];
	
	//print_r($rowfolder);
	if($rowfolder['clientid'] == 'ALL'){
		return(file_exists('applications/'.$applicfolder.'/'.$filename));
	}else{
		return(file_exists('applications/client_'.$clientid.'/'.$applicfolder.'/'.$filename));
	}
	
}

function resize_image($source_url, $reducedsize=0, $newwidth=0, $newheight=0) {
	 
	$info = getimagesize($source_url);
 
	if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
	elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
	elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);

	list($width,$height)=getimagesize($source_url);

	if($reducedsize > 0){
		$newwidth=$width - ($width * ($reducedsize / 100));
		$newheight=$height - ($height * ($reducedsize / 100)); //($height/$width)*$newwidth;
	}
	
	$tmp=imagecreatetruecolor($newwidth,$newheight);

	imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight, $width,$height);

	$filename = $source_url;
	//$filename = "images/". $_FILES['file']['name'];

	imagejpeg($tmp,$filename,100);

	//imagedestroy($src);
	imagedestroy($tmp);

	return($filename);
}



function checkversion($pclientid, $pcurver, $papplicname){
	//$appver = file_get_contents('http://localhost/snoobix/checkver.php?clid='.$pclientid.'&ver='.$pcurver.'&apl='.$papplicname);
	//$appver = file_get_contents('http://snoobix.com/checkver.php?apl='.$papplicname);
	
	//return($appver);
	return('1.0');
}

function get_filter_condition($pusrid, $ptablename){
	global $dbcon;
	$sql = "select g.groupname , r.recondition 
				from group_rights g , group_records r , users u
				where u.id = '".$pusrid."'
				and LOCATE(u.username, g.usernames) > -1
				and r.groupname=g.groupname
				and r.modulename='".$ptablename."' ";
		//echo $sql;
	$res = mysqli_query($dbcon, $sql);
	if(mysqli_num_rows($res)>0){
		$row = mysqli_fetch_assoc($res);
		return($row['recondition']);
	}else {
		return('');
	}
}


function remvlastchar($strval, $symbl){
   //echo "Old str: ".$strval."<br>";
	//$strlnth = strlen($strval);
	for($c = strlen($strval); $c>=0; $c--){
	
		if(ord(substr($strval, $c,1)) > 65 and ord(substr($strval, $c,1)) < 123 ){
			break;
		}elseif(substr($strval, $c,1)==$symbl OR substr($strval, $c,1)==' '){
			//$smblpos .= ' , '.$c; 
			$strval = substr_replace($strval,'',$c,1);
		}
	}
	//echo "New str: ".$strval."<br>";
	return($strval);
}


function curl_get_contents($url){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}



function get_lov($plov){
	global $dbcon;
	$sqlcodelist = "select m.lov_name,  d.data_entry, d.label 
					from lov_master m, lov_details d
					where m.id = d.lov_masterid 
					and m.lov_name = '".$plov."'";
	$rescodelist = mysqli_query($dbcon, $sqlcodelist);
	return($rescodelist);
}

function validate_key($pkeystr){

	$keystr = file_get_contents('http://snoobix.com/webservice2.php?keystr='.$pkeystr);
	
	return($keystr);

}

function parentmenu($childtitle){
	global $dbcon;
	$sqlprntmnu = "select pgmenu
		from pages
		where id = (select pgparent from pages where pgtitle = '".$_GET['pgtitle']."' and pgparent != '0')
		UNION
		select pgmenu
		from pages
		where pgtitle = '".$_GET['pgtitle']."' and pgparent = '0'
		";
	$resprntmnu = mysqli_query($dbcon, $sqlprntmnu);
	$rowprntmnu = mysqli_fetch_assoc($resprntmnu);
	//echo $rowprntmnu['pgmenu'];
	return($rowprntmnu['pgmenu']);
}

function buildMenu($pgparent, $menu)
    {
   $siteRoot = '/';
    if (isset($menu['pgparents'][$pgparent])){
		$html .= "\n";
		foreach ($menu['pgparents'][$pgparent] as $itemId)
		{
		if(!isset($menu['pgparents'][$itemId]))
			{
			if($menu['items'][$itemId]['pgmenu']=='Home'){
				$html .= "<li ";
				if($menu['items'][$itemId]['pgmenu'] == parentmenu($menu['items'][$itemId]['pgtitle'])){
				 	$html .= " class='selected' ";
			 	}	
				$html .= ">\n <a href='".SERVER."index.php?pgid=".$menu['items'][$itemId]['id']."&pageMenu=".$menu['items'][$itemId]['pgmenu']."&view=".$menu['items'][$itemId]['pgmenu']."&pgtitle=".$menu['items'][$itemId]['pgtitle']."'>".$menu['items'][$itemId]['pgtitle']."</a>\n</li> \n";
			}else{
				$html .= "<li ";
				if($menu['items'][$itemId]['pgmenu'] == parentmenu($menu['items'][$itemId]['pgtitle'])){
				 	$html .= " class='selected' ";
			 	}	
				$html .= ">\n <a href='".SERVER."index.php?pgid=".$menu['items'][$itemId]['id']."&pageMenu=".$menu['items'][$itemId]['pgmenu']."&view=".$menu['items'][$itemId]['pgmenu']."&pgtitle=".$menu['items'][$itemId]['pgtitle']."'>".$menu['items'][$itemId]['pgmenu']."</a>\n</li> \n";
				
				
			}
			}
		if(isset($menu['pgparents'][$itemId]))
			{
			//$html .= "<li>\n <a href='index.php?pg=".$menu['items'][$itemId]['id']."'>".$menu['items'][$itemId]['pgmenu']."</a><ul> \n";
			$html .= "<li ";
			 if($menu['items'][$itemId]['pgmenu'] == parentmenu($menu['items'][$itemId]['pgtitle'])){
				 $html .= " class='selected' ";
			 }
			 $html .= ">\n <a>".$menu['items'][$itemId]['pgmenu']."</a><ul> \n";
			 
			$html .= buildMenu($itemId, $menu);
			
			$html .= "</li> \n";
			}
			 
		}
		//$html .= "<li><a href='contactus.php'>Contact US</a></li></ul>";
		//$html .= "<li><a href='contactus.php'>Contact US</a></li>";  
			if($_SESSION['usrid'] != ""){
				$html .= '<li><a href="admin/dashboard.php">Dashboard</a></li>';
			}
		
		 	if($_SESSION['usrid'] != ""){
				$html .= '<li><a href="logout.php">Logout</a></li>';
			}else{
				$html .= '<li><a href="login.php">Login</a></li>';
			}
			
			
			
			
		$html .= "</ul>  \n";
		
       }
	   
  return $html;
    }

	
function isapplic($aplicname){
	global $dbcon;
	$sqlaplic = "select * from applications where applicname = '".$aplicname."'";
	$resaplic = mysqli_query($dbcon, $sqlaplic);
	if(mysqli_num_rows($resaplic) > 0){
		return(true);
	}else{
		return(false);
	}
}


	
function sendemail($emailfrom, $emailto, $mailsubj, $emailbody){
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= " Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= "From: ".$emailfrom . "\r\n";
	
	$mailsent = mail($emailto,$mailsubj, $emailbody, $headers);

	if($mailsent){
		return(true);
	}else{
		writemail($emailto, $emailfrom, $mailsubj, $emailbody,'email_header');
		return($mailsent);
	}
	
}
	
function sendgmail($to, $from, $from_name, $subject, $body) { 
	date_default_timezone_set('America/Toronto');
	
	require_once('PHPMailer/class.phpmailer.php');
	//include_once("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	
	$mail             = new PHPMailer();
	$body             = $body;
	//$body             = eregi_replace("[\]",'',$body);
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "gmail.com"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "meetingleadermail@gmail.com";  // GMAIL username
	$mail->Password   = "amedia97";            // GMAIL password
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SetFrom($from, $from_name);
	$mail->AddReplyTo($from, $from_name);
	
	$mail->Subject    = $subject;
	
	//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$mail->MsgHTML($body);
	
	//$address = $to;
	$mail->AddAddress($to, "");
	
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	$mail->IsHTML(true); // send as HTML
	
	if($mail->Send()) {
	  return(true); //$mail->ErrorInfo);
	} else {
	  return(false);
	}
}


function isclient($uid){
	global $dbcon;
	$sqlclient = "select clients.id as id from clients, users 
					where client_email = users.email
					and users.id = '".$uid."'";
					
	$resclient = mysqli_query($dbcon, $sqlclient);
	$rowclient = mysqli_fetch_assoc($resclient);
	
	if($rowclient['id']!= ""){
		return(true);
	}else{
		return(false);
	}
	
}


function fnsendemail4event($arrvals){
	global $dbcon;
	$emailtemplate = $arrvals['emailtemplate'];
	$usrid = $arrvals['usrid'];
	$eventid = $arrvals['eventid'];
	
	
	$sqlemailtemplate = "select * from emailtemplates where send_event = '".$emailtemplate."'";
	//echo "<br>"."sqlemailtemplate: ".$sqlemailtemplate;
	$resemailtemplate = mysqli_query($dbcon, $sqlemailtemplate);
	$rowemailtemplate = mysqli_fetch_assoc($resemailtemplate);
	
	
	$sqlevent = "select * from events where id = '".$eventid."'";
	$resevent = mysqli_query($dbcon, $sqlevent);
	$rowevent = mysqli_fetch_assoc($resevent);
	
	$sqleventadmin = "select * from clients where id = '".$rowevent['client_id']."'";
	$reseventadmin = mysqli_query($dbcon, $sqleventadmin);
	$roweventadmin = mysqli_fetch_assoc($reseventadmin);
	$emailto = $roweventadmin['client_email'];
	
	$sqlsuperadmins = "select * from users where user_type = '1' and email != 'defaultsuperuser@abc.com' ";
	$ressuperadmins = mysqli_query($dbcon, $sqlsuperadmins);
	
	while ($rowsuperadmins = mysqli_fetch_assoc($ressuperadmins)){
		$superadminemails .= ','.$rowsuperadmins['email'];
	}
	if(substr($superadminemails,0,1)==','){
		$superadminemails = substr($superadminemails,1);
	}
	$bcc = $superadminemails;


	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: MeetingLeader Support <support@meetingleader.com>' . "\r\n";
	if($bcc != ""){
		$headers .= 'BCC: '.$bcc. "\r\n";	
	}
	
	
	$mailsubj = $rowemailtemplate['title'];
	$mailsubj  = str_replace("#EventTitle#", $rowevent['title'], $mailsubj); 
	
	$mailbody  = str_replace("#UserFirstName#", $roweventadmin['client_fname'], $mailsubj); 
	$mailbody  = str_replace("#UserLastName#", $roweventadmin['client_lname'], $mailsubj); 
	
	$mailbody =	$rowemailtemplate['design'];
	
	$mailbody  = str_replace("#UserFirstName#", $roweventadmin['client_fname'], $mailbody); 
	$mailbody  = str_replace("#UserLastName#", $roweventadmin['client_lname'], $mailbody); 
	$mailbody  = str_replace("#UserEmail#", $roweventadmin['cluebt_email'], $mailbody); 
	$mailbody  = str_replace("#EventTitle#", $rowevent['title'], $mailbody); 
	$mailbody  = str_replace("#EventDescription#", $rowevent['description'], $mailbody); 
	$mailbody  = str_replace("#EventVenu#", $rowevent['event_venu'], $mailbody); 
	$mailbody  = str_replace("#EventVenuCity#", $rowevent['event_city'], $mailbody); 
	$mailbody  = str_replace("#EventVenuState#", $rowevent['event_state'], $mailbody); 

	$mailbody = str_replace("page_images/",SERVER."admin/page_images/",$mailbody);

	$mailbody  = str_replace("%C2%A0","",$mailbody); 
	
 
	$mailsent = mail($emailto,$mailsubj, $mailbody,$headers);
	//$mailsent = sendgmail($emailto, 'support@meetingleader.com', 'MeetingLeader Support', $mailsubj, $mailbody);
	
//die('within function: fnsendemail');

//die();

	if($mailsent){
		return(true);
	}else{
		return($mailsent);
	}


}




function fnsendemail4profile($arrvals){
	global $dbcon;
	$emailtemplate = $arrvals['emailtemplate'];
	$usrid = $arrvals['usrid'];
	$profilechanged = $arrvals['profilechanged'];
	$uploadbiography = $arrvals['uploadbiography'];
	$uploadphoto = $arrvals['uploadphoto'];
	
	$profileudpate = "";
	if(isset($uploadphoto) && $uploadphoto == 'Y'){
		$profileudpate .= "A photograph has been uploaded."."<br>";
	}
	if(isset($uploadbiography) && $uploadbiography == 'Y'){
		$profileudpate .= "A biography has been uploaded."."<br>";
	}
	

	$sqlemailtemplate = "select * from emailtemplates where send_event = '".$emailtemplate."'";
	//echo "<br>"."sqlemailtemplate: ".$sqlemailtemplate;
	$resemailtemplate = mysqli_query($dbcon, $sqlemailtemplate);
	$rowemailtemplate = mysqli_fetch_assoc($resemailtemplate);
	
	$sqluser = "select * from users where id = '".$usrid."'";
	//echo "<br>"."sqluser: ".$sqluser;
	$resuser = mysqli_query($dbcon, $sqluser);
	$rowuser = mysqli_fetch_assoc($resuser);
	//$emailto = $rowuser['email'];


	$sqluserevents = "select * from events where find_in_set(".$usrid.", user_ids)>0";
	$resuserevents = mysqli_query($dbcon, $sqluserevents);
	$eventids = "";
	while ($rowuserevents = mysqli_fetch_assoc($resuserevents) ){
		$eventids .= ','.$rowuserevents['id'];
	}
	if(substr($eventids,0,1)==','){
		$eventids = substr($eventids,1);
	}

	
	if($eventids != ""){
		$sqlevent = "select * from events where id in ('".$eventids."')";
		//echo "<br>"."sqlevent: ".$sqlevent;
		$resevent = mysqli_query($dbcon, $sqlevent);
		$rowevent = mysqli_fetch_assoc($resevent);
		
		
	
	
		$sqlonlycontmgr = "select contmgr from events where id in (".$eventids.") and contmgr != '' ";
		$resonlycontmgr = mysqli_query($dbcon, $sqlonlycontmgr);
		$listcontmgr = "";
		while($rowonlycontmgr = mysqli_fetch_assoc($resonlycontmgr)){
			$listcontmgr .= $rowonlycontmgr['contmgr'];
		}
		
		if(substr($listcontmgr,0,1)==','){
			$listcontmgr = substr($listcontmgr,1);
		}
	
		$sqlcontmgr = "select * from users 
						where  find_in_set(users.id, '".$listcontmgr."' )>0 ";
			//echo "<br>"."sqlcontmgr: ".$sqlcontmgr.'<br>';
			$rescntmgr = mysqli_query($dbcon, $sqlcontmgr);
			$emailto = "";
			
			while ($rowcontmgr = mysqli_fetch_assoc($rescntmgr)) { 
					$emailto .=  ','.$rowcontmgr['email'];
			}	
			if(substr($emailto,0,1)==','){
				$emailto = substr($emailto,1);
			}
			
			//echo 'to: '.$emailto.'<br>';
			
	//}
	}


	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: MeetingLeader Support <support@meetingleader.com>' . "\r\n";
	
	/*if($tocc != ""){
		$headers .= 'BCC: '.$tocc. "\r\n";	
	}*/
	
	
	$mailsubj = $rowemailtemplate['title'];
	$mailsubj  = str_replace("#EventTitle#", $rowevent['title'], $mailsubj); 
	
	$mailbody  = str_replace("#UserFirstName#", $rowuser['fname'], $mailsubj); 
	$mailbody  = str_replace("#UserLastName#", $rowuser['lname'], $mailsubj); 
	
	$mailbody =	$rowemailtemplate['design'];
	
//	  #UserFirstName#     #UserLastName#      #UserEmail#          #NewUserValidationLink#        
//		#EventTitle#      #EventDescription#            #EventVenu#         #EventVenuCity#     #EventVenuState#		
//		#SessionInfo#

	
	
	$mailbody  = str_replace("#UserFirstName#", $rowuser['fname'], $mailbody); 
	$mailbody  = str_replace("#UserLastName#", $rowuser['lname'], $mailbody); 
	$mailbody  = str_replace("#UserEmail#", $rowuser['email'], $mailbody); 
	$mailbody  = str_replace("#NewUserValidationLink#", SERVER."admin/firstlogin.php?vc=".$rowuser['verifycode'], $mailbody); 
	$mailbody  = str_replace("#EventTitle#", $rowevent['title'], $mailbody); 
	$mailbody  = str_replace("#EventDescription#", $rowevent['description'], $mailbody); 
	$mailbody  = str_replace("#EventVenu#", $rowevent['event_venu'], $mailbody); 
	$mailbody  = str_replace("#EventVenuCity#", $rowevent['event_city'], $mailbody); 
	$mailbody  = str_replace("#EventVenuState#", $rowevent['event_state'], $mailbody); 
	$mailbody  = str_replace("#ProfileUpdate#", $profileudpate, $mailbody); 

	$mailbody = str_replace("page_images/",SERVER."admin/page_images/",$mailbody);

	$mailbody  = str_replace("#SessionInfo#", $session_body, $mailbody); 

	$mailbody  = str_replace("%C2%A0","",$mailbody); 
	
	/*echo "<br><br>";
	echo 'emailto: '.$emailto.'<br>';	
	echo 'mailsubj: '.$mailsubj.'<br>';	
	echo 'mailbody: '.$mailbody.'<br>';	
	echo 'headers: '.$headers.'<br>';	

	
*/	

 
	$mailsent = mail($emailto,$mailsubj, $mailbody,$headers);
	//$mailsent = sendgmail($emailto, 'support@meetingleader.com', 'MeetingLeader Support', $mailsubj, $mailbody);
	
//die('within function: fnsendemail');

//die();

	if($mailsent){
		return(true);
	}else{
		return($mailsent);
	}


}





//function fnsendemail($emailtemplate, $usrid, $eventid){
function fnsendemail($arrvals){
	global $dbcon;
	$emailtemplate = $arrvals['emailtemplate'];
	$usrid = $arrvals['usrid'];
	$eventid = $arrvals['eventid'];
	$agendaid = $arrvals['agendaid'];
	
	/*echo 'emailtemplate = '.$arrvals['emailtemplate'];
	echo 'usrid = '.$arrvals['usrid'];
	echo 'eventid = '.$arrvals['eventid'];
	echo 'agendaid = '.$arrvals['agendaid'];
	die();*/

	$sqlemailtemplate = "select * from emailtemplates where status = '1' and send_event = '".$emailtemplate."'";

	//echo "<br>"."sqlemailtemplate: ".$sqlemailtemplate;
	$resemailtemplate = mysqli_query($dbcon, $sqlemailtemplate);
	$rowemailtemplate = mysqli_fetch_assoc($resemailtemplate);
	
	$sqluser = "select * from users where id = '".$usrid."'";
	//echo "<br>"."sqluser: ".$sqluser;
	$resuser = mysqli_query($dbcon, $sqluser);
	$rowuser = mysqli_fetch_assoc($resuser);
	$emailto = $rowuser['email'];
	
	if($eventid != ""){
		$sqlevent = "select * from events where id = '".$eventid."'";
		//echo "<br>"."sqlevent: ".$sqlevent;
		$resevent = mysqli_query($dbcon, $sqlevent);
		$rowevent = mysqli_fetch_assoc($resevent);

		
	//if($agendaid != ""){	
		$sqlagenda = "select * from agenda where id = '".$agendaid."'";
		//echo "<br>"."sqlagenda: ".$sqlagenda;
		$resagenda = mysqli_query($dbcon, $sqlagenda);
		$rowagenda = mysqli_fetch_assoc($resagenda);
		
		//echo 'sqlevent='.$sqlevent.'<br>';
		//echo 'sqlagenda='.$sqlagenda.'<br>';
		//die();
		//////////////////// end:  session info  preparation //////////////////////////
		
		$session_body = "";
	
			$session_body .= "Event Name: ".$rowevent['title']."<br />"; 
			$speaker_fname=$rowagenda['speaker_fname']; $session_body .= "Speaker's first name: ".$speaker_fname."<br />";
			$speaker_lname=$rowagenda['speaker_lname']; $session_body .= "Speaker's last name: ".$speaker_lname."<br />";
			$speaker_email=$rowagenda['speaker_email']; $session_body .= "Speaker's email: ".$speaker_email."<br />";
			
			$session_name=$rowagenda['session_name']; $session_body .= "Session Name: ".$session_name."<br />";
			$description=$rowagenda['description']; $session_body .= "Description: ".$description."<br />";
			
			$session_date=$rowagenda['session_date']; $session_body .= "Session Date: ".$session_date."<br />";
			$room_name=$rowagenda['room_name']; $session_body .= "Room name: ".$room_name."<br />";
			$ownpc=$rowagenda['ownpc']; $session_body .= "Presenter Wishes to use own Laptop: ".$ownpc."<br />";
			$takequest=$rowagenda['takequest']; $session_body .= "Presenter Wishes to take questions from audience: ".$takequest."<br />";
			
			
			$sqlsessionfiles = "select * from agendafiles where session_id = '".$rowagenda['id']."'";
			//echo "<br>".'sqlsessionfiles='.$sqlsessionfiles.'<br>';
			$ressessionfiles = mysqli_query($dbcon, $sqlsessionfiles);
			while ($rowsessionfiles = mysqli_fetch_assoc($ressessionfiles)){
				
				$session_body .=  "Name of Presentation Uploaded ".$rowsessionfiles['filename']."<br />";
				$session_body .= "Does Presentation have video? "; 
							if($rowsessionfiles['isvideo']=='Yes') { $session_body .= "Yes"."<br />"; } else { $session_body .= "No"."<br />"; }
				$rowsessionfiles['isaudio']; $session_body .= "Does Presentation have audio? ";
							if($rowsessionfiles['isaudio']=='Yes') { $session_body .= "Yes"."<br />"; } else { $session_body .= "No"."<br />"; }
				$rowsessionfiles['isembededlind']; $session_body .= "Does Presentation contain any internet links? ";
							if($rowsessionfiles['isembededlind']=='Yes') { $session_body .= "Yes"."<br />"; } else { $session_body .= "No"."<br />"; }
				$session_body .= "Format of presentation? ".$rowsessionfiles['fileratio']."<br />";
				
			}
			
			
			$sqlcontmgr = "select * from users 
							where  exists (select * from events 
											where id = '".$eventid."' 
												and find_in_set(users.id, user_ids)>0 
												and find_in_set(users.id, contmgr)>0 
											) ";
			//echo "<br>"."sqlcontmgr: ".$sqlcontmgr.'<br>';
			
			$rescntmgr = mysqli_query($dbcon, $sqlcontmgr);
			
			$tocc = "";
			
			while ($rowcontmgr = mysqli_fetch_assoc($rescntmgr)) { 
					$tocc .=  ','.$rowcontmgr['email'];
			}	
			if(substr($tocc,0,1)==','){
				$tocc = substr($tocc,1);
			}
			
			//echo 'cc: '.$tocc.'<br>';
			
	
			$sqlweblinks = "select * from agendawebvideo where session_id = '".$rowagenda['id']."'";
			//echo "<br>"."sqlweblinks: ".$sqlweblinks;
			$resweblinks = mysqli_query($dbcon, $sqlweblinks);
			while ($rowsweblinks = mysqli_fetch_assoc($resweblinks)) {
					$session_body .=  $rowsweblinks['agendawebvideo']."<br />";
			}
	
	
			$session_body .=  "Total Number of presenters: ".$rowagenda['presenters']."<br />";;
			$session_body .=  "Podium Mics: ".$rowagenda['micpodium']."<br />";
			$session_body .=  "Wireless Lavaliere Mics: ".$rowagenda['miclavaliere']."<br />";
			$session_body .=  "Wireless Handheld Mics: ".$rowagenda['michandheld']."<br />";
			$session_body .=  "Session Introducer : ".$rowagenda['introducer']."<br />";
	
			
			//$aspratiov = $rowagenda['aspect_ratio'];
			$sqlnotes = "select * from agendanotes where session_id = '".$rowagenda['id']."'";
			//echo "<br>"."sqlnotes: ".$sqlnotes;
			$resnotes = mysqli_query($dbcon, $sqlnotes);
			while ($rownotes = mysqli_fetch_assoc($resnotes)) {
					$session_body .=  $rownotes['notes']."<br />";
			}
		
//////////////////// end: ession info  preparation //////////////////////////
	//}
	}
//die('Session Body = '.$session_body);

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: MeetingLeader Support <support@meetingleader.com>' . "\r\n";
	
	
	if($emailtemplate=='prsntsuces4contmgr'){
		if($tocc != ""){
			//$headers .= 'BCC: '.$tocc. "\r\n";	
			$emailto = $tocc;
		}
	}
	
	
	$mailsubj = $rowemailtemplate['title'];
	$mailsubj  = str_replace("#EventTitle#", $rowevent['title'], $mailsubj); 
	
	
	$mailbody =	$rowemailtemplate['design'];
	
//	  #UserFirstName#     #UserLastName#      #UserEmail#          #NewUserValidationLink#        
//		#EventTitle#      #EventDescription#            #EventVenu#         #EventVenuCity#     #EventVenuState#		
//		#SessionInfo#

	
	
	$mailbody  = str_replace("#UserFirstName#", $rowuser['fname'], $mailbody); 
	$mailbody  = str_replace("#UserLastName#", $rowuser['lname'], $mailbody); 
	$mailbody  = str_replace("#UserEmail#", $rowuser['email'], $mailbody); 
	$mailbody  = str_replace("#NewUserValidationLink#", SERVER."admin/firstlogin.php?vc=".$rowuser['verifycode'], $mailbody); 
	$mailbody  = str_replace("#EventTitle#", $rowevent['title'], $mailbody); 
	$mailbody  = str_replace("#EventDescription#", $rowevent['description'], $mailbody); 
	$mailbody  = str_replace("#EventVenu#", $rowevent['event_venu'], $mailbody); 
	$mailbody  = str_replace("#EventVenuCity#", $rowevent['event_city'], $mailbody); 
	$mailbody  = str_replace("#EventVenuState#", $rowevent['event_state'], $mailbody); 
	
	$mailbody = str_replace("page_images/",SERVER."admin/page_images/",$mailbody);

	$mailbody  = str_replace("#SessionInfo#", $session_body, $mailbody); 

	$mailbody  = str_replace("%C2%A0","",$mailbody); 
	
	/*echo "<br><br>";
	echo 'emailto: '.$emailto.'<br>';	
	echo 'mailsubj: '.$mailsubj.'<br>';	
	echo 'mailbody: '.$mailbody.'<br>';	
	echo 'headers: '.$headers.'<br>';	

	die();*/
	 
	$mailsent = mail($emailto,$mailsubj, $mailbody,$headers);
	//$mailsent = sendgmail($emailto, 'support@meetingleader.com', 'MeetingLeader Support', $mailsubj, $mailbody);
	
//die('within function: fnsendemail');

	if($mailsent){
		return(true);
	}else{
		return($mailsent);
	}


}


function writemail($mailto, $emailfrom, $mailsubj, $mailbody, $mailheader=''){

	$fh = fopen('write_mail.txt','a');
	$str2write = "From: ".$emailfrom."\r\n";
	$str2write .= "To: ".$mailto."\r\n";
	$str2write .= "Subject: ".$mailsubj."\r\n";
	$str2write .= "Body: ".$mailbody."\r\n"."\r\n"."\r\n"."\r\n"."\r\n";
	fwrite($fh,$str2write);
	fclose($fh);
	return true;
}

function generateRandomString($length = 10) {
    $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return trim($randomString);
}

function getipaddr()
{
    /*$js = file_get_contents( 'http://www.whatsmyip.us/showipsimple.php');
	$nonreq=array('document.write("', '");');
	$ipval=str_replace($nonreq,"",$js);
	return $ipval;*/
	
	return (empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])?
$_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP']);
 
	
}

function accessrights($sid,$stype,$module_id,$right) {
global $dbcon;
$rights_sql = "Select * from access_rights WHERE user_type = '".$stype."' and user_id = '".$sid."' and module_id = '".$module_id."' and module_id in (Select module_id from modules where module_status = 1 )";
//echo $rights_sql;
//$sql_rights = "Select count(*) from access_rights WHERE user_type = '".$stype."' and user_id = '".$sid."' and module_id = '".$module_id."' and module_id in (Select module_id from modules where module_status = 1 )";
$rs_rights=mysqli_query($dbcon, $rights_sql) ;
$rights_rec=mysqli_num_rows($rs_rights);
if($rights_rec == 0 ){	
	$rights_sql = "Select * from access_rights 
						WHERE user_type = '".$stype."' 
							and user_id = (select id from users where user_type = '".$stype."' and fname = 'Default' and lname = 'User')
							and module_id = '".$module_id."' 
							and module_id in (Select module_id from modules 
												where module_status = 1 )";
//		echo $rights_sql;
	$rs_rights=mysqli_query($dbcon, $rights_sql) ;
	$rights_rec=mysqli_num_rows($rs_rights);
	
	
}
	$row_right = mysqli_fetch_assoc($rs_rights);
	if($right == 'add'){
			return $row_right['add_module'];
	}
	if($right == 'edit'){
			return $row_right['edit_module'];
	}
	if($right == 'delete'){
			return $row_right['delete_module'];
	}
	if($right == 'view'){
			return $row_right['view_module'];
	}
	
	
}

function grouprights($clientid, $uid,$stype,$applic, $module,$right) {
global $dbcon;
$sqloginuser = "select * from users where id = '".$uid."'";

$resloginuser = mysqli_query($dbcon, $sqloginuser);
$rowloginuser = mysqli_fetch_assoc($resloginuser);
$loginuser = $rowloginuser['username'];

$rights_sql = "Select gr.groupname, gr.applicid, gr.modulenames, gr.usernames, gr.add_right, gr.edit_right, gr.delete_right, gr.view_right,
						ap.id, ap.applicname, ap.appdescr, ap.table_prefix, ap.config_file
				from group_rights gr , applications ap
				WHERE gr.applicid = ap.id 
				  and ap.applicname = '".$applic."'
				  and find_in_set('".$loginuser."',gr.usernames) > 0
				  and find_in_set('".$module."',gr.modulenames) > 0
				  and gr.active = 'Y' and ap.active='Y'";
//echo $rights_sql; 
$rs_rights=mysqli_query($dbcon, $rights_sql) ;
$rights_rec=mysqli_num_rows($rs_rights);
/*
if($rights_rec == 0 ){	
	$rights_sql = "Select * from access_rights 
						WHERE user_type = '".$stype."' 
							and user_id = (select id from users where user_type = '".$stype."' and fname = 'Default' and lname = 'User')
							and module_id = '".$module_id."' 
							and module_id in (Select module_id from modules 
												where module_status = 1 )";
//		echo $rights_sql;
	$rs_rights=mysqli_query($dbcon, $rights_sql) ;
	$rights_rec=mysqli_num_rows($rs_rights);
}
*/
	$row_right = mysqli_fetch_assoc($rs_rights);
	if($right == 'add'){
			return $row_right['add_right'];
	}else if($right == 'edit'){
			return $row_right['edit_right'];
	}else if($right == 'delete'){
			return $row_right['delete_right'];
	}else if($right == 'view'){
			return $row_right['view_right'];
	}else {
			return 0;
	}
	
	
}



function group_access_rights($clientid , $uid, $stype, $applic, $module, $right) {
global $dbcon;
	$sqloginuser = "select * from users where id = '".$uid."' and clientid = '".$clientid."' ";
	//echo $sqloginuser; //die();
	$resloginuser = mysqli_query($dbcon, $sqloginuser);
	$rowloginuser = mysqli_fetch_assoc($resloginuser);
	$loginuser = $rowloginuser['username'];
	
	 if($rowloginuser['user_type']=='1'){
	 //echo "user type:".$rowloginuser['user_type']; die();
		return(1); exit;
	 }else{

	 
	 //echo ".$usrid.",".$usrtype.",".$applicname; die();
	 
	 
	 
		$rights_sql = "Select gr.groupname, gr.applicid, gr.modulenames, gr.usernames, gr.add_right, gr.edit_right, gr.delete_right, gr.view_right,
							ap.id, ap.applicname, ap.appdescr, ap.table_prefix
					from group_rights gr , applications ap
					WHERE gr.applicid = ap.id 
					  and ap.applicname = '".$applic."'
					  and find_in_set('".$loginuser."',gr.usernames) > 0
					  and find_in_set('".$module."',gr.modulenames) > 0
					  and gr.active = 'Y' and ap.active='Y'";
		//echo $rights_sql; 
		$rs_rights=mysqli_query($dbcon, $rights_sql) ;
		$rights_nrec=mysqli_num_rows($rs_rights);
		/*
		if($rights_nrec == 0 ){	
			$rights_sql = "Select * from access_rights 
								WHERE user_type = '".$stype."' 
									and user_id = (select id from users where user_type = '".$stype."' and fname = 'Default' and lname = 'User')
									and module_id = '".$module_id."' 
									and module_id in (Select module_id from modules 
														where module_status = 1 )";
		//		echo $rights_sql;
			$rs_rights=mysqli_query($dbcon, $rights_sql) ;
			$rights_rec=mysqli_num_rows($rs_rights);
		}
		*/
		
		//echo "rights_nrec: ".$rights_nrec;
		if($rights_nrec == 0 ){	
			return 0;
		}else{
			$row_right = mysqli_fetch_assoc($rs_rights);
			if($right == 'add'){
					return $row_right['add_right'];
			}else if($right == 'edit'){
					return $row_right['edit_right'];
			}else if($right == 'delete'){
					return $row_right['delete_right'];
			}else if($right == 'view'){
					return $row_right['view_right'];
			}else {
					return 0;
			}
		}
		
	}
}


function getBracedText($str) {
	preg_match_all('/\{(.*?)\}/',$str,$match); 
	$allmatches = implode(',',$match[1]);	
    return($allmatches);
}


function cleanstring($str) {
		$str = trim($str);
		global $dbcon;
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
			$str=strip_tags($str);
		}
		return mysqli_real_escape_string($dbcon, $str);
	}

function Get_filedName($table,$name,$where){
	global $dbcon;
$sql=mysqli_query($dbcon, "Select $name from $table where $where");
if(mysqli_num_rows($sql)>0){
$row=mysqli_fetch_assoc($sql);
return $row['name'];
}else{
return "N/A";
}
}
function Get_filedValue($table,$name,$where){
global $dbcon;
$sql=mysqli_query($dbcon, "Select $name from $table where $where");
if(mysqli_num_rows($sql)>0){
$row=mysqli_fetch_assoc($sql);
return $row['kpi_type'];
}else{
return "N/A";
}
}	


function datetime_format($datestr, $reqform){
	$converted_date = $datestr;
	if(!empty($datestr) & $datestr != '00/00/0000 00:00:00'){
		if($reqform == 'DB'){  //database format
			$converted_date = date('Y-m-d H:i:s',strtotime($datestr));
		}elseif($reqform == 'NA'){  //north american format
			$converted_date = date('m/d/Y H:i:s',strtotime($datestr));
		}
	}
	return $converted_date;
}

function setdate_format($datestr, $reqform){
	$converted_date = $datestr;
	if(!empty($datestr) && ($datestr != '00/00/0000' || $datestr != '0000/00/00')){
		if($reqform == 'DB'){  //database format
			$converted_date = date('Y-m-d',strtotime(str_replace('/','-',$datestr)));
		}elseif($reqform == 'NA'){  //north american format
			$converted_date = date('m/d/Y',strtotime($datestr));
		}elseif($reqform != ''){  //north american format
			$converted_date = date($reqform,strtotime($datestr));
		}
	}
	return $converted_date;
}


//sql form date converter
function date_format_sql($date){
	if(!empty($date) & $date != '00/00/0000'){
		$tarikh = split('/',$date);
		return $tarikh[2].'-'.$tarikh[1].'-'.$tarikh[0];
		}else{return '';}
}
//calender field form date converter
function date_format_calender($date){
	if(!empty($date) & $date != '0000-00-00'){	
		$tarikh = split('-',$date);
		return $tarikh[2].'/'.$tarikh[1].'/'.$tarikh[0];
		}else{	return '';}
}
//web form date converter
function date_converter($date){
	if(!empty($date) && $date != '0000-00-00'){ 
		$tarikh = split('-',$date);	
		$year = (strlen($tarikh[0])==2)?'20'.$tarikh[0]:$tarikh[0];
		$month = month_name($tarikh[1]);
			if(strlen($tarikh[2]) > 2){
				$day = split(' ',$tarikh[2]);
				$day = $day[0];
			}else{
				$day = $tarikh[2];
			}
			return $day.'-'.$month.'-'.$year;
		}else{
			return "Null";
		}
}	
//month name
function month_name($i){
	switch($i){
			case 1:
				return 'Jan';
				break;
			case 2:
				return 'Feb';
				break;
			case 3:
				return 'Mar';
				break;
			case 4:
				return 'Apr';
				break;
			case 5:
				return 'May';
				break;
			case 6:
				return 'Jun';
				break;
			case 7:
				return 'Jul';
				break;
			case 8:
				return 'Aug';
				break;
			case 9:
				return 'Sep';
				break;
			case 10:
				return 'Oct';
				break;
			case 11:
				return 'Nov';
				break;
			case 12:
				return 'Dec';
				break;
		}
}
//truncate string
function truncate_string($i,$l){
	if(strlen($i) >= $l){
		$trim_i = trim($i);	
		$o = "";
		for($a=0;$a<=$l;$a++){
			$o = $o.$trim_i[$a];
		}
	return $o.'...';
	}else{ return $i; }
}
//get record on id
function get_record_on_id($tablename, $id, $fields = ''){
	global $dbcon;
	if(empty($fields)){
		$fields = '*';
	}
	$query = 'select '.$fields.' from '.$tablename.' where id = '.$id;
	$rs = mysqli_query($dbcon, $query);
	$row = mysqli_fetch_assoc($rs);
	return $row;
}
//get combo box
function get_combo($table, $field, $selected='',$show=''){
	global $dbcon;
	$output = "";
	if($selected){
	$query = "select id,".$field." from ".$table;
	}else{
	$query = "select id,".$field." from ".$table.' where status=1';
	}
	$rs_combo = mysqli_query($dbcon, $query);
		if(!empty($selected)){
				while($row_combo = mysqli_fetch_assoc($rs_combo)){
					if($selected == $row_combo['id']){
						echo '<option selected value="'.$row_combo['id'].'">'.$row_combo[$field].'</option>';
					}else{
						echo '<option value="'.$row_combo['id'].'">'.$row_combo[$field].'</option>';
					}
				}
			}else{
				if(!empty($show)){
					$front = $show;
				}else{
					$front = "Select One";
				}
				echo '<option selected>'.$front.'</option>';
				while($row_combo = mysqli_fetch_assoc($rs_combo)){
				  echo '<option value="'.$row_combo['id'].'">'.$row_combo[$field].'</option>';
				}
			}
			echo '</select>';
			if($selected){
				$q = "select id,".$field." from ".$table." where id='".$selected."'";
				$rs_combo = mysqli_query($dbcon, "select id,".$field." from ".$table." where id='".$selected."'");
				$row_combo = mysqli_fetch_assoc($rs_combo);
				echo  $row_combo[$field];
				//return $row_combo[$field];
			}
		}
//getting full day characters
function full_day_name($day){

		switch($day){

			case 'Mon':

				return 'Monday';

				break;

			case 'Tue':

				return 'Tuesday';

				break;

			case 'Wed':

				return 'Wednesday';

				break;

			case 'Thu':

				return 'Thrusday';

				break;

			case 'Fri':

				return 'Friday';

				break;

			case 'Sat':

				return 'Saturday';

				break;

			case 'Sun':

				return 'Sunday';

				break;

		}

	}
//convert string to permalink
function friendlyURL($string){

		$output	= strtolower($string);

		$output = str_replace(' ','-',$output);
		$output = str_replace('`','_',$output);
		$output = str_replace('~','_',$output);
		$output = str_replace('@','_',$output);
		$output = str_replace('#','_',$output);
		$output = str_replace('$','_',$output);
		$output = str_replace('%','_',$output);
		$output = str_replace('^','_',$output);
		$output = str_replace('&','_',$output);
		$output = str_replace('*','_',$output);
		$output = str_replace('(','_',$output);
		$output = str_replace(')','_',$output);
		$output = str_replace('+','_',$output);
		$output = str_replace('=','_',$output);
		$output = str_replace(']','_',$output);
		$output = str_replace('}','_',$output);
		$output = str_replace('[','_',$output);
		$output = str_replace('{','_',$output);
		$output = str_replace('\'','_',$output);
		$output = str_replace('"','_',$output);
		$output = str_replace(';','_',$output);
		$output = str_replace(':','_',$output);
		$output = str_replace('?','_',$output);
		$output = str_replace('.','_',$output);
		$output = str_replace('>','_',$output);
		$output = str_replace(',','_',$output);
		$output = str_replace('<','_',$output);

		return $output;

	}
//inverse of friendly URL 
function InversefriendlyURL($string){

		

		$output = str_replace('-',' ',$string);

		

		return $output;

	}

function getrandnum(){
	$curdattime = date('YmdHis');	
	return $curdattime;
}
	
function sliderpagelink($sliderpage){
	global $dbcon;
	$sqlsliderpage = "select * from pages where pgmenu like '%".$sliderpage."%' ";	
	$resliderpage = mysqli_query($dbcon, $sqlsliderpage);
	$rowsliderpage = mysqli_fetch_assoc($resliderpage);
	
	
	
	$sliderpagelink ="index.php?pgid=".$rowsliderpage['id']."&pageMenu=".$rowsliderpage['pgmenu']."&view=".$rowsliderpage['pgmenu']."&pgtitle=".$rowsliderpage['pgtitle'];
	return($sliderpagelink);
}


function getgroupname($groupid){
	global $dbcon;
	$sqlgroupname = "select * from group_rights where recid = '".$groupid."'";	
	$resgroupname = mysqli_query($dbcon, $sqlgroupname);
	$rowgroupname = mysqli_fetch_assoc($resgroupname);
	return($rowgroupname['groupname']);
}

function getcurlang($sid){
	if (file_exists($sid."_curlang.sef")){
		
		$filehdr = fopen($sid."_curlang.sef",'r');
		$curlang = fread($filehdr,50);
		fclose($filehdr);
	}else{
		$filehdr = fopen("defaultlang.sef",'r');
		$curlang = fread($filehdr,50);
		fclose($filehdr);
	}
	return($curlang); 
}

function setcurlang($sid, $lang){

	$filehdr = fopen($sid."_curlang.sef",'w');
	fwrite($filehdr,$lang);
	fclose($filehdr);	
	return(true);
}

function getpgurl($sid,$pgtype){
	global $dbcon;
	$sqlpageurl = "select * from pages where status = '1' and pgtype = '".$pgtype."' and pglang = '".getcurlang($sid)."'";	
	
	$respageurl = mysqli_query($dbcon, $sqlpageurl);
	$rowpageurl = mysqli_fetch_assoc($respageurl);
	
	$pageurl ="index.php?pgid=".$rowpageurl['id']."&pageMenu=".$rowpageurl['pgmenu']."&view=".$rowpageurl['pgmenu']."&pgtitle=".$rowpageurl['pgtitle']."&sid=".$sid;
	return($pageurl);
}

function setcuruser($sid, $useremail){
	$filehdr = fopen($sid."_curuser.sef",'w');
	fwrite($filehdr, $useremail);
	fclose($filehdr);
	return(true);
}

function getcuruser($sid){
	$filehdr = fopen($sid."_curuser.sef",'r');
	$curuser = fread($filehdr,250);
	fclose($filehdr);
	return($curuser);

}

	
function showslider($sliderid){
  global $var1;
  global $dbcon;
  $var1 = $sliderid;

//include_once('connection.php');
//global $var1;
//$sliderid =  $var; //$_REQUEST['slid'];
//echo "slider = ".$sliderid;

$sqlslider = "select * from slider where position= 'Inner Page' and status = '1' ";
//echo $sqlcurslider;
$reslider = mysqli_query($dbcon, $sqlslider);


$sqlcurslider = "select * from slider where slider_id = '".$sliderid."'";
$rescurslider = mysqli_query($dbcon, $sqlcurslider);
$rowcurslider = mysqli_fetch_assoc($rescurslider);



$html_slider = "<p>&nbsp;</p>
<div class='location-tab'>

	<ul>";


		while($rowslider = mysqli_fetch_assoc($reslider)){ 
    		$html_slider .= '<li class="'; 
			
			if ($rowslider['slider_id']==$sliderid) { 
				$html_slider .= ' selected ' ;
			} 
			$sliderlink = sliderpagelink($rowslider['slider_name']);
			$html_slider .= '">
			
			
			<a href="'.$sliderlink.'"> '. $rowslider['slider_name'].' </a>
		</li>'	;

		}

  
	$html_slider .= '</ul>
</div>

<div class="location-details">
	<div class="location-details-top"></div>
	<div class="location-details-middle">
		<div class="location-details-page"> ';

			$html_slider .= '<h4> '.$rowcurslider['slider_name'].'</h4>

<div class="location-banner">
	<div id="slides">
		<div class="slides_container" style="opacity: 1; overflow: hidden;">';


			 if($rowcurslider['image1'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image1'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image2'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image2'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image3'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image3'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image4'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image4'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image5'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image5'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image6'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image6'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image7'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image8'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image9'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image9'].'" border="0" ></a>
			</div>';
             } 

			 if($rowcurslider['image10'] != "") {
			$html_slider .= '<div class="slide" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 5; opacity: 1; width: 320px; height: 175px;">
				<a href="#"><img  src="admin/slider_images/'.$rowcurslider['image10'].'" border="0"> </a>
			</div>';
             } 


		$html_slider .= '</div>

		<div class="slidertext">
			&nbsp;
		</div>
	</div>
</div>
		</div>
	</div>
	<div class="location-details-bottom"></div>
</div>';





 return $html_slider;

	}
?>