
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


function openModalNeolux(){
    document.querySelector('#idNeolux').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formNeolux").reset();
    $('#modalFormNeolux').modal('show')
}
let tableBlindsRollers;
let rowTable1= "";
let divLoading1 = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
// tableBlindsRollers = $('#tableBlindsRollers').dataTable();
tableBlindsNeolux = $('#tableBlindsNeolux').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
 
});

    if(document.querySelector("#formNeolux")){
        let forNeolux = document.querySelector("#formNeolux");
        forNeolux.onsubmit = function(e) {
            e.preventDefault();
            let strCodigo = document.querySelector('#ID_neolux').value;
            let strCantidad = document.querySelector('#can_neolux').value;
            let strInstalacion = document.querySelector('#inst_neolux').value;
            let strAncho = document.querySelector('#anc_neolux').value;
            let strLargo = document.querySelector('#alt_neolux').value;
            let strColorTela = document.querySelector('#colTela_neolux').value;
            let strTypeControl = document.querySelector('#control_neolux').value;
            let strColorComp = document.querySelector('#colorComp_neolux').value;
            let strTypesa = document.querySelector('#typePesa_neolux').value;
            let strTypeCadena = document.querySelector('#typeCad_neolux').value;
            let strMedidaCadena = document.querySelector('#cad_neolux').value;
            let strControlMotor = document.querySelector('#motor_neolux').value;
            let intPrecio = document.querySelector('#precio_total').value;
          

            if(strCodigo == '' || strCantidad == '' || strInstalacion == '' || strAncho == '' || strLargo == '' || intPrecio == '')
            {
                swal("Atención", "Todos los campos son." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Neolux/setNeolux'; 
            var formData = new FormData(forNeolux);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormNeolux').modal("hide");
                        forNeolux.reset();
                        swal("Sheer Elegance", objData.msg ,"success");
                        // tableBlindsRollers.api().ajax.reload();
                        $("#tableBlindsNeolux").load(" #tableBlindsNeolux");

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
function fntViewNeolux(idneolux){
    var ineoluxr = idneolux;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Neolux/getNeolux/'+idneolux;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector("#celID_sheer").innerHTML = objData.data.codigo_sheer;
                document.querySelector("#celcantidad").innerHTML = objData.data.sheer_cantidad;
                document.querySelector("#cellocalizacion").innerHTML = objData.data.sheer_identificacion;
                document.querySelector("#celinstalacion").innerHTML = objData.data.sheer_instalacion;
                document.querySelector("#celancho").innerHTML = objData.data.sheer_ancho;
                document.querySelector("#celalto").innerHTML = objData.data.sheer_largo;
                document.querySelector("#celtela").innerHTML = objData.data.sheer_color_tela;
                document.querySelector("#celcontrol").innerHTML = objData.data.sheer_typecontrol;
                document.querySelector("#celcomponentes").innerHTML = objData.data.sheer_colorcomponents;
                document.querySelector("#celpesa").innerHTML = objData.data.sheer_typesa;
                document.querySelector("#celcadena").innerHTML = objData.data.sheer_typecadena;
                document.querySelector("#celmcadena").innerHTML = objData.data.sheer_m_cadena;
                document.querySelector("#celmotor").innerHTML = objData.data.sheer_control_motor;
                document.querySelector("#celprecio").innerHTML = objData.data.sheer_precio;
                document.querySelector("#celnota").innerHTML = objData.data.sheer_nota;
                // document.querySelector("#celstatus").innerHTML = estadoUsuario;
                $('#modalViewNeolux').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
 }
 
 function fntEditNeolux(idneolux){
     // rowTable = element.parentNode.parentNode.parentNode; 
     document.querySelector('#titleModal').innerHTML ="Actualizar Persiana";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idneolux =idneolux;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Neolux/getNeolux/'+ idneolux;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idNeolux').value=objData.data.ID_SHEER;
                document.querySelector('#ID_neolux').value=objData.data.codigo_sheer;
                document.querySelector('#can_neolux').value=objData.data.sheer_cantidad;                  
                document.querySelector('#loc_neolux').value=objData.data.sheer_identificacion;
                document.querySelector('#inst_neolux').value=objData.data.sheer_instalacion;
                document.querySelector('#anc_neolux').value=objData.data.sheer_ancho;
                document.querySelector('#alt_neolux').value=objData.data.sheer_largo;
                document.querySelector('#colTela_neolux').value=objData.data.sheer_color_tela;     
                document.querySelector('#control_neolux').value=objData.data.sheer_typecontrol;
                document.querySelector('#colorComp_neolux').value=objData.data.sheer_colorcomponents;
                document.querySelector('#typePesa_neolux').value=objData.data.sheer_typesa;
                document.querySelector('#typeCad_neolux').value=objData.data.sheer_typecadena;
                document.querySelector('#cad_neolux').value=objData.data.sheer_m_cadena;
                document.querySelector('#motor_neolux').value=objData.data.sheer_control_motor;
                document.querySelector('#balance_neolux').value=objData.data.sheer_cassette;
                document.querySelector('#precioLista').value=objData.data.sheer_preciolista;
                document.querySelector('#precio_unitario').value=objData.data.sheer_preciounit;
                document.querySelector('#precio_total').value=objData.data.sheer_precio;
                document.querySelector('#nota').value=objData.data.sheer_nota;
                //  if(objData.data.status == 1){
                //      document.querySelector("#listStatus").value = 1;
                //  }else{
                //      document.querySelector("#listStatus").value = 2;
                //  }
                //  $('#listStatus').selectpicker('render');
             }
         }
     
         $('#modalFormNeolux').modal('show');
     }
 }
 
 function fntDelNeolux(idneolux){
    var idneolux =idneolux;
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
            let ajaxUrl = base_url+'/Neolux/delNeolux';
            let strData = "idRoller="+idneolux;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        // tableBlindsRollers.api().ajax.reload();
                        $("#tableBlindsNeolux").load(" #tableBlindsNeolux");
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
        var ajaxUrl = base_url+'/Neolux/precio'; 
        var formData = new FormData(form);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
        var objData = JSON.parse(request.responseText);
        if(objData.status){
        // $('#modalFormRoller').modal("hide");
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
    var ajaxUrl = base_url+'/Neolux/getPrecio';
    var formData = new FormData(form);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
            // $('#modalFormRoller').modal("hide");
            // form.reset();
            swal("Precios", objData.msg ,"success");
            
            }else{
            swal("Error", objData.msg, "error");
            }
            }
            return false;
    }


}







