<?php
// set notifybar
//include "include/notifybar.php";
 $_SESSION["show"]="show";

function get_detail($field,$arr,$table){
	if($_GET['id']!=""){
		$sql="select $field from $table where id=".$_GET['id'];
	
		$result=mysql_query($sql) or die("error setting:".mysql_error());
		$item=mysql_fetch_assoc($result);
		$arr_key=array_diff($arr,$item);
		return $arr_key;
	}else{	
		return "";
	}
}


 
 switch($_GET['type'])
  {
    case "problemtype":
		$row=GetData("problemtype",$_GET['id']);
		$field="ProblemName,abbr";
		$arr=array("ProblemName"=>$_POST['ProblemTypeName'],"abbr"=>$_POST['abbr']);	
		$arr_key=get_detail($field,$arr,"problemtype");
		
		if($_GET['act']=="delete"){		
			if($_GET['chk_del']=="1"){
				$detail="รหัส : ".$row['Code'];
				$detail.=" ชื่อ :".$row['ProblemName'];			
				$chk_log->AddLog(3,$detail);
				$_SESSION["shw_type"]="delete";
			}
		}
		// detail log
		if(empty($arr_key)){
		  $conj="รหัส : ".$_POST['code'];
		  $detail="ไม่มีการเปลี่ยนแปลงใดๆ";
		  $detail=$conj.$detail;		
		}else{
			$conj="ดังนี้ ";
			$i=0;
			foreach($arr_key as $key=>$value){			
				
				switch($key){
					
					case "ProblemName":
						$i=$i+1;
						$detail[$i]="ชื่อจาก :".$row['ProblemName']." เป็น ".$_POST['ProblemTypeName'];
						break;
					case "abbr":
						$i=$i+1;				
						$detail[$i]="ตัวย่อจาก :".$row['abbr']." เป็น ".$_POST['abbr'];
						break;
				}//close switch
			}//close foreach			
			$detail=implode(", ",$detail);
			$detail=$conj.$detail;
		}//close if
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){	
						
				$chk_log->AddLog(2,$detail);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$detail="ชื่อ: ".$_POST['ProblemTypeName'];
				$chk_log->AddLog(1,$detail);
				$_SESSION["shw_type"]="add";
			}			
		}
	  ProblemType();
      break;
    case "humantype":
		$row=GetData("humantype",$_GET['id']);
		$field="HumanName";
		$arr=array($_POST['HumanTypeName']);
		$arr_key=get_detail($field,$arr,"humantype");
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$detail="รหัส ".$row['Code'];
				$detail.=" ชื่อ: ".$row['HumanName'];	
				$chk_log->AddLog(19,$detail);
				$_SESSION["shw_type"]="delete";
			}
		}
		//***** detail log
		
	    if(empty($arr_key)){
		  $detail="รหัส : ".$_POST['code'];
		  $detail.=" ไม่มีการเปลี่ยนแปลงใดๆ";		
		}else{
		  $detail="ดังนี้ รหัส : ".$row['Code'];		
		  $detail.=" ชื่อ : ".$row['HumanName']." เป็น ".$arr_key[0];
		}//close if
		// ***** detail log
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				//$detail="รหัส ".$row['Code']." ".$detail;		
				$chk_log->AddLog(18,$detail);	
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$detail="ชื่อ: ".$_POST['HumanTypeName'];
				$chk_log->AddLog(17,$detail);
				$_SESSION["shw_type"]="add";
			}			
		}
	 
     HumanType();
      break;
    case "System":
		$row=GetData("system",$_GET['id']);
		$field="SystemName";
		$arr=array($_POST['txtSystem']);
		$arr_key=get_detail($field,$arr,"system");
		if($_GET['act']=="delete"){		
			if($_GET['chk_del']=="1"){
				$detail="รหัส ".$row['Code'];
				$detail.=" ชื่อ: ".$row['SystemName'];	
				$chk_log->AddLog(23,$detail);
				$_SESSION["shw_type"]="delete";
			}
		}
		//***** detail log
	    if(empty($arr_key)){
		  $detail="รหัส : ".$_POST['code'];
		  $detail.=" ไม่มีการเปลี่ยนแปลงใดๆ";			
		}else{
		  $detail="ดังนี้ รหัส : ".$row['Code'];		
		  $detail.=" ชื่อ : ".$row['SystemName']." เป็น ".$arr_key[0];
		}//close if
		// ***** detail log
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				//$detail="รหัส ".$row['Code']." ".$detail;		
				$chk_log->AddLog(22,$detail);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$detail="ชื่อ: ".$_POST['txtSystem'];	
				$chk_log->AddLog(21,$detail);	
				$_SESSION["shw_type"]="add";
			}			
		}
      SystemA();
      break;
    case "department":
		$row=GetData("department",$_GET['id']);
		$field="DeptName";
		$arr=array($_POST['txtDeptName']);
		$arr_key=get_detail($field,$arr,"department");
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$detail="รหัส ".$row['Code'];
			    $detail.=" ชื่อ: ".$row['DeptName'];	
				$chk_log->AddLog(7,$detail);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		//***** detail log
	    if(empty($arr_key)){
	  	  $detail="รหัส : ".$_POST['code'];
		  $detail.=" ไม่มีการเปลี่ยนแปลงใดๆ";				
		}else{
		  $detail="ดังนี้ รหัส : ".$row['Code'];		
		  $detail.=" ชื่อ : ".$row['DeptName']." เป็น ".$arr_key[0];
		}//close if
		// ***** detail log
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){	
				//$detail="รหัส ".$row['Code']." ".$detail;					
				$chk_log->AddLog(6,$detail);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$detail="ชื่อ: ".$_POST['txtDeptName'];	
				$chk_log->AddLog(5,$detail);
				$_SESSION["shw_type"]="add";
			}			
		}
      Department();
      break;
    case "division":
		$row=GetData("division",$_GET['id']);
		$field="DivisionName,DeptID";
		$arr=array("DivisionName"=>$_POST['txtDivisionName'],"DeptID"=>$_POST['department']);	
		$arr_key=get_detail($field,$arr,"division");
		
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$detail="รหัส ".$row['Code'];
				$detail.=" ชื่อ: ".$row['DivisionName'];	
				$chk_log->AddLog(11,$detail);
				$_SESSION["shw_type"]="delete";
			}
		}
		// detail log
		$detail = array();
		if(empty($arr_key)){
	  	  $detail[]="รหัส : ".$_POST['code'];
		  $detail[]=" ไม่มีการเปลี่ยนแปลงใดๆ";		
		}else{
			 $detail[]="ดังนี้ รหัส : ".$row['Code'];
			
			foreach($arr_key as $key=>$value){			
				
				switch($key){
					
					case "DivisionName":
												
						$detail[]="กอง/สำนักจาก :".$row['DivisionName']." เป็น ".$_POST['txtDivisionName'];
						break;
					case "DeptID":
						
						$name1['deptname']=GetOne("deptname","id",$row['DeptID'],"department");
						$name2['deptname']=GetOne("deptname","id",$_POST['department'],"department");
						$detail[]="กรมจาก :".$name1['deptname']." เป็น ".$name2['deptname'];
						break;
				}//close switch
			}//close foreach			
			$detail=implode(", ",$detail);
			
		}//close if
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				//$detail="รหัส ".$row['Code']." ".$detail;				
				$chk_log->AddLog(10,$detail);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$detail="ชื่อ: ".$_POST['txtDivisionName'];
				$chk_log->AddLog(9,$detail);
				$_SESSION["shw_type"]="add";
			}			
		}
      Division();
      break;
    case "group":
		
		$row=GetData("hd_section",$_GET['id']);
		$field="GroupName,DeptID,DivisionID";
		$arr=array("GroupName"=>$_POST['txtGroupName'],"DeptID"=>$_POST['department'],"DivisionID"=>$_POST['division']);	
		$arr_key=get_detail($field,$arr,"hd_section");	
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$detail="รหัส ".$row['Code'];
				$detail.=" ชื่อ: ".$row['GroupName'];
				$chk_log->AddLog(15,$detail);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		// detail log
		$detail = array();
		if(empty($arr_key)){
		  $detail[]="รหัส : ".$_POST['code'];
		  $detail[]=" ไม่มีการเปลี่ยนแปลงใดๆ";
		}else{
			
			$detail[]="ดังนี้ รหัส : ".$row['Code'];
			foreach($arr_key as $key=>$value){				
				switch($key){
					case "GroupName":
						$detail[]="กลุ่ม/ฝ่ายจาก :".$row['GroupName']." เป็น".$_POST['txtGroupName'];
						break;
					case "DeptID":					
						$name1['deptname']=GetOne("deptname","id",$row['DeptID'],"department");
						$name2['deptname']=GetOne("deptname","id",$_POST['department'],"department");
						$detail[]="กรมจาก :".$name1['deptname']." เป็น".$name2['deptname'];
						break;
					case "DivisionID":
						$name1['divisionname']=GetOne("divisionname","id",$row['DivisionID'],"division");
						$name2['divisionname']=GetOne("divisionname","id",$_POST['division'],"division");
						$detail[]="กอง/สำนักจาก :".$name1['divisionname']." เป็น".$name2['divisionname'];
						break;
					default:
						break;
				}//close switch
			}//close foreach			
			$detail=implode(", ",$detail);
		}//close if
		echo "AA ";
		echo $_GET['type'].'<br>';
		echo $_GET['act'];
		
		if($_GET['id']!=""){
			
			if($_GET['chk_edit']=="1"){
				$detail="รหัส ".$row['Code']." ".$detail;		
				$chk_log->AddLog(14,$detail);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$detail="ชื่อ: ".$_POST['txtGroupName'];
				$chk_log->AddLog(13,$detail);
				$_SESSION["shw_type"]="add";
			}			
		}
		
      Group();
      break;
    case "server";
		$row=GetData("server",$_GET['id']);
		$field="SystemID,ServerName,Note,Os,NetworkAddress,DiskSize,PortRunning,ProcessRunning,DatabaseName
		,Size,PathDataName,PathSoftware,StartApp,StopApp,ip_ftp,ip_ftp_public,url_ftp,port,username,password,dbport,DBuser,DBpass,BackupProcess";

		$arr=array($_POST['systembox'],$_POST['servername'],$_POST['note']
					,$_POST['os'],$_POST['networkaddress'],$_POST['disksize']
					,$_POST['portrunning'],$_POST['processrunning'],$_POST['databasename']
					,$_POST['size']		,$_POST['pathdataname'],$_POST['pathsoftware'],$_POST['startapp']
					,$_POST['stopapp'],$_POST['ip_ftp'],$_POST['ip_ftp_public']
					,$_POST['url_ftp'],$_POST['port'],$_POST['username'],$_POST['password'],$_POST['dbport'],$_POST['DBuser'],$_POST['DBpass']
					,$_POST['BackupProcess']
					);
		$arr_key=get_detail($field,$arr,"server");
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				 $detail="ชื่อ: ".$row['ServerName'];
				$chk_log->AddLog(27,$detail);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		//***** detail log
	    if(empty($arr_key)){
		  $conj=": ";
		  $detail="ไม่มีการเปลี่ยนแปลงใดๆ";		
		}else{
		 			
		  $detail="ชื่อ : ".$_POST['servername'];
		}//close if
		// ***** detail log
		$detail=$conj.$detail;
		
		
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(26,$detail);	
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				
				$detail="ชื่อ: ".$_POST['servername'];
				$chk_log->AddLog(25,$detail);
				$_SESSION["shw_type"]="add";
			}			
		}
      server();
      break;
  }


