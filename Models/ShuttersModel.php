<?php 
	class ShuttersModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		// --------------------------------------------------------------------------------------------- SENTENCIAS PARA SHUTTERS

		public function insertShutters(string $idpedido, string $Pais, string $idprecio, string $precioComp, string $cantidad, string $Identificacion, string $Ancho, string $Largo, 
		                              string $Profundidad, string $Medida,  string $Color, string $Louver,  string $Baston, string $Config, 
									  string $portada, string $ruta, string $Poste1, string $Poste2, string $Riel, string $Totalft2, string $Precio,
									  string $PrecioTotal, string $nota){
			
			$this->strPedido = $idpedido;	
			$this->Pais=$Pais;
			$this->idprecio=$idprecio;
            $this->precioComp=$precioComp;
			$this->strCantidad = $cantidad;
			$this->strIdentificacion = $Identificacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strProfundidad = $Profundidad;
			$this->strMedida = $Medida;
			// $this->strMarco = $marco;
		
			$this->strColor= $Color;
            $this->strLouver = $Louver;
			$this->strBaston = $Baston;
			$this->strConfig = $Config;
			
			$this->strPortada = $portada;
			$this->strRuta = $ruta;

			$this->strPoste1 = $Poste1;
			$this->strPoste2 = $Poste2;
			$this->strRiel = $Riel;
			$this->strTotalft2 = $Totalft2;
			$this->strPrecio = $Precio;
			$this->PrecioTotal = $PrecioTotal;
			$this->strNota = $nota;			

			if(empty($request))
			{

				//  VALUES (8, '1', 2, '3', 'Exacta', 1.00, 3.00, '4', '2.0', 'Blanco', 'Redonda', 'Inoxidable', '8', 'Der/R', 0.00) 

				$query_insert  = "INSERT INTO shutters(idpedido, 
														shut_pais
														shut_preBase,
														shut_precioComp,
														shut_cantidad,
				                                        shut_identificacion,
														shut_ancho,
														shut_largo,
														shut_profundidad,
														shut_t_medida,
														-- shut_marco,
														shut_color,
														shut_m_louver,
														shut_baston,
														shut_configuracion,
														shut_diagrama,
														shut_ruta,
														shut_p_T1,
														shut_p_T2,
														shut_Ub_riel,
														shut_ft2,
														shut_precio,
														shut_totalprecio,
														shut_nota) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array(	$this->strPedido,
									$this->Pais,
									$this->idprecio,
									$this->precioComp,
									$this->strCantidad,
									$this->strIdentificacion,
									$this->strAncho,
									$this->strLargo,
									$this->strProfundidad,
									$this->strMedida,
									// $this->strMarco,
									$this->strColor,
									$this->strLouver,
									$this->strBaston,
									$this->strConfig,
									$this->strPortada,
									$this->strRuta,
									$this->strPoste1,
									$this->strPoste2,
									$this->strRiel,
									$this->strTotalft2,
									$this->strPrecio,
									$this->PrecioTotal,
									$this->strNota); 
								
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateShutters(int $idShutter, string $idpedido, string $Pais, string $idprecio, string $precioComp, string $cantidad, string $Identificacion, 
		                               string $Ancho, string $Largo, string $Profundidad, string $Medida, string $Color, string $Louver, string $Baston, string $Config, 
									   string $portada, string $ruta, string $Poste1, string $Poste2, string $Riel, string $Totalft2, string $Precio,
		string $precioTotal, string $nota){
	
			// $this->intStatus = $status;
			$this->intIdShutter = $idShutter;
			$this->strPedido = $idpedido;
			$this->Pais=$Pais;
			$this->idprecio=$idprecio;
            $this->precioComp=$precioComp;
			$this->strCantidad = $cantidad;
			$this->strIdentificacion = $Identificacion;
			$this->strAncho = $Ancho;
			$this->strLargo = $Largo;
			$this->strProfundidad = $Profundidad;
			$this->strMedida = $Medida;
			// $this->strMarco = $marco;
			$this->strColor= $Color;
            $this->strLouver = $Louver;
			$this->strBaston = $Baston;
			$this->strConfig = $Config;
			
			$this->strPortada = $portada;
			$this->strRuta = $ruta;

			$this->strPoste1 = $Poste1;
			$this->strPoste2 = $Poste2;
			$this->strRiel = $Riel;
			$this->strTotalft2 = $Totalft2;
			$this->strPrecio = $Precio;
			
			$this->PrecioTotal = $precioTotal;
			$this->strNota = $nota;

			// $sql = "SELECT * FROM shutters WHERE ID_SHUTTER = '$this->intIdShutter'";
			// $request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE shutters SET  shut_pais=?,
											 shut_preBase=?,
											 shut_preComp=?,
										     shut_cantidad = ?,
											 shut_identificacion = ?, 
				                             shut_ancho= ?, 
											 shut_largo = ?, 											 
											 shut_profundidad = ?,  
											 shut_t_medida= ?, 
											 shut_color= ?,
											 shut_m_louver= ?, 
											 shut_baston= ?, 
											 shut_configuracion = ?, 
											 shut_diagrama = ?,
											 shut_ruta=?, 
											 shut_p_T1=?, 
											 shut_p_T2=?, 
											 shut_Ub_riel=?, 
											 shut_ft2= ?,
											 shut_precio= ?,
											 shut_totalprecio= ?,
											 shut_nota=?
				WHERE ID_SHUTTER = $this->intIdShutter";
				$arrData = array(
								$this->Pais,
								$this->idprecio,
								$this->precioComp,
					            $this->strCantidad,
								$this->strIdentificacion,
								$this->strAncho,
								$this->strLargo,
								$this->strProfundidad,
								$this->strMedida,
						
								$this->strColor,
								$this->strLouver,
								$this->strBaston,
								$this->strConfig,
								
								$this->strPortada,
								$this->strRuta,

								$this->strPoste1,
								$this->strPoste2,
								$this->strRiel,
								$this->strTotalft2,
								$this->strPrecio,
								$this->PrecioTotal,
								$this->strNota);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}
		// .............................................................................................Galeria de fotos para persianas especiales
		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}
		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteShutter(int $idShutter){
			$this->intIdShutter = $idShutter;
			$sql = "UPDATE shutters SET status = ? WHERE ID_SHUTTER= $this->intIdShutter";
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
			$sql="SELECT ps.idpedido, sh.ID_SHUTTERS, sh.shut_identificacion, sh. shut_t_instalacion,sh.shut_ancho, sh.shut_largo, 
			             sh.shut_color, sh.shut_ft2, sh.shut_precio, sh.status
							  FROM pedidoshutters ps INNER JOIN shutters sh ON ps.idpedido = sh.idpedido 
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

		public function selectShutter(int $idshutter){
			$this->intIdShutter = $idshutter;
			$sql = "SELECT * FROM shutters WHERE ID_SHUTTER = $this->intIdShutter";
			$request = $this->select($sql);
			return $request;
		}
// --------------------------------------------------------------------------------------------------ORDEN

        public function insertPedido(int $TipoCliente,string $Date,  int $CN, string $Sucursal, string $Vendedor, string $Medido, 
		                             string $Entrega, string $ft2)
		{

				$this->intCN = $CN;
				$this->intTipoCliente = $TipoCliente;
				$this->strSucursal = $Sucursal;
				$this->strVendedor = $Vendedor;
				$this->strMedido = $Medido;
				$this->strEntrega = $Entrega;
				$this->strDate = $Date;
				$this->strMotor = $ft2;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO pedidoshutters(ID_CLIENTE, fecha, cn, sucursal, vendedor, medido, entrega,precioft2) 
									VALUES(?,?,?,?,?,?,?,?)";
					$arrData = array($this->intTipoCliente,
									$this->strDate,
									$this->intCN,    
									$this->strSucursal,    			
									$this->strVendedor,    
									$this->strMedido,    						
									$this->strEntrega,
									$this->strMotor);    		

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
						   p.precioft2,
						   p.status
						   FROM pedidoshutters p 
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
							p.precioft2,
							p.status
							FROM pedidoshutters p 
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
							FROM pedido p 
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
	                            	string $medido, string $entrega, string $ft2){
			$this->intIdPedido = $idpedido;
			$this->intIdCliente= $ID_CLIENTE;
			$this->strfecha = $fecha;
			$this->strcn = $cn;
			$this->strsucursal = $sucursal;
			$this->strvendedor = $vendedor;
			$this->strmedido = $medido;
			$this->strentrega = $entrega;

			$this->strmotor = $ft2;
			// $this->intStatus = $status;

			$sql = "SELECT * FROM pedidoshutters WHERE cn = '$this->strcn' AND idpedido != $this->intIdPedido";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE pedidoshutters SET ID_CLIENTE = ?, fecha= ?, cn = ?,  sucursal= ?, vendedor = ?, medido = ?, entrega= ? , precioft2= ? 		
				WHERE idpedido = $this->intIdPedido ";
				$arrData = array($this->intIdCliente, 
								 $this->strfecha, 
								 $this->strcn, 
								 $this->strsucursal, 
								 $this->strvendedor, 
								 $this->strmedido, 
								 $this->strentrega,
								 $this->strmotor);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deletePedido(int $idpedido){
			$this->intIdPedido = $idpedido;
			$sql = "UPDATE pedidoshutters SET status = ? WHERE idpedido = $this->intIdPedido ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function idP(int $id){
			$sql = "SELECT * FROM pedido  WHERE idpedido != $id ";

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
							p.precioft2,
							p.status
							FROM pedidoshutters as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT sh.idpedido,
									   sh.ID_SHUTTER, 
									   sh.shut_pais,
									   sh.shut_cantidad, 
				                       sh.shut_identificacion, 
									   sh.shut_nota,
									   sh.shut_ancho,
				                       sh.shut_largo, 
									   sh.shut_color, 
									   sh.shut_ft2,
									   sh.shut_precio,
									   sh.shut_totalprecio,  
									   sh.status
					                   FROM shutters sh  
									   INNER JOIN pedidoshutters ps 
									   ON sh.idpedido = ps.idpedido 
					                   where sh.idpedido=$idpedido and sh.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciosshutters where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);		   
				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'roller'=>$requestPersinas,
			    'precio'=>$requestprecio);
		
			}

			return $request;
		}

		public function insertPrecios(string $idpedido, string $txtFt2, string $importe, string $porcentaje, string $totalpor, string $subtotal, string $instalacion, 
		                              string $percenimp, string $tlimp,string $total,
		                              string $anticipacion, string $saldo){
		        $this-> idpedido = $idpedido;
				$this-> txtFt2=$txtFt2;
				$this-> importe= $importe;
				$this-> procentaje= $porcentaje;
				$this-> totalpor= $totalpor;
				$this-> subtotal= $subtotal;
				$this-> instalacion= $instalacion;
				$this-> intpercenimp=$percenimp;
				$this-> inttlimp=$tlimp;
				$this-> total= $total;
				$this-> acticipacion= $anticipacion;
				$this-> saldo= $saldo;
				
				
				if(empty($request))
				{
					$query_insert  = "INSERT INTO preciosshutters(idpedido, totalFt2, importe, porcentaje, totalPor, subtotal, instalacion, percenimp, totalimp,total,anticipacion, saldo) 
									VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData = array( $this-> idpedido,
								    $this-> totalFt2,
									$this-> importe,
									$this-> procentaje,
									$this-> totalpor,
									$this-> subtotal,
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
							p.precioft2,
							p.status
							FROM pedidoshutters as p 
							INNER JOIN inf_cliente1 c 
							ON p.ID_CLIENTE = c.ID_CLIENTE   
							WHERE p.idpedido = $idpedido";
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idCliente=$requestPedido['ID_CLIENTE'];
				$sql_cliente="SELECT * FROM inf_cliente1 where ID_CLIENTE= $idCliente";
				$requestcliente=$this->select($sql_cliente);

				$sql_Rollers = "SELECT sh.idpedido,
									   sh.ID_SHUTTER, 
									   sh.shut_pais,
									   sh.shut_cantidad, 
				                       sh.shut_identificacion, 
									   sh.shut_ancho,
									   sh.shut_largo,
									   sh.shut_profundidad,
				                       sh.shut_t_medida, 
									   sh.shut_color,
									   sh.shut_m_louver,
									   sh.shut_baston,
									   sh.shut_configuracion,
									   sh.shut_diagrama,
									   sh.shut_p_T1, 
									   sh.shut_p_T2, 
									   sh.shut_Ub_riel,
									   sh.shut_ft2, 
									   sh.shut_precio,
									   sh.shut_totalprecio,
									   sh.shut_nota,   
									   sh.status
					                   FROM shutters sh  
									   INNER JOIN pedidoshutters p 
									   ON sh.idpedido = p.idpedido 
					                   where sh.idpedido=$idpedido and sh.status !=0";
                $requestPersinas = $this->select_all($sql_Rollers);
				$sql_precio="SELECT * FROM preciosshutters where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);

				$sql_precio="SELECT * FROM preciosshutters where idpedido=$idpedido";
				$requestprecio=$this->select($sql_precio);

				$sql_images="SELECT im.id, im.productoid, im.img FROM imagen im
				             INNER JOIN shutters s
							 ON im.productoid=s.ID_SHUTTER";
				$requestImg = $this->select_all($sql_images);


				// --------------------------------------------
				// $marcos = "SELECT *	FROM marcotable";
    //              $requestMarcos = $this->select_all($marcos);

				// --------------------------------------------


				$request=array('cliente'=>$requestcliente,
				'orden'=>$requestPedido,
				'shutter'=>$requestPersinas,
			    'precio'=>$requestprecio,
			    'imagen'=>$requestImg);
		
			}

			return $request;

		}

		public function updateprecio(string $idprecio, string $idpedido, string $txtFt2,  string $importe, string $porcentaje, string $totalpor, string $subtotal, string $instalacion,
		                            string $percenimp, string $tlimp, string $total, string $anticipacion, string $saldo ){
			
			
			$this->intIdPrecio = $idprecio;
			$this->intIdPedido = $idpedido;
			$this-> txtFt2=$txtFt2;
			$this->intImporte= $importe;
			$this->intPorcentaje= $porcentaje;
			$this->intTotalpor= $totalpor;
			$this->intSubtotal = $subtotal;
			$this->intInstalacion = $instalacion;
			$this-> intpercenimp=$percenimp;
			$this-> inttlimp=$tlimp;
			$this->intTotal = $total;
			$this->intAnticipacion = $anticipacion;
			$this->intSaldo = $saldo;

			$sql = "SELECT * FROM preciosshutters WHERE idpedido = '$this->intIdPedido' AND id != $this->intIdPrecio";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE preciosshutters SET totalFt2=?, importe = ?, porcentaje= ?, totalPor = ?,  subtotal= ?, instalacion = ?, percenimp = ?, totalimp = ?, total = ?, anticipacion= ? , saldo= ? 		
				WHERE id = $this->intIdPrecio ";
				$arrData = array($this->txtFt2,
					            $this->intImporte,
								$this->intPorcentaje,
								$this->intTotalpor,
								$this->intSubtotal,
								$this->intInstalacion,
								$this-> intpercenimp,
				                $this-> inttlimp,
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