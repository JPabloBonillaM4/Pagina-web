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
                        <a href="#" class="editAdmin btn btn-rounded btn-outline-info btn-sm openModal" data-modal="edit_modal" data-action="edit-admin" data-id="<?php echo $dato['id']; ?>">
                          <i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="deleteAdmin btn btn-rounded btn-outline-danger btn-sm openModal" data-modal="delete_modal" data-action="delete-admin" data-id="<?php echo $dato['id']; ?>">
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
  <!-- EDIT MODAL -->
  <div class="modal fade" tabindex="-1" role="dialog" id="edit_modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">EDIT MODAL</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="edit_admin_info">
            <div class="form-group">
              <label for=""></label>
              <input type="text" id="">
            </div>
            <div class="form-group">
              <label for=""></label>
              <input type="text">
            </div>
            <div class="form-group">
              <label for=""></label>
              <input type="text">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- DELETE MODAL -->
  <div class="modal fade" tabindex="-1" role="dialog" id="delete_modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">DELETE MODAL</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <?php include('templates/footer.php'); ?>

  <!-- PERSONALIZACION -->
  <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>