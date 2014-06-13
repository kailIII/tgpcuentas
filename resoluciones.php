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
        $obj6->guardarResolucionNueva($_POST["id"], $_POST["id_cta"], $_FILES["foto"], $_POST["motivo"]);
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
	
	<?php
		include ("partes/nav.php");
	?>

<div class="container-fluid">

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
                          <h4><p class="text-center">Cuenta sin Resoluciones Escaneadas</p></h4>
                      </div>
                  </div>
          </div>

            <div class="row">

                <form class="form-horizontal" role="form" action="resoluciones.php" method="POST" enctype="multipart/form-data">
                 
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Cargar Resolución</label>
                    <div class="col-sm-3">
                       <input type="file" class="form-control" name="foto" required title="Seleccione la Resolucion Escaneada">
                    </div>
                  </div>              
    
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Motivo</label>
                    <div class="col-sm-3">
                        <select class="form-control" name="motivo" required title="Seleccione el Motivo de la Resolucion">
                          <option value="">Sin Especificar</option>
                          <option value="CREACION">CREACION</option>
                          <option value="MODIFICACION">MODIFICACION</option>
                          <option value="BAJA">BAJA</option>
                        </select>
                    </div>
                  </div>

                   <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-primary" onclick="location='edit_cuentas.php'">Cancelar</button>
                          <input type="hidden" name="Guardar" value="Si" />
                          <input type="hidden" name="id" value="<?php echo $row[0]["idcta"]; ?>"/>
                          <input type="hidden" name="id_cta" value="<?echo $row[0]['cta'];?>" />                        
                        </div>
                      </div>
                </form>

            </div>

            <?php
              }

              for ($i=0; $i < sizeof($resolucion); $i++) { 
            ?>
              
              <div class="row">
                <div class="col-sm-4 col-md-2">
                  <div class="thumbnail">
                    <img src="resoluciones/<?php echo $resolucion[$i]['direccion']; ?>.jpg" alt="Cuenta Nro: <?php echo $resolucion[$i]['cuenta']; ?> - Motivo: <?php echo $resolucion[$i]['motivo']; ?>">
                    <div class="caption">
                      <p class="text-center bg-danger">Motivo: <?php echo $resolucion[$i]['motivo']; ?></p>
                      <p class="text-center"><a href="resoluciones/<?php echo $resolucion[$i]['direccion']; ?>.jpg" rel="shadowbox[Mixed];" title="Cuenta Nro: <?php echo $resolucion[$i]['cuenta']; ?> - Motivo: <?php echo $resolucion[$i]['motivo']; ?>" class="btn btn-primary" role="button">Ver</a></p>
                    </div>
                  </div>
                </div>
              </div>

           <?php     
                }
            ?>
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