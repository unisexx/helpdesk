
<style type="text/css">
.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>

<script type="text/javascript">
$(document).ready(function() {
					   
  $("#frmedit").validate({
    rules: {
      UserID: "required",
	  UserType: "required",
	 
      NameUser: "required",
      Department: "required",
      Division: "required",
      section: "required",
      human: "required",
      IdCard: {
        required: true,
        minlength: 13
        },
      Email:{
        required: true,
        email: true
        },
     
       <? if($_GET['id']==''){ ?>
      Password: "required",
      <? } ?>

   
      RePassword: {      
        equalTo: "#Password"
        }
    },
    messages: {
      UserID: "  กรุณาเลือกสิทธิ์การใช้งาน",
	  UserType:" กรุณาเลือกประเภทผู้ใช้งาน",	 
      NameUser: "  กรุณากรอกชื่อ/นามสกุล",
      Department: "  กรุณาเลือกกรม",
      Division: "  กรุณาเลือกกอง/สำนัก",
      section: "  กรุณาเลือกกลุ่ม/ฝ่าย",
      human: "  กรุณาเลือกประเภทบุลคลากร",
      IdCard: {
        required: "  กรุณากรอกเลขบัตรประจำตัวประชาชน",
        minlength: "  กรุณากรอกเลขบัตรประจำตัวประชาชนให้ถูกต้อง"
     },     
     Email:{
      required: "  กรุณากรอก Email",
      email: "  กรุณากรอก email ให้ถูกต้อง"
      },
       <? if($_GET['id']==''){ ?>
      Password: "กรุณากรอก Password",
      <? } ?>

    
    
     RePassword: {
      
      equalTo: "  กรุณากรอก Password ให้เหมือนกัน"
      }
     },
	 errorPlacement: function(error, element){
		if (element.is(":radio")) 
			error.appendTo(element.parent());
		else 
			if (element.is(":checkbox")) 
				error.appendTo(element.next());
			else 
				error.width();
		error.appendTo(element.parent());
	}					
  }); 
   $(".chkSystem").rules("add",{required:true, messages: { required: "กรุณาเลือกระบบ"}});
});
function CheckForValidate(pUserGroup)
{
<?	
		$ssrow  = mysql_fetch_array(mysql_query("SELECT ID FROM usergroup WHERE UserGroupName = 'Super Admin'"));
		$superAdminID = $ssrow['ID'];
?>
	   superadminID =  <?=$superAdminID  ?>; 
		if(pUserGroup == superadminID)
		{
						$("#Department").rules("remove");
						$("#Division").rules("remove");
						$("#section").rules("remove");
						$("#human").rules("remove");
		}
		else
		{
						$("#Department").rules("add",{required:true});
						$("#Division").rules("add",{required:true});
						$("#section").rules("add",{required:true});
						$("#human").rules("add",{required:true});																		
		}
}
</script>

<?
if(@$_GET['id']!='')
{
	$row = GetData('informent',@$_GET['id']);
}else{
	$row['UserGroupID']="";
	$row['Name']="";
	$row['DepartmentID']="";
	$row['DivisionID']="";
	$row['GroupID']="";
	$row['HumanType']="";
	$row['IdCard']="";
	$row['Tel']="";
	$row['Email']="";
	$row['usertypeid']="";
}

?>
<h3>ข้อมูลผู้แจ้ง (เพิ่ม / แก้ไข)</h3>
<form name="frmedit" id="frmedit" class="commentForm" enctype="multipart/form-data"  action="user/query.php?act=insert&id=<?php echo @$_GET['id']?>&chk_del=<?php echo $item_10['CanDelete'];?>&chk_edit=<?php echo $item_10['CanEdit']; ?>&chk_add=<?php echo $item_10['CanAdd'] ?>"  method="post">
<table class="tbadd">
<tr>
  <th>สิทธิ์การใช้งาน <span class="Txt_red_12">*</span></th>
  <td><select name="UserID" id="UserID" onchange="CheckForValidate(this.value); " >
  <option value="">กรุณาเลือกสิทธิ์การใช้งาน</option>
  <?
  $sql = "SELECT * FROM usergroup ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){?>
  <option value="<?php echo $srow['ID'];?>" <?php if($row['UserGroupID']==$srow['ID'])echo "selected";?>><?php echo $srow['UserGroupName'];?></option>
  <? } ?>
