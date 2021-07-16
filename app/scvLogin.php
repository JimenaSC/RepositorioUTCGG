<?php
    require('conexion.php');
    session_start();
	//Comprobamos si hay una sesion abierta, si es así el cliente no podrá entrar al Login
	if(isset($_SESSION["idUsuario"]) && isset($_SESSION["idUsuario"])){
		header("Location: welcome.php");
	}
    sleep(2);
    $usuario    =   $_POST['user'];
    $password   =   $_POST['pass'];
    $typeuser   =   $_POST['typeuser'];
    $bandera    =   false;
    if($typeuser == "usuario"){
        $usuarios = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario AND pass= :password");
    }else if($typeuser == "general"){
        $usuarios = $pdo->prepare("SELECT * FROM alumnos WHERE usuario = :usuario AND pass= :password");
    }
    
    $usuarios->execute(array(
        "usuario"   =>  $usuario,
        "password"  =>  $password
    ));
	$rowUsuario = $usuarios->rowCount();
    if ($rowUsuario > 0):
        $bandera = true;
        
        $json = array();
        while($row = $usuarios->fetch(PDO::FETCH_ASSOC)){
            $_SESSION['idUsuario'] = $row['idUsuario'];
            if($row['id_tipoUsuario'] == 1){
                $_SESSION['tipoUsuario'] = "Administrador";
            }else if($row['id_tipoUsuario'] == 2){
                $_SESSION['tipoUsuario'] = "Docente";
            }else if($row['id_tipoUsuario'] == 3){
                $_SESSION['tipoUsuario'] = "Alumno";
            }
		    
            $json[] = array(
                'usuario' => $row['usuario'],
                'pass' => $row['pass'],
                'tipo' => $_SESSION['tipoUsuario'],
                'id' => $row['idUsuario'],
                'bandera' => $bandera
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    else:
        $json = array();
        $bandera = false;
        $json[] = array(
            'usuario' => $usuario,
            'pass' => $password,
            'bandera' => $bandera
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;      
    endif;
 ?>
