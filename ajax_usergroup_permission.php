<?
header("Content-Type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>';
echo '';
include "include/config.php";
include "include/function.php";
db_connect();
$permission = GetPermission($_GET['id']);
$usergroup = GetData("usergroup",$_GET['id']);
//$usergroup_system = GetData
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
</head>
<body>
  <table class="tbadd">
<tr>
  <th>ชื่อสิทธิ์การใช้งาน  <span class="Txt_red_12">*</span></th>
  <td><input name="textarea8" type="text" id="textarea8" value="<?=$usergroup['UserGroupName'];?>" disabled="disabled" size="40"  /></td>
</tr>

<tr>
  <th>ตั้งค่า</th>
  <td>&nbsp;</td>
</tr>
<? 
$menuID = 1;
?>
<tr>
  <th class="padL15">ประเภทปัญหา</th>
  <td><input type="checkbox" name="ProblemViewState" id="ProblemViewState" value="1" disabled="disabled" <? if(@$permission[$menuID]['CanView']!='')echo "checked";?> />
    View
    <input type="checkbox" name="ProblemAddState" id="ProblemAddState" value="1" disabled="disabled" <? if(@$permission[$menuID]['CanAdd']!='')echo "checked";?> />
    Add 
    <input type="checkbox" name="ProblemEditState" id="ProblemEditState" value="1" disabled="disabled" <? if(@$permission[$menuID]['CanEdit']!='')echo "checked";?> />
    Edit 
    <input type="checkbox" name="ProblemDeleteState" id="ProblemDeleteState" value="1" disabled="disabled" <? if(@$permission[$menuID]['CanDelete']!='')echo "checked";?> />
    Delete
   
    </td>
</tr>
<? 
$menuID = 2;
?>
<tr>
  <th class="padL15">กรม</th>
  <td><input type="checkbox" name="DepartmentViewState" id="DepartmentViewState" value="1" disabled="disabled" <? if($permission[$menuID]['CanView']!='')echo "checked";?> />
View
  <input type="checkbox" name="DepartmentAddState" id="DepartmentAddState" value="1" disabled="disabled" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
Add
<input type="checkbox" name="DepartmentEditState" id="DepartmentEditState" value="1" disabled="disabled" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
Edit
<input type="checkbox" name="DepartmentDeleteState" id="DepartmentDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
Delete
    
</td>
</tr>
<? 
$menuID = 3;
?>
<tr>
  <th class="padL15">กอง/สำนักงาน</th>
  <td><input type="checkbox" name="DivisionViewState" id="DivisionViewState" value="1" disabled="disabled" <? if($permission[$menuID]['CanView']!='')echo "checked";?> />
View
  <input type="checkbox" name="DivisionAddState" id="DivisionAddState" value="1" disabled="disabled" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
Add
<input type="checkbox" name="DivisionEditState" id="DivisionEditState" value="1" disabled="disabled" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
Edit
<input type="checkbox" name="DivisionDeleteState" id="DivisionDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
Delete
     
</td>
</tr>
<? 
$menuID = 4;
?>
<tr>
  <th class="padL15"> กลุ่ม/ฝ่าย</th>
  <td><input type="checkbox" name="GroupViewState" id="GroupViewState" value="1" disabled="disabled" <? if($permission[$menuID]['CanView']!='')echo "checked";?> />
View
  <input type="checkbox" name="GroupAddState" id="GroupAddState" value="1" disabled="disabled" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?>/>
Add
<input type="checkbox" name="GroupEditState" id="GroupEditState" value="1" disabled="disabled" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
Edit
<input type="checkbox" name="GroupDeleteState" id="GroupDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
Delete
    
</td>
</tr>
<? 
$menuID = 5;
?>
<tr>
  <th class="padL15">ประเภทบุคลากร</th>
  <td><input type="checkbox" name="HumanViewState" id="HumanViewState" value="1" disabled="disabled" <? if($permission[$menuID]['CanView']!='')echo "checked";?>/>
View
  <input type="checkbox" name="HumanAddState" id="HumanAddState" value="1" disabled="disabled" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?>/>
Add
<input type="checkbox" name="HumanEditState" id="HumanEditState" value="1" disabled="disabled" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
Edit
<input type="checkbox" name="HumanDeleteState" id="HumanDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
Delete
   
</td>
</tr>
<? 
$menuID = 6;
?>
<tr>
  <th class="padL15">ระบบงาน</th>
  <td><input type="checkbox" name="SystemViewState" id="SystemViewState" value="1" disabled="disabled" <? if($permission[$menuID]['CanView']!='')echo "checked";?>/>
View
<input type="checkbox" name="SystemAddState" id="SystemAddState" value="1" disabled="disabled" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?>/>
Add
<input type="checkbox" name="SystemEditState" id="SystemEditState" value="1" disabled="disabled" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
Edit
<input type="checkbox" name="SystemDeleteState" id="SystemDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
Delete
</td>
</tr>
<? 
$menuID = 7;
?>
<tr>
  <th class="padL15">Server</th>
  <td><input type="checkbox" name="ServerViewState" id="ServerViewState" value="1" disabled="disabled" <? if($permission[$menuID]['CanView']!='')echo "checked";?>/>
View
  <input type="checkbox" name="ServerAddState" id="ServerAddState" value="1" disabled="disabled" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?>/>
Add
<input type="checkbox" name="ServerEditState" id="ServerEditState" value="1" disabled="disabled" <? if($permission[$menuID]['CanEdit']!='')echo "checked";?>/>
Edit
<input type="checkbox" name="ServerDeleteState" id="ServerDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?>/>
Delete
</td>
</tr>
<? 
$menuID = 8;
?>
<tr>
  <th>ข้อมูลผู้แจ้ง</th>

  <td><input type="checkbox" name="UserViewState" id="UserViewState" value="1" disabled="disabled" <? if(@$permission[$menuID]['CanView']!='')echo "checked";?>/>
    View 
    <input type="checkbox" name="UserAddState" id="UserAddState" value="1" disabled="disabled"<? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
	Add
    <input type="checkbox" name="UserEditState" id="UserEditState" value="1" disabled="disabled"<? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
	Edit
    	<input type="checkbox" name="UserDeleteState" id="UserDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
	Delete
</td>
</tr>
<? 
$menuID = 9;
?>
<tr>
  <th>สิทธิ์การใช้งาน</th>

  <td><input type="checkbox" name="PermissionViewState" id="PermissionViewState" value="1" disabled="disabled"<? if(@$permission[$menuID]['CanView']!='')echo "checked";?>/>
    View 
    <input type="checkbox" name="PermissionAddState" id="PermissionAddState" value="1" disabled="disabled"<? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
	Add
    <input type="checkbox" name="PermissionEditState" id="PermissionEditState" value="1" disabled="disabled"<? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
	Edit
    	<input type="checkbox" name="PermissionDeleteState" id="PermissionDeleteState" value="1" disabled="disabled"<? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
	Delete
</td>
</tr>
<? 
$menuID = 10;
?>
<tr>
  <th>รายงาน</th>

  <td><input type="checkbox" name="ReportViewState" id="ReportViewState" value="1" disabled="disabled"<? if(@$permission[$menuID]['CanView']!='')echo "checked";?>/>
    View 
    <input type="checkbox" name="ReportAddState" id="ReportAddState" value="1" disabled="disabled" <? if($permission[$menuID]['CanAdd']!='')echo "checked";?> />
	Add
    <input type="checkbox" name="ReportEditState" id="ReportEditState" value="1" disabled="disabled"<? if($permission[$menuID]['CanEdit']!='')echo "checked";?> />
	Edit
    	<input type="checkbox" name="ReportDeleteState" id="ReportDeleteState" value="1" disabled="disabled" <? if($permission[$menuID]['CanDelete']!='')echo "checked";?> />
	Delete
     <input type="checkbox" name="ReportExportState" id="ReportExportState" value="1" disabled="disabled"<? if(@$permission[$menuID]['CanExport']!='')echo "checked";?>/>
    Export
</td>
</tr>
<? 
$menuID = 11;
?>
<tr>
  <th>logfile</th>
  <td><input type="checkbox" name="LogViewState" id="LogViewState" value="1"  disabled="disabled"<? if(@$permission[$menuID]['CanView']!='')echo "checked";?>/>
    View
</td>
</tr>
</table>
</body>
</html>
