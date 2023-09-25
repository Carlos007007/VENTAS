<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\cashierController;

	if(isset($_POST['modulo_caja'])){

		$insCaja = new cashierController();

		if($_POST['modulo_caja']=="registrar"){
			echo $insCaja->registrarCajaControlador();
		}

		if($_POST['modulo_caja']=="eliminar"){
			echo $insCaja->eliminarCajaControlador();
		}

		if($_POST['modulo_caja']=="actualizar"){
			echo $insCaja->actualizarCajaControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}