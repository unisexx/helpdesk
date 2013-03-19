<?php  
	  // include "../include/session_config.php";
	  // include "../include/config.php";
	  // include "../include/function.php";
	  // include "../include/class_userlogin.php";
	  $list=new UserLogin();
	  // db_connect();
$path="../uploads/file/";	
// set notifybar
 $_SESSION["show"]="show";
 if(@$_GET['act']=="delete"){
 	$_SESSION["shw_type"]="delete";
 }
 if($_POST['id']!=""){
 	$_SESSION["shw_type"]="edit";
 }else{
 	$_SESSION["shw_type"]="add";
 }
 	
//var_dump($_POST);exit;

function get_detail($id,$method=false)
{
		$name1['problemname']=GetOne("problemname","id",$_POST['problemtype'],"problemtype");
		$name2['systemname']=GetOne("systemname","id",$_POST['systemid'],"system");

		if($id!=""){			
			$field="code,problemtype,title,status,chk_send
			,send_note
			,active_date,send_date,new_date,operation_date,complete_date
			,systemid,orderid,responsibleid,coordinatorid,ownid
			,service,system_success,response_success";
			$result=mysql_query("select $field from request_lists where id='$id'");
			$item=mysql_fetch_assoc($result);
			
			$str=array("code"=>$_POST['code'],"problemtype"=>$_POST['problemtype'],"title"=>$_POST['title'],"status"=>$_POST['status'],"chk_send"=>@$_POST['chk_send']
					   ,"send_note"=>@$_POST['send_note']
					   ,"active_date"=>$_POST['active_date'],"send_date"=>$_POST['send_date'],"new_date"=>$_POST['new_date']
					   ,"operation_date"=>$_POST['operation_date'],"complete_date"=>$_POST['complete_date']
					   ,"systemid"=>$_POST['systemid'],"orderid"=>$_POST['orderid'],"responsibleid"=>@$_POST['responsibleid'],"coordinatorid"=>@$_POST['coordinatorid']
					   ,"ownid"=>$_POST['ownid'],"service"=>@$_POST['service'],"system_success"=>$_POST['system_success'],"response_success"=>@$_POST['response_success']
						);		
			
	
			$arr_key=array_diff($str,$item);		 
			if(empty($arr_key)){
					$arr_key =array_diff($item,$str);
			}
			
			if(empty($arr_key)){
				$conj="รหัส : ".$_POST['code'];
				$detail=" ไม่มีการเปลี่ยนแปลงใดๆ";
				$save_detail=$conj.$detail;
			}else{
				if($method=="post"){
					foreach($arr_key as $key=>$value){
						$detail[]="รหัส : ".$_POST['code'];
						$detail[]="หัวข้อ :" .$_POST['title'];
						$detail[]="ประเภทปัญหา :".$name1['problemname'];
						$detail[]="ระบบ :".$name2['systemname'];					
					}// foreach
				}else{
					$row=GetData("request_lists",$id);
					$name1['problemname']=GetOne("problemname","id",$row['problemtype'],"problemtype");
					$name2['systemname']=GetOne("systemname","id",$row['systemid'],"system");
						$detail[]="รหัส : ".$row['code'];
					$detail[]="หัวข้อ :" .$row['title'];
					$detail[]="ประเภทปัญหา :".$name1['problemname'];
					$detail[]="ระบบ :".$name2['systemname'];
				}//close method
			$detail=implode(", ",$detail);
			$save_detail="ดังนี้ : ".$detail;
			
			}//close if $arr_key
		
		
		}else{
			$detail[0]="รหัส : ".$_POST['code'];
			$detail[1]="หัวข้อ :" .$_POST['title'];
			$detail[2]="ประเภทปัญหา :".$name1['problemname'];
			$detail[3]="ระบบ :".$name2['systemname']	;
			
			$detail=implode(", ",$detail);
			$save_detail="ดังนี้ : ".$detail;
			
		}//close if $id
		

				
	return $save_detail; 
}//close function
	



