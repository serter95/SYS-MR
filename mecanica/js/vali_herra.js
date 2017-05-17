    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
//       especiales = "8-37-39-46";
especiales=['8','37','39','46','9'];
       tecla_especial = false;
       //for(var i in especiales){
        for(var i=0,n; n=especiales[i];i++){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

function solonum(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 1234567890";
     //  especiales = "8-37-39-46";
especiales=['8','37','39','46','9'];
       tecla_especial = false;
       //for(var i in especiales){
         for(var i=0,n; n=especiales[i];i++){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function solonum2(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890.";
especiales=['8','37','39','46','9'];
 tecla_especial = false;
        for(var i=0,n; n=especiales[i];i++){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

       function solonum3(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890";
//especiales = "8-37-39-46";
especiales=['8','37','39','46','9'];
/*
los especiales son las teclas 
8: retroceso o borrar
37: tecla izquierda
39: tecla derecha
46: suprimir
9:tabulador
http://help.adobe.com/es_ES/AS2LCR/Flash_10.0/help.html?content=00000525.html
un poco mas sobre los especiales en el link anterior
*/
       tecla_especial = false;
       //for(var i in especiales){
        for(var i=0,n; n=especiales[i];i++){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function solonum4(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890/";

       especiales=['8','9'];
       tecla_especial = false;
       //for(var i in especiales){
         for(var i=0,n; n=especiales[i];i++){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function validarcoma(e,field){
      key = e.keyCode ? e.keyCode:e.which;
      tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890,";

        if(letras.indexOf(tecla)==-1 ){
            return false;
          }
      if (key === 8)
        return true;
      if(field.value!==""){
        if((field.value.indexOf(","))>0){
          if(key>47 && key < 58){
            if(field.value==="")
              return true;
            regexp=/[0-9](1,10)[,][0-9](1,3)$/;
            regexp=/[0-9](2)$/;
            return !(regexp.test(field.value));
          }
        }
      }
      if (key > 47 && key < 58){
        if (field.value === "")
          return true;
        regexp=/[0-9](10)/;
        return !(regexp.test(field.value));
      }

      if(key === 44){
        if (field.value==="")
          return false;
        regexp=/^[0-9]+$/;
        return regexp.test(field.value);
      }

    }

    function soloAlfa(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890,.-";
       especiales = "8-37-39-46";
//especiales=['8','37','39','46','9'];
       tecla_especial = false
       //for(var i in especiales){
                for(var i=0,n; n=especiales[i];i++){

            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

        function soloAlfa2(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890,.-/%";
       especiales = "8-37-39-46";
//especiales=['8','37','39','46','9'];
       tecla_especial = false
       //for(var i in especiales){
                for(var i=0,n; n=especiales[i];i++){

            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    $('#btn_error_imagen').click(function(){
    $('#error_imagen').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
    
  });
  });

     $('#cancelar_imagen').click(function(){
    $('#elim_img').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
    
  });
  });

      $('#aceptar_imagen').click(function(){
        $('#inputimagen').val("");
      $('#muestra').attr("src","");
      $('#previewcanvas').hide();
       $('#div_quitar_imagen').hide();
      var f=document.getElementById('foto1');
      var t=document.getElementById('foto1').cloneNode(true);
      t.value='';
      f.parentNode.replaceChild(t,f);
    $('#elim_img').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
    
  });
  });

      $('#quitar_imagen').click(function(){
         $('#elim_img').modal({
                    show:true,
                    backdrop:'static'
                });
      });

        $('.block_mod_btn').click(function(){
         $('#blockeo_mod').modal({
                    show:true,
                    backdrop:'static'
                });
      });
   
    $('.block_elim_btn').click(function(){
         $('#blockeo_elim').modal({
                    show:true,
                    backdrop:'static'
                });
      });
$('#c_herra').hide();
$('#medida2').hide();
/*  function select_medida(){

  var tipo_medida=document.getElementById("tipo_medida").value;

  if(tipo_medida=="Pulgadas"){
    $('#medida1').hide();
    $('#medida2').show();
    document.getElementById('medida_mil').disabled=true;
    document.getElementById('medida_pul').disabled=false;
    document.getElementById('medida2_pul').disabled=false;
  }
  else if(tipo_medida=="Milimetros"){
    $('#medida1').show();
    $('#medida2').hide();
    document.getElementById('medida_pul').disabled=true;
    document.getElementById('medida2_pul').disabled=true;
     document.getElementById('medida_mil').disabled=false;
  }

}
*/
function calculo_importe(){
  var precio = document.getElementById("precio").value;
  var cantidad = document.getElementById("existencia").value;

  var importe;

  importe=precio * cantidad;

$("#importe").val(importe);

}


function min_stock(){
   var cantidad = document.getElementById("existencia").value;
    var min= document.getElementById("minimo").value;
   /*if(min > cantidad){
    alert("El minimo del stock no puede ser mayor a la existencia "+ min +""+cantidad);
    $("#minimo").val("");

   }*/
 cantInt=parseInt(cantidad);
 minInt=parseInt(min);
 if (isNaN(minInt) && isNaN(cantInt)){
          alert("no number");

    }
    else{
      if(minInt > cantInt){
    alert("El minimo del stock no puede ser mayor a la existencia "+ min +""+cantidad);
    $("#recambio").val("");
    
   }
}
}

function calculo_danada(){
  var cantidad = document.getElementById("existencia").value;

  var buenas = document.getElementById("buenas").value;
  var caldanadas;

   cantInt=parseInt(cantidad);
 buenasInt=parseInt(buenas);

 if (isNaN(cantInt) && isNaN(buenasInt)) {
          alert("no number");

    }
    else{
      /*if(buenasInt+danadasInt > cantInt){
    alert("la sumatoria entre buenas y danadas debe dar la existencia");
    $("#recambio").val("");
    
   }*/
   caldanadas=cantInt - buenasInt;
   $("#danadas").val(caldanadas);

}
    
}

function min_recambio(){
   
    var min= document.getElementById("minimo").value;
    var recambio =document.getElementById("recambio").value;
    minInt=parseInt(min);
    recambioInt=parseInt(recambio);
    if (isNaN(minInt) && isNaN(recambioInt)){
          alert("no number");

    }
    else{
      minInt=minInt+10;
      if(recambioInt < minInt){
    alert("por favor coloque sobre el recambio como "+ minInt +" minimo 10 productos sobre el stock minimo");
    $("#recambio").val("");
    
   }
    }
      
  
}


function existeCodigo(){
 var user = document.getElementById("codigo").value;

var consulta;

consulta=$("#codigo").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
var tipo="registro";
  
  if (user=="")
    {
      mostrarPrompt("Campo Requerido", "CodePrompt", "red");
      return false;
    }

  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodePrompt", "red");
      return false;
    }

   $.ajax({
      type:"POST",
      url:"verificar_codigo_herramienta.php",
      data:"codigo="+consultax+"&tipo="+tipo,
      success: function (data){
        
        $('#res').val(data);


        var valor2 = document.getElementById("res").value;
         var code = document.getElementById("codigo").value;

      if (valor2==1)
    {

       mostrarPrompt("Ya en uso", "CodePrompt", "red");
    
    }
   if (valor2==0)
    {
       mostrarPrompt("Valido", "CodePrompt", "green");
  
    }
    /*if (code == ""){
     mostrarPrompt("Campo Requerido", "CodePrompt", "red");

      }*/
    }

    });


 var valor = document.getElementById("res").value;
 /*if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
        return false;
      }*/
 
       if (valor==1)
    {

 
      return false;
    }
   if (valor==0)
    {

     
      return true;
    }
   
     
}

function existeCodigo2(){
 var user = document.getElementById("codigomod").value;

 if (user=="")
    {
      mostrarPrompt("Campo Requerido", "CodemodPrompt", "red");
      return false;
    }

 if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodemodPrompt", "red");
      return false;
    }

  var id= document.getElementById("idmod").value;
var consulta;

consulta=$("#codigomod").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
var tipo="modificacion";
//algo=String(algo);
  if(consulta==""){
    $("#resMC").val("1");
    mostrarPrompt("Valido", "CodemodPrompt", "green");
  }
  else{

   $.ajax({
      type:"POST",
      url:"verificar_codigo_herramienta.php",
      data:"codigo="+consultax+"&id="+id+"&tipo="+tipo,
      success: function (data){
        
        $('#resMC').val(data);

        var valor2 = document.getElementById("resMC").value;
         var code = document.getElementById("codigomod").value;

      if (valor2==0)
    {

       mostrarPrompt("Ya en uso", "CodemodPrompt", "red");
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "CodemodPrompt", "green");
  
    }
  
    }

    });

   }
 var valor = document.getElementById("resMC").value;
 /*if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
        return false;
      }*/
 
       if (valor==0)
    {

 
      return false;
    }
    if(valor==""){
      return true;
    }
   if (valor==1)
    {

     
      return true;
    }
   
     
}


  function validar_Select_NB(){
    var control=document.getElementById("pre_nb").value;
    if (control=="S/NB"){
       $('#NB').hide();
      document.getElementById("NB").disabled=true;
       mostrarPrompt("Valido", "N/BPrompt", "green");
       $('#promptNB').css('margin-left','25px');
    }
    else {
      $('#NB').show();
      document.getElementById("NB").disabled=false;
       mostrarPrompt("", "N/BPrompt", "green");
         $('#promptNB').css('margin-left','-27px');
    }
  }

  function validar_Select_NBmod(){
    var control=document.getElementById("pre_nbmod").value;
    if (control=="S/NB"){
       $('#MNB').hide();
      document.getElementById("MNB").disabled=true;
       mostrarPrompt("Valido", "MN/BPrompt", "green");
       //document.getElementById("promptNBM").style.marginLeft="27px;";
        $('#promptNBM').css('margin-left','20px');
    }
    else {
      $('#MNB').show();
      document.getElementById("MNB").disabled=false;
       mostrarPrompt("", "MN/BPrompt", "green");
      //document.getElementById("promptNBM").style.marginLeft="-27px;";
      $('#promptNBM').css('margin-left','-27px');
    }
  }

  function validar_Select_Serial(){
    var control=document.getElementById("pre_serial").value;
    if (control=="S/Serial"){
       $('#serial').hide();
      document.getElementById("serial").disabled=true;
       mostrarPrompt("Valido", "SerialPrompt", "green");
       $('#promptSerial').css('margin-left','25px');
    }
    else {
      $('#serial').show();
      document.getElementById("serial").disabled=false;
       mostrarPrompt("", "SerialPrompt", "green");
         $('#promptSerial').css('margin-left','-27px');
    }
  }

  function validar_Select_Serialmod(){
    var control=document.getElementById("pre_serialmod").value;
    if (control=="S/Serial"){
       $('#serialmod').hide();
      document.getElementById("serialmod").disabled=true;
       mostrarPrompt("Valido", "SerialmodPrompt", "green");
       $('#promptSerialmod').css('margin-left','25px');
    }
    else {
      $('#serialmod').show();
      document.getElementById("serialmod").disabled=false;
       mostrarPrompt("", "SerialmodPrompt", "green");
         $('#promptSerialmod').css('margin-left','-27px');
    }
  }


function validarN_B()
{
 
 var user = document.getElementById("NB").value;
 var control = document.getElementById("NB");
if (control.disabled==true){
          return true;
}
else{
var consulta1;
  var consulta2;
 

var consulta;


  consulta1=$("#pre_nb").val();
  consulta2=$("#NB").val();
  
  consulta=consulta1 + consulta2;


//se realiza la busqueda
$("#res2").delay().queue(function(n){

  

   $.ajax({
      type:"POST",
      url:"verificar_nb.php",
      data:"nb="+consulta,
      success: function (data){
        
        $('#res2').val(data);
        n();
      }

    });
});

 var valor = document.getElementById("res2").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "N/BPrompt", "red");
        return false;
      }
   if(!user.match(/^[0-9]{4,6}$/)){
        mostrarPrompt("Invalido", "N/BPrompt", "red");
        return false;     
      }
   if(user == '00000'){
         mostrarPrompt("No puede ingresar solo ceros", "N/BPrompt", "red");
        return false;
      }
      if (valor==1)
    {

       mostrarPrompt("Ya registrado", "N/BPrompt", "red");
      return false;
    }
   if (valor==0)
    {
       mostrarPrompt("Esta disponible", "N/BPrompt", "green");
     
      return true;
    }
   

   
     }

}

function validarM_N_B()
{
 var control = document.getElementById("MNB");
if (control.disabled==true){
          return true;
}
else{
 var id= document.getElementById("m_id_nb").value;
 var user = document.getElementById("MNB").value;
var consulta1 = document.getElementById("pre_nbmod").value;
  var consulta2 = document.getElementById("MNB").value;
 

var consulta;



  
  consulta=consulta1 + consulta2;


//se realiza la busqueda
  

   $.ajax({
      type:"POST",
      url:"verificar_nb2.php",
      data:"nb="+consulta+"&id="+id,
      success: function (data){
        
        $('#Mres').val(data);
        
        var valor = document.getElementById("Mres").value;       
         var nb = document.getElementById("MNB").value;
           if (nb=="")
        {
           mostrarPrompt("Campo Requerido", "MN/BPrompt", "red");
          return false;
        }
          if(!nb.match(/^[0-9]{4,6}$/)){
        mostrarPrompt("Invalido", "MN/BPrompt", "red");
        return false;     
      }
        if (valor==0)
        {
           mostrarPrompt("Ya registrado", "MN/BPrompt", "red");
          return false;
        }
       if (valor==1)
        {
           mostrarPrompt("Esta disponible", "MN/BPrompt", "green");
          return true;
        }

      }
 
});
 var valor = document.getElementById("Mres").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "MN/BPrompt", "red");
        return false;
      }
   if(!user.match(/^[0-9]{4,6}$/)){
        mostrarPrompt("Invalido", "MN/BPrompt", "red");
        return false;     
      }
   if(user == '00000'){
         mostrarPrompt("No puede ingresar solo ceros", "MN/BPrompt", "red");
        return false;
      }
      if (valor==0)
        {
          
          return false;
        }
       if (valor==1)
        {
       
          return true;
        }
   
}
      

}

