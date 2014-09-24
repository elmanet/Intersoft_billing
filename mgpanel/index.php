<?php 
require_once('modules/inc/conexion.inc.php'); 
require_once('modules/inc/config.inc.php');


// INICIO DE BUSQUEDAS SQL
$colname_usua = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usua = $_SESSION['MM_Username'];
}
mysql_select_db($database_sistemai, $sistemai);
$query_usua = sprintf("SELECT * FROM sis_users a, sis_users_cuenta b, sis_users_tipo c WHERE a.id_usuario=b.id_usuario AND a.id_user_tipo=c.id_user_tipo AND b.username = %s", GetSQLValueString($colname_usua, "text"));
$usua = mysql_query($query_usua, $sistemai) or die(mysql_error());
$row_usua = mysql_fetch_assoc($usua);
$totalRows_usua = mysql_num_rows($usua);

mysql_select_db($database_sistemai, $sistemai);
$query_usuariot = sprintf("SELECT * FROM sis_users");
$usuariot = mysql_query($query_usuariot, $sistemai) or die(mysql_error());
$row_usuariot = mysql_fetch_assoc($usuariot);
$totalRows_usuariot = mysql_num_rows($usuariot);

mysql_select_db($database_sistemai, $sistemai);
$query_productost = sprintf("SELECT * FROM sis_productos");
$productost = mysql_query($query_productost, $sistemai) or die(mysql_error());
$row_productost = mysql_fetch_assoc($productost);
$totalRows_productost = mysql_num_rows($productost);

mysql_select_db($database_sistemai, $sistemai);
$query_factura = sprintf("SELECT * FROM sis_factura WHERE eliminada=0");
$factura = mysql_query($query_factura, $sistemai) or die(mysql_error());
$row_factura = mysql_fetch_assoc($factura);
$totalRows_factura = mysql_num_rows($factura);

mysql_select_db($database_sistemai, $sistemai);
$query_articuloblog = sprintf("SELECT * FROM sis_plantilla_articulos WHERE tipo_articulo=0");
$articuloblog = mysql_query($query_articuloblog, $sistemai) or die(mysql_error());
$row_articuloblog = mysql_fetch_assoc($articuloblog);
$totalRows_articuloblog = mysql_num_rows($articuloblog);


