<style type="text/css">

.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">


$().ready(function() {
  $("#frmdepartment").validate({
    rules: {
      txtDeptName:{
		  required:true,
		  remote:"setting/chk_dup_system.php?name=department"
	  },
      
    },
    messages: {
      txtDeptName: {
		  required:"  กรุณากรอกชื่อกรม",
		  remote:"มีข้อมูลนี้แล้ว"
	  }
   }
  });  
});
</script>

<?
//if(@$_GET['id']!='')$row = GetData('Department',@$_GET['id']);
if(@$_GET['id']!='')$row = GetData('department',@$_GET['id']);
?>
<h3>ตั้งค่า กรม (เพิ่ม / แก้ไข)</h3>
<form name="frmdepartment" id="frmdepartment" class="commentForm" enctype="multipart/form-data" action="setting.php?act=query&type=department&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_2['CanEdit']; ?>&chk_add=<?php echo $item_2['CanAdd']; ?>" method="post">
<table class="tbadd">
<tr>
  <th>รหัสกรม</th>
  <td>
      <? if(@$_GET['id']!='')echo $row['Code']; else echo "ระบบจะกำหนดให้อัตโนมัติ"; ?>
  </td>
</tr>
<tr>
  <th>ชื่อกรม <span class="Txt_red_12">*</span></th>
  <td><input name="txtDeptName" type="text" id="txtDeptName" value="<?php echo @$row['DeptName'];?>" size="50" /></td>
</tr>
</table>
<div id="boxbtnadd">
   <input type="hidden" name="code" value="<?php echo @$row['Code']?>" />
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>


</form>