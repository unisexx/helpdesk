<?

$m = "Hello World.";
$subject = "Test PHP Mailer";
			require_once("PHPMailer_v5.1/class.phpmailer.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path		
			require_once("PHPMailer_v5.1/class.smtp.php");  // ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path	
			$mail = new PHPMailer();		
			$mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้                        		
			$mail->From     = "mail.favouritedesign.com";  //  account e-mail ของเราที่ใช้ในการส่งอีเมล
			$mail->FromName = "crm@favouritedesign.com"; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
			$mail->AddAddress('clinton.toey@gmail.com');            // Email ปลายทางที่เราต้องการส่ง
			$mail->AddAddress('phionixz@hotmail.com'); 
			$mail->AddAddress('t_auchz@hotmail.com');
			for($i=0;$i<=count($str);$i++){
				$mail->AddAddress($str[$i]); 
			}
			  		
			$mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
			$mail->Subject     =  $subject;        // หัวข้อที่จะส่ง
			$mail->Body     = $m;                   // ข้อความ ที่จะส่ง
			$mail->SMTPDebug = false;
			$mail->do_debug = 0;

			$flgSend = $mail->send();       
		
	
			/* ###### PHPMailer #### */
		
		
	
		
		if (@$flgSend)
		{								
			


		  //ReDirect($host."request_list.php",'top');
			
		}
		else 
		{
			print ('CANNOT SEND EMAIL');
		}
?>