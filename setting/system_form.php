
<style type="text/css">

.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">

$().ready(function() {
  $("#frmSystem").validate({
    rules: {
      txtSystem:{
		  required:true,
		  remote:"setting/chk_dup_system.php?name=system"
	  }
    },
    messages: {
      txtSystem:{
		required:"กรุณากรอกชื่อระบบงาน",
	  	remote: "มีข้อมูลนี้แล้ว"
	  }
     }
  });  
});
</script>

<?

//if(@$_GET['id']!='')$row = GetData('System',@$_GET['id']);
if(@$_GET['id']!='')$row = GetData('system',@$_GET['id']);
?>
<h3>ตั้งค่า ชื่อระบบงาน (เพิ่ม / แก้ไข)</h3>
<form name="frmSystem" id="frmSystem" class="commentForm" enctype="multipart/form-data" action="setting.php?act=query&type=System&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_6['CanEdit']; ?>&chk_add=<?php echo $item_6['CanAdd']; ?>" method="post">
<table class="tbadd">
<tr>
  <th>รหัสชื่อระบบงาน</th>
  <td>
      <? if(@$_GET['id']!='')echo $row['Code']; else echo "ระบบจะกำหนดให้อัตโนมัติ"; ?>
  </td>
</tr>
<tr>
  <th>ชื่อระบบงาน <span class="Txt_red_12">*</span></th>
  <td><input name="txtSystem" type="text" id="txtSystem" value="<?=@$row['SystemName'];?>" size="50" /></td>
</tr>
</table>
<div id="boxbtnadd">
  <input type="hidden" name="code" value="<?php echo @$row['Code']?>" />
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>