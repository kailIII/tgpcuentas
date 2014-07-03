<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
    require_once 'class/aperturaCuenta.php';
    require_once 'class/saf.php';
    require_once 'class/firmantes.php';
  
    $obj1=  new Saf();
    $saf = $obj1->Ordenar_Saf();
    
    
    $obj2 = new Firmantes();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == 1) {
        
        $obj3 = new Firmantes();
        $idsaf = $obj3->idSaf($_POST["saf"]);
        $saf = $idsaf[0]["servicio"];
        
        $obj2 = new Firmantes();
        $error = $obj2->altaFirmante($saf, $_POST["dni"], $_POST["ape_nom"], $_POST["domicilio"], $_POST["cargo"]);
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
            <li>FIRMANTES</li>
            <li class="active">ALTA DE NUEVOS FIRMANTES</li>
          </ul>
      </div>
      
      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

        <div class="panel panel-primary">   
          
          <div class="panel-heading">
             <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Alta de Firmantes</h3>
          </div>  
          
          <div class="panel-body">
          
                  <form class="form-horizontal" role="form" action="alta_firmantes.php" method="POST">
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
                        <label class="col-sm-2 control-label">DNI</label>
                        <div class="col-sm-3">
                            <input type="text" name="dni" class="form-control" value="" required placeholder="DNI del Firmante" title="Ingrese el DNI">
                        </div>
                      </div>

                       <?php
                          if (isset($_GET["error"]) AND $_GET["error"]==2) {
                        ?>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-5">
                                    <div class="alert alert-danger alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <strong> DNI: <?php echo $_GET['dni']; ?> Registrado por otro Firmante.</strong>
                                    </div>       
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">Apellido y Nombre</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" value="<?php echo $_GET['an'];?>" placeholder="Apellido y Nombre del Firmante" name="ape_nom" required title="Ingrese el Apellido y nombre">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-2 control-label">Domicilio</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" value="<?php echo $_GET['do'];?>" placeholder="Domicilio del Firmante" name="domicilio" required title="Ingrese el Domicilio">
                            </div>
                          </div>

                           <div class="form-group">
                            <label class="col-sm-2 control-label">Cargo</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control" value="<?php echo $_GET['ca'];?>" placeholder="Cargo del Firmante" name="cargo" required title="Ingrese el Cargo">
                            </div>
                          </div>
                      
                      <?php }else{ ?>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Apellido y Nombre</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" placeholder="Apellido y Nombre del Firmante" name="ape_nom" required title="Ingrese el Apellido y nombre">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Domicilio</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" placeholder="Domicilio del Firmante" name="domicilio" required title="Ingrese el Domicilio">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="col-sm-2 control-label">Cargo</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" placeholder="Cargo del Firmante" name="cargo" required title="Ingrese el Cargo">
                        </div>
                      </div>
                      
                      <?php } ?>

                     <br>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-default" onclick="location='home.php'">Cancelar</button>
                          <input type="hidden" name="Guardar" value="1" />
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

          <script language='javascript' type='text/javascript'>
              function slctr(texto,valor)
              {
                  this.texto = texto
                  this.valor = valor
               }
          </script>

          <?php
          ///////////////////////////////////////////////////////////////////////////////////
          //       SCRIPT QUE AUTOMATIZA LA SELECCION DE DOS SELECT POR EJ: LOCALIDADES - PCIA
          ///////////////////////////////////////////////////////////////////////////////////
            echo "<script language='javascript' type='text/javascript'>".chr(13).chr(10);
            $varaux= $sector[0]['cod_saf'];
            echo "var ".$sector[0]['cod_saf']."=new Array()".chr(13).chr(10);
                  $cont=0;
                  //MENSAJE DESPUES DE SELECCIONAR SELECT
                  //echo $sector[0]['cod_saf']."[$cont] = new slctr('Seleccione Sector','d00')".chr(13).chr(10);
                  //$cont++;
            echo $sector[0]['cod_saf']."[$cont] = new slctr('".trim($sector[0]['sector'])."','".$sector[0]['id']."')";
            echo chr(13).chr(10);
            //$cont++; GENERA ERROR
            
                  for($i=0;$i<sizeof($sector);$i++)
                  {
              if ($sector[$i]['cod_saf']==$varaux)
              {
                $vcod=$sector[$i]['cod_saf'];
                echo $sector[$i]['cod_saf']."[$cont] = new slctr('".trim($sector[$i]['sector'])."','".$sector[$i]['id']."')";
                echo chr(13).chr(10);
                $cont++;
              }
              else
              {
                $varaux=$sector[$i]['cod_saf'];
                echo "var ".$sector[$i]['cod_saf']."=new Array()".chr(13).chr(10);
                $cont=0;
                                  //MENSAJE DESPUES DE SELECCIONAR SELECT
                //echo $sector[$i]['cod_saf']."[$cont] = new slctr('Seleccione Sector','d00')".chr(13).chr(10);
                //$cont++;
                echo $sector[$i]['cod_saf']."[$cont] = new slctr('".trim($sector[$i]['sector'])."','".$sector[$i]['id']."')";
                echo chr(13).chr(10);
                $cont++;
              }
            }
            echo "</script>";
          ///////////////////////////////////////////////////////////////////////////////////
          //       SCRIPT QUE AUTOMATIZA LA SELECCION DE DOS SELECT POR EJ: LOCALIDADES - PCIA
          /////////////////////////////////////////////////////////////////////////////////// 
          ?>

          <script language='javascript' type='text/javascript'>
              function slctryole(cual,donde)
              {
                if(cual.selectedIndex != 0)
                {
                  donde.length=0
                  cual = eval(cual.value)
                  for(m=0;m<cual.length;m++)
                  {
                    var nuevaOpcion = new Option(cual[m].texto);
                    donde.options[m] = nuevaOpcion;
                    if(cual[m].valor != null)
                    {
                      donde.options[m].value = cual[m].valor
                    }
                    else
                    {
                      donde.options[m].value = cual[m].texto
                    }
                  }
                }
              }
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