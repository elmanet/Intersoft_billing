<?php
require_once('../inc/conexion_modules.inc.php'); 
require_once('../inc/config.inc.php');
$id_detalle=$_GET['id'];
mysql_select_db($database_sistemai, $sistemai);
$query_producto = sprintf("SELECT a.id_detalle, a.id_producto, a.cant, a.precio_costo, b.nombre_prod FROM sis_factura_inventario_detalle a, sis_productos b WHERE a.id_producto=b.id AND a.id_fact_inventario='$id_detalle'");
$producto = mysql_query($query_producto, $sistemai) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);

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
    <h3 class="box-title">DETALLE DE RECOMPRA</h3> 
    <small class="btn btn-success btn-lg" style="position:absolute; right:10px;top:10px;"><a href="index.php?mod=gestor-recompra" style="color:#fff;"><i class="glyphicon glyphicon-circle-arrow-left"></i><span> Regresar</span></a></small>                                   
   </div><!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
				<thead>

            <tr >
            <th><b>Producto</b></th>
            <th><b>Precio Compra</b></th>
 				    <th><b>Cantidad</b></th>
            <?php /*
            <th><b>Opciones</b></th>
            */?>
            </tr>
        </thead>
             
              <?php do { ?>
              <tr class="odd">
              <td align="center" ><?php echo $row_producto['nombre_prod']; ?></td>
              <td align="center" ><?php echo $row_producto['precio_costo']; ?></td>
              <td align="center" ><?php echo $row_producto['cant']; ?></td>
               <?php /*           
             <td  align="center" ><a href="index.php?mod=modificar-producto&id=<?php echo $row_producto['id'];?>"><span class="glyphicon glyphicon-pencil" style="font-size:2em;"></span></a>&nbsp;<a href="javascript:cargar('#divtest', 'modules/productos/eliminar.php?id=<?php echo $row_producto['id'];?>&ruta=<?php echo '../../../imagesmg/'.$row_producto['ruta'];?>')"  class="ask-custom"><span class="glyphicon glyphicon-trash" style="font-size:2em;"></span></a></td> 
				    */?>
        
              </tr>
              <?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>
            </table>
            
             </div><!-- /.box-body -->
         </div><!-- /.box -->
            <?php } ?>
            <?php if (($totalRows_producto==0)){ ?> 
            <br>
            <small class="btn btn-success btn-lg" style="position:absolute; right:10px;top:110px;"><a href="index.php?mod=gestor-recompra" style="color:#fff;"><i class="glyphicon glyphicon-circle-arrow-left"></i><span> Regresar</span></a></small>                                   
            <center>
            <img src="images/iconfinder/vacio.png" alt="" width="200">
				<p style="font-size:19px;">"No Hay Productos Registrados!"</p>            
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
        
                 <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false,
                    
                });

            });
        </script>
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
</body>

</html>