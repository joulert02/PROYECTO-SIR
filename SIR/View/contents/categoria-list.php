<?php
    include_once 'http://localhost:8080/PROYECTO-SIR/SIR/View/contents/database.php';

		$json=array();
		$consulta="SELECT * FROM tbl_categoria_producto ORDER BY id_categoria ";
		try {
			$resultado=$conn->query($consulta);
            $resultado->execute();
            
			foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
				$json[] = array(
                    'idCategoria' => $datos->id_Categoria,
                    'nombre' => $datos->categoria,
                    'estado' => $datos->estado,
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
		} catch (Exception $e) {
			die($e->getMessage());
		}
?>