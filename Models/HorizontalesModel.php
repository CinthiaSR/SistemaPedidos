<?php 
	class HorizontalesModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA ROLLERS

		public function insertHorizontal( string $idpedido, string $Cantidad, string $Localizacion, string $Instalacion, 
		                             string $Ancho, string $Largo, string $Escalera, string $Color, string $Config,
									 string $Ctrl, string $Elev, string $Gal, string $Valance, string $Brack, string $precioUnit, 
									 string $precioLista, string $Precio, string $Nota){
			
			$this->strPedido = $idpedido;
			// $this->strCodigo = $Codigo;
			$this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strEscalera = $Escalera;
			$this->strColor = $Color;
			$this->strConfig = $Config;
			$this->strCtrl = $Ctrl;
            $this->strElev = $Elev;
			$this->strGal = $Gal;
			$this->strValance =$Valance;
			$this->strBrack =$Brack;

			$this->strPrecioUnit = $precioUnit;
			$this->strPrecioLista = $precioLista;
			$this->strPrecio = $Precio;
			$this->strNota = $Nota;
			

			if(empty($request))
			{

				//  VALUES (8, '1', 2, '3', 'Exacta', 1.00, 3.00, '4', '2.0', 'Blanco', 'Redonda', 'Inoxidable', '8', 'Der/R', 0.00) 

				$query_insert  = "INSERT INTO horizontal(idpedido, 
				                                          hor_cantidad, 
														  hor_identificacion, 
														  hor_instalacion, 
														  hor_ancho, 
														  hor_largo, 
				                                          hor_t_escalera, 
														  hor_est_color, 
														  hor_configuracion, 
														  hor_cbm, 
														  hor_ele_id, 
														  hor_galeriarim, 
														  hor_norm,
														  hor_holddown,
														  hor_preciolista,
														  hor_preciounit,
														  hor_precio,
														  hor_nota) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array(
								$this->strPedido,
								// $this->strCodigo = $Codigo;
								$this->strCantidad,
								$this->strLocalizacion,
								$this->strInstalacion,
								$this->strAncho,
								$this->strLargo,
								$this->strEscalera,
								$this->strColor,
								$this->strConfig,
								$this->strCtrl,
								$this->strElev,
								$this->strGal,
								$this->strValance,
								$this->strBrack,					
								$this->strPrecioUnit,
								$this->strPrecioLista,
								$this->strPrecio,
								$this->strNota
							
							); 
								
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateHorizontal(int $idHorizontal, string $Cantidad, string $Localizacion, string $Instalacion, 
		string $Ancho, string $Largo, string $Escalera, string $Color, string $Config,
		string $Ctrl, string $Elev, string $Gal, string $Valance, string $Brack, string $precioUnit, string $precioLista, string $Precio, string $Nota){
	
			$this->strHorizontal = $idHorizontal;
			// $this->strCodigo = $Codigo;
			$this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strEscalera = $Escalera;
			$this->strColor = $Color;
			$this->strConfig = $Config;
			$this->strCtrl = $Ctrl;
            $this->strElev = $Elev;
			$this->strGal = $Gal;
			$this->strValance =$Valance;
			$this->strBrack =$Brack;			

			$this->strPrecioUnit = $precioUnit;
			$this->strPrecioLista = $precioLista;
			$this->strPrecio = $Precio;
			$this->strNota = $Nota;

			$sql = "SELECT * FROM horizontal WHERE ID_HORIZONTAL != $this->strHorizontal ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE horizontal SET hor_cantidad= ?, 
											  hor_identificacion = ?,  
											  hor_instalacion= ?, 
											  hor_ancho = ?, 
											  hor_largo = ?, 
											  hor_t_escalera= ?,
											  hor_est_color= ?, 
											  hor_configuracion= ?,  
											  hor_cbm= ?, 
											  hor_ele_id = ?, 
											  hor_galeriarim = ?, 
											  hor_norm= ?,
											  hor_holddown= ?,
											  hor_preciolista= ?,
											  hor_preciounit= ?,
											  hor_precio= ?,
											  hor_nota= ? 
				WHERE ID_HORIZONTAL = $this->strHorizontal";
				$arrData = array(
					$this->strCantidad,
					$this->strLocalizacion,
					$this->strInstalacion,
					$this->strAncho,
					$this->strLargo,
					$this->strEscalera,
					$this->strColor,
					$this->strConfig,
					$this->strCtrl,
					$this->strElev,
					$this->strGal,
					$this->strValance,
					$this->strBrack,
		
					$this->strPrecioUnit,
					$this->strPrecioLista,
					$this->strPrecio,
					$this->strNota
				);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteHorizontal(int $idhorizontal){
			$this->intIdHorizontal = $idhorizontal;
			$sql = "UPDATE horizontal SET status = ? WHERE ID_HORIZONTAL= $this->intIdHorizontal";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		// R E V I S A R !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
		public function selectHorizontales($idpedido){

			$sql="SELECT p.idpedido, h.ID_HORIZONTAL, h.hor_identificacion, h.hor_cantidad,h.hor_instalacion,h.hor_ancho,
			             h.hor_largo, h.hor_est_color, h.hor_precio, h.hor_status
							  FROM pedidoshorizontal p INNER JOIN horizontal h ON p.idpedido = h.idpedido 
							  WHERE p.idpedido = $idpedido";
			$request = $this->select_all($sql);
			return $request;
	    }

		public function selectHorizontal(int $idhorizontal){
			$this->intIdHorizontal = $idhorizontal;
			$sql = "SELECT * FROM horizontal WHERE ID_HORIZONTAL = $this->intIdHorizontal";
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
					$query_insert  = "INSERT INTO pedidoshorizontal(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega) 
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

		public function selectpedidos(){
			$sql = "SELECT p.idpedido,
						   p.cn,
						   p.ID_CLIENTE,
			               c.nombre,
						   p.fecha, 
						   p.sucursal,
						   p.vendedor, 
						   p.status
						   FROM pedidoshorizontal p 
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
							FROM pedidoshorizontal p 
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
							FROM pedidoshorizontal p 
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

			$sql = "SELECT * FROM pedidoshorizontal WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidoshorizontal SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ?		
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
			$sql = "UPDATE pedidoshorizontal SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function idP(int $id){
			$sql = "SELECT * FROM pedidoshorizontal  WHERE idpedido != $id ";

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
							FROM pedidoshorizontal as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Horizontales = "SELECT en.idpedido,
									   en.ID_HORIZONTAL, 
				                       en.hor_identificacion, 
									   en.hor_cantidad,
									   en.hor_instalacion,
									   en.hor_ancho,
				                       en.hor_largo, 
									   en.hor_est_color, 
									   en.hor_precio,
									   en.hor_nota, 
									   en.status
					                   FROM horizontal en  
									   INNER JOIN pedidoshorizontal p 
									   ON en.idpedido = p.idpedido 
					                   where en.idpedido=$idpedido and en.status !=0";
                $requestPersinas = $this->select_all($sql_Horizontales);
				$sql_precio="SELECT * FROM precioshorizontal where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'horizontal'=>$requestPersinas,
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
				
				$this-> intinstalacion= $instalacion;
				$this-> intpercenimp=$percenimp;
				$this-> inttlimp=$tlimp;

				$this-> inttotal= $total;
				$this-> intacticipacion= $anticipacion;
				$this-> intsaldo= $saldo;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO precioshorizontal(idpedido, importe, porcentaje, totalPor, subtotal,  instalacion, percenimp, totalimp,total,anticipacion, saldo) 
									VALUES(?,?,?,?,?,?,?,?,?,?,?)";
					$arrData = array( $this-> idpedido,
									$this-> intimporte,
									$this-> intprocentaje,
									$this-> inttotalpor,
									$this-> intsubtotal,
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
							FROM pedidoshorizontal as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT en.idpedido,
									   en.ID_HORIZONTAL, 
				                       en.hor_identificacion, 
									   en.hor_cantidad,
									   en.hor_instalacion,
									   en.hor_ancho,
				                       en.hor_largo, 
									   en.hor_t_escalera, 
									   en.hor_est_color,
									   en.hor_configuracion,
									   en.hor_cbm,
									   en.hor_ele_id,
									   en.hor_galeriarim,
									   en.hor_norm,
									   en.hor_holddown,
									   en.hor_preciolista,
									   en.hor_preciounit,
									   en.hor_precio,
									   en.hor_nota,
									   en.status
					                   FROM horizontal en  
									   INNER JOIN pedidoshorizontal p 
									   ON en.idpedido = p.idpedido 
					                   where en.idpedido=$idpedido and en.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM precioshorizontal where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'horizontal'=>$requestPersinas,
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
			$this-> intpercenimp=$percenimp;
		    $this-> inttlimp=$tlimp;		
			$this->intInstalacion = $instalacion;
			$this->intTotal = $total;
			$this->intAnticipacion = $anticipacion;
			$this->intSaldo = $saldo;

			$sql = "SELECT * FROM precioshorizontal WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE precioshorizontal SET importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?,  instalacion = ?,percenimp=?, totalimp=?, total = ?, anticipacion= ? , saldo= ? 		
				WHERE id = $this->intIdPrecio ";
				$arrData = array($this->intImporte,
								$this->intPorcentaje,
								$this->intTotalpor,
								$this->intSubtotal,
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