<?php
    session_start();
    if(isset($_SESSION['usuario'])){
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
        if(isset($_POST['botonpsw'])){
            $usuario = $_SESSION['usuario'];
            $pswViejo = $_POST['pswViejo'];
            $pswNuevo = $_POST['pswNuevo'];
            $pswNuevoC = $_POST['pswNuevoC'];
            $email = $_POST['email']; 
            $emailC = $_POST['emailC']; 
       
           $query = mysqli_query($connect, "SELECT * FROM usuarios WHERE usuario='".$usuario."' AND psw='".$pswViejo."'");
           
            if(mysqli_num_rows($query)>0){
                if($pswNuevo == $pswNuevoC){
                    if($email == $emailC){
                        $row = mysqli_fetch_array($query);
                        $id = $row['id'];
                        mysqli_query($connect, "UPDATE usuarios SET psw='".$pswNuevo."' WHERE id='".$id."'") or die (mysqli_errno());
                        //enviar correo-------------------------------
                        echo '<script> alert("Su contraseña ha sido modificada satisfactoriamente. En un momento más recibirá un correo erectrónico confirmando el cambio de contraseña."); </script>';
                        echo '<script> window.location = "../vistasGen/seguridad.php"; </script>';
                    }else{
                        echo '<script> alert("Las cuentas de correo no coinciden. Rectificar e-mail."); </script>';
                        echo '<script> window.location = "../vistasGen/seguridad.php"; </script>';
                    }
                }else{
                    echo '<script> alert("Las contraseñas no coinciden. Rectificar nueva contraseña."); </script>';
                    echo '<script> window.location = "../vistasGen/seguridad.php"; </script>';
                }
            }else{
                echo '<script> alert("La contraseña actual de su cuenta es incorrecta. Vuelva a intentarlo o comuníquese con el administrador."); </script>';
                echo '<script> window.location = "../vistasGen/seguridad.php"; </script>';
            }
        }
        ?>
    </body>
</html>
<?php
}
    else{
        echo '<script> window.location = "../index.php"; </script>';
    }
?>