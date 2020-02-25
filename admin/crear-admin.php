<?php include('templates/head.php'); ?>
<!-- Site wrapper -->
<div class="wrapper">
  <!-- BARRA DE NAVEGACION -->
  <?php include('templates/barra_navegacion.php'); ?>
  
  <!-- BARRA LATERAL -->
  <?php include('templates/aside.php'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear administrador</h1>
            <small class="text-muted font-italic">Favor de llenar el formulario completo para registrar un nuevo administrador</small>
          </div>
        </div>
      </div>
    </section>

    <section class="content col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Nuevo administrador</h3>
            </div>
            <form class="form-horizontal" name="crear-admin" id="crear-admin">
                <div class="card-body">
                    <div class="card-body">
                        <!-- usuario -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="user" name="user" data-name="usuario" placeholder="Usuario">
                        </div>
                        <!-- contraseña -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" data-name="contraseña" placeholder="Contraseña">
                        </div>
                        <!-- nombre -->
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" data-name="nombre" placeholder="Escriba nombre completo...">
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button class="btn btn-outline-success" id="agregar_admin">Agregar</button>
                </div>
            </form>
        </div>
    </section>

  </div>

  <!-- FOOTER -->
  <?php include('templates/footer.php'); ?>

  <!-- PERSONALIZACION -->
  <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>