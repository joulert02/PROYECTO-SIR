<?php

$peticionAjax = true;

require_once "../core/configGeneral.php";

if (isset($_GET['Token'])) {
    require_once "../Controller/loginController.php";
    $logout = new loginController();
    echo $logout->cierre_sesion_controlador();
} else {
    session_start();
    session_destroy();
    echo '<script> window.location.href="' . SERVERURL . 'login/' . '" </script>';
}
