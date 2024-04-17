<?php

    if(isset($_POST["search"])){
        include("conexion.php");

        $search = $_POST["search"];

        if(!empty($search)){
            $query = "SELECT 
            mt.Nombre_TT AS 'Trabajo Terminal',
            mt.Descripción AS 'Descripción TT',
            CONCAT( d.Nombre_Director, ' ' 
            ,d.Apellido_Paterno, ' '
            ,d.Apellido_Materno) AS 'NombreDirector' 
            FROM metodo_director md 
            INNER JOIN director d ON md.ID_Director = d.ID_Director 
            INNER JOIN metodo_titulacion mt ON md.ID_TT = mt.ID_TT 
            WHERE CONCAT( d.Nombre_Director,  ' ' , d.Apellido_Paterno, ' ', d.Apellido_Materno) LIKE '$search%'";
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
                    "laboratorio" => $row["laboratorio"]
                );
            }
            $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
            echo $jsonstring;
        }
    }else{
        header("Location: ../lost.html");
    }
?>