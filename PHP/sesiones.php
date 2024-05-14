<?php
    session_start();
    if(isset($_POST["usuario"])){
        if($_POST["usuario"] == 'root'){
            $_SESSION["usuario"] = $_POST["usuario"];
            $_SESSION["Time"] = "NO";
            echo "Loggeado con éxito";
        }else{
            $_SESSION["usuario"] = $_POST["usuario"];
            echo "¡ Hasta luego !";
        }
    }else{
        header("Location: ../lost.html");
    }
?>