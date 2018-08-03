<?php 
    $accion = $_POST['accion'];
	if ($accion == 'txt') 
    {
        include '../function/connection.php';
        $conn = Connect_DB();
        $fecha = $_POST['fecha'];
        $horas = $_POST['horas'];
        $razon = $_POST['razon'];
        $employeeID = $_POST['employeeID'];
        // $registros = 0;
        $NOW = date('Y-m-d');
        try{
            $insert_qry = "INSERT INTO P1TXTVAC (employee,fecha,txt_favor,emp_observaciones,crtd_user,lupd_datetime,lupd_user) 
                    VALUES (:Employeeid,:Fecha,:Horas,:Razon,:User,:Lupd_date,:Lupd_user)";
            $stmnt = $conn -> prepare ($insert_qry);
            $stmnt -> bindParam(':Employeeid', $employeeID, PDO::PARAM_STR);
            $stmnt -> bindParam(':Fecha', $fecha, PDO::PARAM_STR);
            $stmnt -> bindParam(':Horas', $horas, PDO::PARAM_INT);
            $stmnt -> bindParam(':Razon', $razon, PDO::PARAM_STR);
            $stmnt -> bindParam(':User', $employeeID, PDO::PARAM_STR);
            $stmnt -> bindParam(':Lupd_date', $NOW, PDO::PARAM_STR);
            $stmnt -> bindParam(':Lupd_user', $employeeID, PDO::PARAM_STR);
            $stmnt -> execute();
            $respuesta = array(
                'estado' => 'correcto'
            );
            $conn = null;
        }catch(PDOException $e) {
        // En caso de un error, tomar la exepcion
        $respuesta = array(
        'estado' => 'error',
        'log' => $e->getMessage()
        );      
        }
        echo json_encode($respuesta);
    }
 ?>