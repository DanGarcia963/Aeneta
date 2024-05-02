<?php
    include("conexion.php");
    session_start();
    if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){
        if(isset($_POST["IDAlum"]))
        {
            $ID_Alumno = $_POST["IDAlum"];
        }
        else{
            $ID_Alumno = $_SESSION["usuario"];
            //echo "<script>console.log('$ID_Alumno');</script>";
        }
    }else{
        header("Location: lost.html");
        $_SESSION["usuario"] = "invitado";
    }


    if(!empty($ID_Alumno)){
        $query = "SELECT 
        a.ID_Alumno AS 'ID_Alumno',
        mt.Nombre_TT AS 'Trabajo_Terminal',
        mt.Descripción AS 'Descripcion',
        GROUP_CONCAT(DISTINCT CONCAT(a.Nombres, ' ', a.Apellido_Paterno, ' ', a.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Alumnos',
        GROUP_CONCAT(DISTINCT CONCAT(d.Nombre_Director, ' ', d.Apellido_Paterno, ' ', d.Apellido_Materno) SEPARATOR ', ') AS 'Nombres_Directores',
        tt.Nombre_Tipo_Titulacion AS 'Tipo_Titulacion',
        ar.Nombre_Area AS 'Area',
        et.Nombre_Estado AS 'Estado'
        FROM metodo_titulacion mt
        LEFT JOIN metodo_director md ON mt.ID_TT = md.ID_TT
        LEFT JOIN director d ON md.ID_Director = d.ID_Director
        LEFT JOIN alumno a ON mt.ID_TT = a.ID_TT
        LEFT JOIN area ar ON mt.ID_Area = ar.ID_Area
        LEFT JOIN tipo_titulacion tt ON mt.ID_Tipo_Titulacion = tt.ID_Tipo_Titulacion
        LEFT JOIN estado_titulacion et ON mt.ID_Estado = et.ID_Estado
        WHERE a.ID_Alumno = '$ID_Alumno'";
        $result = mysqli_query($conexion, $query);

        if(!$result){
            die("Error de consulta".mysqli_error($conexion));
        }

        $json = array();
        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                "IDAlumno" => $row["ID_Alumno"],
                "TrabajoTerminal" => $row["Trabajo_Terminal"],
                "Description" => $row["Descripcion"],
                "NombresAlumnos" => $row["Nombres_Alumnos"],
                "NombresDirectores" => $row["Nombres_Directores"],
                "TipoTitulacion" => $row["Tipo_Titulacion"],
                "AreaTT" => $row["Area"],
                "EstadoTT" => $row["Estado"],
            );
        }
        $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
        echo $jsonstring;
    }
?>