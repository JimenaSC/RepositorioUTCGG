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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="img/icon1.png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alumnos | Repositorio</title>
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
                <h4 class="card-header text-center">Registro de alumnos</h4>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <br>
                            <div align="right">
                                <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success">Agregar</button> 
                                <br>
                                <br> 
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6" style="width:100%; height:190px; overflow: scroll; overflow-x:hidden;">
                                        <h3>Filtrar por Carrera</h3>
                                        <?php

                                            $query = "SELECT DISTINCT * FROM carrera  ORDER BY idCarrera ASC
                                            ";
                                            $statement = $pdo->prepare($query);
                                            $statement->execute();
                                            $result = $statement->fetchAll();
                                            foreach($result as $row)
                                            {
                                            ?>
                                            <div class="list-group-item checkbox" >
                                                <label><input type="checkbox" class="common_selector carrera" value="<?php echo $row['idCarrera']; ?>" > <?php echo $row['carrera']; ?></label>
                                            </div>
                                        <?php    
                                        }

                                        ?>
                                    </div>
                                    <div class="col-md-6" style="width:100%; height:190px; overflow: scroll; overflow-x:hidden;">
                                        <h3>Filtrar por Cuatrimestre</h3>
                                        <?php

                                            $query = "SELECT DISTINCT * FROM cuatrimestre  ORDER BY idCuatrimestre ASC
                                            ";
                                            $stm = $pdo->prepare($query);
                                            $stm->execute();
                                            $result = $stm->fetchAll();
                                            foreach($result as $row)
                                            {
                                            ?>
                                            <div class="list-group-item checkbox" >
                                                <label><input type="checkbox" class="common_selector cuatri" value="<?php echo $row['idCuatrimestre']; ?>" > <?php echo $row['cuatrimestre']; ?></label>
                                            </div>
                                        <?php    
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="filter_data"></div>
                            <div id="docentes_table">
                                
                            </div>
                        </div> <!--END TABLE RESPONSIVE-->
                    </div> <!--END ROW-->
                </div> <!-- END CARD BODY -->
            </div> <!-- END CARD -->
          </div><!-- Main Col END -->
    </div> 
    <!-- BODY ROW END -->
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="js/sidebar.js"></script>
    <script src="js/mainAlumnos.js"></script>
    <script src="js/sweetalert.js"></script> <!-- aqui esta la alerta superior-->
</body>
</html>




<!-- ===========================================================================================================
                                        AGREGAR Y ACTUALIZAR
=========================================================================================================== -->
<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog modal-lg">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">Alumno</h4>  
                    <button type="button" class="close" data-dismiss="modal"><i class="far fa-times-circle"></i></button>       
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                            <label style="font-weight: 600;">Nombre (s)</label>  
                            <input type="text" name="alumno" id="alumno" class="form-control" placeholder="Ingresa tu Nombre aquí"/>  
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-center" style="font-weight: 600;" for="">Apellido Paterno</label>
                                    <input type="text" name="app" id="app" class="form-control" placeholder="Ingresa tu Apellido Paterno aquí">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-center" style="font-weight: 600;" for="">Apellido Materno</label>
                                    <input type="text" name="apm" id="apm" class="form-control" placeholder="Ingresa tu Apellido Materno aquí">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-center" style="font-weight: 600;" for="">Usuario</label>
                                    <input type="text" name="user" id="user" class="form-control" placeholder="Usuario">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-center" style="font-weight: 600;" for="">Contraseña</label>
                                    <input type="password" name="pass" id="pass" class="form-control" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label style="font-weight: 600;">Carrera</label>
                                    <select name="carrera" id="carrera" class="form-control carrera">
                                        <option value="">Selecciona una opción</option>
                                        <?php
                                            $query = $pdo->prepare("SELECT * FROM carrera");
                                            $query->execute();
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>   
                                            <option value="<?php echo $row['idCarrera']?>"><?php echo utf8_encode($row['carrera'])?></option>  
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label style="font-weight: 600;">Cuatrimestre</label>
                                    <select name="cuatri" id="cuatri" class="form-control cuatri">
                                        <option value="">Selecciona una opción</option>
                                        <?php
                                            $query = $pdo->prepare("SELECT * FROM cuatrimestre");
                                            $query->execute();
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>   
                                            <option value="<?php echo $row['idCuatrimestre']?>"><?php echo utf8_encode($row['cuatrimestre'])?></option>  
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <input type="hidden" name="alumno_id" id="alumno_id">
                </div>  
                    
                <div class="modal-footer">  
                    <input type="submit" name="insert" id="insert" value="Agregar" class="btn btn-success"  />  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>  
                        </form>
                </div>   
           </div>  
      </div>  
</div>  

<!-- GIF de cargando-->
<style>
    #loading
    {
        text-align:center; 
        background: url('../loader4.gif') no-repeat center; 
        height: 150px;
    }
</style>


 <script>
    $(document).ready(function(){
        filter_data();
        function filter_data(){
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetchAlumno';
            var carrera = get_filter('carrera');
            var cuatri = get_filter('cuatri');
            $.ajax({
                url:"app/fetchAlumnos.php",
                method:"POST",
                data:{action:action, carrera:carrera, cuatri:cuatri},
                success:function(data){
                    $('.filter_data').html(data);
                    //$('#docentes_table').html(data);
                }
            });
        }
        function get_filter(class_name)
        {
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }
        $('.common_selector').click(function(){
            filter_data();
        });
    });
 </script>