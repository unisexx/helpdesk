<?php
 /* 
 เราสามารถกำหนดเวลาให้ ตัวแปร SESSION หมดอายุได้ ด้วย ฟังก์ชัน 
 ini_set(session.gc_maxlifetime, 1800); 
 1800 คือจำนวนวินาทีของตัวแปร SESSION ว่าต้องการ 
 ให้ตัวแปร SESSION นั้นอยู่ได้นานแค่ไหน 
 หาก ฟังก์ชันข้างต้นไม่สามารถทำงานได้ เราสามารถ 
 สร้างฟังก์ชันไว้ใช้งานเองแบบง่ายๆ ได้ ดังนี้ 
 */  
 function setSessionTime($_timeSecond){  
  if(!isset($_SESSION['ses_time_life'])){  
   $_SESSION['ses_time_life']=time();  
  }  
  if(isset($_SESSION['ses_time_life']) && time()-$_SESSION['ses_time_life']>$_timeSecond){  
   if(count($_SESSION)>0){  
    foreach($_SESSION as $key=>$value){  
     unset($$key);  
     unset($_SESSION[$key]);  
    }  
   }  
  }  
 }  
 // การใช้งาน  
 //setSessionTime(10);  
 // 10 คือจำนวนวินาทีที่ต้องการให้ตัวแปร SESSION หมดอายุ  
 // สามารถกำหนดเป็น 30*60  
 // หมายถึงกำหนดให้ตัวแปร SESSION หมดอายุภายใน 30 นาที  
 // เช่น  setSessionTime(30*60);  
 // ฟังก์ชันนี้สามารถนำไปใช้ในการกำหนดเวลาว่าให้ user ต้องทำการล็อกอิน  
 // ใหม่ทุกๆ กี่นาทีหรือกี่วินาที หรือกี่ชั่วโมงก็ได้ 
	
 function get_detail(){
		if($_POST['Password']==""){
			$arr_pass=$_POST['arr_pass'];
		}else{
			$arr_pass=$_POST['Password'];
		}	
			   $str=array("Name"=>ucfirst($_POST['NameUser']),"lastname"=>ucfirst($_POST['lastname'])
				 ,"UserGroupID"=>$_POST['UserID']	  ,"DepartmentID"=>$_POST['Department']	
				 ,"DivisionID"=>$_POST['Division']	,"GroupID"=>$_POST['section'] 
				 ,"Email"=>$_POST['Email']   	,"Password"=>$arr_pass);
			   $field="Name,lastname,UserGroupID,DepartmentID,DivisionID,GroupID,Email,Password";
			   $result=mysql_query("select $field  from informent where id=".$_GET['id']); 
			   $item=mysql_fetch_assoc($result);	
			
			   $result = array_diff($str,$item);	
			   $arr_key=array_keys($result);
			   $i=0;

			   
			   if(empty($arr_key)){				  
				   	$conj=" :";
			   	   	$detail[0]="ไม่มีการเปลี่ยนแปลง";
				
					 $save_detail=$conj.$detail[0];
				   
			   }else{
			   	$conj="ดังนี้ ";

			   foreach($arr_key as $key=>$value){			
				switch($value){
					case "Name";
						$i=$i+1;
						$detail[$i]="ชื่อจาก ".$item['Name']." เป็น ".$_POST['NameUser'];
						break;
					case "lastname";
						$i=$i+1;
						$detail[$i]="นามสกุลจาก ".$item['lastname']." เป็น ".$_POST['lastname'];
						break;
			
					case "UserGroupID";
						$i=$i+1;
						$name1['usergroupname']=GetOne("usergroupname","id",$item['UserGroupID'],"usergroup");
						$name2['usergroupname']=GetOne("usergroupname","id",$_POST['UserID'],"usergroup");
						$detail[$i]="สิทธิ์การใช้งานจาก ".$name1['usergroupname']." เป็น ".$name2['usergroupname'];
						break;
					case "DepartmentID";
						$i=$i+1;
						$name1['deptname']=GetOne("deptname","id",$item['DepartmentID'],"department");
						$name2['deptname']=GetOne("deptname","id",$_POST['Department'],"department");
						$detail[$i]="กรมจาก ".$name1['deptname']." เป็น ".$name2['deptname'];
						break;
					case "DivisionID";
						$i=$i+1;
						$name1['divisionname']=GetOne("divisionname","id",$item['DivisionID'],"division");
						$name2['divisionname']=GetOne("divisionname","id",$_POST['Division'],"division");
						$detail[$i]="กอง/สำนักจาก ".$name1['divisionname']." เป็น ".$name2['divisionname'];
						break;
					case "GroupID";
						$i=$i+1;
						$name1['groupname']=GetOne("groupname","id",$item['GroupID'],"hd_section");
						$name2['groupname']=GetOne("groupname","id",$_POST['section'],"hd_section");
						
						$detail[$i]="กลุ่ม/ฝ่ายจาก ".$name1['groupname']." เป็น ".$name2['groupname'];
						break;
					case "HumanType";
						$i=$i+1;
						$name1['humanname']=GetOne("humanname","id",$item['HumanType'],"humantype");
						$name2['humanname']=GetOne("humanname","id",$_POST['human'],"humantype");
						$detail[$i]="ประเภทบุคลากรจาก ".$name1['humanname']." เป็น ".$name2['humanname'];
						break;
					case "Email";
						$i=$i+1;
						$detail[$i]="อีเมล์จาก ".$item['Email']." เป็น ".$_POST['Email'];
						break;
						
					case "Password":
						$i=$i+1;
						$detail[$i]="รหัสผ่าน จาก ".$item['Password']." เป็น ".$arr_pass;
						break;	
				    
				}
			   }
		      $i=$i+1;		  
			  $save_detail=implode($detail,", ");
			  $save_detail=$conj.$save_detail;
			 }//close if $arr_key
	return $save_detail;
}//close function
		   
