<?php 

	class FormatosModel extends Mysql
	{
		private $intIdFormato;
		private $strArchivo;
		private $strNombre;
		private $strRuta;
		private $intStatus;
		

		public function __construct()
		{
			parent::__construct();
		}	

		
        public function selectFormatos()
		{
			$sql = "SELECT	* FROM formatos WHERE status != 0 ";
			$request = $this->select_all($sql);
			return $request;
		}
		
        public function selectFormato(int $idformato){
			$this->intIdFormato = $idformato;
			$sql = "SELECT * FROM formatos WHERE ID_FORMATO = $this->intIdFormato";
			$request = $this->select($sql);
			return $request;
		}

		public function insertFormato(string $nombre, string $archivo, string $ruta, int $status){
			$this->strNombre = $nombre;
			$this->strArchivo = $archivo;
			$this->strRuta = $ruta;
			$this->intStatus = $status;

			$return = 0;

			$sql = "SELECT * FROM formatos WHERE nombre= '{$this->strNombre}'";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO formatos (nombre,archivo,ruta,status) 
								  VALUES(?,?,?,?)";
				$arrData = array($this->strNombre,
								$this->strArchivo,
								$this->strRuta,
								$this->intStatus);
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}
		
		public function updateFormato(int $idformato, string $nombre, string $archivo, string $ruta, int $status){

			$this->intIdFormato = $idformato;
			$this->strNombre = $nombre;
			$this->strArchivo = $archivo;
			$this->strRuta = $ruta;
           	$this->intStatus = $status;

			$sql = "SELECT * FROM formatos WHERE nombre= '$this->strNombre' AND ID_FORMATO != $this->intIdFormato";
			$request = $this->select_all($sql);

			if(empty($request))
			{
	
					$sql = "UPDATE formatos SET nombre=?, archivo=?, ruta=?,status=? WHERE ID_FORMATO = $this->intIdFormato";
					$arrData = array($this->strNombre,
	        						$this->strArchivo, 
									$this->strRuta,
	        						$this->intStatus);
				
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		}

		public function deleteFormato(int $idformato)
		{
			$this->intIdFormato = $idformato;
			$sql = "UPDATE formatos SET status = ? WHERE ID_FORMATO = $this->intIdFormato ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
    }
?>