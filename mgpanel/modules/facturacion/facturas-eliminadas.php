<?php


mysql_select_db($database_sistemai, $sistemai);
$query_producto = "SELECT * FROM sis_factura a, sis_users b WHERE a.id_cliente=b.id_usuario AND a.eliminada=1 ORDER BY a.creado DESC";
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
    <h3 class="box-title">GESTOR DE FACTURAS</h3> 
    <small class="btn btn-primary btn-lg" style="position:absolute; right:185px;top:10px;"><a href="index.php?mod=gestor-factura" style="color:#fff;"><i class="glyphicon glyphicon-print"></i><span> Reporte de Facturas</span></a></small>                                   
    <small class="btn btn-success btn-lg" style="position:absolute; right:10px;top:10px;"><a href="index.php?mod=nueva-factura&p=6" style="color:#fff;"><i class="glyphicon glyphicon-plus"></i><span> Nueva Factura</span></a></small>                                   
   </div><!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="example2" class="table table-bordered table-striped">
				<thead>

            <tr >
            <th><b>ID</b></th>
 				    <th><b>Fecha</b></th>
            <th><b>Cliente</b></th>
            <th><b>Observacion</b></th>
				    <th><b>Detalle</b></th>
        
            <?php /*
            <th><b>Opciones</b></th>
            */?>
            </tr>
        </thead>
             
              <?php do { ?>
              <tr class="odd">
              <td align="center" ><?php echo $row_producto['id_factura']; ?></td>
              <td align="center" ><?php echo $row_producto['fecha']; ?></td>
              <td align="center" ><?php echo $row_producto['nombre_usuario']." ".$row_producto['apellido_usuario']; ?></td>
              <td align="center" ><?php echo $row_producto['observaciones']; ?></td>
              <td  align="center" ><a href="#" onclick="cargar('#divtest', 'modules/facturacion/factura-detalle.php?id=<?php echo $row_producto['id_factura'];?>')"  ><span class="glyphicon glyphicon-align-justify" style="font-size:2em;"></span></a></td>
             

             <?php /*
             <td  align="center" ><a href="index.php?mod=modificar-producto&id=<?php echo $row_producto['id'];?>"><span class="glyphicon glyphicon-pencil" style="font-size:2em;"></span></a>&nbsp;<a href="javascript:cargar('#divtest', 'modules/productos/eliminar.php?id=<?php echo $row_producto['id'];?>&ruta=<?php echo '../../../imagesmg/'.$row_producto['ruta'];?>')"  class="ask-custom"><span class="glyphicon glyphicon-trash" style="font-size:2em;"></span></a></td> 
				    */ ?>
        
              </tr>
              <?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>
            </table>
            
             </div><!-- /.box-body -->
         </div><!-- /.box -->
            <?php } ?>
            <?php if (($totalRows_producto==0)){ ?> 
            <br>
            <small class="btn btn-success btn-lg" style="position:absolute; right:10px;top:110px;"><a href="index.php?mod=nueva-factura&p=6" style="color:#fff;"><i class="glyphicon glyphicon-plus"></i><span> Nueva Factura</span></a></small>                                   
            <center>
            <img src="images/iconfinder/vacio.png" alt="" width="200">
				<p style="font-size:19px;">"No Hay Facturas Registradas!"</p>            
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
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": true,
                    
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