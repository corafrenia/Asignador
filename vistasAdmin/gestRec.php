<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
?>
<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" href="../css/estilo.css" />
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="http://www.uv.mx/favicon.ico" type="image/x-icon" />
        <title>-Administrador- UV</title>
        
        <script languaje = "javascript">
            function abrir(url){
                window.open(url, "Modificar Registro de Salones.", "width=500, heigth=300, top=200, left=200");
            }
        </script>
    </head>
    <body>
        <header>
            <section class="encabezado">
                <div id="barra" >Universidad Veracruzana</div>
            </section>
            <div id="sesion"><p>Ha iniciado sesión: <?php echo $_SESSION['usuario']; ?>.<br><a href="../procesos/logout.php">Cerrar Sesión.</a></p></div>
                <div id="fac">
                    <a id="regresar" href="../vistasAdmin/administrador.php"></a>Gestión de Recursos y Mobiliario.</div>
            <nav>
                <ul>
                    <li><a class="uno" title="seg" href="../vistasAdmin/segAdmon.php">Seguridad</a></li>
                    <li><a class="dos" title="aulas" href="../vistasAdmin/gestRec.php">Gestion de recursos y mobiliario</a></li>
                    <li><a class="tres" title="asignaturas" href="">Gestion de asignaturas</a></li>
                    <li><a class="cuatro" title=mestros" href="">Gestion de Catedráticos</a></li>
                    <li><a class="cinco" title="horarios" href="">Gestion de horarios</a></li>
                    <li><a class="seis" title="usuarios" href="">Gestion de usuarios</a></li>
                </ul>
            </nav> 
        </header>
        <article>
            <div><form method="post" action="../procesos/buscaRegRec.php"><img class="imgbuscar" src="../img/buscar.png" /><input type="search" value="Buscar..." name="buscar" class="buscar" /></form></div>
            <table id="tabla">
                <tr>
                <form method="post">
                    <th><input type="submit" name="salon" class="botonv" value="Salón"/></th>
                    <th><input type="submit" name="hub" class="botonv" value="Hubicación"/></th>
                    <th><input type="submit" name="cap" class="botonv" value="Capacidad"/></th>
                    <th><input type="submit" name="om" class="botonv" value="Otro Mobiliario"/></th>
                    <th><input type="submit" name="em" class="botonv" value="Equipo Multimedia"/></th>
                    <th><input type="submit" name="obs" class="botonv" value="Observaciones"/></th>
                </form>
                </tr>
                <?php
                include '../procesos/mostrarRegRec.php';
                if ($rows>0) {
                    while ($row = mysqli_fetch_array($query)){
                    ?>
                <tr>
                    <td><strong><?=$row['salon']?></strong></td>
                    <td><?=$row['hub_salon']?></td> 
                    <td><?=$row['capacidad']?></td> 
                    <td><?=$row['otro_mov']?></td> 
                    <td><?=$row['eq_mm']?></td>
                    <td><?=$row['observaciones']?></td>
                <form method="post" > 
                <td><input type="submit" name="editar" class="gestion" value="_/" title="Modificar Registro" onclick="abrir('../procesos/editarRec.php?id=<?=$row['id']?>')" /></td>
                </form>
                <form method="post" action="../procesos/borrarRec.php?id=<?=$row['id']?>">
                    <td><input type="submit" name="eliminar" class="gestion" value="-" title="Eliminar Registro" onclick="return confirm('¿Esta seguro de querer eliminar este registro?');"/></td>
                </form>
                </tr>
             <?php
                    }
                    
                }
                    ?>
                <tr>
                    <th>Ingresar salones</th>
                </tr>
                <form action="../procesos/metGestRec.php" method="post">
                <tr>
                    <td><input type="text" name="salon" class="camposG" required/></td>
                    <td><input type="text" name="hub_salon" class="camposG" required/></td>
                    <td><input type="number" name="capacidad" class="camposG" required/></td>
                    <td><input type="text" name="otro_mov" class="camposG" required/></td>
                    <td><input type="text" name="eq_mm" class="camposG" required/></td>
                    <td><input type="text" name="observaciones" class="camposG" required/></td>
                    <td id="mas"><input type="submit" name="guardar" class="gestion" value="+" title="Guardar Registro"/></td>
                </tr>
                <tr>
                    
                </tr>
                </form>
            </table>
        </article>
        
        <footer>
            
        </footer>
    </body>
</html>
<?php
}
    else{
        echo '<script> alert("Acceso denegado. Debe iniciar sesión."); </script>';
        echo '<script> window.location = "../index.php"; </script>';
    }
?>