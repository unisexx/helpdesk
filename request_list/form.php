<!-- ผู้รับผิดชอบ -->
<style type="text/css">
#frmedit label.error{ color:red; }
</style>

<script type="text/javascript">
function add_problem(k)
{					
		var data,k_before,position;
		if(k=="" || k==undefined){
		 	k=2;
		}else{
			 k++;
		}
		 k_before=k-1;
			
		 	 position="'#position_"+k+"'";
			 data='<div id="problem_'+k+'">';
			 data+='<input type="hidden" name="position_'+k+'" id="position_'+k+'" value="'+k+'" />';
			 data+='<p style="padding:3px;"><label style="vertical-align:top; width:80px;display:inline-block;"> รายละเอียด '+k+' </label>';
			 data+='<textarea   name="detail'+k+'"  id="detail'+k+'" cols="72" rows="5"></textarea>';
			 data+='<span style="vertical-align:top;">';
			 data+=' <input type="button" name="delbutton" id="delbutton"  class="btn_delete" onclick="del($('+position+').val())" />';
			 data+='</span></p>';
			 data+='<p style="padding:3px;"><label style="width:80px;display:inline-block;"> URL</label>';
			 data+='<input type="text" name="url'+k+'" id="url'+k+'"   size="75" /></p>';
			 data+='<p style="padding:3px;"><label style="width:80px;display:inline-block;"> แนบไฟล์</label>';
			 data+='<input type="file" name="fileatth'+k+'" id="fileatth'+k+'" size="40"/></p>';
			 data+='</div>';
			$('#k_before').val(k);
			
			$('.problem').append(data);
}
		 
function alert_del(id,list_id,ch)
{
		var ans=confirm(" ต้องการลบรายการนี้ ?");	
		if(ans){
			if(ch==1){
				window.location="request_list/del.php?detail_id="+id+"&id="+list_id+"&act=del_file";
			}else{
			
				window.location="request_list/del.php?detail_id="+id+"&id="+list_id;
			}
		}
}

function del(post){
	$('#problem_'+post).remove();
	v=$('#k_before').val();
	v=v-1;
	$('#k_before').val(v);
	
}



$(document).ready(function() {
	$("[name=orderid]").fancybox({
				'width'				: '60%',
				'height'			: '50%',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'autoscale' 		:false,
				'scrolling'			: 'yes',
				'type'				: 'iframe'
	});	
	$("[name=order]").fancybox({
		'width'				: '60%',
		'height'			: '50%',
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'autoscale' 		:false,
		'scrolling'			: 'yes',
		'type'				: 'iframe'
	});					   



  $("#frmedit").validate({
    rules: {
      systemid: "required",
	  problemtype: "required",
      title: "required",	  
      n_orderid: "required",
	  detail1:"required"	
	 

    },
    messages: {
      systemid: "  กรุณาเลือกระบบ", 
      problemtype: "  กรุณาประเภทปัญหา",      
      title: "  กรุณาพิมพ์หัวข้อ",     
      n_orderid: "กรุณาเลือกผู้แจ้ง",
	  detail1:" กรุณาพิมพ์รายละเอียดปัญหา"
	  
     },
	 errorPlacement: function(error, element){
		
		if (element.is(":radio")) 
			if(element.attr('name')=="systemid")
				error.appendTo(element.parent().parent());
			else
				error.appendTo(element.parent());
		else 
			if (element.is(":checkbox")) 
				error.appendTo(element.next());
			else 			  
				error.appendTo(element.parent());
	}					
  });
     $("#frmedit input[name='mileage']").each(function() {
       $(this).rules("add", { required: true });
    }); 
	
	var content_id = "<?php echo $_GET['id']?>";
	if(content_id == ""){
		$('.detail,.result,.test,.future').hide();
	}else{
		$('.detail,.result,.test,.future').show();
	}
	
    $('select[name=status]').change(function(){
    	if($(this).val() == 1){
    		$('.detail,.result,.test,.future').show();
    	}else{
    		$('.detail,.result,.test,.future').hide();
    	}
    });
});
</script>


<?php
  	
