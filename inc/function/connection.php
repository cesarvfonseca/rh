<?php 
	function Connect_DB()
	{
	    $serverName = "MEXQ-SERVER4,1433";
		$database = "MEXQAPPdbr";
		$uid = "sa";
		$pwd = "P@ssw0rd";
	
		$conn = new PDO( "sqlsrv:server=$serverName ; Database = $database", $uid, $pwd);
		return $conn;
	}
 ?>