function ProblemType()
{


	if($_GET['act']=='delete')
	{     
		  if($_GET['chk_del']=="1"){
		 	mysql_query("DELETE FROM problemtype WHERE ID=".$_GET['id']);
			
		  }else{Alert($GLOBALS["alert_del"]);}
		  
		 
		  ReDirect('setting.php?act=problemlist','top'); 
		
	}
	else
	{     
	  if($_GET['id']!='')
	  {
			if($_GET['chk_edit']=="1"){
				mysql_query("UPDATE problemtype SET ProblemName='".$_POST['ProblemTypeName']."',abbr='".$_POST['abbr']."' WHERE ID=".$_GET['id']);				
			}else{Alert($GLOBALS["alert_edit"]);}
			
	  }else{
		if($_GET['chk_add']=="1"){			
			mysql_query ("INSERT INTO problemtype( Code, ProblemName,abbr) VALUES( '', '".$_POST['ProblemTypeName']."','".$_POST['abbr']."')") or die("Error problem:".mysql_error());

			$sql = "SELECT ID FROM problemtype WHERE ProblemName='".$_POST['ProblemTypeName']."' ";
			$result = mysql_query($sql) or die("Error".mysql_error());
			$row = mysql_fetch_array($result);
			
			$code = "P".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
			mysql_query("UPDATE problemtype SET Code='".$code."' WHERE ID=".$row['ID']);
			
			
			
		}
		else{Alert($GLOBALS["alert_add"]);
		}
	  
	  }
	} 
  
  ReDirect('setting.php?act=problemlist','self');
}
function HumanType()
{
if($_GET['act']=='delete')
{ 

  if($_GET['chk_del']=="1"){
	  mysql_query("DELETE FROM humantype WHERE ID=".$_GET['id']);
	 
  }else{Alert($GLOBALS["alert_del"]);}  
	  ReDirect('setting.php?act=humantypelist','top');
  
}
else
{   
  if($_GET['id']!='')
  {
    if($_GET['chk_edit']=="1"){
		mysql_query("UPDATE humantype SET HumanName='".$_POST['HumanTypeName']."' WHERE ID=".$_GET['id']) or die("Error human:".mysql_error());
		
	}else{Alert($GLOBALS["alert_edit"]);}
	
  }else{
  	if($_GET['chk_add']=="1"){
		 mysql_query ("INSERT INTO humantype( Code, HumanName) VALUES( '', '".$_POST['HumanTypeName']."')")  or die("Error human:".mysql_error());
		
		
		$sql = "SELECT ID FROM humantype WHERE HumanName='".$_POST['HumanTypeName']."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$code = "H".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
		mysql_query("UPDATE humantype SET Code='".$code."' WHERE ID=".$row['ID']);

	}else{Alert($GLOBALS["alert_add"]);}
  }
}  
  ReDirect('setting.php?act=humantypelist','self');
}

