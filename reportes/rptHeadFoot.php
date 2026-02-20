<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('./tutorial/logo.png',10,10,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(90,10,'Sistema de Informacion Integral',1,5,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C'); //cuenta el numero de paginas
}
}
//Programa Principal y es donde se manda utilizar
// Instanciation of inherited class
$pdf = new PDF();//Definimos la instancia
$pdf->AliasNbPages();//Cuenta cuantas paginas tiene mi archivo
$pdf->AddPage(); //pagina en blanco
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)// la condicion de 40 , cuenta cuantos datos tienene que haber dentro del el archivo
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>