<style type="text/css">
.commentForm label { color:red; }
.commentForm label.error{ color:red; }
</style>
<script type="text/javascript">
  function checkAll(pName)
  {
      var chkView = document.getElementById(pName+ 'ViewState'); 
      chkView.checked = true;
      if(pName!='Report')
      {
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState'); 
      chkAdd.checked = true;
      chkEdit.checked = true;
      chkDelete.checked = true;
      }
      else
      {         
	  var chkAdd = document.getElementById(pName + 'AddState');
      var chkExport = document.getElementById(pName+'ExportState');    
	  var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState'); 
	  chkAdd.checked = true;
      chkExport.checked = true;
	  chkEdit.checked = true;
      chkDelete.checked = true;
      }
  }
  function uncheckAll(pName)
  {
      var chkView = document.getElementById(pName+ 'ViewState'); 
      chkView.checked = false;
      if(pName!='Report')
      {
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState'); 
      chkAdd.checked = false;
      chkEdit.checked = false;
      chkDelete.checked = false;
      }
      else
      {         
	  var chkAdd = document.getElementById(pName + 'AddState');
      var chkExport = document.getElementById(pName+'ExportState');    
	  var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState'); 
	  chkAdd.checked = false;
      chkExport.checked = false;
	  chkEdit.checked = false;
      chkDelete.checked = false;
      } 
  }

  function checkAllForm(pState)
  {
      pName = 'Problem';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;   
      pName = 'Division';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;                 
      pName = 'Department';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;     
      pName = 'Group';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;  
      pName = 'Human';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;     
	pName = 'System';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;    
	pName = 'Server';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;    
	pName = 'User';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;  
	pName = 'Permission';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
      var chkEdit = document.getElementById(pName + 'EditState');
      var chkDelete = document.getElementById(pName + 'DeleteState');   
      chkView.checked = pState;
      chkAdd.checked = pState;
      chkEdit.checked = pState;
      chkDelete.checked = pState;  
    pName = 'Report';
      var chkView = document.getElementById(pName+ 'ViewState');
      var chkAdd = document.getElementById(pName + 'AddState');
	  var chkEdit = document.getElementById(pName + 'EditState');
	  var chkDelete = document.getElementById(pName + 'DeleteState'); 
      var chkExport = document.getElementById(pName + 'ExportState'); 
      chkView.checked = pState;
      chkAdd.checked = pState;
	  chkEdit.checked = pState;
	  chkDelete.checked = pState;
	  chkExport.checked = pState;            
    pName = 'Log';
      var chkView = document.getElementById(pName+ 'ViewState');
      chkView.checked = pState; 
	  
          
  }

  function checkActionAllForm(pState,pAction)
  {

      pName = 'Problem';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
      pName = 'Division';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
      pName = 'Department';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
      pName = 'Group';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
      pName = 'Human';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
	  pName = 'System';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
	  pName = 'Server';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
	  pName = 'User';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
	  pName = 'Permission';
	  var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
      pName = 'Report';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
      pName = 'Log';
      var chkState = document.getElementById(pName+ pAction +'State');
      chkState.checked = pState;
	 

  }
  $(document).ready(function(){
	 $("#frmedit").validate({
	  	rules:{
			UserGroupName:"required"
		},
		messages:{
			UserGroupName:"กรุณารุะบุชื่อ"
		}
	 
	 })
	
							 
  })
</script>
<?php

$permission = GetPermission(@$_GET['id']);

if($permission=="")
{
	for($i=1;$i<11;$i++){
		$permission[$i]['CanView']="";
		$permission[$i]['CanAdd']="";
		$permission[$i]['CanEdit']="";
		$permission[$i]['CanDelete']="";
		$permission[$i]['CanAccessAll']="";
	}
}
$usergroup =GetData("usergroup",@$_GET['id']);

//$usergroup_system = GetData
?>
 
<form name="frmUsergroup" id="frmedit" method="post" action="usergroup.php?act=query&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_9['CanEdit']; ?>&chk_add=<?php echo $item_9['CanAdd']; ?>" class="commentForm">
<table class="tbadd">
<tr>
  <th>ชื่อสิทธิ์การใช้งาน  <span class="Txt_red_12">*</span></th>
  <td><input name="UserGroupName" type="text" id="UserGroupName" value="<?php echo $usergroup['UserGroupName'];?>" size="40" /></td>
</tr>
<tr>
  <th  align="left">สามารถดูรายการที่แจ้ง</th>
  <td align="left" valign="top">
<input type="checkbox" name="CanAccessAll" id="CanAccessAll" value="1" <? if($usergroup['CanAccessAll']!='')echo "checked";?> />
   (เลือกถ้าดูได้ทั้งหมด)
 </td>
