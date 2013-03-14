<?
  include "include/session_config.php";
  include "include/config.php";
  include "include/function.php";
  
    db_connect();
  	$field="id,dates,detail,ipaddress,userid";
	$val ="'','".date('Y-m-d H:i:s')."','log out','".$_SESSION["ip"]."','".$_SESSION["id"]."'";
	$result=mysql_query("INSERT INTO hd_logs(".$field.") VALUES(".$val.")") or die("Invalid query: " . mysql_error()); 
    session_destroy();
    ReDirect("index.php","top");
?>
 
