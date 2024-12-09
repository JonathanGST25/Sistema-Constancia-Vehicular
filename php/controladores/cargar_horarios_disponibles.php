<?php
// Archivo verificar_evento.php
include('../conexion.php');
// Obtener la fecha del parámetro GET
$date = $_GET['date'];
$delegacionId = $_GET['delegacionId'];

// Conexión a la base de datos (actualiza los valores según tu configuración)
$host = 'localhost';
$username = 'root';
$password = '199925';
$database = 'fge_constancia_vhclo';

$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Consulta para verificar si hay un evento en la fecha especificada
$stmt = $conn->prepare("SELECT COUNT(*) AS eventCount FROM Catalogo_Horarios, Catalogo_Periodos, Delegaciones WHERE fechaCita = ? AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND Catalogo_Periodos.delegacionId = Delegaciones.delegacionId AND Delegaciones.delegacionId = '$delegacionId'");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

// Obtener el resultado de la consulta
$row = $result->fetch_assoc();
$eventCount = $row['eventCount'];

$stmt->close();
$conn->close();

if($eventCount > 0 ){
//OBTENER LA SUMA DE LA CANTIDAD DE CITAS EN EL DIA DE FECHA
$sql = "SELECT SUM(cantidadCitas) AS sumaCitas FROM Catalogo_Horarios, Catalogo_Periodos, Delegaciones WHERE fechaCita = '$date' AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND Catalogo_Periodos.delegacionId = Delegaciones.delegacionId AND Delegaciones.delegacionId = '$delegacionId'";
$result = mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($result);
$sumaCitas = $mostrar['sumaCitas'];

$sql = "SELECT COUNT(*) AS countCitas FROM Catalogo_Horarios, Catalogo_Periodos, Delegaciones WHERE fechaCita = '$date' AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND Catalogo_Periodos.delegacionId = Delegaciones.delegacionId AND Delegaciones.delegacionId = '$delegacionId'";
$result = mysqli_query($conexion, $sql);
$consulta = mysqli_fetch_array($result);
$countCitas = $consulta['countCitas'];

$sql = "SELECT Catalogo_Horarios.cantidadCoches FROM Catalogo_Horarios, Catalogo_Periodos, Delegaciones WHERE fechaCita = '$date' AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND Catalogo_Periodos.delegacionId = Delegaciones.delegacionId AND Delegaciones.delegacionId = '$delegacionId'";
$result = mysqli_query($conexion, $sql);
$consultaCoches = mysqli_fetch_array($result);
$cantidadCoches = ($consultaCoches['cantidadCoches']);

if($sumaCitas < ($countCitas * $cantidadCoches)){
    echo 'true';
}else{
    echo 'false';
}

}else{
    echo 'false';
}

?>
