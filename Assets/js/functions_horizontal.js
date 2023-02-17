

function openModalRoller(){
    document.querySelector('#idHorizontal').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formHorizontal").reset();
    $('#modalFormHorizontal').modal('show')
}
let tableBlindshorizontales;
let rowTable1= "";
let divLoading1 = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
// tableBlindshorizontales = $('#tableBlindshorizontales').dataTable();
tableBlindshorizontales = $('#tableBlindshorizontales').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
 
});

    if(document.querySelector("#formHorizontal")){
        let formHorizontal = document.querySelector("#formHorizontal");
        formHorizontal.onsubmit = function(e) {
            e.preventDefault();
            let strCantidad = document.querySelector('#can_horizontal').value;
            let strLocalizacion = document.querySelector('#loc_horizontal').value;
            let strInstalacion = document.querySelector('#inst_horizontal').value;
            let strAncho = document.querySelector('#anc_horizontal').value;
            let strLargo = document.querySelector('#alt_horizontal').value;
            let strColor = document.querySelector('#col_horizontal').value;
            let strConfig= document.querySelector('#config_horizontal').value;
            let strCtrl= document.querySelector('#ctrl_horizontal').value;
          

            if(strCantidad == ''|| strLocalizacion == '' || strInstalacion == '' || strAncho == '' || strLargo == '' ||
            strColor==''|| strConfig=='')
            {
                swal("Atención", "Todos los campos son." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Horizontales/setHorizontal'; 
            var formData = new FormData(formHorizontal);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormHorizontal').modal("hide");
                        formHorizontal.reset();
                        swal("Persiana Horizontal", objData.msg ,"success");
                        // tableBlindshorizontales.api().ajax.reload();
                        $("#tableBlindshorizontales").load(" #tableBlindshorizontales");

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

// --------------------------------------------
function fntViewRoller(idhorizontal){
    var idhorizontal = idhorizontal;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Horizontales/getHorizontal/'+idhorizontal;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
            //    var estadoUsuario = objData.data.status == 1 ? 
                // '<span class="badge badge-success">Activo</span>' : 
                // '<span class="badge badge-danger">Inactivo</span>';
                // document.querySelector("#celID_roller").innerHTML = objData.data.codigo_enrrollable;
                document.querySelector("#celcantidad").innerHTML = objData.data.hor_cantidad;
                document.querySelector("#cellocalizacion").innerHTML = objData.data.hor_identificacion;
                document.querySelector("#celinstalacion").innerHTML = objData.data.hor_instalacion;
                document.querySelector("#celancho").innerHTML = objData.data.hor_ancho;
                document.querySelector("#celalto").innerHTML = objData.data.hor_largo;
                document.querySelector("#celEsc").innerHTML = objData.data.hor_t_escalera;
                document.querySelector("#celcolor").innerHTML = objData.data.hor_est_color;
                document.querySelector("#celconfiguracion").innerHTML = objData.data.hor_configuracion;
                document.querySelector("#celcbm").innerHTML = objData.data.hor_cbm;
                document.querySelector("#celelev").innerHTML = objData.data.hor_ele_id;
                document.querySelector("#celgal").innerHTML = objData.data.hor_galeriarim;
                document.querySelector("#celVal").innerHTML = objData.data.hor_norm;
                document.querySelector("#celBrack").innerHTML = objData.data.hor_holddown;
                document.querySelector("#celprecio").innerHTML = objData.data.hor_precio;
                document.querySelector("#celnota").innerHTML = objData.data.hor_nota;
                // document.querySelector("#celstatus").innerHTML = estadoUsuario;
                $('#modalViewHorizontal').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
 }
 
 function fntEditRoller(idroller){
     // rowTable = element.parentNode.parentNode.parentNode; 
     document.querySelector('#titleModal').innerHTML ="Actualizar Persiana";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idroller =idroller;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Horizontales/getHorizontal/'+ idroller;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idHorizontal').value=objData.data.ID_HORIZONTAL;
                // document.querySelector('#ID_horizontal').value=objData.data.codigo_enrrollable;
                document.querySelector('#can_horizontal').value=objData.data.hor_cantidad;                  
                document.querySelector('#loc_horizontal').value=objData.data.hor_identificacion;
                document.querySelector('#inst_horizontal').value=objData.data.hor_instalacion;
                document.querySelector('#anc_horizontal').value=objData.data.hor_ancho;
                document.querySelector('#alt_horizontal').value=objData.data.hor_largo;
                document.querySelector('#esc_horizontal').value=objData.data.hor_t_escalera;     
                document.querySelector('#col_horizontal').value=objData.data.hor_est_color;
                document.querySelector('#config_horizontal').value=objData.data.hor_configuracion;
                document.querySelector('#ctrl_horizontal').value=objData.data.hor_cbm;
                document.querySelector('#elev_horizontal').value=objData.data.hor_ele_id;
                document.querySelector('#gal_horizontal').value=objData.data.hor_galeriarim;
                document.querySelector('#val_horizontal').value=objData.data.hor_norm;
                document.querySelector('#brack_horizontal').value=objData.data.hor_holddown;
                document.querySelector('#precioLista').value=objData.data.hor_preciolista;
                document.querySelector('#precio_unitario').value=objData.data.hor_preciounit;
                document.querySelector('#precio_total').value=objData.data.hor_precio;
                document.querySelector('#nota').value=objData.data.hor_nota;
             }
         }
     
         $('#modalFormHorizontal').modal('show');
     }
 }
 
 function fntDelRoller(idroller){
    var idroller =idroller;
    swal({
        title: "Eliminar Horizontal",
        text: "¿Realmente quiere eliminar la persiana?",
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
            let ajaxUrl = base_url+'/Horizontales/delHorizontal';
            let strData = "idHorizontal="+idroller;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        // tableBlindshorizontales.api().ajax.reload();
                        $("#tableBlindshorizontales").load(" #tableBlindshorizontales");
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
    if (document.formPrice.txtdescuento.value.length==0){
        //    alert("Tiene que escribir su nombre");
        swal("Atención", "Todos los campos son requeridos" , "error");
           document.formPrice.txtdescuento.focus()
           return 0;
    }
        var form = document.querySelector("#formPrice");
        var request = (window.XMLHttpRequest) ? 
        new XMLHttpRequest() : 
        new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Horizontales/precio'; 
        var formData = new FormData(form);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
        var objData = JSON.parse(request.responseText);
        if(objData.status){
        // $('#modalFormHorizontal').modal("hide");
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
    var ajaxUrl = base_url+'/Horizontales/getPrecio';
    var formData = new FormData(form);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
            // $('#modalFormHorizontal').modal("hide");
            // form.reset();
            swal("Precios", objData.msg ,"success");
            
            }else{
            swal("Error", objData.msg, "error");
            }
            }
            return false;
    }


}







