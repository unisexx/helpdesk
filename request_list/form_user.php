<!-- ผู้ใช้งาน -->
<script>	
		!window.jQuery && document.write('<script src="js/fancybox/jquery-1.4.3.min.js"><\/script>');		
</script>
<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>	
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />	
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
				alert("ddd");
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
function form_disable()
{

	$("input[name='systemid']:checked").attr('disabled','disabled ');
	$("input[name='systemid']").attr('disabled','disabled');
	
	$("input[name='problemtype']:checked").attr('disabled','disabled');
	$("input[name='problemtype']").attr('disabled','disabled');
	$("input[name='title']").attr('disabled','disabled');
	var k_before=$("#k_before").val();
	for(i=1;i<=k_before;i++){				
		$('#detail'+i).attr('disabled','disabled');
		$('#url'+i).attr('disabled','disabled');
		$('#fileatth'+i).attr('disabled','disabled');
	}
  //$("#addproblem").attr('disabled','disabled');
  $(".btn_delete").attr('disabled','disabled');
  $("input[name='del_file']").attr('disabled','disabled');
		
}
function form_enable(){
	$("input[name='systemid']:checked").removeAttr('disabled');
	$("input[name='systemid']").removeAttr('disabled');
	
	$("input[name='problemtype']:checked").removeAttr('disabled');
	$("input[name='problemtype']").removeAttr('disabled');
	$("input[name='title']").removeAttr('disabled');
	var k_before=$("#k_before").val();
	for(i=1;i<=k_before;i++){				
		$('#detail'+i).removeAttr('disabled');
		$('#url'+i).removeAttr('disabled');
		$('#fileatth'+i).removeAttr('disabled');
	}
  //$("#addproblem").removeAttr('disabled');
  $(".btn_delete").removeAttr('disabled');
  $("input[name='del_file']").removeAttr('disabled');
}

