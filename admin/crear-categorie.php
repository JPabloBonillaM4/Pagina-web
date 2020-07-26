<?php include_once('functions/sessions.php'); ?>
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
            <h1>Crear categoria</h1>
            <small class="font-italic text-danger"> <span>*</span> Favor de llenar el formulario completo para registrar una nueva categoria</small>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="card card-info h-100">
            <div class="card-header">
                <h3 class="card-title">Nueva categoria</h3>
            </div>
            <form class="form-horizontal" name="crear-subcategory" id="crear-subcategory" style="display: contents;">
              <div class="card-body">
                <!-- nombre -->
                <div class="form-group">
                    <label for="cat_evento">Nombre:</label>
                    <input type="text" class="form-control" id="cat_evento" name="cat_evento" data-name="nombre" placeholder="Escriba el nombre de la subcategoria..." data-required="true">
                </div>
                <!-- icono -->
                <div class="form-group">
                    <label for="icono">Icono:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="input-group-text h-100"><i class="fa fa-address-book"></i></span>
                        </div>
                        <input type="text" class="form-control iconPicker" id="icono" name="icono" autocomplete="off" data-name="icono" placeholder="Seleccione su icono" data-required="true">
                    </div>
                </div>
                <input type="hidden" name="action" value="guardar" id="action" data-name="action">
              </div>
              <div class="card-footer d-flex justify-content-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-outline-info resetForm">Limpiar</button>
                  <button type="submit" class="btn btn-outline-success">Agregar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- FOOTER -->
  <?php include('templates/footer.php'); ?>

  <!-- PERSONALIZACION -->
  <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>