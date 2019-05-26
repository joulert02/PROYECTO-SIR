
<?php 
      session_start();
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
            function comprobantePdfPedido(){    
            $html="";
            $session_id= session_id();
    //  $sql_count=mysqli_query($con,"select * from tmp where session_id='".$session_id."'");
    //  $count=mysqli_num_rows($sql_count);
    //  if ($count==0)
    //  {
    //  echo "<script>alert('No hay productos agregados a la cotizacion')</script>";
    //  echo "<script>window.close();</script>";
   //   exit;
    //  }

             $conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
$Consulta = $conec->prepare("SELECT * FROM tmp");
$Consulta ->  execute();
$contarRegistros = $Consulta -> fetchAll();
if ($CantidadPersonas = (count($contarRegistros)==0)) {
      echo "<script>alert('No hay productos agregados al pedido')</script>";
       echo "<script>window.close();</script>";
}


            
      //Variables por GET
      $proveedor=intval($_GET['proveedor']);
      $estadoP=mysqli_real_escape_string($this->conn,(strip_tags($_REQUEST['estado'], ENT_QUOTES)));
      $transporte=mysqli_real_escape_string($this->conn,(strip_tags($_REQUEST['transporte'], ENT_QUOTES)));
      $condiciones=mysqli_real_escape_string($this->conn,(strip_tags($_REQUEST['condiciones'], ENT_QUOTES)));
      $comentarios=mysqli_real_escape_string($this->conn,(strip_tags($_REQUEST['comentarios'], ENT_QUOTES)));
      //Fin de variables por GET
      $sql=mysqli_query($this->conn, "select LAST_INSERT_ID(id_pedido) as last from tbl_pedido order by id_pedido desc limit 0,1 ");
      $rw=mysqli_fetch_array($sql);
      $numero_pedido=$rw['last'];   
      $perfil=mysqli_query($this->conn,"select * from perfil limit 0,1");//Obtengo los datos de la emprea
      $rw_perfil=mysqli_fetch_array($perfil);
      
      $sql_proveedor=mysqli_query($this->conn,"select * from tbl_persona where id_persona='$proveedor' limit 0,1");//Obtengo los datos del proveedor
      $rw_proveedor=mysqli_fetch_array($sql_proveedor);
      // get the HTML
      //CODIGO JOULER
      $sql=mysqli_query($this->conn, "select * from tbl_producto, tmp where tbl_producto.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
      $tabblaDetalle="";

      try {
            $conec = new PDO("mysql:host=localhost;dbname=s.i.r", "root", "");
            // set the PDO error mode to exception
            $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully"; 
            $sumador_total=0;
            $date=date("Y-m-d H:i:s");
            $insert=mysqli_query($this->conn,"INSERT INTO tbl_pedido VALUES ('','$proveedor','$condiciones','Liliana Ospina','$date','$date','$transporte','$estadoP','$comentarios')");

          $html=$html. '  <p style="font-size:11pt;text-align:right">COMPROOBANTE Nº '.$condiciones.'</p>';
            $html=$html. '
            <table cellspacing="0" style="width: 100%;">
        <tr>

            <td  style="width: 28%; color: #444444;">
                <img src="http://localhost:8080/PROYECTO-SIR/SIR/public/img/Rodillos GBP.png" style="width: 100px; height: 100px" alt="">
                
            </td>
                  <td style:"45%">
            <div align="center">
            <label>Nit:  9000.324995-9</label><br>
            <label>IVA: Regimen Común</label><br>
            <label>Actividad Economica:  103-11.04x1.000</label><br>
            <label>Resolución DIAN Nro 320001394592 De 2018/04/28</label><br>
            </div><br>
                  </td>
        </tr>
    </table>
    <br>
            ';
            $html=$html. '<label></label><br><br>';
            $html=$html. '<label align="center">Cra 108 Nro 19-62 Telefax: 2679629  Telefono: 2676353  Email: Informacion@industriasmastder.com - Bogotá</label>';



            $html=$html. '<label></label><br><br><br><br><br>';
            $html=$html.'<table border="0" width="100%" cellpadding="5" cellspacing="5" > ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td width="50%"> ';
            $html=$html.'  <table border="1"> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td colspan="2"> ';
            $html=$html.'  SEÑORES: ';
            $html=$html.   $rw_proveedor['nombres'];
            $html=$html.'  </td>';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td colspan="2"> ';
            $html=$html.'  DIRECCIÓN: ';
            $html=$html.   $rw_proveedor['direccion'];
            $html=$html.'  </td>';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td> ';
            $html=$html.'  C.C O NIT:';
            $html=$html.   $rw_proveedor['documento'];
            $html=$html.'  </td> ';
            $html=$html.'  <td>';
            $html=$html.'  TEL: ';
            $html=$html.   $rw_proveedor['telefono'];
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td> ';
            $html=$html.'  CIUDAD:';
            $html=$html.   $rw_proveedor['ciudad'];
            $html=$html.'  </td> ';
            $html=$html.'  <td> ';
            $html=$html.'  DPTO: ';
            $html=$html.   $rw_proveedor['departamento'];
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td> ';

            $estadoPE = ($estadoP==1) ? "Pendiente" : "pago" ;
            //$html=$html.'  FORMA DE PAGO: ';
            $html=$html.'  ESTADO PEDIDO: ';
            $html=$html.   $estadoPE;
            $html=$html.'  </td> ';
            $html=$html.'  <td> ';
            $html=$html.'  VENDEDOR: ';
            $html=$html.   $rw_perfil['propietario'];
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  </table> ';
            $html=$html.'  </td> ';
            $html=$html.'  <td width="50%"> ';
            $html=$html.'  <table border="1"> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td>  ';
            $html=$html.'  FECHA FACTURA  ';
            $html=$html.'  </td> ';
            $html=$html.'  <td> ';
            $html=$html.'  FECHA VENCIMIENTO  ';
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td>  ';
            $html=$html.'  AÑO MES DIA ';
            $html=$html.'  </td> ';
            $html=$html.'  <td>  ';
            $html=$html.'  AÑO MES DIA ';
            $html=$html.'  </td>  ';
            $html=$html.'  </tr>  ';
            $html=$html.'  <tr>  ';
            $html=$html.'  <td> ';
            $html=$html.   date("d-m-Y");
            $html=$html.'  </td>  ';
            $html=$html.'  <td> ';
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td colspan="2"> ';
            $html=$html.'  DESPACHADO POR: ';
            $html=$html.   $rw_perfil['propietario'];
            $html=$html.'  </td>';
            $html=$html.'  </tr> ';
            $html=$html.'  <tr> ';
            $html=$html.'  <td colspan="2"> ';
            $html=$html.'  TRANSPORTE: ';
            $html=$html.   $transporte;
            $html=$html.'  </td>';
            $html=$html.'  </tr> ';
            $html=$html.'  </table> ';
            $html=$html.'  </td> ';
            $html=$html.'  </tr> ';
            $html=$html.'  </table> ';
            $html=$html. ' <table  border="1" style:"border: 1px solid black;">
            <tr >
                  <th class="pumpkin" style="width: 14% ">CODIGO</th>
                  <th class="pumpkin" style="width: 7% ">CANT.</th>
                  <th class="pumpkin" style="width: 31%">DESCRIPCION</th>
                  <th class="pumpkin" style="width: 14%;text-align:right">PRECIO UNIT.</th>
                  <th class="pumpkin" style="width: 34%;text-align:right">TOTAL</th>
            </tr>';
            while ($row=mysqli_fetch_array($sql))
                  {
                  $id_tmp=$row["id_tmp"];
                  $id_producto=$row["id_producto"];
                  $referencia=$row['referencia'];
                  $cantidad=$row['cantidad_tmp'];
                  $nombre_producto=$row['nombre_producto'];
                  $id_marca_producto=$row['Categoria_Producto_id_Categoria'];
                  if (!empty($id_marca_producto))
                  {
                  $sql_marca=mysqli_query($this->conn,"select categoria from tbl_categoria_producto where id_Categoria='$id_marca_producto'");
                  $rw_marca=mysqli_fetch_array($sql_marca);
                  $nombre_marca=$rw_marca['categoria'];
                  $marca_producto=" ".strtoupper($nombre_marca);
                  }
                  else {$marca_producto='';}
                  $precio_venta=$row['precio_tmp'];
                  $precio_venta_f=number_format($precio_venta,2);//Formateo variables
                  $precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
                  $precio_total=$precio_venta_r*$cantidad;
                  $precio_total_f=number_format($precio_total,2);//Precio total formateado
                  $precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
                  $sumador_total+=$precio_total_r;//Sumador
                  $html=$html. '
                  <tr>
                  <td class="jouler" style="width: 14%; text-align: center">'.$referencia.'</td>
                  <td class="jouler" style="width: 7%; text-align: center">'.$cantidad.'</td>
                  <td class="jouler" style="width: 31%; text-align: left">'.$nombre_producto.$marca_producto.'</td>
                  <td class="jouler" style="width: 14%; text-align: right">'.$precio_venta_f.'</td>
                  <td class="jouler" style="width: 34%; text-align: right">'.$precio_total_f.'</td>
                  </tr>       ';
            // Insert en la tabla detalle_pedido
            $insertar = "INSERT INTO tbl_detalle_pedido(`Pedido_id_pedido`, `Producto_id_producto`, `cantidad`, `precio`, `sub_total1`, `descuento`, `sub_total2`, `iva_total`, `total_pagar`)
            VALUES (?,?,?,?,?,?,?,?,?)";
            $conec->prepare($insertar)->execute(array(
                  $numero_pedido,
                  $id_producto,
                  $cantidad,
                  $precio_venta_r,
                  1000,
                  2,
                  500,
                  500,
                  500
            ));
            // echo $numero_pedido."g".$id_producto."asd".$cantidad."asd".$precio_venta_r."asd";
            // $insert_detail=mysqli_query($con, "INSERT INTO tbl_detalle_pedido VALUES ('','$numero_pedido','$id_producto','$cantidad','$precio_venta_r','1000','1000','1000','1000','1000')");
            }
            $html=$html.'</table>';
            $total_neto=number_format($sumador_total,2,'.','');
            $iva=intval($rw_perfil['iva']);
            $total_iva=($total_neto* $iva) / 100;
            $total_iva=number_format($total_iva,2,'.','');
            $sumador_total=$total_neto+$total_iva; 

            $html=$html.' 
            <table  border="1" style:"border: 1px solid black;">

            <tr>
            <td> OBSERVACIONES : BANCOLOMBIA AHORROS 22329169000<br>medellin@industriasmastder.com Tel: 2859578</td>
            <td> Sub Total</td>
            <td>$'. number_format($total_neto,2).'</td>

            </tr>

            <tr>
            <td> COMENTARIO: '. $comentarios.' </td><td> DCTO %</td>
            <td>$</td>
            </tr>
            <tr>
            <td> SON: </td><td> I.V.A</td>
            <td>$'. number_format($total_iva,2).'</td>
            </tr>
            <tr>
            <td> Rodillos Mastder</td><td> TOTAL</td>
             <td>$'. number_format($sumador_total,2).'</td>

            </tr>
            
       </table>';



            // $date=date("Y-m-d H:i:s");
            // $insert=mysqli_query($con,"INSERT INTO tbl_pedido VALUES ('','$proveedor','$condiciones','Liliana Ospina','$date','$date','$transporte','1','$comentarios')");
            $delete=mysqli_query($this->conn,"DELETE FROM tmp WHERE session_id='".$session_id."'");

            }catch(PDOException $e){
            $html=$html. "Connection failed: " . $e->getMessage();
      }
       $html=$html. '<label></label><br><br>';
      
      $html=$html. '
      <br>
      <p style="font-size:11pt;text-align:center">Si tiene alguna consulta sobre este pedido por favor contácte a:<br>
            '. $rw_perfil['propietario'].'", <strong>Teléfono: </strong>"'.$rw_perfil['telefono'].'", <strong>Email:</strong> "'.$rw_perfil['email'].'<br>
      </p>
      ';    

                   
             return ($html);  
                  
      }
}
?>

