<?php include_once('functions/sessions.php'); ?>
<?php include_once('controllers/categoriesController.php'); ?>
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
            <h1>Listado de categorias de eventos</h1>
            <small></small>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Admistración de categorias</h3>
        </div>
        <div class="card-body table-overflow">
          <table class="dataTable table table-bordered table-striped">
            <thead>
              <tr class="text-center">
                <th>Nombre</th>
                <th>Icono</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php $categories = getCategories(); ?> <!-- Se manda a llamar la función para obtener los registros -->
              <?php if($categories->num_rows > 0){ ?>
                <?php while($dato = $categories->fetch_assoc()){ ?>
                  <tr class="text-center">
                      <td class="align-middle"><?php echo $dato['cat_evento']; ?></td>
                      <td class="align-middle"><i class="fa <?php echo $dato['icono']; ?>"></i></td>
                      <td class="align-middle">
                        <a href="#" class="editCategory btn btn-rounded btn-outline-info btn-sm" data-modal="edit_modal" data-action="get" data-id="<?php echo $dato['id_categoria']; ?>">
                          <i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="deleteCategory btn btn-rounded btn-outline-danger btn-sm" data-modal="delete_modal" data-action="delete" data-id="<?php echo $dato['id_categoria']; ?>">
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