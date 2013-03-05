
<script>
$(document).ready(function() {	
         $('.datepicker').date_input();			
    });
</script>
<script type="text/javascript">	
	function alert_del(id){
		var answer = confirm("ยืนยันการลบ");
		if (answer){
			window.location="request_list.php?act=delete&id="+id;
		}
	}
	
</script>
<? 
db_connect(); 
?>
<h3>รายการที่แจ้ง</h3>

<?php	
	 
	
	$p_name=(@$_POST['name']!="")?" and (a.code='".$_POST['name']."' or coordinatorid=(select id from informent where name LIKE '%".$_POST['name']."%') or responsibleid=(select id from informent where name LIKE '%".@$_POST['name']."'))" :"";
	$p_system=(@$_POST['s_system']!="")?" and systemid='".$_POST['s_system']."'" :"";
	$p_newdate=(@$_POST['new_date']!="")?" and substr(new_date,1,10)='".DateTH2DB($_POST['new_date'])."'" :"";
	$p_status=(@$_POST['s_status']!="")?" and status='".$_POST['s_status']."'" :"";
	
?>
<?php  
	   
	   if($_SESSION['usertype']=='4'){ // ผู้ใช้งาน
		   $sql="select a.*,b.* from request_lists a";
		   $sql .=" inner join informent b on a.orderid=b.id where a.orderid='".@$_SESSION["id"]."'".$p_name.$p_system.$p_newdate.$p_status;
			

		
	   }else if( $_SESSION['usertype']=='3'){  // เจ้าของระบบ
		    $sql="select * from request_lists a ";
			$sql .=" where (chk_send='send' or orderid='".@$_SESSION['id']."')";
			$sql .=" and systemid in(select b.systemid from informent a";
			$sql .=" left join user_systems b on a.id=b.userid";
			$sql .=" where a.usertypeid='3' and a.id='".@$_SESSION['id']."')".$p_name.$p_system.$p_newdate.$p_status;
			//$sql .="ORDER BY a.id";

	   }else if($_SESSION['usertype']=='1' ){//ผู้รับผิดชอบ
		   $sql="select * from request_lists a where 1=1 ".$p_name.$p_system.$p_newdate.$p_status;
		   //$sql .="ORDER BY id";
		  

	   }else if ($_SESSION['usertype']=='2'){//ผู้ประสานงาน 
	   	   $sql  ="select a.*,b.* from request_lists a";
		   $sql .=" inner join informent b on a.coordinatorid=b.id where a.coordinatorid='".@$_SESSION['id']."'".$p_name.$p_system.$p_newdate.$p_status;
		  // $sql .="ORDER BY a.id";
	   }
	   
	   		$view="select canaccessall from usergroup where canaccessall='1' and id=".$_SESSION['usergroupid'];
			$result=mysql_query($view) or die ("Error:".mysql_error());
			$item=mysql_fetch_assoc($result);
				if($item['canaccessall']=="1"){
					$sql="select a.* from request_lists a where 1=1";
				}

	  $result_1=mysql_query($sql); 	   
	  $i=1;
	  $num_pages= 1;
                $page= @$_GET['page']!='' ? @$_GET['page'] : 1;            
                        $prev_page = $page - 1; 
                        $next_page = $page + 1; 
						//var_dump($sql);exit;
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
                 $sql .= "  ORDER BY a.ID DESC  LIMIT $page_start, $per_page"; 
				
                $result = mysql_query($sql) or die("Invalid query: " . mysql_error()); 
?>

<span style="font-size:12px;">มีทั้งหมด <?=$num_rows;?> รายการ  / <?=$num_pages;?> หน้า </span><div id="pagenavi" ></div>
          <script src="js/jquery.paginate.js" type="text/javascript"></script>  
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
                                                            var url = '<?=$PHP_SELF;?>?page='+page;         
                                                            $(location).attr('href',url);
                                                          }
                            });
                    </script>  
<div id="search">
<form method="POST" id="frmsearch">
    <span>รหัส /ชื่อผู้แจ้ง /ชื่อผู้รับผิดชอบ / ชื่อผู้ประสานงาน 
      <input type="text" size="35" name="name"/></span>
    <span>
      วันที่แจ้ง
    <input type="text" name="new_date" class="datepicker" style="width:100px;" value="<?php echo @$_POST['new_date'];?>" />
      <select name="s_system">
            <option value="">เลือกระบบงาน</option>
            <?php 
                $sql="select b.systemname as system,b.id as id from user_systems  a";
                $sql.=" left join system b on a.systemid=b.id";
                $sql.=" where userid='".$_SESSION['id']."'";
                $result=mysql_query($sql);
                while($item=mysql_fetch_assoc($result)): 
            ?>
            <option value="<?php echo $item['id'] ?>" <?php echo (@$_POST['s_system']==$item['id'])?"selected":"";?> ><?php echo $item['system']; ?></option> 
            <? endwhile; ?> 
        </select>
      <select name="s_status">
        <option value="">ทุกสถานะ</option>
        <?php
            $result=mysql_query("select * from problemstatus");
            while($item=mysql_fetch_assoc($result)):
        ?>
        <option value="<?php echo $item['id']?>"  <?php echo (@$_POST['s_status']==$item['id'])?"selected":""; ?>><?php echo $item['name'] ?></option>
        <?php endwhile; ?>
      </select>
      <input name="search" type="submit" value="search" class="btn_search" />
      </span>
