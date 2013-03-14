<?php

  // include "../include/session_config.php";
  // include "../include/config.php";
  // include "../include/function.php";
  // include "../include/class_userlogin.php";
  // db_connect();
   $pm= New UserLogin();
   $_SESSION["show"]="show";
   
	 // <<<<< ระบบ **** 
	 function get_detail_system(){
	   $result=mysql_query("select systemid from user_systems WHERE userid='".$_GET['id']."'");
	 	
		while($row=mysql_fetch_assoc($result)){
			$item[]=$row['systemid'];
			$temp[]=GetOne("systemname","id",$row['systemid'],"system");
		 }		 	  
	   $system=implode(", ",$temp);	  		
	   $str_key=array_diff($_POST['ChkSystem'],$item);	 
		
	   if(empty($str_key)){
			return $detail="";	
				
	   }else {
			
			sort($str_key);
			foreach($str_key as $key=>$value){
	  			$temp[]=GetOne("systemname","id",$value,"system");

			}
			$chk_system=implode(", ",$temp);
			$detail[]="ระบบงานจาก ".$system." เป็น ".$chk_system;			
			return $detail;
	   }
	 }//function
	   // **** ระบบ >>>>>

	
	function get_detail(){
	  if($_POST['Password']==""){
		$arr_pass=$_POST['arr_pass'];
	 }else{
		$arr_pass=$_POST['Password'];
	 }		
			   	$str=array("ID"=>$_GET['id'],"Code"=>$_POST['code'] ,"Name"=>ucfirst($_POST['NameUser'])
				 ,"lastname"=>ucfirst($_POST['lastname']),"usertypeid"=>$_POST['UserType']
				 ,"UserGroupID"=>$_POST['UserID']	  ,"DepartmentID"=>$_POST['Department']	
				 ,"DivisionID"=>$_POST['division']	,"GroupID"=>$_POST['section'] 
				 ,"HumanType"=>$_POST['human']    ,"IdCard"=>$_POST['IdCard']  ,"Tel"=>$_POST['Tel']
				 ,"Email"=>$_POST['Email']   	,"Password"=>$arr_pass,"DateRegister"=>$_POST['DateRegister']);
			   $result=mysql_query("select * from informent where id=".$_GET['id']); 
			   $item=mysql_fetch_assoc($result);	
			
			   $arr_key = array_diff($str,$item);	
			  	if(empty($arr_key)){
				 $arr_key =array_diff($item,$str);
				}
			
			 

			   
			   if(empty($arr_key)){
			   	   $conj="";
				   $detail[0]=get_detail_system(0);
				   if($detail[0]==""){
				   		$conj=" :";
			   	   		$detail[0]="ไม่มีการเปลี่ยนแปลง";
				   }
					 $save_detail=$conj.$detail[0];
				   
			   }else{
			   	$conj="ดังนี้ ";

			   foreach($arr_key as $key=>$value){
				
				switch($key){
					case "Name";
						$detail[]="ชื่อจาก ".$item['Name']." เป็น ".$_POST['NameUser'];
						break;
					case "lastname";
						$detail[]="นามสกุลจาก ".$item['lastname']." เป็น ".$_POST['lastname'];
						break;
					case "usertypeid";
						$detail[]="ประเภทผู้ใช้จาก ".GetUserType($item['usertypeid'])." เป็น ".GetUserType($_POST['UserType']);
						break;
					case "UserGroupID";
						$name1['usergroupname']=GetOne("usergroupname","id",$item['UserGroupID'],"usergroup");
						$name2['usergroupname']=GetOne("usergroupname","id",$_POST['UserID'],"usergroup");
						$detail[]="สิทธิ์การใช้งานจาก ".$name1['usergroupname']." เป็น ".$name2['usergroupname'];
						break;
					case "DepartmentID";
					
						$name1['deptname']=($item['DepartmentID']!="0")? GetOne("deptname","id",$item['DepartmentID'],"department"):"";
						$name2['deptname']=($_POST['Department']!="")? GetOne("deptname","id",$_POST['Department'],"department"):"";
						
						$detail[]="กรมจาก ".$name1['deptname']." เป็น ".$name2['deptname'];
						break;
					case "DivisionID";
						$name1['divisionname']=($item['DivisionID']!="0")? GetOne("divisionname","id",$item['DivisionID'],"division"):"";
						$name2['divisionname']=($_POST['division']!="") ? GetOne("divisionname","id",$_POST['division'],"division"):"";
						$detail[]="กอง/สำนักจาก ".$name1['divisionname']." เป็น ".$name2['divisionname'];
						break;
					case "GroupID";
						$name1['groupname']=($item['GroupID']!="0")? GetOne("groupname","id",$item['GroupID'],"hd_section"):"";
						$name2['groupname']=($_POST['section']!="") ? GetOne("groupname","id",$_POST['section'],"hd_section"):"";
						
						$detail[]="กลุ่ม/ฝ่ายจาก ".$name1['groupname']." เป็น ".$name2['groupname'];
						break;
					case "HumanType";
						$name1['humanname']=($item['HumanType']!="0") ? GetOne("humanname","id",$item['HumanType'],"humantype"):"";
						$name2['humanname']=($_POST['human']!="") ? GetOne("humanname","id",$_POST['human'],"humantype"):"";
						$detail[]="ประเภทบุคลากรจาก ".$name1['humanname']." เป็น ".$name2['humanname'];
						break;
					case "IdCard";
						$item['IdCard']=($item['IdCard']=="")?"ช่องว่าง":$item['IdCard'];
						$detail[]="เลขบัตรประชาชนจาก ".$item['IdCard']." เป็น ".$_POST['IdCard'];
						break;
					case "Tel":
						$item['Tel']=($item['Tel']=="")?"ช่องว่าง":$item['Tel'];
						$detail[]="เบอร์ติดต่อจาก ".$item['Tel']." เป็น ".$_POST['Tel'];					
						break;				
					case "Email";
						$detail[]="อีเมล์จาก ".$item['Email']." เป็น ".$_POST['Email'];
						break;
						
					case "Password":
						$detail[]="รหัสผ่าน จาก ".$item['Password']." เป็น ".$arr_pass;
						
						break;	
				    
				}
			   }
		      //$i=$i+1;
			  // << -- ระบบ -->>
			  $temp=get_detail_system();
			  if($temp!=""){
			  	$detail[]=$temp;
			  }
			  $save_detail=implode($detail,", ");
			  $save_detail=$conj.$save_detail;
			 }//close if $arr_key

			
	//print_r($detail);
	
	//print($save_detail);exit;
	return $save_detail;
	}
		   