$(document).ready(function() {
				
		// กรณี ไม่ใช่รายการของผู้แจ้ง ระบบ, ประเภทปัญหา, ช่องทางการแจ้ง, หัวเรื่อง, รายละเอียด	ให้ disable ไว้   
	    var status=$("input[name='status']").val();
		//alert(status);
		var order_id=$("input[name='orderid']").val();
		var sess_id=$("input[name='sess_id']").val();
		if(status !="1")
		{
			if(status!=""){
				form_disable();
			}
	 	 }
	  	if(status=="1"){			
			//order_id="2";
			if(sess_id==order_id){
				form_enable();
			}else{
				form_disable();
			}
		}
		

	
  $.validator.setDefaults({
		   	  submitHandler: function() {				
				form_enable();			   
				form.submit();
				}
				
  });								   
					   
  $("#frmedit").validate({
    rules: {
      systemid: "required",
	  problemtype: "required",
      title: "required",
	  detail1: "required"

    },
    messages: {
      systemid: "  กรุณาเลือกระบบ", 
      problemtype: "  กรุณาประเภทปัญหา",      
      title: "  กรุณาพิมพ์หัวข้อ",
      detail1: "  กรุณาพิมพ์รายละเอียดปัญหา"

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
  
});   
</script>



<?php 
  
db_connect(); 
	if(isset($_GET['id'])){
		//$id=$_GET['id'];
		$rs=GetData("request_lists",$_GET['id']);
		//if($rs['chk_send']=="send" || $rs['chk_send']=="send_wait"){		
		/*	$dd="select datediff(send_date,new_date) as dd1,datediff(complete_date,send_date) as dd2, from request_lists where id=".$rs['id'];		
		}else{
			$dd="select datediff(operation_date,new_date) as dd1,datediff(complete_date,operation_date)  as dd2 from request_lists where id=".$rs['id'];*/
			
		//}
	$dd="select new_date,operation_date,send_date,complete_date from request_lists where id=".$rs['id'];	
	$result=mysql_query($dd) or die("datediff :".mysql_error());
	$item=mysql_fetch_assoc($result);
	}
	else{
		$rs['id']="";
		$rs['code']="";
		$rs['status']="";
		$rs['problemtype']="";
		$rs['title']="";
		
	
	
		
		$rs['coordinatorid']="";
  		$rs['send_note']="";
		$rs['orderid']="";
		$rs['responsibleid']="";
		$rs['chk_send']="";
		$rs['new_date']="";
		$rs['operation_date']="";
		$rs['complete_date']="";
	
		$rs['systemid']="";
		$rs['service']="";
		
		$rs['send_date']="";
		$rs['active_date']="";
		$rs['ownid']="";
	}
 
?>
<form  id="frmedit" action="request_list/save.php"  method="post" enctype="multipart/form-data">
<input type="hidden" name="sess_id" value="<?php echo $_SESSION["id"] ?>" />
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
  <img src="images/send.png" width="32" height="32" title="ส่งต่อการดำเนินการ" align="absmiddle"/>
  <img src="images/complete.png" width="32" height="32" title="เรียบร้อย"  align="absmiddle"/>
  <?php } ?>

   </td>
</tr>
<tr>
<tr>
  <th>รหัส</th>
    <td><?php echo ($rs['code']=="")?"ระบบกำหนดให้อัตโนมัติ":$rs['code'];?></td>
<tr>
<th>ระบบ <span class="Txt_red_12">*</span></th>
<td>
<?php 
	$sql= "SELECT c.id as id,c.systemname as name FROM informent a ";
	$sql= $sql. " LEFT JOIN user_systems b on a.id=b.userid";
	$sql= $sql. " LEFT JOIN system c on b.systemid=c.id";
	$sql= $sql. " WHERE a.id='".$_SESSION['id']."'";
	
	$result=mysql_query($sql); 
	
?>
        <?php while($item=mysql_fetch_assoc($result)): ?>
    		<input type="radio" name="systemid" id="systemid" value="<?php echo $item['id']?>" <?php if($item['id']==$rs['systemid']){echo "checked";}?>/> <?php echo $item['name']?>
        <?php endwhile; ?>   
</td>
</tr>
<tr>
  <th>สถานะ</th>
  <td><?php echo ($rs['status']=="")? "-":GetProblemStatus($rs['status'],false); ?></td>
</tr>
<tr>
  <th>ประเภทปัญหา   <span class="Txt_red_12">*</span></th>
  <td>
  <?php 	
		
		$sql="SELECT  * FROM problemtype order by id"; 
		$result=mysql_query($sql);	

  ?>
		<?php while($item =mysql_fetch_assoc($result)): ?>
             <input type="radio" name="problemtype" id="problemtype" value="<?php echo $item['ID']; ?>" <?php if($item['ID']==$rs['problemtype']){ echo"checked";} ?> /><label> <?php echo $item['ProblemName'] ?></label>  
        <?php endwhile; ?>
</td>
</tr>
<tr>
  <th>หัวเรื่อง <span class="Txt_red_12">*</span></th>
  <td><input name="title" type="text" id="title"  size="75" value="<?php echo $rs['title']; ?>" /></td>
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
    <div id="problem_<?php echo $i ?>" >
   
    
    <p style="padding:3px;"><label style="vertical-align:top; width:80px;display:inline-block;"> รายละเอียด <?php echo $i ?></label><textarea  name="detail<?php echo $i ?>" 
    id="detail<?php echo $i ?>" cols="72" rows="5"><?php echo $item['detail'] ?></textarea>
        <span style="vertical-align:top;">       
        <input type="button" name="delbutton" id="delbutton"  class="btn_delete" onclick="alert_del(<?php echo $item['id']; ?>,<?php echo $rs['id']; ?>)" />
        </span>
    </p>
    <p style="padding:3px;">
    <label style="width:80px;display:inline-block;"> URL</label><input type="text" name="url<?php echo $i ?>"   id="url<?php echo $i ?>" size="75" value="<?php echo $item['url']?>"/>
    </p>
    
   <?php if($item['fileatth']!="" ){?>
    <p style="padding:3px;">
    <label style="width:80px;display:inline-block;"> ไฟล์ :</label><a href="download.php?filename=<?php echo $item['fileatth']?>"><?php echo $item['fileatth']?></a>
     <img   src="images/delete_ico.png" width="14" height="15"  name="del_file" class="cursor" onclick="alert_del(<?php echo $item['id']; ?>,<?php echo $rs['id']; ?>,1)"  /></p>  
      <input type="hidden"  name="fileatth<?php echo $i ?>" value="<?php echo $item['fileatth']?>" />
   
   <?php } ?>
    <p style="padding:3px;"><label style="width:80px;display:inline-block;"> แนบไฟล์</label><input type="file"   name="fileatth<?php echo $i ?>" id="fileatth<?php echo $i ?>" size="40"/> </p>
     <input type="hidden" name="fileatth_old<?php echo $i ?>"  value="<?php  echo $item['fileatth']?>" />  
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

</td>
</tr>


<tr>
  <th>ชื่อผู้แจ้ง</th>
  <td><?php echo  GetUser($_SESSION['id'],'user'); ?></td>
</tr>
<tr>
  <th>ชื่อผู้รับผิดชอบ</th>
  <td><?php echo (isset($_GET['id']))?GetUser($rs['responsibleid'],'response'):$rs['responsibleid'];?></td>
</tr>

<tr>
  <th valign="top">สนทนา</th>
  <td>
  	<u>บันทึกสนทนา</u><br />
    <?php
    	//---------- dear ------------
		$sql = "select * from request_list_note where request_lists_id =  '".$_GET['id']."' order by id asc";				
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)){
			echo"<font color=#65358F>$row[informent_name] : $row[detail] <span style=font-size:10px;>($row[date])</span></font><br>";
		}
	?>
    
  	<textarea name="request_note" cols="72" rows="2" id="textarea4" ></textarea>
  </td>
