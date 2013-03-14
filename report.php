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

	$action= new UserLogin();
	
	$item_8=$action->GetPermission(10);
	if($item_8==""){$item_8['CanView']="";}
	
	

	switch(@$_GET['act'])
	{
			case 'query':
				include "report/query.php";
			break;
					
			case 'list1':
			
				if($item_8['CanView']=="1"){
					if(!isset($_SESSION["show"])){	
						
						$detail="ชื่อ :รายงานสรุปการรับแจ้งปัญหา ";						
						$action->AddLog(28,$detail);
					}
				}
						include "report/list1.php";
				
			break;
			
			case 'list2':
				if($item_8['CanView']=="1"){
				if(!isset($_SESSION["show"])){	
						$detail="ชื่อ :รายงานสรุปประเภทปัญหาประจำเดือน";
						$action->AddLog(28,$detail);
					}
				}
					include "report/list2.php";
				
						
			break;

			case 'list3':
				if($item_8['CanView']=="1"){
				if(!isset($_SESSION["show"])){	
						$detail="ชื่อ :รายงานข้อผิดพลาดของระบบงาน";
						$action->AddLog(28,$detail);
					}
				}
				
				
					include "report/list3.php";

				
				break;
			
			case 'list4':
				if($item_8['CanView']=="1"){
				if(!isset($_SESSION["show"])){	
						$detail="ชื่อ : รายงานการบำรุงรักษา ระบบทะเบียนพัสดุ";
						$action->AddLog(28,$detail);
					}
				}
				
			
					include "report/list4.php";

				
			break;
						
			case 'list5':
				if($item_8['CanView']=="1"){
				if(!isset($_SESSION["show"])){	
						$detail="ชื่อ : รายงานรายละเอียดแจ้งปัญหาประจำเดือนุ";
						$action->AddLog(28,$detail);
					}
				}
				
			
					include "report/list5.php";

				
			break;

			case 'form4':
				
					
					include "report/form4.php";
						
			break;
			
      case 'query4':
        include "report/query4.php";
       break;
	}
?>
</div>
</body>

</html>