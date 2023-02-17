<?php 

require 'Libraries/html2pdf/vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;

class Shutters extends Controllers{
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
	public function Shutters(){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Shutters";
		$data['page_title'] = "SHUTTERS <small>Pedidos</small>";
		$data['page_name'] = "shutters";
		$data['page_functions_js'] = "functions_shutter.js";
		$this->views->getView($this,"shutters",$data);
	}	
// -------------------------------------------------------------------ACCIONES PARA PEDIDO
	public function setPedido(){
	
		if($_POST){			
			if(empty($_POST['listClient']) || empty($_POST['suc_roller']) || empty($_POST['vend_roller']) || 
			empty($_POST['medid_roller']) || empty($_POST['entre_roller']) || empty($_POST['date_roller']) || 
			empty($_POST['ft2']) ||	empty($_POST['listClient']))
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
				$strft2 = ucwords(strClean($_POST['ft2']));

				
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
																   $strentrega,
																   $strft2);
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
																	$strentrega,
																	$strft2);
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
				// die;
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
						$btnView .= ' <a title="Ver Detalle" href="'.base_url().'/shutters/orden/'.$arrData[$i]['idpedido'].'" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>';
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
	
		$data['page_tag'] = "Pedido - Shutters de madera";
		$data['page_title'] = "PEDIDO Shutters de madera";
		$data['page_name'] = "pedido";
		$data['page_functions_js'] = "functions_shutters.js";

