<?php
include 'conexion.php';

if(isset($_GET['IDArchivo'])) {
    $id = $_GET['IDArchivo'];

    $query ="SELECT archivo_nombre,archivo_binario,archivo_tipo,archivo_peso FROM archivos WHERE id='".$id."'";
    $result = $conexion->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['archivo_nombre'];
        $contenido = $row['archivo_binario'];

        // Obtener la extensión del archivo
        $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

        // Establecer las cabeceras
        header("Content-Disposition: inline; filename=\"$nombre\"");
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Si es PDF, establecer Content-type como application/pdf
        if ($extension == 'pdf') {
            header('Content-type: application/pdf');
        } else {
            // Si es imagen, establecer Content-type según la extensión
            if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {
                $tipo_imagen = 'image/' . $extension;
                header("Content-type: $tipo_imagen");
            } else {
                // Si no es ni PDF ni imagen, asumimos que es binario
                header('Content-type: application/octet-stream');
            }
        }

        // Mostrar el contenido binario
        echo $contenido;
    } else {
        echo "No se encontró ningún archivo con ese ID.";
    }
} else {
    echo "No se proporcionó ningún ID de archivo.";
}
?>
