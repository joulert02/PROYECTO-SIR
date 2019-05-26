	<?php
	require_once "Model/personModel1.php";
	require_once "Controller/personController.php";
	require_once "Model/tipoDocumento_Persona_model.1.php";
	$usuario = new  personModel1();
	$tipoDocumentoPersonModel= new tipoDocumentoPersonModel1();
	//CONEXION
	$conec = new PDO("mysql:host=localhost;dbname=s.i.r;charset=utf8;", "root", "");
	// set the PDO error mode to exception
	$conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Connected successfully"; 
			$resultado;
			$buscar  = "SELECT * FROM tbl_persona WHERE id_persona=?";
				$resultado = $conec->prepare($buscar);

				$datosUrl = explode("/",$_GET["views"]);
				$idP = mainModel::decryption($datosUrl[1]);

				$resultado->execute(array($idP));

				$datos = $resultado->fetch(PDO::FETCH_OBJ);
				$usuario = new personModel1();
				$usuario->__SET('id_persona', $datos->id_persona);
				$usuario->__SET('nombres', $datos->nombres);
				$usuario->__SET('apellidos', $datos->apellidos);
				$usuario->__SET('tipo_documento_tipo_documento', $datos->tipo_documento_tipo_documento);
				$usuario->__SET('documento', $datos->documento);
				$usuario->__SET('telefono', $datos->telefono);
				$usuario->__SET('nro_Celular', $datos->nro_Celular);
				$usuario->__SET('direccion', $datos->direccion);
				$usuario->__SET('ciudad', $datos->ciudad);
				$usuario->__SET('departamento', $datos->departamento);
				$usuario->__SET('tipo_persona_tipo_persona', $datos->tipo_persona_tipo_persona);
				$usuario->__SET('estado', $datos->estado);	

				$resultado = $usuario;

?>
<style type="text/css">
   .container{  
    width:900px;
    height: 575px;
  }
