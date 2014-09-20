<?php ob_start();

require_once('../inc/conexion_modules.inc.php'); 


 $insertSQL = sprintf("INSERT INTO sis_factura(id_factura, id_cliente, fecha, tipo_pago, observaciones, termino_entrega) VALUES ( %s, %s, %s, %s, %s, %s)", 
                        GetSQLValueString($_POST['id_factura'], "int"),
                        GetSQLValueString($_POST['id_cliente'], "bigint"),
                        GetSQLValueString($_POST['fecha'], "date"),
                        GetSQLValueString($_POST['tipo_pago'], "int"),
                        GetSQLValueString($_POST['observaciones'], "text"),
                        GetSQLValueString($_POST['termino_entrega'], "text"));
                       
  mysql_select_db($database_sistemai, $sistemai);
  $Result1 = mysql_query($insertSQL, $sistemai) or die(mysql_error());

mysql_select_db($database_sistemai, $sistemai);
$query_inventario = sprintf("SELECT * FROM sis_factura ORDER by creado DESC;");
$inventario = mysql_query($query_inventario, $sistemai) or die(mysql_error());
$row_inventario = mysql_fetch_assoc($inventario);
$totalRows_inventario = mysql_num_rows($inventario);
$idfact=$row_inventario['id_factura'];

$ptotal=$_POST['ptotal'];
$i=1; do {
if ($_POST['cant'.$i]>0) {

$insertSQL = sprintf("INSERT INTO sis_factura_detalle(id_detalle_fact, id_factura, id_producto, cant, newmargen) VALUES (  %s, %s, %s, %s, %s)", 
                        GetSQLValueString($_POST['id_detalle_fact'.$i], "int"),
                        GetSQLValueString($idfact, "int"),
                        GetSQLValueString($_POST['id_producto'.$i], "date"),
                        GetSQLValueString($_POST['cant'.$i], "int"),
                        GetSQLValueString($_POST['newmargen'.$i], "int"));
                       
  mysql_select_db($database_sistemai, $sistemai);
  $Result2 = mysql_query($insertSQL, $sistemai) or die(mysql_error());

$prod=$_POST['id_producto'.$i];

mysql_select_db($database_sistemai, $sistemai);
$query_producto = sprintf("SELECT id, existencia FROM sis_productos WHERE id='$prod'");
$producto = mysql_query($query_producto, $sistemai) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);
$nuevacant=$row_producto['existencia']-$_POST['cant'.$i];

$updateSQL = sprintf("UPDATE sis_productos SET existencia=%s WHERE id=%s",  
               
              GetSQLValueString($nuevacant, "int"),
              GetSQLValueString($prod, "int"));
                       
  mysql_select_db($database_sistemai, $sistemai);
  $Result3 = mysql_query($updateSQL, $sistemai) or die(mysql_error());


}

$i++; } while ($i <= $ptotal); 

$return_loc = "index.php";
//header("Location: ".$return_loc); 


ob_end_flush(); ?>

