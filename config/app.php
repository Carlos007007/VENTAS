<?php

	const APP_URL="__APPURL__";
	const APP_NAME="VENTAS";
	const APP_SESSION_NAME="POS";
	// const PAIS="60"; // el salvador
	const PAIS="__PAIS_CODE__"; // el salvador

	/*----------  Tipos de documentos  ----------*/
	if( !strcmp(PAIS, 60) ) { // el salvador
	 	define('DOCUMENTOS_USUARIOS', ["NIT","DUI","Cedula","Licencia","Pasaporte","Otro"]);
	}
	else if( !strcmp(PAIS, 47) ) { // colombia
	 	define('DOCUMENTOS_USUARIOS', ["NIT","Cedula","Extranjeria","Pasaporte","Otro"]);
	}
	else if( !strcmp(PAIS, 174) ) { // panama
	 	define('DOCUMENTOS_USUARIOS', ["RUC","Cedula","Extranjeria","Pasaporte","Otro"]);
	}
	else if( !strcmp(PAIS, 188) ) { // rep dom
	 	define('DOCUMENTOS_USUARIOS', ["RNC","Cedula","Extranjeria","Pasaporte","Otro"]);
	}
	else { // mexico
		define('DOCUMENTOS_USUARIOS', ["RFC", "INE","CURP","Pasaporte","Otro"]);
	}


	/*----------  Tipos de unidades de productos  ----------*/
	const PRODUCTO_UNIDAD=["Pieza", "Unidad","Libra","Kilogramo","Caja","Paquete","Lata","Galon","Botella","Tira","Sobre","Bolsa","Saco","Tarjeta","Otro"];

	/*----------  Configuración de moneda  ----------*/
	const MONEDA_SIMBOLO="$";

	if( !strcmp(PAIS, 60) ) // el salvador
		define('MONEDA_NOMBRE', "USD");
	else if( !strcmp(PAIS, 47) ) // colombia
		define('MONEDA_NOMBRE', "COP");
	else if( !strcmp(PAIS, 174) ) // panama
		define('MONEDA_NOMBRE', "PAB");
	else if( !strcmp(PAIS, 188) ) // rep dom
		define('MONEDA_NOMBRE', "DOP");
	else // mexico
		define('MONEDA_NOMBRE', "MXN");

	const MONEDA_DECIMALES="2";
	const MONEDA_SEPARADOR_MILLAR=",";
	const MONEDA_SEPARADOR_DECIMAL=".";


	/*----------  Marcador de campos obligatorios (Font Awesome) ----------*/
	const CAMPO_OBLIGATORIO='&nbsp; <i class="fas fa-edit"></i> &nbsp;';

	/*----------  Zona horaria  ----------*/
	if( !strcmp(PAIS, 60) ) // el salvador
		date_default_timezone_set("America/El_Salvador");
	else if( !strcmp(PAIS, 47) ) // colombia
		date_default_timezone_set("America/Bogota");
	else if( !strcmp(PAIS, 174) ) // panama
		date_default_timezone_set("America/Panama");
	else if( !strcmp(PAIS, 188) ) // rep dom
		date_default_timezone_set("America/Santo_Domingo");
	else
		date_default_timezone_set("America/Matamoros");

	/*
		Configuración de zona horaria de tu país, para más información visita
		http://php.net/manual/es/function.date-default-timezone-set.php
		http://php.net/manual/es/timezones.php
	*/