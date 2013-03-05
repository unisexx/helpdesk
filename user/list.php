<?php
 
 if(!isset($_SESSION["show"])){	
 	if($_GET['page']==NULL){
		$pm->AddLog(34);
	}
 }
 
 //include "include/notifybar.php";
 //include "include/set_notifybar.php";
 $usersearch =@$_GET['usersearch'];
 $usergroup = @$_GET['usergroup'];
 $section =@$_GET['section'];

  $condition = " WHERE 1 = 1 ";
  //$condition = " WHERE  1 = 1 AND id= ".$_SESSION['id'];
  $condition .= $usersearch!='' ? " AND (Name LIKE  '%".$usersearch."%' OR Code LIKE  '%".$usersearch."%') " : ""; 
  $condition .= $usergroup != '' ?  " AND UserGroupID = ".$usergroup : "";  
  $condition .= $section != '' ?  " AND DivisionID = ".$section : "";  
                $num_pages= 1;
                $page= @$_GET['page']!='' ? @$_GET['page'] : 1;
                  $sql = "select * from informent  ".$condition;    
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
<h3>ข้อมูลผู้แจ้ง</h3>
<div  >มีทั้งหมด <?=$num_rows;?> รายการ  / <?=$num_pages;?> หน้า <div id="pagenavi" ></div></div>
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
<form name="frmuser" enctype="multipart/form-data" action="user.php" method="get">
<div id="search">
<span>รหัส / ชื่อผู้แจ้ง 
  <input type="hidden" name="act" id="act" value="list">
  <input name= "usersearch"type="text" id="usersearch" value="<?=$usersearch;?>" size="35" /></span>
<span>
 <td><select name="usergroup" id="usergroup">
  <option value="">ทุกสิทธิ์การใช้งาน</option>
  <?
  $sql = "SELECT * FROM usergroup ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if($usergroup==$srow['ID'])echo "selected";?> >
  <?=$srow['UserGroupName'];?>
  </option>
  <? } ?>
</select>
  <select name="section" id="section">
  <option value="">ทุกหน่วยงาน</option>
  <?
  $sql = "SELECT * FROM division ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if($section==$srow['ID'])echo "selected";?> >
  <?=$srow['DivisionName'];?>
  </option>
  <? } ?>
</select>
  <input name="" type="submit" value="search" class="btn_search" />
  </span>
</div>
<div id="btnBox"><input type="button" value="เพิ่มรายการ"  onclick="document.location='user.php?act=form&chk_add=<?php echo $item_10['CanAdd'] ?>'" class="btn_add"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>รหัส</th> 
  <th>ชื่อ-สกุล ผู้แจ้ง</th>
  <th>สิทธิ์การใช้งาน</th>
  <th>หน่วยงาน(กอง/สำนัก)</th>
  <th>เบอร์ติดต่อกลับ</th>
  <th>วันที่ลงทะเบียน</th>
  <th>ลบ</th>
  </tr>

<?
  $i = ($page -1)* $per_page; 
  while($row = mysql_fetch_array($result_1)){
  $i++;
?>  
 

<tr style="cursor:pointer;">
  <td onclick="window.location='user.php?act=form&id=<?=$row['ID'];?>';" ><?=$i;?></td>
  <td onclick="window.location='user.php?act=form&id=<?=$row['ID'];?>';" ><?=$row['Code'];?></td>
  <td onclick="window.location='user.php?act=form&id=<?=$row['ID'];?>';" ><?=$row['Name']." ".$row['lastname'];?></td>
  <td onclick="window.location='user.php?act=form&id=<?=$row['ID'];?>';" ><?
    $Group = GetData("usergroup",$row['UserGroupID']);
    echo $Group['UserGroupName'];
  ?></td>
  <td onclick="window.location='user.php?act=form&id=<?=$row['ID'];?>';" >
  <?
    $Divi = GetData("division",$row['DivisionID']);
    echo $Divi['DivisionName'];
  ?>
  </td>
  <td onclick="window.location='user.php?act=form&id=<?=$row['ID'];?>';" ><?=$row['Tel'];?></td>
  <td onclick="window.location='user.php?act=form&id=<?=$row['ID'];?>';" ><?=GetThaiDate($row['DateRegister'],1,1);?></td>
  <td>
  <input type="button" name="delbutton" id="delbutton" value="" class="btn_delete" onclick="ConfirmDelete('user.php?act=delete&id=<?=$row['ID'];?>&chk_del=<?php  echo $item_10['CanDelete'];?>');" /></td>
</tr>
<?  } ?>

</table>
