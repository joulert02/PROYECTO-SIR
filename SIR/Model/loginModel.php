<?php
if ($peticionAjax == true) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class loginModel extends mainModel
{
    protected function iniciar_sesion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM tbl_usuario WHERE correo = :correo AND password = :clave");
        $sql->bindParam(":correo", $datos['usuario']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->execute();
        return $sql;
    }
    protected function cambiar_clave_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE tbl_usuario SET password = :clave where id_usuario = :usuario");
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->execute();
        return $sql;
    }

    public function cierre_sesion_modelo($datos)
    {
        if ($datos['usuario'] != "" && $datos['Token_S']==$datos['Token']) {
            session_unset();
            session_destroy();
            $respuesta = "true";
        } else {
            $respuesta = "false";
        }
        return $respuesta;        
    }
}
