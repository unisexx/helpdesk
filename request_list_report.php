<?php 
include ('include/adodb_connect.php');
include ('include/function.php');
//$db->debug = true;
$db->EXECUTE("set names 'utf8'");
$req = $db->GetRow('select request_lists.*,informent.Name,informent.lastname,informent.tel,informent.email,department.DeptName from request_lists LEFT JOIN informent ON request_lists.orderid = informent.ID LEFT JOIN department ON informent.DepartmentID = department.ID where request_lists.id = '.$_GET['id']);
$details = $db->GetAll('select * from request_list_details where title_id = '.$_GET['id']);
?>
<style type="text/css">
.fill{border-bottom: 1px dashed #333;padding: 0 10px;}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานการแจ้งปัญหาใช้ระบบงาน</title>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="800" border="0" align="center">
  <tr>
    <td><font style="font-size:20px"><strong>แบบฟอร์มการรับแจ้งปัญหา / การให้บริการ</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
      <tr>
        <td><table width="100%" border="0" cellpadding="3" cellspacing="3">
          <tr>
            <td><p>วันที่รับแจ้ง <span class="fill"><?php echo DB2Date($req['new_date'])?></span> เวลา <span class="fill"><?php echo DB2Date($req['new_date'],'timeonly')?> น.</span> วันที่ดำเนินการ <span class="fill"><?php echo DB2Date($req['active_date'])?></span> เวลา <span class="fill"><?php echo DB2Date($req['active_date'],'timeonly')?> น.</span> วันที่เรียบร้อย <span class="fill"><?php echo DB2Date($req['complete_date'])?></span> เวลา <span class="fill"><?php echo DB2Date($req['complete_date'],'timeonly')?> น.</span> </p>
              <p>รหัส .......................... ระบบ ............................... สถานะ
                <input type="checkbox" name="checkbox7" value="checkbox" />
                รายการใหม่
  <input type="checkbox" name="checkbox" value="checkbox" />
                กำลังดำเนินการ
  <input type="checkbox" name="checkbox2" value="checkbox" />
                เรียบร้อย
  <input type="checkbox" name="checkbox3" value="checkbox" />
                แจ้งกลับแล้ว</p>
              <p>ช่องทางแจ้ง
                <input type="checkbox" name="checkbox4" value="checkbox" />
                โทรศัพท์
  <input type="checkbox" name="checkbox5" value="checkbox" />
                e-mail
  <input type="checkbox" name="checkbox6" value="checkbox" />
                อื่น ๆ (ระบุ)  ..............................................................................................................</p>
              <p>เรื่อง / ประเภทปัญหา : <span class="fill"><?php echo $req['title']?></span></p>
              <p>รายละเอียด</p>
              <?php if($details):?>
	              <?php foreach($details as $detail):?>
	              	<p><span class="fill">- <?php echo $detail['detail']?></span></p>
	              <?php endforeach;?>
              <?php endif;?>
              <p>ชื่อผู้แจ้ง <span class="fill"><?php echo $req['Name']?> <?php echo $req['lastname']?></span> 
              	หน่วยงาน <span class="fill"><?php echo $req['DeptName']?></span> 
              	โทรศัพท์ติดต่อ <span class="fill"><?php echo ($req['tel'])?$req['tel']:'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';?></span><br>
              	e-mail <span class="fill"><?php echo $req['email']?></span></p>
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
            <td><p>ระบุประเภทปัญหา สาเหตุ
              <input type="checkbox" name="checkbox72" value="checkbox" />
              By App
  <input type="checkbox" name="checkbox8" value="checkbox" />
              By User
  <input type="checkbox" name="checkbox22" value="checkbox" />
              Hardware
  <input type="checkbox" name="checkbox35" value="checkbox" />
              Network
  <input type="checkbox" name="checkbox352" value="checkbox" />
              อื่น ๆ..........</p>
              <p>วันที่ดำเนินการ .................................. </p>
              <p>รายละเอียดการดำเนินงาน </p>
              <p>...................................................................................................................................................................................................</p>
              <p>...................................................................................................................................................................................................</p>
              <p>ผลการดำเนินการ</p>
              <p>...................................................................................................................................................................................................</p>
              <p>...................................................................................................................................................................................................</p>
              <p>ผลการทดสอบ</p>
              <p>...................................................................................................................................................................................................</p>
              <p>...................................................................................................................................................................................................<br />
              </p>
              <p>ข้อเสนอแนะในการนำไปสู่การแก้ปัญหาในอนาคต</p>
              <p>...................................................................................................................................................................................................</p>
              <p>...................................................................................................................................................................................................<br />
              </p></td>
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
                  <p>แจ้งกลับ .................................... วันที่ ...............................<br />
                    ทาง
                    <input type="checkbox" name="checkbox32" value="checkbox" />
                    E-mail
                    <input type="checkbox" name="checkbox33" value="checkbox" />
                    โทรศัพท์
                    <input type="checkbox" name="checkbox34" value="checkbox" />
                    อื่น ๆ..............................<br />
                  </p>
                <p>&nbsp;</p>
                <p align="center">ลงชื่อ ...................................................................<br />
                  (........................................................................................)<br />
                  วันที่ ..................................................................................... </p></td>
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