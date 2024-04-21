<!--     \\\     -->
<!--      (o>    -->
<!--   \\_//)    -->
<!--    \_/_)    -->
<!--      _|_    -->

<?php
  include("./configBD.php");
  date_default_timezone_set("America/Mexico_City");

  $boleta = $_REQUEST["boleta"];
  $nombre = $_REQUEST["nombre"];
  $primerApe = $_REQUEST["primerApe"];
  $segundoApe = $_REQUEST["segundoApe"];
  $correo = $_REQUEST["correo"];
  $telCel = $_REQUEST["CURP"];
  $contrasena = md5($_REQUEST["contrasena"]);
  $respAX = [];

  //Revisar si el número de boleta ya está registrado
  $sqlGetBoleta = "SELECT * FROM alumno WHERE boleta = '$boleta'";
  $resGetBoleta = mysqli_query($conexion, $sqlGetBoleta);
  if(mysqli_num_rows($resGetBoleta) == 1){
    $respAX["cod"] = 2;
    $respAX["msj"] = "Error. El número de boleta ya está registrado. Favor de intentarlo nuevamente.";
    $respAX["icono"] = "error";
    $respAX["log"] = date("d-m-Y H:i");
  }else{
    $sqlSetAlumno = "INSERT INTO alumno (boleta, Nombres, Apellido_Paterno, Apellido_Materno, Correo, CURP, Contrasena ) VALUES('$boleta','$nombre','$primerApe','$segundoApe','$correo', '$CURP', '$contrasena')";
    $resSetAlumno = mysqli_query($conexion, $sqlSetAlumno);
    if(mysqli_affected_rows($conexion) == 1){
      $respAX["cod"] = 1;
      $respAX["msj"] = "Gracias. Tu registro se realizó de manera correcta";
      $respAX["icono"] = "success";
      $respAX["log"] = date("d-m-Y H:i");
    }else{
      $respAX["cod"] = 0;
      $resp["msj"] = "Error. Favor de intentarlo nuevamente";
      $respAX["icono"] = "error";
      $respAX["fecha"] = date("d-m-Y H:i");
    }
  }

  echo json_encode($respAX);
?>