<?php
$resultado = ""; // Definir la variable antes del bloque try-catch

if (!empty($_POST["nombre"])) {
    // Conexion a base de datos
    $conexion = mysqli_connect("localhost", "root", "", "Aeneta");

    $boleta = trim($_POST["boleta"]);
    $nombre = trim($_POST["nombre"]);
    $apellido_paterno = trim($_POST["apellidoP"]);
    $apellido_materno = trim($_POST["apellidoM"]);
    $rfc = trim($_POST["rfc"]);
    $correo = trim($_POST["correo"]);    
    $contra = trim($_POST["contra"]);
    $Area = $_POST["area"]; 

    $query = "INSERT INTO director(Nombre_Director, Apellido_Paterno, Apellido_Materno, RFC, Boleta, Correo, ID_Area, Contrasena) 
    VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$rfc', '$boleta', '$correo', $Area, '$contra')";

    try {
        $resultado = mysqli_query($conexion, $query);
        if ($resultado) {
            echo "Los datos fueron Guardados con éxito.";
        } else {
            echo "Ocurrió un error al guardar los datos.";
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "<script>alert('La CURP ya está registrada en el sistema. Por favor, ingresa una CURP diferente.');</script>";
        } else {
            echo "Ocurrió un error al guardar los datos.";
        }
    }
} else {
    header("Location: lost.html");
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro de Datos Profesor</title>
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
                        <h1 class="letras" id="first_message">¡<?php echo "$nombre"; ?> te has registrado con exito!</h1>
                        
                        <form id="primer_pdf" action="index.php" target="_blank">
                        <input class="form_pdf" type="text" name="boleta" id="boleta" value="<?php echo "$boleta"; ?>">
                        <input class="form_pdf" type="text" name="rfc" id="rfc" value="<?php echo "$rfc"; ?>">
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