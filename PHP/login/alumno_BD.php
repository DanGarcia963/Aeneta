<!--     \\\     -->
<!--      (o>    -->
<!--   \\_//)    -->
<!--    \_/_)    -->
<!--      _|_    -->

<?php
  $boleta = $_SESSION["boleta"];
  $sqlGetAlumno = "SELECT * FROM alumno WHERE boleta = '$boleta'";
  $resGetAlumno = mysqli_query($conexion, $sqlGetAlumno);
  $infGetAlumno = mysqli_fetch_row($resGetAlumno);
?>