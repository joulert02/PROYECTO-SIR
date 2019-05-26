<?php
if ($peticionAjax == true) {
	require_once "../core/mainModel.php";
	include_once "Controller/productController.php";
	require_once "Controller/categoryController.php";
} else {
	require_once "./core/mainModel.php";
	include_once "Controller/productController.php";
	require_once "Controller/categoryController.php";
}

class entryModel extends mainModel
{
	private $entrada_has_prducto;
	private $Entrada_id_entrada;
	private $Producto_id_producto;
	private $cantidad;
	private $fecha_entrada;
	private $cantidadP;
	private $nombre_producto;
	private $referencia;

	public function __GET($atr)
	{
		return $this->$atr;
	}
	public function __SET($atr, $vl)
	{
		$this->$atr = $vl;
	}

	public function insertar(entryModel $entrada)
	{
		$insertar = "INSERT INTO tbl_entrada(fecha_entrada) VALUES (?)";
		try {
			mainModel::conectar()->prepare($insertar)->execute(array(
				$entrada->__GET('fecha_entrada'),
			));

			$idEntradacon = "SELECT max(id_entrada) as id_entrada ,fecha_entrada FROM tbl_entrada";
			$idEntrada = mainModel::conectar()->prepare($idEntradacon);
			$idEntrada->execute();
			$dato = $idEntrada->fetch(PDO::FETCH_OBJ);
			$idEntra = $dato->id_entrada;

			$productosTMP = "SELECT * FROM tmp_entrada WHERE tipo=1";

			$Rtmp = mainModel::conectar()->query($productosTMP);


			foreach ($Rtmp->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$insertardetalle = "INSERT INTO tbl_detalle_entrada (Entrada_id_entrada, Producto_id_producto, cantidad) VALUES ( ?, ?, ?)";

				mainModel::conectar()->prepare($insertardetalle)->execute(array(
					$idEntra,
					$datos->id_producto,
					$datos->cantidad_tmp,
				));

				$consulCantidad = "SELECT * FROM tbl_producto WHERE id_producto = $datos->id_producto";
				$resulCantidad = mainModel::conectar()->prepare($consulCantidad);
				$resulCantidad->execute();
				$conversionP = $resulCantidad->fetch(PDO::FETCH_OBJ);
				$cantidadP = $conversionP->cantidad;

				$total = $cantidadP + $datos->cantidad_tmp;
				//echo $total."<br>";
				//echo $cantidadP."<br>";
				//echo $datos->cantidad_tmp."<br>";
				$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";
				$cantidadresult = mainModel::conectar()->prepare($cantidadcon)->execute(array(
					$total,
					$datos->id_producto
				));
			}

			$productosTMP = "DELETE FROM `tmp_entrada` WHERE tipo=1";

			mainModel::conectar()->query($productosTMP)->execute();

			return true;
		} catch (Exception $e) {
			echo "Error al isertar datos en Entrada: " . $e->getMessage();
		}
	}

