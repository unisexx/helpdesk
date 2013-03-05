<? 
//include "include/notifybar.php";
//include "include/set_notifybar.php";
	
  $groupsearch = @$_GET['groupsearch'];
  $condition = "WHERE 1 = 1 ";
  $condition .= $groupsearch!='' ? " AND GroupName like '%".$groupsearch."%'" : "";
                $num_pages= 1;
                $page= @$_GET['page']!='' ? @$_GET['page'] : 1;
                  $sql = "select * from section  ".$condition;   
				  //var_dump($sql);
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
                $result = mysql_query($sql) or die("Invalid query: " . mysql_error());    
?>
<h3>ตั้งค่า กลุ่ม/ฝ่าย</h3> 
<div  >มีทั้งหมด <?=$num_rows;?> รายการ  / <?=$num_pages;?> หน้า <div id="pagenavi" ></div></div>
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
 var url='<?php echo $_SERVER['PHP_SELF'].( ! empty($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING']:'')?>';
			<?php  if(!empty($_SERVER['QUERY_STRING'])){ ?>
					url=url+'&act=grouplist&page='+page;											   
			<?php }else{ ?>
					url=url+'?act=grouplist&page='+page;
		   <?php } ?>                                                           
														   
														     
                                                            $(location).attr('href',url);
                                                          }
                            });
                    </script>      
<form method="get">
<div id="search">
<span> ชื่อกลุ่ม / ฝ่าย
<input type="hidden" name="act" id="act" value="grouplist">
<input name= "groupsearch"type="text" id="groupsearch" size="35" value="<?=$groupsearch;?>"> </span>
<span>
<input type="submit" value="search" class="btn_search" />
  </span>
</div>
</form>
<div id="btnBox"><input type="button" value="เพิ่มรายการ"  class="btn_add" onclick="window.location.href='setting.php?act=groupform'"/></div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">รหัส</th>
  <th align="left">ชื่อกลุ่ม/ฝ่าย</th>
  <th align="left">ชื่อกอง/สำนักงาน</th>
  <th align="left">ชื่อกรม</th>
  <th align="left">ลบ</th>
  </tr>
<?
  $i = ($page -1)* $per_page;
  while($row=mysql_fetch_array($result)){
	 $i++;
?>
<tr style="cursor:pointer;">
  <td onclick="window.location='setting.php?act=groupform&id=<?=$row['ID'];?>';" ><?=$i;?></td>
  <td onclick="window.location='setting.php?act=groupform&id=<?=$row['ID'];?>';" ><?=$row['Code'];?></td>
  <td onclick="window.location='setting.php?act=groupform&id=<?=$row['ID'];?>';" ><?=$row['GroupName'];?></td>
  <td onclick="window.location='setting.php?act=groupform&id=<?=$row['ID'];?>';" >
  <?
    $Divis = GetData("division",$row['DivisionID']);
    echo $Divis['DivisionName'];
  ?>
  </td>
  <td>
  <?
    $dept = GetData("department",$row['DeptID']);
    echo $dept['DeptName'];
  ?>
  </td>
  <td><input type="submit" name="delbutton" id="delbutton" value="" class="btn_delete" onclick="ConfirmDelete('setting.php?type=group&act=delete&id=<?=$row['ID'];?>&chk_del=<?php echo $item_4['CanDelete'];?>');" /> </td>
</tr>
<? } ?>
</table>
</form>