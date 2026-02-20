<?php
require('fpdf.php');
require_once("../Modelo/clientes.php"); //importa el modelo de la clase clasific para mandar a ejecutar el metodo de consulta

class PDF extends FPDF // clase llamada pdf
{
    // Page header
function Header()
{
    // Logo
    $this->Image('../Imagenes/elite.png',5,2,30);
    // Arial bold 15
    $this->SetFont('Arial','B'.'I',15);
    // Move to the right
    $this->Cell(40);
    // Title
    $this->Cell(100,10,'Informe de Clientes',1,5,'C');
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
            $alto=50;
            // Colors, line width and bold font
            $this->SetFillColor(0,0,128); // Cambio de color de la cabezera de la tabla
            $this->SetTextColor(255);
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(.5);
            $this->SetFont('','B');
            // Header , define los anchos de las columnas
            $w = array(25, 30, 20, 30 , 15 ,20 , 20 , 30);
            for($i=0;$i<count($header);$i++) // crea el encabezado de la tabla , osea el header
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Obtiene los datos de la base de datos -------------
    
                $obj = new cte(); //instancia
                $tuplas = $obj->Consultar(); //regresa mi instancia con el metodo de consultar
                $fill = false;
                foreach ($tuplas as $row){
                    $idcli = $row['idcte'];
                    $nomcli = $row['nombre_cte'];
                    $domcli = $row['dom_cte'];
                    $cpcli = $row['cp_cte'];
                    $refecli = $row['Referencia'];
                    $Anualidad = $row['Anualidad'];
                    $fechaini = $row['fecha_ini'];
                    $fechafin = $row['fecha_fin'];
                    $corr = $row['correo_cte'];
                    
                    //echo "<tr id='$idc'><td>$nomc</td><td>$descc</td><td>
                      //  <i class='material-icons edit' data-idc='$idc' data-nomc='$nomc' data-descc='$descc'>create</i>
                       // <i class='material-icons delete' data-idc='$idc'>delete_forever</i></td></tr>";
                    
                       $this->Cell($w[0],10,$nomcli,'LR',0,'L',$fill); // el cell en el 0 es el ancho y el 6 es la aultura y el row es el dato que va a obtener 
                       $this->Cell($w[1],10,$domcli,'LR',0,'L',$fill);
                       $this->Cell($w[2],10,$cpcli,'LR',0,'C',$fill);
                       $this->Cell($w[3],10,$refecli,'LR',0,'L',$fill);
                       $this->Cell($w[4],10,$Anualidad,'LR',0,'C',$fill);
                       $this->Cell($w[5],10, date('d/m/y', strtotime($fechaini)), 'LR', 0, 'C', $fill); //se usa nada mas para numeros el number format
                       $this->Cell($w[6],10, date('d/m/y', strtotime($fechafin)), 'LR', 0, 'C', $fill); //se usa nada mas para numeros el number format
                       $this->Cell($w[7],10,$corr,'LR',0,'L',$fill);
                       
                       //$this->Image("$foto", 170 , $alto , -350);
                       $this->Ln();
                       $fill = !$fill;
                       //$alto += 20;
                }
            

            //---------------------------------------
            /*$fill = false;
            foreach($data as $row)
            {
                $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill); // el cell en el 0 es el ancho y el 6 es la aultura y el row es el dato que va a obtener 
                $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
                $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
                $this->Ln();
                $fill = !$fill;
            }
            */
            // Closing line
            $this->Cell(array_sum($w),0,'','T');
        }
        }
        
        // fin de la clase
        require_once("../Modelo/Usuario.php");
        $idopc = "opcCliente";
        $obj = new Usuario();
        $res = $obj->ValidaOpcion($idopc);
        if ($res == "")
        {    
             header("location:../Acceso/");
        }

        //Programa principal en java seria el main-------------------------------------------------

$pdf = new PDF();
$pdf->AliasNbPages();//Cuenta cuantas paginas tiene mi archivo
// Column headings
$header = array('Nombre Cliente' , 'Domicilio' , 'C.P' , 'Referencia' , 'Anualidad' , 'Fecha de inicio' , 'Fecha de fin' , 'Correo Electronico');
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