</style>
     <br>
	<div class="container-fluid">
		<div class="col-md-10 col-xs-12 col-md-offset-1 mt-1">
      <div class="panel panel-default">
          <div class="panel-heading clearfix">&nbsp&nbsp
             <span class="glyphicon glyphicon-edit fa-fax3 fa-lg"></span>
             <label ><h4><b>Editar Persona</b></h4></label>
          </div>
      <div class="panel-body"> 
		<form action="" method="POST" class="ml-2" id="validate_form">
			<div class="form-row">
					<input type="hidden" name="id_persona" class="form-control" disabled="" value="<?php echo $resultado->id_persona ?>">
				<div class="col-md-4 mb-3">
					<label>Nombres</label>
					<input type="text" name="nombres" class="form-control" required data-parsley-length="[3,20]" value="<?php echo $resultado->nombres ?>">
				</div>
				<div class="col-md-4 mb-3">
					<label>Apellidos</label>
					<input type="text" name="apellidos" class="form-control" required data-parsley-length="[3,20]" value="<?php echo $resultado->apellidos ?>">
				</div>
				<div class="col-md-4 mb-3">
					<!-- <label>Tipo Documento</label><br>
					<select name="tipo_documento_tipo_documento" class="custom-select">
					<option value="true" disabled>seleccionar tipo documento</option>
						<?php
							// if ($resultado->tipo_documento_tipo_documento==1) {
							// 	echo '<option value="1" selected>Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3">Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==2) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2" selected>Tarjeta Identidad</option>
							// 	<option value="3">selected>Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==3) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3" selected>Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==4) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3">selected>Cedula Ciudadania</option>
							// 	<option value="4"selected>Tarjeta Identidad</option>
							// 	<option value="5">Registro Civil</option>';
							// }elseif ($resultado->tipo_documento_tipo_documento==5) {
							// 	echo '<option value="1">Cedula Ciudadania</option>
							// 	<option value="2">Tarjeta Identidad</option>
							// 	<option value="3" >selected>Cedula Ciudadania</option>
							// 	<option value="4">Tarjeta Identidad</option>
							// 	<option value="5"selected>Registro Civil</option>';
							// }
						?>
					</select>
					<br><br> -->
					<label>seleccionar tipo documento</label>
					<select name="tipo_documento_tipo_documento" class="custom-select form-control" placeholder="Seleccione Estado"  required ="">
            <option value="true" disabled>Seleccione tipo</option>
            <?php
						$tipoDocumento = array();
						$consultar = "SELECT * FROM tbl_tipo_documento";
							$resultadoTipo = $conec->query($consultar);
			
							foreach ($resultadoTipo->fetchAll(PDO::FETCH_OBJ) as $dato) {
								$tipo = new tipoDocumentoPersonModel1();
								$tipo->__SET('tipo_documento', $dato->tipo_documento);
								$tipo->__SET('nombre_documento', $dato->nombre_documento);
			
								$tipoDocumento[] = $tipo;
							}
					
              foreach ($tipoDocumento as $dat) {
                  if ($dat->tipo_documento==$resultado->tipo_documento_tipo_documento) {
									echo '<option value="'.$resultado->tipo_documento_tipo_documento.'"selected>'.$dat->nombre_documento.'</option>';
                }else{
									echo '<option value="'.$dat->tipo_documento.'">'.$dat->nombre_documento.'</option>';
								}
							}
            ?>
          </select><br>
					
				</div>
				<div class="col-md-4 mb-3">
					<label>Documento</label>
					<input type="text" name="documento" class="form-control" required data-parsley-length="[10,14]" data-parsley-type="number" value="<?php echo $resultado->__GET('documento') ?>">
				</div>
				<div class="col-md-4 mb-3">
					<label>Teléfono</label>
					<input type="text" name="telefono" class="form-control" data-parsley-length="[7,10]" data-parsley-type="number" value="<?php echo $resultado->telefono ?>">
				</div>
				<div class="col-md-4 mb-3">
					<label>Celular</label>
					<input type="text" name="nro_Celular" class="form-control" required data-parsley-length="[10,12]" data-parsley-type="number" value="<?php echo $resultado->nro_Celular ?>"><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Dirección</label>
					<input type="text" name="direccion" class="form-control" required data-parsley-length="[4,25]" value="<?php echo $resultado->direccion ?>">
				</div>
				<div class="col-md-4 mb-3">
					<label>Ciudad</label>
					<select type="text" name="ciudad" class="custom-select form-control" required >
					<option style="display: none;" value="<?php echo $resultado->ciudad ?>"selected><?php echo $resultado->ciudad ?></option>
					<option  disabled>Seleccione Ciudad</option>
					<option value="Amaga">Amaga</option>
								<option value="Amalfi">Amalfi</option>
								<option value="Apartadór">Apartadór</option>
								<option value="Barbosa">Barbosa</option>
								<option value="Barranquilla">Barranquilla</option>
								<option value="Bello">Bello</option>
								<option value="Bogotá">Bogotá</option>
								<option value="Bucaramanga">Bucaramanga</option>
								<option value="Caldas">Caldas</option>
								<option value="Cali">Cali</option>
								<option value="Cartagena">Cartagena</option>
								<option value="Caucasia">Caucasia</option>
								<option value="Cúcuta">Cúcuta</option>
								<option value="Envígado">Envígado</option>
								<option value="Girardota">Girardota</option>
								<option value="Ibagué">Ibagué</option>
								<option value="Itaguí">Itaguí</option>
								<option value="Jericó">Jericó</option>
								<option value="Marinilla">Marinilla</option>
								<option value="Medellín">Medellín</option>
								<option value="Pasto">Pasto</option>
								<option value="Peñol">Peñol</option>
								<option value="Remedios">Remedios</option>
								<option value="Rio Negro">Rio Negro</option>
								<option value="San Pedro">San Pedro</option>
								<option value="Santa Fé">Santa Fé</option>
								<option value="Santa Marta">Santa Marta</option>
								<option value="Santa Rosa">Santa Rosa</option>
								<option value="Soacha">Soacha</option>
								<option value="Soledad">Soledad</option>
								<option value="Sonsón">Sonsón</option>
								<option value="Turbo">Turbo</option>
								<option value="Yarumal">Yarumal</option>

					</select>
				</div>
				<div class="col-md-4 mb-3">
							<label>Departamento</label>
							<select name="departamento" class="custom-select form-control" required >
								<option style="display: none;" value="<?php echo $resultado->departamento ?>"selected><?php echo $resultado->departamento ?></option>
								<option disabled>Seleccione departamento</option>
								<option value="Amazonas">Amazonas</option> 
								 <option value="Antioquia">Antioquia</option>
								 <option value="Arauca">Arauca</option>
								 <option value="Atlántico">Atlántico</option>
								<option value="Bolívar">Bolívar</option>
								 <option value="Boyacá">Boyacá</option> 
								 <option value="Caldas">Caldas</option> 
								 <option value="Caquetá">Caquetá</option> 
								 <option value="Casanare">Casanare</option>
								 <option value="Cauca">Cauca</option>
								<option value="Cesar">Cesar</option>
								<option value="Chocó">Chocó</option> 
								<option value="Córdoba">Córdoba</option>
								<option value="Cundinamarca">Cundinamarca</option>
								<option value="Guainía">Guainía</option>
								 <option value="Guaviare">Guaviare</option>
								<option value="Huila">Huila</option>
								 <option value="Guajira">Guajira</option>
								 <option value="Magdalena">Magdalena</option>
								 <option value="Meta">Meta</option>
								<option value="Nariño">Nariño</option>
								 <option value="Norte de Santander">Norte de Santander</option>
								<option value="Putumayo">Putumayo</option>
								 <option value="Quindio">Quindio</option>
								 <option value="Risaralda">Risaralda</option>
								 <option value="San Andres">San Andres</option> 
								 <option value="Santander">Santander</option>
								<option value="Sucre">Sucre</option>
								 <option value="Tolima">Tolima</option>
								 <option value="Valle del Cauca">Valle del Cauca</option>
								<option value="Vaupés">Vaupés</option>
								 <option value="Vichada">Vichada</option>

							</select><br>
						</div>
				<div class="col-md-4 mb-3">
							<!-- forma larga y estudipa -->
					<!-- <label>Tipo Persona</label><br>
					<select name="tipo_persona_tipo_persona" class="custom-select" required="">
						<option value="true" disabled>seleccionar tipo persona</option>
						<?php
							// if ($resultado->tipo_persona_tipo_persona==1) {
							// 	echo '<option value="1" selected>Proveedor</option>
							// 	<option value="2">Cliente</option>
							// 	<option value="3">jouler</option>';
							// }elseif ($resultado->tipo_persona_tipo_persona==2) {
							// 	echo '<option value="1">Proveedor</option>
							// 	<option value="2"selected>Cliente</option>
							// 	<option value="3">jouler</option>';
							// }elseif ($resultado->tipo_persona_tipo_persona==3) {
							// 	echo '<option value="1">Proveedor</option>
							// 	<option value="2">Cliente</option>
							// 	<option value="3"selected>jouler</option>';
							// }
						?>
					</select><br> -->
					<label>Tipo Persona</label><br>
					<select name="tipo_persona_tipo_persona" class="custom-select form-control" placeholder="Seleccione Tipo"  required ="">
            <option value="true" disabled>Seleccione tipo</option>
            <?php
						$tipoPersona = array();
						$consultar = "SELECT * FROM tbl_tipo_persona";
						$resultadoTipoP = $conec->query($consultar);
							
						foreach ($resultadoTipoP->fetchAll(PDO::FETCH_OBJ) as $dato) {
							$tipo = new tipoDocumentoPersonModel1();
							$tipo->__SET('tipo_persona', $dato->tipo_persona);
							$tipo->__SET('nombre_tipo', $dato->nombre_tipo);
							$tipoPersona[]=$tipo;
						}
            foreach ($tipoPersona as $dat) {
              if ($dat->tipo_persona==$resultado->tipo_persona_tipo_persona) {
								echo '<option value="'.$resultado->tipo_persona_tipo_persona.'"selected>'.$dat->nombre_tipo.'</option>';
              }else{
								echo '<option value="'.$dat->tipo_persona.'">'.$dat->nombre_tipo.'</option>';
							}
						}
            ?>
          </select><br>
				</div>
				<div class="col-md-4 mb-3">
					<label>Estado</label><br>
					<select name="estado" class="custom-select form-control" required="">				
						<option value="true" disabled>seleccionar estado</option>
						<?php
							if ($resultado->estado==1) {
								echo '<option value="1" selected>Activo</option>
								<option value="2">Inactivo</option>';
							}elseif ($resultado->estado==0) {
								echo '<option value="1">Activo</option>
								<option value="2"selected>Inactivo</option>';
							}
						?>
					</select><br>
				</div>
			</div>
			<div class="col-md-12">
				<input type="submit" name="actualizar" class="btn btn-primary" value="Actualizar">
				<input type="reset" value="Limpiar" class="btn btn-secondary">
				<!-- <button type="submit" class="categoria-cancelar">Cancelar</button> -->
    		<a href="<?php echo SERVERURL; ?>listPerson" class="btn btn-danger"  style="float: right;">Cancelar</a>
			</div>
		</form>
	</div>
