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

<h3>รายงาน รายงานข้อผิดพลาดของระบบงาน</h3> 


<?php 
		
		
		//$sql="select * from request_lists where ".$s_system.$_POST['s_system'].$s_year.$_POST['s_year'].$s_month.$_POST['s_month'];
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
			
			
			
		   
		    switch($_SESSION['usertype']){
			case "1": 
					$type="";
					break;
			case "2":
				//$type=" and coordinatorid=".$_SESSION['id'];	
				$type="";		
				break;
			case "3" or "4": 
				$type=" and orderid=".$_SESSION['id'];	

				break;
			}
			
			$sql="SELECT * from request_lists where systemid='".$sysid."' AND month(new_date)=".$s_month." and year(new_date)='".$s_year."'";	
			$sql =$sql.$type; 
			
			$i=1;
			$per_page=10;
			$num_pages=1;
                $page= @$_GET['page']!='' ? @$_GET['page'] : 1;              
                        $prev_page = $page - 1; 
                        $next_page = $page + 1; 
                        $result = mysql_query($sql);
                        $page_start = ( $per_page * $page) - $per_page; 
                        $num_rows = mysql_num_rows( $result ); 
                        
                  if ( $num_rows <= $per_page )
                        $num_pages = 1;                   
                  else if ( ( $num_rows % $per_page ) == 0 )
                        $num_pages = ( $num_rows / $per_page ); 
                  else
                        $num_pages = ( $num_rows / $per_page ) + 1; 
                $num_pages = ( int ) $num_pages; 
                 $sql .= "  ORDER BY ID  DESC  LIMIT $page_start, $per_page"; 
				
                $result_1 = mysql_query($sql) or die("Invalid query: " . mysql_error());   
				
		

	?>
    
<span style="font-size:12px;">มีทั้งหมด <?=$num_rows;?> รายการ  / <?=$num_pages;?> หน้า </span><div id="pagenavi" ></div>
         <script  src="../js/jquery.paginate.js"type="text/javascript"></script>   
                    <script type="text/javascript">
                                $("#pagenavi").paginate({
                                count     : <?=$num_pages;?>,
                                start     : <?=$page;?>,
                                display     : 10,
                                border          : false,
                                text_color        : '#888',
                                background_color      : '#EEE', 
                                text_hover_color      : 'black',
                                background_hover_color  : '#CFCFCF',
                                images          : false,
                                mouse         : 'press',

												onChange          : function(page){                     

 var url='<?php echo $_SERVER['PHP_SELF'].( ! empty($_SERVER['QUERY_STRING'])? '?'.$_SERVER['QUERY_STRING']:'')?>';
			<?php  if( ! empty($_SERVER['QUERY_STRING'])){ ?>	

			
					url=url+'&page='+page;											   
			<?php }else{ ?>
					url=url+'?act=list3&page='+page;
		   <?php } ?>                                                          

                                                            $(location).attr('href',url);
                                                          }
                            });
                    </script>  
    <div id="search">
	<span>
    <form method="get" id="frmsearch"  action="report.php?act=list3">
	
      <select name="s_system">
        <option value="">เลือกระบบงาน</option>
        <?php 
            $sql="select b.systemname as system,b.id as id from user_systems  a";
			$sql.=" left join system b on a.systemid=b.id";
			$sql.=" where userid='".$_SESSION['id']."'";
			$result=mysql_query($sql);
            while($item=mysql_fetch_assoc($result)): 
        ?>
        <option value="<?php echo $item['id']; ?>" <?php echo ($item['id']==@$_GET['s_system'])?"selected":"";?>><?php echo $item['system']; ?></option> 
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
        <option value="<?php echo $i?>" <?php echo ($i==@$_GET['s_month'])?"selected":"";?>><?php echo GetMonthName('full',$i) ?></option>
        <?php endfor; ?>
      </select>
		<input type="hidden" name="act" id="act" value="list3">
      <input  name="submit" type="submit" value="search" class="btn_search" /> 
	  
      </form>
  </span>
</div> 


<?php $s_sysname= Systemname(@$sysid); ?>  
<div id="titleReport"><?php echo $s_sysname." ประจำเดือน".GetMonthName('full',@$s_month)." ปี ".@$s_year_th=$s_year+543; ?></div>
<input type="hidden" name="sysname" 	value="<?php echo Systemname(@$sysid)?>" />
<input type="hidden" name="s_month" 	value="<?php echo GetMonthName('full',@$s_month)?>" />
<input type="hidden" name="s_year" 		value="<?php echo $s_year_th ?>" />
<input type="hidden" name="list"        value="list3" />

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อ-สกุล ผู้แจ้ง</th>
  <th>ชื่อ-สกุล ผู้รับแจ้ง</th>
  <th>ผลการแก้ไข</th>
  <th>วันที่แจ้ง</th>
  <th>พิมพ์</th>
  </tr>
<?php 
	$i = ($page -1)* $per_page; 
	while($item=mysql_fetch_assoc($result_1)):
	$i++;			
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo GetUser($item['orderid'],'user')?></td>
  <td><?php echo GetUser($item['responsibleid'],'user')?></td>
  <td><?php echo GetProblemStatus($item['status'],false)?></td>
  <td><?php echo  GetThaiDate($item['new_date'],1,1) ?></td>
  <td><a class="btn_print" href="report/print3.php?id=<?php echo $item['id']?>&chk_export=<?php echo $item_10['CanExport']; ?>&s_year=<?php echo @$s_year_th?>&system=<?php echo $s_sysname ?>&s_month=<?php echo GetMonthName('full',@$s_month)?>" target="_blank"></a></td>
 
 </tr>
<?php endwhile; ?>
</table>