// function detail_price(idpedido){
//     if(document.querySelector("#formPrice")){
//         let formPrice = document.querySelector("#formPrice");
//         formPrice.onsubmit = function(e) {
//             e.preventDefault();
//             let strPercenDescINP = document.querySelector('#txtdescuento').value;
//             let strDescuento = document.querySelector('#txtDesc').value;
//             let strSubtotal = document.querySelector('#txtSubtotal').value;
//             let strInstalacionINP = document.querySelector('#txtInstall').value;
//             let strTotal = document.querySelector('#txtTotal').value;
//             let strAnticipoINP = document.querySelector('#txtAnticipo').value;
//             let strSaldo = document.querySelector('#txtSaldo').value;
                    

//             if(strPercenDescINP == '' || strInstalacionINP == '' || strAnticipoINP== '')
//             {
//                 swal("Atención", "Todos los campos son." , "error");
//                 return false;
//             }
//             divLoading1.style.display = "flex";
//             var request = (window.XMLHttpRequest) ? 
//                           new XMLHttpRequest() : 
//                           new ActiveXObject('Microsoft.XMLHTTP');
//             var ajaxUrl = base_url+'/Horizontales/setRoller'; 
//             var formData = new FormData(formHorizontal);
//             request.open("POST",ajaxUrl,true);
//             request.send(formData);
//             request.onreadystatechange = function(){
//                 if(request.readyState == 4 && request.status == 200){
//                     var objData = JSON.parse(request.responseText);
//                     if(objData.status){
//                         $('#modalFormHorizontal').modal("hide");
//                         formHorizontal.reset();
//                         swal("Roller", objData.msg ,"success");
//                         // tableBlindshorizontales.api().ajax.reload();
//                         $("#tableBlindshorizontales").load(" #tableBlindshorizontales");

