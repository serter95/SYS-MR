    $('#btn_error_incompleto').click(function(){
      $('#error_incompleto').on('hidden.bs.modal', function (e) {
        $('body').addClass('modal-open');

      });
    });


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
     letras = "áéíóúabcdefghijklmnñopqrstuvwxyz1234567890,-.";
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

  function soloAlfa3(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890,.&-";
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



  function existeCodigo(){
   var user = document.getElementById("codigo").value;

   var consulta;

   consulta=$("#codigo").val();
   var consultax;
   consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);

   if (user==0){
    mostrarPrompt("Campo Requerido", "CodePrompt", "red");
    return false;
  }
  if(user.length == 0){
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
    url:"verificar_codigo.php",
    data:"codigo="+consultax,
    success: function (data){

      $('#res').val(data);


      var valor2 = document.getElementById("res").value;

      if (valor2==0)
      {

       mostrarPrompt("No existe", "CodePrompt", "red");

     }
     if (valor2==1)
     {
       mostrarPrompt("Valido", "CodePrompt", "green");

     }
   }

 });


  var valor = document.getElementById("res").value;
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

function existeCodigo2(){
 var user = document.getElementById("codigo2").value;

 var consulta;

 consulta=$("#codigo2").val();
 var consultax;
 consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);




 $.ajax({
  type:"POST",
  url:"verificar_codigo.php",
  data:"codigo="+consultax,
  success: function (data){

    $('#res2').val(data);


    var valor2 = document.getElementById("res2").value;

    if (valor2==0)
    {

     mostrarPrompt("No existe", "Code2Prompt", "red");

   }
   if (valor2==1)
   {
     mostrarPrompt("Valido", "Code2Prompt", "green");

   }
 }

});


 var valor = document.getElementById("res2").value;
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


function validarN_B()
{

 var user = document.getElementById("NB").value;
 var consulta1;
 var consulta2;
 

 var consulta;


 consulta1=$("#pre_nb").val();
 consulta2=$("#NB").val();

 consulta=consulta1 + consulta2;


//se realiza la busqueda




$.ajax({
  type:"POST",
  url:"verificar_nb.php",
  data:"nb="+consulta,
  success: function (data){

    $('#res').val(data);


    var valor2 = document.getElementById("res").value;

    if (valor2==0)
    {

     mostrarPrompt("No existe", "N/BPrompt", "red");

   }
   if (valor2==1)
   {
     mostrarPrompt("Valido", "N/BPrompt", "green");

   }
 }

});


var valor = document.getElementById("res").value;
if(user.length == 0){
 mostrarPrompt("Campo Requerido", "N/BPrompt", "red");
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

mostrarPrompt("Valido", "C.I_per", "green");
return true;
}
function validarCI2()
{
  var user = document.getElementById("ci_usu2").value;    
  var nac = document.getElementById("nac_usu2").value;

  var ci=nac+user;

  if (nac==0){
    mostrarPrompt("Seleccione la nacionalidad", "C.I_per2", "red");
    return false;
  }
  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "C.I_per2", "red");
   return false;
 }
 if(!user.match(/^[0-9]{7,9}$/)){
  mostrarPrompt("Invalido", "C.I_per2", "red");
  return false;     
}

$.ajax({
  type:"POST",
  url:"veri_ci.php",
  data:"ci="+ci,
  success: function (data){

    $('#validar_ci_ajax2').val(data);

    var valor2 = document.getElementById("validar_ci_ajax2").value;

    if (valor2==1)
    {
      mostrarPrompt("Valido", "C.I_per2", "green");

    }
    if (valor2==0)
    {
      mostrarPrompt("No existe", "C.I_per2", "red");

    }

  }
});

var valor = document.getElementById("validar_ci_ajax2").value;

if (valor==1)
{

  return true;
}
if (valor==0)
{

  return false;
}

mostrarPrompt("Valido", "C.I_per2", "green");
return true;
}

function valida_fecha(){

  var url='buscar_fecha_igual.php';

  var split_fecha;
  var fecha=document.getElementById('fecha').value;

  if (!fecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fechaPrompt", "red");
          return false;
    }

  split_fecha = fecha.split("/");

  fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];


  var fechac=split_fecha[2]+"-"+split_fecha[1]+"-"+split_fecha[0];

  var id=document.getElementById('id_maq').value;
  var valor2 = document.getElementById("resultado_fecha").value;

        var primera = Date.parse(fecha); //01 de Octubre del 2013

        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        var dateNext=new Date(year, month, day);

        var segunda = Date.parse(dateNext); 
        //alert("funcion personal "+ci);
        var tipo="registro";
        var mantenimiento="preventivo";

        $.ajax({
          type:'POST',
          url:url,
          data:'fecha='+fechac+'&id='+id+'&tipo='+tipo+'&mant='+mantenimiento,
          success:function(valores){
            var datos=eval(valores);
            $("#resultado_fecha").val(datos[0]);
            var valor = document.getElementById("resultado_fecha").value;


            if (valor==0){
             mostrarPrompt("Campo Requerido", "fechaPrompt", "red");
           }

           if (valor=="igual")
           {

             mostrarPrompt("Ya se realizo una solicitud en esta fecha", "fechaPrompt", "red");

           }
           if (valor=="valido")
           {


             mostrarPrompt("Valido", "fechaPrompt", "green");

           }
           if(primera>segunda){
            mostrarPrompt("La fecha debe ser menor o igual al dia de hoy", "fechaPrompt", "red");

          }
        }
      });

        if(primera>segunda){

          return false;
        }

        if (valor2==""){
         mostrarPrompt("Campo Requerido", "fechaPrompt", "red");
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


    function valida_fecha2(){

      var url='buscar_fecha_igual.php';
      var split_fecha;
      var fecha=document.getElementById('fecha2').value;
      if (!fecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fecha2xPrompt", "red");
          return false;
    }
      split_fecha = fecha.split("/");

      fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

      var fechac=split_fecha[2]+"-"+split_fecha[1]+"-"+split_fecha[0];

      var id=document.getElementById('id_maq2').value;
      var valor2 = document.getElementById("resultado_fecha2").value;

        var primera = Date.parse(fecha); //01 de Octubre del 2013

        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        var dateNext=new Date(year, month, day);

        var segunda = Date.parse(dateNext); 
        //alert("funcion personal "+ci);
        var tipo="registro";
        var mantenimiento="preventivo";
        $.ajax({
          type:'POST',
          url:url,

          data:'fecha='+fechac+'&id='+id+'&tipo='+tipo+'&mant='+mantenimiento,
          success:function(valores){
            var datos=eval(valores);
            $("#resultado_fecha2").val(datos[0]);
            var valor = document.getElementById("resultado_fecha2").value;


            if (valor==""){
             mostrarPrompt("Campo Requerido", "fecha2xPrompt", "red");
           }

           if (valor=="igual")
           {

             mostrarPrompt("Ya se realizo una solicitud en esta fecha", "fecha2xPrompt", "red");

           }
           if (valor=="valido")
           {


             mostrarPrompt("Valido", "fecha2xPrompt", "green");

           }
           if(primera>segunda){
            mostrarPrompt("La fecha debe ser menor o igual al dia de hoy", "fecha2xPrompt", "red");

          }
        }
      });

        if(primera>segunda){

          return false;
        }

        if (valor2==""){
         mostrarPrompt("Campo Requerido", "fecha2xPrompt", "red");
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


    function validarFecham(){
      var date=document.getElementById("fecha").value;
      var x=new Date();
      var fecha = date.split("/");
      x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
      var today = new Date();

      if (x >= today){

        return false;}
        
        else{
          return true;

        }
      }

      function validar_aceite()
      {
        var nombres = document.getElementById("niv_aceite").selectedIndex;

        if (nombres == 0)
        {
          mostrarPrompt("Campo Requerido", "aceitePrompt", "red");
          return false;
        }
        mostrarPrompt("Valido", "aceitePrompt", "green");
        return true;
      }
      function validar_aceite2()
      {
        var nombres = document.getElementById("niv_aceite2").value;

        if (nombres == 0)
        {
         mostrarPrompt("Campo Requerido", "aceite2Prompt", "red");
         return false;
       }
       mostrarPrompt("Valido", "aceite2Prompt", "green");
       return true;
     }

     function valida_fecha_mayor(){

       var split_fecha;

       var fecha=document.getElementById('fecha').value;

       split_fecha = fecha.split("/");

       fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

       var split_fecha2;

       var nextfecha=document.getElementById('nextfecha').value;

         if (!nextfecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fecha2Prompt", "red");
          return false;
    }

       split_fecha2 = nextfecha.split("/");

       nextfecha=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];

        //var nextfecha=document.getElementById('nextfecha').value;
 var primera = Date.parse(fecha); //01 de Octubre del 2013
var segunda = Date.parse(nextfecha); //03 de Octubre del 2013


if (nextfecha=="")
{
  mostrarPrompt("Campo Requerido", "fecha2Prompt", "red");
  return false;
}

if (primera > segunda) {
  mostrarPrompt("La fecha debe ser mayor a la fecha de la revision", "fecha2Prompt", "red");
  return false;
}
if (primera == segunda){
  mostarPrompt("La fecha debe ser mayor a la fecha de la revision", "fecha2Prompt", "red");
  return false;
}
else{
  mostrarPrompt("Valido", "fecha2Prompt", "green");
  return true;
}
        //alert("funcion personal "+ci);


      }

      function valida_fecha_mayor2(){

       var split_fecha;

       var fecha=document.getElementById('fecha2').value;

       split_fecha = fecha.split("/");

       fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

       var split_fecha2;

       var nextfecha=document.getElementById('nextfecha2').value;


       if (!nextfecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fecha2x2Prompt", "red");
          return false;
    }

       split_fecha2 = nextfecha.split("/");

       nextfecha=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];

 var primera = Date.parse(fecha); //01 de Octubre del 2013
var segunda = Date.parse(nextfecha); //03 de Octubre del 2013

  
if (nextfecha=="")
{
  mostrarPrompt("Campo Requerido", "fecha2x2Prompt", "red");
  return false;
}
if (primera > segunda) {
  mostrarPrompt("La fecha debe ser mayor a la fecha de la revision", "fecha2x2Prompt", "red");
  return false;
}
if (primera == segunda){
  mostrarPrompt("La fecha debe ser mayor a la fecha de la revision", "fecha2x2Prompt", "red");
  return false;
}
else{
  mostrarPrompt("Valido", "fecha2x2Prompt", "green");
  return true;
}
        //alert("funcion personal "+ci);


      }


      function validarObservaciones(){

        var user = document.getElementById("observaciones").value;

        if(user.length == 0){
         mostrarPrompt("Campo Requerido", "observacionesPrompt", "red");
         return false;
       }
       if (user.match(/^\s/))
       {
        mostrarPrompt("Invalido", "observacionesPrompt", "red");
        return false;
      }
      if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,-]{1,}$/)){
        mostrarPrompt("Invalido", "observacionesPrompt", "red");
        return false;     
      }
      mostrarPrompt("Valido", "observacionesPrompt", "green");
      return true;

    }

    function validarObservaciones2(){

      var user = document.getElementById("observaciones2").value;

      if(user.length == 0){
       mostrarPrompt("Campo Requerido", "observaciones2Prompt", "red");
       return false;
     }
     if (user.match(/^\s/))
     {
      mostrarPrompt("Invalido", "observaciones2Prompt", "red");
      return false;
    }
    if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
      mostrarPrompt("Invalido", "observaciones2Prompt", "red");
      return false;   
    }
    mostrarPrompt("Valido", "observaciones2Prompt", "green");
    return true;

  }

  function validarObservacionesmod(){

    var user = document.getElementById("observacionesmod").value;
    
    if(user.length == 0){
     mostrarPrompt("Campo Requerido", "observacionesmodPrompt", "red");
     return false;
   }
   if (user.match(/^\s/))
   {
    mostrarPrompt("Invalido", "observacionesmodPrompt", "red");
    return false;
  }
  if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
    mostrarPrompt("Invalido", "observacionesmodPrompt", "red");
    return false;     
  }
  mostrarPrompt("Valido", "observacionesmodPrompt", "green");
  return true;

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
if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "responsablePrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "responsablePrompt", "green");
return true;

}



