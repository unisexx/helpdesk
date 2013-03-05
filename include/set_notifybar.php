<?php
	if(isset($_SESSION['shw_type'])){
		switch($_SESSION['shw_type']){
			case 'edit':
				echo "<script>notify('edit');</script>";
				break;
			case'add':
				echo "<script>notify('add');</script>";
				break;
			case'delete':
				echo "<script>notify('delete');</script>";
				break;
		
		}
	}
	 unset($_SESSION["shw_type"]);
?>