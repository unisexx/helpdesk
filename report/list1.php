<style type="text/css">
#frmsearch label.error{ color:red; }

</style>

<script type="text/javascript">
$(document).ready(function() {
					   
  $("#frmsearch").validate({
    rules: {
      s_system: "required",
	  s_year: "required",
      s_month: "required"
	

    },
    messages: {
      s_system: "กรุณาเลือกระบบ", 
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
		
		// กรณีเป็นผู้ใช้งานหลายระบบ จะดีฟอลต์ให้อัตโนมัติ
			function get_s(){
				$sql="select b.id as id from user_systems  a";
				$sql.=" left join system b on a.systemid=b.id";
				$sql.=" where userid='".$_SESSION['id']."' limit 0,1";
				$result=mysql_query($sql);
				$item=mysql_fetch_assoc($result);
				//$sysid=$item['id'];
				//$_POST['s_system']=$item['id'];
				return $item['id'];
			}
			
			function get_m(){
				$sql=mysql_query("select month(curdate()) as s_month from dual");
				$rs=mysql_fetch_assoc($sql);
				//$s_month=$rs['s_month'];
				//$_POST['s_month']=$rs['s_month'];
				return $rs['s_month'];
			}
		
			function get_y(){
				$sql=mysql_query("select year(curdate()) as s_year from dual");
				$rs=mysql_fetch_assoc($sql);
				//$s_year=$rs['s_year'];
				//$_POST['s_year']=$rs['s_year'];
				return $rs['s_year'];
			}
	
			
			
			if($_GET['s_month']==""){		
					$_GET['s_month']=get_m();
					$s_month=$_GET['s_month'];				
			}else{
					$s_month=$_GET['s_month'];				
			}
			
			
			
			if($_GET['s_year']==""){			
					$_GET['s_year']=get_y();
					$s_year=$_GET['s_year'];
							
				}else{
					$s_year=$_GET['s_year'];
				
			}
			
			if($_GET['s_system']==""){				
					$_GET['s_system']=get_s();
					$sysid=$_GET['s_system'];
				}else {
					$sysid=$_GET['s_system'];
			}
			

	
		

	?>
<h3>รายงาน สรุปการรับแจ้งปัญหาประจำเดือน</h3> 
<div id="search">
	<span>
    <form method="GET" id="frmsearch" action="report.php?act=list1">
      <select name="s_system">
        <option value="">เลือกระบบงาน</option>
       
        <?php 
            $sql="select b.systemname as system,b.id as id from user_systems  a";
			$sql.=" left join system b on a.systemid=b.id";
			$sql.=" where userid='".$_SESSION['id']."'";
			$result=mysql_query($sql);
            while($item=mysql_fetch_assoc($result)): 
        ?>
        <option value="<?php echo $item['id'] ?>" <?php echo ($item['id']==@$_GET['s_system'])?"selected":"";?> ><?php echo $item['system']; ?></option> 
        <? endwhile; ?> 
  
      </select>
      
      <select name="s_year">
      	<option value="">เลือกปี</option>
        <?php 
            $result=mysql_query("select year(new_date) as yy  from request_lists  group by year(new_date) order by new_date desc");
            while($item=mysql_fetch_assoc($result)): 
        ?>
         <option value="<?php echo $item['yy']; ?>" <?php echo ($item['yy']==@$_GET['s_year'])?"selected":"";?>><?php echo $item['yy']+543; ?></option>
         <?php endwhile; ?>
     
      </select>
      
      <select name="s_month">
        <option value="">เลือกเดือน</option>
        <?php for($i=1;$i<=12;$i++): ?>
        <option value="<?php echo $i; ?>" <?php echo ($i==@$_GET['s_month'])?"selected":"";?>><?php echo GetMonthName('full',$i) ?></option>
        <?php endfor; ?>
      </select>
	  <input type="hidden" name="act" value="list1" />
      <input  name="submit" type="submit" value="search" class="btn_search" /> 
      </form>
  </span>
</div>


<form action="report/print1.php?chk_export=<?php echo $item_10['CanExport']?> " method="post" target="_blank" >
<div id="btnBox"><input type="submit" value="พิมพ์รายงาน"  class="btn_print"  /></div>
<div id="titleReport"><?php echo Systemname(@$sysid)." ประจำเดือน".GetMonthName('full',@$s_month)." ปี ".@$s_year_th=$s_year+543; ?></div>
<input type="hidden" name="sysname" 	value="<?php echo Systemname(@$sysid)?>" />
<input type="hidden" name="s_month" 	value="<?php echo GetMonthName('full',@$s_month)?>" />
<input type="hidden" name="s_year" 		value="<?php echo $s_year_th ?>" />
<input type="hidden" name="list"        value="list1" />

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>รายการ</th>
  <th>จำนวน</th>
  <th>หมายเหตุ</th>
  </tr>
<tr>
  <td>1</td>
  <td>งานค้างจากเดือนที่ผ่านมา</td>
  <?php 
   $m=$s_month-1;
  $sql1="select * from request_lists where systemid='".$sysid."' AND month(new_date)='$m' and status<>3";
 // echo $sql1;
  	$result=mysql_query($sql1);
	$num=mysql_num_rows($result);
  ?>
  <td><?php echo $num ?></td>
  <input type="hidden" name="list_0" value="<?php echo $num ?>" />
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>2</td>
  <td>เรื่องที่ได้รับแจ้งทั้งหมดในเดือนนี้</td> 
  <?php
   $sql2="SELECT * from request_lists where systemid='".$sysid."' AND month(new_date)=".$s_month." and year(new_date)='".$s_year."'";
  // echo $sql2;
  	$result=mysql_query($sql2); 
	$num=mysql_num_rows($result);  
  ?> 
  <input type="hidden" name="list_1" value="<?php echo $num ?>" />
  <td><?php echo $num ?></td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>3</td>
  <td>เรื่องที่ดำเนินการเรียบร้อยแล้วในเดือนนี้</td>
  <?php
  	$sql3="SELECT * from request_lists where systemid='".$sysid."' AND month(complete_date)='".$s_month."' and year(complete_date)='".$s_year."'";
	//echo $sql3;
	$result=mysql_query($sql3); 
	$num=mysql_num_rows($result);  
  ?> 
  <input type="hidden" name="list_2" value="<?php echo $num ?>" />
  <td><?php echo $num ?></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>4</td>
  <td>เรื่องที่กำลังดำเนินการ</td>
  <?php
  	$sql4="SELECT * from request_lists where systemid='".$sysid."' AND month(operation_date)='".$s_month."' and year(operation_date)='".$s_year."' and status=2";
	//echo $sql4;
	$result=mysql_query($sql4); 
	$num=mysql_num_rows($result);  
  ?> 
  <input type="hidden" name="list_3" value="<?php echo $num ?>" />
  <td><?php echo $num ?></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td class="B">เรื่องที่ได้รับแจ้งทั้งหมด</td>
   <?php 
	$result=mysql_query("SELECT * from request_lists where systemid='".$sysid."'"); 
	$num=mysql_num_rows($result);  
  ?> 
  <input type="hidden" name="list_4" value="<?php echo $num ?>" />
  <td class="B"><?php echo $num ?></td>
  <td>&nbsp;</td>
 
</tr>
</table>
</form>