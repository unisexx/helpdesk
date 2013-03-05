<script>
function ViewUsergroupPermission(pID)
{
  var url = "ajax_usergroup_permission.php?id="+pID;
  urlEncode(url, false)
  ajaxpage(url, 'dvAjaxBody');
  centerPopup();loadPopup();
}
</script>
<?php
 //include "include/notifybar.php";
 //include "include/set_notifybar.php";
$num_pages= 1;
								$page= @$_GET['page']!='' ? @$_GET['page'] : 1;
									$sql = "select * from usergroup where 1 ";
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
<h3>ตั้งค่า สิทธิ์การใข้งาน</h3>
<div  >มีทั้งหมด <?=$num_rows;?> รายการ  / <?=$num_pages;?> หน้า <div id="pagenavi" ></div></div>
					<script src="js/jquery.paginate.js" type="text/javascript"></script>	
                    <script type="text/javascript">
                                $("#pagenavi").paginate({
                                count 		: <?=$num_pages;?>,
                                start 		: <?=$page;?>,
                                display     : 10,
                                border					: false,
                                text_color  			: '#888',
                                background_color    	: '#EEE',	
                                text_hover_color  		: 'black',
                                background_hover_color	: '#CFCFCF',
                                images					: false,
                                mouse					: 'press',
                                                onChange     			: function(page){											
                                                            var url = '<?=$PHP_SELF;?>?page='+page;					
                                                            $(location).attr('href',url);
                                                          }
                            });
                    </script>      

<div id="btnBox"><input type="button" value="เพิ่มรายการ" onclick="document.location='usergroup.php?act=form'" class="btn_add"/></div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">รหัส</th>
  <th align="left">สิทธิ์การใช้งาน</th>

  <th align="left">ความสามารถในการใช้งาน</th>
  <th align="left">วันที่</th>
  <th align="left">ลบ</th>
  </tr>
<?
  $i = ($page -1)* $per_page;
  while($rs=mysql_fetch_array($result)){
	 $i++;
?>
<tr>
  <td onclick="window.location='usergroup.php?act=form&id=<?=$rs['ID'];?>';" style="cursor:pointer;"><?=$i;?></td>
  <td onclick="window.location='usergroup.php?act=form&id=<?=$rs['ID'];?>';" style="cursor:pointer;"><?=$rs['Code'];?></td>
  <td onclick="window.location='usergroup.php?act=form&id=<?=$rs['ID'];?>';" style="cursor:pointer;"><?=$rs['UserGroupName'];?></td>

  <td onclick="ViewUsergroupPermission(<?=$rs['ID'];?>);" style="cursor:pointer;">ดูความสามารถ</td>
  <td onclick="window.location='usergroup.php?act=form&id=<?=$rs['ID'];?>';" style="cursor:pointer;"><?=GetThaiDate($rs['UserDate'],0,0);?></td>
  <td><input type="submit" name="delbutton" id="delbutton" value="" class="btn_delete" onclick="ConfirmDelete('usergroup.php?&act=delete&id=<?=$rs['ID'];?>&chk_del=<?php echo $item_9['CanDelete'];?>');" /> </td>
</tr>
<?  } ?>

</table>
<div id="popupContact" style="width:800px;height:500px; z-index:1000">
<div id="dvAjaxBody"></div>
</div>
<div id="backgroundPopup" onclick="disablePopup();" style="z-index:999"></div> 

</div>