if($_GET['act']=='delete')
  { 
	  
	  if($_GET['chk_del']=="1"){
		  
		  $sql=" select concat(name,'  ',lastname)as name,code from informent where id=".$_GET['id'];
		  $result=mysql_query($sql) or die("error:".mysql_error());
		 
		  $item=mysql_fetch_assoc($result);	
		  $detail="รหัส : ".$item['code'];
		  $detail.=" ชื่อ : ".$item['name'];
		 
		  $pm->AddLog(37,$detail);
		  mysql_query("DELETE FROM informent WHERE ID=".$_GET['id']);
		  mysql_query("DELETE FROM user_systems WHERE userid=".$_GET['id']);
		  
		  $_SESSION["shw_type"]="delete";
		 ReDirect('user.php?act=list','top');
	  }else{Alert($alert_del);}
  }
else{

    if ($_GET['id']!='')
      {
      	 if($_GET['chk_edit']=="1"){
		 	 $detail="รหัส ".$_POST['code']." ".get_detail();
		 		  
			  $password="";
		  if($_POST['Password']!='')$password = ", Password='".$_POST['Password']."' ";
			  $sql  ="UPDATE informent SET UserGroupID='".$_POST['UserID']."', Name='".ucfirst($_POST['NameUser'])."', DepartmentID='".$_POST['Department']."'";
			  $sql .=", DivisionID='".$_POST['division']."', GroupID='".$_POST['section']."', HumanType='".$_POST['human']."', IdCard='".$_POST['IdCard']."'";
			  $sql .=", Tel='".$_POST['Tel']."', Email='".$_POST['Email']."'".$password;
			  $sql .=", usertypeid='".$_POST['UserType']."',code='".$_POST['code']."',lastname='".ucfirst($_POST['lastname'])."'";
			  $sql .="  WHERE ID=".$_GET['id'];
			  //var_dump($sql);exit;
			
			  mysql_query($sql) or die("Error update user: ".mysql_error());
			  FillUserSystem($_GET['id']);		      
			  $pm->AddLog(36,$detail);
			  $_SESSION["shw_type"]="edit";	  
		}else{Alert($alert_edit);}
      }
    else
      {
				  
    	if($_GET['chk_add']=="1"){
			//var_dump($_POST);exit;
			$date = date("Y-m-d H:i:s");
			$field=" Code,Name,lastname,usertypeid, UserGroupID,DepartmentID, DivisionID,GroupID, HumanType, IdCard, Tel, Email, Password, DateRegister";
			
			$val ="'','".ucfirst($_POST['NameUser'])."'";
			$val .=",'".ucfirst($_POST['lastname'])."'";
			$val .=",'".@$_POST['UserType']."'";
			$val .=",'".$_POST['UserID']."'";
			$val .=",'".$_POST['Department']."'";
			$val .=",'".$_POST['division']."'";
			$val .=",'".$_POST['section']."'";
			$val .=",'".$_POST['human']."'";
			$val .=",'".$_POST['IdCard']."'";
			$val .=",'".$_POST['Tel']."'";
			$val .=",'".$_POST['Email']."'";
			$val .=",'".$_POST['Password']."'";
			$val .=",'".$date."'";
			
			
			
			
	
			
			mysql_query("LOCK TABLES informent WRITE"); 
			mysql_query("SET AUTOCOMMIT = 0");	
			mysql_query("INSERT INTO informent(".$field.") VALUES(".$val.")") or die("Error Inesert : ".mysql_error());       
			$insert_id = mysql_insert_id(); 
			mysql_query("COMMIT");
			mysql_query("UNLOCK TABLES");
			
			FillUserSystem($insert_id);
	
			$code = "U".str_pad($insert_id, 3, "0", STR_PAD_LEFT);
			mysql_query("UPDATE informent SET Code='".$code."' WHERE ID=".$insert_id);
			$detail="รหัส : ".$_POST['code'];
			$detail.=" ชื่อ : ".ucfirst($_POST['NameUser'])."  ".ucfirst($_POST['lastname']);
			$pm->AddLog(35,$detail);
			$_SESSION["shw_type"]="add";	  
		}else{Alert($alert_add);}

      
	  } //($_GET['id']!='')
   ReDirect($host.'user.php?act=list','top');
  
    } //($_GET['act']=='delete')
	
	function FillUserSystem($pUserID)
	{
 		 $chkSystem = @$_POST['ChkSystem'];
		// var_dump($_POST['ChkSystem']);exit;
		 if($pUserID!='')
		 {
		
			 mysql_query("DELETE FROM user_systems WHERE userid='".$pUserID."'");				
		 }
		 
					  for($i=0;$i<count($chkSystem);$i++)
					  {
						  if($chkSystem !=''){
							  if($chkSystem[$i] !=''){
								$sql = " INSERT INTO user_systems(userid,SystemID) VALUES('".$pUserID."','".$chkSystem[$i]."')";
								mysql_query($sql);
							  }
						  }
					  }
	}
?>