</tr>
<tr>
  <th  align="left">ตั้งค่า</th>
  <td align="left" valign="top">
    <span onclick="checkAllForm(true)" style="cursor:pointer;"><font color="green">[เลือกทั้งหมด]</font></span>
    &nbsp;&nbsp;&nbsp;&nbsp;<span onclick="checkActionAllForm(true,'View')" style="cursor:pointer;"><font color="green">[เลือกดูทั้งหมด]</font></span>
    &nbsp;&nbsp;&nbsp;<span onclick="checkActionAllForm(true,'Add')" style="cursor:pointer;"><font color="green">[เลือกเพิ่มทั้งหมด]</font></span>
    &nbsp;&nbsp;&nbsp;&nbsp;<span onclick="checkActionAllForm(true,'Edit')" style="cursor:pointer;"><font color="green">[เลือกแก้ไขทั้งหมด]</font></span>
    &nbsp;&nbsp;&nbsp;&nbsp;<span onclick="checkActionAllForm(true,'Delete')" style="cursor:pointer;"><font color="green">[เลือกลบทั้งหมด]</font></span><br />
    <span onclick="checkAllForm(false)" style="cursor:pointer"><font color="red">[ไม่เลือกทั้งหมด]</font></span>&nbsp;
    <span onclick="checkActionAllForm(false,'View')" style="cursor:pointer"><font color="red">[ไม่เลือกดูทั้งหมด]</font></span>
    <span onclick="checkActionAllForm(false,'Add')" style="cursor:pointer"><font color="red">[ไม่เลือกเพิ่มทั้งหมด]</font></span>&nbsp;
    <span onclick="checkActionAllForm(false,'Edit')" style="cursor:pointer"><font color="red">[ไม่เลือกแก้ไขทั้งหมด]</font></span>&nbsp;
    <span onclick="checkActionAllForm(false,'Delete')" style="cursor:pointer"><font color="red">[ไม่เลือกลบทั้งหมด]</font></span>&nbsp;
    </td>
</tr>

<? 
$menuID = 1;
?>
<tr>
  <th class="padL15">ประเภทปัญหา</th>
  <td><input type="checkbox" name="ProblemViewState" id="ProblemViewState" value="1" <? if($permission[$menuID]['CanView']!='')echo "checked";?> />
    View
    <input type="checkbox" name="ProblemAddState" id="ProblemAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?>/>
    Add 
    <input type="checkbox" name="ProblemEditState" id="ProblemEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
    Edit 
    <input type="checkbox" name="ProblemDeleteState" id="ProblemDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
    Delete
    &nbsp;<span onclick="checkAll('Problem')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Problem')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
    </td>
</tr>
<? 
$menuID = 2;
?>
<tr>
  <th class="padL15">กรม</th>
  <td><input type="checkbox" name="DepartmentViewState" id="DepartmentViewState" value="1"  <? if($permission[$menuID]['CanView']!='')echo "checked";?> />
View
  <input type="checkbox" name="DepartmentAddState" id="DepartmentAddState" value="1"  <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
Add
<input type="checkbox" name="DepartmentEditState" id="DepartmentEditState" value="1"  <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
Edit
<input type="checkbox" name="DepartmentDeleteState" id="DepartmentDeleteState" value="1"  <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
Delete
    &nbsp;<span onclick="checkAll('Department')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Department')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
<? 
$menuID = 3;
?>
<tr>
  <th class="padL15">กอง/สำนักงาน</th>
  <td><input type="checkbox" name="DivisionViewState" id="DivisionViewState" value="1" <? if($permission[$menuID]['CanView']!='')echo "checked";?>/>
View
  <input type="checkbox" name="DivisionAddState" id="DivisionAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?>/>
Add
<input type="checkbox" name="DivisionEditState" id="DivisionEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
Edit
<input type="checkbox" name="DivisionDeleteState" id="DivisionDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
Delete
    &nbsp;<span onclick="checkAll('Division')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Division')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
<? 
$menuID = 4;
?>
<tr>
  <th class="padL15"> กลุ่ม/ฝ่าย</th>
  <td><input type="checkbox" name="GroupViewState" id="GroupViewState" value="1" <? if($permission[$menuID]['CanView']!='')echo "checked";?>/>
View
  <input type="checkbox" name="GroupAddState" id="GroupAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
Add
<input type="checkbox" name="GroupEditState" id="GroupEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
Edit
<input type="checkbox" name="GroupDeleteState" id="GroupDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
Delete
    &nbsp;<span onclick="checkAll('Group')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Group')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