function SystemA()
{
if($_GET['act']=='delete')
{ 
	if($_GET['chk_del']=="1"){
	  mysql_query("DELETE FROM system WHERE ID=".$_GET['id']);
	  // delete ma_user
	  mysql_query("DELETE FROM ma_user WHERE system_id=".$_GET['id']);
	  // delete admin_user
	  mysql_query("DELETE FROM admin_user WHERE system_id=".$_GET['id']);
	  
	}else{Alert($GLOBALS["alert_del"]);}
	  ReDirect('setting.php?act=systemlist','top');
}
else
{   
  if($_GET['id']!='')
  {
    if($_GET['chk_edit']=="1"){
		mysql_query("UPDATE system SET SystemName='".$_POST['txtSystem']."' WHERE ID=".$_GET['id'])  or die("Error System:".mysql_error());
		//update ma_user
		foreach($_POST['m_name'] as $key => $item){
			if($item){
				if($_POST['ma_id'][$key] != ""){
					mysql_query ("UPDATE ma_user SET m_name='".$item."', m_tel='".$_POST['m_tel'][$key]."', m_email='".$_POST['m_email'][$key]."', m_company='".$_POST['m_company'][$key]."', m_ctel='".$_POST['m_ctel'][$key]."' WHERE ID=".$_POST['ma_id'][$key])  or die("Error System:".mysql_error());
				}else{
					mysql_query ("INSERT INTO ma_user( system_id, m_name, m_tel, m_email, m_company,m_ctel) VALUES( ".$_GET['id'].", '".$item."', '".$_POST['m_tel'][$key]."', '".$_POST['m_email'][$key]."', '".$_POST['m_company'][$key]."', '".$_POST['m_ctel'][$key]."')") or die ("Error System:".mysql_error());
				}
				
			}
		}
		/*************/
		
		//update admin_user
		foreach($_POST['a_name'] as $key => $item){
			if($item){
				if($_POST['admin_id'][$key] != ""){
					mysql_query ("UPDATE admin_user SET a_name='".$item."', a_tel='".$_POST['a_tel'][$key]."', a_email='".$_POST['a_email'][$key]."', a_company='".$_POST['a_company'][$key]."', a_ctel='".$_POST['a_ctel'][$key]."' WHERE ID=".$_POST['admin_id'][$key])  or die("Error System:".mysql_error());
				}else{
					mysql_query ("INSERT INTO admin_user( system_id, a_name, a_tel, a_email, a_company,a_ctel) VALUES( ".$_GET['id'].", '".$item."', '".$_POST['a_tel'][$key]."', '".$_POST['a_email'][$key]."', '".$_POST['a_company'][$key]."', '".$_POST['a_ctel'][$key]."')") or die ("Error System:".mysql_error());
				}
				
			}
		}
		/*************/
		
	}else{Alert($GLOBALS["alert_edit"]);}
	   ReDirect('setting.php?act=systemlist','top');
  }else{
  	if($_GET['chk_add']=="1"){
		 mysql_query ("INSERT INTO system( Code, SystemName) VALUES( '', '".$_POST['txtSystem']."')") or die ("Error System:".mysql_error());
		
		// เพิ่ม ma_user
		// หา max id จากเทเบิ้ล system
		$sql = "SELECT max(ID) FROM system";
		$rs = mysql_query($sql);
		$row = mysql_fetch_array($rs);
		
		foreach($_POST['m_name'] as $key => $item){
			if($item){
				mysql_query ("INSERT INTO ma_user( system_id, m_name, m_tel, m_email, m_company,m_ctel) VALUES( ".$row['max(ID)'].", '".$item."', '".$_POST['m_tel'][$key]."', '".$_POST['m_email'][$key]."', '".$_POST['m_company'][$key]."', '".$_POST['m_ctel'][$key]."')") or die ("Error System:".mysql_error());
			}
		}
		/*************/
		
		// เพิ่ม admin_user
		foreach($_POST['a_name'] as $key => $item){
			if($item){
				mysql_query ("INSERT INTO admin_user( system_id, a_name, a_tel, a_email, a_company,a_ctel) VALUES( ".$row['max(ID)'].", '".$item."', '".$_POST['a_tel'][$key]."', '".$_POST['a_email'][$key]."', '".$_POST['a_company'][$key]."', '".$_POST['a_ctel'][$key]."')") or die ("Error System:".mysql_error());
			}
		}
		/*************/
		
		$sql = "SELECT ID FROM system WHERE SystemName='".$_POST['txtSystem']."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$code = "S".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
		mysql_query("UPDATE system SET Code='".$code."' WHERE ID=".$row['ID']);
		
	}else{Alert($GLOBALS["alert_add"]);}
  }
} 
  ReDirect('setting.php?act=systemlist','self');
}

