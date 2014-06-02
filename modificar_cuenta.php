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
    
    $obj4 = new Cuentas();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == 1 ) {
        
        $obj6 = new Cuentas();
        $id_cta = $obj6->idCta($_POST["saf"]);
        $saf = $id_cta[0]['servicio'];

        $obj7 = new Cuentas();
        $id_banco = $obj7->idBanco($_POST["banco"]);
        $banco = $id_banco[0]['nombre'];
        
        $obj4->editarCuenta_2($_POST["id"], $saf, $_POST["sector"], $_POST["denominacion"], $banco, $_POST["tipo"], $_POST["nro_cta"], $_POST["acto_adm"], $_POST["fecha_acto"], $_POST["observacion"]);
        
        $obj8 = new Resoluciones();
        $obj8->guardarResolucionModificacion($_POST["id"], $_POST["nro_cta"], $_FILES["foto"]);
        exit;
    }

     if (!empty($_GET["id"])) 
         {
             $id = $_GET["id"];
             $obj5 = new Cuentas();
             $row = $obj5->idCuentaEdit_2($id);
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
       <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Completar Datos de la Cuenta</h3>
    </div>  

    <div class="panel-body">

            
            <form action="modificar_cuenta.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tipo de Cuenta</label>
                  <div class="col-sm-5">
                      <select class="form-control" name="tipo" required title="Seleccione un Tipo de Cuenta">
                        <option value="<?php echo $row[0]['fdopropio']; ?>"><?php echo $row[0]['fdopropio']; ?></option>
                        <option value="OPERATIVA">OPERATIVA</option>
                        <option value="CTA. UNICA">CTA. UNICA</option>
                      </select>              
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nro. Cuenta</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="nro_cta" value="<?php echo $row[0]['cta']; ?>" required title="Ingrese el Nro. de Cuenta">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Acto Administrativo</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="acto_adm" value="<?php echo $row[0]['actoadm']; ?>" title="Ingrese el Acto Administrativo">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha Acto</label>
                  <div class="col-sm-3">
                    <div class="input-append date" id="dp3" data-date="" data-date-format="yyyy/mm/dd">
                      <div class="input-group">
                        <input class="form-control" type="text" value="<?php echo $row[0]['fecha']; ?>" name="fecha_acto" required placeholder="aaaa/mm/dd" title="Ingrese la Fecha">
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
                        <input type="text" class="form-control" name="observacion"  value="<?php echo $row[0]['obs']; ?>">
                  </div>
                </div>
            
                 <div class="form-group">
                        <label class="col-sm-2 control-label">SAF</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="saf" onchange="slctryole(this,this.form.sector)" required title="Debe Seleccionar un SAF">

                                  <?php
                                      $cta1 = $row[0]["nombre"];
                                      $cta2 = $row[0]["cod_ser"];
                                      $cta3 = $row[0]["servicio"];
                                      
                                      for($i=0;$i<sizeof($saf);$i++){
                                          
                                          ?>
                                     
                                      
                                      <option title="<?php echo $saf[$i]["nombre"]; ?>" value="<?php echo $saf[$i]["cod_ser"]; ?>" 
                                      <?php if ($saf[$i]["cod_ser"]==$cta2)
                                      {
                                      echo 'selected';
                                      }
                                      echo '>'.$saf[$i]["servicio"];
                                      }
                                  ?>
                             </option>

                            </select>
                        </div>
                    </div>

                 <div class="form-group">
                        <label class="col-sm-2 control-label">Sector</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="sector" id="sector" required title="Debe Seleccionar un Sector">
                              <?php
                              
                                    $cta5 = $row[0]["idsector"];
                                    
                                    for($i=0;$i<sizeof($sector);$i++){
                                        
                                        ?>
                                   
                                    
                                    <option value="<?php echo $sector[$i]["id"]; ?>" 
                                    <?php if ($sector[$i]["id"]==$cta5)
                                    {
                                    echo 'selected';
                                    }
                                    echo '>'.$sector[$i]["sector"];
                                    }
                                ?>                            
                            </select>

                            </select>
                        </div>
                      </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Denominación</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="denominacion" value="<?php echo $row[0]['denominacion']; ?>" required title="Ingrese una Denominac&oacute;n">
                  </div>
                </div>

                <div class="form-group">
                        <label class="col-sm-2 control-label">Banco</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="banco">
                            <?php
                                $cta4 = $row[0]["id"];
                                
                                for($i=0;$i<sizeof($banco);$i++){
                                    ?>
                                
                                <option value="<?php echo $banco[$i]["nombre"]; ?>" 
                                <?php if ($banco[$i]["id"]==$cta4)
                                {
                                echo 'selected';
                                }
                                echo '>'.$banco[$i]["nombre"];
                                }
                                ?>

                            </select>              
                        </div>
                      </div>

              
              <hr>

                 <div class="form-group">
                   <label class="col-sm-2 control-label">Resolución de Modificacion</label>
                   <div class="col-sm-5">
                     <input type="file" class="form-control" name="foto" required title="Seleccione la Resolucion Escaneada">
                   </div>
                 </div> 

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                    <button type="button" class="btn btn-primary" onclick="location='edit_cuentas.php'">Cancelar</button>
                        <input type="hidden" name="Guardar" value="1" />
                        <input type="hidden" name="id" value="<?php echo $row[0]['idcta'];?>">
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