<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Validando</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php 
        include("../procesos/conexion.php");
        if(isset($_POST['login'])){
            $usuario = $_POST['user'];
            $contra = $_POST['psw'];
            $tipo = $_POST['tipo'];
            $log = mysqli_query($connect, "SELECT * FROM dat_pers WHERE user='$usuario' AND pass='$contra'");
            if(mysqli_num_rows($log)>0){
                $row = mysqli_fetch_array($log);
                if (isset($_SESSION['user']) && $_SESSION['tipo'] == 1){
                    $_SESSION["user"] = $row['user'];
                    echo 'Iniciando sesión para '. $_SESSION["user"] . '<p>';
                    echo '<script> window.location = "../vistasAdmin/administrador.php"; </script>'; 
                }else{
                    if (isset($_SESSION['user']) && $_SESSION['tipo'] == 2){
                    $_SESSION["user"] = $row['user'];
                    echo 'Iniciando sesión para '. $_SESSION["user"] . '<p>';
                    echo '<script> window.location = "../vistasAlumno/bienvenidaSesion.php"; </script>'; 
                    }else{
                        if (isset($_SESSION['user']) && $_SESSION['tipo'] == 3){
                        $_SESSION["user"] = $row['user'];
                        echo 'Iniciando sesión para '. $_SESSION["user"] . '<p>';
                        echo '<script> window.location = "../vistasMaestro/bienvenidaSesion.php"; </script>'; 
                        }
                    }
                }
            }
            else{
                echo '<script> alert("Usuario o contraseña incorrectos."); </script>';
                echo '<script> window.location = "../vista/administrador.php"; </script>';
            }
        }
        ?>
    </body>
</html>