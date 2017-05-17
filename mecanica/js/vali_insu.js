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
especiales=['8','9'];
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


   /* function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
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
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
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

        if(letras.indexOf(tecla)==-1 ){
            return false;
        }
    }

       function solonum3(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890";

        if(letras.indexOf(tecla)==-1 ){
            return false;
        }
    }*/

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
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890,.";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
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
       letras = " -áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

  $('#medida2').hide();

  $('#medida3').hide();
/*var medida =document.getElementById("medida_mil");
medida.readOnly=true; //añade el atributo solo lectura

  $('#tipo_medida').click(function(){
   medida.readOnly=false;
    
  });*/
    document.getElementById('medida_maquina').disabled=true;

  function select_medida(){

  var tipo_medida=document.getElementById("tipo_medida").value;

  if(tipo_medida=="Pulgadas"){
  /*  $('#medida1').hide();
    $('#medida2').show();
    $('#medida3').hide();
    document.getElementById('medida_mil').disabled=true;*/
    document.getElementById('medida_maquina').disabled=true;
    /*document.getElementById('medida_pul').disabled=false;
    document.getElementById('medida2_pul').disabled=false;*/
  }
   if(tipo_medida=="Milimetros"){
    $('#medida1').show();
    $('#medida2').hide();
    $('#medida3').hide();
    document.getElementById('medida_maquina').disabled=true;
    document.getElementById('medida_pul').disabled=true;
    document.getElementById('medida2_pul').disabled=true;
     document.getElementById('medida_mil').disabled=false;
  }
   else if(tipo_medida=="Maquina"){
    $('#medida3').show();
    $('#medida1').hide();
    $('#medida2').hide();
    document.getElementById('medida_maquina').disabled=false;
    document.getElementById('medida_pul').disabled=true;
    document.getElementById('medida2_pul').disabled=true;
     document.getElementById('medida_mil').disabled=true;
  }

}

function calculo_importe(){
  var precio = document.getElementById("precio").value;
  var cantidad = document.getElementById("existencia").value;

  var importe;

  importe=precio * cantidad;

$("#importe").val(importe);

}

function calculo_importe2(){
  var precio = document.getElementById("preciomod").value;
  var cantidad = document.getElementById("existenciamod").value;

  var importe;

  importe=precio * cantidad;

$("#importemod").val(importe);

}

function min_stock(){
   var cantidad = document.getElementById("existencia").value;
    var min= document.getElementById("minimo").value;

     if(min==""){
   mostrarPrompt("Campo Requerido", "minimoPrompt", "red");
   return false;
   }
     else if (!min.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "minimoPrompt", "red");
        return false;     
      }
   else{
    mostrarPrompt("Valido", "minimoPrompt", "green");
    return true;
   }
   
   max_stock()
}

function min_stockmod(){
   var cantidad = document.getElementById("existenciamod").value;
    var min= document.getElementById("minimomod").value;

     if(min==""){
   mostrarPrompt("Campo Requerido", "minimomodPrompt", "red");
   return false;
   }
     else if (!min.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "minimomodPrompt", "red");
        return false;     
      }
   else{
    mostrarPrompt("Valido", "minimomodPrompt", "green");
    return true;
   }
   /*if(min > cantidad){
    alert("El minimo del stock no puede ser mayor a la existencia "+ min +""+cantidad);
    $("#minimo").val("");

   }*/
/* cantInt=parseInt(cantidad);
 minInt=parseInt(min);
 if (isNaN(minInt) && isNaN(cantInt)){
          alert("no number");

    }
    else{
      if(minInt > cantInt){
    alert("El minimo del stock no puede ser mayor a la existencia "+ min +""+cantidad);
    $("#recambio").val("");
        mostrarPrompt("", "minimoPrompt", "red");

   }
}*/
}

