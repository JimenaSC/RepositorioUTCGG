<?php
    require('../../conexion.php');
    if(isset($_POST['alumno_id'])) {
        $id = $_POST['alumno_id'];
        $output = '';
        $query = $pdo->prepare("DELETE FROM alumnos WHERE idUsuario = :id");
        $result = $query->execute(array(
            "id"    =>  $id
        ));
        if(!$result) {
            die('Query Failed');
        }else{
            echo('OK');
        }
    }