<?php 
	class ArcosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA SHUTTERS

		public function insertShutters(string $idpedido, string $cantidad, string $Identificacion, string $Instalacion, string $Base, string $Altura, string $Color, 
		                               string $Config, string $Marco, string $Totalft2, string $Precio, string $PrecioTotal, string $nota, string $plant){
			
			$this->strPedido = $idpedido;	
			$this->strCantidad = $cantidad;
			$this->strIdentificacion = $Identificacion;
			$this->strInstalacion = $Instalacion;
			$this->strBase = $Base;
			$this->strAltura = $Altura;
			$this->strMarco = $Marco;		
			$this->strColor= $Color;
			$this->strConfig = $Config;
			$this->strTotalft2 = $Totalft2;
			$this->strPrecio = $Precio;
			$this->PrecioTotal = $PrecioTotal;
			$this->strNota = $nota;	
			$this->strPlant = $plant;

			if(empty($request))
			{
				$query_insert  = "INSERT INTO arcos(idpedido, 
														cantidad_arcos,
				                                        arcos_identificacion,
														arcos_instalacion,
														arcos_base,
														arcos_altura,
														arcos_color,
														arcos_tipoconfiguracion,
														arcos_tipomarco,
														arcos_totalf2,
														arcos_preciounit,
														arcos_preciototal,
														arcos_nota,
														arcos_plant) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array(	$this->strPedido,
									$this->strCantidad,
									$this->strIdentificacion,
									$this->strInstalacion,
									$this->strBase,
									$this->strAltura,
									$this->strColor,
									$this->strConfig,
									$this->strMarco,	
									$this->strTotalft2,
									$this->strPrecio,
									$this->PrecioTotal,
									$this->strNota,
									$this->strPlant); 
								
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateShutters(int $idShutter, string $idpedido, string $cantidad, string $Identificacion, string $Instalacion, string $Base, string $Altura, string $Color, 
		string $Config, string $Marco, string $Totalft2, string $Precio, string $PrecioTotal, string $nota, string $plant){
	
			// $this->intStatus = $status;
			$this->intIdShutter = $idShutter;
			$this->strPedido = $idpedido;	
			$this->strCantidad = $cantidad;
			$this->strIdentificacion = $Identificacion;
			$this->strInstalacion = $Instalacion;
			$this->strBase = $Base;
			$this->strAltura = $Altura;
			$this->strMarco = $Marco;		
			$this->strColor= $Color;
			$this->strConfig = $Config;
			$this->strTotalft2 = $Totalft2;
			$this->strPrecio = $Precio;
			$this->PrecioTotal = $PrecioTotal;
			$this->strNota = $nota;		
			$this->strPlant = $plant;

			// $sql = "SELECT * FROM shutters WHERE ID_SHUTTER = '$this->intIdShutter'";
			// $request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE arcos SET  cantidad_arcos=?,
											arcos_identificacion=?,
											arcos_instalacion=?,
											arcos_base=?,
											arcos_altura=?,
											arcos_color=?,
											arcos_tipoconfiguracion=?,
											arcos_tipomarco=?,
											arcos_totalf2=?,
											arcos_preciounit=?,
											arcos_preciototal=?,
											arcos_nota=?,
											arcos_plant=?
				WHERE ID_ARCOS = $this->intIdShutter";
				$arrData = array(
								$this->strCantidad,
								$this->strIdentificacion,
								$this->strInstalacion,
								$this->strBase,
								$this->strAltura,
								$this->strColor,
								$this->strConfig,
								$this->strMarco,	
								$this->strTotalft2,
								$this->strPrecio,
								$this->PrecioTotal,
								$this->strNota,
								$this->strPlant);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}
		// .............................................................................................Galeria de fotos para persianas especiales
		// public function insertImage(int $idproducto, string $imagen){
		// 	$this->intIdProducto = $idproducto;
		// 	$this->strImagen = $imagen;
		// 	$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	    //     $arrData = array($this->intIdProducto,
        // 					$this->strImagen);
	    //     $request_insert = $this->insert($query_insert,$arrData);
	    //     return $request_insert;
		// }
		// public function selectImages(int $idproducto){
		// 	$this->intIdProducto = $idproducto;
		// 	$sql = "SELECT productoid,img
		// 			FROM imagen
		// 			WHERE productoid = $this->intIdProducto";
		// 	$request = $this->select_all($sql);
		// 	return $request;
		// }

		// public function deleteImage(int $idproducto, string $imagen){
		// 	$this->intIdProducto = $idproducto;
		// 	$this->strImagen = $imagen;
		// 	$query  = "DELETE FROM imagen 
		// 				WHERE productoid = $this->intIdProducto 
		// 				AND img = '{$this->strImagen}'";
	    //     $request_delete = $this->delete($query);
	    //     return $request_delete;
		// }

		public function deleteShutter(int $idArco){
			$this->intIdArco = $idArco;
			$sql = "UPDATE arcos SET status = ? WHERE ID_ARCOS= $this->intIdArco";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function deletePrecio(int $id){
			$this->intId = $id;
			$sql = "UPDATE preciosarcos SET status = ? WHERE id= $this->intId";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		// R E V I S A R !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
		public function selectShutters($idpedido){
			$sql="SELECT ps.idpedido, ar.ID_ARCOS, ar.arcos_identificacion, ar.arcos_instalacion, ar.arcos_base, ar.arcos_altura, 
			             ar.arcos_color, ar.arcos_totalf2, ar.arcos_preciototal, ar.status
							  FROM pedidoshutters ps INNER JOIN arcos ar ON ps.idpedido = ar.idpedido 
							  WHERE ps.idpedido = $idpedido";
			$request = $this->select_all($sql);
			return $request;
	    }

		
		public function selectShutter(int $idshutter){
			$this->intIdShutter = $idshutter;
			$sql = "SELECT * FROM arcos WHERE ID_ARCOS = $this->intIdShutter";
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
				// $this->strMotor = $ft2;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO pedidosarcos(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega) 
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
						--    p.precioft2,
						   p.status
						   FROM pedidosarcos p 
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
							FROM pedidosarcos p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE idpedido = $this->intIdpedido";
			$request = $this->select($sql);
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


			$sql = "SELECT * FROM pedidosarcos WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidosarcos SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ?  		
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
			$sql = "UPDATE pedidosarcos SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
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
							-- p.precioft2,
							p.status
							FROM pedidosarcos as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT ps.idpedido,
									   ar.idpedido,
									   ar.ID_ARCOS, 
									   ar.cantidad_arcos, 
				                       ar.arcos_identificacion, 
									   ar.arcos_nota,
									   ar.arcos_base,
				                       ar.arcos_altura, 
									   ar.arcos_color, 
									   ar.arcos_totalf2,
									   ar.arcos_preciounit,
									   ar.arcos_preciototal,  
									   ar.status
					                   FROM arcos ar  
									   INNER JOIN pedidosarcos ps 
									   ON ar.idpedido = ps.idpedido 
					                   where ar.idpedido=$idpedido and ar.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciosarcos where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);		   
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'arcos'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;
		}

		public function insertPrecios(string $idpedido, string $importe,  string $instalacion, string $percenimp, string $tlimp, string $total, string $anticipacion, string $saldo){
		        $this-> idpedido = $idpedido;
				$this-> importe= $importe;
				$this-> instalacion= $instalacion;
				$this-> intpercenimp=$percenimp;
				$this-> inttlimp=$tlimp;
				$this-> total= $total;
				$this-> acticipacion= $anticipacion;
				$this-> saldo= $saldo;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO preciosarcos(idpedido, importe, instalacion, percenimp, totalimp,total,anticipacion, saldo) 
									VALUES(?,?,?,?,?,?,?,?)";
					$arrData = array( $this-> idpedido,
									$this-> importe,
									$this-> instalacion,
									$this-> intpercenimp,
				                    $this-> inttlimp,
									$this-> total,
									$this-> acticipacion,
									$this-> saldo);    		

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
							-- p.precioft2,
							p.status
							FROM pedidosarcos p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT ar.idpedido,
									   ar.ID_ARCOS, 
									   ar.cantidad_arcos, 
				                       ar.arcos_identificacion, 
									   ar.arcos_instalacion, 
									   ar.arcos_base,
									   ar.arcos_altura,
									   ar.arcos_color,
				                       ar.arcos_tipoconfiguracion, 
									   ar.arcos_tipomarco,
									   ar.arcos_totalf2,
									   ar.arcos_preciounit,
									   ar.arcos_preciototal,
									   ar.arcos_nota,  
									   ar.arcos_plant,
									   ar.status
					                   FROM arcos ar  
									   INNER JOIN pedidosarcos p 
									   ON ar.idpedido = p.idpedido 
					                   where ar.idpedido=$idpedido and ar.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciosarcos where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'arcos'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;

		}

		public function updateprecio(string $idprecio, string $idpedido, string $importe, string $instalacion, string $percenimp, string $tlimp,
		                             string $total,string $anticipacion, string $saldo ){
			
			
			$this->intIdPrecio = $idprecio;
			$this->intIdPedido = $idpedido;
			$this->intImporte= $importe;
			$this->intInstalacion = $instalacion;
			$this-> intpercenimp=$percenimp;
		    $this-> inttlimp=$tlimp;
			$this->intTotal = $total;
			$this->intAnticipacion = $anticipacion;
			$this->intSaldo = $saldo;

			$sql = "SELECT * FROM preciosarcos WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE preciosarcos SET importe = ?, instalacion = ?, percenimp=?, totalimp=?, total = ?, anticipacion= ? , saldo= ? 		
				WHERE id = $this->intIdPrecio ";
				$arrData = array($this->intImporte,
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