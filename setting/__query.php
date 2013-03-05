<?php

// set notifybar
 $_SESSION["show"]="show";

 switch($_GET['type'])
  {
    case "problemtype":
	
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$chk_log->AddLog(3);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(2);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$chk_log->AddLog(1);
				$_SESSION["shw_type"]="add";
			}			
		}
	  ProblemType();
      break;
    case "humantype":
	
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$chk_log->AddLog(19);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(18);	
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$chk_log->AddLog(17);
				$_SESSION["shw_type"]="add";
			}			
		}
	 
      HumanType();
      break;
    case "System":
	
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$chk_log->AddLog(23);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(22);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$chk_log->AddLog(21);	
				$_SESSION["shw_type"]="add";
			}			
		}
      SystemA();
      break;
    case "department":
	
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$chk_log->AddLog(7);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(6);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$chk_log->AddLog(5);
				$_SESSION["shw_type"]="add";
			}			
		}
      Department();
      break;
    case "division":
	
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$chk_log->AddLog(11);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(10);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$chk_log->AddLog(9);
				$_SESSION["shw_type"]="add";
			}			
		}
      Division();
      break;
    case "group":
	
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$chk_log->AddLog(15);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		if($_GET['id']!=""){
			
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(14);
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$chk_log->AddLog(13);
				$_SESSION["shw_type"]="add";
			}			
		}
      Group();
      break;
    case "server";
		
		if($_GET['act']=="delete"){
			if($_GET['chk_del']=="1"){
				$chk_log->AddLog(27);
				$_SESSION["shw_type"]="delete";
			}
		}
		
		if($_GET['id']!=""){
			if($_GET['chk_edit']=="1"){
				$chk_log->AddLog(26);	
				$_SESSION["shw_type"]="edit";
			}
		}else{
			if($_GET['chk_add']=="1"){
				$chk_log->AddLog(25);
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
			
			
			$sql = mysql_query ("INSERT INTO problemtype( Code, ProblemName,abbr) VALUES( '', '".$_POST['ProblemTypeName']."','".$_POST['abbr']."')");

			$sql = "SELECT ID FROM problemtype WHERE ProblemName='".$_POST['ProblemTypeName']."' ";
			$result = mysql_query($sql) or die("Error".mysql_error());
			$row = mysql_fetch_array($result);
			
			$code = "P".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
			mysql_query("UPDATE problemtype SET Code='".$code."' WHERE ID=".$row['ID']);
			
		}else{Alert($GLOBALS["alert_add"]);}
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
		mysql_query("UPDATE humantype SET HumanName='".$_POST['HumanTypeName']."' WHERE ID=".$_GET['id']);
		
	}else{Alert($GLOBALS["alert_edit"]);}
	
  }else{
  	if($_GET['chk_add']=="1"){
		$sql = mysql_query ("INSERT INTO humantype( Code, HumanName) 
		VALUES( '', '".$_POST['HumanTypeName']."')");
		mysql_query($sql);
		
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
	  
	}else{Alert($GLOBALS["alert_del"]);}
	  ReDirect('setting.php?act=systemlist','top');
}
else
{   
  if($_GET['id']!='')
  {
    if($_GET['chk_edit']=="1"){
		mysql_query("UPDATE system SET SystemName='".$_POST['txtSystem']."' WHERE ID=".$_GET['id']);
		
	}else{Alert($GLOBALS["alert_edit"]);}
	   ReDirect('setting.php?act=systemlist','top');
  }else{
  	if($_GET['chk_add']=="1"){
		$sql = mysql_query ("INSERT INTO system( Code, SystemName) 
		VALUES( '', '".$_POST['txtSystem']."')");
		mysql_query($sql);
		
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
		$sql = mysql_query ("INSERT INTO department( Code, DeptName) 
		VALUES( '', '".$_POST['txtDeptName']."')");
		mysql_query($sql);
		
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
		$sql = mysql_query ("INSERT INTO division( Code, DivisionName, DeptID) 
		VALUES( '', '".$_POST['txtDivisionName']."', '".$_POST['department']."')");
		mysql_query($sql);
		
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
	  mysql_query("DELETE FROM section WHERE ID=".$_GET['id']);
	  
	}else{Alert($GLOBALS["alert_del"]);} 
	  ReDirect('setting.php?act=grouplist','top');
	  
}
else
{ 
  if($_GET['id']!='')
  {
    if($_GET['chk_edit']=="1"){
		mysql_query("UPDATE section SET GroupName='".$_POST['txtGroupName']."', DivisionID=".$_POST['division'].", DeptID=".$_POST['department']." WHERE ID=".$_GET['id']);
		 
	}else {Alert($GLOBALS["alert_edit"]);}
  }else{
  	if($_GET['chk_add']=="1"){
		$sql = mysql_query ("INSERT INTO section( Code, GroupName, DivisionID, DeptID) 
		VALUES( '', '".$_POST['txtGroupName']."','".$_POST['division']."','".$_POST['department']."')");
		mysql_query($sql);
		
		$sql = "SELECT ID FROM section WHERE GroupName='".$_POST['txtGroupName']."' ";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		
		$code = "G".str_pad($row['ID'], 3, "0", STR_PAD_LEFT);  
		mysql_query("UPDATE section SET Code='".$code."' WHERE ID=".$row['ID']);
	
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
		mysql_query("UPDATE server SET SystemID=".$_POST['systembox'].", ServerName='".$_POST['servername']."', Os='".$_POST['os']."', NetworkAddress='".$_POST['networkaddress']."', DiskSize='".$_POST['disksize']."', PortRunning='".$_POST['portrunning']."', ProcessRunning='".$_POST['processrunning']."', DataBaseName='".$_POST['databasename']."', Size='".$_POST['size']."', PathDataName='".$_POST['pathdataname']."', PathSoftware='".$_POST['pathsoftware']."', StartApp='".$_POST['startapp']."', StopApp='".$_POST['stopapp']."',ip_ftp='".$_POST['ip_ftp']."',ip_ftp_public='".$_POST['ip_ftp_public']."',port='".$_POST['port']."',username='".$_POST['username']."',password='".$_POST['password']."' WHERE ID=".$_GET['id']);
		
	}else{Alert($GLOBALS["alert_edit"]);}
    }else{
    	if($_GET['chk_add']=="1"){
			$sql = mysql_query ("INSERT INTO server( SystemID, ServerName, Os, NetworkAddress, DiskSize, PortRunning, ProcessRunning, DatabaseName, Size, PathDataName, PathSoftware, StartApp, StopApp,ip_ftp,ip_ftp_public,port,username,password) 
			VALUES( '".$_POST['systemid']."', '".$_POST['servername']."', '".$_POST['os']."', '".$_POST['networkaddress']."', '".$_POST['disksize']."', '".$_POST['portrunning']."', '".$_POST['processrunning']."', '".$_POST['databasename']."', '".$_POST['size']."', '".$_POST['pathdataname']."', '".$_POST['pathsoftware']."', '".$_POST['startapp']."','".$_POST['stopapp']."','".$_POST['ip_ftp']."','".$_POST['ip_ftp_public']."','".$_POST['port']."','".$_POST['username']."','".$_POST['password']."')");
			mysql_query($sql);
			
			$sql = "SELECT ID FROM server WHERE ServerName='".$_POST['servername']."' ";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			
		}else{Alert($GLOBALS["alert_add"]);}
		
  }
}
  ReDirect('setting.php?act=serverlist','self');
}
?>


