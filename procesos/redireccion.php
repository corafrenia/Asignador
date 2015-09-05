<?php
session_start();
include ("../procesos/conexion.php");

$tipo=$_SESSION['tipo'];

if($tipo==1){
    return header("Location: ../vistasAdmin/administrador.php");
}else{
    if($tipo==2){
        return header("Location: ../vistasMaestro/maestro.php");
    }else{
        if($tipo==3){
            return header("Location: ../vistasAlumno/alumno.php");
        }else{
            echo '<script> alert("No ha iniciado sesión."); </script>';
            echo '<script> window.location = "../index.php"; </script>';
        }
    }
}
?>