<?php
require_once('../inc/conexion_modules.inc.php'); 
require_once('../inc/config.inc.php');

$id=$_GET['id'];
$ruta=$_GET['ruta'];

if($ruta=="imagenes/") { //verificamos que no hallan fotos
	
	if($id>0) {
		echo "<center><br><div class='tablaestilo'><table width='90%'><caption>Eliminando Categor&iacute;a!</caption></table></center>";

		$sql = "DELETE FROM sis_productos_categoria_padre WHERE id=$id LIMIT 1"; 
	       $res=mysql_query($sql,$sistemai);          
  }else {
  	echo "Error al Eliminar";
  	}
	
	}else { // si hay fotos barralas
		

		
		$sql = "DELETE FROM sis_productos_categoria_padre WHERE id=$id LIMIT 1"; 
                $res=mysql_query($sql,$sistemai);
       if(!$res) {
   echo "<center><br><div class='tablaestilo'><table width='90%'><caption><span style='font-size:40px;'>Error al Eliminar</span> <br>Existen Productos Asociados!</caption></table></center>";
   } else {
    unlink("$ruta");
    echo "<center><br><div class='tablaestilo'><table width='90%'><caption>Eliminando Categor&iacute;a!</caption></table></center>";
	}

	
} // finalizamos el borrado	
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; utf-8" />
<meta http-equiv="Refresh" content="2;url=admin.php">
<title><?php echo $row_config['title_site'];?></title>
<link href="../../css/main_central.css" rel="stylesheet" type="text/css" />
<link href="../../css/modules.css" rel="stylesheet" type="text/css" />
<link href="../../css/input.css" rel="stylesheet" type="text/css">
<link href="../../css/marca.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../../images/favicon.ico">
</head>

<body style="background-color:#fff;">
<br>
<br><br>
<center>
<img src="../../images/gif/procesando.gif" alt="" ><br>

</center>
</body>

</html>