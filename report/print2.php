<?
	include "../include/session_config.php";
	include "../include/config.php";
	include "../include/function.php";
	include "../include/class_userlogin.php";
	db_connect();
	$log =new UserLogin();
	if($_GET['chk_export']=="1"){
		$detail="ชื่อ :รายงานสรุปประเภทปัญหาประจำเดือน";
		$log->AddLog(29,$detail);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<script type="text/javascript" src="../js/print.js"></script>
<link rel="stylesheet" type="text/css" href="../css/print.css"/>
</head>

<body onload="window.print();">
<div id="page">
<div class="clear"></div>
<div style="width:800px; height:103px; position:relative;">
<img src="../images/fd_head.gif" width="800" />
<div style="clear:both;"></div>
<div style="position:absolute;float:right; top:44px; right:10px;text-align:right;color:#999">รายงานสรุปการรับแจ้งปัญหา <?php echo $_POST['sysname'] .'<br /> ประจำเดือน '.$_POST['s_month']."".$_POST['s_year']?></div>
</div><!-- img -->
<div id="title">รายงานสรุปประเภทปัญหาประจำเดือน  <?php echo $_POST['sysname'] .'<br /> ประจำเดือน '.$_POST['s_month']."".$_POST['s_year']?></div>
<div>
<table class="tbfilename">
<tr>
<th width="10%">ลำดับ</th>
<th width="30%">รายการ</th>
<th width="15%">จำนวน</th>
<th width="45%">การอ้างอิง</th>
</tr>
<tr>
<td height="41">1</td>
<td>งานแก้ไขข้อผิดพลาด</td>
<td><?php echo $_POST['list_0'];?></td>
<td></td>

</tr>
<tr>
<td>2</td>
<td>งานปรับปรุงเพิ่มเติม</td>
<td><?php echo $_POST['list_1'];?></td>
<td></td>
</tr>
<tr>
<td>3</td>
<td>งานให้คำแนะนำ</td>
<td><?php echo $_POST['list_2'];?></td>
<td></td>
</tr>
<tr>
<td>4</td>
<td>งานอื่นๆ</td>
<td><?php echo $_POST['list_3'];?></td>
<td></td> 
</tr>
<tr>
<td>&nbsp;</td>
<td>รวม</td>
<td><?php echo $_POST['list_4'];?></td>
<td></td>
</tr>
</table>
</div>
<div class="clear"></div>  
<div style="width:800px; height:103px; position:absolute;bottom:0px;">
<img src="../images/fd_foot.gif" width="800"/>
</div>
</div>
</body>
</html>
<?php
}else{
		Alert($alert_export);
		ReDirect($host."report.php?act=list2",'top');
		
	}
		
		
		
?>