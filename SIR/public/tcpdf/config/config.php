<?php 
		class Conexion{
			var $ruta;
			var $usuario;
			var $contrasena;
			var $baseDatos;
		
			function Conexion(){
				$this->ruta="localhost"; //
				$this->usuario="root"; //usuario que tengas definido
				$this->contrasena=""; //contraseña que tengas definidad
				$this->baseDatos="s.i.r"; //base de datos personas, si quieres utilizar otra base de datos solamente cambiala
			}
			
			function conectarse(){		
			
				$enlace = mysqli_connect($this->ruta, $this->usuario, '', $this->baseDatos);
				if($enlace){
					
				}else{
					die('Error de Conexión (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
				}
				return($enlace);
				
			}
		}

?>
