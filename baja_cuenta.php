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
  
    $obj1 = new Saf();
    $saf = $obj1->Ordenar_Saf();
    
    $obj2 = new Sectores();
    $sector = $obj2->Ordenar_Sector();
    
    $obj3 = new Bancos();
    $banco = $obj3->Ordenar_Banco();
    
    $obj4 = new Cuentas();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == "Si") {
        
        $obj4->bajaCta($_POST["id"], $_POST["fec_baja"]);
        exit;
    }

     if (!empty($_GET["id"])) 
         {
             $id = $_GET["id"];
             $obj5 = new Cuentas();
             $row = $obj5->idCambiarSaf($id);
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
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link  href="css/datepicker.css" rel="stylesheet">
    
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

  <?php include ("partes/nav.php"); ?>
      
      <div class="row">

       <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="home.php"><span class="glyphicon glyphicon-home"></a></li>
            <li>CUENTAS OFICIALES</li>
            <li><a href="edit_cuentas.php?cta=<?php echo $row[0]["cta"]; ?>">MODIFICACIÓN DE CUENTAS</a></li>
            <li class="active">BAJA DE CUENTA</li>
          </ul>
    </div>  
      
      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

        <div class="panel panel-primary">   
          <div class="panel-heading">
             <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Baja de Cuenta</h3>
          </div>  

          <div class="panel-body">

                  
                  <form action="#" class="form-horizontal">
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
                  </form>

                  <form class="form-horizontal" role="form" action="baja_cuenta.php" method="POST">
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
                    
                    <hr>

                        <div class="form-group">
                        <label class="col-sm-2 control-label">Fecha Inicio de Baja</label>
                        <div class="col-sm-3">
                          <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy/mm/dd">
                            <div class="input-group">
                              <input class="form-control" type="text" value="" name="fec_baja" required autofocus placeholder="aaaa/mm/dd" title="Ingrese la Fecha Inicial de Baja">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="add-on"><span class="glyphicon glyphicon-calendar"></span></span></button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-default" onclick="location='edit_cuentas.php'">Cancelar</button>
                              <input type="hidden" name="Guardar" value="Si" />
                              <input type="hidden" name="id" value="<?php echo $row[0]["idcta"]; ?>"/>
                        </div>
                      </div>
                    </form> 
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
    <script type="text/javascript" src="js/bootstrap-datepicker.js" charset="UTF-8"></script>
    <script>
          $('#dp3').datepicker();
    </script>


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