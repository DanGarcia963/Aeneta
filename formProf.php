<?php
    session_start();
    if($_SESSION["usuario"] == "root" || $_SESSION["usuario"] == "invitado"){
       
    }
    else {
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
        <link type="text/css" rel="stylesheet" href="styles/form.css">
        <script src="js/jquery-3.7.1.js"></script>
    </head>
    <body>
        <script src="bootstrap/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <div class="inicio">
            <a href="index.php" style="width: 100%;"><h4 style="width: 100%;" class="col-12 inicio_texto">Inicio</h4></a>
        </div>
        <div class="container">
            <div class="row titulo">   
                <img class="col-lg-2 col-md-3 col-sm-2 hdr_img" src="img/escom.png" alt="ESCOM" class="col-2">
                <div class="col-lg-8 col-md-6 col-sm-8 hdr justify-content-center"><h1>Registro de datos Generales para Profesores</h1></div>
                <img class="col-lg-2 col-md-3 col-sm-2 hdr_img" src="img/Logo.png" alt="IPN" class="col-2">
            </div>
            <div class="row justify-content-center">
                <form class="row formulario justify-content-center" id="formulario" method="post" action="modificarProfesor.php" novalidate>
                    <div class="col-lg-5 col-md-7 col-sm-12 fields" id="fsection">
                        <fieldset class="row justify-content-center seccion">
                            <legend>Identidad Profesor</legend>

                            <label class="col-lg-4 col-sm-10 mt-3" for="boleta">No. de boleta:</label>
                            <div class="col-lg-8 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="boleta" id="boleta" placeholder="No. de boleta" required>
                            </div>

                            <label class="col-lg-4 col-sm-10 mt-3" for="nombre">Nombre (s):</label>
                            <div class="col-lg-8 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                            </div>
                            
                            <label class="col-lg-4 col-sm-10 mt-3" for="apellidoP">Apellido Paterno:</label>
                            <div class="col-lg-8 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="apellidoP" id="apellidoP" placeholder="Apellido Paterno" required>
                            </div>
                            
                            <label class="col-lg-4 col-sm-10 mt-3" for="apellidoM">Apellido Materno:</label>
                            <div class="col-lg-8 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="apellidoM" id="apellidoM" placeholder="Apellido Materno" required>
                            </div>
                            
                            <label class="col-lg-3 col-sm-10 mt-3" for="rfc">RFC:</label>
                            <div class="col-lg-9 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="rfc" id="rfc" placeholder="RFC" required>
                            </div>

                            <label class="col-lg-5 col-sm-4 mt-3" for="correo">Correo:</label>
                            <div class="col-lg-7 col-sm-6 mt-3">
                                <input class="form-control" type="email" name="correo" placeholder="user@email.com" id="correo" required/>
                            </div> 

                            <label class="col-lg-3 col-sm-10 mt-3" for="contra">Contraseña:</label>
                            <div class="col-lg-9 col-sm-10 mt-3">
                                <input class="form-control" type="text"  name="contra" id="contra" placeholder="Contraseña" required>
                            </div>  

                            <label class="col-lg-4 col-sm-4 mt-3" for="area">Area de Estudio:</label>
                            <div class="col-lg-8 col-sm-6 mt-3">
                                <select class="form-control" name="area" id="area" required>
                                    <option selected>Seleccionar</option>
                                    <?php
                                        include("PHP/conexion.php");
                                        $query="SELECT Nombre_Area FROM Area";
                                        $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                        while ($row=mysqli_fetch_array($result)){
                                        echo '<option value="'.$row['Nombre_Area'].'">'.$row['Nombre_Area'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="row mt-3 justify-content-center">
                                <input class="col-5 ms-4 btn btn-success" type="submit" value="Enviar">
                            </div>

                        </fieldset>
                    </div>
                </form>
            </div>
            
        </div>
        <script src="js/formularioProfesor.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
    </body>
</html>