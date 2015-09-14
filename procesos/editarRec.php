
<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
            $id= $_GET['id'];
            $mostrar="SELECT * FROM salones WHERE id = '".$id."'";
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
                    <td>Salón:</td>
                    <td><input name="salon" class="campos" type="text" value="<?php echo $row['salon']; ?>" /></td>
                    <td><input name="guardarM" class="boton" type="submit" value="Guardar" onclick="return confirm('Al guardar se almacenarán los nuevos cambios. ¿Esta seguro que desea modificar este registro?');"</td>
                </tr>
                <tr>
                    <td>Hubicación:</td>
                    <td><input name="hub_salon" class="campos" type="text" value="<?php echo $row['hub_salon']; ?>" /></td>
                </tr>
                <tr>
                    <td>Capacidad:</td>
                    <td><input name="capacidad" class="campos" type="number" value="<?php echo $row['capacidad']; ?>" /></td>
                </tr>
                <tr>
                    <td>Mobiliario:</td>
                    <td><input name="otro_mov" class="campos" type="text" value="<?php echo $row['otro_mov']; ?>" /></td>
                </tr>
                <tr>
                    <td>Equipo Multimedia:</td>
                    <td><input name="eq_mm" class="campos" type="text" value="<?php echo $row['eq_mm']; ?>" /></td>
                </tr>
                <tr>
                    <td>Observaciones:</td>
                    <td><input name="observaciones" class="campos" type="text" value="<?php echo $row['observaciones']; ?>" /></td>
                </tr>
            </table>
        </form>
        <?php 
        if(isset($_POST['guardarM'])){
            $salon = $_POST['salon']; 
            $capacidad = $_POST['capacidad']; 
            $hub_salon = $_POST['hub_salon']; 
            $otro_mov = $_POST['otro_mov']; 
            $eq_mm = $_POST['eq_mm']; 
            $observaciones = $_POST['observaciones']; 
            
            $query = mysqli_query($connect, "UPDATE salones SET salon='".$salon."', hub_salon='".$hub_salon."', capacidad='".$capacidad."', otro_mov='".$otro_mov."', eq_mm='".$eq_mm."', observaciones='".$observaciones."' WHERE id='".$id."'");
            echo '<script> alert("El registro ha sido modificado satisfactoriamente."); </script>';
            echo '<script>opener.location.href="../vistasAdmin/gestRec.php";</script>'; 
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