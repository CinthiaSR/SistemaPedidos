<?php 
	class RollersModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA ROLLERS

		public function insertRoller( string $idpedido, string $Codigo, string $Cantidad, string $Localizacion, string $Instalacion, 
		                             string $Ancho, string $Largo, string $ColorTela, string $TypeControl,
									 string $ColorComp, string $Typesa, string $TypeCadena, string $MedidaCadena, 
									 string $ControlMotor, string $balance, string $precioUnit, string $precioLista, string $Precio, string $Nota){
			
			$this->strPedido = $idpedido;
			$this->strCodigo = $Codigo;
			$this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColorTela = $ColorTela;
			$this->strTypeControl = $TypeControl;
			$this->strColorComp = $ColorComp;
            $this->strTypesa = $Typesa;
			$this->strTypeCadena = $TypeCadena;
			$this->strMedidaCadena = $MedidaCadena;
			$this->strControlMotor = $ControlMotor;

			$this->strBalance = $balance;
			$this->strPrecioUnit = $precioUnit;
			$this->strPrecioLista = $precioLista;

			$this->strPrecio = $Precio;
			$this->strNota = $Nota;
			

			if(empty($request))
			{

				//  VALUES (8, '1', 2, '3', 'Exacta', 1.00, 3.00, '4', '2.0', 'Blanco', 'Redonda', 'Inoxidable', '8', 'Der/R', 0.00) 

				$query_insert  = "INSERT INTO enrrollable(idpedido, 
				                                          codigo_enrrollable, 
				                                          en_cantidad, 
														  en_identificacion, 
														  en_instalacion, 
														  en_ancho, 
														  en_largo, 
				                                          en_color_tela, 
														  en_typecontrol, 
														  en_colorcomponents, 
														  en_typesa, 
														  en_typecadena, 
														  en_m_cadena,
														  en_control_motor,
														  en_balance,
														  en_preciolista,
														  en_preciounit,
														  en_precio,
														  en_nota) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strPedido,    
								$this->strCodigo ,    
								$this->strCantidad,    			
								$this->strLocalizacion,    
						        $this->strInstalacion,    						
								$this->strAncho,    
								$this->strLargo,   
								$this->strColorTela,    				
								$this->strTypeControl,    						
								$this->strColorComp,    			
							    $this->strTypesa,    	
								$this->strTypeCadena,    					
								$this->strMedidaCadena,    
								$this->strControlMotor,   
								$this->strBalance,
								$this->strPrecioUnit,
								$this->strPrecioLista, 
								$this->strPrecio,
								$this->strNota); 
								
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateRoller(int $idRoller, string $Codigo, string $Cantidad, string $Localizacion, string $Instalacion, 
									string $Ancho, string $Largo, string $ColorTela, string $TypeControl,
									string $ColorComp, string $Typesa, string $TypeCadena, string $MedidaCadena, 
									string $ControlMotor, string $balance, string $precioUnit, string $precioLista, string $Precio, string $Nota){
	
			// $this->intStatus = $status;
			$this->intIdRoller = $idRoller;
			$this->strCodigo = $Codigo;
			$this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColorTela = $ColorTela;
			$this->strTypeControl = $TypeControl;
			$this->strColorComp = $ColorComp;
            $this->strTypesa = $Typesa;
			$this->strTypeCadena = $TypeCadena;
			$this->strMedidaCadena = $MedidaCadena;
			$this->strControlMotor = $ControlMotor;
			
			$this->strBalance = $balance;
			$this->strPrecioUnit = $precioUnit;
			$this->strPrecioLista = $precioLista;

			$this->strPrecio = $Precio;
			$this->strNota = $Nota;

			$sql = "SELECT * FROM enrrollable WHERE codigo_enrrollable = '$this->strCodigo' AND ID_ENRROLLABLE != $this->intIdRoller ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE enrrollable SET codigo_enrrollable = ?, 
				                                             en_cantidad= ?, 
															 en_identificacion = ?,  
															 en_instalacion= ?, 
															 en_ancho = ?, 
															 en_largo = ?, 
															 en_color_tela= ?,
															 en_typecontrol= ?, 
															 en_colorcomponents= ?,  
															 en_typesa= ?, 
															 en_typecadena = ?, 
															 en_m_cadena = ?, 
															 en_control_motor= ?,
															 en_balance= ?,
															 en_preciolista= ?,
															 en_preciounit= ?,
															 en_precio= ?,
															 en_nota= ? 		
				WHERE ID_ENRROLLABLE = $this->intIdRoller";
				$arrData = array(
					$this->strCodigo, 
					$this->strCantidad,
					$this->strLocalizacion ,
					$this->strInstalacion,
					$this->strAncho, 			
					$this->strLargo , 			
					$this->strColorTela ,
					$this->strTypeControl ,
					$this->strColorComp ,
					$this->strTypesa ,
					$this->strTypeCadena ,
					$this->strMedidaCadena ,
					$this->strControlMotor ,
					$this->strBalance,
					$this->strPrecioUnit,
					$this->strPrecioLista,
					$this->strPrecio,
					$this->strNota);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteRoller(int $idroller){
			$this->intIdRoller = $idroller;
			$sql = "UPDATE enrrollable SET status = ? WHERE ID_ENRROLLABLE= $this->intIdRoller ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		// R E V I S A R !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
		public function selectRollers($idpedido){
			// $where = "";
			// if($idpedido != null){
			// 	$where = " WHERE en.idpedido = ".$idpedido;
			// }
			// $request=array();
			$sql="SELECT p.idpedido, en.ID_ENRROLLABLE, en.en_identificacion, en.en_cantidad,en.en_instalacion,en.en_ancho,
			             en.en_largo, en.en_color_tela, en.en_precio, en.status
							  FROM pedidos p INNER JOIN enrrollable en ON p.idpedido = en.idpedido 
							  WHERE p.idpedido = $idpedido";
			// $this->intIdPedido = $idpedido;
			// $request=array();
			// $sql="SELECT p.idpedido, en.ID_ENRROLLABLE, en.en_identificacion, en.en_cantidad,en.en_instalacion,en.en_ancho,
			//              en.en_largo, en.en_color_tela, en.en_precio, en.status
			// 				  FROM pedido p INNER JOIN enrrollable en ON p.idpedido = en.idpedido 
			// 				  where en.status !=0";
			$request = $this->select_all($sql);
			// $request=array('persinas'=>$sql);
			return $request;
	    }

		public function selectRoller(int $idroller){
			$this->intIdRoller = $idroller;
			$sql = "SELECT * FROM enrrollable WHERE ID_ENRROLLABLE = $this->intIdRoller";
			$request = $this->select($sql);
			return $request;
		}
// --------------------------------------------------------------------------------------------------ORDEN

        public function insertPedido(int $TipoCliente,string $Date,  int $CN, string $Sucursal, string $Vendedor, string $Medido, 
		                             string $Entrega)
		{

				$this->intCN = $CN;
				$this->intTipoCliente = $TipoCliente;
				$this->strSucursal = $Sucursal;
				$this->strVendedor = $Vendedor;
				$this->strMedido = $Medido;
				$this->strEntrega = $Entrega;
				$this->strDate = $Date;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO pedidos(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega) 
									VALUES(?,?,?,?,?,?,?)";
					$arrData = array($this->intTipoCliente,
									$this->strDate,
									$this->intCN,    
									$this->strSucursal,    			
									$this->strVendedor,    
									$this->strMedido,    						
									$this->strEntrega);    		

					$request_insert = $this->insert($query_insert,$arrData);
					$return = $request_insert;
				}else{
					$return = "exist";
				}
				return $return;
		}

		public function selectPedidos(){
			$sql = "SELECT p.idpedido,
						   p.cn,
						   p.ID_CLIENTE,
			               c.nombre,
						   p.fecha, 
						   p.sucursal,
						   p.vendedor, 
						   p.status
						   FROM pedidos p 
						   INNER JOIN inf_cliente1 c 
						    ON p.ID_CLIENTE = c.ID_CLIENTE   
						   WHERE p.status != 0 ";

			// $sql = "SELECT	* FROM pedido WHERE status != 0 ";
					$request = $this->select_all($sql);
					return $request;
		}

		public function selectPedido(int $idpedido){
			$this->intIdpedido = $idpedido;
			$sql = "SELECT p.idpedido,
							p.cn,
							p.ID_CLIENTE,
							c.nombre,
							p.fecha, 
							p.sucursal,
							p.vendedor,
							p.medido,
							p.entrega,
							p.status
							FROM pedidos p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE idpedido = $this->intIdpedido";
			$request = $this->select($sql);
			return $request;
		}
		public function idPedido(int $idpedido){

			$request=array();
			$sql = "SELECT p.idpedido,
							p.cn,
							p.ID_CLIENTE,
							c.nombre,
							p.fecha as fecha, 
							p.sucursal,
							p.vendedor,
							p.medido,
							p.entrega, 
							p.status
							FROM pedidos p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
			
				$request=array('orden'=>$requestPedido);
		
			}
			// $this->intIdpedido = $idpedido;
			// $sql = "SELECT * FROM pedido  WHERE idpedido=	$this->intIdpedido  ";

			// // $sql = "SELECT	* FROM pedido WHERE status != 0 ";
			// 		$request = $this->select($sql);
			// if(!empty($request)){
			// 	// $idCliente=$requestPedido['ID_CLIENTE'];
			//     // $sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
			// 	// $requestcliente=$this->select($sql_cliente);
		
			// 			$request=array('orden'=>$request);
						
				
			// 		}
					
					return $request;
		}

		public function updatePedido(int $idpedido, int $ID_CLIENTE, string $fecha, string $cn, string $sucursal, string $vendedor,
	                            	string $medido, string $entrega){
			$this->intIdPedido = $idpedido;
			$this->intIdCliente= $ID_CLIENTE;
			$this->strfecha = $fecha;
			$this->strcn = $cn;
			$this->strsucursal = $sucursal;
			$this->strvendedor = $vendedor;
			$this->strmedido = $medido;
			$this->strentrega = $entrega;

			// $this->intStatus = $status;

			$sql = "SELECT * FROM pedidos WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidos SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ?		
				WHERE idpedido = $this->intIdPedido ";
				$arrData = array($this->intIdCliente, 
								 $this->strfecha, 
								 $this->strcn, 
								 $this->strsucursal, 
								 $this->strvendedor, 
								 $this->strmedido, 
								 $this->strentrega);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deletePedido(int $idpedido){
			$this->intIdPedido = $idpedido;
			$sql = "UPDATE pedidos SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function idP(int $id){
			$sql = "SELECT * FROM pedidos  WHERE idpedido != $id ";

			// $sql = "SELECT	* FROM pedido WHERE status != 0 ";
					$request = $this->select($sql);
					return $request;
		}


// ------------------------------------------------------------------DATOS DE LA ORDEN
		public function select_Pedido(int $idpedido){
			$request=array();
			$sql = "SELECT p.idpedido,
							p.cn,
							p.ID_CLIENTE,
							c.nombre,
							p.fecha as fecha, 
							p.sucursal,
							p.vendedor,
							p.medido,
							p.entrega,
							p.status
							FROM pedidos as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT en.idpedido,
									   en.ID_ENRROLLABLE, 
				                       en.en_identificacion, 
									   en.en_cantidad,
									   en.en_typecontrol,
									   en.en_ancho,
				                       en.en_largo, 
									   en.en_color_tela, 
									   en.en_precio,
									   en.en_nota, 
									   en.status
					                   FROM enrrollable en  
									   INNER JOIN pedidos p 
									   ON en.idpedido = p.idpedido 
					                   where en.idpedido=$idpedido and en.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciorollers where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'roller'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;
		}

		public function insertPrecios(string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal,  string $instalacion, 
		                              string $percenimp, string $tlimp,string $total, string $anticipacion, string $saldo){
		        $this-> idpedido = $idpedido;
				$this-> intimporte= $importe;
				$this-> intprocentaje= $porcentaje;
				$this-> inttotalpor= $totalpor;
				$this-> intsubtotal= $subtotal;
				// $this-> intmotorizacion= $motorizacion;
				$this-> intinstalacion= $instalacion;
				$this-> intpercenimp=$percenimp;
				$this-> inttlimp=$tlimp;
				$this-> inttotal= $total;
				$this-> intacticipacion= $anticipacion;
				$this-> intsaldo= $saldo;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO preciorollers(idpedido, importe, porcentaje, totalPor, subtotal,  instalacion, percenimp, totalimp,total,anticipacion, saldo) 
									VALUES(?,?,?,?,?,?,?,?,?,?,?)";
					$arrData = array( $this-> idpedido,
									$this-> intimporte,
									$this-> intprocentaje,
									$this-> inttotalpor,
									$this-> intsubtotal,
									// $this-> intmotorizacion,
									$this-> intinstalacion,
									$this-> intpercenimp,
				                    $this-> inttlimp,
									$this-> inttotal,
									$this-> intacticipacion,
									$this-> intsaldo);    		

					$request_insert = $this->insert($query_insert,$arrData);
					$return = $request_insert;
				}else{
					$return = "exist";
				}
				return $return;

		}


		public function InfGralPedido(int $idpedido){
			$request=array();
			$sql = "SELECT p.idpedido,
							p.cn,
							p.ID_CLIENTE,
							c.nombre,
							p.fecha as fecha, 
							p.sucursal,
							p.vendedor,
							p.medido,
							p.entrega,
							p.status
							FROM pedidos as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT en.idpedido,
									   en.ID_ENRROLLABLE, 
				                       en.en_identificacion, 
									   en.en_cantidad,
									   en.en_instalacion,
									   en.en_ancho,
				                       en.en_largo, 
									   en.en_color_tela, 
									   en.en_typecontrol,
									   en.en_colorcomponents,
									   en.en_typesa,
									   en.en_typecadena,
									   en.en_m_cadena,
									   en.en_control_motor,
									   en.en_balance,
									   en.en_preciolista,
									   en.en_preciounit,
									   en.en_precio,
									   en.en_nota,
									   en.status
					                   FROM enrrollable en  
									   INNER JOIN pedidos p 
									   ON en.idpedido = p.idpedido 
					                   where en.idpedido=$idpedido and en.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciorollers where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'roller'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;

		}
    	public function updateprecio(string $idprecio, string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal, string $instalacion, 
		                            string $percenimp, string $tlimp, string $total, string $anticipacion, string $saldo ){
			
			
			$this->intIdPrecio = $idprecio;
			$this->intIdPedido = $idpedido;
			$this->intImporte= $importe;
			$this->intPorcentaje= $porcentaje;
			$this->intTotalpor= $totalpor;
			$this->intSubtotal = $subtotal;
			// $this->intmotorizacion= $motorizacion;		
			$this->intInstalacion = $instalacion;
			$this-> intpercenimp=$percenimp;
			$this-> inttlimp=$tlimp;
			$this->intTotal = $total;
			$this->intAnticipacion = $anticipacion;
			$this->intSaldo = $saldo;

			// $sql = "SELECT * FROM preciorollers WHERE idpedido = '$this->intIdPedido'";
			// $request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE preciorollers SET importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?, instalacion = ?, percenimp = ?, totalimp = ?, total = ?,  anticipacion= ? , saldo= ? 		
				WHERE id = $this->intIdPrecio ";
				$arrData = array($this->intImporte,
								$this->intPorcentaje,
								$this->intTotalpor,
								$this->intSubtotal,
								// $this->intmotorizacion,
								$this->intInstalacion,
								$this->intpercenimp,
				                $this->inttlimp,
								$this->intTotal,
								$this->intAnticipacion,
								$this->intSaldo);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			


		}

		// public function updateprecio(string $idprecio, string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal, string $instalacion, 
		//                              string $total, string $anticipacion, string $saldo ){
			
			
		// 	$this->intIdPrecio = $idprecio;
		// 	$this->intIdPedido = $idpedido;
		// 	$this->intImporte= $importe;
		// 	$this->intPorcentaje= $porcentaje;
		// 	$this->intTotalpor= $totalpor;
		// 	$this->intSubtotal = $subtotal;
		// 	// $this->intmotorizacion= $motorizacion;		
		// 	$this->intInstalacion = $instalacion;
		// 	$this->intTotal = $total;
		// 	$this->intAnticipacion = $anticipacion;
		// 	$this->intSaldo = $saldo;

		// 	$sql = "SELECT * FROM preciorollers WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
		// 	$request = $this->select_all($sql);

		// 	if(empty($request))
		// 	{
		// 		$sql = "UPDATE preciorollers SET importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?, instalacion = ?, total = ?, anticipacion= ?, saldo= ? 		
		// 		WHERE id = $this->intIdPrecio ";
		// 		$arrData = array($this->intImporte,
		// 						$this->intPorcentaje,
		// 						$this->intTotalpor,
		// 						$this->intSubtotal,
		// 						// $this->intmotorizacion,
		// 						$this->intInstalacion,
		// 						$this->intTotal,
		// 						$this->intAnticipacion,
		// 						$this->intSaldo);
		// 		$request = $this->update($sql,$arrData);
		// 	}else{
		// 		$request = "exist";
		// 	}
		//     return $request;			


		// }

	}
 ?>