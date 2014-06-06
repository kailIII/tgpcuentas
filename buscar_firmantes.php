<?php
error_reporting(E_ERROR);
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
        require_once 'class/saf.php';
        require_once 'class/firmantes.php';

        $obj1 = new Saf();
        $list_saf = $obj1->Ordenar_Saf();
    
/////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////PAGINADOR///////////////////////////////////////////////////////////   
$_pagi_sql = "SELECT dni, nombre, saf, id, domicilio, cargo
              FROM firm_datos ORDER BY nombre"; 

$_pagi_cuantos = 5;
$_pagi_nav_num_enlaces = 10;
$_pagi_nav_estilo="pag";
//$_pagi_propagar=array('sec','nom','apli','per');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_primera ="<span class='glyphicon glyphicon-step-backward'></span>";
$_pagi_nav_anterior = "<span class='glyphicon glyphicon-backward'></span>";
$_pagi_nav_ultima = "<span class='glyphicon glyphicon-step-forward'></span>";
$_pagi_nav_siguiente = "<span class='glyphicon glyphicon-forward'></span>";


include("paginator.inc.php");     
////////////////////////////////PAGINADOR/////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////


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
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

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
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span> Búsqueda de Firmante</h3>
        </div>
        
        <div class="panel-body">

            <div class="row">
              <div class="col-md-6 col-md-offset-3">

                <h4><p class="text-center">Buscar Firmante por:</p></h4>
                  <center>
                    <form class="form-inline" role="form" action="buscar_firmantes1.php" method="POST">
                        
                        <div class="form-group">
                                  <select class="form-control" name="saf">
                                    <option value=""><p class="text-muted">SAF</p></option>


                                            <?php
                                            for($i=0;$i<sizeof($list_saf);$i++){
                                                ?>
                                            <option title="<?php echo $list_saf[$i]["nombre"]; ?>" value="<?php echo $list_saf[$i]["servicio"]; ?>"> <?php echo $list_saf[$i]["servicio"];?></option>
                                            
                                                  <?php
                                                   }
                                                ?>   
                                   </select>
                        </div>

                          <div class="form-group">
                            <input type="text" name="dni" class="form-control" placeholder="DNI del Firmante">
                          </div>

                          <div class="form-group">
                            <input type="text" name="ape_nom" class="form-control" placeholder="Apellido y Nombre">
                          </div>

                          <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                   </center>
              </div>
            </div>

           

            <br>
                <table class="table table-hover">
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

              <tbody>
                                 <?php
                                 
                                while($row = mysql_fetch_array($_pagi_result)){ 
    

                                
                                    ?>
                                <tr>
                                    <td><?php echo $row["saf"]; ?></td>
                                    <td><?php echo $row["dni"]; ?></td>
                                    <td><?php echo $row["nombre"]; ?></td>
                                    <td><?php echo $row["domicilio"]; ?></td>
                                    <td><?php echo $row["cargo"]; ?></td>      
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="edit_firmante.php?id=<?php echo $row["id"];?>" title="Modificar Firmante"><span class="glyphicon glyphicon-user"></span></a>
                            
                                    </td>
                                </tr>
                                <?php
                                  }
                                ?>
                                 <tr>
                                    <td colspan="12">
                                        <p class="text-center"><?php echo $_pagi_navegacion; //MUESTRA PAGINADOR ?></p>
                                    </td>
                                </tr>
                                <?php
                                   if($row < 0){
                                ?>     
                                <tr>
                                    <td colspan="11">
                                        <h4 style="color: red; text-align: center">No Existe Registro de Cuenta.</h4>
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