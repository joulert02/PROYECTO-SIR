<?php
if (isset($_REQUEST['estado']) && isset($_REQUEST['id'])) {
	$estado = (1 == $_REQUEST['estado']) ? 0 : 1;
	$idPersona = $_REQUEST['id'];
	var_dump($estado . $idPersona);
	try {
		    $con = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
		    // set the PDO error mode to exception
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully"; 
				$con->prepare("UPDATE `tbl_persona` SET `estado`=? WHERE id_persona=?")->execute(array(
					$estado,
					$idPersona
				));
				echo "datos registrados";
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
}else {

		if ($peticionAjax==true) {
			require_once "../Model/personModel.php";
		} else {
			require_once "./Model/personModel.php";
		}

class personController extends personModel
{

	public function agregar_persona_controlador(){
		$nombres = mainModel::limpiar_cadena($_POST["nombres"]);
		$apellidos = mainModel::limpiar_cadena($_POST["apellidos"]);
		$tipoD = mainModel::limpiar_cadena($_POST["tipo_documento_tipo_documento"]);
		$documento = mainModel::limpiar_cadena($_POST["documento"]);
		$telefono = mainModel::limpiar_cadena($_POST["telefono"]);
		$celular = mainModel::limpiar_cadena($_POST["nro_Celular"]);
		$direccion = mainModel::limpiar_cadena($_POST["direccion"]);
		$ciudad = mainModel::limpiar_cadena($_POST["ciudad"]);
		$departamento = mainModel::limpiar_cadena($_POST["departamento"]);
		$tipoP = mainModel::limpiar_cadena($_POST["tipo_persona_tipo_persona"]);
		$estado = mainModel::limpiar_cadena($_POST["estado"]);

		$consulta1 = mainModel::ejecutar_consulta_simple("SELECT `documento` FROM `tbl_persona` WHERE documento=$documento");
		if ($consulta1->rowCount() >= 1) {
			echo '<div class="alert alert-danger" role="alert">
			Esté documento ya se encuentra registrado
		</div>';
			$alerta = [
				"Alerta" => "simple",
				"Titulo" => "Ocurrio un error inesperado",
				"Texto" => "El documento que acaba de ingresar ya se encuentra registrado en el sistema",
				"Tipo" => "error"
			];
		}else {
			$dataPerson=[
				"nombres" => $nombres,
				"apellidos" => $apellidos,
				"tipoD" => $tipoD,
				"documento" => $documento,
				"telefono" => $telefono,
				"celular" => $celular,
				"direccion" => $direccion,
				"ciudad" => $ciudad,
				"departamento" => $departamento,
				"tipoP" => $tipoP,
				"estado" => $estado
			];
			$guardarPerson = personModel::agregar_persona_modelo($dataPerson);

			if ($guardarPerson->rowCount() >= 1) {
				$alerta = [
					"Alerta" => "limpiar",
					"Titulo" => "Persona Registrada",
					"Texto" => "La persona se ha registrado con exito en el sistema.",
					"Tipo" => "success"
				];
			} else {
				$alerta = [
					"Alerta" => "simple",
					"Titulo" => "Ocurrio un error inesperado",
					"Texto" => "No hemos podido registrar la persona",
					"Tipo" => "error"
				];
			}
			
		}
		return mainModel::sweet_alert($alerta);
	}

	public function consultarTipoDocumento()
	{
		$personModel = new personModel();
		return $personModel->consultarTipoDocumento();
	}

	public function consultarTipoPersona()
	{
		$personModel = new personModel();
		return $personModel->consultarTipoPersona();
	}

	public function insertar(personModel $usuario)
	{
		$personModel = new personModel();
		return $personModel->insertar($usuario);
	}
	
	public function listar()
	{
		$personModel = new personModel();
		return $personModel->listar();
	}
	
	public function buscar($id)
	{
		$personModel = new personModel();
		return $personModel->buscar($id);
	}

	public function actualizar(personModel $usuario)
	{
		$personModel = new personModel();
		return $personModel->actualizar($usuario);
	}

	public function eliminar($id)
	{
		$personModel = new personModel();
		return $personModel->eliminar($id);
	}
}
}

?>