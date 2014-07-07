<?php
require_once("../class/class.php");
require_once("../class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
        require_once("../class/Informes.php");
                   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Padrón de Cuentas Oficiales</title>
    <link rel="shortcut icon" href="../img/favicon.ico"/>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"> body {padding-bottom: 40px; background-color: #eee; } </style>
 </head>

  <body>

<div class="container">

  <?php
    include ("nav.php");
  ?>

<div class="row">
      
    <?php include ("menu.php"); ?> 
     
      <div class="col-sm-10">

        <div class="panel panel-success">   
          
          <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Informes de Cuentas</h3>
          </div>  
          
          <?php  

                if(isset($_GET["var"]) AND $_GET["var"] == "cuentas1")
                    {
                      $obj1 = new Informes();
                      $cantidadSaf = $obj1->cantidadPorSaf();

                      include ("cantidad_saf.php");
                    }

                if(isset($_GET["var"]) AND $_GET["var"] == "cuentas2")
                    {
                      $obj1 = new Informes();
                      $cantidadBanco = $obj1->cantidadPorBanco();

                      include ("cantidad_banco.php");
                    }
           ?> 


            <?php 
              if (empty($_GET["var"])) {
            ?>
            
            <div class="panel-body">
              <blockquote>
                <p>Seleccione el tipo de Informe que necesita accediendo al Menú de la izquierda. <small>Informes en PDF y Exel</small></p>
              </blockquote>
            </div>

            <?php
              }
            ?>

              <div class="panel-footer"><?php include ("../partes/footer.php");?></div>   

          </div>
      </div>
    </div>
</div> <!-- /container -->
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

          
</body>
</html>
<!--FINALIZA LA SESION-->
<?php
}else
{
	echo "<script type='text/javascript'>
	alert('Ud debe Iniciar Sesi\u00f3n para acceder a este contenido.');
	window.location='../index.php';
	</script>";
}		