<style type="text/css">

.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">
$.validator.setDefaults({
  submitHandler: function() { $("#frmserver").submit();}
});

$().ready(function() {
  $("#frmserver").validate({
    rules: {
      systembox: "required",
      servername: "required",
      os: "required",
      networkaddress: "required",
      disksize: "required",
      databasename: "required",
      size: "required",
      pathdataname: "required",
      pathsoftware: "required",
      startapp: "required",
      stopapp: "required"
      
    },
    messages: {
      systembox: "  กรุณาเลือกระบบงาน",
      servername: "  กรุณากรอกข้อมูล",
      os: "  กรุณากรอกข้อมูล",
      networkaddress: "  กรุณากรอกข้อมูล",
      disksize: "  กรุณากรอกข้อมูล",
      databasename: "  กรุณากรอกข้อมูล",
      size: "  กรุณากรอกข้อมูล",
      pathdataname: "  กรุณากรอกข้อมูล",
      pathsoftware: "  กรุณากรอกข้อมูล",
      startapp: "  กรุณากรอกข้อมูล",
      stopapp: "กรุณากรอกข้อมูล  "
     }
  });  
});
</script>

<?php
if(@$_GET['id']!='')$row = GetData('server',@$_GET['id']);

?>
<h3>ตั้งค่า Server (เพิ่ม / แก้ไข)</h3>
<form name="frmserver" id="frmserver" class="commentForm" enctype="multipart/form-data" action="setting.php?act=query&type=server&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_7['CanEdit']; ?>&chk_add=<?php echo $item_7['CanAdd']; ?>" method="post">
<table class="tbadd">
<tr>
  <th>ชื่อระบบงาน <span class="Txt_red_12">*</span></th>
  <td><select name="systembox" id="systembox">
  <option value="">กรุณาเลือกระบบงาน</option>
  <?
  $sql = "SELECT * FROM system ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if(@$row['SystemID']==$srow['ID'])echo "selected";?> >
  <?=$srow['SystemName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th colspan="2">System Configuration</th>
</tr>
<tr>
  <th class="padL15">Server Name(hostname) <span class="Txt_red_12">*</span></th>
  <td><input name="servername" type="text" id="servername" value="<?=@$row['ServerName'];?>" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Operating System <span class="Txt_red_12">*</span></th>
  <td><input name="os" type="text" id="os" value="<?=@$row['Os'];?>" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Network Address <span class="Txt_red_12">*</span></th>
  <td><input name="networkaddress" type="text" id="networkaddress" value="<?=@$row['NetworkAddress'];?>" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Disk Size <span class="Txt_red_12">*</span></th>
  <td><input name="disksize" type="text" id="disksize" value="<?=@$row['DiskSize'];?>" size="20" /></td>
</tr>
<tr>
  <th colspan="2">System Service</th>
  </tr>
<tr>
  <th class="padL15">Port Running</th>
  <td><input name="portrunning" type="text" id="portrunning" value="<?=@$row['PortRunning'];?>" size="5" /></td>
</tr>
<tr>
  <th valign="top" class="padL15">Process Runing</th>
  <td><textarea name="processrunning" cols="47" id="processrunning"><?=@$row['ProcessRunning'];?></textarea></td>
</tr>
<tr>
  <th colspan="2">System Database</th>
  </tr>
<tr>
  <th valign="top" class="padL15">Database Name <span class="Txt_red_12">*</span></th>
  <td><textarea name="databasename" cols="47" id="databasename"><?=@$row['DatabaseName'];?></textarea></td>
</tr>
<tr>
  <th class="padL15">Size <span class="Txt_red_12">*</span></th>
  <td><input name="size" type="text" id="size" value="<?=@$row['Size'];?>" size="20" /></td>
</tr>
<tr>
  <th valign="top" class="padL15">Path Data Name <span class="Txt_red_12">*</span></th>
  <td><textarea name="pathdataname" cols="47" id="pathdataname"><?=@$row['PathDataName'];?></textarea></td>
</tr>
<tr>
  <th colspan="2">Software Application</th>
  </tr>
<tr>
  <th class="padL15">Path Software <span class="Txt_red_12">*</span></th>
  <td><input name="pathsoftware" type="text" id="pathsoftware" value="<?=@$row['PathSoftware'];?>" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Start Application <span class="Txt_red_12">*</span></th>
  <td><input name="startapp" type="text" id="startapp" value="<?=@$row['StartApp'];?>" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Stop Application <span class="Txt_red_12">*</span></th>
  <td><input name="stopapp" type="text" id="stopapp" value="<?=@$row['StopApp'];?>" size="50" /></td>
</tr>
<tr>
  <th colspan="2">FTP Account</th>
  </tr>
<tr>
  <th class="padL15">IP/FTP </th>
  <td><input name="ip_ftp" type="text" id="" value="" size="50" /></td>
</tr>
<tr>
  <th class="padL15">IP/FTP (Public)</th>
  <td><input name="ip_ftp_public" type="text" id="input" value="" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Port</th>
  <td><input name="port" type="text" id="input2" value="" size="5" /></td>
</tr>
<tr>
  <th class="padL15">Username</th>
  <td><input name="username" type="text" id="input3" value="" size="30" /></td>
</tr>
<tr>
  <th class="padL15">Password</th>
  <td><input name="password" type="text" id="input4" value="" size="30" /></td>
</tr>
</table>
<div id="boxbtnadd">
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>