db_connect(); 
if (isset($_GET['id']))
{
	//$id=$_GET['id'];
	$rs=GetData("request_lists",$_GET['id']);
	$dd="select new_date,operation_date,send_date,complete_date from request_lists where id=".$rs['id'];	
	$result=mysql_query($dd) or die("datediff :".mysql_error());
	$item=mysql_fetch_assoc($result);
	
	
	
}else{
	$rs['id']="";
	$rs['code']="";
	$rs['status']="";
	$rs['problemtype']="";
	$rs['title']="";
	$rs['send_note']="";
	$rs['system_note']="";
	$rs['coordinator_note']="";
	$rs['response_note']="";
	$rs['orderid']="";
	$rs['responsibleid']="";
	$rs['chk_send']="";
	$rs['new_date']="";
	$rs['operation_date']="";
	$rs['complete_date']="";
	$rs['systemid']="";
	$rs['service']="";
	$rs['coordinatorid']="";
	$rs['send_date']="";
	$rs['active_date']="";
	$rs['ownid']="";
}
 ?>

<form id="frmedit" action="request_list/save.php" method="post" enctype="multipart/form-data">

<table class="tbadd">
<tr>
<th></th>
<td>
<?php if(isset($_GET['id'])){ ?>

<div style="height:55px;width:160px;float:left">
<img src="images/new.png" width="32" height="32" title="รายการใหม่" align="absmiddle"/>

<span style="display:inline-block;vertical-align:middle">
 <?php 
 
		if($rs['chk_send']=="send" || $rs['chk_send']=="send_wait"){
			if($item['send_date']!="0000-00-00 00:00:00"){
				echo difftime($item['send_date'],$item['new_date']); 
			}
		}else{
			if($item['operation_date']!="0000-00-00 00:00:00"){
				echo difftime($item['operation_date'],$item['new_date']);
			}
		}
 	 
	?>
</span>
 <p><?php echo DB2Date($item['new_date']) ?></p>
</div>

<div style="height:55px;width:160px;float:left ">
    <?php if($rs['chk_send']==""){ ?>
    <img src="images/process.png" width="32" height="32" title="กำลังดำเนินการ" align="absmiddle"/>
   	<?php }else{ ?>
    <img src="images/send.png" width="32" height="32" title="ส่งต่อการดำเนินการ" align="absmiddle"/>
    <?php } ?>

    <span style="display:inline-block;vertical-align:middle">
  	<?php
			
		if($rs['chk_send']=="send" || $rs['chk_send']=="send_wait"){
			if($rs['complete_date']!="0000-00-00 00:00:00"){
				echo difftime($item['complete_date'],$item['send_date']);
				
			}
		  $c=TRUE; 
		}else{
			if($rs['complete_date']!="0000-00-00 00:00:00"){
				if($item['operation_date']!="0000-00-00 00:00:00")
				{
					echo difftime($item['complete_date'],$item['operation_date']);
				}else{
					echo difftime($item['complete_date'],$item['new_date']);
				}
				//echo $item['complete_date'];
				//echo $item['operation_date'];
				
			}
		  $c=FALSE;
		}
	
	?>
    </span>
    <p><?php echo ($c)? DB2Date($item['send_date']):DB2Date($item['operation_date']); ?></p>
</div>  
    <div style="height:55px;width:160px;float:left">
    <img src="images/complete.png" width="32" height="32" title="เรียบร้อย"  align="absmiddle"/>
    <p><?php echo DB2Date($item['complete_date']) ?></p>
    </div>
  
  <?php }else{ ?>
  <img src="images/new.png" width="32" height="32" title="รายการใหม่" align="absmiddle"/>
  <img src="images/process.png" width="32" height="32" title="กำลังดำเนินการ" align="absmiddle"/>
  <img src="images/send.png" width="32" height="32" title="แจ้งกลับแล้ว" align="absmiddle"/>
  <img src="images/complete.png" width="32" height="32" title="เรียบร้อย"  align="absmiddle"/>
  <?php } ?>

</td>
</tr>
<tr>
  <th>รหัส </th>
  <td><?php  echo ($rs['code']=="")?"ระบบกำหนดให้อัตโนมัติ":$rs['code'];?></td>
</tr>
<tr>
<th>ระบบ</th>
<td>
<div style="width:1000px">
<?php 
	$sql= "SELECT c.id as id,c.systemname as name FROM informent a ";
	$sql.=" LEFT JOIN user_systems b on a.id=b.userid";
	$sql.=" LEFT JOIN system c on b.systemid=c.id";
	$sql.=" WHERE a.id='".$_SESSION['id']."'";
	$result=mysql_query($sql); 
