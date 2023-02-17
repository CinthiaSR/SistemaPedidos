// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


function openModalRomana(){
    document.querySelector('#idRomana').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formRomana").reset();
    $('#modalFormRomana').modal('show')
}
let tableBlindsRomana;
let rowTable1= "";
let divLoading1 = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
// tableBlindsRomana = $('#tableBlindsRomana').dataTable();
tableBlindsRomana = $('#tableBlindsRomana').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
 
});

    if(document.querySelector("#formRomana")){
        let formRomana = document.querySelector("#formRomana");
        formRomana.onsubmit = function(e) {
            e.preventDefault();
            let strCantidad = document.querySelector('#can_ro').value;
            let strLocalizacion = document.querySelector('#loc_ro').value;
            let strInstalacion = document.querySelector('#inst_ro').value;
            let strAncho = document.querySelector('#anc_ro').value;
            let strLargo = document.querySelector('#alt_ro').value;
            let strColorTela = document.querySelector('#colTela_ro').value;
            let strType = document.querySelector('#tipo_ro').value;
            let strConfig = document.querySelector('#config_ro').value;
            let strForro = document.querySelector('#forro_ro').value;
            let strControl = document.querySelector('#control_ro').value;
            let strMotor = document.querySelector('#ctrlMotor_ro').value;
            let intPrecio = document.querySelector('#precio_total').value;
          

            if(strConfig == '' || strCantidad == '' || strInstalacion == '' || strAncho == '' || strLargo == '' || intPrecio == '')
            {
                swal("Atención", "Todos los campos son." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Romana/setRomana'; 
            var formData = new FormData(formRomana);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormRomana').modal("hide");
                        formRomana.reset();
                        swal("Persiana Romana", objData.msg ,"success");
                        $("#tableBlindsRomana").load(" #tableBlindsRomana");

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
// function fntViewRoller(idroller){
//     var idroller = idroller;
//     let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
//     let ajaxUrl = base_url+'/Rollers/getRoller/'+idroller;
//     request.open("GET",ajaxUrl,true);
//     request.send();
//     request.onreadystatechange = function(){
//         if(request.readyState == 4 && request.status == 200){
//             let objData = JSON.parse(request.responseText);
//             if(objData.status){
//             //    var estadoUsuario = objData.data.status == 1 ? 
//                 // '<span class="badge badge-success">Activo</span>' : 
//                 // '<span class="badge badge-danger">Inactivo</span>';
//                 document.querySelector("#celID_roller").innerHTML = objData.data.codigo_enrrollable;
//                 document.querySelector("#celcantidad").innerHTML = objData.data.en_cantidad;
//                 document.querySelector("#cellocalizacion").innerHTML = objData.data.en_identificacion;
//                 document.querySelector("#celinstalacion").innerHTML = objData.data.en_instalacion;
//                 document.querySelector("#celancho").innerHTML = objData.data.en_ancho;
//                 document.querySelector("#celalto").innerHTML = objData.data.en_largo;
//                 document.querySelector("#celtela").innerHTML = objData.data.en_color_tela;
//                 document.querySelector("#celcontrol").innerHTML = objData.data.en_typecontrol;
//                 document.querySelector("#celcomponentes").innerHTML = objData.data.en_colorcomponents;
//                 document.querySelector("#celpesa").innerHTML = objData.data.en_typesa;
//                 document.querySelector("#celcadena").innerHTML = objData.data.en_typecadena;
//                 document.querySelector("#celmcadena").innerHTML = objData.data.en_m_cadena;
//                 document.querySelector("#celmotor").innerHTML = objData.data.en_control_motor;
//                 document.querySelector("#celprecio").innerHTML = objData.data.en_precio;
//                 document.querySelector("#celnota").innerHTML = objData.data.en_nota;
//                 // document.querySelector("#celstatus").innerHTML = estadoUsuario;
//                 $('#modalViewRoller').modal('show');
//             }else{
//                 swal("Error", objData.msg , "error");
//             }
//         }
//     }
//  }
 
 function fntEditRoller(idroller){
     // rowTable = element.parentNode.parentNode.parentNode; 
     document.querySelector('#titleModal').innerHTML ="Actualizar Persiana";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idroller =idroller;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Romana/getRoller/'+ idroller;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idRomana').value=objData.data.ID_ROMANA;
                document.querySelector('#can_ro').value=objData.data.ro_cantidad;                  
                document.querySelector('#loc_ro').value=objData.data.ro_identificacion;
                document.querySelector('#inst_ro').value=objData.data.ro_instalacion;
                document.querySelector('#anc_ro').value=objData.data.ro_ancho;
                document.querySelector('#alt_ro').value=objData.data.ro_largo;
                document.querySelector('#colTela_ro').value=objData.data.ro_color_tela;     
                document.querySelector('#tipo_ro').value=objData.data.ro_tiporo;
                document.querySelector('#config_ro').value=objData.data.ro_tipoconfig;
                document.querySelector('#forro_ro').value=objData.data.ro_tipoforro;
                document.querySelector('#control_ro').value=objData.data.ro_tipocontrol;
                document.querySelector('#ctrlMotor_ro').value=objData.data.ro_controlmotor;
                document.querySelector('#precioMan').value=objData.data.ro_manufactura;
                document.querySelector('#precioLista').value=objData.data.ro_precioLista;
                document.querySelector('#precio_unitario').value=objData.data.ro_preciounit;
                document.querySelector('#precio_total').value=objData.data.ro_precio;
                document.querySelector('#nota').value=objData.data.ro_nota;
             }
         }
     
         $('#modalFormRomana').modal('show');
     }
 }
 
 function fntDelRoller(idroller){
    var idroller =idroller;
    swal({
        title: "Eliminar Roller",
        text: "¿Realmente quiere eliminar el Roller?",
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
            let ajaxUrl = base_url+'/Romana/delRoller';
            let strData = "idRoller="+idroller;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        // tableBlindsRomana.api().ajax.reload();
                        $("#tableBlindsRomana").load(" #tableBlindsRomana");
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
        var ajaxUrl = base_url+'/Romana/precio'; 
        var formData = new FormData(form);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
        var objData = JSON.parse(request.responseText);
        if(objData.status){
        // $('#modalFormRomana').modal("hide");
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
    var ajaxUrl = base_url+'/Romana/getPrecio';
    var formData = new FormData(form);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
            // $('#modalFormRomana').modal("hide");
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
//             var ajaxUrl = base_url+'/Romana/setRoller'; 
//             var formData = new FormData(formRoller);
//             request.open("POST",ajaxUrl,true);
//             request.send(formData);
//             request.onreadystatechange = function(){
//                 if(request.readyState == 4 && request.status == 200){
//                     var objData = JSON.parse(request.responseText);
//                     if(objData.status){
//                         $('#modalFormRomana').modal("hide");
//                         formRoller.reset();
//                         swal("Roller", objData.msg ,"success");
//                         // tableBlindsRomana.api().ajax.reload();
//                         $("#tableBlindsRomana").load(" #tableBlindsRomana");

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
    // var ancho= document.querySelector('#anc_roller').value;
    var precio = document.querySelector('#precioLista').value;
    var unidades = document.querySelector('#can_ro').value;
    var manufactura = document.querySelector('#precioMan').value;

    $(".monto").each(function() {
        if (isNaN(precio)) {  
            text1=0;
          } else {  
            resultado1=parseFloat(precio)+parseFloat(manufactura);
            text1= resultado1;

            //   if((balance=="Cassette 100")) {
            //     cassette100=8;
            //     num1=parseFloat(ancho); 
            //     resultado1=(num1/12)*cassette100;
            //     resultado2=resultado1+parseFloat(precio);
            //     text1= resultado2;
            //   } else if(balance=="Cassette 120"){
            //       cassette120=12;
            //       num1=parseFloat(ancho); 
            //       resultado2=(num1/12)*cassette120;
            //       resultado3=resultado2+parseFloat(precio);
            //       text1= resultado3;
            //     }
            //     else if(balance=="Fascia 3"){
            //         Fascia3=7;
            //         num1=parseFloat(ancho); 
            //         resultado3=(num1/12)*Fascia3;
            //         resultado4=resultado3+parseFloat(precio);
            //         text1= resultado4;
            //       }
            //       else if(balance=="Fascia 4"){
            //         Fascia4=9;
            //         num1=parseFloat(ancho); 
            //         resultado4=(num1/12)*Fascia4;
            //         resultado5=resultado4+parseFloat(precio);
            //         text1= resultado5;
            //       }
            //       else if(balance=="Custom" || ancho==0 ){
            //         suma3=parseFloat(precio);
            //         text1=suma3 
            //       }
            //       else if(balance=="Otro" || ancho==0 ){
            //         suma3=precio;
            //         text1=suma3 
            //       }
        }
        $('#precio_unitario').val(parseFloat(text1));	
	});
    if(text1==0) {
           resultado1=precio; 
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
    var motorizacion= document.querySelector('#txtMotorizacion').value;
    var instalar= document.querySelector('#txtInstall').value;
    var anticipo= document.querySelector('#txtAnticipo').value;
    var desc= document.querySelector('#txtDesc').value;
    var impuesto = document.querySelector('#txtimpuesto').value;

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
        if(isNaN(text2) || isNaN(instalar) || isNaN(motorizacion)){
            text3+=0;

        }else if (impuesto!=0){
            resultado3=(parseFloat(text2)+parseFloat(instalar)); 
            sumatotal=(parseFloat(resultado3)+parseFloat(motorizacion))
            text3= sumatotal; 
            resultado4=(parseFloat(text3)*parseFloat(impuesto))/100; 
            text4= resultado4; 
            $('#txtImp').val(parseFloat(text4));
            resultado5=(parseFloat(sumatotal)+parseFloat(resultado4)); 
            text5= resultado5;              
        }
     else if(impuesto==0){
            $('#txtImp').val(parseFloat(text4));
            resultado5=(parseFloat(text2)+parseFloat(instalar)); 
            sumatotal2=(parseFloat(resultado5)+parseFloat(motorizacion));
            text5= sumatotal2;
        }
        $('#txtTotal').val(parseFloat(text5));
        }
        if(anticipo!=0) {
            resultado6=(parseFloat(text5)-parseFloat(anticipo)); 
            text6= resultado6; 
        }else{
            resultado7=(parseFloat(text5));
            text6=resultado7;
        }
        $('#txtSaldo').val(parseFloat(text6));
}

 


 



