<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\clientController;

	if(isset($_POST['modulo_cliente'])){

		$insCliente = new clientController();

		if($_POST['modulo_cliente']=="registrar"){
			echo $insCliente->registrarClienteControlador();
		}

		if($_POST['modulo_cliente']=="eliminar"){
			echo $insCliente->eliminarClienteControlador();
		}

		if($_POST['modulo_cliente']=="actualizar"){
			echo $insCliente->actualizarClienteControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}