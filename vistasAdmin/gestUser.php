<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
        $pagina=$_GET['num'];
        if(isset($_GET['buscar'])){
            $buscar=$_GET['buscar'];
            if($buscar=='Administrador'){
                $buscar=1;
            }else{
                if($buscar=='Catedrático'){
                    $buscar=2;
                }else{
                    if($buscar=='Alumno'){
                    $buscar=3;
                    }
                }
            }
            
                $rst_usuarios= mysqli_query($connect, "SELECT * FROM usuarios WHERE usuario LIKE '%".$buscar."%' OR psw='".$buscar."' OR email LIKE '%".$buscar."%' OR tipo='".$buscar."'");
                $total_registros= mysqli_num_rows($rst_usuarios);

                $registros=10;
                $pagina=$_GET['num'];
                if(is_numeric($pagina)){
                    $inicio=(($pagina-1)*$registros);
                }
                else{
                    $inicio=0;
                }
                $query_users=  mysqli_query($connect, "SELECT * FROM usuarios WHERE usuario LIKE '%".$buscar."%' OR psw='".$buscar."' OR email LIKE '%".$buscar."%' OR tipo='".$buscar."' LIMIT $inicio, $registros");
            
        }else{
            if(empty($_GET['buscar'])){
                $rst_usuarios= mysqli_query($connect, "SELECT * FROM usuarios") or die ("la consulta está mal");
                $total_registros= mysqli_num_rows($rst_usuarios);
                $registros=10;
                $pagina=$_GET['num'];
                if(is_numeric($pagina)){
                    $inicio=(($pagina-1)*$registros);
                }
                else{
                    $inicio=0;
                }
                $query_users=  mysqli_query($connect, "SELECT * FROM usuarios LIMIT $inicio, $registros")or die ("la consulta está mal");
            }
        }
                              
        $paginas=  ceil($total_registros/$registros);
        $rows = mysqli_num_rows($query_users);
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
                    <a id="regresar" href="../vistasAdmin/administrador.php"></a>Gestión de Usuarios.</div>
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
            
           
            <table id="tabla" align="center">
                <form name="busca" method="get" action="../vistasAdmin/gestUser.php">
                <tr>
                    <td colspan="4"><img class="imgbuscar" src="../img/buscar.png"  title="Buscar..."/><input type="hidden" name="num" value="1"/>
                        <input type="search" value="<?=$_GET['buscar']?>" name="buscar" class="buscar" title="Buscar..."/>
                        </td>
                    <td colspan="2">Cantidad de registros: <?=$total_registros?></td>
                </tr>
                 </form>
                <tr>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Email</th>
                    <th>Tipo de Usuario</th>
               
                </tr>
                 <tr>
                     <th></th>
                    <th>Ingresar usuario</th>
                </tr>
                <form action="../procesos/metGestUser.php" method="post">
                <tr>
                    
                    <td><input type="text" name="usuario" class="camposG" required/></td>
                    <td><input type="text" name="psw" class="camposG" required/></td>
                    <td><input type="email" name="email" class="camposG" required/></td>
                    <td><select name="tipo" class="camposG" />
                        <option disabled>- Tipo -</option>
                        <option value='1' class="camposG"> Administrador </option>
                        <option value='2' class="camposG"> Catedrático </option>
                        <option value='3' class="camposG"> Alumno </option>
                    </td>
                    <td id="mas"><input type="submit" name="guardar" class="gestion" value="+" title="Guardar Registro"/></td>
                </tr>
                </form>
                <?php                       
                    if ($rows>0) {
                        while ($row = mysqli_fetch_array($query_users)){
                        
                    ?>
                <tr>
                    
                    <td><?=$row['usuario']?></td> 
                    <td><?=$row['psw']?></td> 
                    <td><?=$row['email']?></td> 
                    <td><?php
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
                    ?>
                    </td>
          
                <form method="post" > 
                <td><input type="submit" name="editar" class="gestion" value="_/" title="Modificar Registro" onclick="abrir('../procesos/editarUser.php?usuario=<?=$row['usuario']?>')" /></td>
                </form>
                <form method="post" action="../procesos/borrarUser.php?usuario=<?=$row['usuario']?>">
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
            echo "&nbsp;<a href='../vistasAdmin/gestUser.php?num=".($pagina-1)."&buscar=".$_GET['buscar']."' class=anterior></a>&nbsp;";
        }
            for($cont=1; $cont<=$paginas;$cont++){
                if($cont==$pagina){
                    echo " ".$cont ." ";
                }else{
                    echo "&nbsp;<a href='../vistasAdmin/gestUser.php?num=".$cont."&buscar=".$_GET['buscar']."' class=numero>$cont</a>&nbsp;";
                }
            }
        if($pagina<$paginas){
            echo "&nbsp;<a href='../vistasAdmin/gestUser.php?num=".($pagina+1)."&buscar=".$_GET['buscar']."'class=posterior></a>&nbsp;";
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