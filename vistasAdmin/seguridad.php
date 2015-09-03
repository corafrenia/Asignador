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
        <div id="fac"><a id="regresar" href="../vistasAdmin/administrador.php"></a>Cambio de Contraseña</div>
        <nav>
            <ul>
                <li><a class="uno" title="seg" href="../vistasAdmin/seguridad.php">Seguridad</a></li>
                <li><a class="dos" title="aulas" href="">Asignacion de Aulas</a></li>
                <li><a class="tres" title="" href="">Horarios Docentes</a></li>
            </ul>
        </nav> 
    </header>
    <body>
        <article>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Ingrese su contraseña actual:</td>
                        <td><input type="password" name="pwsac" class="campos" /></td>
                    </tr>
                    <tr>
                        <td>Ingrese su nueva contraseña:</td>
                        <td><input type="password" name="pwsnue" class="campos" /></td>
                    </tr>
                    <tr>
                        <td>Repita nueva contraseña:</td>
                        <td><input type="password" name="pwsnue" class="campos" /></td>
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