</select></td>
</tr> 
<tr>
  <th>ประเภทผู้ใช้งาน  <span class="Txt_red_12">*</span></th>
  <td><input type="radio" name="UserType" id="UserType" value="1" <? if($row['usertypeid']=='1')echo "checked";?>/>
    ผู้รับผิดชอบ 
     <input type="radio" name="UserType" id="UserType" value="2" <? if($row['usertypeid']=='2')echo "checked";?>/>
    ผู้ประสานงาน
    <input type="radio" name="UserType" id="UserType" value="3" <? if($row['usertypeid']=='3')echo "checked";?>/>
    เจ้าของระบบ
    <input type="radio" name="UserType" id="UserType" value="4" <? if($row['usertypeid']=='4')echo "checked";?>/>
    ผู้ใช้งาน</td>
</tr>
<tr>
  <th>ใช้งานระบบ   <span class="Txt_red_12">*</span></th>
  <td>
  <? 
    $sql = " SELECT * FROM system ORDER BY SystemName ";
    $result = mysql_query($sql);
    while($srow = mysql_fetch_array($result))
    {
  ?>
  <input type="checkbox" name="Chk_<?php echo $srow['ID'];?>" id="Chk_<?php echo $srow['ID'];?>" 
  <? if(SelectCountData("user_systems"," WHERE userid=".@$_GET['id']." AND SystemID=".$srow['ID'])> 0)echo "checked";?> value="<?php echo $srow['ID'];?>" class="chkSystem" />
    <? echo $srow['SystemName'];
    }
    ?>
  </td>
</tr>
<tr>
  <th>ชื่อ - นามสกุล  <span class="Txt_red_12">*</span></th>
  <td><input name="NameUser" type="text" id="NameUser" value="<?php echo $row['Name'];?>" size="40" /></td>
</tr>
<tr>
  <th>กรม <span class="Txt_red_12">*</span></th>
  <td><select name="Department" id="Department">
  <option value="">กรุณาเลือกกรม</option>
  <?
  $sql = "SELECT * FROM department ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?php echo $srow['ID'];?>" <? if($row['DepartmentID']==$srow['ID'])echo "selected";?> >
  <?=$srow['DeptName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th>กอง/สำนัก<span class="Txt_red_12">*</span></th>
  <td><select name="Division" id="Division">
  <option value="">กรุณากอง/สำนัก</option>
  <?
  $sql = "SELECT * FROM division ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if($row['DivisionID']==$srow['ID'])echo "selected";?> >
  <?=$srow['DivisionName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th>กลุ่ม/ฝ่าย<span class="Txt_red_12">*</span></th>
  <td><select name="section" id="section">
  <option value="">กรุณาเลือกกลุ่ม/ฝ่าย</option>
  <?
  $sql = "SELECT * FROM section ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if($row['GroupID']==$srow['ID'])echo "selected";?> >
  <?=$srow['GroupName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th>ประเภทบุคลากร<span class="Txt_red_12">*</span></th>
  <td><select name="human" id="human">
  <option value="">กรุณาเลือกประเภทบุคลากร</option>
  <?
  $sql = "SELECT * FROM humantype ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?php echo $srow['ID'];?>" <? if($row['HumanType']==$srow['ID'])echo "selected";?> >
  <?php  echo $srow['HumanName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th>บัตรประชาชน  <span class="Txt_red_12">*</span></th>
  <td><input name="IdCard" type="text" id="IdCard" value= "<?php echo $row['IdCard']?>" maxlength="13" /></td>
</tr>
<tr>
  <th>เบอร์ติดต่อ</th>
  <td><input name="Tel" type="text" id="Tel" value="<?php echo $row['Tel']?>" /></td>
</tr>
<tr>
  <th>อีเมล์  <span class="Txt_red_12">*</span></th>
  <td><input name="Email" type="text" id="Email" value="<?php echo $row['Email']?>" size="30" /></td>
</tr>
<?
if(@$_SESSION['id']!='')
{
?>
<tr>
  <th>รหัสผ่าน <span class="Txt_red_12">*</span></th>
  <td><?php echo @$row['Password']?></td>
  
</tr>
<? } ?>
<tr>
  <th>สร้าง/เปลี่ยน รหัสผ่าน <span class="Txt_red_12">*</span></th>
  <td><input name="Password" type="Password" id="Password" /></td>
</tr>
<tr>
  <th>ยืนยันรหัสผ่าน  <span class="Txt_red_12">*</span></th>
  <td><input name="RePassword" type="Password" id="RePassword" value="" />
  </td>
</tr>
</table>
<div id="boxbtnadd">
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>
<input type="hidden" name="code"     value="<?php echo $row['Code']; ?>" />
<input type="hidden" name="Password" value="<?php echo $row['Password'];?>" />
<input type="hidden" name="DateRegister" value="<?php echo $row['DateRegister'] ?>" />
</form>