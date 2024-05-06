<?php
    session_start();
    include("conexion.php");
    if(empty($_POST["correo"])){
        header("Location: lost.html");
    }
    else{
        $correo = $_POST["correo"];
        $contra = $_POST["contra"];
            $queryAlumno = "SELECT ID_Alumno AS 'IDAlumno', ID_TT AS 'IDTrabajoTerminal' FROM alumno WHERE Correo = '$correo' AND Contrasena ='$contra'"; 
            $resultAlumno = mysqli_query($conexion, $queryAlumno);
            $queryDirector = "SELECT ID_Director AS 'IDirector' FROM director WHERE Correo = '$correo' AND Contrasena ='$contra'"; 
            $resultDirector = mysqli_query($conexion, $queryDirector);
            if(mysqli_num_rows($resultAlumno) == 1){
                echo "<script>console.log('Alumno');</script>";
                $row = mysqli_fetch_assoc($resultAlumno);
                $_SESSION["usuario"] = $row["IDAlumno"];
                if($row["IDTrabajoTerminal"])
                {
                    $_SESSION["TT"]="SI";
                }
                else
                {
                    $_SESSION["TT"]="NO";
                }
                $jsonA = array();
                
                do {
                    $jsonA[] = array(
                        "ID_Alumno" => $row["IDAlumno"],
                    );
                } while ($row = mysqli_fetch_assoc($resultAlumno));
                
                // Convierte el array a JSON y lo muestra
                $jsonstring = json_encode($jsonA, JSON_UNESCAPED_UNICODE);
                echo $jsonstring;
        }else if(mysqli_num_rows($resultDirector) == 1){
            echo "<script>console.log('Director');</script>";
                $row = mysqli_fetch_assoc($resultDirector);
                $_SESSION["usuario"] = $row["IDirector"];
                $_SESSION["TT"]="Director";
                $jsonD = array();
                
                do {
                    $jsonD[] = array(
                        "ID_Director" => $row["IDirector"],
                    );
                } while ($row = mysqli_fetch_assoc($resultDirector));
                
                // Convierte el array a JSON y lo muestra
                $jsonstring = json_encode($jsonD, JSON_UNESCAPED_UNICODE);
                echo $jsonstring;
        }
        else {
            echo "Error";
            //die();
        }
    }
?>