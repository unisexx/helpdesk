<?php  
	include "../include/config.php";
  	include "../include/function.php";
  	include "../include/session_config.php";

		db_connect();
	
		echo GetUser($_GET['glo_id'],'user');
		
?>
