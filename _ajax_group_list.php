<?
include "include/config.php";
db_connect();

?>
   <select name="division" id="division" onchange="ReloadSectionList(this.value);" >
  <option value="">กรุณาเลือกกอง/สำนัก</option>
  <?
  $condition = $_GET['id'] !='' ? " WHERE deptid='".$_GET['id']."'" : "" ;
  $sql = "SELECT * FROM division ".$condition;  
  $sresult = mysql_query($sql) or die("Error group query :".mysql_error());
  while($srow=mysql_fetch_array($sresult)):
  ?>
  <option value="<?php echo $srow['ID'];?>"?> 
   <?php echo $srow['DivisionName'];?>
  </option>
  <?php endwhile; ?>
</select>
