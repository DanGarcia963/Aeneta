<?php
  $servidorBD = "localhost";
  $usuarioBD = "root";
  $contrasenaBD = "";
  $nombreBD = "aeneta";

  $conexion = mysqli_connect($servidorBD,$usuarioBD,$contrasenaBD,$nombreBD);

  mysqli_query($conexion, "SET NAMES 'utf8'");
  
  if(mysqli_connect_errno()){
    die("Problemas con la conexión a la BD ".mysqli_connect_error());
  }
?>