function Department()
{ //กรม
if($_GET['act']=='delete')
{ 
	if($_GET['chk_del']=="1"){
	  mysql_query("DELETE FROM department WHERE ID=".$_GET['id']);
	}else{Alert($GLOBALS["alert_del"]);} 
	  ReDirect('setting.php?act=departmentlist','top');
}
else
{
  if($_GET['id']!='')
  {
    if($_GET['chk_edit']=="1"){
		mysql_query("UPDATE department SET DeptName='".$_POST['txtDeptName']."' WHERE ID=".$_GET['id']);		
	
	}else{ Alert($GLOBALS["alert_edit"]);}
  }else{
  	if($_GET['chk_add']=="1"){
		mysql_query ("INSERT INTO department( Code, DeptName) VALUES( '', '".$_POST['txtDeptName']."')") or die ("Error Department:".mysql_error()) ;

		
		$sql = "SELECT ID FROM department WHERE DeptName='".$_POST['txtDeptName']."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$code = "D".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
		mysql_query("UPDATE department SET Code='".$code."' WHERE ID=".$row['ID']);
		
	 
	}else{ Alert($GLOBALS["alert_add"]);}
  }
}
    ReDirect('setting.php?act=departmentlist','self');
}


function Division()
{
//กอง/สำนัก
if($_GET['act']=='delete')
{ 
	if($_GET['chk_del']=="1"){ 
	
	  mysql_query("DELETE FROM division WHERE ID=".$_GET['id']);
	
	}else{Alert($GLOBALS["alert_del"]);} 
	  ReDirect('setting.php?act=divisionlist','top');
  
}
else
{
  if($_GET['id']!='')
  {    
	if($_GET['chk_edit']=="1"){		
		mysql_query("UPDATE division SET DivisionName='".$_POST['txtDivisionName']."', DeptID=".$_POST['department']." WHERE 	ID=".$_GET['id']);
		
	}else{ Alert($GLOBALS["alert_edit"]);}
  }else{  
   	if($_GET['chk_add']=="1"){	
		mysql_query ("INSERT INTO division( Code, DivisionName, DeptID) VALUES( '', '".$_POST['txtDivisionName']."', '".$_POST['department']."')") or die ("Error Division:".mysql_error());

		
		$sql = "SELECT ID FROM division WHERE DivisionName='".$_POST['txtDivisionName']."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$code = "F".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
		mysql_query("UPDATE division SET Code='".$code."' WHERE ID=".$row['ID']);
		
	}else{ Alert($GLOBALS["alert_add"]);}
  } 
}
 ReDirect('setting.php?act=divisionlist','self');
}

