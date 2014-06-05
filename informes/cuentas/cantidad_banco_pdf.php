<?php
require_once("../../class/class.php");
require_once("../../class/Informes.php");

$obj1 = new Informes();
$cantidadBanco = $obj1->cantidadPorBanco();

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
    $this->Cell(30,30,'* Informe de Cantidad de Cuentas por Banco',0,0,'L');
    $this->Ln(20);
    // Tabla, encabezados de tablas y  color
    $this->Cell(10);
    $this->SetFillColor(215,215,215);
    $this->SetFont('Times','B',10);
    $this->Cell(100,10,'Nombre',1,0,'C',1);
    $this->Cell(20,10,'Cantidad',1,0,'C',1);
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

for ($i=0; $i < sizeof($cantidadBanco); $i++)
{
  

    $pdf->Cell(10);
    $pdf->SetFont('Times','',10);
    $pdf->SetFillColor(256,256,256);
    $pdf->Cell(100,10, $cantidadBanco[$i]["nombre"], 1, 0, 'L', 1);
    $pdf->Cell(20,10, $cantidadBanco[$i]["cantidad"], 1, 0, 'C', 1);
    $pdf->ln(10);       
}
        
$pdf->Output();

 
?>

