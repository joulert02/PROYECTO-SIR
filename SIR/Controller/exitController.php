<?php

if (isset($_REQUEST['id'])) {
	$idDetalle = $_REQUEST['id'];
	$json=array();
	try {
		    $con = new PDO("mysql:host=localhost;dbname=s.i.r;charset=utf8", "root", "");
		    // set the PDO error mode to exception
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully"; 
				$resultado = $con->prepare("SELECT pro.nombre_producto,ts.nombre, s.fecha_salida, pro.referencia, dt.cantidad FROM tbl_producto pro 
				JOIN tbl_detalle_salida dt ON dt.Producto_id_producto = pro.id_producto JOIN tbl_salida s on s.id_salida = dt.Salida_id_salida JOIN
				 tbl_tipo_salida ts on s.tipo_salida_tipo_salida = ts.tipo_salida WHERE dt.Salida_id_salida = ?");
				$resultado->execute(array(
					$idDetalle
				));

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
					$json[] = array(
						'nombre_producto' => $datos->nombre_producto,
						'referencia' => $datos->referencia,
						'cantidad' => $datos->cantidad,
						'fecha_salida' => $datos->fecha_salida,
						'tipoSalida' => $datos->nombre,
					);
				}

				$jsonstring = json_encode($json);
				echo $jsonstring;
		
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
}else {

if ($peticionAjax==true) {
	require_once "../Model/exitModel.php";
} else {
	require_once "./Model/exitModel.php";
}

	class exitController 
	{
		public function listar()
		{
			$salidaModel = new exitModel();
			return $salidaModel->listar();
		}
		public function insertar(exitModel $salida)
		{
			$salidaModel = new exitModel();
			return $salidaModel->insertar($salida);
		}
		public function buscar($id)
		{
			$salidaModel = new exitModel();
			return $salidaModel->buscar($id);
		}
		public function actualizar(exitModel $salida)
		{
			$salidaModel = new exitModel();
			return $salidaModel->actualizar($salida);
		}

		public function eliminar($id)
		{
			$salidaModel = new exitModel();
			return $salidaModel->eliminar($id);
		}
	}
}
?>