function Group()
{
if($_GET['act']=='delete')
{ 
	if($_GET['chk_del']=="1"){
	  mysql_query("DELETE FROM hd_section WHERE ID=".$_GET['id']);
	  
	}else{Alert($GLOBALS["alert_del"]);} 
	  ReDirect('setting.php?act=grouplist','top');
}
else
{ 
  if($_GET['id']!='')
  {
    if($_GET['chk_edit']=="1"){
		mysql_query("UPDATE hd_section SET GroupName='".$_POST['txtGroupName']."', DivisionID=".$_POST['division'].", DeptID=".$_POST['department']." WHERE ID=".$_GET['id']);
		 
	}else {Alert($GLOBALS["alert_edit"]);}
  }else{
  	if($_GET['chk_add']=="1"){
		
		$sql ="INSERT INTO hd_section( Code, GroupName, DivisionID, DeptID) ";
		$sql.=" VALUES( '','".$_POST['txtGroupName']."','".$_POST['division']."','".$_POST['department']."')";
		
		mysql_query($sql) or die("Insert hd_section:".mysql_error());
		
		$sql = "SELECT ID FROM hd_section WHERE GroupName='".$_POST['txtGroupName']."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$code = "G".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
		mysql_query("UPDATE hd_section SET Code='".$code."' WHERE ID=".$row['ID']);
	
	}else { Alert($GLOBALS["alert_add"]);}
  }
}
  ReDirect('setting.php?act=grouplist','self');
}

