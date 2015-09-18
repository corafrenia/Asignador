<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
            $id= $_GET['id'];
            $mostrar="SELECT * FROM asignaturas WHERE id = '".$id."'";
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
                    <td>Clave:</td>
                    <td><input name="clave" class="campos" type="text" value="<?php echo $row['clave']; ?>" /></td>
                    <td><input name="guardarM" class="boton" type="submit" value="Guardar" onclick="return confirm('Al guardar se almacenarán los nuevos cambios. ¿Esta seguro que desea modificar este registro?');"</td>
                </tr>
                <tr>
                    <td>Asignatura:</td>
                    <td><input name="asignatura" class="campos" type="text" value="<?php echo $row['asignatura']; ?>" /></td>
                </tr>
                <tr>
                    <td>Inscritos:</td>
                    <td><input name="inscritos" class="campos" type="number" value="<?php echo $row['inscritos']; ?>" /></td>
                </tr>
            </table>
        </form>
        <?php 
        if(isset($_POST['guardarM'])){
            $clave = $_POST['clave']; 
            $asignatura = $_POST['asignatura']; 
            $inscritos = $_POST['inscritos']; 
            
            
            $query = mysqli_query($connect, "UPDATE asignaturas SET clave='".$clave."', asignatura='".$asignatura."', inscritos='".$inscritos."' WHERE id='".$id."'");
            echo '<script> alert("El registro ha sido modificado satisfactoriamente."); </script>';
            echo '<script>opener.location.href="../vistasAdmin/gestAsig.php?numA=1&buscarA= ";</script>'; 
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