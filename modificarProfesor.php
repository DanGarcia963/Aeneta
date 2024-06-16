<?php

    if (!empty($_POST["nombre"])) {
        // Aqui se guardan los datos recibidos del formulario
        $variables = [
            "Boleta" => $_POST["boleta"],
            "Nombre" => $_POST["nombre"],
            "Apellido Paterno" => $_POST["apellidoP"],
            "Apellido Materno" => $_POST["apellidoM"],
            "RFC" => $_POST["rfc"],
            "Correo" => $_POST["correo"],
            "Contra" => $_POST["contra"],
            "Area" => $_POST["area"],

        ];
    }else{
        header("Location: lost.html");
    }
?>

<?php
    include("PHP/conexion.php");
    $query_areas = "SELECT ID_Area, Nombre_Area FROM area";
    $result_areas = mysqli_query($conexion, $query_areas);
    $areas = array();
    if ($result_areas->num_rows > 0) {
        while($row = $result_areas->fetch_assoc()) {
            $areas[$row["ID_Area"]] = $row["Nombre_Area"];
        }
    } else {
        echo "No se encontraron alcaldías";
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Modificar Datos Profesor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link type="text/css" rel="stylesheet" href="styles/modificar.css">
        <script src="js/jquery-3.7.1.js"></script>

        <script>
            $(document).ready(()=>{
                // Se inicia con tabla mostrada y formulario escondido
                $(".elementos_tabla").show();
                $("#formulario").hide();
                // Al momento de que se clickee editar
                $("#edit").click(()=>{
                    // Se esconde la tabla
                    $(".elementos_tabla").hide();
                    // Se muestra el formulario
                    $("#formulario").show();
                    // Se oculta el icono
                    $("#edit").hide();
                    // Y se muestran los "Otros" campos
                });

            });
        </script>
    </head>
    <body>
    
        <div class="inicio">
            <a href="index.php" style="width: 100%;"><h4 style="width: 100%;" class="col-12 inicio_texto">Inicio</h4></a>
        </div>
        
        <div class="container" id="tabla">
            <div class="row col-lg-8 col-md-8 col-sm-8 justify-content-center" id="datos">
                <table class="row col-12 table elementos_tabla" id="tablaa">
                    <div class="row justify-content-center col-8">
                        <h1 class="col-lg-10 col-md-12 col-sm-12" id="hdr">Resumen de tus datos Profesor</h1>
                        <div class="col-lg-2 col-md-12 col-sm-12 edit_blanco" id="edit"></div>
                    </div>
                    <?php
                        if(!empty($_POST["nombre"])){
                            foreach ($variables as $nombre_variable => $valor_variable) {
                                if ($valor_variable != "") { 
                                    echo "<tbody>";
                                    echo "<tr class=\"row justify-content-center\">";
                                    echo "<th class=\"form_header col-lg-4\" scope=\"row\">$nombre_variable: </th>";
                                    echo "<td class=\"rubros col-lg-4\">";
                                    if (($nombre_variable == "Escuela" || $nombre_variable == "Discapacidad") && ($valor_variable == "Seleccionar")) {
                                        echo "No especificado";
                                    }elseif ($nombre_variable == "Escuela" && $valor_variable == "Otra" && $_POST["otra_esc"] == "") {
                                        echo "No especificado";
                                    }elseif ($nombre_variable == "Discapacidad" && $valor_variable == "Otra" && $_POST["otra_disc"] == "") {
                                        echo "No especificado";
                                    }else{
                                        echo "$valor_variable";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
                            }
                        }
                    ?>
                <table>
                
                <div class="row justify-content-center elementos_tabla" id="botones">  
                    <button class="col-5 btn btn-primary" id="enviar" name="enviar">Enviar</button>
                </div>
            </div>
            <div class="row justify-content-center" id="formulario">
                <form class="row justify-content-center" method="post" id="form_oculto" action="modificarProfesor.php" novalidate>
                    <div class="row col-8 justify-content-center">

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="boleta">No. de boleta:</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="boleta" id="boleta" placeholder="No. de boleta" value="<?php echo "{$variables["Boleta"]}";?>" required>
                            </div>
                        <?php    
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="nombre">Nombre (s):</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre (s)" value="<?php echo "{$variables["Nombre"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>
                        
                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="apellidoP">Apellido Paterno:</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="apellidoP" id="apellidoP" placeholder="Apellido Paterno" value="<?php echo "{$variables["Apellido Paterno"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>
                        
                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="apellidoM">Apellido Materno:</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="apellidoM" id="apellidoM" placeholder="Apellido Materno" value="<?php echo "{$variables["Apellido Materno"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="rfc">RFC:</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="rfc" id="rfc" placeholder="RFC" value="<?php echo "{$variables["RFC"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>
            
                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="correo">Correo:</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="email" name="correo" id="correo" placeholder="Correo" value="<?php echo "{$variables["Correo"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>

                                                
                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="contra">Contraseña:</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="contra" id="contra" placeholder="Contraseña" value="<?php echo "{$variables["Contra"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="area">Area:</label>
                        <?php
                            if(!empty($_POST["nombre"])){
                        ?>
                            <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                            <select class="form-control" name="area" id="area" required>
                                <?php
                                echo "<script>console.log('" . htmlspecialchars($_POST['area']) . "');</script>";
                                foreach ($areas as $id_areas => $nombre_areas) {
                                    if ($id_areas == $variables["Area"] || $nombre_areas == $variables["Area"]) { // Cambio aquí
                                    ?>  
                                        <option value="<?php echo "$id_areas"; ?>" selected><?php echo "$nombre_areas"; ?></option>
                                    <?php
                                    } else {
                                    ?>  
                                        <option value="<?php echo "$id_areas"; ?>"><?php echo "$nombre_areas"; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            </div>
                        <?php
                            }
                        ?>
                        
                        <div class="row mt-3 justify-content-center">
                            <button class="col-5 btn btn-primary" id="guardar" type="submit">Guardar</button>
                        </div>

                    </div>
                </form> 
            </div>  
        </div>
        <script src="js/modificarProfesor.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
    </body>
</html>