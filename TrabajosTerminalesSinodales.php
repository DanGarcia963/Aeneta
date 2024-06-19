<?php
    session_start();
    if($_SESSION["TT"] != "Director"){
        header("Location: lost.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Trabajos de Titulacion(S)</title>
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
            <div class="row fields">
                <div class="row justify-content-center loader1" id="administrador">Trabajos de Titulacion</div>
                    <div class="row justify-content-center">
                    <button type="button" class="col col-6 mb-5 btn btn-danger" name="cancelar" id="cancelar">
                        <i class="bi bi-x-lg mx-2"></i> Cancelar
                    </button>
                    </div>
                    <div class="row contenido justify-content-center" id="TablaRegistros">
                    <h3 id="Tcabecera"><u id="matches"></u><span id="total_users"></span></h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style=" width: 120px;"></th>
                                <th scope="col">Trabajo Terminal</th>
                                <th scope="col">Nombre Alumnos</th>
                                <th scope="col">Nombre Directores</th>
                                <th scope="col">Tipo de Titulacion</th>
                                <th scope="col">Area</th>
                            </tr>
                        </thead>
                        <tbody id="registros">
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <h3 class="add" id="AgrCabecera">Visualizar</h3>
                    <form class="row col-lg-6 col-md-8 col-sm-8 justify-content-center add" id="formulario" method="post" novalidate>

                    <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="nombreTT">Nombre de Trabajo Terminal:</label>
                    <div class="col-lg-8 col-md-12 col-sm-12 mt-2">
                        <textarea class="form-control" type="text" name="nombreTT" id="nombreTT" placeholder="Nombre Trabajo Terminal" rows="3" cols="50"required></textarea>
                    </div>

                    <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="descripcion">Descripción:</label>
                    <div class="col-lg-8 col-md-12 mt-2">
                        <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" rows="8" cols="50" maxlength="200" required></textarea>
                    </div>
                    
                    <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="alumnos">Alumnos:</label>
                    <div class="col-lg-8 col-md-12 mt-2">
                        <textarea class="form-control" name="alumnos" id="alumnos" placeholder="Alumnos" rows="4" cols="50" required></textarea>
                    </div>
                    
                    <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="directores">Directores:</label>
                    <div class="col-lg-8 col-md-12 mt-2">
                        <textarea class="form-control" name="directores" id="directores" placeholder="Directores" rows="4" cols="50" required ></textarea>
                    </div>
                    

                    <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="TipoTitulacion">Tipo de Titulación:</label>
                    <div class="col-lg-8 col-md-12 mt-2">
                        <input class="form-control" type="text" name="TipoTitulacion" id="TipoTitulacion" placeholder="Tipo de Titulacion" required>
                    </div>

                    <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="area">Area de Estudio:</label>
                    <div class="col-lg-8 col-md-12 mt-2">
                        <input class="form-control" type="text" name="area" id="area" placeholder="Area de Estudio" required>
                    </div>
                    
                    <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="calificacion">Calificación:</label>
                    <div class="col-lg-8 col-md-12 mt-2">
                        <input class="form-control" type="number" name="calificacion" id="calificacion" min="0" max="10" placeholder="Calificacion" required>
                    </div>

                </form>

                </div>
            </div>
        </div>
        <script src="JS/TrabajosTerminalesSinodales.js"></script>
    </body>
</html>