function existeSerial(){
 var control = document.getElementById("serial");
if (control.disabled==true){
          return true;
}
else{
 var user = document.getElementById("serial").value;


var consulta;

consulta=$("#serial").val();
var consultax;
var tipo="registro";
//consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);



   $.ajax({
      type:"POST",
      url:"verificar_serial_herramienta.php",
      data:"codigo="+consulta+"&tipo="+tipo,
      success: function (data){
        
        $('#resS').val(data);


        var valor2 = document.getElementById("resS").value;
         var code = document.getElementById("serial").value;

    
      if (valor2==1)
    {

      mostrarPrompt("Valido", "SerialPrompt", "green");
    
    }
   if (valor2==0)
    {
       mostrarPrompt("Valido", "SerialPrompt", "green");
  
    }
      if(!code.match(/^[0-9]{4,6}$/)){
        mostrarPrompt("Invalido, coloque más de cuatro números", "SerialPrompt", "red");
           
      }
    /*if (code == ""){
     mostrarPrompt("Campo Requerido", "CodePrompt", "red");

      }*/
    }

    });


 var valor = document.getElementById("resS").value;
 /*if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
        return false;
      }*/
    if(!user.match(/^[0-9]{4,6}$/)){
     
        return false;     
      }
       if (valor==1)
    {

 
      return true;
    }
   if (valor==0)
    {

     
      return true;
    }
    }
   
     
}

