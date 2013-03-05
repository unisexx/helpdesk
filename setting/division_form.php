<style type="text/css">

.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">

$().ready(function() {
 
  $("#frmdivision").validate({
    rules: {
      department: "required",
      txtDivisionName:
	  {
		  required:true,
		  remote: {
			url: 'setting/chk_dup_system.php?name=division',
			data: {
				deptid: function () {
					return $('#department').val();
				}//close function
		   }//close data
		}//close remote
	 }//close txt
      
    },
    messages: {
      department: "  กรุณาเลือกกรม",
      txtDivisionName:{
		  required:"  กรุณากรอกชื่อกอง/สำนัก",
		  remote:"มีชื่อนี้แล้ว"
	  }
    }
  });  
});

 $("#department").change(function() {
    $("#txtDivisionName").removeData("previousValue"); //clear cache when changing group
    $("#frmdivision").data('validator').element('#txtDivisionName'); //retrigger remote call

 });

</script>

<?php
if(@$_GET['id']!='')$row = GetData('division',@$_GET['id']);
?>
<h3>ตั้งค่า กอง/สำนัก (เพิ่ม / แก้ไข)</h3>
<form name="frmdivision" id="frmdivision" class="commentForm" enctype="multipart/form-data" action="setting.php?act=query&type=division&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_3['CanEdit']; ?>&chk_add=<?php echo $item_3['CanAdd']; ?>" method="post">
<table class="tbadd">
<tr>
  <th>รหัสกอง/สำนัก</th>
  <td>
  <? if(@$_GET['id']!='')echo $row['Code']; else echo "ระบบจะกำหนดให้อัตโนมัติ"; ?>
  </td>
</tr>
<tr>
  <th>ชื่อกรม <span class="Txt_red_12">*</span></th>
  <td><select name="department" id="department">
  <option value="">กรุณาเลือกกรม</option>
  <?
  $sql = "SELECT * FROM department ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if(@$row['DeptID']==$srow['ID'])echo "selected";?> >
  <?=$srow['DeptName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th>ชื่อกอง/สำนัก <span class="Txt_red_12">*</span></th>
  <td><input name="txtDivisionName" type="text" id="txtDivisionName" value="<?=@$row['DivisionName'];?>" size="50" /></td>
</tr>
</table>
<div id="boxbtnadd">
 <input type="hidden" name="code" value="<?php echo @$row['Code']?>" />
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>