<?
   //include "include/notifybar.php";
   //include "include/set_notifybar.php";
	
  
  
  $problemsearch = @$_GET['problemsearch'];
  $condition = " WHERE 1 = 1 ";
  $condition .= $problemsearch!='' ? " AND ProblemName like '%".$problemsearch."%'" : "";  
                $num_pages= 1;
                $page= @$_GET['page']!='' ? @$_GET['page'] : 1;
                $sql = "select * from problemtype  ".$condition;  
						
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
                $sql .= "  ORDER BY ID    LIMIT $page_start, $per_page"; 
                $result = mysql_query($sql) or die("Invalid query: " . mysql_error()); 
				
?>
<h3>ตั้งค่า ประเภทปัญหา</h3>
<div  >มีทั้งหมด <?php  echo $num_rows;?> รายการ  / <?php  echo $num_pages;?> หน้า <div id="pagenavi" ></div></div>
          <script src="../js/jquery.paginate.js" type="text/javascript"></script>  
                    <script type="text/javascript">
                                $("#pagenavi").paginate({
                                count     : <?php  echo $num_pages;?>,
                                start     : <?php  echo $page;?>,
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
<span> ชื่อประเภทปัญหา
<input type="hidden" name="act" id="act" value="problemlist">
<input name= "problemsearch" type="text" id= "problemsearch" size="35" value="<?php  echo $problemsearch;?>"></span>
<span>
<input name="" type="submit" value="search" class="btn_search" />
  </span>
</div>
</form>

<div id="btnBox"><input type="button" value="เพิ่มรายการ"  class="btn_add" onclick="document.location.href='setting.php?act=problemform'"/></div>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">รหัส</th>
  <th align="left">ชื่อประเภทปัญหา</th>
  <th align="left">ตัวย่อ</th>
  <th align="left">ลบ</th>
  </tr>
<?
  $i = 0;
  while($row = mysql_fetch_array($result)){
  $i=$i+1; 
?> 

  <tr style="cursor:pointer;">
  <td onclick="window.location='setting.php?act=problemform&id=<?php  echo $row['ID'];?>';" ><?php  echo $i;?></td>
  <td onclick="window.location='setting.php?act=problemform&id=<?php  echo $row['ID'];?>';" ><?php  echo $row['Code'];?></td>
  <td onclick="window.location='setting.php?act=problemform&id=<?php  echo $row['ID'];?>';" ><?php  echo $row['ProblemName'];?></td>
  <td onclick="window.location='setting.php?act=problemform&id=<?php  echo $row['ID'];?>';" ><?php  echo $row['abbr'];?></td>
  
 <td> <input type="submit" name="delbutton" id="delbutton" value=""  class="btn_delete" onclick="ConfirmDelete('setting.php?type=problemtype&act=delete&id=<?php  echo $row['ID'];?>&chk_del=<?php echo $item_1['CanDelete']; ?>');" /> </td>
  </tr>
<? } ?>
</table>

