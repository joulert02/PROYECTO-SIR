<?php
if (isset($_REQUEST['id'])) {
	$idDetalle = $_REQUEST['id'];
	$json=array();
	try {
		    $con = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
		    // set the PDO error mode to exception
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully"; 
				$resultado = $con->prepare("SELECT pro.nombre_producto, e.fecha_entrada, pro.referencia, dt.cantidad FROM tbl_producto pro JOIN tbl_detalle_entrada dt 
				ON dt.Producto_id_producto = pro.id_producto JOIN tbl_entrada e on e.id_entrada = dt.Entrada_id_entrada WHERE dt.Entrada_id_entrada =?");
				$resultado->execute(array(
					$idDetalle
				));

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
					$json[] = array(
						'nombre_producto' => $datos->nombre_producto,
						'referencia' => $datos->referencia,
						'cantidad' => $datos->cantidad,
						'fecha_entrada' => $datos->fecha_entrada,
					);
				}

				$jsonstring = json_encode($json);
				echo $jsonstring;
		
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
}else {

if ($peticionAjax==true) {
	require_once "../Model/entryModel.php";
} else {
	require_once "./Model/entryModel.php";
}

	class entryController1
	{
		public function listar()
		{
			$entradaModel = new entryModel();
			return $entradaModel->listar();
		}
		public function listarReferencias()
		{
			$entradaModel = new entryModel();
			return $entradaModel->listarReferencias(2);
		}
		public function insertar(entryModel $entrada)
		{
			$entradaModel = new entryModel();
			return $entradaModel->insertar($entrada);
		}
		public function buscar($id)
		{
			$entradaModel = new entryModel();
			return $entradaModel->buscar($id);
		}
		public function actualizar(entryModel $entrada)
		{
			$entradaModel = new entryModel();
			return $entradaModel->actualizar($entrada);
		}

		public function eliminar($id)
		{
			$entradaModel = new entryModel();
			return $entradaModel->eliminar($id);
		}
	}

}
?>