
<?php 
 
  include "../include/session_config.php";
  include "../include/config.php";
  include "../include/function.php";
  
  db_connect();

	$dept=$_GET['dept'];
	$div=$_GET['division'];
	$gpname=$_GET['gpname'];
	
  	$sql="select id from section where deptid='".$dept."' and divisionid='".$div."' and groupname='".$gpname."'";	
	$result=mysql_query($sql) or die("Error chk dup: ".mysql_error());   
	$num=mysql_num_rows($result);
	if($num==0){
		echo "ok";
	}else if($num==1){
		echo "not";
	}
   		
		

 
 


?>
