<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="css/estilo.css" />
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="http://www.uv.mx/favicon.ico" type="image/x-icon" />
        <title>Asignacion de aulas - UV</title>
        
    </head>
    <body>
        <header>
            <section class="encabezado">
                <div id="barra" >Universidad Veracruzana</div>
            </section>
                <div id="fac">
                    <a href="https://www.uv.mx/orizaba/medicina/" id="regresar" href=""></a>Sistema de Asignación de Aulas.</div>
        </header>
        <article>
            <form  id="formulario" action="procesos/valog.php" method="POST">
                <table align="center">
                    <tr>
                        <td>Usuario: </td><td><input type="text" name="usuario" class=campos required /></td>
                    </tr>
                    <tr>
                        <td>Contraseña: </td><td><input type="password" name="psw" class=campos required/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="login" class=boton /></td>
                    </tr>
                </table>
            </form>
        </article>
        <?php
        // put your code here
        ?>
        <footer>
            
        </footer>
    </body>
</html>
