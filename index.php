<?php
    include('app/conexion.php');
    session_start();
    //session_destroy();
    if(isset($_SESSION["idUsuario"])){
        header("Location: app/welcome.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/iconUT.png" type="image/x-icon">
    <title>Iniciar sesión || Repositorio</title>
    <!-- Styles CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/boo.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    

</head>
<body>
    <div class="error">
        <span>Datos de ingreso no válidos, inténtalo de nuevo por favor</span>
    </div>

    <div class="modal-dialog text-center" style="text-align:center">
        <div class="col-sm-10 main">
            <div class="modal-content">
                <!--<div class="col-12 user-img">
                    <img src="img/user2.png" alt="UserExample">
                </div>-->
                <div  class="inicio-s">
                    <span style="font-size: 18px; font-weight: 750;">Iniciar Sesión</span>
                </div>
                <div class="user-img">
                    <img src = img/logout2.png > 
                </div>
                <form action="" method="POST" id="formlg" style="Poppins"  class="form-group col-12">
                    <div class="form-group">
                        <input type="text" name="userform" id="userform" class="form-control" placeholder="Usuario / User" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passform" id="passform" class="form-control" placeholder="Contraseña / Password" required>
                    </div>
                    <div class="form-group">
                        <select name="typeuser" id="typeuser" class="typeuser form-control" required>
                            <option value="">Tipo de acceso</option>
                            <option value="general">Alumnos</option>
                            <option value="usuario">Administradores/Docentes</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" style="font-weight: 600;" value="Iniciar Sesión" class="form-control btn btn-success" id="btnform">
                    </div>
                    <p style="color: #232729; font-size: 13px; ">¿Eres nuevo Estudiante? <span><a href="singup.php" style="color: #00BD00;"> Registrate Aquí</a></span></p>
                </form>
            </div>
        </div>
    </div>



    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/main2.js"></script>
    
    
</body>
</html>