<?php

mysql_select_db($database_sistemai, $sistemai);
$query_categoria = "SELECT * FROM sis_productos_fabricantes";
$categoria = mysql_query($query_categoria, $sistemai) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);


?>
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

            
<?php if ($totalRows_categoria>0){ ?>            

<div class="box">
   <div class="box-header">
    <h3 class="box-title">LISTADO DE MARCAS/FABRICANTES</h3> 
    <small class="btn btn-success btn-lg" style="position:absolute; right:10px;top:10px;"><a href="index.php?mod=nueva-marca-producto" style="color:#fff;"><i class="glyphicon glyphicon-plus"></i><span> Nuevo</span></a></small>                                   
   </div><!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="example2" class="table table-bordered table-striped">

				    <thead>
              <tr >
              <th><b>ID</b></th>
              <th><b>Nombre del Fabricante/Marca</b></th>
					    <th><b>Status</b></th>
              <th><b>Opciones</b></th>
              </tr>
             </thead>
             
              <?php do { ?>
              <tr class="odd">
              <td  height="26" align="center" ><?php echo $row_categoria['id']; ?></td>
              <td  height="26" align="center" ><?php echo strtoupper($row_categoria['nombre_marca']); ?></td>
              <td  align="center" >
                <?php if ($row_categoria['status']==0){ ?><span class="glyphicon glyphicon-thumbs-down" style="font-size:2em;"></span><?php }  ?>
                <?php if ($row_categoria['status']==1){ ?><span class="glyphicon glyphicon-thumbs-up" style="font-size:2em;"></span><?php }  ?>
              </td>
              <td  align="center" ><a href="index.php?mod=modificar-marca-producto&id=<?php echo $row_categoria['id'];?>"><span class="glyphicon glyphicon-pencil" style="font-size:2em;"></span></a>&nbsp;<a href="javascript:cargar('#divtest', 'modules/productos-marca/eliminar.php?id=<?php echo $row_categoria['id'];?>&ruta=<?php echo '../../../imagesmg/'.$row_categoria['ruta'];?>')"  class="ask-custom"><span class="glyphicon glyphicon-trash" style="font-size:2em;"></span></a></td>
				  
        </tr>
              <?php } while ($row_categoria = mysql_fetch_assoc($categoria)); ?>
            </table>
          </div><!-- /.box-body -->
         </div><!-- /.box -->
            <?php } ?>
           <?php if (($totalRows_categoria==0)){ ?> 
            <br>
            <small class="btn btn-success btn-lg" style="position:absolute; right:10px;top:110px;"><a href="index.php?mod=nueva-marca-producto" style="color:#fff;"><i class="glyphicon glyphicon-plus"></i><span> Agregar Categoría</span></a></small>                                   
            <center>
            <img src="../../images/iconfinder/vacio.png" alt="" width="200">
        <p style="font-size:19px;">"No Hay Marcas Registradas!"</p>            
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