<?php
ob_start();
require "fpdf.php";
require_once('connection.php');

class PDF extends FPDF
{
    
}
$pdf = new PDF('L','mm','Letter');

$pdf->SetMargins(20,18);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0x00,0x00,0x00);
$pdf->SetFont("Arial","b",7);
$pdf->Cell(0,5,'Hired Employees',0,1,'C');
$pdf->Ln();

$sql = "SELECT * FROM employee WHERE hired = 'y'";
$result = mysql_query($sql);


if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}


$pdf->Cell(20,10,"Nombre",1,0,'L');
    $pdf->Cell(15,10,"License #",1,0,'L');
    $pdf->Cell(20,10,"SSN",1,0,'L');
    $pdf->Cell(60,10,"Address",1,0,'L');
    $pdf->Cell(30,10,"Phone Number",1,0,'L');
    $pdf->Cell(40,10,"Email",1,0,'L');
    $pdf->Cell(20,10,"Union Trade",1,0,'L');
    $pdf->Cell(15,10,"Hiring Date",1,0,'L');
    $pdf->Cell(30,10,"Crew",1,0,'L');
    $pdf->Ln();
    $pdf->SetFont('helvetica');
while($row=mysql_fetch_array($result,MYSQL_ASSOC))
{

    $pdf->Cell(20,10,$row['name'],1,0,'L');
    $pdf->Cell(15,10,$row['license_number'],1,0,'L');
    $pdf->Cell(20,10,$row['social_security_number'],1,0,'L');
    $pdf->Cell(60,10,$row['address'],1,0,'L');
    $pdf->Cell(30,10,$row['phone_number'],1,0,'L');
    $pdf->Cell(40,10,$row['email'],1,0,'L');
    $pdf->Cell(20,10,$row['union_trade'],1,0,'L');
    $pdf->Cell(15,10,$row['hiring_date'],1,0,'L');
    $pdf->Cell(30,10,$row['crew'],1,0,'L');
    $pdf->Ln();

}
ob_end_clean();
$pdf->Output();
//$pdf->Output("HiredEmployees","D");
ob_end_flush();

