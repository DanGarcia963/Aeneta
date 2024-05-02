
<?php
session_start();
if(isset($_SESSION["usuario"]) || isset($_SESSION["TT"])){}else{
    header("Location: lost.html");
    $_SESSION["usuario"] = "invitado";
}
$ID_Alumno = $_SESSION["usuario"];
echo "<script>console.log('$ID_Alumno');</script>";

if(isset($_POST["IDTT"])){
include("conexion.php");
$IDTT = $_POST["IDTT"];
$query = "UPDATE alumno 
          SET ID_TT = $IDTT
          WHERE ID_Alumno = '$ID_Alumno'";
        $resultado = mysqli_query($conexion, $query);
    
        if(!$resultado){
            echo "Error";
            $_SESSION["TT"]="NO";
        }else{
            echo "Los datos fueron modificados con éxito.";
            $_SESSION["TT"]="SI";
        }
    }
    else {
        echo "Error: IDTT no definido.";
    }
?>