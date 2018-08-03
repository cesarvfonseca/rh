<?php
$accion = $_POST['accion'];
    //VERIFICAR QUE LA ACCION PROVIENE DEL FORM DE LOGIN
if ($accion == 'login')
{
   include '../function/connection.php';
   $conn = Connect_DB();
   $usuario = $_POST['usuario'];
   $password = $_POST['password'];
   try{
    $query = "SELECT * FROM PJEMPLOY WHERE employee = :Usuario";
    $stmt = $conn ->prepare($query);
    $stmt -> bindParam(':Usuario', $usuario, PDO::PARAM_STR);
    $stmt -> execute();
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     $passwordDB = trim($row['user1']);
     $employeeName = trim(ucwords(strtolower($row['emp_name'])));
     if ($password === $passwordDB) {
        session_start();
        $_SESSION["userActive"] = trim($row['employee']);
        $_SESSION["userName"] = $employeeName;
        $_SESSION["loginStatus"] = true;
        $respuesta = array(
            'respuesta' => 'correcto',
            'nombre' => $employeeName,
            'tipo' => $accion
        );
    }else{
       $respuesta = array(
          'resultado' => 'Password Incorrecto'
      );
   }
} else {
    $respuesta = array(
      'resultado' => 'Usuario no existe'
  );
}
$conn = null;
}catch(PDOException $e) {
        	// En caso de un error, tomar la exepcion
   $respuesta = array(
    'pass' => $e->getMessage()
);
}
echo json_encode($respuesta);
}

