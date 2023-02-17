<?php 

	class ClientesModel extends Mysql
	{
		private $intIdCliente;
		private $strIdentificacion;
		private $strNombre;
		private $strDireccion;
        private $strCiudad;
		private $intTelefono;
		private $strEmail;
		private $strToken;
		private $intStatus;
		

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertCliente(string $identificacion, string $nombre, string $direccion, string $ciudad, int $telefono, string $email, int $status){

			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strDireccion = $direccion;
            $this->strCiudad = $ciudad;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->intStatus = $status;
			$return = 0;

			$sql = "SELECT * FROM inf_cliente1 WHERE 
					email= '{$this->strEmail}' or no_cliente = '{$this->strIdentificacion}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO inf_cliente1(no_cliente,nombre,direccion,ciudad,telefono,email,status) 
								  VALUES(?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strDireccion,
                                $this->strCiudad,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

        public function selectClientes()
		{
			$sql = "SELECT	* FROM inf_cliente1 WHERE status != 0 ";
					$request = $this->select_all($sql);
					return $request;
		}

        public function selectCliente(int $idcliente){
			$this->intIdCliente = $idcliente;
			$sql = "SELECT * FROM inf_cliente1 WHERE ID_CLIENTE = $this->intIdCliente";
			$request = $this->select($sql);
			return $request;
		}

		public function updateCliente(int $idcliente, string $identificacion, string $nombre, string $direccion, string $ciudad, int $telefono, string $email, int $status){

			$this->intIdCliente = $idcliente;
			$this->strIdentificacion = $identificacion;
			$this->strNombre = $nombre;
			$this->strDireccion = $direccion;
            $this->strCiudad = $ciudad;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->intStatus = $status;

			$sql = "SELECT * FROM inf_cliente1 WHERE (email= '{$this->strEmail}' AND ID_CLIENTE != $this->intIdCliente)
										  OR (	no_cliente = '{$this->strIdentificacion}' AND ID_CLIENTE!= $this->intIdCliente) ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
	
					$sql = "UPDATE inf_cliente1 SET no_cliente=?, nombre=?, direccion=?, ciudad=?, telefono=?, email=?, status=? 
							WHERE ID_CLIENTE = $this->intIdCliente";
					$arrData = array($this->strIdentificacion,
	        						$this->strNombre,
	        						$this->strDireccion,
									$this->strCiudad,
	        						$this->intTelefono,
	        						$this->strEmail,
	        						$this->intStatus);
				
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		}

		public function deleteCliente(int $intIdpersona)
		{
			$this->intIdCliente = $intIdpersona;
			$sql = "UPDATE inf_cliente1 SET status = ? WHERE ID_CLIENTE = $this->intIdCliente ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
    }
?>