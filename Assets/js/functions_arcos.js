// let tablePedidosArcos;
// let rowTable = "";
// let divLoading = document.querySelector("#divLoading");
// document.addEventListener('DOMContentLoaded', function(){
// tablePedidosArcos = $('#tablePedidosArcos').dataTable( {
//     "aProcessing":true,
//     "aServerSide":true,
//     "language": {
//         "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
//     },
//     "ajax":{
//         "url": " "+base_url+"/Arcos/getPedidos",
//         "dataSrc":""
//     },
//     "columns":[
//         // {"data":"idpedido"},
//         {"data":"cn"},
//         {"data":"nombre"},
//         // {"data":"cn"},
//         {"data":"fecha"},
//         {"data":"sucursal"},
//         // {"data":"precioft2"},
//         // {"data":"status"},
//         {"data":"options"}
        
//     ],       
//     'dom': 'lBfrtip',
//     'buttons': [
//         {
//             "extend": "copyHtml5",
//             "text": "<i class='far fa-copy'></i> Copiar",
//             "titleAttr":"Copiar",
//             "className": "btn btn-secondary",
//             "exportOptions": { 
//                 "columns": [ 0, 1, 2, 3, 4, 5] 
//             }
//         },{
//             "extend": "excelHtml5",
//             "text": "<i class='fas fa-file-excel'></i> Excel",
//             "titleAttr":"Exportar a Excel",
//             "className": "btn btn-success",
//             "exportOptions": { 
//                 "columns": [ 0, 1, 2, 3, 4, 5] 
//             }
//         },{
//             "extend": "pdfHtml5",
//             "text": "<i class='fas fa-file-pdf'></i> PDF",
//             "titleAttr":"Exportar a PDF",
//             "className": "btn btn-danger",
//             "exportOptions": { 
//                 "columns": [ 0, 1, 2, 3, 4, 5] 
//             }
//         },{
//             "extend": "csvHtml5",
//             "text": "<i class='fas fa-file-csv'></i> CSV",
//             "titleAttr":"Exportar a CSV",
//             "className": "btn btn-info",
//             "exportOptions": { 
//                 "columns": [ 0, 1, 2, 3, 4, 5] 
//             }
//         }
//     ],
//     "resonsieve":"true",
//     "bDestroy": true,
//     "iDisplayLength": 10,
//     "order":[[0,"desc"]]  
// });


//     // if(document.querySelector("#formPedidoArcos")){
//         let formPedidoArcos = document.querySelector("#formPedidoArcos");
//         formPedidoArcos.onsubmit = function(e) {
//             e.preventDefault();
//             let strCN = document.querySelector('#cnroller').value;
//             let strsucursal = document.querySelector('#suc_roller').value;
//             let strvendedor = document.querySelector('#vend_roller').value;
//             let strmedido = document.querySelector('#medid_roller').value;
//             let strentrega = document.querySelector('#entre_roller').value;
//             let strdate = document.querySelector('#date_roller').value;
//             let intCliente = document.querySelector('#listClient').value;
//             // let tipoPersiana = document.querySelector('#tipoPersiana').value;
//             // let ft2= document.querySelector('#ft2').value;
            

//             // let intStatus = document.querySelector('#listStatus').value;
//             if(strCN == '' || strsucursal == '' || strvendedor == '' || strmedido == '' || strentrega== '')
//             {
//                 swal("Atención", "Todos los campos son obligatorios." , "error");
//                 return false;
//             }
//             divLoading.style.display = "flex";
//             let request = (window.XMLHttpRequest) ? 
//                             new XMLHttpRequest() : 
//                             new ActiveXObject('Microsoft.XMLHTTP');
//             let ajaxUrl = base_url+'/Arcos/setPedido'; 
//             let formData = new FormData(formPedidoArcos);
//             request.open("POST",ajaxUrl,true);
//             request.send(formData);
//             request.onreadystatechange = function(){
//                 if(request.readyState == 4 && request.status == 200){
//                     let objData = JSON.parse(request.responseText);
//                     if(objData.status){
//                         $('#modalFormPedidoArcos').modal("hide");
//                         formPedidoArcos.reset();
//                         swal("Pedido Arcos", objData.msg ,"success");
                        
//                         tablePedidosArcos.api().ajax.reload();
//                     }

