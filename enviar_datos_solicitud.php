<?php
    session_start();
    if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){}else{
        $_SESSION["usuario"] = "invitado";
    }
    $ID_Alumno = $_SESSION["usuario"];
    echo "<script>console.log('$ID_Alumno');</script>";
?>
<?php
//$resultado = ""; // Definir la variable antes del bloque try-catch

if (!empty($_POST["nombreTT"])) {
    // Conexion a base de datos
    $conexion = mysqli_connect("localhost", "root", "", "Aeneta");

    $NombreTT = trim($_POST["nombreTT"]);
    $DescTT = trim($_POST["descripcionTT"]);
    $PalabCl = trim($_POST["palabrasclave"]);
    $Area = $_POST["area"]; 
    $Alumno2 = (!empty($_POST["alumno2"]) && $_POST["alumno2"] != "Seleccionar") ? $_POST["alumno2"] : "";
    $Alumno3 = (!empty($_POST["alumno3"]) && $_POST["alumno3"] != "Seleccionar") ? $_POST["alumno3"] : "";
    $Alumno4 = (!empty($_POST["alumno4"]) && $_POST["alumno4"] != "Seleccionar") ? $_POST["alumno4"] : "";
    $Tip_Titu = $_POST["Tipo_Titulacion"];   
    $director1 = $_POST["director1"];
    $director2 = $_POST["director2"];
    echo "<script>console.log('" . htmlspecialchars($_POST['area']) . "');</script>";
    echo "<script>console.log('" . htmlspecialchars($_POST['alumno2']) . "');</script>";
    echo "<script>console.log('" . htmlspecialchars($_POST['alumno3']) . "');</script>";
    echo "<script>console.log('" . htmlspecialchars($_POST['alumno4']) . "');</script>";
    echo "<script>console.log('" . htmlspecialchars($_POST['Tipo_Titulacion']) . "');</script>";
    echo "<script>console.log('" . htmlspecialchars($_POST['director1']) . "');</script>";
    echo "<script>console.log('" . htmlspecialchars($_POST['director2']) . "');</script>";

    $query_insert_tt = "INSERT INTO metodo_titulacion (Nombre_TT, Descripción,Palabras_Clave, ID_Area, ID_Tipo_Titulacion) VALUES ('$NombreTT', '$DescTT','$PalabCl', $Area,$Tip_Titu)";
    $resultado=mysqli_query($conexion, $query_insert_tt);
    if($resultado){
        // Si la inserción fue exitosa, obtenemos el ID generado
        $id_tt = mysqli_insert_id($conexion);
        $_SESSION["TT"] = "SI";
        // Datos a insertar en metodo_director
        echo "<script>console.log('" . htmlspecialchars($_SESSION["TT"]) . "');</script>";
                                
    
        // Inserción en metodo_director
        $query_update_id_tt = "UPDATE alumno SET ID_TT = $id_tt WHERE ID_Alumno = $ID_Alumno";
        $query_insert_director1 = "INSERT INTO metodo_director (ID_Director, ID_TT, ID_Cargo) VALUES ($director1, $id_tt, 1)";
        $query_insert_director2 = "INSERT INTO metodo_director (ID_Director, ID_TT, ID_Cargo) VALUES ($director2, $id_tt, 1)";

        if($Alumno2 != ""){
        $query_update_id_tt2 = "UPDATE alumno SET ID_TT = $id_tt WHERE ID_Alumno = $Alumno2";
        if(mysqli_query($conexion, $query_update_id_tt2)){
            echo "Los datos se insertaron correctamente en la tabla.";
        } else {
            echo "Error al insertar en alumno: " . mysqli_error($conexion);
        }
        }

        if($Alumno3 != ""){
            $query_update_id_tt3 = "UPDATE alumno SET ID_TT = $id_tt WHERE ID_Alumno = $Alumno3";
            if(mysqli_query($conexion, $query_update_id_tt3)){
                echo "Los datos se insertaron correctamente en la tabla.";
            } else {
                echo "Error al insertar en alumno: " . mysqli_error($conexion);
            }
            }
        
            if($Alumno4 != ""){
                $query_update_id_tt4 = "UPDATE alumno SET ID_TT = $id_tt WHERE ID_Alumno = $Alumno4";
                if(mysqli_query($conexion, $query_update_id_tt4)){
                    echo "Los datos se insertaron correctamente en la tabla.";
                } else {
                    echo "Error al insertar en alumno: " . mysqli_error($conexion);
                }
                }

        // Ejecutar ambas inserciones
        if(mysqli_query($conexion, $query_insert_director1) && mysqli_query($conexion, $query_insert_director2)&& mysqli_query($conexion, $query_update_id_tt)){
            echo "Los datos se insertaron correctamente en las 3 tablas.";
        } else {
            echo "Error al insertar en metodo_director: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al insertar en metodo_titulacion: " . mysqli_error($conexion);
    }
} else {
    header("Location: lost.html");
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Protocolo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="styles/enviados.css">
        <script src="js/jquery-3.7.1.js"></script>
    </head>
    <body>
    <script src="bootstrap/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <div class="inicio">
                <a href="index.php" style="width: 100%;"><h4 style="width: 100%;" class="col-12 inicio_texto">Inicio</h4></a>
        </div>    
    <div class="container" id="contt">
            <div class="row justify-content-center" id="todo">
                <div class="col-6 recuadro">
                <?php
                    if($resultado){
                ?>
                        <img src="img/sign_up.png" height="200" id="img_reg" alt="img_registro">
                        <h1 class="letras" id="first_message">¡Has registrado tu Protocolo con exito!</h1>
                        
                        <form id="primer_pdf" action="index.php" target="_blank">

                        <button class="btn btn-light" type="submit" name="generar" id="generar">Ir al Inicio</button>
                        </form>

                        <?php
                            }else{
                        ?>

                            <h3 class="bad">¡Ups ha ocurrido un error!</h3>

                        <?php
                            }
                        ?>
                </div>
            </div>
        </div>
        <script src="js/generar_pdf.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
    </body>
</html>