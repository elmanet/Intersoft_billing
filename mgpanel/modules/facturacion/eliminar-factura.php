<?php
require_once('../inc/conexion_modules.inc.php'); 
require_once('../inc/config.inc.php');

$id=$_GET['id'];
$id2=$_GET['id'];


mysql_select_db($database_sistemai, $sistemai);
$query_fact = sprintf("SELECT * FROM sis_factura_detalle WHERE id_factura='$id'");
$fact = mysql_query($query_fact, $sistemai) or die(mysql_error());
$row_fact = mysql_fetch_assoc($fact);
$totalRows_fact = mysql_num_rows($fact);


$updateSQL = sprintf("UPDATE sis_factura SET eliminada=1 WHERE id_factura=$id");
mysql_select_db($database_sistemai, $sistemai);
$Result1 = mysql_query($updateSQL, $sistemai) or die(mysql_error());


do {
    $cantr=$row_fact['cant'];
    $id_prod=$row_fact['id_producto'];

    $updateSQL = sprintf("UPDATE sis_productos SET existencia=(existencia+'$cantr') WHERE id=$id_prod");
	mysql_select_db($database_sistemai, $sistemai);
	$Result2 = mysql_query($updateSQL, $sistemai) or die(mysql_error());



} while ($row_fact = mysql_fetch_assoc($fact));
		$rows = mysql_num_rows($fact);
		if($rows > 0) {
		mysql_data_seek($fact, 0);
		$row_fact = mysql_fetch_assoc($fact);
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; utf-8" />
<title><?php echo $row_config['title_site'];?></title>
<meta http-equiv="Refresh" content="1;url=index.php?mod=gestor-factura">
</head>

<body>
<br>
<br><br>
<center>
<div class="box box-warning">
     <div class="box-header">
            <h3 class="box-title"></h3>
     </div><!-- /.box-header -->
<div class="box-body">
<img src="images/gif/procesando.gif" alt="" ><br>
<p>Procesando... <b>Devolviendo Productos a Inventario</b></p>
</div>
</div>
</center>
</body>

</html>