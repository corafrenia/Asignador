<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
            $clave= $_GET['clave'];
            $mostrar="SELECT * FROM asignaturas JOIN horas WHERE clave = '".$clave."' AND asignaturas.hora = horas.id";
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
                    <td><input name="clave" class="campos" type="text" value="<?php echo $row['clave']; ?>" readonly/></td>
                    <td><input name="guardarM" class="boton" type="submit" value="Guardar" onclick="return confirm('Al guardar se almacenarán los nuevos cambios. ¿Esta seguro que desea modificar este registro?');"</td>
                </tr>
                <tr>
                    <td>Asignatura:</td>
                    <td><input name="asignatura" class="campos" type="text" value="<?php echo $row['asignatura']; ?>" /></td>
                </tr>
                <tr>
                    <td>Horario:</td>
                    <td>
                        <select name="hora" class="camposG" required/>
                            <option value="<?=$row['hora']?>"><?=$row['hora_ini']?> - <?=$row['hora_fin']?></option>
                            <option disabled>- Seleccionar -</option>
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
                <tr>
                    <td>Inscritos:</td>
                    <td><input name="inscritos" class="campos" type="number" value="<?php echo $row['inscritos']; ?>" /></td>
                </tr>
            </table>
        </form>
        <?php 
        if(isset($_POST['guardarM'])){
            if(empty($_POST['hora'])){
                echo '<script> alert("Elija la hora de la asignatura."); </script>';
                echo '<script> window.location = "../procesos/editarAsig.php"; </script>';
            }
            $clave = $_POST['clave']; 
            $asignatura = $_POST['asignatura']; 
            $inscritos = $_POST['inscritos']; 
            $hora=$_POST['hora'];
            
            
            $query = mysqli_query($connect, "UPDATE asignaturas SET asignatura='".$asignatura."', hora='".$hora."', inscritos='".$inscritos."' WHERE clave='".$clave."'");
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