<?php
  session_start();
  $nombreSesion = $_REQUEST["nombreSesion"];
  unset($_SESSION[$nombreSesion]);
  header("location: ./../");
?>