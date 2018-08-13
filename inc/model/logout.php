<?php 
	// if(isset($_POST['submit'])) {
	session_start();
	$employee = $_SESSION["userActive"];
	include '../function/connection.php';
	$conn = Connect_DB();
	$queryUpdate = "UPDATE P1ACCESOWEB SET estado = :Estado WHERE employee = :Employee";
	$stmt -> bindParam(':Employee', $employee , PDO::PARAM_STR);
    $stmt -> bindParam(':Estado', $estado_en_linea , PDO::PARAM_INT);
    $stmt -> execute();
    $stmt = null;

	session_destroy();
	$_SESSION = array();
	echo "<script> location.href='../../'; </script>";
	// }else{
	// 	exit();
	// }	
 ?>