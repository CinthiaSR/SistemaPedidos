<?php 
	class NeoluxModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA ROLLERS

		public function insertNeolux ( string $idpedido, string $Codigo, string $Cantidad, string $Localizacion, string $Instalacion, 
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

				$query_insert  = "INSERT INTO sheer(idpedido, 
				                                          codigo_sheer, 
				                                          sheer_cantidad, 
														  sheer_identificacion,
														  sheer_instalacion, 
														  sheer_ancho, 
														  sheer_largo, 
				                                          sheer_color_tela, 
														  sheer_typecontrol, 
														  sheer_colorcomponents, 
														  sheer_typesa, 
														  sheer_typecadena, 
														  sheer_m_cadena,
														  sheer_control_motor,
														  sheer_cassette,
														  sheer_preciolista,
														  sheer_preciounit,
														  sheer_precio,
														  sheer_nota) 
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

		public function updateNeolux(int $idRoller, string $Codigo, string $Cantidad, string $Localizacion, string $Instalacion, 
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

			$sql = "SELECT * FROM sheer WHERE codigo_sheer = '$this->strCodigo' AND ID_SHEER != $this->intIdRoller ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE sheer SET codigo_sheer = ?, 
				                                          sheer_cantidad =?, 
														  sheer_identificacion =?,
														  sheer_instalacion =?, 
														  sheer_ancho =?, 
														  sheer_largo =?, 
				                                          sheer_color_tela =?, 
														  sheer_typecontrol =?, 
														  sheer_colorcomponents =?, 
														  sheer_typesa =?, 
														  sheer_typecadena =?, 
														  sheer_m_cadena =?,
														  sheer_control_motor =?,
														  sheer_cassette =?,
														  sheer_preciolista =?,
														  sheer_preciounit =?,
														  sheer_precio =?,
														  sheer_nota =?	
				WHERE ID_SHEER = $this->intIdRoller";
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

		public function deleteNeolux(int $idroller){
			$this->intIdRoller = $idroller;
			$sql = "UPDATE sheer SET status = ? WHERE ID_SHEER= $this->intIdRoller ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		// R E V I S A R !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
		public function selectNeoluxs($idpedido){
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

		public function selectNeolux(int $idroller){
			$this->intIdRoller = $idroller;
			$sql = "SELECT * FROM sheer WHERE ID_SHEER = $this->intIdRoller";
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
					$query_insert  = "INSERT INTO pedidosneolux(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega) 
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
						   FROM pedidosneolux p 
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
							FROM pedidosneolux p 
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
							FROM pedidosneolux p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
			
				$request=array('orden'=>$requestPedido);
		
			}					
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

			$sql = "SELECT * FROM pedidosneolux WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidosneolux SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ?		
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
			$sql = "UPDATE pedidosneolux SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function idP(int $id){
			$sql = "SELECT * FROM pedidosneolux  WHERE idpedido != $id ";

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
							FROM pedidosneolux as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Neolux = "SELECT s.idpedido,
									   s.ID_SHEER, 
				                       s.sheer_identificacion, 
									   s.sheer_cantidad,
									   s.sheer_typecontrol,
									   s.sheer_ancho,
				                       s.sheer_largo, 
									   s.sheer_color_tela, 
									   s.sheer_precio,
									   s.sheer_nota, 
									   s.status
					                   FROM sheer s  
									   INNER JOIN pedidosneolux p 
									   ON s.idpedido = p.idpedido 
					                   where s.idpedido=$idpedido and s.status !=0";
                $requestPersinas = $this->select_all($sql_Neolux);
				$sql_precio="SELECT * FROM precioneolux where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'neolux'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;
		}

		public function insertPrecios(string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal, string $instalacion, 
		                              string $percenimp, string $tlimp,string $total, string $anticipacion, string $saldo){
		        $this-> idpedido = $idpedido;
				$this-> intimporte= $importe;
				$this-> intprocentaje= $porcentaje;
				$this-> inttotalpor= $totalpor;
				$this-> intsubtotal= $subtotal;
				$this-> intinstalacion= $instalacion;

				$this-> intpercenimp=$percenimp;
				$this-> inttlimp=$tlimp;

				$this-> inttotal= $total;
				$this-> intacticipacion= $anticipacion;
				$this-> intsaldo= $saldo;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO precioneolux(idpedido, importe, porcentaje, totalPor, subtotal, instalacion,percenimp, totalimp, total,anticipacion, saldo) 
									VALUES(?,?,?,?,?,?,?,?,?)";
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
							FROM pedidosneolux as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Neolux = "SELECT s.idpedido,
									   s.ID_SHEER,
									   s.codigo_sheer, 
									   s.sheer_cantidad,
				                       s.sheer_identificacion, 
									   s.sheer_instalacion,
									   s.sheer_ancho,
				                       s.sheer_largo, 
									   s.sheer_color_tela, 
									   s.sheer_typecontrol,
									   s.sheer_colorcomponents,
									   s.sheer_typesa,
									   s.sheer_typecadena,
									   s.sheer_m_cadena,
									   s.sheer_control_motor,
									   s.sheer_cassette,
									   s.sheer_preciolista,
									   s.sheer_preciounit,
									   s.sheer_precio,
									   s.sheer_nota,
									   s.status
					                   FROM sheer s  
									   INNER JOIN pedidosneolux p 
									   ON s.idpedido = p.idpedido 
					                   where s.idpedido=$idpedido and s.status !=0";
                $requestPersinas = $this->select_all($sql_Neolux);
				$sql_precio="SELECT * FROM precioneolux where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'neolux'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;

		}

		public function updateprecio(string $idprecio, string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal, string $instalacion, 
		                             string $percenimp, string $tlimp,string $total, string $anticipacion, string $saldo ){
			
			
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

			$sql = "SELECT * FROM precioneolux WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE precioneolux SET importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?, instalacion = ?,percenimp = ?, totalimp = ?, total = ?, anticipacion= ? , saldo= ? 		
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

	}
 ?>