function detail_price(idpedido){
    if(document.querySelector("#formPrice")){
        let formPrice = document.querySelector("#formPrice");
        formPrice.onsubmit = function(e) {
            e.preventDefault();
            let strPercenDescINP = document.querySelector('#txtdescuento').value;
            let strDescuento = document.querySelector('#txtDesc').value;
            let strSubtotal = document.querySelector('#txtSubtotal').value;
            let strInstalacionINP = document.querySelector('#txtInstall').value;
            let strTotal = document.querySelector('#txtTotal').value;
            let strAnticipoINP = document.querySelector('#txtAnticipo').value;
            let strSaldo = document.querySelector('#txtSaldo').value;
                    

            if(strPercenDescINP == '' || strInstalacionINP == '' || strAnticipoINP== '')
            {
                swal("Atención", "Todos los campos son." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Rollers/setRoller'; 
            var formData = new FormData(formRoller);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormRoller').modal("hide");
                        formRoller.reset();
                        swal("Roller", objData.msg ,"success");
                        // tableBlindsRollers.api().ajax.reload();
                        $("#tableBlindsRollers").load(" #tableBlindsRollers");

                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading1.style.display = "none";
                return false;
            }
        }
    }
}

function calculate(){
    // var ancho= document.querySelector('#anc_roller').value;
    var preciolista = document.querySelector('#precioLista').value;
    var unidades = document.querySelector('#can_neolux').value;

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
        }
        else if(impuesto==0){
            $('#txtImp').val(parseFloat(text4));
            resultado5=(parseFloat(text2)+parseFloat(instalar)); 
            text5= resultado5;
        }
        $('#txtTotal').val(parseFloat(text5));
	}
    if(anticipo!=0) {
            resultado6=(parseFloat(text5)-parseFloat(anticipo)); 
            text6= resultado6; 
        }else if(anticipo==0){
            text6=resultado5;
        }
        $('#txtSaldo').val(parseFloat(text6));

}

 


 



