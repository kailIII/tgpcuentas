<?php
//SHOW A DATABASE ON A PDF FILE
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE
require_once("../../class/class.php");

require('../../fpdf/fpdf.php');


//Select the Products you want to show in your PDF file
$result=mysql_query("SELECT saf, COUNT(cta) cantidad FROM cuentas GROUP BY saf ORDER BY cuentas.saf  ASC",$link);
$number_of_products = mysql_numrows($result);

//Initialize the 3 columns and the total
$column_code = "";
$column_name = "";
$column_price = "";
$total = 0;

//For each row, add the field to the corresponding column
while($row = mysql_fetch_array($result))
{
	$saf = $row["saf"];
	$cantidad = $row["cantidad"];
	

	$column_code = $column_code.$saf."\n";
	$column_name = $column_name.$cantidad."\n";

}
mysql_close();


//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();

//Fields cantidad position
$Y_Fields_Name_position = 20;
//Table position, under Fields cantidad
$Y_Table_Position = 26;

//First create each Field cantidad
//Gray color filling each Field cantidad box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field cantidad
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(45);
$pdf->Cell(20,6,'saf',1,0,'L',1);
$pdf->SetX(65);
$pdf->Cell(100,6,'cantidad',1,0,'L',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(20,6,$column_code,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->MultiCell(100,6,$column_name,1);


//Create lines (boxes) for each ROW (Product)
//If you don't use the following saf, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_products)
{
	$pdf->SetX(45);
	$pdf->MultiCell(120,6,'',1);
	$i = $i +1;
}

$pdf->Output();
?>
