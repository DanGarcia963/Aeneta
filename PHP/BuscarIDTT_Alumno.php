<?php
    include("conexion.php");
    session_start();
    if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){
        if(isset($_POST["IDAlum"])) {
            $ID_Alumno = $_POST["IDAlum"];
        } else {
            $ID_Alumno = $_SESSION["usuario"];
        }
    } else {
        header("Location: lost.html");
        $_SESSION["usuario"] = "invitado";
    }

    if(!empty($ID_Alumno)) {
        $query = "SELECT 
            mt.ID_TT AS 'ID_Trabajo'
            FROM metodo_titulacion mt
            LEFT JOIN alumno a ON mt.ID_TT = a.ID_TT
            WHERE a.ID_Alumno = '$ID_Alumno'";
        $result = mysqli_query($conexion, $query);

        if(!$result) {
            die("Error de consulta".mysqli_error($conexion));
        }

        $fila = mysqli_fetch_assoc($result);
        $_SESSION["ID_TT"] = $fila["ID_Trabajo"];

        $json = array();
        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
                "IDTrabajo" => $row["ID_Trabajo"],
            );
        }
        $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
        echo $jsonstring;
    }
?>
