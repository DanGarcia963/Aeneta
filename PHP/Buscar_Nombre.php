<?php
/* Aqui voy hacer la busqueda*/

    if(isset($_POST["search"])){
        include("conexion.php");

        $search = $_POST["search"];

        if(!empty($search)){
            $query = "";/*sql para la busqueda / UNICO QUE TENGO QUE MODIFICAR*/ 
            $result = mysqli_query($conexion, $query);

            if(!$result){
                die("Error de consulta".mysqli_error($conexion));
            }

            $json = array();
            while($row = mysqli_fetch_array($result)){
                $json[] = array(
                    "TrabajoTerminal" => $row["Trabajo_Terminal"],
                    "NombresAlumnos" => $row["Nombres_Alumnos"],
                    "NombresDirectores" => $row["Nombres_Directores"]
                );
            }
            $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
            echo $jsonstring;
        }
    }else{
        header("Location: ../lost.html");
    }
?>
?>