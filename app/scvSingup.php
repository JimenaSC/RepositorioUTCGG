<?php
    require('conexion.php');
    sleep(2);
    if(!empty($_POST)){
        $output         =   '';  
        $nombre         =   $_POST['alumno'];
        $app            =   $_POST['app'];
        $apm            =   $_POST['apm'];
        $usuario        =   $_POST['user'];
        $pass           =   $_POST['pass'];
        $carrera        =   $_POST['carrera'];
        $cuatrimestre   =   $_POST['cuatri'];
        $tipoUsuario    =   3;
        //comprobamos si hay algun usuario con el nombre que se nos especifica
        $comprobar = $pdo->prepare("SELECT * FROM alumnos WHERE usuario = :com_us");
        $comprobar->execute(array(
            "com_us"    =>  $usuario
        ));
        $countRow = $comprobar->rowCount();
        if($countRow > 0){
            echo "EXIST";
        }else{
            #coprobamos si hay algun id, si es asi, entonces es una actualizacion
            $sql = $pdo->prepare("INSERT INTO alumnos(nombre,app,apm,usuario,pass,id_cuatrimestre,id_tipoUsuario,idCarrera) VALUES(:nombre,:app,:apm,:usuario,:pass,:cuatri,:tipoUsuario,:idCarrera)");
            $result = $sql->execute(array(
                "nombre"        =>  $nombre,
                "app"           =>  $app,
                "apm"           =>  $apm,
                "usuario"       =>  $usuario,
                "pass"          =>  $pass,
                "tipoUsuario"   =>  $tipoUsuario,
                "idCarrera"     =>  $carrera,
                "cuatri"        =>  $cuatrimestre
            ));
            #comprobacion rapida
            if($result){
                echo 'OK';
            }else{
                echo 'NO';
            }
        }
        
    }
?>