function max_stock(){
   var cantidad = document.getElementById("existencia").value;
    var max= document.getElementById("maximo").value;
    var min =document.getElementById("minimo").value;
     
    maxint=parseInt(max);
    minint=parseInt(min);
    cantidad=parseInt(cantidad);


     if(max==""){
   mostrarPrompt("Campo Requerido", "maximoPrompt", "red");
   return false;
   }
     else if (!max.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "maximoPrompt", "red");
        return false;     
      }
    else if(maxint<minint){
           mostrarPrompt("El stock maximo es menor al stock minimo", "maximoPrompt", "red");
              return false;

   }
   else if(cantidad>max){
       mostrarPrompt("La existencia es mayor al stock maximo", "maximoPrompt", "red");
   return true;
   }

   else{
      mostrarPrompt("Valido", "maximoPrompt", "green");
    return true;
   }
}

function max_stockmod(){
   var cantidad = document.getElementById("existenciamod").value;
    var max= document.getElementById("maximomod").value;
     var maxi= document.getElementById("maximomod").value;
    cantidad=parseInt(cantidad);
    max=parseInt(max);
        var min =document.getElementById("minimomod").value;

      minint=parseInt(min);

     if(maxi==""){
   mostrarPrompt("Campo Requerido", "maximomodPrompt", "red");
   return false;
   }
    else if (!maxi.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "maximomodPrompt", "red");
        return false;     
      }
   else if(max<minint){
       mostrarPrompt("El stock maximo es menor al stock minimo", "maximomodPrompt", "red");
    return false;
   }
   else if(cantidad>max){
       mostrarPrompt("La existencia es mayor al stock maximo", "maximomodPrompt", "red");
   return true;
   }
   else{
      mostrarPrompt("Valido", "maximomodPrompt", "green");
    return true;
   }
   /*if(min > cantidad){
    alert("El minimo del stock no puede ser mayor a la existencia "+ min +""+cantidad);
    $("#minimo").val("");

   }*/
/* cantInt=parseInt(cantidad);
 minInt=parseInt(min);
 if (isNaN(minInt) && isNaN(cantInt)){
          alert("no number");

    }
    else{
      if(minInt > cantInt){
    alert("El minimo del stock no puede ser mayor a la existencia "+ min +""+cantidad);
    $("#recambio").val("");
        mostrarPrompt("", "minimoPrompt", "red");

   }
}*/
}

function calculo_danada(){
  var cantidad = document.getElementById("existencia").value;

  var buenas = document.getElementById("buenas").value;
  var caldanadas;
  var danadas = document.getElementById("danadas").value;
  // cantInt=parseInt(cantidad);
 //buenasInt=parseInt(buenas);
/*
 if (isNaN(cantInt) && isNaN(buenasInt)) {
          alert("no numberc");

    }
    else{
      /*if(buenasInt+danadasInt > cantInt){
    alert("la sumatoria entre buenas y danadas debe dar la existencia");
    $("#recambio").val("");
    
   }*/
   caldanadas=cantidad-buenas;
   //caldanadas=cantInt - buenasInt;
   if(caldanadas<0){
    //alert("error no puede ser menor a 0");
    mostrarPrompt("No puede ser menor a 0", "danadasPrompt", "red");
    $("#danadas").val("");
    return false;
   }
   else{

   $("#danadas").val(caldanadas);
      mostrarPrompt("Valido", "danadasPrompt", "green");

   return true;
 }
//}
    if(danadas==""){
   mostrarPrompt("Campo Requerido", "danadasPrompt", "red");
   return false;
   }
}
  
