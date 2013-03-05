<style type="text/css">

.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">

$(document).ready(function() {						  
  $("#frmProblemType").validate({
    rules: {
      ProblemTypeName: {
		  required: true
		 
	  },
	  abbr:"required"
    },
    messages: {
      ProblemTypeName:{
		 required:  " กรุณากรอกชื่อประเภทปัญหา"
	  	 
	  
     },
	 abbr:"กรุณากรอกตัวย่อ"
   }
  });  
});
</script>

<?
//if(@$_GET['id']!='') $row=GetData('ProblemType',$_GET['id']);
if(@$_GET['id']!='') $row=GetData('problemtype',$_GET['id']);

?>
<h3>ตั้งค่า ประเภทปัญหา (เพิ่ม / แก้ไข)</h3>
<form name="frmProblemType" id="frmProblemType" class="commentForm"  action="setting.php?act=query&type=problemtype&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_1['CanEdit']; ?>&chk_add=<?php echo $item_1['CanAdd']; ?>" method="post">
<table class="tbadd">
<tr>
  <th>รหัสประเภทปัญหา</th>
  <td>
        <? if(@$_GET['id']!='')echo $row['Code']; else echo "ระบบจะกำหนดให้อัตโนมัติ"; ?>
  </td>
</tr>
<tr>
  <th>ชื่อประเภทปัญหา  <span class="Txt_red_12">*</span></th>
  <td><input name="ProblemTypeName" type="text" id="ProblemTypeName" value="<?php echo @$row['ProblemName'];?>" size="50" /></td>
</tr>
<tr>
  <th>ตัวย่อ<span class="Txt_red_12">*</span></th>
  <td>
  <?php if(@$_GET['id']!=""){ ?>
  <input name="abbr" type="text" id="abbr" value="<?php echo @$row['abbr'];?>" size="50" disabled="disabled" />
  <input name="abbr" type="hidden" value="<?php echo @$row['abbr']; ?>" />
  <?php }else{ ?>
   <input name="abbr" type="text" id="abbr" value="<?php echo @$row['abbr'];?>" size="50"  />
  <?php }?>
  </td>
</tr>
</table>
<div id="boxbtnadd">
  <input type="hidden" name="id"    value="<?php echo $row['ID'] ?>" /> 
  <input type="hidden" name="code" value="<?php echo @$row['Code'] ?>" />
  <input name="input" type="submit" value="บันทึก"  class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>


</form>