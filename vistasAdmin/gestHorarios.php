<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
        if(isset($_GET['buscar'])){
            $buscar=$_GET['buscar'];
            $rst_horarios= mysqli_query($connect, "SELECT A.clave, A.asignatura, M.maestro, D1.dia, D2.dia, D3.dia, D4.dia, D5.dia, H.hora_ini, H.hora_fin, S.salon FROM horario Ho "
                                                . "INNER JOIN asignaturas A ON Ho.asignatura_c = A.clave "
                                                . "INNER JOIN maestros M ON Ho.maestro_c = M.clave_maes "
                                                . "INNER JOIN dias D1 ON Ho.dia1 = D1.id_dia "
                                                . "INNER JOIN dias D2 ON Ho.dia2 = D2.id_dia "
                                                . "INNER JOIN dias D3 ON Ho.dia3 = D3.id_dia "
                                                . "INNER JOIN dias D4 ON Ho.dia4 = D4.id_dia "
                                                . "INNER JOIN dias D5 ON Ho.dia5 = D5.id_dia "
                                                . "INNER JOIN horas H ON Ho.hora_c = H.id_hora "
                                                . "INNER JOIN salones S ON Ho.salon_c = S.salon "
                                                . "WHERE A.clave='".$buscar."' OR A.asigntura LIKE '".$buscar."' OR M.maestro='".$buscar."' OR D1.dia='".$buscar."' OR D2.dia='".$buscar."' OR D3.dia='".$buscar."' OR D4.dia='".$buscar."' OR D5.dia='".$buscar."' OR H.hora_ini='".$buscar."' OR S.salon='".$buscar."'") or die ("El query está mal");
                $total_registros= mysqli_num_rows($rst_horarios);
                $registros=10;
                $pagina=$_GET['num'];
                if(is_numeric($pagina)){
                    $inicio=(($pagina-1)*$registros);
                }
                else{
                    $inicio=0;
                }
                $query=  mysqli_query($connect, "SELECT * FROM horario Ho "
                                                . "JOIN asignaturas A ON Ho.asignatura_c = A.clave "
                                                . "JOIN maestros M ON Ho.maestro_c = M.clave_maes "
                                                . "JOIN dias D1, D2, D3, D4, D5 ON Ho.dia1 = D.id_dia AND Ho.dia2 = D.id_dia AND Ho.dia3 = D.id_dia AND Ho.dia4 = D.id_dia AND Ho.dia5 = D.id_dia "
                                                . "JOIN horas H ON Ho.hora_c = horas.id_hora "
                                                . "JOIN salones S ON Ho.salon_c = salones.salon "
                                                . "WHERE asignatura_c='".$buscar."' OR maestro_c='".$buscar."' OR dia1='".$buscar."' OR dia2='".$buscar."' OR dia3='".$buscar."' OR dia4='".$buscar."' OR dia5='".$buscar."' OR hora_c='".$buscar."' OR salon_c='".$buscar."' LIMIT $inicio, $registros");
            
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
                window.open(url, "Modificar Registro de Maestro.", "width=500, heigth=300, top=200, left=200");
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
                    <a id="regresar" href="../vistasAdmin/administrador.php"></a>Gestión de Horarios.</div>
            <nav>
                <ul>
                    <li><a class="uno" title="seg" href="../vistasAdmin/segAdmon.php">Seguridad</a></li>
                    <li><a class="dos" title="aulas" href="../vistasAdmin/gestRec.php?num=1&buscar= ">Gestion de recursos y mobiliario</a></li>
                    <li><a class="tres" title="asignaturas" href="../vistasAdmin/gestAsig.php?numA=1&buscarA= ">Gestion de asignaturas</a></li>
                    <li><a class="cuatro" title=mestros" href="../vistasAdmin/gestMaes.php?num=1&buscar= ">Gestion de Catedráticos</a></li>
                    <li><a class="cinco" title="horarios" href="../vistasAdmin/gestHorarios.php?num=1&buscar= ">Gestion de horarios</a></li>
                    <li><a class="seis" title="usuarios" href="../vistasAdmin/gestUser.php?num=1&buscar= ">Gestion de usuarios</a></li>
                </ul>
            </nav> 
        </header>
        <!-- -----------------------------------------------------Tabla de resultados--------------------------------------------- -->
        <article>
            
           
            <table id="tabla">
                <form method="get" action="../vistasAdmin/gestHorarios.php">
                <tr>
                    <td colspan="5"><img class="imgbuscar" src="../img/buscar.png"  title="Buscar..."/><input type="hidden" name="num" value="1"/>
                        <input type="search" value="<?=$_GET['buscar']?>" name="buscar" class="buscar" title="Buscar..."/>
                        </td>
                    <td colspan="4">Cantidad de registros: <?=$total_registros?></td>
                </tr>
                 </form>
                <tr>
                    <th>Clave de Asignatura</th>
                    <th>Asignatura</th>
                    <th>Catedrático</th>
                    <th colspan="5">Días de Clase</th>
                    <th>Horario</th>
                    <th>Salón</th>
                </tr>
                 <tr>
                     <th></th>
                    <th>Generar Horario</th>
                </tr>
                <form action="../procesos/metGestHr.php" method="post">
                <tr>
                    <td></td>
                    <td><input type="text" name="asignatura" class="camposG" required/></td>
                    <td><input type="text" name="maestro" class="camposG" required/></td>
                    <td><select name="dia1" class="camposG" />
                        <option disabled>- Días -</option>
                        <?php 
                            $dia1=  mysqli_query($connect, "SELECT * FROM dias ORDER BY id_dia");
                            while ($fila_dia1 = mysqli_fetch_array($dia1)) {
                                ?>
                        <option value='<?=$fila_dia1["id_dia"]?>' class="camposG"> <?=$fila_dia1["dia"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                    <td><select name="dia2" class="camposG" />
                        <option disabled>- Días -</option>
                        <?php 
                            $dia2=  mysqli_query($connect, "SELECT * FROM dias ORDER BY id_dia");
                            while ($fila_dia2 = mysqli_fetch_array($dia2)) {
                                ?>
                        <option value='<?=$fila_dia2["id_dia"]?>' class="camposG"> <?=$fila_dia2["dia"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                    <td><select name="dia3" class="camposG" />
                        <option disabled>- Días -</option>
                        <?php 
                            $dia3=  mysqli_query($connect, "SELECT * FROM dias ORDER BY id_dia");
                            while ($fila_dia3 = mysqli_fetch_array($dia3)) {
                                ?>
                        <option value='<?=$fila_dia3["id_dia"]?>' class="camposG"> <?=$fila_dia3["dia"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                    <td><select name="dia4" class="camposG" />
                        <option disabled>- Días -</option>
                        <?php 
                            $dia4=  mysqli_query($connect, "SELECT * FROM dias ORDER BY id_dia");
                            while ($fila_dia4 = mysqli_fetch_array($dia4)) {
                                ?>
                        <option value='<?=$fila_dia4["id_dia"]?>' class="camposG"> <?=$fila_dia4["dia"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                    <td><select name="dia5" class="camposG" />
                        <option disabled>- Días -</option>
                        <?php 
                            $dia5=  mysqli_query($connect, "SELECT * FROM dias ORDER BY id_dia");
                            while ($fila_dia5 = mysqli_fetch_array($dia5)) {
                                ?>
                        <option value='<?=$fila_dia5["id_dia"]?>' class="camposG"> <?=$fila_dia5["dia"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                    <td><select name="hora" class="camposG" />
                        <option disabled>- Seleccionar Horario-</option>
                        <?php 
                            $h=  mysqli_query($connect, "SELECT * FROM horas");
                            while ($fila_h = mysqli_fetch_array($h)) {
                                ?>
                        <option value='<?=$fila_h["id_hora"]?>' class="camposG"> <?=$fila_h["hora_ini"]?> - <?=$fila_h["hora_fin"]?> </option>
                        <?php    
                            }
                        ?>
                    </td>
                    <td></td>
                    <td><input type="submit" name="guardar" class="gestion" value="+" title="Guardar Registro"/></td>
                </tr>
                </form>
                <?php                       
                    if ($rows>0) {
                        while ($row = mysqli_fetch_array($query)){
                        
                    ?>
                <tr>
                    
                    <td><strong><?=$row['clave']?></strong></td>
                    <td><?=$row['asignatura']?></td> 
                    <td><?=$row['maestro']?></td> 
                    <td><?=$row['dia']?></td>
                    <td><?=$row['dia']?></td>
                    <td><?=$row['dia']?></td>
                    <td><?=$row['dia']?></td>
                    <td><?=$row['dia']?></td>
                    <td><?=$row['hora_ini']?> - <?=$row['hora_fin']?></td> 
                    <td><?=$row['salon']?></td>
                <form method="post" > 
                <td><input type="submit" name="editar" class="gestion" value="_/" title="Modificar Registro" onclick="abrir('../procesos/editarMaes.php?clave_maes=<?=$row['clave_maes']?>')" /></td>
                </form>
                <form method="post" action="../procesos/borrarMaes.php?clave_maes=<?=$row['clave_maes']?>">
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
            echo "&nbsp;<a href='../vistasAdmin/gestMaes.php?num=".($pagina-1)."&buscar=".$_GET['buscar']."' class=anterior></a>&nbsp;";
        }
            for($cont=1; $cont<=$paginas;$cont++){
                if($cont==$pagina){
                    echo " ".$cont ." ";
                }else{
                    echo "&nbsp;<a href='../vistasAdmin/gestMaes.php?num=".$cont."&buscar=".$_GET['buscar']."' class=numero>$cont</a>&nbsp;";
                }
            }
        if($pagina<$paginas){
            echo "&nbsp;<a href='../vistasAdmin/gestMaes.php?num=".($pagina+1)."&buscar=".$_GET['buscar']."'class=posterior></a>&nbsp;";
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