function Server()
{
if($_GET['act']=='delete')
{ 
	if($_GET['chk_del']=="1"){
	  mysql_query("DELETE FROM server WHERE ID=".$_GET['id']);
	 
	}else{Alert($GLOBALS["alert_del"]);} 
	  ReDirect('setting.php?act=serverlist','top');
}
else
{ 
  if($_GET['id']!='')
  {
    if($_GET['chk_edit']=="1"){
		mysql_query("UPDATE server SET SystemID=".$_POST['systembox'].", ServerName='".$_POST['servername']."', Os='".$_POST['os']."', NetworkAddress='".$_POST['networkaddress']."', DiskSize='".$_POST['disksize']."', PortRunning='".$_POST['portrunning']."', ProcessRunning='".$_POST['processrunning']."', DataBaseName='".$_POST['databasename']."', Size='".$_POST['size']."', PathDataName='".$_POST['pathdataname']."', PathSoftware='".$_POST['pathsoftware']."', StartApp='".$_POST['startapp']."', StopApp='".$_POST['stopapp']."',ip_ftp='".$_POST['ip_ftp']."',ip_ftp_public='".$_POST['ip_ftp_public']."',port='".$_POST['port']."',username='".$_POST['username']."',password='".$_POST['password']."',Note='".$_POST['note']."',url_ftp='".$_POST['url_ftp']."',dbport='".$_POST['dbport']."',DBuser='".$_POST['DBuser']."',DBpass='".$_POST['DBpass']."',BackupProcess='".$_POST['BackupProcess']."' WHERE ID=".$_GET['id']);
		
	}else{Alert($GLOBALS["alert_edit"]);}
    }else{
    	if($_GET['chk_add']=="1"){
			mysql_query ("INSERT INTO server( SystemID, ServerName, Os, NetworkAddress, DiskSize, PortRunning, ProcessRunning, DatabaseName, Size, PathDataName, PathSoftware, StartApp, StopApp,ip_ftp,ip_ftp_public,port,username,password,Note,url_ftp,dbport,DBuser,DBpass,BackupProcess) 
			VALUES( '".$_POST['systembox']."', '".$_POST['servername']."', '".$_POST['os']."', '".$_POST['networkaddress']."', '".$_POST['disksize']."', '".$_POST['portrunning']."', '".$_POST['processrunning']."', '".$_POST['databasename']."', '".$_POST['size']."', '".$_POST['pathdataname']."', '".$_POST['pathsoftware']."', '".$_POST['startapp']."','".$_POST['stopapp']."','".$_POST['ip_ftp']."','".$_POST['ip_ftp_public']."','".$_POST['port']."','".$_POST['username']."','".$_POST['password']."','".$_POST['note']."','".$_POST['url_ftp']."','".$_POST['dbport']."','".$_POST['DBuser']."','".$_POST['DBpass']."','".$_POST['BackupProcess']."')") or die ("Error Server:".mysql_error());
			
			
			$sql = "SELECT ID FROM server WHERE ServerName='".$_POST['servername']."' ";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			
		}else{Alert($GLOBALS["alert_add"]);}
		
  }
}
  ReDirect('setting.php?act=serverlist','self');
}
?>


