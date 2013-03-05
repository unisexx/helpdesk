<style type="text/css">

.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">
$().ready(function() {
  $("#frmgroup").validate({
    rules: {
      division: "required",
      department: "required",
      txtGroupName:{
		  required:true,
		  remote: {
			url: 'setting/chk_dup_system.php?name=group',
			data: {
				deptid: function () {
					return $('#department').val();
				},//close function
				divisionid: function () {
					return $('#division').val();
				}//close function
		   }//close data
		}//close remote
	 }//close txt
    },
    messages: {
      division: "  กรุณาเลือกกอง/สำนัก",
      department: "  กรุณาเลือกกรม",
      txtGroupName:{
		  required:"  กรุณากรอกชื่อกลุ่ม/ฝ่าย",
		  remote:"มีข้อมูลนี้แล้ว"
	  }//close txt
     }
  });  
});
	  
$("#department").change(function() {
    $("#txtGroupName").removeData("previousValue"); //clear cache when changing group
    $("#frmgroup").data('validator').element('#txtGroupName'); //retrigger remote call

 });	  
$("#division").change(function() {
    $("#txtGroupName").removeData("previousValue"); //clear cache when changing group
    $("#frmgroup").data('validator').element('#txtGroupName'); //retrigger remote call

 });	  
	  
	  
	  
	  function ReloadDivisionList(pDeptID)
	   {		   	  
				
				
		        url = "_ajax_group_list.php?id="+pDeptID;			
		   		$.get(url,function(data){
					$("#dvDivisionList").html(data);
				});
	   }
	   function trim(stringToTrim)
   		{
			return stringToTrim.replace(/^\s+|\s+$/g,'');
  		}
	   function chk_dup()
	   {

				$.ajax({
					type: 'GET',
					url: '<?php echo $host ?>setting/chk_dup.php',
					data: 'dept='+$("#department").val()+'&division='+$("#division").val()+'&gpname='+$("#txtGroupName").val(),							
					success: function(data){
				
						if(trim(data)=="not"){
								$("#department").val('');
								$("#division").val('');
								$("#txtGroupName").val('');
								alert("มีข้อมูลนี้แล้ว ไม่สามารถบันทึกได้ !!!");
						}else{
							 form.submit();
						}
					}
				});
		//form.submit();
	   }
</script>
<?php
if(@$_GET['id']!='')$row = GetData('section',@$_GET['id']);
?>
<h3>ตั้งค่า กลุ่ม/ฝ่าย (เพิ่ม / แก้ไข)</h3>
<form name="frmgroup" id="frmgroup" class="commentForm" enctype="multipart/form-data" action="setting.php?act=query&type=group&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_4['CanEdit']; ?>&chk_add=<?php echo $item_4['CanAdd']; ?>" method="post">
<table class="tbadd">
<tr>
  <th>รหัสกลุ่ม/ฝ่าย</th>
  <td>
    <? if(@$_GET['id']!='')echo $row['Code']; else echo "ระบบจะกำหนดให้อัตโนมัติ"; ?>
  </td>
</tr>
<tr>
  <th>ชื่อกรม <span class="Txt_red_12">*</span></th>
  <td><select name="department" id="department"onchange="ReloadDivisionList(this.value);">
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
  <td>
  <div id="dvDivisionList">
  <select name="division" id="division">
  <option value="">กรุณาเลือกกอง/สำนัก</option>
  <?
  $sql = "SELECT * FROM division ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?php echo $srow['ID'];?>" <? if(@$row['DivisionID']==$srow['ID'])echo "selected";?> >
  <?php echo $srow['DivisionName'];?>
  </option>
  <? } ?>
 </select>
</div>
</td>
</tr>
<!--onblur="javascript:chk_dup();"-->
<tr>
  <th>ชื่อกลุ่ม/ฝ่าย <span class="Txt_red_12">*</span></th>
  <td><input name="txtGroupName" type="text" id="txtGroupName" value="<?=@$row['GroupName'];?>" size="50" /></td>
</tr>
</table>
<div id="boxbtnadd">
  <input name="input" type="submit" value="บันทึก" class="btn_save" />
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>