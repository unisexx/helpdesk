<?
  //include "include/notifybar.php";
  //include "include/set_notifybar.php";
  $systemsearch = @$_GET['systemsearch'];
  $condition = " WHERE 1 = 1 ";
  $condition .= $systemsearch!='' ? " AND SystemName like '%".$systemsearch."%'" : "";  
                $num_pages= 1;
                $page=@$_GET['page']!='' ? @$_GET['page'] : 1;
                  $sql = "select * from system  ".$condition;    
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
<h3>ตั้งค่า ชื่อระบบงาน</h3>
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
<form method="get">
<div id="search">
<span> ชื่อระบบงาน
<input type="hidden" name="act" id="act" value="systemlist">
<input name= "systemsearch" type="text" id= "systemsearch" size="35" value="<?=$systemsearch;?>"></span>
<span>
<input name="" type="submit" value="search" class="btn_search" />
  </span>
</div>
</form>
<div id="btnBox"><input type="button" value="เพิ่มรายการ"  class="btn_add"  onclick="window.location.href='setting.php?act=systemform'"/></div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">รหัส</th>
  <th align="left">ชื่อระบบงาน</th>
  <th align="left">ลบ</th>
  </tr>
<?
  $i = ($page -1)* $per_page;
  while($row=mysql_fetch_array($result)){
	 $i++;
?>
<tr style="cursor:pointer;">
  <td onclick="window.location='setting.php?act=systemform&id=<?=$row['ID'];?>';" ><?=$i;?></td>
  <td onclick="window.location='setting.php?act=systemform&id=<?=$row['ID'];?>';" ><?=$row['Code'];?></td>
  <td onclick="window.location='setting.php?act=systemform&id=<?=$row['ID'];?>';" ><?=$row['SystemName'];?></td>
  <td> <input type="submit" name="delbutton" id="delbutton" value="" class="btn_delete" onclick="ConfirmDelete('setting.php?type=System&act=delete&id=<?=$row['ID'];?>&chk_del=<?php echo $item_6['CanDelete'];?>');" /> </td>
</tr>
<? } ?>
</table>

