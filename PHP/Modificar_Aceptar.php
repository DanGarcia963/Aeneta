<?php
if(isset($_POST["IDTT"])){
include("conexion.php");
$IDTT = $_POST["IDTT"];
$query = "UPDATE metodo_titulacion 
          SET ID_Estado = 1
          WHERE ID_TT = '$IDTT'";
        $resultado = mysqli_query($conexion, $query);
    
        if(!$resultado){
            echo "Error";
        }else{
            echo "Los datos fueron modificados con éxito.";
        }
    }
    else {
        echo "Error: IDTT no definido.";
    }
?>
