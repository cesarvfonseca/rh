<?php 
	function Connect_DB()
	{
	    $serverName = "MEXQ-SERVER4,1433";
		$database = "MEXQAPPPr";
		$uid = "sa";
		$pwd = "P@ssw0rd";
	
		$conn = new PDO( "sqlsrv:server=$serverName ; Database = $database", $uid, $pwd);
		return $conn;
	}

	$serverName = "MEXQ-SERVER4";
	$connectionInfo = array("Database"=>"MEXQAppPr", "UID"=>"sa", "PWD"=>"P@ssw0rd", "CharacterSet"=>"UTF-8");
	$con = sqlsrv_connect($serverName, $connectionInfo);
	
 ?>