<?php 
	include('include/adodb_connect.php');
	// $db->debug = true;
	$systems = $db->GetAll("select * from system order by id asc");
?>
<style type="text/css">
#frmsearch label.error{ color:red; }
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
<h3>รายงานผลการดำเนินโครงการบริหารจัดการระบบสารสนเทศ (IT Helpdesk 02)</h3>
<div id="search">
<span>
    <form method="post" id="frmsearch" >
      <select name="s_year">
      	<option value="">เลือกปี</option>
       
      </select>
      
      <select name="s_month">
        <option value="">เลือกเดือน</option>
        
      </select>

      <input  name="submit" type="submit" value="search" class="btn_search" /> 
      </form>
</span>
</div>

<form  method="post" action="report/IT_Helpdesk_02.php?chk_export=<?php echo $item_10['CanExport']?> " target="_blank">
<div id="btnBox"><input type="submit" value="พิมพ์รายงาน"  class="btn_print" /></div>
<div id="titleReport"><?php echo "รายงานผลการดำเนินโครงการบริหารจัดการระบบสารสนเทศ ประจำเดือน".GetMonthName('full',@$s_month)." ปี ".@$s_year_th=@$s_year+543; ?></div>
<input type="hidden" name="s_month" 	value="<?php echo GetMonthName('full',@$s_month)?>" />
<input type="hidden" name="s_year" 		value="<?php echo $s_year_th ?>" />
<input type="hidden" name="list"        value="list2" />

<table class="tblist">
	<tr>
	    <th rowspan="2" align="center">ลำดับ</th>
	    <th rowspan="2" align="center">ชื่อระบบ</th>
	    <th colspan="4" align="center">ประเภทการให้บริการ</th>
	    <th colspan="3" align="center">สถานะการดำเนินการ</th>
	    <th rowspan="2" align="center">รวม</td>
	</tr>
	<tr>
		<th align="center">งานปรับปรุง<br>เพิ่มเติมโปรแกรม</th>
		<th align="center">งานแก้ไข<br>ข้อผิดพลาด</th>
		<th align="center">งาน<br>ร้องขอ</th>
		<th align="center">งานให้<br>คำแนะนำ</th>
		<th align="center">กำลัง<br>ดำเนินการ</th>
	    <th align="center">เรียบร้อย</th>
	    <th align="center">แจ้งกลับ</th>
	</tr>
	<?php foreach($systems as $key=>$system):?>
	<tr>
        <td align="center"><?php echo $key+1?></td>
        <td><?php echo $system['SystemName']?></td>
        <td>
        	<?php
        		$rs = $db->Execute("select * from request_lists where systemid = ".$system['ID']);
				$count = $rs->RecordCount();
				echo $count;
        	?>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
	<?php endforeach;?>
</table>
</form>