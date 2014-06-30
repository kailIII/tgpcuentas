<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

//ABRE LA SESION
if ($_SESSION["session_user"] and $_SESSION["session_name"] and $_SESSION["session_perfil"]){
	$obj=new Usuarios();
	$perfil=$obj->get_permisos_por_id(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Padrón de Cuentas Oficiales</title>
    <link rel="shortcut icon" href="img/favicon.ico"/>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"> body { padding-top: 70px; padding-bottom: 40px; background-color: #eee; } </style>
 </head>

  <body>

    <div class="container">

      <?php include ("partes/nav.php"); ?>

      <div class="row">

      <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
           <!--  <li><a href="active">Inicio</a></li>
            <li><a href="#">Library</a></li> -->
            <li class="active"><span class="glyphicon glyphicon-home"></span></li>
          </ul>
      </div>  

      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">
          
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span> Tesorería General - Pcia. de La Rioja</h3>
            </div>
            <div class="panel-body">
              <h1><small><p class="text-center"><span class="glyphicon glyphicon-list-alt"></span>  Sistema de Padrón de Cuentas Oficiales</p></small></h1>
            </div>
            <div class="panel-footer"><?php include ("partes/footer.php");?></div>
          </div>

        </div>
      </div>

    </div> <!-- /container -->
	
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>  

</body>
</html>
<!--FINALIZA LA SESION-->
<?php
}else
{
	echo "<script type='text/javascript'>
	alert('Ud debe Iniciar Sesi\u00f3n para acceder a este contenido.');
	window.location='index.php';
	</script>";
}		
?>