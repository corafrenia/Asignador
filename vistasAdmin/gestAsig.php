<?php
    session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){        
        if(isset($_GET['buscarA'])){
            $buscar_a=$_GET['buscarA'];  
            $rst_asignaturas= mysqli_query($connect, "SELECT * FROM asignaturas A INNER JOIN horas H ON A.hora = H.id_hora WHERE A.clave LIKE '%".$buscar_a."%' OR A.asignatura LIKE '%".$buscar_a."' OR H.hora_ini='".$buscar_a."' OR A.inscritos='".$buscar_a."'")or die ("Query está mal");
            $total_registros_a= mysqli_num_rows($rst_asignaturas);
            $registros_a=10;
            $pagina_a=$_GET['numA'];
            if(is_numeric($pagina_a)){
                $inicio_a=(($pagina_a-1)*$registros_a);
            }
            else{
                $inicio_a=0;
            }
            $query_asig=  mysqli_query($connect, "SELECT * FROM asignaturas A INNER JOIN horas h ON A.hora = H.id_hora WHERE A.clave LIKE '%".$buscar_a."%' OR A.asignatura LIKE '%".$buscar_a."' OR H.hora_ini='".$buscar_a."' OR A.inscritos='".$buscar_a."' LIMIT $inicio_a, $registros_a") or die ("Query está mal");
        }                     
        $paginas_a=  ceil($total_registros_a/$registros_a);
        $rows_a = mysqli_num_rows($query_asig);
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
                    <a id="regresar" href="../vistasAdmin/administrador.php"></a>Gestión de Asignaturas.</div>
            <nav>
                <ul>
                    <li><a class="uno" title="Seguridad" href="../vistasAdmin/segAdmon.php">Seguridad</a></li>
                    <li><a class="dos" title="Gestion de recursos y mobiliario" href="../vistasAdmin/gestRec.php?num=1&buscar= ">Gestion de recursos y mobiliario</a></li>
                    <li><a class="tres" title="Gestion de Asignaturas" href="../vistasAdmin/gestAsig.php?numA=1&buscarA= ">Gestion de Asignaturas</a></li>
                    <li><a class="cuatro" title="Gestion de Catedráticos" href="../vistasAdmin/gestMaes.php?num=1&buscar= ">Gestion de Catedráticos</a></li>
                    <li><a class="cinco" title="Gestion de horarios" href="../vistasAdmin/gestHorarios.php?num=1&buscar= ">Gestion de horarios</a></li>
                    <li><a class="seis" title="Gestion de usuarios" href="../vistasAdmin/gestUser.php?num=1&buscar= ">Gestion de usuarios</a></li>
                </ul>
            </nav> 
        </header>
        <!-- -----------------------------------------------------Tabla de resultados--------------------------------------------- -->
        <article>
            
           
            <table id="tabla" align="center">
                <form method="get" action="../vistasAdmin/gestAsig.php">
                <tr>
                    <td colspan="4"><img class="imgbuscar" src="../img/buscar.png"  title="Buscar..."/>
                        <input type="hidden" name="numA" value="1"/>
                        <input type="search" value="<?=$_GET['buscarA']?>" name="buscarA" class="buscar" title="Buscar..."/>
                    </td>
                    <td colspan="2">Cantidad de registros: <?=$total_registros_a?></td>
                </tr>
                 </form>
                <tr>
                   
                    <th>Clave</th>
                    <th>Asignatura</th>
                    <th>Horario</th>
                    <th>Inscritos</th>
                                  
                </tr>
                 <tr>
                     
                    <th>Ingresar Asignaturas</th>
                </tr>
                <form action="../procesos/metGestAsig.php" method="post">
                <tr>
                    
                    <td><input type="text" name="clave" class="camposG" required/></td>
                    <td><input type="text" name="asignatura" class="camposG" required/></td>
                    <td><select name="hora" class="camposG" required/>
                        <option disabled>- Seleccionar Horario-</option>
                        <?php 
                            $hi=  mysqli_query($connect, "SELECT * FROM horas");
                            while ($fila_hi = mysqli_fetch_array($hi)) {
                                ?>
                        <option value='<?=$fila_hi["id_hora"]?>' class="camposG"> <?=$fila_hi["hora_ini"]?> - <?=$fila_hi["hora_fin"]?> </option>
                        <?php    
                            }
                        ?>
                    
                    </td>
                    <td><input type="number" name="inscritos" class="camposG" required/></td>
                    <td id="mas"><input type="submit" name="guardar" class="gestion" value="+" title="Guardar Registro"/></td>
                </tr>
                </form>
                <?php                       
                    if ($rows_a>0) {
                        while ($row_a = mysqli_fetch_array($query_asig)){
                        
                    ?>
                <tr>
                    
                    <td><strong><?=$row_a['clave']?></strong></td>
                    <td><?=$row_a['asignatura']?></td> 
                    <td><?=$row_a['hora_ini']?> - <?=$row_a['hora_fin']?></td>  
                    <td><?=$row_a['inscritos']?></td> 
                <form method="post" > 
                <td><input type="submit" name="editar" class="gestion" value="_/" title="Modificar Registro" onclick="abrir('../procesos/editarAsig.php?clave=<?=$row_a['clave']?>')" /></td>
                </form>
                <form method="post" action="../procesos/borrarAsig.php?clave=<?=$row_a['clave']?>">
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
        if($pagina_a>1){
            echo "&nbsp;<a href='../vistasAdmin/gestAsig.php?numA=".($pagina_a-1)."&buscarA=".$_GET['buscarA']."' class=anterior></a>&nbsp;";
        }
            for($cont=1; $cont<=$paginas_a;$cont++){
                if($cont==$pagina_a){
                    echo " ".$cont ." ";
                }else{
                    echo "&nbsp;<a href='../vistasAdmin/gestAsig.php?numA=".$cont."&buscarA=".$_GET['buscarA']."' class=numero>$cont</a>&nbsp;";
                }
            }
        if($pagina_a<$paginas_a){
            echo "&nbsp;<a href='../vistasAdmin/gestAsig.php?numA=".($pagina_a+1)."&buscarA=".$_GET['buscarA']."'class=posterior></a>&nbsp;";
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