if(@$_GET['act']=='delete'){
	//$detail=get_detail();
	$detail=get_detail($_GET['id'],"get");
	mysql_query("DELETE FROM request_lists WHERE id=".$_GET['id']);
	mysql_query("DELETE FROM request_list_details WHERE title_id=".$_GET['id']);
	mysql_query("DELETE FROM request_list_note WHERE request_lists_id=".$_GET['id']) or die("del request_list_note :".mysql_error());
	$item=GetData("request_list_details",$_GET['id']);
	if($item)
	{
		unlink ($path.@$item['fileatth']);
	}
	$list->AddLog(41,$detail);
	ReDirect($host."request_list.php",'top');
}else{
	
//เช็ค status กรณีติีกเสร็จทั้งสองฝ่าย
if(@$_POST['chk_send']=="send_wait"){
	if(@$_POST['system_success']=="1" && @$_POST['response_success']=="1"){
	$_POST['status']="3";
	//เสร็จเรียบร้อยแล้ว
	}else if(@$_POST['system_success']!="1" || $_POST['response_success']!="1"){
		$_POST['status']="4";
		//ส่งต่อการดำเนินการ
	}
}else if(@$_POST['chk_send']=="send"){
	if($_POST['system_success']=="1"){
		$_POST['status']="3";
	}else{
		$_POST['status']="4";
	}
}	
	
switch(@$_POST['status'])
{
	case "1":
		$_POST['new_date']=($_POST['new_date']=="0000-00-00 00:00:00" || $_POST['new_date']=="" ||$_POST['new_date']==NULL)?date('Y-m-d H:i:s'):$_POST['new_date'];	
		break;
	case "2":
		$_POST['operation_date']=($_POST['operation_date']=="0000-00-00 00:00:00" || $_POST['operation_date']=="" ||$_POST['operation_date']==NULL)?date('Y-m-d H:i:s'):$_POST['operation_date'];
		break;
	case "3":
		$_POST['complete_date']=($_POST['complete_date']=="0000-00-00 00:00:00" || $_POST['complete_date']=="" ||$_POST['complete_date']==NULL)?date('Y-m-d H:i:s'):$_POST['complete_date'];
		break;

}

//
if((@$_POST['chk_send']=='send' || @$_POST['chk_send']=='send_wait') && @$_POST['send_date']=="0000-00-00 00:00:00"){
	$_POST['send_date']=date('Y-m-d H:i:s');
}


if(($_POST['active_date']=="0000-00-00 00:00:00" || $_POST['active_date']=="") && $_SESSION['usertype']==1){
	$_POST['active_date']=date('Y-m-d H:i:s');
}

// code --> part#1
$result=mysql_query("select * from problemtype where id='".@$_POST['problemtype']."'");
$item=mysql_fetch_assoc($result);
$abbr=$item['abbr'];
$part_code=$item['abbr'].date('Ym');
//code --> part#2
$sql="select  * from request_lists  where  substr(code,1,7)='".$part_code."'";
$result=mysql_query($sql);
$n_row = mysql_num_rows($result);
$n_row=$n_row+1;

//code -->part#3  
switch (strlen($n_row)){
	case "1":
		$rec_no="00".$n_row; break;
	case "2":
		$rec_no="0".$n_row;  break;
	default:
		$rec_no=$n_row;      break;
}

//code  -->aggreation
	
	if($_POST['code']!=""){
		$_POST['code']=$abbr.trim(substr($_POST['code'],1));
		//print $_POST['code'];exit;
	
	}else{
		$_POST['code']=$abbr.date('Ym').str_pad($n_row, 3, "0", STR_PAD_LEFT);
	}
	

		
			


if(@$_POST['id']==""){
	
	$field  ="problemtype,title,status,chk_send";
	$field .=",send_note";
	$field .=",new_date,operation_date,complete_date";
	$field .=",orderid,responsibleid,coordinatorid,systemid";
	$field .=",service,code,send_date,active_date,system_success,response_success,ownid";
	$field .=",operation_detail,result,test,future,admin_id,rso_name,rso_date,rso_channel,servicetype_id";
				
	$rso_date = ($_POST['rso_date'])?Date2DB($_POST['rso_date']):''; 
	// echo $_SESSION['usertype'];
	switch($_SESSION['usertype'])
		{
			case "1": 	
			//ผู้รับผิดชอบ
				$val  ="'".$_POST['problemtype']."','".$_POST['title']."','".$_POST['status']."','".@$_POST['chk_send']."'";						
				$val .=",'".@$_POST['send_note']."'";
				$val .=",'".$_POST['new_date']."','".$_POST['operation_date']."','".$_POST['complete_date']."'";
				$val .=",'".$_POST['orderid']."','".@$_POST['responsibleid']."','".@$_POST['coordinatorid']."','".$_POST['systemid']."','".@$_POST['service']."'";
				$val .=",'".$_POST['code']."','".@$_POST['send_date']."','".@$_POST['active_date']."'";
				$val .=",'".@$_POST['system_success']."','".@$_POST['response_success']."',''";
				$val .=",'".@$_POST['operation_detail']."','".@$_POST['result']."','".@$_POST['test']."','".@$_POST['future']."','".@$_POST['admin_id']."','".@$_POST['rso_name']."','".@$rso_date."','".@$_POST['rso_channel']."','".@$_POST['servicetype_id']."'";
				break;
			
			case "2": 	
			//ผู้ประสานงาน
				$val="'".$_POST['problemtype']."','".$_POST['title']."','".$_POST['status']."',''";						
				$val .=",''";
				$val .=",'".$_POST['new_date']."','',''";
				$val .=",'".$_POST['orderid']."','','".$_POST['coordinatorid']."','".$_POST['systemid']."','".$_POST['service']."'";
				$val .=",'".$_POST['code']."','','','','',''";
				break;
			case "4":	
			//ผู้ใช้งาน
				$val="'".$_POST['problemtype']."','".$_POST['title']."','".$_POST['status']."',''";						
				$val  .=",''";
				$val  .=",'".$_POST['new_date']."','',''";
				$val  .=",'".$_POST['orderid']."','','','".$_POST['systemid']."','".$_POST['service']."'";
				$val .=",'".$_POST['code']."','','','','',''";
				break;
			case "3":  
			//เจ้าของระบบ
				$val="'".$_POST['problemtype']."','".$_POST['title']."','".$_POST['status']."',''";						
				$val .=",''";
				$val .=",'".$_POST['new_date']."','',''";
				$val .=",'".$_POST['orderid']."','','','".$_POST['systemid']."','".$_POST['service']."'";
				$val .=",'".$_POST['code']."','',''";
				$val .=",'".@$_POST['system_success']."','".@$_POST['response_success']."','".$_POST['ownid']."'";
				break;
		}
	
			// echo "INSERT INTO request_lists(".$field.") VALUES(".$val.")";
			mysql_query("LOCK TABLES request_lists WRITE"); 
			mysql_query("SET AUTOCOMMIT = 0");	
	
			mysql_query("INSERT INTO request_lists(".$field.") VALUES(".$val.")") or die("Error insert :".mysql_error()); 
			$title_id = mysql_insert_id(); 
			mysql_query("COMMIT");
			mysql_query("UNLOCK TABLES");	
			
	
			
	for($i=1;$i<=$_POST['k_before'];$i++){

		$sql="INSERT INTO request_list_details(detail,title_id) VALUE('".$_POST['detail'.$i]."','".$title_id."')" ;				
		mysql_query($sql) or die("Error 1: ".mysql_error());	
		$insert_id = mysql_insert_id(); 
		
		$sql="UPDATE request_list_details SET url='".$_POST['url'.$i]."',title_id=".$title_id." WHERE id=".$insert_id;				
		mysql_query($sql) or die("Error 2 : ".mysql_error());
	

		
	   $path="../uploads/file/";	
		// upload file
		//var_dump(isset($_FILES['fileatth'.$i]));exit;
		 if(isset($_FILES['fileatth'.$i]) || $_FILES['fileatth'.$i]['name']!=""){
				 
			$sur = strrchr(@$_FILES["fileatth".$i]["name"], "."); //ตัดนามสกุลไฟล์เก็บไว้
			
				$arr = (Date("dmy_His").$i.$sur); //ตั้งเป็น วันที่_เวลา.นามสกุล			
				$sql="UPDATE request_list_details SET fileatth='".$arr."',title_id=".$title_id." WHERE id=".$insert_id;	
			
						
			
			  if (@$_FILES["fileatth".$i]["error"] > 0)
				{
				$error_message = @$error_types[@$_FILES['fileatth']['error'][$i]];
				//echo "size: " .$_FILES["fileatth"]['size'][$i];
				//echo "Error: " .@$_FILES["fileatth"]["error"][$i] ." :".$error_message. "<br>";
				//exit;
				}
			  else
				{						
						if (file_exists($path.@$_FILES["fileatth".$i]["name"])) 
						{
							//echo "file exists";
							unlink ($path.@$_FILES["fileatth".$i]["name"]);
						}else{
							//$sur = strrchr(@$_FILES["fileatth".$i]["name"], "."); //ตัดนามสกุลไฟล์เก็บไว้
							//$filename = (Date("dmy_His").$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล		
							//var_dump($path,$arr);exit;
							//copy($_FILES["fileatth".$i]["tmp_name"],$path.@$arr);
							move_uploaded_file($_FILES["fileatth".$i]["tmp_name"],$path.@$arr);							
						}
				}
				mysql_query($sql) or die("Error 3: ".mysql_error());
			}//close if isset

	}//close for $_POST['k_before']
	
			$detail=get_detail("");
			$list->AddLog(39,$detail);


}
else{
	
	$_POST['new_date'] = Date2DB(@$_POST['new_date_stamp']).' '.$_POST['new_hour'].':'.$_POST['new_min'].':'.$_POST['new_sec'];
	$_POST['operation_date'] = Date2DB(@$_POST['operation_date_stamp']).' '.$_POST['operation_hour'].':'.$_POST['operation_min'].':'.$_POST['operation_sec'];
	$_POST['complete_date'] = Date2DB(@$_POST['complete_date_stamp']).' '.$_POST['complete_hour'].':'.$_POST['complete_min'].':'.$_POST['complete_sec'];
	
	$detail=get_detail($_POST['id'],"post");
	$val  ="id='".$_POST['id']."'";
	$val .=",problemtype='".$_POST['problemtype']."'";
	$val .=",status='".$_POST['status']."'";
	$val .=",chk_send='".@$_POST['chk_send']."'";
	$val .=",send_note='".@$_POST['send_note']."'";
	$val .=",send_date='".$_POST['send_date']."'";
	$val .=",new_date='".$_POST['new_date']."'";
	$val .=",operation_date='".@$_POST['operation_date']."'";
	$val .=",complete_date='".@$_POST['complete_date']."'";
	$val .=",orderid='".$_POST['orderid']."'";
	$val .=",responsibleid='".@$_POST['responsibleid']."'";
	$val .=",coordinatorid='".@$_POST['coordinatorid']."'";
	$val .=",systemid='".@$_POST['systemid']."'";
	$val .=",service='".@$_POST['service']."'";
	$val .=",title='".@$_POST['title']."'";
	$val .=",code='".@$_POST['code']."'";
	$val .=",active_date='".@$_POST['active_date']."'";
	$val .=",system_success='".@$_POST['system_success']."'";
	$val .=",response_success='".@$_POST['response_success']."'";
	$val .=",ownid='".@$_POST['ownid']."'";
	$val .=",operation_detail='".@$_POST['operation_detail']."'";
	$val .=",result='".@$_POST['result']."'";
	$val .=",test='".@$_POST['test']."'";
	$val .=",future='".@$_POST['future']."'";
	$val .=",admin_id='".@$_POST['admin_id']."'";
	$val .=",rso_name='".@$_POST['rso_name']."'";
	$val .=",rso_date='".Date2DB(@$_POST['rso_date'])."'";
	$val .=",rso_channel='".@$_POST['rso_channel']."'";
	$val .=",servicetype_id='".@$_POST['servicetype_id']."'";
	$sql="UPDATE request_lists SET ".$val." WHERE id=".$_POST['id'];	
	mysql_query($sql)or die("Error update :".mysql_error());
	
	// echo @$_POST['operation_detail'];
	// echo $sql;
	
    $txt_email="(update)";
	

	mysql_query("delete from request_list_details where title_id='".$_POST['id']."'") or die("Error delete :".mysql_error());
	for($i=1;$i<=$_POST['k_before'];$i++){

		$sql="INSERT INTO request_list_details(detail,title_id) VALUE('".$_POST['detail'.$i]."','".$_POST['id']."')" ;				
		mysql_query($sql) or die("Error 1: ".mysql_error());	
		$insert_id = mysql_insert_id(); 
		
		$sql="UPDATE request_list_details SET url='".$_POST['url'.$i]."',title_id=".$_POST['id']." WHERE id=".$insert_id;				
		mysql_query($sql) or die("Error 2 : ".mysql_error());
	   
	  
		
	   if($_FILES['fileatth'.$i]['name']==""){
		   
		   $arr=@$_POST['fileatth'.$i];
	   }else{
	   	   
		   $sur = strrchr(@$_FILES["fileatth".$i]["name"], "."); //ตัดนามสกุลไฟล์เก็บไว้
		   $arr = (Date("dmy_His").$i.$sur); //เป็น วันที่_เวลา.นามสกุล		
	   }
	   
	   	//var_dump($arr);exit;
		$sql="UPDATE request_list_details SET fileatth='".$arr."',title_id=".$_POST['id']." WHERE id=".$insert_id;				
	    // upload file
		
		 if(isset($_FILES['fileatth'.$i]) || $_FILES['fileatth'.$i]!=""){
			  
			 
			  if (@$_FILES["fileatth".$i]["error"] > 0)
				{
				$error_message = @$error_types[@$_FILES['fileatth']['error'][$i]];
				//echo "size: " .$_FILES["fileatth"]['size'][$i];
				//echo "Error: " .@$_FILES["fileatth"]["error"][$i] ." :".$error_message. "<br>";
				//exit;
				}
			  else
				{						
						if (file_exists($path.@$_FILES["fileatth".$i]["name"])) 
						{

							unlink ($path.@$_FILES["fileatth".$i]["name"]);
						}else{
	
							move_uploaded_file(@$_FILES["fileatth".$i]["tmp_name"],$path.@$arr);
												
							
						}
				}
			}//close if isset
		mysql_query($sql) or die("Error 3: ".mysql_error());				
	}
	
	
	$list->AddLog(40,$detail);
	
}
	
	//----------------- dear  ----------------
			$zid = ($_POST['id']=="")?$title_id:$_POST['id'];
			
			$user_id = $_SESSION['id'];
			$currentUser = GetData("informent",$_SESSION['id']);
			$username = $currentUser['Name'];
			$noteadd = $_POST['request_note'];
			$nowdate = date('Y-m-d H:i:s');
			//echo"zid = $zid<br>user_id = $user_id<br>noteadd = $noteadd";
			if($noteadd !=""){
			$sql ="INSERT INTO request_list_note (request_lists_id, informent_id, informent_name, detail, date)";
			$sql.=" VALUES ('$zid', '$user_id', '$username', '$noteadd', '$nowdate')";
			//var_dump($sql);exit;
			mysql_query($sql) or die("dear error:".mysql_error());
			}

	
	
	
	
//ส่งเมล์

if($_POST['send_date']!="0000-00-00 00:00:00"){
	$strtime_send=substr(GetThaiDate(@$_POST['send_date'],1,1),10,6)." น.";
}else{
    $strtime_send="-";
}
if($_POST['active_date']!="0000-00-00 00:00:00"){
	$strtime_active=substr(GetThaiDate(@$_POST['active_date'],1,1),10,6)." น.";
}else{
    $strtime_active="-";
}
if($_POST['operation_date']!="0000-00-00 00:00:00"){
	$strtime_operation=substr(GetThaiDate(@$_POST['operation_date'],1,1),10,6)." น.";
}else{
    $strtime_operation="-";
}
if($_POST['complete_date']!="0000-00-00 00:00:00"){
	$strtime_complete=substr(GetThaiDate(@$_POST['complete_date'],1,1),10,6)." น.";
}else{
    $strtime_complete="-";
}	

$width_p="800px";
$width="150px";
$label="{display:inline-block;width:$width;align:left;text-align:right;}";
$label_content="{display:inline-block;width:$width;align:left;text-align:left;}";
$div="width:800px;border-width:1px;border-color:#333;";

$m  ="<div style=width:800px;border-width:1px;border-color:#333;";
$m .="<p style=width:$width_p;align:center;><font face=Tahoma,sans-serif color='#470D7B' ><b>ระบบแจ้งปัญหาการใช้ระบบงาน</b></font><p/>";
$m .="<span >";
$m .="<p><label style=$label><b>รหัสการแจ้ง : </b></label><span style=$label_content>".$_POST['code']."</span>";
$m .="<label style=$label><b>สถานะ : </b></label><span style=$label_content>".GetProblemStatus($_POST['status'],false)."</span></p>";

$m .="<p><label style=$label><b>ระบบ : </b></label><span style=$label_content>".GetSystem($_POST['systemid'],true)."</span>";
$m .="<label style=$label><b>ประเภทปัญหา : </b></label><span style=$label_content>".GetProblemType($_POST['problemtype'])."</span></p>";
$m .="<p><label  style=$label><b>หัวข้อ : </b></label><span style=$label_content>".$_POST['title']."</span></p>";
for($i=1;$i<=$_POST['k_before'];$i++){
$m .="<p><label  style=$label><b>รายละเอียด : </b></label><span style=$label_content>".$_POST['detail'.$i]."</span></p>";
$m .="<p><label><b>url : </b></label><span style=$label_content>".$_POST['url'.$i]."</span></p>";
 }
$m .="<p><label style=$label><b>ผู้แจ้ง : </b></label><span style=$label_content>".GetUser($_POST['orderid'],'user')."</span>";

$m .="<p><label style=$label><b>วันที่แจ้งใหม่ : </b></label><span style=$label_content>".DB2Date($_POST['new_date'])."</span>";
$m .="<label style=$label><b>เวลา : </b></label><span style=$label_content>". substr(GetThaiDate($_POST['new_date'],1,1),10,6)." น.</span></p>";



$m .="<p><label style=$label><b>วันที่ดำเนินการ : </b></label><span style=$label_content>".DB2Date(@$_POST['operation_date'])."</span>";
$m .="<label  style=$label><b>เวลา : </b></label><span style=$label_content>".  $strtime_operation."</span></p>";
$m .="<p><label style=$label><b>วันที่ส่งดำเนินการ : </b></label><span style=$label_content>".DB2Date(@$_POST['send_date'])."</span>";

$m .="<label  style=$label><b>เวลา : </b></label><span style=$label_content>". $strtime_send."</span></p>";

$m .="<p><label style=$label><b>วันที่แก้ไขเรียบร้อย :</b></label><span style=$label_content>".DB2Date(@$_POST['complete_date'])."</span>";
$m .="<label  style=$label><b>เวลา : </b></label><span style=$label_content>". $strtime_complete."</span></p>";

$m .="<p><label style=$label><b>บันทึกการสนทนา</b></label>";
$m .="<p style=margin-left:30px>";
//---------- dear ------------
$sql = "select * from request_list_note where request_lists_id = '$zid' order by id asc";				
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	$m.="<font color=#65358F>$row[informent_name] : $row[detail] <span style=font-size:10px;>($row[date])</span></font><br>";
}
$m .="</p>";	

