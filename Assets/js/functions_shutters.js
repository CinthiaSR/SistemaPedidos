


// -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


function openModalRoller(){
    // document.querySelector('#idShutters').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Agregar";
    document.querySelector('#titleModal').innerHTML = "Nuevo";
    document.querySelector("#formShutters").reset();
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalFormShutters').modal('show')
}
let tableShutters;
let rowTable1= "";
let divLoading1 = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
// tableShutters = $('#tableShutters').dataTable();
tableShutters = $('#tableShutters').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
 
});

if(document.querySelector("#foto")){
    let foto = document.querySelector("#foto");
    foto.onchange = function(e) {
        let uploadFoto = document.querySelector("#foto").value;
        let fileimg = document.querySelector("#foto").files;
        let nav = window.URL || window.webkitURL;
        let contactAlert = document.querySelector('#form_alert');
        if(uploadFoto !=''){
            let type = fileimg[0].type;
            let name = fileimg[0].name;
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.add("notBlock");
                foto.value="";
                return false;
            }else{  
                    contactAlert.innerHTML='';
                    if(document.querySelector('#img')){
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
                }
        }else{
            alert("No selecciono foto");
            if(document.querySelector('#img')){
                document.querySelector('#img').remove();
            }
        }
    }
}
if(document.querySelector(".delPhoto")){
    let delPhoto = document.querySelector(".delPhoto");
    delPhoto.onclick = function(e) {
        document.querySelector("#foto_remove").value= 1;
        removePhoto();
    }
}

