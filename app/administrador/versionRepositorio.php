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
    

    

   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="img/Logo.png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro | RepositorioUTCGG</title>
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
                <h4 class="card-header text-center">Registro de Repositorio</h4>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center">Listado de Repositorios</h5>
                        <br>
                        <div class=" d-flex justify-content-between align-items-center">

                            
                            <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success btn-lg">Agregar</button> 
						    
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4" style="width:100%; height:190px; overflow: scroll; overflow-x:hidden;">
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
                                <div class="col-md-4" style="width:100%; height:190px; overflow: scroll; overflow-x:hidden;">
                                    <h3>Filtrar por Tipo</h3>
                                    <?php

                                        $query = "SELECT DISTINCT * FROM proyecto  ORDER BY idProyecto ASC
                                        ";
                                        $stm = $pdo->prepare($query);
                                        $stm->execute();
                                        $result = $stm->fetchAll();
                                        foreach($result as $row)
                                        {
                                        ?>
                                        <div class="list-group-item checkbox" >
                                            <label><input type="checkbox" class="common_selector tipo" value="<?php echo $row['idProyecto']; ?>" > <?php echo $row['tipo']; ?></label>
                                        </div>
                                    <?php    
                                    }

                                    ?>
                                </div>
                                <div class="col-md-4" style="width:100%; height:190px; overflow: scroll; overflow-x:hidden;">
                                    <h3>Filtrar por Nivel</h3>
                                    
                                    <div class="list-group-item checkbox" >
                                        <label><input type="checkbox" class="common_selector nivel" value="TSU">TSU</label>
                                    </div>
                                    <div class="list-group-item checkbox" >
                                        <label><input type="checkbox" class="common_selector nivel" value="Ingenieria"> Ingenieria</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                        <div id="filter_data" class="table-responsive filter_data">
                                
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
    <script src="js/sweetalert.js"></script>
    <script src="js/mainVersion.js"></script>
</body>
</html>


<!-- ===========================================================================================================
                                        AGREGAR REPOSITORIO
=========================================================================================================== -->
<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">Nuevo Repositorio</h4>  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>       
                </div>  
                <div class="modal-body">  
                
                     <form method="post" action="uploadRepositorio.php" id="insert_form" enctype="multipart/form-data" onsubmit="return validar();">
                            <div class="form-row">
                                <label for="">Seleccionar Alumno</label>
                                <select name="alumno" id="alumno" class="form-control alumno">
                                    <option value="">Selecciona Alumno</option>
                                    <?php
                                        $query = $pdo->prepare("SELECT * FROM alumnos");
                                        $query->execute();
                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>   
                                        <option value="<?php echo $row['usuario']?>"><?php echo utf8_encode($row['nombre'].' '.$row['app'] . ' '.$row['apm'].' {'.$row['usuario'].'}')?></option>  
                                    <?php } ?>
                                </select>
                                <div class="form-group col-md-10">
                                    <label>Nombre repositorio</label>
                                    <input type="text" name="nrepositorio" id="nrepositorio" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Version</label>
                                    <input type="text" name="version" id="version" class="form-control" value="1" readonly>
                                </div>
                            </div>
                            <label>Descripcion</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control"></textarea>
                            <label for="">Archivo Sistema (Zip, RAR): Hasta 100MB</label>
                            <input type="file" name="fsistema" id="fsistema" class="form-control" accept=".zip,.rar,.7zip">
                            <label for="">Manual Tecnico (PDF, DOCX)</label>
                            <input type="file" name="mtecnico" id="mtecnico" class="form-control" accept="application/pdf, .doc,.docx," placeholder="">
                            <label for="">Manual de Usuario (PDF, DOC)</label>
                            <input type="file" name="musuario" id="musuario" class="form-control" accept="application/pdf, .doc,.docx,"> 
                            
                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Seleccionar tipo de proyecto</label>
                                    <select name="tipoproyecto" id="tipoproyecto" class="form-control tipoproyecto">
                                        <option value="">Selecciona el tipo de proyecto</option>
                                        <?php
                                            $query = $pdo->prepare("SELECT * FROM proyecto");
                                            $query->execute();
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        ?>   
                                            <option value="<?php echo $row['idProyecto']?>"><?php echo utf8_encode($row['tipo'])?></option>  
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Seleccionar Nivel de Proyecto</label>
                                    <select name="nvlproyecto" id="nvlproyecto" class="form-control nvlproyecto">
                                        <option value="">Selecciona el tipo de proyecto</option>
                                        <option value="Ingenieria">Ingenieria</option>
                                        <option value="TSU">TSU</option>
                                    </select>
                                </div>
                                <input type="hidden" name="repositorio_id" id="repositorio_id">
                            </div>
                            <br>                            
                </div>  
                <div class="modal-footer">  
                    <input type="submit" name="insert" id="insert" value="Insertar" class="btn btn-success" />  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </form>
                </div>   
           </div>  
      </div>  
