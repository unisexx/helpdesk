<?


if(@$_GET['id']!='')
{
	$row = GetData('informent',@$_GET['id']);
	$group_form=GetData('usergroup',$row['UserGroupID']);
	
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
	$row['Password']="";
	$row['Code']="";
	$group_form['level']="";
}
	
      

//if(($group['level']>=$group_form['level']) || $group_form['level']==""){
		
		$ssrow  = mysql_fetch_array(mysql_query("SELECT ID FROM usergroup WHERE UserGroupName = 'Super Admin'"));
		$superAdminID = $ssrow['ID'];
		
?>


<style type="text/css">
.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>

<script language="javascript">
var deptid;
var divid;
function ReloadDivisionList(pDeptID)
{		   	  
	deptid=pDeptID;
	   url = "_ajax_group_list.php?id="+pDeptID;			
		$.get(url,function(data){
			$("#dvDivisionList").html(data);
			
		});
}
function ReloadSectionList(div)
{

				url = "_ajax_section_list.php?id="+div;			
		   		$.get(url,function(data){
					$("#dvsectionlist").html(data);
				});
		
}

function trim(stringToTrim)
   {
		return stringToTrim.replace(/^\s+|\s+$/g,'');
  }
  function alpha_chk(name,lastname)
  {
		chk_lastname=lastname.match(/^[a-zA-Z]+$/);
		chk_name=name.match(/^[a-zA-Z]+$/);
		
		if(chk_lastname==null || chk_name==null)
		{
			$("#NameUser").val(null);
			$("#lastname").val(null);
			
			return "not OK";
			
		
		} else{ return "OK";}
		 
  }

		
  function auto_email()
  { 	 

	 if($("input[name='NameUser']").val()!="" && $("input[name='lastname']").val()!=""){
			var name;
			name=$("#NameUser").val();
			lastname=$("#lastname").val();
			res=alpha_chk(name,lastname);
			if(res=='OK'){			
				$.ajax({
					type: 'GET',
					url: '<?php echo $host ?>user/chk_email.php',
					data: 'name='+$("#NameUser").val()+'&lastname='+$("#lastname").val()+'&id='+$("#id").val(),							
					success: function(data){
						$res=trim(data)+"@m-society.go.th";
						$('#Email').val($res);
						
					}
				});
			}else{ alert("กรุณาระบุเป็นภาษาอังกฤษ");}
			return false;
		
		

      } //close if
   }  //close function 
   
function form_disable(){
	var form_level='<?php echo $group_form['level'] ?>';
	var level='<?php echo $group['level'] ?>';
	if(form_level!=""){			
		if((level < form_level)){
		 
		  $('#frmedit :input:not(".btn_back")').attr('disabled','disabled');
		  $('#frmedit :select').attr('disabled','disabled');
		  $('#frmedit :submit').attr('disabled','disabled');
		  $('#frmedit :radio').attr('disabled','disabled');
		  $('#frmedit :checkbox').attr('disabled','disabled');
		 
		}
	}
}


function autoTab(obj,$i){
	if($i=="1"){
		var pattern=new String("_-____-_____-_-__"); //บัตรประชาชน
	}else{
		var pattern=new String("__-___-____"); //โทรศัพท์
	}
	var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
	var returnText=new String("");
	var obj_l=obj.value.length;
	var obj_l2=obj_l-1;
	for(i=0;i<pattern.length;i++){
		if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
			returnText+=obj.value+pattern_ex;
			obj.value=returnText;
		}
	}
	if(obj_l>=pattern.length){
		obj.value=obj.value.substr(0,pattern.length);
	}
}





