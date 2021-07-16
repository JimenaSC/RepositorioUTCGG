<?php
    require 'conexion.php';
    session_start();
    //Evaluamos si existe la variable de sesión id_usuario, si no existe redirigimos al index
    if(!isset($_SESSION["idUsuario"])){
        header("Location: ../index.php");
    }
    //asigno mi sesión a una variable para volver a comparar en el codigo
    $idUsuario = $_SESSION['idUsuario'];
    //Preparo mi consulta SQL
    $SQL = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario = ':idUsuario';");
    $SQL->execute(array(
        "idUsuario" => $idUsuario
    ));
    //Hacemos una variable de tipo asociativo
    $row = $SQL->fetch(PDO::FETCH_ASSOC);
    //Segun el tipo de usuario empezamos a redireccionar
    if($_SESSION['tipoUsuario']=="Administrador") 
    {
    header("Location: administrador/index.php");
    } 
    else if ($_SESSION['tipoUsuario']=="Alumno")  
    {
        header("Location: alumno/index.php");
    } 
    else if ($_SESSION['tipoUsuario']=="Docente")  
    {
        header("Location: docente/index.php");
    } 


?>