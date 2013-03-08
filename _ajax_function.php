<?php
include ('include/adodb_connect.php');

if($_GET){
	if($_GET['action'] == 'del_ma_user'){
		$db->Execute("delete from ma_user where id=".$_GET['id']);  
		if(!$db){ echo"failed.";} else { echo"OK";}
	}
	
	if($_GET['action'] == 'del_admin_user'){
		$db->Execute("delete from admin_user where id=".$_GET['id']);  
		if(!$db){ echo"failed.";} else { echo"OK";}
	}
	
	if($_GET['action'] == 'get_ma_user'){
		$rs = $db->GetAll("SELECT * FROM ma_user where system_id = ".$_GET['id']." ORDER BY id ASC");
		if($rs){
			echo '<style>table.nowidth td{width:auto !important;}table.nowidth th{background:#ddcded;}</style>';
			echo '<table class="nowidth">';
			echo '<tr><th>ชื่อ-สกุล</th><th>เบอร์ติดต่อ</th><th>อีเมล์</th><th>ชื่อบริษัท</th><th>เบอร์ติดต่อ</th></tr>';
			foreach($rs as $row){
				echo '<tr><td>'.$row['m_name'].'</td><td>'.$row['m_tel'].'</td><td>'.$row['m_email'].'</td><td>'.$row['m_company'].'</td><td>'.$row['m_ctel'].'</td></tr>';
			}
			echo '</table>';	
		}
	}
	
	if($_GET['action'] == 'get_admin_user'){
		$rs = $db->GetAll("SELECT * FROM admin_user where system_id = ".$_GET['id']." ORDER BY id ASC");
		if($rs){
			echo '<style>table.nowidth td{width:auto !important;}</style>';
			echo '<table class="nowidth">';
			echo '<tr><th>ชื่อ-สกุล</th><th>เบอร์ติดต่อ</th><th>อีเมล์</th><th>ชื่อบริษัท</th><th>เบอร์ติดต่อ</th></tr>';
			foreach($rs as $row){
				echo '<tr><td>'.$row['a_name'].'</td><td>'.$row['a_tel'].'</td><td>'.$row['a_email'].'</td><td>'.$row['a_company'].'</td><td>'.$row['a_ctel'].'</td></tr>';
			}
			echo '</table>';
		}
	}
}
?>