<?php 
	
	//define("BASE_URL", "http://localhost/tienda_virtual/");
	const BASE_URL = "http://localhost/interblinds";
	// const BASE_URL = "https://ordersinterblinds.com";


	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//Datos de conexión a Base de Datos
	const DB_HOST = "127.0.0.1:3306";
	const DB_NAME = "u516440945_interblinds";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "$";
	const CURRENCY = "DLLS";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "Interblind Shutters San Diego";
	// Datos ficticios
	const EMAIL_REMITENTE = "sales@interblindshutters.com";
	const NOMBRE_EMPESA = "Interblind Shutters";
	const WEB_EMPRESA = "www.interblindshutters.com";

	const DESCRIPCION = "Feel elegance & think in innovation";
	const SHAREDHASH = "TiendaVirtual";

	//Datos Empresa
	const DIRECCION = "San Diego CA.";
	const TELEMPRESA = "+(502)78787845";
	const WHATSAPP = "+50278787845";
	const EMAIL_EMPRESA = "sales@interblindshutters.com";
	
	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";
	const CAT_FOOTER = "1,2,3,4,5";

	//Módulos
	const MCLIENTES = 3;
	const MPEDIDOS = 5;
	const MSUSCRIPTORES = 7;

	//Roles
	const RADMINISTRADOR = 1;
	const RCLIENTES = 7;


	


 ?>