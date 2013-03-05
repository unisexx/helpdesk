<?
	include "../include/session_config.php";
	include "../include/config.php";
	include "../include/function.php";
	include "../include/class_userlogin.php";
	db_connect();
	$log=new UserLogin();
	if($_GET['chk_export']=="1"){
		$detail="ชื่อ : รายงานการบำรุงรักษาโปรแกรม ";
		$log->AddLog(29,$detail);
	
	
?>
<?
if($_GET['id']!='')
{
	$systemReport = GetData('systemreport',$_GET['id']);
	$serverInfo = GetData("server",$systemReport['ServerID']);
	$result=mysql_query("select  YEAR(SystemDate) as yy,MONTH(SystemDate)as mm from systemreport  where id=".$_GET['id']);
	while($item=mysql_fetch_assoc($result)){
		$yy=$item['yy'];
		$mm=$item['mm'];
	}
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<script type="text/javascript" src="../js/print.js"></script>
<link rel="stylesheet" type="text/css" href="../css/print.css"/>
</head>
<body >
<div id="page">
<div class="clear"></div>
<div style="width:800px; height:103px; position:relative;">
<img src="../images/fd_head.gif" />
<div style="clear:both;"></div>
<div style="position:absolute; top:44px; right:10px;text-align:right;color:#999">รายงานการบำรุงรักษาโปรแกรม <?php echo Systemname($systemReport['SystemID']) ?><br /> ประจำเดือน <?php echo GetMonthName('full',$mm)?> <?php echo $yy+543 ?> </div>
</div><!-- img -->
<div id="title">รายงานการบำรุงรักษาโปรแกรม <?php echo Systemname($systemReport['SystemID']) ?><br />
ประจำเดือน <?php echo GetMonthName('full',$mm)?> <?php echo $yy+543 ?>

</div>
<p><label class="headtitle">System Configuration</label></p>
<div style="padding-left:15px;">
<p><label>Server Name(host name) :</label><span > <?=$serverInfo['ServerName'];?></span></p>
<p><label>Operation System :</label><span><?=$serverInfo['Os'];?></span></p>
<p><label>Network Address :</label><span><?=$serverInfo['NetworkAddress'];?></span></p>
<p><label>Disk Size :</label><span><?=$serverInfo['DiskSize'];?></span></p>
</div>
<div>
<table class="tbfilename">
<tr>
<th>File System</th>
<th>Size</th>
<th>Used</th>
<th>Available</th>
<th>Use%</th>
<th>Mounted on</th>
</tr>
 <?

  $sql = "SELECT * FROM systemreportdetail  WHERE PID  = ".$_GET['id']." ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){

  ?>
<tr>
<td ><?=$srow['NameServer']; ?></td>
<td><?=$srow['1kBlocks'];?></td>
<td><?=$srow['Used'];?></td>
<td><?=$srow['Available'];?></td>
<td><?=$srow['PUse'];?></td>
<td><?=$srow['MountedOn'];?></td>
</tr>
<? } ?>
</table>
</div>
<p><label class="headtitle">System Service</label></p>
<div style="padding-left:15px;">
<p><label>Port Running :</label><span> <?=$serverInfo['PortRunning'];?></span></p> <!--80-->
<p><label>Process Running  :</label><span><?=$serverInfo['ProcessRunning'];?></span></p> 
</div>

<p><label class="headtitle">System Database</label></p>
<div style="padding-left:15px;">
<p><label>Name Database :</label><span><?=$serverInfo['DatabaseName'];?></span></p> 
<p><label>Size :</label><span><?=$serverInfo['Size'];?></span></p>
<p><label>Path Data Name :</label><span><?=$serverInfo['PathDataName'];?></span></p>
</div>

<p><label class="headtitle">Software Application</label></p>
<div style="padding-left:15px;">
<p><label>Path Software :</label><span><?=$serverInfo['PathSoftware'];?></span></p>
<p><label>Start Application :</label><span><?=$serverInfo['StartApp'];?></span></p>
<p><label>Stop Application :</label><span><?=$serverInfo['StopApp'];?></span></p>
</div>
<p><label>วันที่ตรวจสอบฐานข้อมูล</label><span class="underline"><?=convertDateFromDB($systemReport['SystemDate'.@$i]);?></span></p>
<p><label>ผู้ตรวจสอบ</label><span class="underline"><?=$systemReport['Examiner'];?></span></p>

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
		ReDirect($host."report.php?act=list4",'top');
	}
		
		
		
		
?>


