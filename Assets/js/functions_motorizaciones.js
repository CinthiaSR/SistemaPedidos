

// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


function openModalRoller(){
    document.querySelector('#idRoller').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formMotor").reset();
    $('#modalFormMotor').modal('show')
}

// function openModalComp(){
//     document.querySelector('#idComp').value ="";
//     document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
//     document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
//     document.querySelector('#btnText').innerHTML ="Agregar";
//     document.querySelector('#titleModal').innerHTML = "Nuevo";
//     document.querySelector("#formComplemento").reset();
//     $('#modalComplemento').modal('show')
// }


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

    if(document.querySelector("#formMotor")){
        let formMotor = document.querySelector("#formMotor");
        formMotor.onsubmit = function(e) {
            e.preventDefault();
            let strCantidad = document.querySelector('#can_roller').value;
            let strLocalizacion = document.querySelector('#loc_roller').value;
            let strInstalacion = document.querySelector('#inst_roller').value;
            let strAncho = document.querySelector('#anc_roller').value;
            let strLargo = document.querySelector('#alt_roller').value;
            let strColorTela = document.querySelector('#colTela_roller').value;
            let strColorComp = document.querySelector('#colorComp_roller').value;
            let strTypesa = document.querySelector('#Pesa_roller').value;
            let strControlMotor = document.querySelector('#motor_roller').value;
            let intPrecio = document.querySelector('#precio_total').value;
          

            if(strCantidad == '' || strInstalacion == '' || strAncho == '' || strLargo == '' || intPrecio == '')
            {
                swal("Atención", "Todos los campos son." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Motorizacion/setRoller'; 
            var formData = new FormData(formMotor);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormMotor').modal("hide");
                        formMotor.reset();
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
// fntMotor();

}, false);


// ***************************************************SELECT CLIENTE
function fntMotor(marca){
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

                $("#marca").change(function(){
                     marca = document.querySelector('#marca').value;
                     alert (marca);
                     let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                     let ajaxUrl = base_url+'/Motores/getTipo/'+marca;
                     let strData = "marca="+marca;
                     request.open("POST",ajaxUrl,true);
                     request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                     request.send(strData);
                     request.onreadystatechange = function(){                
                        if(request.readyState == 4 && request.status == 200){
                            document.querySelector('#tipo').innerHTML = request.responseText;
                             $('#tipo').selectpicker('render');
                             
                        }
                     }
                    });

                }
            }
  }