</tr>
</table>
<div id="boxbtnadd">

  <input type="hidden" name="id" 				value="<?php echo $rs['id']; ?>" />
  <input type="hidden" name="code"				value="<?php echo $rs['code'];?>" />
  <input type="hidden" name="status" id="status"			value="<?php echo $rs['status']; ?>" />
  <input type="hidden" name="coordinatorid"		value="<?php echo $rs['coordinatorid']?>" />
  <input type="hidden" name="send_note"			value="<?php echo $rs['send_note']; ?>" />
  <input type="hidden" name="chk_send" 			value="<?php echo $rs['chk_send']; ?>" /> 
 
  <input type="hidden" name="responsibleid" 	value="<?php echo $rs['responsibleid'];?>" />

  <input type="hidden" name="send_date"			value="<?php echo $rs['send_date'];?>" />
  <input type="hidden" name="active_date"		value="<?php echo $rs['active_date']?>"/>
  <input type="hidden" name="complete_date" 	value="<?php echo $rs['complete_date']?>" />
  <input type="hidden" name="operation_date" 	value="<?php echo $rs['operation_date']?>" />
  <input type="hidden" name="response_success"  value="<?php echo $rs['response_success'] ?>" />
  <input type="hidden" name="system_success"    value="<?php echo $rs['system_success']?>" />
  <input type="hidden" name="new_date"			value="<?php echo $rs['new_date'] ?>" />
  <input type="hidden" name="ownid"				value="<?php echo $rs['ownid']?>" />
 
 
  <?php if($rs['orderid']==0):?>
  	<input type="hidden" name="orderid"			value="<?php echo $_SESSION['id'];?>" />
   <?php endif; ?>
  <?php if($rs['orderid']!=0): ?>
  	 <input type="hidden" name="orderid" 		value="<?php echo $rs['orderid']; ?>" />
  <?php endif; ?>
   <?php if($rs['status']==""):?>
  	<input type="hidden" name="status" 			value="1" />
    <input type="hidden" name="new_date"		value="<?php echo date('Y-m-d H:i:s');?>" />
  <?php endif; ?>
 
 
   <?php if($rs['service']==""): ?>
   <input type="hidden" name="service"			value="sys" />
   <?php endif; ?>
   <?php if($rs['service']!=""): ?>
   	<input type="hidden" name="service" 		value="<?php echo $rs['service']?>" />
   <?php endif; ?>
  <input name="input" type="submit" 	value="บันทึก" 	class="btn_save"/>
  <input name="input2" type="button" 	value="ย้อนกลับ"  class="btn_back"	onclick="history.back(-1)" />
</div>
</form>