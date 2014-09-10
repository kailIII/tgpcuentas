<?php
error_reporting(E_ERROR);
require_once("class/class.php");
require_once("class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
  
        require_once 'class/saf.php';

        $obj1 = new Saf();
        $list_saf = $obj1->Ordenar_Saf();
        
    
/////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////PAGINADOR///////////////////////////////////////////////////////////   
$_pagi_sql = "SELECT cuentas.id id, cta, cuentas.saf saf, cuentas.organismo sector, denominacion, banco, actoadm, DATE_FORMAT(fecha, '%d/%m/%Y') as fecha, observaciones, DATE_FORMAT(fecbaja, '%d/%m/%Y') as fecbaja, fdopropio
            FROM cuentas
            WHERE cuentas.cerrada = 1
            AND cuentas.inibaj = 0 
            AND cuentas.baja = 0
            ORDER BY cuentas.saf, cuentas.cta"; 

$_pagi_cuantos = 5;
$_pagi_nav_num_enlaces = 10;
$_pagi_nav_estilo="pag";
//$_pagi_propagar=array('sec','nom','apli','per');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_primera ="<span class='glyphicon glyphicon-step-backward'></span>";
$_pagi_nav_anterior = "<span class='glyphicon glyphicon-backward'></span>";
$_pagi_nav_ultima = "<span class='glyphicon glyphicon-step-forward'></span>";
$_pagi_nav_siguiente = "<span class='glyphicon glyphicon-forward'></span>";


include("paginator.inc.php");     
////////////////////////////////PAGINADOR/////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////


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
            <li class="active">MODIFICACIÓN DE CUENTAS</li>
          </ul>
    </div> 
    
          <?php include ("partes/menu.php"); ?>


    <div class="col-md-10">

      <div class="panel panel-primary">
        
        <div class="panel-heading">
          <h3 class="panel-title"><span class="glyphicon glyphicon-chevron-right"></span> Modificaci&oacute;n de Cuentas</h3>
        </div>
        
        <div class="panel-body">

            <div class="row">
              <div class="col-md-8 col-md-offset-2">

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
                <table class="table table-hover">
                    <thead>
                      <tr class="info">
                        <th>Cuenta</th>
                        <th>SAF</th>
                        <th>Sector</th>
                        <th>Denominaci&oacute;n</th>
                        <th>Banco</th>
                        <!-- <th>Acto Alta</th> -->
                        <th>Fecha Apertura</th>
                        <th>Observación</th>
                        <!-- <th>Acto Baja</th> -->
                        <th>Fecha Baja</th>
                        <th>Tipo Cta.</th>
                        <th>Operaciones&nbsp;</th>
                      </tr>
                </thead>

              <tbody>
                                 <?php
                                 
                                while($row = mysql_fetch_array($_pagi_result)){ 

                                    ?>
                                          <tr>
                                              <td><?php echo $row["cta"]; ?></td>
                                              <td><?php echo $row["saf"]; ?></td>
                                              <td><?php echo $row["sector"]; ?></td>
                                              <td><?php echo $row["denominacion"]; ?></td>
                                              <td><?php echo $row["banco"]; ?></td>
                                              <!-- <td><?php// echo $row["actoadm"]; ?></td> -->
                                              <td><?php echo $row["fecha"]; ?></td>
                                              <td><?php echo $row["observaciones"]; ?></td>
                                              <!-- <td><?php// echo $row["actobaja"]; ?></td> -->
                                              <td><?php echo $row["fecbaja"]; ?></td>
                                              <td><?php echo $row["fdopropio"]; ?></td>
                                              <td>
                                                  <a href="modificar_firmante.php?id=<?php echo $row["id"];?>" title="Modificar Firmante"><span class="glyphicon glyphicon-user"></span></a>
                                                  <a href="cambiar_saf.php?id=<?php echo $row["id"];?>" title="Cambiar SAF"><span class="glyphicon glyphicon-transfer"></span></a>
                                                  <a href="baja_cuenta.php?id=<?php echo $row["id"];?>" title="Baja de Cuenta"><span class="glyphicon glyphicon-trash"></span></a>
                                                  <a href="modificar_cuenta.php?id=<?php echo $row["id"];?>" title="Modificar Cuenta"><span class="glyphicon glyphicon-list"></span></a>
                                                  <a href="resoluciones.php?id=<?php echo $row["id"];?>" title="Resoluciones de Cuenta"><span class="glyphicon glyphicon-file"></span></a>
                                              </td>
                                          </tr>
                                        <?php
                           
                                  }
                                ?>
                                 <tr>
                                    <td colspan="12">
                                        <p class="text-center"><?php echo $_pagi_navegacion; //MUESTRA PAGINADOR ?></p>
                                    </td>
                                </tr>
                                <?php
                                   if($row < 0){
                                ?>     
                                <tr>
                                    <td colspan="11">
                                        <h4 style="color: red; text-align: center">No Existe Registro de Cuenta.</h4>
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