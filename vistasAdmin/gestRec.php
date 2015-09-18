<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
        $pagina=$_GET['num'];
        if(isset($_GET['buscar'])){
            $buscar=$_GET['buscar'];
            
                $rst_salones= mysqli_query($connect, "SELECT * FROM salones WHERE salon='".$buscar."' OR hub_salon='".$buscar."' OR capacidad='".$buscar."' OR otro_mov LIKE '%".$buscar."%' OR eq_mm LIKE '%".$buscar."%' OR observaciones LIKE '%".$buscar."%'");
                $total_registros= mysqli_num_rows($rst_salones);

                $registros=10;
                $pagina=$_GET['num'];
                if(is_numeric($pagina)){
                    $inicio=(($pagina-1)*$registros);
                }
                else{
                    $inicio=0;
                }
                $query=  mysqli_query($connect, "SELECT * FROM salones WHERE salon='".$buscar."' OR hub_salon='".$buscar."' OR capacidad='".$buscar."' OR otro_mov LIKE '%".$buscar."%' OR eq_mm LIKE '%".$buscar."%' OR observaciones LIKE '%".$buscar."%' LIMIT $inicio, $registros");
            
        }else{
            if(empty($_GET['buscar'])){
                $rst_salones= mysqli_query($connect, "SELECT * FROM salones ORDER BY hub_salon");
                $total_registros= mysqli_num_rows($rst_salones);
                $registros=10;
                $pagina=$_GET['num'];
                if(is_numeric($pagina)){
                    $inicio=(($pagina-1)*$registros);
                }
                else{
                    $inicio=0;
                }
                $query=  mysqli_query($connect, "SELECT * FROM salones LIMIT $inicio, $registros");
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
                window.open(url, "Modificar Registro de Salones.", "width=500, heigth=300, top=200, left=200");
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
                    <li><a class="tres" title="asignaturas" href="">Gestion de asignaturas</a></li>
                    <li><a class="cuatro" title=mestros" href="">Gestion de Catedráticos</a></li>
                    <li><a class="cinco" title="horarios" href="">Gestion de horarios</a></li>
                    <li><a class="seis" title="usuarios" href="">Gestion de usuarios</a></li>
                </ul>
            </nav> 
        </header>
        <!-- -----------------------------------------------------Tabla de resultados--------------------------------------------- -->
        <article>
            
           
            <table id="tabla">
                <form name="busca" method="get" action="../vistasAdmin/gestRec.php">
                <tr>
                    <td colspan="5"><img class="imgbuscar" src="../img/buscar.png"  title="Buscar..."/><input type="hidden" name="num" value="1"/>
                        <input type="search" value="<?=$_GET['buscar']?>" name="buscar" class="buscar" title="Buscar..."/>
                        </td>
                        <script>
                            function FuncionTest(control){
                                document.busca.num.type='hidden';
                            }
                        </script> 
                    <td colspan="4">Cantidad de registros: <?=$total_registros?></td>
                </tr>
                 </form>
                <tr>
                    <th>No.</th>
                    <th>Salón</th>
                    <th>Hubicación</th>
                    <th>Capacidad</th>
                    <th>Otro Mobiliario</th>
                    <th>Equipo Multimedia</th>
                    <th>Observaciones</th>
               
                </tr>
                 <tr>
                     <th></th>
                    <th>Ingresar salones</th>
                </tr>
                <form action="../procesos/metGestRec.php" method="post">
                <tr>
                    <td></td>
                    <td><input type="text" name="salon" class="camposG" required/></td>
                    <td><input type="text" name="hub_salon" class="camposG" required/></td>
                    <td><input type="number" name="capacidad" class="camposG" required/></td>
                    <td><input type="text" name="otro_mov" class="camposG" required/></td>
                    <td><input type="text" name="eq_mm" class="camposG" required/></td>
                    <td><input type="text" name="observaciones" class="camposG" required/></td>
                    <td id="mas"><input type="submit" name="guardar" class="gestion" value="+" title="Guardar Registro"/></td>
                </tr>
                </form>
                <?php                       
                    if ($rows>0) {
                        while ($row = mysqli_fetch_array($query)){
                        
                    ?>
                <tr>
                    <td></td>
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
                            
                        }else{
                            
                            echo "<tr><td colspan='9' align='center'><ul>No hay registros.</ul></td></tr>";
                        }
                    
                    
                    ?>               
                <tr>
                    <td colspan="9" align="center">
        <?php
        if($pagina>1){
            echo "&nbsp;<a href='../vistasAdmin/gestRec.php?num=".($pagina-1)."&buscar=".$_GET['buscar']."' class=anterior></a>&nbsp;";
        }
            for($cont=1; $cont<=$paginas;$cont++){
                if($cont==$pagina){
                    echo " ".$cont ." ";
                }else{
                    echo "&nbsp;<a href='../vistasAdmin/gestRec.php?num=".$cont."&buscar=".$_GET['buscar']."' class=numero>$cont</a>&nbsp;";
                }
            }
        if($pagina<$paginas){
            echo "&nbsp;<a href='../vistasAdmin/gestRec.php?num=".($pagina+1)."&buscar=".$_GET['buscar']."'class=posterior></a>&nbsp;";
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