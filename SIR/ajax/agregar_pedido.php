<?php
	
session_start();
$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}
if (isset($_POST['estado'])){$precio_venta=$_POST['estado'];}

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
if (!empty($id) and !empty($cantidad) and !empty($precio_venta))
{
$insert_tmp=mysqli_query($con, "INSERT INTO tmp (id_producto,cantidad_tmp,precio_tmp,session_id) VALUES ('$id','$cantidad','$precio_venta','$session_id')");
}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
	$id=intval($_GET['id']);
$delete=mysqli_query($con, "DELETE FROM tmp WHERE id_tmp='".$id."'");
}

?>
<table class="table">
<tr>
	<th>Referencia</th>
	<th>Descripción</th>
	<th>Cantidad</th>
	<th><span class="pull-right">Precio Unit.</span></th>
	<th><span class="pull-right">Precio Total</span></th>
	<th><span class="pull-right">Eliminar</span></th>
</tr>
<?php
	$sumador_total=0;
	$sql=mysqli_query($con, "select * from tbl_producto, tmp where tbl_producto.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$referencia=$row['referencia'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	$id_categoria_producto=$row['Categoria_Producto_id_Categoria'];
	if (!empty($id_categoria_producto))
	{
	$sql_marca=mysqli_query($con, "select categoria from tbl_categoria_producto where id_Categoria='$id_categoria_producto'");
	$rw_marca=mysqli_fetch_array($sql_marca);
	$nombre_categoria=$rw_marca['categoria'];
	$marca_producto=" ".strtoupper($nombre_categoria);
	}
	else {$marca_producto='';}
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr>
			<td><?php echo $referencia;?></td>
			<td><?php echo $nombre_producto.$marca_producto;?></td>
			<td><?php echo $cantidad;?></td>
			<td><span class="pull-right"><?php echo $precio_venta_f;?></span></td>
			<td><span class="pull-right"><?php echo $precio_total_f;?></span></td>
			<td ><span class="pull-right"><a href="#" title="Eliminar" class="btn btn-danger delete text-center" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></span></td>
		</tr>		
		<?php
	}

?>
<tr>
	<td colspan=4><span class="pull-right">TOTAL $</span></td>
	<td><span class="pull-right"><?php echo number_format($sumador_total,2);?></span></td>
	<td></td>
</tr>
</table>
			