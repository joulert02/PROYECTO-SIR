<?php
require_once "Controller/categoryController.php";
$controls = new  CategoriaController();
?>

<script>
  $(document).ready(function() {
    $('#grid').DataTable({
      "order": [
        [0, "desc"]
      ],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
    });
  });
</script>
<style type="text/css">
  .container2 {
    width: 550px;
  }
</style>
<h1 style="text-align: center; padding: 30px">Gestión Categoría</h1>
<main class="container-fluid">
  <hr>
  <section class="row">
    <article class="col-md-5">
      <div class="col-md-16">
        <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
            <span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
             <label><h4 id="nombre" style="font-weight: bold;">Nueva Categoría</h4></label>
          </div>
          <div class="panel-body">
            <form method="post" id="categoria-form" class="ml-auto">
              <input type="hidden" id="id_categoria">
              <div class="row">
                <div class="col-md-6">
                  <label>Nombre Categoría</label><br>
                  <input type="text" id="categoria" class="form-control" required=""><br>
                </div>
                <div class="col-md-6">
                  <label>Estado</label><br>
                  <select name="estado" id="estado" class="custom-select form-control" required="" id="exampleFormControlSelect1">
                    <option value="true" selected disabled>Seleccione Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select><br>
                </div>
                <div class="col-md-12 mb-3">
                  <button type="submit" id="btnR" class="btn btn-primary mt-3 mb-3">Registrar</button>
                  <input type="reset" value="Limpiar" class="btn btn-danger mt-3 mb-3 boton-limpiar" style="float: right;">
                </div>
            </form>
          </div>
        </div>
      </div>
    </article>
    <article class="col-md-7">
      <div class="table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap">
          <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
            <tr>
              <td style="display: none" width="5%">Id Categoria</td>
              <td width="5%">Nombre Categoría</td>
              <td width="5%">Estado</td>
              <td width="1%">Acciones</td>
            </tr>
          </thead>
          <tbody id="categorias">
            <?php foreach ($controls->ListaDatos() as $r) : ?>
              <tr idCategoria="<?php $r->__GET('id_Categoria'); ?>" estado="<?php $r->__GET('estado'); ?>">
                <td style="display: none"> <?php echo $r->__GET('id_Categoria'); ?> </td>
                <td> <?php echo $r->__GET('categoria'); ?> </td>
                <td>
                  <?php
                  if ($r->__GET('estado') == 1) {
                    echo "Activo";
                  } else {
                    echo "Inactivo";
                  }
                  ?>
                </td>
                <td>
                  <button class="btn btn-primary categoria-edit text-center"><i class="fa fa-edit"></i></button>
                  <button class="btn btn-danger categoria-delete text-center"><i class="fas fa-sync-alt fa-spin" aria-hidden="true"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </article>
  </section>
</main>
<script src="<?php echo SERVERURL; ?>ajax/Categoria.js"></script>
<script>
  $(document).ready(function() {
    var instance = $('#categoria-form').parsley();
  });
</script>