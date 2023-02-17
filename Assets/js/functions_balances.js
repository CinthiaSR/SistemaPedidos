

// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


function openModalbalance(){
    document.querySelector('#idBalance').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formBalance").reset();
    $('#modalFormBalance').modal('show')
}
let tableBlindsbalance;
let rowTable1= "";
let divLoading1 = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
tableBlindsbalance = $('#tableBlindsbalance').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
 
});

    if(document.querySelector("#formBalance")){
        let formBalance = document.querySelector("#formBalance");
        formBalance.onsubmit = function(e) {
            e.preventDefault();
            let strCantidad = document.querySelector('#can').value;
            let strLocalizacion = document.querySelector('#loc').value;
            let strInstalacion = document.querySelector('#inst').value;
            let strAncho = document.querySelector('#anc').value;
            let strLargo = document.querySelector('#alt').value;
            let strColor = document.querySelector('#col').value;
          

            if(strCantidad == ''|| strLocalizacion == '' || strInstalacion == '' || strAncho == '' || strLargo == '' ||
            strColor=='')
            {
                swal("Atención", "Todos los campos son." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Balance/setBalance'; 
            var formData = new FormData(formBalance);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormBalance').modal("hide");
                        formBalance.reset();
                        swal("Balance ", objData.msg ,"success");
                        $("#tableBlindsbalance").load(" #tableBlindsbalance");

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
function fntViewRoller(idbalance){
    var idbalance = idbalance;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Balance/getBalance/'+idbalance;
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
 
 function fntEditbalance(idbalance){
     // rowTable = element.parentNode.parentNode.parentNode; 
     document.querySelector('#titleModal').innerHTML ="Actualizar Persiana";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idbalance =idbalance;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Balance/getBalance/'+ idbalance;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idBalance').value=objData.data.ID_BALANCE;
                // document.querySelector('#ID_horizontal').value=objData.data.codigo_enrrollable;
                document.querySelector('#can').value=objData.data.bal_cantidad;                  
                document.querySelector('#loc').value=objData.data.bal_identificacion;
                document.querySelector('#inst').value=objData.data.bal_media;
                document.querySelector('#alt').value=objData.data.bal_alto;
                document.querySelector('#anc').value=objData.data.bal_largo;
                document.querySelector('#col').value=objData.data.bal_color;
                document.querySelector('#tam').value=objData.data.bal_retorno;
                document.querySelector('#cortesEsp').value=objData.data.bal_cortes;
                document.querySelector('#L_inst').value=objData.data.bal_L_instalacion;
                document.querySelector('#Sup').value=objData.data.bal_tapasuperior;
                document.querySelector('#Forr').value=objData.data.bal_forrado;
                document.querySelector('#NameFrr').value=objData.data.bal_nombreforro;
                document.querySelector('#precio_unitario').value=objData.data.bal_preciounit;
                document.querySelector('#precio_total').value=objData.data.bal_preciototal;
                document.querySelector('#nota').value=objData.data.bal_nota;
             }
         }
     
         $('#modalFormBalance').modal('show');
     }
 }
 
 function fntDelbalance(idbalance){
    var idbalance =idbalance;
    swal({
        title: "Eliminar Balance de madera",
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
            let ajaxUrl = base_url+'/Balance/delBalance';
            let strData = "idBalance="+idbalance;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        $("#tableBlindsbalance").load(" #tableBlindsbalance");
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
        var ajaxUrl = base_url+'/Balance/precio'; 
        var formData = new FormData(form);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
        var objData = JSON.parse(request.responseText);
        if(objData.status){
        // $('#modalformBalance').modal("hide");
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
    var ajaxUrl = base_url+'/Balance/getPrecio';
    var formData = new FormData(form);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
            // $('#modalformBalance').modal("hide");
            // form.reset();
            swal("Precios", objData.msg ,"success");
            
            }else{
            swal("Error", objData.msg, "error");
            }
            }
            return false;
    }


}


function calculate(){
    var preciolista = document.querySelector('#precio_unitario').value;
    var unidades = document.querySelector('#can').value;
    var text1=0;

    $(".monto").each(function() {
        if (isNaN(unidades) || isNaN(preciolista)) {  
            text1=0;
          } else {
                    suma3=parseFloat(preciolista)*parseFloat(unidades);
                    text1=suma3 
        }
        $('#precio_total').val(parseFloat(text1));	
	});
    // if(text1==0) {

    //        resultado1=text1*parseFloat(unidades); 
    //        text2= 0; 
            
         
    //     } else{
    //         resultado1=text1*parseFloat(unidades); 
    //         text2= resultado1; 
    //     }
    //     $('#precio_total').val(parseFloat(text2));

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
    }else{
            text6=resultado5
    }
        $('#txtSaldo').val(parseFloat(text6));

	}

 


 