// --------------------------------------------

 
 function fntEditRoller(idroller){
     // rowTable = element.parentNode.parentNode.parentNode; 
     document.querySelector('#titleModal').innerHTML ="Actualizar Persiana";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idroller =idroller;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Motorizacion/getRoller/'+ idroller;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idRoller').value=objData.data.ID_MOTORIZADA;
                document.querySelector('#can_roller').value=objData.data.mo_cantidad;                  
                document.querySelector('#loc_roller').value=objData.data.mo_identificacion;
                document.querySelector('#inst_roller').value=objData.data.mo_instalacion;
                document.querySelector('#anc_roller').value=objData.data.mo_ancho;
                document.querySelector('#alt_roller').value=objData.data.mo_largo;
                document.querySelector('#colTela_roller').value=objData.data.mo_color_tela;     
                document.querySelector('#colorComp_roller').value=objData.data.mo_colorcomp;
                document.querySelector('#Pesa_roller').value=objData.data.mo_pesa;
                document.querySelector('#motor_roller').value=objData.data.mo_ctrl_motor;
                document.querySelector('#balance_roller').value=objData.data.mo_balance;
                document.querySelector('#marca').value=objData.data.mo_marca;
                document.querySelector('#tipo').value=objData.data.mo_tipo;
                // document.querySelector('#nombre_motor').value=objData.data.mo_nombre;
                document.querySelector('#precioLista').value=objData.data.mo_preciolista;
                document.querySelector('#precio_unitario').value=objData.data.mo_preciounit;
                document.querySelector('#precio_total').value=objData.data.mo_precio;
                document.querySelector('#nota').value=objData.data.mo_nota;
             }
         }
     
         $('#modalFormMotor').modal('show');
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
    }, 
    function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Motorizacion/delRoller';
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
        var ajaxUrl = base_url+'/Motorizacion/precio'; 
        var formData = new FormData(form);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
        var objData = JSON.parse(request.responseText);
        if(objData.status){
        // $('#modalFormMotor').modal("hide");
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
    var ajaxUrl = base_url+'/Motorizacion/getPrecio';
    var formData = new FormData(form);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
            // $('#modalFormMotor').modal("hide");
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
            var formData = new FormData(formMotor);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormMotor').modal("hide");
                        formMotor.reset();
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
    if(text1==0) {
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

 

// function cambiante(){

//     $('.montos').on('change',function(){
//         // var tipo = document.querySelector('#tipo').value;

//         var motoresSomfy = "<option value='0' selected>Selecciona una opción...</option><option value='Baterias Altus 28'>Baterias Altus 28</option><option value=''>Baterias Sonnese 30</option><option value=''>Electrico LSN 406</option><option value=''>Electrico LSN 510</option>"
//         var motoresCeltic = "<option value='0' selected>Selecciona una opción...</option><option value='Baterias Celtic 1.2 Nw'>Baterias Celtic 1.2 Nw</option><option value=''>Baterias Celtic 6 Nw</option><option value=''>Electrico Celtic 6 Nw</option><option value=''>Electrico Celtic 10 Nw</option><option value=''>Electrico Celtic 20 Nw</option>"
//         var motoresTube = "<option value='0' selected>Selecciona una opción...</option><option value=''>Recargable 1.1 Nw</option><option value=''>Electrico 6 Nw</option><option value=''>Electrico 10 Nw</option>"

//         // -------Control
//         var controlSomfy = "<option value='0' selected>Selecciona una opción...</option><option value=''>1 Canal</option><option value=''>5 Canales</option><option value=''>16 Canales</option>"
//         var controlCeltic = "<option value='0' selected>Selecciona una opción...</option><option value=''>1 Canal</option><option value=''>6 Canales</option><option value=''>16 Canales</option>"
//         var controlTube = "<option value='0' selected>Selecciona una opción...</option><option value=''>1 Canal</option><option value=''>5 Canales</option><option value=''>15 Canales</option>"

//         // -------Cargador
//         var cargadorSomfy = "<option value='0' selected>Selecciona una opción...</option><option value=''>Cargador para motor</option>"
//         var cargadorCeltic = "<option value='0' selected>Selecciona una opción...</option><option value=''>Cargador 1.2 Nw</option><option value=''>Cargador 6 Nw</option>"
//         var cargadorTube = "<option value='0' selected>Selecciona una opción...</option><option value=''>Cargador para motor</option>"
 
//         // -------Ext
//         var ExtSomfy = "<option value='0' selected>Selecciona una opción...</option><option value=''>Ext. para cargador</option>"
//         var ExtCeltic = "<option value='0' selected>Selecciona una opción...</option><option value=''>Ext. para cargador</option>"
//         var ExtTube = "<option value='0' selected>Selecciona una opción...</option><option value=''>No hay datos</option>"
 
//         // -------Interface
//         var InterfaceSomfy = "<option value='0' selected>Selecciona una opción...</option><option value=''>InteO</option>"
//         var InterfaceCeltic = "<option value='0' selected>Selecciona una opción...</option><option value=''>VTI Smart HUB</option>"
//         var InterfaceTube = "<option value='0' selected>Selecciona una opción...</option><option value=''>BOX RTL</option>"
         

//         var marca = $("#marca option:selected").val();
//         var tipo = $("#tipo option:selected").val();
        
//         if(marca == "Somfy" && tipo== "Motor"){
//             $("#nombre_motor").html(motoresSomfy);
//         }
//         else if(marca == "Vertilux" && tipo== "Motor"){
//             $("#nombre_motor").html(motoresCeltic);
//         }
//         else if(marca == "Tube" && tipo== "Motor"){
//             $("#nombre_motor").html(motoresTube);
//         }
//         // ---------Control
//         else if(marca == "Somfy" && tipo== "Control"){
//             $("#nombre_motor").html(controlSomfy);
//         }
//         else if(marca == "Vertilux" && tipo== "Control"){
//             $("#nombre_motor").html(controlCeltic);
//         }
//         else if(marca == "Tube" && tipo== "Control"){
//             $("#nombre_motor").html(controlTube);
//         }
//         // ---------Cargador
//         else if(marca == "Somfy" && tipo== "Cargador"){
//             $("#nombre_motor").html(cargadorSomfy);
//         }
//         else if(marca == "Vertilux" && tipo== "Cargador"){
//             $("#nombre_motor").html(cargadorCeltic);
//         }
//         else if(marca == "Tube" && tipo== "Cargador"){
//             $("#nombre_motor").html(cargadorTube);
//         }
//         // ---------Ext
//         else if(marca == "Somfy" && tipo== "Ext"){
//             $("#nombre_motor").html(ExtSomfy);
//         }
//         else if(marca == "Vertilux" && tipo== "Ext"){
//             $("#nombre_motor").html(ExtCeltic);
//         }
//         else if(marca == "Tube" && tipo== "Ext"){
//             $("#nombre_motor").html(ExtTube);
//         }
//          // ---------Interface
//          else if(marca == "Somfy" && tipo== "Interface"){
//             $("#nombre_motor").html(InterfaceSomfy);
//         }
//         else if(marca == "Vertilux" && tipo== "Interface"){
//             $("#nombre_motor").html(InterfaceCeltic);
//         }
//         else if(marca == "Tube" && tipo== "Interface"){
//             $("#nombre_motor").html(InterfaceTube);
//         }

//         });
// }

function h(){
    opt = document.getElementsByClassName("hALL");
     for (i=0; i<opt.length; i++) {
     opt[i].style.display = "none";
     }
    
    e = document.getElementById("marca")
    e = e[e.selectedIndex].dataset.hab.split(" ");
    for (x=0;x<e.length;x++){
     opt = document.getElementsByClassName(e[x]);
      if (opt.length) {
       for (i=0; i<opt.length; i++) {
        opt[i].style.display = "";
       }
      }
     }
    }
    h("");
 


// function cargarProvincias() {
//     var array = ["Somfy_motores", "Somfy_Controles", "Somfy_Cargadores", "Somfy_Interface", 
//                  "Tube_Motores", "Tube_Controles", "Tube_Cargadores", "Tube_Interface", 
//                  "Vertilux_Motores", "Vertilux_Controles", "Vertilux_Cargadores", "Vertilux_Interface"
//                 ];
//     array.sort();
//     addOptions("marca", array);
// }

// function addOptions(domElement, array) {
//     var selector = document.getElementsByName(domElement)[0];
//     for (provincia in array) {
//         var opcion = document.createElement("option");
//         opcion.text = array[provincia];
//         opcion.value = array[provincia].toLowerCase()
//         selector.add(opcion);
//     }
// }



// function cargarPueblos() {
//     // Objeto de provincias con pueblos
//     var listaPueblos = {
//         somfy_motores: ["Baterias Altus 28", "Baterias Sonesse 30", "Electrico LSN 406", "Electrico LSN 510"],
//         somfy_control: ["1 Canal", "5 Canales", "16 Canales"],
//         somfy_cargadores: ["Cargador para motor", "Extension para cargador"],
//         somfy_interface: ["InteO Interface Somfy"],

//         tube_motores: ["Baterias Tube 1.1 Nw", "Baterias Tube 406", "Electrico Tube 510"],
//         tube_control: ["1 Canal", "5 Canales", "15 Canales"],
//         tube_cargadores: ["Cargador para motor"],
//         tube_interface: ["BOX RTL"],

//         vertilux_motores: ["Baterias Celtic 1.2 Nw", "Baterias Celtic 6 Nw", "Electrico Celtic 6 Nw", "Electrico Celtic 10 Nw", "Electrico Celtic 20 Nw"],
//         vertilux_control: ["1 Canal", "6 Canales", "16 Canales"],
//         vertilux_cargadores: ["Cargador 1.2 Nw", "Cargador 6 Nw", "Extension para cargador"],
//         vertilux_interface: ["VTI Smart HUB"]
//     }
    
//     var provincias = document.getElementById('marca')
//     var pueblos = document.getElementById('tipo')
//     var provinciaSeleccionada = provincias.value
    
//     // Se limpian los pueblos
//     pueblos.innerHTML = '<option value="">Selecciona</option>'
    
//     if(provinciaSeleccionada !== ''){
//       // Se seleccionan los pueblos y se ordenan
//       provinciaSeleccionada = listaPueblos[provinciaSeleccionada]
//       provinciaSeleccionada.sort()
    
//       // Insertamos los pueblos
//       provinciaSeleccionada.forEach(function(pueblo){
//         let opcion = document.createElement('option')
//         opcion.value = pueblo
//         opcion.text = pueblo
//         pueblos.add(opcion)
//       });
//     }
    
//   }
// cargarProvincias();
