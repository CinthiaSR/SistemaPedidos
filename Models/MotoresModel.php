<?php 

	class MotoresModel extends Mysql
	{
		// private $intIdCliente;
		// private $strIdentificacion;
		// private $strNombre;
		// private $strDireccion;
        // private $strCiudad;
		// private $intTelefono;
		// private $strEmail;
		// private $strToken;
		// private $intStatus;
		

		public function __construct()
		{
			parent::__construct();
		}	

		public function insertMotor(string $codigo, string $marca, string $nombre, string $precio,  int $status){
            $this->strcodigo = $codigo;
			$this->strmarca = $marca;
			$this->strNombre = $nombre;
			$this->strprecio = $precio;
			$this->intStatus = $status;
			$return = 0;

			$sql = "SELECT * FROM motores WHERE codigo = '{$this->strcodigo}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO motores(codigo,marca,tipo, precio, status) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->strcodigo,
                                $this->strmarca,
                                $this->strNombre,
                                $this->strprecio,
                                $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}
		// --------------------------------------------------------LISTA MOTORES
		public function selectLista()
		{
			$sql = "SELECT	* FROM listamotores WHERE status != 0 ";
					$request = $this->select_all($sql);
					return $request;
		}

		// --------------------------------------------------------

        public function selectMotores(){
			$sql = "SELECT	m.ID_MOTOR,
			                m.codigo,
							m.marca,
							m.tipo,
							m.precio, 
							m.status,
							l.ID_LISTA,
							l.nombre
			                FROM motores m 
							INNER JOIN listamotores l
							ON m.marca =l.ID_LISTA 
							WHERE m.status != 0 ";
					$request = $this->select_all($sql);
					return $request;
		}

        public function selectMotor(int $idcliente){
			$this->intIdCliente = $idcliente;
			$sql = "SELECT m.ID_MOTOR,
			        m.codigo,
					m.marca,
					m.tipo,
					m.precio,
					l.nombre
			        FROM motores m
					INNER JOIN listamotores l	
					ON m.marca =l.ID_LISTA  				
					WHERE ID_MOTOR = $this->intIdCliente";
			$request = $this->select($sql);
			return $request;
		}

		public function selectTipo(string $marca){
			$this->strMarca = $marca;
			// $sql = "SELECT * FROM motores WHERE marca = $this->strMarca";
			$sql = "SELECT * FROM motores WHERE marca = $this->strMarca";

			$request = $this->select_all($sql);
			return $request;
		}


		public function updateMotor(int $idmotor, string $codigo, string $marca, string $nombre, string $precio,  int $status){

			$this->intMotor = $idmotor;
            $this->strcodigo = $codigo;
			$this->strmarca = $marca;
			$this->strNombre = $nombre;
			$this->strprecio = $precio;
			$this->intStatus = $status;

			// $sql = "SELECT * FROM motores WHERE codigo = $this->strcodigo";
			$sql = "SELECT * FROM motores WHERE codigo = '$this->strcodigo' AND ID_MOTOR != $this->intMotor";

			$request = $this->select_all($sql);

			if(empty($request))
			{
	
					$sql = "UPDATE motores SET codigo=?, marca=?, tipo=?, precio=?
							WHERE ID_MOTOR = $this->intMotor";
					$arrData = array($this->strcodigo,
                                    $this->strmarca,
                                    $this->strNombre,
                                    $this->strprecio);
				
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		}

		public function deleteMotor(int $intIdpersona)
		{
			$this->intIdCliente = $intIdpersona;
			$sql = "UPDATE motores SET status = ? WHERE ID_MOTOR = $this->intIdCliente ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
    }
?>