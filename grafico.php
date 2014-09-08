<?php 
require_once("class/class.php");
require_once("class/class_usuarios.php");

//ABRE LA SESION
if ($_SESSION["session_user"] and $_SESSION["session_name"] and $_SESSION["session_perfil"]){
	$obj=new Usuarios();
	$perfil=$obj->get_permisos_por_id(); 

require_once("class/Informes.php");
                               
                               
include ("jpgraph/src/jpgraph.php"); 
include ("jpgraph/src/jpgraph_pie.php"); 
include ("jpgraph/src/jpgraph_pie3d.php"); 


$obj1 = new Informes();
$cantidadSaf = $obj1->cantidadPorSaf();


                      
for($i=0;$i<sizeof($cantidadSaf);$i++){
   
     $cantidadSaf[$i]["saf"]; 
     $cantidadSaf[$i]["nombre"]; 
     $cantidadSaf[$i]["cantidad"];

  }

$data = array(40,60,21,33); 

$graph = new PieGraph(450,200,"auto"); 
$graph->img->SetAntiAliasing(); 
$graph->SetMarginColor('gray'); 
//$graph->SetShadow(); 

// Setup margin and titles 
$graph->title->Set("Ejemplo: Horas de Trabajo"); 

$p1 = new PiePlot3D($data); 
$p1->SetSize(0.35); 
$p1->SetCenter(0.5); 

// Setup slice labels and move them into the plot 
$p1->value->SetFont(FF_FONT1,FS_BOLD); 
$p1->value->SetColor("black"); 
$p1->SetLabelPos(0.2); 

$nombres=array("pepe","luis","miguel","alberto"); 
$p1->SetLegends($nombres); 

// Explode all slices 
$p1->ExplodeAll(); 

$graph->Add($p1); 
$graph->Stroke(); 
?>

<?php
}else
{
	echo "<script type='text/javascript'>
	alert('Ud debe Iniciar Sesi\u00f3n para acceder a este contenido.');
	window.location='index.php';
	</script>";
}		
?>