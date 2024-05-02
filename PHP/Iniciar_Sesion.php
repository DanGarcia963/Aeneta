<?php
    session_start();
    include("conexion.php");
    if(empty($_POST["correo"])){
        header("Location: lost.html");
    }
    else{
        $correo = $_POST["correo"];
        $contra = $_POST["contra"];
            $query = "SELECT ID_Alumno AS 'IDAlumno', ID_TT AS 'IDTrabajoTerminal' FROM alumno WHERE Correo = '$correo' AND Contrasena ='$contra'"; 
            $result = mysqli_query($conexion, $query);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $_SESSION["usuario"] = $row["IDAlumno"];
                if($row["IDTrabajoTerminal"])
                {
                    $_SESSION["TT"]="SI";
                }
                else
                {
                    $_SESSION["TT"]="NO";
                }
                $json = array();
                
                do {
                    $json[] = array(
                        "ID_Alumno" => $row["IDAlumno"],
                    );
                } while ($row = mysqli_fetch_assoc($result));
                
                // Convierte el array a JSON y lo muestra
                $jsonstring = json_encode($json, JSON_UNESCAPED_UNICODE);
                echo $jsonstring;
        }else{
            echo "Error";
            die();
        }
    }
?>