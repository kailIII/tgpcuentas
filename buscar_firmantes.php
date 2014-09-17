<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
        require_once 'class/firmantes.php';
        
        $obj2 = new Firmantes();
        $list_firm = $obj2->listaFirmante();
 
             
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
            <li>FIRMANTES</li>
            <li class="active">BÚSQUEDA DE FIRMANTES</li>
          </ul>
      </div>
      
      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

      <div class="panel panel-primary">
        
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span> Búsqueda de Firmante</h3>
        </div>
        
        <div class="panel-body">
                

               <table id="firmantes" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="info">
                <th>SAF</th>
                <th>DNI</th>
                <th>Apellido y Nombre</th>
                <th>Domicilio</th>
                <th>Cargo</th>
                <th>Editar</th>   
            </tr>
        </thead>
 
        <tfoot>
            <tr class="info">
                <th>SAF</th>
                <th>DNI</th>
                <th>Apellido y Nombre</th>
                <th>Domicilio</th>
                <th>Cargo</th>
                <th>Editar</th>
            </tr>
        </tfoot>
 
        <tbody>

           <?php
              for($i=0;$i<sizeof($list_firm);$i++){
            ?>

            <tr>
                <td><?php echo $list_firm[$i]["saf"]; ?></td>
                <td><?php echo $list_firm[$i]["dni"]; ?></td>
                <td><?php echo $list_firm[$i]["nombre"]; ?></td>
                <td><?php echo $list_firm[$i]["domicilio"]; ?></td>
                <td><?php echo $list_firm[$i]["cargo"]; ?></td> 
                <td>&nbsp;&nbsp;&nbsp;
                    <a href="edit_firmante.php?id=<?php echo $list_firm[$i]["id"];?>" title="Modificar Firmante"><span class="glyphicon glyphicon-user"></span></a>
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
    
    <?php if (empty($_GET["dni"])) { ?>
    <script>
        $(document).ready(function() {
        $('#firmantes').dataTable();
        } );
    </script>
    <?php } else { $dni = $_GET["dni"]; ?> ?>
    <script>
        $(document).ready(function() {
        $('#firmantes').dataTable({
          "search": {"search": "<?php echo $dni; ?>"}
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