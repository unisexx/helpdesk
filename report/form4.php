  <script>
    $(document).ready(function() {  
      $('.datepicker').datepick({format: 'Y-m-d', showOn: 'both', buttonImageOnly: true, buttonImage: 'js/jquery.datepick/cal_ico.png'
      },$.datepick.regional['th']);       
    });
  </script>     

<style type="text/css">
#frmData label { color:red; }
#frmData label.error{ color:red; }
</style>
<script type="text/javascript">
//$.validator.setDefaults({
 // submitHandler: function() { $("#frmData").submit();}
//});

       $().ready(function() {
		   		
		  
			$.validator.setDefaults({
		   	  submitHandler: function() {				
				removeMultiInputNamingRules('#frmData', 'input[alt="Name[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="Blocks[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="Used[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="Available[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="PUse[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="MountedOn[]"]');
			    form.submit();
				
				}
				
			});
			 $("#frmData").validate({
			   rules: {
				  systembox: "required",
				  serverbox: "required",
				  systemdate: "required",
				  Examiner: "required"
			
				  
				},
				messages: {
				  systembox: "  กรุณาเลือกระบบงาน",
				  serverbox: "  กรุณาเลือก Server",
				  systemdate: " กรุณากรอกวันที่ตรวจสอบฐานข้อมูล",
				  Examiner: "  กรุณากรอกผู้ตรวจสอบ"
				  
				 }
									
			
			});
		   
	 $(".btn_save").click(function(){
			    
				
				removeMultiInputNamingRules('#frmData', 'input[alt="Name[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="Blocks[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="Used[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="Available[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="PUse[]"]');
				removeMultiInputNamingRules('#frmData', 'input[alt="MountedOn[]"]');
		  		addMultiInputNamingRules('#frmData', 'input[name="Name[]"]', { required:true,messages:{required:"  กรุณากรอกข้อมูล"} });
				addMultiInputNamingRules('#frmData', 'input[name="Blocks[]"]',{ required:true,messages:{required:"  กรุณากรอกข้อมูล"} });
				addMultiInputNamingRules('#frmData', 'input[name="Used[]"]', { required:true,messages:{required:"  กรุณากรอกข้อมูล"} });
				addMultiInputNamingRules('#frmData', 'input[name="Available[]"]',{ required:true,messages:{required:"  กรุณากรอกข้อมูล"} });
				addMultiInputNamingRules('#frmData', 'input[name="PUse[]"]', { required:true,messages:{required:"  กรุณากรอกข้อมูล"} });
				addMultiInputNamingRules('#frmData', 'input[name="MountedOn[]"]',{ required:true,messages:{required:"  กรุณากรอกข้อมูล"} });
				
		  });
		 

		   
       var i = 2;
          $('.tbadd input[name="button1"]').click(function(){
          var x = i++ ;
                $.post('report/formtest.php',{'data':x},function(data){
                     $(".tbadd").append(data);		   
       });
       });
       });
function ReloadServerList(pSystemID)
   {		   	  
			url = "_ajax_server_list.php?id="+pSystemID;			
			$.get(url,function(data){
				$("#dvServerList").html(data);
			});
   }
function addMultiInputNamingRules(form, field, rules){
	$(form).find(field).each(function(index){
		$(this).attr('alt', $(this).attr('name'));
		$(this).attr('name', $(this).attr('name') + '-' + index);
		$(this).rules('add', rules);
	});
}

function removeMultiInputNamingRules(form, field){
	$(form).find(field).each(function(index){
		$(this).attr('name', $(this).attr('alt'));
		$(this).removeAttr('alt');
	});
}

</script>
<?php
if(@$_GET['id']!='')$row = GetData('systemreport',@$_GET['id']);
?>
<h3>System &amp; Software (เพิ่ม / แก้ไข)</h3>
<form name="frmData" id="frmData" method="post" enctype="multipart/form-data" action="report.php?act=query4&id=<?php echo @$_GET['id'];?>&chk_edit=<?php echo $item_10['CanEdit']?>&chk_add=<?php echo $item_10['CanAdd'] ?>">
<table class="tbadd">
<tr>
  <th>ชื่อระบบงาน <span class="Txt_red_12">*</span></th>
  <td><select name="systembox" id="systembox" onchange="ReloadServerList(this.value);">
  <option value="">กรุณาเลือกระบบงาน</option>
  <?
  $sql = "SELECT * FROM system ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if(@$row['SystemID']==$srow['ID'])echo "selected";?> >
  <?=$srow['SystemName'];?>
  </option>
  <? } ?>
