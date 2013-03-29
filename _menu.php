<? 

$currentUser = GetData("informent",$_SESSION['id']);
$_SESSION["usertype"]=$currentUser['usertypeid'];
$_SESSION["usergroupid"]=$currentUser['UserGroupID'];
$group = GetData("usergroup",$_SESSION["usergroupid"]);
$agen=GetAgencie($_SESSION["id"]);


?>
<?
	$tmp = explode("/",$_SERVER['SCRIPT_NAME']);
		 $page_name = trim($tmp[count($tmp)-1]);
		$active_1_list = array('profile.php');
		$active_2_list = array('usergroup.php');
		$active_3_list = array('user.php');
		$active_4_list = array('request_list.php');
		$active_5_list = array('setting.php');
		$active_6_list = array('report.php');	
		$active_7_list = array('logfile.php');	
		
		if (in_array($page_name, $active_1_list))$m1_class = "current";	else	$m1_class = "";					
		if (in_array($page_name, $active_2_list))$m2_class = "current";	else 	$m2_class = "";						
		if (in_array($page_name, $active_3_list))$m3_class = "current";	else	$m3_class = "";											
		if (in_array($page_name, $active_4_list))$m4_class = "current";	else	$m4_class = "";											
		if (in_array($page_name, $active_5_list))$m5_class = "current";	else	$m5_class = "";											
		if (in_array($page_name, $active_6_list))$m6_class = "current";	else	$m6_class = "";				
		if (in_array($page_name, $active_7_list))$m7_class = "current";	else	$m7_class = "";										
	
?>

<div id="head">
<div style="padding:95px 0 0 144px;">
<span class="gray">Log in as:</span><?php echo $currentUser['Name']." ".$currentUser['lastname'];?>

<span class="gray"> หน่วยงาน:</span>
<?php  if($_SESSION["usergroupid"]=="2"){
			$agen="FavouriteDesign";  
		}
			echo $agen;
?>
<?php 
$pm =new UserLogin();

    $item_1=$pm->GetPermission(1);//ประเภทปัญหา
	if($item_1==""){$item_1['CanView']="";}
	$item_2=$pm->GetPermission(2);//กรม
	if($item_2==""){$item_2['CanView']="";}
	$item_3=$pm->GetPermission(3);//กอง/สำนักงาน
	if($item_3==""){$item_3['CanView']="";}
	$item_4=$pm->GetPermission(4);//กลุ่ม/ฝ่าย
	if($item_4==""){$item_4['CanView']="";}
	$item_5=$pm->GetPermission(5);//ประเภทบุคลากร
	if($item_5==""){$item_5['CanView']="";}
	$item_6=$pm->GetPermission(6);//ระบบงาน
	if($item_6==""){$item_6['CanView']="";}
	$item_7=$pm->GetPermission(7);//server
	if($item_7==""){$item_7['CanView']="";}
	
    $item_8=$pm->GetPermission(8);	 //ข้อมูลผู้แจ้ง
	 if($item_8==""){$item_8['CanView']="";}	
	
	
	$item_10=$pm->GetPermission(10); //รายงาน
	if($item_10==""){$item_10['CanView']="";}
	
    $item_9=$pm->GetPermission(9); //สิทธิ์การใช้งาน
	if($item_9==""){$item_9['CanView']="";}
	
	$item_11=$pm->GetPermission(11); //log file
	if($item_11==""){$item_11['CanView']="";}
?>
<span class="gray"> สิทธิ์ :</span><?php echo $group['UserGroupName']; ?>(<?php echo GetUserType($_SESSION["usertype"]); ?>)</div>
</div>
<div class="menu">
		<ul>
			<li><a href="profile.php"  class="<?=$m1_class;?>">ประวัติส่วนตัว</a></li>
			<?php if($item_9['CanView']=="1"){ ?>
            <li><a href="usergroup.php"  class="<?=$m2_class;?>">สิทธิ์การใช้งาน</a></li>
			<?php } ?>
			<?php if($item_8['CanView']=="1"){ ?>
            <li><a href="user.php"  class="<?=$m3_class;?>">ข้อมูลผู้แจ้ง</a></li>
			<?php } ?>
			<li><a href="request_list.php" id="current"  class="<?=$m4_class;?>">รายการที่แจ้ง</a></li>
			 <?php  
			 if($item_1['CanView']=="1" || $item_2['CanView']=="1" || $item_3['CanView']=="1" || $item_4['CanView']=="1" || $item_5['CanView']=="1" || $item_6['CanView']=="1" || $item_7['CanView']=="1"){ ?>
            
            <li><a href="#" class="<?=$m5_class;?>">ตั้งค่า</a>
            
                <ul>
				<?php 
					  if($item_1['CanView']=="1"){ ?>
                <li><a href="setting.php?act=problemlist">ประเภทปัญหา</a></li>
				<?php }
					  if($item_5['CanView']=="1"){  ?>
                <li><a href="setting.php?act=humantypelist">ประเภทบุคลากร</a></li>
				<?php }
						if($item_6['CanView']=="1"){?>
                <li><a href="setting.php?act=systemlist">ระบบงาน</a></li>
				<?php }
						if($item_7['CanView']=="1"){ ?>
                <li><a href="setting.php?act=serverlist">Server</a></li>
				<?php }
						if($item_2['CanView']=="1"){ ?>
                <li><a href="setting.php?act=departmentlist">กรม</a></li>
				<?php }
						if($item_3['CanView']=="1"){ ?>
                <li><a href="setting.php?act=divisionlist">กอง/สำนัก</a></li>
				<?php }
						if($item_4['CanView']=="1"){ ?>
                <li><a href="setting.php?act=grouplist">กลุ่ม/ฝ่าย</a></li>
			 <?php } ?>
                </ul>
          </li>
          <?php } ?>
		  	<?php if($item_10['CanView']=="1"){ ?>
            <li><a href="#" class="<?=$m6_class;?>">รายงาน</a>
            	<ul>
				<li><a href="report.php?act=list6">รายงานผลการดำเนินโครงการบริหารจัดการระบบสารสนเทศ (IT Helpdesk 02)</a></li>
            	<li><a href="report.php?act=list2">สรุปประเภทปัญหาประจำเดือน (IT Helpdesk 02-1)</a></li>
                <li><a href="report.php?act=list1">สรุปการรับแจ้งปัญหาประจำเดือน (IT Helpdesk 02-2)</a></li>
                <li><a href="report.php?act=list5">รายละเอียดแจ้งปัญหาประจำเดือน (IT Helpdesk 03)</a></li>
                <li><a href="report.php?act=list7">รายงานรายละเอียดงานค้างจากเดือนที่แล้ว (IT Helpdesk 04)</a></li>
                <!-- <li><a href="report.php?act=list4">System & Software</a></li> -->
                </ul>
            </li>
			<?php } ?>
			<?php 
				if($item_11['CanView']=="1"){
				 ?>
            <li><a href="logfile.php" class="<?=$m7_class;?>">LOG</a></li>
			<?php } ?>
            <li><a href="#" onclick="ConfirmLogout();">ออกจากระบบ</a></li>
		</ul>
	</div>
    <iframe name="frmUpdate" id="fmUpdate" width="0" height="0" frameborder="0" scrollbars="no"></iframe>