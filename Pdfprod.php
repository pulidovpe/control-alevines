<?php if(@session_start() == false){session_destroy();session_start();}
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
}

include_once("conexion.php");
$conecta = conectarse();
// Para que MySQL reconozca la ñ y demas caracteres latinos
mysql_query("SET NAMES 'utf8'");
//header("Content-Type: text/html;charset=utf-8");

$query = "SELECT * FROM productor ORDER BY cedula ASC";
$Resultado = mysql_query($query, $conecta) or die(mysql_error());
$MostrarFilas = mysql_num_rows($Resultado);
$ixx = 0;
while($datatmp = mysql_fetch_assoc($Resultado)) { 
  $ixx = $ixx+1;
  $data[] = array_merge($datatmp, array('num'=>$ixx));
}
?>
<?php
else {
  $MostrarFila = mysql_fetch_array($Resultado);
  $aFecha = explode("-",$MostrarFila['fecha']);
  $dia = $aFecha[2]; // devuelve el día del mes
  $mes = $aFecha[1]; // devuelve el número del mes
  $anio = $aFecha[0]; // devuelve el año
  $fecha = $dia."/".$mes."/".$anio;

  // De aqui en adelante, se genera el pdf.  //
  ob_end_clean();
    
  define('FPDF_FONTPATH','font/');
  require('fpdf.php');
  class PDF extends FPDF
  {
  }
  $pdf=new PDF('P','mm','Letter');
  $pdf->Open();
  $pdf->AliasNbPages();
  $pdf->SetTopMargin(15);
  $pdf->SetLineWidth(0);
  $pdf->AddPage();
  $pdf->SetLeftMargin(15);
  // imagen izquierda
  $pdf->Image('img/logo1.jpg',20,15,-200);

  // Membrete
  $membrete1 = utf8_decode("REPÚBLICA BOLIVARIANA DE VENEZUELA");
  $membrete2 = utf8_decode("GOBERNACIÓN DEL ESTADO APURE");
  $membrete3 = utf8_decode("FUNDACIÓN ESTACIÓN PISCÍCOLA");
  $pdf->SetFont('Arial','B',10); //<-- Tipo de letra arial, Bold, tamaño 20
  $pdf->Ln(2);
  $pdf->Cell(55);
  $pdf->write(5,$membrete1 );  // <-- Cadena a escribir
  $pdf->Ln();
  $pdf->Cell(60);
  $pdf->write(5,$membrete2 );  // <-- Cadena a escribir
  $pdf->Ln();
  $pdf->Cell(62);
  $pdf->write(5,$membrete3 );  // <-- Cadena a escribir
  $pdf->Ln();
  $pdf->Cell(77);
  $pdf->write(5,"''SAN FERNANDO''");  // <-- Cadena a escribir
  $pdf->Ln();
  $pdf->Cell(81);
  $pdf->write(5,"G-20002598-0");  // <-- Cadena a escribir
  
  // imagen derecha
  $pdf->Image('img/logo2.jpg',160,15,-200);
  
  $pdf->SetFont('Arial','B',13); //<-- Tipo de letra arial, Bold, tamaño 20
  $pdf->Ln(13);
  $pdf->Cell(69);  
  $pdf->write(0,"FACTURA PROFROMA");
  $pdf->Ln(15);
  // Numero de factura proforma y fecha
  $iAnchoTabular = 125;   
  $pdf->Ln();
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(3,7,"Proforma: 0".$MostrarFila['id_fact']."/".$anio,20,0,"L");
  $pdf->Ln();
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(3,7,"Fecha: ".$fecha,20,0,"L");
  // Datos del productor/comprador
  $iAnchoTabular = 10; 
  $pdf->Ln(12);
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"Nombre del Comprador: ".$MostrarFila['nombres']." ".$MostrarFila['apellidos']);
  $pdf->Ln();
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"C.I/RIF.: ".$MostrarFila['ced_prod'],0,0,"L");
  $pdf->Ln();
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $dir = utf8_decode("Dirección: ");
  $pdf->Cell(0,5,$dir.$MostrarFila['direccion'],0,0,"L");
  $pdf->Ln(-1);
  $iAnchoTabular = 110;
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $tlf = utf8_decode("Teléfono: ");
  $pdf->Cell(0,5,$tlf.$MostrarFila['telefono'],0,0,"L");
  $pdf->Ln();
  $iAnchoTabular = 10;
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"Municipio: ".$MostrarFila['municipios'],0,0,"L");
  $pdf->Ln(-1);
  $iAnchoTabular = 110;
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"Estado: ".$MostrarFila['estados'],0,0,"L");
  // Que compro
  $alevines  = $MostrarFila['compra1'];
  $juveniles = $MostrarFila['compra2'];
  $empaques  = $MostrarFila['compra3'];
  $palevines = $MostrarFila['precio1'];
  $pjuveniles= $MostrarFila['precio2'];
  $pempaques = $MostrarFila['precio3'];
  $total     = $MostrarFila['total'];
  // Titulos
  $iAnchoTabular = 10;
  $pdf->Ln(13);
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell($iAnchoTabular);   
  $pdf->Cell(70,6,"Concepto",1,0,'C');
  $pdf->Cell(30,6,"Cantidad",1,0,'C'); 
  $pdf->Cell(30,6,"Precio Unitario",1,0,'C');
  $pdf->Cell(30,6,"Total",1,0,'C'); 
  
  if($alevines>0)  {
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
    $pdf->Cell($iAnchoTabular);
    $pdf->Cell(70,6,"Alevines de Cachama negra",1,0,'L');
    $pdf->Cell(30,6,$alevines,1,0,'L');
    $pdf->Cell(30,6,$p_alev,1,0,'L');
    $pdf->Cell(30,6,$palevines,1,0,'L');    
    $pdf->Ln();
  }
  if($juveniles>0)  {
    $pdf->SetFont('Arial','',9);
    $pdf->Cell($iAnchoTabular);
    $pdf->Cell(70,6,"Juveniles de Cachama negra",1,0,'L');
    $pdf->Cell(30,6,$juveniles,1,0,'L');
    $pdf->Cell(30,6,$p_juv,1,0,'L');
    $pdf->Cell(30,6,$pjuveniles,1,0,'L');    
    $pdf->Ln();
  }
  if($empaques>0)  {
    $pdf->SetFont('Arial','',9);
    $pdf->Cell($iAnchoTabular);
    $pdf->Cell(70,6,"Empaques",1,0,'L');
    $pdf->Cell(30,6,$empaques,1,0,'L');
    $pdf->Cell(30,6,$p_emp,1,0,'L');
    $pdf->Cell(30,6,$pempaques,1,0,'L');    
    $pdf->Ln();
  }
  $pdf->SetFont('Arial','',9);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(130,6,"Total: ",1,0,'L');
  $pdf->Cell(30,6,$total,1,0,'L');    
  $pdf->Ln();

  $pdf->SetFont('Arial','B',11); 
  $pdf->Ln(15);
  $pdf->Cell(70);  
  $pdf->write(0,"AUTORIZADO POR");
  $pdf->Ln(20);
  $pdf->SetFont('Arial','',9);  
  $pdf->Cell(72);  
  $pdf->Cell(0,5,"Sup. Daniel Alvarado",0,0,"L");
  $pdf->Ln();
  $texto2 = utf8_decode("Presidente de la Fundación Estación Piscícola ''San Fernando''");
  $pdf->Cell(45);
  $pdf->Cell(0,5,$texto2,0,0,"L");
  $pdf->Ln(21);
  $pdf->SetFont('Arial','B',10);  
  $pdf->Cell(10);  
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell(0,5,"OBSERVACIONES: Esta Proforma es Gratuita / Precio sujeto a cambio sin previo aviso",0,0,"L");
  $pdf->Ln();
  $pdf->Cell(10);
  $pdf->Cell(0,5,"Depositar en efectivo o cheques del mismo banco, en la Cta. Cte. 0163-0228-72-2283002826",0,0,"L");
  $pdf->Ln();
  $pdf->Cell(10);
  $pdf->Cell(0,5,"__________________________________________________________________________",0,0,"L");
  $pdf->Ln();

  $pdf->Output();
}

?>