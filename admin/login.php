<?php include('templates/head.php'); ?>

    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../index.php"><b>GDL</b>WebCamp</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Ingresa para iniciar sesión</p>
                    <form name="login-admin-form" id="login-admin">
                        <div class="input-group mb-3">
                            <input type="text" autocomplete="off" class="form-control" name="correo_usuario" id="correo_usuario" data-name="Correo o usuario" placeholder="Correo / Usuario">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" data-name="contraseña" class="form-control" placeholder="Contraseña">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <div class="input-group-append">
                                <button id="show_password" class="btn btn-info" type="button"> 
                                    <span class="fa fa-eye-slash icon_show_password"></span> 
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <input type="hidden" name="login_admin" id="login_admin" value="1">
                                <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
<?php include('templates/foot.php'); ?>