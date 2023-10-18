<?php

	$code=(isset($_GET['code'])) ? $_GET['code'] : 0;

	/*---------- Incluyendo configuraciones ----------*/
    require_once "../../config/app.php";
    require_once "../../autoload.php";

	/*---------- Instancia al controlador venta ----------*/
	use app\controllers\saleController;
	$ins_venta = new saleController();

	$datos_venta=$ins_venta->seleccionarDatos("Normal","venta INNER JOIN cliente ON venta.cliente_id=cliente.cliente_id INNER JOIN usuario ON venta.usuario_id=usuario.usuario_id INNER JOIN caja ON venta.caja_id=caja.caja_id WHERE (venta_codigo='$code')","*",0);

	if($datos_venta->rowCount()==1){
        
		/*---------- Datos de la venta ----------*/
		$datos_venta=$datos_venta->fetch();

		/*---------- Seleccion de datos de la empresa ----------*/
		$datos_empresa=$ins_venta->seleccionarDatos("Normal","empresa LIMIT 1","*",0);
		$datos_empresa=$datos_empresa->fetch();


		require "./code128.php";

		$pdf = new PDF_Code128('P','mm',array(80,258));
		$pdf->SetMargins(4,10,4);
        $pdf->AddPage();
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper($datos_empresa['empresa_nombre'])),0,'C',false);
        $pdf->SetFont('Arial','',9);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",$datos_empresa['empresa_direccion']),0,'C',false);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: ".$datos_empresa['empresa_telefono']),0,'C',false);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Email: ".$datos_empresa['empresa_email']),0,'C',false);

        $pdf->Ln(1);
        $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
        $pdf->Ln(5);

        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".date("d/m/Y", strtotime($datos_venta['venta_fecha']))." ".$datos_venta['venta_hora']),0,'C',false);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Caja Nro: ".$datos_venta['caja_numero']),0,'C',false);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cajero: ".$datos_venta['usuario_nombre']." ".$datos_venta['usuario_apellido']),0,'C',false);
        $pdf->SetFont('Arial','B',10);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Ticket Nro: ".$datos_venta['venta_id'])),0,'C',false);
        $pdf->SetFont('Arial','',9);

        $pdf->Ln(1);
        $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
        $pdf->Ln(5);
    
        if($datos_venta['cliente_id']==1){
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cliente: N/A"),0,'C',false);
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Documento: N/A"),0,'C',false);
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: N/A"),0,'C',false);
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Dirección: N/A"),0,'C',false);
        }else{
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cliente: ".$datos_venta['cliente_nombre']." ".$datos_venta['cliente_apellido']),0,'C',false);
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Documento: ".$datos_venta['cliente_tipo_documento']." ".$datos_venta['cliente_numero_documento']),0,'C',false);
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: ".$datos_venta['cliente_telefono']),0,'C',false);
            $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Dirección: ".$datos_venta['cliente_provincia'].", ".$datos_venta['cliente_ciudad'].", ".$datos_venta['cliente_direccion']),0,'C',false);
        }

        $pdf->Ln(1);
        $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
        $pdf->Ln(3);

        $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1","Cant."),0,0,'C');
        $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","Precio"),0,0,'C');
        $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","Total"),0,0,'C');

        $pdf->Ln(3);
        $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
        $pdf->Ln(3);

        /*----------  Seleccionando detalles de la venta  ----------*/
		$venta_detalle=$ins_venta->seleccionarDatos("Normal","venta_detalle WHERE venta_codigo='".$datos_venta['venta_codigo']."'","*",0);
        $venta_detalle=$venta_detalle->fetchAll();
        
        foreach($venta_detalle as $detalle){
            $pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1",$detalle['venta_detalle_descripcion']),0,'C',false);
            $pdf->Cell(18,4,iconv("UTF-8", "ISO-8859-1",$detalle['venta_detalle_cantidad']),0,0,'C');
            $pdf->Cell(22,4,iconv("UTF-8", "ISO-8859-1",MONEDA_SIMBOLO.number_format($detalle['venta_detalle_precio_venta'],MONEDA_DECIMALES,MONEDA_SEPARADOR_DECIMAL,MONEDA_SEPARADOR_MILLAR)),0,0,'C');
            $pdf->Cell(32,4,iconv("UTF-8", "ISO-8859-1",MONEDA_SIMBOLO.number_format($detalle['venta_detalle_total'],MONEDA_DECIMALES,MONEDA_SEPARADOR_DECIMAL,MONEDA_SEPARADOR_MILLAR)),0,0,'C');
            $pdf->Ln(4);
            $pdf->Ln(3);
        }

        $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

        $pdf->Ln(5);

        $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
        $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),0,0,'C');
        $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",MONEDA_SIMBOLO.number_format($datos_venta['venta_total'],MONEDA_DECIMALES,MONEDA_SEPARADOR_DECIMAL,MONEDA_SEPARADOR_MILLAR).' '.MONEDA_NOMBRE),0,0,'C');

        $pdf->Ln(5);
        
        $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
        $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL PAGADO"),0,0,'C');
        $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",MONEDA_SIMBOLO.number_format($datos_venta['venta_pagado'],MONEDA_DECIMALES,MONEDA_SEPARADOR_DECIMAL,MONEDA_SEPARADOR_MILLAR).' '.MONEDA_NOMBRE),0,0,'C');

        $pdf->Ln(5);

        $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
        $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","CAMBIO"),0,0,'C');
        $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",MONEDA_SIMBOLO.number_format($datos_venta['venta_cambio'],MONEDA_DECIMALES,MONEDA_SEPARADOR_DECIMAL,MONEDA_SEPARADOR_MILLAR).' '.MONEDA_NOMBRE),0,0,'C');

        $pdf->Ln(10);

        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su compra"),'',0,'C');

        $pdf->Ln(9);

        $pdf->Code128(5,$pdf->GetY(),$datos_venta['venta_codigo'],70,20);
        $pdf->SetXY(0,$pdf->GetY()+21);
        $pdf->SetFont('Arial','',14);
        $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",$datos_venta['venta_codigo']),0,'C',false);
        
		$pdf->Output("I","Ticket_Nro".$datos_venta['venta_id'].".pdf",true);

	}else{
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo APP_NAME; ?></title>
	<?php include '../views/inc/head.php'; ?>
</head>
<body>
    <div class="main-container">
        <section class="hero-body">
            <div class="hero-body">
                <p class="has-text-centered has-text-white pb-3">
                    <i class="fas fa-rocket fa-5x"></i>
                </p>
                <p class="title has-text-white">¡Ocurrió un error!</p>
                <p class="subtitle has-text-white">No hemos encontrado datos de la venta</p>
            </div>
        </section>
    </div>
	<?php include '../views/inc/script.php'; ?>
</body>
</html>
<?php } ?>