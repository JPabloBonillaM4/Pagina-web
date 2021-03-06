<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link d-flex flex-column align-items-center pl-0">
        <img src="img/AdminLTELogo.png"
            alt="Admin Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Administrador <b>GDLWebCamp</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel my-3 pb-3 d-flex flex-column align-items-center pr-3">
            <div class="image">
                <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info d-flex flex-column text-center w-75">
                <a href="#" class="d-block" style="white-space: normal;"><?php echo $_SESSION['data_user']['nombre']; ?></a>
                <div class="btn-group btn-group-toggle w-100">
                    <a class="btn btn-outline-info btn-sm">Información</a>
                    <a class="btn btn-outline-danger btn-sm" href="./login.php?session_close=true">Log out</a>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="admin-main.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Datos</p>
                        </a>
                    </ul>
                </li>
                
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                        Eventos
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="list-events.php" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Ver todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crear-events.php" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                        Categoria Eventos
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="list-categories.php" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Ver todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crear-categorie.php" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                        Invitados
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="list-invitados.php" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Ver todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crear-invitado.php" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Registrados
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="list-registers.php" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Ver todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crear-registers.php" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if($_SESSION['data_user']['nivel'] == 1): ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                            Administradores
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="list-admin.php" class="nav-link">
                                    <i class="fas fa-list-alt nav-icon"></i>
                                    <p>Ver todos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="crear-admin.php" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Agregar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p>
                        Testimoniales
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Ver todos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Agregar</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
