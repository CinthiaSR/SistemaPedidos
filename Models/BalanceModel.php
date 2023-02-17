<?php 
	class BalanceModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA ROLLERS

		public function insertBalance( string $idpedido, string $Cantidad, string $Localizacion, string $Instalacion, 
		                             string $Ancho, string $Largo, string $Color, string $Tam, string $Cortes, string $L_inst, 
                                     string $Sup, string $Forr, string $NameFrr, string $precioUnit,string $Precio, string $Nota){
			
			$this->strPedido = $idpedido;
			// $this->strCodigo = $Codigo;
			$this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColor = $Color;
			$this->strTam = $Tam;
			$this->strCortes = $Cortes;
			$this->strL_inst = $L_inst;
            $this->strSup = $Sup;
			$this->strForr =$Forr;
			$this->strNameFrr =$NameFrr;

			$this->strPrecioUnit = $precioUnit;
			$this->strPrecio = $Precio;
			$this->strNota = $Nota;
			

			if(empty($request))
			{

				//  VALUES (8, '1', 2, '3', 'Exacta', 1.00, 3.00, '4', '2.0', 'Blanco', 'Redonda', 'Inoxidable', '8', 'Der/R', 0.00) 

				$query_insert  = "INSERT INTO balance1(idpedido, 
				                                          bal_cantidad, 
														  bal_identificacion, 
														  bal_media, 
														  bal_alto, 
														  bal_largo, 
				                                          bal_color, 
														  bal_retorno, 
														  bal_cortes, 
														  bal_L_instalacion, 
														  bal_tapasuperior, 
														  bal_forrado, 
														  bal_nombreforro,
														  bal_preciounit,
														  bal_preciototal,
														  bal_nota) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array(
                    $this->strPedido,
                    $this->strCantidad,
                    $this->strLocalizacion,
                    $this->strInstalacion,
                    $this->strAncho,
                    $this->strLargo,
                    $this->strColor,
                    $this->strTam,
                    $this->strCortes,
                    $this->strL_inst,
                    $this->strSup,
                    $this->strForr,
                    $this->strNameFrr,        
                    $this->strPrecioUnit,
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

		public function updateHorizontal(int $idBalance, string $Cantidad, string $Localizacion, string $Instalacion, 
        string $Ancho, string $Largo, string $Color, string $Tam, string $Cortes, string $L_inst, 
        string $Sup, string $Forr, string $NameFrr, string $precioUnit,string $Precio, string $Nota){
	
			$this->strBalance = $idBalance;
			// $this->strCodigo = $Codigo;
            $this->strCantidad = $Cantidad;
			$this->strLocalizacion = $Localizacion;
            $this->strInstalacion = $Instalacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strColor = $Color;
			$this->strTam = $Tam;
			$this->strCortes = $Cortes;
			$this->strL_inst = $L_inst;
            $this->strSup = $Sup;
			$this->strForr =$Forr;
			$this->strNameFrr =$NameFrr;

			$this->strPrecioUnit = $precioUnit;
			$this->strPrecio = $Precio;
			$this->strNota = $Nota;

// 			$sql = "SELECT * FROM balance1 WHERE ID_BALANCE != $this->strBalance";
// 			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE balance1 SET bal_cantidad=?, 
											bal_identificacion=?, 
											bal_media=?, 
											bal_alto=?, 
											bal_largo=?, 
				                            bal_color=?, 
											bal_retorno=?, 
											bal_cortes=?, 
											bal_L_instalacion=?, 
											bal_tapasuperior=?, 
											bal_forrado=?, 
											bal_nombreforro=?,
											bal_preciounit=?,
											bal_preciototal=?,
											bal_nota=?
				WHERE ID_BALANCE = $this->strBalance";
				$arrData = array(
                    $this->strCantidad,
                    $this->strLocalizacion,
                    $this->strInstalacion,
                    $this->strAncho,
                    $this->strLargo,
                    $this->strColor,
                    $this->strTam,
                    $this->strCortes,
                    $this->strL_inst,
                    $this->strSup,
                    $this->strForr,
                    $this->strNameFrr,        
                    $this->strPrecioUnit,
                    $this->strPrecio,
                    $this->strNota
				);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteBalance(int $idBalance){
			$this->intIdBalance = $idBalance;
			$sql = "UPDATE balance1 SET status = ? WHERE ID_BALANCE= $this->intIdBalance";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		// R E V I S A R !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	
		public function selectBalances($idpedido){

			$sql="SELECT p.idpedido, b.ID_BALANCE, b.bal_identificacion, b.bal_cantidad,b.bal_media,b.bal_alto,
			             b.ba_largo, b.bal_color, b.bal_preciounit, b.bal_status
							  FROM pedidobal p INNER JOIN balance1 b ON p.idpedido = b.idpedido 
							  WHERE p.idpedido = $idpedido";
			$request = $this->select_all($sql);
			return $request;
	    }
		public function selectBalance(int $idBalance){
			$this->intIdBalance = $idBalance;
			$sql = "SELECT * FROM balance1 WHERE ID_BALANCE = $this->intIdBalance";
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
					$query_insert  = "INSERT INTO pedidobal(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega) 
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
						   FROM pedidobal p 
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
							FROM pedidobal p 
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
							FROM pedidobal p 
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

			$sql = "SELECT * FROM pedidobal WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidobal SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ?		
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
			$sql = "UPDATE pedidobal SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function idP(int $id){
			$sql = "SELECT * FROM pedidobal  WHERE idpedido != $id ";

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
							FROM pedidobal as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Horizontales = "SELECT ba.idpedido,
									   ba.ID_BALANCE, 
				                       ba.bal_identificacion, 
									   ba.bal_cantidad,
									   ba.bal_media,
									   ba.bal_alto,
				                       ba.bal_largo, 
									   ba.bal_color, 
									   ba.bal_preciototal,
									   ba.bal_nota, 
									   ba.status
					                   FROM balance1 ba  
									   INNER JOIN pedidobal p 
									   ON ba.idpedido = p.idpedido 
					                   where ba.idpedido=$idpedido and ba.status !=0";
                $requestPersinas = $this->select_all($sql_Horizontales);
				$sql_precio="SELECT * FROM preciosbal where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'balance'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;
		}

    	public function insertPrecios(string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal,  string $instalacion, 
		                              string $percenimp, string $tlimp, string $total,string $anticipacion, string $saldo){
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
					$query_insert  = "INSERT INTO preciosbal(idpedido, importe, porcentaje, totalPor, subtotal, instalacion, percenimp, totalimp,total,anticipacion, saldo) 
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
							FROM pedidobal as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT ba.idpedido,
									   ba.ID_BALANCE, 
									   ba.bal_cantidad, 
									   ba.bal_identificacion, 
									   ba.bal_media, 
									   ba.bal_alto, 
									   ba.bal_largo, 
				                       ba.bal_color, 
									   ba.bal_retorno, 
									   ba.bal_cortes, 
									   ba.bal_L_instalacion, 
									   ba.bal_tapasuperior, 
									   ba.bal_forrado, 
									   ba.bal_nombreforro,
									   ba.bal_preciounit,
									   ba.bal_preciototal,
									   ba.bal_nota,
									   ba.status
					                   FROM balance1 ba  
									   INNER JOIN pedidobal p 
									   ON ba.idpedido = p.idpedido 
					                   where ba.idpedido=$idpedido and ba.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciosbal where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'balance'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;

		}

		public function updateprecio(string $idprecio, string $idpedido, string $importe, int $porcentaje, string $totalpor, string $subtotal,  
		                              string $instalacion, string $percenimp, string $tlimp, string $total, string $anticipacion, string $saldo ){
			
			
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

			$sql = "SELECT * FROM preciosbal WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE preciosbal SET importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?,  instalacion = ?, percenimp=?, totalimp=?, total = ?, anticipacion= ? , saldo= ? 		
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