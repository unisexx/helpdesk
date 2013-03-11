<?php
//print"dd";
//PHP 4 การกำหนดค่าเริ่มต้นให้กับตัวแปรนั้นจะเป็นค่าคงที่เท่านั้น (constant) ในการที่จะกำหนดค่าเริ่มต้นให้กับตัวแปรที่ไม่ใช่ค่าคงที่เราจะต้องทำการ //สร้างฟังก์ชันที่มันจะทำการเรียกใช้ตัวเองโดยอัตโนมัติเมื่อ object ถูกสร้าง ซึ่งเราเรียกฟังก์ชันนี้ว่า constructor (ซึ่งชื่อฟังก์ชัน constructor จะต้องมีชื่อเหมือนชื่อคลาสด้วย)

class UserLogin{
	
	
	var $action=array(0=>"view  list ประเภทปัญหา"  ,1=>"add ประเภทปัญหา"		,2=>"edit ประเภทปัญหา"	,3=>"delete ประเภทปัญหา",
				  	  4=>"view  list กรม"		  ,5=>"add กรม"			,6=>"edit กรม"		 	,7=>"delete กรม",
				  	  8=>"view  list กอง/สำนัก"     ,9=>"add กอง/สำนัก"		,10=>"edit กอง/สำนัก"		,11=>"delete กอง/สำนัก",	
				  	  12=>"view list กลุ่ม/ฝ่าย"     ,13=>"add กลุ่ม/ฝ่าย"		,14=>"edit กลุ่ม/ฝ่าย"		,15=>"delete กลุ่ม/ฝ่าย",
				  	  16=>"view list ประเภทบุคลากร" ,17=>"add ประเภทบุคลากร"	,18=>"edit ประเภทบุคลากร"	,19=>"delete ประเภทบุคลากร",
					  20=>"view list ประเภทระบบ"   ,21=>"add ประเภทระบบ"		,22=>"edit ประเภทระบบ"	,23=>"delete ประเภทระบบ",
					  24=>"view list เซิร์ฟเวอร์"		,25=>"add เซิร์ฟเวอร์"		,26=>"edit เซิร์ฟเวอร์"		,27=>"delete เซิร์ฟเวอร์",
					  28=>"view list รายงาน"      ,29=>"export รายงาน"	,31=>"edit รายงาน"			,32=>"delete รายงาน",	33=>"add รายงาน",
				  	  30=>"view list log",		 
					  34=>"view list ข้อมูลผู้แจ้ง"	,35=>"add ข้อมูลผู้แจ้ง"		,36=>"edit ข้อมูลผู้แจ้ง"		,37=>"delete ข้อมูลผู้แจ้ง",
					  38=>"view list รายการแจ้ง"	,39=>"add รายการแจ้ง"		,40=>"edit รายการแจ้ง"	,41=>"delete รายการแจ้ง",
					  42=>"view list สิทธิ์การใช้งาน",43=>"add สิทธิ์การใช้งาน"   ,44=>"edit สิทธิ์การใช้งาน" ,45=>"delete สิทธิ์การใช้งาน",
					  46=>"view list ประวัติส่วนตัว" ,47=>"edit ประวัติส่วนตัว"
					);

 function GetPermission($pm_code)
 {
	$sql="select * from usergroup_permission where usergroupid=".$_SESSION["usergroupid"]." and code=".$pm_code; 
     
	$result=mysql_query($sql)or die('Invalid query: ' . mysql_error());
	
	if($result){
		$item=mysql_fetch_assoc($result);
	}else{ $item="";}
	return $item;
	
 }
 function CanAccessAll(){
 	$view="select canaccessall from usergroup where canaccessall='1' and id=".$_SESSION['usergroupid'];
	$result=mysql_query($view) or die ("Error:".mysql_error());
	$item=mysql_fetch_assoc($result);
	return $item['canaccessall'];
 }

 function AddLog($i,$detail=FALSE)
 { 	
	
	$desc=$this->action[$i]." ".$detail;
	
	$field="dates,detail,ipaddress,userid";
	$val ="'".date('Y-m-d H:i:s')."','".$desc."','".$_SESSION["ip"]."','".$_SESSION["id"]."'";
	$sql="INSERT INTO hd_logs(".$field.") VALUES(".$val.")";
	$result=mysql_query($sql) or die("Invalid query: " . mysql_error());  
	return $result;
	
 }

 	
}//close class
?>