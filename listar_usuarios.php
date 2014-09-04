<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

//ABRE LA SESION
if ($_SESSION["session_user"] and $_SESSION["session_name"] and $_SESSION["session_perfil"]){
	$obj=new Usuarios();
	$perfil=$obj->get_permisos_por_id(); 

  require_once 'class/administradores.php';
  require_once 'class/permisos.php';

  $obj1 = new Administradores();
  $lista = $obj1->Lista_Usuarios();

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
    <style type="text/css"> body {padding-bottom: 40px; background-color: #eee; } </style>
 </head>

  <body>

    <div class="container">

      <?php include ("partes/nav.php"); ?>

      <div class="row">

      <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
           <!--  <li><a href="active">Inicio</a></li>
            <li><a href="#">Library</a></li> -->
            <li class="active"><span class="glyphicon glyphicon-home"></span> INICIO</li>
          </ul>
      </div>  

      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Listado de Usuarios</h3>
            <div class="pull-right">
              <span class="clickable filter" data-toggle="tooltip" title="Filtrar Datos" data-container="body">
                <i class="glyphicon glyphicon-filter"></i>
              </span>
            </div>
          </div>
          <div class="panel-body">

            <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" autofocus placeholder="Buscar usuarios existente" />
          
          </div>
          
          <table class="table table-hover" id="dev-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Apellido y Nombre</th>
                <th>Usuario</th>
                <th>Perfil</th>
                <th><center>Operaciones</center></th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < sizeof($lista); $i++) 
                { 
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $lista[$i]["ape_nom"]; ?></td>
                <td><?php echo $lista[$i]["user"]; ?></td>
                <td><?php echo $lista[$i]["perfil"]; ?></td>
                <td><center><a href="#?id=<?php echo $lista[$i]["idu"];?>" title="Editar Usuario"><span class="glyphicon glyphicon-user"></span></a></center></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

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
    <script src="js/filtertab.js"></script>  

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