//                     else{
//                         swal("Error", objData.msg , "error");
//                     }
//                 }
//                 divLoading.style.display = "none";
//                 return false;
//             }
//         }
//     // }
//     fntCliente();
// }, false);

// // ----------------------------------------------
// function openModal()
// {
//     document.querySelector('#idPedido').value ="";
//     document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
//     document.querySelector('#btnText').innerHTML ="Guardar";
//     document.querySelector('#titleModal').innerHTML = "Nuevo Pedido";
//     document.querySelector("#formPedidoArcos").reset();
//     $('#modalFormPedidoArcos').modal('show')
// }
// // ***************************************************SELECT CLIENTE
// function fntCliente(){
//     if(document.querySelector('#listClient')){
//         let ajaxUrl = base_url+'/Clientes/getSelectClientes';
//         let request = (window.XMLHttpRequest) ? 
//                     new XMLHttpRequest() : 
//                     new ActiveXObject('Microsoft.XMLHTTP');
//         request.open("GET",ajaxUrl,true);
//         request.send();
//         request.onreadystatechange = function(){
//             if(request.readyState == 4 && request.status == 200){
//                 document.querySelector('#listClient').innerHTML = request.responseText;
//                 $('#listClient').selectpicker('render');
//             }
//         }
//     }
// }

// function fntEditPedido(idpedido){
//     document.querySelector('#titleModal').innerHTML ="Actualizar datos";
//     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
//     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
//     document.querySelector('#btnText').innerHTML ="Actualizar";

//      var idcliente =idcliente;
//     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
//     var ajaxUrl = base_url+'/Arcos/getPedido/'+idpedido;
//     request.open("GET",ajaxUrl,true);
//     request.send();
//     request.onreadystatechange = function(){

//         if(request.readyState == 4 && request.status == 200){
//             let objData = JSON.parse(request.responseText);

//             if(objData.status)
//             {
//                 document.querySelector("#idPedido").value = objData.data.idpedido;
//                 document.querySelector("#cnroller").value = objData.data.cn;
//                 document.querySelector("#suc_roller").value = objData.data.sucursal;
//                 document.querySelector("#vend_roller").value = objData.data.vendedor;
//                 document.querySelector("#medid_roller").value = objData.data.medido;
//                 document.querySelector("#entre_roller").value = objData.data.entrega;
//                 document.querySelector("#date_roller").value = objData.data.fecha;
//             //    document.querySelector("#ft2").value = objData.data.precioft2;
//                 document.querySelector("#listClient").value = objData.data.ID_CLIENTE;
//                 $('#listClient').selectpicker('render');
//             }
//         }
//         $('#modalFormPedidoArcos').modal('show');
//     }
// }
// // --------------------------------------------------

// function fntDelPedido(idpedido){
//     var idpedido = idpedido;
//     swal({
//         title: "Eliminar Persianas",
//         text: "¿Realmente quiere eliminar el Pedido?",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Si, eliminar!",
//         cancelButtonText: "No, cancelar!",
//         closeOnConfirm: false,
//         closeOnCancel: true
//     }, function(isConfirm) {
        
//         if (isConfirm) 
//         {
//             var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
//             var ajaxUrl = base_url+'/Arcos/delPedido/';
//             var strData = "idpedido="+idpedido;
//             request.open("POST",ajaxUrl,true);
//             request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//             request.send(strData);
//             request.onreadystatechange = function(){
//                 if(request.readyState == 4 && request.status == 200){
//                     var objData = JSON.parse(request.responseText);
//                     if(objData.status)
//                     {
//                         swal("Eliminar!", objData.msg , "success");
//                         tablePedidosArcos.api().ajax.reload(function(){
//                             // fntEditPedido();
//                             // fntDelPedido();
//                             // fntPermisos();
//                         });
//                     }else{
//                         swal("Atención!", objData.msg , "error");
//                     }
//                 }
//             }
//         }

//     });
// }

function openModalArcos(){
    document.querySelector('#idArcos').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formArcos").reset();
    $('#modalFormArcos').modal('show')
}
let tableArcos;
let rowTable1= "";
let divLoading1 = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
tableArcos = $('#tableArcos').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
 
});