function calculo_danada2(){
  var cantidad = document.getElementById("existenciamod").value;

  var buenas = document.getElementById("buenasmod").value;
  var caldanadas;
  var danadas = document.getElementById("danadasmod").value;
  // cantInt=parseInt(cantidad);
 //buenasInt=parseInt(buenas);
/*
 if (isNaN(cantInt) && isNaN(buenasInt)) {
          alert("no number");

    }
    else{
      /*if(buenasInt+danadasInt > cantInt){
    alert("la sumatoria entre buenas y danadas debe dar la existencia");
    $("#recambio").val("");
    
   }*/
   caldanadas=cantidad-buenas;
   //caldanadas=cantInt - buenasInt;
   if(caldanadas<0){
    //alert("error no puede ser menor a 0");
    mostrarPrompt("No puede ser menor a 0", "danadasmodPrompt", "red");
    $("#danadasmod").val("");
    return false;
   }
   else{

   $("#danadasmod").val(caldanadas);
      mostrarPrompt("Valido", "danadasmodPrompt", "green");

   return true;
 }
//}
    if(danadas==""){
   mostrarPrompt("Campo Requerido", "danadasmodPrompt", "red");
   return false;
   }
}


function min_recambio(){
   
    var min= document.getElementById("minimo").value;
    var recambio =document.getElementById("recambio").value;
    minInt=parseInt(min);
    recambioInt=parseInt(recambio);

    if (recambio==""){
         mostrarPrompt("Campo Requerido", "recambioPrompt", "red");
         return false;
    }

   // if (isNaN(minInt) && isNaN(recambioInt)){
          //alert("no number");

    //}
   /* else{
      minInt=minInt+10;
      if(recambioInt < minInt){
    alert("por favor coloque sobre el recambio como "+ minInt +" minimo 10 productos sobre el stock minimo");
    $("#recambio").val("");
    return false;
   }*/
   else{
   mostrarPrompt("Valido", "recambioPrompt", "green");

    return true;
   }
  //  }
      
  
}

function min_recambiomod(){
   
    var min= document.getElementById("minimomod").value;
    var recambio =document.getElementById("recambiomod").value;
    minInt=parseInt(min);
    recambioInt=parseInt(recambio);

    if (recambio==""){
         mostrarPrompt("Campo Requerido", "recambiomodPrompt", "red");
         return false;
    }

   // if (isNaN(minInt) && isNaN(recambioInt)){
          //alert("no number");

    //}
   /* else{
      minInt=minInt+10;
      if(recambioInt < minInt){
    alert("por favor coloque sobre el recambio como "+ minInt +" minimo 10 productos sobre el stock minimo");
    $("#recambio").val("");
    return false;
   }*/
   else{
   mostrarPrompt("Valido", "recambiomodPrompt", "green");

    return true;
   }
  //  }
      
  
}

function existeCodigo(){
 var user = document.getElementById("codigo").value;

var consulta;

consulta=$("#codigo").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
var tipo="registro";
  
  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodePrompt", "red");
      return false;
    }


   $.ajax({
      type:"POST",
      url:"verificar_codigo_insumo.php",
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
    if (code == ""){
     mostrarPrompt("Campo Requerido", "CodePrompt", "red");

      }
    }

    });


 var valor = document.getElementById("res").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
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

function existeCodigo2(){
 var user = document.getElementById("codigomod").value;
  var id= document.getElementById("idmod").value;
var consulta;

consulta=$("#codigomod").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
var tipo="modificacion";
//algo=String(algo);

  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodemodPrompt", "red");
      return false;
    }

   $.ajax({
      type:"POST",
      url:"verificar_codigo_insumo.php",
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
      if (code == ""){
     mostrarPrompt("Campo Requerido", "CodemodPrompt", "red");

      }
  
    }

    });

   
 var valor = document.getElementById("resMC").value;
 /*if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
        return false;
      }*/
     if(user.length == 0){

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
         var user = document.getElementById("MNB").value;
          if(user.length == 0){
         mostrarPrompt("Campo Requerido", "MN/BPrompt", "red");
        return false;
      }
   if(!user.match(/^[0-9]{4,6}$/)){
        mostrarPrompt("Invalido", "MN/BPrompt", "red");
        return false;     
      }
        if (valor==0)
        {
           mostrarPrompt("Registrado", "MN/BPrompt", "red");
          return false;
        }
       if (valor==1)
        {
           mostrarPrompt("Disponible", "MN/BPrompt", "green");
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

$('#btn_error_incompleto').click(function(){
    $('#error_incompleto').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
    
  });
  });

