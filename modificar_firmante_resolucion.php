<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
        require_once 'class/saf.php';
        require_once 'class/sectores.php';
        require_once 'class/bancos.php';
        require_once 'class/cuentas.php';
        require_once 'class/FirmanteCuentas.php';
        require_once 'class/firmantes.php';
  
    if (!empty($_GET["idcta"]) AND !empty($_GET["firm"])) 
         {
             $obj4 = new Cuentas();
             $row = $obj4->idCambiarSaf($_GET["idcta"]);

             $obj6 = new FirmanteCuentas();
             $firmanteCuenta = $obj6->firmanteCuenta($_GET["firm"]);
         }

    $obj1 = new Saf();
    $saf = $obj1->Ordenar_Saf();
    
    $obj2 = new Sectores();
    $sector = $obj2->Ordenar_Sector();
    
    $obj3 = new Bancos();
    $banco = $obj3->Ordenar_Banco();

    


    $obj7 = new FirmanteCuentas();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == 1) {
        
        $obj7->modificarResolucionFirmante($_POST["id"], $_POST["idCta"], $_POST["fecha_alta"], $_POST["resolucion_alta"]);
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
       <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Modificacion de Resolución de Firmantes</h3>
    </div>  

    <div class="panel-body">

            
           <!--  <form action="#" class="form-horizontal">
               <div class="form-group">
                  <label class="col-sm-2 control-label">Tipo de Cuenta</label>
                  <div class="col-sm-3">
                      <input type="text" class="form-control" readonly value="<?php echo $row[0]['fdopropio']; ?>">             
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nro. Cuenta</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" readonly value="<?php echo $row[0]['cta']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Acto Administrativo</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" readonly value="<?php echo $row[0]['actoadm']; ?>">
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha Acto</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" readonly value="<?php echo $row[0]['fecha']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Observaciones</label>
                  <div class="col-sm-5">
                        <input type="text" class="form-control" readonly name="observacion"  value="<?php echo $row[0]['observaciones']; ?>">
                  </div>
                </div>
            </form> -->

            <blockquote>
              <p>Datos de la Cuenta</p>
            </blockquote>

            <form class="form-horizontal" role="form" action="#" method="POST">
                <div class="form-group">
                  <label class="col-sm-2 control-label">SAF</label>
                  <div class="col-sm-3">
                      <input type="text" class="form-control" name="saf" readonly value="<?php echo $row[0]['servicio']; ?>">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Sector</label>
                  <div class="col-sm-5">
                      <input type="text" class="form-control" name="sector" readonly value="<?php echo $row[0]['sector']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Denominación</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="denominacion" readonly value="<?php echo $row[0]['denominacion']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Banco</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="banco" readonly value="<?php echo $row[0]['banco']; ?>">
                  </div>
                </div>
              </form>
              
               <blockquote>
                <p>Cambio de Resolución y/o Fecha</p>
              </blockquote>
              
              <form class="form-horizontal" role="form" action="modificar_firmante_resolucion.php" method="POST">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Apellido y Nombre</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" readonly value="<?php echo $firmanteCuenta[0]['nombre']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">DNI</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" readonly value="<?php echo $firmanteCuenta[0]['dni']; ?>">
                  </div>
                </div>


                 <div class="form-group">
                   <label class="col-sm-2 control-label">Fecha de Alta</label>
                   <div class="col-sm-3">
                     <input type="date" class="form-control" name="fecha_alta" value="<?php echo $firmanteCuenta[0]['fecha'];?>" autofocus>
                   </div>
                 </div> 

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Resolución de Alta</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="resolucion_alta" size="50" value="<?php echo $firmanteCuenta[0]['resalta'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-primary" onclick="location='modificar_firmante.php?id=<?php echo $_GET["idcta"]; ?>'">Cancelar</button>
                       <input type="hidden" name="Guardar" value="1" />
                       <input type="hidden" name="id" value="<?php echo $firmanteCuenta[0]['id']; ?>">
                       <input type="hidden" name="idCta" value="<?php echo $_GET["idcta"]; ?>" >
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