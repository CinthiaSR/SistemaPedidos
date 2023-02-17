<?php 
	class RomanaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA ROLLERS

		public function insertRomana( string $idpedido, string $Cantidad, string $Localizacion, string $Instalacion, 
		                             string $Ancho, string $Largo, string $ColorTela, string $Type, string $Config, 
									 string $Forro, string $Control, string $ControlMotor, string $Manufactura,  string $precioLista, 
									 string $precioUnit, string $Precio, string $Nota){
			
			$this->strPedido = $idpedido;
			$this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColorTela = $ColorTela;
			$this->strType = $Type;
			$this->strConfig = $Config;
            $this->strForro = $Forro;
			$this->strControl = $Control;
			$this->strControlMotor = $ControlMotor;

			$this->strManufactura = $Manufactura;
			$this->strPrecioLista = $precioLista;
			$this->strPrecioUnit = $precioUnit;

			$this->strPrecio = $Precio;
			$this->strNota = $Nota;
			

			if(empty($request))
			{

				$query_insert  = "INSERT INTO romana(idpedido, 
				                                     ro_cantidad, 
													 ro_identificacion, 
													 ro_instalacion, 
													 ro_ancho, 
													 ro_largo, 
				                                     ro_color_tela, 
													 ro_tiporo, 
													 ro_tipoconfig, 
													 ro_tipoforro, 
													 ro_tipocontrol, 
													 ro_controlmotor,
													 ro_manufactura,
													 ro_precioLista,
													 ro_preciounit,
													 ro_precio,
													 ro_nota) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strPedido,    
								$this->strCantidad,
								$this->strLocalizacion,
								$this->strInstalacion,
								$this->strAncho,
								$this->strLargo,
								$this->strColorTela,
								$this->strType,
								$this->strConfig,
								$this->strForro,
								$this->strControl,
								$this->strControlMotor,					
								$this->strManufactura,
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

		public function updateRomana(string $idRomana, string $idpedido, string $Cantidad, string $Identificacion, string $Instalacion, 
									string $Ancho, string $Largo, string $ColorTela, string $Type, string $Config, 
									string $Forro, string $Control, string $ControlMotor, string $Manufactura,  string $precioLista, 
									string $precioUnit, string $Precio, string $Nota){
	
			// $this->intStatus = $status;
			$this->intIdRomana = $idRomana;
			$this->strPedido = $idpedido;	
			$this->strCantidad = $Cantidad;
			$this->strIdentificacion = $Identificacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColorTela = $ColorTela;
			$this->strType = $Type;
			$this->strConfig = $Config;
            $this->strForro = $Forro;
			$this->strControl = $Control;
			$this->strControlMotor = $ControlMotor;
			$this->strManufactura = $Manufactura;
			$this->strPrecioLista = $precioLista;
			$this->strPrecioUnit = $precioUnit;
			$this->strPrecio = $Precio;
			$this->strNota = $Nota;


			if(empty($request))
			{
				$sql = "UPDATE romana SET ro_cantidad =?, 
										  ro_identificacion=?, 
										  ro_instalacion=?, 
										  ro_ancho=?, 
										  ro_largo=?, 
										  ro_color_tela=?, 
										  ro_tiporo=?, 
										  ro_tipoconfig=?, 
										  ro_tipoforro=?, 
										  ro_tipocontrol=?, 
										  ro_controlmotor=?,
										  ro_manufactura=?,
										  ro_precioLista=?,
										  ro_preciounit=?,
										  ro_precio=?,
										  ro_nota=?		
				WHERE ID_ROMANA = $this->intIdRomana";
				$arrData = array($this->strCantidad,
								$this->strIdentificacion,
								$this->strInstalacion,
								$this->strAncho,
								$this->strLargo,
								$this->strColorTela,
								$this->strType,
								$this->strConfig,
								$this->strForro,
								$this->strControl,
								$this->strControlMotor,					
								$this->strManufactura,
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
		

		public function deleteRoller(int $idromana){
			$this->intIdRomana = $idromana;
			$sql = "UPDATE romana SET status = ? WHERE ID_ROMANA= $this->intIdRomana ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		// R E V I S A R !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
		public function selectRollers($idpedido){
			$sql="SELECT p.idpedido, en.ID_ROMANA, en.ro_identificacion, en.ro_cantidad,en.ro_instalacion,en.ro_ancho,
			             en.ro_largo, en.ro_color_tela, en.ro_precio, en.status
							  FROM pedidosroman p INNER JOIN romana en ON p.idpedido = en.idpedido 
							  WHERE p.idpedido = $idpedido";
			$request = $this->select_all($sql);
			return $request;
	    }

		public function selectRoller(int $idroller){
			$this->intIdRoller = $idroller;
			$sql = "SELECT * FROM romana WHERE ID_ROMANA = $this->intIdRoller";
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
					$query_insert  = "INSERT INTO pedidosroman(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega) 
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
						   FROM pedidosroman p 
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
							FROM pedidosroman p 
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
							FROM pedidosroman p 
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

			$sql = "SELECT * FROM pedidosroman WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidosroman SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ?		
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
			$sql = "UPDATE pedidosroman SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function idP(int $id){
			$sql = "SELECT * FROM pedidosroman  WHERE idpedido != $id ";

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
							FROM pedidosroman as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT en.idpedido,
									   en.ID_ROMANA, 
				                       en.ro_identificacion, 
									   en.ro_cantidad,
									   en.ro_tiporo,
									   en.ro_ancho,
				                       en.ro_largo, 
									   en.ro_color_tela, 
									   en.ro_precio,
									   en.ro_nota, 
									   en.status
					                   FROM romana en  
									   INNER JOIN pedidosroman p 
									   ON en.idpedido = p.idpedido 
					                   where en.idpedido=$idpedido and en.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciosroman where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'roller'=>$requestPersinas,
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
					$query_insert  = "INSERT INTO preciosroman(idpedido, importe, porcentaje, totalPor, subtotal, motorizacion, instalacion,
					                                           percenimp, totalimp,total,anticipacion, saldo) 
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
							FROM pedidosroman as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT rom.idpedido,
									   rom.ID_ROMANA, 
										rom.ro_cantidad, 
										rom.ro_identificacion, 
										rom.ro_instalacion, 
										rom.ro_ancho, 
										rom.ro_largo, 
										rom.ro_color_tela, 
										rom.ro_tiporo, 
										rom.ro_tipoconfig, 
										rom.ro_tipoforro, 
										rom.ro_tipocontrol, 
										rom.ro_controlmotor,
										rom.ro_manufactura,
										rom.ro_preciolista,
										rom.ro_preciounit,
										rom.ro_precio,
										rom.ro_nota,
									    rom.status
					                   FROM romana rom  
									   INNER JOIN pedidos p 
									   ON rom.idpedido = p.idpedido 
					                   where rom.idpedido=$idpedido and rom.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciosroman where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'roller'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;

		}

		public function updateprecio(string $idprecio, string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal,  string $motorizacion, string $instalacion, 
		                             string $percenimp, string $tlimp,string $total, string $anticipacion, string $saldo ){
			
			
			$this->intIdPrecio = $idprecio;
			$this->intIdPedido = $idpedido;
			$this->intImporte= $importe;
			$this->intPorcentaje= $porcentaje;
			$this->intTotalpor= $totalpor;
			$this->intSubtotal = $subtotal;
			$this->intmotorizacion= $motorizacion;		
			$this->intInstalacion = $instalacion;
			$this->intpercenimp=$percenimp;
			$this->inttlimp=$tlimp;
			$this->intTotal = $total;
			$this->intAnticipacion = $anticipacion;
			$this->intSaldo = $saldo;

			$sql = "SELECT * FROM preciosroman WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE preciosroman SET importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?, motorizacion=?, instalacion = ?, 
				                                percenimp = ?, totalimp = ?,total = ?, anticipacion= ? , saldo= ? 		
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