//                     }else{
//                         swal("Error", objData.msg, "error");
//                     }
//                 }
//                 divLoading1.style.display = "none";
//                 return false;
//             }
//         }
//     }
// }

function calculate(){
    var preciolista = document.querySelector('#precioLista').value;
    var unidades = document.querySelector('#can_horizontal').value;

    $(".monto").each(function() {
        if (isNaN(unidades) || isNaN(preciolista)) {  
            text1=0;
          } else {
                    suma3=parseFloat(preciolista);
                    text1=suma3 
        }
        $('#precio_unitario').val(parseFloat(text1));	
	});
    if(text1==0) {

           resultado1=text1*parseFloat(unidades); 
           text2= 0; 
            
         
        } else{
            resultado1=text1*parseFloat(unidades); 
            text2= resultado1; 
        }
        $('#precio_total').val(parseFloat(text2));

}


function calculateTotal(){
    var subtotal= document.querySelector('#txtImporte').value;
    var porcentaje = document.querySelector('#txtdescuento').value;
    var impuesto = document.querySelector('#txtimpuesto').value;
    var instalar= document.querySelector('#txtInstall').value;
    var anticipo= document.querySelector('#txtAnticipo').value;
    var desc= document.querySelector('#txtDesc').value;

	var totalAmount = 0; 
    text1=0;
    text2=0
    text3=0
    text4=0
	$(".monto").each(function() {
        if (isNaN(subtotal) || isNaN(porcentaje)) {  
            text1=0;
            text2=0;
          } else {  
            resultado=(parseFloat(subtotal)*parseFloat(porcentaje))/100; 
            text1= resultado;            
        }
        $('#txtDesc').val(parseFloat(text1));	

	});

	if(subtotal) {
        if(isNaN(text1)){
            text2+=0;
        }else{
            resultado1=(parseFloat(subtotal)-parseFloat(text1)); 
            text2= resultado1; 
        }
        // document.getElementById("txtSubtotal").innerHTML = text2; 
        $('#txtSubtotal').val(parseFloat(text2));	
	}


    if(text2) {
        if(isNaN(text2) || isNaN(instalar)){
            text3+=0;
        }else if (impuesto!=0){
            resultado3=(parseFloat(text2)+parseFloat(instalar)); 
            text3= resultado3;
            resultado4=(parseFloat(text3)*parseFloat(impuesto))/100; 
            text4= resultado4;                    
            $('#txtImp').val(parseFloat(text4));
            resultado5=(parseFloat(resultado3)+parseFloat(resultado4)); 
            text5= resultado5;              
        } else{
            $('#txtImp').val(parseFloat(text4));
            resultado5=(parseFloat(text2)+parseFloat(instalar)); 
            text5= resultado5;
        }
        $('#txtTotal').val(parseFloat(text5));
	}
    if(anticipo!=0 ) {
            resultado6=(parseFloat(text5)-parseFloat(anticipo)); 
            text6= resultado6; 
        }else if(anticipo==0){
            // resultado7=(parseFloat(text2)+parseFloat(instalar)); 
            text6=resultado5;
        }
        $('#txtSaldo').val(parseFloat(text6));
}

 


 



