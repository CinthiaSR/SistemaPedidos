<?php 

require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;

class Arcos extends Controllers{
	public function __construct(){
		parent::__construct();
		session_start();
// 		session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
		getPermisos(3);
	}
// ---------------------------------------------------------------------------Muestra la pantalla principal de pedidos
	public function Arcos(){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Arcos";
		$data['page_title'] = "ARCOS <small>Pedidos</small>";
		$data['page_name'] = "arcos";
		$data['page_functions_js'] = "functions_arco.js";
		$this->views->getView($this,"arcos",$data);
	}	
// -------------------------------------------------------------------ACCIONES PARA PEDIDO
	public function setPedido(){
	
		if($_POST){			
			if(empty($_POST['listClient']) || empty($_POST['suc_roller']) || empty($_POST['vend_roller']) || 
			empty($_POST['medid_roller']) || empty($_POST['entre_roller']) || empty($_POST['date_roller']) || empty($_POST['listClient']))
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');

				
			}else{ 
				$idPedido = intval($_POST['idPedido']);
				$strcn = intval(strClean($_POST['cnroller']));
				$strsucursal = ucwords(strClean($_POST['suc_roller']));
				$strvendedor = ucwords(strClean($_POST['vend_roller']));
				$strmedido = ucwords(strClean($_POST['medid_roller']));
				$strentrega = ucwords(strClean($_POST['entre_roller']));
				$strdate = ucwords(strClean($_POST['date_roller']));
				$idCliente = intval(strClean($_POST['listClient']));
				// $strTipo = ucwords(strClean($_POST['tipoPersiana']));
				// $strft2 = ucwords(strClean($_POST['ft2']));

				
				$request_user = "";
				if($idPedido == 0)
				{
					$option = 1;
					if($_SESSION['permisosMod']['w']){
						$request_user = $this->model->insertPedido($idCliente,
						                                           $strdate,
					                                               $strcn,
																   $strsucursal, 
																   $strvendedor,
																   $strmedido, 
																   $strentrega);
					}
				}else{
					$option = 2;
					if($_SESSION['permisosMod']['u']){
						$request_user = $this->model->updatePedido($idPedido,
																	$idCliente,
																	$strdate,
																	$strcn,
																	$strsucursal, 
																	$strvendedor,
																	$strmedido, 
																	$strentrega);
					}

				}

				if($request_user > 0 )
				{
					if($option == 1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_user == 'exist'){
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el CN ingresado ya existe, ingrese otro.');		
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
	public function getPedidos(){
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectPedidos();
				// dep($arrData);
				// exit;
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($_SESSION['permisosMod']['r']){
						$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/arcos/orden/'.$arrData[$i]['idpedido'].'"  class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>';
					}
					if($_SESSION['permisosMod']['u']){
							$btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditPedido('.$arrData[$i]['idpedido'].')" title="Editar pedido"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){
							$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelPedido('.$arrData[$i]['idpedido'].')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
	}
	public function getPedido($idpedido){
			if($_SESSION['permisosMod']['r']){
				$intIdPedido= intval($idpedido);
				if($intIdPedido > 0)
				{
					
					$arrData = $this->model->selectPedido($intIdPedido);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
    }
	public function delPedido(){
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdPedido = intval($_POST['idpedido']);
					$requestDelete = $this->model->deletePedido($intIdPedido);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el pedido');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el pedido.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el pedido.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
	}
	// --------------------------------------------------------------------------Muestra pantalla para registrar una orden con persianas 
	public function orden($idpedido){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
	
		$data['page_tag'] = "Arcos";
		$data['page_title'] = "Arcos";
		$data['page_name'] = "Arcos";
		$data['page_functions_js'] = "functions_arcos.js";

		// $pedido=$this->model->select_Pedido($idpedido);
		// dep($pedido);
		// exit;
	    $data['arrPedido'] = $this->model->select_Pedido($idpedido);
		$this->views->getView($this,"ordenarcos",$data);	
	}
	// ---------------------------------------------------------------ACCIONES PARA PERSIANAS 
	public function setArcos(){ 
		if($_POST){			
			if( empty($_POST['Iden'])|| empty($_POST['base']))
			   {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				// dep($_POST);
				// exit;
				// die();
				
			}else{ 
						// $idpedido = "14";
              
				$idpedido = intval($_POST['idPedidoS']);
				$idArcos = intval($_POST['idArcos']);
				$Cantidad = intval($_POST['unidades']);
				$strIden = strClean($_POST['Iden']);
				$strInst = ucwords(strClean($_POST['Inst']));
				$strBase = ucwords(strClean($_POST['base']));
				$strAltura = ucwords(strClean($_POST['altura']));
				$strColor= ucwords(strClean($_POST['color']));
				$strConfig= ucwords(strClean($_POST['config']));
				$strMarco= ucwords(strClean($_POST['marco']));
				$strft2 = ucwords(strClean($_POST['Tft2']));
				$strPrecio = ucwords(strClean($_POST['precio']));
				$Total = ucwords(strClean($_POST['precio_total']));
				$strNota = strClean($_POST['nota']);
				$strPlant = strClean($_POST['plant']);
				$request_user = "";
				
					if($idArcos == 0){
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertShutters($idpedido,
																		$Cantidad,
																		$strIden,
																		$strInst,
																		$strBase,
																		$strAltura,
																		$strColor,
																		$strConfig,
																		$strMarco,
																		$strft2,
																		$strPrecio,
																		$Total,
																	    $strNota,
																	    $strPlant);
					// 	dep($request_user);
					// die();
					}
				}else{
					$option = 2;
					if($_SESSION['permisosMod']['u']){
						$request_user = $this->model->updateShutters($idArcos,
																	$idpedido,
																	$Cantidad,
																	$strIden,
																	$strInst,
																	$strBase,
																	$strAltura,
																	$strColor,
																	$strConfig,
																	$strMarco,
																	$strft2,
																	$strPrecio,
																	$Total,
																	$strNota,
																	$strPlant);

				  }
				}		
		

				if($request_user > 0 )
				{
					if($option == 1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');					
					}
				}else if($request_user == 'exist'){
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
	
		die();
	}


	// ..............................................................................Galeria de imagenes para persianas especiales

	public function delArco(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdArco = intval($_POST['idArcos']);
				$requestDelete = $this->model->deleteShutter($intIdArco);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la persiana');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el persiana.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el persiana.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
}
	
	public function getArco($idshutter){
		if($_SESSION['permisosMod']['r']){
			$intIdShutter= intval($idshutter);
			if($intIdShutter > 0)
			{
				$arrData = $this->model->selectShutter($intIdShutter);
				// dep($arrData);
				// exit();
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
    }

	public function setDetalles(){
		$sid=session_id();
		echo $_SESSION['idUser'];
		echo "<br>";
		echo $sid;
		dep($_SESSION['arrPedido']);
	}

	public function details(){
		if($_POST){			
			if(empty($_POST['cnroller']) || empty($_POST['suc_roller']) || empty($_POST['vend_roller']) || 
			empty($_POST['medid_roller']) || empty($_POST['entre_roller']) || empty($_POST['date_roller']) || empty($_POST['listClient']))
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{ 
				$idPE = intval($_POST['idPE']);
				$strcn = intval(strClean($_POST['txtdescuento']));
				$strsucursal = ucwords(strClean($_POST['suc_roller']));
				$strvendedor = ucwords(strClean($_POST['vend_roller']));
				$strmedido = ucwords(strClean($_POST['medid_roller']));
				$strentrega = ucwords(strClean($_POST['entre_roller']));
				$strdate = ucwords(strClean($_POST['date_roller']));
				$idCliente = intval(strClean($_POST['listClient']));
				
				$request_user = "";
				if($idPE == 0)
				{
					$option = 1;
					if($_SESSION['permisosMod']['w']){
						$request_user = $this->model->insertPedido($idCliente,
						                                           $strdate,
					                                               $strcn,
																   $strsucursal, 
																   $strvendedor,
																   $strmedido, 
																   $strentrega																   
																   );
					}
				}else{
					$option = 2;
					if($_SESSION['permisosMod']['u']){
						$request_user = $this->model->updatePedido($idPE,
																	$idCliente,
																	$strdate,
																	$strcn,
																	$strsucursal, 
																	$strvendedor,
																	$strmedido, 
																	$strentrega
																	);
					}

				}

				if($request_user > 0 )
				{
					if($option == 1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_user == 'exist'){
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el CN ingresado ya existe, ingrese otro.');		
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();

	}

	// ----------------------------------------------------------------PRESUPUESTO DE PERSINAS
	public function precio(){
		if($_POST){			
			if(empty($_POST['idPE'])||empty($_POST['txtImporte']) ||  empty($_POST['txtInstall']) || empty($_POST['txtTotal']) || 
			empty($_POST['txtAnticipo']) || empty($_POST['txtSaldo']))
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				dep($_POST);
				exit;

				
			}else{ 
				$id= intval($_POST['id']);
				$idPedido= intval($_POST['idPE']);
				$importe = ucwords(strClean($_POST['txtImporte']));
				// $descuento = ucwords(strClean($_POST['txtdescuento']));
				// $Desc = ucwords(strClean($_POST['txtDesc']));
				// $subtotal = ucwords(strClean($_POST['txtSubtotal']));
				$install = ucwords(strClean($_POST['txtInstall']));
				
				$percenimp =  ucwords(strClean($_POST['txtimpuesto']));
				$tlimp =  ucwords(strClean($_POST['txtImp']));
				
				$total= ucwords(strClean($_POST['txtTotal']));
				$anticipo = ucwords(strClean($_POST['txtAnticipo']));
				$saldo = ucwords(strClean($_POST['txtSaldo']));
	

				
				$request_user = "";
				if($id == 0)
				{
					$option = 1;
					if($_SESSION['permisosMod']['w']){
						$request_user = $this->model->insertPrecios($idPedido,
																   $importe,
						                                        //    $descuento,
					                                            //    $Desc,
																//    $subtotal, 
																   $install,
																   $percenimp,
																   $tlimp,
																   $total, 
																   $anticipo,
																   $saldo);

						// dep($request_user);
						// exit();
					}
				}

				if($request_user > 0 )
				{
					if($option == 1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_user == 'exist'){
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el CN ingresado ya existe, ingrese otro.');		
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();

	}

	public function delprecio(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intId = intval($_POST['id']);
				$requestDelete = $this->model->deletePrecio($intId);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Eliminado');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
}



public function facturacliente($idpedido){
		if($_SESSION['permisosMod']['r']){
			if(is_numeric($idpedido)){
				$data = $this->model->InfGralPedido($idpedido);
				if(empty($data)){
					echo "Datos no encontrados";
				}else{
					$idpedido = $data['orden']['cn'];
					ob_end_clean();
					$html = getFile("Template/Modals/PDFClientes/PDFClienteArcos",$data);
					$html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
					
					$html2pdf->writeHTML($html);
					$html2pdf->output('factura-'.$idpedido.'.pdf');
				}
			}else{
				echo "Dato no válido";
			}
		}else{
			header('Location: '.base_url().'/login');
			die();
		}
}

	public function PDFNOTES($idpedido){
		if($_SESSION['permisosMod']['r']){
			if(is_numeric($idpedido)){
				$data = $this->model->InfGralPedido($idpedido);
				if(empty($data)){
					echo "Datos no encontrados";
				}else{
					$idpedido = $data['orden']['cn'];
					ob_end_clean();
					$html = getFile("Template/Modals/PDFShutters/pdfArcos",$data);
					$html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
					
					// $html=file_get_contents(media().'/images/uploads/'.$img);
					$html2pdf->writeHTML($html);
					$html2pdf->output('factura-'.$idpedido.'.pdf');
				}
			}else{
				echo "Dato no válido";
			}
		}else{
			header('Location: '.base_url().'/login');
			die();
		}
    }

	public function facturaproduccion($idpedido){
		if($_SESSION['permisosMod']['r']){
			if(is_numeric($idpedido)){
				$data = $this->model->InfGralPedido($idpedido);
				if(empty($data)){
					echo "Datos no encontrados";
				}else{
					$idpedido = $data['orden']['cn'];
					ob_end_clean();
					$html = getFile("Template/Modals/PDFProduccion/PDFProduccionArcos",$data);
					$html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
					
					$html2pdf->writeHTML($html);
					$html2pdf->output('factura-'.$idpedido.'.pdf');
				}
			}else{
				echo "Dato no válido";
			}
		}else{
			header('Location: '.base_url().'/login');
			die();
		}
    }

	public function getPrecio($idprecio){
		if($_SESSION['permisosMod']['r']){
				if($_POST){			
					if(empty($_POST['id'])||empty($_POST['idPE']))
					{
						$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						dep($_POST);
						exit;
		
						
					}else{ 
						$id= intval($_POST['id']);
						$idPedido= intval($_POST['idPE']);
						$importe = ucwords(strClean($_POST['txtImporte']));
						// $descuento = ucwords(strClean($_POST['txtdescuento']));
						// $Desc = ucwords(strClean($_POST['txtDesc']));
						// $subtotal = ucwords(strClean($_POST['txtSubtotal']));
						$install = ucwords(strClean($_POST['txtInstall']));
						
						$percenimp =  ucwords(strClean($_POST['txtimpuesto']));
			        	$tlimp =  ucwords(strClean($_POST['txtImp']));
				
						$total= ucwords(strClean($_POST['txtTotal']));
						$anticipo = ucwords(strClean($_POST['txtAnticipo']));
						$saldo = ucwords(strClean($_POST['txtSaldo']));
			
		
						
						$request_user = "";
						if($id > 0)
						{
						  $option = 1;
							if($_SESSION['permisosMod']['u']){
								$request_user = $this->model->updateprecio($id,
																			$idPedido,
																			$importe,
																			// $descuento,
																			// $Desc,
																			// $subtotal, 
																			$install,
																			 $percenimp,
																             $tlimp,
																			$total, 
																			$anticipo,
																			$saldo);
							}
		
						}
		
						if($request_user > 0 )
						{
							if($option == 1){
								$arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
							}
						}else if($request_user == 'exist'){
							$arrResponse = array('status' => false, 'msg' => '¡Atención! Revisa la que todos los datos sean correctos.');		
						}else{
							$arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
						}
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
				die();
			
		}
		die();

	}

	// ------------------------------------------------------------Seleccionar marco y tipo de instalacion
	public function getSelectMarcos(){
		$htmlOptions = "";
		$arrData = $this->model->selectMarcos();
		// dep( $arrData);
		// exit;
		if(count($arrData) > 0 ){
			for ($i=0; $i < count($arrData); $i++) { 
				if($arrData[$i]['status'] == 1 ){
				$htmlOptions .= '<option value="'.$arrData[$i]['idMarco'].'" >'.$arrData[$i]['nombre'].'--'.$arrData[$i]['condicion'].'</option>';
			  }
			}
		}
		echo $htmlOptions;
		die();	
	}

	public function getMarco($idMarco){
		if($_SESSION['permisosMod']['r']){
			$intId= intval($idMarco);
			if($intId > 0)
			{
				
				$arrData = $this->model->selectMarco($intId);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
}

}


 ?>