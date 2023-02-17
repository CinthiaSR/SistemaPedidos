<?php 

require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;

class Rollers extends Controllers{
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
	public function Rollers(){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Rollers";
		$data['page_title'] = "ROLLERS SHADES Manuales <small>Pedidos</small>";
		$data['page_name'] = "rollers";
		$data['page_functions_js'] = "functions_roller.js";
		$this->views->getView($this,"rollers",$data);
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
						$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/rollers/orden/'.$arrData[$i]['idpedido'].'" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>';
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
	
		$data['page_tag'] = "Pedido Roller Shades";
		$data['page_title'] = "PEDIDO Roller Shades Manuales";
		$data['page_name'] = "pedido";
		$data['page_functions_js'] = "functions_rollers.js";

		// $pedido=$this->model->idPedido($idpedido);
		// dep($pedido);
		// exit;
	    $data['arrPedido'] = $this->model->select_Pedido($idpedido);
		$this->views->getView($this,"orden",$data);	
	}
	// ---------------------------------------------------------------ACCIONES PARA PERSIANAS 
	public function setRoller(){ 
		if($_POST){			
			if( empty($_POST['idPedidoR'])|| empty($_POST['ID_roller']))
			   {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			
				
			}else{ 
						// $idpedido = "14";
              
				$idpedido = intval($_POST['idPedidoR']);
				$idRoller = intval($_POST['idRoller']);
				$strCodigo = strClean($_POST['ID_roller']);
				$strCantidad = intval(strClean($_POST['can_roller']));
				$strLocalizacion = ucwords(strClean($_POST['loc_roller']));
				$strInstalacion = ucwords(strClean($_POST['inst_roller']));
				$strAncho = ucwords(strClean($_POST['anc_roller']));
				$strLargo = ucwords(strClean($_POST['alt_roller']));
				$strColorTela = ucwords(strClean($_POST['colTela_roller']));
				$strTypeControl = strClean($_POST['control_roller']);
				$strColorComp = ucwords(strClean($_POST['colorComp_roller']));
				$strTypesa = ucwords(strClean($_POST['typePesa_roller']));
				$strTypeCadena = ucwords(strClean($_POST['typeCad_roller']));
				$strMedidaCadena = ucwords(strClean($_POST['cad_roller']));
				$strControlMotor = ucwords(strClean($_POST['motor_roller']));

				$strBalance = ucwords(strClean($_POST['balance_roller']));
				$strprecioUnit = ucwords(strClean($_POST['precio_unitario']));
				$strprecioLista = ucwords(strClean($_POST['precioLista']));

				$strPrecio = ucwords(strClean($_POST['precio_total']));
				$strNota = ucwords(strClean($_POST['nota']));
				$request_user = "";
				
					if($idRoller == 0){
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertRoller($idpedido,
							                                        $strCodigo,
																	$strCantidad, 
																	$strLocalizacion,
																	$strInstalacion, 
																	$strAncho, 
																	$strLargo, 
																	$strColorTela,
																	$strTypeControl, 
																	$strColorComp, 
																	$strTypesa, 
																	$strTypeCadena,
																	$strMedidaCadena,																	
																	$strControlMotor, 
																	$strBalance,
																	$strprecioUnit,
																	$strprecioLista, 
																	$strPrecio, 
																	$strNota);

							// dep($request_user);

							// dep($_SESSION['arrPedido']);
							// exit();
							
					}
				}else{
					$option = 2;
					if($_SESSION['permisosMod']['u']){
						$request_user = $this->model->updateRoller($idRoller,
																	$strCodigo,
																	$strCantidad, 
																	$strLocalizacion,
																	$strInstalacion, 
																	$strAncho, 
																	$strLargo, 
																	$strColorTela,
																	$strTypeControl, 
																	$strColorComp, 
																	$strTypesa, 
																	$strTypeCadena,
																	$strMedidaCadena,
																	$strControlMotor, 
																	$strBalance, 
																	$strprecioUnit,
																	$strprecioLista,
																	$strPrecio,
																	$strNota);

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

	public function delRoller(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdRoller = intval($_POST['idRoller']);
				$requestDelete = $this->model->deleteRoller($intIdRoller);
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
    // ---------------------- Muestra todas las persianas
	public function getRollers($idpedido){
		if($_SESSION['permisosMod']['r']){
         
		// $idpedido=9;
		 $arrData = $this->model->selectRollers($idpedido);
		if($idpedido>0){
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
							// $btnView .= ' <a title="Ver Detalle" href="'.base_url().'/rollers/orden/'.$arrData[$i]['idpedido'].'" target="_blanck" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>';
							// $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewRoller('.$arrData[$i]['ID_ENRROLLABLE'].')" title="Ver pedido"><i class="far fa-eye"></i> </button>';
						}
						if($_SESSION['permisosMod']['u']){
								$btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditRoller('.$arrData[$i]['ID_ENRROLLABLE'].')" title="Editar pedido"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d']){
								$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelRoller('.$arrData[$i]['ID_ENRROLLABLE'].')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
						}
						$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
					}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

		        }
			
			
		}
		die();
	}
	
	public function getRoller($idroller){
		if($_SESSION['permisosMod']['r']){
			$intIdRoller= intval($idroller);
			if($intIdRoller > 0)
			{
				$arrData = $this->model->selectRoller($intIdRoller);
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
			if(empty($_POST['idPE']))
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				// dep($_POST);
				// exit;
				
			}else{ 
				$id=  ucwords($_POST['id']);
				$idPedido=  ucwords($_POST['idPE']);
				$importe =  ucwords(strClean($_POST['txtImporte']));
				$descuento =  ucwords(strClean($_POST['txtdescuento']));
				$Desc =  ucwords(strClean($_POST['txtDesc']));
				$subtotal =  ucwords(strClean($_POST['txtSubtotal']));
				$install =  ucwords(strClean($_POST['txtInstall']));

				$percenimp =  ucwords(strClean($_POST['txtimpuesto']));
				$tlimp =  ucwords(strClean($_POST['txtImp']));

				$total=  ucwords(strClean($_POST['txtTotal']));
				$anticipo =  ucwords(strClean($_POST['txtAnticipo']));
				$saldo =  ucwords(strClean($_POST['txtSaldo']));
				
				$request_user = "";
				if($id == 0)
				{
					$option = 1;
					if($_SESSION['permisosMod']['w']){
						$request_user = $this->model->insertPrecios($idPedido,
																   $importe,
						                                           $descuento,
					                                               $Desc,
																   $subtotal,
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

	public function facturacliente($idpedido){
			if($_SESSION['permisosMod']['r']){
				if(is_numeric($idpedido)){
					$data = $this->model->InfGralPedido($idpedido);
					if(empty($data)){
						echo "Datos no encontrados";
					}else{
						$idpedido = $data['orden']['cn'];
						ob_end_clean();
						$html = getFile("Template/Modals/PDFClientes/PDFClienteRollers",$data);
						$html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
						
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
					$html = getFile("Template/Modals/PDFProduccion/PDFProduccionRollers",$data);
					$html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
					
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
					$html = getFile("Template/Modals/PDFShutters/pdfRollers",$data);
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
	public function getPrecio(){
		if($_SESSION['permisosMod']['r']){
				if($_POST){			
					if(empty($_POST['id'])||empty($_POST['idPE']))
					{
						$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						// dep($_POST);
						// die;
		
						
					}else{ 
						$id= intval($_POST['id']);
						$idPedido=  ucwords($_POST['idPE']);
						$importe =  ucwords(strClean($_POST['txtImporte']));
						$descuento =  ucwords(strClean($_POST['txtdescuento']));
						$Desc =  ucwords(strClean($_POST['txtDesc']));
						$subtotal =  ucwords(strClean($_POST['txtSubtotal']));
						// $motorizacion =  ucwords(strClean($_POST['txtMotorizacion']));
						$install =  ucwords(strClean($_POST['txtInstall']));
						$percenimp =  ucwords(strClean($_POST['txtimpuesto']));
						$tlimp =  ucwords(strClean($_POST['txtImp']));
						$total=  ucwords(strClean($_POST['txtTotal']));
						$anticipo =  ucwords(strClean($_POST['txtAnticipo']));
						$saldo =  ucwords(strClean($_POST['txtSaldo']));
			
		
						
						$request_user = "";
						if($id > 0)
						{
						  $option = 1;
							if($_SESSION['permisosMod']['u']){
								$request_user = $this->model->updateprecio($id,
																			$idPedido,
																			$importe,
																			$descuento,
																			$Desc,
																			$subtotal,
																			// $motorizacion, 
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


}


 ?>