<?php
    session_start();
            if($_SESSION["TT"] != "Director" || !isset($_SESSION["usuario"])){
                header("Location: lost.html");
            }
            $ID_Sinodal = $_SESSION["usuario"];
        include("conexion.php");

            $query = "SELECT 
    mt.ID_TT AS 'ID_Trabajo_Terminal',
    mt.Nombre_TT AS 'Trabajo_Terminal',
    GROUP_CONCAT(DISTINCT CONCAT(a.Nombres, ' ', a.Apellido_Paterno, ' ', a.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Alumnos',
    GROUP_CONCAT(DISTINCT CONCAT(d.Nombre_Director, ' ', d.Apellido_Paterno, ' ', d.Apellido_Materno, ' (', c.Nombre_Cargo, ')') SEPARATOR ', ') AS 'Nombres_Directores',
    tt.Nombre_Tipo_Titulacion AS 'Tipo_Titulacion',
    ar.Nombre_Area AS 'Area'
    FROM metodo_titulacion mt
    LEFT JOIN metodo_director md ON mt.ID_TT = md.ID_TT
    LEFT JOIN director d ON md.ID_Director = d.ID_Director
    LEFT JOIN alumno a ON mt.ID_TT = a.ID_TT
    LEFT JOIN area ar ON mt.ID_Area = ar.ID_Area
    LEFT JOIN tipo_titulacion tt ON mt.ID_Tipo_Titulacion = tt.ID_Tipo_Titulacion
    LEFT JOIN estado_titulacion et ON mt.ID_Estado = et.ID_Estado
    LEFT JOIN cargo c ON md.ID_Cargo = c.ID_Cargo
    WHERE mt.ID_TT IN (
        SELECT DISTINCT mt2.ID_TT
        FROM metodo_titulacion mt2
        LEFT JOIN metodo_director md2 ON mt2.ID_TT = md2.ID_TT
        LEFT JOIN cargo c2 ON md2.ID_Cargo = c2.ID_Cargo
        WHERE md2.ID_Director = '$ID_Sinodal' AND c2.ID_Cargo = 1
    )
GROUP BY mt.ID_TT;";

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