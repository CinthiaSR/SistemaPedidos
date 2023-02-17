<?php 

require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;

class Balance extends Controllers{
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

	public function Balance(){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Balance";
		$data['page_title'] = "BALANCE <small>Pedidos</small>";
		$data['page_name'] = "balance1";
		$data['page_functions_js'] = "functions_balance.js";
		$this->views->getView($this,"balance",$data);
	}	
// -------------------------------------------------------------------ACCIONES PARA PEDIDO
	public function setPedido(){
	
		if($_POST){			
			if(empty($_POST['suc']) || empty($_POST['vend']) || 
			empty($_POST['medid']) || empty($_POST['entre']) || empty($_POST['date']) || empty($_POST['listClient']))
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');

				
			}else{ 
				$idPedido = intval($_POST['idPedido']);
				$strcn = intval(strClean($_POST['cn']));
				$strsucursal = ucwords(strClean($_POST['suc']));
				$strvendedor = ucwords(strClean($_POST['vend']));
				$strmedido = ucwords(strClean($_POST['medid']));
				$strentrega = ucwords(strClean($_POST['entre']));
				$strdate = ucwords(strClean($_POST['date']));
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
						$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/balance/orden/'.$arrData[$i]['idpedido'].'" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>';
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
	
		$data['page_tag'] = "Pedido Balance ";
		$data['page_title'] = "PEDIDO Balance ";
		$data['page_name'] = "pedido";
		$data['page_functions_js'] = "functions_balances.js";

		// $pedido=$this->model->idPedido($idpedido);
		// dep($pedido);
		// exit;
	    $data['arrPedido'] = $this->model->select_Pedido($idpedido);
		$this->views->getView($this,"ordenbalance",$data);	
	}
	// ---------------------------------------------------------------ACCIONES PARA PERSIANAS 
	public function setBalance(){ 
		if($_POST){			
			if( empty($_POST['idPedidoB'])|| empty($_POST['can']))
			   {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			
				
			}else{ 
						// $idpedido = "14";
              
				$idpedido = intval($_POST['idPedidoB']); //proviene de la tabla pedidos
				$idBalance = intval($_POST['idBalance']);
				// $strCodigo = strClean($_POST['ID_horizontal']);
				$strCantidad = intval(strClean($_POST['can']));
				$strLocalizacion = ucwords(strClean($_POST['loc']));
				$strInstalacion = ucwords(strClean($_POST['inst']));
				$strAncho = ucwords(strClean($_POST['anc']));
				$strLargo = ucwords(strClean($_POST['alt']));
				$strColor = ucwords(strClean($_POST['col']));
				$strTm = ucwords(strClean($_POST['tam']));
				$strCortes = strClean($_POST['cortesEsp']);
				$strL= strClean($_POST['L_inst']);
				$strSup = ucwords(strClean($_POST['Sup']));
				$strForr = ucwords(strClean($_POST['Forr']));
				$strNameF= ucwords(strClean($_POST['NameFrr']));
				$strprecioUnit = ucwords(strClean($_POST['precio_unitario']));

				$strPrecio = ucwords(strClean($_POST['precio_total']));
				$strNota = ucwords(strClean($_POST['nota']));
				$request_user = "";
				
					if($idBalance == 0){
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertBalance($idpedido,
							                                        // $strCodigo,
																	$strCantidad, 
																	$strLocalizacion,
																	$strInstalacion, 
																	$strAncho, 
																	$strLargo,  
																	$strColor,
																	$strTm,
																	$strCortes,
																	$strL,
																	$strSup,
																	$strForr,
																	$strNameF,
																	$strprecioUnit,
																	$strPrecio, 
																	$strNota);

							// dep($request_user);

							// dep($_SESSION['arrPedido']);
							// exit();
							
					}
				}else{
					$option = 2;
					if($_SESSION['permisosMod']['u']){
						$request_user = $this->model->updateHorizontal($idBalance,
																	// $strCodigo,
																	$strCantidad, 
																	$strLocalizacion,
																	$strInstalacion, 
																	$strAncho, 
																	$strLargo,  
																	$strColor,
																	$strTm,
																	$strCortes,
																	$strL,
																	$strSup,
																	$strForr,
																	$strNameF,
																	$strprecioUnit,
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

	public function delBalance(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdBalance = intval($_POST['idBalance']);
				$requestDelete = $this->model->deleteBalance($intIdBalance);
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
	public function getBalances($idpedido){
		if($_SESSION['permisosMod']['r']){
         
		// $idpedido=9;
		 $arrData = $this->model->selectBalances($idpedido);
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
								$btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditRoller('.$arrData[$i]['ID_BALANCE'].')" title="Editar pedido"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d']){
								$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelRoller('.$arrData[$i]['ID_BALANCE'].')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
						}
						$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
					}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

		        }
			
			
		}
		die();
	}
	
	public function getBalance($idBalance){
		if($_SESSION['permisosMod']['r']){
			$intIdBalance= intval($idBalance);
			if($intIdBalance > 0)
			{
				$arrData = $this->model->selectBalance($intIdBalance);
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
						$html = getFile("Template/Modals/PDFClientes/PDFClienteBalance",$data);
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

	public function facturaproduccion($idpedido){
		if($_SESSION['permisosMod']['r']){
			if(is_numeric($idpedido)){
				$data = $this->model->InfGralPedido($idpedido);
				if(empty($data)){
					echo "Datos no encontrados";
				}else{
					$idpedido = $data['orden']['cn'];
					ob_end_clean();
					$html = getFile("Template/Modals/PDFProduccion/PDFProduccionBalance",$data);
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
					$html = getFile("Template/Modals/PDFShutters/pdfBalance",$data);
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
				    if(empty($_POST['id']))
					{
						$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				// 		dep($_POST);
				// 		die;
		
						
					}else{ 
						$id= intval($_POST['id']);
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