?>
        <?php while($item=mysql_fetch_assoc($result)): ?>
        <span style="display:inline-block;float:left;width:300px;">
    		<input type="radio" name="systemid"  value="<?php echo $item['id']?>" <?php if($item['id']==$rs['systemid']){echo "checked";}?>/> <?php echo $item['name']?>
        </span>
		<?php endwhile; ?> 
</div>  
</td>
</tr>
<tr>
<tr>
  <th>สถานะ</th>
  <td>
  	<select name="status" id="select">
    <option value="">กรุณาเลือกสถานะ</option>
   	<?php $sql="select * from problemstatus order by id"; 
		  $result=mysql_query($sql);?>
	<?php while($item=mysql_fetch_assoc($result)):?>
    	<option value="<?php echo $item['id'];?>" <?php if($item['id']==trim($rs['status'])){ echo"selected";}?>><?php echo $item['name'];?></option>
	<?php endwhile;?>
    </select>
  </td>
</tr>
<tr>
  <th>ประเภทปัญหา<span class="Txt_red_12">*</span></th>  
  <td>
	<?php 			
		$sql="SELECT  * FROM problemtype order by id"; 
		$result=mysql_query($sql);	
		//if (!$result) { echo "$sql"; die("\n Invalid query: " . mysql_error()); }
    ?>
		<?php while($item =mysql_fetch_assoc($result)): ?>
             <input type="radio" name="problemtype"  value="<?php echo $item['ID']; ?>" <?php if($item['ID']==$rs['problemtype']){ echo"checked";} ?> /><label> <?php echo $item['ProblemName'] ?></label>  
        <?php endwhile; ?>

  </td>
</tr>
<tr>
	<th>ช่องทางการแจ้ง</th>
    <td>
    	<input type="radio" name="service" value="sys"  checked="checked" /> ระบบ
		<input type="radio" name="service" value="tel"   <?php if($rs['service']=="tel"){echo "checked";}?>/> โทรศัพท์
		<input type="radio" name="service" value="email" <?php if($rs['service']=="email"){echo "checked";}?>/> อีเมล์
        <input type="radio" name="service" value="other" <?php if($rs['service']=="other"){echo "checked";}?>/> อื่นๆ
    </td>
</tr>
<tr>
  <th>หัวเรื่อง <span class="Txt_red_12">*</span></th>
  <td><input name="title" type="text" id="textarea3"  size="75"  value="<?php echo $rs['title']; ?>"/></td>
</tr>
<tr>
<th></th>
<td class="problem">
<?php 
     
if(@$_GET['id']!=""){
		  $sql="select b.id as id,b.fileatth as fileatth,b.detail as detail,b.url as url,b.title_id as title_id";
		  $sql.=" from request_lists a left join request_list_details b on a.id=b.title_id where a.id=".$_GET['id']." order by id ";
		  $result=mysql_query($sql) or die("Error :".mysql_error());
		 
?>
	<p style="padding:3px;"><input type="button"  id="addproblem" name="addproblem" value="เพิ่มรายละเอียด" onclick="add_problem($('#k_before').val());" /></p>
	<?php  
		$i=0;
		$k_before=0;
	while( $item=mysql_fetch_assoc($result)){ 
		$i++;
	?>
    <div id="problem_<?php echo $i ?>"  >
    <p style="padding:3px;"><label style="vertical-align:top; width:80px;display:inline-block;"> รายละเอียด <?php echo $i ?></label><textarea  name="detail<?php echo $i ?>" 
    id="detail<?php echo $i ?>" cols="72" rows="5"><?php echo $item['detail'] ?></textarea>
        <span style="vertical-align:top;">       
        <input type="button" name="delbutton" id="delbutton"  class="btn_delete" onclick="alert_del(<?php echo $item['id']; ?>,<?php echo $rs['id']; ?>)" />
       
        </span>
    </p>
    <p style="padding:3px;">
    <label style="width:80px;display:inline-block;"> URL</label><input type="text" name="url<?php echo $i ?>"  size="75" value="<?php echo $item['url']?>"/>
    </p>
    
   <?php if($item['fileatth']!="" ){?>
    <p style="padding:3px;">
    <label style="width:80px;display:inline-block;"> ไฟล์ :</label><a href="download.php?filename=<?php echo $item['fileatth']?>"><?php echo $item['fileatth']?></a>
    <img   src="images/delete_ico.png" width="14" height="15"  name="del_file" class="cursor" onclick="alert_del(<?php echo $item['id']; ?>,<?php echo $rs['id']; ?>,1)"  />
    <input type="hidden"  name="fileatth<?php echo $i ?>" value="<?php echo $item['fileatth']?>" />
    </p> 
    <?php } ?>
    <p style="padding:3px;"><label style="width:80px;display:inline-block;"> แนบไฟล์</label><input type="file"   name="fileatth<?php echo $i ?>"  size="40"/> </p>
     
   <?php $k_before=$i; ?>
   <div>   
    <?php } ?>
     <input type="hidden"  name="k_before" id="k_before" value="<?php echo $k_before ?>" />
     
<?php }else{ ?>	
<div id="problem_1">
<input type="hidden" name="position_1" id="position_1" value="1" />
<input type="hidden" name="k_before" value="1" id="k_before" />
<p style="padding:3px;"><input type="button"  id="addproblem" name="addproblem" value="เพิ่มรายละเอียด" onclick="add_problem($('#k_before').val());" /></p>
<p style="padding:3px;"><label style="vertical-align:top; width:80px;display:inline-block;"> รายละเอียด 1  <span class="Txt_red_12">*</span></label><textarea  name="detail1" id="detail1" cols="72" rows="5"></textarea>

</p>
<p style="padding:3px;"><label style="width:80px;display:inline-block;"> URL</label><input type="text" name="url1" id="url1" size="75" value=""/></p>
<p style="padding:3px;"><label style="width:80px;display:inline-block;"> แนบไฟล์</label><input type="file"   name="fileatth1" id="fileatth1"  size="40"/></p>
</div>		 
<?php  }?>
</td>
</tr>




