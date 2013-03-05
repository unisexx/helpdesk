
<?php 
 
  include "../include/session_config.php";
  include "../include/config.php";
  include "../include/function.php";
  
  db_connect();
/*  $_GET['name']="group";
  $_GET['txtGroupName']="สำนักกกกกก";
  $_GET['deptid']="20";
  $_GET['divisionid']="9";
*/
function get_chk($field,$val,$tb){
	$sql="select $field from $tb where $field='$val'";	
	$result=mysql_query($sql); 
	$item=mysql_fetch_assoc($result);
	if($item[$field]){
		return "false";
	}else {
		return  "true";
	}
}


switch($_GET['name']){
	case "system":
		$field="systemname";
		$val=$_GET['txtSystem'];
		$tb="system";
		$chk=get_chk($field,$val,$tb);
		echo $chk;
	break;
	case "problem":
		$field="problemname";
		$val=$_GET['ProblemTypeName'];
		$tb="problemtype";
		$chk=get_chk($field,$val,$tb);
		echo $chk;
	break;
	case "department":
		$field="deptname";
		$val=$_GET['txtDeptName'];
		$tb="department";
		$chk=get_chk($field,$val,$tb);
		echo $chk;
		
	break;
	case "human":
		$field="humanname";
		$val=$_GET['HumanTypeName'];
		$tb="humantype";
		$chk=get_chk($field,$val,$tb);
		echo $chk;
	break;
	case "division":
		$sql="select divisionname from division where divisionname='".$_GET['txtDivisionName']."' and deptid='".$_GET['deptid']."'";
		$result=mysql_query($sql);
		$item=mysql_fetch_assoc($result);
		if($item['divisionname']){
			echo "false";
		}else{
			echo  "true";
		}
		
	break;
	case "group":
		$sql="select groupname from section where groupname='".$_GET['txtGroupName']."' and deptid='".$_GET['deptid']."' and divisionid='".$_GET['divisionid']."'";
		$result=mysql_query($sql);
		$item=mysql_fetch_assoc($result);
		if($item['groupname']){
			echo "false";
		}else{
			echo  "true";
		}
	break;
}
		
//$name=$this->user->get("select password from officers where password='".$_GET['password']."' AND profile_id=".$this->id);		
//		if($name){ echo "true";}else{ echo "false" ;}
 
 


?>
