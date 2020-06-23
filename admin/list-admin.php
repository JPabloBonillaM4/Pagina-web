<?php include_once('functions/sessions.php'); ?>
<?php include_once('controllers/adminController.php'); ?>
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
            <h1>Listado de administradores</h1>
            <small></small>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Admistración de usuarios</h3>
        </div>
        <div class="card-body">
          <table class="dataTable table table-bordered table-striped">
            <thead>
              <tr class="text-center">
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php $users = getAdminUsers(); ?> <!-- Se manda a llamar la función para obtener los registros -->
              <?php if($users->num_rows > 0){ ?>
                <?php while($dato = $users->fetch_assoc()){ ?>
                  <tr class="text-center">
                      <td><?php echo $dato['user']; ?></td>
                      <td><?php echo $dato['name']; ?></td>
                      <td><?php echo $dato['email']; ?></td>
                      <td>
                        <a href="#" class="editAdmin btn btn-rounded btn-outline-info btn-sm" data-modal="edit_modal" data-action="get" data-id="<?php echo $dato['id']; ?>">
                          <i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="deleteAdmin btn btn-rounded btn-outline-danger btn-sm" data-modal="delete_modal" data-action="delete" data-id="<?php echo $dato['id']; ?>">
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
  <?php include('modals/edit-delete-admin.php') ?>
  <!-- FOOTER -->
  <?php include('templates/footer.php'); ?>

  <!-- PERSONALIZACION -->
  <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>