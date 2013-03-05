<?
include "include/config.php";
db_connect();

?>
 <select name="section" id="section" >
  <option value="">กรุณาเลือกกลุ่ม/ฝ่าย</option>
  <?
   $condition = ($_GET['id'] !='') ? " WHERE divisionid='".$_GET['id']."'" : "" ;
  $sql = "SELECT * FROM section ".$condition;
  
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" >
  <?=$srow['GroupName'];?>
  </option>
  <? } ?>
</select>