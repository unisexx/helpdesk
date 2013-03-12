<style type="text/css">
.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<?php
		//include "include/notifybar.php";
 		//include "include/set_notifybar.php";
		
		$ssrow  = mysql_fetch_array(mysql_query("SELECT ID FROM usergroup WHERE UserGroupName = 'Super Admin'"));
		$superAdminID = $ssrow['ID'];
	 	$_GET['id']=$_SESSION['id'];
		
		
?>
<script type="text/javascript">

$(document).ready(function() {
    
  // $.validator.setDefaults({
	  // submitHandler: function() {   
	  // $("#frmprofile").submit();
	  // }
	// });
   
  $("#frmprofile").validate({
    rules: {
      UserID: "required",
	  UserType: "required",
      NameUser: "required",
	  lastname: "required",
	  <? if($row['UserGroupID'] != $superAdminID){ ?>
      Department: "required",
      Division: "required",
      section: "required",
      human: "required",
	  <? } ?>
     
	ChkSystem:{
		required:true, 
		minlength:1
		},

     /* Email:{
        required: true,
        email: true
        },*/
     
       <? if($_GET['id']==''){ ?>
      Password:{
	  	required:true,
		minlength:5
	  },
      <? }else{ ?>
	   Password:{
	  	
		minlength:5
	  },
	  <?php } ?>
   
      RePassword: {      
        equalTo: "#Password",
		
        }
    },
    messages: {
      UserID: "  กรุณาเลือกสิทธิ์การใช้งาน",
	  UserType:" กรุณาเลือกประเภทผู้ใช้งาน",	 
      NameUser: "  กรุณากรอกชื่อ",
	  lastname: " กรุณากรอกนามสกุล",
	  <? if($row['UserGroupID'] != $superAdminID){ ?>
      Department: "  กรุณาเลือกกรม",
      Division: "  กรุณาเลือกกอง/สำนัก",
      section: "  กรุณาเลือกกลุ่ม/ฝ่าย",
      human: "  กรุณาเลือกประเภทบุลคลากร",
	    <? } ?>
    
	 ChkSystem:{
		 required:" กรุณาเลือกระบบ",
		 minLength:" กรุณาเลือกระบบอย่างน้อย 1 ระบบ"
	 },
    /* Email:{
      required: "  กรุณากรอก Email",
      email: "  กรุณากรอก email ให้ถูกต้อง"
      },*/
       <? if($_GET['id']==''){ ?>
      Password: {
	  	required: "กรุณากรอก Password",
		minlength: "กรุณากรอกอย่างน้อย 5 ตัวอักษร"
	  	},
      <? }else{ ?>
	  	Password: {
	  	
		minlength: "กรุณากรอกอย่างน้อย 5 ตัวอักษร"
	  	},
	  <?php } ?>

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
     
     //$(".chkSystem").rules("add",{onecheck:true});
});
	   function ReloadDivisionList(pDeptID)
	   {		   	  
		        url = "_ajax_group_list.php?id="+pDeptID;			
		   		$.get(url,function(data){
					$("#dvDivisionList").html(data);
				});
	   }
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
  divid=div;
	url = "_ajax_section_list.php?id="+div+"&deptid="+deptid;			
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
			$("#NameUser").val('');
			$("#lastname").val('');
			
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
   
</script>
<script type="text/javascript">
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
</script>

<form name="frmprofile" id="frmprofile" class="commentForm" enctype="multipart/form-data" action="profile.php?act=query&id=<?=$row['ID'];?>" target="frmUpdate" method="post">
<table class="tbadd">
<tr>
  <th>สิทธิ์การใช้งาน <span class="Txt_red_12">*</span></th>
  <td><select name="UserID" id="UserID">
  <option>กรุณาเลือกสิทธิ์การใช้งาน</option>
  <?
  $sql = "SELECT * FROM usergroup ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if($row['UserGroupID']==$srow['ID'])echo "selected";?> >
  <?=$srow['UserGroupName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th>ชื่อ - นามสกุล (อังกฤษ)<span class="Txt_red_12">*</span></th>
  <td style="width:300px;"><input name="NameUser" type="text" id="NameUser" value="<?php echo $row['Name'];?>" size="30" > - <input name="lastname" type="text" id="lastname" value="<?php echo @$row['lastname'];?>" size="30" onblur="auto_email()"/> <img src="images/ajax-refresh-icon.gif" width="16" height="16" align="absmiddle" onclick="auto_email();" /></td>

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
</select></td>
</tr>
<tr>
  <th>กอง/สำนัก<span class="Txt_red_12">*</span></th>
  <td>
<div id="dvDivisionList">
  <select name="Division" id="Division" onchange="ReloadSectionList(this.value)">
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
  <select name="section" id="section">
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
  <td><input name="Email" type="text" id="Email" value="<?php echo $row['Email']?>" size="30"  /><span></span></td>
 
  
</tr>
<?
if($_SESSION["id"]!='')
{
?>
<tr>
  <th>รหัสผ่าน <span class="Txt_red_12">*</span></th>
  <td><?=$row['Password']?></td>
</tr>
<? } ?>
<tr>
  <th>เปลี่ยนรหัสผ่าน</th>
  <td><input name="Password" type="password" id="Password" value="" /></td>
</tr>
<tr>
  <th>ยืนยันรหัสผ่าน</th>
  <td><input name="RePassword" type="password" id="RePassword" value="" /></td>
</tr>
</table>
<input type="hidden" name="id" id="id" value="<?php echo @$_GET['id']?>" />
<div id="boxbtnadd">
  <input name="input" id="btn_submit" type="submit" value="บันทึก"  class="btn_save" />
  <input type="hidden" name="arr_pass" 		value="<?php echo $row['Password']?>" />
</div>
</div>
</form>
