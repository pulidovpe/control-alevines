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

$id = $_GET['fact'];
if(empty($id)) { 
?>
	<SCRIPT LANGUAGE="Javascript" TYPE="text/javascript">
		alert("Factura inexistente!");
		//window.close();
		window.history.back();
	</SCRIPT>
<?php
}
$sql0="SELECT precio FROM almacen";
$Resultado0=mysql_query($sql0, $conecta);
$MostrarFila0 = mysql_fetch_array($Resultado0);
$p_alev1 = $MostrarFila0['precio'];
$MostrarFila0 = mysql_fetch_array($Resultado0);
$p_alev2 = $MostrarFila0['precio'];
$MostrarFila0 = mysql_fetch_array($Resultado0);
$p_juv  = $MostrarFila0['precio'];
$MostrarFila0 = mysql_fetch_array($Resultado0);
$p_emp  = $MostrarFila0['precio'];

//DUDA. DEBO MOSTRAR EL PRECIO DEL TRANSPORTE ELEGIDO O SOLO EL MONTO LISTO???

$sql1="SELECT * FROM factura, productor WHERE factura.ced_prod = productor.cedula AND factura.id_fact=".$id;
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
	$pdf->write(0,"FACTURA DE VENTA");
	$pdf->Ln(12);							 //MODIFIQUE AQUI reste 3
	// Numero de factura y fecha
	$texto3 = utf8_decode("Factura N°: 0");
	$iAnchoTabular = 125; 	
 	$pdf->Ln();
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(3,7,$texto3.$MostrarFila['id_fact']."/".$anio,20,0,"L");
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
  $pdf->Cell(0,5,utf8_decode("Dirección: ".$MostrarFila['direccion']),0,0,"L");
  $pdf->Ln(-1);
  $iAnchoTabular = 110;
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,utf8_decode("Teléfono: ".$MostrarFila['telefono']),0,0,"L");
  $pdf->Ln();
  $iAnchoTabular = 10;
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,utf8_decode("Municipio: ".$MostrarFila['municipios']),0,0,"L");
  $pdf->Ln(-1);
  $iAnchoTabular = 110;
  $pdf->SetFont("Arial","B",11);
  $pdf->Cell($iAnchoTabular);
  $pdf->Cell(0,5,utf8_decode("Estado: ".$MostrarFila['estados']),0,0,"L");
  // Que compro
  $alevines1 = $MostrarFila['compra1'];
  $alevines2 = $MostrarFila['compra2'];
  $juveniles = $MostrarFila['compra3'];
  $empaques  = $MostrarFila['compra4'];
  $palevines1= $MostrarFila['precio1'];
  $palevines2= $MostrarFila['precio2'];
  $pjuveniles= $MostrarFila['precio3'];
  $pempaques = $MostrarFila['precio4'];
  $trans     = $MostrarFila['transporte'];
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
	
	if($alevines1>0)  {
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
		$pdf->Cell($iAnchoTabular);
		$pdf->Cell(70,6,"Alevines de Cachama Negra 1",1,0,'L');
		$pdf->Cell(30,6,$alevines1,1,0,'L');
		$pdf->Cell(30,6,$p_alev1,1,0,'L');
		$pdf->Cell(30,6,$palevines1,1,0,'L');		
	}
	if($alevines2>0)  {
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
		$pdf->Cell($iAnchoTabular);
		$pdf->Cell(70,6,"Alevines de Cachama Negra 2",1,0,'L');
		$pdf->Cell(30,6,$alevines2,1,0,'L');
		$pdf->Cell(30,6,$p_alev2,1,0,'L');
		$pdf->Cell(30,6,$palevines2,1,0,'L');		
	}
	if($juveniles>0)  {
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
		$pdf->Cell($iAnchoTabular);
		$pdf->Cell(70,6,"Juveniles de Cachama Negra",1,0,'L');
		$pdf->Cell(30,6,$juveniles,1,0,'L');
		$pdf->Cell(30,6,$p_juv,1,0,'L');
		$pdf->Cell(30,6,$pjuveniles,1,0,'L');    
	}
	if($empaques>0)  {
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
		$pdf->Cell($iAnchoTabular);
		$pdf->Cell(70,6,"Empaques",1,0,'L');
		$pdf->Cell(30,6,$empaques,1,0,'L');
		$pdf->Cell(30,6,$p_emp,1,0,'L');
		$pdf->Cell(30,6,$pempaques,1,0,'L');    
	}
	if($trans>0)  {
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
		$pdf->Cell($iAnchoTabular);
		$pdf->Cell(70,6,utf8_decode("Transporte de la Institución"),1,0,'L');
		$pdf->Cell(30,6,' ',1,0,'L');  //DUDA. QUE COLOCAR AQUI???
		$pdf->Cell(30,6,' ',1,0,'L'); //DUDA. QUE COLOCAR AQUI???
		$pdf->Cell(30,6,$trans,1,0,'L');  //DUDA. COLOCO SOLO EL MONTO TOTAL?? SIN EL CAMPO TEXTO???  
	}
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell($iAnchoTabular);
	$pdf->Cell(130,6,"Total: ",1,0,'L');
	$pdf->Cell(30,6,$total,1,0,'L');    
	//$pdf->Ln();

	$iAnchoTabular = 10;
	$pdf->Ln(13);
	$texto1 = utf8_decode("Del Banco del Tesoro a nombre de la Fundación Estación Piscícola ''San Fernando''");
	$sql2="SELECT forma_pago,num_cheqdep,fecha,monto FROM depositos WHERE factura =".$id;
	$Resultado2=mysql_query($sql2, $conecta);
	while($MostrarFila2 = mysql_fetch_array($Resultado2)) {
		if($MostrarFila2['forma_pago']=='Deposito') {	  	
		  	$pdf->SetFont("Arial","B",11);
		  	$pdf->Cell($iAnchoTabular);
		  	$pdf->Cell(0,5,utf8_decode("-DEPÓSITO REALIZADO EN LA CUENTA CORRIENTE: 0163-0228-72-2283002826"),0,0,"L");
	  		$pdf->Ln();
	  		$pdf->SetFont("Arial","B",11);
		  	$pdf->Cell($iAnchoTabular);
		  	$pdf->Cell(0,5,$texto1,0,0,"L");
	  		$pdf->Ln();
	  		$pdf->SetFont("Arial","B",11);
		  	$pdf->Cell($iAnchoTabular);
		  	$pdf->Cell(0,5,utf8_decode("SEGÚN DEPÓSITO NÚMERO: ".$MostrarFila2['num_cheqdep']." DE FECHA: ".$MostrarFila2['fecha']." POR Bs: ".$MostrarFila2['monto']),0,0,"L");
	  		$pdf->Ln();
	  	}
	  	if($MostrarFila2['forma_pago']=='Cheque') {	  	
		  	$pdf->SetFont("Arial","B",11);
		  	$pdf->Cell($iAnchoTabular);
		  	$pdf->Cell(0,5,utf8_decode("-PAGO CON CHEQUE EN LA OFICINA DE COBROS PARA SER DEPOSITADO EN: "),0,0,"L");
	  		$pdf->Ln();
	  		$pdf->SetFont("Arial","B",11);
		  	$pdf->Cell($iAnchoTabular);
		  	$pdf->Cell(0,5,$texto1,0,0,"L");
	  		$pdf->Ln();
	  		$pdf->SetFont("Arial","B",11);
		  	$pdf->Cell($iAnchoTabular);
		  	$pdf->Cell(0,5,utf8_decode("NÚMERO DE CHEQUE: ".$MostrarFila2['num_cheqdep']." DE FECHA: ".$MostrarFila2['fecha']." POR Bs: ".$MostrarFila2['monto']),0,0,"L");
	  		$pdf->Ln();
	  	}
	  	if($MostrarFila2['forma_pago']=='Efectivo') {	  	
		  	$pdf->SetFont("Arial","B",11);
		  	$pdf->Cell($iAnchoTabular);
		  	$pdf->Cell(0,5,utf8_decode("-PAGO HECHO EN EFECTIVO EN LA OFICINA DE COBROS DE LA ESTACIÓN POR Bs: ".$MostrarFila2['monto']),0,0,"L");
	  		$pdf->Ln();
	  	}
	}	

	$pdf->SetFont('Arial','B',11); 
	$pdf->Ln(12);							 //MODIFIQUE AQUI reste 3
	$pdf->Cell(70);  
	$pdf->write(0,"AUTORIZADO POR");
	$pdf->Ln(20);
	$pdf->SetFont('Arial','',9); 	
	$pdf->Cell(72);  
	$pdf->Cell(0,5,"Tecn. Sup. Daniel Alvarado",0,0,"L");
	$pdf->Ln();
	$texto2 = utf8_decode("Presidente de la Fundación Estación Piscícola ''San Fernando''");
	$pdf->Cell(45);
	$pdf->Cell(0,5,$texto2,0,0,"L");
	$pdf->Ln();
	$pdf->SetFont('Arial','B',10);
	$pdf->Ln(18);							 //MODIFIQUE AQUI reste 3 	
	$pdf->Cell(10);	
	$pdf->SetFont("Arial","B",11);
	$pdf->Cell(0,5,"OBSERVACIONES__________________________________________________________",0,0,"L");
  $pdf->Ln();
  $pdf->Cell(10);
 	$pdf->Cell(0,5,"__________________________________________________________________________",0,0,"L");
  $pdf->Ln();
  $pdf->Cell(10);
  $pdf->Cell(0,5,"__________________________________________________________________________",0,0,"L");
  $pdf->Ln();
  $pdf->SetFont('Arial','',10); 
  $texto2 = utf8_decode("Fundación Estacion Piscicola San Fernando, a 4 Km.del puente Maria nieves, Biruaca Edo. Apure");
  $pdf->Cell(13);
  $pdf->Cell(0,5,$texto2,0,0,"L");
  $pdf->Ln(5);
  $texto2 = utf8_decode("Telf. 0247-3415796/Telefax 0247-3421975 e-mail:epsanfdo@gmail.com");
  $pdf->Cell(33);
  $pdf->Cell(0,5,$texto2,0,0,"L");
  $pdf->Ln();

	$pdf->Output();
}
?>