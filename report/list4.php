<?  

 $listSearch = @$_GET['listSearch'];
 $yearsearch = @$_GET['yearsearch'];
 $monthsearch =@$_GET['monthsearch'];
  $condition = " WHERE 1 = 1 ";
  $condition .= $listSearch!='' ? " AND SystemID like '%".$listSearch."%'" : "";  
  $condition .= $yearsearch!='' ? " AND YEAR(SystemDate)='".$yearsearch."'" : "";
  $condition .= $monthsearch!='' ? " AND MONTH(SystemDate)='".$monthsearch."'" : "";
                $num_pages= 1;
                $page= @$_GET['page']!='' ? @$_GET['page'] : 1;
                  $sql = "select * from systemreport  ".$condition;    
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
				 //echo $sql;
                $result = mysql_query($sql) or die("Invalid query: " . mysql_error());    
?>
<h3>รายงาน System & Software</h3>
<div  >มีทั้งหมด <?=$num_rows;?> รายการ  / <?=$num_pages;?> หน้า <div id="pagenavi" ></div></div>
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
                                                            var url = '<?=$PHP_SELF;?>?act=list4&page='+page;         
                                                            $(location).attr('href',url);
                                                          }
                            });
                    </script>      
<form name="frmserver" enctype="multipart/form-data" action="report.php" method="get">
<div id="search"><span>
  <input type="hidden" name="act" id="act" value="list4">
  <select name="listSearch" id="listSearch" value="">
  <option value="">กรุณาเลือกระบบงาน</option>
  <?
  $sql = "SELECT * FROM system ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if($listSearch==$srow['ID'])echo "selected";?> >
  <?=$srow['SystemName']; ?> 
  </option>
  <? } ?>
  </select>
  <select name="yearsearch" id="yearsearch">
    <option value="">กรุณาเลือกปี</option>
    <?
      $ryear = $_GET['yearsearch']!='' ? $_GET['yearsearch'] : date("Y");
      $ryear = $ryear - 5;
      for($i=0;$i<=10;$i++)
      {
      $ryear = $ryear +1;
      ?>
      <option value="<?php echo  $ryear;?>" <?php echo ($ryear==@$_GET['yearsearch'])? "selected" :"" ?>><?=($ryear+543);?></option>
    <? } ?>

  </select>
  <select name="monthsearch" id="monthsearch">
    <option value="">กรุณาเลือกเดือน</option>
    <?
    for($i=1;$i<=12;$i++)
    {
    ?>
      <option value="<?=$i;?>" <?php echo ($i==@$_GET['monthsearch'])? "selected":"" ?>><?=GetMonthName('full',$i);?> </option>
    <?} ?>

  </select>
  <input name="search" type="submit" value="search" class="btn_search" />
  </span>
</div>
</form>
<div id="btnBox"><input type="button" value="เพิ่มรายการ"  class="btn_add"  onclick="window.location.href='report.php?act=form4&chk_add=<?php echo $item_10['CanAdd'];?>'"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อระบบงาน</th>
  <th>วันที่ตรวจสอบฐานข้อมูล</th>
  <th>Server Name</th>
  <th>พิมพ์</th>
  <th>ลบ</th>
  
  </tr>
<?
  $i = ($page -1)* $per_page;
  while($row=mysql_fetch_array($result)){
	 $i++;
?>
<tr style="cursor:pointer;">
 <td onclick="window.location='report.php?act=form4&id=<?=$row['ID'];?>';" ><?=$i;?></td>
 <td onclick="window.location='report.php?act=form4&id=<?=$row['ID'];?>';" >
  <?
    $SystemID = GetData("system",$row['SystemID']);
    echo $SystemID['SystemName'];
  ?>
  </td>
 <td onclick="window.location='report.php?act=form4&id=<?=$row['ID'];?>';" >
 <?=GetThaiDate($row['SystemDate'],'','');?>
 </td>
 <td onclick="window.location='report.php?act=form4&id=<?=$row['ID'];?>';" >
  <?
    $ServerID = GetData("server",$row['ServerID']);
    echo $ServerID['ServerName'];
  ?></td>
<td><input type="button" name="btnPrint" id="btnPrint" value="Print" class="btn_print" onclick="window.open('report/print4.php?id=<?=$row['ID'];?>&chk_export=<?php echo $item_10['CanExport']?>')" /></td> 
<td><input type="button" name="delbutton" id="delbutton" value="" class="btn_delete" onclick="ConfirmDelete('report.php?act=query4&mode=delete&id=<?=$row['ID'];?>&chk_del=<?php echo $item_10['CanDelete'];?>');"/></td>

 </tr>
<? } ?>
</table>