<? 
$menuID = 5;
?>
<tr>
  <th class="padL15">ประเภทบุคลากร</th>
  <td><input type="checkbox" name="HumanViewState" id="HumanViewState" value="1" <? if($permission[$menuID]['CanView']!='')echo "checked";?> />
View
  <input type="checkbox" name="HumanAddState" id="HumanAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
Add
<input type="checkbox" name="HumanEditState" id="HumanEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
Edit
<input type="checkbox" name="HumanDeleteState" id="HumanDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
Delete
    &nbsp;<span onclick="checkAll('Human')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Human')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
<? 
$menuID = 6;
?>
<tr>
  <th class="padL15"> ระบบงาน</th>
  <td><input type="checkbox" name="SystemViewState" id="SystemViewState" value="1" <? if($permission[$menuID]['CanView']!='')echo "checked";?>/>
View
  <input type="checkbox" name="SystemAddState" id="SystemAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
Add
<input type="checkbox" name="SystemEditState" id="SystemEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
Edit
<input type="checkbox" name="SystemDeleteState" id="SystemDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
Delete
    &nbsp;<span onclick="checkAll('System')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('System')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
<? 
$menuID = 7;
?>
<tr>
  <th class="padL15"> Server</th>
  <td><input type="checkbox" name="ServerViewState" id="ServerViewState" value="1" <? if($permission[$menuID]['CanView']!='')echo "checked";?>/>
View
  <input type="checkbox" name="ServerAddState" id="ServerAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
Add
<input type="checkbox" name="ServerEditState" id="ServerEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
Edit
<input type="checkbox" name="ServerDeleteState" id="ServerDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
Delete
    &nbsp;<span onclick="checkAll('Server')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Server')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
<? 
$menuID = 8;
?>
<tr>
  <th>ข้อมูลผู้แจ้ง</th>
    <td>
    <input type="checkbox" name="UserViewState" id="UserViewState" value="1" <? if($permission[$menuID]['CanView']!='')echo "checked";?> />
    View
    <input type="checkbox" name="UserAddState" id="UserAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?>/>
    Add 
    <input type="checkbox" name="UserEditState" id="UserEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
    Edit 
    <input type="checkbox" name="UserDeleteState" id="UserDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
    Delete
    &nbsp;<span onclick="checkAll('User')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('User')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
    </td>
</tr>
</tr>
<? 
$menuID = 9;
?>
<tr>
  <th>สิทธิ์การใช้งาน</th>

  <td><input type="checkbox" name="PermissionViewState" id="PermissionViewState" value="1" <? if(@$permission[$menuID]['CanView']!='')echo "checked";?>/>
    View 
    <input type="checkbox" name="PermissionAddState" id="PermissionAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
	Add
    <input type="checkbox" name="PermissionEditState" id="PermissionEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
	Edit
    	<input type="checkbox" name="PermissionDeleteState" id="PermissionDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
	Delete
    &nbsp;<span onclick="checkAll('Permission')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Permission')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
</tr>
<? 
$menuID = 10;
?>
<tr>
  <th>รายงาน</th>

  <td><input type="checkbox" name="ReportViewState" id="ReportViewState" value="1" <? if(@$permission[$menuID]['CanView']!='')echo "checked";?>/>
    View 
    <input type="checkbox" name="ReportAddState" id="ReportAddState" value="1" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
	Add
    <input type="checkbox" name="ReportEditState" id="ReportEditState" value="1" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
	Edit
    	<input type="checkbox" name="ReportDeleteState" id="ReportDeleteState" value="1" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
	Delete
     <input type="checkbox" name="ReportExportState" id="ReportExportState" value="1" <? if(@$permission[$menuID]['CanExport']!='')echo "checked";?>/>
    Export
    &nbsp;<span onclick="checkAll('Report')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Report')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>
</tr>
<? 
$menuID = 11;
?>
<tr>
  <th>logfile</th>
  <td><input type="checkbox" name="LogViewState" id="LogViewState" value="1" <? if(@$permission[$menuID]['CanView']!='')echo "checked";?>/>
    View
    &nbsp;<span onclick="checkAll('Log')" style="cursor:pointer;"><font color="green">[เลือก]</font></span>  <span onclick="uncheckAll('Log')" style="cursor:pointer"><font color="red">[ไม่เลือก]</font></span>
</td>

</table>
<div id="boxbtnadd">
	<input type="hidden" name="code" value="<?php echo $usergroup['Code'] ?>" />
  <input name="input" type="submit" value="บันทึก" class="btn_save" />
  <input name="input2" type="button" value="ย้อนกลับ" onclick="history.back(-1)" class="btn_back"/>
</div>
</form>