function validarmodform(){
   if(!validarUbicacion2() || !validarM_Nombre() || !validarM_N_B() ||  !validarEstantemod() || !validarMedidamod() || !validarPrecio2() ||!validarExistencia2() || !validarBuenas2() || !calculo_danada2()  || !min_stockmod() || !max_stockmod() ){
        /*$('#error_incompletomod').modal({
                    show:true,
                    backdrop:'static'
                });

        setTimeout(function(){
          $('#error_incompleto').modal('hide');
         $('#error_incompleto').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
});
        },10000);
        return false;*/
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
     var medida3 = document.getElementById("medida_maquina").value;
  var medida_estado = document.getElementById("medida_mil");
   var medida1_estado = document.getElementById("medida_pul");
    var medida3_estado = document.getElementById("medida_maquina");
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
else if(medida3_estado.disabled==false)
{
  if(medida3==""){
     mostrarPrompt("Campo Requerido", "medida3Prompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "medida3Prompt", "green");
  return true;
}
}
}

function validarMedidamod(){
     var medida = document.getElementById("medidamod").value;
 //  var medida1 = document.getElementById("medida_pul").value;
    var medida3 = document.getElementById("medida_maquinamod").value;
 var medida_estado = document.getElementById("medidamod");
  // var medida1_estado = document.getElementById("medida_pul");
    var medida3_estado = document.getElementById("medida_maquinamod");
  if (medida_estado.disabled==false){

  var tipo=$('#tipo_medidamod').val();
  if (medida == ""){
       mostrarPrompt("Campo Requerido", "medidamodPrompt", "red");
    return false;
   
  }
/*
  else if(tipo=='Pulgadas'){

     if (!medida.match(/^([0-9]{1,2}|[0-9]{1,2}\/([1-9]{1}|[1-9]{1}[0-9]{1}))?$/))
    {
      mostrarPrompt("Invalido", "medidamodPrompt", "red");
          return false;
    }
    else{
      mostrarPrompt("Valido", "medidamodPrompt", "green");
      return true;
    }
  }
  */
  else if(tipo=='Milimetros'){
    if(!medida.match(/^[0-9]{1,5}/)){
      mostrarPrompt("Invalido, coloque ", "medidamodPrompt", "red");
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
else if(medida3_estado.disabled==false)
{
  if(medida3==""){
     mostrarPrompt("Campo Requerido", "medidamod3Prompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "medidamod3Prompt", "green");
  return true;
}
}
}


function opciontipomedidamod(){
  var tipo=document.getElementById('tipo_medidamod').value;

  if (tipo=='Maquina')
  {
    document.getElementById('medidamod').disabled=true;
    document.getElementById('medida_maquinamod').disabled=false;
    $('#div_medidaM1').hide();
   $('#medidamod3').show();
   return true;
  }
  else if(tipo=='Pulgadas'){
    /*var medida=$('#medidamod').val();
    document.getElementById('medida_maquinamod').disabled=true;
     document.getElementById('medidamod').disabled=false;
    $('#div_medidaM1').show();
    $('#medidamod3').hide();
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
    }*/
     var medida=$('#medidamod').val();
    document.getElementById('medida_maquinamod').disabled=true;
     document.getElementById('medidamod').disabled=false;
    $('#div_medidaM1').show();
    $('#medidamod3').hide();
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
   else if(tipo=='Milimetros'){
     var medida=$('#medidamod').val();
    document.getElementById('medida_maquinamod').disabled=true;
     document.getElementById('medidamod').disabled=false;
    $('#div_medidaM1').show();
    $('#medidamod3').hide();
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

function validarPrecio(){
  var precio = document.getElementById("precio").value;
   if(precio==""){
     mostrarPrompt("Campo Requerido", "precioPrompt", "red");
    return false;
  }
   else if(!precio.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "precioPrompt", "red");
        return false;     
      }
  else{
mostrarPrompt("Valido", "precioPrompt", "green");
  return true;
}
}

function validarPrecio2(){
  var precio = document.getElementById("preciomod").value;
   if(precio==""){
     mostrarPrompt("Campo Requerido", "preciomodPrompt", "red");
    return false;
  }
   else if(!precio.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "preciomodPrompt", "red");
        return false;     
      }
  else{
mostrarPrompt("Valido", "preciomodPrompt", "green");
  return true;
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

function validarBuenas(){
  var buenas = document.getElementById("buenas").value;
   if(buenas==""){
     mostrarPrompt("Campo Requerido", "buenasPrompt", "red");
    return false;
  }
    else if (!buenas.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "buenasPrompt", "red");
        return false;     
      }
  else{
mostrarPrompt("Valido", "buenasPrompt", "green");
  return true;
}
}

function validarBuenas2(){
  var buenas = document.getElementById("buenasmod").value;
   if(buenas==""){
     mostrarPrompt("Campo Requerido", "buenasmodPrompt", "red");
    return false;
  }
    else if (!buenas.match(/^[0-9]{1,}$/)){
        mostrarPrompt("Invalido", "buenasmodPrompt", "red");
        return false;     
      }
  else{
mostrarPrompt("Valido", "buenasmodPrompt", "green");
  return true;
}
}

function validarNombre(){
  //var nombre = document.getElementById("nombre").value;
 var user = document.getElementById("nombre").value;

 if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "nombrePrompt", "red");
      return false;
    }

var consulta;
var tipo=document.getElementById('tipo').value;

consulta=$("#nombre").val();
//var consultax;
//consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
   $.ajax({
      type:"POST",
      url:"verificar_nombre_insumo.php",
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
*/
}


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
  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Nombre2Prompt", "red");
      return false;
    }

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
*/
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

function validarUbicacion2(){
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


function validarForm()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!validarUbicacion() || !validarNombre() || !validarN_B()|| !validarMedida() || !validarPrecio() || !validarExistencia() || !validarBuenas() || !calculo_danada() || !min_stock() || !max_stock() || !validarEstante()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/
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

 //-----------------------Entrada y Salida Interna-----------------

  function Entrada_Salida(id){

        var url='modifica_insumos.php';
        
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
                $('#idE').val(id);
                $('#idS').val(id);
              //  $('#codigoE').val(datos[1]);
  //                $('#codigoS').val(datos[1]);
                $('#NBE').val(datos[2]);
                $('#NBS').val(datos[2]);
                $('#descripcionE').val(datos[3]);
                $('#descripcionS').val(datos[3]);
                $('#existenciaE').val(datos[7]);
                $('#existencia2').val(datos[7]);
                $('#buenasE').val(datos[8]);
                $('#buenas2').val(datos[8]);
                $('#danadasE').val(datos[9]);
                $('#danadas2').val(datos[9]);
                $('#minimoE').val(datos[10]);
                $('#minimoS').val(datos[10]);
                $('#maximoE').val(datos[15]);
                 $('#maximoS').val(datos[15]);
               $('#pre_nbmod').val(datos[16]);
                 if (datos[16]=="S/NB"){
                  $('#NBE').val("S/NB");
                  $('#NBS').val("S/NB");
                }
                else{
                  $('#NBE').val(datos[16]+datos[2]);
                  $('#NBS').val(datos[16]+datos[2]);

                }
                 $('#salida_existencia').val("");
                 $('#salida_buenas').val("");
                $('#salida_danadas').val("");
                 $('#entrada_existencia').val("");
                  $('#entrada_buenas').val("");
                   $('#entrada_danadas').val("");
                  reiniciarE();
                  reiniciarS();
                $('#entradasalidamodal').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

function validarExistenciaEntradaInterna(){
  var existencia = document.getElementById("entrada_existencia").value;
  var comparar=document.getElementById("maximoE").value;
  var existe=document.getElementById("existenciaE").value;
  var total;

   exis1=parseInt(existencia);
exis2=parseInt(existe);
  total=exis1+exis2;

  if (existencia.match(/^\s/))
    {
      mostrarPrompt("Invalido", "existenciaEPrompt", "red");
      return false;
    }

   if(existencia==""){
     mostrarPrompt("Campo Requerido", "existenciaEPrompt", "red");
    return false;
  }
  if (exis1=='0'){
   mostrarPrompt("La entrada no puede ser 0", "existenciaEPrompt", "red");
    return false;
  }
  if(total>comparar){
    mostrarPrompt("Excede el maximo de stock", "existenciaEPrompt", "red");
    //alert(total);
    return true;
  }
  else{
mostrarPrompt("Valido", "existenciaEPrompt", "green");
  return true;
}
}

function validarExistenciaSalidaInterna(){
  var existencia = document.getElementById("salida_existencia").value;
  var existe=document.getElementById("existencia2").value;
   exis1=parseInt(existencia);
  exis2=parseInt(existe);
   
   if(existencia==""){
     mostrarPrompt("Campo Requerido", "existencia2Prompt", "red");
    return false;
  }
  
  else if(exis2<exis1){
    mostrarPrompt("Cantidad de Salida es mayor a la existencia", "existencia2Prompt", "red");
    //alert(total);
    return false;
  }
  else{
mostrarPrompt("Valido", "existencia2Prompt", "green");
  return true;
}
}

function calculo_danada_entradaInterna(){
  var cantidad = document.getElementById("entrada_existencia").value;

  var buenas = document.getElementById("entrada_buenas").value;
  var caldanadas;
  var danadas = document.getElementById("entrada_danadas").value;
  // cantInt=parseInt(cantidad);
 //buenasInt=parseInt(buenas);
/*
 if (isNaN(cantInt) && isNaN(buenasInt)) {
          alert("no numberc");

    }
    else{
      /*if(buenasInt+danadasInt > cantInt){
    alert("la sumatoria entre buenas y danadas debe dar la existencia");
    $("#recambio").val("");
    
   }*/
   caldanadas=cantidad-buenas;
   //caldanadas=cantInt - buenasInt;
   if(caldanadas<0){
  //  alert("error no puede ser menor a 0");
    mostrarPrompt("No puede ser menor a 0", "danadas1Prompt", "red");
    $("#entrada_danadas").val("");
    return false;
   }
   else{

   $("#entrada_danadas").val(caldanadas);
      mostrarPrompt("Valido", "danadas1Prompt", "green");

   return true;
 }
//}
 
}

function reiniciarE(){

   if(!validarExistenciaEntradaInterna() || !validarBuenasEntrada() || !validarEntradaDanadas()){
      
        return false;
    } 
     
    return true;
}

function reiniciarS(){

      if( !validarExistenciaSalida() ||!validarBuenasSalida() || !validarSalidaDanadas() ){
         return false;
    }
    return true;
}


function validarForm_EInterno()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!validarExistenciaEntradaInterna() || !validarBuenasEntrada() || !validarEntradaDanadas()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/
        jsMostrar("salidaR_INS_E");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_INS_E", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_INS_E");
        }, 2000);
        
        return false;
    } 
      document.getElementById('aceptar1').disabled=true;
    return true;
}

function validarForm_SInterno()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validarExistenciaSalida() ||!validarBuenasSalida() || !validarSalidaDanadas() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/
      jsMostrar("salidaR_INS_S");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_INS_S", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_INS_S");
        }, 2000);
        
        return false;
    } 
    document.getElementById('aceptar2').disabled=true;
    return true;
}
//--------------------------Fin entrada y salida interna
function valida_fechamod(){

        var url='buscar_fecha_igual.php';

        var fecha=document.getElementById('fechamod').value;


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
  if( !valida_fechamod()  ){
        $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;
    } 
    return true;
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





///-----------------insumos e&s------------

function calculo_danada_entrada(){
  var cantidad = document.getElementById("entrada_existencia").value;

  var buenas = document.getElementById("entrada_buenas").value;
  var caldanadas;
  var danadas = document.getElementById("entrada_danadas").value;
  // cantInt=parseInt(cantidad);
 //buenasInt=parseInt(buenas);
/*
 if (isNaN(cantInt) && isNaN(buenasInt)) {
          alert("no numberc");

    }
    else{
      /*if(buenasInt+danadasInt > cantInt){
    alert("la sumatoria entre buenas y danadas debe dar la existencia");
    $("#recambio").val("");
    
   }*/
   caldanadas=cantidad-buenas;
   //caldanadas=cantInt - buenasInt;
   if(caldanadas<0){
  //  alert("error no puede ser menor a 0");
    mostrarPrompt("No puede ser menor a 0", "danadasPrompt", "red");
    $("#entrada_danadas").val("");
    return false;
   }
   else{

   $("#entrada_danadas").val(caldanadas);
      mostrarPrompt("Valido", "danadasPrompt", "green");

   return true;
 }
//}
 
}

function calculo_danada_salida(){
  var cantidad = document.getElementById("salida_existencia").value;

  var buenas = document.getElementById("salida_buenas").value;
  var caldanadas;
  var danadas = document.getElementById("salida_danadas").value;
  // cantInt=parseInt(cantidad);
 //buenasInt=parseInt(buenas);
/*
 if (isNaN(cantInt) && isNaN(buenasInt)) {
          alert("no numberc");

    }
    else{
      /*if(buenasInt+danadasInt > cantInt){
    alert("la sumatoria entre buenas y danadas debe dar la existencia");
    $("#recambio").val("");
    
   }*/
   caldanadas=cantidad-buenas;
   //caldanadas=cantInt - buenasInt;
   if(caldanadas<0){
   // alert("error no puede ser menor a 0");
    mostrarPrompt("No puede ser menor a 0", "danadas2Prompt", "red");
    $("#salida_danadas").val("");
    return false;
   }
   else{

   $("#salida_danadas").val(caldanadas);
      mostrarPrompt("Valido", "danadas2Prompt", "green");

   return true;
 }
//}
 
}

function existeCodigoE(){
 var user = document.getElementById("codigo").value;

var consulta;

consulta=$("#codigo").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
var tipo="registro";
  


   $.ajax({
      type:"POST",
      url:"verificar_codigo_insumo.php",
      data:"codigo="+consultax+"&tipo="+tipo,
      success: function (data){
        
        $('#resE').val(data);


        var valor2 = document.getElementById("resE").value;
         var code = document.getElementById("codigo").value;

      if (valor2==0)
    {

       mostrarPrompt("No existe", "CodePrompt", "red");
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "CodePrompt", "green");
  
    }
    if (code == ""){
     mostrarPrompt("Campo Requerido", "CodePrompt", "red");

      }
    }

    });


 var valor = document.getElementById("resE").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodePrompt", "red");
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

function existeCodigoS(){
 var user = document.getElementById("codigo2").value;

var consulta;

consulta=$("#codigo2").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
var tipo="registro";
  


   $.ajax({
      type:"POST",
      url:"verificar_codigo_insumo.php",
      data:"codigo="+consultax+"&tipo="+tipo,
      success: function (data){
        
        $('#resS').val(data);


        var valor2 = document.getElementById("resS").value;
         var code = document.getElementById("codigo2").value;

      if (valor2==0)
    {

       mostrarPrompt("No existe", "Code2Prompt", "red");
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "Code2Prompt", "green");
  
    }
    if (code == ""){
     mostrarPrompt("Campo Requerido", "Code2Prompt", "red");

      }
    }

    });


 var valor = document.getElementById("resS").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "Code2Prompt", "red");
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

