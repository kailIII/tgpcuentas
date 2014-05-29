<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
  require_once 'class/aperturaCuenta.php';
        require_once 'class/saf.php';
        require_once 'class/sectores.php';
  
    if (isset($_GET["pos"])) {
        $inicio = $_GET["pos"];
    } else {
        $inicio = 0;
    }

    $obj1=  new Saf();
    $saf = $obj1->Ordenar_Saf();
    
    
    $obj2 = new Sectores();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == "Si") {
        $obj2->Alta_Sector($_POST["saf"]);
        
        $obj5 = new Sectores();
        $obj5->Alta_Sector1($_POST["sector"]);
        
        exit;
    }
    
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

  <div class="container">

        <div class="panel panel-primary">   
          
          <div class="panel-heading">
             <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Alta de Sectores</h3>
          </div>  
          
          <div class="panel-body">
          
                  <form class="form-horizontal" role="form" action="alta_sectores.php" method="POST">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">SAF</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="saf" onchange="slctryole(this,this.form.sector)" autofocus required title="Debe Seleccionar un SAF">
                              <option value="">Sin Especificar</option>


                                  <?php
                                  for($i=0;$i<sizeof($saf);$i++){
                                      ?>
                                  <option title="<?php echo $saf[$i]["nombre"]; ?>" value="<?php echo $saf[$i]["cod_ser"]; ?>"> <?php echo $saf[$i]["servicio"]; ?></option>

                                      <?php
                                        }
                                      ?>
                            </select>
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Sector</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Sector" name="sector" required title="Ingrese un Sector">
                        </div>
                      </div>

                     <br>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-primary" onclick="location='home.php'">Cancelar</button>
                          <input type="hidden" name="Guardar" value="Si" />
                        </div>
                      </div>
                    </form> 
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