<?
include "include/config.php";
db_connect();
?>
  <select name="serverbox" id="serverbox">
  <option value="">กรุณาเลือก Server</option>
  <?
  $sql = "SELECT * FROM server WHERE SystemID =".$_GET['id'];
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?php echo $srow['ID'];?>"><?php echo $srow['ServerName'];?></option>
  <? } ?>
</select>