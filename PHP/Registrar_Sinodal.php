<?php
session_start();
include("conexion.php");
if(isset($_POST["IDTT"]) && isset($_SESSION["usuario"])){
$ID_Director = $_SESSION["usuario"];
$IDTT = $_POST["IDTT"];
$query = "INSERT INTO metodo_director (ID_Director, ID_TT, ID_Cargo) VALUES ($ID_Director, $IDTT, 2)";
        $resultado = mysqli_query($conexion, $query);
    
        if(!$resultado) {
            echo "Error al insertar datos: " . mysqli_error($conexion); // Mensaje de error específico
        } else {
            echo "Los datos fueron modificados con éxito.";
        }
    }
    else {
        echo "Error: IDTT no definido o sesión de usuario no iniciada.";
    }
?>