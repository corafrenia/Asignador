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
        include("/conexion.php");
        if(isset($_POST['login'])){
            $usuario = $_POST['usuario'];
            $contra = $_POST['psw'];
            $query = mysqli_query($connect, "SELECT * FROM usuarios WHERE usuario='".$usuario."' AND psw='".$contra."'");
            if(mysqli_num_rows($query)>0){
                $row = mysqli_fetch_array($query);
                $_SESSION['usuario'] = $row['usuario'];
		$_SESSION['psw'] = $row['psw'];
		$_SESSION['id'] = $row['id'];
		$_SESSION['tipo'] = $row['tipo'];
                if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
                    echo 'Iniciando sesión para '. $_SESSION["usuario"] . '<p>';
                    echo '<script> window.location = "../vistasAdmin/administrador.php"; </script>'; 
                }else{
                    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 2){
                    echo 'Iniciando sesión para '. $_SESSION["usuario"] . '<p>';
                    echo '<script> window.location = "../vistasMaestro/maestro.php"; </script>'; 
                    }else{
                        if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 3){
                        echo 'Iniciando sesión para '. $_SESSION["usuario"] . '<p>';
                        echo '<script> window.location = "../vistasAlumno/alumno.php"; </script>'; 
                        }
                    }
                }
            }
            else{
                echo '<script> alert("Usuario o contraseña incorrectos."); </script>';
                echo '<script> window.location = "../index.php"; </script>';
            }
        }
        ?>
    </body>
</html>