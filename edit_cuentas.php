<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
    
        require_once 'class/cuentas.php';

        $obj = new Cuentas();
        $list_cuentas = $obj->listaCuentas();

             
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
    <link href="css/jquery.dataTables.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"> body {padding-bottom: 40px; background-color: #eee; } </style>
 </head>

  <body>

    <div class="container">

       <?php include ("partes/nav.php"); ?>

      <div class="row"> 

    <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="home.php"><span class="glyphicon glyphicon-home"></a></li>
            <li>CUENTAS OFICIALES</li>
            <li class="active">MODIFICACIÓN DE CUENTAS</li>
          </ul>
    </div> 

                <?php include ("partes/menu.php"); ?>


    <div class="col-md-10">

      <div class="panel panel-primary">
        
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span> Modificaci&oacute;n de Cuentas</h3>
        </div>
        
        <div class="panel-body">

         

             <table id="cuentas" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="info">
                <th>Cuenta</th>
                <th>SAF</th>
                <th>Sector</th>
                <th>Denominaci&oacute;n</th>
                <th>Banco</th>
                <th>Fecha Apertura</th>
                <th>Observación</th>
                <th>Tipo Cta.</th>
                <!-- <th>Fecha Baja</th> -->
                <th>Operación</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr class="info">
              <th>Cuenta</th>
              <th>SAF</th>
              <th>Sector</th>
              <th>Denominaci&oacute;n</th>
              <th>Banco</th>
              <th>Fecha Apertura</th>
              <th>Observación</th>
              <th>Tipo Cta.</th>
              <!-- <th>Fecha Baja</th> -->
              <th>Operación</th>
          </tr>
        </tfoot>
 
        <tbody>

           <?php
              for($i=0;$i<sizeof($list_cuentas);$i++){
            ?>

            <tr>
                <td><?php echo $list_cuentas[$i]["cta"]; ?></td>
                <td><?php echo $list_cuentas[$i]["saf"]; ?></td>
                <td><?php echo $list_cuentas[$i]["sector"]; ?></td>
                <td><?php echo $list_cuentas[$i]["denominacion"]; ?></td>
                <td><?php echo $list_cuentas[$i]["banco"]; ?></td>
                <td><?php echo $list_cuentas[$i]["fecha"]; ?></td>
                <td><?php echo $list_cuentas[$i]["observaciones"]; ?></td>
                <td><?php echo $list_cuentas[$i]["fdopropio"]; ?></td>
                <!-- <td><?php //echo $list_cuentas[$i]["fecbaja"]; ?></td> -->
                <td>
                    <a href="modificar_firmante.php?id=<?php echo $list_cuentas[$i]["id"];?>" title="Modificar Firmante"><span class="glyphicon glyphicon-user"></span></a>
                    <a href="cambiar_saf.php?id=<?php echo $list_cuentas[$i]["id"];?>" title="Cambiar SAF"><span class="glyphicon glyphicon-transfer"></span></a>
                    <a href="baja_cuenta.php?id=<?php echo $list_cuentas[$i]["id"];?>" title="Baja de Cuenta"><span class="glyphicon glyphicon-trash"></span></a>
                    <a href="modificar_cuenta.php?id=<?php echo $list_cuentas[$i]["id"];?>" title="Modificar Cuenta"><span class="glyphicon glyphicon-list"></span></a>
                    <a href="resoluciones.php?id=<?php echo $list_cuentas[$i]["id"];?>" title="Resoluciones de Cuenta"><span class="glyphicon glyphicon-file"></span></a>
                </td>
            </tr>

          <?php } ?>

           
        </tbody>
    </table>

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
    <script src="js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    
    <?php if (empty($_GET["cta"])) { ?>
    <script>
        $(document).ready(function() {
        $('#cuentas').dataTable();
        } );
    </script>
    <?php } else { $cta = $_GET["cta"]; ?>
    <script>
        $(document).ready(function() {
        $('#cuentas').dataTable({
          "search": {"search": "<?php echo $cta; ?>"}
        });
        } );
    </script>
    <?php }?> 

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