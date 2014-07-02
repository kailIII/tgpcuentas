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
  
    if (!empty($_GET["id"])) 
         {
             $id = $_GET["id"];
             $obj4 = new Cuentas();
             $row = $obj4->idCambiarSaf($id);

             $obj5 = new Resoluciones();
             $resolucion = $obj5->listResoluciones($id);
         }

    $obj1 = new Saf();
    $saf = $obj1->Ordenar_Saf();
    
    $obj2 = new Sectores();
    $sector = $obj2->Ordenar_Sector();
    
    $obj3 = new Bancos();
    $banco = $obj3->Ordenar_Banco();

    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == "Si") {
        
        $obj6 = new Resoluciones();
        $obj6->guardarResolucionNueva();
        exit;
    }

    if (isset($_POST["Eliminar"]) and $_POST["Eliminar"] == "Si") {
        
        $obj6 = new Resoluciones();
        $obj6->eliminarResoluciones($_POST["id"], $_POST["id_cta"]);
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
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
    <script type="text/javascript" src="shadowbox/shadowbox.js"></script>
        <script type="text/javascript">
            Shadowbox.init();
        </script>

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

       <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="home.php"><span class="glyphicon glyphicon-home"></span></a></li>
            <li>CUENTAS OFICIALES</li>
            <li><a href="edit_cuentas1.php?cta=<?php echo $row[0]["cta"]; ?>&&saf=<?php echo NULL; ?>">MODIFICACIÓN DE CUENTAS</a></li>
            <li class="active">RESOLUCIONES DE CUENTAS</li>
          </ul>
    </div>  
      
      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

  <div class="panel panel-primary">   
    
    <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Resoluciones de Cuenta</h3>
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
              <p>Resoluciones</p>
            </blockquote>

            <?php
            
            if (empty($resolucion)) {

            ?> 


                  
          <div class="row">
                  <div class="col-sm-5">
                      <div class="alert alert-danger">
                         <p class="text-center">Cuenta sin Resoluciones Escaneadas</p>
                      </div>
                  </div>
          </div>

          <div class="row">
              <div class="col-sm-12">
                <hr>

                <blockquote>
                          <p>Cargar Resoluciones Escaneadas</p>
               </blockquote>

                <form class="form-horizontal" role="form" action="resoluciones.php" method="POST" enctype="multipart/form-data">
                     
                    
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Motivo</label>
                      <div class="col-sm-4">
                          <select class="form-control" name="motivo" required title="Seleccione el Motivo de la Resolucion">
                            <option value="">Sin Especificar</option>
                            <option value="CREACION">CREACION</option>
                            <option value="MODIFICACION">MODIFICACION</option>
                            <option value="BAJA">BAJA</option>
                          </select>
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
                                    <label class='col-sm-3 control-label'>Cargar Resolución $x</label>
                                      <div class='col-sm-5'>
                                         <input id='file-1' type='file' class='file' name='foto$x' value='1' title='Seleccione la Resolucion Escaneada' data-preview-file-type='any'>
                                      </div>
                                  </div>"; 
                            $x++; 
                        } 
                         
                        echo "<input type='hidden' value='$cant'  name='cant'/>"; 
                    ?>

                    <!-- Button trigger modal -->
                   <div class="form-group">
                      <label class="col-sm-2 control-label">&nbsp;</label>
                      <div class="col-sm-6">
                          <p class="text-right text-muted">* Cantidad de Resoluciones Escaneadas <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-plus"></span>
                          </button></p>
                      </div>
                    </div>

                   <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-default" onclick="location='edit_cuentas.php'">Cancelar</button>
                          <input type="hidden" name="Guardar" value="Si" />
                          <input type="hidden" name="id" value="<?php echo $row[0]["idcta"]; ?>"/>
                          <input type="hidden" name="id_cta" value="<?php echo $row[0]['cta'];?>" />                        
                        </div>
                      </div>
                </form>

              </div>
            </div>
    
            <div class="row">
            <?php
              }
              for ($i=0; $i < sizeof($resolucion); $i++) { 
            ?>
              <form action="resoluciones.php" method="POST">
              
                <div class="col-sm-4 col-md-2">
                  <div class="thumbnail">
                    <img src="resoluciones/<?php echo $resolucion[$i]['direccion']; ?>.jpg" alt="Cuenta Nro: <?php echo $resolucion[$i]['cuenta']; ?> - Motivo: <?php echo $resolucion[$i]['motivo']; ?>">
                    <div class="caption">
                      <p class="text-center bg-danger">Motivo: <strong><?php echo $resolucion[$i]['motivo']; ?></strong></p>
                      <p class="text-center"><a href="resoluciones/<?php echo $resolucion[$i]['direccion']; ?>.jpg" rel="shadowbox[Mixed];" title="Cuenta Nro: <?php echo $resolucion[$i]['cuenta']; ?> - Motivo: <?php echo $resolucion[$i]['motivo']; ?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-eye-open"></span></a>
                        <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button></p>
                        <input type="hidden" name="Eliminar" value="Si" />
                        <input type="hidden" name="id" value="<?php echo $resolucion[$i]["id"]; ?>"/>
                        <input type="hidden" name="id_cta" value="<?php echo $resolucion[$i]['id_cuenta'];?>" />  
                    </div>
                  </div>
                </div>
              </form>
           <?php     
                }
            ?>
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

      <div class="panel-footer"><?php include ("partes/footer.php");?></div>   

    </div>

   </div>
  </div>

</div> <!-- /container -->
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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