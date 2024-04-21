<?php
  session_start();
  include("./configBD.php");
  date_default_timezone_set("America/Mexico_City");

  $respAX = [];
  $boleta = $_REQUEST["boleta"];
  $contrasena = md5($_REQUEST["contrasena"]);

  $sqlGetAlumno = "SELECT * FROM alumno WHERE boleta = '$boleta' AND contrasena = '$contrasena'";
  $resGetAlumno = mysqli_query($conexion, $sqlGetAlumno);
  if(mysqli_num_rows($resGetAlumno) == 1){
    $_SESSION["boleta"] = $boleta;
    $infGetAlumno = mysqli_fetch_row($resGetAlumno);
    $respAX["cod"] = 1;
    $respAX["msj"] = "Bienvenido :) $infGetAlumno[1]";
    $respAX["icono"] = "success";
    $respAX["log"] = date("d-m-Y H:i");
  }else{
    $respAX["cod"] = 0;
    $respAX["msj"] = "Error. Boleta o contraseña incorrecta. Favor de intentarlo nuevamente";
    $respAX["icono"] = "success";
    $respAX["log"] = date("d-m-Y H:i");
  }

  echo json_encode($respAX);
?>