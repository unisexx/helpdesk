<link rel="stylesheet" type="text/css" href="../css/print.css" media="print"/>
<?
	include "../include/session_config.php";
	include "../include/config.php";
	include "../include/function.php";
	include "../include/class_userlogin.php";
	db_connect();
	$log =new UserLogin();
	if($_GET['chk_export']=="1"){
		$detail="ชื่อ :รายงานรายละเอียดแจ้งปัญหาประจำเดือน ";
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
<?php 
$sysname=(isset($_POST['sysname']))? $_POST['sysname']:"";
$_POST['edate']=(isset($_POST['edate']))? " ถึง ".$_POST['edate']:"";
$_POST['sdate']=(isset($_POST['sdate']))? " วันที่ " .$_POST['sdate']:"";

?>
<div style="text-align: right;">IT Helpdesk 03</div>
<!-- <div style="width:800px; height:103px; position:relative;">
<img src="../images/fd_head.gif" />
<div style="clear:both;"></div>
<div style="position:absolute; top:44px; right:100px;text-align:right;color:#999">รายงานรายละเอียดการรับแจ้งปัญหา <?php echo $sysname .'<br /> '.$_POST['sdate'].$_POST['edate']?></div>
</div>  -->
<div id="title">
รายงานรายละเอียดการรับแจ้งปัญหา <?php echo $sysname .'<br /> '.$_POST['sdate'].$_POST['edate']?></div>
<p><label class="headtitle">สรุปการรับแจ้งปัญหา</label></p>
<table class="tbfilename">
<tr>
<th>ลำดับ</th>
<th style="text-align:center">รายการ</th>
<th style="width:100px;">สถานะ</th>
<th>วันที่รับแจ้ง</th>
<th>หมายเหตุ</th>
</tr>
<?php
  $text=$_POST['sql']; 
 
  $sql= str_replace("\\","",$text);
  //echo $sql;
  //$tt=substr($sql,0,strpos($sql,"ORDER"));
	//echo $tt;						 
 $result=mysql_query($sql) or die("Error: ".mysql_error());
  $i=$_POST['no'];
  while($item=mysql_fetch_assoc($result)):
  $i++;
?>

<tr>
<td><?php echo $i ?></td>
<td><?php echo $item['title'] ?></td>
<td><?php echo GetProblemStatus($item['status']) ?></td>
<td><?php echo DB2Date($item['new_date']) ?></td>
<td>&nbsp;</td>
</tr>
<?php endwhile; ?>

</table>
<p><label class="headtitle">ข้อเสนอแนะอื่นๆ</label></p>
<div style="height:226px;">
	<p><span class="botline" style="width:100%"></span></p>
	<p><span class="botline" style="width:100%"></span></p>
	<p><span class="botline" style="width:100%"></span></p>
	<p><span class="botline" style="width:100%"></span></p>

</div>
<div>
<p>
  <label>ลงชื่อเจ้าหน้าที่ :</label>
  <span class="underline" style="width:155px;"></span>
  <label>ลงชื่อผู้ดูแลระบบ</label>
  <span class="underline" style="width:155px;"></span>
</p>
<!-- <div class="clear"></div>  
<div style="width:800px; height:103px;bottom:0px;">
<img src="../images/fd_foot.gif" width="800"/>
</div> -->
</body>
</html>
<?php
}else{
		Alert($alert_export);
		ReDirect($host."report.php?act=list1",'top');
		
	}
		
		
		
		
?>
