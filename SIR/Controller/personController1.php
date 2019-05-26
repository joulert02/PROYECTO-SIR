<?php 
if (isset($_REQUEST['idp'])) {
	$idpersona = $_REQUEST['idp'];
	$json=array();
	try {
		    $con = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
		    // set the PDO error mode to exception
		    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "Connected successfully"; 
				$resultado = $con->prepare("SELECT * FROM tbl_persona WHERE id_persona=? ORDER BY id_persona DESC");
				$resultado->execute(array(
					$idpersona
				));

				foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
					$json[] = array(
						'nombres' => $datos->nombres,
						'apellidos' => $datos->apellidos,
						
						'documento' => $datos->documento,
						'telefono' => $datos->telefono,
						'nro_Celular' => $datos->nro_Celular,
						'direccion' => $datos->direccion,
						'ciudad' => $datos->ciudad,
						'departamento' => $datos->departamento,
						'tipo_persona_tipo_persona'=> $datos->tipo_persona_tipo_persona,
						'estado' => $datos->estado,
					);
				}

				$jsonstring = json_encode($json);
				echo $jsonstring;
		
		    }catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
    }
}
?>



