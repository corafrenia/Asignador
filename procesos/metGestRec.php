<?php
session_start();
include("/conexion.php");
    if(isset($_POST['guardar'])){
        $salon=$_POST['salon'];
        $hub=$_POST['hub_salon'];
        $cap=$_POST['capacidad'];
        $otro_mov=$_POST['otro_mov'];
        $eq_mm=$_POST['eq_mm'];
        $obs=$_POST['observaciones'];
        mysqli_query($connect, "INSERT INTO salones (`id`, `salon`, `hub_salon`, `capacidad`, `otro_mov`, `eq_mm`, `observaciones`) VALUES  (NULL, '$salon', '$hub', '$cap', '$otro_mov', '$eq_mm', '$obs')") or die ("problemas al insertar datos");
        echo '<script> alert("Registro almacenado correctamente."); </script>';
        echo '<script> window.location = "../vistasAdmin/gestRec.php"; </script>';
    }
?>