<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\productController;

	if(isset($_POST['modulo_producto'])){

		$insProducto = new productController();

		if($_POST['modulo_producto']=="registrar"){
			echo $insProducto->registrarProductoControlador();
		}

		if($_POST['modulo_producto']=="eliminar"){
			echo $insProducto->eliminarProductoControlador();
		}

		if($_POST['modulo_producto']=="actualizar"){
			echo $insProducto->actualizarProductoControlador();
		}

		if($_POST['modulo_producto']=="eliminarFoto"){
			echo $insProducto->eliminarFotoProductoControlador();
		}

		if($_POST['modulo_producto']=="actualizarFoto"){
			echo $insProducto->actualizarFotoProductoControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}