</select></td>
</tr>
<tr>
  <th>ServerName<span class="Txt_red_12">*</span></th>
  <td>
  <div id="dvServerList">
  <select name="serverbox" id="serverbox">
  <option value="">กรุณาเลือก Server</option>
  <?
  $sql = "SELECT * FROM server ";
  $sresult = mysql_query($sql);
  while($srow=mysql_fetch_array($sresult)){
  ?>
  <option value="<?=$srow['ID'];?>" <? if(@$row['ServerID']==$srow['ID'])echo "selected";?> >
  <?=$srow['ServerName'];?>
  </option>
  <? } ?>
</select>
</div>
</td>
</tr>
  <tr>
    <th>วันที่ตรวจสอบฐานข้อมูล <span class="Txt_red_12">*</span></th>
  <td><input type="text" id="systemdate"  name="systemdate" value="<?=ConvertDateFromDB(@$row['SystemDate'.$i]);?>" class="datepicker" size="10" />
   </td>
</tr>
</tr>
  <tr>
    <th>ผู้ตรวจสอบ <span class="Txt_red_12">*</span></th>
  <td><input type="text" id="Examiner"  name="Examiner" value="<?=@$row['Examiner'];?>"  />
   </td>
</tr>
  <tr>
    <th>File System<span class="Txt_red_12"> *</span></th>
    <td><input type="button" name="button1" id="button1" value="เพิ่ม" class="btn_create"/></td>
  </tr>
<?
if(@$_GET['id']!='')
{
	$s = 1;
$result = mysql_query("SELECT * FROM systemreportdetail WHERE PID=".@$_GET['id']." ORDER BY ID ");
while($row = mysql_fetch_array($result))
{
?>
<tr>
  <th colspan="2">File System <? echo $s++?> </th>
</tr>
<tr>
  <th class="padL15">Name  <span class="Txt_red_12">*</span></th>
  <td><input name="Name[]" type="text" id="Name[]" value="<?=@$row['NameServer'];?>" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Size  <span class="Txt_red_12">*</span></th>
  <td><input name="Blocks[]" type="text" id="Blocks[]" value="<?=@$row['1kBlocks'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Used  <span class="Txt_red_12">*</span></th> 
  <td><input name="Used[]" type="text" id="Used[]" value="<?=@$row['Used'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Available   <span class="Txt_red_12">*</span></th>
  <td><input name="Available[]" type="text" id="Available[]" value="<?=@$row['Available'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Use %  <span class="Txt_red_12">*</span></th>
  <td><input name="PUse[]" type="text" id="PUse[]" value="<?=@$row['PUse'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Mounted on  <span class="Txt_red_12">*</span></th>
  <td><input name="MountedOn[]" type="text"  value="<?=@$row['MountedOn'];?>" /></td>
</tr>
<? } }else{ ?>
<tr>
  <th colspan="2">File System 1</th>
</tr>
<tr>
  <th class="padL15">Name  <span class="Txt_red_12">*</span></th>
  <td><input name="Name[]" type="text"  value="<?=@$row['NameServer'];?>" size="50" /></td>
</tr>
<tr>
  <th class="padL15">Size  <span class="Txt_red_12">*</span></th>
  <td><input name="Blocks[]" type="text"  value="<?=@$row['1kBlocks'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Used  <span class="Txt_red_12">*</span></th>
  <td><input name="Used[]" type="text"  value="<?=@$row['Used'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Available   <span class="Txt_red_12">*</span></th>
  <td><input name="Available[]" type="text"  value="<?=@$row['Available'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Use %  <span class="Txt_red_12">*</span></th>
  <td><input name="PUse[]" type="text"  value="<?=@$row['PUse'];?>" /></td>
</tr>
<tr>
  <th class="padL15">Mounted on  <span class="Txt_red_12">*</span></th>
  <td><input  name="MountedOn[]" type="text"  value="<?=@$row['MountedOn'];?>" /></td>
</tr>
<? } ?>
<div class="test">

</div>
</table>
<div id="boxbtnadd">
  <input name="input" type="submit" value="บันทึก" class="btn_save"/>
  <input name="input2" type="button" value="ย้อนกลับ"  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>