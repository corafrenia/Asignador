<?php
session_start();
include ("../procesos/conexion.php");
if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
       
        if(isset($_POST['eliminar'])){
            $id= $_GET['id'];
            $delete = "DELETE FROM asignaturas WHERE id = '".$id."'";
            mysqli_query($connect, $delete);
            header("Location: ../vistasAdmin/gestAsig.php?numA=1&buscarA= ");
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