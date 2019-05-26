<?php
if (isset($_REQUEST['estado']) && isset($_REQUEST['id'])) {
	$estado = (1 == $_REQUEST['estado']) ? 0 : 1;
	$idProducto = $_REQUEST['id'];
	var_dump($estado . $idProducto);
	try {
		$con = new PDO("mysql:host=localhost;dbname=s.i.r;charset=utf8", "root", "");
		// set the PDO error mode to exception
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "Connected successfully"; 
		$con->prepare("UPDATE `tbl_producto` SET `estado`=? WHERE id_producto=?")->execute(array(
			$estado,
			$idProducto
		));
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
} else {

	if ($peticionAjax == true) {
		require_once "../Model/productModel.php";
		require_once '../Model/categoryModel.php';
	} else {
		require_once "./Model/productModel.php";
		require_once './Model/categoryModel.php';
	}


	class productoController extends productoModel
	{

		public function agregar_producto_controlador()
		{
			$referencia = mainModel::limpiar_cadena($_POST["referencia"]);
			$nombre_producto = mainModel::limpiar_cadena($_POST["nombre_producto"]);
			$precio_unitario = mainModel::limpiar_cadena($_POST["precio_unitario"]);
			// $IVA_Producto = mainModel::limpiar_cadena($_POST["IVA_Producto"]);
			$Categoria_Producto_id_Categoria = mainModel::limpiar_cadena($_POST["Categoria_Producto_id_Categoria"]);
			$Persona_id_persona = mainModel::limpiar_cadena($_POST["Persona_id_persona"]);
			$cantidad = mainModel::limpiar_cadena($_POST["cantidad"]);
			$estado = mainModel::limpiar_cadena($_POST["estado"]);

			$consultaReferencia = mainModel::ejecutar_consulta_simple("SELECT `referencia` FROM `tbl_producto` WHERE referencia='$referencia'");
			$consultaNombre = mainModel::ejecutar_consulta_simple("SELECT `nombre_producto` FROM `tbl_producto` WHERE nombre_producto='$nombre_producto'");
			if ($consultaReferencia->rowCount() >= 1) {
				echo '<div class="alert alert-danger" role="alert">
				Está Referencias Ya se encuentra registrada.
				</div>';
				echo "<script>swal('Error al cambiar la contraseña','Campos Requeridos','error')</script>";
				if ($consultaNombre->rowCount() >= 1) {
					echo '<div class="alert alert-danger" role="alert">
					El Nombre Ya se encuentra registrado.
					</div>';
					$alerta = [
						"Alerta" => "simple",
						"Titulo" => "Ocurrio un error inesperado",
						"Texto" => "El Nombre Ya se encuentra registrada en el sistema",
						"Tipo" => "error"
					];
				}
			} else {
				$dataPerson = [
					"referencia" => $referencia,
					"nombre_producto" => $nombre_producto,
					"precio_unitario" => $precio_unitario,
					"Categoria_Producto_id_Categoria" => $Categoria_Producto_id_Categoria,
					"Persona_id_persona" => $Persona_id_persona,
					"cantidad" => $cantidad,
					"estado" => $estado
				];
				$guardarPerson = productoModel::agregar_producto_modelo($dataPerson);

				if ($guardarPerson->rowCount() >= 1) {
					echo '<div class="alert alert-success" role="alert">
				El producto se ha registrado con exito en el sistema
		</div>';
					$alerta = [
						"Alerta" => "recargar",
						"Titulo" => "Producto Registrado",
						"Texto" => "El producto se ha registrado con exito en el sistema.",
						"Tipo" => "success",
						"url" => "listProduct/"
					];
				} else {
					echo '<div class="alert alert-danger" role="alert">
				No hemos podido registrar el producto
			</div>';
					$alerta = [
						"Alerta" => "simple",
						"Titulo" => "Ocurrio un error inesperado",
						"Texto" => "No hemos podido registrar el producto",
						"Tipo" => "error"
					];
				}
			}
			return mainModel::sweet_alert($alerta);
		}

		public function insertar(productoModel $producto)
		{
			$productoModel = new productoModel();
			return $productoModel->insertar($producto);
		}

		public function listar()
		{
			$productoModel = new productoModel();
			return $productoModel->listar();
		}

		public function buscar($id_producto)
		{
			$productoModel = new productoModel();
			return $productoModel->buscar($id_producto);
		}

		public function actualizar(productoModel $producto)
		{
			$productoModel = new productoModel();
			return $productoModel->actualizar($producto);
		}

		public function eliminar($id_producto)
		{
			$productoModel = new productoModel();
			return $productoModel->eliminar($id_producto);
		}
	}
}
