<link rel="stylesheet" type="text/css" href="../css/print.css" media="print"/>
<?
include "../include/session_config.php";
	include "../include/config.php";
	include "../include/function.php";
	include "../include/class_userlogin.php";
	db_connect();
	$log =new UserLogin();
	if($_GET['chk_export']=="1"){
		$detail="ชื่อ :รายงานข้อผิดพลาดของระบบงาน";
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

<!--<body Onload="printpr();">-->

<body onload="window.print();">
<div id="page">
<div class="clear"></div>
<div style="width:800px; height:103px; position:relative;">
<img src="../images/fd_head.gif" />

<div style="position:absolute; top:44px; right:100px;text-align:right;color:#999">รายงานข้อผิดพลาดของ<?php echo $_GET['system']?><br /> ประจำเดือน<?php echo $_GET['s_month']?> ปี <?php echo  $_GET['s_year'] ?></div>
</div><!-- img -->
    <div id="title">รายงานข้อผิดพลาดของ<?php echo $_GET['system']?><br>ประจำเดือน<?php echo $_GET['s_month']?> ปี <?php echo  $_GET['s_year'] ?></div>
    <?php 
     $result=mysql_query("SELECT * FROM request_lists WHERE id='".$_GET['id']."'");
     $item=mysql_fetch_assoc($result);
     ?>  

    <div>
        <p>        	
            <label>ที่มา</label> <span style="width:118px"><?php echo GetUserType($_SESSION['usertype']); ?></span>
            <label>รหัส</label> <span class="underline" style="width:100px;"><?php echo $item['code']; ?></span>
			<label>สถานะ</label> <span class="underline" style="width:100px;">
			<?php echo GetProblemStatus($item['status'],FALSE); ?></span>
        </p>
        <p>	
            <label>ผู้แจ้ง</label><span class="underline" style="width:280px;"><?php echo GetUser($item['orderid'],'user')?></span>
            <label>วันที่</label><span class="underline" style="width:80px;"><?php echo GetThaiDate($item['new_date'],1,0)?></span>
            <label>เวลา</label><span class="underline" style="width:65px;"><?php echo substr(GetThaiDate($item['new_date'],1,1),10,6)?> น.</span></p>
        <p>
            <label>หน่วยงาน</label><span class="underline" style="width:290px;"><?php echo GetDiv($item['orderid'])?></span>
            <label>เบอร์โทรศัพท์</label><span class="underline" style="width:105px;"><?php echo GetTel($item['orderid'])?></span>
        </p>
        <p>
            <label>ผู้รับแจ้ง</label><span class="underline" style="width:262px;"><?php echo GetUser($item['responsibleid'],'response')?></span>
            <label>วันที่</label><span class="underline" style="width:80px;"><?php echo GetThaiDate($item['active_date'],1,0)?></span>
            <label>เวลา</label><span class="underline" style="width:65px;"><?php echo substr(GetThaiDate($item['active_date'],1,1),10,6)?> น.</span>
        </p>
        <p>
            <label>หน่วยงาน</label><span class="underline" style="width:290px;"><?php $div=GetDiv($item['responsibleid'],'responsibleid'); echo ($div=="")?"Favourite Design":$div;?></span>
            <label>เบอร์โทรศัพท์</label><span class="underline" style="width:105px;"><?php echo GetUser($item['responsibleid'],'response',true) ?></span>
        </p>
        <div><label style="vertical-align:top">รายการผิดพลาด</label>
        <span style="border:0px;width:500px;"><?php echo $item['title']?></span>
        <div style="border:0px; height:300px; width:500px;">
        <ul class="list_detail">
        <?php $sql ="select b.detail as detail,b.url as url,b.fileatth as fileatth from request_lists a";
			  $sql .=" left join request_list_details b on a.id=b.title_id where a.id=".$_GET['id']." order by b.id ";
			  
			  $result=mysql_query($sql) or die("Error select detail :".mysql_error());
			  $i=1;
			  while($row=mysql_fetch_assoc($result)):			  
		?>
        	<li><label>รายละเอียด <?php echo $i ?> :</label><?php echo $row['detail']?></li>
        	<li><label>url :</label><?php echo $row['url']?> <label>ไฟล์ :</label><?php echo $row['fileatth']?></li>
 
        <?php $i++; endwhile; ?>
        </ul></div></div>
		
        <p><label>ระบุสาเหตุ</label>
        <span class="underline" style="width:280px;"><?php echo GetProblemType($item['problemtype']); ?></span>
        </p>
        <p>
            <?php  			
			  $own=($item['chk_send']!="")?	GetUser($item['ownid'],'user'):"";						
			?>
			<label>ส่งให้เจ้าของระบบ</label>
			<?php if($item['chk_send']==""){?>
				<span class="underline" style="width:280px;">ไม่ส่งต่อ</span>	
			<?php }elseif($item['chk_send']=="send"){?>
				<span class="underline" style="width:280px;">ส่งต่อ กรณีงานเดี่ยว</span>
				<label>วันที่</label> <span class="underline" style="width:80px;">
				<?php echo GetThaiDate($item['send_date'],1,0)?></span>
            <label>เวลา</label> <span class="underline" style="width:65px;">
			<?php echo substr(GetThaiDate($item['send_date'],1,1),10,6);
			($item['operation_date']=='0000-00-00 00:00:00')?"":" น.";?></span>
			<p>
			<label style="vertical-align:top">รายละเอียด</label> <span style="border:0px; height:70px;">
			<?php echo $item['send_note'] ?></span></p>
			<?php }elseif($item['chk_send']=="send_wait"){ ?>
				<span class="underline" style="width:280px;">ส่งต่อ กรณีงานร่วม</span>
				 <label>วันที่</label> <span class="underline" style="width:80px;">
				 <?php echo GetThaiDate($item['send_date'],1,0)?></span>
            <label>เวลา</label> <span class="underline" style="width:65px;">
			<?php echo substr(GetThaiDate($item['send_date'],1,1),10,6);
			($item['operation_date']=='0000-00-00 00:00:00')?"":" น.";?></span>
			<p><label style="vertical-align:top">รายละเอียด</label><span style="border:0px; height:80px;">
			<?php echo $item['send_note'] ?></span></p>
			<?php } ?> 
           
        </p>
    </div>
    
    <div>
        
        <p><label>สรุปผลการแก้ไข</label><span style="border:0px; height:80px;"><?php echo $item['system_note'] ?></span></p>
        <p>
            <label>ผู้รายงานผล</label> <span class="underline" style="width:235px;">
			<?php echo GetUser($item['responsibleid'],'response')?></span>
            <label>วันที่</label><span class="underline" style="width:80px;"><?php echo GetThaiDate($item['complete_date'],1,0); ?></span>
            <label>เวลา</label><span class="underline" style="width:65px;"><?php echo substr(GetThaiDate($item['complete_date'],1,1),10,6); ($item['complete_date']=='0000-00-00 00:00:00')? "":" น.";?></span>
        </p>
        <p>
            <label>ผู้รับผลรายงาน</label><span class="underline" style="width:218px;"></span>
            <label>วันที่</label><span class="underline" style="width:80px;"></span>
            <label>เวลา</label><span class="underline" style="width:65px;"></span>
        </p>
        <p>
            <label>หน่วยงาน</label><span class="underline" style="width:290px;"></span>
            <label>เบอร์โทรศัพท์</label><span class="underline" style="width:105px;"></span>
        </p>
    </div>
  
<div style="width:800px; height:103px;position:relative;   bottom:0px;">
<img src="../images/fd_foot.gif" width="800"/>
</div>
<div class="clear"></div>
</div>
</body>
</html>
<?php
}else{
		Alert($alert_export);
		ReDirect($host."report.php?act=list3",'top');
		
	}
		
		
		
		
?>