function existeSerial2(){
   var control = document.getElementById("serialmod");
if (control.disabled==true){
          return true;
}
else{

 var user = document.getElementById("serialmod").value;

var consulta;

consulta=$("#serialmod").val();
var consultax;
var tipo="modificacion";
//consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
 var id= document.getElementById("idmod").value;


   $.ajax({
      type:"POST",
      url:"verificar_serial_herramienta.php",
      data:"codigo="+consulta+"&id="+id+"&tipo="+tipo,
      success: function (data){
        
        $('#resMS').val(data);


        var valor2 = document.getElementById("resMS").value;
         var code = document.getElementById("serialmod").value;

    
      if (valor2==0)
    {

       mostrarPrompt("Valido", "SerialmodPrompt", "green");
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "SerialmodPrompt", "green");
  
    }
      if(!code.match(/^[0-9]{4,6}$/)){
        mostrarPrompt("Invalido, coloque más de cuatro números", "SerialmodPrompt", "red");
           
      }
    /*if (code == ""){
     mostrarPrompt("Campo Requerido", "CodePrompt", "red");

      }*/
    }

    });


 var valor = document.getElementById("resMS").value;
 /*if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
        return false;
      }*/
    if(!user.match(/^[0-9]{4,6}$/)){
     
        return false;     
      }
       if (valor==0)
    {

 
      return true;
    }
   if (valor==1)
    {

     
      return true;
    }
   }
     
}

