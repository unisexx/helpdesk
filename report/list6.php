<?php 
	include('include/adodb_connect.php');
	// $db->debug = true;
?>
<style type="text/css">
#frmsearch label.error{ color:red; }
table th,table td{border-left:1px solid #ccc !important; border-right:1px solid #ccc !important;}
</style>
<script type="text/javascript">
$(document).ready(function() {
  $("#frmsearch").validate({
    rules: {
	  s_year: "required",
      s_month: "required"
    },
    messages: {
      s_year: "  กรุณาเลือกปี",      
      s_month: "  กรุณาเลือกเดือน"
     
     },
	 errorPlacement: function(error, element){
		if (element.is(":radio")) 
			error.appendTo(element.parent());
		else 
			if (element.is(":checkbox")) 
				error.appendTo(element.next());
			else 
				error.width();
		error.appendTo(element.parent());
	}					
  });  
});
</script>
<?php 

		//$sql="select * from request_lists where ".$s_system.$_POST['s_system'].$s_year.$_POST['s_year'].$s_month.$_POST['s_month'];
		// กรณีเป็นผู้ใช้งานหลายระบบ จะดีฟอลต์ให้อัตโนมัติ
		if(@$_POST['submit']=='search'){
			$s_month=$_POST['s_month'];
			$s_year=$_POST['s_year'];
		}else{
			$s_month = date('n');
			$s_year = date('Y');
		}
		
	  //ช่องทางการแจ้ง
	  $rs = $db->Execute("select * from request_lists where service = 'tel' and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
	  $telcount = $rs->RecordCount();
	  
	  $rs = $db->Execute("select * from request_lists where service = 'email' and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
	  $emailcount = $rs->RecordCount();
	  
	  $rs = $db->Execute("select * from request_lists where service = 'other' and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
	  $othercount = $rs->RecordCount();
	?>
<h3>รายงานผลการดำเนินโครงการบริหารจัดการระบบสารสนเทศ (IT Helpdesk 02)</h3>
<div id="search">
<span>
    <form method="post" id="frmsearch" >
      <select name="s_year">
      	<option value="">เลือกปี</option>
       <?php var_dump($_POST['s_year']); ?>
        <?php 
            $result=mysql_query("select year(new_date) as yy  from request_lists  group by year(new_date) order by new_date desc");
            while($item=mysql_fetch_assoc($result)): 
        ?>
         <option value="<?php echo $item['yy'];?>" <?php echo ($item['yy']==@$s_year)?"selected":"";?>><?php echo $item['yy']+543; ?></option>
         <?php endwhile; ?>
      </select>
      
      <select name="s_month">
        <option value="">เลือกเดือน</option>
        <?php for($i=1;$i<=12;$i++): ?>
        <option value="<?php echo $i?>" <?php echo ($i==@$s_month)?"selected":"";?>><?php echo GetMonthName('full',$i) ?></option>
        <?php endfor; ?>
      </select>

      <input  name="submit" type="submit" value="search" class="btn_search" /> 
      </form>
</span>
</div>

<form  method="post" action="IT_Helpdesk_02.php?chk_export=<?php echo $item_10['CanExport']?>&s_month=<?php echo $s_month?>&s_year=<?php echo $s_year?> " target="_blank">
<div id="btnBox"><input type="submit" value="พิมพ์รายงาน"  class="btn_print" /></div>
<div id="titleReport"><?php echo "รายงานผลการดำเนินโครงการบริหารจัดการระบบสารสนเทศ ประจำเดือน ".GetMonthName('full',@$s_month)." ปี ".@$s_year_th=@$s_year+543; ?></div>
<input type="hidden" name="s_month" 	value="<?php echo GetMonthName('full',@$s_month)?>" />
<input type="hidden" name="s_year" 		value="<?php echo $s_year_th ?>" />
<input type="hidden" name="list"        value="list2" />

<table class="tblist">
	<tr>
	    <th rowspan="2" align="center">ลำดับ</th>
	    <th rowspan="2" align="center">ชื่อระบบ</th>
	    <th colspan="4" align="center">ประเภทการให้บริการ</th>
	    <th colspan="4" align="center">สถานะการดำเนินการ</th>
	    <th rowspan="2" align="center">รวม</td>
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
</table>
<br>
<font style="font-size:12px">ช่องทางการรับแจ้งทางโทรศัพท์ จำนวน <?php echo $telcount?> รายการ ทางอีเมล์จำนวน <?php echo $emailcount?> รายการ  ทางอื่นๆจำนวน <?php echo $othercount?> รายการ<br />ประเภทปัญหา/สาเหตุ 
  	<?php
  		$problemtypes = $db->GetAll("select * from problemtype order by id asc");
  		foreach($problemtypes as $problemtype):
			$rs = $db->Execute("select * from request_lists where problemtype = ".$problemtype['ID']." and month(new_date)=".$s_month." and year(new_date)='".$s_year."'");
			$problemcount = $rs->RecordCount();
  	?>
  		<?php echo $problemtype['ProblemName'].' จำนวน '.$problemcount.' รายการ, '?>
  	<?php endforeach;?>
</font>
</form>