		// $pedido=$this->model->idPedido($idpedido);
		// dep($pedido);
		// exit;
	    $data['arrPedido'] = $this->model->select_Pedido($idpedido);
		$this->views->getView($this,"ordenshutters",$data);	
	}
	// ---------------------------------------------------------------ACCIONES PARA PERSIANAS 
	public function setShutters(){ 
		if($_POST){			
			if( empty($_POST['Iden_shutters'])|| empty($_POST['anc_shutters']))
			   {
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				// dep($_POST);
				// exit;
				// die();
				
			}else{ 
						// $idpedido = "14";
              
				$idpedido = intval($_POST['idPedidoS']);
				$Cantidad = intval($_POST['unidades_shutters']);
				$idShutter = intval($_POST['idShutter']);
				$strIden = strClean($_POST['Iden_shutters']);
				$strAncho = ucwords(strClean($_POST['anc_shutters']));
				$strLargo = ucwords(strClean($_POST['alt_shutters']));
				$strProfundidad = intval(strClean($_POST['prof_shutters']));
				$strMedida = strClean(strClean($_POST['Med_shutters']));
				// $strMarco = strClean($_POST['marco_shutters']);
				// $strInstalacion = ucwords(strClean($_POST['inst_shutters']));
				$strColor= ucwords(strClean($_POST['color_shutters']));
				$srtLouver= ucwords(strClean($_POST['Louver_shutters']));
				$strBaston= ucwords(strClean($_POST['baston_shutters']));
				$strConfig = ucwords(strClean($_POST['typeConfig']));
				// $strDiagrama = ucwords(strClean($_POST['diagrama']));
				$strPoste1 = ucwords(strClean($_POST['poste1']));
				$strPoste2 = ucwords(strClean($_POST['poste2']));
				$strRiel = ucwords(strClean($_POST['rielD']));
				$strft2 = ucwords(strClean($_POST['Tft2']));
				$strPrecio = ucwords(strClean($_POST['precio_shutters']));
				$Total = ucwords(strClean($_POST['precio_total']));
				$strNota = strClean($_POST['nota']);

				// ........................................Diagrama
				
				$ruta = strtolower(clear_cadena($strIden));
				$ruta = str_replace(" ","-",$ruta);

				$foto   	 	= $_FILES['foto'];
				$nombre_foto 	= $foto['name'];
				$type 		 	= $foto['type'];
				$url_temp    	= $foto['tmp_name'];
				$imgPortada 	= 'portada_categoria.png';
				$request_cateria = "";
				if($nombre_foto != ''){
					$imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
				}

				$request_user = "";
				
					if($idShutter == 0){
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertShutters($idpedido,
																		$Cantidad,
																		$strIden,
																		$strAncho,
																		$strLargo,
																		$strProfundidad,
																		$strMedida,
																		$strColor,
																		$srtLouver,
																		$strBaston,
																		$strConfig,
																		$imgPortada,$ruta,
																		$strPoste1,
																		$strPoste2,
																		$strRiel,
																		$strft2,
																		$strPrecio,
																		$Total,
																	    $strNota);
					}
				}else{
					$option = 2;
					if($_SESSION['permisosMod']['u']){

						if($nombre_foto == ''){
							if($_POST['foto_actual'] != 'portada_categoria.png' && $_POST['foto_remove'] == 0 ){
								$imgPortada = $_POST['foto_actual'];
							}
						}
						$request_user = $this->model->updateShutters($idShutter,
																	$idpedido,
																	$Cantidad,
																	$strIden,
																	$strAncho,
																	$strLargo,
																	$strProfundidad,
																	$strMedida,
																	$strColor,
																	$srtLouver,
																	$strBaston,
																	$strConfig,
																	$imgPortada,$ruta,
																	$strPoste1,
																	$strPoste2,
																	$strRiel,
																	$strft2,
																	$strPrecio,
																	$Total,
																	$strNota);

				  }
				}		
		

				if($request_user > 0 )
				{
					if($option == 1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
						if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }

					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
						if($nombre_foto != ''){ uploadImage($foto,$imgPortada); }

						if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png')
							|| ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')){
							deleteFile($_POST['foto_actual']);
						}
					
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
	public function setImage(){
		if($_POST){
			if(empty($_POST['ID_SHUTTER'])){
				$arrResponse = array('status' => false, 'msg' => 'Error de dato.');
			}else{
				          
				$idProducto = intval($_POST['ID_SHUTTER']);
				$foto      = $_FILES['foto'];
				$imgNombre = 'pro_'.md5(date('d-m-Y H:i:s')).'.jpg';
				$request_image = $this->model->insertImage($idProducto,$imgNombre);
				if($request_image){
					$uploadImage = uploadImage($foto,$imgNombre);
					$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function delFile(){
		if($_POST){
			if(empty($_POST['ID_SHUTTER']) || empty($_POST['file'])){
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{
				//Eliminar de la DB
				$idProducto = intval($_POST['ID_SHUTTER']);
				$imgNombre  = strClean($_POST['file']);
				$request_image = $this->model->deleteImage($idProducto,$imgNombre);

				if($request_image){
					$deleteFile =  deleteFile($imgNombre);
					$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function delShutter(){
		if($_POST){
			if($_SESSION['permisosMod']['d']){
				$intIdShutter = intval($_POST['idShutter']);
				$requestDelete = $this->model->deleteShutter($intIdShutter);
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
	public function getShutters($idpedido){
		if($_SESSION['permisosMod']['r']){
         
		// $idpedido=9;
		 $arrData = $this->model->selectShutters($idpedido);
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
								$btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditRoller('.$arrData[$i]['ID_SHUTTER'].')" title="Editar pedido"><i class="fas fa-pencil-alt"></i></button>';
						}
						if($_SESSION['permisosMod']['d']){
								$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelRoller('.$arrData[$i]['ID_SHUTTER'].')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
						}
						$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
					}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

		        }
			
			
		}
		die();
	}
	
	public function getShutter($idshutter){
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
					$arrData['url_portada'] = media().'/images/uploads/'.$arrData['shut_diagrama'];
					$arrResponse = array('status' => true, 'data' => $arrData);

					$arrImg = $this->model->selectImages($intIdShutter);
						if(count($arrImg) > 0){
							for ($i=0; $i < count($arrImg); $i++) { 
								$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
							}
						}
						$arrData['images'] = $arrImg;
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
			if(empty($_POST['idPE'])||empty($_POST['txtImporte']) || empty($_POST['txtdescuento']) || empty($_POST['txtDesc']) || 
			empty($_POST['txtSubtotal']) || empty($_POST['txtInstall']) || empty($_POST['txtTotal']) || 
			empty($_POST['txtAnticipo']) || empty($_POST['txtSaldo']))
			{
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				// dep($_POST);
				// exit;

				
			}else{ 
				$id= intval($_POST['id']);
				$idPedido= intval($_POST['idPE']);
				$importe = ucwords(strClean($_POST['txtImporte']));
				$descuento = ucwords(strClean($_POST['txtdescuento']));
				$Desc = ucwords(strClean($_POST['txtDesc']));
				$subtotal = ucwords(strClean($_POST['txtSubtotal']));
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
						                                           $descuento,
					                                               $Desc,
																   $subtotal, 
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

	public function facturacliente($idpedido){
			if($_SESSION['permisosMod']['r']){
				if(is_numeric($idpedido)){
					$data = $this->model->InfGralPedido($idpedido);
				// 	echo $data;
				// 	dep($data);
				// 	die();
					if(empty($data)){
						echo "Datos no encontrados";
					}else{
						$idpedido = $data['orden']['cn'];
						$img=$data['shutter']['shut_diagrama'];
						ob_end_clean();
						$html = getFile("Template/Modals/PDFClientes/PDFClienteShutters",$data);
						$html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
						
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

	public function PDFNOTES($idpedido){
		if($_SESSION['permisosMod']['r']){
			if(is_numeric($idpedido)){
				$data = $this->model->InfGralPedido($idpedido);
				if(empty($data)){
					echo "Datos no encontrados";
				}else{
					$idpedido = $data['orden']['cn'];
					$img=$data['shutter']['shut_diagrama'];
					ob_end_clean();
					$html = getFile("Template/Modals/PDFShutters/pdfnotes",$data);
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
					$html = getFile("Template/Modals/PDFProduccion/PDFProduccionShutters",$data);
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

	public function getPrecio($idprecio){
		if($_SESSION['permisosMod']['r']){
				if($_POST){			
					if(empty($_POST['id'])||empty($_POST['idPE'])||empty($_POST['txtImporte']) || empty($_POST['txtdescuento']) || empty($_POST['txtDesc']) || 
					empty($_POST['txtSubtotal']) || empty($_POST['txtInstall']) || empty($_POST['txtTotal']) || 
					empty($_POST['txtAnticipo']) || empty($_POST['txtSaldo']))
					{
						$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						// dep($_POST);
						// exit;
		
						
					}else{ 
						$id= intval($_POST['id']);
						$idPedido= intval($_POST['idPE']);
						$importe = ucwords(strClean($_POST['txtImporte']));
						$descuento = ucwords(strClean($_POST['txtdescuento']));
						$Desc = ucwords(strClean($_POST['txtDesc']));
						$subtotal = ucwords(strClean($_POST['txtSubtotal']));
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