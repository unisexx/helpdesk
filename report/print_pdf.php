<link rel="stylesheet" type="text/css" href="../css/print.css" />
<?php
	  include "../include/config.php";
	  include "../include/function.php";
	  include "../include/session_config.php";
	  include "../plugins/tcpdf/tcpdf.php";
	  db_connect();
	 
	
	function ReportTable($ch){
		
		 switch($ch)
		 {
			case "list1":
				$myArr=array("ลำดับ","รายการ","จำนวนเรื่องที่รับแจ้ง","หมายเหตุ"); 
		 		$myHead=array("งานค้างจากเดือนที่ผ่านมา","เรื่องที่ได้รับแจ้งทั้งหมดในเดือนนี้ ","	เรื่องที่ดำเนินการเรียบร้อยแล้วในเดือนนี้ ","เรื่องที่กำลังดำเนินการ (แล้วเสร็จในเดือนต่อไป)","รวมเรื่องที่ได้รับแจ้งทั้งหมด");
				break;
			case "list2":
		 		$myArr=array("ลำดับ","รายการ","จำนวนเรื่องที่รับแจ้ง","การอ้างอิง"); 
				$myHead=array("งานแก้ไขข้อผิดพลาด","งานปรับปรุงเพิ่มเติม","งานสอบถาม","งานอื่นๆ","รวม");
				break;
		 }
	
		
		
		
		if($ch=="list1")
		{
			$html ='<p><label class="headtitle"><b>สรุปการรับแจ้งปัญหา</b></label></p>';		
			$html .='<div>';
			$html .='<table cellpadding="5" style="width:90%;" >';
			$html .='<tr style="line-height:200">';
			$html .='<th style="width:7%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[0].'</b></th>';
			$html .='<th style="width:40%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[1].'</b></th>';
			$html .='<th style="width:20%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[2].'</b></th>';
			$html .='<th style="width:30%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[3].'</b></th>';
			$html .='</tr>';
			 $j=0;
			for($i=0;$i<count($myHead);$i++){
				$j=$j+1;
				if($j==5){ echo $j="";}
			$html .='<tr >';
			$html .='<td style="width:7%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;">'.$j.'</td>';
			$html .='<td style="width:40%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;">'.$myHead[$i].'</td>';
			$html .='<td style="width:20%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;">'.$_POST['list_'.$i].'</td>';
			$html .='<td style="width:30%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"></td>';
			$html .='</tr>';
			}
	 
			$html .='</table>'; 
			$html .='</div>';
			$html .='<p><label class="headtitle"><b>ข้อเสนอแนะอื่นๆ</b></label></p>';
			$html .='<div style="height:540px;">';
			for($i=1;$i<8;$i++){
			$html .='<p>............................................................................................................................................................................................</p>';
			}
			$html .='</p>'.str_repeat('</br>',5);
			$html .='  <label><b>ลงชื่อเจ้าหน้าที่ :</b></label>';
			$html .='  <span class="underline" style="width:155px;">__________________________</span>';
			$html .='  <label><b>ลงชื่อผู้ดูแลระบบ :</b></label>';
			$html .='  <span class="underline" style="width:155px;">__________________________</span></p>';      
			$html .='</div>';
		}else if($ch=="list2"){
			
			$html .='<table cellpadding="5" style="width:90%;" >';
			$html .='<tr style="line-height:200">';
			$html .='<th style="width:7%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[0].'</b></th>';
			$html .='<th style="width:40%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[1].'</b></th>';
			$html .='<th style="width:20%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[2].'</b></th>';
			$html .='<th style="width:30%;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"><b>'.$myArr[3].'</b></th>';
			$html .='</tr>';
			 $j=0;
			for($i=0;$i<count($myHead);$i++){
				$j=$j+1;
				if($j==5){ echo $j="";}
			$html .='<tr >';
			$html .='<td style="width:7%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;">'.$j.'</td>';
			$html .='<td style="width:40%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;">'.$myHead[$i].'</td>';
			$html .='<td style="width:20%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;">'.$_POST['list_'.$i].'</td>';
			$html .='<td style="width:30%;color:#333;border-top: 1px solid #666;border-bottom: 1px solid #666;border-left: 1px solid #666;border-right: 1px solid #666;"></td>';
			$html .='</tr>';
			}
	 
			$html .='</table>'; 
			$html .='</div>';
		}else if($ch=="list3"){
	/*		$sql="SELECT * FROM request_lists where id='".$_POST['id'];
		
			$html  ='<div id="title">รายงานข้อผิดพลาดของระบบงาน</div>';
			$html .='<div>';
			$html .='<p><label>ที่มา</label> เจ้าหน้าที่ ศทส.   เจ้าของระบบ   ผู้ใช้งานทั่วไป </p>';
			$html .='<p><label>ผู้แจ้ง</label><span class="underline" style="width:280px;">คุณเพ็ญนภา</span><label>วันที่</label><span class="underline" style="width:80px;">22/4/2553</span><label>เวลา</label><span class="underline" 				style="width:65px;">13.00 น.</span></p>';
			$html .='<p><label>หน่วยงาน</label><span class="underline" style="width:290px;">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</span><label>เบอร์โทรศัพท์</label><span class="underline" style="width:105px;">084-255-4741</span></p>';
			$html .='<p><label>ผู้รับแจ้ง</label><span class="underline" style="width:262px;">&nbsp;</span><label>วันที่</label><span class="underline" style="width:80px;"></span><label>เวลา</label><span class="underline" style="width:65px;"></span></p>';
			$html .='<p><label>หน่วยงาน</label><span class="underline" style="width:290px;"></span><label>เบอร์โทรศัพท์</label><span class="underline" style="width:105px;"></span></p>';
			$html .='<p><label>รายการผิดพลาด</label><span style="border:0px; height:230px;">-</span></p>';
			$html .='<p><label>ระบุสาเหตุ</label>Bug App Bug User Hardware Network ไม่สามารถระบุได้</p>';
			$html .='<p><label>ส่งต่อ</label><span class="underline" style="width:280px;"></span><label>วันที่</label><span class="underline" style="width:80px;"></span><label>เวลา</label><span class="underline" style="width:65px;"></span></p>';
			$html .='</div>';
			$html .='<div>';
			$html .='<p><label>รายละเอียด</label><span style="border:0px; height:230px;">-</span></p>';
			$html .='<p><label>สรุปผลการแก้ไข</label><span style="border:0px; height:120px;">-</span></p>';
			$html .='<p><label>ผู้รายงานผล</label><span class="underline" style="width:235px;"></span><label>วันที่</label><span class="underline" style="width:80px;"></span><label>เวลา</label><span class="underline" style="width:65px;"></span>';$html .='</p>';
			$html .='<p><label>ผู้รับผลรายงาน</label><span class="underline" style="width:218px;"></span><label>วันที่</label><span class="underline" style="width:80px;"></span><label>เวลา</label><span class="underline" style="width:65px;"></span></p>';
			$html .='<p><label>หน่วยงาน</label><span class="underline" style="width:290px;"></span><label>เบอร์โทรศัพท์</label><span class="underline" style="width:105px;"></span></p>';
			$html .='</div>';
*/
			
			
		$html='<table style="width:90%" cellpadding=3; cellspacing=10;>';
        $html.='<tr>';
        $html.='<td style="width:80px">ที่มา</td>';
        $html.='<td style="border-bottom:1px solid #999;">เจ้าหน้าที่ ศทส.   เจ้าของระบบ   ผู้ใช้งานทั่วไป</td>';
        $html.='</tr>';
        $html.='<tr>';
        $html.=' 	<td>ผู้แจ้ง</td>';
        $html.='    <td style="border-bottom:1px solid #999;">คุณเพ็ญนภา</td>';       
        $html.='    <td>วันที่</td>';
        $html.='    <td style="border-bottom:1px solid #999;">22/4/2553</td>';
        $html.='    <td style="width:80">เวลา</td>';
        $html.='    <td style="border-bottom:1px solid #999;">13.00 น.</td>';
        $html.=' </tr>';
        $html.='<tr>';
        $html.='	<td>หน่วยงาน</td>';
        $html.='    <td colspan="2" style="border-bottom:1px solid #999;">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</td>';
        $html.='    <td>เบอร์โทรศัพท์</td>';
       $html.='    <td style="border-bottom:1px solid #999;">084-255-4741</td>';
       $html.=' </tr>';
       $html.=' <tr>';
       $html.=' 	<td>ผู้รับแจ้ง</td>';
       $html.='     <td style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.='     <td>วันที่</td>';
       $html.='     <td style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.='     <td>เวลา</td>';
       $html.='     <td style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.=' </tr>';
       $html.=' <tr>';
       $html.=' 	<td>หน่วยงาน</td>';
       $html.='     <td colspan="2" style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.='     <td>เบอร์โทรศัพท์</td>';
       $html.='     <td style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.=' </tr>';
       $html.=' <tr>';
       $html.=' 	<td style="width:120" >รายการผิดพลาด</td>';
       $html.='     <td colspan="4" style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.=' </tr>';
	   $html.=' <tr>';
       $html.=' 	<td>ระบุสาเหตุ</td>';
       $html.='     <td colspan="4" style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.=' </tr>';
	   $html.=' <tr>';
       $html.=' 	<td >ส่งต่อ</td>';
       $html.='     <td  style="border-bottom:1px solid #999;">&nbsp;</td>';
	   $html.='     <td >วันที่</td>';
	   $html.='     <td  style="border-bottom:1px solid #999;">&nbsp;</td>';
	   $html.='     <td>เวลา</td>';
	   $html.='     <td  style="border-bottom:1px solid #999;">&nbsp;</td>';
       $html.=' </tr>';
       $html.=' </table>';
        		
		
		}
	
		return  $html;
      
	}
	function head($ch){
		switch($ch){
			case "list1":
					$hd ='<div style="text-align:center;"><b>รายงานสรุปการรับแจ้งปัญหา '.$_POST['sysname'] .'<br /> ประจำเดือน '.$_POST['s_month'].'  '.$_POST['s_year'].'</b></div>';
					break;
			case "list2":
					$hd ='<div style="text-align:center;"><b>รายงานสรุปการรับแจ้งปัญหา '.$_POST['sysname'] .'<br /> ประจำเดือน '.$_POST['s_month'].'  '.$_POST['s_year'].'</b></div>';
					break;
			case "list3":
					$hd='<div style="text-align:center"><b>รายงานข้อผิดพลาดของระบบงาน</b></div>';
					break;
		}
		return $hd;
	}
			
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		    // remove default header/footer
		    $pdf->setPrintHeader(false);
		    $pdf->setPrintFooter(TRUE);
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		    //set margins
		    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		
		    //set auto page breaks
		    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		    //set image scale factor
		    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
		
		    //initialize document
		    $pdf->AliasNbPages();
		
		    // add a page
		    $pdf->AddPage();

			$hd=head($_POST['list']);
			$pdf->SetFont("freeserif", "", 11);
			$pdf->writeHTML($hd, true, false, true, false, '');	
			$pdf->Ln(3);
			//$html=ReportTable($_POST['list']);
			$html=ReportTable($_POST['list']);
			//print $html;exit;
			
			$pdf->SetFont("freeserif", "", 10);
			$pdf->writeHTML($html, true, false, true, false, '');			
		
			
			$filename="Report_SystemProblem_";	
			ob_clean() ;
			//$pdf->Output($filename,"I");
			$pdf->Output($filename,"D");

							
?>
