<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\saleController;

	if(isset($_POST['modulo_venta'])){

		$insVenta = new saleController();

		/*--------- Buscar producto por codigo ---------*/
		if($_POST['modulo_venta']=="buscar_codigo"){
			echo $insVenta->buscarCodigoVentaControlador();
		}

		/*--------- Agregar producto a carrito ---------*/
		if($_POST['modulo_venta']=="agregar_producto"){
			echo $insVenta->agregarProductoCarritoControlador();
        }

        /*--------- Remover producto de carrito ---------*/
		if($_POST['modulo_venta']=="remover_producto"){
			echo $insVenta->removerProductoCarritoControlador();
		}

		/*--------- Actualizar producto de carrito ---------*/
		if($_POST['modulo_venta']=="actualizar_producto"){
			echo $insVenta->actualizarProductoCarritoControlador();
		}

		/*--------- Buscar cliente ---------*/
		if($_POST['modulo_venta']=="buscar_cliente"){
			echo $insVenta->buscarClienteVentaControlador();
		}

		/*--------- Agregar cliente a carrito ---------*/
		if($_POST['modulo_venta']=="agregar_cliente"){
			echo $insVenta->agregarClienteVentaControlador();
		}

		/*--------- Remover cliente de carrito ---------*/
		if($_POST['modulo_venta']=="remover_cliente"){
			echo $insVenta->removerClienteVentaControlador();
		}

		/*--------- Registrar venta ---------*/
		if($_POST['modulo_venta']=="registrar_venta"){
			echo $insVenta->registrarVentaControlador();
		}

		/*--------- Eliminar venta ---------*/
		if($_POST['modulo_venta']=="eliminar_venta"){
			echo $insVenta->eliminarVentaControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}