// FIN DE BUSQUEDAS SQL
//HOJA DE MENU DE MODULOS 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $row_config['title_site'];?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->



       
    </head>
    <body class="skin-blue">
   
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="images/logo.png"  />
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                       
                        <li class="dropdown messages-menu">
                            <a href="../index.php" class="dropdown-toggle" target="_blank">
                                <i class="fa fa-desktop"></i>
                                <span >Ver Sitio</span>
                            </a>
                            
                        </li>
                         <?php /*
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">7</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 7 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        */?>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $row_usua['nombre_usuario'];?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?php if($row_usua['ruta'] == "imagenes/") { ?>
                                        <img src="images/pngnew/blanco-naranja-usuario-masculino-icono-6118-48.png" class="img-circle" alt="User Image" />
                                    <?php } else { ?>
                                        <img src="../imagesmg/<?php echo $row_usua['ruta'];?>" class="img-circle" alt="User Image" />
                                    <?php } ?>
                                    <p>
                                        <?php echo $row_usua['nombre_usuario'];?> - <?php echo $row_usua['descripcion'];?>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <?php /*
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                */ ?>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div> 
                                    <div class="pull-right">
                                        <a href="<?php echo $logoutAction ?>" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php if($row_usua['ruta'] == "imagenes/") { ?>
                                <img src="images/pngnew/blanco-naranja-usuario-masculino-icono-6118-48.png" class="img-circle" alt="User Image" />
                            <?php } else { ?>
                                <img src="../imagesmg/<?php echo $row_usua['ruta'];?>" class="img-circle" alt="User Image" />
                            <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hola, <?php echo $row_usua['nombre_usuario'];?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <?php /*
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">

                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    */?>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php">
                                <i class="fa fa-home"></i> <span>Inicio</span>
                            </a>
                        </li>
                         <?php /*
                        <li>
                            <a href="index.php?mod=nuevo-articulo-blog">
                                <i class="fa fa-arrow-circle-up"></i> <span>Nuevo Articulo Blog</span> <small class="badge pull-right bg-red">nuevo</small>
                            </a>
                        </li>
                       
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder-open"></i>
                                <span>Gestor de Blog</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?mod=gestor-blog"><i class="fa fa-file-text-o"></i> Gestor de Articulos</a></li>
                                <li><a href="index.php?mod=gestor-categoria-articulos"><i class="fa fa-list-alt"></i> Gestor de Categorias</a></li>
                                
                            </ul>
                        </li>
                        */ ?>


                        <?php if($row_config['tienda']==1) { //MOSTRAR SI ESTA ACTIVA TIENDA?>
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-print"></i>
                                <span>Facturación</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?mod=nueva-factura&p=6"><i class="fa fa-plus"></i> Nueva Factura</a></li>
                                <li><a href="index.php?mod=gestor-factura"><i class="fa  fa-clipboard"></i> Reporte de Facturas</a></li>


                                
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-briefcase"></i>
                                <span>Inventario</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?mod=gestor-productos"><i class="fa fa-th"></i> Inventario de Productos</a></li>
                                <li><a href="index.php?mod=gestor-recompra"><i class="fa fa-plus-square"></i> Re-Compra Inventario</a></li>
                                <li><a href="index.php?mod=gestor-proveedor"><i class="fa fa-truck"></i> Gestor de Proveedores</a></li>
                                                                
                            </ul>
                        </li>

                        

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Tienda Virtual</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               
                                <li><a href="#"><i class="fa fa-list-ul"></i> Listado de Pedidos</a></li>
                                <li><a href="index.php?mod=gestor-categoria-productos"><i class="fa fa-sitemap"></i> Categorías</a></li>
                                <li><a href="index.php?mod=gestor-marcas"><i class="fa fa-suitcase"></i> Fabricantes/Marcas</a></li>
                                <li><a href="#"><i class="fa fa-truck"></i> Tipos de Envío</a></li>
                                <li><a href="#"><i class="fa fa-credit-card"></i> Tipos de Pago</a></li>

                                
                            </ul>
                        </li>
                        <?php } ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Usuarios</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <?php /* <li><a href="#"><i class="fa fa-wrench"></i> Perfil</a></li> */ ?>
                                <li><a href="index.php?mod=gestor-usuarios"><i class="fa fa-envelope"></i> Gestor de Usuarios</a></li>
                                <li><a href="#"><i class="fa fa-key"></i> Cambiar Contraseña</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-desktop"></i>
                                <span>Gestor Web</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php?mod=gestor-modulos"><i class="fa fa-th-large"></i> Gestor de Módulos</a></li>
                                <li><a href="index.php?mod=gestor-contenido"><i class="fa fa-book"></i> Contenido Web</a></li>
                                <li><a href="index.php?mod=gestor-blog"><i class="fa fa-file-text-o"></i> Articulos Blog</a></li>
                                <li><a href="index.php?mod=gestor-categoria-articulos"><i class="fa fa-list-alt"></i>Categoria de Artículos</a></li>
                                <li><a href="index.php?mod=gestor-banner"><i class="fa fa-caret-square-o-right"></i> Gestor de Banners</a></li>
                                <li><a href="index.php?mod=gestor-menu"><i class="fa fa-chain"></i> Gestor de Menú</a></li>
                                <?php /* <li><a href="#"><i class="fa fa-picture-o"></i> Gestor de Galerías</a></li> */?>
                                <li><a href="index.php?mod=gestor-multimedia"><i class="fa fa-camera-retro"></i> Gestor Multimedia</a></li>    
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gear"></i>
                                <span>Configuración Sistema</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#" onclick="cargar('#divtest', 'modules/confi_tienda/modificar.php')"><i class="fa fa-gears"></i> Configuración Web</a></li>
                                <?php if($row_usua['cod']==5) {?>
                                <li><a href="#"><i class="fa fa-th"></i> Configurar Posiciones</a></li>
                                <li><a href="#"><i class="fa fa-html5"></i> Editor Web</a></li>
                                <?php } ?>
                            </ul>
                        </li>

                         <li>
                            <a href="<?php echo $logoutAction ?>">
                                <i class="fa fa-power-off"></i> <span>Salir</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Bienvenido(a)
                        <small>Control panel</small>
                    </h1>
                    <?php /*
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Inicio</li>
                    </ol>
                    */?>
                </section> 

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row" id="divtest">
                    <?php if ($_GET['mod']=="") { ?>


                        <?php if($row_config['tienda']==1) { //MOSTRAR SI ESTA ACTIVA TIENDA?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                         <?php echo $totalRows_productost; ?>
                                    </h3>
                                    <p>
                                        Productos
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <a href="index.php?mod=gestor-productos" class="small-box-footer">
                                    Ver Productos <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <?php } ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       <?php echo $totalRows_factura;?>
                                    </h3>
                                    <p>
                                        Facturas
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-print"></i>
                                </div>
                                <a href="index.php?mod=nueva-factura&p=6" class="small-box-footer">
                                    Nueva Factura <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $totalRows_usuariot; ?>
                                    </h3>
                                    <p>
                                        Usuarios Registrados
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="index.php?mod=nuevo-usuario"  class="small-box-footer">
                                    Nuevo Usuario <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       <?php echo $totalRows_articuloblog; ?>
                                    </h3>
                                    <p>
                                        Articulos Blog
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <a href="index.php?mod=nuevo-articulo-blog" class="small-box-footer">
                                    Nuevo Articulo <i class="fa fa-arrow-circle-right"></i>
                                </a>

                            </div>
                        </div><!-- ./col -->

<?php } /*FIN PRINCIPAL*/?>


<?php /* GESTOR DE USUARIOS */
if ($_GET['mod']=="gestor-usuarios") { 
    require_once('modules/usuarios/admin.php');
}
if ($_GET['mod']=="nuevo-usuario") { 
    require_once('modules/usuarios/nuevo.php');
}
if ($_GET['mod']=="modificar-usuario") { 
    require_once('modules/usuarios/modificar.php');
}
/*FIN DE GESTOR DE USUARIOS*/?>

<?php /* GESTOR DE ARTICULOS BLOG */
if ($_GET['mod']=="gestor-blog") { 
    require_once('modules/plantilla-articulos/admin.php');
}
if ($_GET['mod']=="nuevo-articulo-blog") { 
    require_once('modules/plantilla-articulos/nuevo.php');
}
if ($_GET['mod']=="modificar-articulo-blog") { 
    require_once('modules/plantilla-articulos/modificar.php');
}

if ($_GET['mod']=="gestor-categoria-articulos") { 
    require_once('modules/plantilla-articulos-categoria/admin.php');
}
if ($_GET['mod']=="nueva-categoria-articulo") { 
    require_once('modules/plantilla-articulos-categoria/nuevo.php');
}
if ($_GET['mod']=="modificar-categoria-articulo") { 
    require_once('modules/plantilla-articulos-categoria/modificar.php');
}
/*FIN DE GESTOR DE USUARIOS*/?>

<?php /* GESTOR DE MODULOS */
if ($_GET['mod']=="gestor-modulos") { 
    require_once('modules/plantilla/admin.php');
}
if ($_GET['mod']=="nuevo-modulo") { 
    require_once('modules/plantilla/nuevo.php');
}
if ($_GET['mod']=="modificar-modulo") { 
    require_once('modules/plantilla/modificar.php');
}
/*FIN DE GESTOR DE MODULOS*/?>

<?php /* GESTOR DE CONTENIDO */
if ($_GET['mod']=="gestor-contenido") { 
    require_once('modules/plantilla-articulos-contenido/admin.php');
}
if ($_GET['mod']=="nuevo-contenido") { 
    require_once('modules/plantilla-articulos-contenido/nuevo.php');
}
if ($_GET['mod']=="modificar-contenido") { 
    require_once('modules/plantilla-articulos-contenido/modificar.php');
}


/*FIN DE GESTOR DE MODULOS*/?>

<?php /* GESTOR DE BANNERS */
if ($_GET['mod']=="gestor-banner") { 
    require_once('modules/banners/admin.php');
}
if ($_GET['mod']=="nuevo-banner") { 
    require_once('modules/banners/nuevo.php');
}
if ($_GET['mod']=="modificar-banner") { 
    require_once('modules/banners/modificar.php');
}
/*FIN DE GESTOR DE BANNERS*/?>

<?php /* GESTOR DE MENU */
if ($_GET['mod']=="gestor-menu") { 
    require_once('modules/plantilla-menu/admin.php');
}
if ($_GET['mod']=="nuevo-menu") { 
    require_once('modules/plantilla-menu/nuevo.php');
}
if ($_GET['mod']=="modificar-menu") { 
    require_once('modules/plantilla-menu/modificar.php');
}
/*FIN DE GESTOR DE BANNERS*/?>

<?php /* GESTOR DE PRODUCTOS */

if ($_GET['mod']=="gestor-productos") { 
    require_once('modules/productos/admin.php');
}
if ($_GET['mod']=="nuevo-producto") { 
    require_once('modules/productos/nuevo.php');
}
if ($_GET['mod']=="modificar-producto") { 
    require_once('modules/productos/modificar.php');
}

/* CATEGORIA */

if ($_GET['mod']=="gestor-categoria-productos") { 
    require_once('modules/productos-categoria/admin.php');
}
if ($_GET['mod']=="nueva-categoria-producto") { 
    require_once('modules/productos-categoria/nuevo.php');
}
if ($_GET['mod']=="modificar-categoria-producto") { 
    require_once('modules/productos-categoria/modificar.php');
}

/* MARCAS */

if ($_GET['mod']=="gestor-marcas") { 
    require_once('modules/productos-marca/admin.php');
}
if ($_GET['mod']=="nueva-marca-producto") { 
    require_once('modules/productos-marca/nuevo.php');
}
if ($_GET['mod']=="modificar-marca-producto") { 
    require_once('modules/productos-marca/modificar.php');
}

/* FACTURACION */

if ($_GET['mod']=="gestor-proveedor") { 
    require_once('modules/facturacion-proveedor/admin.php');
}
if ($_GET['mod']=="nuevo-proveedor") { 
    require_once('modules/facturacion-proveedor/nuevo.php');
}
if ($_GET['mod']=="modificar-proveedor") { 
    require_once('modules/facturacion-proveedor/modificar.php');
}

if ($_GET['mod']=="gestor-recompra") { 
    require_once('modules/facturacion/recompra.php');
}
if ($_GET['mod']=="nueva-recompra") { 
    require_once('modules/facturacion/nueva-recompra.php');
}
if ($_GET['mod']=="nueva-factura") { 
    require_once('modules/facturacion/nueva-factura.php');
}
if ($_GET['mod']=="gestor-factura") { 
    require_once('modules/facturacion/gestor-factura.php');
}

/*FIN DE GESTOR DE PRODUCTOS*/?>

<?php 
if ($_GET['mod']=="gestor-multimedia") { ?>

<iframe src="modules/filemanager/dialog.php" id="frame-multimedia"></iframe>
<?php } ?>




<!-- FIN LISTADO DE INMUEBLES -->
</div><!-- FIN CONTENIDO CENTRAL -->

<?php /*
                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-cloud"></i>

                                    <h3 class="box-title">Server Load</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <!-- bar chart -->
                                            <div class="chart" id="bar-chart" style="height: 250px;"></div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="pad">
                                                <!-- Progress bars -->
                                                <div class="clearfix">
                                                    <span class="pull-left">Bandwidth</span>
                                                    <small class="pull-right">10/200 GB</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">Transfered</span>
                                                    <small class="pull-right">10 GB</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 70%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">Activity</span>
                                                    <small class="pull-right">73%</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-light-blue" style="width: 70%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">FTP</span>
                                                    <small class="pull-right">30 GB</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 70%;"></div>
                                                </div>
                                                <!-- Buttons -->
                                                <p>
                                                    <button class="btn btn-default btn-sm"><i class="fa fa-cloud-download"></i> Generate PDF</button>
                                                </p>
                                            </div><!-- /.pad -->
                                        </div><!-- /.col -->
                                    </div><!-- /.row - inside box -->
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <input type="text" class="knob" data-readonly="true" value="80" data-width="60" data-height="60" data-fgColor="#f56954"/>
                                            <div class="knob-label">CPU</div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#00a65a"/>
                                            <div class="knob-label">Disk</div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center">
                                            <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#3c8dbc"/>
                                            <div class="knob-label">RAM</div>
                                        </div><!-- ./col -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->        
                            
                            <!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
                                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                                </div>
                            </div><!-- /.nav-tabs-custom -->
                                                
                            <!-- Calendar -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                                    <div class="box-title">Calendar</div>
                                    
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Add new event</a></li>
                                                <li><a href="#">Clear events</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">View calendar</a></li>
                                            </ul>
                                        </div>
                                    </div><!-- /. tools -->                                    
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <!--The calendar -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <!-- quick email widget -->
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>

                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                                                        
                            <!-- Map box -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">                                        
                                        <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->

                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        Visitors
                                    </h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div id="world-map" style="height: 300px;"></div>
                                    <div class="table-responsive">
                                        <!-- .table - Uses sparkline charts-->
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Country</th>
                                                <th>Visitors</th>
                                                <th>Online</th>
                                                <th>Page Views</th>
                                            </tr>
                                            <tr>
                                                <td><a href="#">USA</a></td>
                                                <td><div id="sparkline-1"></div></td>
                                                <td>209</td>
                                                <td>239</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">India</a></td>
                                                <td><div id="sparkline-2"></div></td>
                                                <td>131</td>
                                                <td>958</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Britain</a></td>
                                                <td><div id="sparkline-3"></div></td>
                                                <td>19</td>
                                                <td>417</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Brazil</a></td>
                                                <td><div id="sparkline-4"></div></td>
                                                <td>109</td>
                                                <td>476</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">China</a></td>
                                                <td><div id="sparkline-5"></div></td>
                                                <td>192</td>
                                                <td>437</td>
                                            </tr>
                                            <tr>
                                                <td><a href="#">Australia</a></td>
                                                <td><div id="sparkline-6"></div></td>
                                                <td>1709</td>
                                                <td>947</td>
                                            </tr>
                                        </table><!-- /.table -->
                                    </div>
                                </div><!-- /.box-body-->
                                <div class="box-footer">
                                    <button class="btn btn-info"><i class="fa fa-download"></i> Generate PDF</button>
                                    <button class="btn btn-warning"><i class="fa fa-bug"></i> Report Bug</button>
                                </div>
                            </div> 
                            <!-- /.box -->

                            <!-- Chat box -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-comments-o"></i> Chat</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        <div class="btn-group" data-toggle="btn-toggle" >
                                            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>                                            
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar.png" alt="user image" class="online"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                Mike Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                        <div class="attachment">
                                            <h4>Attachments:</h4>
                                            <p class="filename">
                                                Theme-thumbnail-image.jpg
                                            </p>
                                            <div class="pull-right">
                                                <button class="btn btn-primary btn-sm btn-flat">Open</button>
                                            </div>
                                        </div><!-- /.attachment -->
                                    </div><!-- /.item -->
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar2.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                                                Jane Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div><!-- /.item -->
                                    <!-- chat item -->
                                    <div class="item">
                                        <img src="img/avatar3.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                                                Susan Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div><!-- /.item -->
                                </div><!-- /.chat -->
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Type message..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box (chat box) -->

                            <!-- TO DO List -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">To Do List</h3>
                                    <div class="box-tools pull-right">
                                        <ul class="pagination pagination-sm inline">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <ul class="todo-list">
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>  
                                            <!-- checkbox -->
                                            <input type="checkbox" value="" name=""/>                                            
                                            <!-- todo text -->
                                            <span class="text">Design a nice theme</span>
                                            <!-- Emphasis label -->
                                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>                                            
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Make the theme responsive</span>
                                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Check your messages and notifications</span>
                                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                    <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                                </div>
                            </div><!-- /.box -->

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->
*/?>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->




        
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <?php /*
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
*/?>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <script>
        $(document).ready(function() {
            $('#cweb').hide();
        });
            function cargar(div, desde)
            {
                 $('#cweb').show();
                 $(div).load(desde, function() {
                    $('#cweb').hide();
                    });


            }
        </script>

 <div id="cweb">
<CENTER>
<div id="cweb-gif">
<img src="images/load.gif"><br>
    CARGANDO...
</div>

</CENTER>
</div>



    </body>
</html>