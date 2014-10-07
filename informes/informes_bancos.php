<?php
require_once("../class/class.php");
require_once("../class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
        require_once("../class/Informes.php");
        require_once("../class/bancos.php");
        require_once("../class/saf.php")
  
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
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <!-- LIBRERIAS PARA GRAFICOS DE BARRA -->
    <script src="../js/jquery.min.js"></script>
    <?php //include("highcharts.php"); ?>

    <style type="text/css"> body {padding-bottom: 40px; background-color: #eee; } </style>
 </head>

  <body>

<div class="container">

  <?php
    include ("nav.php");
  ?>

<div class="row">

  <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
           <!--  <li><a href="active">Inicio</a></li>
            <li><a href="#">Library</a></li> -->
            <li><a href="../home.php"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">INFORMES</li>
          </ul>
      </div>
      
    <?php include ("menu.php"); ?> 
     
      <div class="col-sm-10">

        <div class="panel panel-success">   
          
          <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Informes de Cuentas</h3>
          </div> 

          <?php  
                switch ($_GET["var"]) {
                  
                  case 'bancos1':

                      $obj1 = new Bancos();
                      $banco = $obj1->Ordenar_Banco();

                      if (isset($_GET["informe"]) and $_GET["informe"] == 1) {

                          $obj2 = new Informes();
                          $listar1 = $obj2->bancoCuentas1($_GET["banco"], $_GET["radio"]);

                        }
                      include ("bancos/bancos.php");

                      break;

                  case 'bancos2':

                      $obj1 = new Bancos();
                      $banco = $obj1->Ordenar_Banco();

                      $obj2 = new Saf();
                      $saf = $obj2->Ordenar_Saf();

                      if (isset($_GET["informe"]) and $_GET["informe"] == 2) {

                          $obj = new Informes();
                          $listar = $obj->bancoCuentas2($_GET["banco"], $_GET["radio"], $_GET["saf"]);

                        }

                      include ("bancos/banco_saf.php");

                      break;
                }


           ?> 


            <?php 
              if (empty($_GET["var"])) {
            ?>
            
            <div class="panel-body">
              <blockquote>
                <p>Seleccione el tipo de Informe que necesita accediendo al Menú de la izquierda. <small>Gráficos de Barras e Informes en PDF y Exel</small></p>
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