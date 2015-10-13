<?php
session_start();
include("/conexion.php");
    if(isset($_POST['guardar'])){
        $clave=$_POST['clave_maes'];
        $maestro=$_POST['maestro'];
        $asig=$_POST['asig'];
        $hora=$_POST['hora'];
        
        mysqli_query($connect, "INSERT INTO maestros (`clave_maes`, `maestro`, `asignatura_clave`, `hora`) VALUES ('$clave', '$maestro', '$asig', '$hora')") or die ('<script> alert("El registro ya existe."); </script><script> window.location = "../vistasAdmin/gestMaes.php?num=1&buscar= "; </script>');
        echo '<script> alert("Registro almacenado correctamente."); </script>';
        echo '<script> window.location = "../vistasAdmin/gestMaes.php?num=1&buscar= "; </script>';
    }
?>