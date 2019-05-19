<?php
if ($peticionAjax == true) {
    require_once "../Model/loginModel.php";
    require_once "../core/configGeneral.php";
} else {
    require_once "./Model/loginModel.php";
    require_once "./core/configGeneral.php";
}

class loginController extends loginModel
{

    public function iniciar_sesion_controlador()
    {
        $usuario = mainModel::limpiar_cadena($_POST["usuario"]);
        $clave = mainModel::limpiar_cadena($_POST["clave"]);
        $clave = mainModel::encryption($clave);
        $datosLogin = [
            "usuario" => $usuario,
            "clave" => $clave
        ];

        $datosCuenta = loginModel::iniciar_sesion_modelo($datosLogin);
        $usu = $_POST["usuario"];
        $pass = $_POST["clave"];

        if ($datosCuenta->rowCount() == 1) {
            $row = $datosCuenta->fetch();

            session_start(['name' => 'SIR']);
            $_SESSION['usuario_sir'] = $row['nombre'];
            $_SESSION['correo_sir'] = $row['correo'];
            $_SESSION['imagen_sir'] = $row['imagen'];
            $_SESSION['url_sir'] = $row['url'];
            $_SESSION['token_sir'] = md5(uniqid(mt_rand(), true));
            $url = SERVERURL . "homeAdmin/";

            return $urlLocation = '<script>window.location.href="' . $url . '";</script>';
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre de usuario y contraseña no son correctos",
                "Tipo" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }

    public function forzar_cierre_sesion_controlador(){
        session_destroy();
        return $location = SERVERURL."login/";
    }
}
