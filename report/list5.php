<style type="text/css">
#frmsearch label.error{ color:red; }

</style>
<script>
$(document).ready(function() {	
	 	$('.datepicker').date_input();		
	
//		$("#frmsearch").validate({						
//			rules: {
//			  s_system: "required",
//			  sdate: "required",
//			  edate: "required"
//			
//		
//			},
//			messages: {
//			  s_system: "กรุณาเลือกระบบ", 
//			  sdate: "  กรุณาเลือกปี",      
//			  edate: "  กรุณาเลือกเดือน"
//			 
//			 },
//			 errorPlacement: function(error, element){
//				if (element.is(":radio")) 
//					error.appendTo(element.parent());
//				else 
//					if (element.is(":checkbox")) 
//						error.appendTo(element.next());
//					else 
//						error.width();
//				error.appendTo(element.parent());
//			}					
//		});  
	 
});
</script>


<?php 
  db_connect();
?>
<h3>รายงานรายละเอียดแจ้งปัญหาประจำเดือน (IT Helpdesk 03)</h3> 

<?php 

 
 $where =(@$_GET['s_system']!="")?" and systemid='".@$_GET['s_system']."'":"";
 $where.=(@$_GET['status']!="")? " and status='".@$_GET['status']."'":"";
 if(@$_GET['sdate']=="" && @$_GET['edate']==""){
 	$where.="";
 }else if(@$_GET['sdate']!="" || @$_GET['edate']!=""){
 	if(@$_GET['sdate']!="" && @$_GET['edate']!==""){
		$where.=" and substr(new_date,1,10) between '".DateTH2DB($_GET['sdate'])."' and '".DateTH2DB($_GET['edate'])."'";
	}
	else if($_GET['sdate']!="" ){
		$where.=" and substr(new_date,1,10)='".DateTH2DB($_GET['sdate'])."'";
	}else{
		$where.=" and substr(new_date,1,10)='".DateTH2DB($_GET['edate'])."'";
	}
 }

 $sql="select * from request_lists where 1=1 ".$where;
 //echo $sql;

 $i=1;
 $num_pages= 1;
                $page= @$_GET['page']!='' ? @$_GET['page'] : 1;            
                        $prev_page = $page - 1; 
                        $next_page = $page + 1; 
						
                        $result = mysql_query($sql);
                        $page_start = ( $per_page * $page) - $per_page; 
                        $num_rows = mysql_num_rows($result); 
						
                    
                  if ( $num_rows <= $per_page )
                        $num_pages = 1;                   
                  else if ( ( $num_rows % $per_page ) == 0 )
                        $num_pages = ( $num_rows / $per_page ); 
                  else
                        $num_pages = ( $num_rows / $per_page ) + 1; 
                $num_pages = ( int ) $num_pages; 
                 $sql.= "  ORDER BY id DESC  LIMIT $page_start, $per_page"; 
				//echo $sql;
                $result_1 = mysql_query($sql) or die("Invalid query: " . mysql_error()); 
	


?>
<span style="font-size:12px;">มีทั้งหมด <?php echo  $num_rows;?> รายการ  / <?php echo $num_pages;?> หน้า </span><div id="pagenavi" ></div>
          <script src="../js/jquery.paginate.js" type="text/javascript"></script> 
		  
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
					url=url+'?act=list5&page='+page;
		   <?php } ?>               
                                                            $(location).attr('href',url);
                                                          }
                            });
                    </script>  
<div id="search">

    <form method="GET" id="frmsearch" action="report.php?act=list5">
	<span>
      <select name="s_system">
        <option value="">เลือกระบบงาน</option>
        <?php 
            $sql1="select b.systemname as system,b.id as id from user_systems  a";
			$sql1.=" left join system b on a.systemid=b.id";
			$sql1.=" where userid='".$_SESSION['id']."'";
			
			$result=mysql_query($sql1);
            while($item=mysql_fetch_assoc($result)): 
        ?>
        <option value="<?php echo $item['id'] ?>" <?php echo ($item['id']==@$_GET['s_system'])?"selected":"";?> ><?php echo $item['system']; ?></option> 
        <? endwhile; ?>  
      </select>
      <select name="status">
      	<option value="">เลือกสถานะ</option>
        <?php 
			$sql1="SELECT * FROM problemstatus";
			$result=mysql_query($sql1);
			while($i_status=mysql_fetch_assoc($result)):
		?>
        	<option value="<?php echo $i_status['id']?>" <?php  echo ($i_status['id']==@$_GET['status'])?"selected":"" ?>><?php echo $i_status['name'] ?></option>
        <?php endwhile; ?>
      </select>
      วันที่ <input type="text" name="sdate" class="datepicker" value="<?php echo @$_GET['sdate'] ?>" />
	  ถึง <input  type="text"  name="edate" class="datepicker"  value="<?php echo @$_GET['edate'] ?>"/>
	  
	   <input type="hidden" name="act" value="list5" />
	   <input name="search" type="submit" value="search" class="btn_search" />
	  </span>
	  </form>
</div>

<form action="report/print5.php?chk_export=<?php echo $item_10['CanExport']?> " method="post" id="frmexport" target="_blank">
<div id="btnBox"><input type="submit" value="พิมพ์รายงาน"  class="btn_print" /></div>
<div id="titleReport">
	<?php 
		echo (@$_GET['s_system']!="")? Systemname(@$_GET['s_system']):"";
		echo (@$_GET['sdate']!="")? " ตั้งแต่วันที่ ".@$_GET['sdate']:"";
		echo (@$_GET['edate']!="")? " ถึงวันที่ ".@$_GET['edate']:"";
	?>
	
</div>


<table class="tblist">
<tr>
  <th style="width:100px">ลำดับ</th>
  <th>รายการ</th>
  <th>สถานะ</th>
  <th>วันที่รับแจ้ง</th>
</tr>
<?php 
$i = ($page -1)* $per_page; 
while($item=mysql_fetch_assoc($result_1)){
$i++;

?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $item['title']?></td>
<td><?php echo @GetProblemStatus($item['status'])?></td>
<td><?php echo DB2Date($item['new_date'])?></td>
</tr>
<?php 

} ?>
</table>
<input type="hidden" name="sysname" 	value="<?php echo @Systemname(@$_GET['s_system']) ?>" ? />
<input type="hidden" name="sdate" 		value="<?php echo @$_GET['sdate'] ?>" ? />
<input type="hidden" name="edate" 		value="<?php echo @$_GET['edate'] ?>" ? />
<input type="hidden" name="sql"			value="<?php echo $sql ?>" />
<input type="hidden" name="no"			value="<?php echo ($page -1)* $per_page; ?>" />
<input type="hidden" name="list"        value="list5" />
</form>