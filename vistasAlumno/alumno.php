<?php
    session_start();
    include ("../procesos/conexion.php");
    if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" href="../css/estilo.css" />
        <meta charset="UTF-8">
        <title>-Administrador- UV</title>
    </head>
    <body>
        <header>
            <section class="encabezado">
                <div id="barra" >Universidad Veracruzana</div>
            </section>
            <div id="sesion"><p>Ha iniciado sesión: <?php echo $_SESSION['usuario']; ?>.<br><a href="../procesos/logout.php">Cerrar Sesión.</a></p></div>
                <div id="fac">
                    <a href="" id="regresar" href="../vistasAdmin/administrador.php"></a>Sesión Alumno.</div>
            <nav>
                <ul>
                    <li><a class="uno" title="seg" href="../vistasGen/seguridad.php">Seguridad</a></li>
                    <li><a class="dos" title="aulas" href="">Asignacion de Aulas</a></li>
                    <li><a class="tres" title="" href="">Horarios Docentes</a></li>
                </ul>
            </nav> 
        </header>
        
        <?php
        // put your code here
        ?>
        <footer>
            
        </footer>
    </body>
</html>
<?php
}
    else{
        echo '<script> window.location = "../index.php"; </script>';
    }
?>