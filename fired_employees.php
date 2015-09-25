<?php
ob_start();
require "fpdf.php";
require_once('connection.php');

class PDF extends FPDF
{
    
}
$pdf = new PDF('L','mm','Letter');

$pdf->SetMargins(8,18);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0x00,0x00,0x00);
$pdf->SetFont("Arial","b",7);
$pdf->Cell(0,5,'Hired Employees',0,1,'C');
$pdf->Ln();

$sql = "SELECT * FROM employee WHERE hired = 'n'";
$result = mysql_query($sql);


if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}


    $pdf->Cell(20,20,"Nombre",1,0,'L');
    $pdf->Cell(50,20,"Address",1,0,'L');
    $pdf->Cell(20,20,"Phone Number",1,0,'L');
    $pdf->Cell(30,20,"Email",1,0,'L');
    $pdf->Cell(20,20,"Union Trade",1,0,'L');
    $pdf->Cell(15,20,"Hiring Date",1,0,'L');
    $pdf->Cell(15,20,"Term. Date",1,0,'L');
    $pdf->Cell(95,20,"Reason",1,0,'L');

    $pdf->Ln();
    $pdf->SetFont('helvetica');
while($row=mysql_fetch_array($result,MYSQL_ASSOC))
{

    $pdf->Cell(20,20,$row['name'],1,0,'C');
    $pdf->Cell(50,20,$row['address'],1,0,'C');
    $pdf->Cell(20,20,$row['phone_number'],1,0,'C');
    $pdf->Cell(30,20,$row['email'],1,0,'C');
    $pdf->Cell(20,20,$row['union_trade'],1,0,'C');
    $pdf->Cell(15,20,$row['hiring_date'],1,0,'C');
    $pdf->Cell(15,20,$row['termination_date'],1,0,'C');
    $pdf->MultiCell(95,10,$row['reason_termination'],1,0,'C');
    $pdf->Ln();

}
ob_end_clean();
$pdf->Output();
//$pdf->Output("HiredEmployees","D");
ob_end_flush();

