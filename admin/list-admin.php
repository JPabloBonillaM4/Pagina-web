<?php include_once('functions/sessions.php'); ?>
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
            <h1>Lista de administradores</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">DataTable with default features</h3>
        </div>
        <div class="card-body">
          <table class="dataTable table table-bordered table-striped">
            <thead>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Trident</td>
                <td>Internet
                  Explorer 4.0
                </td>
                <td>Win 95+</td>
                <td> 4</td>
                <td>X</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>

  <!-- FOOTER -->
  <?php include('templates/footer.php'); ?>

  <!-- PERSONALIZACION -->
  <?php include('templates/personalize.php'); ?>

<?php include('templates/foot.php'); ?>