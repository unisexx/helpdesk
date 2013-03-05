<?
	include "../include/config.php";
	include "excelwriter.inc.php"; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<script type="text/javascript" src="../js/print.js"></script>
<link rel="stylesheet" type="text/css" href="../css/print.css"/>
</head>

<body>
<!--<body onload="window.print(); window.close();">-->
<div id="page">
<?php //var_dump($_POST); ?>
<?php 
	$filename = "รายงานสรุปการรับแจ้งปัญหา".$_POST['sysname']."- ".$_POST['s_month']." ".$_POST['s_year'];
	$filename="ddd";
	$excel=new ExcelWriter("../file/$filename.xls");  //คำสั่งสร้างไฟล์ Excel โดยใช้ชื่อที่ตั้งไว้ด้านบน $filename
	if($excel==false)    
	 echo $excel->error;     
	//ถ้าสร้างไม่ได้ โชว์เออเร่อ อันนี้ไม่ต้องไปยุ่งอะไร
	 
	 $myArr=array("ลำดับ","รายการ","จำนวนเรื่องที่รับแจ้ง","หมายเหตุ"); 
	// อันนี้ผมสร้างคอลัมก่อนในส่วนแถวแรกของ excel ทำเป็น array เลยครับ
	 $excel->writeLine($myArr); 
	//เขียน array ที่สร้างด้านบนลง ลงแถวแรกเลย  โดย array แต่ละช่องจะถูกแบ่งเป็นคอลัม ๆ ไป
	 $myHead=array("งานค้างจากเดือนที่ผ่านมา","เรื่องที่ได้รับแจ้งทั้งหมดในเดือนนี้ ","	เรื่องที่ดำเนินการเรียบร้อยแล้วในเดือนนี้ ","เรื่องที่กำลังดำเนินการ (แล้วเสร็จในเดือนต่อไป)","รวมเรื่องที่ได้รับแจ้งทั้งหมด");
	 $j=0;
	 for($i=0;$i<=4;$i++){
	 $j=$j+1;
	 if($j==5){ echo $j="";}
	  
	 $myArr=array($j,$myHead[$i],$_POST['list_'.$i],"");
	
	//นำ  array แต่ละช่องที่แตกไว้มาใส่ค่าเลย
	 $excel->writeLine($myArr);  
	//จับเขียนซะ foreach วนไปเรื่อย ๆ จนครบ ค่าที่ส่งมา
	 }
	 $excel->close(); 
	//ปิดการทำงาน และแสดงผลผ่านหน้าเว็บด้านล่าง
	 echo "ทำการสร้างข้อมูลเสร็จสิ้น<br />";
    

	 
?>
<a href="../file/<?php echo $filename.".xls"; ?>">เปิดไฟล์ที่นี่</a>
</div>
</body>
</html>