	public function listar()
	{
		$datosEntry = array();
		$consultar = "SELECT * FROM `tbl_entrada` ORDER BY `id_entrada` desc";
		try {

			$resultado = mainModel::conectar()->query($consultar);
			// $resultado = execute();

			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $dato) {
				$entrada = new entryModel();
				$entrada->__SET('Entrada_id_entrada', $dato->id_entrada);
				// $entrada->__SET('nombre_producto', $dato->nombre_producto);
				// $entrada->__SET('referencia', $dato->referencia);
				// $entrada->__SET('cantidad', $dato->cantidad);
				$entrada->__SET('fecha_entrada', $dato->fecha_entrada);

				$datosEntry[] = $entrada;
			}
			return $datosEntry;
		} catch (Exception $e) {
			echo "Error al consultar" . $e->getMessage();
		}
	}

	public function listarReferencias($id)
	{
		$datosEntrys = array();
		$buscar  = "SELECT pro.referencia FROM tbl_producto pro JOIN tbl_detalle_entrada dt 
				ON dt.Producto_id_producto = pro.id_producto JOIN tbl_entrada e on e.id_entrada = dt.Entrada_id_entrada WHERE dt.Entrada_id_entrada =$id";
		try {
			$resultado = mainModel::conectar()->query($buscar);


			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$entradas = new entryModel();
				//$entradas->__SET('Entrada_id_entrada', $datos->id_entrada);
				// $entrada->__SET('nombre_producto', $dato->nombre_producto);
				// $entrada->__SET('referencia', $dato->referencia);
				// $entrada->__SET('cantidad', $dato->cantidad);
				$entradas->__SET('referencia', $datos->referencia);

				$datosEntrys[] = $entradas;
			}
			return $datosEntrys;
		} catch (Exception $e) {
			echo "Error al consultar" . $e->getMessage();
		}
	}

	public function buscar()
	{
		$datosEntrys = array();
		$buscar  = "SELECT ent.id_entrada, ent.fecha_entrada, det.cantidad,det.Producto_id_producto,det.entrada_has_prducto FROM tbl_entrada ent, tbl_detalle_entrada det 
			where ent.id_entrada=det.Entrada_id_entrada and det.Entrada_id_entrada=?";


		try {
			$resultado = mainModel::conectar()->prepare($buscar);

			$datosUrl = explode("/", $_GET["views"]);
			$id = mainModel::decryption($datosUrl[1]);

			$resultado->execute(array($id));

			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$usuario = new entryModel();
				$usuario->__SET('entrada_has_prducto', $datos->entrada_has_prducto);
				$usuario->__SET('Entrada_id_entrada', $datos->id_entrada);
				$usuario->__SET('fecha_entrada', $datos->fecha_entrada);
				$usuario->__SET('cantidad', $datos->cantidad);
				$usuario->__SET('Producto_id_producto', $datos->Producto_id_producto);
				$datosEntrys[] = $usuario;
			}
			return $datosEntrys;
		} catch (Exception $e) {
			echo "Error al buscar datos " . $e->getMessage();
		}
	}

	public function insertTmp($id, $cantidad)
	{
		$insertar = "INSERT INTO tmp_entrada (id_producto,cantidad_tmp,tipo) values (?,?,?)";
		$consultar = "SELECT * FROM `tmp_entrada` WHERE tipo=2";
		$igual = 0;
		try {
			$respuesta = mainModel::conectar()->prepare($consultar);
			$respuesta->execute();
			// var_dump($respuesta->fetchAll(PDO::FETCH_OBJ));
			// echo $id;
			foreach ($respuesta->fetchAll(PDO::FETCH_OBJ) as $value) {
				if ($value->id_producto == $id) {
					$igual = 1;
				}
			}

			if ($igual == 0) {
				mainModel::conectar()->prepare($insertar)->execute(array(
					$id,
					$cantidad,
					2
				));
			}
			return true;
		} catch (Exception $e) {
			echo "Error al consultar" . $e->getMessage();
		}
	}

	public function actualizar1(entryModel $entrada)
	{
		$datosUrl = explode("/", $_GET["views"]);
		$id = mainModel::decryption($datosUrl[1]);

		$buscar  = "UPDATE tbl_detalle_entrada SET Producto_id_producto=?, cantidad=? WHERE entrada_has_prducto=?";
		try {
			$resultado = $this->conexion->prepare($buscar);
			$resultado->execute(array(
				$entrada->__GET('Producto_id_producto'),
				$entrada->__GET('cantidad'),
				$entrada->__GET('entrada_has_prducto'),
			));

			$b  = "UPDATE tbl_entrada SET fecha_entrada=? WHERE id_entrada=?";
			$re = mainModel::conectar()->query($b);
			$re->execute(array(
				$entrada->__GET('fecha_entrada'),
				$entrada->__GET('entrada_has_prducto'),
			));

			$total = $entrada->__GET('cantidad') + $entrada->__GET('cantidadP');
			$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";
			$cantidadresult = $this->conexion->prepare($cantidadcon)->execute(array(
				$total,
				$entrada->__GET('Producto_id_producto')
			));

			return true;
		} catch (Exception $e) {
			echo "Error al buscar datos " . $e->getMessage();
		}
	}

	public function actualizar(entryModel $entrada)
	{
		$actualizar = "UPDATE `tbl_entrada` SET `fecha_entrada`=? WHERE id_entrada=?";
		$datosUrl = explode("/", $_GET["views"]);
		$id = mainModel::decryption($datosUrl[1]);
		try {
			mainModel::conectar()->prepare($actualizar)->execute(array(
				$entrada->__GET('fecha_entrada'),
				$id
			));


			$productosTMP = "SELECT * FROM tmp_entrada WHERE tipo=2";

			$Rtmp = mainModel::conectar()->query($productosTMP);

			$igual = 0;
			$cantidadR=0;
			foreach ($Rtmp->fetchAll(PDO::FETCH_OBJ) as $datos) {
				foreach (self::buscar() as $key) {
					if ($key->__GET('Producto_id_producto') == $datos->id_producto) {
						// echo $datos->cantidad_tmp;
						// echo $key->__GET('cantidad');
						$cantidadR=$datos->cantidad_tmp-$key->__GET('cantidad');
						// echo $cantidadR;
						$igual = 1;
					}
				}
				var_dump($igual);
				if ($igual == 0) {
					$insertardetalle = "INSERT INTO tbl_detalle_entrada (Entrada_id_entrada, Producto_id_producto, cantidad) VALUES ( ?, ?, ?)";

					mainModel::conectar()->prepare($insertardetalle)->execute(array(
						$id,
						$datos->id_producto,
						$datos->cantidad_tmp,
					));

					$consulCantidad = "SELECT * FROM tbl_producto WHERE id_producto = $datos->id_producto";
					$resulCantidad = mainModel::conectar()->prepare($consulCantidad);
					$resulCantidad->execute();
					$conversionP = $resulCantidad->fetch(PDO::FETCH_OBJ);
					$cantidadP = $conversionP->cantidad;

					$total = $cantidadP + $datos->cantidad_tmp;
					//echo $total."<br>";
					//echo $cantidadP."<br>";
					//echo $datos->cantidad_tmp."<br>";
					$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";
					$cantidadresult = mainModel::conectar()->prepare($cantidadcon)->execute(array(
						$total,
						$datos->id_producto
					));
				} else {
					$insertardetalle = "UPDATE `tbl_detalle_entrada` SET `cantidad`= ? WHERE Entrada_id_entrada = ? AND Producto_id_producto = ? ";

					mainModel::conectar()->prepare($insertardetalle)->execute(array(
						$datos->cantidad_tmp,
						$id,
						$datos->id_producto,
					));

					$consulCantidad = "SELECT * FROM tbl_producto WHERE id_producto = $datos->id_producto";
					$resulCantidad = mainModel::conectar()->prepare($consulCantidad);
					$resulCantidad->execute();
					$conversionP = $resulCantidad->fetch(PDO::FETCH_OBJ);
					$cantidadP = $conversionP->cantidad;

					$total = $cantidadP + $cantidadR;
					//echo $total."<br>";
					//echo $cantidadP."<br>";
					//echo $datos->cantidad_tmp."<br>";
					$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";
					$cantidadresult = mainModel::conectar()->prepare($cantidadcon)->execute(array(
						$total,
						$datos->id_producto
					));
				}
				$igual = 0;
			}

			$productosTMP = "DELETE FROM `tmp_entrada` WHERE tipo=2	";

			mainModel::conectar()->query($productosTMP)->execute();

			return true;
		} catch (Exception $e) {
			echo "Error al isertar datos en Entrada: " . $e->getMessage();
		}
	}


	public function eliminar($id)
	{
		$borrar = "DELETE FROM `tbl_detalle_entrada` WHERE `entrada_has_prducto`=?;
			DELETE FROM tbl_entrada WHERE id_entrada=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($id, $id));
			return true;
		} catch (Exception $e) {
			echo "Error al eliminar datos " . $e->getMessage();
		}
	}
}
