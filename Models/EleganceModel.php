<?php 
	class EleganceModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA ROLLERS

		public function insertNeolux ( string $idpedido, string $Cantidad, string $Localizacion, string $Instalacion, 
										string $Ancho, string $Largo, string $ColorTela, string $ColorComp, string $Typesa, 
										string $ControlMotor, string $cassete,  string $Marca, string $Tipo, string $precioUnit, 
                                        string $precioLista, string $Precio, string $Nota){
		$this->strPedido = $idpedido;
            $this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColorTela = $ColorTela;
			$this->strColorComp = $ColorComp;
            $this->strTypesa = $Typesa;
			$this->strControlMotor = $ControlMotor;			
			$this->strcassete = $cassete;
			$this->strMarca = $Marca;
			$this->strTipo = $Tipo;
			$this->strPrecioUnit = $precioUnit;
			$this->strPrecioLista = $precioLista;
			$this->strPrecio = $Precio;
			$this->strNota = $Nota;

			if(empty($request))
			{

				//  VALUES (8, '1', 2, '3', 'Exacta', 1.00, 3.00, '4', '2.0', 'Blanco', 'Redonda', 'Inoxidable', '8', 'Der/R', 0.00) 

				$query_insert  = "INSERT INTO motorneolux(idpedido, 
				                                          ne_cantidad, 
														  ne_identificacion,
														  ne_instalacion, 
														  ne_ancho, 
														  ne_largo, 
				                                          ne_color_tela, 														  
														  ne_colorcomp, 
														  ne_typesa, 
														  ne_ctrlmotor,
														  ne_cassette,
                                                          ne_marca,
                                                          ne_tipo,
														  ne_preciolista,
														  ne_preciounit,
														  ne_precio,
														  ne_nota) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strPedido,     
								$this->strCantidad,
								$this->strLocalizacion,    			
						        $this->strInstalacion,    						
								$this->strAncho,    
								$this->strLargo,   
								$this->strColorTela,
                                $this->strColorComp,
                                $this->strTypesa,
                                $this->strControlMotor,		
                                $this->strcassete,
                                $this->strMarca,
                                $this->strTipo,
                                $this->strPrecioLista,
                                $this->strPrecioUnit,
                                $this->strPrecio,
                                $this->strNota); 
								
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateNeolux(int $idRoller,string $Cantidad, string $Localizacion, string $Instalacion,string $Ancho, string $Largo, string $ColorTela, 
                                     string $ColorComp, string $Typesa, string $ControlMotor, string $cassete,  string $Marca, string $Tipo, string $precioUnit, 
                                     string $precioLista, string $Precio, string $Nota){
	
			// $this->intStatus = $status;
			$this->intIdRoller = $idRoller;
			// $this->strCodigo = $Codigo;
			$this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColorTela = $ColorTela;
			$this->strColorComp = $ColorComp;
            $this->strTypesa = $Typesa;
			$this->strControlMotor = $ControlMotor;			
			$this->strcassete = $cassete;
			$this->strMarca = $Marca;
			$this->strTipo = $Tipo;
			$this->strPrecioUnit = $precioUnit;
			$this->strPrecioLista = $precioLista;
			$this->strPrecio = $Precio;
			$this->strNota = $Nota;

			$sql = "SELECT * FROM motorneolux WHERE ID_MOTORIZADA != $this->intIdRoller ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE motorneolux SET  ne_cantidad =?, 
                                                ne_identificacion =?,
                                                ne_instalacion =?, 
                                                ne_ancho =?, 
                                                ne_largo =?, 
                                                ne_color_tela =?, 														  
                                                ne_colorcomp =?, 
                                                ne_typesa =?, 
                                                ne_ctrlmotor =?,
                                                ne_cassette =?,
                                                ne_marca =?,
                                                ne_tipo =?,
                                                ne_preciolista =?,
                                                ne_preciounit =?,
                                                ne_precio =?,
                                                ne_nota =?
				WHERE ID_MOTORIZADA = $this->intIdRoller";
				$arrData = array($this->strCantidad,
                $this->strLocalizacion,    			
                $this->strInstalacion,    						
                $this->strAncho,    
                $this->strLargo,   
                $this->strColorTela,
                $this->strColorComp,
                $this->strTypesa,
                $this->strControlMotor,		
                $this->strcassete,
                $this->strMarca,
                $this->strTipo,
                $this->strPrecioLista,
                $this->strPrecioUnit,
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
			$sql = "UPDATE motorneolux SET status = ? WHERE ID_MOTORIZADA= $this->intIdRoller ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		// R E V I S A R !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
		
		public function selectNeolux(int $idroller){
			$this->intIdRoller = $idroller;
			$sql = "SELECT * FROM motorneolux WHERE ID_MOTORIZADA = $this->intIdRoller";
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
					$query_insert  = "INSERT INTO pedidomotor(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega) 
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
						   FROM pedidomotor p 
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
							FROM pedidomotor p 
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
							FROM pedidomotor p 
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

			$sql = "SELECT * FROM pedidomotor WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidomotor SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ?		
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
			$sql = "UPDATE pedidomotor SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function idP(int $id){
			$sql = "SELECT * FROM pedidomotor  WHERE idpedido != $id ";

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
							FROM pedidomotor as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Neolux = "SELECT s.idpedido,
									   s.ID_MOTORIZADA, 
				                       s.ne_identificacion, 
									   s.ne_cantidad,
									   s.ne_ancho,
				                       s.ne_largo, 
									   s.ne_color_tela, 
									   s.ne_precio,
									   s.ne_nota, 
                                    --    s.ne_marca,
									   s.status
					                   FROM motorneolux s  
									   INNER JOIN pedidomotor p 
									   ON s.idpedido = p.idpedido 
					                   where s.idpedido=$idpedido and s.status !=0";
                $requestPersinas = $this->select_all($sql_Neolux);
				$sql_precio="SELECT * FROM preciomotorizadas where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'neolux'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;
		}

		public function insertPrecios(string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal, string $motorizacion, string $instalacion, 
									  string $percenimp, string $tlimp, string $total, string $anticipacion, string $saldo){
		        $this-> idpedido = $idpedido;
				$this-> intimporte= $importe;
				$this-> intprocentaje= $porcentaje;
				$this-> inttotalpor= $totalpor;
				$this-> intsubtotal= $subtotal;
				$this-> intmotorizacion= $motorizacion;
				$this-> intinstalacion= $instalacion;
				$this-> intpercenimp=$percenimp;
				$this-> inttlimp=$tlimp;
				$this-> inttotal= $total;
				$this-> intacticipacion= $anticipacion;
				$this-> intsaldo= $saldo;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO preciomotorizadas(idpedido, importe, porcentaje, totalPor, subtotal, motorizacion, instalacion, percenimp, totalimp, total,anticipo, saldo) 
									VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData = array( $this-> idpedido,
									$this-> intimporte,
									$this-> intprocentaje,
									$this-> inttotalpor,
									$this-> intsubtotal,
									$this-> intmotorizacion,
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
							FROM pedidomotor as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Neolux = "SELECT  s.idpedido,
									   s.ID_MOTORIZADA,
                                        s.ne_cantidad, 
										s.ne_identificacion,
										s.ne_instalacion, 
										s.ne_ancho, 
										s.ne_largo, 
				                        s.ne_color_tela, 														  
										s.ne_colorcomp, 
										s.ne_typesa, 
										s.ne_ctrlmotor,
										s.ne_cassette,
                                        s.ne_marca,
                                        s.ne_tipo,
										s.ne_preciolista,
										s.ne_preciounit,
										s.ne_precio,
										s.ne_nota,
									   s.status
					                   FROM motorneolux s  
									   INNER JOIN pedidosneolux p 
									   ON s.idpedido = p.idpedido 
					                   where s.idpedido=$idpedido and s.status !=0";
                $requestPersinas = $this->select_all($sql_Neolux);
				$sql_precio="SELECT * FROM preciomotorizadas where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'neolux'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;

		}

		public function updateprecio(string $idprecio, string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal, string $motorizacion, string $instalacion, 
		                             string $percenimp, string $tlimp,string $total, string $anticipacion, string $saldo ){
			
			
			$this->intIdPrecio = $idprecio;
			$this->intIdPedido = $idpedido;
			$this->intImporte= $importe;
			$this->intPorcentaje= $porcentaje;
			$this->intTotalpor= $totalpor;
			$this->intSubtotal = $subtotal;
			$this->intmotorizacion= $motorizacion;		
			$this->intInstalacion = $instalacion;
			$this-> intpercenimp=$percenimp;
			$this-> inttlimp=$tlimp;
			$this->intTotal = $total;
			$this->intAnticipacion = $anticipacion;
			$this->intSaldo = $saldo;

			$sql = "SELECT * FROM preciomotorizadas WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE preciomotorizadas SET importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?, motorizacion=?, instalacion = ?,
				                                     percenimp = ?, totalimp = ?, total = ?, anticipo= ? , saldo= ? 		
				WHERE id = $this->intIdPrecio ";
				$arrData = array($this->intImporte,
								$this->intPorcentaje,
								$this->intTotalpor,
								$this->intSubtotal,
								$this->intmotorizacion,
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