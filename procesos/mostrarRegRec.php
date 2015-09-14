<?php
    if (isset($_SESSION['usuario']) && $_SESSION['tipo'] == 1){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Validando</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php 
        include("/conexion.php");
        if(empty($_POST['salon']) && empty($_POST['hub']) && empty($_POST['cap']) && empty($_POST['om']) && empty($_POST['em']) && empty($_POST['obs'])){
                $query = mysqli_query($connect, "SELECT * FROM salones ORDER BY id ASC");
                }
                else{
                    if(isset($_POST['salon'])){
                        $query = mysqli_query($connect, "SELECT * FROM salones ORDER BY salon ASC");
                    }else{
                        if(isset($_POST['hub'])){
                            $query = mysqli_query($connect, "SELECT * FROM salones ORDER BY hub_salon ASC");
                        } 
                        else{
                            if(isset($_POST['cap'])){
                                $query = mysqli_query($connect, "SELECT * FROM salones ORDER BY capacidad ASC");
                            }else{
                                if(isset($_POST['om'])){
                                    $query = mysqli_query($connect, "SELECT * FROM salones ORDER BY otro_mov ASC");
                                }else{
                                    if(isset($_POST['em'])){
                                        $query = mysqli_query($connect, "SELECT * FROM salones ORDER BY eq_mm ASC");
                                    }else{
                                        if(isset($_POST['obs'])){
                                            $query = mysqli_query($connect, "SELECT * FROM salones ORDER BY observaciones ASC");
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $rows = mysqli_num_rows($query);
        ?>
    </body>
</html>
<?php
}
    else{
        echo '<script> window.location = "../index.php"; </script>';
    }
?> 