let tableClientes;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableClientes = $('#tableClientes').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Clientes/getClientes",
            "dataSrc":""
        },
        "columns":[
            {"data":"no_cliente"},
            {"data":"nombre"},
            {"data":"direccion"},
            {"data":"ciudad"},
            {"data":"telefono"},
            {"data":"email"},
            {"data":"status"},
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

    if(document.querySelector("#formCliente")){
        let formCliente = document.querySelector("#formCliente");
        formCliente.onsubmit = function(e) {
            e.preventDefault();
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strDireccion = document.querySelector('#txtDireccion').value;
            let strCiudad = document.querySelector('#txtCiudad').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let intStatus = document.querySelector('#listStatus').value;

            if(strIdentificacion == '' || strDireccion == '' || strNombre == '' || strEmail == '' || intTelefono == '' || strCiudad == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Clientes/setCliente'; 
            var formData = new FormData(formCliente);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);

                    if(objData.status){
                        $('#modalFormCliente').modal("hide");
                        formCliente.reset();
                        swal("Clientes", objData.msg ,"success");
                        tableClientes.api().ajax.reload();

                    }else{
                        swal("Error", objData.msg, "error");
                    }
                    // if(objData.status)
                    // {
                    //     if(rowTable == ""){
                    //         tableUsuarios.api().ajax.reload();
                    //     }else{
                    //         htmlStatus = intStatus == 1 ? 
                    //         '<span class="badge badge-success">Activo</span>' : 
                    //         '<span class="badge badge-danger">Inactivo</span>';
                    //         rowTable.cells[1].textContent = strNombre;
                    //         rowTable.cells[2].textContent = strApellido;
                    //         rowTable.cells[3].textContent = strEmail;
                    //         rowTable.cells[4].textContent = intTelefono;
                    //         rowTable.cells[5].textContent = document.querySelector("#listRolid").selectedOptions[0].text;
                    //         rowTable.cells[6].innerHTML = htmlStatus;
                    //         rowTable="";
                    //     }
                    //     $('#modalFormUsuario').modal("hide");
                    //     formUsuario.reset();
                    //     swal("Usuarios", objData.msg ,"success");
                    // }else{
                    //     swal("Error", objData.msg , "error");
                    // }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
  
}, false);


function fntViewCliente(idcliente){
   var idcliente = idcliente;
   let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
   let ajaxUrl = base_url+'/Clientes/getCliente/'+idcliente;
   request.open("GET",ajaxUrl,true);
   request.send();
   request.onreadystatechange = function(){
       if(request.readyState == 4 && request.status == 200){
           var objData = JSON.parse(request.responseText);

           if(objData.status)
           {
              var estadoUsuario = objData.data.status == 1 ? 
               '<span class="badge badge-success">Activo</span>' : 
               '<span class="badge badge-danger">Inactivo</span>';

               document.querySelector("#celIdentificacion").innerHTML = objData.data.no_cliente;
               document.querySelector("#celNombre").innerHTML = objData.data.nombre;
               document.querySelector("#celDireccion").innerHTML = objData.data.direccion;
               document.querySelector("#celCiudad").innerHTML = objData.data.ciudad;
               document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
               document.querySelector("#celEmail").innerHTML = objData.data.email;
               document.querySelector("#celEstado").innerHTML = estadoUsuario;
               $('#modalViewCliente').modal('show');
           }else{
               swal("Error", objData.msg , "error");
           }
       }
   }
}

function fntEditCliente(idcliente){
    // rowTable = element.parentNode.parentNode.parentNode; 
    document.querySelector('#titleModal').innerHTML ="Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

     var idcliente =idcliente;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Clientes/getCliente/'+idcliente;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               document.querySelector("#idCliente").value = objData.data.ID_CLIENTE;
               document.querySelector("#txtIdentificacion").value = objData.data.no_cliente;
               document.querySelector("#txtNombre").value = objData.data.nombre;
               document.querySelector("#txtDireccion").value = objData.data.direccion;
               document.querySelector("#txtCiudad").value = objData.data.ciudad;
               document.querySelector("#txtTelefono").value = objData.data.telefono;
               document.querySelector("#txtEmail").value = objData.data.email;
            //    document.querySelector("#celEstado").value = estadoUsuario;
                // $('#listRolid').selectpicker('render');

                if(objData.data.status == 1){
                    document.querySelector("#listStatus").value = 1;
                }else{
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
        }
    
        $('#modalFormCliente').modal('show');
    }
}

function fntDelCliente(idcliente){
    var idcliente =idcliente;
    // idUsuario = idpersona;
   swal({
       title: "Eliminar Cliente",
       text: "¿Realmente quiere eliminar el Cliente?",
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
           let ajaxUrl = base_url+'/Clientes/delCliente';
           let strData = "idCliente="+idcliente;
           request.open("POST",ajaxUrl,true);
           request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           request.send(strData);
           request.onreadystatechange = function(){
               if(request.readyState == 4 && request.status == 200){
                   let objData = JSON.parse(request.responseText);
                   if(objData.status)
                   {
                       swal("Eliminar!", objData.msg , "success");
                       tableClientes.api().ajax.reload();
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
    document.querySelector('#idCliente').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector("#formCliente").reset();
    $('#modalFormCliente').modal('show');
}