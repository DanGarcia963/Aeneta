<?php
include("conexion.php");
session_start();
if(isset($_SESSION["usuario"])){
    $ID_Alumno = $_SESSION["usuario"];
    echo "<script>console.log('$ID_Alumno');</script>";
if (empty($_FILES['archivo']['name'])){
header("location: formulario.php?proceso=falta_indicar_fichero"); 
exit;
}
 
if ($conexion->connect_error) {
die("La conexion falló: " . $conexion->connect_error);
}
// Consulta SQL para obtener el ID de área del director
$queryIDTT = "SELECT ID_TT FROM alumno WHERE ID_Alumno = $ID_Alumno";
$resultadoIDTT = mysqli_query($conexion, $queryIDTT);

if(!$resultadoIDTT){
    die("Error de consulta".mysqli_error($conexion));
}

// Obtener el ID de área del resultado
$filaIDTT = mysqli_fetch_assoc($resultadoIDTT);
$IDTT = $filaIDTT['ID_TT'];
echo "<script>console.log('$IDTT');</script>";
// Liberar el resultado
mysqli_free_result($resultadoIDTT);

$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;

$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
 
$binario_nombre=$_FILES['archivo']['name'];
$binario_peso=$_FILES['archivo']['size'];
$binario_tipo=$_FILES['archivo']['type'];
 
$consulta_insertar = "INSERT INTO archivos (id, archivo_binario, archivo_nombre, archivo_peso, archivo_tipo, ID_TT, ID_Alumno) VALUES ('', '$binario_contenido', '$binario_nombre', '$binario_peso', '$binario_tipo', '$IDTT','$ID_Alumno')";
 
if ($conexion->query($consulta_insertar) === TRUE)
{
echo'<script type="text/javascript">
alert("Archivo cargado exitosamente!");
</script>';
header("location: ../archivos.php");
}
 
else {
echo "Error al insertar pdf." . $consulta_insertar . "<br>" . $conexion->error;
}
}else{
    echo "Error: IDTT no definido o sesión de usuario no iniciada.";
}
 
?>