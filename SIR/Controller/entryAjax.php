<?php
$conexion = new PDO("mysql:host=localhost;dbname=s.i.r;charset=utf8", "root", "");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_REQUEST['Producto_id_producto']) && isset($_REQUEST['cantidad']) && isset($_REQUEST['tipo'])) {
    $Producto_id_producto = $_REQUEST['Producto_id_producto'];
    $cantidad = $_REQUEST['cantidad'];
    $tipo = $_REQUEST['tipo'];
    $detalles = "INSERT INTO tmp_entrada (id_producto,cantidad_tmp,tipo) values (?,?,?)";
    $consultar = "SELECT * FROM `tmp_entrada` WHERE tipo=$tipo";
    $editar = "UPDATE `tmp_entrada` SET `cantidad_tmp`=? WHERE id_producto=? AND tipo = ?";
    $igual = 0;
    try {
        $respuesta = $conexion->prepare($consultar);
        $respuesta->execute();
        // var_dump($respuesta->fetchAll(PDO::FETCH_OBJ));
        // echo $id;
        foreach ($respuesta->fetchAll(PDO::FETCH_OBJ) as $value) {
            if ($value->id_producto == $Producto_id_producto) {
                $nuevaC=$cantidad+$value->cantidad_tmp;
                $conexion->prepare($editar)->execute(array(
                    $nuevaC,
                    $Producto_id_producto,
                    $tipo
                ));
                $igual = 1;
            }
        }
        if ($igual == 0) {
            $conexion->prepare($detalles)->execute(array(
                $Producto_id_producto,
                $cantidad,
                $tipo
            ));
            echo 1;
        } else {
            echo 2;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else if (isset($_REQUEST['listar']) && isset($_REQUEST['tipo'])) {
    $tipo = $_REQUEST['tipo'];
    $json = array();
    $consulta = "SELECT id_tmp,t.id_producto,t.cantidad_tmp,i.nombre_producto,i.referencia FROM tmp_entrada t JOIN tbl_producto i ON i.id_producto = t.id_producto WHERE tipo=$tipo";
    try {
        $resultado = $conexion->query($consulta);
        $resultado->execute();

        foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
            $json[] = array(
                'idTmp' => $datos->id_tmp,
                'Producto_id_producto' => $datos->id_producto,
                'cantidad' => $datos->cantidad_tmp,
                'nombre_producto' => $datos->nombre_producto,
                'referencia' => $datos->referencia,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else if (isset($_REQUEST['Producto_id_producto']) && isset($_REQUEST['tipo'])) {
    $tipo = $_REQUEST['tipo'];
    $cod = $_REQUEST['Producto_id_producto'];
    $consulta = "DELETE FROM `tmp_entrada` WHERE `id_tmp`=$cod and tipo=$tipo";
    try {
        $resultado = $conexion->query($consulta);
        $resultado->execute();
        echo "delete";
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    $json = array();
    $consulta = "SELECT * FROM tbl_producto";
    try {
        $resultado = $conexion->query($consulta);
        $resultado->execute();

        foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
            $json[] = array(
                'Producto_id_producto' => $datos->id_producto,
                'nombre_producto' => $datos->nombre_producto,
                'referencia' => $datos->referencia,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