</div>  

<!-- ===========================================================================================================
                                        ACTUALIZAR REPOSITORIO
=========================================================================================================== -->
<div id="add_files_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">Cargar Repositorio</h4>  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>       
                </div>  
                <div class="modal-body">  
                
                    <form method="post" action="updRepositorio.php" id="update_form" enctype="multipart/form-data" onsubmit="return validarUp();">
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label>Nombre repositorio</label>
                                    <input type="text" name="nrepositorio" id="nrepositorio" class="form-control nrepositorio" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Version</label>
                                    <input type="text" name="version" id="version" class="form-control version"  readonly>
                                </div>
                            </div>
                            <label for="">Archivo Sistema (Zip, RAR): Hasta 100MB</label>
                            <input type="file" name="fsistema" id="fsistema" class="form-control fsistema" accept=".zip,.rar,.7zip">
                            <label for="">Manual Tecnico (PDF, DOCX)</label>
                            <input type="file" name="mtecnico" id="mtecnico" class="form-control mtecnico" accept="application/pdf, .doc,.docx," placeholder="">
                            <label for="">Manual de Usuario (PDF, DOC)</label>
                            <input type="file" name="musuario" id="musuario" class="form-control musuario" accept="application/pdf, .doc,.docx,"> 
                            
                            <br>
                            <input type="hidden" name="repositorio_id" class="repositorio_id" id="repositorio_id">
                            <br>
                            
                </div>  
                <div class="modal-footer">  
                    <input type="submit" name="insert" id="insert" value="Insertar" class="btn btn-success" />  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                        </form>
                </div>   
           </div>  
      </div>  
</div>  


<!-- ===========================================================================================================
                                        Visualizar Repositorio
=========================================================================================================== -->
<div id="view_files_Modal" class="modal fade">  
      <div class="modal-dialog modal-lg">  
           <div class="modal-content ">  
                <div class="modal-header">  
                    <h4 class="modal-title">Visualizar Repositorio</h4>  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>       
                </div>  
                <div class="modal-body">  
                    <div class="view_repositories" id="view_repositories">
                    </div>
                </div>  
                <div class="modal-footer">  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>   
           </div>  
      </div>  
</div>  







<script>
    $(document).ready(function(){
        filter_data();
        function filter_data(){
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetchRepositorio';
            var carrera = get_filter('carrera');
            var tipo = get_filter('tipo');
            var nivel = get_filter('nivel');
            $.ajax({
                url:"app/fetchVersiones.php",
                method:"POST",
                data:{action:action, carrera:carrera, tipo:tipo,nivel:nivel},
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



<script>
    function validar() {
        if($('#alumno').val()==""){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'El usuario del alumno es requerido!'
            });
            return false;
        }else
        if($('#nrepositorio').val() == "")  
        {  
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'El nombre del repositorio es requerido!'
            });
            return false;
        }else if($('#fsistema').val() == ''){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'Archivo del sistema Requerido'
            });
            return false;
        }else if($('#tipoproyecto').val() == ''){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'Tipo de proyecto requerido'
            });
            return false;
        }else if($('#nvlproyecto').val() == ''){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'Nivel del proyecto requerido'
            });
            return false;
        }
    }
    function validarup() {
        if($('#fsistema').val() == ''){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'Archivo del sistema Requerido'
            });
            return false;
        }else if($('#tipoproyecto').val() == ''){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'Tipo de proyecto requerido'
            });
            return false;
        }else if($('#nvlproyecto').val() == ''){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                
            });
            
            Toast.fire({
                type: 'error',
                title: 'Nivel del proyecto requerido'
            });
            return false;
        }
    }
</script>
<style>
    #loading
    {
        text-align:center; 
        background: url('../loader.gif') no-repeat center; 
        height: 150px;
    }
</style>