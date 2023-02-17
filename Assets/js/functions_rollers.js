
// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


function openModalRoller(){
    document.querySelector('#idRoller').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formRoller").reset();
    $('#modalFormRoller').modal('show')
}
let tableBlindsRollers;
let rowTable1= "";
let divLoading1 = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
// tableBlindsRollers = $('#tableBlindsRollers').dataTable();
tableBlindsRollers = $('#tableBlindsRollers').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
 
});

    if(document.querySelector("#formRoller")){
        let formRoller = document.querySelector("#formRoller");
        formRoller.onsubmit = function(e) {
            e.preventDefault();
            let strCodigo = document.querySelector('#ID_roller').value;
            let strCantidad = document.querySelector('#can_roller').value;
            let strLocalizacion = document.querySelector('#loc_roller').value;
            let strInstalacion = document.querySelector('#inst_roller').value;
            let strAncho = document.querySelector('#anc_roller').value;
            let strLargo = document.querySelector('#alt_roller').value;
            let strColorTela = document.querySelector('#colTela_roller').value;
            let strTypeControl = document.querySelector('#control_roller').value;
            let strColorComp = document.querySelector('#colorComp_roller').value;
            let strTypesa = document.querySelector('#typePesa_roller').value;
            let strTypeCadena = document.querySelector('#typeCad_roller').value;
            let strMedidaCadena = document.querySelector('#cad_roller').value;
            let strControlMotor = document.querySelector('#motor_roller').value;
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
  
}, false);

