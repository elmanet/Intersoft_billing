<?php ob_start();

require_once('../inc/conexion_modules.inc.php'); 


 $insertSQL = sprintf("INSERT INTO sis_factura_inventario(id_fact_inventario, id_proveedor, fecha_inventario, observaciones) VALUES ( %s, %s, %s, %s)", 
                        GetSQLValueString($_POST['id_fact_inventario'], "int"),
                        GetSQLValueString($_POST['id_proveedor'], "int"),
                        GetSQLValueString($_POST['fecha_inventario'], "date"),
                        GetSQLValueString($_POST['observaciones'], "text"));
                       
  mysql_select_db($database_sistemai, $sistemai);
  $Result1 = mysql_query($insertSQL, $sistemai) or die(mysql_error());

mysql_select_db($database_sistemai, $sistemai);
$query_inventario = sprintf("SELECT * FROM sis_factura_inventario ORDER by creado DESC;");
$inventario = mysql_query($query_inventario, $sistemai) or die(mysql_error());
$row_inventario = mysql_fetch_assoc($inventario);
$totalRows_inventario = mysql_num_rows($inventario);
$idfact=$row_inventario['id_fact_inventario'];

$ptotal=$_POST['ptotal'];
$i=1; do {
if ($_POST['cant'.$i]>0) {

$insertSQL = sprintf("INSERT INTO sis_factura_inventario_detalle(id_detalle, id_fact_inventario, id_producto, precio_costo, cant) VALUES (  %s, %s, %s, %s, %s)", 
                        GetSQLValueString($_POST['id_detalle'.$i], "int"),
                        GetSQLValueString($idfact, "int"),
                        GetSQLValueString($_POST['id_producto'.$i], "date"),
                        GetSQLValueString($_POST['precio_costo'.$i], "double"),
                        GetSQLValueString($_POST['cant'.$i], "int"));
                       
  mysql_select_db($database_sistemai, $sistemai);
  $Result2 = mysql_query($insertSQL, $sistemai) or die(mysql_error());

$prod=$_POST['id_producto'.$i];

mysql_select_db($database_sistemai, $sistemai);
$query_producto = sprintf("SELECT id, existencia FROM sis_productos WHERE id='$prod'");
$producto = mysql_query($query_producto, $sistemai) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);
$nuevacant=$row_producto['existencia']+$_POST['cant'.$i];

$updateSQL = sprintf("UPDATE sis_productos SET existencia=%s, precio=%s WHERE id=%s",  
               
              GetSQLValueString($nuevacant, "int"),
              GetSQLValueString($_POST['precio_costo'.$i], "double"),
              GetSQLValueString($prod, "int"));
                       
  mysql_select_db($database_sistemai, $sistemai);
  $Result3 = mysql_query($updateSQL, $sistemai) or die(mysql_error());


}

$i++; } while ($i <= $ptotal); 

$return_loc = "index.php";
//header("Location: ".$return_loc); 


ob_end_flush(); ?>

