<link rel="stylesheet" type="text/css" href="../css/print.css" media="print"/>
<?
	include "../include/session_config.php";
	include "../include/config.php";
	include "../include/function.php";
	include "../include/class_userlogin.php";
	db_connect();
	$log =new UserLogin();
	if($_GET['chk_export']=="1"){
		$detail="ชื่อ :รายงานสรุปการรับแจ้งปัญหา ";
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
<div style="position:absolute;float:right; top:44px; right:100px;text-align:right;color:#999">รายงานสรุปการรับแจ้งปัญหา <?php echo $_POST['sysname'] .'<br /> ประจำเดือน '.$_POST['s_month']."".$_POST['s_year']?></div>
</div><!-- img -->
<div id="title">รายงานสรุปการรับแจ้งปัญหา <?php echo $_POST['sysname'] .'<br /> ประจำเดือน '.$_POST['s_month']."".$_POST['s_year']?></div>
<p><label class="headtitle">สรุปการรับแจ้งปัญหา</label></p>
<div>
<table class="tbfilename">
<tr>
<th style="width:1%">ลำดับ</th>
<th style="width:30%">รายการ</th>
<th style="width:18%">จำนวนเรื่องที่รับแจ้ง</th>
<th style="width:8%;">หมายเหตุ</th>
</tr>
<tr>
<td>1</td>
<td>งานค้างจากเดือนที่ผ่านมา</td>
<td><?php echo $_POST['list_0'];?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>2</td>
<td>เรื่องที่ได้รับแจ้งทั้งหมดในเดือนนี้ </td>
<td><?php echo $_POST['list_1'];?></td>
<td>&nbsp;</td>
</tr>
<tr>
  <td>3</td>
  <td>เรื่องที่ดำเนินการเรียบร้อยแล้วในเดือนนี้ </td>
  <td><?php echo $_POST['list_2'];?></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>4</td>
  <td>เรื่องที่กำลังดำเนินการ (แล้วเสร็จในเดือนต่อไป)</td>
  <td><?php echo $_POST['list_3'];?></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>รวมเรื่องที่ได้รับแจ้งทั้งหมด</td>
  <td><?php echo $_POST['list_4'];?></td>
  <td>&nbsp;</td>
</tr>
</table>
</div>

<p><label class="headtitle">ข้อเสนอแนะอื่นๆ</label></p>
<div style="height:400px;">
<p><span class="botline" style="width:100%"></span></p>
<p><span class="botline" style="width:100%"></span></p>
<p><span class="botline" style="width:100%"></span></p>
<p><span class="botline" style="width:100%"></span></p>
<p><span class="botline" style="width:100%"></span></p>
<p><span class="botline" style="width:100%"></span></p>
<p><span class="botline" style="width:100%"></span></p>
<p><span class="botline" style="width:100%"></span></p>
</div>
<p>
  <label>ลงชื่อเจ้าหน้าที่ :</label>
  <span class="underline" style="width:155px;"></span>
  <label>ลงชื่อผู้ดูแลระบบ</label>
  <span class="underline" style="width:155px;"></span></p>
<div class="clear"></div>  
<div style="width:800px; height:103px;bottom:0px;">
<img src="../images/fd_foot.gif" width="800" />
</div>
</div>
</body>
</html>
<?php
}else{
		Alert($alert_export);
		ReDirect($host."report.php?act=list1",'top');
		
	}
		
		
		
		
?>
