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
<? 
include "_menu.php";
$row = $currentUser;
 ?>
<div id="page">
<h3>ประวัติส่วนตัว</h3>
<?
  $pm = new UserLogin();

  switch(@$_GET['act'])
  {
    case "delete":
      include "profile/query.php";
      break;
    case "query":
	  if(!isset($_SESSION["show"])){	
	  	//$pm->AddLog(47);
	  }
      include "profile/query.php";
      break;
    default:
	  if(!isset($_SESSION["show"])){	
	  	$pm->AddLog(46);
	  }
      include "profile/form.php";
      break;
  }
?>
</div>
</body>
</html>
