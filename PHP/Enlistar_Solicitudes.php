<?php
        include("conexion.php");

            $query = "SELECT 
            mt.ID_TT AS 'ID_Trabajo_Terminal',
            mt.Nombre_TT AS 'Trabajo_Terminal',
            GROUP_CONCAT(DISTINCT CONCAT(a.Nombres, ' ', a.Apellido_Paterno, ' ', a.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Alumnos',
            GROUP_CONCAT(DISTINCT CONCAT(d.Nombre_Director, ' ', d.Apellido_Paterno, ' ', d.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Directores',
            tt.Nombre_Tipo_Titulacion AS 'Tipo_Titulacion',
            ar.Nombre_Area AS 'Area'
            FROM metodo_titulacion mt
            LEFT JOIN metodo_director md ON mt.ID_TT = md.ID_TT
            LEFT JOIN director d ON md.ID_Director = d.ID_Director
            LEFT JOIN alumno a ON mt.ID_TT = a.ID_TT
            LEFT JOIN area ar ON mt.ID_Area = ar.ID_Area
            LEFT JOIN tipo_titulacion tt ON mt.ID_Tipo_Titulacion = tt.ID_Tipo_Titulacion
            LEFT JOIN estado_titulacion et ON mt.ID_Estado = et.ID_Estado
            WHERE et.Nombre_Estado = 'En Revision'
            GROUP BY mt.ID_TT";

        $result = mysqli_query($conexion, $query);

        if(!$result){
            die("Error de consulta".mysqli_error($conexion));
        }

        $json = array();

        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                "ID_Terminal" => $row["ID_Trabajo_Terminal"],
                "TrabajoTerminal" => $row["Trabajo_Terminal"],
                "NombresAlumnos" => $row["Nombres_Alumnos"],
                "NombresDirectores" => $row["Nombres_Directores"],
                "TipoTitulacion" => $row["Tipo_Titulacion"],
                "AreaTT" => $row["Area"]
            );
        }

        $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);

        echo $jsonstring;
?>