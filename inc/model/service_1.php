<?php 	
	$conn = Connect_DB();

	$_SESSION["godLevel"] = 0;
	$employee_id = $_SESSION["userActive"];
	$selectQuery = "SELECT 
					emp_status,employee,emp_name,em_id03,user1,manager1,manager2, 
					(SELECT em_id03 FROM PJEMPLOY WHERE employee=(SELECT manager1 FROM PJEMPLOY WHERE employee= :empID)) correo_jefe, * 
					FROM PJEMPLOY 
					WHERE employee= :empID_";
	$stmnt = $conn ->prepare($selectQuery);
	$stmnt -> bindParam(':empID', $employee_id, PDO::PARAM_STR);
	$stmnt -> bindParam(':empID_', $employee_id, PDO::PARAM_STR);
    $stmnt -> execute();
    // $conn = null;
    $row = $stmnt->fetch(PDO::FETCH_ASSOC);
    $managerMail = trim($row['correo_jefe']);
    $stmt = null;

    //IDENTIFICAR SI EL USUARIO TIENE GENTE A SU MANDO
    $selectQuery_Jefes = "SELECT * FROM PJEMPLOY WHERE manager1=:bossID";
    $stmnt = $conn ->prepare($selectQuery_Jefes);
    $stmnt -> bindParam(':bossID', $employee_id, PDO::PARAM_STR);
    $stmnt -> execute();
    $row = $stmnt->fetch(PDO::FETCH_ASSOC);

    if ($row>0) {
    	$_SESSION["godLevel"] = 1;
    }

    $stmt = null;

    //PANEL JEFE
    $selectQuery_personal = "SELECT 
							CASE
							 WHEN tipo = 1
								THEN 'TXT A FAVOR'
							 WHEN tipo = 2
								THEN 'TXT EN CONTRA'
							 WHEN tipo = 3
								THEN 'VACACIONES'
							 END AS tipo_incidencia,
							jefe_autorizacion,
								CASE
									WHEN jefe_autorizacion=0
										THEN 'Pendiente'
									WHEN jefe_autorizacion=1
										THEN 'Autorizado'	
									ELSE 'No Autorizado'
								END as voboJefe,
							rh_vobo,
								CASE
									WHEN rh_vobo=0
										THEN 'Pendiente'
									WHEN rh_vobo=1
										THEN 'Autorizado'
									ELSE 'No Autorizado'
								END as voboRH,
							txt.id,
							txt.employee,
							txt.fecha,
							txt.tipo,
							txt.horas,
							txt.dias,
							txt.emp_observaciones,
							txt.jefe_observaciones,
							txt.rh_observaciones,
							pe.emp_name
							FROM P1TXTVAC txt
							INNER JOIN PJEMPLOY pe
							ON txt.employee = pe.employee
							WHERE pe.manager1=:bossID ORDER BY fecha ASC;";
	$stmnt2 = $conn -> prepare($selectQuery_personal);
	$stmnt2 -> bindParam(':bossID', $employee_id, PDO::PARAM_STR);
    $stmnt2 -> execute();
    $stmt2 = null;
    $conn = null;
 ?>