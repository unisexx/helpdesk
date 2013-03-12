<?php

function Alert($message)
{
  
   echo "<script>alert('".$message."');</script>";
  
}

function ReDirect($url,$target)
{

  echo "<script>".$target.".location='".$url."';</script>";
}

function GetData($tablename, $id)
{
    if($id!='' && $tablename !='')
    {
      
      $result = mysql_query("SELECT * FROM ".$tablename." WHERE ID=".$id) or die("Error".mysql_error());
      
      $row = mysql_fetch_array($result);
      
    }
    return @$row;
}
function GetOne($field,$f_id,$id,$tb){
	
	 $sql="SELECT $field FROM $tb WHERE $f_id=".$id;
	
	 if($id!=""){
		 $result = mysql_query($sql) or die("Error GetOne".mysql_error());   
		 while($row=mysql_fetch_assoc($result)){
			$item=$row[$field];
		 }	 
	 	return  $item;
	 }else{
	 	return NULL;
	 }

}
function SelectCountData($tablename,$condition)
{
    $result = mysql_query("SELECT * FROM ".$tablename.$condition);
    @$nrow = mysql_num_rows($result);
    return $nrow;
}

function GetPermission($usertype)
{
  $sql = "SELECT * FROM usergroup_permission WHERE UserGroupID=".$usertype;
  $result = mysql_query($sql);
  $permission="";
	  while(@$row = mysql_fetch_array($result))
	  {
		$permission[$row['Code']]['CanView'] = $row['CanView'];
		$permission[$row['Code']]['CanAdd'] = $row['CanAdd'];
		$permission[$row['Code']]['CanEdit'] = $row['CanEdit'];
		$permission[$row['Code']]['CanDelete'] = $row['CanDelete'];
		$permission[$row['Code']]['CanExport'] = $row['CanExport'];
	  }
  return $permission;
  
  
}
function DB2Date($Dt,$timeonly=false)
{ 
		if($Dt!=NULL && $Dt!="0000-00-00 00:00:00"){
			@list($date,$time) = explode(" ",$Dt);
			@list($y,$m,$d)   = explode("-",$date);
	                $showtime = ($time)?$time:'';
			if($timeonly == 'timeonly'){
				return $time;
			}else{
				return $d."/".$m."/".($y+543);
			}
		}else{ 
			return ""; }
}
function DateTH2DB($date){
		list($d,$m,$y) = explode('/', $date);
	    $y-=543;
	    return $y.'-'.$m.'-'.$d;
	
}
function Date2DB($Dt){
	if(($Dt!="")&&($Dt != '0000-00-00')){
		@list($date,$time) = explode(" ",$Dt);
		list($d,$m,$y) = explode("/",$date);
		return ($y-543)."-".$m."-".$d;
	}else{ return $Dt; }
}
function GetProblemType($id){
	
	$result=mysql_query("select problemname FROM problemtype where id=".$id);	
	$item=mysql_fetch_assoc($result);
	return $item['problemname'];
}
function GetSystem($id,$ch){
	
/*	$sql= "SELECT c.id as id,c.systemname as name FROM informent a ";
	$sql= $sql. " LEFT JOIN user_systems b on a.id=b.userid";
	$sql= $sql. " LEFT JOIN system c on b.systemid=c.id";
	$sql= $sql. " WHERE a.id='".$id."'";*/
	
	$sql="select b.systemname as name,b.id as id from request_lists a";
	$sql=$sql." left join system b on a.systemid=b.id";
    $sql=$sql." where a.id='".$id."'";
	
	$result=mysql_query($sql);
	$item=mysql_fetch_assoc($result);
	if($ch){
		return $item['name'];
	}else{
		return $item['id'];
	}
}
function GetProblemStatus($id,$ch=FALSE){
	$result=mysql_query("SELECT img,name FROM problemstatus WHERE id=".$id);
	$item=mysql_fetch_assoc($result);	
	if($ch) {return $item['img'];}else{return $item['name'];}
	
}
function GetUser($id,$ch,$bool=false){

	switch ($ch){
		case "order":
			$sql="select concat(name,' ',lastname) as name,tel from request_lists a ";
			$sql.=" inner join  informent b on a.orderid=b.id  group by b.name,a.orderid HAVING a.orderid=".$id;
			$result=mysql_query($sql);
			$item=mysql_fetch_assoc($result);	
			return $item;
		
		case "response":
			$sql="select concat(name,' ',lastname) as name,tel from request_lists a ";
			$sql .=" inner join  informent b on a.responsibleid=b.id  group by b.name,a.responsibleid HAVING a.responsibleid=".$id;
			$result=mysql_query($sql);
			$item=mysql_fetch_assoc($result);
			if($bool){
				return $item['tel'];				
			}else {return $item['name'];}
		case "coor":
			$sql="select concat(name,' ',lastname) as name from request_lists a ";
			$sql.=" inner join  informent b on a.coordinatorid=b.id  group by b.name,a.coordinatorid having a.coordinatorid=".$id;
			$result=mysql_query($sql);
			$item=mysql_fetch_assoc($result);
			return $item['name'];
		case "user":
			$sql="select concat(name,' ',lastname) as name from informent where id=".$id;
			$result=mysql_query($sql);
			$item=mysql_fetch_assoc($result);
			return $item['name'];
	}
}
function GetTel($userid){
	$sql="select tel from informent where id=".$userid;
	$result=mysql_query($sql);
	$item=mysql_fetch_assoc($result);
	return $item['tel'];
}
function GetUserType($id){
	 
	 $type=array("","ผู้รับผิดชอบ","ผู้ประสานงาน ","เจ้าของระบบ","ผู้ใช้งาน");	 
	 return $type[$id];

}
function GetDiv($id,$type=false){
	$type=($type==false)?"orderid":$type;
	$sql="select c.divisionname as name from request_lists a";
	$sql=$sql." inner join informent  b on a.".$type."=b.id";
	$sql=$sql." inner join division c on b.divisionid=c.id";
	$sql=$sql." group by c.divisionname,a.".$type.",c.id,b.id,b.divisionid having a.".$type."=".$id;
	
	$result=mysql_query($sql);
	$item=mysql_fetch_assoc($result);
	return $item['name'];
}