$m .="<div><a href='http://crm.favouritedesign.com'>http://crm.favouritedesign.com</a></div>";
$m .="</div>";


		
		if(@$_POST['chk_send']=="send" || @$_POST['chk_send']=="send_wait"){
			//ส่งให้เจ้าของระบบ	operation_detail 
		
			if($_POST['responsibleid']!=0){
				$sysid=GetSystem($_POST['orderid'],false);
				$sql="select email from user_systems a";
				$sql .=" left join  informent b on a.userid=b.id";
				$sql .=" WHERE systemid='".$sysid."' and usertypeid=3";
				$result=mysql_query($sql) or die("error".mysql_error());
				$num_rows = mysql_num_rows($result);
				
				$i=0;	
					if ($num_rows>0)
					{
						while($item=mysql_fetch_assoc($result)){
							
							$str[$i]=$item['email'];
							$i++;
						}
						$j=$i;
						 //และส่งให้ผู้รับผิดชอบด้วย
						$email_response=GetEmail($_POST['responsibleid']);
						if(!empty($str)){							
							$j++;
							$str[$j]=$email_response;
							//$to=$email_response;
						}else{ $str[$i]=$email_response;}						
					}

			}
		}elseif(@$_POST['chk_send']!="send" || @$_POST['chk_send']!="send_wait" ){
		$i=0;	
		
		 //ระบบส่งให้ผู้รับผิดชอบทั้งหมด			
			if(@$_POST['responsibleid']==""){
						 
				//if($_SESSION["usertype"]!=1){
					$result=mysql_query("select email from informent where usertypeid='1'") or die("Error".mysql_error());					
					$num=mysql_num_rows($result);													
					if($num>0){						
						while($item=mysql_fetch_assoc($result)){				
							$str[$i]=$item['email'];
							$i++;	}
					}else{
						//echo $item['email'];
						//$item=mysql_fetch_assoc($result);
						//$str[$i]=$item['email'];
					}
				//}					
			}else{
				// ระบบส่งให้ผู้รับผิดชอบ....ที่รับเรื่อง				
				$str[$i]=GetEmail($_POST['responsibleid']);
			}
			$j=$i;
			//กรณีมีผู้ประสานงาน
			if(@$_POST['coordinatorid']!=0){
				 $j++;
				  $str[$j]=GetEmail($_POST['coordinatorid']);
			}			
		}
			//และระบบส่งให้ผู้แจ้งทุกครั้งที่มีความคืบหน้า
			$email_orderid=GetEmail($_POST['orderid']);				
		 // echo $email_orderid;
		 
			if(!in_array ($email_orderid,$str)){
				$j++;
				$str[$j]=$email_orderid;	
					
			}					

		
		

		
			//var_dump($str);exit;
		
		if($_POST['status']==1){
			$subject="ระบบแจ้งปัญหาการใช้งาน รหัส ".$_POST['code'];
		}else{
			$subject="ความคืบหน้าระบบแจ้งปัญหาการใช้งาน รหัส ".$_POST['code'];
		}
		$subject=$subject." สถานะ ".GetProblemStatus($_POST['status'],false)." ".@$txt_email;


			###### PHPMailer #### 

			
			require_once("PHPMailer_v5.1/class.phpmailer.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path		
			require_once("PHPMailer_v5.1/class.smtp.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path	
			$mail = new PHPMailer();		
			$mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้                        		
			$mail->From     = "mail.favouritedesign.com";  //  account e-mail ของเราที่ใช้ในการส่งอีเมล
			$mail->FromName = "crm@favouritedesign.com"; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
			//$mail->AddAddress('clinton.toey@gmail.com');            // Email ปลายทางที่เราต้องการส่ง
			//$mail->AddAddress('phionixz@hotmail.com'); 
			//$mail->AddAddress('tanawat.k@m-society.go.th');
			//$mail->AddAddress('t_auchz@hotmail.com');
			//$mail->AddAddress('spaical_4@hotmail.com');
			//$mail->AddAddress('chamroen.n@m-society.go.th');			
			// for($i=0;$i<=count($str);$i++){
				// $mail->AddAddress($str[$i]); 
			// }
// 			  		
			// $mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
			// $mail->Subject     =  $subject;        // หัวข้อที่จะส่ง
			// $mail->Body     = $m;                   // ข้อความ ที่จะส่ง
			// $mail->SMTPDebug = false;
			// $mail->do_debug = 0;

			// $flgSend = $mail->send();       
// 		
// 	
			// ##### PHPMailer #### 	
			// if(@$flgSend)
			// {								
				 ReDirect($host."request_list.php",'top');			
			// }
			// else 
			// {
				// print('CANNOT SEND EMAIL');
			// }
	


 } // close act



			
  //-------------------------file-------------------------

						

	/*		
			  for($i=1;$i<=$_POST['k_before'];$i++){
				  if(isset($_FILES['fileatth'.$i])){
					  if (@$_FILES["fileatth".$i]["error"] > 0)
						{
						$error_message = $error_types[$_FILES['fileatth']['error'][$i]];
						//echo "size: " .$_FILES["fileatth"]['size'][$i];
						//echo "Error: " .@$_FILES["fileatth"]["error"][$i] ." :".$error_message. "<br>";
						//exit;
						}
					  else
						{						
								if (file_exists($path.@$_FILES["fileatth".$i]["name"])) 
								{
									//echo "file exists";
									unlink ($path.@$_FILES["fileatth".$i]["name"]);
								}else{
									$sur = strrchr(@$_FILES["fileatth".$i]["name"], "."); //ตัดนามสกุลไฟล์เก็บไว้
									$filename = (Date("dmy_His").$sur); //ผมตั้งเป็น วันที่_เวลา.นามสกุล									
									copy(@$_FILES["fileatth".$i]["tmp_name"],$path.@$filename);							
								}
						}
				 }//close if isset
			  }//close for*/
			  
  //-------------------------file-------------------------	
	
	

?>
