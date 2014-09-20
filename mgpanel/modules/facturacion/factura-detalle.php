<?php
require_once('../inc/conexion_modules.inc.php'); 
require_once('../inc/config.inc.php');
$id_detalle=$_GET['id'];

mysql_select_db($database_sistemai, $sistemai);
$query_factura = sprintf("SELECT * FROM sis_factura WHERE id_factura='$id_detalle'");
$factura = mysql_query($query_factura, $sistemai) or die(mysql_error());
$row_factura = mysql_fetch_assoc($factura);
$totalRows_factura = mysql_num_rows($factura);

mysql_select_db($database_sistemai, $sistemai);
$query_producto = sprintf("SELECT a.id_detalle_fact, a.id_factura, a.id_producto, a.cant, a.newmargen, b.precio, b.margen, b.nombre_prod FROM sis_factura_detalle a, sis_productos b WHERE a.id_producto=b.id AND a.id_factura='$id_detalle'");
$producto = mysql_query($query_producto, $sistemai) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);

mysql_select_db($database_sistemai, $sistemai);
$query_cliente = sprintf("SELECT * FROM sis_factura a, sis_users b WHERE a.id_cliente=b.id_usuario AND a.id_factura='$id_detalle'");
$cliente = mysql_query($query_cliente, $sistemai) or die(mysql_error());
$row_cliente = mysql_fetch_assoc($cliente);
$totalRows_cliente = mysql_num_rows($cliente);



//FIN DE LA BUSQUEDA
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; utf-8" />

<?php /* FUNCION PREGUNTAR ANTES */ ?>         
<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
        <script type="text/javascript">
          
          $(document).ready(function() {
            
            
            $('.ask-plain').click(function(e) {
              
              e.preventDefault();
              thisHref  = $(this).attr('href');
              
              if(confirm('Are you sure')) {
                window.location = thisHref;
              }
              
            });
            
            $('.ask-custom').jConfirmAction({question : "Quieres Eliminarlo?", yesAnswer : "Si", cancelAnswer : "Cancelar"});
            $('.ask').jConfirmAction();
          });
          
        </script>
 <?php /* FUNCION PREGUNTAR ANTES */ ?> 


</head>

<body>

