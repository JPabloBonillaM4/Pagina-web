<?php include_once('functions/sessions.php'); ?>
<?php include_once('controllers/eventsController.php'); ?>
<?php include('templates/head.php'); ?>
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
                    <h1>Listado de eventos</h1>
                    <small>Aquí podras editar o eliminar los eventos</small>
                </div>
            </div>
        </div>
    </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admistración de eventos</h3>
                </div>
                <div class="card-body table-overflow">
                    <table class="dataTable table table-bordered table-striped">
                        <thead>
                        <tr class="text-center">
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Categoria</th>
                            <th>Invitado</th>
                            <th>Clave</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $events = getEvents(); ?> <!-- Se manda a llamar la función para obtener los registros -->
                        <?php if($events->num_rows > 0){ ?>
                            <?php while($dato = $events->fetch_assoc()){ ?>
                            <tr class="text-center">
                                <td><?php echo $dato['nombre']; ?></td>
                                <td><?php echo $dato['fecha']; ?></td>
                                <td><?php echo $dato['hora']; ?></td>
                                <td><?php echo $dato['nombre_evento']; ?></td>
                                <td><?php echo $dato['nombre_invitado']; ?></td>
                                <td><?php echo $dato['clave']; ?></td>
                                <td>
                                    <a href="#" class="editEvent btn btn-rounded btn-outline-info btn-sm" data-modal="edit_modal" data-action="get" data-id="<?php echo $dato['id']; ?>">
                                    <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#" class="deleteEvent btn btn-rounded btn-outline-danger btn-sm" data-modal="delete_modal" data-action="delete" data-id="<?php echo $dato['id']; ?>">
                                    <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!-- MODALS -->
    <?php include('modals/edit-delete-event.php') ?>
    <!-- FOOTER -->
    <?php include('templates/footer.php'); ?>

    <!-- PERSONALIZACION -->
    <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>