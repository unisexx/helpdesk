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
	//$pm= new UserLogin();
    //$item_9=$pm->GetPermission(9);
	//if($item_9==""){$item_9['CanView']="";}
	
	switch(@$_GET['act'])
	{
	    case 'delete':
        include "usergroup/query.php";
      break;  
			case 'query':
				include "usergroup/query.php";
			break;
			case 'form':
				include "usergroup/form.php";
			break;
			default :
					if(!isset($_SESSION["show"])){	
				  	$pm->AddLog(42);
					}
					include "usergroup/list.php";
					
		
 		    break;
	}
?>
</div>
</body>
</html>

