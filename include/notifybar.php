
<script type="text/javascript">
function notify(shw_type){
  switch(shw_type){ 
    case"add":
		txt="บันทึกข้อมูลเรียบร้อยแล้วคะ";
  	    break;
	case"delete":
		txt="ลบข้อมูลเรียบร้อยแล้วคะ";
  	    break;
	case"edit":		
		txt="แก้ไขข้อมูลเรียบร้อยแล้วคะ";
  	    break;
  }
	<?php if($_SESSION["show"]=="show"): ?>
	$(function() {
	  $.notifyBar({
		html: txt,
		delay: 2000,
		animationSpeed: "normal"
		
	  }); 
	 
	});
	 <?php 	
	 	unset($_SESSION["show"]);
		//unset($_SESSION["shw_type"]);
	  ?>
	<?php endif; ?>
}
</script>