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
        $obj6->guardarResolucionBaja();
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
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link  href="css/datepicker.css" rel="stylesheet">
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />

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
            <li><a href="bajas_cuentas.php">CUENTAS OFICIALES EN TRAMITE DE BAJA</a></li>
            <li class="active">BAJA DEFINITIVA DE CUENTAS OFICIALES </li>
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
                        <label class="col-sm-3 control-label">Tipo de Cuenta</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" readonly value="<?php echo $row[0]['fdopropio']; ?>">             
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Nro. Cuenta</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" readonly value="<?php echo $row[0]['cta']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Acto Administrativo</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" readonly value="<?php echo $row[0]['actoadm']; ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha Acto</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" readonly value="<?php echo $row[0]['fecha']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Observaciones</label>
                        <div class="col-sm-5">
                              <input type="text" class="form-control" readonly name="observacion"  value="<?php echo $row[0]['observaciones']; ?>">
                        </div>
                      </div>
                  </form>

                  <form class="form-horizontal" role="form" action="baja_cuenta_definitiva.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label class="col-sm-3 control-label">SAF</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="saf" readonly value="<?php echo $row[0]['servicio']; ?>">
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Sector</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="sector" readonly value="<?php echo $row[0]['sector']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Denominación</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="denominacion" readonly value="<?php echo $row[0]['denominacion']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Banco</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" name="banco" readonly value="<?php echo $row[0]['banco']; ?>">
                        </div>
                      </div>
                    
                    <hr>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha de Baja</label>
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
                         <label class="col-sm-3 control-label">Acto de Baja</label>
                         <div class="col-sm-5">
                           <input type="text" class="form-control" name="acto_baja" title="Ingrese Fecha de Baja" required>
                         </div>
                       </div>

                       <?php 
                        if(isset($_POST['cant_archivos'])){ 
                            $cant = $_POST['cant_archivos']; 
                        } 
                        else{ 
                            $cant = 1; 
                        } 
                         
                        $x = 1; 
                        while($x <= $cant){ 
                            echo "<div class='form-group'>
                                    <label class='col-sm-3 control-label'>Carga Resolución $x</label>
                                      <div class='col-sm-5'>
                                         <input id='file-1' type='file' class='file' required name='foto$x' required title='Seleccione la Resolucion Escaneada' data-preview-file-type='any'>
                                      </div>
                                  </div>"; 
                            $x++; 
                        } 
                         
                        echo "<input type='hidden' value='$cant'  name='cant'/>"; 
                    ?>

                    <!-- Button trigger modal -->
                     <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-5">
                            <p class="text-right text-muted">* Cantidad de Resoluciones Escaneadas <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                              <span class="glyphicon glyphicon-plus"></span>
                            </button></p>
                        </div>
                      </div> 

                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-default" onclick="location='bajas_cuentas.php'">Cancelar</button>
                          <input type="hidden" name="Guardar" value="Si">
                          <input type="hidden" name="id" value="<?php echo $row[0]["idcta"]; ?>"/>
                          <input type="hidden" name="nro_cta" value="<?php echo $row[0]['cta'];?>" />
                        </div>
                      </div>
                    </form> 

                    <!-- Modal  para ingresar la cantidad de INPUT FILE-->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Cantidad de Imagenes a Cargar</h4>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" action="#" method="POST" role="form">

                              <div class="form-group">
                                
                                <label class="col-sm-4 control-label">Imágenes a Cargar</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                      <input type="text" name="cant_archivos" class="form-control" autofocus>
                                      <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span></button>
                                      </span>
                                    </div>
                                </div>
                        
                              </div>

                            </form>
                          </div>
                         
                        </div>
                      </div>
                    </div>


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
    <script src="js/fileinput.js" type="text/javascript"></script>
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