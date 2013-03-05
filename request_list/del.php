
<?php 
	  include "../include/session_config.php";
	  include "../include/config.php";
	  include "../include/function.php";
	  include "../include/class_userlogin.php";
	  $user=new UserLogin();
	  $path="../uploads/file/";	
	    db_connect();
		if(@$_GET['act']=="del_file"){
			
			$result=mysql_query("SELECT * FROM request_list_details WHERE id=".$_GET['detail_id']) or die("Error select list_detail:".mysql_error());
			$item=mysql_fetch_assoc($result);
			//if($item){
			if ($item !="" && file_exists($path.$item)){ 
				$path="../uploads/file/";
				unlink ($path.@$item['fileatth']);
				
			}
			mysql_query("UPDATE request_list_details SET fileatth='' WHERE id=".$_GET['detail_id']) or die("Error del detail:".mysql_error());
			
			
		}else
		{
			mysql_query("DELETE FROM request_list_details WHERE id=".$_GET['detail_id']) or die("Error del detail:".mysql_error());	
		}
		$user->AddLog(40);
		//exit;
		ReDirect($host."request_list.php?act=form&id=".$_GET['id'],'self');
?>


	
