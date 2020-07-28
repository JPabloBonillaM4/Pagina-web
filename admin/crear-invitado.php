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
                <h1>Crear invitado</h1>
                <small class="font-italic text-danger"> <span>*</span> Favor de llenar el formulario completo para registrar un nuevo invitado</small>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card card-info h-100">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo invitado</h3>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" name="crear-invited" id="crear-invited" style="display: contents;">
                        <div class="card-body">
                            <!-- nombre -->
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" data-name="nombre" placeholder="Escriba el nombre del invitado..." data-required="true">
                            </div>
                            <!-- apellido -->
                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" data-name="apellido" placeholder="Escriba el apellido del invitado..." data-required="true">
                            </div>
                            <!-- descripcion -->
                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" data-name="descripcion" placeholder="Escriba el descripcion del invitado..." data-required="true" cols="30" rows="5"></textarea>
                            </div>
                            <!-- imagen -->
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control-file" id="imagen" name="imagen">
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