function validarEstante(){
  //myString=$.trim(mystring);
  var estante = document.getElementById("estante").value;
  //marca=$.trim(marca);
  if(estante==""){
     mostrarPrompt("Campo Requerido", "EstantePrompt", "red");
    return false;
  }

   if (!estante.match(/^[0-9]{1,2}$/))
    {
      mostrarPrompt("Invalido, coloque solo números", "EstantePrompt", "red");
      return false;
    }
  else{
mostrarPrompt("Valido", "EstantePrompt", "green");
  return true;
}
}

function validarEstantemod(){
  //myString=$.trim(mystring);
  var estante = document.getElementById("estantemod").value;
  //marca=$.trim(marca);
  if(estante==""){
     mostrarPrompt("Campo Requerido", "EstantemodPrompt", "red");
    return false;
  }

   if (!estante.match(/^[0-9]{1,2}$/))
    {
      mostrarPrompt("Invalido, coloque solo números", "EstantemodPrompt", "red");
      return false;
    }
  else{
mostrarPrompt("Valido", "EstantemodPrompt", "green");
  return true;
}
}

function validarMarca(){
  //myString=$.trim(mystring);
  var marca = document.getElementById("marca").value;
  //marca=$.trim(marca);
  if (marca.match(/^\s/))
    {
      mostrarPrompt("Invalido", "marcaPrompt", "red");
      return false;
    }

   if(marca==""){
     mostrarPrompt("Campo Requerido", "marcaPrompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "marcaPrompt", "green");
  return true;
}
}

function validarM_Marca(){
  var marca = document.getElementById("marcamod").value;

  if (marca.match(/^\s/))
    {
      mostrarPrompt("Invalido", "marcamodPrompt", "red");
      return false;
    }

   if(marca==""){
     mostrarPrompt("Campo Requerido", "marcamodPrompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "marcamodPrompt", "green");
  return true;
}
}


function validarUbicacion(){
  var ubicacion = document.getElementById("ubicacion").value;
  
  if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "ubicacionPrompt", "red");
      return false;
    }

   if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "ubicacionPrompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "ubicacionPrompt", "green");
  return true;
}
}

function validarM_Ubicacion(){
  var ubicacion = document.getElementById("ubicacionmod").value;

  if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "ubicacionmodPrompt", "red");
      return false;
    }

   if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "ubicacionmodPrompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "ubicacionmodPrompt", "green");
  return true;
}
}

$('#btn_error_incompleto').click(function(){
    $('#error_incompleto').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
    
  });
  });

function validarmodform(){
   if( !validarM_N_B() || !validarM_Nombre() || !validarM_Ubicacion() || !validarEstantemod() ||  !existeSerial2() || !validarM_Marca() || !validarMedidamod() || !validarExistencia2()){
        jsMostrar("salidaM_INS");
        
        mostrarPrompt("El formulario debe estar completo", "salidaM_INS", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaM_INS");
        }, 2000);
        
        return false;
    } 
    return true;  
}


