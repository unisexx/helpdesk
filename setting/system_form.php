<style type="text/css">
.commentForm label { color:red; }
.commentForm label.error{ color:red; }
.admin-row,.ma-row{padding:5px 0;}
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

$(document).ready(function(){
	$('.add-admin').click(function(){
		var element = $('.admin-row:first').clone();
		element.find('input[name=admin_del]').remove();
		element.find('input').val('');
		element.appendTo('.admin-col');
	});
	
	$('.add-ma').click(function(){
		var element = $('.ma-row:first').clone();
		element.find('input[name=ma_del]').remove();
		element.find('input').val('');
		element.appendTo('.ma-col');
	});
	
	$('input[name="ma_del"]').click(function(){
		if(confirm('ยืนยันการลบข้อมูล')){
			var $this = $(this);
			$.get('_ajax_function.php',{
				'id' : $this.prev('input[name="ma_id[]"]').val(),
				'action':'del_ma_user'
			},function(data){
				$this.closest('.ma-row').fadeOut();
			});
		}
	});
	
	$('input[name="admin_del"]').click(function(){
		if(confirm('ยืนยันการลบข้อมูล')){
			var $this = $(this);
			$.get('_ajax_function.php',{
				'id' : $this.prev('input[name="admin_id[]"]').val(),
				'action':'del_admin_user'
			},function(data){
				$this.closest('.admin-row').fadeOut();
			});
		}
	});
});
</script>

<?

//if(@$_GET['id']!='')$row = GetData('System',@$_GET['id']);
if(@$_GET['id']!=''){
	$row = GetData('system',@$_GET['id']);
	// เรียก ma_user
	$sql = "SELECT * FROM ma_user where system_id = ".@$_GET['id'];
	$result_ma = mysql_query($sql) or die("Invalid query: " . mysql_error());
	// เรียก admin_user
	$sql = "SELECT * FROM admin_user where system_id = ".@$_GET['id'];
	$result_admin = mysql_query($sql) or die("Invalid query: " . mysql_error());
}
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
<tr>
	<th>ผู้พัฒนา/MA</th>
	<td class="ma-col">
		<input class="add-ma" type="button" value=" เพิ่มผู้พัฒนา/MA "><br>
		<?php if($result_ma != ""):?>
		<?php while($ma=mysql_fetch_array($result_ma)):?>
			<div class="ma-row">
				ชื่อ-สกุล <input type="text" name="m_name[]" value="<?php echo $ma['m_name']?>"> 
				เบอร์ติดต่อ <input type="text" name="m_tel[]" value="<?php echo $ma['m_tel']?>"> 
				อีเมล์ <input type="text" name="m_email[]" value="<?php echo $ma['m_email']?>"> 
				ชื่อบริษัท <input type="text" name="m_company[]" value="<?php echo $ma['m_company']?>"> 
				เบอร์ติดต่อ <input type="text" name="m_ctel[]" value="<?php echo $ma['m_ctel']?>">
				<input type="hidden" name="ma_id[]" value="<?php echo $ma['id']?>">
				<input type="button" name="ma_del" value=" ลบ ">
			</div>
		<?php endwhile;?>
		<?php endif;?>
		<div class="ma-row">
			ชื่อ-สกุล <input type="text" name="m_name[]" value=""> 
			เบอร์ติดต่อ <input type="text" name="m_tel[]" value=""> 
			อีเมล์ <input type="text" name="m_email[]" value=""> 
			ชื่อบริษัท <input type="text" name="m_company[]"> 
			เบอร์ติดต่อ <input type="text" name="m_ctel[]">
			<input type="hidden" name="id[]" value="">
		</div>
	</td>
</tr>
<tr>
	<th>เจ้าหน้าที่/ผู้ดูแลระบบ</th>
	<td class="admin-col">
		<input class="add-admin" type="button" value=" เพิ่มเจ้าหน้าที่/ผู้ดูแลระบบ "><br>
		<?php if($result_admin != ""):?>
		<?php while($ad=mysql_fetch_array($result_admin)):?>
			<div class="admin-row">
				ชื่อ-สกุล <input type="text" name="a_name[]" value="<?php echo $ad['a_name']?>"> 
				เบอร์ติดต่อ <input type="text" name="a_tel[]" value="<?php echo $ad['a_tel']?>"> 
				อีเมล์ <input type="text" name="a_email[]" value="<?php echo $ad['a_email']?>"> 
				ชื่อบริษัท <input type="text" name="a_company[]" value="<?php echo $ad['a_company']?>"> 
				เบอร์ติดต่อ <input type="text" name="a_ctel[]" value="<?php echo $ad['a_ctel']?>">
				<input type="hidden" name="admin_id[]" value="<?php echo $ad['id']?>">
				<input type="button" name="admin_del" value=" ลบ ">
			</div>
		<?php endwhile;?>
		<?php endif;?>
		<div class="admin-row">ชื่อ-สกุล <input type="text" name="a_name[]" value=""> เบอร์ติดต่อ <input type="text" name="a_tel[]" value=""> อีเมล์ <input type="text" name="a_email[]" value=""> ชื่อบริษัท <input type="text" name="a_company[]"> เบอร์ติดต่อ <input type="text" name="a_ctel[]"></div>
	</td>
</tr>
</table>
<div id="boxbtnadd">
  <input type="hidden" name="code" value="<?php echo @$row['Code']?>" />
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>

</form>