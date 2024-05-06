<?php
include 'conexion.php';

if(isset($_POST['IDArchivo'])) {
    $id = $_POST['IDArchivo'];

    $query = "DELETE FROM `archivos` WHERE id = '$id'";
    $result = $conexion->query($query);

    if ($result)
    {
    echo'<script type="text/javascript">
    alert("Archivo cargado exitosamente!");
    </script>';
    }
     
    else {
    echo "Error al insertar pdf." . $query . "<br>" . $conexion->error;
    }
} else {
    echo "No se proporcionó ningún ID de archivo.";
}
?>
