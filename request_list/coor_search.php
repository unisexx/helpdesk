<?php  
	include "../include/session_config.php";
	include "../include/config.php";
  	include "../include/function.php";
  	

		db_connect();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="../js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/other.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css" />

<script type="text/javascript">
	var glo_id;
	function get_id(user_id){		
		glo_id=user_id;	
		
	}
   function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,'');
	}


	$(document).ready(function(){
		$('[name=sele]').live('click',function(){
			$.ajax ({
				type:'GET',
				url:'<?php echo $host ?>request_list/function.php',
				data:'glo_id='+glo_id,	
				success:function(data){	
				
				  parent.$('[name=n_coordinatorid]').val(trim(data));
				  parent.$('[name=coordinatorid]').val(glo_id);				
				  parent.$.fancybox.close();
			
				}
			});
		 return false;
		});	
	});
	

</script>
</head>
<body>
<table class="tblist">
<tr>
	<th>ลำดับ</th>
    <th>รหัส</th>
    <th>ชื่อ-นามสกุล</th>
    <th>สิทธิ์ผู้ใช้งาน</th>
    <th>กอง/สำนัก</th>
    <th>กลุ่ม/ฝ่าย</th>
    <th></th>

</tr>
<?php
	 
	$sql="SELECT a.id as id,a.code as code ,concat(a.name,' ',a.lastname) as name,b.divisionname as division,c. groupname as section,d.usergroupname as groupname";
	$sql .=" from informent a ";
	$sql .=" inner join division b on a.divisionid=b.id";
	$sql .=" inner join section c on a.groupid=c.id";
	$sql .=" inner join usergroup d on a.usergroupid=d.id";
	$sql .=" WHERE a.usertypeid='2'";
	$result=mysql_query($sql);
	$i=1;
	while($item=mysql_fetch_assoc($result)):
	
?>
<tr>
	<td><?php echo $i++; ?></td>
    <td><?php echo $item['code']?></td>
    <td><?php echo $item['name']?></td>
    <td><?php echo $item['groupname']?></td>
    <td><?php echo $item['division']?></td>
    <td><?php echo $item['section']?></td>
    <td><input type="button" name="sele" id="sele" class="btn" value="เลือก" onclick="javascript:get_id(<?php echo $item['id']?>)" /></td>
   
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
