<?php
session_start();
include("/conexion.php");
    if(isset($_POST['guardar'])){
        $usuario=$_POST['usuario'];
        $psw=$_POST['psw'];
        $email=$_POST['email'];
        $tipo=$_POST['tipo'];
  
        mysqli_query($connect, "INSERT INTO usuarios (`usuario`, `psw`, `email`, `tipo`) VALUES  ('$usuario', '$psw', '$email', '$tipo')") or die ('<script> alert("El usuario ya existe."); </script><script> window.location = "../vistasAdmin/gestUser.php?num=1&buscar= "; </script>');
        echo '<script> alert("Registro almacenado correctamente."); </script>';
        echo '<script> window.location = "../vistasAdmin/gestUser.php?num=1&buscar= "; </script>';
    }
?>