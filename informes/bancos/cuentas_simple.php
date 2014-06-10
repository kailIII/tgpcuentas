<?php
require_once("../../class/class.php");
require_once("../../class/class_usuarios.php");

if ($_SESSION["session_user"] and $_SESSION["session_perfil"]) {
    $obj = new Usuarios();
    $perfil = $obj->get_permisos_por_id();
	
        require_once("../../class/bancos.php");
        require_once("../../class/Informes.php");

$obj1 = new Bancos();
$banco = $obj1->Ordenar_Banco();

if (isset($_POST["Buscar"]) and $_POST["Buscar"] == 1) {
    
    $obj2 = new Informes();
    $listBancosCuentas = $obj2->bancosCuentasSimple($_POST["banco"]);
}
        

             
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
                            <li><a href="infogeneral">General</a></li>
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
                    <li><a href="#">Listado de Usuarios</a></li>
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
                    <h3>Informe por Banco - Cuentas Ctes. Oficiales - Datos Cuentas</h3>
                </div>
                <?php 
                    if (!empty($listBancosCuentas)){
                ?>
                <div style="text-align: right">
                    <a target="_blank" style="text-decoration:none" href="../../informes/bancos/cuenta_simple_pdf.php?banco=<?php echo $listBancosCuentas[0]["banco"]; ?>"><img src="../../img/icon/document_alt_stroke_12x16.png">&nbsp;&nbsp;Imprimir Informe</a>
                </div>
                <?php
                    }
                ?>
          </div>
     
            <br/> 
          
                <div>
                    <form action="cuentas_simple.php" method="POST">
                        <table>
                                    <tr>        
                                        <th align="right">Banco&nbsp;&nbsp;</th>
                                        <td>
                                        <select name="banco" required title="Debe Seleccionar un Banco">
                                        <option value="">Sin Especificar</option>
                                        
                                        
                                        <?php
                                        for($i=0;$i<sizeof($banco);$i++){
                                        ?>
                                        <option value="<?php echo $banco[$i]["nombre"]; ?>"> <?php echo $banco[$i]["nombre"]; ?></option>
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        </select>
                                        
                                        </td>
                                        <td>
                                            <input type="submit" value="&nbsp;Buscar&nbsp;"/>
                                            <input type="hidden" name="Buscar" value="1"/>
                                        </td>
                                    </tr>
                        </table>
                    </form>
                </div>

                <br>
                <br>
                
                <?php
                 if (!empty($listBancosCuentas)) {
                ?>

                <b>Banco Seleccionado: </b><?php echo $listBancosCuentas[0]["banco"]; ?>
                <p>&nbsp;</p>

                 <div class="datagrid">
                      <table>
                            <thead>
                                <tr>
                                    <th>Cuenta</th>
                                    <th>Denominacion</th>
                                    <th>SAF</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php        
                                    
                                    for($i=0;$i<sizeof($listBancosCuentas);$i++){
                                       
                                ?>
                                    <tr>
                                        <td><?php echo $listBancosCuentas[$i]["posicion"]; ?></td>
                                        <td><?php echo $listBancosCuentas[$i]["cta"]; ?></td>
                                        <td><?php echo $listBancosCuentas[$i]["denominacion"]; ?></td>
                                        <td><?php echo $listBancosCuentas[$i]["saf"]; ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>                               
                               </tbody>
                        </table>
                    </div>
                
                <?php
                      }
                ?>
            
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


