<?php 
	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function cantUsuarios(){
			$sql = "SELECT COUNT(*) as total FROM persona WHERE status != 0";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		public function cantClientes(){
			$sql = "SELECT COUNT(*) as total FROM inf_cliente1 WHERE status != 0";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
		// Inf. Arco
        public function cantPedidosArcos(){
			$sql = "SELECT COUNT(*) as total FROM pedidosarcos ";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosArcosMonto(){
			$sql = "SELECT SUM(saldo) as total FROM preciosarcos ";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
// -----BALANCES DE MADERA-------------------
		public function cantPedidosBalance(){
			$sql = "SELECT COUNT(*) as total FROM pedidobal ";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosBalanceMonto(){
			$sql = "SELECT SUM(saldo) as total FROM preciosbal";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
// -----HORIZONTALES-------------------
        public function cantPedidosHorizontales(){
			$sql = "SELECT COUNT(*) as total FROM pedidoshorizontal";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosHorizontalesMonto(){
			$sql = "SELECT SUM(saldo) as total FROM precioshorizontal";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
// -----NEOLUX MANUALES----------------------

        public function cantPedidosNeolux(){
			$sql = "SELECT COUNT(*) as total FROM pedidosneolux";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosNeoluxMonto(){
			$sql = "SELECT SUM(saldo) as total FROM precioneolux";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
// -----NEOLUX MOTORIZADAS----------------------
		public function cantPedidosNeoluxMotor(){
			$sql = "SELECT COUNT(*) as total FROM pedidomotor";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosNeoluxMotorMonto(){
			$sql = "SELECT SUM(saldo) as total FROM preciomotorizadas";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

// -----ROLLER MANUALES----------------------
        public function cantPedidosRoller(){
			$sql = "SELECT COUNT(*) as total FROM pedidos";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosRollerMonto(){
			$sql = "SELECT SUM(saldo) as total FROM preciorollers";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

// -----ROLLER MOTORIZADAS----------------------
        public function cantPedidosMotor(){
			$sql = "SELECT COUNT(*) as total FROM pedidosmortorizada";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosMotorMonto(){
			$sql = "SELECT SUM(saldo) as total FROM preciosmotor";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
// -----ROMANA----------------------
        public function cantPedidosRomana(){
			$sql = "SELECT COUNT(*) as total FROM pedidosroman ";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosRomanaMonto(){
			$sql = "SELECT SUM(saldo) as total FROM preciosroman";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
// -----SHUTTER----------------------
        public function cantPedidosShutters(){
			$sql = "SELECT COUNT(*) as total FROM pedidoshutters";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}

		public function cantPedidosShuttersMonto(){
			$sql = "SELECT SUM(saldo) as total FROM preciosshutters";
			$request = $this->select($sql);
			$total = $request['total']; 
			return $total;
		}
// ---------------------------

		public function VentasMes(int $anio, int $mes){
			$totalVentasMes=0;
			$arrVentaDias=array();
			$dias= cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
			$n_dia=1;
			for ($i=0; $i <$dias ; $i++) { 
				# code...
				$date= date_create($anio.'-'.$mes.'-'.$n_dia);
				$fechaVenta= date_format($date, "Y-m-d");
				$sql="SELECT count(pre.idpedido) as cantidad, SUM(pre.saldo) as total, 
				      DAY (ped.fecha) as dia from pedidosmortorizada ped 
					  inner join preciosmotor pre on ped.idpedido = pre.idpedido 
					  where ped.fecha = '$fechaVenta'";
				$ventaDia= $this->select($sql);
				$ventaDia['dia']= $n_dia;
				$ventaDia['total']= $ventaDia['total']=="" ? 0: $ventaDia['total'];
				$totalVentasMes += $ventaDia['total'];
				array_push($arrVentaDias, $ventaDia);
				$n_dia++;
			}
			$meses=Meses();
			$arrData=array('anio'=> $anio, 'mes'=> $meses[intval($mes-1)],'total'=> $totalVentasMes, 'ventas'=>$arrVentaDias);
			return $arrData;
			// echo $dias;

		}

		// ---------------------
		public function VentasAnio(int $anio){
			$arrMVentas =array();
			$arrMeses= Meses();
			for ($i=1; $i <=12; $i++) { 
				# code...
				$arrData= array('anio'=>'', 'no_mes'=>'','mes'=>'', 'cantidad'=>'','venta'=>'');
				$sql="SELECT count(pre.idpedido) as cantidad, SUM(pre.saldo) as venta, $anio as anio, $i as mes 
				      from pedidosmortorizada ped 
				      inner join preciosmotor pre on ped.idpedido = pre.idpedido 
				      where MONTH (ped.fecha) = $i AND YEAR(ped.fecha)= $anio";

				$ventaMes = $this->select($sql);
				$arrData['mes']=$arrMeses[$i-1];
				if(empty($ventaMes)){
					$arrData['anio']= $anio;
					$arrData['no_mes']= $i;
					$arrData['cantidad']= 0;
					$arrData['venta']=0;
					
				}else{
					$arrData['anio']= $ventaMes['anio'];
					$arrData['no_mes']= $ventaMes['mes'] ;
					$arrData['cantidad']=  $ventaMes['cantidad'];
					if(empty($arrData['venta']=$ventaMes['venta'])){
						$arrData['venta']=0;
					}else{
					$arrData['venta']=  $ventaMes['venta'];	
					}
					
					// $arrData['venta']=  $ventaMes['venta'];
				}
				array_push($arrMVentas,$arrData);
			}
			// dep($arrMVentas);
			$arrVentas=array('anio'=> $anio, 'meses'=> $arrMVentas);
			return $arrVentas;

		}


		public function VentasManuales(int $anio){
			$arrMVentas =array();
			$arrMeses= Meses();
			for ($i=1; $i <=12; $i++) { 
				# code...
				$arrData= array('anio'=>'', 'no_mes'=>'','mes'=>'', 'cantidad'=>'','venta'=>'');
				$sql="SELECT count(pre.idpedido) as cantidad, SUM(pre.saldo) as venta, $anio as anio, $i as mes 
				      from pedidos ped 
				      inner join preciorollers pre on ped.idpedido = pre.idpedido 
				      where MONTH (ped.fecha) = $i AND YEAR(ped.fecha)= $anio";

				$ventaMes = $this->select($sql);
				$arrData['mes']=$arrMeses[$i-1];
				if(empty($ventaMes)){
					$arrData['anio']= $anio;
					$arrData['no_mes']= $i;
					$arrData['cantidad']= 0;
					$arrData['venta']=0;
					
				}else{
					$arrData['anio']= $ventaMes['anio'];
					$arrData['no_mes']= $ventaMes['mes'] ;
					$arrData['cantidad']=  $ventaMes['cantidad'];
					if(empty($arrData['venta']=$ventaMes['venta'])){
						$arrData['venta']=0;
					}else{
					$arrData['venta']=  $ventaMes['venta'];	
					}
					
					// $arrData['venta']=  $ventaMes['venta'];
				}
				array_push($arrMVentas,$arrData);
			}
			// dep($arrMVentas);
			$arrVentas=array('anio'=> $anio, 'meses'=> $arrMVentas);
			return $arrVentas;

		}


		
		public function VentasShutters(int $anio){
			$arrMVentas =array();
			$arrMeses= Meses();
			for ($i=1; $i <=12; $i++) { 
				# code...
				$arrData= array('anio'=>'', 'no_mes'=>'','mes'=>'', 'cantidad'=>'','venta'=>'');
				$sql="SELECT count(pre.idpedido) as cantidad, SUM(pre.saldo) as venta, $anio as anio, $i as mes 
				      from pedidoshutters ped 
				      inner join preciosshutters pre on ped.idpedido = pre.idpedido 
				      where MONTH (ped.fecha) = $i AND YEAR(ped.fecha)= $anio";

				$ventaMes = $this->select($sql);
				$arrData['mes']=$arrMeses[$i-1];
				if(empty($ventaMes)){
					$arrData['anio']= $anio;
					$arrData['no_mes']= $i;
					$arrData['cantidad']= 0;
					$arrData['venta']=0;
					
				}else{
					$arrData['anio']= $ventaMes['anio'];
					$arrData['no_mes']= $ventaMes['mes'] ;
					$arrData['cantidad']=  $ventaMes['cantidad'];
					if(empty($arrData['venta']=$ventaMes['venta'])){
						$arrData['venta']=0;
					}else{
					$arrData['venta']=  $ventaMes['venta'];	
					}
					
					// $arrData['venta']=  $ventaMes['venta'];
				}
				array_push($arrMVentas,$arrData);
			}
			// dep($arrMVentas);
			$arrVentas=array('anio'=> $anio, 'meses'=> $arrMVentas);
			return $arrVentas;

		}
















		// public function cantPedidos(){
		// 	$rolid = $_SESSION['userData']['idrol'];
		// 	$idUser = $_SESSION['userData']['idpersona'];
		// 	$where = "";
		// 	if($rolid == RCLIENTES ){
		// 		$where = " WHERE personaid = ".$idUser;
		// 	}

		// 	$sql = "SELECT COUNT(*) as total FROM pedido ".$where;
		// 	$request = $this->select($sql);
		// 	$total = $request['total']; 
		// 	return $total;
		// }
		// public function lastOrders(){
		// 	$rolid = $_SESSION['userData']['idrol'];
		// 	$idUser = $_SESSION['userData']['idpersona'];
		// 	$where = "";
		// 	if($rolid == RCLIENTES ){
		// 		$where = " WHERE p.personaid = ".$idUser;
		// 	}

		// 	$sql = "SELECT p.idpedido, CONCAT(pr.nombres,' ',pr.apellidos) as nombre, p.monto, p.status 
		// 			FROM pedido p
		// 			INNER JOIN persona pr
		// 			ON p.personaid = pr.idpersona
		// 			$where
		// 			ORDER BY p.idpedido DESC LIMIT 10 ";
		// 	$request = $this->select_all($sql);
		// 	return $request;
		// }	
		// public function selectPagosMes(int $anio, int $mes){

		// 	$sql = "SELECT p.tipopagoid, tp.tipopago, COUNT(p.tipopagoid) as cantidad, SUM(p.monto) as total 
		// 			FROM pedido p 
		// 			INNER JOIN tipopago tp 
		// 			ON p.tipopagoid = tp.idtipopago 
		// 			WHERE MONTH(p.fecha) = $mes AND YEAR(p.fecha) = $anio GROUP BY tipopagoid";
		// 	$pagos = $this->select_all($sql);
		// 	$meses = Meses();
		// 	$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'tipospago' => $pagos );
		// 	return $arrData;
		// }
		// public function selectVentasMes(int $anio, int $mes){
		// 	$rolid = $_SESSION['userData']['idrol'];
		// 	$idUser = $_SESSION['userData']['idpersona'];
		// 	$where = "";
		// 	if($rolid == RCLIENTES ){
		// 		$where = " AND personaid = ".$idUser;
		// 	}

		// 	$totalVentasMes = 0;
		// 	$arrVentaDias = array();
		// 	$dias = cal_days_in_month(CAL_GREGORIAN,$mes, $anio);
		// 	$n_dia = 1;
		// 	for ($i=0; $i < $dias ; $i++) { 
		// 		$date = date_create($anio."-".$mes."-".$n_dia);
		// 		$fechaVenta = date_format($date,"Y-m-d");
		// 		$sql = "SELECT DAY(fecha) AS dia, COUNT(idpedido) AS cantidad, SUM(monto) AS total 
		// 				FROM pedido 
		// 				WHERE DATE(fecha) = '$fechaVenta' AND status = 'Completo' ".$where;
		// 		$ventaDia = $this->select($sql);
		// 		$ventaDia['dia'] = $n_dia;
		// 		$ventaDia['total'] = $ventaDia['total'] == "" ? 0 : $ventaDia['total'];
		// 		$totalVentasMes += $ventaDia['total'];
		// 		array_push($arrVentaDias, $ventaDia);
		// 		$n_dia++;
		// 	}
		// 	$meses = Meses();
		// 	$arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalVentasMes,'ventas' => $arrVentaDias );
		// 	return $arrData;
		// }
		// public function selectVentasAnio(int $anio){
		// 	$arrMVentas = array();
		// 	$arrMeses = Meses();
		// 	for ($i=1; $i <= 12; $i++) { 
		// 		$arrData = array('anio'=>'','no_mes'=>'','mes'=>'','venta'=>'');
		// 		$sql = "SELECT $anio AS anio, $i AS mes, SUM(monto) AS venta 
		// 				FROM pedido 
		// 				WHERE MONTH(fecha)= $i AND YEAR(fecha) = $anio AND status = 'Completo' 
		// 				GROUP BY MONTH(fecha) ";
		// 		$ventaMes = $this->select($sql);
		// 		$arrData['mes'] = $arrMeses[$i-1];
		// 		if(empty($ventaMes)){
		// 			$arrData['anio'] = $anio;
		// 			$arrData['no_mes'] = $i;
		// 			$arrData['venta'] = 0;
		// 		}else{
		// 			$arrData['anio'] = $ventaMes['anio'];
		// 			$arrData['no_mes'] = $ventaMes['mes'];
		// 			$arrData['venta'] = $ventaMes['venta'];
		// 		}
		// 		array_push($arrMVentas, $arrData);
		// 		# code...
		// 	}
		// 	$arrVentas = array('anio' => $anio, 'meses' => $arrMVentas);
		// 	return $arrVentas;
		// }
		// public function productosTen(){
		// 	$sql = "SELECT * FROM producto WHERE status = 1 ORDER BY idproducto DESC LIMIT 1,10 ";
		// 	$request = $this->select_all($sql);
		// 	return $request;
		// }
	}
 ?>