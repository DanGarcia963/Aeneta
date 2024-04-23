<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Solicitudes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="styles/admin.css">
        <script src="JS/jquery-3.7.1.js"></script>
    </head>
    <body>
        <div class="inicio">
            <!--<a href="index.php" style="width: 100%;"><h4 style="width: 100%;" class="col-12 inicio_texto">Inicio</h4></a>-->
        </div>
        <div class="container">
            <div class="row titulo">   
                <img class="col-lg-2 col-md-3 col-sm-2 hdr_img" src="img/escom.png" alt="ESCOM" class="col-2">
                <div class="col-lg-8 col-md-6 col-sm-8 hdr justify-content-center"><h1>Panel de Solicitudes</h1></div>
                <img class="col-lg-2 col-md-3 col-sm-2 hdr_img" src="img/Logo.png" alt="IPN" class="col-2">
            </div>
            <div class="row fields">
                <div class="row justify-content-center" id="administrador">Solicitudes</div>
                    <div class="form-inline justify-content-center barra_buscar">
                        <div class="col-lg-8 col-md-12 mt-2">
                                <select class="form-control" name="opciones" id="opciones" required>
                                    <option selected>Seleccionar</option>
                                    <option value="1">Solicitudes Rechazadas</option>
                                    <option value="2">Solicitudes Aceptadas</option>
                                </select>
                            </div>
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
            </div>
        </div>
        <script src="JS/Solicitudes.js"></script>
    </body>
</html>