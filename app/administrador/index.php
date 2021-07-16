<?php
    require('../conexion.php');
    session_start();
    if(!isset($_SESSION["idUsuario"])){
        header("Location: ../welcome.php");
    }
    if($_SESSION['tipoUsuario']=="Alumno") {
		header("location: ../welcome.php");
    }
    if($_SESSION['tipoUsuario']=="Docente") {
		header("location: ../welcome.php");
    }
    $idUsuario = $_SESSION['idUsuario'];
    $Sql = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario = :id");
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
        <?php include('../sidebar.php') ?>
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
                        <h2 class="text-center">Bienvenido(a) Administrador</h2>
                        <br>
                        <h3 class="text-center"><?php echo $nombre .' '. $app . ' ' . $apm  ?></h3>
                    </div>
                </div>
                <div class="HomeCategories">
                    <div class="HomeCategories-container">
                        <div class="HomeCategories-items">
                            <div class="HomeCategories-item HomeCategories-desarrollo">
                                <div class="HomeCategories-badge" style="background-color:#33b13a"><img loading="lazy"
                                        src="https://static.platzi.com/bff/image/ico-desarrollo-fa207491a4cb7b6be3e3ab41b1fecced.png"
                                        alt="Desarrollo e ingeniería"></div>
                                <div class="HomeCategories-category">
                                    <h2>Registrar Repositorio</h2>
                                </div><a href="registroRepositorio.php"></a>
                            </div>
                            <div class="HomeCategories-item HomeCategories-negocios">
                                <div class="HomeCategories-badge" style="background-color:#f5c443"><img loading="lazy"
                                        src="https://static.platzi.com/bff/image/ico-negocios-dc4144d0713e6155b9b955fbccf91a29.png"
                                        alt="Negocios y emprendimiento"></div>
                                <div class="HomeCategories-category">
                                    <h2>Docentes</h2>
                                </div><a href="docentes.php"></a>
                            </div>
                            <div class="HomeCategories-item HomeCategories-crecimiento-profesional">
                                <div class="HomeCategories-badge" style="background-color:#cb161d"><img loading="lazy"
                                        src="https://static.platzi.com/bff/image/ico-crecimiento-ef17081ac63f53c197ec0f78653389f3.png"
                                        alt="Crecimiento Profesional"></div>
                                <div class="HomeCategories-category">
                                    <h2>Alumnos</h2>
                                </div><a href="alumnos.php"></a>
                            </div>
                            <div class="HomeCategories-item HomeCategories-produccion-audiovisual">
                                <div class="HomeCategories-badge" style="background-color:#fa7800"><img loading="lazy"
                                        src="https://static.platzi.com/bff/image/ico-audiovisual-c1b62eacf0b272116d683243cd490685.png"
                                        alt="Producción Audiovisual"></div>
                                <div class="HomeCategories-category">
                                    <h2>Administradores</h2>
                                </div><a href="usuarios.php"></a>
                            </div>
                        </div>
                    </div>
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

<style>
.HomeCategories {
  padding: 1em 1em 2em 1em;
  color: #4a4a4a;
}
@media only screen and (min-width: 48em) {
  .HomeCategories {
	padding: 1.5em 1em;
  }
}
.HomeCategories-container {
  grid-template-columns: minmax(auto, 1024px);
  display: grid;
  -webkit-box-pack: center;
  -moz-box-pack: center;
  -o-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
}
@media only screen and (min-width: 64em) {
  .HomeCategories-container {
	grid-template-columns: minmax(auto, 936px);
  }
}
@media only screen and (min-width: 75em) {
  .HomeCategories-container {
	grid-template-columns: minmax(auto, 1024px);
  }
}
.HomeCategories-items {
  display: grid;
  grid-template-columns: 1fr;
  grid-gap: 1rem;
  grid-row-gap: 0.5em;
  grid-auto-rows: 1fr;
  -webkit-box-align: center;
  -moz-box-align: center;
  -o-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}
@media only screen and (min-width: 48em) {
  .HomeCategories-items {
	grid-template-columns: 1fr 1fr;
	grid-gap: 2rem;
	grid-row-gap: 0.5em;
  }
}
@media only screen and (min-width: 64em) {
  .HomeCategories-items {
	grid-template-columns: repeat(3, 1fr);
	grid-gap: 1.5rem;
	grid-row-gap: 0.5em;
  }
}
.HomeCategories-desarrollo:before {
  background: #33b13a;
}
.HomeCategories-diseno:before {
  background: #6b407e;
}
.HomeCategories-negocios:before {
  background: #f5c443;
}
.HomeCategories-produccion-audiovisual:before {
  background: #fa7800;
}
.HomeCategories-crecimiento-profesional:before {
  background: #cb161d;
}
.HomeCategories-marketing:before {
  background: #29b8e8;
}
.HomeCategories-item {
  display: grid;
  grid-template-columns: 64px auto;
  background-color: #f6f6f6;
  -webkit-border-radius: 6px;
  border-radius: 6px;
  position: relative;
  -webkit-transition: 0.2s;
  -moz-transition: 0.2s;
  -o-transition: 0.2s;
  -ms-transition: 0.2s;
  transition: 0.2s;
  cursor: pointer;
  z-index: 0;
  height: 100%;
}
.HomeCategories-item:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  -webkit-transform: scaleX(0);
  -moz-transform: scaleX(0);
  -o-transform: scaleX(0);
  -ms-transform: scaleX(0);
  transform: scaleX(0);
  -webkit-transform-origin: 0 50%;
  -moz-transform-origin: 0 50%;
  -o-transform-origin: 0 50%;
  -ms-transform-origin: 0 50%;
  transform-origin: 0 50%;
  -webkit-transition: -webkit-transform 0.3s ease-out;
  -moz-transition: -moz-transform 0.3s ease-out;
  -o-transition: -o-transform 0.3s ease-out;
  -ms-transition: -ms-transform 0.3s ease-out;
  transition: transform 0.3s ease-out;
  margin-left: 6px;
}
.HomeCategories-item:hover {
  -webkit-border-radius: 6px;
  border-radius: 6px;
  color: #fff;
}
.HomeCategories-item:hover:before {
  -webkit-transform: scaleX(1);
  -moz-transform: scaleX(1);
  -o-transform: scaleX(1);
  -ms-transform: scaleX(1);
  transform: scaleX(1);
  -webkit-border-radius: 6px;
  border-radius: 6px;
}
.HomeCategories-item a {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  color: #fff;
  text-decoration: none;
}
.HomeCategories-badge {
  background-color: #33b13a;
  -webkit-border-radius: 6px 0 0 6px;
  border-radius: 6px 0 0 6px;
  display: -webkit-box;
  display: -moz-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: box;
  display: flex;
  -webkit-box-pack: center;
  -moz-box-pack: center;
  -o-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -moz-box-align: center;
  -o-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}
.HomeCategories-badge img {
  width: 32px;
}
.HomeCategories-category {
  padding: 12px;
  cursor: pointer;
  -webkit-border-radius: 6px;
  border-radius: 6px;
  -webkit-align-self: center;
  align-self: center;
  -ms-flex-item-align: center;
}
.HomeCategories-category h2 {
  font-size: 16px;
  font-weight: bold;
}
@media only screen and (min-width: 48em) {
  .HomeCategories-category h2 {
	font-size: 18px;
  }
}
.HomeCategories-category span {
  font-size: 12px;
  font-weight: 500;
}
@media only screen and (min-width: 64em) {
  .HomeCategories-category span {
	font-size: 14px;
  }
}
</style>
