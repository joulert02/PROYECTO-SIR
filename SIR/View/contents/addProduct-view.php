<?php 
require_once 'Controller/productController.php';
include_once 'Controller/categoryController.php';
require_once "Controller/personController.php";

$categoria = new CategoriaController();
$producto = new productoModel();
$productoController = new productoController();
$person = new personController();

?>
<style type="text/css">
  .container{  
   width:900px;
   height: 415px;
 }
</style>

<br>        
<div class="container-fluid">
   <div class="col-md-10 col-xs-12 col-md-offset-1 mt-1">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-list fa-fax3 fa-lg"></span>
             <label ><h4><b>Nuevo Producto</b></h4></label>
          </div>
      <div class="panel-body"> 
    <form data-form="save" action="<?php echo SERVERURL; ?>ajax/productAjax.php" method="POST" id="validate_form" class="ml-2 FormularioAjax" autocomplete="off" enctype="multipart/form-data">
    <p class="RespuestaAjax"></p> 
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label>Referencia*</label>
          <input type="text" name="referencia" class="form-control" placeholder="Ingrese referencia"  required  >
        </div>
        <div class="col-md-4 mb-3">
          <label>Nombre Producto*</label>
          <input type="text" name="nombre_producto" class="form-control" placeholder="Ingrese Nombre del producto"  required data-parsley-length="[3,20]" >
        </div>
        <div class="col-md-4 mb-3">
          <label>Precio Unitario*</label>
          <input type="number" name="precio_unitario" class="form-control" placeholder="Precio Unitario"  required data-parsley-type="number" ><br>
        </div>
        <div class="col-md-4 mb-3">
          <label>Categoria*</label>
          <select name="Categoria_Producto_id_Categoria" class="custom-select form-control" placeholder="Seleccione Estado"  required ="">
          <?php
          echo'<option value="true" selected disabled>Seleccione estado</option> ';         
          foreach ($categoria->ListaDatos() as $r) {
            if ($r->estado==1) {
              echo '<option value="'.$r->id_Categoria.'">'.$r->categoria.'</option>';
            }
          }
          ?>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label>Proveedor*</label>
          <select name="Persona_id_persona" class="custom-select form-control" placeholder="Seleccione Estado"  required ="">
            <option value="true" selected disabled>Seleccione Proveedor</option>
            <?php
              foreach ($person->listar() as $dat) {
                  if ($dat->estado=="Activo" and $dat->nombre_tipo=="Proveedor") {
                  echo '<option value="'.$dat->id_persona.'">'.$dat->nombres.'</option>';
                }
              }
            ?>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label>Cantidad*</label>
          <input type="number" name="cantidad" class="form-control" placeholder="Cantidad" required data-parsley-type="number"><br>
        </div>
        <div class="col-md-4 mb-3">
        <label>Estado*</label><br>
          <select name="estado" class="custom-select form-control" required="">
            <option value="true" selected disabled>Seleccione estado</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
          </select><br>
        </div>
      </div>
      <div class="col-md-12">
      <input type="submit" id="submit" name="submit" class="btn btn-primary" value="Registrar" >
      <input type="reset" value="Limpiar" class="btn btn-secondary">
      <a href="<?php echo SERVERURL; ?>listProduct"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
     </div>
    </form>
  </div>
</div>
</div>
</div>

    
<script>  
$(document).ready(function(){  
   var instance =$('#validate_form').parsley();
});  
</script>

<?php 

// if (isset($_POST['submit'])) {
//     $producto->__SET('referencia',$_POST['referencia']);
//     $producto->__SET('nombre_producto',$_POST['nombre_producto']);
//     $producto->__SET('precio_unitario',$_POST['precio_unitario']);
//     $producto->__SET('IVA_Producto',$_POST['IVA_Producto']);
//     $producto->__SET('Categoria_Producto_id_Categoria',$_POST['Categoria_Producto_id_Categoria']);
//     $producto->__SET('Persona_id_persona',$_POST['Persona_id_persona']);
//     $producto->__SET('cantidad',$_POST['cantidad']);
//     $producto->__SET('estado',$_POST['estado']);

//  if (($producto->referencia == "")&&($producto->nombre_producto == "")&&($producto->precio_unitario == "")&&($producto->Catedoria_Producto_id_Categoria == "")&&($producto->Persona_id_persona == "")&&($producto->cantidad == "")&&($producto->estado == ""))  
//    {
//      echo'<script type="text/javascript"> 
//         swal({title: "ERROR",    
//              text: "No se púdo registrar el cliente Revise los campos.", 
//              type:"error", 
//              confirmButtonText: "OK", 
//              closeOnConfirm: false 
//             }, 
//             function(){ 
//                 window.location.href="'.SERVERURL.'addProduct/"; 
//               });  
//            </script>';
//            return false;    
//    }
//    else if ($productoController->insertar($producto)) {

//       echo'<script type="text/javascript"> 
//           swal({title: "LISTO",    
//               text: "El cliente ha sido registrado correcto.", 
//               type:"success", 
//               confirmButtonText: "OK", 
//               closeOnConfirm: false 
//              }, 
//               function(){ 
//                 window.location.href="'.SERVERURL.'listProduct"; 
//               });  
//               </script>'; 
//       }
//       else{ 
//         echo'<script type="text/javascript"> 
//             swal({title: "ERROR",    
//               text: "No se púdo registrar el cliente. Intenta más tarde.", 
//               type:"error", 
//               confirmButtonText: "OK", 
//               closeOnConfirm: false 
//               }, 
//               function(){ 
//               window.location.href="'.SERVERURL.'addProduct/"; 
//               });  
//               </script>';    
//    ?>
 <!-- <meta http-equiv="refresh" content="0; url=http://localhost/SIR/listProtuct"> -->
 <?php 
//   }
// } ?>
 </div>
