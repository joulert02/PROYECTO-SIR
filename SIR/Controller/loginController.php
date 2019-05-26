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

        if ($datosCuenta->rowCount() == 1) {
            $row = $datosCuenta->fetch();

            session_start(['name' => 'SIR']);
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['usuario_sir'] = $row['nombre'];
            $_SESSION['correo_sir'] = $row['correo'];
            $_SESSION['password_sir'] = $row['password'];
            $_SESSION['imagen_sir'] = $row['imagen'];
            $_SESSION['url_sir'] = $row['url'];
            $_SESSION['token_sir'] = md5(uniqid(mt_rand(), true));
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Sesión Iniciada",
                "Texto" => "Has Iniciado Sesión Correctamente",
                "Tipo" => "success",
                "url" => "homeAdmin/"
            ];
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

    public function cambiar_clave_controlador(string $url)
    {
        $clave = mainModel::limpiar_cadena($_POST["password"]);
        $clave = mainModel::encryption($clave);
        $datosLogin = [
            "usuario" => 1,
            "clave" => $clave
        ];
        $datosCuenta = loginModel::cambiar_clave_modelo($datosLogin);

        if ($datosCuenta->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Contrase Actualizada",
                "Texto" => "La Contraseña Ha Sido Actualizada Con Éxito",
                "Tipo" => "success",
                "url" => $url,
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No Se Pudo Cambiar La contraseña Intente mas tarde",
                "Tipo" => "error"
            ];
        }
        return mainModel::sweet_alert($alerta);
    }

    public function forzar_cierre_sesion_controlador()
    {
        session_destroy();
        return $location = SERVERURL . "403/";
    }

    public function cierre_sesion_controlador()
    {
        session_start(['name' => 'SIR']);
        $token = mainModel::decryption($_GET['Token']);
        $datos=[
            "usuario" => $_SESSION['usuario_sir'],
            "Token_S" => $_SESSION['token_sir'],
            "Token" => $token,
        ];
        return loginModelo::cierre_sesion_modelo($datos);
        // echo '<script type="text/javascript"> 
        //         swal({title: "Sesion Cerrada",    
        //             text: "Sessión Cerrada Con Exito.", 
        //             type:"success", 
        //             confirmButtonText: "OK", 
        //             closeOnConfirm: true 
        //             }, 
        //             function(){ 
        //             window.location.href="' . SERVERURL . 'login/"; 
        //             });  
        //         </script>';
    }
}
