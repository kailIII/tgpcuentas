<?php
require_once("../../class/class.php");
require_once("../../class/Informes.php");

$obj1 = new Informes();
$listBancosCuentas = $obj1->bancosCuentasSimple($_GET["banco"]);

$banco = $listBancosCuentas[0]["banco"];

require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../rioja.png',100,5,8);
        $this->SetFont('Arial','',6);
        $this->Cell(80);
        $this->Cell(30,15,'TESORERIA GRAL. DE LA PCIA. DE LA RIOJA',0,0,'C');
        $this->Ln(3);
        $this->Cell(80);
        $this->Cell(30,15,'SISTEMA DE PADRON DE CUENTAS OFICIALES',0,0,'C');
        $this->Ln(3);
         // Encabezado
        $this->SetFont('Arial','B',12);
        $this->Cell(10);
        // Título
        $this->Cell(30,30,'* Informe por Banco - Cuentas Ctes. Oficiales - Datos Cuentas',0,0,'L');
        $this->Ln(20);
        // Tabla, encabezados de tablas y  color
        $this->Cell(10);
        $this->SetFillColor(215,215,215);
        $this->SetFont('Times','B',10);
        $this->Cell(25,10,'Cuenta',1,0,'C',1);
        $this->Cell(100,10,'Denominacion',1,0,'C',1);
        $this->Cell(15,10,'SAF',1,0,'C',1);
        $this->Ln(10);
        
    }

    function Encabezado()
    {
        // Tabla, encabezados de tablas y  color
        $this->Cell(10);
        $this->SetFillColor(215,215,215);
        $this->SetFont('Times','B',10);
        $this->Cell(25,10,'Cuenta',1,0,'C',1);
        $this->Cell(100,10,'Denominacion',1,0,'C',1);
        $this->Cell(15,10,'SAF',1,0,'C',1);
        $this->Ln(10);   
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
    
    $pdf->sety(36);
    $pdf->setx(20);
    $pdf->SetFont('Times','',12);
    $pdf->SetFillColor(215,215,215);
    $pdf->Cell(140,10, $listBancosCuentas[0]["banco"], 1, 0, 'C', 1);
    $pdf->ln(10);

$pdf->Encabezado();


for ($i=0; $i < sizeof($listBancosCuentas); $i++)
{
    $pdf->Cell(10);
    $pdf->SetFont('Times','',10);
    $pdf->SetFillColor(256,256,256);
    $pdf->Cell(25,10, $listBancosCuentas[$i]["cta"], 1, 0, 'C', 1);
    $pdf->Cell(100,10, $listBancosCuentas[$i]["denominacion"], 1, 0, 'L', 1);
    $pdf->Cell(15,10, $listBancosCuentas[$i]["saf"], 1, 0, 'C', 1);
    $pdf->ln(10);       
}
      
$pdf->Output();

 
?>

