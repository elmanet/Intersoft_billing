<?php
require_once('../inc/conexion_modules.inc.php'); 
require_once('../inc/config.inc.php');
require_once('../inc/usuario.inc.php');

mysql_select_db($database_sistemai, $sistemai);
$query_categoria = "SELECT * FROM sis_galeria_categoria";
$categoria = mysql_query($query_categoria, $sistemai) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; utf-8" />
<title><?php echo $row_config['title_site'];?></title>
<link href="../../css/main_central.css" rel="stylesheet" type="text/css" />
<link href="../../css/modules.css" rel="stylesheet" type="text/css" />
 <link href="../../css/marca.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../images/favicon.ico">
<?php require_once('../inc/condicion_eliminar.inc.php'); ?>
</head>
<body>
<div class="boton_modulos">
<a href="nuevo.php" ><img src="../../images/iconspng/1371153548_sign-up.png" width="28" height="28" alt="" valign="middle" /> Nuevo</a>
</div>
<center>
<!--
<a href="usuario_nuevo.php" style="font-size:16px;"><img src="../../images/pngnew/agregar-usuarios-icono-3782-48.png" alt="" align="middle">Nuevo Cliente</a>
-->
<br>
            
<?php if ($totalRows_categoria>0){ ?>            
<div class="tablaestilo">
		<table summary="Usuarios" width="90%">
				<caption>LISTADO DE GALERIAS DE FOTOS</caption>
				<thead>
              <tr >
              <th width="30%" height="35"  align="center" scope="col" ><b>Nombre de la Galer&iacute;a</b></th>
              <th width="30%" height="35"  align="center" scope="col" ><b>Alias Enlace</b></th>
              <th width="20%" height="35"  align="center" scope="col" ><b>Imagen Galer&iacute;a</b></th>
					<th width="20%" align="center" scope="col"><b>Status</b></th>
              <th width="10%" height="35"  align="center" scope="col"><b>Opciones</b></th>
              </tr>
             </thead>
             
              <?php do { ?>
              <tr class="odd">
              <td  height="26" align="center" ><?php echo strtoupper($row_categoria['titulo_cate']); ?></td>
              <td  height="26" align="center" ><?php echo $row_categoria['alias']; ?></td>
              <td  align="center" >
              	<?php if ($row_categoria['ruta']=="imagenes/"){ ?>
					<img src="../../images/iconfinder/no-imagen2.png" alt="" height="50" >
              <?php } else { ?>
              <img src="<?php echo $row_categoria['ruta']; ?>" alt="" height="50" >
              <?php } ?>              	
              	              
              </td>
              <td  align="center" >
					<?php if ($row_categoria['status']==0){ ?><img src="../../images/iconfinder/not.gif" alt=""  ></a> <?php }  ?>
					<?php if ($row_categoria['status']==1){ ?><img src="../../images/iconfinder/yes.gif" alt=""  ></a> <?php }  ?>           
              </td>
				  <td  align="center" ><a href="modificar.php?id=<?php echo $row_categoria['id_cate'];?>"><img src="../../images/png/32px-Crystal_Clear_action_reload.png" alt="" width="16" ></a>&nbsp;<?php if($row_usua['cod']==5) {?><a href="eliminar.php?id=<?php echo $row_categoria['id_cate'];?>&ruta=<?php echo $row_categoria['ruta'];?>" class="ask-custom"><img src="../../images/png/cancel_f2.png" alt="" width="16"></a> <?php } ?></td>
        
              </tr>
              <?php } while ($row_categoria = mysql_fetch_assoc($categoria)); ?>
            </table>
            
            </div>
            <?php } ?>
           <?php if (($totalRows_categoria==0)){ ?> 
            <br>
            <center>
            <img src="../../images/iconfinder/vacio.png" alt="" width="200">
				<p style="font-size:19px;">"No Hay Galer&iacute;as Registradas!"</p>            
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
</body>

</html>
<?php
mysql_free_result($config);
mysql_free_result($categoria);
?>