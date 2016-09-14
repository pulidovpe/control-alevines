<?php if(@session_start() == false){session_destroy();session_start();}
if(!isset($_SESSION['usuario']) && ($_SESSION['tipo'] != 1)) { 
  header("Location: cerrarsesion.php");
  exit;
}  
include_once("conexion.php");
$conecta = conectarse();
$ced=$_GET['ced'];
$est=$_GET['est'];
$mun=$_GET['mun'];
$sql='';
if(empty($ced) && empty($est) && empty($mun)) {
  echo "CAMPOS NO DEBEN IR VACIOS";
} else {
  if (!empty($ced)) { // Si escribio cedula
    if ($est<>'Seleccione') { // Si eligio estado
      if (!empty($mun)) { // Si se eligio municipio
        $sql = "SELECT * FROM productor WHERE cedula LIKE '%$ced%' AND estados='$est' AND municipios='$mun' LIMIT 8";
      } else { // Sino se eligio municipio
        $sql = "SELECT * FROM productor WHERE cedula LIKE '%$ced%' AND estados='$est' LIMIT 8";
      }
    } else { // Sino se eligio estado
      $sql = "SELECT * FROM productor WHERE cedula LIKE '%$ced%' LIMIT 8";
    }
  } else { // Sino escribio cedula
    if ($est<>'Seleccione') { // Si eligio estado
      if (empty($mun)) {  // Sino se eligio municipio
        $sql = "SELECT * FROM productor WHERE estados='$est' LIMIT 8";
      } else { // Si se eligio municipio
        $sql = "SELECT * FROM productor WHERE estados='$est' AND municipios='$mun' LIMIT 8";
      }
    } 
  }
}
if($sql != '') {
  mysql_query("SET NAMES 'utf8'");
  $Resultado=mysql_query($sql, $conecta);
  $cant =  mysql_num_rows($Resultado);
   
  if($cant<1) { 
  ?>
    <SCRIPT LANGUAGE="Javascript" TYPE="text/javascript">
      alert("No existen registros archivados!");
      window.close();
      //window.history.back();
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
    $pdf->write(0,"LISTADO DE PRODUCTORES");
    $pdf->Ln(12);              //MODIFIQUE AQUI reste 3
    // Titulos
    $iAnchoTabular = 7;
    $pdf->Ln(13);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell($iAnchoTabular);  
    $pdf->Cell(20,6,"C.I/RIF.: ",1,0,'C');
    $pdf->Cell(35,6,"Nombres",1,0,'C'); 
    $pdf->Cell(35,6,"Apellidos",1,0,'C');
    $pdf->Cell(35,6,"Estado",1,0,'C'); 
    $pdf->Cell(40,6,"Municipio",1,0,'C'); 
    while($MostrarFila = mysql_fetch_array($Resultado)) { 
      $pdf->SetFont('Arial','',8);
      $pdf->Ln();
      $pdf->Cell($iAnchoTabular);
      $pdf->Cell(20,6,$MostrarFila['cedula'],1,0,'L');
      $pdf->Cell(35,6,$MostrarFila['nombres'],1,0,'L');
      $pdf->Cell(35,6,$MostrarFila['apellidos'],1,0,'L');
      $pdf->Cell(35,6,utf8_decode(strtoupper($MostrarFila['estados'])),1,0,'L');
      $pdf->Cell(40,6,utf8_decode(strtoupper($MostrarFila['municipios'])),1,0,'L');
      //$descrip = ucwords(strtolower($MostrarFila['descripcion']));
      //$pdf->Cell(165,6,substr($descrip, 0, 118)."..",1,0,'L');
    }

   
    $pdf->Output();
    
  }
} else {
  ?>
    <SCRIPT LANGUAGE="Javascript" TYPE="text/javascript">
      alert("No existen registros archivados!");
      window.close();
      //window.history.back();
    </SCRIPT>
  <?php
}

?>