<tr> 
  <th>ชื่อผู้แจ้ง  <span class="Txt_red_12">*</span></th>
  <td>
  <?php if($rs['orderid']!=0 || $rs['orderid']!="" ):?>
 	 	<?php  $name=GetUser($rs['orderid'],'order'); echo $name['name']?>
        <input type="hidden" name="orderid" value="<?php  echo $rs['orderid']?>" />

  <?php endif;?>
  <?php if ($rs['orderid']==0 || $rs['orderid']==""): ?>
        <input name="n_orderid" type="text" id="n_orderid" size="40" onclick='$("a[name=orderid]").trigger("click");' />
         <a name="orderid"  class="a_search" href="request_list/order_search.php?total=total"></a>
        <input type="hidden" name="orderid"  />
  <?php endif;?>

  </td>
<!-- <tr>
	<th>ชื่อผู้ประสานงาน</th>
    <td>
	<?php if($rs['coordinatorid']!=0):?>
    <?php  echo $name=GetUser($rs['coordinatorid'],'coor');?>
    	<input type="hidden" name="coordinatorid" value="<?php  echo $rs['coordinatorid']?>" />
  	<?php endif;?>
  	<?php if ($rs['coordinatorid']==0): ?>
        <input name="n_coordinatorid" type="text" id="n_coordinatorid" size="40" onclick='$("a[name=order]").trigger("click");' />
         <a name="order" class="a_search" href="request_list/coor_search.php"></a>
         <input type="hidden" name="coordinatorid"  />
  	<?php endif;?>
    </td>
</tr>  -->
</tr>
<tr>
  <th>ผู้พัฒนา/MA</th>    
  <td> 
  
  	<?php if($rs['responsibleid']!=0 || $rs['responsibleid']!="" ):?>
  		<?php echo $reponse=GetUser($rs['responsibleid'],'response');?>
        <input name="responsibleid" type="hidden" value="<?php echo $rs['responsibleid'];?>" />
        
    <?php endif;?>          
    <?php 
    	if(@$rs['id'])
		{
		 if($rs['responsibleid']==0 || $rs['responsibleid']==""){
	    		echo $reponse=GetUser($_SESSION['id'],'user');?>
	        <input name="responsibleid" type="hidden" value="<?php echo $_SESSION['id'];?>" />             
  <?php }}?>
 
  </td>
</tr>
<tr>
	<th>เจ้าหน้าที่/ผู้ดูแลระบบ</th>
	<td></td>
</tr>
<!-- <tr>
  <th valign="top">ส่งให้เจ้าของระบบ</th>
  <td>
  	<input type="radio" name="chk_send" id="checkbox"  value="" checked="checked" /> ไม่ส่งต่อ
    <input type="radio" name="chk_send" id="checkbox"  value="send"      <?php echo ($rs['chk_send']=='send')?"checked":""; ?> /> ส่งต่อ กรณีงานเดี่ยว
    <input type="radio" name="chk_send" id="checkbox"  value="send_wait" <?php echo ($rs['chk_send']=='send_wait')?"checked":""; ?> /> ส่งต่อ กรณีเป็นงานร่วม
  </td>