</div>
</div>
</div>

        <script>  
        $(document).ready(function(){  
        $('#validate_form').parsley();
        });  
        </script>


		<script>  
		$(document).on('click', '.categoria-cancelar', function(){
		 window.close();
    });
        $(document).ready(function(){  
		 window.close();
			 
       });  
       </script>

		<?php
			if (isset($_POST["actualizar"])) {
				$respuesta;
				$usuario->__SET('id_persona', $idP);
				$usuario->__SET('nombres', $_POST["nombres"]);
				$usuario->__SET('apellidos', $_POST["apellidos"]);
				$usuario->__SET('tipo_documento_tipo_documento', $_POST["tipo_documento_tipo_documento"]);
				$usuario->__SET('documento', $_POST["documento"]);
				$usuario->__SET('telefono', $_POST["telefono"]);
				$usuario->__SET('nro_Celular', $_POST["nro_Celular"]);
				$usuario->__SET('direccion', $_POST["direccion"]);
				$usuario->__SET('ciudad', $_POST["ciudad"]);
				$usuario->__SET('departamento', $_POST["departamento"]);
				$usuario->__SET('tipo_persona_tipo_persona', $_POST["tipo_persona_tipo_persona"]);
				$usuario->__SET('estado', $_POST["estado"]);

				$insertar = "UPDATE tbl_persona SET nombres=?, apellidos=?, tipo_documento_tipo_documento=?, documento=?, telefono=?, nro_Celular=?, direccion=?, ciudad=?, departamento=?, tipo_persona_tipo_persona=?, estado=? WHERE id_persona=?";
				try{
					$conec->prepare($insertar)->execute(array(
						$usuario->__GET('nombres'),
						$usuario->__GET('apellidos'),
						$usuario->__GET('tipo_documento_tipo_documento'),
						$usuario->__GET('documento'),
						$usuario->__GET('telefono'),
						$usuario->__GET('nro_Celular'),
						$usuario->__GET('direccion'),
						$usuario->__GET('ciudad'),
						$usuario->__GET('departamento'),
						$usuario->__GET('tipo_persona_tipo_persona'),
						$usuario->__GET('estado'),
						 $idP
					));
					echo'<script>  swal({title: "Persona Actualizada",    
						text: "La persona sido Actualida en el sistema con exito.", 
						type:"success", 
						confirmButtonText: "OK", 
						closeOnConfirm: true 
					}, 
					function(){ 
						window.location.href = "'.SERVERURL.'listPerson";
					});  </script>';
				}catch (Exception $e){
					echo'<script>  swal({title: "Error Inesperado",    
						text: "Ha ocurrido un error inesperado, se recargara la pagina.", 
						type:"success", 
						confirmButtonText: "OK", 
						closeOnConfirm: true 
					}, 
					function(){ 
						window.location.href = "'.SERVERURL.'editProduct";
					});  </script>';
				}
}
 ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery.js"></script>
  <script src="../../public/js/sweetalert.min.js"></script>                
  <script src="../../public/js/sweetalert-dev.js"></script>   
 </div>