function validarMedida(){
  var medida = document.getElementById("medida_mil").value;
   var medida1 = document.getElementById("medida_pul").value;
  var medida_estado = document.getElementById("medida_mil");
   var medida1_estado = document.getElementById("medida_pul");
  if (medida_estado.disabled==false){
  if (medida == ""){
       mostrarPrompt("Campo Requerido", "medidaPrompt", "red");
    return false;
   
  }
    else if (!medida.match(/^[ 0-9a-zA-Z%\/]{1,}/)){
        mostrarPrompt("Invalido", "medidaPrompt", "red");
        return false;     
      }
  
  else{
      mostrarPrompt("Valido", "medidaPrompt", "green");
    return true;
  }
}
else if(medida1_estado.disabled==false)
{
  if(medida1==""){
     mostrarPrompt("Campo Requerido", "medida1Prompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "medida1Prompt", "green");
  return true;
}
}
}
function validarExistencia(){
  var existencia = document.getElementById("existencia").value;
   if(existencia==""){
     mostrarPrompt("Campo Requerido", "existenciaPrompt", "red");
    return false;
  }
  else if (!existencia.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "existenciaPrompt", "red");
        return false;     
      }
  else{
mostrarPrompt("Valido", "existenciaPrompt", "green");
  return true;
}
}

function validarExistencia2(){
  var existencia = document.getElementById("existenciamod").value;
   if(existencia==""){
     mostrarPrompt("Campo Requerido", "existenciamodPrompt", "red");
    return false;
  }
    else if (!existencia.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "existenciamodPrompt", "red");
        return false;     
      }
  else{
mostrarPrompt("Valido", "existenciamodPrompt", "green");
  return true;
}
}


function validarNombre(){
  var nombre = document.getElementById("nombre").value;

  if (nombre.match(/^\s/))
    {
      mostrarPrompt("Invalido", "nombrePrompt", "red");
      return false;
    }

  if (nombre == ""){
       mostrarPrompt("Campo Requerido", "nombrePrompt", "red");
    return false;
   
  }
  
  else{
      mostrarPrompt("Valido", "nombrePrompt", "green");
    return true;
  }

}

function validarM_Nombre(){
  var nombre = document.getElementById("nombremod").value;
  
  if (nombre.match(/^\s/))
    {
      mostrarPrompt("Invalido", "nombremodPrompt", "red");
      return false;
    }

  if (nombre == ""){
       mostrarPrompt("Campo Requerido", "nombremodPrompt", "red");
    return false;
   
  }
  
  else{
      mostrarPrompt("Valido", "nombremodPrompt", "green");
    return true;
  }

}
/*
function validarNombre(){
  //var nombre = document.getElementById("nombre").value;





 var user = document.getElementById("nombre").value;

var consulta;
var tipo=document.getElementById('tipo').value;

consulta=$("#nombre").val();
//var consultax;
//consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
   $.ajax({
      type:"POST",
      url:"verificar_nombre_herramienta.php",
        data:"nombre="+consulta+"&tipo="+tipo,
      success: function (data){
        
        $('#resn').val(data);


        var valor2 = document.getElementById("resn").value;
         var code = document.getElementById("nombre").value;

      if (valor2==1)
    {

       mostrarPrompt("Ya en uso", "nombrePrompt", "red");
    
    }
   if (valor2==0)
    {
       mostrarPrompt("Valido", "nombrePrompt", "green");
  
    }
    if (code == ""){
     mostrarPrompt("Campo Requerido", "nombrePrompt", "red");

      }
    }

    });


 var valor = document.getElementById("resn").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "nombrePrompt", "red");
        return false;
      }
 
       if (valor==1)
    {

 
      return false;
    }
   if (valor==0)
    {

     
      return true;
    }
   
*/
//---------------------------------------
  /*
  


  if (nombre == ""){
       mostrarPrompt("Campo Requerido", "nombrePrompt", "red");
    return false;
   
  }
  
  else{
      mostrarPrompt("Valido", "nombrePrompt", "green");
    return true;
  }

}

*//*
function validarM_Nombre(){
  //var nombre = document.getElementById("nombre").value;





 var user = document.getElementById("nombremod").value;
 var id=document.getElementById("idmod").value;
var consulta;
var tipo=document.getElementById('Mtipo').value;
consulta=$("#nombremod").val();
 var id= document.getElementById("idmod").value;
//var consultax;
//consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
   $.ajax({
      type:"POST",
      url:"verificar_nombre_insumo.php",
      data:"nombre="+consulta+"&tipo="+tipo+"&id="+id,
      success: function (data){
        
        $('#Mresn').val(data);
   

        var valor2 = document.getElementById("Mresn").value;
         var code = document.getElementById("nombremod").value;

      if (valor2==0)
    {

       mostrarPrompt("Ya en uso", "Nombre2Prompt", "red");
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "Nombre2Prompt", "green");
  
    }
    if (code == ""){
     mostrarPrompt("Campo Requerido", "Nombre2Prompt", "red");

      }
    }

    });


 var valor = document.getElementById("Mresn").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "Nombre2Prompt", "red");
        return false;
      }
 
       if (valor==0)
    {

 
      return false;
    }
   if (valor==1)
    {

     
      return true;
    }
   
*/
//---------------------------------------
  /*
  


  if (nombre == ""){
       mostrarPrompt("Campo Requerido", "nombrePrompt", "red");
    return false;
   
  }
  
  else{
      mostrarPrompt("Valido", "nombrePrompt", "green");
    return true;
  }

}

*/
function validarForm()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!validarNombre() || !validarN_B() || !existeSerial() || !validarMarca() || !validarEstante() || !validarUbicacion() || !validarMedida() || !validarExistencia() ){
   jsMostrar("salidaR_INS");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_INS", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_INS");
        }, 2000);
        
        return false;
    } 
    return true;
}

 

