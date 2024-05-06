<?php
include("conexion.php");
session_start();

// Verificar si hay una sesión de usuario
if(isset($_SESSION["usuario"])){
    $ID_Alumno = $_SESSION["usuario"];
} else {
    header("Location: lost.html"); // Redireccionar si no hay sesión de usuario
}

$queryIDTT = "SELECT ID_TT FROM alumno WHERE ID_Alumno = $ID_Alumno";
$resultadoIDTT = mysqli_query($conexion, $queryIDTT);

if(!$resultadoIDTT){
    die("Error de consulta".mysqli_error($conexion));
}

// Obtener el ID de área del resultado
$filaIDTT = mysqli_fetch_assoc($resultadoIDTT);
$IDTT = $filaIDTT['ID_TT'];
// Liberar el resultado
mysqli_free_result($resultadoIDTT);

// Consulta SQL para obtener los trabajos terminales
$queryArchivos = "SELECT 
                    ac.id AS 'ID_Archivo',
                    mt.Nombre_TT AS 'Trabajo_Terminal',
                    ac.archivo_nombre AS 'NombreArchivo',
                    ac.archivo_tipo AS 'TipoArchivo'
                  FROM metodo_titulacion mt
                  LEFT JOIN archivos ac ON mt.ID_TT = ac.ID_TT
                  WHERE ac.ID_TT = $IDTT";

$resultadoArchivos = mysqli_query($conexion, $queryArchivos);

if(!$resultadoArchivos){
    die("Error de consulta".mysqli_error($conexion));
}

$json = array();

while($row = mysqli_fetch_array($resultadoArchivos)){
    $json[] = array(
        "IDArchivo" => $row["ID_Archivo"],
        "TrabajoTerminal" => $row["Trabajo_Terminal"],
        "Nombre_Archivo" => $row["NombreArchivo"],
        "Tipo_Archivo" => $row["TipoArchivo"]
    );
}

$jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);

echo $jsonstring;
?>
