<?php 

	class Clientes extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
// 			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(3);
		}

		public function Clientes(){
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Clientes";
			$data['page_title'] = "CLIENTES";
			$data['page_name'] = "clientess";
			$data['page_functions_js'] = "functions_clientes.js";
			$this->views->getView($this,"clientes",$data);
		}

        public function setCliente(){
			if($_POST){			
				if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtDireccion']) || 
				   empty($_POST['txtCiudad']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{ 
					$idCliente = intval($_POST['idCliente']);
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strDireccion = ucwords(strClean($_POST['txtDireccion']));
                    $strCiudad = ucwords(strClean($_POST['txtCiudad']));
					$intTelefono = intval(strClean($_POST['txtTelefono']));
					$strEmail = strtolower(strClean($_POST['txtEmail']));
					$intStatus = intval(strClean($_POST['listStatus']));
					$request_user = "";
					if($idCliente == 0)
					{
                        $option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_user = $this->model->insertCliente($strIdentificacion,
																				$strNombre, 
																				$strDireccion,
                                                                                $strCiudad, 
																				$intTelefono, 
																				$strEmail, 
																				$intStatus );
						}
					}else{
						$option = 2;
						if($_SESSION['permisosMod']['u']){
							$request_user = $this->model->updateCliente($idCliente,
																		$strIdentificacion, 
																		$strNombre, 
																		$strDireccion,
                                                                        $strCiudad, 
																		$intTelefono, 
																		$strEmail,  
																		$intStatus);
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

        public function getClientes()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectClientes();
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
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewCliente('.$arrData[$i]['ID_CLIENTE'].')" title="Ver cliente"><i class="far fa-eye"></i></button>';
                        // $btnView .= ' <a title="Ver Detalle" href="'.base_url().'/perfil/perfil/'.$arrData[$i]['ID_CLIENTE'].'" target="_blanck" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>';
					}
					if($_SESSION['permisosMod']['u']){
						// if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						// 	($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ){
							$btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditCliente('.$arrData[$i]['ID_CLIENTE'].')" title="Editar cliente"><i class="fas fa-pencil-alt"></i></button>';
						// }else{
						// 	$btnEdit = '<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button>';
						// }
					}
					if($_SESSION['permisosMod']['d']){
						// if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
						// 	($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
						// 	($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'] )
						// 	 ){
							$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelCliente('.$arrData[$i]['ID_CLIENTE'].')" title="Eliminar cliente"><i class="far fa-trash-alt"></i></button>';
						// }else{
						// 	$btnDelete = '<button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>';
						// }
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

        public function getCliente($idcliente){
			if($_SESSION['permisosMod']['r']){
				$idcliente = intval($idcliente);
				if($idcliente > 0)
				{
					$arrData = $this->model->selectCliente($idcliente);
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

		public function delCliente()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdpersona = intval($_POST['idCliente']);
					$requestDelete = $this->model->deleteCliente($intIdpersona);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}


		public function getSelectClientes(){
			$htmlOptions = "";
			$arrData = $this->model->selectClientes();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['ID_CLIENTE'].'">'.$arrData[$i]['nombre'].' - '.$arrData[$i]['direccion'].
					'. Tel: '.$arrData[$i]['telefono'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();	
		}


    }
?>