<?
  include "include/function.php";
  include('include/adodb_connect.php');
  $s_month = $_GET['s_month'];
  $s_year = $_GET['s_year'];
  
  //ช่องทางการแจ้ง
  $rs = $db->Execute("select * from request_lists where service = 'tel' and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
  $telcount = $rs->RecordCount();
  
  $rs = $db->Execute("select * from request_lists where service = 'email' and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
  $emailcount = $rs->RecordCount();
  
  $rs = $db->Execute("select * from request_lists where service = 'other' and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
  $othercount = $rs->RecordCount();
?>
<style>
body{font-size:12px;}
table.report td{text-align:center; padding:5px;}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="900" border="0" align="center">
  <tr>
    <td align="right">IT Helpdesk 02 </td>
  </tr>
  <tr>
    <td align="center"><p>รายงานผลการดำเนินโครงการบริหารจัดการระบบสารสนเทศ (สป.พม.) ประจำปีงบประมาณ <?php echo $s_year+543?> <br />
      เดือน <?php echo GetMonthName('full',$s_month)?></p>
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td><table class="report" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td rowspan="2" align="center">ลำดับ</td>
        <td rowspan="2" align="center">ชื่อระบบ</td>
        <td colspan="4" align="center">ประเภทการให้บริการ</td>
        <td colspan="4" align="center">สถานะการดำเนินการ</td>
        <td rowspan="2" align="center">รวม</td>
      </tr>
      <tr>
        <?php 
			$servicetypes = $db->GetAll("select * from servicetype order by id asc");
			foreach($servicetypes as $servicetype):
		?>
			<th align="center"><?php echo $servicetype['service_name']?></th>
		<?php endforeach;?>
		<?php 
			$problemstatuss = $db->GetAll("select * from problemstatus order by id asc");
			foreach($problemstatuss as $problemstatus):
		?>
			<th align="center"><?php echo $problemstatus['name']?></th>
		<?php endforeach;?>
	  </tr>
      <?php 
		$systems = $db->GetAll("select * from system order by id asc");
		foreach($systems as $key=>$system):
	?>
	<tr>
        <td align="center"><?php echo $key+1?></td>
        <td><?php echo $system['SystemName']?></td>
        <?php 
        	foreach($servicetypes as $servicetype):
				$rs = $db->Execute("select * from request_lists where systemid = ".$system['ID']." and servicetype_id = ".$servicetype['id']." and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
				$servicecount = $rs->RecordCount();
		?>
			<td><?php echo $servicecount?></td>
		<?php endforeach;?>
		<?php 
        	foreach($problemstatuss as $problemstatus):
				$rs = $db->Execute("select * from request_lists where systemid = ".$system['ID']." and status = ".$problemstatus['id']." and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
				$statuscount = $rs->RecordCount();
		?>
			<td><?php echo $statuscount?></td>
		<?php endforeach;?>
		<?php
			$rs = $db->Execute("select * from request_lists where systemid = ".$system['ID']." and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
			$totlecount = $rs->RecordCount();
		?>
        <td><?php echo $totlecount?></td>
	</tr>
	<?php endforeach;?>
	<tr style="background: #FAF4FF; color:#65358f; font-weight: bold;">
		<td></td>
		<td>รวมทั้งหมด (รายการ)</td>
		<?php 
        	foreach($servicetypes as $servicetype):
				$rs = $db->Execute("select * from request_lists where servicetype_id = ".$servicetype['id']." and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
				$servicecount_total = $rs->RecordCount();
		?>
			<td><?php echo $servicecount_total?></td>
		<?php endforeach;?>
		<?php 
        	foreach($problemstatuss as $problemstatus):
				$rs = $db->Execute("select * from request_lists where status = ".$problemstatus['id']." and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
				$statuscount_total = $rs->RecordCount();
		?>
			<td><?php echo $statuscount_total?></td>
		<?php endforeach;?>
		<?php
			$rs = $db->Execute("select * from request_lists where month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
			$alltotlecount = $rs->RecordCount();
		?>
        <td><?php echo $alltotlecount?></td>
	</tr>
</table></td>
  </tr>
  <tr><td height="8"></td></tr>
  <tr>
  	<td><font style="font-size:12px">ช่องทางการรับแจ้งทางโทรศัพท์ จำนวน <?php echo $telcount?> รายการ ทางอีเมล์จำนวน <?php echo $emailcount?> รายการ  ทางอื่นๆจำนวน <?php echo $othercount?> รายการ<br />ประเภทปัญหา/สาเหตุ 
  	<?php
  		$problemtypes = $db->GetAll("select * from problemtype order by id asc");
  		foreach($problemtypes as $problemtype):
			$rs = $db->Execute("select * from request_lists where problemtype = ".$problemtype['ID']." and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
			$problemcount = $rs->RecordCount();
  	?>
  		<?php echo $problemtype['ProblemName'].' จำนวน '.$problemcount.' รายการ, '?>
  	<?php endforeach;?>
	</font></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