function valida_fechamod(){

        var url='buscar_fecha_igual.php';

        var fecha=document.getElementById('fechaprestamomod').value;


        var id=document.getElementById('ids_mant_mod').value;
        var valor2 = document.getElementById("resultado_fechamod").value;
 
        var primera = Date.parse(fecha); //01 de Octubre del 2013

  var d = new Date();
      var month = d.getMonth();
var day = d.getDate()+1;
var year = d.getFullYear();

      var dateNext=new Date(year, month, day);
      
      var segunda = Date.parse(dateNext); 
        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
             data:'fecha='+fecha+'&id='+id,
            success:function(valores){
                var datos=eval(valores);
                $("#resultado_fechamod").val(datos[0]);
                   var valor = document.getElementById("resultado_fechamod").value;
                  
                   
      if (valor==""){
         mostrarPrompt("Campo Requerido", "fechamodPrompt", "red");
      }

      if (valor=="igual")
    {

       mostrarPrompt("Ya se realizo una revision esta fecha", "fechamodPrompt", "red");
   
    }
   if (valor=="valido")
    {

             
       mostrarPrompt("Valido", "fechamodPrompt", "green");
     
  }
             if(primera>segunda){
      mostrarPrompt("La fecha debe ser menor o igual al dia de hoy", "fechamodPrompt", "red");
 
}
            }
        });

if(primera>segunda){

  return false;
}

          if (valor2==""){
         mostrarPrompt("Campo Requerido", "fechamodPrompt", "red");
         return false;
      }
        if (valor2=="igual")
    {

      return false;
    }
       
   if (valor2=="valido")
    {

     
      return true;
  }

   

    }

function validarForm_mod()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !valida_fechamod() ){
        $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;
    } 
    return true;
}

//-----------------------Prestamo Interno-------------

function validarForm_PInterno()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!validarCI() || !validarFecha() || !validarFecha2() || !validarResponsable() || !validarCIResponsable() ){
     /*   $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);*/
        jsMostrar("control_herra_P");
        
        mostrarPrompt("El formulario debe estar completo", "control_herra_P", "red");
        
        setTimeout(function()
        {
          jsOcultar("control_herra_P");
        }, 2000);

        return false;
    } 
    return true;
}

function validarForm_PmodInterno()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validarDevolucion()){
       
        jsMostrar("control_herra_D");
        
        mostrarPrompt("El formulario debe estar completo", "control_herra_D", "red");
        
        setTimeout(function()
        {
          jsOcultar("control_herra_D");
        }, 2000);

        return false;
    } 
    return true;
}

 function Prestamo(id){

        var url='modifica_herramientas.php';
        
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
                $('#idH').val(id);
          //      $('#codigoP').val(datos[1]);
                $('#nombreP').val(datos[2]);
               
                    if (datos[3]=="S/NB"){
                        $('#NBP').val("S/NB");
                        //document.getElementById('MNB').disabled=true;
                    }
                    else{
                      $('#NBP').val("NB-"+datos[4]);
                     // $('#MNB').show();
                 
                    }

                
                $('#prestamo_modal').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };
function select_estado2(){

  var tipo=document.getElementById("estadomodP").value;

  if(tipo=="Activo"){
   
    $('#divdevolucion').hide();
    document.getElementById('devolucion').disabled=true;
    
  }
  else if(tipo=="Concluido"){
    $('#divdevolucion').show();
    
    document.getElementById('devolucion').disabled=false;
  
  }

}
//----------------------End Prestamo Interno-----------

//----------------------prestamos-----------


