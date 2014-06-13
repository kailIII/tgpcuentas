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
        require_once 'class/Resoluciones.php';
  
    $obj1 = new Saf();
    $saf = $obj1->Ordenar_Saf();
    
    $obj2 = new Sectores();
    $sector = $obj2->Ordenar_Sector();
    
    $obj3 = new Bancos();
    $banco = $obj3->Ordenar_Banco();

     if (!empty($_GET["id"])) 
         {
             $id = $_GET["id"];
             $obj5 = new Cuentas();
             $row = $obj5->idCambiarSaf($id);
         } 
    
    $obj4 = new Cuentas();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == "Si") {
        
        $obj4->bajaCuentaDefinitiva($_POST["id"], $_POST["fec_baja"], $_POST["acto_baja"]);

        $obj6 = new Resoluciones();
        $obj6->guardarResolucionBaja($_POST["id"], $_POST["id_cta"], $_FILES["foto"]);
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
    <link  href="css/datepicker.css" rel="stylesheet">

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

<div class="container">

   <?php include ("partes/nav.php"); ?>
      
      <div class="row">
      
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

                  <form class="form-horizontal" role="form" action="baja_cuenta_definitiva.php" method="POST" enctype="multipart/form-data">
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
                        <label class="col-sm-2 control-label">Fecha de Baja</label>
                        <div class="col-sm-3">
                          <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy/mm/dd">
                            <div class="input-group">
                              <input class="form-control" type="text" value="" name="fec_baja" required autofocus placeholder="aaaa/mm/dd" title="Ingrese la Fecha de Baja">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="add-on"><span class="glyphicon glyphicon-calendar"></span></span></button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
       

                       <div class="form-group">
                         <label class="col-sm-2 control-label">Acto de Baja</label>
                         <div class="col-sm-5">
                           <input type="text" class="form-control" name="acto_baja" title="Ingrese Fecha de Baja" required>
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-2 control-label">Resolución de Baja</label>
                         <div class="col-sm-5">
                           <input type="file" class="form-control" name="foto" required title="Seleccione la Resolucion Escaneada">
                         </div>
                       </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-primary" onclick="location='bajas_cuentas.php'">Cancelar</button>
                          <input type="hidden" name="Guardar" value="Si">
                          <input type="hidden" name="id" value="<?php echo $row[0]["idcta"]; ?>"/>
                          <input type="hidden" name="id_cta" value="<?php echo $row[0]['cta'];?>" />
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
    <script src="js/bootstrap-datepicker.js"></script>
    <script>
          if (top.location != location) {
            top.location.href = document.location.href ;
          }
            $(function(){
              window.prettyPrint && prettyPrint();
              $('#dp3').datepicker();
              $('#dp3').datepicker();
              $('#dpYears').datepicker();
              $('#dpMonths').datepicker();
              
              
              var startDate = new Date(2012,1,20);
              var endDate = new Date(2012,1,25);
           
                // disabling dates
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            });
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