// --------------------------------------------
function fntViewRoller(idroller){
    var idroller = idroller;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Rollers/getRoller/'+idroller;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
            //    var estadoUsuario = objData.data.status == 1 ? 
                // '<span class="badge badge-success">Activo</span>' : 
                // '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celID_roller").innerHTML = objData.data.codigo_enrrollable;
                document.querySelector("#celcantidad").innerHTML = objData.data.en_cantidad;
                document.querySelector("#cellocalizacion").innerHTML = objData.data.en_identificacion;
                document.querySelector("#celinstalacion").innerHTML = objData.data.en_instalacion;
                document.querySelector("#celancho").innerHTML = objData.data.en_ancho;
                document.querySelector("#celalto").innerHTML = objData.data.en_largo;
                document.querySelector("#celtela").innerHTML = objData.data.en_color_tela;
                document.querySelector("#celcontrol").innerHTML = objData.data.en_typecontrol;
                document.querySelector("#celcomponentes").innerHTML = objData.data.en_colorcomponents;
                document.querySelector("#celpesa").innerHTML = objData.data.en_typesa;
                document.querySelector("#celcadena").innerHTML = objData.data.en_typecadena;
                document.querySelector("#celmcadena").innerHTML = objData.data.en_m_cadena;
                document.querySelector("#celmotor").innerHTML = objData.data.en_control_motor;
                document.querySelector("#celprecio").innerHTML = objData.data.en_precio;
                document.querySelector("#celnota").innerHTML = objData.data.en_nota;
                // document.querySelector("#celstatus").innerHTML = estadoUsuario;
                $('#modalViewRoller').modal('show');
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
     var ajaxUrl = base_url+'/Rollers/getRoller/'+ idroller;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idRoller').value=objData.data.ID_ENRROLLABLE;
                document.querySelector('#ID_roller').value=objData.data.codigo_enrrollable;
                document.querySelector('#can_roller').value=objData.data.en_cantidad;                  
                document.querySelector('#loc_roller').value=objData.data.en_identificacion;
                document.querySelector('#inst_roller').value=objData.data.en_instalacion;
                document.querySelector('#anc_roller').value=objData.data.en_ancho;
                document.querySelector('#alt_roller').value=objData.data.en_largo;
                document.querySelector('#colTela_roller').value=objData.data.en_color_tela;     
                document.querySelector('#control_roller').value=objData.data.en_typecontrol;
                document.querySelector('#colorComp_roller').value=objData.data.en_colorcomponents;
                document.querySelector('#typePesa_roller').value=objData.data.en_typesa;
                document.querySelector('#typeCad_roller').value=objData.data.en_typecadena;
                document.querySelector('#cad_roller').value=objData.data.en_m_cadena;
                document.querySelector('#motor_roller').value=objData.data.en_control_motor;
                document.querySelector('#balance_roller').value=objData.data.en_balance;
                document.querySelector('#precioLista').value=objData.data.en_preciolista;
                document.querySelector('#precio_unitario').value=objData.data.en_preciounit;
                document.querySelector('#precio_total').value=objData.data.en_precio;
                document.querySelector('#nota').value=objData.data.en_nota;
                //  if(objData.data.status == 1){
                //      document.querySelector("#listStatus").value = 1;
                //  }else{
                //      document.querySelector("#listStatus").value = 2;
                //  }
                //  $('#listStatus').selectpicker('render');
             }
         }
     
         $('#modalFormRoller').modal('show');
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
            let ajaxUrl = base_url+'/Rollers/delRoller';
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
                        // tableBlindsRollers.api().ajax.reload();
                        $("#tableBlindsRollers").load(" #tableBlindsRollers");
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
        var ajaxUrl = base_url+'/Rollers/precio'; 
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
    var ajaxUrl = base_url+'/Rollers/getPrecio';
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
    var ancho= document.querySelector('#anc_roller').value;
    var precio = document.querySelector('#precioLista').value;
    var unidades = document.querySelector('#can_roller').value;
    var balance = document.querySelector('#balance_roller').value;

    $(".monto").each(function() {
        if (isNaN(ancho) || isNaN(precio)) {  
            text1=0;
          } else {  
              if((balance=="Cassette 100")) {
                cassette100=8;
                num1=parseFloat(ancho); 
                resultado1=(num1/12)*cassette100;
                resultado2=resultado1+parseFloat(precio);
                text1= resultado2;
              } else if(balance=="Cassette 120"){
                  cassette120=12;
                  num1=parseFloat(ancho); 
                  resultado2=(num1/12)*cassette120;
                  resultado3=resultado2+parseFloat(precio);
                  text1= resultado3;
                }
                else if(balance=="Fascia 3"){
                    Fascia3=7;
                    num1=parseFloat(ancho); 
                    resultado3=(num1/12)*Fascia3;
                    resultado4=resultado3+parseFloat(precio);
                    text1= resultado4;
                  }
                  else if(balance=="Fascia 4"){
                    Fascia4=9;
                    num1=parseFloat(ancho); 
                    resultado4=(num1/12)*Fascia4;
                    resultado5=resultado4+parseFloat(precio);
                    text1= resultado5;
                  }
                  else if(balance=="Custom" || ancho==0 ){
                    suma3=parseFloat(precio);
                    text1=suma3 
                  }
                  else if(balance=="Otro" || ancho==0 ){
                    suma3=precio;
                    text1=suma3 
                  }
        }
        $('#precio_unitario').val(parseFloat(text1));	
	});
    if(text1==0 || ancho==0) {

           resultado1=precio; 
           text2= 0; 
            
         
        } else{
            resultado1=text1*parseFloat(unidades); 
            text2= resultado1; 
        }
        $('#precio_total').val(parseFloat(text2));
    // if(text1) {
    //     if(isNaN(text1) || isNaN(unidades)|| isNaN(precio)|| isNaN(ancho)){
    //         text2+=0;
    //     }
    //     else if(ancho !=0) {
    //         suma1=(parseFloat(text1)+parseFloat(precio)); 
    //         resultado1=(parseFloat(suma1)*parseFloat(unidades)); 
    //         text2= resultado1; 
    //     }
    //     else if(precio ==0) {
    //         resultado1=(parseFloat(text1)*parseFloat(unidades)); 
    //         text2= resultado1; 
    //     }
    //     $('#precio_total').val(parseFloat(text2));
	// }


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
    }else{
            text6=resultado5;
        }
        $('#txtSaldo').val(parseFloat(text6));
}

 


 