$(document).ready(function() {
						   
	
	form_disable();
	
	$.validator.addMethod('onecheck', function(value, ele) {
	return $("input:checked").length >= 1;
	}, 'กรุณาเลือกระบบ')		   
  $("#frmedit").validate({
    rules: {
      UserID: "required",
	  UserType: "required",
      NameUser: "required",
	  lastname: "required",
	  <? if($row['UserGroupID'] != $superAdminID){ ?>
      Department: "required",
      division: "required",
      section: "required",
      human: "required",
	  <? } ?>
      /*IdCard: {
        required: true,
        minlength: 13
        },*/
			ChkSystem:{
			required:true, minlength:1
	 },

      Email:{
        required: true,
        email: true
        },
	  
       <? if($_GET['id']==''){ ?>
      Password:
		{
			required:true,
			minlength:5
		},
      <? }else{ ?>
	  Password:
		{
		
			minlength:5
		},

	  <? } ?>
      RePassword: {      
        equalTo: "#Password"
        }
    },
    messages: {
      UserID: "  กรุณาเลือกสิทธิ์การใช้งาน",
	  UserType:" กรุณาเลือกประเภทผู้ใช้งาน",	 
      NameUser: "  กรุณากรอกชื่อ",
	  lastname: "กรุณากรอกนามสกุล",
	  <? if($row['UserGroupID'] != $superAdminID){ ?>
      Department: "  กรุณาเลือกกรม",
      division: "  กรุณาเลือกกอง/สำนัก",
      section: "  กรุณาเลือกกลุ่ม/ฝ่าย",
      human: "  กรุณาเลือกประเภทบุลคลากร",
	    <? } ?>
     /* IdCard: {
        required: "  กรุณากรอกเลขบัตรประจำตัวประชาชน",
        minlength: "  กรุณากรอกเลขบัตรประจำตัวประชาชนให้ถูกต้อง"
     },  */   
	 ChkSystem:{
		 required:" กรุณาเลือกระบบ",
		 minlength:" กรุณาเลือกระบบอย่างน้อย 1 ระบบ"
	 },
	
     Email:{
      required: "  กรุณากรอก Email",
      email: "  กรุณากรอก email ให้ถูกต้อง"
      },
	
       <? if($_GET['id']==''){ ?>
      Password:{
		  required: "กรุณากรอก Password",
		  minlength:"กรุณากรอกอย่างน้อย 5 ตัวอักษร"
	  },
      <? }else{ ?>
	  Password:{
	
		  minlength:"กรุณากรอกอย่างน้อย 5 ตัวอักษร"
	  },

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
				error.appendTo(element.parent().parent().next());
			else 
				error.width();
		error.appendTo(element.parent());
	}					
  }); 
     
     //$(".chkSystem").rules("add",{onecheck:true});
});

function CheckForValidate(pUserGroup)
{
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



<h3>ข้อมูลผู้แจ้ง (เพิ่ม / แก้ไข)</h3>

<form name="frmedit" id="frmedit" class="commentForm"  action="user.php?act=insert&id=<?php echo @$_GET['id']?>&chk_del=<?php echo $item_10['CanDelete'];?>&chk_edit=<?php echo $item_10['CanEdit']; ?>&chk_add=<?php echo $item_10['CanAdd'] ?>"  method="post">
<table class="tbadd">
<tr>
  <th>ประเภทผู้ใช้งาน  <span class="Txt_red_12">*</span></th>
  <td><input type="radio" name="UserType" id="UserType" value="1" <? if($row['usertypeid']=='1')echo "checked";?>/>
    ผู้พัฒนา / MA 
     <input type="radio" name="UserType" id="UserType" value="2" <? if($row['usertypeid']=='2')echo "checked";?>/>
    ผู้ประสานงาน
    <input type="radio" name="UserType" id="UserType" value="3" <? if($row['usertypeid']=='3')echo "checked";?>/>
    เจ้าหน้าที่ / ผู้ดูแลระบบ
    <input type="radio" name="UserType" id="UserType" value="4" <? if($row['usertypeid']=='4')echo "checked";?>/>
    ผู้ใช้งาน</td>
</tr>

<tr>
  <th>สิทธิ์การใช้งาน <span class="Txt_red_12">*</span></th>
  <td>
  <select name="UserID" id="UserID" onchange="CheckForValidate(this.value); " >
  <option value="">กรุณาเลือกสิทธิ์การใช้งาน</option>
  <?
  $sql = "SELECT * FROM usergroup ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){?>
  <option value="<?php echo $srow['ID'];?>" <?php if($row['UserGroupID']==$srow['ID'])echo "selected";?>><?php echo $srow['UserGroupName'];?></option>
  <? } ?>
 </select>
</td>
</tr> 


<tr>
  <th>ใช้งานระบบ   <span class="Txt_red_12">*</span></th>
  <td>
  <div style="width:1000px">
  <? 
    $sql = " SELECT * FROM system ORDER BY id ";
    $result = mysql_query($sql);
    while($srow = mysql_fetch_array($result))
    {
  ?>
  <span style="display:inline-block;float:left;width:300px;">
  <input type="checkbox" name="ChkSystem[]" id="ChkSystem"  class="required"
  <? if(SelectCountData("user_systems"," WHERE userid=".@$_GET['id']." AND SystemID=".$srow['ID'])> 0)echo "checked";?> value="<?php echo $srow['ID'];?>"  />
    <? echo $srow['SystemName']; ?>
     </span>
<?php } ?>
      
   </div>
  </td>
</tr>
<tr>
  <th>ชื่อ - นามสกุล (อังกฤษ)<span class="Txt_red_12">*</span></th>
  <td style="width:300px;"><input name="NameUser" type="text" id="NameUser" value="<?php echo $row['Name'];?>" size="30" > - <input name="lastname" type="text" id="lastname" value="<?php echo @$row['lastname'];?>" size="30" onblur="javascript:auto_email();"/> <img src="images/ajax-refresh-icon.gif"  width="16" height="16" align="absmiddle" onclick="javascript:auto_email();" class="cursor"/></td>

</tr>
<tr>
  <th>บัตรประชาชน  <span class="Txt_red_12"></span></th>
  <td><input name="IdCard" type="text" id="IdCard" value= "<?php echo $row['IdCard']?>" onkeyup="autoTab(this,'1')"/></td>
</tr>
<tr>
  <th>กรม <span class="Txt_red_12">*</span></th>
  <td><select name="Department" id="Department" onchange="ReloadDivisionList(this.value);">
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
</select>
<input type="hidden" name="dept" id="dept" />
</td>
</tr>
<tr>
  <th>กอง/สำนัก<span class="Txt_red_12">*</span></th>
  <td>
  <div  id="dvDivisionList">
  <select name="division" id="division" onchange="ReloadSectionList(this.value)" <?php echo ($_GET['id'])?'':'disabled';?>>
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
</select>
 </div>
</td>
</tr>
<tr>
  <th>กลุ่ม/ฝ่าย<span class="Txt_red_12">*</span></th>
  <td>
  <div id="dvsectionlist">
  <select name="section" id="section" <?php echo ($_GET['id'])?'':'disabled';?>>
  <option value="">กรุณาเลือกกลุ่ม/ฝ่าย</option>
  <?
  $sql = "SELECT * FROM hd_section ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if($row['GroupID']==$srow['ID'])echo "selected";?> >
  <?=$srow['GroupName'];?>
  </option>
  <? } ?>
