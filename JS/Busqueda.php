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
            <a href="index.php" style="width: 100%;"><h4 style="width: 100%;" class="col-12 inicio_texto">Inicio</h4></a>
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
                <div class="row justify-content-center">
                    <button type="button" class="col-lg-6 col-md-6 col-sm-8 mb-5 btn btn-success" name="agregar" id="agregar">
                        <i class="bi bi-person-add mx-2"></i> Agregar Alumno
                    </button>
                    <button type="button" class="col col-6 mb-5 btn btn-danger" name="cancelar" id="cancelar">
                        <i class="bi bi-x-lg mx-2"></i> Cancelar
                    </button>
                </div>
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
                <div class="row justify-content-center">
                    <h3 class="add" id="AgrCabecera">Agregar Alumno</h3>
                    <form class="row col-lg-6 col-md-8 col-sm-8 justify-content-center add" id="formulario" method="post" action="modificar.php" novalidate>
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="boleta">No. de boleta:</label>
                        <div class="col-lg-8 col-md-12 col-sm-12 mt-2">
                            <input class="form-control" type="text" name="boleta" id="boleta" placeholder="No. de boleta" required>
                        </div>

                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="nombre">Nombre (s):</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="apellidoP">Apellido Paterno:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text" name="apellidoP" id="apellidoP" placeholder="Apellido Paterno" required>
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="apellidoM">Apellido Materno:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text" name="apellidoM" id="apellidoM" placeholder="Apellido Materno" required>
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="fecha">Fecha de nacimiento:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="col col-8 mt-2 form-control" type="date" name="fecha" id="fecha" max="2008-12-31" min="1950-01-01" required>
                        </div>

                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="genero">Género:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <select class="col col-8 mt-2 form-control" name="genero" id="genero" required>
                                <option selected>Seleccionar</option>
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                            </select>
                        </div>

                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="curp">CURP:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text" name="curp" id="curp" placeholder="CURP" required>
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="calle">Calle:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text"  name="calle" id="calle" placeholder="Calle" required>
                        </div>
            
                        <label class="col-lg-1 col-md-4 col-sm-4 mt-2" for="numeroe">Ext:</label>
                        <div class="col-lg-5 col-md-8 col-sm-8 mt-2">
                            <input class="form-control" type="number"  name="numeroe" id="numeroe" placeholder="No. Ext" required>
                        </div>
            
                        <label class="col-lg-1 col-md-4 col-sm-4 mt-2" id="int" for="numeroi">Int:</label>
                        <div class="col-lg-5 col-md-8 col-sm-8 mt-2">
                            <input class="form-control" type="number"  name="numeroi" id="numeroi" placeholder="No. Int" required>
                        </div>
            
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="colonia">Colonia:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text"  name="colonia" id="colonia" placeholder="Colonia" required>
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="alcaldia">Alcaldía / Municipio:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <select class="form-control" name="alcaldia" id="alcaldia" required>
                                <option selected>Seleccionar</option>
                                <option value="1">Azcapotzalco</option>
                                <option value="2">Alvaro Obregon</option>
                                <option value="3">Benito Juárez</option>
                                <option value="4">Coyoacán</option>
                                <option value="5">Cuajimalpa de Morelos</option>
                                <option value="6">Cuautémoc</option>
                                <option value="7">Gustavo A.Madero</option>
                                <option value="8">Iztacalco</option>
                                <option value="9">Iztapalapa</option>
                                <option value="10">La Magdalena Contreras</option>
                                <option value="11">Miguel Hidalgo</option>
                                <option value="12">Milpa Alta</option>
                                <option value="13">Tláhuac</option>
                                <option value="14">Tlalpan</option>
                                <option value="15">Venustiano Carranza</option>
                                <option value="16">Xochimilco</option>
                            </select>
                        </div>

                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="estado">Estado:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text" name="estado" id="estado" placeholder="Estado">
                        </div>
            
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="cp">Codigo Postal:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text" name="cp" id="cp" placeholder="C.P." required>
                        </div>
            
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="tel">Teléfono:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="tel" name="tel" id="tel" placeholder="Teléfono" required>
                        </div>
            
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="correo">Correo:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="email" name="correo" placeholder="user@email.com" id="correo" required/>
                        </div>


                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="escuela">Escuela de procedencia:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <select class="form-control" name="escuela" id="escuela" required>
                                <option selected>Seleccionar</option>
                                <option value="1">CECyT 1 "Gonzalo Vázquez Vela"</option>
                                <option value="2">CECyT 2 "Miguel Bernard"</option>
                                <option value="3">CECyT 3 "Estanislao Ramírez Ruiz"</option>
                                <option value="4">CECyT 4 "Lázaro Cárdenas"</option>
                                <option value="5">CECyT 5 "Benito Juárez García"</option>
                                <option value="6">CECyT 6 "Miguel Othón de Mendizábal"</option>
                                <option value="7">CECyT 7 "Cuauhtémoc"</option>
                                <option value="8">CECyT 8 "Narciso Bassols García"</option>
                                <option value="9">CECyT 9 "Juan de Dios Bátiz"</option>
                                <option value="10">CECyT 10 "Carlos Vallejo Márquez"</option>
                                <option value="11">CECyT 11 "Wilfrido Massieu Pérez"</option>
                                <option value="12">CECyT 12 "José María Morelos"</option>
                                <option value="13">CECyT 13 "Ricardo Flores Magón"</option>
                                <option value="14">CECyT 14 "Luis Enrique Erro Soler"</option>
                                <option value="15">CECyT 15 "Diódoro Antúnez Echegaray"</option>
                                <option value="16">CECyT 16 "Hidalgo"</option>
                                <option value="17">CECyT 17 "León Guanajuato"</option>
                                <option value="18">CECyT 19 "Leona Vicario"</option>
                                <option value="19">CET 1 "Walter Cross Buchanan"</option>
                                <option value="20">Otra</option>
                            </select>                            
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2 otra_escuela" for="otra_esc">Nombre:</label>
                        <div class="col-lg-8 col-md-12 mt-2 otra_escuela">
                            <input class="form-control" type="text" name="otra_esc" id="otra_esc">                            
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="entidad">Entidad federativa de procedencia:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <select class="form-control" name="entidad" id="entidad" required>
                                <option selected>Seleccionar</option>
                                <option value="1">Aguascalientes</option>
                                <option value="2">Baja California</option>
                                <option value="3">Baja California Sur</option>
                                <option value="4">Campeche</option>
                                <option value="5">Chiapas</option>
                                <option value="6">Chihuahua</option>
                                <option value="7">Ciudad de México</option>
                                <option value="8">Coahuila de Zaragoza</option>
                                <option value="9">Colima</option>
                                <option value="10">Durango</option>
                                <option value="11">Estado de México</option>
                                <option value="12">Guanajuato</option>
                                <option value="13">Guerrero</option>
                                <option value="14">Hidalgo</option>
                                <option value="15">Jalisco</option>
                                <option value="16">Michoacán</option>
                                <option value="17">Morelos</option>
                                <option value="18">Nayarit</option>
                                <option value="19">Nuevo León</option>
                                <option value="20">Oaxaca</option>
                                <option value="21">Puebla</option>
                                <option value="22">Querétaro</option>
                                <option value="23">Quintana Roo</option>
                                <option value="24">San Luis Potosí</option>
                                <option value="25">Sinaloa</option>
                                <option value="26">Sonora</option>
                                <option value="27">Tabasco</option>
                                <option value="28">Tamaulipas</option>
                                <option value="29">Tlaxcala</option>
                                <option value="30">Veracruz</option>
                                <option value="31">Yucatán</option>
                                <option value="32">Zacatecas</option>
                            </select>                            
                        </div>

                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="promedio">Promedio:</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <input class="form-control" type="text" id="promedio" name="promedio" placeholder="Promedio" required>                            
                        </div>

                        <div id="prom_valid">
                            El promedio debe ser entre 6-10 y debe tener máximo 2 decimales
                        </div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" for="opcion">Opción:</label>
                    
                        <div class="col col-3 mt-2"><input class="1raop" type="checkbox" name="opcion" id="opcion" value="1ra">1º</div>
                        <div class="col col-3 mt-2"><input class="2daop" type="checkbox" name="opcion" id="opcion" value="2da">2º</div>
                        <div class="col col-2 mt-2"><input class="3raop" type="checkbox" name="opcion" id="opcion" value="3ra">3º</div>

                        <div id="chk_valid"></div>
                        
                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2" id="disc_text" for="discapacidad">Discapacidad</label>
                        <div class="col-lg-8 col-md-12 mt-2">
                            <select class="form-control" name="discapacidad" id="discapacidad">
                                <option selected>Seleccionar</option>
                                <option value="1">Con discapacidad auditiva</option>
                                <option value="2">Con discapacidad motriz usuaria de silla de ruedas</option>
                                <option value="3">Con discapacidad motriz usuaria de muletas</option>
                                <option value="4">Con discapacidad motriz usuaria de bastón</option>
                                <option value="5">Con discapacidad visual</option>
                                <option value="6">Otra</option>
                            </select>                            
                        </div>

                        <label class="col-lg-4 col-md-12 col-sm-12 mt-2 otra_discapacidad" for="otra_disc">¿Cuál?:</label> 
                        <div class="col-lg-8 col-md-12 mt-2 otra_discapacidad">
                            <input class="form-control" type="text" name="otra_disc" id="otra_disc">
                        </div>

                        <input class="col-lg-5 col-md-5 col-md-6 mt-5 btn btn-light" name="enviar" id="enviar" type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
        <script src="JS/Busqueda.js"></script>
    </body>
</html>