<?php
    require('../conexion.php');
    session_start();
    if(!isset($_SESSION["idUsuario"])){
        header("Location: ../welcome.php");
    }
    if($_SESSION['tipoUsuario']=="Alumno") {
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
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="img/icon1.png" width="100" height="50">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | Repositorio</title>
    <!-- SCRIPTS -->
    <script src="../../js/jquery.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="css/bootstrapd.css">
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
        <?php include('../sidebar-docente.html') ?>
        <!-- sidebar-container END -->

        <!-- SECCION MAIN -->
        <div class="col mt-5">
            <h1 class="text-center">
                
            </h1>
            <!-- CARD-->
            <div class="card">
                <h4 class="card-header text-center" style="height: rem;"> Inicio</h4>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Bienvenid@ Docente</h2>
                        <br>
                        <h3 class="text-center"><?php echo $nombre .' '. $app . ' ' . $apm  ?></h3>
                    </div>
                </div>
                <div class="HomeCategories">
                    <div class="HomeCategories-container">
                        <div class="HomeCategories-items">
                            <div class="HomeCategories-item HomeCategories-desarrollo">
                                <div class="HomeCategories-badge" style="background-color:#33b13a">
                                <i class="fas fa-folder" style="color:  #FFFFFF "></i>
                                </div>
                                <div class="HomeCategories-category">
                                    <h2>Registrar Repositorio</h2>
                                </div><a href="registroRepositorio.php"></a>
                            </div>

                            <div class="HomeCategories-item HomeCategories-crecimiento-profesional">
                                <div class="HomeCategories-badge" style="background-color:#007500">
                                  <i class="fas fa-graduation-cap" style="color:  #FFFFFF "></i>
                                </div>
                                <div class="HomeCategories-category">
                                    <h2>Registrar Alumnos</h2>
                                </div><a href="alumnos.php"></a>
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
  color: #4a4a4a; /* COLOR DE LAS LETRAS*/
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
/* efecto de deslizado
.HomeCategories-desarrollo:before {
  background: #33b13a; /*COLOR DEL DESLISABLE REPOSITORIO */
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
/* efecto de deslizado
.HomeCategories-crecimiento-profesional:before {
  background: #cb161d; /*COLOR DEL DESLISABLE ALUMNOS */
}
.HomeCategories-marketing:before {
  background: #29b8e8;
}
.HomeCategories-item {
  display: grid;
  grid-template-columns: 64px auto;
  background-color: #f6f6f6;
  /*-webkit-border-radius: 6px;
  border-radius: 6px; bordes totales de las categorias*/
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
  /*-webkit-border-radius: 6px;
  border-radius: 6px; */
  box-shadow: 0 0 0 0.2rem rgba(227, 228, 232 );
  color: ;
}
.HomeCategories-item:hover:before {
  -webkit-transform: scaleX(1);
  -moz-transform: scaleX(1);
  -o-transform: scaleX(1);
  -ms-transform: scaleX(1);
  transform: scaleX(1);
  /*-webkit-border-radius: 6px;
  border-radius: 6px; bordes de las categorias*/
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
  /*-webkit-border-radius: 6px 0 0 6px; */
  /*border-radius: 6px 0 0 6px; bordes de las categorias*/
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