// -----------------------------------
    if(document.querySelector("#formArcos")){
        let formArcos = document.querySelector("#formArcos");
        formArcos.onsubmit = function(e) {
            e.preventDefault();
            let strIden = document.querySelector('#Iden').value;
            let strAncho = document.querySelector('#base').value;
            let strAlto = document.querySelector('#altura').value;
            let strColor = document.querySelector('#color').value;
            let strConfig = document.querySelector('#config').value;
            let strMarco = document.querySelector('#marco').value;
            let strTft2 = document.querySelector('#Tft2').value;
            let strPrecio = document.querySelector('#precio').value;
          

            if(strIden == '' || strAncho == '' || strAlto == '' || strColor == '' || strConfig == '' || strMarco == ''|| strTft2 == '')
            {
                swal("Atención", "Todos los campos son requeridos." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Arcos/setArcos'; 
            var formData = new FormData(formArcos);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormArcos').modal("hide");
                        formArcos.reset();
                        swal("Arcos", objData.msg ,"success");
                        $("#tableArcos").load(" #tableArcos");

                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading1.style.display = "none";
                return false;
            }
        }
    }
     
}, false);
// .........................................................Tipo de marco



function calculate(){
    var ancho= document.querySelector('#base').value;
    var alto = document.querySelector('#altura').value;
    var Med = document.querySelector('#marco').value;

    var Config= document.querySelector('#config').value;
    // var inst = document.querySelector('#inst_shutters').value;
    // var precioxft2 = document.querySelector('#idprecio').value;
    var preciolista = document.querySelector('#precio').value;
    var unidades = document.querySelector('#unidades').value;
   

    text1=0;
	$(".monto").each(function() {
        if (isNaN(ancho) || isNaN(alto)) {  
            text1=0;
          } else if (Config=="Shutter Regular" || Config=="Shutter Irregular"){ 
                if((Med=="Z-Standar" || Med=="Z-Redondo" )) {
                          marco=2;
                          num1=parseFloat(ancho); 
                          num2=parseFloat(alto);
                          suma1=num1+marco;
                          suma2=num2+marco;
                          resultado=(parseFloat(suma1)*parseFloat(suma2))/144; 
                          text1= resultado;
                        }
                          else if(Med=="Z-Delux"){
                              marco=3;
                              num1=parseFloat(ancho); 
                              num2=parseFloat(alto);
                              suma1=num1+marco;
                              suma2=num2+marco;
                              resultado=(parseFloat(suma1)*parseFloat(suma2))/144; 
                              text1= resultado;
                          }
                          else if(Med=="L-Standar"){
                              marco=4;
                              num1=parseFloat(ancho); 
                              num2=parseFloat(alto);
                              suma1=num1+marco;
                              suma2=num2+marco;
                              resultado=(parseFloat(suma1)*parseFloat(suma2))/144; 
                              text1= resultado;
                          }
                          else if(Med=="Otro" || ancho==0 ){
                              suma3=precio;
                              text1=suma3 
                          }
            } else if(Config=='Horizontal 2" Arriba' || Config=='Horizontal 2" Abajo'|| Config=='Sunburst 2" Perfecto' || Config=='Sunburst 2" Tipo Ceja'){
                            resultado1=precio; 
                            text1= 0; 
            }
        $('#Tft2').val(parseFloat(text1));	
	});
    if(text1!=0) {
        // if(isNaN(text1) || isNaN(preciolista)|| isNaN(unidades)){
        //     text2+=0;
        // }else if(text1!=0){
            resultado1=(parseFloat(text1)*parseFloat(preciolista)); 
            text2= resultado1; 
            resultado2=(parseFloat(resultado1)*parseFloat(unidades));
            text3=resultado2;
        }else if(text1==0){
            resultado3=(parseFloat(preciolista)*parseFloat(unidades));
            text3=resultado3;            
        }
        // $('#precio').val(parseFloat(text2));
        $('#precio_total').val(parseFloat(text3));
	}



 
 function fntEditShutter(idshutter){
     // rowTable = element.parentNode.parentNode.parentNode; 
     document.querySelector('#titleModal').innerHTML ="Actualizar Persiana";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idshutter =idshutter;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Arcos/getArco/'+ idshutter;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idArcos').value=objData.data.ID_ARCOS;
                document.querySelector('#unidades').value=objData.data.cantidad_arcos;
                document.querySelector('#Iden').value=objData.data.arcos_identificacion;
                document.querySelector('#Inst').value=objData.data.arcos_instalacion;                  
                document.querySelector('#base').value=objData.data.arcos_base;
                document.querySelector('#altura').value=objData.data.arcos_altura;
                document.querySelector('#color').value=objData.data.arcos_color;     
                document.querySelector('#config').value=objData.data.arcos_tipoconfiguracion;
                document.querySelector('#marco').value=objData.data.arcos_tipomarco;
                document.querySelector('#Tft2').value=objData.data.arcos_totalf2;
                document.querySelector('#precio').value=objData.data.arcos_preciounit;
                document.querySelector('#precio_total').value=objData.data.arcos_preciototal;
                document.querySelector('#nota').value=objData.data.arcos_nota;
                document.querySelector('#plant').value=objData.data.arcos_plant;
            }
         }
     
         $('#modalFormArcos').modal('show');
     }
 }
 
 function fntDelShutter(idroller){
    var idroller =idroller;
    swal({
        title: "Eliminar Arcor",
        text: "¿Realmente quiere eliminar este elemento?",
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
            let ajaxUrl = base_url+'/Arcos/delArco';
            let strData = "idArcos="+idroller;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        $("#tableArcos").load(" #tableArcos");
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }
 
    });
 
 }