function Del($tb,$id)
{
	$result=mysql_query("delete FROM ".$tb." WHERE id=".$id);
	
	
	if($result){return "OK";}else{ return "NOT";}
}
function GetDataALL($tb)
{
      
      $result = mysql_query("SELECT * FROM ".$tb." order by id");
	  return $result;
	  
}
function convertDateToDB($date)
  {
    if($date!='')
    {
    $expdate = explode("-",$date);
    $date = ($expdate[0]-543)."-".$expdate[1]."-".$expdate[2];
    }
    return $date;
  }

function convertDateFromDB($date)
  {
    if($date!='')
    {
    $expdate = explode("-",$date);
    if(count($expdate)>1)
      $date = ($expdate[0]+543)."-".$expdate[1]."-".$expdate[2];
    }
    return $date;
  }

  function GetMonthName($type,$no)
{
  if($type=='full')
  {
    $monthName = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	
  }
  else
  {
    $monthName = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');                                 
  }
  return $monthName[$no];
}

function GetThaiDate($pDate,$havetime,$showtime)
	{
		 $date = "";
		 if($pDate>0)
		 {
			 $tmpDate = $pDate;
			if($havetime == 1)
			{
				$pDate = explode(" ",$pDate);
				$tmpDate = $pDate[0];
				$tmpTime = $pDate[1];
			}
			
			if (strpos($tmpDate,"/"))
			{
				 $tmpDate = explode("/", $tmpDate);
			}
			else
			{
				$tmpDate = explode("-",$tmpDate);
			}
			
			$year = (int)$tmpDate[0]+543;
			$date  =  $tmpDate[2]."/".$tmpDate[1]."/".$year;
			if($showtime == 1)$date .= " ".$tmpTime;
		}		
		return $date;
	} 
function  Systemname($id)
{
	 $result=mysql_query("SELECT systemname FROM system WHERE id=".$id);
	 $item=mysql_fetch_assoc($result);
	 return $item['systemname'];
}


if ( ! function_exists('valid_email'))
{
	function valid_email($address)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}
}

// ------------------------------------------------------------------------

/*
 * Send an email
 */	
if ( ! function_exists('send_email'))
{
	
	function send_email($recipient, $subject = 'Test email', $message = 'Hello World',$strHeader='Content-type: text/html; charset=windows-874')
	{
		
		
		return mail($recipient, $subject, $message,$strHeader);
	}
}

function GetEmail($id){
	$result=mysql_query("select email from informent where id='".$id."'");
	$item=mysql_fetch_assoc($result);
	return $item['email'];
}
function GetAgencie($id){

	$sql="select b.divisionname as divisionname ,c.groupname as groupname  from informent a";
	$sql .=" left join division b on a.divisionid=b.id";
	$sql .=" left join hd_section c on  b.id=c.divisionid";
	$sql .=" where a.id='".$id."'";
	$result=mysql_query($sql);
	$item=mysql_fetch_assoc($result);
	return $item['divisionname']." ".$item['groupname'];
}
function notify(){
	
echo"<script>	$(function () {";
echo" $.notifyBar({";
echo"html: 'บันทึกเรียบร้อยแล้ว!',";
echo"delay: 2000,";
echo"	animationSpeed: 'normal'";
echo" });  ";
 echo"});</script>";
}

function generate_password($length=5) {
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $password = '';
      for ( $i = 0; $i < $length; $i++ )
         $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		 
      return $password;
 } 
function difftime($dd2,$dd1){
	
	list($date1,$time1) = explode(" ",$dd1);
	list($date2,$time2) = explode(" ",$dd2);
	list($year1,$month1,$day1)=explode("-",$date1);
	list($hour1,$minute1,$second1)=explode(":",$time1);
	list($year2,$month2,$day2)=explode("-",$date2);
	list($hour2,$minute2,$second2)=explode(":",$time2);
	
	//mktime ( ชั่วโมง, นาที, วินาที, เดือน, วัน, ปี); ฟังก์ชั่น time อยู่ในรูป unix timestamp
	$t1 = mktime($hour1, $minute1, $second1, $month1, $day1, $year1);
	$t2 = mktime($hour2, $minute2, $second2, $month2, $day2, $year2);
	$diff = $t2 - $t1;
	$day = floor($diff/(24*60*60));
	$diff -= $day * 24 * 60 * 60;
	$hour = floor($diff/(60*60));
	$diff -= $hour * 60 * 60;
	$minute = floor($diff/60);
	$diff -= $minute * 60;
	$second = $diff;

 return $day ." วัน /".$hour.":".$minute." ชั่วโมง";
} 



?>
