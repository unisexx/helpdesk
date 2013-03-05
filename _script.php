<link rel="stylesheet" type="text/css" href="css/template.css"/>
<link rel="stylesheet" type="text/css" href="css/popup.css"/>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/vtip.js"></script>
<link rel="stylesheet" type="text/css" href="css/vtip.css" />
<script type="text/javascript" src="js/jquery-script.js"></script>
<script type="text/javascript" src="js/core.js"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="ajax.js" type="text/javascript"></script>
<script src="js/positioning.js" type="text/javascript"></script>
<script src="js/popup.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/paginate.css" />
<script type="text/javascript" src="js/date_input/jquery.date_input.min.js"></script>
<script type="text/javascript" src="js/date_input/jquery.date_input.th_TH.js"></script>
<link rel="stylesheet" href="js/date_input/date_input.css" type="text/css">
<script type="text/javascript" src="js/jquery.datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="js/jquery.datepick/jquery.datepick-th.js"></script>
<link type="text/css" href="js/jquery.datepick/redmond.datepick.css" rel="stylesheet" />
<link rel="stylesheet" href="js/jQuery-Notify-bar/jquery.notifyBar.css" />
<script type="text/javascript" src="js/jQuery-Notify-bar/jquery.notifyBar.js"></script>

<?php
	if(!isset($_SESSION["id"])){
		ReDirect('index.php','self');
	}
?>