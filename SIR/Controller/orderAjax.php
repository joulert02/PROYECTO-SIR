<?php
$conexion = new PDO("mysql:host=localhost;dbname=s.i.r;charset=utf8", "root", "");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_REQUEST['Producto_id_producto']) && isset($_REQUEST['cantidad'])) {
    $Producto_id_producto = $_REQUEST['Producto_id_producto'];
    $cantidad = $_REQUEST['cantidad'];
    $valor = $_REQUEST['valor'];
    $detalles = "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id) values (?,?,?,?)";
    try {
        session_start();

        $session_id = session_id();
        $conexion->prepare($detalles)->execute(array(
            $Producto_id_producto,
            $cantidad,
            $valor,
            $session_id
        ));
        echo 1;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else if (isset($_REQUEST['listar'])) {
    $json = array();
    $consulta = "SELECT id_tmp,t.id_producto,t.cantidad_tmp,i.nombre_producto,i.referencia,i.precio_unitario FROM tmp t JOIN tbl_producto i ON i.id_producto = t.id_producto";
    try {
        $resultado = $conexion->query($consulta);
        $resultado->execute();

        foreach ($resultado->fetchAll(PDO::FETCH_OBJ) as $datos) {
            $json[] = array(
                'idTmp' => $datos->id_tmp,
                'Producto_id_producto' => $datos->id_producto,
                'precio_unitario' => $datos->precio_unitario,
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
} else if (isset($_REQUEST['Producto_id_producto'])) {
    $cod = $_REQUEST['Producto_id_producto'];
    $consulta = "DELETE FROM `tmp` WHERE `id_tmp`=$cod";
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
                'precio_unitario' => $datos->precio_unitario,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