</select>
</div>
</td>
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
  <th>เบอร์ติดต่อ</th>
  <td><input name="Tel" type="text" id="Tel" value="<?php echo $row['Tel']?>" onkeyup="autoTab(this,'2')"/></td>
</tr>
<tr>
  <th>อีเมล์  <span class="Txt_red_12">*</span></th>
  <td><input name="Email" type="text" id="Email" value="<?php echo $row['Email']?>" size="30" /><span></span></td>
  
  
</tr>
<?
if(@$_SESSION['id']!='')
{
	 $gen_pass=generate_password();	
?>
<tr>
  <th>รหัสผ่าน <span class="Txt_red_12">*</span></th>
  <td><?php echo ($row['Password']=="")? $gen_pass:$row['Password']?></td>
  <input type="hidden" name="Password" value="<?php echo ($row['Password']=="")? $gen_pass:$row['Password']?>" />
  
</tr>
<? } ?>
<tr>
  <th>สร้าง/เปลี่ยน รหัสผ่าน <span class="Txt_red_12">*</span></th>
  <td><input name="Password" type="Password" id="Password" value="<?php echo ($row['Password']=="")? $gen_pass:""?>" /></td>
</tr>
<tr>
  <th>ยืนยันรหัสผ่าน  <span class="Txt_red_12">*</span></th>
  <td><input name="RePassword" type="Password" id="RePassword" value="<?php echo ($row['Password']=="")? $gen_pass:""?>" />
  </td>
</tr>
</table>
<div id="boxbtnadd">
  <input name="input" type="submit"  value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back" />

</div>
<input type="hidden" name="id" id="id" 		value="<?php echo @$_GET['id']?>" />
<input type="hidden" name="code"       		value="<?php echo $row['Code']; ?>" />
<input type="hidden" name="DateRegister" 	value="<?php echo @$row['DateRegister']?>" />
<input type="hidden" name="arr_pass" 		value="<?php echo $row['Password']?>" />
</form>
