<?php
    session_start();
    include ("../procesos/conexion.php");
    if(isset($_SESSION['usuario'])){
?>
<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" href="../css/estilo.css"/>
        <meta charset="UTF-8">
        <title>Seguridad -Administrador- UV</title>
        
    </head>
    <header>
        <section class="encabezado">
            <div id="barra" >Universidad Veracruzana</div>
        </section>
        <div id="sesion"><p>Ha iniciado sesión: <?php echo $_SESSION['usuario']; ?>.<br><a href="../procesos/logout.php">Cerrar Sesión.</a></p></div>
        <div id="fac"><a id="regresar" href="../procesos/redireccion.php"></a>Cambio de Contraseña</div>
        <nav>
            <ul>
                <li><a class="uno" title="seg" href="../vistasGen/seguridad.php">Seguridad</a></li>
                <li><a class="dos" title="aulas" href="">Asignacion de Aulas</a></li>
                <li><a class="tres" title="" href="">Horarios Docentes</a></li>
            </ul>
        </nav> 
    </header>
    <body>
        <article>
            <form action="../procesos/procesoContra.php" method="post" id="formulario1" >
                <table>
                    <tr>
                        <td>Ingrese su contraseña actual:</td>
                        <td><input type="password" name="pswViejo" class="campos" required/></td>
                    </tr>
                    <tr>
                        <td>Ingrese su nueva contraseña:</td>
                        <td><input type="password" name="pswNuevo" class="campos" required/></td>
                    </tr>
                    <tr>
                        <td>Repita nueva contraseña:</td>
                        <td><input type="password" name="pswNuevoC" class="campos" required autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td>Ingrese un correo electrónico para recibir confirmación:</td>
                        <td><input type="email" name="email" class="campos" required/></td>
                    </tr>
                    <tr>
                        <td>Ingrese nuevamente su correo electrónico:</td>
                        <td><input type="email" name="emailC" class="campos" required autocomplete="off"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="botonpsw" class="boton" value="Enviar" /></td>
                    </tr>
                </table>
            </form>
        </article>
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