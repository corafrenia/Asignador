<?php
session_start();
include("/conexion.php");
    if(isset($_POST['guardar'])){
        $clave=$_POST['clave'];
        $asig=$_POST['asignatura'];
        $hora=$_POST['hora'];
        $ins=$_POST['inscritos'];
        
        mysqli_query($connect, "INSERT INTO asignaturas (`clave`, `asignatura`, `hora`, `inscritos`) VALUES  ('$clave', '$asig', '$hora', '$ins')") or die ('<script> alert("El registro ya existe."); </script><script> window.location = "../vistasAdmin/gestAsig.php?numA=1&buscarA= "; </script>');
        echo '<script> alert("Registro almacenado correctamente."); </script>';
        echo '<script> window.location = "../vistasAdmin/gestAsig.php?numA=1&buscarA= "; </script>';
    }
?>