<?
  include "include/session_config.php";
  include "include/config.php";
  include "include/function.php";
  include "include/class_userlogin.php";
  db_connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<? include "_script.php";?>
</head>

<body>
<? include "_menu.php" ?>
<div id="page">
<? 
	
	$chk_log= new UserLogin();
	//ตรวจสอบ permission

/*	$item_1=$chk_log->GetPermission(1);//ประเภทปัญหา
	if($item_1==""){$item_1['CanView']="";}
	$item_2=$chk_log->GetPermission(2);//กรม
	if($item_2==""){$item_2['CanView']="";}
	$item_3=$chk_log->GetPermission(3);//กอง/สำนักงาน
	if($item_3==""){$item_3['CanView']="";}
	$item_4=$chk_log->GetPermission(4);//กลุ่ม/ฝ่าย
	if($item_4==""){$item_4['CanView']="";}
	$item_5=$chk_log->GetPermission(5);//ประเภทบุคลากร
	if($item_5==""){$item_5['CanView']="";}
	$item_6=$chk_log->GetPermission(6);//ระบบงาน
	if($item_6==""){$item_6['CanView']="";}
	$item_7=$chk_log->GetPermission(7);//server
	if($item_7==""){$item_7['CanView']="";}
*/
	

	
	switch($_GET['act'])
	{
		    case 'delete':
				include "setting/query.php";
		    break;
			case 'query':
				include "setting/query.php";
			break;
			
			case 'problemlist':
							
					if(!isset($_SESSION["show"])){				
						$chk_log->AddLog(0);						
					}
					include "setting/problem_type_list.php";
			
			break;
			case 'problemform':
					include "setting/problem_type_form.php";					
			break;
			
			case 'departmentlist':
				
					if(!isset($_SESSION["show"])){	
						$chk_log->AddLog(4);
					}
					include "setting/department_list.php";
			
				
			break;
			case 'departmentform':				
					include "setting/department_form.php";
				break;
			
			case 'divisionlist':
				
					if(!isset($_SESSION["show"])){	
					$chk_log->AddLog(8);
					}
					include "setting/division_list.php";
				
				
			break;
			case 'divisionform':			
					include "setting/division_form.php";			
			break;
			
			case 'grouplist':
				
					if(!isset($_SESSION["show"])){	
					$chk_log->AddLog(12);
					}
					include "setting/group_list.php";
				
				
			break;
			case 'groupform':			
					include "setting/group_form.php";
			break;
			
			case 'humantypelist':			
				
					if(!isset($_SESSION["show"])){	
					$chk_log->AddLog(16);
					}
					include "setting/human_type_list.php";
				
				
			break;
			case 'humantypeform':				
					include "setting/human_type_form.php";
			break;
			
			case 'systemlist':
				
					if(!isset($_SESSION["show"])){	
					$chk_log->AddLog(20);
					}
					include "setting/system_list.php";
				
				
				
			break;
			case 'systemform':
				include "setting/system_form.php";
			break;
			
			case 'serverlist':
				
					if(!isset($_SESSION["show"])){	
					$chk_log->AddLog(24);
					}
					include "setting/server_list.php";
				
				
				
			break;
			case 'serverform':
				include "setting/server_form.php";
			break;
	}
?>

</div>
</body>
</html>