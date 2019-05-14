<?php 
require_once "../../../Controller/Order Controller/pedido_controller.php";
$control = new  Pedido_Controller();
require "global.php";
require "menu.php";
?>

<html>
<head>
  <meta name="viewport" content="width=device-width" />
  <title>Rodillos Mastder</title>


<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>

</head>
<body>

<script>

$(document).ready(function() {
  $('#grid').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});

    </script>

    <style type="text/css">

  .container 
 {  
 width:950px;
 height: 400px;
 position: relative;
}

#modal_size{
      width: 25%;
    }

    </style>
    <br><br><br>
    <center>

    <h1>Pedidos</h1>
      </center>

         <div class="container">

          <a href="add_pedido.php" class="btn btn-primary" role="button">Registrar Pedido &nbsp&nbsp<i class="fa fa-plus-circle"></i></a>
          <br><br>

        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #dc3545;color: white; font-weight: bold;">
                <tr>
                        <td >Id Pedido</td>
                                <td >Id Cliente</td>
                                <td >Vendedor</td>
                                <td >Fecha Pedido</td>
                                <td >Fecha Vencimiento</td>
                                <td >Despachado Por</td>
                                <td >Estado</td>
                                <td >Acciones</td>
                </tr>
            </thead>

        <tbody>
            <tr>
      <?php foreach ($control->ListaDatos() as $r):?>
                <td> <?php echo $r->__GET('id_pedido'); ?> </td>
                <td> <?php echo $r->__GET('Persona_id_persona');?> </td>
                <td> <?php echo $r->__GET('vendedor'); ?> </td>
                                <td> <?php echo $r->__GET('fecha_pedido'); ?> </td>
                <td> <?php echo $r->__GET('fecha_vencimiento');?> </td>
                <td> <?php echo $r->__GET('despachado_por'); ?> </td>
                                <td> <?php echo $r->__GET('estado'); ?> </td>
                <td>
<a href="edit_pedido.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Editar" class='btn btn-primary' ><i class="fa fa-pencil-square-o" aria-hidden="true" ></i></a>

<a href="#" data-target="#miModal" data-toggle="modal" class='btn btn-primary' id='<?php echo $r->id_pedido; ?>'><i class="fa fa-eye" aria-hidden="true"></i></a> 

<a href="eliminar_pedido.php?id_pedido=<?php echo $r->id_pedido; ?>" title="Eliminar" class='btn btn-danger delete' ><i class="fa fa-trash-o" aria-hidden="true" ></i></a>

                </td>
            </tr>
      <?php endforeach; ?> 
        </tbody>

    </table>
</div>

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modal_size">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <center>
        <h4 class="modal-title" id="myModalLabel">Informacion Del Pedido</h4>
      </center>
      </div>
      <div class="modal-body">

               <label>Id Pedido:</label>
               <?php echo $r->__GET('id_pedido'); ?> 
               <br>
               <label>Id Persona:</label>
               <?php echo $r->__GET('');?> 
               <br>Persona_id_persona
               <label>Vendador:</label>
               <?php echo $r->__GET('vendedor'); ?> 
               <br>
               <label>Fecha Pedido:</label>
               <?php echo $r->__GET('fecha_pedido'); ?> 
               <br>
               <label>Fecha Vencimiento:</label>
               <?php echo $r->__GET('fecha_vencimiento');?> 
               <br>
               <label>Despachado Por:</label>
               <?php echo $r->__GET('despachado_por'); ?> 
               <br>
               <label>Estado:</label>
               <?php echo $r->__GET('estado'); ?> 
              
               <div class="modal-footer">
                <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </center>
      </div>
      </div>
    </div>
  </div>
</div>
<?php
?>

<script>
        jQuery(document).ready(function($){
            $('.delete').on('click',function(){
                var getLink = $(this).attr('href');
                swal({
                        title: 'Estás seguro de eliminar este registro?',
                        text: "Será eliminado permanentemente!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar!',
                        closeOnConfirm: false
                        },function(){
                          swal("¡Eliminado!", 
                         "Eliminado Correctamente.", 
                         "success",); 
                        window.location.href = getLink
                    });
                return false;
            });
        });
    </script>


  <script src="../../../Assets/js/table-datatables-responsive.js"></script>

</body>
</html>