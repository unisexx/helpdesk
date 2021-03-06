<?php 
include ('include/adodb_connect.php');
include ('include/function.php');
//$db->debug = true;
$db->EXECUTE("set names 'utf8'");
$req = $db->GetRow('SELECT
request_lists.id,
request_lists.`code`,
request_lists.problemtype,
request_lists.title,
request_lists.`status`,
request_lists.chk_send,
request_lists.system_note,
request_lists.response_note,
request_lists.coordinator_note,
request_lists.send_note,
request_lists.active_date,
request_lists.send_date,
request_lists.new_date,
request_lists.operation_date,
request_lists.complete_date,
request_lists.systemid,
request_lists.orderid,
request_lists.responsibleid,
request_lists.coordinatorid,
request_lists.ownid,
request_lists.service,
request_lists.system_success,
request_lists.response_success,
request_lists.operation_detail,
request_lists.result,
request_lists.test,
request_lists.future,
request_lists.admin_id,
request_lists.rso_name,
request_lists.rso_date,
request_lists.rso_channel,
request_lists.servicetype_id,
informent.`Name`,
informent.lastname,
informent.Tel,
informent.Email,
department.DeptName,
system.SystemName,
problemstatus.`name` AS statusname,
problemtype.ProblemName,
informent.GroupID,
hd_section.GroupName
FROM
request_lists
LEFT JOIN informent ON request_lists.orderid = informent.ID
LEFT JOIN department ON informent.DepartmentID = department.ID
LEFT JOIN system ON request_lists.systemid = system.ID
LEFT JOIN problemstatus ON request_lists.`status` = problemstatus.id
LEFT JOIN problemtype ON request_lists.problemtype = problemtype.ID
LEFT JOIN hd_section ON informent.GroupID = hd_section.ID
where request_lists.id = '.$_GET['id']);
$details = $db->GetAll('select * from request_list_details where title_id = '.$_GET['id']);
$service = array('tel'=>'โทรศัพท์','sys'=>'ระบบ','email'=>'อีเมล์','other'=>'อื่นๆ');
?>
<style type="text/css">
.fill{border-bottom: 1px dashed #333;padding: 0 10px;}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แบบฟอร์มการรับแจ้งปัญหา / การให้บริการ การบริหารจัดการระบบสารสนเทศ สป.พม.</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="window.print();">
<div align="right">IT Helpdesk 01</div>
<div align="center"><h3>แบบฟอร์มการรับแจ้งปัญหา / การให้บริการ<br>การบริหารจัดการระบบสารสนเทศ สป.พม. </h3></div>
<table width="800" border="0" align="center">
  <tr>
    <td><font style="font-size:20px"><strong>แบบฟอร์มการรับแจ้งปัญหา / การให้บริการ</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td><table width="100%" border="0" cellpadding="3" cellspacing="3">
          <tr>
            <td><p>วันที่รับแจ้ง <span class="fill"><?php echo DB2Date($req['new_date'])?></span> เวลา <span class="fill"><?php echo DB2Date($req['new_date'],'timeonly')?> น.</span> วันที่ดำเนินการ <span class="fill"><?php echo DB2Date($req['operation_date'])?></span> เวลา <span class="fill"><?php echo DB2Date($req['operation_date'],'timeonly')?> น.</span> วันที่เรียบร้อย <span class="fill"><?php echo DB2Date($req['complete_date'])?></span> เวลา <span class="fill"><?php echo DB2Date($req['complete_date'],'timeonly')?> น.</span> </p>
              <p>รหัส <span class="fill"><?php echo $req['code']?></span> ระบบ <span class="fill"><?php echo $req['SystemName']?></span> สถานะ <span class="fill"><?php echo $req['statusname']?></span> ช่องทางแจ้ง <span class="fill"><?php echo $service[$req['service']]?></span>
              <p>เรื่อง / ประเภทปัญหา : <span class="fill"><?php echo $req['title']?></span></p>
              <p>รายละเอียด</p>
              <?php if($details):?>
	              <?php foreach($details as $detail):?>
	              	<p><span class="fill">- <?php echo $detail['detail']?></span></p>
	              <?php endforeach;?>
              <?php endif;?>
              <p>ชื่อผู้แจ้ง <span class="fill"><?php echo $req['Name']?> <?php echo $req['lastname']?></span> 
              	หน่วยงาน <span class="fill"><?php echo $req['GroupName']?></span> 
              	<?php echo ($req['Tel'])?'โทรศัพท์ติดต่อ <span class="fill">'.$req['Tel'].'</span>':'';?>
              	E-mail <span class="fill"><?php echo $req['Email']?></span></p>
              </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><font style="font-size:20px"><strong>รายงานผลการดำเนินงาน การบริหารจัดการระบบสารสนเทศ สป.พม.</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td><table width="100%" border="0" cellpadding="3" cellspacing="3">
          <tr>
            <td><p>ระบุประเภทปัญหา สาเหตุ <span class="fill"><?php echo $req['ProblemName']?></span> วันที่ดำเนินการ <span class="fill"><?php echo DB2Date($req['operation_date'])?></span> </p>
              <p>รายละเอียดการดำเนินงาน <span class="fill"><?php echo $req['operation_detail']?></span></p>
              <p>ผลการดำเนินการ <span class="fill"><?php echo $req['result']?></span></p>
              <p>ผลการทดสอบ <span class="fill"><?php echo $req['test']?></span></p>
              <p>ข้อเสนอแนะในการนำไปสู่การแก้ปัญหาในอนาคต <span class="fill"><?php echo $req['future']?></span></p></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><u>
การแจ้งผลการดำเนินงาน</u></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="50%"><table width="100%" border="0" cellpadding="3" cellspacing="3">
            <tr>
              <td><p>สำหรับเจ้าหน้าที่ IT Helpdesk</p>
                  <p>แจ้งกลับ <span class="fill"><?php echo $req['Name']?> <?php echo $req['lastname']?></span> วันที่ <span class="fill"><?php echo DB2Date($req['rso_date'])?></span><br />
                   ช่องทางแจ้ง <span class="fill"><?php echo $service[$req['rso_channel']]?></span>
                    <!-- <input type="checkbox" name="checkbox32" value="checkbox" />
                    E-mail
                    <input type="checkbox" name="checkbox33" value="checkbox" />
                    โทรศัพท์
                    <input type="checkbox" name="checkbox34" value="checkbox" />
                    อื่น ๆ..............................<br /> -->
                  </p>
                <p>&nbsp;</p>
                <p align="center">ลงชื่อ <span class="fill">สาโรจน์ อุทธา</span><br />
                  (<span class="fill">นายสาโรจน์ อุทธา</span>)<br />
                  วันที่ <span class="fill"><?php echo DB2Date($req['rso_date'])?></span> </p></td>
            </tr>
        </table></td>
        <td width="50%"><table width="100%" border="0" cellpadding="3" cellspacing="3">
            <tr>
              <td><p>สำหรับผู้ควบคุมงาน</p>
                  <p>
                    <input type="checkbox" name="checkbox342" value="checkbox" />
                    รับเรื่อง / ทราบ ณ วันที่ ................................................<br />
                    <input type="checkbox" name="checkbox343" value="checkbox" />
                    ตรวจสอบความถูกต้อง ณ วันที่ ....................................<br />
                    <input type="checkbox" name="checkbox344" value="checkbox" />
                    ข้อแนะนำ / แก้ไขเพิ่มเติม ........................................... </p>
                <p align="center"><br />
                  ลงชื่อ ...............................................................<br />
                  (........................................................................................)<br />
                  วันที่ ..................................................................................... </p></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>