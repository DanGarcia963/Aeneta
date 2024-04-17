<?php
    session_start();
    if($_SESSION["usuario"] != "root"){
        header("Location: lost.html");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="styles/admin.css">
        <script src="js/jquery-3.7.1.js"></script>
    </head>
    <body>
        <div class="inicio">
            <!--<a href="index.php" style="width: 100%;"><h4 style="width: 100%;" class="col-12 inicio_texto">Inicio</h4></a>-->
        </div>
        <div class="container">
            <div class="row titulo">   
                <img class="col-lg-2 col-md-3 col-sm-2 hdr_img" src="img/escom.png" alt="ESCOM" class="col-2">
                <div class="col-lg-8 col-md-6 col-sm-8 hdr justify-content-center"><h1>Panel de Busqueda</h1></div>
                <img class="col-lg-2 col-md-3 col-sm-2 hdr_img" src="img/Logo.png" alt="IPN" class="col-2">
            </div>
            <div class="row fields">
                <div class="row justify-content-center" id="administrador">Busqueda</div>
                <form class="form-inline justify-content-center barra_buscar">
                    <input class="form-control" type="search" id="search" name="search" placeholder="Buscar por nombre">
                    <!-- <button class="btn btn-primary" id="btnBuscar">Buscar</button> -->
                </form>
                <div class="row contenido justify-content-center" id="TablaRegistros">
                    <h3 id="Tcabecera"><u id="matches"></u><span id="total_users"></span></h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <!--
                                <td><button><i class="bi bi-gear"></i></button></td>
                                <td><button><i class="bi bi-trash3"></i></button></td>
                                -->
                                <th scope="col" style=" width: 120px;"></th>
                                <th scope="col">Trabajo Terminal</th>
                                <th scope="col">Nombre Alumnos</th>
                                <th scope="col">Nombre Directores</th>
                            </tr>
                        </thead>
                        <tbody id="registros">
                            <!--
                            <th scope="row" class="align-middle">
                                <button class="btn btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-outline-danger mx-2"><i class="bi bi-trash3"></i></button>
                            </th>
                            <td class="align-middle">Jose</td>
                            <td class="align-middle">PECE23173921832</td>
                            <td class="align-middle">55 1234 5678</td>
                            -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="JS/Busqueda.js"></script>
    </body>
</html>