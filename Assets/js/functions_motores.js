let tableMotores;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
    tableMotores = $('#tableMotores').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Motores/getMotores",
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"codigo"},
            {"data":"tipo"},
            {"data":"precio"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    if(document.querySelector("#formMotores")){
    
        let formMotores = document.querySelector("#formMotores");
        formMotores.onsubmit = function(e) {
            e.preventDefault();
            // let strCodigo = document.querySelector('#txtCodigo').value;
            // let strMarca = document.querySelector('#marca').value;
            // let strNombre = document.querySelector('#txtNombre').value;
            // let strPrecio = document.querySelector('#txtPrecio').value;
            // let intStatus = document.querySelector('#listStatus').value;

            // if(strMarca == '' || strCodigo == '' || strNombre == '' || strPrecio || intStatus == '')
            // {
            //     swal("Atención", "Todos los campos son obligatorios." , "error");
            //     return false;
            // }
 
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Motores/setMotor'; 
            var formData = new FormData(formMotores);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);

                    if(objData.status){
                        $('#modalFormMotores').modal("hide");
                        formMotores.reset();
                        swal("Motores", objData.msg ,"success");
                        tableMotores.api().ajax.reload();

                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    fntBusqueda();
  
}, false);

function fntBusqueda(){
    if(document.querySelector('#marca')){
        let ajaxUrl = base_url+'/Motores/getSelectMotores';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#marca').innerHTML = request.responseText;
                $('#marca').selectpicker('render');
            }
        }
    }
}


// function fntViewCliente(idcliente){
//    var idcliente = idcliente;
//    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
//    let ajaxUrl = base_url+'/Motores/getMotor/'+idcliente;
//    request.open("GET",ajaxUrl,true);
//    request.send();
//    request.onreadystatechange = function(){
//        if(request.readyState == 4 && request.status == 200){
//            var objData = JSON.parse(request.responseText);

//            if(objData.status)
//            {
//               var estadoUsuario = objData.data.status == 1 ? 
//                '<span class="badge badge-success">Activo</span>' : 
//                '<span class="badge badge-danger">Inactivo</span>';

//                document.querySelector("#celIdentificacion").innerHTML = objData.data.no_cliente;
//                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
//                document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
//                document.querySelector("#celCiudad").innerHTML = objData.data.ciudad;
//                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
//                document.querySelector("#celEmail").innerHTML = objData.data.email;
//                document.querySelector("#celEstado").innerHTML = estadoUsuario;
//                $('#modalViewCliente').modal('show');
//            }else{
//                swal("Error", objData.msg , "error");
//            }
//        }
//    }
// }

function fntEditCliente(idcliente){
    // rowTable = element.parentNode.parentNode.parentNode; 
    document.querySelector('#titleModal').innerHTML ="Actualizar Datos";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

     var idcliente =idcliente;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Motores/getMotor/'+idcliente;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               document.querySelector("#idMotor").value = objData.data.ID_MOTOR;
               document.querySelector("#txtCodigo").value = objData.data.codigo;
            //    document.querySelector("#marca").value = objData.data.marca;
               document.querySelector("#marca").value = objData.data.marca;
               $('#marca').selectpicker('render');
               document.querySelector("#txtNombre").value = objData.data.tipo;
               document.querySelector("#txtPrecio").value = objData.data.precio;
                if(objData.data.status == 1){
                    document.querySelector("#listStatus").value = 1;
                }else{
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
        }
    
        $('#modalFormMotores').modal('show');
    }
}

function fntDelCliente(idcliente){
    var idcliente =idcliente;
    // idUsuario = idpersona;
   swal({
       title: "Eliminar",
       text: "¿Realmente quiere eliminar el elemento?",
       type: "warning",
       showCancelButton: true,
       confirmButtonText: "Si, eliminar!",
       cancelButtonText: "No, cancelar!",
       closeOnConfirm: false,
       closeOnCancel: true
   }, function(isConfirm) {
       
       if (isConfirm) 
       {
           let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
           let ajaxUrl = base_url+'/Motores/delMotor';
           let strData = "idMotor="+idcliente;
           request.open("POST",ajaxUrl,true);
           request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           request.send(strData);
           request.onreadystatechange = function(){
               if(request.readyState == 4 && request.status == 200){
                   let objData = JSON.parse(request.responseText);
                   if(objData.status)
                   {
                       swal("Eliminar!", objData.msg , "success");
                       tableMotores.api().ajax.reload();
                   }else{
                       swal("Atención!", objData.msg , "error");
                   }
               }
           }
       }

   });

}


function openModal()
{
    document.querySelector('#idMotor').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Motor";
    document.querySelector("#formMotores").reset();
    $('#modalFormMotores').modal('show');
}