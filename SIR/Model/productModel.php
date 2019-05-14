<?php

if ($peticionAjax==true) {
		require_once "../core/mainModel.php";
include_once "tipoDocumento_Persona_model.php";
} else {
		require_once "./core/mainModel.php";
include_once "Model/tipoDocumento_Persona_model.php";
}

class productoModel extends mainModel
{
		private $id_producto;
		private $referencia;
		private $nombre_producto;
    private $precio_unitario;
    private $Categoria_Producto_id_Categoria;
    private $Persona_id_persona;
    private $cantidad;
    private $estado;

    public function __GET($atr)
	{
			return $this->$atr;
	}
	public function __SET($atr, $vl)
	{
		$this->$atr=$vl;
		}
		
		protected function agregar_producto_modelo($datos){
			// $conexion = new PDO("mysql:host=localhost;dbname=s.i.r;charset=utf8", "root","");
			// set the PDO error mode to exception
		$insertarP = "INSERT INTO tbl_producto(referencia, nombre_producto, precio_unitario,Categoria_Producto_id_Categoria, Persona_id_persona, cantidad, estado)
		VALUES (:referencia, :nombre_producto, :precio_unitario,  :Categoria_Producto_id_Categoria, :Persona_id_persona, :cantidad, :estado)";
		$sql= mainModel::conectar()->prepare($insertarP);
		$sql->bindParam(":referencia",$datos['referencia']);
		$sql->bindParam(":nombre_producto",$datos['nombre_producto']);
		$sql->bindParam(":precio_unitario",$datos['precio_unitario']);
		$sql->bindParam(":Categoria_Producto_id_Categoria",$datos['Categoria_Producto_id_Categoria']);
		$sql->bindParam(":Persona_id_persona",$datos['Persona_id_persona']);
		$sql->bindParam(":cantidad",$datos['cantidad']);
		$sql->bindParam(":estado",$datos['estado']);
		$sql->execute();

		return $sql;
	}

    public function insertar(productoModel $producto)
		{

			$insertar = "INSERT INTO tbl_producto(referencia, nombre_producto, precio_unitario,
			Categoria_Producto_id_Categoria, Persona_id_persona, cantidad, estado) VALUES (?,?,?,?,?,?,?)";
			try{
				$this->conexion->prepare($insertar)->execute(array(
					$producto->__GET('referencia'),
					$producto->__GET('nombre_producto'),
					$producto->__GET('precio_unitario'),
					$producto->__GET('Categoria_Producto_id_Categoria'),
					$producto->__GET('Persona_id_persona'),
					$producto->__GET('cantidad'),
					$producto->__GET('estado'),
				));

				return true;
			}catch (Exception $e){
				echo "Error al isertar datos: ".$e->getMessage();
			}
		}

		public function actualizar(productoModel $producto)
	{
		$actualizar="UPDATE `tbl_producto` SET `referencia`=? ,`nombre_producto`=?,`precio_unitario`=?,
		`Categoria_Producto_id_Categoria`=?,`Persona_id_persona`=?,`cantidad`=?,`estado`=? WHERE `id_producto`=?";
		try {
			$this->conexion->prepare($actualizar)->execute(array(
				$producto->__GET('referencia'),
				$producto->__GET('nombre_producto'),
				$producto->__GET('precio_unitario'),
				$producto->__GET('Categoria_Producto_id_Categoria'),
				$producto->__GET('Persona_id_persona'),
				$producto->__GET('cantidad'),
				$producto->__GET('estado'),
				$producto->__GET('id_producto'),
				));
			return true;

		} catch (Exception $e) {
			echo "error al ingresar datos ".$e->getMessage();
		}
	}

		public function listar()
	{
		$datosProductos=array();
		$consulta="SELECT * FROM `tbl_producto` ORDER BY `tbl_producto`.`id_producto` ASC";
		try {
			$resultado=mainModel::conectar()->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$producto = new productoModel();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre_producto',$datos->nombre_producto);
				$producto->__SET('referencia',$datos->referencia);
				$producto->__SET('precio_unitario',$datos->precio_unitario);
				$producto->__SET('Categoria_Producto_id_Categoria',$datos->Categoria_Producto_id_Categoria);
				$producto->__SET('Persona_id_persona',$datos->Persona_id_persona);
				$producto->__SET('cantidad',$datos->cantidad);
				$producto->__SET('estado',$datos->estado);
				$datosProductos[]=$producto;
			}
			return $datosProductos;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function stockMinimo()
	{
		$datosProductos=array();
		$consulta="SELECT * FROM tbl_producto WHERE cantidad <=30 ";
		try {
			$resultado=mainModel::conectar()->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$producto = new productoModel();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre_producto',$datos->nombre_producto);
				$producto->__SET('referencia',$datos->referencia);
				$producto->__SET('precio_unitario',$datos->precio_unitario);
				$producto->__SET('Categoria_Producto_id_Categoria',$datos->Categoria_Producto_id_Categoria);
				$producto->__SET('Persona_id_persona',$datos->Persona_id_persona);
				$producto->__SET('cantidad',$datos->cantidad);
				$producto->__SET('estado',$datos->estado);
				$datosProductos[]=$producto;
			}
			return $datosProductos;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function stockMaximo()
	{
		$datosProductos=array();
		$consulta="SELECT * FROM tbl_producto WHERE cantidad >=150 ";
		try {
			$resultado=mainModel::conectar()->prepare($consulta);
			$resultado->execute();
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$producto = new productoModel();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre_producto',$datos->nombre_producto);
				$producto->__SET('referencia',$datos->referencia);
				$producto->__SET('precio_unitario',$datos->precio_unitario);
				$producto->__SET('Categoria_Producto_id_Categoria',$datos->Categoria_Producto_id_Categoria);
				$producto->__SET('Persona_id_persona',$datos->Persona_id_persona);
				$producto->__SET('cantidad',$datos->cantidad);
				$producto->__SET('estado',$datos->estado);
				$datosProductos[]=$producto;
			}
			return $datosProductos;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function buscar($id_producto)
	{
		$buscar="SELECT * FROM tbl_producto where id_producto=?";
		try {
			$resultado=mainModel::conectar()->prepare($buscar);
			$resultado->execute(array($id_producto));
			
			$datos=$resultado->fetch(PDO::FETCH_OBJ);
			if ($datos==null) {
				return false;
			}else {
				$producto = new productoModel();
				$producto->__SET('id_producto',$datos->id_producto);
				$producto->__SET('nombre_producto',$datos->nombre_producto);
				$producto->__SET('referencia',$datos->referencia);
				$producto->__SET('precio_unitario',$datos->precio_unitario);
				$producto->__SET('Categoria_Producto_id_Categoria',$datos->Categoria_Producto_id_Categoria);
				$producto->__SET('Persona_id_persona',$datos->Persona_id_persona);
				$producto->__SET('cantidad',$datos->cantidad);
				$producto->__SET('estado',$datos->estado);
				return $producto;
		}

		} catch (Exception $e) {
			echo "error al buscar ".$e->getMessage();
		}
	}

	public function eliminar($id_producto)
	{
		$borrar="DELETE  FROM tbl_producto WHERE id_producto=?";
		try {
			$this->conexion->prepare($borrar)->execute(array($id_producto));
			return true;

		} catch (Exception $e) {
			echo "error al eliminar datos ".$e->getMessage();
		}
	}

}
?>