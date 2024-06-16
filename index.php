<?php
    session_start();
    if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){}else{
        $_SESSION["usuario"] = "invitado";
        $_SESSION["TT"] = "NO_DIRECTOR";
    }
    $ID_Director = isset($_SESSION["TT"]) ? $_SESSION["TT"] : "NO_DIRECTOR";
    $ID_Alumno = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : "invitado";
    echo "<script>console.log('$ID_Alumno');</script>";
    echo "<script>console.log('$ID_Director');</script>";
    if(isset($_SESSION["Time"])){}else{
        $_SESSION["Time"] = "NO";
    }
    $TIMEP = isset($_SESSION["Time"]) ? $_SESSION["Time"] : "NO";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si el formulario fue enviado
        if (isset($_POST["changeTime"]) && $_POST["changeTime"] == "true") {
            $_SESSION["Time"] = "SI"; // Cambiar el valor de la sesión a "SI"
        }
        else if (isset($_POST["changeTime"]) && $_POST["changeTime"] == "false") {
            $_SESSION["Time"] = "NO"; // Cambiar el valor de la sesión a "NO"
        }
    }

    
    echo "<script>console.log('$TIMEP');</script>";
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
    <link rel="stylesheet" href="styles/toogleSwitch.css">
    <script src="JS/jquery-3.7.1.js"></script>
    <script src="JS/index.js"></script>
</head>
<body>
    <div class="container justify-content-center">
        <div class="row justify-content-center " id="tam1" >
            <h1 class="col-lg-8" id="bienvenido">
                <?php
                    if($_SESSION["usuario"] == "root"){
                        echo "¡ <span id=\"letras_adm\">Administrador</span> !";
                    }else{
                        echo "Sistema de Gestion de Trabajos de Titulación 'Aeneta'";
                    }
                ?>
            </h1>
        </div>
        <div class="row buttons justify-content-center">
            <div class="row col-8 justify-content-center">
            <?php
                if($_SESSION["usuario"] == "root")
                {
            ?>

            <?php
                $verified = (isset($_SESSION["Time"]));
                //echo "<script>console.log('$verified');</script>";
                $verified1 = (isset($_SESSION["Time"]) && $_SESSION["Time"] == "NO");
                //echo "<script>console.log('$verified1');</script>";
                if ($_SESSION["Time"] == "SI") {
            ?>                                 
                    <div class="contenedor col col-lg-3 col-md-4 col-sm-12 mt-3">
                    <div class="msg col col-lg-3 col-md-4 col-sm-12 mt-3">Desactivar Envio de Protocolos</div>
                    <label class="switch">
                        <input type="checkbox" class="input" value="<?php $_SESSION["Time"] = "SI"; ?>" checked>
                        <div class="rail">
                            <span class="circle"></span>
                        </div>
                        <span class="indicator"></span>
                    </label>
                    <form method="post" action="">
                            <input type="hidden" name="changeTime" value="false">
                            <button class="boton" type="submit">Confirmar</button>
                    </form>
                </div>
            <?php                                
                }else if ($_SESSION["Time"] == "NO"){
            ?> 
                    <div class="contenedor col col-lg-3 col-md-4 col-sm-12 mt-3">
                    <div class="msg col col-lg-3 col-md-4 col-sm-12 mt-3">Activar Envio de Protocolos</div>
                    <label class="switch">
                        <input type="checkbox" class="input" value="<?php $_SESSION["Time"] = "NO"; ?>">
                        <div class="rail">
                            <span class="circle"></span>
                        </div>
                        <span class="indicator"></span>
                    </label>
                    <form method="post" action="">
                            <input type="hidden" name="changeTime" value="true">
                            <button class="boton" type="submit">Confirmar</button>
                        </form>
                </div>
            <?php
                }                        
            ?>

            <?php
                }
            ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones btnpanel" href="Busqueda.php">Panel de Busqueda</a>
                        </div>
                <?php
                    if($_SESSION["usuario"] == "invitado"){
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
                    }else if($_SESSION["usuario"] == "invitado"){
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones btnreg" href="form.html">Registro Alumno</a>
                        </div>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones btnreg" href="formProf.php">Registro Profesor</a>
                        </div>
                <?php
                    }if($_SESSION["usuario"] == "root"){
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones btnreg" href="form.html">Registrar Alumno</a>
                        </div>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones btnreg" href="formProf.php">Registrar Profesor</a>
                        </div>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones Solicitudes" href="Solicitudes.php">Administrar Protocolos</a>
                        </div>
                <?php
                    } else if($_SESSION["usuario"] != "root" && $_SESSION["usuario"] != "invitado" && $_SESSION["TT"] == "SI"){
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones Solicitudes" href="GestionSolicitud.php">Visualizar Solicitud</a>
                        </div>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a id="btnPDF" class="botones btnpdf">Generar PDF</a>
                        </div>
                        <script>
                            $(document).on('click', '#btnPDF', function () {
                                // Cuando se hace clic en el botón, primero llamamos a la función listar()
                                listar();
                            });

                            function listar() {
                                $.ajax({
                                    url: 'PHP/BuscarIDTT_Alumno.php',
                                    type: 'GET',
                                    success: function (response) {
                                        // Una vez que la llamada AJAX ha tenido éxito, aquí es donde queremos hacer la redirección
                                        console.log("La llamada AJAX ha terminado");
                                        window.location.href = 'recupera.php';
                                    },
                                    error: function (xhr, status, error) {
                                        // Si hay algún error en la llamada AJAX, lo manejamos aquí
                                        console.error("Error en la llamada AJAX:", error);
                                    }
                                });
                            }
                        </script>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones Solicitudes" href="archivos.php">Adjuntar Archivo</a>
                        </div>
                <?php
                    }else if($_SESSION["usuario"] != "root" && $_SESSION["usuario"] != "invitado" && $_SESSION["TT"] == "NO" && $_SESSION["Time"] == "SI"){
                ?>
                <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones Solicitudes" href="RegistrarSolicitud.php">Registrar Protocolo</a>
                        </div>
                <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                        <a class="botones Solicitudes" href="RegistrarSolicitudExistente.php">Registrar a Protocolo Existente</a>
                        </div>
                <?php
                    }else if($_SESSION["TT"] == "Director" && $_SESSION["usuario"] != "invitado"){
                ?>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones Solicitudes" href="Solicitudes.php">Visualizar Trabajos de Titulacion</a>
                        </div>
                        <div class="col col-lg-3 col-md-4 col-sm-12 mt-3">
                            <a class="botones Solicitudes" href="RevisarTT.php">Sinodal Trabajos Terminales</a>
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

