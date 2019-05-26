<?php
    if ($peticionAjax==true) {
        require_once "../core/configAPP.php";
    } else {
        require_once "./core/configAPP.php";
    }
    
    class mainModel{

        protected function conectar(){
				// set the PDO error mode to exception
                $enlace =  new PDO("mysql:host=localhost;dbname=s.i.r;charset=utf8", "root","");
                return $enlace;
        }

        protected function ejecutar_consulta_simple($consulta){
            $respuesta = self::conectar()->prepare($consulta);
            $respuesta->execute();
            return $respuesta;
        } 

        public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
        }
        
        protected function generar_codigo_aleatorio($letra,$longitud,$num){
            for ($i=1; $i <=$longitud ; $i++) { 
                $numero = rand(0,9);
                $letra.= $numero;
            }
            return $letra.$num;
        }

        protected function limpiar_cadena($cadena){
            //quitamos espacios en blanco
            $cadena = trim($cadena);
            // quitamos las barras invetidas \
            $cadena = stripslashes($cadena);
            $cadena = str_ireplace("<script>","",$cadena);
            $cadena = str_ireplace("</script>","",$cadena);
            $cadena = str_ireplace("<script src","",$cadena);
            $cadena = str_ireplace("<script type=","",$cadena);
            $cadena = str_ireplace("SELECT * FROM","",$cadena);
            $cadena = str_ireplace("DELETE FROM","",$cadena);
            $cadena = str_ireplace("INSERT INTO","",$cadena);
            $cadena = str_ireplace("--","",$cadena);
            $cadena = str_ireplace("^","",$cadena);
            $cadena = str_ireplace("[","",$cadena);
            $cadena = str_ireplace("]","",$cadena);
            $cadena = str_ireplace("==","",$cadena);
            $cadena = str_ireplace(";","",$cadena);
            return $cadena;
        }

        protected function sweet_alert($datos){
            if ($datos['Alerta']=="simple") {
                $alerta = "
                <script>
                    swal({
                        title: '".$datos['Titulo']."',
                        text: '".$datos['Texto']."',
                        type: '".$datos['Tipo']."',
                        confirmButtonText: 'Aceptar',
                    });
                </script>
                ";
            }elseif ($datos['Alerta']=="recargar") {
                $alerta = "
                    <script>
                        swal({
                            title: '".$datos['Titulo']."',
                            text: '".$datos['Texto']."',
                            type: '".$datos['Tipo']."',
                            confirmButtonText: 'Aceptar',
                        },
                        function(){
                            window.location.href='".SERVERURL.$datos['url']."'
                        });
                    </script>
                ";
            }elseif ($datos['Alerta']=="limpiar") {
                $alerta = "
                    <script>
                        swal({
                            title: '".$datos['Titulo']."',
                            text: '".$datos['Texto']."',
                            type: '".$datos['Tipo']."',
                            confirmButtonText: 'Aceptar',
                        },
                        function(){
                            $('.FormularioAjax')[0].reset();
                        });
                    </script>
                ";
            }
            return $alerta;
        }
    }