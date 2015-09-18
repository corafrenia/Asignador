<?php
session_start();
include("/conexion.php");
    if(isset($_POST['guardar'])){
        $clave=$_POST['clave'];
        $asig=$_POST['asignatura'];
        $ins=$_POST['inscritos'];
        
        mysqli_query($connect, "INSERT INTO asignaturas (`id`, `clave`, `asignatura`, `inscritos`) VALUES  (NULL, '$clave', '$asig', '$ins')") or die ("problemas al insertar datos");
        echo '<script> alert("Registro almacenado correctamente."); </script>';
        echo '<script> window.location = "../vistasAdmin/gestAsig.php?numA=1&buscarA= "; </script>';
    }
?>