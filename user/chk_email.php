
<?php 
 
  include "../include/session_config.php";
  include "../include/config.php";
  include "../include/function.php";
  
  db_connect();


function chk_email($l ,$n,$i,$id=false){
	
	$lastname=$l;
	$name=$n;
	$lastname_cut=substr($lastname,0,$i);
	$email=strtolower($name).".".strtolower($lastname_cut);

	$chk_id=($id!="")? "id <>".$id." and ":"";
  	$sql="select email from informent where ".$chk_id."  substr(email,1,(instr(email,'@'))-1)='".$email."'";
  	$result=mysql_query($sql) or die("Error email: ".mysql_error());
  	$item=mysql_fetch_assoc($result);
   		if($item['email']!=NULL || $item['email']!="")
		{
 			$i++;
			return chk_email($lastname,$name,$i);
 
 		}else{
			
			
			echo $email;
		}
		
}


 $name=$_GET['name'];
 $lastname=$_GET['lastname'];
 $id=$_GET['id'];
 $email=chk_email($lastname,$name,1,$id);
 
 


?>