function validarResponsable2(){

  var user = document.getElementById("responsable2").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "responsable2Prompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "responsable2Prompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "responsable2Prompt", "red");
  return false;     
}
mostrarPrompt("Valido", "responsable2Prompt", "green");
return true;

}

function validarResponsablemod(){

  var user = document.getElementById("responsablemod").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "responsablemodPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "responsablemodPrompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "responsablemodPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "responsablemodPrompt", "green");
return true;

}

function validarProveedor(){

  var user = document.getElementById("provedor").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "proveedorPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "proveedorPrompt", "red");
  return false;
}
if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "proveedorPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "proveedorPrompt", "green");
return true;

}

function validarProveedormod(){
  var estado=document.getElementById("provedormod");

  if(estado.disabled==false){

    var user = document.getElementById("provedormod").value;
    
    if(user.length == 0){
     mostrarPrompt("Campo Requerido", "proveedormodPrompt", "red");
     return false;
   }
   if (user.match(/^\s/))
   {
    mostrarPrompt("Invalido", "proveedormodPrompt", "red");
    return false;
  }
  if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
    mostrarPrompt("Invalido", "proveedormodPrompt", "red");
    return false;     
  }
  mostrarPrompt("Valido", "proveedormodPrompt", "green");
  return true;
}

else{
        //mostrarPrompt("Valido", "proveedormodPrompt", "green");
        return true;
      } 

    }


    function validarHombre(){

      var user = document.getElementById("hora").value;

      if(user.length == 0){
       mostrarPrompt("Campo Requerido", "hora_hPrompt", "red");
       return false;
     }
     if(!user.match(/^[0-9]{1,3}$/)){
      mostrarPrompt("Invalido", "hora_hPrompt", "red");
      return false;     
    }
    mostrarPrompt("Valido", "hora_hPrompt", "green");
    return true;

  }

  function validarHombre2(){

    var user = document.getElementById("hora2").value;
    
    if(user.length == 0){
     mostrarPrompt("Campo Requerido", "hora_h2Prompt", "red");
     return false;
   }
   if(!user.match(/^[0-9]{1,3}$/)){
    mostrarPrompt("Invalido", "hora_h2Prompt", "red");
    return false;     
  }
  mostrarPrompt("Valido", "hora_h2Prompt", "green");
  return true;

}

function validarHombremod(){

  var user = document.getElementById("hora_hombremod").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "hora_hombremodPrompt", "red");
   return false;
 }
 if(!user.match(/^[0-9]{1,3}$/)){
  mostrarPrompt("Invalido", "hora_hombremodPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "hora_hombremodPrompt", "green");
return true;

}

function validarCosto(){

  var user = document.getElementById("costo").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "costoPrompt", "red");
   return false;
 }
 if(!user.match(/^[0-9]{1,}$/)){
  mostrarPrompt("Invalido", "costoPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "costoPrompt", "green");
return true;

}

function validarCosto2(){

  var user = document.getElementById("costo2").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "costo2Prompt", "red");
   return false;
 }
 if(!user.match(/^[0-9]{1,}$/)){
  mostrarPrompt("Invalido", "costo2Prompt", "red");
  return false;     
}
mostrarPrompt("Valido", "costo2Prompt", "green");
return true;

}

