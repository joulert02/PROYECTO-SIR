
<?php 
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';

echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';

echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';

echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';

    require "../../public/tcpdf/config/config.php";
	class consulta{
		var $conn;
		var $conexion;
		function consulta(){		
			$this->conexion= new  Conexion();				
			$this->conn=$this->conexion->conectarse();
		}	
		//-----------------------------------------------------------------------------------------------------------------------
		//-----------------------------------------------------------------------------------------------------------------------
		function reportePdfEntradas(){			
			$html="";
			//$sql="select * from tbl_entrada order by id_entrada";
            
            $sql="SELECT ent.id_entrada, pro.nombre_producto, pro.referencia, dent.cantidad, ent.fecha_entrada 
			FROM tbl_entrada ent INNER JOIN tbl_detalle_entrada dent ON ent.id_entrada = dent.Entrada_id_entrada INNER JOIN 
			tbl_producto pro ON pro.id_producto = dent.Producto_id_producto ORDER BY id_entrada DESC";

			$rs=mysqli_query($this->conn,$sql);
			$i=0;

			$html=$html. '<head>
            <img src="http://localhost:8080/PROYECTO-SIR/SIR/public/img/Rodillos GBP.png" style="width: 100px; height: 100px" alt="">
             <head>';
			$html=$html.'<div align="center">
			<h1>Reporte de entradas.</h1>
			<br /><br />			
			<table class="table table-bordered" border="1" style="border: 1px solid black;" bordercolor="#0000CC;"bordercolordark="#FF0000;">';	
			$html=$html.'<tr bgcolor="#2E2EFE"><td width="20%"><font color="#FFFFFF">
			<h2>Referencia</h2></font></td><td width="45%"><font color="#FFFFFF">
			<h2>Nombre Producto</h2></font></td><td width="13%"><font color="#FFFFFF">
			<h2>Cantidad</h2></font></td><td width="22%"><font color="#FFFFFF">
			<h2>Fecha Entrada</h2></font></td></tr>';
			while ($row = mysqli_fetch_array($rs)){
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#95B1CE">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td width="20%"><h2 style="font-weight:normal;">';
				$html = $html. $row["referencia"];
				$html = $html.'</h2></td><td width="45%"><h2 style="font-weight:normal;">';
				$html = $html. $row["nombre_producto"];
				$html = $html.'</h2></td><td width="13%"><h2 style="font-weight:normal;">';
				$html = $html. $row["cantidad"];
				$html = $html.'</h2></td><td width="22%"><h2 style="font-weight:normal;">';
				$html = $html. $row["fecha_entrada"];
				$html = $html.'</h2></td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';

     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

