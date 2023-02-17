<?php 

class Perfil extends Controllers{
	// use TTipoPago;
	public function __construct()
	{
		parent::__construct();
		session_start();
// 		session_regenerate_id(true);
		if(empty($_SESSION['login']))
		{
			header('Location: '.base_url().'/login');
			die();
		}
		getPermisos(3);
	}

	public function Perfil(){
		if(empty($_SESSION['permisosMod']['r'])){
			header("Location:".base_url().'/dashboard');
		}
		$data['page_tag'] = "Perfil";
		$data['page_title'] = "Perfil <small>Pedidos</small>";
		$data['page_name'] = "Perfil";
		$data['page_functions_js'] = "functions_rollers.js";
		$this->views->getView($this,"perfil",$data);
	}
	

}
 ?>