var tableFormatos;
var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

	tableFormatos = $('#tableFormatos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Formatos/getFormatos",
            "dataSrc":""
        },
        "columns":[
            {"data":"ID_FORMATO"},
            {"data":"nombre"},
            {"data":"archivo"},
            {"data":"status"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    //NUEVO ROL
    var formRol = document.querySelector("#formFormato");
    formRol.onsubmit = function(e) {
        e.preventDefault();

        var intIdRol = document.querySelector('#idFormato').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strArchivo = document.querySelector('#txtArchivo').value;
        var intStatus = document.querySelector('#listStatus').value;        
        if(strNombre == '' || strArchivo == '' || intStatus == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Formatos/setFormato'; 
        var formData = new FormData(formRol);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalFormFormato').modal("hide");
                    formRol.reset();
                    swal("Formatos", objData.msg ,"success");
                    tableFormatos.api().ajax.reload();
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
            divLoading.style.display = "none";
            return false;
        }

        
    }

});

$('#tableFormatos').DataTable();

function openModal(){

    document.querySelector('#idFormato').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo ";
    document.querySelector("#formFormato").reset();
	$('#modalFormFormato').modal('show');
}

window.addEventListener('load', function() {
    /*fntEditRol();
    fntDelRol();
    fntPermisos();*/
}, false);


function fntViewFormato(idformato){
    var idformato = idformato;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Formatos/getFormato/'+idformato;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
 
            if(objData.status)
            {
               var estadoUsuario = objData.data.status == 1 ? 
                '<span class="badge badge-success">Vigente</span>' : 
                '<span class="badge badge-danger">Sin actualizar</span>';
 
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celArchivo").innerHTML = objData.data.archivo;
                document.querySelector("#filePDF").innerHTML = objData.data.ruta;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;

                $('#modalViewFormato').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
 }
 
 function fntEditFormato(idformato){
     document.querySelector('#titleModal').innerHTML ="Actualizar Formato";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idformato =idformato;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Formatos/getFormato/'+idformato;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {
                document.querySelector("#idFormato").value = objData.data.ID_FORMATO;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#txtArchivo").value = objData.data.archivo;
                document.querySelector("#file").value = objData.data.ruta;
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
     
         $('#modalFormFormato').modal('show');
     }
 }
 
 function fntDelFormato(idformato){
     var idformato =idformato;
     // idUsuario = idpersona;
    swal({
        title: "Eliminar Formato",
        text: "¿Realmente quiere eliminar este registro?",
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
            let ajaxUrl = base_url+'/Formatos/delFormato';
            let strData = "idFormato="+idformato;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableFormatos.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }
 
    });
 
 }
 

