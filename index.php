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

<link rel="stylesheet" type="text/css" href="css/template.css"/>
</head>

<body>

<div id="page">
<? switch(@$_GET['act'])
  {
      case 'query':
        include "profile/query.php";
      break;
      default :
        include "profile/login.php";
        break;
  }
?>
</div>
</body>

</html>