function existeNB(){
 //var user = document.getElementById("codigo").value;


        var consulta;

  
  consulta=$("#codigo").val();
  consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
//var tipo="registro";
//+"&tipo="+tipo  
  
   $.ajax({
      type:"POST",
      url:"verificar_code_herramienta.php",
      data:"codigo="+consultax,
      success: function (data){
        
        $('#res').val(data);
        
        var valor2 = document.getElementById("res").value;
         var code = document.getElementById("codigo").value;

      if (valor2==2){
       mostrarPrompt("En prestamo", "N/BPrompt", "red");

      }
      if (valor2==0)
    {

       mostrarPrompt("No existe", "N/BPrompt", "red");
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "N/BPrompt", "green");
  
    }
    /*if (code == ""){
     mostrarPrompt("Campo Requerido", "CodePrompt", "red");

      }*/
    }

    });


 var valor = document.getElementById("res").value;
 /*if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
        return false;
      }*/
  
    if (valor==2){
      return false;
    }
       if (valor==0)
    {

 
      return false;
    }
   if (valor==1)
    {

     
      return true;
    }
   
     
}

function validarCI()
{
    var user = document.getElementById("ci_usu").value;    
    var nac = document.getElementById("nac_usu").value;

    var ci=nac+user;

  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_per", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "C.I_per", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,9}$/)){
        mostrarPrompt("Invalido", "C.I_per", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_ci.php",
      data:"ci="+ci,
      success: function (data){
        $('#validar_ci_ajax').val(data);

        var valor2 = document.getElementById("validar_ci_ajax").value;

    if (valor2==1)
    {
      mostrarPrompt("Valido", "C.I_per", "green");

    }
    if (valor2==0)
    {
      mostrarPrompt("No existe", "C.I_per", "red");
 
    }
        
      }
    });

    var valor = document.getElementById("validar_ci_ajax").value;

    if (valor==1)
    {

      return true;
    }
    if (valor==0)
    {
   
      return false;
    }

/*       mostrarPrompt("Valido", "C.I_per", "green");
        return true;
*/
}


function validarCIResponsable()
{
    var user = document.getElementById("ci_res").value;    
    var nac = document.getElementById("nac_res").value;

    var ci=nac+user;

  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "ciresponsablePrompt", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "ciresponsablePrompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,9}$/)){
        mostrarPrompt("Invalido", "ciresponsablePrompt", "red");
        return false;     
      }

      else{
         mostrarPrompt("Valido", "ciresponsablePrompt", "green");
         return true;   
      }


    

/*       mostrarPrompt("Valido", "C.I_per", "green");
        return true;
*/
}








function validarResponsable(){

    var user = document.getElementById("responsable").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "responsablePrompt", "red");
        return false;
      }
    if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "responsablePrompt", "red");
      return false;
    }
    if(!user.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,]{1,}$/)){
        mostrarPrompt("Invalido", "responsablePrompt", "red");
        return false;     
      }
       mostrarPrompt("Valido", "responsablePrompt", "green");
        return true;

}

function validarFecha(){

    var user = document.getElementById("fecha").value;
       var split_fecha;
        var fecha=document.getElementById('fecha').value;

        split_fecha = fecha.split("/");

        fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];
          var primera = Date.parse(fecha); //01 de Octubre del 2013
          var d = new Date();
          var month = d.getMonth();
    var day = d.getDate()+1;
    var year = d.getFullYear();

          var dateNext=new Date(year, month, day);
          
          var segunda = Date.parse(dateNext); 
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "fechaPrompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/)){
        mostrarPrompt("Invalido", "fechaPrompt", "red");
        return false;     
      }
    if(primera>segunda){
      mostrarPrompt("La fecha debe ser <br> menor  o igual al <br> dia de hoy", "fechaPrompt", "red");
 
  return false;
}

       mostrarPrompt("Valido", "fechaPrompt", "green");
        return true;

}

function validarFecha2(){
        var user = document.getElementById("fecha").value;

    var user2 = document.getElementById("fecha2").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "fecha2Prompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/)){
        mostrarPrompt("Invalido", "fecha2Prompt", "red");
        return false;     
      }
   else if(user>user2){
        mostrarPrompt("La fecha tentativa de <br> devolucion no puede ser menor <br>  a la fecha del prestamo", "fecha2Prompt", "red");
             return false;
       } 
       mostrarPrompt("Valido", "fecha2Prompt", "green");
        return true;

}

function select_estado(){

  var tipo=document.getElementById("estadomod").value;

  if(tipo=="Activo"){
   
    $('#divdevolucion').hide();
    document.getElementById('devolucion').disabled=true;
    
  }
  else if(tipo=="Concluido"){
    $('#divdevolucion').show();
    
    document.getElementById('devolucion').disabled=false;
  
  }

}

function validarDevolucion(){
  var devolucion=document.getElementById("devolucion").value;
  var fecha=document.getElementById("fechaprestamomod").value;
 var estado=document.getElementById("devolucion").disabled;

      if(estado==true){
          return true;
        }
        else{
      if (devolucion == ""){
       mostrarPrompt("Campo Requerido", "devolucionPrompt", "red");

        return false;
      }
       else if(fecha>devolucion){
        mostrarPrompt("La fecha de devolucion no puede ser menor a la fecha del prestamo", "devolucionPrompt", "red");
             return false;
       } 
      else{
      mostrarPrompt("Valido", "devolucionPrompt", "green");

        return true;

      }
      }
        }

