<style type="text/css">
#frmsearch label.error{ color:red; }

</style>

<script type="text/javascript">
$(document).ready(function() {
					   
  $("#frmsearch").validate({
    rules: {
      // s_system: "required",
	  s_year: "required",
      s_month: "required"
	

    },
    messages: {
      // s_system: "กรุณาเลือกระบบ", 
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
  db_connect();
?>
<?php 

		//$sql="select * from request_lists where ".$s_system.$_POST['s_system'].$s_year.$_POST['s_year'].$s_month.$_POST['s_month'];
		// กรณีเป็นผู้ใช้งานหลายระบบ จะดีฟอลต์ให้อัตโนมัติ
		if(@$_POST['submit']!='search'){
			$sql="select b.id as id from user_systems  a";
			$sql.=" left join system b on a.systemid=b.id";
			$sql.=" where userid='".$_SESSION['id']."' limit 0,1";
			$result=mysql_query($sql);
			$item=mysql_fetch_assoc($result);
			$sysid=$item['id'];
			$_POST['s_system']=$item['id'];
			$sysid = $_POST['s_system'] != "" ? " and systemid='".$_POST['s_system']."' " : "" ;
	
			
			$sql=mysql_query("select month(curdate()) as s_month from dual");
			$rs=mysql_fetch_assoc($sql);
			$s_month=$rs['s_month'];
			$_POST['s_month']=$rs['s_month'];
		
			$sql=mysql_query("select year(curdate()) as s_year from dual");
			$rs=mysql_fetch_assoc($sql);
			$s_year=$rs['s_year'];
			$_POST['s_year']=$rs['s_year'];
			
		}else{
			$s_month=$_POST['s_month'];
			$s_year=$_POST['s_year'];
			$sysid = $_POST['s_system'] != "" ? " and systemid='".$_POST['s_system']."' " : "" ;
		}

	?>
<h3>รายงาน สรุปประเภทปัญหาประจำเดือน (IT Helpdesk 02-1)</h3>
<div id="search">
<span>
    <form method="post" id="frmsearch" >
	
      <select name="s_system">
        <option value="">เลือกระบบงาน</option>
        <?php 
            $sql="select b.systemname as system,b.id as id from user_systems  a";
			$sql.=" left join system b on a.systemid=b.id";
			$sql.=" where userid='".$_SESSION['id']."'";
			$result=mysql_query($sql);
            while($item=mysql_fetch_assoc($result)): 
        ?>
        <option value="<?php echo $item['id']; ?>" <?php echo ($item['id']==@$_POST['s_system'])?"selected":"";?> ><?php echo $item['system']; ?></option> 
        <? endwhile; ?> 
  
      </select>
      
      <select name="s_year">
      	<option value="">เลือกปี</option>
       <?php var_dump($_POST['s_year']); ?>
        <?php 
            $result=mysql_query("select year(new_date) as yy  from request_lists  group by year(new_date) order by new_date desc");
            while($item=mysql_fetch_assoc($result)): 
        ?>
         <option value="<?php echo $item['yy'];?>" <?php echo ($item['yy']==@$_POST['s_year'])?"selected":"";?>><?php echo $item['yy']+543; ?></option>
         <?php endwhile; ?>
     
      </select>
      
      <select name="s_month">
        <option value="">เลือกเดือน</option>
        <?php for($i=1;$i<=12;$i++): ?>
        <option value="<?php echo $i?>" <?php echo ($i==@$_POST['s_month'])?"selected":"";?>><?php echo GetMonthName('full',$i) ?></option>
        <?php endfor; ?>
      </select>

      <input  name="submit" type="submit" value="search" class="btn_search" /> 
      </form>
      
</span>
</div>

<form  method="post" action="report/print2.php?chk_export=<?php echo $item_10['CanExport']?> " target="_blank">
<div id="btnBox"><input type="submit" value="พิมพ์รายงาน"  class="btn_print" /></div>
<div id="titleReport"><?php echo Systemname(@$sysid)." ประจำเดือน".GetMonthName('full',@$s_month)." ปี ".@$s_year_th=@$s_year+543; ?></div>
<input type="hidden" name="sysname" 	value="<?php echo Systemname(@$sysid)?>" />
<input type="hidden" name="s_month" 	value="<?php echo GetMonthName('full',@$s_month)?>" />
<input type="hidden" name="s_year" 		value="<?php echo $s_year_th ?>" />
<input type="hidden" name="list"        value="list2" />

<table class="tblist">
  <tr>
    <th>ลำดับ</th>
    <th>รายการ</th>
    <th>จำนวนเรื่องที่รับแจ้ง</th>
    <th>การอ้างอิง</th>
  </tr>
  <tr>
    <td>1</td>
    <td>งานปรับปรุงเพิ่มเติมโปรแกรม</td>
    <?php

  	$result=mysql_query("SELECT * from request_lists where 1=1 ".$sysid." AND month(new_date)=".$s_month." and year(new_date)='".$s_year."' and servicetype_id='1'"); 
	
	// echo "SELECT * from request_lists where 1=1 ".$sysid."' AND month(new_date)=".$s_month." and year(new_date)='".$s_year."' and servicetype_id='1'";
	
	$num=mysql_num_rows($result);  
  	?> 
    <td><?php echo $num ?></td>
    <input type="hidden" name="list_0" value="<?php echo $num ?>" />
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>2</td>
    <td>งานแก้ไขข้อผิดพลาด</td>
    <?php

  	$result=mysql_query("SELECT * from request_lists where 1=1 ".$sysid." AND month(new_date)=".$s_month." and year(new_date)='".$s_year."' and servicetype_id='2'"); 
	$num=mysql_num_rows($result);  
  	?> 
    <td><?php echo $num ?></td>
    <input type="hidden" name="list_1" value="<?php echo $num ?>" />
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>3</td>
    <td>งานร้องขอ</td>
     <?php

  	$result=mysql_query("SELECT * from request_lists where 1=1 ".$sysid." AND month(new_date)=".$s_month." and year(new_date)='".$s_year."' and servicetype_id='3'"); 
	$num=mysql_num_rows($result);  
  	?> 
    <td><?php echo $num ?></td>
    <input type="hidden" name="list_2" value="<?php echo $num ?>" />
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4</td>
    <td>งานให้คำแนะนำ</td>
    <?php

  	$result=mysql_query("SELECT * from request_lists where 1=1 ".$sysid." AND month(new_date)=".$s_month." and year(new_date)='".$s_year."' and servicetype_id='4'"); 
	$num=mysql_num_rows($result);  
  	?>     
    <td><?php echo $num ?></td>
    <input type="hidden" name="list_3" value="<?php echo $num ?>" />
    <td>&nbsp;</td>
  </tr>
  <!-- <tr>
    <td>5</td>
    <td>Other</td>
    <?php

  	$result=mysql_query("SELECT * from request_lists where 1=1 ".$sysid." AND month(new_date)=".$s_month." and year(new_date)='".$s_year."' and problemtype='5'"); 
	$num=mysql_num_rows($result);  
  	?>     
    <td><?php echo $num ?></td>
    <input type="hidden" name="list_3" value="<?php echo $num ?>" />
    <td>&nbsp;</td>
  </tr> -->
  <tr>
    <td>&nbsp;</td>
    <td class="B">รวม</td>
    <?php
  	$result=mysql_query("SELECT * from request_lists where 1=1 ".$sysid." AND month(new_date)=".$s_month." and year(new_date)='".$s_year."'"); 
	$num=mysql_num_rows($result);  
  	?> 
    <td class="B"><?php echo $num ?></td>
    <input type="hidden" name="list_4" value="<?php echo $num ?>" />
    <td>&nbsp;</td>
  </tr>
</table>
</form>