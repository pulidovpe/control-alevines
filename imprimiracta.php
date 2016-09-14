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

$id = $_GET['acta'];

$ahora= time();
$fecha = date("Y",$ahora)."-";
$fecha .= date("m",$ahora)."-";
$fecha .= date("d",$ahora);

$sql0="UPDATE acta SET fecha_entreg='$fecha' WHERE id_acta=".$id;
$res0=mysql_query($sql0,$conecta);

$sql1="SELECT * FROM factura, productor, acta WHERE factura.ced_prod = productor.cedula AND factura.id_fact= acta.id_fact AND acta.id_acta=".$id;
$Resultado=mysql_query($sql1, $conecta);
$cant =  mysql_num_rows($Resultado);
if($cant<1) { 
?>
  <SCRIPT LANGUAGE="Javascript" TYPE="text/javascript">
    alert("No existen registros archivados!");
    //window.close();
    window.history.back();
  </SCRIPT>
<?php
} else {
  $MostrarFila = mysql_fetch_array($Resultado);
  $aFecha = explode("-",$MostrarFila['fecha_entreg']);
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
  header( 'Content-Type: text/html;charset=utf-8' );  
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
  $pdf->write(0,"ACTA DE ENTREGA");
  $pdf->Ln(15);
  // Numero de factura y fecha
  $texto3 = utf8_decode("Número de Acta: 0");
  $iAnchoTabular = 125;   
  $pdf->Ln();
   $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell (0,5,$texto3.$MostrarFila['id_acta']."/".$anio,20,0,"L");
  $pdf->Ln();
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"Factura: 0".$MostrarFila['id_fact']."/".$anio,20,0,"L");
  $pdf->Ln();
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"Fecha: ".$fecha,20,0,"L");
  $iAnchoTabular = 10; 
  $pdf->Ln(12);
  $pdf->SetFont("Arial","B",12);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"Quien suscribe la presente Acta, hace constar que recibe conforme a los");
  $pdf->Ln();
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,"renglones contenidos en la Factura de Venta Anexa.");
  $pdf->Ln();




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
  $pdf->SetFont('Arial','B',10); 
  $pdf->Ln(10);
  $pdf->Cell(10);  
  $pdf->write(0,"Firma del Productor:");
  $pdf->Ln(15);
  
  } 
{
  $pdf->SetFont('Arial','B',10); 
  $pdf->Ln(10);
  $pdf->Cell(10);  
  $pdf->write(0,"VERIFICADO POR");
   $pdf->Ln(15);
  $pdf->SetFont('Arial','',9);  
  $pdf->Cell(45);  
  $pdf->Cell(0,2," ______________________                  ________________________",0,0,"L");
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',9);  
  $pdf->Cell(45);  
  $pdf->Cell(0,2,"      Ing. Luis A. Gonzalez                        Tecn. Sup. Daniel Alvarado",0,0,"L");
  $pdf->Ln();
  $texto2 = utf8_decode("     Director General FEPSF                           Presidente FEPSF");
  $pdf->Cell(45);
  $pdf->Cell(0,5,$texto2,0,0,"L");
  $pdf->Ln(15);
  $pdf->SetFont('Arial','B',10);  
  $pdf->Cell(10);  
  $pdf->SetFont("Arial","B",10);
  $pdf->Cell(0,5,"OBSERVACIONES__________________________________________________________",0,0,"L");
  $pdf->Ln();
  $pdf->Cell(10);
  $pdf->Cell(0,5,"NOTA: SE ENTREGA 2 % ADICIONAL A LA VENTA______________________________",0,0,"L");
  $pdf->Ln(25);
  $pdf->SetFont('Arial','',10); 
  $texto2 = utf8_decode("Fundación Estación Piscícola San Fernando, a 4 Km.del puente Maria nieves, Biruaca Edo. Apure");
  $pdf->Cell(20);
  $pdf->Cell(0,5,$texto2,0,0,"L");
  $pdf->Ln(5);
  $texto2 = utf8_decode("Telf. 0247-3415796/Telefax 0247-3421975 e-mail:epsanfdo@gmail.com");
  $pdf->Cell(40);
  $pdf->Cell(0,5,$texto2,0,0,"L");
  $pdf->Ln();
 
  $pdf->Output();
  
}

?>