</form>
 </div>
  

<div id="btnBox">
 <!-- <input type="button" value="เพิ่มรายการ" onclick="document.location.href='request_list.php?act=form'" alt="ผู้รับผิดชอบ" class="btn_add"/> -->
 <!--<input type="button" value="เพิ่มรายการ" onclick="document.location.href='request_list.php?act=form_coordinator'" alt="ผู้ประสานงาน" class="btn_add"/> -->
 <!-- <input type="button" value="เพิ่มรายการ" onclick="document.location.href='request_list.php?act=form_user'" alt="ผู้ใช้งาน" class="btn_add"/>-->
 <input type="button" value="เพิ่มรายการ" onclick="document.location.href='request_list.php?act=form'"  class="btn_add" />
</div>
<table class="tblist" >
<tr>
  <th>ลำดับ</th>
  <th>รหัส</th>
  <th>วันที่</th>
  <th>ประเภทปัญหา</th>
  <th>ชื่อระบบงาน</th>
  <th>สถานะ</th>
   <?php if($_SESSION['usertype']=='1' || $_SESSION['usertype']=='2' ): ?>
  <th>ชื่อผู้แจ้ง</th>  
  <th>ผู้รับผิดชอบ</th>
  <th>ผู้ประสานงาน</th>
  <?php endif; ?>
  <th>ลบ</th>
  </tr>


<?php
	$j=0;
	$i = ($page -1)* $per_page; 
	while($item=mysql_fetch_assoc($result_1)):
	$i++;
  ?>

<tr >
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;"><?php echo ++$j ?></td>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;"><?php echo $item['code'] ?></td>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;">
  	<img src="images/calendar_ico.gif" width="30" height="30" title="แจ้งใหม่:<?php echo DB2Date($item['new_date'])?> <br> ดำเนินการ: <?php echo DB2Date($item['operation_date']) ?><br> แก้ไขเรียบร้อย: <?php echo DB2Date($item['complete_date'])?> <br> ยืนยันจบ:<?php echo DB2Date($item['confirm_date'])?>" class="vtip"/>
  </td>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;"><?php echo GetProblemType($item['problemtype']); ?></td>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'"style="cursor:pointer;"><?php echo GetSystem($item['id'],true) ?></td>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;">
  	<img src="images/<?php  echo GetProblemStatus($item['status'],true);  ?>" width="32" height="32" title="<?php  echo GetProblemStatus($item['status'],false);  ?>" class="vtip" />
  </td>
  <?php if($_SESSION['usertype']=='1' || $_SESSION['usertype']=='2' ): ?>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;">
  	<?php $rs=GetUser($item['orderid'],'order')?><span title="หน่วยงาน :<?php echo GetDiv($item['orderid'])?><br>เบอร์ติดต่อ :<?php echo $rs['tel']?>" class="vtip"><?php echo $rs['name']; ?></span>
  </td>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;"><?php echo GetUser($item['responsibleid'],'response')?></td>
  <td onclick="window.location='request_list.php?act=form&id=<?php echo $item['id']?>'" style="cursor:pointer;"><?php echo ($item['coordinatorid']==0)?"-": GetUser($item['coordinatorid'],'coor');?></td>
  <?php endif; ?>
  <td onclick="javascript:alert_del(<?php echo $item['id']?>);" style="cursor:pointer;"><input type="button" name="button" id="button" value="X" class="btn_delete"/></td>
 
  </tr>
<tr>
<?php endwhile; ?> 

</table>
<div id="status">
	<img src="images/new.png" width="32" height="32" title="รายการใหม่" />รายการใหม่
    <img src="images/process.png" width="32" height="32" title="กำลังดำเนินการ"/>กำลังดำเนินการ
    <img src="images/yes.png" width="32" height="32" title="แก้ไขเรียบร้อย"/>เรียบร้อย
    <img src="images/confirm.png" width="32" height="32" title="ยืนยันจบ" />ยืนยันจบ
</div>

      