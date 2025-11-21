<?php

	namespace app\controllers;
	use app\models\mainModel;

	class facturaelectronicaController extends mainModel{

		/*----------  Controlador registrar empresa  ----------*/
		public function registrarFacturaElectronicaControlador(){

			# Almacenando datos#
		    $mboxuser=$this->limpiarCadena($_POST['mbox_user']);
		    $mboxpass=$this->limpiarCadena($_POST['mbox_pass']);
		    $mboxamb=$this->limpiarCadena($_POST['mbox_ambiente']);

		    # Verificando campos obligatorios #
            if($mboxuser==""){
            	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
            }

            # Verificando integridad de los datos #
		    if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,85}",$mboxuser)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El Usuario moneyBox no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }
		    if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,85}",$mboxpass)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El Password moneyBox no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }
		    if($this->verificarDatos("[0-9]{1}",$mboxamb)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El Ambiente moneyBox no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

            $empresa_datos_reg=[
				[
					"campo_nombre"=>"mbox_user",
					"campo_marcador"=>":Usuario",
					"campo_valor"=>$mboxuser
				],
				[
					"campo_nombre"=>"mbox_pass",
					"campo_marcador"=>":Password",
					"campo_valor"=>$mboxpass
				],
				[
					"campo_nombre"=>"mbox_ambiente",
					"campo_marcador"=>":Ambiente",
					"campo_valor"=>$mboxamb
				]
			];

			$registrar_empresa=$this->guardarDatos("empresa",$empresa_datos_reg);

			if($registrar_empresa->rowCount()==1){
				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Cuenta moneyBox registrada",
					"texto"=>"Los datos de su cuenta moneyBox se registraron con exito",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar los datos de su cuenta moneyBox, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}


		/*----------  Controlador actualizar empresa  ----------*/
		public function actualizarFacturaElectronicaControlador(){

			$id=$this->limpiarCadena($_POST['empresa_id']);

			# Verificando empresa #
		    $datos=$this->ejecutarConsulta("SELECT * FROM empresa WHERE empresa_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado la empresa en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    # Almacenando datos#
		    $mboxuser=$this->limpiarCadena($_POST['mbox_user']);
		    $mboxpass=$this->limpiarCadena($_POST['mbox_pass']);
		    $mboxamb=$this->limpiarCadena($_POST['mbox_ambiente']);

		    # Verificando campos obligatorios #
            if($mboxuser==""){
            	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
            }

           # Verificando integridad de los datos #
		    if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,85}",$mboxuser)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El Usuario moneyBox no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }
		    if($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,85}",$mboxpass)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El Password moneyBox no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }
		    if($this->verificarDatos("[0-9]{1}",$mboxamb)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El Ambiente moneyBox no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

            $empresa_datos_up=[
				[
					"campo_nombre"=>"mbox_user",
					"campo_marcador"=>":Usuario",
					"campo_valor"=>$mboxuser
				],
				[
					"campo_nombre"=>"mbox_pass",
					"campo_marcador"=>":Password",
					"campo_valor"=>$mboxpass
				],
				[
					"campo_nombre"=>"mbox_ambiente",
					"campo_marcador"=>":Ambiente",
					"campo_valor"=>$mboxamb
				]
			];

			$condicion=[
				"condicion_campo"=>"empresa_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->actualizarDatos("empresa",$empresa_datos_up,$condicion)){
				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Datos moneyBox actualizados",
					"texto"=>"Los datos de su cuenta moneyBox se actualizaron correctamente",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos de su cuenta moneyBox, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}

	}