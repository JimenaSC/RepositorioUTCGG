<?php
    require('../../conexion.php');
    #Comprobar si hay un id
    if(isset($_POST["repositorio_id"])) {
        $query = $pdo->prepare("SELECT * FROM repositorios WHERE idRepositorio = :id");
        $query->execute(array(
            "id"    =>   $_POST["repositorio_id"]
        ));
        $row = $query->fetchAll();
        echo json_encode($row);
    }    
?>