if ($accion == 'txt' || $accion == 'txtc')
{
    include '../function/connection.php';
    $conn = Connect_DB();
    $fecha = $_POST['fecha'];
    $horas = $_POST['horas'];
    $razon = $_POST['razon'];
    $employeeID = $_POST["employeeID"];
    // $registros = 0;
    $NOW = date('Y-m-d');
    try{
        if ($accion == 'txt')
            $tipo = 1;
        else
            $tipo = 2;
        $insert_qry = "INSERT INTO P1TXTVAC (employee,fecha,tipo,horas,emp_observaciones,crtd_user,lupd_datetime,lupd_user)
                        VALUES (:Employeeid,:Fecha,:Tipo,:Horas,:Razon,:User,:Lupd_date,:Lupd_user)";
        $stmnt = $conn -> prepare ($insert_qry);
        $stmnt -> bindParam(':Employeeid', $employeeID, PDO::PARAM_STR);
        $stmnt -> bindParam(':Fecha', $fecha, PDO::PARAM_STR);
        $stmnt -> bindParam(':Tipo', $tipo, PDO::PARAM_INT);
        $stmnt -> bindParam(':Horas', $horas, PDO::PARAM_INT);
        $stmnt -> bindParam(':Razon', $razon, PDO::PARAM_STR);
        $stmnt -> bindParam(':User', $employeeID, PDO::PARAM_STR);
        $stmnt -> bindParam(':Lupd_date', $NOW, PDO::PARAM_STR);
        $stmnt -> bindParam(':Lupd_user', $employeeID, PDO::PARAM_STR);
        $stmnt -> execute();
        $respuesta = array(
            'estado' => 'correcto'
        );
        $stmt = null;
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

//ELIMINAR INCIDENCIAS DEL Empleado
if ($accion == 'eliminar_incidencia')
{
    // die(json_encode($_POST));
    include '../function/connection.php';
    $conn = Connect_DB();
    $id_mov = $_POST['id_mov'];
    try{
        $queryv = "SELECT jefe_autorizacion FROM P1TXTVAC WHERE id=:ID_MOV";
        $stmnt = $conn -> prepare ($queryv);
        $stmnt -> bindParam(':ID_MOV', $id_mov, PDO::PARAM_INT);
        $stmnt -> execute();
        if ($row = $stmnt->fetch(PDO::FETCH_ASSOC)) {
          $estado = $row['jefe_autorizacion'];
          if ($estado==0) {
              $delete_qry = "DELETE FROM P1TXTVAC WHERE id=:IDMOV";
              $stmnt = $conn -> prepare ($delete_qry);
              $stmnt -> bindParam(':IDMOV', $id_mov, PDO::PARAM_INT);
              $stmnt -> execute();
              $respuesta = array(
                  'estado' => 'correcto',
                  'informacion' => 'La incidencia ha sido eliminada!'
              );
          }else{
                $respuesta = array(
                    'estado' => 'incorrecto',
                    'informacion' => 'Ya esta validada por tu jefe directo'
                );
              }
          }
        $stmnt = null;
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

//AUTORIZACION DEL JEFE
if ($accion == 'voboJefe')
{
    // die(json_encode($_POST));
    include '../function/connection.php';
    $conn = Connect_DB();
    $idM = $_POST['id'];
    $status = $_POST['status'];
    $employeeID = $_POST['idempleado'];
    $observaciones_default = $_POST['observaciones_default'];
    $fecha_actual = date('Y-m-d');
    try{
        $update_qry = "UPDATE P1TXTVAC SET jefe_autorizacion=:Status, lupd_datetime=:Fecha, lupd_user=:Employeeid,jefe_observaciones=:Observaciones_jefe WHERE id=:IDM";
        $stmnt = $conn -> prepare ($update_qry);
        $stmnt -> bindParam(':Status', $status, PDO::PARAM_INT);
        $stmnt -> bindParam(':Employeeid', $employeeID, PDO::PARAM_STR);
        $stmnt -> bindParam(':Observaciones_jefe', $observaciones_default, PDO::PARAM_STR);
        $stmnt -> bindParam(':Fecha', $fecha_actual, PDO::PARAM_STR);
        $stmnt -> bindParam(':IDM', $idM, PDO::PARAM_INT);
        $stmnt -> execute();
        $respuesta = array(
            'estado' => 'correcto'
        );
        $stmnt = null;
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

if ($accion == 'vacaciones')
{
    $feriados = array(
    '1-1', // Año Nuevo (irrenunciable)
    '10-4', // Viernes Santo (feriado religioso)
    '11-4', // Sábado Santo (feriado religioso)
    '1-5', // Día Nacional del Trabajo (irrenunciable)
    '21-5', // Día de las Glorias Navales
    '29-6', // San Pedro y San Pablo (feriado religioso)
    '16-7', // Virgen del Carmen (feriado religioso)
    '15-8', // Asunción de la Virgen (feriado religioso)
    '19-9', // Dia Festivo De Prueba
    '12-10', // Aniversario del Descubrimiento de América
    '31-10', // Día Nacional de las Iglesias Evangélicas y Protestantes (feriado religioso)
    '1-11', // Día de Todos los Santos (feriado religioso)
    '8-12', // Inmaculada Concepción de la Virgen (feriado religioso)
    '13-12', // elecciones presidencial y parlamentarias (puede que se traslade al domingo 13)
    '25-12', // Natividad del Señor (feriado religioso) (irrenunciable)
    );
    include '../function/connection.php';
    $conn = Connect_DB();
    $fechaINI = $_POST['fechaINI'];
    $fechaFIN = $_POST['fechaFIN'];
    $razon = $_POST['razon'];
    $employeeID = $_POST['employeeID'];
    $NOW = date('Y-m-d');
    $param = 1;
    $tipo = 3;
    $dias_habiles = DiasHabiles($fechaINI, $fechaFIN);
    $cant = count($dias_habiles);
    try{
        for ($i=0; $i < $cant ; $i++)
        {
            $dia = $dias_habiles[$i];
            $fecha = getdate($dia);
            $feriado = $fecha['mday'].'-'.$fecha['mon'];
            //EVALUAR SABADOS / DOMINGOS / DIAS FERIADOS
            if (!(($fecha["wday"]==0 || $fecha["wday"]==6)||(in_array($feriado,$feriados))))
            {
                $fechaSQL = $fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"];
                $insert_vac = "INSERT INTO P1TXTVAC (employee,fecha,tipo,dias,emp_observaciones,crtd_user,lupd_datetime,lupd_user)
                    VALUES (:Employeeid,:Fecha,:Tipo,:Dias,:Razon,:User,:Lupd_date,:Lupd_user)";
                $stmnt = $conn -> prepare ($insert_vac);
                $stmnt -> bindParam(':Employeeid', $employeeID, PDO::PARAM_STR);
                $stmnt -> bindParam(':Fecha', $fechaSQL, PDO::PARAM_STR);
                $stmnt -> bindParam(':Tipo', $tipo, PDO::PARAM_INT);
                $stmnt -> bindParam(':Dias', $param, PDO::PARAM_INT);
                $stmnt -> bindParam(':Razon', $razon, PDO::PARAM_STR);
                $stmnt -> bindParam(':User', $employeeID, PDO::PARAM_STR);
                $stmnt -> bindParam(':Lupd_date', $NOW, PDO::PARAM_STR);
                $stmnt -> bindParam(':Lupd_user', $employeeID, PDO::PARAM_STR);
                $stmnt -> execute();
            }
        }
        $respuesta = array(
                    'estado' => 'correcto'
                );
        $stmt = null;
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

function DiasHabiles($fecha_inicial,$fecha_final)
{
$newArray = array();
list($year,$mes,$dia) = explode("-",$fecha_inicial);
$ini = mktime(0, 0, 0, $mes , $dia, $year);
list($yearf,$mesf,$diaf) = explode("-",$fecha_final);
$fin = mktime(0, 0, 0, $mesf , $diaf, $yearf);

$r = 0;
while($ini != $fin)
{
$ini = mktime(0, 0, 0, $mes , $dia+$r, $year);
// echo "ini = ". $ini ."
// ";
$newArray[] .=$ini;
$r++;
}
return $newArray;
}

function diasFeriados(){

}

?>
