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
<title><?php echo $title;?></title>
<? include "_script.php";?>
</head>

<body>
<? include "_menu.php" ?>
<div id="page">
<?  // $pm = new UserLogin();
	// $item_10=$pm->GetPermission(8);	
	// if($item_10==""){$item_10['CanView']="";}
	 
	
	switch(@$_GET['act'])
	{
      case 'delete':
        include "user/query.php";
        break; 
		case 'query':
			include "user/query.php";
		break;
		case 'form':
			include "user/form.php";
			//include "user/form_test.php";
      	break;
      	case 'user':
		
/*			if(!isset($_SESSION["show"])){	
				$pm->AddLog(34);
			}*/
			include "user/list.php";   
		
          
		break;
		default :
/*			if(!isset($_SESSION["show"])){	
			$pm->AddLog(34);
			}*/
			include "user/list.php";   
		
			
		break;
	}
?>
</div>
</body>
</html>
