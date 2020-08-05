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
                <h1>Crear registrado</h1>
                <small class="font-italic text-danger"> <span>*</span> Favor de llenar el formulario completo para registrar un nuevo registrado</small>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card card-info h-100">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo registrado</h3>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" name="crear-register" id="crear-register" style="display: contents;">
                        <div class="card-body">
                            <!-- nombre -->
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre_registrado" name="nombre_registrado" data-name="nombre" placeholder="Escriba el nombre del registrado..." data-required="true">
                            </div>
                            <!-- apellido -->
                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" class="form-control" id="apellido_registrado" name="apellido_registrado" data-name="apellido" placeholder="Escriba el apellido del registrado..." data-required="true">
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