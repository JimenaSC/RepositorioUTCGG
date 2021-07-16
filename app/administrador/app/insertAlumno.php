<?php
    require('../../conexion.php');
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
        $id             =   $_POST['alumno_id'];

        #coprobamos si hay algun id, si es asi, entonces es una actualizacion
        if($id != '') {
            //comprobamos si hay algun usuario con el nombre que se nos especifica
            $comprobar = $pdo->prepare("SELECT * FROM alumnos WHERE usuario = :com_us");
            $comprobar->execute(array(
                "com_us"    =>  $usuario
            ));
            $countRow = $comprobar->rowCount();
            if($countRow > 0){
                echo "EXIST";
            }else{
                $sql = $pdo->prepare("UPDATE alumnos SET
                    nombre          =   :nombre,
                    app             =   :app,
                    apm             =   :apm,
                    usuario         =   :usuario,
                    pass            =   :pass,
                    idCarrera       =   :carrera,
                    id_cuatrimestre =   :cuatri,
                    id_tipoUsuario  =   :tipoUsuario
                    WHERE idUsuario  =   :id
                ");
                
                #EJECUTAMOS LA CONSULTA DE ACTUALIZACION
                $result = $sql->execute(array(
                    "nombre"        =>  $nombre,
                    "app"           =>  $app,
                    "apm"           =>  $apm,
                    "usuario"       =>  $usuario,
                    "pass"          =>  $pass,
                    "tipoUsuario"   =>  $tipoUsuario,
                    "carrera"       =>  $carrera,
                    "cuatri"        =>  $cuatrimestre,
                    "id"            =>  $id
                ));
                if($result){
                    echo 'OK';
                }else{
                    echo 'NO';
                }
            }
           
        }else{
            //comprobamos si hay algun usuario con el nombre que se nos especifica
            $comprobar = $pdo->prepare("SELECT * FROM alumnos WHERE usuario = :com_us");
            $comprobar->execute(array(
                "com_us"    =>  $usuario
            ));
            $countRow = $comprobar->rowCount();
            if($countRow > 0){
                echo "EXIST";
            }else{
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
        
    }
?>