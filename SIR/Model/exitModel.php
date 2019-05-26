<?php

    if ($peticionAjax==true) {
        require_once "../core/mainModel.php";
		include_once "Controller/productController.php";
        require_once "Controller/categoryController.php";
        require_once "Model/tipoSalidaModel.php";
    } else {
        require_once "./core/mainModel.php";
		include_once "Controller/productController.php";
        require_once "Controller/categoryController.php";
        require_once "Model/tipoSalidaModel.php";
}



	class exitModel extends mainModel
	{
		private $producto_has_salida;
		private $Salida_id_salida;
		private $Producto_id_producto;
		private $cantidad;
		private $fecha_salida;
		private $cantidadP;
		private $nombre_producto;
		private $referencia;
		private $tipo_salida_tipo_salida;

		public function __GET($atr)
		{
			return $this->$atr;
		}
		public function __SET($atr, $vl)
		{
			$this->$atr=$vl;
		}

		public function insertar(exitModel $salida)
		{
			$insertar = "INSERT INTO tbl_salida(fecha_salida,tipo_salida_tipo_salida) VALUES (?,?)";
			try{
				mainModel::conectar()->prepare($insertar)->execute(array(
					$salida->__GET('fecha_salida'),
					$salida->__GET('tipo_salida_tipo_salida'),
				));

				$idsalidacon = "SELECT max(id_salida) as id_salida FROM tbl_salida";
				$idsalida=mainModel::conectar()->prepare($idsalidacon);
				$idsalida->execute();
				$dato=$idsalida->fetch(PDO::FETCH_OBJ);
				$idSali = $dato->id_salida;

				$productosTMP="SELECT * FROM tmp_salida";

		        $Rtmp = mainModel::conectar()->query($productosTMP);
		        //$Rtmp->execute();
		        
		        foreach ($Rtmp->fetchAll(PDO::FETCH_OBJ) as $datos) {
		            $insertardetalle = "INSERT INTO tbl_detalle_salida (Salida_id_salida, Producto_id_producto, cantidad) VALUES (?,?,?)";

					mainModel::conectar()->prepare($insertardetalle)->execute(array(
						$idSali,
						$datos->id_producto,
						$datos->cantidad_tmp,
					));
					
					$consulCantidad = "SELECT * FROM tbl_producto WHERE id_producto = $datos->id_producto";
					$resulCantidad=mainModel::conectar()->prepare($consulCantidad);
					$resulCantidad->execute();
					$conversionP=$resulCantidad->fetch(PDO::FETCH_OBJ);
					$cantidadP = $conversionP->cantidad;

					$total= $cantidadP - $datos->cantidad_tmp;
					//echo $total."<br>";
					//echo $cantidadP."<br>";
					//echo $datos->cantidad_tmp."<br>";
					$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";
					$cantidadresult=mainModel::conectar()->prepare($cantidadcon)->execute(array(
						$total,
						$datos->id_producto
					));
		        }


		        $productosTMP="DELETE FROM `tmp_salida`";

		        mainModel::conectar()->query($productosTMP)->execute();
				return true;
			}catch (Exception $e){
				echo "Error al isertar datos en Salida: ".$e->getMessage();
			}
		}

		public function listar()
		{
			$datosExit = array();
			$consultar = "SELECT fecha_salida,id_salida, ts.nombre FROM `tbl_salida` s JOIN tbl_tipo_salida  
			ts on tipo_salida_tipo_salida = ts.tipo_salida";
			try{
				$resultado = mainModel::conectar()->query($consultar);

				// $resultado = execute();

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $dato) {
					$salida = new exitModel();
					$salida->__SET('Salida_id_salida', $dato->id_salida);
					// $salida->__SET('nombre_producto', $dato->nombre_producto);
					// $salida->__SET('referencia', $dato->referencia);
					// $salida->__SET('cantidad', $dato->cantidad);
					$salida->__SET('fecha_salida', $dato->fecha_salida);
					$salida->__SET('tipo_salida_tipo_salida', $dato->nombre);

					$datosExit[] = $salida;
				}
				return $datosExit;
			}catch(Exception $e){
				echo "Error al consultar".$e->getMessage();
			}
		}

		public function listarReferencias($id)
		{
			$datosEntrys = array();
			$buscar  = "SELECT pro.referencia FROM tbl_producto pro JOIN tbl_detalle_salida dt 
			ON dt.Producto_id_producto = pro.id_producto JOIN tbl_salida s on s.id_salida = dt.Salida_id_salida WHERE dt.Salida_id_salida =$id";
			try{
				$resultado = mainModel::conectar()->query($buscar);
				

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
					$entradas = new exitModel();
					//$entradas->__SET('Entrada_id_entrada', $datos->id_entrada);
					// $entrada->__SET('nombre_producto', $dato->nombre_producto);
					// $entrada->__SET('referencia', $dato->referencia);
					// $entrada->__SET('cantidad', $dato->cantidad);
					$entradas->__SET('referencia', $datos->referencia);

					$datosEntrys[] = $entradas;
				}
				return $datosEntrys;
			}catch(Exception $e){
				echo "Error al consultar".$e->getMessage();
			}
		}

		public function buscar()
		{
			$datosExit = array();
			$buscar  = "SELECT sali.id_salida,sali.tipo_salida_tipo_salida, sali.fecha_salida, dexit.cantidad,dexit.Producto_id_producto,
			dexit.producto_has_salida FROM tbl_salida sali, tbl_detalle_salida dexit 
			where sali.id_salida=dexit.Salida_id_salida and dexit.Salida_id_salida=?";
			try{
				$resultado = mainModel::conectar()->prepare($buscar);

				$datosUrl = explode("/",$_GET["views"]);
				$id = mainModel::decryption($datosUrl[1]);

				$resultado->execute(array($id));

                foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$usuario = new exitModel();
				$usuario->__SET('producto_has_salida', $datos->producto_has_salida);
				$usuario->__SET('Salida_id_salida', $datos->id_salida);
				$usuario->__SET('fecha_salida', $datos->fecha_salida);
				$usuario->__SET('cantidad', $datos->cantidad);
				$usuario->__SET('Producto_id_producto', $datos->Producto_id_producto);
				$usuario->__SET('tipo_salida_tipo_salida', $datos->tipo_salida_tipo_salida);
				$datosExit[] = $usuario;
				}
				return $datosExit;
			}catch (Exception $e){
				echo "Error al buscar datos ".$e->getMessage();
			}
		}

		public function actualizar(exitModel $salida)
		{
			$buscar  = "UPDATE tbl_detalle_salida SET Producto_id_producto=?, cantidad=? WHERE producto_has_salida=?";
			try{
				$resultado = $this->conexion->prepare($buscar);
				$resultado->execute(array(
					$salida->__GET('Producto_id_producto'),
					$salida->__GET('cantidad'),
					$salida->__GET('producto_has_salida'),
				));

				$total=$salida->__GET('cantidad') - $salida->__GET('cantidadP');
				$cantidadcon = "UPDATE tbl_producto SET cantidad=? WHERE id_producto=?";	
				$cantidadresult=$this->conexion->prepare($cantidadcon)->execute(array(
					abs($total),
					$salida->__GET('Producto_id_producto')
				));
				
				return true;
			}catch (Exception $e){
				echo "Error al buscar datos ".$e->getMessage();
			}
		}

		public function eliminar($id)
		{
			$borrar = "DELETE FROM `tbl_detalle_salida` WHERE `producto_has_salida`=?;
			DELETE FROM tbl_salida WHERE id_salida=?";
			try{
				$this->conexion->prepare($borrar)->execute(array($id,$id));
				return true;
			}catch (Exception $e){
				echo "Error al eliminar datos ".$e->getMessage();
			}
		}
	}
