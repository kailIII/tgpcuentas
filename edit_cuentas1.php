<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
    
        require_once 'class/saf.php';
        require_once 'class/cuentas.php';

        $obj1 = new Saf();
        $list_saf = $obj1->Ordenar_Saf();

        //SCRIPT PARA VOLVER A TRAS Y MANTENER LOS DATOS
        if (!empty($_GET["cta"])) {
          
            if (empty($_GET["saf"]) AND empty($_GET["cta"])) 
           {
                if (!empty($_GET["firmante"])) 
                            {
                                 $obj4 = new Cuentas();
                                 $ctas = $obj4->rCuenta_2($_GET["firmante"]);
                            }

            }else{

                    if (!empty($_GET["saf"])) 
                    {
                        $obj2 = new Cuentas();
                        $ctas = $obj2->rCuenta($_GET["saf"], $_GET["cta"]);
                    }else{
                            if (!empty($_GET["cta"])) {
                                $obj2 = new Cuentas();
                                $ctas = $obj2->rCuenta($_GET["saf"], $_GET["cta"]);
                            }
                    }                  

                            
                 }
        }

         if (empty($_POST["saf"]) AND empty($_POST["cta"])) 
           {
                if (!empty($_POST["firmante"])) 
                            {
                                 $obj4 = new Cuentas();
                                 $ctas = $obj4->rCuenta_2($_POST["firmante"]);
                            }

            }else{

                    if (!empty($_POST["saf"])) 
                    {
                        $obj2 = new Cuentas();
                        $ctas = $obj2->rCuenta($_POST["saf"], $_POST["cta"]);
                    }else{
                            if (!empty($_POST["cta"])) {
                                $obj2 = new Cuentas();
                                $ctas = $obj2->rCuenta($_POST["saf"], $_POST["cta"]);
                            }
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
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"> body { padding-top: 70px; padding-bottom: 40px; background-color: #eee; } </style>
 </head>

  <body>

    <div class="container-fluid">

       <?php include ("partes/nav2.php"); ?>

      <div class="row"> 

    <div class="col-md-12">
          <ul class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="home.php"><span class="glyphicon glyphicon-home"></a></li>
            <li>CUENTAS OFICIALES</li>
            <li class="active">MODIFICACIÓN DE CUENTAS</li>
          </ul>
    </div> 

    <div class="col-md-12">

      <div class="panel panel-primary">
        
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span> Modificaci&oacute;n de Cuentas</h3>
        </div>
        
        <div class="panel-body">

            <div class="row">
              <div class="col-md-6 col-md-offset-3">

                <h4><p class="text-center">Buscar Cuenta por:</p></h4>
                  <center>
                    <form class="form-inline" role="form" action="edit_cuentas1.php" method="POST">
                        
                        <div class="form-group">
                                  <select class="form-control" name="saf">
                                    <option value=""><p class="text-muted">SAF</p></option>


                                            <?php
                                            for($i=0;$i<sizeof($list_saf);$i++){
                                                ?>
                                            <option title="<?php echo $list_saf[$i]["nombre"]; ?>" value="<?php echo $list_saf[$i]["servicio"]; ?>"> <?php echo $list_saf[$i]["servicio"];?></option>
                                            
                                                  <?php
                                                   }
                                                ?>   
                                   </select>
                        </div>

                          <div class="form-group">
                            <input type="text" name="cta" class="form-control" placeholder="Nro. de Cuenta">
                          </div>

                          <div class="form-group">
                            <input type="text" name="firmante" class="form-control" placeholder="DNI Firmante">
                          </div>

                          <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                   </center>
              </div>
            </div>

           

            <br>

            <?php
                    if (!empty($ctas)) {
                         if (!empty($ctas[0]["dni"]) AND !empty($ctas[0]["nombre"])) {
            ?>
            
            <div class="row">
                <div class="col-sm-4">
                    <div class="alert alert-success">
                    
                <?php

                                echo "<b>DNI: </b>".$ctas[0]["dni"]."<br>";
                                echo "<b>Apellido y Nombre: </b>".$ctas[0]["nombre"];

                ?>

                </div>
                </div>
            </div>

             <?php

                    }    
                     
                }
            ?>
                

                <table class="table table-hover">
                    <thead>
                        <tr class="info">
                            <th>Cuenta</th>
                            <th>SAF</th>
                            <th>Sector</th>
                            <th>Denominaci&oacute;n</th>
                            <th>Banco</th>
                            <th>Acto Alta</th>
                            <th>Fecha Apertura</th>
                            <th>Obs.</th>
                            <th>Acto Baja</th>
                            <th>Fecha Baja</th>
                            <th>Operaciones&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>

              <tbody>
                                 <?php
                                if(!empty($ctas))
                                {
                                for($i=0;$i<sizeof($ctas);$i++){
                                 
                                    
                                ?>
                                <tr>
                                    <td><?php echo $ctas[$i]["cta"]; ?></td>
                                    <td><?php echo $ctas[$i]["saf"]; ?></td>
                                    <td><?php echo $ctas[$i]["sector"]; ?></td>
                                    <td><?php echo $ctas[$i]["denominacion"]; ?></td>
                                    <td><?php echo $ctas[$i]["banco"]; ?></td>
                                    <td><?php echo $ctas[$i]["actoadm"]; ?></td>
                                    <td><?php echo $ctas[$i]["fecha"]; ?></td>
                                    <td><?php echo $ctas[$i]["observaciones"]; ?></td>
                                    <td><?php echo $ctas[$i]["actobaja"]; ?></td>
                                    <td><?php echo $ctas[$i]["fecbaja"]; ?></td>
                                    <td>&nbsp;
                                        <a href="modificar_firmante.php?id=<?php echo $ctas[$i]["id"];?>" title="Modificar Firmante"><span class="glyphicon glyphicon-user"></span></a>
                                        <a href="cambiar_saf.php?id=<?php echo $ctas[$i]["id"];?>" title="Cambiar SAF"><span class="glyphicon glyphicon-transfer"></span></a>
                                        <a href="baja_cuenta.php?id=<?php echo $ctas[$i]["id"];?>" title="Baja de Cuenta"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="modificar_cuenta.php?id=<?php echo $ctas[$i]["id"];?>" title="Modificar Cuenta"><span class="glyphicon glyphicon-list"></span></a>
                                        <a href="resoluciones.php?id=<?php echo $ctas[$i]["id"];?>" title="Resoluciones de Cuenta"><span class="glyphicon glyphicon-file"></span></a>
                                    </td>
                                </tr>
                                <?php
                                  }
                                }
                                ?>
                                
                                <?php
                                   if(empty($ctas)){
                                ?> 
                                <tr>
                                    <td colspan="12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-danger">
                                                <h4><p class="text-center">No existe registro de Cuenta</p></h4>
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