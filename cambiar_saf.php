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
        
        $obj6 = new Cuentas();
        $id_cta = $obj6->idCta($_POST["saf"]);
        $saf = $id_cta[0]['servicio'];

        $obj4->cambiarSaf($_POST["id"], $saf, $_POST["sector"]);
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
    <!-- Bootstrap theme -->
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
            <li>CUENTAS OFICIALES</li>
            <li><a href="edit_cuentas.php?cta=<?php echo $row[0]["cta"]; ?>">MODIFICACIÓN DE CUENTAS</a></li>
            <li class="active">MODIFICACIÓN DE SAF Y SECTOR EN LA CUENTA</li>
          </ul>
    </div>  
      
      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

        <div class="panel panel-primary">   
          
          <div class="panel-heading">
             <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Modificaci&oacute;n de SAF y Sector en la Cuenta</h3>
          </div>  
          
          <div class="panel-body">

              <form action="#" class="form-horizontal">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Nro. Cuenta</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" readonly value="<?php echo $row[0]['cta']; ?>" name="nro_cta">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Acto Administrativo</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" readonly value="<?php echo $row[0]['actoadm']; ?>" name="acto_adm">
                  </div>
                </div>

                 <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha Acto</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" readonly value="<?php echo $row[0]['fecha']; ?>" name="fecha_acto">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Observaciones</label>
                  <div class="col-sm-5">
                            <input class="form-control" type="text" readonly name="observacion"  value="<?php echo $row[0]['observaciones']; ?>">
                  </div>
                </div>

              </form> 

                  <form class="form-horizontal" role="form" action="cambiar_saf.php" method="POST">
                      <div class="form-group">
                        <label class="col-sm-2 control-label">SAF</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="saf" onchange="slctryole(this,this.form.sector)" autofocus required title="Debe Seleccionar un SAF">

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
                        <div class="col-sm-9">
                          <input type="text" name="denominacion" class="form-control" readonly value="<?php echo $row[0]["denominacion"]; ?>" name="denominacion">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Banco</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="banco" readonly>
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

                     <br>

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