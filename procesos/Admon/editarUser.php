
<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
            $id= $_GET['id'];
            $mostrar="SELECT * FROM usuarios WHERE id = '".$id."'";
            $query= mysqli_query($connect, $mostrar);
            $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/estilo.css" />
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="http://www.uv.mx/favicon.ico" type="image/x-icon" />
        <title>Modificar Registro - UV</title>
    </head>
    <body>
        <form method="post">
        <table id="tabla">
            <tr>
                <th></th>
                <th>Modificar</th>
                </tr>
                <tr>
                    <td>Usuario:</td>
                    <td><input name="usuario" class="campos" type="text" value="<?php echo $row['usuario']; ?>" readonly/></td>
                    <td><input name="guardarM" class="boton" type="submit" value="Guardar" onclick="return confirm('Al guardar se almacenarán los nuevos cambios. ¿Esta seguro que desea modificar este registro?');"</td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input name="psw" class="campos" type="text" value="<?php echo $row['psw']; ?>" /></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input name="email" class="campos" type="email" value="<?php echo $row['email']; ?>" /></td>
                </tr>
                <tr>
                    <td>Tipo de usuario:</td>
                    <td><select name="tipo" class="camposG" />
                        <option class="camposG"><?php 
                            $tipo=$row['tipo'];
                                if($tipo==1){
                                    echo "Administrador";
                                }else{
                                    if($tipo==2){
                                        echo "Catedrático";
                                    }
                                    else{
                                        if($tipo==3){
                                            echo "Alumno";
                                        }
                                    }
                                } 
                                ?></option>        
                        <option disabled>- Tipo -</option>
                        <option value='1' class="camposG"> Administrador </option>
                        <option value='2' class="camposG"> Catedrático </option>
                        <option value='3' class="camposG"> Alumno </option>
                    </td>
                </tr>
                
            </table>
        </form>
        <?php 
        if(isset($_POST['guardarM'])){
            $usuario = $_POST['usuario']; 
            $psw = $_POST['psw']; 
            $email = $_POST['email']; 
            $tipo = $_POST['tipo']; 
                        
            $query = mysqli_query($connect, "UPDATE usuarios SET psw='".$psw."', email='".$email."', tipo='".$tipo."' WHERE usuario='".$usuario."'");
            echo '<script> alert("El registro ha sido modificado satisfactoriamente."); </script>';
            echo '<script>opener.location.href="../vistasAdmin/gestUser.php";</script>'; 
            echo '<script>opener.window.location.reload();</script>';
            echo '<script> window.close(); </script>';
        }
     
        ?>
    </body>
</html>
<?php
            
        
    }
    else{
        echo '<script> alert("Acceso denegado. Debe iniciar sesión."); </script>';
        echo '<script> window.location = "../index.php"; </script>';
    }
?>