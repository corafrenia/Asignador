<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
            $clave= $_GET['clave_maes'];
            $mostrar="SELECT * FROM maestros JOIN asignaturas ON maestros.asignatura_clave = asignaturas.clave JOIN horas ON maestros.hora = horas.id WHERE clave_maes = '".$clave."'";
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
                    <td><input name="clave" class="campos" type="text" value="<?php echo $row['clave_maes']; ?>" readonly/></td>
                    <td><input name="guardarM" class="boton" type="submit" value="Guardar" onclick="return confirm('Al guardar se almacenarán los nuevos cambios. ¿Esta seguro que desea modificar este registro?');"</td>
                </tr>
                <tr>
                    <td>Maestro:</td>
                    <td><input name="maestro" class="campos" type="text" value="<?php echo $row['maestro']; ?>" /></td>
                </tr>
                <tr>
                    <td>Asigntura:</td>
                    <td><select name="asig" class="camposG" required/>
                    <option value="<?=$row['asignatura_clave']?>"><?=$row['asignatura']?></option>
                    <option disabled>- Seleccionar Asignatura-</option>
                        <?php 
                            $asig=  mysqli_query($connect, "SELECT * FROM asignaturas");
                            while ($fila_asig = mysqli_fetch_array($asig)) {
                                ?>
                        <option value='<?=$fila_asig["clave"]?>' class="camposG"> <?=$fila_asig["asignatura"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                </tr> 
                <tr>
                    <td>Hora:</td>
                    <td><select name="hora" class="camposG" required/>
                        <option value="<?=$row['hora']?>"><?=$row["hora_ini"]?> - <?=$row["hora_fin"]?></option>
                        <option disabled>- Seleccionar Horario-</option>
                        <?php 
                            $hi=  mysqli_query($connect, "SELECT * FROM horas");
                            while ($fila_hi = mysqli_fetch_array($hi)) {
                                ?>
                        <option value='<?=$fila_hi["id"]?>' class="camposG"> <?=$fila_hi["hora_ini"]?> - <?=$fila_hi["hora_fin"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
        <?php 
        if(isset($_POST['guardarM'])){
            $maestro = $_POST['maestro']; 
            $hora = $_POST['hora']; 
            $asignatura = $_POST['asig'];  
                        
            $query = mysqli_query($connect, "UPDATE maestros SET maestro='".$maestro."' , asignatura_clave='".$asignatura."', hora='".$hora."' WHERE clave_maes='".$clave."'") or die ("Problemas al modificar los datos.");
            echo '<script> alert("El registro ha sido modificado satisfactoriamente."); </script>';
            echo '<script>opener.location.href="../vistasAdmin/gestMaes.php";</script>'; 
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