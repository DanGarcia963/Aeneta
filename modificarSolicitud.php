<?php
    session_start();
    if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){}else{
        $_SESSION["usuario"] = "invitado";
    }
    $ID_Alumno = $_SESSION["usuario"];
    echo "<script>console.log('$ID_Alumno');</script>";
?>
<?php
    if (!empty($_POST["nombreTT"])) {
        // Aquí se guardan los datos recibidos del formulario
        $alumno2 = (!empty($_POST["alumno2"]) && $_POST["alumno2"] != "Seleccionar") ? $_POST["alumno2"] : "";
        $alumno3 = (!empty($_POST["alumno3"]) && $_POST["alumno3"] != "Seleccionar") ? $_POST["alumno3"] : "";
        $alumno4 = (!empty($_POST["alumno4"]) && $_POST["alumno4"] != "Seleccionar") ? $_POST["alumno4"] : "";
    
        //echo "<script>console.log('" . htmlspecialchars($_POST["alumno2"]) . "');</script>";
        //echo "<script>console.log('" . htmlspecialchars($_POST["alumno3"]) . "');</script>";
        $variables = [
            "Nombre_TT" => $_POST["nombreTT"],
            "Descripcion_TT" => $_POST["descripcionTT"],
            "Palabras_Clave" => $_POST["palabrasclave"],
            "Area" => $_POST["area"],
            "Alumno2" => $alumno2,
            "Alumno3" => $alumno3,
            "Alumno4" => $alumno4,
            "TipoTitulacion" => $_POST["Tipo_Titulacion"],
            "Director1" => $_POST["director1"],
            "Director2" => $_POST["director2"],
        ];
    } else {
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

<?php
    include("PHP/conexion.php");
    $query_alumnos = "SELECT ID_Alumno, CONCAT(Nombres, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS 'Nombres_Alumno' 
    FROM alumno 
    WHERE ID_TT IS NULL";
    $result_alumnos = mysqli_query($conexion, $query_alumnos);
    $alumnos = array();
    if ($result_alumnos->num_rows > 0) {
        while($row = $result_alumnos->fetch_assoc()) {
            $alumnos[$row["ID_Alumno"]] = $row["Nombres_Alumno"];
        }
    } else {
        echo "No se encontraron alcaldías";
    }
?>

<?php
    include("PHP/conexion.php");
    $query_director = "SELECT ID_Director, CONCAT(Nombre_Director, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS 'Nombre_Director' 
    FROM Director";
    $result_director = mysqli_query($conexion, $query_director);
    $director = array();
    if ($result_director->num_rows > 0) {
        while($row = $result_director->fetch_assoc()) {
            $director[$row["ID_Director"]] = $row["Nombre_Director"];
        }
    } else {
        echo "No se encontraron alcaldías";
    }
?>

<?php
    include("PHP/conexion.php");
    $query_tip_titu = "SELECT ID_Tipo_Titulacion, Nombre_Tipo_Titulacion FROM tipo_titulacion";
    $result_tip_titu = mysqli_query($conexion, $query_tip_titu);
    $tip_titu = array();
    if ($result_tip_titu->num_rows > 0) {
        while($row = $result_tip_titu->fetch_assoc()) {
            $tip_titu[$row["ID_Tipo_Titulacion"]] = $row["Nombre_Tipo_Titulacion"];
        }
    } else {
        echo "No se encontraron alcaldías";
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Modificar Protocolo</title>
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
                        <h1 class="col-lg-10 col-md-12 col-sm-12" id="hdr">Resumen de los datos de tu Protocolo</h1>
                        <div class="col-lg-2 col-md-12 col-sm-12 edit_blanco" id="edit"></div>
                    </div>
                    <?php
                        if(!empty($_POST["nombreTT"])){
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
                <form class="row justify-content-center" method="post" id="form_oculto" action="modificarSolicitud.php" novalidate>
                    <div class="row col-8 justify-content-center">

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="nombreTT">Nombre Trabajo de Titulacion:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="nombreTT" id="nombreTT" placeholder="Nombre Trabajo de Titulacion" value="<?php echo "{$variables["Nombre_TT"]}";?>" required>
                            </div>
                        <?php    
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="descripcionTT">Descripcion:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="descripcionTT" id="descripcionTT" placeholder="Descripcion" value="<?php echo "{$variables["Descripcion_TT"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>
                        



                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="area">Area:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
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

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="palabrasclave">Palabras Clave:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>  <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <input class="form-control" type="text" name="palabrasclave" id="palabrasclave" placeholder="Palabras Clave" value="<?php echo "{$variables["Palabras_Clave"]}";?>" required>
                            </div>
                        <?php
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="alumno2">Alumno 2:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>
                            <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                            <select class="form-control" name="alumno2" id="alumno2" required>
                            <option>Seleccionar</option>
                                <?php
                                echo "<script>console.log('" . htmlspecialchars($alumno2) . "');</script>";
                                foreach ($alumnos as $id_alumno2 => $nombre_alumno2) {
                                    if ($id_alumno2 == $variables["Alumno2"] || $nombre_alumno2 == $variables["Alumno2"]) { // Cambio aquí
                                    ?>  
                                        <option value="<?php echo "$id_alumno2"; ?>" selected><?php echo "$nombre_alumno2"; ?></option>
                                    <?php
                                    } else {
                                    ?>  
                                        <option value="<?php echo "$id_alumno2"; ?>"><?php echo "$nombre_alumno2"; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            </div>
                        <?php
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="alumno3">Alumno 3:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>
                            <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                            <select class="form-control" name="alumno3" id="alumno3" required>
                            <option>Seleccionar</option>
                                <?php
                                echo "<script>console.log('" . htmlspecialchars($alumno3) . "');</script>";
                                foreach ($alumnos as $id_alumno3 => $nombre_alumno3) {
                                    if ($id_alumno3 == $variables["Alumno3"] || $nombre_alumno3 == $variables["Alumno3"]) { // Cambio aquí
                                    ?>  
                                        <option value="<?php echo "$id_alumno3"; ?>" selected><?php echo "$nombre_alumno3"; ?></option>
                                    <?php
                                    } else {
                                    ?>  
                                        <option value="<?php echo "$id_alumno3"; ?>"><?php echo "$nombre_alumno3"; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            </div>
                        <?php
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="alumno4">Alumno 4:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>
                            <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                            <select class="form-control" name="alumno4" id="alumno4" required>
                            <option>Seleccionar</option>
                                <?php
                                echo "<script>console.log('" . htmlspecialchars($alumno4) . "');</script>";
                                foreach ($alumnos as $id_alumno4 => $nombre_alumno4) {
                                    if ($id_alumno4 == $variables["Alumno4"] || $nombre_alumno4 == $variables["Alumno4"]) { // Cambio aquí
                                    ?>  
                                        <option value="<?php echo "$id_alumno4"; ?>" selected><?php echo "$nombre_alumno4"; ?></option>
                                    <?php
                                    } else {
                                    ?>  
                                        <option value="<?php echo "$id_alumno4"; ?>"><?php echo "$nombre_alumno4"; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            </div>
                        <?php
                            }
                        ?>


                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="Tipo_Titulacion">Tipo de Titulacion:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>
                            <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <select class="form-control" name="Tipo_Titulacion" id="Tipo_Titulacion" required>
                                <option>Seleccionar</option>
                                    <?php
                                        echo "<script>console.log('" . htmlspecialchars($_POST['Tipo_Titulacion']) . "');</script>";
                                        foreach ($tip_titu as $id_tipo_titulacion => $nombre_tipo_titulacion) {
                                            if ($id_tipo_titulacion == $variables["TipoTitulacion"] || $nombre_tipo_titulacion == $variables["TipoTitulacion"]) {
                                            ?>  
                                                <option value="<?php echo "$id_tipo_titulacion"; ?>" selected><?php echo "$nombre_tipo_titulacion"; ?></option>
                                            <?php
                                            }else{
                                            ?>  
                                                <option value="<?php echo "$id_tipo_titulacion"; ?>"><?php echo "$nombre_tipo_titulacion"; ?></option>
                                            <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        <?php
                            }
                        ?>

                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="director1">Director 1:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>
                            <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <select class="form-control" name="director1" id="director1" required>
                                    <?php
                                        echo "<script>console.log('" . htmlspecialchars($_POST['director1']) . "');</script>";
                                        foreach ($director as $id_director => $nombre_director) {
                                            if ($id_director == $variables["Director1"] || $nombre_director == $variables["Director1"]) {
                                            ?>  
                                                <option value="<?php echo "$id_director"; ?>" selected><?php echo "$nombre_director"; ?></option>
                                            <?php
                                            }else{
                                            ?>  
                                                <option value="<?php echo "$id_director"; ?>"><?php echo "$nombre_director"; ?></option>
                                            <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        <?php
                            }
                        ?>
   
                        <label class="mt-1 col-lg-5 col-md-12 col-sm-12" for="director2">Director 2:</label>
                        <?php
                            if(!empty($_POST["nombreTT"])){
                        ?>
                            <div class="mt-1 col-lg-7 col-md-12 col-sm-12">
                                <select class="form-control" name="director2" id="director2" required>
                                    <?php
                                        echo "<script>console.log('" . htmlspecialchars($_POST['director2']) . "');</script>";
                                        foreach ($director as $id_director => $nombre_director) {
                                            if ($nombre_director == $variables["Director2"] || $id_director == $variables["Director2"]) {
                                            ?>  
                                                <option value="<?php echo "$id_director"; ?>" selected><?php echo "$nombre_director"; ?></option>
                                            <?php
                                            }else{
                                            ?>  
                                                <option value="<?php echo "$id_director"; ?>"><?php echo "$nombre_director"; ?></option>
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
        <script src="js/modificarSolicitud.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
    </body>
</html>