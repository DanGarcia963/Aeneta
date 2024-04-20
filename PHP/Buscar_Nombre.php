<?php
    if(isset($_POST["search"])){
        include("conexion.php");

        $search = $_POST["search"];

        if(!empty($search)){
            $query = "SELECT 
            mt.Nombre_TT AS 'Trabajo_Terminal',
            GROUP_CONCAT(DISTINCT CONCAT(a.Nombres, ' ', a.Apellido_Paterno, ' ', a.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Alumnos',
            GROUP_CONCAT(DISTINCT CONCAT(d.Nombre_Director, ' ', d.Apellido_Paterno, ' ', d.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Directores'
            FROM metodo_titulacion mt
            LEFT JOIN metodo_director md ON mt.ID_TT = md.ID_TT
            LEFT JOIN director d ON md.ID_Director = d.ID_Director
            LEFT JOIN alumno a ON mt.ID_TT = a.ID_TT 
            WHERE mt.Nombre_TT LIKE '%$search%'
            GROUP BY mt.Nombre_TT"; /*consulta para la busqueda por nombre de TT*/ 
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
