<?php 
require_once('modules/inc/conexion_sinsesion.inc.php');
require_once('modules/inc/config.inc.php');
mysql_select_db($database_sistemai, $sistemai);
$query_users = "SELECT * FROM sis_users_cuenta";
$users = mysql_query($query_users, $sistemai) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
   $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=md5($_POST['password']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_sistemai, $sistemai);
  
  $LoginRS__query=sprintf("SELECT username, password FROM sis_users_cuenta WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $sistemai) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;       

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];  
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
   
    echo "<div id='error-clave'>Error! clave o usuario Incorrecto</div>";
  }
}
?>
<?php
// Make the page validate
//ini_set('session.use_trans_sid', '0');

// Include the random string file
require 'modules/acceso/rand.php';

// Begin the session
session_start();

// Set the session contents
$_SESSION['captcha_id'] = $str;

// CONSULTA SQL


?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title><?php echo $row_config['title_site'];?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
          body{
            background: #9d97c9; /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover,  #9d97c9 0%, #23538a 100%); /* FF3.6+ */
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#9d97c9), color-stop(100%,#23538a)); /* Chrome,Safari4+ */
            background: -webkit-radial-gradient(center, ellipse cover,  #9d97c9 0%,#23538a 100%); /* Chrome10+,Safari5.1+ */
            background: -o-radial-gradient(center, ellipse cover,  #9d97c9 0%,#23538a 100%); /* Opera 12+ */
            background: -ms-radial-gradient(center, ellipse cover,  #9d97c9 0%,#23538a 100%); /* IE10+ */
            background: radial-gradient(ellipse at center,  #9d97c9 0%,#23538a 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9d97c9', endColorstr='#23538a',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
          }
        </style>
    </head>
    <body>

        <div class="form-box" id="login-box">
            <div class="header">
                <img src="images/logo.png" width="80%" />

            </div>
            <form action="<?php echo $loginFormAction; ?>" method="post" id="captchaform">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="ID Usuario" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Clave" required/>
                    </div>   
                    <?php /*       
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                    */?>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-blue2 btn-block">Entrar</button>  
                    
                    <p><a href="#">Olvidé mi contraseña</a></p>
                    
                </div>
            </form>

         

            <div class="credito-form">
                <span><b>INTERSOFT-latin</b> <br>Todos los derechos reservados &copy; 2014<br>Versi&oacute;n 3.0 </span>
            </div>
           
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>