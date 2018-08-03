<?php 
	// if(isset($_POST['submit'])) {
		session_start();
		session_destroy();
		$_SESSION = array();
		echo "<script> location.href='../../'; </script>";
	// }else{
	// 	exit();
	// }	
 ?>