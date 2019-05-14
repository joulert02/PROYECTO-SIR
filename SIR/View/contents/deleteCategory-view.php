<?php 
require_once 'Controller/categoryController.php';
$control = new CategoriaController();
if ($control->eliminar($_GET['id_Categoria'])) {
	echo "Datos eliminandos con exito  "; ?>
	<meta http-equiv="refresh" content="0; url=list-category.php">
<?php  }?>