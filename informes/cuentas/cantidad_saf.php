<?php
//require_once("../../init.php");
require_once("../../class/class.php");
require_once("../../class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
    
        require_once("../../class/Informes.php");

$obj1 = new Informes();
$cantidadSaf = $obj1->cantidadPorSaf();
            
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Padrón de Cuentas Oficiales</title>
    <link rel="shortcut icon" href="../../img/favicon.ico"/>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="../../css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="../../css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"> body { padding-top: 70px; padding-bottom: 40px; background-color: #eee; } </style>
 </head>

  <body>
	
	<?php
    include ("../nav.php");
	?>

<div class="container">

  <div class="panel panel-danger">   
    
    <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Informe de Cantidad de Cuentas por SAF</h3>
    </div>  
    
    <div class="panel-body">
    
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
         <button type="button" class="btn btn-danger" onclick="window.open('cantidad_saf_pdf.php', 'popup')"><i class="fa fa-file-pdf-o"></i> PDF</button>      
         <button type="button" class="btn btn-success" onclick="location='cantidad_saf_exel.php'"><i class="fa fa-file-excel-o"></i> EXEL</button>      
        </div>
    </div>
    <br>

          <table class="table table-hover">
            <thead>
                <tr class="info">
                   <th>Nro. SAF</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
              <tbody>
                    <?php
                      
                                for($i=0;$i<sizeof($cantidadSaf);$i++){
                                   
                                ?>
                                <tr>
                                    <td><?php echo $cantidadSaf[$i]["saf"]; ?></td>
                                    <td><?php echo $cantidadSaf[$i]["nombre"]; ?></td>
                                    <td><?php echo $cantidadSaf[$i]["cantidad"]; ?></td>
                                </tr>
                                <?php
                                  }
                                ?>
                                
              </tbody>
          </table>
        </div>    

        <div class="panel-footer"><?php include ("../../partes/footer.php");?></div>   

    </div>
</div> <!-- /container -->
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

          
</body>
</html>
<!--FINALIZA LA SESION-->
<?php
}else
{
	echo "<script type='text/javascript'>
	alert('Ud debe Iniciar Sesi\u00f3n para acceder a este contenido.');
	window.location='../../index.php';
	</script>";
}		