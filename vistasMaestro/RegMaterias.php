<?php
     session_start();
    include ("../procesos/conexion.php");
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 2){
?>
<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" href="../css/estilo.css" />
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="http://www.uv.mx/favicon.ico" type="image/x-icon" />
        <title>- Sesión: <?php echo $_SESSION['usuario']; ?> - UV</title>
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
                    <li><a class="uno" title="seg" href="../vistasMaestro/segMaes.php">Seguridad</a></li>
                    <li><a class="dos" title="aulas" href="../vistasMaestro/RegMaterias.php">Registro de Asignaturas</a></li>
                    <li><a class="tres" title="" href="">Horarios Docentes</a></li>
                </ul>
            </nav> 
        </header>
        <!-- -----------------------------------------------------Tabla de resultados--------------------------------------------- -->
        <article>
              
                <table id="tabla" align="center">
                    <form method="get" action="../vistasMaestro/RegMaterias.php">
                    <tr>
                        <th colspan="2">
                            Ingrese las materias que imparte, seleccionandola de la barra que se encuentra a continuacion:
                        </th> 
                    </tr>
                    <tr>
                        <td> 
                            
                                <select name="asig" class="camposG" />
                                <option disabled>- Asignaturas -</option>
                        <?php 
                            $asignatura=  mysqli_query($connect, "SELECT A.Asignatura FROM horario H JOIN asignaturas A ON H.asignatura_c = A.clave ORDER BY asignatura ASC");
                            while ($fila_asig = mysqli_fetch_array($asignatura)) {
                        ?>
                        <option value='<?=$fila_asig["asignatura"]?>' class="camposG"> <?=$fila_asig["asignatura"]?> </option>
                        <?php    
                            }
                        ?>
                            </form>
                        </td>
                        <td><input type="submit" name="asis" value="Asignatura" class="boton"></td>
                            
                    </tr>
                        <?php    
                            if(isset($_GET['asis'])){
                        ?>
                    <tr>
                        <th colspan="2">
                            Ingrese la sección a la que corresponde su horario:
                        </th> 
                    </tr>
                    <tr>
                        <td>  
                            <form method="get">  
                            <select name="seccion" class="camposG" />
                            <option disabled>- Sección -</option>
                            <option value='1' class="camposG"> Sección 1 </option>
                            <option value='1' class="camposG"> Sección 2 </option>
                            <option value='1' class="camposG"> Sección 3 </option>
                            <option value='1' class="camposG"> Sección 4 </option>
                            <option value='1' class="camposG"> Sección 5 </option>
                        </td>
                            <td><input type="submit" name="asis" value="Sección" class="boton"></td>
                        </form>
                    </tr>    
                         <?php    
                            }
                        ?>
                    </tr>
                    
                    </form>
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