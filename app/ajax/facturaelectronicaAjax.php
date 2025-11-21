<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\facturaelectronicaController;

	if(isset($_POST['modulo_facturaelectronica'])){

		$insFacturaEl = new facturaelectronicaController();

		if($_POST['modulo_facturaelectronica']=="registrar"){
			echo $insFacturaEl->registrarFacturaElectronicaControlador();
		}

		if($_POST['modulo_facturaelectronica']=="actualizar"){
			echo $insFacturaEl->actualizarFacturaElectronicaControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}