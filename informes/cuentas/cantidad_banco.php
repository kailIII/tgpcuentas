<?php
require_once("../../class/class.php");
require_once("../../class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
	
        require_once("../../class/Informes.php");

$obj1 = new Informes();
$cantidadBanco = $obj1->cantidadPorBanco();
        

             
?>

<!DOCTYPE html>
<html>   
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="../../css/estilos.css" />
        <link rel="stylesheet" type="text/css" href="../../css/style.css" />
        <script type="text/javascript" src="../../css/script.js"></script>
        <title>Sistema de Padron de Cuentas Oficiales</title>
        <link rel="shortcut icon" href="../../favicon.ico"/>
    </head>
<body>
<div id="contenido">
    <div id="encabezado">
        <table width="100%" border="0">
            <tr>
                <td width="50%">
                    <a href="../../home.php" style="text-decoration: none; color: #000"><h2>Sistema de Padron de Cuentas Oficiales</h2></a>
                </td>
                <td width="55%" align="right">
                    <?php
                                        $var = new Conectar();
                                        $fecha = $var->fecha();

                                        echo $fecha;
                                        ?>           
                </td>
            </tr>         
        </table>  
    </div><!--CIERRE DE ENCABEZADO-->
    
    <div id="menu_principal">
        <!-- Inicio del Menu -->
        <ul class="menu" id="menu">
            <li><a href="#" class="menulink">Cuentas Oficiales</a>
                <ul>
                    <li><a href="../../apertura_cta.php">Apertura de Cuentas</a></li>
                    <li><a href="../../alta_cuentas.php">Alta de Cuentas</a></li>
                    <li><a href="../../alta_sectores.php">Alta de Sectores</a></li>                
                    <li><a href="../../edit_cuentas.php">Modificacion de Cuentas</a></li>
                    <li><a href="../../bajas_cuentas.php">Baja de Cuentas</a></li>
                    <li><a href="../../baja_sectores.php">Baja de Sectores</a></li>
                </ul>
            </li>           

            <li><a href="#"  class="menulink">Firmantes</a>
                <ul>
                    <li><a href="../../alta_firmantes.php">Agregar Firmantes</a></li>
                    <li><a href="../../buscar_firmantes.php">Buscar Firmantes</a></li>
                </ul>
            </li>
            </li>      
            <li><a href="#" class="menulink">Informes</a>
                <ul>
                    <li class="sub"><a href="#">General</a>
                        <ul>
                            <li><a href="#">General</a></li>
                            <li><a href="#">Activos de Cuentas</a></li>
                            <li><a href="#">Historicos de Cuentas</a></li>
                        </ul>
                    </li>
                    <li class="sub"><a href="#">Cuentas</a>
                        <ul>
                            <li><a href="../../informes/cuentas/cantidad_saf.php">Cantidad por SAF</a></li>
                            <li><a href="../../informes/cuentas/cantidad_banco.php">Cantidad por Banco</a></li>
                        </ul>
                    </li> 
                    <li class="sub"><a href="#">Bancos</a>
                        <ul>
                            <li><a href="../../informes/bancos/cuentas_simple.php">Por Cuentas: Simple</a></li> 
                            <li><a href="#">Por Cuentas: Detallado</a></li>
                            <li><a href="#">Por Bancos y SAF</a></li>
                        </ul>
                    </li> 
                    <li class="sub"><a href="#">SAF</a>
                        <ul>
                            <li><a href="#">Por SAF</a></li>
                            <li><a href="#">General por Cuentas</a></li>
                            <li><a href="#">Autorizados por SAF</a></li>
                        </ul>
                    </li> 
                </ul>
            </li>    




            <li>
                <a href="#" class="menulink">Administracion</a>
                <ul>
                    <li> <a href="../../alta_usuarios.php">Usuarios</a></li>
                    <li><a href="indexarchivo.php?sec=configuracion/permiso_consulta&apli=admin&per=C"> Permisos </a></li>
                </ul>
            </li>
            <li style="margin-left: 328px; margin-top: 5px">
                <div id="user"><i>Usuario:&nbsp;</i></div>
            </li>
    
            <li >
                <a class="menulink1" href="#"><img src="../../img/icon/user_9x12.png">&nbsp;<i><?php echo $_SESSION["session_user"]; ?></i></a>
            <ul>
                <li>
                    <a href="../../salir.php"><i>Cerrar Sesi&oacute;n</i></a> 
                </li>
            </ul>
            
        </li>
        </ul>
       </div>
    <div id="principal">
        <div id="columna_central">





<div id="registrogrilla" style="margin: 0 auto;">
        <fieldset>
          <div>
                <div>
                    <h3>Informe de Cantidad de Cuentas por Banco</h3>
                </div>
                <div style="text-align: right">
                    <a target="_blank" style="text-decoration:none" href="../../informes/cuentas/cantidad_banco_pdf.php"><img src="../../img/icon/document_alt_stroke_12x16.png">&nbsp;&nbsp;Imprimir Informe</a>
                </div>
          </div>
     
            <br/> 
          
                <div class="datagrid">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php
                      
                                for($i=0;$i<sizeof($cantidadBanco);$i++){
                                   
                                ?>
                                <tr>
                                    <td><?php echo $cantidadBanco[$i]["nombre"]; ?></td>
                                    <td><?php echo $cantidadBanco[$i]["cantidad"]; ?></td>
                                </tr>
                                <?php
                                  }
                                ?>
                                
                               </tbody>
                        </table>
                    </div>
                
            
        </fieldset>
</div>

<?php include("../../partes/footer.php"); ?>


<!--FINALIZA LA SESION-->
<?php
}else
{
	echo "<script type='text/javascript'>
	alert('Ud debe Iniciar Sesi\u00f3n para acceder a este contenido.');
	window.location='../../index.php';
	</script>";
}
?>


