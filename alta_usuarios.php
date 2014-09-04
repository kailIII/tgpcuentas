<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
    require_once 'class/administradores.php';
    require_once 'class/permisos.php';
          
    $obj3 = new Permisos();
    $per = $obj3->listaPermisos();
        
    $obj2 = new Administradores();
    if (isset($_POST["Guardar"]) and $_POST["Guardar"] == "Si") {
        
        if($_POST["pass1"] != $_POST["pass2"]){

            $msj = 1;     
            
        }else {
           
        $obj2->Alta_Usuario($_POST["ape_nom"], $_POST["user"], $_POST["permiso"], $_POST["pass1"]);
        exit;  

        }         
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
            <li>USUARIOS</li>
            <li class="active">ALTA DE NUEVOS USUARIOS</li>
          </ul>
      </div>
      
      <?php include ("partes/menu.php"); ?>

        <div class="col-md-10">

        <div class="panel panel-primary">   
          
          <div class="panel-heading">
             <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Alta de Usuarios</h3>
          </div>  
          
          <div class="panel-body">
          
                  <form class="form-horizontal" role="form" action="alta_usuarios.php" method="POST">

                        <?php
                        if (empty($msj)){
                        ?> 
                      
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Apellido y Nombre</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" autofocus placeholder="Apellido y Nombre" name="ape_nom" required title="Ingrese el Apellido y nombre">
                        </div>
                      </div>
                      
                      <?php 

                        if (empty($_GET["error"])) {

                       ?>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Usuario</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" placeholder="Nombre de Usuario" name="user" required title="Ingrese el Nombre Usuario">
                        </div>
                      </div>

                      <?php }

                        else{

                       ?>

                      <div class="form-group has-warning has-feedback">
                        <label class="col-sm-3 control-label" for="inputWarning2">Usuario</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" placeholder="Nombre de Usuario ya existente" name="user" id="inputWarning2">
                          <span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
                        </div>
                      </div>

                      <?php } ?>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Permisos</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="permiso" required title="Debe Seleccionar un Permiso para el Usuario">
                              <option value="">Sin Especificar</option>


                                  <?php 
                                     for ($i = 0; $i < sizeof($per); $i++) {
                                    ?>
                                  <option value="<?php echo $per[$i]["id"];?>"> <?php echo $per[$i]["perfil"];?></option>

                                      <?php
                                        }
                                      ?>
                            </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Contraseña</label>
                        <div class="col-sm-5">
                          <input type="password" class="form-control" placeholder="Ingresar Contraseña" name="pass1" required title="Ingrese el Domicilio">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Repita Contraseña</label>
                        <div class="col-sm-5">
                          <input type="password" class="form-control" placeholder="Repita Contraseña Ingrasada" name="pass2" required title="Ingrese el Cargo">
                        </div>
                      </div>
                      
                      <?php }else{ ?>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Apellido y Nombre</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" value="<?php echo $_POST["ape_nom"]; ?>" placeholder="Apellido y Nombre" name="ape_nom" required title="Ingrese el Apellido y nombre">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Usuario</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" value="<?php echo $_POST["user"]; ?>" placeholder="Nombre de Usuario" name="user" required title="Ingrese el Nombre Usuario">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="col-sm-3 control-label">Permisos</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="permiso" required title="Debe Seleccionar un Permiso para el Usuario">
                              <option value="">Sin Especificar</option>


                                  <?php 
                                     for ($i = 0; $i < sizeof($per); $i++) {
                                    ?>
                                  <option value="<?php echo $per[$i]["id"];?>"> <?php echo $per[$i]["perfil"];?></option>

                                      <?php
                                        }
                                      ?>
                            </select>
                        </div>
                      </div>


                      <div class="form-group has-error has-feedback">
                        <label class="col-sm-3 control-label" for="inputError2">Contraseña</label>
                          <div class="col-sm-5">
                            <input type="password" class="form-control" name="pass1" required="Ingrese contraseña" placeholder="Ingrese nuevamente la contraseña" id="inputError2">
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                          </div>
                      </div>

                      <div class="form-group has-error has-feedback">
                        <label class="col-sm-3 control-label" for="inputError2">Repita Contraseña</label>
                          <div class="col-sm-5">
                            <input type="password" class="form-control" name="pass2" required="Repita contraseña" placeholder="Repita Contraseña Ingrasada" id="inputError2">
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                          </div>
                      </div>

                      
                      <?php } ?>

                     <br>

                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-primary">Aceptar</button>
                          <button type="button" class="btn btn-default" onclick="location='home.php'">Cancelar</button>
                           <input type="hidden" name="Guardar" value="Si" />
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