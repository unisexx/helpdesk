<?php

  include "../include/session_config.php";
  include "../include/config.php";
  include "../include/function.php";
  db_connect();

if($_GET['act']=='delete')
  { 
	  if($_GET['chk_del']=="1"){
		  mysql_query("DELETE FROM informent WHERE ID=".$_GET['id']);
		  mysql_query("DELETE FROM user_systems WHERE userid=".$_GET['id']);
		  $pm->AddLog(37);
		  ReDirect('user.php?act=list','top');
	  }else{Alert($alert_del);}
  }
else{

    if ($_GET['id']!='')
      {
      	 if($_GET['chk_edit']=="1"){
		  if($_POST['Password']!='')$password = ", Password='".$_POST['Password']."' ";
		  $sql = "UPDATE informent SET UserGroupID='".$_POST['UserID']."', Name='".$_POST['NameUser']."', DepartmentID='".$_POST['Department']."', DivisionID='".$_POST['Division']."', GroupID='".$_POST['section']."', HumanType='".$_POST['human']."', IdCard='".$_POST['IdCard']."', Tel='".$_POST['Tel']."', Email='".$_POST['Email']."'".$password;
		  $sql.=",usertypeid='".$_POST['UserType']."',code='".$_POST['code']."',DateRegister='".$_POST['DateRegister']."' WHERE ID=".$_GET['id'];
		 
		  mysql_query($sql);
			  
	
			mysql_query("DELETE FROM user_systems WHERE userid='".$_GET['id']."'");
			$sql = "SELECT * FROM system ORDER BY SystemName ";
			$result = mysql_query($sql);
			while($srow = mysql_fetch_array($result))
			{
			   if($_POST['Chk_'.$srow['ID']]!='')
			   {
				  $sql = " INSERT INTO user_systems(userid,SystemID) VALUES('".$_GET['id']."','".$srow['ID']."')";
				  mysql_query($sql);
			   }
			}
		 $pm->AddLog(36); 
		}else{Alert($alert_edit);}
      }
    else
      {
    	if($_GET['chk_add']=="1"){
			$date = date("Y-m-d H:i:s");
			$field=" Code, UserGroupID, Name, DepartmentID, DivisionID, GroupID, HumanType, IdCard, Tel, Email, Password, DateRegister,usertypeid";
			$val  ="'','".$_POST['UserID']."'";
			$val .=",'".$_POST['NameUser']."'";
			$val .=",'".$_POST['Department']."'";
			$val .=",'".$_POST['Division']."'";
			$val .=",'".$_POST['section']."'";
			$val .=",'".$_POST['human']."'";
			$val .=",'".$_POST['IdCard']."'";
			$val .=",'".$_POST['Tel']."'";
			$val .=",'".$_POST['Email']."'";
			$val .=",'".$_POST['Password']."'";
			$val .=",'".$date."'";
			$val .=",'".$_POST['UserType']."'";
			
	
			
			mysql_query("LOCK TABLES informent WRITE"); 
			mysql_query("SET AUTOCOMMIT = 0");	
			mysql_query("INSERT INTO informent(".$field.") VALUES(".$val.")");       
			$insert_id = mysql_insert_id(); 
			mysql_query("COMMIT");
			mysql_query("UNLOCK TABLES");
			
			
	
	
			$sql = "SELECT * FROM system ORDER BY SystemName ";
			$result = mysql_query($sql);
			while($srow = mysql_fetch_array($result))
			{
			   if(@$_POST['Chk_'.$srow['ID']]!='')
			   {
				  $sql = "INSERT INTO user_systems(userid,SystemID) VALUES('".$insert_id ."','".$srow['ID']."')";
				  mysql_query($sql);
			   }
			} 
	
	
			$code = "I".str_pad($insert_id, 4, "0", STR_PAD_LEFT);
			mysql_query("UPDATE informent SET Code='".$code."' WHERE ID=".$insert_id);
		
		}else{Alert($alert_add);}
		
		
		
		
      } //($_GET['id']!='')
    ReDirect($host.'user.php?act=list','top');
    //header($hd."user.php?act=list&status=1");
    } //($_GET['act']=='delete')
?>