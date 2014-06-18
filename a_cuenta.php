<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
        require_once 'class/cuentas.php';
        require_once 'class/saf.php';
        require_once 'class/firmantes.php'; 
        
    $obj3=  new Saf();
    $saf = $obj3->Ordenar_Saf();
   
    if (!empty($_GET["id"])) {

             $id = $_GET["id"];
             $obj1 = new Cuentas();
             $row = $obj1->idCuenta($id);
           } 

    if (isset($_POST["Guardar"]) AND $_POST["Guardar"]=="Si") {
            $obj2 = new Cuentas();
            $obj2->altaCuenta($_POST["id"], $_POST["tipo"], $_POST["nro_cta"], $_POST["acto_adm"], $_POST["fecha_acto"], $_POST["observacion"]);
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

        <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="home.php">INICIO</a></li>
            <li>CUENTAS OFICIALES</li>
            <li><a href="alta_cuentas.php">ALTA DE CUENTAS</a></li>
            <li class="active">RESOLUCION DE CUENTA</li>
          </ul>
      </div>
      
      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

      <div class="panel panel-primary">   
        <div class="panel-heading">
           <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Resoluci&oacute;n de Cuenta</h3>
        </div>  

        <div class="panel-body">
                <form class="form-horizontal" role="form" action="#">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">SAF</label>
                      <div class="col-sm-3">
                          <input type="text" class="form-control" readonly value="<?php echo $row[0]['saf']; ?>">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Sector</label>
                      <div class="col-sm-5">
                          <input type="text" class="form-control" readonly value="<?php echo $row[0]['sector']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Denominación</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" readonly value='<?php echo $row[0]['denominacion']; ?>' name="denominacion">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Banco</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" readonly value="<?php echo $row[0]['banco']; ?>">
                      </div>
                    </div>
                </form>

                   <hr>

                <form action="a_cuenta.php" method="POST" class="form-horizontal">
                   <div class="form-group">
                      <label class="col-sm-2 control-label">Tipo de Cuenta</label>
                      <div class="col-sm-5">
                          <select class="form-control" name="tipo" required autofocus title="Seleccione un Tipo de Cuenta">
                            <option value="">Sin Especificar</option>
                            <option value="OPERATIVA">OPERATIVA</option>
                            <option value="CTA. UNICA">CTA. UNICA</option>
                          </select>              
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Nro. Cuenta</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="" placeholder="Nro. de Cuenta" name="nro_cta" required title="Ingrese el Nro. de Cuenta">
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
                                          <strong>El Nro. de Cuenta: <?php echo $_GET['cta']; ?> Ya existe!</strong>
                                        </div>       
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-2 control-label">Acto Administrativo</label>
                                <div class="col-sm-5">
                                  <input type="text" class="form-control" value="<?php echo $_GET['aa'];?>" name="acto_adm" required title="Ingrese el Acto Administrativo">
                                </div>
                              </div>

                               <div class="form-group">
                                <label class="col-sm-2 control-label">Fecha Acto</label>
                                <div class="col-sm-3">
                                  <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy/mm/dd">
                                    <div class="input-group">
                                      <input class="form-control" type="text" value="<?php echo $_GET["fa"]; ?>" name="fecha_acto" required placeholder="aaaa/mm/dd" title="Ingrese la Fecha del Acto">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="add-on"><span class="glyphicon glyphicon-calendar"></span></span></button>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          <?php
                            }else

                            {

                          ?>    

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Acto Administrativo</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="" placeholder="Acto Administrativo" name="acto_adm" required title="Ingrese el Acto Administrativo">
                      </div>
                    </div>

                     <div class="form-group">
                      <label class="col-sm-2 control-label">Fecha Acto</label>
                      <div class="col-sm-3">
                        <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy/mm/dd">
                          <div class="input-group">
                            <input class="form-control" type="text" value="" name="fecha_acto" required placeholder="aaaa/mm/dd" title="Ingrese la Fecha del Acto">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button"><span class="add-on"><span class="glyphicon glyphicon-calendar"></span></span></button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Observaciones</label>
                      <div class="col-sm-5">
                                <textarea class="form-control" placeholder="Observaciones" type="text" name="observacion"  value=""></textarea>
                      </div>
                    </div>

                    <?php
                      }
                    ?>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                        <button type="button" class="btn btn-default" onclick="location='alta_cuentas.php'">Cancelar</button>
                        <input type="hidden" name="Guardar" value="Si">
                        <input type="hidden" name="id" value="<?php echo $row[0]["id"]; ?>">
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