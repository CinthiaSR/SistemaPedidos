<?php 
// require_once("Models/TTipoPago.php"); 
class Pedidos extends Controllers{
	// use TTipoPago;
	public function __construct()
	{
		parent::__construct();
		session_start();
// 		session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
		getPermisos(MPEDIDOS);
	}

	public function Pedidos()
	{
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Pedidos";
		$data['page_title'] = "PEDIDOS <small>Tienda Virtual</small>";
		$data['page_name'] = "pedidos";
		$data['page_functions_js'] = "functions_roller.js";
		$this->views->getView($this,"pedidos",$data);
	}

	public function getPedidos(){
		if($_SESSION['permisosMod']['r']){
			$idpersona = "";
			if( $_SESSION['userData']['idrol'] == RCLIENTES ){
				$idpersona = $_SESSION['userData']['idpersona'];
			}
			$arrData = $this->model->selectPedidos($idpersona);
			//dep($arrData);
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';

				$arrData[$i]['transaccion'] = $arrData[$i]['referenciacobro'];
				if($arrData[$i]['idtransaccionpaypal'] != ""){
					$arrData[$i]['transaccion'] = $arrData[$i]['idtransaccionpaypal'];
				}

				$arrData[$i]['monto'] = SMONEY.formatMoney($arrData[$i]['monto']);

				
				if($_SESSION['permisosMod']['r']){
					
					$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/pedidos/orden/'.$arrData[$i]['idpedido'].'" target="_blanck" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>

						<a title="Generar PDF" href="'.base_url().'/factura/generarFactura/'.$arrData[$i]['idpedido'].'" target="_blanck" class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i> </a> ';

					if($arrData[$i]['idtipopago'] == 1){
						$btnView .= '<a title="Ver Transacción" href="'.base_url().'/pedidos/transaccion/'.$arrData[$i]['idtransaccionpaypal'].'" target="_blanck" class="btn btn-info btn-sm"> <i class="fa fa-paypal" aria-hidden="true"></i> </a> ';
					}else{
						$btnView .= '<button class="btn btn-secondary btn-sm" disabled=""><i class="fa fa-paypal" aria-hidden="true"></i></button> ';
					}
				}
				if($_SESSION['permisosMod']['u']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idpedido'].')" title="Editar pedido"><i class="fas fa-pencil-alt"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function orden($idpedido){
		if(!is_numeric($idpedido)){
			header("Location:".base_url().'/pedidos');
		}
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$idpersona = "";
		if( $_SESSION['userData']['idrol'] == RCLIENTES ){
			$idpersona = $_SESSION['userData']['idpersona'];
		}
		
		$data['page_tag'] = "Pedido - Tienda Virtual";
		$data['page_title'] = "PEDIDO <small>Tienda Virtual</small>";
		$data['page_name'] = "pedido";
		$data['arrPedido'] = $this->model->selectPedido($idpedido,$idpersona);
		$this->views->getView($this,"orden",$data);
	}

	public function transaccion($transaccion){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$idpersona = "";
		if( $_SESSION['userData']['idrol'] == RCLIENTES ){
			$idpersona = $_SESSION['userData']['idpersona'];
		}
		$requestTransaccion = $this->model->selectTransPaypal($transaccion,$idpersona);		
		$data['page_tag'] = "Detalles de la transacción - Tienda Virtual";
		$data['page_title'] = "Detalles de la transacción";
		$data['page_name'] = "detalle_transaccion";
		$data['page_functions_js'] = "functions_pedidos.js";
		$data['objTransaccion'] = $requestTransaccion;
		$this->views->getView($this,"transaccion",$data);
	}

	// public function getTransaccion(string $transaccion){
	// 	if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['idrol'] != RCLIENTES){
	// 		if($transaccion == ""){
	// 			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
	// 		}else{
	// 			$transaccion = strClean($transaccion);
	// 			$requestTransaccion = $this->model->selectTransPaypal($transaccion);
	// 			if(empty($requestTransaccion)){
	// 				$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
	// 			}else{
	// 				$htmlModal = getFile("Template/Modals/modalReembolso",$requestTransaccion);
	// 				$arrResponse = array("status" => true, "html" => $htmlModal);
	// 			}
	// 		}
	// 		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	// 	}
	// 	die();
	// }

	public function setReembolso(){
		if($_POST){
			if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){
				//dep($_POST);
				$transaccion = strClean($_POST['idtransaccion']);
				$observacion = strClean($_POST['observacion']);
				$requestTransaccion = $this->model->reembolsoPaypal($transaccion,$observacion);
				if($requestTransaccion){
					$arrResponse = array("status" => true, "msg" => "El reembolso se ha procesado.");
				}else{
					$arrResponse = array("status" => false, "msg" => "No es posible procesar el reembolso.");
				}
			}else{
				$arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, consulte al administrador.");
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	// public function getPedido(string $pedido){
	// 	if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES){
	// 		if($pedido == ""){
	// 			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
	// 		}else{
	// 			$requestPedido = $this->model->selectPedido($pedido,"");
	// 			if(empty($requestPedido)){
	// 				$arrResponse = array("status" => false, "msg" => "Datos no disponibles.");
	// 			}else{
	// 				$requestPedido['tipospago'] = $this->getTiposPagoT();
	// 				$htmlModal = getFile("Template/Modals/modalPedido",$requestPedido);
	// 				$arrResponse = array("status" => true, "html" => $htmlModal);
	// 			}
	// 		}
	// 		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	// 	}
	// 	die();
	// }

	public function setPedido(){
		if($_POST){
			if(empty($_POST['cnroller']) || empty($_POST['suc_roller']) || 
			   empty($_POST['vend_roller']) || empty($_POST['medid_roller']) ||
			   empty($_POST['entre_roller']) || empty($_POST['date_roller']) || 
			   empty($_POST['listClient']) )
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				
				$idPedido = intval($_POST['idPedido']);
				$strCN = strClean($_POST['txtNombre']);
				$strSucursal = strClean($_POST['txtDescripcion']);
				$strVendedor = strClean($_POST['txtCodigo']);
				$strMedido = intval($_POST['listCategoria']);
				$strEntrega = strClean($_POST['txtPrecio']);
				$strDate = intval($_POST['txtStock']);
				$strList = intval($_POST['listClient']);
				$request_pedido = "";

				$ruta = strtolower(clear_cadena($strCN));
				$ruta = str_replace(" ","-",$ruta);

				if($idPedido == 0)
				{
					$option = 1;
					if($_SESSION['permisosMod']['w']){
						$request_pedido = $this->model->insertProducto($strCN, 
																	$strSucursal, 
																	$strVendedor, 
																	$strMedido,
																	$strEntrega, 
																	$strDate, 
																	$strList );
					}
				}else{
					$option = 2;
					if($_SESSION['permisosMod']['u']){
						$request_pedido = $this->model->updateProducto($idPedido,
																	$strCN, 
																	$strSucursal, 
																	$strVendedor, 
																	$strMedido,
																	$strEntrega, 
																	$strDate, 
																	$strList);
					}
				}
				if($request_pedido > 0 )
				{
					if($option == 1){
						$arrResponse = array('status' => true, 'idproducto' => $request_pedido, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'idproducto' => $idPedido, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_pedido == 'exist'){
					$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');		
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
}
 ?>