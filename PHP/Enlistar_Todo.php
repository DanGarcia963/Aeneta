<?php
    session_start();

    if($_SESSION["usuario"] == "root"){
        include("conexion.php");

        $query = "SELECT * FROM alumnos";

        $result = mysqli_query($conexion, $query);

        if(!$result){
            die("Error de consulta".mysqli_error($conexion));
        }

        $json = array();

        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                "boleta" => $row["boleta"],
                "nombre" => $row["nombre"],
                "apellidoP" => $row["apellido_paterno"],
                "apellidoM" => $row["apellido_materno"],
                "fecha" => $row["fecha"],
                "laboratorio" => $row["laboratorio"]
            );
        }

        $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);

        echo $jsonstring;

    }else{
        header("Location: ../lost.html");
    }
?>