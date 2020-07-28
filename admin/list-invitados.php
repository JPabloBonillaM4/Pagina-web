<?php include_once('functions/sessions.php'); ?>
<?php include_once('controllers/guestsController.php'); ?>
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
            <h1>Listado de invitados</h1>
            <small></small>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admistración de invitados</h3>
            </div>
            <div class="card-body table-overflow">
                <table class="dataTable table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                        <th width="25%">Nombre</th>
                        <th width="50%">Biografía</th>
                        <th width="15%">Imagen</th>
                        <th width="10%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $guests = getGuests(); ?> <!-- Se manda a llamar la función para obtener los registros -->
                        <?php if($guests->num_rows > 0){ ?>
                        <?php while($dato = $guests->fetch_assoc()){ ?>
                            <tr class="text-center">
                                <td class="align-middle"><?php echo $dato['nombre']." ".$dato['apellido']; ?></td>
                                <td class="align-middle"><?php echo $dato['descripcion']; ?></td>
                                <td class="align-middle">
                                    <img class="img-adjusted" src="img/invitados/<?php echo $dato['url_imagen']; ?>" onerror="this.src='img/invitados/default-user.webp'" alt="img_invitado">
                                </td>
                                <td class="align-middle">
                                <a href="#" class="editInvited btn btn-rounded btn-outline-info btn-sm" data-modal="edit_modal" data-action="get" data-id="<?php echo $dato['id_invitado']; ?>">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="#" class="deleteInvited btn btn-rounded btn-outline-danger btn-sm" data-modal="delete_modal" data-action="delete" data-id="<?php echo $dato['id_invitado']; ?>">
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
  <?php include('modals/edit-delete-category.php') ?>
  <!-- FOOTER -->
  <?php include('templates/footer.php'); ?>

  <!-- PERSONALIZACION -->
  <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>