</tr> -->
<!-- <tr>
  <th valign="top">รายละเอียดการส่งต่อ</th>
  <td><textarea name="send_note" cols="72" rows="5" id="textarea5"><?php echo $rs['send_note'];?></textarea></td>
</tr> -->
<!-- <tr>
  <th valign="top">เจ้าของระบบ</th>
  <td>
  <input type="checkbox" name="system_success" value="1" <?php  echo($rs['system_success']=="1")? "checked":"";?> disabled="disabled" /> เสร็จ</td>
</tr> -->
<tr class="detail">
	<th>รายละเอียดการดำเนินงาน</th>
	<td><textarea name="Name" rows="5" cols="72"></textarea></td>
</tr>
<tr class="result">
	<th>ผลการดำเนินงาน</th>
	<td><textarea name="Name" rows="5" cols="72"></textarea></td>
</tr>
<tr class="test">
	<th>ผลการทดสอบ</th>
	<td><textarea name="Name" rows="5" cols="72"></textarea></td>
</tr>
<tr class="future">
	<th>ข้อเสนอแนะในการนำไปสู่การแก้ปัญหาในอนาคต</th>
	<td><textarea name="Name" rows="5" cols="72"></textarea></td>
</tr>
<tr>
	<th>แจ้งผลการดำเนินงาน</th>
	<td>
		ชื่อ - สกุล <input type='text' name='' style="width:260px;"> วันที่แจ้ง <input type='text' name=''><br>
		ช่องทางแจ้ง <input type="radio" name="service" value="tel"   <?php if($rs['service']=="tel"){echo "checked";}?>/> โทรศัพท์
		<input type="radio" name="service" value="email" <?php if($rs['service']=="email"){echo "checked";}?>/> อีเมล์
        <input type="radio" name="service" value="other" <?php if($rs['service']=="other"){echo "checked";}?>/> อื่นๆ
	</td>
</tr>
<tr>
  <th valign="top">ผู้รับผิดชอบ</th>
  <td><input type="checkbox" name="response_success"value="1" <?php  echo ($rs['response_success']=="1")? "checked":"";?>/> เสร็จ</td>
</tr>
<tr>
  <th valign="top">สนทนา</th>
  <td>
  	<u>บันทึกสนทนา</u><br />
    <?php
    	//---------- dear ------------
		$sql = "select * from request_list_note where request_lists_id = '".$_GET['id']."' order by id asc";
		
		$result = mysql_query($sql) or die("Error request_list_note :".mysql_error());
		while($row = mysql_fetch_assoc($result)){
			echo"<font color=#65358F>$row[informent_name] : $row[detail] <span style=font-size:10px;>($row[date])</span></font><br>";
		}
	?>   
  	<textarea name="request_note" cols="72" rows="2" id="textarea4"></textarea>
  </td>
</tr>
</table>

  <input type="hidden" name="id" 				value="<?php echo $rs['id']; ?>" />
  <input type="hidden" name="code" 				value="<?php echo $rs['code']; ?>" />
  
  <?php if($rs['status']==""): ?>
   <input type="hidden" name="new_date" 		value="<?php echo date('Y-m-d H:i:s'); ?>" />
   <input type="hidden" name="active_date"      value="<?php echo date('Y-m-d H:i:s');?>" />
  <?php endif; ?>
  <?php if($rs['status']!=""):?>
  	<input type="hidden" name="new_date" 		value="<?php echo $rs['new_date']; ?>" />
  <?php endif; ?>
  <input type="hidden" name="new_date"			value="<?php echo $rs['new_date'];?>" />
  <input type="hidden" name="operation_date" 	value="<?php echo $rs['operation_date'];?>" />
  <input type="hidden" name="complete_date" 	value="<?php echo $rs['complete_date'];?>" />

  <input type="hidden" name="send_date"			value="<?php echo $rs['send_date']; ?>" />
  <input type="hidden" name="active_date"       value="<?php echo $rs['active_date'];?>" />
  <input type="hidden" name="system_success" 	value="<?php echo $rs['system_success']?>" />
  <input type='hidden' name="ownid"				value="<?php echo $rs['ownid'] ?>" />
 <div id="boxbtnadd">  
  <input name="input" type="submit" value="บันทึก" class="btn_save" />
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(1)" class="btn_back"/>
</div>
</form>