function validarCostomod(){

  var user = document.getElementById("costomod").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "costomodPrompt", "red");
   return false;
 }
 if(!user.match(/^[0-9]{1,}$/)){
  mostrarPrompt("Invalido", "costomodPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "costomodPrompt", "green");
return true;

}




function validar_fechaI(){

  var control=document.getElementById('fechai');

  if (control.disabled==true){
    return true;
  }
  else{

   var split_fecha;

   var fecha=document.getElementById('fechamod').value;

   split_fecha = fecha.split("/");

   fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];


   var nextfecha=document.getElementById('fechai').value;
   var nextfechamod=document.getElementById('fechanextmod').value;

     if (!nextfecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fechaiPrompt", "red");
          return false;
    }
   if (nextfecha=="")
   {

    mostrarPrompt("Campo Requerido", "fechaiPrompt", "red");
    return false;
  }
  if(nextfecha.length == 0){
   mostrarPrompt("Campo Requerido", "fechaiPrompt", "red");
   return false;

 }
 var split_fecha2;
 split_fecha2 = nextfecha.split("/");

 nextfecha=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];



 var split_fecha3;
 split_fecha3= nextfechamod.split("/");

 nextfechamod=split_fecha3[2]+"/"+split_fecha3[1]+"/"+split_fecha3[0];

 var primera = Date.parse(fecha); //01 de Octubre del 2013
var segunda = Date.parse(nextfecha); //03 de Octubre del 2013
var tercera = Date.parse(nextfechamod); //03 de Octubre del 2013


if (primera > segunda) {
  mostrarPrompt("La fecha debe ser mayor a la fecha de la revision", "fechaiPrompt", "red");
  return false;
}
if (primera == segunda){
  mostrarPrompt("La fecha debe ser mayor a la fecha de la revision", "fechaiPrompt", "red");
  return false;
}
if (segunda>=tercera){
  mostrarPrompt("La fecha no debe ser mayor o igual a la fecha de la siguiente revision", "fechaiPrompt", "red");
  return false;
}
else{
  mostrarPrompt("Valido", "fechaiPrompt", "green");
  return true;
}
        //alert("funcion personal "+ci);
      }

    }

    function validar_detalleI(){
      var control=document.getElementById("detallei");
      if(control.disabled==true){
        return true;
      }
      else{

        var user = document.getElementById("detallei").value;

        if(user.length == 0){
         mostrarPrompt("Campo Requerido", "detalleiPrompt", "red");
         return false;
       }
       if (user.match(/^\s/))
       {
        mostrarPrompt("Invalido", "detalleiPrompt", "red");
        return false;
      }
      if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
        mostrarPrompt("Invalido", "detalleiPrompt", "red");
        return false;     
      }
      mostrarPrompt("Valido", "detalleiPrompt", "green");
      return true;
    }
  }



  $('#imprevisto_no').click(function(){
    $('#div_fechaimprevisto').hide();
    $('#div_detalleimprevisto').hide();
    document.getElementById("fechai").disabled=true;
    document.getElementById("detallei").disabled=true;

  });

  $('#imprevisto_si').click(function(){
    $('#div_fechaimprevisto').show();
    $('#div_detalleimprevisto').show();
    document.getElementById("fechai").disabled=false;
    document.getElementById("detallei").disabled=false;
    document.getElementById("fechai").readOnly=false;
    document.getElementById("detallei").readOnly=false;
  });


  function validarForm()
  {
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !existeCodigo() || !validarCI() || !validarResponsable()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
    return false;*/
    jsMostrar("salidaR_PRE");

    mostrarPrompt("El formulario debe estar completo", "salidaR_PRE", "red");

    setTimeout(function()
    {
      jsOcultar("salidaR_PRE");
    }, 2000);

    return false;
  } 
  return true;
}

function validarForm2()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !existeCodigo2() || !validarCI2() || !validarProveedor() || !validarResponsable2()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
    return false;*/
    jsMostrar("salidaR_PRE2");

    mostrarPrompt("El formulario debe estar completo", "salidaR_PRE2", "red");

    setTimeout(function()
    {
      jsOcultar("salidaR_PRE2");
    }, 2000);

    return false;
  } 
  return true;
}



