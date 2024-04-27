<?php
  $boleta = $_SESSION["boleta"];
  $sqlGetAlumno = "SELECT * FROM alumno WHERE Boleta = '$boleta'";
  $resGetAlumno = mysqli_query($conexion, $sqlGetAlumno);
  $infGetAlumno = mysqli_fetch_row($resGetAlumno);
?>