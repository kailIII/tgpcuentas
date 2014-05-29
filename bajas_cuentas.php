<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
    
        require_once 'class/cuentas.php';
    

    $obj5 = new Cuentas();
    $ctas = $obj5->inicioBajaCuentas();

 
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
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

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
		include ("partes/nav.php");
	?>

<div class="container-fluid">

  <div class="panel panel-primary">   
    
    <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Cuentas Oficiales en Tramite de Baja</h3>
    </div>  
    
    <div class="panel-body">

          <table class="table table-hover">
            <thead>
                <tr class="info">
                    <th>Cuenta</th>
                    <th>SAF</th>
                    <th>Sector</th>
                    <th>Denominaci&oacute;n</th>
                    <th>Banco</th>
                    <th>Inicio de Baja</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
               <tbody>
                                 <?php
                                if(!empty($ctas))
                                {
                                for($i=0;$i<sizeof($ctas);$i++){
                                 
                                    
                                ?>
                                <tr>
                                    <td><?php echo $ctas[$i]["cta"]; ?></td>
                                    <td><?php echo $ctas[$i]["saf"]; ?></td>
                                    <td><?php echo $ctas[$i]["organismo"]; ?></td>
                                    <td><?php echo $ctas[$i]["denominacion"]; ?></td>
                                    <td><?php echo $ctas[$i]["banco"]; ?></td>
                                    <td><?php echo $ctas[$i]["fecbajainicio"]; ?></td>
                                    <td align="center">
                                        <a href="baja_cuenta_definitiva.php?id=<?php echo $ctas[$i]["id"];?>" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                </tr>
                                <?php
                                  }
                                }
                                ?>
                                
                                <?php
                                   if(empty($ctas)){
                                ?>     
                                <tr>
                                    <td colspan="6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="alert alert-danger">
                                                <h4><p class="text-center">No existe registro de Inicio de Baja de Cuentas</p></h4>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                               <?php
                                   }
                                ?>
                    </tbody>
          </table>
        </div>    

        <div class="panel-footer"><?php include ("partes/footer.php");?></div>   

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