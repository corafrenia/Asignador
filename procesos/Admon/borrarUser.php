<?php
session_start();
include ("../procesos/conexion.php");
if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
       
        if(isset($_POST['eliminar'])){
            $usuario= $_GET['usuario'];
            $delete = "DELETE FROM usuarios WHERE usuario = '".$usuario."'";
            mysqli_query($connect, $delete) or die ("no se eliminno ningun registro");
            header("Location: ../vistasAdmin/gestUser.php?num=1&buscar= ");
        }else{
            if(isset($_POST['editar'])){
                echo '<script languaje = "javascript"> '
                . 'function abrir(url)'
                        . ' </script>';
            }
        }
    }

else{
        echo '<script> alert("Acceso denegado. Debe iniciar sesión."); </script>';
        echo '<script> window.location = "../index.php"; </script>';
    }
?>