<?php
  session_start();
  if(isset($_SESSION["boleta"])){
    include("./configBD.php");
    include("./alumno_BD.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informacion alumno</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="./../css/flex.css" rel="stylesheet">
  <link href="./../libs/materialize/css/materialize.min.css" rel="stylesheet">
  <script src="./../libs/jquery-3.7.1.min.js"></script> 
  <script src="./../libs/materialize/js/materialize.min.js"></script>
</head>
<body>
    <header>
      <!--
        <img src="./../img/header.jpg" class="responsive-img">
    -->
    </header>
    <main class="valign-wrapper">
      <div class="container">
        <div class="row">
          <h3 class="center-align">Bienvenido :) <?php echo "$infGetAlumno[1] $infGetAlumno[2] $infGetAlumno[3]"; ?></h3>
          <h4 class="center-align"><?php
            echo "$infGetAlumno[0] / $infGetAlumno[4] / $infGetAlumno[5]";
          ?></h4>
        </div>
        <div class="row">
          <div class="col s12 m6 center-align">
            <a href="./cerrarSesion.php?nombreSesion=boleta">Cerrar Sesión</a>
          </div>
        </div>
      </div>
    </main>
    <footer class="page-footer blue">
    <div class="footer-copyright">
      <div class="container">
      © 2024 ingenieria de sotfware
      <a class="grey-text text-lighten-4 right" href="https://escom.ipn.mx">escom.ipn.mx</a>
      </div>
    </div>
  </footer>
</body>
</html>
<?php
  }else{
    header("location: ./../");
  }
?>