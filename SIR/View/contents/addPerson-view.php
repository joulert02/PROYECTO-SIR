<?php
require_once "Controller/personController.php";
$tipoDocumentoPersona = new tipoDocumentoPersonModel();
?>

<div class="container-fluid">
	<div class="col-md-10 col-xs-12 col-md-offset-1 mt-1">
		<!-- Card Form -->
		<div class="panel panel-default">
			<!-- title -->
			<div class="panel-heading clearfix">
				<h4><strong><span class="fa fa-user-plus fa-lg" style="padding-right: 5px;"></span>Nueva Persona</strong></h4>
			</div>
			<div class="panel-body">
				<!-- Person Form  -->
				<form data-form="save" action="<?php echo SERVERURL; ?>ajax/personAjax.php" method="POST" class="FormularioAjax" id="validate_form" autocomplete="off" enctype="multipart/form-data">
					<div class="RespuestaAjax row col-md-12"></div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label>Nombres</label>
							<input type="text" name="nombres" class="form-control" required data-parsley-length="[3,20]">
						</div>
						<div class="col-md-4 mb-3">
							<label>Apellidos</label>
							<input type="text" name="apellidos" class="form-control" required data-parsley-length="[3,20]">
						</div>
						<div class="col-md-4 mb-3 ">
							<label>Tipo Documento</label>
							<select name="tipo_documento_tipo_documento" class="custom-select form-control" required="">
								<option value="true" selected disabled>Seleccione un documento</option>
								<?php
								foreach ($tipoDocumentoPersona->consultarTipoDocumento() as $dato) {
									echo '<option value="' . $dato->tipo_documento . '">' . $dato->nombre_documento	. '</option>';
								}
								?>
							</select><br>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label>Documento</label>
							<input type="number" name="documento" class="form-control" required data-parsley-length="[10,14]" data-parsley-type="number">
						</div>
						<div class="col-md-4 mb-3">
							<label>Teléfono</label>
							<input type="number" name="telefono" class="form-control" data-parsley-length="[7,10]" data-parsley-type="number">
						</div>
						<div class="col-md-4 mb-3">
							<label>Celular</label>
							<input type="number" name="nro_Celular" class="form-control" required data-parsley-length="[10,12]" data-parsley-type="number"><br>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label>Dirección</label>
							<input type="text" name="direccion" class="form-control"required data-parsley-length="[3,20]">
						</div>
						<div class="col-md-4 mb-3">
							<label>Ciudad</label>
							<select name="ciudad" class="custom-select form-control" required="">
								<option value="true" selected disabled>Seleccione Ciudad</option>
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
							<select name="departamento" class="custom-select form-control" required="">
								<option value="true" selected disabled>Seleccione Departamento</option>
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
					</div>
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label>Tipo Persona</label>
							<select name="tipo_persona_tipo_persona" class="custom-select form-control" required="">
								<option value="true" selected disabled>Seleccione tipo Persona</option>
								<?php
								foreach ($tipoDocumentoPersona->consultarTipoPersona() as $dato) {
									echo '<option value="' . $dato->tipo_persona . '">' . $dato->nombre_tipo	. '</option>';
								}
								?>
							</select><br>
						</div>
						<div class="col-md-4 mb-3">
							<label>Estado</label>
							<select name="estado" class="custom-select form-control" required="">
								<option value="true" selected disabled>Seleccione estado</option>
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select><br>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<input type="submit" id="registrar" name="registrar" class="btn btn-primary" value="Registrar">
						<input type="reset" value="Limpiar" class="btn btn-secondary">
						<a href="<?php echo SERVERURL; ?>listPerson"><input type="button" value="Cancelar" class="btn btn-danger" style="float: right;"></a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			var instance = $('#validate_form').parsley();
		});
	</script>