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
<?  include "_menu.php" ?>
<div id="page">
	<div class="inner">
<? 
	$pm= new UserLogin();

	
	switch(@$_GET['act'])
	{
			case 'form':
				switch($_SESSION['usertype'])
				{
					case "1": 	 //ผู้รับผิดชอบ
						echo "request_list/form.php";
						include "request_list/form.php";
						break;
					case "2": 	//ผู้ประสานงาน
						echo "request_list/form_coordinator.php";
						include "request_list/form_coordinator.php";
						break;
					case "4":	//ผู้ใช้งาน
						echo "request_list/form_user.php";
						include "request_list/form_user.php";
						break;
					case "3":  //เจ้าของระบบ
						//include "request_list/form_coordinator.php";
						echo "request_list/form_own.php";
						include "request_list/form_own.php";
						break;
				}
			break;
			case 'delete':				
				include "request_list/save.php";
				break;
			case 'del':	
				include "request_list/save.php";
				break;
			case 'save':
				include "request_list/save.php";
				break;
			default :
			   
	/*			if(!isset($_SESSION["show"])){	
						$pm->AddLog(38);
				}*/
				include "request_list/list.php";
 		    break;
	}
?>
	</div>
</div>

</body>
</html>