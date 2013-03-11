<link rel="stylesheet" type="text/css" href="css/template.css"/>
<link rel="stylesheet" type="text/css" href="css/popup.css"/>
<link rel="stylesheet" type="text/css" href="css/vtip.css" />
<link rel="stylesheet" type="text/css" href="css/paginate.css" />
<link rel="stylesheet" type="text/css" href="js/date_input/date_input.css">
<link rel="stylesheet" type="text/css" href="js/jquery.datepick/redmond.datepick.css" />
<link rel="stylesheet" type="text/css" href="js/jQuery-Notify-bar/jquery.notifyBar.css" />
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.paginate.js"></script>
<script type="text/javascript" src="js/vtip.js"></script>
<script type="text/javascript" src="js/jquery-script.js"></script>
<script type="text/javascript" src="js/core.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="js/positioning.js"></script>
<script type="text/javascript" src="js/popup.js"></script>
<script type="text/javascript" src="js/date_input/jquery.date_input.min.js"></script>
<script type="text/javascript" src="js/date_input/jquery.date_input.th_TH.js"></script>
<script type="text/javascript" src="js/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="js/jquery.datepick/jquery.datepick-th.js"></script>
<script type="text/javascript" src="js/jQuery-Notify-bar/jquery.notifyBar.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(function(){	$("input.datepicker").date_input();	});
});	
</script>
<?php
	if(!isset($_SESSION["id"])){
		ReDirect('index.php','self');
	}
?>