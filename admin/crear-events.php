<?php include_once('functions/sessions.php'); ?>
<?php include('templates/head.php'); ?>
<?php include_once('controllers/eventsController.php'); ?>
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
                        <h1>Crear evento</h1>
                        <small class="font-italic text-danger"><span>*</span> Favor de llenar el formulario completo para registrar un nuevo evento</small>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card card-info h-100">
                        <div class="card-header">
                            <h3 class="card-title">Nuevo evento</h3>
                        </div>
                        <form class="form-horizontal" name="crear-event" id="crear-event" style="display: contents;">
                            <div class="card-body">
                                <!-- Nombre del evento -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-elementor"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="event" name="event" data-name="nombre" placeholder="Nombre del evento..." data-required="true">
                                </div>
                                <!-- Fecha del evento -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control datepickerSingle" id="date" name="date" data-name="fecha" placeholder="Fecha del evento..." data-required="true">
                                </div>
                                <!-- Hora del evento -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control timepicker" id="time" name="time" data-name="hora" placeholder="Hora del evento..." data-required="true">
                                </div>
                                <!-- Categoría del evento -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-award"></i></span>
                                    </div>
                                    <select class="form-control select2" data-placeholder="Seleccione una categoria" name="category" id="category" data-name="categoria" data-required="true">
                                        <option value=""></option>
                                        <?php $categorias = getCategories(); ?>
                                        <?php if($categorias->num_rows > 0){ ?>
                                            <?php while($dato = $categorias->fetch_assoc()){ ?>
                                                <option value="<?php echo $dato['id_categoria']; ?>"><?php echo $dato['cat_evento'] ?></option>
                                            <?php }?>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Categoría del evento -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <select class="form-control select2" data-placeholder="Seleccione un invitado" name="invitate" id="invitate" data-name="invitado" data-required="true">
                                        <option value=""></option>
                                        <?php $invitados = getInvitates(); ?>
                                        <?php if($invitados->num_rows > 0){ ?>
                                            <?php while($dato = $invitados->fetch_assoc()){ ?>
                                                <option value="<?php echo $dato['id_invitado']; ?>"><?php echo $dato['nombre']." ".$dato['apellido'] ?></option>
                                            <?php }?>
                                        <?php }?>
                                    </select>
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
                <div class="col-md-6 mb-3">
                    <img class="img-fluid" src="img/eventos.jpg" alt="imagen-administador">
                </div>
            </div>
        </section>
    </div>

    <!-- FOOTER -->
    <?php include('templates/footer.php'); ?>

    <!-- PERSONALIZACION -->
    <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>