<?php
    require('../../conexion.php');
    #Comprobar si hay un id
    if(isset($_POST["alumno_id"])) {
        $query = $pdo->prepare("SELECT * FROM alumnos WHERE idUsuario = :id");
        $query->execute(array(
            "id"    =>   $_POST["alumno_id"]
        ));
        $row = $query->fetchAll();
        echo json_encode($row);
    }    
?>