function validarForm_P()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !existeNB() || !validarCI() || !validarFecha() || !validarFecha2() || !validarResponsable()  || !validarCIResponsable() ){
        $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;
    } 
    return true;
}


function validarForm_Pmod()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validarDevolucion()){
        $('#error_incompletomod').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;
    } 
    return true;
}


function validarMedidamod(){
     var medida = document.getElementById("medidamod").value;
 //  var medida1 = document.getElementById("medida_pul").value;
 var medida_estado = document.getElementById("medidamod");
  // var medida1_estado = document.getElementById("medida_pul");
  if (medida_estado.disabled==false){

  var tipo=$('#tipo_medidamod').val();
  if (medida == ""){
       mostrarPrompt("Campo Requerido", "medidamodPrompt", "red");
    return false;
   
  }

  else if(tipo=='Pulgadas'){

     if (!medida.match(/^[ 0-9a-zA-Z%\/]{1,}/))
    {
      mostrarPrompt("Invalido, evite colocar comillas", "medidamodPrompt", "red");
          return false;
    }
    else{
      mostrarPrompt("Valido", "medidamodPrompt", "green");
      return true;
    }
  }
  
  else if(tipo=='Milimetros'){
    if(!medida.match(/^[ 0-9a-zA-Z%\/]{1,}/)){
      mostrarPrompt("Invalido, evite colocar comillas", "medidamodPrompt", "red");
      return false;
    }
     else{
    mostrarPrompt("Valido", "medidamodPrompt", "green");
    return true;
  }
  }
  else{
    mostrarPrompt("Valido", "medidamodPrompt", "green");
    return true;
  }
}

}


/*function opciontipomedidamod(){
  var tipo=document.getElementById('tipo_medidamod').value;

   if(tipo=='Pulgadas'){
    var medida=$('#medidamod').val();
     document.getElementById('medidamod').disabled=false;
    $('#div_medidaM1').show();
    //$('#medidamod').val("");
    if (medida==""){
       mostrarPrompt("Campo Requerido", "medidamodPrompt", "red");
          return false;
    }
    else if (!medida.match(/^([0-9]{1,2}|[0-9]{1,2}\/([1-9]{1}|[1-9]{1}[0-9]{1}))?$/))
    {
      mostrarPrompt("Invalido", "medidamodPrompt", "red");
      $('#medidamod').val("");
          return false;
    }
    else{
      return true;
    }
  }
   else if(tipo=='Milimetros'){
     var medida=$('#medidamod').val();
     document.getElementById('medidamod').disabled=false;
    $('#div_medidaM1').show();
    //$('#medidamod').val("");
    if (medida==""){
       mostrarPrompt("Campo Requerido", "medidamodPrompt", "red");
          return false;
    }
     else if (!medida.match(/^[0-9]{1,5}$/))
    {
      mostrarPrompt("Invalido", "medidamodPrompt", "red");
          $('#medidamod').val("");
          return false;
    }
    else{
      return true;
    }
  }
}
*/

 function Devoluciones(id){

        var url='modifica_prestamos.php';
        
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);

               $('#idP').val(datos[0]);
                $('#fechaprestamomod').val(datos[1]);
                $('#encargadomod').val(datos[2]);
                $('#responsablemod').val(datos[3]);
                $('#estadomodP').val(datos[4]);
                
                if(datos[4]=='Activo')
                {
                    $('#divdevolucion').hide();
                    document.getElementById('devolucion').disabled=true;
               
                }
                $('#id_herramod').val(datos[5]);

        
                $('#modif_prestamo').modal({
                    show:true,
                    backdrop:'static'
                });

                $("#fechaprestamomod").attr('readonly',true);

        $("#fechaprestamomod").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: datos[1],
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });
                
              
            }
        });
    };



     function DevolucionV(id){

        var url='modifica_prestamo.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
               $('#idP').val(datos[0]);
                $('#fechaprestamomod').val(datos[1]);
                $('#encargadomod').val(datos[2]);
                $('#responsablemod').val(datos[3]);
                $('#estadomodP').val(datos[4]);
                
                if(datos[4]=='Activo')
                {
                    $('#divdevolucion').hide();
                    document.getElementById('devolucion').disabled=true;
               
                }
                $('#id_herramod').val(datos[5]);
                $('#c_herra').show();
                $('#consulta_herra').hide(); 

            }
        });

              $.ajax({
            type:'POST',
            url:'buscar_herramienta.php',
            data:'id='+id,
            success: function(valores){
                
                
                $('#tbody_consultaClau').html(valores);
                 
                 $('#dataTables-exampleClausulas').DataTable({
              responsive: true
        });
            }
        });
}



function jsMostrar(id)
{
    document.getElementById(id).style.display = "block";  
}

function jsOcultar(id)
{
    document.getElementById(id).style.display = "none"; 
}

function mostrarPrompt(mensaje, ubicacion, color)
{
        document.getElementById(ubicacion).innerHTML = mensaje;
        document.getElementById(ubicacion).style.color = color;
}
