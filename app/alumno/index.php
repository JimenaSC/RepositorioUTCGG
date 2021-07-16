<?php
    require('../conexion.php');
    session_start();
    if(!isset($_SESSION["idUsuario"])){
        header("Location: ../welcome.php");
    }

    
    //VERIFICAR SI ESTA LA CARPETA DEL USUARIO
    $idUsuario = $_SESSION['idUsuario'];
    $Sql = $pdo->prepare("SELECT * FROM alumnos WHERE idUsuario = :id");
    $Sql->execute(array(
        "id"    =>  $idUsuario
    ));
    //TRAER LOS DATOS QUE SE NECESITAN PARA VERIFICAR SI EXISTE UNA CARPETA CON EL NOMBRE
    $row = $Sql->fetch(PDO::FETCH_ASSOC);
    $usuario    =   $row['usuario'];
    $nombre     =   $row['nombre'];
    $app        =   $row['app'];
    $apm        =   $row['apm'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="img/Logo.png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DASHBOARD | RepositorioUTCGG</title>
    <!-- SCRIPTS -->
    <script src="../../js/jquery.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="../../css/bootstrap4.3.css">
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap4.3.js"></script>   
</head>
<body>

    <!-- INCLUSION DE NAVBAR -->
    <?php include('../navbar.html')?>
    <!-- FIN INCLUSION NAVBAR -->

    <!-- BOOTSTRAP ROW -->
    <div class="row" id="body-row">
        <!-- INICIO SIDEBAR -->
        <?php include('../sidebar-user.html') ?>
        <!-- sidebar-container END -->

        <!-- SECCION MAIN -->
        <div class="col mt-5">
            <h1 class="text-center">
                
            </h1>
            <!-- CARD-->
            <div class="card">
                <h4 class="card-header text-center">DASHBOARD</h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12"> 
                            <h2 class="text-center">Bienvenido(a) alumno</h2>
                            <h3 class="text-center"><?php echo $nombre .' '. $app . ' ' . $apm  ?></h3>
                            <br>
                        </div>
                        <br>
                        <br>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><a href="registroRepositorio.php" class="btn btn-success btn-block">Registrar Repositorio</a></div>
                        <div class="col-md-4"></div>
                    </div>
                </div> <!-- END CARD BODY -->
            </div> <!-- END CARD -->
          </div><!-- Main Col END -->
    </div> 
    <!-- BODY ROW END -->
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="js/sidebar.js"></script>
</body>
</html>

