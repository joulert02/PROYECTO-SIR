<?php

$peticionAjax = true;

require_once "../core/configGeneral.php";
if (isset($_POST['referencia'])) {
    require_once "../Controller/productController.php";
    $insPerson = new productoController();
    
    if (isset($_POST['referencia']) && isset($_POST['nombre_producto']) && isset($_POST['precio_unitario']) && isset($_POST['Categoria_Producto_id_Categoria']) 
    && isset($_POST['Persona_id_persona']) && isset($_POST['cantidad']) && isset($_POST['estado'])) {
    
    echo $insPerson->agregar_producto_controlador();
    
    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login/'.'" </script>';
}
