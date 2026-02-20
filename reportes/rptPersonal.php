<?php
require('fpdf.php');
require_once("../Modelo/Personal.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta

class PDF extends FPDF // clase llamada pdf
{
    // Page header
function Header()
{
    // Logo
    $this->Image('../Imagenes/Icons_files/roque.jpeg',5,2,30);
    // Arial bold 15
    $this->SetFont('Arial','B'.'I',15);
    // Move to the right
    $this->Cell(40);
    // Title
    $this->Cell(100,10,'Informe de Personal',1,5,'C');
    //Fecha
    $this->Cell(150,-10,'Fecha:'. date('d/m/Y'),10,20,'R');
    // Line break
    $this->Ln(30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',7);
    // Page number
    $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C'); //cuenta el numero de paginas
}


        // Colored table
       function FancyTable($header)
{
    $w = array(35, 30 , 30 , 35 , 30);
    $totalWidth = array_sum($w);
    $x = ($this->GetPageWidth() - $totalWidth) / 2;

    // Encabezado
    $this->SetFillColor(0,0,128);
    $this->SetTextColor(255);
    $this->SetDrawColor(0,0,0);
    $this->SetLineWidth(.5);
    $this->SetFont('','B');
    $this->SetX($x);
    for($i=0;$i<count($header);$i++)
     $this->Cell($w[$i],4,$header[$i],1,0,'C',true);
    $this->Ln();

    // Restaurar colores y fuente
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');

    // Datos
    $obj = new personal();
    $tuplas = $obj->Consultar();
    $fill = false;
    foreach ($tuplas as $row){
        $this->SetX($x); // Centrar cada fila
        $this->Cell($w[0],10,$row['nombrePer'],'LR',0,'C',$fill);
        $this->Cell($w[1],10,$row['correoPer'],'LR',0,'C',$fill);
        $this->Cell($w[2],10,$row['cargoPer'],'LR',0,'C',$fill);
        $this->Cell($w[3],10,$row['nombreDep'],'LR',0,'C',$fill);
        $this->Cell($w[4],10,$row['nombre_area'],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }

    // Línea final
    $this->SetX($x);
    $this->Cell(array_sum($w),0,'','T');
        }
    }
        
        // fin de la clase


        //Programa principal en java seria el main-------------------------------------------------

$pdf = new PDF();
$pdf->AliasNbPages();//Cuenta cuantas paginas tiene mi archivo
// Column headings
$header = array('Nombre personal' , 'Correo Electronico', 'Cargo' , 'Departamento' , 'Area');
// Data loading

$pdf->SetFont('Arial','',8);
$pdf->AddPage();// Salto de pagina
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
$pdf->FancyTable($header);
$pdf->Output();
?>