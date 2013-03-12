<?
   include "include/session_config.php";
   include "include/function.php";
   include "include/config.php";
   include "include/class_userlogin.php";
	db_connect();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<? include "_script.php";?>
</head>
<script>
$(document).ready(function() {	
         $('.datepicker').date_input();			
    });
</script>
<body>
<? include "_menu.php" ?>

<?php 

	  if(!isset($pm)){
		$pm=new UserLogin();
	  }
	  if(@$_GET['page']==NULL){
		$pm->AddLog(30);
	  }

	$where  =(@$_GET['name']!="")?" AND userid=(select id from informent where name LIKE '%".$_GET['name']."%')":"";		
	if(@$_GET['s_date']!="" && @$_GET['s_edate']!=""){
		$where .=" AND substr(dates,1,10) Between '".DateTH2DB($_GET['s_date'])."' and '".DateTH2DB($_GET['s_edate'])."'";
	}else{
		if(@$_GET['s_date']!=""){
			$where .=" AND substr(dates,1,10)='".DateTH2DB($_GET['s_date'])."'" ;
		}elseif(@$_GET['s_edate']!=""){
			$where .=" AND substr(dates,1,10)='".DateTH2DB($_GET['s_edate'])."'" ;
		}
	}
	
	 $where .=(@$_GET['s_ip']!="")?" AND ipaddress LIKE'%".$_GET['s_ip']."%'":"";
	 $where .=(@$_GET['s_type']!="") ?" AND substr(detail,1,instr(detail,' '))='".$_GET['s_type']."'":"";
	 
	 $sql_cond=mysql_query("SELECT id from informent where usergroupid='2' and id='".$_SESSION["id"]."'") or die("Error".mysql_error());
	 $res=mysql_fetch_assoc($sql_cond);
	 if($res==NULL){$cond=" and userid='".$_SESSION["id"]."'";}else{$cond="";}
	 $sql  ="SELECT ipaddress,userid,dates,detail FROM hd_logs where 1 ".$cond.$where;
	 
	 $result=mysql_query($sql);
	 $i=1;
	 $per_page=20;
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
                 $sql .= "  ORDER BY dates DESC  LIMIT $page_start, $per_page"; 
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

	var url='<?php echo $_SERVER['PHP_SELF'].( ! empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING']:'')?>';
			<?php  if(!empty($_SERVER['QUERY_STRING'])){ ?>
					url=url+'&page='+page;											   
			<?php }else{ ?>
					url=url+'?page='+page;
		   <?php } ?>
						
		  
						        
                                                            $(location).attr('href',url);
                                                          }
                            });
                    </script> 
<div id="search">
<form method="get" >
    <span>ชื่อ  <input type="text" size="35" name="name" value="<?php echo @$_GET['name'] ?>"/>
   วันที่ <input type="text" name="s_date" class="datepicker" style="width:100px;" value="<?php echo @$_GET['s_date'];?>" />ถึงวันที่
     <input type="text" name="s_edate" class="datepicker" style="width:100px;" value="<?php echo @$_GET['s_edate'];?>" />
	IP <input type="text" name="s_ip"  value="<?php echo @$_GET['s_ip']?>" />
    <select name="s_type">
    <option value="">เลือกประเภท</option>
    <option value="view">view</option>
    <option value="add">add</option>
    <option value="edit">edit</option>
    <option value="delete">delete</option>
    </select>
	<input name="search" type="submit" value="search" class="btn_search" />
    </span>
</form>
</div>
<div id="page">
<h3>ประวัติการใช้งาน</h3>
<table class="tblist">
  <tr>
  <th align="left">ลำดับ</th>
  <th align="left">วัน เดือน ปี เวลา</th>
  <th align="left">ชื่อ-สกุล</th>
  <th align="left">รายละเอียด</th>
  <th align="left">IP Address</th>
  </tr>
  <?php 

	$logs=new UserLogin();
	$j=0;
	$i = ($page -1)* $per_page;
	while($item=mysql_fetch_assoc($result)):
	$i++;

  ?>
  <tr style="padding:5px;margin:5px;">
  <td style="width:30px"><?php echo $i;?></td>
  <td style="width:50px"><?php echo GetThaiDate($item['dates'],1,1)?></td>
  <td style="width:80px"><?php echo  GetUser($item['userid'],'user');?></td>
  <td style="width:300px"><?php echo $item['detail']?></td>
  <td style="width:150px"><?php echo $item['ipaddress'] ?></td>
  </tr>
 <?php endwhile; ?>

</table>

</div>

</body>
</html>
