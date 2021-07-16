<?php
    require('../../conexion.php');
    #Comprobar si hay un id
    if(isset($_POST["docente_id"])) {
        $query = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario = :id");
        $query->execute(array(
            "id"    =>   $_POST["docente_id"]
        ));
        $row = $query->fetchAll();
        echo json_encode($row);
    }    
?>