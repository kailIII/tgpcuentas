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
        require_once 'class/Resoluciones.php';
    
    if (!empty($_GET["id"])) 
         {
             $id = $_GET["id"];
             $obj4 = new Cuentas();
             $row = $obj4->idCambiarSaf($id);
         }

    $obj1 = new Saf();
    $saf = $obj1->Ordenar_Saf();
    
    $obj2 = new Sectores();
    $sector = $obj2->Ordenar_Sector();
    
    $obj3 = new Bancos();
    $banco = $obj3->Ordenar_Banco();

    $obj6 = new FirmanteCuentas();
    $listFirmantesCuenta = $obj6->listFirmantesCuenta($_GET["id"]);

    $obj5 = new Firmantes();
    if (isset($_POST["Buscar"]) and $_POST["Buscar"] == 1) {
        
        $idFirmante = $obj5->idFirmante($_POST["dni"]);

    }

    $obj8 = new Resoluciones();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == 2) {

        $obj8->guardarResolucionFirmante($row[0]["idCta"], $row[0]["cta"]);
        
        $obj7 = new FirmanteCuentas();
        $obj7->addFirmanteCuentas($row[0]["cta"], $_POST["doc"], $_POST["fecha"], $id, $_POST["resolucion"]);
        header("Location: modificar_firmante.php?id=$id");
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
    <script src="js/jquery.min.js"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
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
            <li class="active">ASIGNAR - MODIFICAR FIRMANTE</li>
          </ul>
    </div>  

      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

  <div class="panel panel-primary">   
    
    <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Modificacion de Firmantes</h3>
    </div>  
    
    <div class="panel-body">

        <blockquote>
          <p>Datos de la Cuenta</p>
        </blockquote>

          <table class="table table-hover">
            <thead>
                <tr class="info">
                    <th>Nro. Cuenta</th>
                    <th>Acto Adm.</th>
                    <th>Fecha Acto</th>
                    <th>Observaciones</th>
                    <th>SAF</th>
                    <th>Sector</th>
                    <th>Denominacion</th>
                    <th>Banco</th>                                 
                </tr>
             </thead>
              <tbody>
                    <tr>
                        <td><?php echo $row[0]["cta"]; ?></td>
                        <td><?php echo $row[0]["actoadm"]; ?></td>
                        <td><?php echo $row[0]["fecha"]; ?></td>
                        <td><?php echo $row[0]["observaciones"]; ?></td>
                        <td><?php echo $row[0]["servicio"]; ?></td>
                        <td><?php echo $row[0]["sector"]; ?></td>
                        <td><?php echo $row[0]["denominacion"]; ?></td>    
                        <td><?php echo $row[0]["banco"]; ?></td>  
                    </tr>
                </tbody>
          </table>

            <blockquote>
              <p>Firmantes</p>
            </blockquote>

          <table class="table table-hover">
            <thead>
                <tr class="info">
                   <th>DNI</th>
                    <th>Apellido y Nombre</th>
                    <th>Domicilio</th>
                    <th>Cargo</th>
                    <th>Acto Alta</th>
                    <th>Fecha Alta</th>
                    <th>Operaciones</th>                               
                </tr>
             </thead>
              <tbody>
                                 <?php
                                 
                                    for ($i = 0;$i < sizeof($listFirmantesCuenta);$i++) {

                                    ?>
                                <tr>
                                    <td><?php echo $listFirmantesCuenta[$i]["dni"]; ?></td>
                                    <td><?php echo $listFirmantesCuenta[$i]["nombre"]; ?></td>
                                    <td><?php echo $listFirmantesCuenta[$i]["domicilio"]; ?></td>
                                    <td><?php echo $listFirmantesCuenta[$i]["cargo"]; ?></td>    
                                    <td><?php echo $listFirmantesCuenta[$i]["resalta"]; ?></td>  
                                    <td><?php echo $listFirmantesCuenta[$i]["fechaalta"]; ?></td>      
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="modificar_firmante_resolucion.php?firm=<?php echo $listFirmantesCuenta[$i]["id"];?>&&idcta=<?php echo $row[0]["idCta"];?>" title="Modificar Resolucion"><span class="glyphicon glyphicon-list"></span></a>&nbsp;&nbsp;
                                        <a href="baja_firmante.php?firm=<?php echo $listFirmantesCuenta[$i]["id"];?>&&idcta=<?php echo $row[0]["idCta"]; ?>" title="Baja de Firmante"<span class="glyphicon glyphicon-remove"></span></a>

                                    </td>
                                </tr>
                                <?php
                                  }
                                if(empty($listFirmantesCuenta)){
                                ?>     
                                <tr>
                                    <td colspan="11">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-danger">
                                                <h4><p class="text-center">No existe Firmante asociado a la Cuenta</p></h4>
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

    </div>

    <div class="panel panel-success">   
    
        <div class="panel-heading">
              <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Agregar Firmantes</h3>
        </div>  
        
        <div class="panel-body">
            
            <div class="row">
              <div class="col-sm-12">
                
                <form class="form-horizontal" role="form" action="modificar_firmante.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                     <div class="form-group">
                            <label class="col-sm-3 control-label">Ingrese DNI</label>
                            <div class="col-sm-3">
                            
                               <div class="input-group">
                                  <input type="text" class="form-control" placeholder="DNI del Firmante" name="dni" title="Ingrese DNI del Firmante">
                                  <span class="input-group-btn">
                                    <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                  </span>
                                  <input type="hidden" name="Buscar" value="1">
                              </div>

                            </div>
                    </div>

                     <?php 
                        if (!empty($idFirmante)) {
                     ?>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">Apellido y Nombre</label>
                            <div class="col-sm-5">
                               <input type="text" class="form-control" name="nombre" readonly value="<?php echo $idFirmante[0]["nombre"]; ?>">
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">DNI</label>
                            <div class="col-sm-5">
                               <input type="text" class="form-control" name="doc" readonly value="<?php echo $idFirmante[0]["dni"]; ?>">
                            </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Fecha de Alta</label>
                      <div class="col-sm-3">
                        <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy/mm/dd">
                          <div class="input-group">
                            <input class="form-control" type="text" value="" name="fecha" required autofocus placeholder="aaaa/mm/dd" title="Ingrese la Fecha de Alta">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button"><span class="add-on"><span class="glyphicon glyphicon-calendar"></span></span></button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Resolución Alta</label>
                            <div class="col-sm-5">
                               <input type="text" class="form-control" name="resolucion" title="Ingrese Resolucion Alta" required>
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
                                         <input id='file-1' type='file' class='file' name='foto$x' title='Seleccione la Resolucion Escaneada' data-preview-file-type='any'>
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
                          <button type="button" class="btn btn-default" onclick="location='modificar_firmante.php?id=<?php echo $id; ?>'">Cancelar</button>
                          <input type="hidden" name="Guardar" value="2" />
                        </div>
                      </div>

                      <?php       
                        }
                        ?>

                </form>
              
              </div>
            </div>

            <!-- Modal  para ingresar la cantidad de INPUT FILE-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cantidad de Imagenes a Cargar</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" action="modificar_firmante.php?id=<?php echo $id; ?>" method="POST" role="form">

                      <div class="form-group">
                        
                        <label class="col-sm-4 control-label">Imágenes a Cargar</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                              <input type="text" name="cant_archivos" class="form-control" autofocus>
                              <input type="hidden" name="dni" value="<?php echo $idFirmante[0]["dni"]; ?>">
                              <input type="hidden" name="Buscar" value="1">
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