if(@$_SESSION['id']!='' )
{
	 $detail=get_detail(); 	  
	  $pm->AddLog(47,$detail);
	  if(@$_POST['Password']!='')$password = ", Password='".@$_POST['Password']."' ";
      $sql = "UPDATE informent SET ";
	  $sql .="  UserGroupID='".@$_POST['UserID']."', 		 Name='".@ucfirst($_POST['NameUser'])."',	lastname='".@ucfirst($_POST['lastname'])."'";
	  $sql .=", DepartmentID='".@$_POST['Department']."',	 DivisionID='".@$_POST['Division']."', 		GroupID='".@$_POST['section']."'";
	  $sql .=", HumanType='".@$_POST['human']."',			 IdCard='".@$_POST['IdCard']."', 			Tel='".@$_POST['Tel']."', Email='".@$_POST['Email']."'".@$password." WHERE ID=".@$_GET['id'];
 	
	
	mysql_query($sql) or die ("Error update profile: ".mysql_error());
	$_SESSION["show"]="show";
	$_SESSION["shw_type"]="edit";
	ReDirect('profile.php','top');
 
}
else{
  $sql = "select * from informent where Email= '".$_POST['Email']."' AND Password= '".$_POST['Password']."'";
  $result = mysql_query($sql) or die("Error Select :".mysql_error());
  $row = mysql_fetch_array($result);
	  if(!$row )
	  {
		echo "<script>alert('กรุณากรอกข้อมูลให้ถูกต้อง')</script>";
		ReDirect('index.php','self');
	  }
	  else
	  {
	
		$_SESSION["id"]=$row['ID'];	
		//$_SESSION["usertype"]=$row['usertypeid'];
		//$_SESSION["usergroupid"]=$row['UserGroupID'];
		$_SESSION["date_login"]=date('Y-m-d H:i:s');
		$_SESSION["ip"]=(getenv(@HTTP_X_FORWARDED_FOR)) ? getenv(@HTTP_X_FORWARDED_FOR):getenv(@REMOTE_ADDR);      
	    setSessionTime(3600); 
		$field="id,dates,detail,ipaddress,userid";
		$val ="'','".$_SESSION["date_login"]."','log in','".$_SESSION["ip"]."','".$_SESSION["id"]."'";
		$result=mysql_query("INSERT INTO hd_logs(".$field.") VALUES(".$val.")") or die("Invalid query: " . mysql_error()); 
		
	
	
	  //ReDirect('profile.php','top');
	   ReDirect('request_list.php','top');
		
	   }
}
?>