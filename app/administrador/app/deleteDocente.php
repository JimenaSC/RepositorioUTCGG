<?php
    require('../../conexion.php');
    if(isset($_POST['docente_id'])) {
        $id = $_POST['docente_id'];
        $output = '';
        $query = $pdo->prepare("DELETE FROM usuario WHERE idUsuario = :id");
        $result = $query->execute(array(
            "id"    =>  $id
        ));
        if(!$result) {
            die('Query Failed');
        }else{
            echo('OK');
        }
    }