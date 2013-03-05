<?php 
$_SESSION["show"]="show";

if($_GET['act']=='delete')
{ 
	 if($_GET['chk_del']=="1"){ 
		  
		  
		  $sql="select usergroupname,code from usergroup where ID=".$_GET['id'];
		  $result=mysql_query($sql) or die("error del usergroup:".mysql_error());
		  $item=mysql_fetch_assoc($result);
		  $detail="รหัส : ".$item['code'];
		  $detail.=" ชื่อ : ".$item['usergroupname'];
		  mysql_query("DELETE FROM usergroup WHERE ID=".$_GET['id']);
		  mysql_query("DELETE FROM usergroup_permission WHERE UserGroupID=".$_GET['id']);
		  $_SESSION["shw_type"]="delete";
		  		  
		  $pm->AddLog(45,$detail);
		  
		  ReDirect('usergroup.php?act=list','top');
		  
	 }else{Alert($alert_del);}
}

if(($_GET['id']!='') && ($_GET['act']=="query"))
{
    $usergroupID = $_GET['id'];
	if($_GET['chk_edit']=="1"){ 
		 mysql_query("UPDATE usergroup SET UserGroupName='".$_POST['UserGroupName']."', CanAccessAll='".@$_POST['CanAccessAll']."' WHERE ID=".$_GET['id']);
		mysql_query("DELETE FROM usergroup_permission WHERE UserGroupID=".$usergroupID);
		for($i=1;$i<=11;$i++)
		{
		  SavePermission($i,$usergroupID);
		}
		$_SESSION["shw_type"]="edit";
		$detail="รหัส : ".$_POST['code'];
		$detail.=" ชื่อ : ".$_POST['UserGroupName'];
		$pm->AddLog(44,$detail);
	}else {Alert($alert_edit);}
}

elseif(($_GET['id']=='') && ($_GET['act']=="query"))
{
    
    if(@$_GET['chk_add']=="1"){ 
		$date = date("Y-m-d");
		 $sql = "INSERT INTO usergroup (Code,UserGroupName,UserDate,CanAccessAll)VALUES('".@$code."','".$_POST['UserGroupName']."','".$date."','".@$_POST['CanAccessAll']."')";
		mysql_query($sql);
		
		$result = mysql_query("SELECT ID FROM usergroup WHERE CODE='".@$code."'");
		$row = mysql_fetch_array($result);
		$usergroupID = $row['ID'];
		
		$code = "G".str_pad($usergroupID, 3, "0", STR_PAD_LEFT);     
		mysql_query("UPDATE usergroup SET Code='".@$code."' WHERE ID=".$usergroupID);   
		
	
		mysql_query("DELETE FROM usergroup_permission WHERE UserGroupID=".$usergroupID);
		for($i=1;$i<=11;$i++)
		{
		  SavePermission($i,$usergroupID);
		}
		
	    $detail=" รหัส : ".$code;
		$detail.=" ชื่อ : ".$_POST['UserGroupName'];
		$pm->AddLog(43,$detail);
		$_SESSION["shw_type"]="add";
	}else{Alert($alert_add);}
}
ReDirect('usergroup.php','top');


function SavePermission($i,$usergroupID)
{
      switch($i){
        case 1:
          $ControlName = 'Problem';
          break;
        case 2:
          $ControlName = 'Department';
          break;  
        case 3:
          $ControlName = 'Division';
          break;  
        case 4:
          $ControlName = 'Group';
          break;  
        case 5:
          $ControlName = 'Human';
          break;    
        case 6:
          $ControlName = 'System';
          break;  
        case 7:
          $ControlName = 'Server';
          break;          
		case 8:
          $ControlName = 'User';
          break;    
		 case 9:
          $ControlName = 'Permission';
          break;    
        case 10:
          $ControlName = 'Report';
          break;            
        case 11:
          $ControlName = 'Log';
          break;           
        }
        
          $ViewState = @$_POST[$ControlName.'ViewState'];
          $AddState = @$_POST[$ControlName.'AddState'];
          $EditState = @$_POST[$ControlName.'EditState'];
          $DeleteState = @$_POST[$ControlName.'DeleteState'];  
          $ExportState = @$_POST[$ControlName.'ExportState'];                                              
          
          $sql = "INSERT INTO usergroup_permission (Code, CanView, CanAdd, CanEdit, CanDelete, CanExport, UserGroupID)VALUES(".$i.",'".$ViewState."','".$AddState."','".$EditState."', '".$DeleteState."','".$ExportState."', '".$usergroupID."' )";          
          mysql_query($sql);
}
?>