function removePhoto(){
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if(document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
}


// -----------------------------------
    // if(document.querySelector("#formShutters")){
        let formRoller = document.querySelector("#formShutters");
        formRoller.onsubmit = function(e) {
            e.preventDefault();
            let strIden = document.querySelector('#Iden_shutters').value;
            let strAncho = document.querySelector('#anc_shutters').value;
            let strAlto = document.querySelector('#alt_shutters').value;
            let strProfundidad = document.querySelector('#prof_shutters').value;
            let strMedida = document.querySelector('#Med_shutters').value;
            // let strInstalacion = document.querySelector('#inst_shutters').value;
            let strColor = document.querySelector('#color_shutters').value;
            let strLouver = document.querySelector('#Louver_shutters').value;
            // let strMarco = document.querySelector('#marco_shutters').value;
            let strBaston = document.querySelector('#baston_shutters').value;
            let strConf = document.querySelector('#typeConfig').value;
            let strDiagrama = document.querySelector('#foto').value;
            // let strref = document.querySelector('#foto1').value;
            // let strPoste1 = document.querySelector('#poste#1').value;
            let intPrecio = document.querySelector('#precio_shutters').value;
          

            if(strIden == '' || strAncho == '' || strAlto == '' || strProfundidad == '' || strMedida == '' || intPrecio == '')
            {
                swal("Atención", "Todos los campos son requeridos." , "error");
                return false;
            }
            divLoading1.style.display = "flex";
            var request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Shutters/setShutters'; 
            var formData = new FormData(formRoller);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modalFormShutters').modal("hide");
                        formRoller.reset();
                        swal("Shutters", objData.msg ,"success");
                        document.querySelector("#containerGallery").classList.remove("notblock");
                        // tableShutters.api().ajax.reload();
                        $("#tableShutters").load(" #tableShutters");

                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading1.style.display = "none";
                return false;
            }
        }
    // }

    if(document.querySelector(".btnAddImage")){
        let btnAddImage =  document.querySelector(".btnAddImage");
        btnAddImage.onclick = function(e){
         let key = Date.now();
         let newElement = document.createElement("div");
         newElement.id= "div"+key;
         newElement.innerHTML = `
             <div class="prevImage"></div>
             <input type="file" name="foto" id="img${key}" class="inputUploadfile">
             <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
             <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
         document.querySelector("#containerImages").appendChild(newElement);
         document.querySelector("#div"+key+" .btnUploadfile").click();
         fntInputFile();
        }
     }
     fntInputFile();
    //  fntBusquedaMarco();
    //  fntMarco();
     
}, false);
// .........................................................Tipo de marco


// ........................................................................................................................ Galeria de imagenes
function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idProducto = document.querySelector("#idShutter").value;
                // let idPedido = document.querySelector("#idPedidoS").value;

            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");            
            let uploadFoto = document.querySelector("#"+idFile).value;
            let fileimg = document.querySelector("#"+idFile).files;
            let prevImg = document.querySelector("#"+parentId+" .prevImage");
            let nav = window.URL || window.webkitURL;
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                }else{
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/Shutters/setImage'; 
                    let formData = new FormData();
                    formData.append('ID_SHUTTER',idProducto);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                            }else{
                                swal("Error", objData.msg , "error");
                            }
                        }
                    }

                }
            }

        });
    });
}

function fntDelItem(element){
    let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector("#idShutter").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Shutters/delFile'; 

    let formData = new FormData();
    formData.append('ID_SHUTTER',idProducto);
    formData.append("file",nameImg);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg , "error");
            }
        }
    }
}

function calculate(){
    const pais= document.querySelector('#Inst_Pais').value;
    const color =document.querySelector('#color_shutters').value;
    const baston= document.querySelector('#baston_shutters').value;
    const PrecioComp=document.querySelector('#precioComp').value;
    var ancho= document.querySelector('#anc_shutters').value;
    var alto = document.querySelector('#alt_shutters').value;
    var Med = document.querySelector('#Med_shutters').value;
    // var inst = document.querySelector('#inst_shutters').value;
    var precioxft2 = document.querySelector('#idprecio').value;
    var unidades = document.querySelector('#unidades_shutters').value;
    var var1 = "Claro de ventana";
    var var2 = "Por dentro";
    var var3 = "Por fuera";


    text1=0;
	$(".monto").each(function() {
        if (isNaN(ancho) || isNaN(alto)) {  
            text1=0;
          } else {  
              if((Med=="PDCD/Z-Std" || Med=="PDCD/Z-Rd" )) {
                marco=2;
                num1=parseFloat(ancho); 
                num2=parseFloat(alto);
                suma1=num1+marco;
                suma2=num2+marco;
                resultado=(parseFloat(suma1)*parseFloat(suma2))/144; 
                text1= resultado;
               }
               else if(Med=="PDSD-F2F/Z-Std" || Med=="PDSD-F2F/Z-Rd" || Med=="PDSD-F2F/Z-Dlx"|| Med=="PDSD-F2F/Z-Dm"||Med=="PFF2F/L-Std"|| Med=="PFF2F/Eleg"){
                  num1=parseFloat(ancho); 
                  num2=parseFloat(alto); 
                  resultado=(parseFloat(num1)*parseFloat(num2))/144; 
                  text1= resultado;
                }
                else if(Med=="PDCD/Z-Dlx"){
                    marco=3;
                    num1=parseFloat(ancho); 
                    num2=parseFloat(alto);
                    suma1=num1+marco;
                    suma2=num2+marco;
                    resultado=(parseFloat(suma1)*parseFloat(suma2))/144; 
                    text1= resultado;
                  }
                  else if(Med=="PDCD/Z-Dm"|| Med=="PFCA/L-Std"){
                    marco=4;
                    num1=parseFloat(ancho); 
                    num2=parseFloat(alto);
                    suma1=num1+marco;
                    suma2=num2+marco;
                    resultado=(parseFloat(suma1)*parseFloat(suma2))/144; 
                    text1= resultado;
                  }
                  else if(Med=="PFCA/Eleg"){
                    marco=8;
                    num1=parseFloat(ancho); 
                    num2=parseFloat(alto);
                    suma1=num1+marco;
                    suma2=num2+marco;
                    resultado=(parseFloat(suma1)*parseFloat(suma2))/144; 
                    text1= resultado;
                    
                }
                ft2xPed=resultado*unidades
        }
        $('#Tft2').val(parseFloat(ft2xPed));	
	});


    if(text1) {
        if(isNaN(text1) || isNaN(precioxft2)|| isNaN(unidades)){
            text2+=0;            
        }else{
            // resultado1=(parseFloat(text1)*parseFloat(precioxft2)); 
            if(pais=="USA Instalada"){
                if (color=="Picolo" || color=="Bolero" || color=="Clarinete"){
                    text2=(parseFloat(precioxft2)+1.50)                
                }
                if (color=="Natural" || color=="Sugar Maple" || color=="Nogal Clasico"
                        || color=="Roble" || color=="Cappuccino" || color=="Chocolate" || color=="Dark Mahogany" 
                        || color=="Coffe"){
                            text2=(parseFloat(precioxft2)+1.50)
                }
                if(color=="Igualacion"){
                    text2= parseFloat(precioxft2)+80; 
                }
            }

            if(pais=="USA No instalada"){
                if (color=="Picolo" || color=="Bolero" || color=="Clarinete"){
                    text2=(parseFloat(precioxft2)+0)                  
                }
                if (color=="Natural" || color=="Sugar Maple" || color=="Nogal Clasico"
                        || color=="Roble" || color=="Cappuccino" || color=="Chocolate" || color=="Dark Mahogany" 
                        || color=="Coffe"){
                            text2=(parseFloat(precioxft2)+0)  
                }
                if(color=="Igualacion"){
                    text2= parseFloat(precioxft2)+80; 
                }
            }


            if(pais=="MX Instalada"){
                if (color=="Picolo" || color=="Bolero" || color=="Clarinete"){
                    text2= parseFloat(precioxft2)+1.50;                 
                }
                if (color=="Natural" || color=="Sugar Maple" || color=="Nogal Clasico"
                        || color=="Roble" || color=="Cappuccino" || color=="Chocolate" || color=="Dark Mahogany" 
                        || color=="Coffe"){
                            text2= parseFloat(precioxft2)+1.50; 
                }
                if(color=="Igualacion"){
                    text2= parseFloat(precioxft2)+50; 
                }
            }

            if(pais=="MX No instalada"){
                if (color=="Picolo" || color=="Bolero" || color=="Clarinete"){
                    text2= parseFloat(precioxft2)+0;                 
                }
                if (color=="Natural" || color=="Sugar Maple" || color=="Nogal Clasico"
                        || color=="Roble" || color=="Cappuccino" || color=="Chocolate" || color=="Dark Mahogany" 
                        || color=="Coffe"){
                            text2= parseFloat(precioxft2)+0; 
                }
                if(color=="Igualacion"){
                    text2= parseFloat(precioxft2)+50; 
                }
            }
            if(baston=="Visible"||baston=='Visible (Split/ dividido)'|| baston=='Oculto (Split/ dividido)'){
                     res= parseFloat(text2)+0;
            }else if (baston=='Oculto'){
                res= parseFloat(text2)+1.50; 
            }
          
            
            resultado2=(parseFloat(ft2xPed)*parseFloat(text2));
            text3=resultado2
            resultado3=(parseFloat(text3)*parseFloat(unidades));
            text4=resultado3;
        }
        
        $('#precioComp').val(parseFloat(res));
        $('#precio_shutters').val(parseFloat(text3));
        $('#precio_total').val(parseFloat(text4));
	}


}






// --------------------------------------------
function fntViewShutter(idroller){
    var idroller = idroller;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Shutters/getShutter/'+idroller;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector("#celCant").innerHTML = objData.data.shut_cantidad;
                document.querySelector("#celIdent").innerHTML = objData.data.shut_identificacion;
                document.querySelector("#celancho").innerHTML = objData.data.shut_ancho;
                document.querySelector("#celalto").innerHTML = objData.data.shut_largo;
                document.querySelector("#celprof").innerHTML = objData.data.shut_profundidad;
                document.querySelector("#celMed").innerHTML = objData.data.shut_t_medida;
                document.querySelector("#celColor").innerHTML = objData.data.shut_color;
                document.querySelector("#celLouver").innerHTML = objData.data.shut_m_louver;
                document.querySelector("#celBaston").innerHTML = objData.data.shut_baston;
                document.querySelector("#celConfig").innerHTML = objData.data.shut_configuracion;
                document.querySelector("#imgCategoria").innerHTML = '<img src="'+objData.data.url_portada+'"></img>';
                document.querySelector("#celPoste1").innerHTML = objData.data.shut_p_T1;
                document.querySelector("#celPoste2").innerHTML = objData.data.shut_p_T2;
                document.querySelector("#celRiel").innerHTML = objData.data.shut_Ub_riel;
                document.querySelector("#celTft2").innerHTML = objData.data.shut_ft2;
                document.querySelector("#celprecio").innerHTML = objData.data.shut_precio;
                document.querySelector("#celTotal").innerHTML = objData.data.shut_totalprecio;
                document.querySelector("#celnota").innerHTML = objData.data.shut_nota;
                // document.querySelector("#celstatus").innerHTML = estadoUsuario;
                $('#modalViewShutter').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
 }
 
 function fntEditShutter(idshutter){
     // rowTable = element.parentNode.parentNode.parentNode; 
     document.querySelector('#titleModal').innerHTML ="Actualizar Persiana";
     document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
     document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
     document.querySelector('#btnText').innerHTML ="Actualizar";
 
      var idshutter =idshutter;
     var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     var ajaxUrl = base_url+'/Shutters/getShutter/'+ idshutter;
     request.open("GET",ajaxUrl,true);
     request.send();
     request.onreadystatechange = function(){
 
         if(request.readyState == 4 && request.status == 200){
            let htmlImage = "";
             let objData = JSON.parse(request.responseText);
 
             if(objData.status)
             {                  
                document.querySelector('#idShutter').value=objData.data.ID_SHUTTER;
                document.querySelector('#Inst_Pais').value=objData.data.shut_pais;
                document.querySelector('#idprecio').value=objData.data.shut_preBase;
                document.querySelector('#precioComp').value=objData.data.shut_preComp;
                document.querySelector('#unidades_shutters').value=objData.data.shut_cantidad;
                document.querySelector('#Iden_shutters').value=objData.data.shut_identificacion;
                document.querySelector('#anc_shutters').value=objData.data.shut_ancho;
                document.querySelector('#alt_shutters').value=objData.data.shut_largo;
                document.querySelector('#prof_shutters').value=objData.data.shut_profundidad;                  
                document.querySelector('#Med_shutters').value=objData.data.shut_t_medida;

                document.querySelector('#color_shutters').value=objData.data.shut_color;     
                document.querySelector('#Louver_shutters').value=objData.data.shut_m_louver;
                // document.querySelector('#marco_shutters').value=objData.data.shut_t_marco;
                document.querySelector('#baston_shutters').value=objData.data.shut_baston;
                document.querySelector('#typeConfig').value=objData.data.shut_configuracion;
                // revisar imagen
                document.querySelector('#foto_actual').value=objData.data.shut_diagrama;
                document.querySelector("#foto_remove").value= 0;

                document.querySelector('#poste1').value=objData.data.shut_p_T1;
                document.querySelector('#poste2').value=objData.data.shut_p_T2;
                document.querySelector('#rielD').value=objData.data.shut_Ub_riel;

                document.querySelector('#Tft2').value=objData.data.shut_ft2;
                document.querySelector('#precio_shutters').value=objData.data.shut_precio;
                document.querySelector('#precio_total').value=objData.data.shut_totalprecio;
                document.querySelector('#nota').value=objData.data.shut_nota;


                if(document.querySelector('#img')){
                    document.querySelector('#img').src = objData.data.url_portada;
                }else{
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img'src="+objData.data.url_portada+">";
                }

                if(objData.data.shut_diagrama == 'portada_categoria.png'){
                    document.querySelector('.delPhoto').classList.add("notBlock");
                }else{
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }


                // .......................................................Galeria para persianas especiales
                if(objData.data.images.length > 0){
                    let objProductos = objData.data.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        let key = Date.now()+p;
                        htmlImage +=`<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objProductos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage; 
                document.querySelector("#containerGallery").classList.remove("notblock"); 

                $('#modalFormShutters').modal('show');
            }else{
                swal("Error", objData.msg , "error");
             }
         }
     
        //  $('#modalFormShutters').modal('show');
     }
 }
 
 function fntDelShutter(idroller){
    var idroller =idroller;
    swal({
        title: "Eliminar Shutter",
        text: "¿Realmente quiere eliminar el Shutter?",
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
            let ajaxUrl = base_url+'/Shutters/delShutter';
            let strData = "idShutter="+idroller;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        // tableShutters.api().ajax.reload();
                        $("#tableShutters").load(" #tableShutters");
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
        var ajaxUrl = base_url+'/Shutters/precio'; 
        var formData = new FormData(form);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
        var objData = JSON.parse(request.responseText);
        if(objData.status){
        // $('#modalFormShutters').modal("hide");
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
    var ajaxUrl = base_url+'/Shutters/getPrecio';
    var formData = new FormData(form);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status){
            // $('#modalFormShutters').modal("hide");
            // form.reset();
            swal("Precios", objData.msg ,"success");
            
            }else{
            swal("Error", objData.msg, "error");
            }
            }
            return false;
    }


}
function calculateTotal(){
    var subtotal= document.querySelector('#txtImporte').value;
    var porcentaje = document.querySelector('#txtdescuento').value;
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

 


 