function valida_fechamod(){

  var url='buscar_fecha_igual.php';
  var split_fecha;
  var fecha=document.getElementById('fechamod').value;
  if (!fecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fechamodPrompt", "red");
          return false;
    }
  split_fecha = fecha.split("/");

  fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

  var id2=document.getElementById('m_id_prev').value;
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
        var tipo="modificacion";
        var mantenimiento="preventivo";
        $.ajax({
          type:'POST',
          url:url,
          data:'fecha='+fecha+'&id='+id+'&tipo='+tipo+'&id_pre='+id2+'&mant='+mantenimiento,
          success:function(valores){
            var datos=eval(valores);
            $("#resultado_fechamod").val(datos[0]);
            var valor = document.getElementById("resultado_fechamod").value;


            if (valor==""){
             mostrarPrompt("Campo Requerido", "fechamodPrompt", "red");
           }

           if (valor=="igual")
           {

             mostrarPrompt("Ya se realizo una revision en esta fecha", "fechamodPrompt", "red");

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
  if(!validarResponsablemod() || !validarProveedormod() || !validarObservacionesmod() || !validarHombremod() || !validarCostomod() || !validar_fechaI() || !validar_detalleI() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
    return false;*/
    jsMostrar("salidaM_PRE");

    mostrarPrompt("El formulario debe estar completo", "salidaM_PRE", "red");

    setTimeout(function()
    {
      jsOcultar("salidaM_PRE");
    }, 2000);

    return false;
  } 
  return true;
}

function validarForm_SE()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validarResponsablemod() || !validarProveedormod() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/
       jsMostrar("salidaM_PRE");

    mostrarPrompt("El formulario debe estar completo", "salidaM_PRE", "red");

    setTimeout(function()
    {
      jsOcultar("salidaM_PRE");
    }, 2000);

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





//control de repuestos


//document.getElementById("utilizadaER1").disabled=true;


function buscar_repuestoE1(valor){
var id=valor.id;
  var aqui=id;
  aqui=aqui.split("repuestoE");
  aqui=aqui[1];
  var buscarid;
  buscarid=valor.value;

   if (buscarid == '')
      {
        //alert("¡Existen estilos sin completar!")
       mostrarPrompt("Campo Requerido", "repuestoEPrompt"+aqui, "red");
       document.getElementById("utilizadaER"+aqui).disabled=true;
        $('#existenciaER'+aqui).val("");
        $('#idRE'+aqui).val("");
        $('utilizadaER'+aqui).val("");
      }

   else{
  var url='modifica_insumos.php';

    $.ajax({
      type:'POST',
      url:url,
      data:'id='+buscarid,
      success: function(valores){
        var datos=eval(valores);

       // $('#idR'+aqui).val(buscarid);

        $('#existenciaER'+aqui).val(datos[8]);

        document.getElementById("utilizadaER"+aqui).disabled=false;


      }
    });
    mostrarPrompt("Valido", "repuestoEPrompt"+aqui, "green");
     $('#idRE'+aqui).val(buscarid);

     }

 validaridrE();
 validar_utilizadaER1();
}

//document.getElementById("utilizadaIR1").disabled=true;

function buscar_repuestoI1(valor){


  var id=valor.id;
  var aqui=id;
  aqui=aqui.split("repuestoI");
  aqui=aqui[1];
  var buscarid;
  buscarid=valor.value;

   if (buscarid == '')
      {
        //alert("¡Existen estilos sin completar!")
       mostrarPrompt("Campo Requerido", "repuestoIPrompt"+aqui, "red");
       document.getElementById("utilizadaIR"+aqui).disabled=true;
        $('#existenciaIR'+aqui).val("");
        $('#idR'+aqui).val("");
        $('utilizadaIR'+aqui).val("");
      }

   else{
  var url='modifica_insumos.php';

    $.ajax({
      type:'POST',
      url:url,
      data:'id='+buscarid,
      success: function(valores){
        var datos=eval(valores);

       // $('#idR'+aqui).val(buscarid);

        $('#existenciaIR'+aqui).val(datos[8]);

        document.getElementById("utilizadaIR"+aqui).disabled=false;


      }
    });
    mostrarPrompt("Valido", "repuestoIPrompt"+aqui, "green");
     $('#idR'+aqui).val(buscarid);

     }

 validaridrI();
 validar_utilizadaIR1();
}

function validaridrI(){
    user = document.getElementsByName('idRI[]');

     for (i=0; i<user.length; i++){
        
          //  j=i+1;
              var idr;
                idr=user[i].id;
                // alert(idr);
               idr=idr.split("idR");
               idr=idr[1];
               var existencia;
                 control=document.getElementById('idR'+idr);
               if (control.disabled==true){
                return true;
               }              
               existencia=document.getElementById('idR'+idr).value;
                
             

      if (user[i].value==""){
         mostrarPrompt("Campo Requerido", "repuestoIPrompt"+idr, "red");
        return false;
      }
     
              
                
          }


          for (i=0; i<user.length; i++) {                        // outer loop uses each item i at 0 through n
             for (j=i+1; j<user.length; j++) {              // inner loop only compares items j at i+1 to n
      if (user[i].value==user[j].value){
        var idr;
                idr=user[j].id;
                idr=idr.split("idR");
               idr=idr[1];
               $('#existenciaIR'+idr).val("");
               $('#utilizadaIR'+idr).val("");
       mostrarPrompt("Campo ya seleccionado", "repuestoIPrompt"+idr, "red");
        
        return false;
      }

     }
   }
          return true;
      

}


function validar_utilizadaIR1(){

  user = document.getElementsByName('utilizadaRI[]');

      for (i=0; i<user.length; i++)
    {

    //  j=i+1;
        var aqui;
          aqui=user[i].id;
         aqui=aqui.split("utilizadaIR");
         aqui=aqui[1];
         var existencia;
         control=document.getElementById('utilizadaIR'+aqui);
         if (control.disabled==true){
          return true;
         }
         existencia=document.getElementById('existenciaIR'+aqui).value;
          valor=control.value;
         valor=parseInt(valor);

      if (user[i].value == '')
      {
        //alert("¡Existen estilos sin completar!");
        

       mostrarPrompt("Campo Requerido", "utilizadaIRPrompt"+aqui, "red");

        
        return false;
      }
       else if (valor=='0'){
   mostrarPrompt("La cantidad no puede ser 0",  "utilizadaIRPrompt"+aqui, "red");
    return false;
  }
      else if(!user[i].value.match(/^[0-9]{1,}$/)){
         
         mostrarPrompt("Invalido", "utilizadaIRPrompt"+aqui, "red");
       return false;     
        }
      else if(parseInt(user[i].value)>existencia){
        mostrarPrompt("Mayor a la existencia", "utilizadaIRPrompt"+aqui, "red");
        
       return false; 
        }
    else{
          
         mostrarPrompt("Valido", "utilizadaIRPrompt"+aqui, "green");
         
        }
    }
      
    return true;    
  }




function validaridrE(){
    user = document.getElementsByName('idRE[]');
     for (i=0; i<user.length; i++){
        
          //  j=i+1;
              var idr;
                idr=user[i].id;
              //   alert(idr);
               idr=idr.split("idRE");
               idr=idr[1];
               var existencia;
                control=document.getElementById('idRE'+idr);
         if (control.disabled==true){
          return true;
         }
               existencia=document.getElementById('idRE'+idr).value;
                
             

      if (user[i].value==""){
         mostrarPrompt("Campo Requerido", "repuestoEPrompt"+idr, "red");
        return false;
      }
     
              
                
          }


          for (i=0; i<user.length; i++) {                        // outer loop uses each item i at 0 through n
             for (j=i+1; j<user.length; j++) {              // inner loop only compares items j at i+1 to n
      if (user[i].value==user[j].value){
        var idr;
                idr=user[j].id;
                idr=idr.split("idRE");
               idr=idr[1];
               $('#existenciaER'+idr).val("");
               $('#utilizadaER'+idr).val("");
       mostrarPrompt("Campo ya seleccionado", "repuestoEPrompt"+idr, "red");
        
        return false;
      }

     }
   }
          return true;

 

}


function validar_utilizadaER1(){

  user = document.getElementsByName('utilizadaRE[]');
      for (i=0; i<user.length; i++)
    {

    //  j=i+1;
        var aqui;
          aqui=user[i].id;
         aqui=aqui.split("utilizadaER");
         aqui=aqui[1];
         var existencia;
         control=document.getElementById('utilizadaER'+aqui);
         if (control.disabled==true){
          return true;
         }
         existencia=document.getElementById('existenciaER'+aqui).value;
          valor=control.value;
         valor=parseInt(valor);

      if (user[i].value == '')
      {
        //alert("¡Existen estilos sin completar!");
        

       mostrarPrompt("Campo Requerido", "utilizadaERPrompt"+aqui, "red");

        
        return false;
      }
       else if (valor=='0'){
        mostrarPrompt("La cantidad no puede ser 0",  "utilizadaERPrompt"+aqui, "red");
          return false;
        }
      else if(!user[i].value.match(/^[0-9]{1,}$/)){
         
         mostrarPrompt("Invalido", "utilizadaERPrompt"+aqui, "red");
       return false;     
        }
      else if(parseInt(user[i].value)>existencia){
        mostrarPrompt("Mayor a la existencia", "utilizadaERPrompt"+aqui, "red");
        
       return false; 
        }
    else{
          
         mostrarPrompt("Valido", "utilizadaERPrompt"+aqui, "green");
         
        }
    }
      
    return true;    
  }

//end control de repuestos


$('#repuesto_asoc').hide();
$('#repuesto_asoc2').hide();

function buscaNumeroMantI(){
  var user=document.getElementById("numero_mantI").value;
  var id=$('#numero_mantI').val();

 
  $.ajax({
    type:"POST",
    url:"modifica_preventivo.php",
    data:'id='+id,
    success: function (valores){

     var datos=eval(valores);

     if (datos[18]=='concluido'){
       $('#validaNI').val("0")
      $('#rev_maquina').val("");
      $('#fechapropuesta').val("");
      $('#responsable').val("");
      $('#maquina_id').val("");
      $('#niv_aceite').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#responsable').val("");    
      $('#hora').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#repuesto_asoc').hide();
      $('#repuestoPC').val("");
      document.getElementById("lucesI1").checked=true;
      document.getElementById("paradaI1").checked=true;
      document.getElementById("pulsadoresI1").checked=true;

      mostrarPrompt("Ya concluido", "numeroIPrompt", "red");
     }
     else if(datos[18]=='no concluido' && datos[0]==id && datos[10]=="interno"){
            $('#rev_maquina').val(datos[1]);
            $('#fechapropuesta').val(datos[2]);
            $('#niv_aceite').val(datos[3]);
            $('#observaciones').val(datos[4]);
            $('#fecha').val(datos[19]);
            $('#responsable').val(datos[9]);    
            $('#hora').val(datos[11]);
            $('#costo').val(datos[13]);
            $('#nextfecha').val(datos[17]);
            $('#maquina_id').val(datos[8]);
             if (datos[5]=="No")
            {
                document.getElementById("lucesI1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesI2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradaI1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradaI2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresI1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresI2").checked=true;
            }

            $('#validaNI').val("1");

              $.ajax({
              type:"POST",
              url:"buscar_repuestos.php",
              data:'id='+datos[0]+'&tipo='+'preventivo',
              success: function (valores2){
                     var datos2=eval(valores2);
                    $('#repuestoPB').html(datos2[0]);   
                   //  $('#NB').val("NB-"+datos2[1]);
                  

              }
            });
              $('#repuesto_asoc').show();

            buscaridmantI();
            document.getElementById("service_interno").checked=true;
           mostrarPrompt("Continuando el mantenimiento interno", "numeroIPrompt", "green");
     }
     else if (datos[0]==id && datos[10]=="interno"){
      $('#rev_maquina').val(datos[1]);
      $('#fechapropuesta').val(datos[2]);
      $('#responsable').val(datos[9]);
       $('#maquina_id').val(datos[8]);
       $('#niv_aceite').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#hora').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#validaNI').val("1");
      $('#repuesto_asoc').hide();
      $('#repuestoPC').val("");
           if (datos[5]=="No")
            {
                document.getElementById("lucesI1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesI2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradaI1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradaI2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresI1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresI2").checked=true;
            }
       document.getElementById("service_interno").checked=true;

      buscaridmantI();
      mostrarPrompt("Valido", "numeroIPrompt", "green");
    }
     else if(datos[18]=='no concluido' && datos[0]==id && datos[10]=="externo"){
            $('#provedor').val(datos[12]);
            $('#rev_maquina2').val(datos[1]);
            $('#fechapropuesta2').val(datos[2]);
            $('#niv_aceite2').val(datos[3]);
            $('#observaciones2').val(datos[4]);
            $('#fecha2').val(datos[19]);
            $('#responsable2').val(datos[9]);    
            $('#hora2').val(datos[11]);
            $('#costo2').val(datos[13]);
            $('#nextfecha2').val(datos[17]);
            $('#maquina_id2').val(datos[8]);
            $('#validaNE').val("1");
            $('#validaNI').val("0");
            $('#numero_mantE').val(id);
            $('#numero_mantI').val("");
            $('#rev_maquina').val("");
            $('#fechapropuesta').val("");
            $('#responsable').val("");
            $('#maquina_id').val("");
            $('#niv_aceite').val("");
            $('#observaciones').val("");
            $('#fecha').val("");
            $('#responsable').val("");    
            $('#hora').val("");
            $('#costo').val("");
            $('#nextfecha').val("");
            $('#externo').show();
            $('#interno').hide();
               
                $.ajax({
              type:"POST",
              url:"buscar_repuestos.php",
              data:'id='+id+'&tipo='+'preventivo',
              success: function (valores2){
                     var datos2=eval(valores2);
                    $('#repuestoPB2').html(datos2[0]);   
                   //  $('#NB').val("NB-"+datos2[1]);
                  

              }
            });
              $('#repuesto_asoc2').show();
              $('#repuesto_asoc').hide();
                   if (datos[5]=="No")
            {
                document.getElementById("lucesE1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesE2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradaE1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradaE2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresE1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresE2").checked=true;
            }
            buscaridmantE();
            document.getElementById("service_externo").checked=true;
            document.getElementById("lucesI1").checked=true;
            document.getElementById("paradaI1").checked=true;
            document.getElementById("pulsadoresI1").checked=true;
           mostrarPrompt("Continuando el mantenimiento externo", "numeroEPrompt", "green");
     }
    else if(datos[10]=="externo")
    {
      $('#numero_mantE').val(id);
      $('#numero_mantI').val("");
      $('#externo').show();
      $('#interno').hide();
      $('#validaNE').val("1");
      $('#validaNI').val("0");
      $('#rev_maquina2').val(datos[1]);
      $('#fechapropuesta2').val(datos[2]);
      $('#maquina_id2').val(datos[8]);
      $('#responsable2').val(datos[9]);
      $('#rev_maquina').val("");
      $('#fechapropuesta').val("");
      $('#responsable').val("");
      $('#provedor').val(datos[12]);
      $('#maquina_id').val("");
      $('#niv_aceite').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#responsable').val("");    
      $('#hora').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#repuesto_asoc').hide();
      $('#repuesto_asoc2').hide();
      $('#repuestoPC').val("");
       buscaridmantE();
      document.getElementById("lucesI1").checked=true;
      document.getElementById("paradaI1").checked=true;
      document.getElementById("pulsadoresI1").checked=true;
      document.getElementById("service_externo").checked=true;
      mostrarPrompt("Se cambio el registro a externo", "numeroEPrompt", "green");


        }
        else if (user==""){
      $('#validaNI').val("0");
      $('#rev_maquina').val("");
      $('#fechapropuesta').val("");
      $('#responsable').val("");
      $('#maquina_id').val("");
      $('#niv_aceite').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#responsable').val("");    
      $('#hora').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#repuesto_asoc').hide();
      $('#repuestoPC').val("");
      document.getElementById("lucesI1").checked=true;
      document.getElementById("paradaI1").checked=true;
      document.getElementById("pulsadoresI1").checked=true;
      mostrarPrompt("Campo Requerido", "numeroIPrompt", "red");
      return false;
      }
      else if(user.length == 0){
         $('#validaNI').val("0");
      $('#rev_maquina').val("");
      $('#fechapropuesta').val("");
      $('#responsable').val("");
      $('#maquina_id').val("");
      $('#niv_aceite').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#responsable').val("");    
      $('#hora').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#repuesto_asoc').hide();
      document.getElementById("lucesI1").checked=true;
      document.getElementById("paradaI1").checked=true;
      document.getElementById("pulsadoresI1").checked=true;
        mostrarPrompt("Campo Requerido", "numeroIPrompt", "red");
        return false;
      }

    else{
      $('#validaNI').val("0");
      $('#rev_maquina').val("");
      $('#fechapropuesta').val("");
      $('#responsable').val("");
      $('#maquina_id').val("");
      $('#niv_aceite').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#responsable').val("");    
      $('#hora').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#repuestoPC').val("");
      $('#repuesto_asoc').hide();
      document.getElementById("lucesI1").checked=true;
      document.getElementById("paradaI1").checked=true;
      document.getElementById("pulsadoresI1").checked=true;
      mostrarPrompt("No existe", "numeroIPrompt", "red");

    }
  }

});
   


  }

  function buscaridmantI(){
      var valor=document.getElementById("maquina_id").value;
        $.ajax({
      type:'POST',
      url:'buscar_insumaquina.php',
      data:'id='+valor,
      success: function(valores){
        //var datos=eval(valores);

       // $('#idR'+aqui).val(buscarid);

        $('#repuestoI1').html(valores);


      }
    });
      
  }
   function buscaridmantE(){
      var valor=document.getElementById("maquina_id2").value;
        $.ajax({
      type:'POST',
      url:'buscar_insumaquina.php',
      data:'id='+valor,
      success: function(valores){
        //var datos=eval(valores);

       // $('#idR'+aqui).val(buscarid);

        $('#repuestoE1').html(valores);


      }
    });
      
  }


  function buscaNumeroMantE(){
    var user=document.getElementById("numero_mantE").value;
    var id=$('#numero_mantE').val();

    $.ajax({
      type:"POST",
      url:"modifica_preventivo.php",
      data:'id='+id,
      success: function (valores){

       var datos=eval(valores);
      if (datos[18]=='concluido'){
      $('#validaNE').val("0");
        $('#rev_maquina2').val("");
        $('#fechapropuesta2').val("");
        $('#responsable2').val("");
        $('#provedor').val("");
        $('#maquina_id2').val("");
        $('#niv_aceite2').val("");
        $('#observaciones2').val("");
        $('#fecha2').val("");
        $('#hora2').val("");
        $('#costo2').val("");
        $('#nextfecha2').val("");
        $('#repuesto_asoc2').hide(); 
        $('#repuestoPC2').val("");
      mostrarPrompt("Ya concluido", "numeroEPrompt", "red");
     }
       else if(datos[18]=='no concluido' && datos[0]==id && datos[10]=="externo"){
            $('#provedor').val(datos[12]);
            $('#rev_maquina2').val(datos[1]);
            $('#fechapropuesta2').val(datos[2]);
            $('#niv_aceite2').val(datos[3]);
            $('#observaciones2').val(datos[4]);
            $('#fecha2').val(datos[19]);
            $('#responsable2').val(datos[9]);    
            $('#hora2').val(datos[11]);
            $('#costo2').val(datos[13]);
            $('#nextfecha2').val(datos[17]);
            $('#maquina_id2').val(datos[8]);
            $('#validaNE').val("1");
             $.ajax({
              type:"POST",
              url:"buscar_repuestos.php",
              data:'id='+id+'&tipo='+'preventivo',
              success: function (valores2){
                     var datos2=eval(valores2);
                    $('#repuestoPB2').html(datos2[0]);   
                   //  $('#NB').val("NB-"+datos2[1]);
                  

              }
            });
              $('#repuesto_asoc2').show();
              $('#repuesto_asoc').hide();          
            buscaridmantE();
            document.getElementById("service_externo").checked=true;
            if (datos[5]=="No")
            {
                document.getElementById("lucesE1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesE2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradaE1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradaE2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresE1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresE2").checked=true;
            }
           mostrarPrompt("Continuando el mantenimiento", "numeroEPrompt", "green");
     }
     else if (datos[0]==id && datos[10]=="externo"){
        $('#rev_maquina2').val(datos[1]);
        $('#fechapropuesta2').val(datos[2]);
        $('#maquina_id2').val(datos[8]);
        $('#responsable2').val(datos[9]);
        $('#provedor').val(datos[12]);
        $('#niv_aceite2').val("");
        $('#observaciones2').val("");
        $('#fecha2').val("");
        $('#hora2').val("");
        $('#costo2').val("");
        $('#nextfecha2').val("");
        $('#validaNE').val("1");
        $('#repuesto_asoc2').hide(); 
        $('#repuestoPC2').val("");
        buscaridmantE();
         document.getElementById("service_externo").checked=true;
         if (datos[5]=="No")
            {
                document.getElementById("lucesE1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesE2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradaE1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradaE2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresE1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresE2").checked=true;
            }
        mostrarPrompt("Valido", "numeroEPrompt", "green");
      }
         else if(datos[18]=='no concluido' && datos[0]==id && datos[10]=="interno"){
              $('#numero_mantI').val(id);
            $('#rev_maquina').val(datos[1]);
            $('#fechapropuesta').val(datos[2]);
            $('#niv_aceite').val(datos[3]);
            $('#observaciones').val(datos[4]);
            $('#fecha').val(datos[19]);
            $('#responsable').val(datos[9]);    
            $('#hora').val(datos[11]);
            $('#costo').val(datos[13]);
            $('#nextfecha').val(datos[17]);
            $('#maquina_id').val(datos[8]);
            $('#numero_mantE').val("");
            $('#interno').show();
            $('#externo').hide();
            $('#validaNI').val("1");
            $('#validaNE').val("0");
            $('#rev_maquina2').val("");
            $('#fechapropuesta2').val("");
            $('#responsable2').val("");
            $('#provedor').val("");
             $.ajax({
              type:"POST",
              url:"buscar_repuestos.php",
              data:'id='+datos[0]+'&tipo='+'preventivo',
              success: function (valores2){
                     var datos2=eval(valores2);
                    $('#repuestoPB').html(datos2[0]);   
                   //  $('#NB').val("NB-"+datos2[1]);
                  

              }
            });
              $('#repuesto_asoc').show();
               $('#repuesto_asoc2').hide();          
               $('#repuestoPC2').val("");
                    if (datos[5]=="No")
            {
                document.getElementById("lucesI1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesI2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradaI1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradaI2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresI1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresI2").checked=true;
            }
            buscaridmantI();
            document.getElementById("service_interno").checked=true;
            document.getElementById("lucesE1").checked=true;
            document.getElementById("paradaE1").checked=true;
            document.getElementById("pulsadoresE1").checked=true;
           mostrarPrompt("Continuando el mantenimiento Interno", "numeroIPrompt", "green");
     }


      else if(datos[10]=="interno")
      {
        $('#numero_mantI').val(id);
        $('#numero_mantE').val("");
        $('#interno').show();
        $('#externo').hide();
        $('#validaNI').val("1");
        $('#validaNE').val("0");
        $('#rev_maquina').val(datos[1]);
        $('#fechapropuesta').val(datos[2]);
        $('#maquina_id').val(datos[8]);
        $('#responsable').val(datos[9]);
        $('#rev_maquina2').val("");
        $('#fechapropuesta2').val("");
        $('#responsable2').val("");
        $('#provedor').val("");
        $('#niv_aceite2').val("");
        $('#observaciones2').val("");
        $('#fecha2').val("");
        $('#hora2').val("");
        $('#costo2').val("");
        $('#nextfecha2').val("");
        $('#repuesto_asoc').hide();
        $('#repuesto_asoc2').hide(); 
        $('#repuestoPC2').val("");
             if (datos[5]=="No")
            {
                document.getElementById("lucesI1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesI2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradaI1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradaI2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresI1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresI2").checked=true;
            }
         buscaridmantI();
        document.getElementById("service_interno").checked=true;
        document.getElementById("lucesE1").checked=true;
        document.getElementById("paradaE1").checked=true;
        document.getElementById("pulsadoresE1").checked=true;
        mostrarPrompt("Se cambio el registro a interno", "numeroIPrompt", "green");


      }
      else if (user==""){
      mostrarPrompt("Campo Requerido", "numeroEPrompt", "red");
      $('#validaNE').val("0");
        $('#rev_maquina2').val("");
        $('#fechapropuesta2').val("");
        $('#responsable2').val("");
        $('#maquina_id2').val("");
        $('#provedor').val("");
        $('#niv_aceite2').val("");
        $('#observaciones2').val("");
        $('#fecha2').val("");
        $('#hora2').val("");
        $('#costo2').val("");
        $('#nextfecha2').val("");
        $('#repuesto_asoc2').hide(); 
        $('#repuestoPC2').val("");
        document.getElementById("lucesE1").checked=true;
        document.getElementById("paradaE1").checked=true;
        document.getElementById("pulsadoresE1").checked=true;
      return false;
    }
    else if(user.length == 0){
      mostrarPrompt("Campo Requerido", "numeroEPrompt", "red");
      $('#validaNE').val("0");
        $('#rev_maquina2').val("");
        $('#fechapropuesta2').val("");
        $('#responsable2').val("");
        $('#provedor').val("");
        $('#maquina_id2').val("");
        $('#niv_aceite2').val("");
        $('#observaciones2').val("");
        $('#fecha2').val("");
        $('#hora2').val("");
        $('#costo2').val("");
        $('#nextfecha2').val("");
        $('#repuesto_asoc2').hide(); 
        $('#repuestoPC2').val("");
        document.getElementById("lucesE1").checked=true;
        document.getElementById("paradaE1").checked=true;
        document.getElementById("pulsadoresE1").checked=true;
      return false;
    }
   
      else{
        $('#validaNE').val("0");
        $('#rev_maquina2').val("");
        $('#fechapropuesta2').val("");
        $('#responsable2').val("");
        $('#provedor').val("");
        $('#maquina_id2').val("");
        $('#niv_aceite2').val("");
        $('#observaciones2').val("");
        $('#fecha2').val("");
        $('#hora2').val("");
        $('#costo2').val("");
        $('#nextfecha2').val("");
        $('#repuesto_asoc2').hide(); 
        $('#repuestoPC2').val("");
        document.getElementById("lucesE1").checked=true;
        document.getElementById("paradaE1").checked=true;
        document.getElementById("pulsadoresE1").checked=true;
        mostrarPrompt("No existe", "numeroEPrompt", "red");

      }
    }

  });
   

  }

function validaNI(){
  var valor=document.getElementById("validaNI").value;

if (valor=="")
{


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

function validaNE(){
  var valor=document.getElementById("validaNE").value;

if (valor=="")
{


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

  function valida_fechaEj(){



    var split_fecha;
    var fecha=document.getElementById('fecha').value;
    var fecha2=document.getElementById('fecha').value;
    split_fecha = fecha.split("/");

    fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];




        var primera = Date.parse(fecha); //01 de Octubre del 2013

        var split_fecha2;

        var dateNext=document.getElementById('fechapropuesta').value;


       split_fecha2 = dateNext.split("/");

         dateNext=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];

        var segunda = Date.parse(dateNext); 

        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        var hoy=new Date(year, month, day);

        var tercera = Date.parse(hoy);


          if (!fecha2.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fechaPrompt", "red");
          return false;
    }

        if (fecha2==""){
         mostrarPrompt("Campo Requerido", "fechaPrompt", "red");
         return false;
       }
       else if(primera<segunda){
           mostrarPrompt("fecha menor a la fecha solicitada", "fechaPrompt", "red");

          return false;
        }

       else if(primera>tercera){
           mostrarPrompt("fecha mayor al dia de hoy", "fechaPrompt", "red");

          return false;
        }
        
        else{
       mostrarPrompt("Valido", "fechaPrompt", "green");

         return true;

        }

        
    }


    function valida_fechaEj2(){

       var split_fecha;
    var fecha=document.getElementById('fecha2').value;
    var fecha2=document.getElementById('fecha2').value;
    split_fecha = fecha.split("/");

    fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];




        var primera = Date.parse(fecha); //01 de Octubre del 2013

        var split_fecha2;

        var dateNext=document.getElementById('fechapropuesta2').value;


       split_fecha2 = dateNext.split("/");

         dateNext=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];

        var segunda = Date.parse(dateNext); 

        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        var hoy=new Date(year, month, day);

        var tercera = Date.parse(hoy);


          if (!fecha2.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fecha2xPrompt", "red");
          return false;
    }

        if (fecha2==""){
         mostrarPrompt("Campo Requerido", "fecha2xPrompt", "red");
         return false;
       }
      else  if(primera<segunda){
           mostrarPrompt("fecha menor a la fecha solicitada", "fecha2xPrompt", "red");

          return false;
        }

       else if(primera>tercera){
           mostrarPrompt("fecha mayor al dia de hoy", "fecha2xPrompt", "red");

          return false;
        }
        
        else{
       mostrarPrompt("Valido", "fecha2xPrompt", "green");

         return true;

        }




    }



      var $body=$(document.body);
    $body.find('[id^=repuestoI]').attr("disabled",true);
    $body.find('[id^=repuestoE]').attr("disabled",true);
    $body.find('[id^=idR]').attr("disabled",true);
    $body.find('[id^=idRE]').attr("disabled",true);
    $body.find('[id^=utilizadaI]').attr("disabled",true);
    $body.find('[id^=utilizadaE]').attr("disabled",true);

    $('#tablo').hide();
    $('#div_sumaI').hide();
    $('#tablo2').hide();
    $('#div_sumaE').hide();

    $('#incluir_noI').click(function(){
   // $('[id^=repuestoI]').disabled=true;
   var $body=$(document.body);
    $body.find('[id^=repuestoI]').attr("disabled",true);
    $body.find('[id^=idR]').attr("disabled",true);
    $body.find('[id^=utilizadaI]').attr("disabled",true);
    $('#tablo').hide();
    $('#div_sumaI').hide();

  });

    $('#incluir_siI').click(function(){
   // $('[id^=repuestoI]').disabled=true;
   var $body=$(document.body);
    $body.find('[id^=repuestoI]').attr("disabled",false);
    $body.find('[id^=idR]').attr("disabled",false);
    $body.find('[id^=utilizadaI]').attr("disabled",false);
    $('#tablo').show();
    $('#div_sumaI').show();
   
  });

     $('#incluir_noE').click(function(){
   // $('[id^=repuestoI]').disabled=true;
   var $body=$(document.body);
    $body.find('[id^=repuestoE]').attr("disabled",true);
    $body.find('[id^=utilizadaE]').attr("disabled",true);
    $body.find('[id^=idRE]').attr("disabled",true);

    $('#tablo2').hide();
    $('#div_sumaE').hide();

  });

    $('#incluir_siE').click(function(){
   // $('[id^=repuestoI]').disabled=true;
   var $body=$(document.body);
    $body.find('[id^=repuestoE]').attr("disabled",false);
    $body.find('[id^=utilizadaE]').attr("disabled",false);
    $body.find('[id^=idRE]').attr("disabled",false);

    $('#tablo2').show();
    $('#div_sumaE').show();
   
  });




    function validarFormI()
    {
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validaNI() || !valida_fechaEj() || !validar_aceite() || !valida_fecha_mayor() || !validarHombre() || !validarCosto() || !validarObservaciones() || !validaridrI() || !validar_utilizadaIR1() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
    return false;*/
    jsMostrar("salidaR_PRE");

    mostrarPrompt("El formulario debe estar completo", "salidaR_PRE", "red");

    setTimeout(function()
    {
      jsOcultar("salidaR_PRE");
    }, 2000);

    return false;
  } 
  return true;
}

function validarFormE()
{


  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validaNE() || !valida_fechaEj2() || !validar_aceite2() || !valida_fecha_mayor2() || !validarHombre2() || !validarCosto2()  || !validarObservaciones2() || !validaridrE() || !validar_utilizadaER1() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
    return false;*/
    jsMostrar("salidaR_PRE2");

    mostrarPrompt("El formulario debe estar completo", "salidaR_PRE2", "red");

    setTimeout(function()
    {
      jsOcultar("salidaR_PRE2");
    }, 2000);

    return false;
  } 
  return true;
}


 function buscaNumeroMantP(){
    var user=document.getElementById("numero_mantP").value;
    var id=$('#numero_mantP').val();

    $.ajax({
      type:"POST",
      url:"modifica_preventivo.php",
      data:'id='+id,
      success: function (valores){

       var datos=eval(valores);
     
       if(datos[18]=='no concluido' && datos[0]==id && datos[10]=="externo"){
            $('#provedorP').val(datos[12]);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[9]);   
            $('#maquina_id').val(datos[8]);
            $('#validaNP').val("1");          
           // buscaridmantE();
            
           mostrarPrompt("Mantenimiento Externo", "numeroPPrompt", "green");
               var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

             $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'preventivo',
      success: function (valores2){
                var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]);
           
    
           //  $('#NB').val("NB-"+datos2[1]);
      }
    });
     }
    else if(datos[18]=='concluido' && datos[0]==id && datos[10]=="externo"){
            $('#provedorP').val(datos[12]);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[9]);   
            $('#maquina_id').val(datos[8]);
            $('#validaNP').val("1");   
          //  buscaridmantE();
           mostrarPrompt("Mantenimiento Externo", "numeroPPrompt", "green");

           var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

             $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'preventivo',
      success: function (valores2){
               var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]); 
           
           //  $('#NB').val("NB-"+datos2[1]);
      }
    });

     }
    
         else if(datos[18]=='no concluido' && datos[0]==id && datos[10]=="interno"){
              $('#numero_mantP').val(id);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[9]);    
            $('#maquina_id').val(datos[8]);
            $('#provedorP').val("");
            $('#validaNP').val("1");   

          // buscaridmantI();
           mostrarPrompt("Mantenimiento Interno", "numeroPPrompt", "green");
     
           var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

             $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'preventivo',
      success: function (valores2){
            var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]); 
           //  $('#NB').val("NB-"+datos2[1]);
      }
    });

     }     
     else if(datos[18]=='concluido' && datos[0]==id && datos[10]=="interno"){
                   $('#numero_mantP').val(id);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[9]);    
            $('#maquina_id').val(datos[8]);
            $('#provedorP').val("");
            $('#validaNP').val("1");   

         //   buscaridmantI();
           mostrarPrompt("Mantenimiento Interno", "numeroPPrompt", "green");
     
           var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

         $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'preventivo',
      success: function (valores2){
             var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]);   
           //  $('#NB').val("NB-"+datos2[1]);
          

      }
    });



     }
      else if (user==""){
      mostrarPrompt("Campo Requerido", "numeroPPrompt", "red");
       $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
         $('#codigo').val("");
          $('#NB').val("");
         $('#repuestoPB').html("<option value=''></option>");
          $('#repuestoPC').val("");

      return false;
    }
    else if(user.length == 0){
      mostrarPrompt("Campo Requerido", "numeroPPrompt", "red");
      $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
          $('#codigo').val("");
          $('#NB').val("");
         $('#repuestoPB').html("<option value=''></option>");
          $('#repuestoPC').val("");

  
      return false;
    }
   
      else{
        $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
          $('#codigo').val("");
          $('#NB').val("");
          $('#repuestoPB').html("<option value=''></option>");
         $('#repuestoPC').val("");


        mostrarPrompt("No existe", "numeroPPrompt", "red");

      }
    }

  });


    

 
    var valor=document.getElementById("validaNP").value;

    if (valor==0)
    {


      return false;
    }
    if (valor==1)
    {


      return true;
    }


  }

   function buscaNumeroMantC(){
    var user=document.getElementById("numero_mantC").value;
    var id=$('#numero_mantC').val();

    $.ajax({
      type:"POST",
      url:"modifica_correctivo.php",
      data:'id='+id,
      success: function (valores){

       var datos=eval(valores);
     
       if(datos[15]=='no concluido' && datos[0]==id && datos[8]=="externo"){
            $('#provedorP').val(datos[10]);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[2]);   
            $('#maquina_id').val(datos[12]);
            $('#validaNP').val("1");          
           // buscaridmantE();
            
           mostrarPrompt("Mantenimiento Externo", "numeroPPrompt", "green");
               var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

             $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'correctivo',
      success: function (valores2){
                var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]);
           
    
           //  $('#NB').val("NB-"+datos2[1]);
      }
    });
     }
    else if(datos[15]=='concluido' && datos[0]==id && datos[8]=="externo"){
            $('#provedorP').val(datos[10]);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[2]);   
            $('#maquina_id').val(datos[12]);
            $('#validaNP').val("1");   
          //  buscaridmantE();
           mostrarPrompt("Mantenimiento Externo", "numeroPPrompt", "green");

           var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

             $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'correctivo',
      success: function (valores2){
               var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]); 
           
           //  $('#NB').val("NB-"+datos2[1]);
      }
    });

     }
    
         else if(datos[15]=='no concluido' && datos[0]==id && datos[8]=="interno"){
              $('#numero_mantC').val(id);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[2]);    
            $('#maquina_id').val(datos[12]);
            $('#provedorP').val("");
            $('#validaNP').val("1");   

          // buscaridmantI();
           mostrarPrompt("Mantenimiento Interno", "numeroPPrompt", "green");
     
           var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

             $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'correctivo',
      success: function (valores2){
            var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]); 
           //  $('#NB').val("NB-"+datos2[1]);
      }
    });

     }     
     else if(datos[15]=='concluido' && datos[0]==id && datos[8]=="interno"){
                   $('#numero_mantC').val(id);
            $('#rev_maquina').val(datos[1]);
            $('#responsable').val(datos[12]);    
            $('#maquina_id').val(datos[12]);
            $('#provedorP').val("");
            $('#validaNP').val("1");   

         //   buscaridmantI();
           mostrarPrompt("Mantenimiento Interno", "numeroPPrompt", "green");
     
           var id_maquina=$('#maquina_id').val();

             $.ajax({
      type:"POST",
      url:"modifica_maquina.php",
      data:'id_maq='+id_maquina,
      success: function (valores2){
               var datos2=eval(valores2);
            $('#codigo').val(datos2[0]);   
             $('#NB').val("NB-"+datos2[1]);
      }
    });

         $.ajax({
      type:"POST",
      url:"buscar_repuestos.php",
      data:'id='+id+'&tipo='+'correctivo',
      success: function (valores2){
             var datos2=eval(valores2);
            $('#repuestoPB').html(datos2[0]);   
           //  $('#NB').val("NB-"+datos2[1]);
          

      }
    });



     }
      else if (user==""){
      mostrarPrompt("Campo Requerido", "numeroPPrompt", "red");
       $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
         $('#codigo').val("");
          $('#NB').val("");
         $('#repuestoPB').html("<option value=''></option>");
          $('#repuestoPC').val("");

      return false;
    }
    else if(user.length == 0){
      mostrarPrompt("Campo Requerido", "numeroPPrompt", "red");
      $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
          $('#codigo').val("");
          $('#NB').val("");
         $('#repuestoPB').html("<option value=''></option>");
          $('#repuestoPC').val("");

  
      return false;
    }
   
      else{
        $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
          $('#codigo').val("");
          $('#NB').val("");
          $('#repuestoPB').html("<option value=''></option>");
         $('#repuestoPC').val("");


        mostrarPrompt("No existe", "numeroPPrompt", "red");

      }
    }

  });


    

 
    var valor=document.getElementById("validaNP").value;

    if (valor==0)
    {


      return false;
    }
    if (valor==1)
    {


      return true;
    }


  }

  function busca_cantidadP(){
     id=$('#repuestoPB').val();
    $.ajax({
      type:"POST",
      url:"buscar_cantidad.php",
      data:'id='+id+'&tipo='+'preventivo',
      success: function (valores2){
            // var datos2=eval(valores2);
           //  $('#NB').val("NB-"+datos2[1]);
            $('#repuestoPC').val(valores2);   

      }
    });
  }

   function busca_cantidadP2(){
     id=$('#repuestoPB2').val();
    $.ajax({
      type:"POST",
      url:"buscar_cantidad.php",
      data:'id='+id+'&tipo='+'preventivo',
      success: function (valores2){
            // var datos2=eval(valores2);
           //  $('#NB').val("NB-"+datos2[1]);
            $('#repuestoPC2').val(valores2);   

      }
    });
  }

  function validarDevolverP(){
      var existe=document.getElementById("repuestoPC").value;

  var danadas = document.getElementById("repuestoPS").value;
  
  exis1=parseInt(danadas);
  exis2=parseInt(existe);
    if(danadas==""){
     mostrarPrompt("Campo Requerido", "devolverPPrompt", "red");
    return false;
  }
   if(danadas<1){
     mostrarPrompt("Campo Requerido", "devolverPPrompt", "red");
    return false;
  }
  
   else if(exis1>exis2){
    mostrarPrompt("La cantidad supera la Salida", "devolverPPrompt", "red");
    //alert(total);
    return false;
  }

  else{
mostrarPrompt("Valido", "devolverPPrompt", "green");
  return true;
}
}



  

  $('#service_preventivo').click(function(){
       $('#reg_maquina').attr("onsubmit","return validarFormRP()");

    // $('#numero_mantP').attr("id", "numero_mantP").attr("onblur","buscaNumeroMantP()");
     $('#numero_mantC').attr("id", "numero_mantP").attr("onblur","buscaNumeroMantP()");
    $('#tipo_mant_R').attr("value", "preventivo");
     $('#interno').show();
      $('#numero_mantP').val("");
     $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
          $('#codigo').val("");
          $('#NB').val("");
         $('#repuestoPB').html("<option value=''></option>");
          $('#repuestoPC').val("");
        mostrarPrompt("", "numeroPPrompt", "red");
       


    });

  $('#service_correctivo').click(function(){
          $('#reg_maquina').attr("onsubmit","return validarFormRC()");
     $('#numero_mantP').attr("id", "numero_mantC").attr("onblur","buscaNumeroMantC()");
      $('#tipo_mant_R').attr("value", "correctivo");
            $('#interno').show();
       $('#numero_mantC').val("");
      $('#validaNP').val("0");
        $('#rev_maquina').val("");
        $('#responsable').val("");
        $('#provedorP').val("");
        $('#maquina_id').val("");
          $('#codigo').val("");
          $('#NB').val("");
         $('#repuestoPB').html("<option value=''></option>");
          $('#repuestoPC').val("");
        $("#numeroPPrompt").val("");
         mostrarPrompt("", "numeroPPrompt", "red");

  //   $('#numero_mantC').attr("id", "numero_mantC").attr("onblur","buscaNumeroMantC()");

    });

  function validarNumeroMantP(){
  var user = document.getElementById("numero_mantP").value;    
  

 if(user.length == 0){
   mostrarPrompt("Campo Requerido", "numeroPPrompt", "red");
   return false;
 }
 else if(!user.match(/^[0-9]{1,6}$/)){
  mostrarPrompt("Invalido", "numeroPPrompt", "red");
  return false;     
    
  }
  else{
 mostrarPrompt("Valido", "numeroPPrompt", "green");
  return true  
}
}
  function validarNumeroMantC(){
  var user = document.getElementById("numero_mantC").value;    
  

 if(user.length == 0){
   mostrarPrompt("Campo Requerido", "numeroPPrompt", "red");
   return false;
 }
 else if(!user.match(/^[0-9]{1,6}$/)){
  mostrarPrompt("Invalido", "numeroPPrompt", "red");
  return false;     
    
  }
  else{
 mostrarPrompt("Valido", "numeroPPrompt", "green");
  return true  
}
}

 function validarRepuestoPB(){
  var user = document.getElementById("repuestoPB").value;    
  

 if(user == ""){
  mostrarPrompt("Campo Requerido", "repuestoPBPrompt", "red");
   return false;
 }
 
  else{
 mostrarPrompt("Valido", "repuestoPBPrompt", "green");
  return true  
}
}


function validarFormRP(){
 if( !validarNumeroMantP() || !validarRepuestoPB() || !validarDevolverP() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
    return false;*/
    jsMostrar("salidaR_PRE");

    mostrarPrompt("El formulario debe estar completo", "salidaR_PRE", "red");

    setTimeout(function()
    {
      jsOcultar("salidaR_PRE");
    }, 2000);

    return false;
  } 
  return true; 
}

function validarFormRC(){
 if( !validarNumeroMantC() || !validarRepuestoPB() || !validarDevolverP() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
    return false;*/
    jsMostrar("salidaR_PRE");

    mostrarPrompt("El formulario debe estar completo", "salidaR_PRE", "red");

    setTimeout(function()
    {
      jsOcultar("salidaR_PRE");
    }, 2000);

    return false;
  } 
  return true; 
}