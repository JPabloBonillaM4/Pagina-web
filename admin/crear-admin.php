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
            <small class="font-italic text-danger"> <span>*</span> Favor de llenar el formulario completo para registrar un nuevo administrador</small>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="card card-info col-md-6 m-0">
          <div class="card-header">
              <h3 class="card-title">Nuevo administrador</h3>
          </div>
          <div class="card-body">
            <form class="form-horizontal" name="crear-admin" id="crear-admin">
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
                  <div class="input-group-append">
                    <button id="show_password" class="btn btn-info" type="button"> <span class="fa fa-eye-slash icon_show_password"></span> </button>
                  </div>
              </div>
              <!-- correo -->
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-at"></i></span>
                  </div>
                  <input type="mail" class="form-control" id="email" name="email" data-name="correo electrónico" placeholder="Correo electrónico">
              </div>
              <!-- nombre -->
              <div class="form-group">
                  <label for="name">Nombre:</label>
                  <input type="text" class="form-control" id="name" name="name" data-name="nombre" placeholder="Escriba nombre completo...">
              </div>
              <input type="hidden" name="agregar-admin" value="1" id="agregar-admin" data-name="agregar-admin">
            </form>
          </div>
          <div class="card-footer d-flex justify-content-center">
            <button class="btn btn-outline-success" id="agregar_admin">Agregar</button>
          </div>
        </div>
        <div class="col-md-6">
          <img class="img-fluid" src="img/admins.gif" alt="imagen-administador">
        </div>
      </div>
    </section>
  </div>

  <!-- FOOTER -->
  <?php include('templates/footer.php'); ?>

  <!-- PERSONALIZACION -->
  <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>