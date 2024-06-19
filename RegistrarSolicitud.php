<?php
    session_start();
    if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){}else{
        header("Location: lost.html");
        $_SESSION["usuario"] = "invitado";
    }
    $ID_Alumno = $_SESSION["usuario"];
    echo "<script>console.log('$ID_Alumno');</script>";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Gestion de Solicitud</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="styles/admin.css">
        <script src="JS/jquery-3.7.1.js"></script>
    </head>
    <body>
        <div class="inicio">
            <a href="index.php" style="width: 100%;"><h4 style="width: 100%;" class="col-12 inicio_texto">Inicio</h4></a>
        </div>
        <div class="container">
                <div class="col-lg-8 col-md-6 col-sm-8 hdr justify-content-center loader1"><h1>Registro de Protocolo de Trabajo de Titulacion</h1></div>
            <div class="row justify-content-center">
                <form class="row formulario justify-content-center" id="formulario" method="post" action="modificarSolicitud.php" novalidate>
                    <div class="col-lg-5 col-md-7 col-sm-12 fields" id="fsection">
                        <fieldset class="row justify-content-center seccion">
                            <legend>Datos del Trabajo de Titulacion</legend>

                            <label class="col-lg-4 col-sm-10 mt-3" for="nombreTT">Nombre Trabajo de Titulación:</label>
                            <div class="col-lg-8 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="nombreTT" id="nombreTT" placeholder="Nombre Trabajo de Titulación" required>
                            </div>
                            
                            <label class="col-lg-4 col-sm-10 mt-3" for="descripcionTT">Resumen Trabajo de Titulación:</label>
                            <div class="col-lg-8 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="descripcionTT" id="descripcionTT" placeholder="Descripción" required>
                            </div>

                            <label class="col-lg-4 col-sm-10 mt-3" for="palabrasclave">Palabras Clave Trabajo de Titulación:</label>
                            <div class="col-lg-8 col-sm-10 mt-3">
                                <input class="form-control" type="text" name="palabrasclave" id="palabrasclave" placeholder="Palabras Clave" required>
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

                            <label class="col-lg-4 col-sm-4 mt-3" for="Tipo_Titulacion">Tipo de Titulacion:</label>
                            <div class="col-lg-8 col-sm-6 mt-3">
                                <select class="form-control" name="Tipo_Titulacion" id="Tipo_Titulacion" required>
                                    <option selected>Seleccionar</option>
                                    <?php
                                        include("PHP/conexion.php");
                                        $query="SELECT Nombre_Tipo_Titulacion FROM tipo_titulacion";
                                        $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                        while ($row=mysqli_fetch_array($result)){
                                        echo '<option value="'.$row['Nombre_Tipo_Titulacion'].'">'.$row['Nombre_Tipo_Titulacion'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <button type="button" id="fbtn" class="col-6 btn btn-primary">Siguiente</button>

                        </fieldset>
                    </div>

                    <div class="col-lg-5 col-md-7 col-sm-12 fields" id="ssection">
                        <fieldset class="row seccion">
                            <legend>Alumnos</legend>

                            <label class="col-lg-4 col-sm-4 mt-3" for="alumno2">Alumno 2:</label>
                            <div class="col-lg-8 col-sm-6 mt-3">
                                <select class="form-control" name="alumno2" id="alumno2" required>
                                    <option selected>Seleccionar</option>
                                    <?php
                                        include("PHP/conexion.php");
                                        $query="SELECT CONCAT(Nombres, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS 'Nombres_Alumno' 
                                         FROM alumno 
                                         WHERE ID_TT IS NULL";
                                        $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                        while ($row=mysqli_fetch_array($result)){
                                        echo '<option value="'.$row['Nombres_Alumno'].'">'.$row['Nombres_Alumno'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <label class="col-lg-4 col-sm-4 mt-3" for="alumno3">Alumno 3:</label>
                            <div class="col-lg-8 col-sm-6 mt-3">
                                <select class="form-control" name="alumno3" id="alumno3" required>
                                    <option selected>Seleccionar</option>
                                    <?php
                                        include("PHP/conexion.php");
                                        $query="SELECT CONCAT(Nombres, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS 'Nombres_Alumno' 
                                         FROM alumno 
                                         WHERE ID_TT IS NULL";
                                        $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                        while ($row=mysqli_fetch_array($result)){
                                        echo '<option value="'.$row['Nombres_Alumno'].'">'.$row['Nombres_Alumno'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>   
                            
                            <label class="col-lg-4 col-sm-4 mt-3" for="alumno4">Alumno 4:</label>
                            <div class="col-lg-8 col-sm-6 mt-3">
                                <select class="form-control" name="alumno4" id="alumno4" required>
                                    <option selected>Seleccionar</option>
                                    <?php
                                        include("PHP/conexion.php");
                                        $query="SELECT CONCAT(Nombres, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS 'Nombres_Alumno' 
                                         FROM alumno 
                                         WHERE ID_TT IS NULL";
                                        $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                        while ($row=mysqli_fetch_array($result)){
                                        echo '<option value="'.$row['Nombres_Alumno'].'">'.$row['Nombres_Alumno'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>                              

                            <div class="row justify-content-center mt-4">
                                <button type="button" id="sbtn_anterior" class="col-5 btn btn-primary ms-4">Anterior</button>
                                <button type="button" id="sbtn_siguiente" class="col-5 btn btn-primary ms-2">Siguiente</button>
                            </div>

                        </fieldset>
                    </div>

                    <div class="col-lg-5 col-md-7 col-sm-12 fields" id="tsection">
                        <fieldset class="row seccion">
                            <legend>Directores</legend>

                            <label class="col-6 col-md-7 mt-3" for="director1">Director 1:</label>
                            <div class="col-6 col-md-5 mt-3">
                                <select class="form-control" name="director1" id="director1" required>
                                    <option selected>Seleccionar</option>
                                    <?php
                                        include("PHP/conexion.php");
                                        if(isset($_POST['area'])){ // Verificar si se ha seleccionado un área
                                            $Nombre_Area = $_POST['area']; // Aquí se captura el valor seleccionado en el primer select
                                            $query="SELECT CONCAT(d.Nombre_Director, ' ', d.Apellido_Paterno, ' ', d.Apellido_Materno) AS 'Nombres_Directores' 
                                            FROM Director d
                                            LEFT JOIN area ar ON d.ID_Area = ar.ID_Area
                                            WHERE ar.Nombre_Area = 'Nombre_Area'";
                                            $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                            while ($row=mysqli_fetch_array($result)){
                                                echo '<option value="'.$row['Nombres_Directores'].'">'.$row['Nombres_Directores'].'</option>';
                                            }
                                        } else {
                                            // Si no se ha seleccionado un área, mostrar todos los directores
                                            $query="SELECT CONCAT(Nombre_Director, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS 'Nombres_Directores' FROM Director";
                                            $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                            while ($row=mysqli_fetch_array($result)){
                                                echo '<option value="'.$row['Nombres_Directores'].'">'.$row['Nombres_Directores'].'</option>';
                                            }
                                        }
                                    
                                    ?>
                                </select>
                            </div>

                            <label class="col-6 col-md-7 mt-3" for="director2">Director 2:</label>
                            <div class="col-6 col-md-5 mt-3">
                                <select class="form-control" name="director2" id="director2" required>
                                <option selected>Seleccionar</option>
                                <?php
                                        include("PHP/conexion.php");
                                        if(isset($_POST['area'])){ // Verificar si se ha seleccionado un área
                                            $Nombre_Area = $_POST['area']; // Aquí se captura el valor seleccionado en el primer select
                                            $query="SELECT CONCAT(d.Nombre_Director, ' ', d.Apellido_Paterno, ' ', d.Apellido_Materno) AS 'Nombres_Directores' 
                                            FROM Director d
                                            LEFT JOIN area ar ON d.ID_Area = ar.ID_Area
                                            WHERE ar.Nombre_Area = 'Nombre_Area'";
                                            $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                            while ($row=mysqli_fetch_array($result)){
                                                echo '<option value="'.$row['Nombres_Directores'].'">'.$row['Nombres_Directores'].'</option>';
                                            }
                                        } else {
                                            // Si no se ha seleccionado un área, mostrar todos los directores
                                            $query="SELECT CONCAT(Nombre_Director, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS 'Nombres_Directores' FROM Director";
                                            $result=mysqli_query($conexion, $query) or die (mysqli_error());
                                            while ($row=mysqli_fetch_array($result)){
                                                echo '<option value="'.$row['Nombres_Directores'].'">'.$row['Nombres_Directores'].'</option>';
                                            }
                                        }
                                    ?>  
                                </select>
                            </div>                                   

                            <div class="row mt-3 justify-content-center">
                                <button class="col-5 ms-4 btn btn-primary" id="tbtn_anterior" type="button">Anterior</button>
                                <input class="col-5 ms-4 btn btn-success" type="submit" value="Enviar">
                            </div>

                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
        <script src="JS/RegistrarSolicitud.js"></script>
    </body>
</html>