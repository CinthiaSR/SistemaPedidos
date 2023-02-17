let tablePedidosArcos;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
tablePedidosArcos = $('#tablePedidosArcos').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Arcos/getPedidos",
        "dataSrc":""
    },
    "columns":[
        // {"data":"idpedido"},
        {"data":"cn"},
        {"data":"nombre"},
        // {"data":"cn"},
        {"data":"fecha"},
        {"data":"sucursal"},
        // {"data":"precioft2"},
        // {"data":"status"},
        {"data":"options"}
        
    ],       
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr":"Copiar",
            "className": "btn btn-secondary",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        },{
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar a Excel",
            "className": "btn btn-success",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        },{
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Exportar a PDF",
            "className": "btn btn-danger",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        },{
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr":"Exportar a CSV",
            "className": "btn btn-info",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        }
    ],
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});


    // if(document.querySelector("#formPedidoArcos")){
        let formPedidoArcos = document.querySelector("#formPedidoArcos");
        formPedidoArcos.onsubmit = function(e) {
            e.preventDefault();
            let strCN = document.querySelector('#cnroller').value;
            let strsucursal = document.querySelector('#suc_roller').value;
            let strvendedor = document.querySelector('#vend_roller').value;
            let strmedido = document.querySelector('#medid_roller').value;
            let strentrega = document.querySelector('#entre_roller').value;
            let strdate = document.querySelector('#date_roller').value;
            let intCliente = document.querySelector('#listClient').value;
            // let tipoPersiana = document.querySelector('#tipoPersiana').value;
            // let ft2= document.querySelector('#ft2').value;
            

            // let intStatus = document.querySelector('#listStatus').value;
            if(strCN == '' || strsucursal == '' || strvendedor == '' || strmedido == '' || strentrega== '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Arcos/setPedido'; 
            let formData = new FormData(formPedidoArcos);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormPedidoArcos').modal("hide");
                        formPedidoArcos.reset();
                        swal("Pedido Arcos", objData.msg ,"success");
                        
                        tablePedidosArcos.api().ajax.reload();
                    }

                    else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    // }
    fntCliente();
}, false);

// ----------------------------------------------
function openModal()
{
    document.querySelector('#idPedido').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Pedido";
    document.querySelector("#formPedidoArcos").reset();
    $('#modalFormPedidoArcos').modal('show')
}
// ***************************************************SELECT CLIENTE
function fntCliente(){
    if(document.querySelector('#listClient')){
        let ajaxUrl = base_url+'/Clientes/getSelectClientes';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listClient').innerHTML = request.responseText;
                $('#listClient').selectpicker('render');
            }
        }
    }
}

function fntEditPedido(idpedido){
    document.querySelector('#titleModal').innerHTML ="Actualizar datos";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

     var idcliente =idcliente;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Arcos/getPedido/'+idpedido;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               document.querySelector("#idPedido").value = objData.data.idpedido;
               document.querySelector("#cnroller").value = objData.data.cn;
               document.querySelector("#suc_roller").value = objData.data.sucursal;
               document.querySelector("#vend_roller").value = objData.data.vendedor;
               document.querySelector("#medid_roller").value = objData.data.medido;
               document.querySelector("#entre_roller").value = objData.data.entrega;
               document.querySelector("#date_roller").value = objData.data.fecha;
            //    document.querySelector("#ft2").value = objData.data.precioft2;
               document.querySelector("#listClient").value = objData.data.ID_CLIENTE;
               $('#listClient').selectpicker('render');
            }
        }
        $('#modalFormPedidoArcos').modal('show');
    }
}
// --------------------------------------------------

function fntDelPedido(idpedido){
    var idpedido = idpedido;
    swal({
        title: "Eliminar Persianas",
        text: "¿Realmente quiere eliminar el Pedido?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Arcos/delPedido/';
            var strData = "idpedido="+idpedido;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tablePedidosArcos.api().ajax.reload(function(){
                            // fntEditPedido();
                            // fntDelPedido();
                            // fntPermisos();
                        });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}

// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
