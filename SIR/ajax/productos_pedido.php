<?php


	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('id_producto', 'nombre_producto');//Columnas de busqueda
		 $sTable = "tbl_producto";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table id="grid" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead style="background-color: #F3F2F2;color: black; font-weight: bold;">
				<tr class="warning">
					<th>Referencia</th>
					<th>Producto</th>
					<th>Categoría</th>
					<th><span class="pull-right">Cant.</span></th>
					<th><span class="pull-right">Precio</span></th>
					<th style="width: 36px;">Agregar</th>
				</tr>
			</thead>
		</tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_producto=$row['id_producto'];
					$referencia=$row['referencia'];
					$nombre_producto=$row['nombre_producto'];
					$id_categoria_producto=$row['Categoria_Producto_id_Categoria'];
					$referencia=$row["referencia"];
					$sql_marca=mysqli_query($con, "select categoria from tbl_categoria_producto where id_Categoria='$id_categoria_producto'");
					$rw_marca=mysqli_fetch_array($sql_marca);
					$nombre_categoria=$rw_marca['categoria'];
					$precio_venta=$row["precio_unitario"];
					$precio_venta=number_format($precio_venta,2);
					?>
					<tr>
						<td><?php echo $referencia; ?></td>
						<td><?php echo $nombre_producto; ?></td>
						<td ><?php echo $nombre_categoria; ?></td>
						<td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $id_producto; ?>"  value="1" >
						</div></td>
						<td class='col-xs-2'><div class="pull-right">
						<?php
						$precio_venta_r=str_replace(",","",$precio_venta);
						// var_dump((int)$precio_venta_r);
						?>
						<input type="text" class="form-control" style="text-align:right" id="precio_venta_<?php echo $id_producto; ?>"  value="<?php echo (int)$precio_venta_r;?>" >
						</div></td>
						<td ><span><a href="#" title="Agregar" data-toggle="tooltip" data-placement="top" class='btn btn-primary pull-center' onclick="agregar('<?php echo $id_producto ?>')"><i class="glyphicon glyphicon-plus"></i></a></span></td>
					</tr>
					<?php
				}
				?>
			</tbody>
			  </table>
			<?php
		}
	}
?>

<script type="text/javascript">
	$(document).ready(function() {
  responsive: true
  $('#grid').DataTable({
     "order": [[ 0, "desc" ]],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});
</script>