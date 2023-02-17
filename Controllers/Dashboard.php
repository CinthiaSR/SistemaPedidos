<?php 

	class Dashboard extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
// 			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(1);
		}

		// public function dashboard()
		// {
		// 	$data['page_id'] = 2;
		// 	$data['page_tag'] = "Dashboard";
		// 	$data['page_title'] = "Dashboard";
		// 	$data['page_name'] = "dashboard";
		// 	$data['page_functions_js'] = "functions_dashboard.js";
		// 	$this->views->getView($this,"dashboard",$data);
		// }
		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard";
			$data['page_title'] = "Dashboard";
			$data['page_name'] = "dashboard";
			$data['page_functions_js'] = "functions_dashboard.js";
			$data['usuarios'] = $this->model->cantUsuarios();
			$data['clientes'] = $this->model->cantClientes();
			// $data['productos'] = $this->model->cantProductos();
			// Inf. Arcos
			$data['arco'] = $this->model->cantPedidosArcos();
			$data['arcoMonto'] = $this->model->cantPedidosArcosMonto();

			$data['balance'] = $this->model->cantPedidosBalance();
			$data['balanceMonto'] = $this->model->cantPedidosBalanceMonto();

			$data['horizontal'] = $this->model->cantPedidosHorizontales();
			$data['horizontalMonto'] = $this->model->cantPedidosHorizontalesMonto();

			$data['neolux'] = $this->model->cantPedidosNeolux();
			$data['neoluxMonto'] = $this->model->cantPedidosNeoluxMonto();

			$data['motor'] = $this->model->cantPedidosNeoluxMotor();
			$data['motorMonto'] = $this->model->cantPedidosNeoluxMotorMonto();

			$data['roller'] = $this->model->cantPedidosRoller();
			$data['rollerMonto'] = $this->model->cantPedidosRollerMonto();
			
			$data['motorizacion'] = $this->model->cantPedidosMotor();
			$data['motorizacionMonto'] = $this->model->cantPedidosMotorMonto();

			$data['romana'] = $this->model->cantPedidosRomana();
			$data['romanaMonto'] = $this->model->cantPedidosRomanaMonto();

			$data['shutter'] = $this->model->cantPedidosShutters();
			$data['shutterMonto'] = $this->model->cantPedidosShuttersMonto();


			$anio = date('Y');
			$mes = date('m');
			$data['VentasxMes']=$this->model->VentasMes($anio,$mes);
			$data['VentasAnio']=$this->model->VentasAnio($anio,$mes);
			$data['RolManuales']=$this->model->VentasManuales($anio,$mes);

			$data['Shutters']=$this->model->VentasShutters($anio,$mes);

			// dep($data['VentasAnio']); exit;

			$this->views->getView($this,"dashboard",$data);
			
		}

		
		// public function ventasMes(){
		// 	if($_POST){
		// 		$grafica = "ventasMes";
		// 		$nFecha = str_replace(" ","",$_POST['fecha']);
		// 		$arrFecha = explode('-',$nFecha);
		// 		$mes = $arrFecha[0];
		// 		$anio = $arrFecha[1];
		// 		$pagos = $this->model->selectVentasMes($anio,$mes);
		// 		$script = getFile("Template/Modals/graficas",$pagos);
		// 		echo $script;
		// 		die();
		// 	}
		// }
		public function ventasAnio(){
			if($_POST){
				$grafica = "Anio1";
				$anio = intval($_POST['anio']);
				$pagos = $this->model->VentasAnio($anio);
				$script = getFile("Template/Modals/graficas",$pagos);
				echo $script;
				die();
			}
		}
		public function ventasAnio2(){
			if($_POST){
				$grafica2 = "ventas2";
				$anio = intval($_POST['anio']);
				$pagos = $this->model->VentasManuales($anio);
				$script = getFile("Template/Modals/grafRManual",$pagos);
				echo $script;
				die();
			}
		}

		public function ventasShutters(){
			if($_POST){
				$grafica2 = "VshuttersAnio";
				$anio = intval($_POST['anio']);
				$pagos = $this->model->VentasShutters($anio);
				$script = getFile("Template/Modals/graficaShutter",$pagos);
				echo $script;
				die();
			}
		}


	}
 ?>