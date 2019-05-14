<?php

$peticionAjax = true;

require_once "../core/configGeneral.php";

if (isset($_POST['documento'])) {
    require_once "../Controller/personController.php";
    $insPerson = new personController();
    
    if (isset($_POST['nombres']) && isset($_POST['tipo_documento_tipo_documento']) && isset($_POST['documento']) && isset($_POST['nro_Celular']) 
    && isset($_POST['direccion']) && isset($_POST['ciudad']) && isset($_POST['tipo_persona_tipo_persona']) && isset($_POST['estado'])) {
    
    echo $insPerson->agregar_persona_controlador();

    }
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="'.SERVERURL.'login/'.'" </script>';
}
