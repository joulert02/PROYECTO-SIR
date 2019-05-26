<?php
$usu = $_SESSION['usuario_sir'];
$nombre = $_SESSION['correo_sir'];
include 'Model/productModel.php';
$controlp = new productoModel();

?>

<?php 
$conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta = $conec->prepare("SELECT * FROM tbl_persona");
$Consulta ->  execute();
$contarRegistros = $Consulta -> fetchAll();
$CantidadPersonas = count($contarRegistros); 
?>

<?php 
$conec1 = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta1 = $conec1->prepare("SELECT * FROM tbl_producto");
$Consulta1 ->  execute();
$contarRegistros1 = $Consulta1 -> fetchAll();
$CantidadProductos = count($contarRegistros1); 
?>

<?php 
$conec2 = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta2 = $conec2->prepare("SELECT * FROM tbl_pedido");
$Consulta2 ->  execute();
$contarRegistros2 = $Consulta2 -> fetchAll();
$CantidadPedidos = count($contarRegistros2); 
?>

<?php 
$conec3 = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta3 = $conec3->prepare("SELECT * FROM tbl_entrada");
$Consulta3 ->  execute();
$contarRegistros3 = $Consulta3 -> fetchAll();
$CantidadEntradas = count($contarRegistros3); 
?>

<?php 
$conec4 = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta4 = $conec4->prepare("SELECT * FROM tbl_categoria_producto");
$Consulta4 ->  execute();
$contarRegistros4 = $Consulta4 -> fetchAll();
$CantidadCategorias = count($contarRegistros4); 
?>

<?php 
$conec5 = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta5 = $conec5->prepare("SELECT * FROM tbl_salida");
$Consulta5 ->  execute();
$contarRegistros5 = $Consulta5 -> fetchAll();
$CantidadSalidas = count($contarRegistros5); 
?>

<style type="text/css">
    .container{  
     width:815px;
     height: 125px;
   }
</style>

<?php 
// if ($nombre!=null || $nombre!="") {
//   echo "<script> 
//   swal('Bienvenido','Administrador ".$nombre." ', 'success')</script>";
// }
   ?>
   
<div class="container-fluid">
  <div class="col-md-10 col-xs-12 col-md-offset-1 mt-1">
       <center>
        <h1>Administración</h1>
       <br><br>
 <div class="row">
    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
         <a href="<?php echo SERVERURL; ?>listPerson"> <i class="glyphicon glyphicon-user"></i></a>
        </div></a>
        <div class="panel-value pull-center">
          <h2 class="margin-top"> <?php echo $CantidadPersonas;?> </h2>
          <a href="<?php echo SERVERURL; ?>listPerson"> <p class="text-muted">Personas</p></a>
        </div>
       </div>
    </div>

    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
           <a href="<?php echo SERVERURL; ?>listProduct"><i class="glyphicon glyphicon-list"></i></a>
        </div>
        <div class="panel-value pull-center">
          <h2 class="margin-top"> <?php echo $CantidadProductos;?> </h2> 
           <a href="<?php echo SERVERURL; ?>listProduct"> <p class="text-muted">Productos</p></a>
        </div>
       </div>
    </div>

     <div class="col-md-4">
       <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-blue">
          <a href="<?php echo SERVERURL; ?>listPedido"> <i class="glyphicon glyphicon-shopping-cart"></i></a>
        </div>
        <div class="panel-value pull-center">
         <h2 class="margin-top"> <?php echo $CantidadPedidos;?> </h2>
           <a href="<?php echo SERVERURL; ?>listPedido"><p class="text-muted">Pedidos</p></a>
        </div>
       </div>
    </div>

     <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <a href="<?php echo SERVERURL; ?>listEntry"> <i class="glyphicon glyphicon-list"></i></a>
        </div>
        <div class="panel-value pull-center">
          <h2 class="margin-top"> <?php echo $CantidadEntradas;?> </h2> 
           <a href="<?php echo SERVERURL; ?>listEntry"><p class="text-muted">Entradas</p></a>
        </div>
       </div>
    </div>

    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <a href="<?php echo SERVERURL; ?>Categoria"> <i class="glyphicon glyphicon-list"></i></a>
        </div>
        <div class="panel-value pull-center">
          <h2 class="margin-top"> <?php echo $CantidadCategorias;?> </h2>
          <a href="<?php echo SERVERURL; ?>Categoria"> <p class="text-muted">Categorías</p></a>
        </div>
       </div>
    </div>

    <div class="col-md-4">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <a href="<?php echo SERVERURL; ?>listExit"> <i class="glyphicon glyphicon-list"></i></a>
        </div>
        <div class="panel-value pull-center">
          <h2 class="margin-top"> <?php echo $CantidadSalidas;?> </h2> 
          <a href="<?php echo SERVERURL; ?>listExit"> <p class="text-muted">Salidas</p></a>
        </div>
       </div>
    </div>
</div>
</center>
<script type="text/javascript">
$(document).ready(function() {
  $('#grid').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});

    </script>

    <script type="text/javascript">
$(document).ready(function() {
  $('#tabla').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});

    </script>

    <style type="text/css">
    .container1{  
     width:850px;
   }
</style>
    <center>
    <div class="container-fluid">
    <section class="row">
      <article class="col-md-6">
        <center>
        <h3>Productos en stock Mínimo</h3>
      </center>
      <div class="table-responsive">
        <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
          <tr>
          <td>Referencia</td>
          <td>Nombre</td>
          <td>Cantidad</td>
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach ($controlp->stockMinimo() as $r):?>
          <tr>
            <td> <?php echo $r->__GET('referencia'); ?> </td>
            <td> <?php echo $r->__GET('nombre_producto');?> </td>
            <td class=" bg-danger text-danger text-center"> <?php echo $r->__GET('cantidad'); ?> </td>
             </tr>
          <?php endforeach; ?> 
          </tbody>
        </table>
        </div>
      </article>
      <article class="col-md-6">
        <center>
        <h3>Productos en stock Máximo</h3>
      </center>
      <div class="table-responsive">
         <table id="tabla" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
          <tr>
          <td>Referencia</td>
          <td>Nombre</td>
          <td>Cantidad</td>
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach ($controlp->stockMaximo() as $r):?>
          <tr>
            <td> <?php echo $r->__GET('referencia'); ?> </td>
            <td> <?php echo $r->__GET('nombre_producto');?> </td>
            <td class=" bg-green text-green text-center"> <?php echo $r->__GET('cantidad'); ?> </td>
             </tr>
          <?php endforeach; ?> 
          </tbody>
          </table>
        </div>
        </div>
      </article>
    </section>
  </div>
  </div>