//  -----------------------------------------------------------------------PRECIO-----------------------------------------

function valida_envia(){                                                  //SAVE
    //valido el nombre
    if (document.formPrice.txtImporte.value.length==0){
        //    alert("Tiene que escribir su nombre");
        swal("Atención", "Todos los campos son requeridos" , "error");
           document.formPrice.txtImporte.focus()
           return 0;
    }
        var form = document.querySelector("#formPrice");
        var request = (window.XMLHttpRequest) ? 
        new XMLHttpRequest() : 
        new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Arcos/precio'; 
        var formData = new FormData(form);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
        var objData = JSON.parse(request.responseText);
        if(objData.status){
        // $('#modalFormArcos').modal("hide");
        // form.reset();
        swal("Precios", objData.msg ,"success");
        
        }else{
        swal("Error", objData.msg, "error");
        }
        }
        return false;
        }
}


function editar(idprecio){                                   //EDIT
    var idprecio=idprecio;
    var form = document.querySelector("#formPrice");
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Arcos/getPrecio';
    var formData = new FormData(form);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
            // $('#modalFormArcos').modal("hide");
            // form.reset();
            swal("Precios", objData.msg ,"success");
            
            }else{
            swal("Error", objData.msg, "error");
            }
            }
            return false;
    }
}

function del(idprecio){
    var idprecio =idprecio;
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Arcos/delprecio';
            let strData = "id="+idprecio;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        $("#formPrice").load(" #formPrice");
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            } 
 }



 function calculateTotal(){
    var subtotal= document.querySelector('#txtImporte').value;
    var instalar= document.querySelector('#txtInstall').value;
    var anticipo= document.querySelector('#txtAnticipo').value;
    var impuesto = document.querySelector('#txtimpuesto').value;

	var totalAmount = 0; 
    text1=0;
    text2=0
    text3=0
    text4=0
    if(subtotal) {
        if(isNaN(subtotal) || isNaN(instalar)){
            text3+=0;

        }else{
            resultado3=(parseFloat(subtotal)+parseFloat(instalar)); 
             text3= resultado3;
                if(text3!=0) {
                     resultado4=(parseFloat(text3)*parseFloat(impuesto))/100; 
                     text4= resultado4; 
                }
                   $('#txtImp').val(parseFloat(text4));
        //          if(impuesto!=0) {
        //              resultado4=(parseFloat(text3)*parseFloat(impuesto))/100; 
        //              text4= resultado4; 
        //           }
        //           $('#txtImp').val(parseFloat(text4));
            resultado5=(parseFloat(resultado3)+parseFloat(resultado4)); 
            text5= resultado5;              
        // }
        // else if(impuesto==0){
        //           if(impuesto==0) {
        //              text4= 0; 
        //           }
        //           $('#txtImp').val(parseFloat(text4));
        //     resultado5=(parseFloat(text2)+parseFloat(instalar)); 
        //     text5= resultado5;

        }
        // document.getElementById("txtTotal").innerHTML = text3; 
        $('#txtTotal').val(parseFloat(text5));

	}
	 
	
    if(text5!=0) {
            resultado6=(parseFloat(text5)-parseFloat(anticipo)); 
            text6= resultado6; 
        }else{
             resultado7=(parseFloat(resultado3)+parseFloat(resultado4)); 
             text6=resultado7;
        }
        $('#txtSaldo').val(parseFloat(text6));

}
 


 



