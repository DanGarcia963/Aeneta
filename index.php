<?php
    session_start();
    if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){}else{
        $_SESSION["usuario"] = "invitado";
    }
    $ID_Alumno = $_SESSION["usuario"];
    echo "<script>console.log('$ID_Alumno');</script>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/index.css">
    <script src="JS/jquery-3.7.1.js"></script>
    <script src="JS/index.js"></script>
</head>
<body>
    <div class="container justify-content-center">
        <div class="row justify-content-center present_card">
            <img class="col-lg-2 col-md-4 col-sm-4 hdr_img" src="img/escom.png" alt="ESCOM">
            <div class="col-lg-6 col-md-4 col-sm-4"></div>
            <img class="col-lg-2 col-md-4 col-sm-4 hdr_img" src="img/Logo.png" alt="IPN">
        </div>
        <div class="row justify-content-center">
            <h1 class="col-lg-8" id="bienvenido">Bienvenido
                <?php
                    if($_SESSION["usuario"] == "root"){
                        echo "¡ <span id=\"letras_adm\">Administrador</span> !";
                    }else{
                        echo "al Sistema de Gestion de Trabajos de Titulación 'Aeneta'";
                    }
                ?>
            </h1>
        </div>
        <div class="row buttons justify-content-center">
            <div class="row col-8 justify-content-center">
                <?php
                    if($_SESSION["usuario"] == "root" || $_SESSION["usuario"] != "invitado"){
                ?>        
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones btnpanel" href="Busqueda.php">Panel de Busqueda</a>
                        </div>
                <?php
                    }else{
                ?>
                    <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones btnadm" id="adminbtn">Iniciar Sesión</a>
                    </div>
                <?php
                    }
                ?>
                <?php
                    if($_SESSION["usuario"] != "invitado"){
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones btnsalir">Cerrar Sesión</a>
                        </div>
                <?php
                    }else{
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones btnreg" href="form.html">Registrarse</a>
                        </div>
                <?php
                    }if($_SESSION["usuario"] == "root"){
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones Solicitudes" href="Solicitudes.php">Administrar Solicitudes</a>
                        </div>
                <?php
                    } else if($_SESSION["usuario"] != "root" && $_SESSION["usuario"] != "invitado" && $_SESSION["TT"] == "SI"){
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones Solicitudes" href="GestionSolicitud.php">Gestionar Solicitud</a>
                        </div>
                <?php
                    }else if($_SESSION["usuario"] != "root" && $_SESSION["usuario"] != "invitado" && $_SESSION["TT"] == "NO"){
                ?>
                <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones Solicitudes" href="RegistrarSolicitud.php">Registrar Solicitud</a>
                        </div>
                <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones Solicitudes" href="RegistrarSolicitudExistente.php">Registrar Solicitud Existente</a>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="row logg justify-content-center">
            <div class="row col-8 login justify-content-center">
                <form class="row col-8 justify-content-center" id="formulario" novalidate>
                    <div class="row usuario_row">
                        <label class="col-lg-4 col-md-6 col-sm-12" for="correo">Correo: </label>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <input class="form-control" type="text" id="correo" name="correo" placeholder="Correo" required>
                        </div>
                    </div>

                    <div class="row contra_row mt-4 mb-3">
                        <label class="col-lg-4 col-md-6 col-sm-12" for="contra">Contraseña: </label>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <input class="form-control" type="password" id="contra" name="contra" placeholder="Contraseña" required>
                        </div>
                    </div>

                    <div class="row contra_row mt-4 mb-3">
                        <div class="col-lg-8 col-md-6 col-sm-12">
                        <a href="Busqueda.php" id="recuperation">No recuerdo mi contraseña</a></div>
                    </div>

                    <div class="col-8 mt-4 mb-3 err_cred">Datos incorrectos</div>
                    <button class="col-lg-5 col-md-5 col-sm-12 mt-3 btn btn-primary" type="button" id="login">Iniciar Sesión</button>
                    <div class="col"></div>
                    <button class="col-ld-5 col-md-5 col-sm-12 mt-3 btn btn-outline-light back" type="button"><i class="bi bi-arrow-left-circle flecha"></i> Regresar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

