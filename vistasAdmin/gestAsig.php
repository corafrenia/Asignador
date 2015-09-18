<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
        $pagina=$_GET['num'];
        if(isset($_GET['buscar'])){
            $buscar=$_GET['buscar'];
            
                $rst_asignaturas= mysqli_query($connect, "SELECT * FROM asignaturas WHERE clave='".$buscar."' OR asignatura='".$buscar."' OR inscritos='".$buscar."'");
                $total_registros= mysqli_num_rows($rst_asignaturas);

                $registros=10;
                $pagina=$_GET['num'];
                if(is_numeric($pagina)){
                    $inicio=(($pagina-1)*$registros);
                }
                else{
                    $inicio=0;
                }
                $query=  mysqli_query($connect, "SELECT * FROM asignaturas WHERE clave='".$buscar."' OR asignatura='".$buscar."' OR inscritos='".$buscar."' LIMIT $inicio, $registros");
            
        }else{
            if(empty($_GET['buscar'])){
                $rst_asignaturas= mysqli_query($connect, "SELECT * FROM asignaturas ORDER BY asignatura");
                $total_registros= mysqli_num_rows($rst_asignaturas);
                $registros=10;
                $pagina=$_GET['num'];
                if(is_numeric($pagina)){
                    $inicio=(($pagina-1)*$registros);
                }
                else{
                    $inicio=0;
                }
                $query=  mysqli_query($connect, "SELECT * FROM asignaturas LIMIT $inicio, $registros");
            }
        }
                              
        $paginas=  ceil($total_registros/$registros);
        $rows = mysqli_num_rows($query);
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
                window.open(url, "Modificar Registro de Asignaturas.", "width=500, heigth=300, top=200, left=200");
            }
        </script>
    </head>
    <body>
        <header>
            <section class="encabezado">
                <div id="barra" >Universidad Veracruzana</div>
            </section>
            <div id="sesion"><p>Ha iniciado sesión: <?php echo $_SESSION['usuario']; ?>.<br><a href="../procesos/logout.php"><img src="../img/logout.png" /></a></p></div>
                <div id="fac">
                    <a id="regresar" href="../vistasAdmin/administrador.php"></a>Gestión de Recursos y Mobiliario.</div>
            <nav>
                <ul>
                    <li><a class="uno" title="seg" href="../vistasAdmin/segAdmon.php">Seguridad</a></li>
                    <li><a class="dos" title="aulas" href="../vistasAdmin/gestRec.php?num=1&buscar= ">Gestion de recursos y mobiliario</a></li>
                    <li><a class="tres" title="asignaturas" href="../vistasAdmin/gestAsig.php?num=1&buscar= ">Gestion de Asignaturas</a></li>
                    <li><a class="cuatro" title=mestros" href="">Gestion de Catedráticos</a></li>
                    <li><a class="cinco" title="horarios" href="">Gestion de horarios</a></li>
                    <li><a class="seis" title="usuarios" href="">Gestion de usuarios</a></li>
                </ul>
            </nav> 
        </header>
        <!-- -----------------------------------------------------Tabla de resultados--------------------------------------------- -->
        <article>
            
           
            <table id="tabla">
                <form name="busca" method="get" action="../vistasAdmin/gestAsig.php">
                <tr>
                    <td colspan="4"><img class="imgbuscar" src="../img/buscar.png"  title="Buscar..."/>
                        <input type="hidden" name="num" value="1"/>
                        <input type="search" value="<?=$_GET['buscar']?>" name="buscar" class="buscar" title="Buscar..."/>
                    </td>
                    <td colspan="2">Cantidad de registros: <?=$total_registros?></td>
                </tr>
                 </form>
                <tr>
                    <th>No.</th>
                    <th>Clave</th>
                    <th>Asignatura</th>
                    <th>Inscritos</th>
                                  
                </tr>
                 <tr>
                     <th></th>
                    <th>Ingresar Asignaturas</th>
                </tr>
                <form action="../procesos/metGestAsig.php" method="post">
                <tr>
                    <td></td>
                    <td><input type="text" name="clave" class="camposG" required/></td>
                    <td><input type="text" name="asignatura" class="camposG" required/></td>
                    <td><input type="number" name="inscritos" class="camposG" required/></td>
                    <td id="mas"><input type="submit" name="guardar" class="gestion" value="+" title="Guardar Registro"/></td>
                </tr>
                </form>
                <?php                       
                    if ($rows>0) {
                        while ($row = mysqli_fetch_array($query)){
                        
                    ?>
                <tr>
                    <td></td>
                    <td><strong><?=$row['clave']?></strong></td>
                    <td><?=$row['asignatura']?></td> 
                    <td><?=$row['inscritos']?></td> 
                <form method="post" > 
                <td><input type="submit" name="editar" class="gestion" value="_/" title="Modificar Registro" onclick="abrir('../procesos/editarAsig.php?id=<?=$row['id']?>')" /></td>
                </form>
                <form method="post" action="../procesos/borrarAsig.php?id=<?=$row['id']?>">
                    <td><input type="submit" name="eliminar" class="gestion" value="-" title="Eliminar Registro" onclick="return confirm('¿Esta seguro de querer eliminar este registro?');"/></td>
                </form>
                </tr>
             <?php
                        }
                            
                        }else{
                            
                            echo "<tr><td colspan='6' align='center'><ul>No hay registros.</ul></td></tr>";
                        }
                    
                    
                    ?>               
                <tr>
                    <td colspan="6" align="center">
        <?php
        if($pagina>1){
            echo "&nbsp;<a href='../vistasAdmin/gestAsig.php?num=".($pagina-1)."&buscar=".$_GET['buscar']."' class=anterior></a>&nbsp;";
        }
            for($cont=1; $cont<=$paginas;$cont++){
                if($cont==$pagina){
                    echo " ".$cont ." ";
                }else{
                    echo "&nbsp;<a href='../vistasAdmin/gestAsig.php?num=".$cont."&buscar=".$_GET['buscar']."' class=numero>$cont</a>&nbsp;";
                }
            }
        if($pagina<$paginas){
            echo "&nbsp;<a href='../vistasAdmin/gestAsig.php?num=".($pagina+1)."&buscar=".$_GET['buscar']."'class=posterior></a>&nbsp;";
        }
        ?>
                    </td>
                </tr>
             </table>   
        </article>
        <!-- -----------------------------------------------------Tabla de resultados--------------------------------------------- -->
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