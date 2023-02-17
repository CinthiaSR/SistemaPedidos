<?php 

class Formatos extends Controllers{
    public function __construct()
    {
        parent::__construct();
        session_start();
        // session_regenerate_id(true);
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/login');
        }
        getPermisos(2);
    }

    public function Formatos()
    {
        if(empty($_SESSION['permisosMod']['r'])){
            header("Location:".base_url().'/dashboard');
        }
        $data['page_tag'] = "Formatos";
        $data['page_title'] = "FORMATOS";
        $data['page_name'] = "formatos";
        $data['page_functions_js'] = "functions_formatos.js";
        $this->views->getView($this,"formatos",$data);
    }
    
    public function getFormatos()
    {
        if($_SESSION['permisosMod']['r']){
            $arrData = $this->model->selectFormatos();
            for ($i=0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';
                
                if($arrData[$i]['status'] == 1)
                {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Vigente</span>';
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Sin actualizar</span>';
                }
                
                if($_SESSION['permisosMod']['r']){
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewFormato('.$arrData[$i]['ID_FORMATO'].')" title="Ver detalles"><i class="far fa-eye"></i></button>
                    <a title="Generar PDF" href="'.base_url().'/factura/generarFactura/'.$arrData[$i]['ID_FORMATO'].'" target="_blanck" class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i> </a>
                    ';
                    
                }
                if($_SESSION['permisosMod']['u']){
                    // if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
                    // 	($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) ){
                        $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditFormato('.$arrData[$i]['ID_FORMATO'].')" title="Editar formato"><i class="fas fa-pencil-alt"></i></button>';
                        // }else{
                            // 	$btnEdit = '<button class="btn btn-secondary btn-sm" disabled ><i class="fas fa-pencil-alt"></i></button>';
                            // }
                        }
                        if($_SESSION['permisosMod']['d']){
                            // if(($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) ||
                            // 	($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and
                            // 	($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'] )
                            // 	 ){
                                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelFormato('.$arrData[$i]['ID_FORMATO'].')" title="Eliminar formato"><i class="far fa-trash-alt"></i></button>';
                                // }else{
                                    // 	$btnDelete = '<button class="btn btn-secondary btn-sm" disabled ><i class="far fa-trash-alt"></i></button>';
                                    // }
                }
                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    
    public function getFormato($idformato){
        if($_SESSION['permisosMod']['r']){
            $idformato = intval($idformato);
            if($idformato > 0)
            {
                $arrData = $this->model->selectFormato($idformato);
                if(empty($arrData))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
    
    public function setFormato(){
        if($_POST){			
            if(empty($_POST['txtNombre'] || empty($_POST['txtArchivo']) || empty($_POST['listStatus'])))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{ 
                $idFormato = intval($_POST['idFormato']);
                $strNombre = ucwords(strClean($_POST['txtNombre']));
                $strArhivo = ucwords(strClean($_POST['txtArchivo']));
                $intStatus = intval(strClean($_POST['listStatus']));
                $file_name = $_FILES['file']['tmp_name'];

                $ruta=media();"/images/PDFS/";
                $nombrefinal=trim($_FILES['file']['name']);
                $PDFS=$ruta . $nombrefinal;

                $request_user = "";
                if ($idFormato == 0)
                {
                    if(move_uploaded_file($_FILES['file']['name'], $PDFS))

                    $option = 1;
                    if($_SESSION['permisosMod']['w']){
                        $request_user = $this->model->insertFormato($strNombre, 
                                                                    $strArhivo,
                                                                    $file_name, 
                                                                    $intStatus );
                    }
                }else{
                    $option = 2;
                    if($_SESSION['permisosMod']['u']){
                        $request_user = $this->model->updateFormato($idFormato,
                                                                    $strNombre, 
                                                                    $strArhivo,
                                                                    $file_name, 
                                                                    $intStatus );
                    }
    
                }
    
                if($request_user > 0 )
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                }else if($request_user == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function delFormato()
    {
        if($_POST){
            if($_SESSION['permisosMod']['d']){
                $intIdpersona = intval($_POST['idFormato']);
                $requestDelete = $this->model->deleteFormato($intIdpersona);
                if($requestDelete)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
    
    
}
?>