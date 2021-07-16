<?php
    require_once('conexion.php');
    session_start();
    //CERRAMOS SESION PARA DIRECCIONAR
    session_destroy();

    header("Location: welcome.php");
?>