function validarBuenasEntrada(){
  var buenas = document.getElementById("entrada_buenas").value;
  
  if (buenas.match(/^\s/))
    {
      mostrarPrompt("Invalido", "buenas1Prompt", "red");
      return false;
    }

   if(buenas==""){
     mostrarPrompt("Campo Requerido", "buenas1Prompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "buenas1Prompt", "green");
  return true;
}
}

function validarBuenasSalida(){
    var existe=document.getElementById("buenas2").value;

  var buenas = document.getElementById("salida_buenas").value;
   exis1=parseInt(buenas);
  exis2=parseInt(existe);
   if(exis1>exis2){
    mostrarPrompt("Salida Buenas excede las Buenas en existecia", "buenas2Prompt", "red");
    //alert(total);
    return false;
  }
   if(buenas==""){
     mostrarPrompt("Campo Requerido", "buenas2Prompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "buenas2Prompt", "green");
  return true;
}
}

function validarExistenciaEntrada(){
  var existencia = document.getElementById("entrada_existencia").value;
  var comparar=document.getElementById("maximo").value;
  var existe=document.getElementById("existencia").value;
  var total;

   exis1=parseInt(existencia);
exis2=parseInt(existe);
  total=exis1+exis2;

  if (existencia.match(/^\s/))
    {
      mostrarPrompt("Invalido", "existenciaPrompt", "red");
      return false;
    }

   if(existencia==""){
     mostrarPrompt("Campo Requerido", "existenciaPrompt", "red");
    return false;
  }
   if (exis1=='0'){
   mostrarPrompt("La Entrada no puede ser 0", "existenciaPrompt", "red");
    return false;
  }
  if(total>comparar){
    mostrarPrompt("Cantidad de Entrada excede el maximo de stock", "existenciaPrompt", "red");
    //alert(total);
    return true;
  }
  else{
mostrarPrompt("Valido", "existenciaPrompt", "green");
  return true;
}
}

function validarExistenciaSalida(){
  var existencia = document.getElementById("salida_existencia").value;
  var existe=document.getElementById("existencia2").value;
   exis1=parseInt(existencia);
  exis2=parseInt(existe);
   
   if(existencia==""){
     mostrarPrompt("Campo Requerido", "existencia2Prompt", "red");
    return false;
  }
   else if (exis1=='0'){
   mostrarPrompt("La Salida no puede ser 0", "existencia2Prompt", "red");
    return false;
  }
  else if(exis2<exis1){
    mostrarPrompt("Cantidad de Salida es mayor a la existencia", "existencia2Prompt", "red");
    //alert(total);
    return false;
  }
  else{
mostrarPrompt("Valido", "existencia2Prompt", "green");
  return true;
}
}

  function validarEntradaDanadas(){
     var danadas = document.getElementById("entrada_danadas").value;
   if(danadas==""){
     mostrarPrompt("Campo Requerido", "danadas1Prompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "danadas1Prompt", "green");
  return true;
}
  }

function validarSalidaDanadas(){
      var existe=document.getElementById("danadas2").value;

  var danadas = document.getElementById("salida_danadas").value;
     exis1=parseInt(danadas);
  exis2=parseInt(existe);
   if(exis1>exis2){
    mostrarPrompt("Salida Dañadas excede las Dañadas en existecia", "danadas2Prompt", "red");
    //alert(total);
    return false;
  }
   if(danadas==""){
     mostrarPrompt("Campo Requerido", "danadas2Prompt", "red");
    return false;
  }
  else{
mostrarPrompt("Valido", "danadas2Prompt", "green");
  return true;
}
}

function validarForm_E()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!validarExistenciaEntrada() || !validarBuenasEntrada() || !validarEntradaDanadas()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/
        jsMostrar("salidaR_INS_E");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_INS_E", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_INS_E");
        }, 2000);
        
        return false;
    } 
      document.getElementById('aceptar1').disabled=true;
    return true;
}

function validarForm_S()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!validarExistenciaSalida() ||!validarBuenasSalida() || !validarSalidaDanadas() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/
      jsMostrar("salidaR_INS_S");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_INS_S", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_INS_S");
        }, 2000);
        
        return false;
    } 
    document.getElementById('aceptar2').disabled=true;
    return true;
}

function reporte_Insumo(){
        window.open("pdf/reporte_insumos.php","_blank");
    };