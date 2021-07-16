
<!-- INICIO SIDEBAR -->
<div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group sticky-top sticky-offset">

            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>MAIN MENU</small>
            </li>
            <!-- /END Separator -->

            <!-- MENU Y SUBMENU #1 -->
            <!-- Menu with submenu -->
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span> 
                    <span class="menu-collapsed">Dashboard</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>

            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="../welcome.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Dashboard</span>
                </a>
            </div>


            <!-- MENU Y SUBMENU #2 -->
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-cogs fa-fw mr-3"></span>
                    <span class="menu-collapsed">Configuraciones</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>

            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="usuarios.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Administradores</span>
                </a>
                <a href="alumnos.php" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Alumnos</span>
                </a>
            </div>
            <!-- MENU INTERNO #3 -->
            <a href="docentes.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-users fa-fw mr-3"></span>
                    
                    <span class="menu-collapsed">Docentes</span>    
                </div>
            </a>

            
            <!-- SECCION 2 MENU -->
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPTIONS</small>
            </li>
            <!-- /END Separator -->
            <a href="registroRepositorio.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">Registro repositorios</span>
                </div>
            </a>
            <a href="versionRepositorio.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-file fa-fw mr-3"></span>
                    <span class="menu-collapsed">Version Repositorios</span>
                </div>
            </a>


            <!-- SECCION #3 -->
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>            
            <!-- /END Separator -->
            <!-- MENU Y SUBMENU #2 -->
            <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Help</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>

            <!-- Submenu content -->
            <div id='submenu4' class="collapse sidebar-submenu">
                <a href="../docs/manual de usuario SCV.pdf" class="list-group-item list-group-item-action bg-dark text-white" target="_blank">
                    <span class="menu-collapsed">Manual de Usuario</span>
                </a>
            </div>
            <!-- Submenu content -->
            <div id='submenu4' class="collapse sidebar-submenu">
                <a href="../docs/SCV  manual tecnico_impri.pdf" class="list-group-item list-group-item-action bg-dark text-white" target="_blank">
                    <span class="menu-collapsed">Manual Tecnico</span>
                </a>
            </div>

            <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Hide</span>
                </div>
            </a>
            <!-- Logo -->
            <li class="list-group-item logo-separator d-flex justify-content-center">

                <img src='img/Logo.png' width="45" height="45" />    
            </li> 
        </ul><!-- List Group END-->
    </div>
    <!-- sidebar-container END -->