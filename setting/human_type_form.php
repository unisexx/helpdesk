<style type="text/css">

.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">

$().ready(function() {
  $("#frmHumanType").validate({
    rules: {
      HumanTypeName:{
	  	required:true
		
	  }
      
    },
    messages: {
      HumanTypeName:{
		 required:"  กรุณากรอกชื่อประเภทบุคลากร"
		
	  }
     }
  });  
});
</script>

<?
//if(@$_GET['id']!='')$row = GetData('HumanType',@$_GET['id']);
if(@$_GET['id']!='')$row = GetData('humantype',@$_GET['id']);
?>
<form name="frmHumanType" id="frmHumanType" class="commentForm"  action="setting.php?act=query&type=humantype&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_5['CanEdit']; ?>&chk_add=<?php echo $item_5['CanAdd']; ?>" method="post">
<h3>ตั้งค่า ประเภทบุคลากร (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>รหัสประเภทบุคลากร</th>
  <td><? if(@$_GET['id']!='')echo @$row['Code']; else echo "ระบบจะกำหนดให้อัตโนมัติ"; ?></td>
</tr>
<tr>
  <th>ชื่อประเภทบุคลากร<span class="Txt_red_12"> *</span></th>
  <td><input name="HumanTypeName" type="text" id="HumanTypeName" value="<?php echo @$row['HumanName'];?>" size="50" /></td>
</tr>
</table>
<div id="boxbtnadd">
  <input type="hidden" name="code" value="<?php echo @$row['Code']?>" />
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>