<?php if ($totalRows_producto>0){ ?>            
<div class="box">
   <div class="box-header">
    <div class="datos-factura">
      <div style="display: inline-block;vertical-align:top;margin-right:20px;margin-top:20px;"><img src="../images/site/<?php echo $row_config['ruta'];?>" height="120"></div>
      <div style="display: inline-block;margin-top:20px;"><?php echo $row_config['dato_factura'];?></div> 
    </div>

    <h3 class="box-title" id="titulo-factura">Orden de Entrega #<?php if($_GET['id']<10){echo "00".$_GET['id'];} if(($_GET['id']>9)and($_GET['id']<100)){echo "0".$_GET['id'];} if($_GET['id']>99){echo $_GET['id'];}?><br><span style="font-size:0.7em;">Fecha: <?php $fecha1=$row_factura['fecha']; $fecha2=date("d-m-Y",strtotime($fecha1)); echo $fecha2; ?></span></h3> 
    <div id="btn-factura">
       <small class="btn btn-success btn-lg"><a href="index.php?mod=gestor-factura" style="color:#fff;"><i class="glyphicon glyphicon-circle-arrow-left"></i><span> Regresar</span></a></small>                                   
       <small class="btn btn-primary btn-lg"><a href="#" onclick="window.print();return false;" style="color:#fff;"><i class="fa fa-print"></i><span> Imprimir</span></a></small>                                   
    </div>
   </div><!-- /.box-header -->
  <div class="box-body table-responsive">
    <label>Nombre o Razón Social:</label> <?php echo $row_cliente['nombre_usuario']." ".$row_cliente['apellido_usuario']; ?>&nbsp;&nbsp;&nbsp;
    <label>Identificación/RUC:</label> <?php echo $row_cliente['ci_usuario'];?><br>
    <label>Dirección:</label> <?php echo $row_cliente['dir_usuario'];?>&nbsp;&nbsp;&nbsp;<label>Teléfono:</label> <?php echo $row_cliente['tel_usuario'];?><br>
    <label>Termino de Entrega:</label> <?php echo $row_factura['termino_entrega'];?>&nbsp;&nbsp;&nbsp;
    <label>Tipo de Pago:</label> <?php if($row_factura['tipo_pago']==1){echo "Contado";} if($row_factura['tipo_pago']==2){echo "Crédito";}?><br>

    <table id="example1" class="table table-bordered table-striped">
				<thead>

            <tr >
            <th style="width:10%;"><b>Cant</b></th>
            <th style="width:50%;"><b>Descripción</b></th>
            <th style="width:20%;"><b>Precio Unitario</b></th>
 				    <th style="width:20%;"><b>Total</b></th>
            </tr>
        </thead>
             
              <?php do { ?>
              <tr class="odd">
              <td align="center"><?php echo $row_producto['cant']; ?></td>
              <td align="left" >&nbsp;<?php echo $row_producto['nombre_prod']; ?></td>
              <td align="left" >
              <?php if($row_producto['newmargen']>0){$preciou=(($row_producto['precio']*$row_producto['newmargen'])/100)+$row_producto['precio']; echo $row_config['simbolo_moneda'].number_format($preciou,2); }else{$preciou=(($row_producto['precio']*$row_producto['margen'])/100)+$row_producto['precio']; echo $row_config['simbolo_moneda'].number_format($preciou,2);} ?></td>
              <td align="left" >
              <?php 
                $preciot=$preciou*$row_producto['cant'];
                echo $row_config['simbolo_moneda'].number_format($preciot,2); 
                $subtotal=$subtotal+$preciot;
              ?>
              </td>
              
               
              </tr>
              <?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>
              <tr>
                <td colspan="3" style="text-align:right;">Sub-Total</td>
                <td style="text-align:left;"><?php echo $row_config['simbolo_moneda'].number_format($subtotal,2);?></td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:right;">ITBMS <?php echo $row_config['impuesto'];?>%</td>
                <td style="text-align:left;"><?php $impuesto=($row_config['impuesto']*$subtotal)/100; echo $row_config['simbolo_moneda'].number_format($impuesto,2);?></td>
              </tr>
              <tr>
                <td colspan="3" style="text-align:right;font-size:1.2em;"><b>Total</b></td>
                <td style="text-align:left;font-size:1.2em;"><b><?php $total=$subtotal+$impuesto; echo $row_config['simbolo_moneda'].number_format($total,2);?></b></td>
              </tr>
            </table>
        
             <p id="observaciones-factura"><b>Observaciones:</b> &nbsp;<?php echo $row_factura['observaciones'];?></p>
            
            <small>Esta Factura fué impresa a través de INTERSOFT CMS, un producto de INTERSOFT-latin 2002 - <?php echo date(Y);?></small>
            
             </div><!-- /.box-body -->
         </div><!-- /.box -->
            <?php } ?>
            <?php if (($totalRows_producto==0)){ ?> 
            <br>
            <small class="btn btn-success btn-lg" style="position:absolute; right:10px;top:110px;"><a href="index.php?mod=gestor-factura" style="color:#fff;"><i class="glyphicon glyphicon-circle-arrow-left"></i><span> Regresar</span></a></small>                                   
            <center>
            <img src="images/iconfinder/vacio.png" alt="" width="200">
				<p style="font-size:19px;">"No Hay Productos en esta Factura!"</p>            
            </center>
            <?php } ?>
            <br />
            <br />
				<br />
           <br />
            <br />
				<br />
           <br />
            <br />
				<br />
</center>	
<!-- DATA TABES SCRIPT -->

        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        
                 
</body>

</html>