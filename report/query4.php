<?
$action=new Userlogin();
if(@$_GET['mode']=='delete')
  { 
	if($_GET['chk_del']=="1")
	{
				
		mysql_query("DELETE FROM systemreportdetail WHERE PID=".$_GET['id']);
		mysql_query("DELETE FROM systemreport WHERE ID=".$_GET['id']);
		$detail="ชื่อ : รางาน system & Software";
		$action->AddLog(32,$detail); 
	}else{ Alert($alert_del);}
	ReDirect('report.php?act=list4','top');
  }
else{

if($_GET['id']!='')
{   
   if($_GET['chk_edit']=="1"){
	   mysql_query("UPDATE systemreport SET SystemID='".$_POST['systembox']
		."', ServerID='".$_POST['serverbox']."', SystemDate='".convertDateToDB($_POST['systemdate'])."', Examiner='".$_POST['Examiner']."' WHERE ID=".$_GET['id']);
		mysql_query($sql);
		
		mysql_query("DELETE FROM systemreportdetail WHERE PID=".$_GET['id']);
	
		for($i=0;$i<count($_POST['Name']);$i++)
		  {  
			$sql =" INSERT INTO systemreportdetail(PID, NameServer,1kBlocks, Used, Available, PUse, MountedOn)VALUES(".
			$_GET['id'].", '".$_POST['Name'][$i]."', '".$_POST['Blocks'][$i]."', '".$_POST['Used'][$i]."', '".$_POST['Available'][$i]."', '".$_POST['PUse'][$i]."', '".$_POST['MountedOn'][$i]."') ";   
			mysql_query($sql);  
		  }
	    $detail="ชื่อ : รางาน system & Software";
		$action->AddLog(31,$detail); 
   }else{ Alert($alert_edit); }
    ReDirect('report.php?act=list4','self');
}
else{
      
	if($_GET['chk_add']=="1"){
        $sql = "INSERT INTO systemreport (SystemID, ServerID, SystemDate,Examiner)
        VALUES('".$_POST['systembox']."' , '".$_POST['serverbox']."', '".convertDateToDB($_POST['systemdate'])."' , '".$_POST['Examiner']."')";
        mysql_query($sql);
        
        $sql = "SELECT ID FROM systemreport WHERE 
        SystemID=".$_POST['systembox']." 
		AND ServerID=".$_POST['serverbox']." 
		AND SystemDate='".convertDateToDB($_POST['systemdate'])."'
		AND Examiner='".$_POST['Examiner']."' ";
        $result = mysql_query($sql);
        $id = mysql_result($result,0,0);
		
      for($i=0;$i<count($_POST['Name']);$i++)
      {  
        $sql =" INSERT INTO systemreportdetail(PID, NameServer, 1kBlocks, Used, Available, PUse, MountedOn)VALUES(       
        $id,
        '".$_POST['Name'][$i]."', '".$_POST['Blocks'][$i]."', '".$_POST['Used'][$i]."', '".$_POST['Available'][$i]."', '".$_POST['PUse'][$i]."', '".$_POST['MountedOn'][$i]."')";   
        mysql_query($sql);     
      }
	 $detail="ชื่อ : รางาน system & Software";
     $action->AddLog(33,$detail); 
	}else{ Alert($alert_add); }
	ReDirect('report.php?act=list4','self');
}
}
?>

