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
       letras = "1234567890:";
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


      function soloAlfa(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890,.";
       //especiales = "8-37-39-46";
       especiales=['8','37','39','46','9'];


       tecla_especial = false
     //  for(var i in especiales){
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

    function existeCodigo(){
     var user = document.getElementById("codigo").value;

     var consulta;

     consulta=$("#codigo").val();
     var consultax;
     consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);




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
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
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

function validarMotivo(){

  var user = document.getElementById("motivo").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "motivoPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "motivoPrompt", "red");
  return false;
}
if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "motivoPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "motivoPrompt", "green");
return true;

}

function validarMotivo2(){

  var user = document.getElementById("motivo2").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "motivo2Prompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "motivo2Prompt", "red");
  return false;
}
if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "motivo2Prompt", "red");
  return false;     
}
mostrarPrompt("Valido", "motivo2Prompt", "green");
return true;
}

function validarMotivomod(){

  var user = document.getElementById("motivomod").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "motivomodPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "motivomodPrompt", "red");
  return false;
}
if(!user.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "motivomodPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "motivomodPrompt", "green");
return true;

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

function validarDescripcion(){

  var user = document.getElementById("descripcion").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "descripcionPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "descripcionPrompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "descripcionPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "descripcionPrompt", "green");
return true;

}

function validarDescripcion2(){

  var user = document.getElementById("descripcion2").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "descripcion2Prompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "descripcion2Prompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "descripcion2Prompt", "red");
  return false;     
}
mostrarPrompt("Valido", "descripcion2Prompt", "green");
return true;

}

function validarDescripcionmod(){

  var user = document.getElementById("descripcionmod").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "descripcionmodPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "descripcionmodPrompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "descripcionmodPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "descripcionmodPrompt", "green");
return true;

}

function validarPieza_cambio(){

  var user = document.getElementById("pieza_cambio").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "pieza_cambioPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "pieza_cambioPrompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "pieza_cambioPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "pieza_cambioPrompt", "green");
return true;

}

function validarPieza_cambio2(){

  var user = document.getElementById("pieza_cambio2").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "pieza_cambio2Prompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "pieza_cambio2Prompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "pieza_cambio2Prompt", "red");
  return false;     
}
mostrarPrompt("Valido", "pieza_cambio2Prompt", "green");
return true;

}

function validarPieza_cambiomod(){

  var user = document.getElementById("pieza_cambiomod").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "pieza_cambiomodPrompt", "red");
   return false;
 }
 if (user.match(/^\s/))
 {
  mostrarPrompt("Invalido", "pieza_cambiomodPrompt", "red");
  return false;
}
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "pieza_cambiomodPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "pieza_cambiomodPrompt", "green");
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
if(!user.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
  mostrarPrompt("Invalido", "proveedorPrompt", "red");
  return false;     
}
mostrarPrompt("Valido", "proveedorPrompt", "green");
return true;

}

function validarProveedormod(){
  var estado=document.getElementById("proveedormod");

  if(estado.disabled==false){
    var user = document.getElementById("proveedormod").value;
    
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


    function valida_fecha(){

      var url='buscar_fecha_igual.php';
      var fecha2=document.getElementById('fecha').value;


      if (!fecha2.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
      {
        mostrarPrompt("Invalido", "fechaPrompt", "red");
        return false;
      }



      var split_fecha;
      var fecha=document.getElementById('fecha').value;

      split_fecha = fecha.split("/");

      fecha=split_fecha[2]+"-"+split_fecha[1]+"-"+split_fecha[0];

      var id=document.getElementById('id_maq').value;
      var valor2 = document.getElementById("resultado_fecha").value;

        var primera = Date.parse(fecha); //01 de Octubre del 2013

        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        var dateNext=new Date(year, month, day);

        var segunda = Date.parse(dateNext); 

        var fechaej=document.getElementById('nextfecha').value;
      fechaej = fechaej.split("/");

      fechaej=fechaej[2]+"-"+fechaej[1]+"-"+fechaej[0];

        var tercera = Date.parse(fechaej);
        //alert("funcion personal "+ci);
        var tipo="registro";
        var mantenimiento="correctivo";
        $.ajax({
          type:'POST',
          url:url,
          data:'fecha='+fecha+'&id='+id+'&tipo='+tipo+'&mant='+mantenimiento,
          success:function(valores){
            var datos=eval(valores);
            $("#resultado_fecha").val(datos[0]);
            var valor = document.getElementById("resultado_fecha").value;


            if (valor==""){
             mostrarPrompt("Campo Requerido", "fechaPrompt", "red");
           }

           if (valor=="igual")
           {

             mostrarPrompt("Ya se realizo una solicitud para esta fecha", "fechaPrompt", "red");

           }
           if (valor=="valido")
           {


             mostrarPrompt("Valido", "fechaPrompt", "green");

           }
           if(primera>segunda){
            mostrarPrompt("La fecha debe ser menor o igual al dia de hoy", "fechaPrompt", "red");

          }
           if(primera>tercera){
            mostrarPrompt("La fecha debe ser menor o igual a la fecha de ejecucion", "fechaPrompt", "red");

          }
        }
      });

        if(primera>segunda){

          return false;
        }
         if(primera>tercera){

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
        mostrarPrompt("Invalido", "fecha2Prompt", "red");
        return false;
      }
      split_fecha = fecha.split("/");

      fecha=split_fecha[2]+"-"+split_fecha[1]+"-"+split_fecha[0];

      var id=document.getElementById('id_maq2').value;
      var valor2 = document.getElementById("resultado_fecha2").value;

        var primera = Date.parse(fecha); //01 de Octubre del 2013

        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        var dateNext=new Date(year, month, day);

        var segunda = Date.parse(dateNext); 

        var fechaej=document.getElementById('nextfecha2').value;
      fechaej = fechaej.split("/");

      fechaej=fechaej[2]+"-"+fechaej[1]+"-"+fechaej[0];
              var tercera = Date.parse(fechaej);

        //alert("funcion personal "+ci);
        var tipo="registro";
        var mantenimiento="correctivo";
        $.ajax({
          type:'POST',
          url:url,

          data:'fecha='+fecha+'&id='+id+'&tipo='+tipo+'&mant='+mantenimiento,
          success:function(valores){
            var datos=eval(valores);
            $("#resultado_fecha2").val(datos[0]);
            var valor = document.getElementById("resultado_fecha2").value;


            if (valor==""){
             mostrarPrompt("Campo Requerido", "fecha2Prompt", "red");
           }

           if (valor=="igual")
           {

             mostrarPrompt("Ya se realizo una solicitud para esta fecha", "fecha2Prompt", "red");

           }
           if (valor=="valido")
           {


             mostrarPrompt("Valido", "fecha2Prompt", "green");

           }
           if(primera>segunda){
            mostrarPrompt("La fecha debe ser menor o igual al dia de hoy", "fecha2Prompt", "red");

          }
          if(primera>tercera){
            mostrarPrompt("La fecha debe ser menor o igual a la fecha de ejecucion", "fecha2Prompt", "red");

          }
        }
      });

        if(primera>segunda){

          return false;
        }
        if(primera>tercera){

          return false;
        }
        if (valor2==""){
         mostrarPrompt("Campo Requerido", "fecha2Prompt", "red");
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

      function validarFalla(){

        var user = document.getElementById("hora_f").value;

        if(user.length == 0){
         mostrarPrompt("Campo Requerido", "hora_fPrompt", "red");
         return false;
       }
       if(!user.match(/^[0-2][0-9]:[0-5][0-9]\s[A-Za-z]{2}/)){
        mostrarPrompt("Invalido", "hora_fPrompt", "red");
        return false;     
      }
      mostrarPrompt("Valido", "hora_fPrompt", "green");
      return true;

    }

    function validarFalla2(){

      var user = document.getElementById("hora_f2").value;

      if(user.length == 0){
       mostrarPrompt("Campo Requerido", "hora_f2Prompt", "red");
       return false;
     }
     if(!user.match(/^[0-2][0-9]:[0-5][0-9]\s[A-Za-z]{2}/)){
        mostrarPrompt("Invalido", "hora_fPrompt", "red");
        return false;     
      }
    mostrarPrompt("Valido", "hora_f2Prompt", "green");
    return true;

  }

  function validarFallamod(){

    var user = document.getElementById("hora_fallamod").value;
    
    if(user.length == 0){
     mostrarPrompt("Campo Requerido", "hora_fallamodPrompt", "red");
     return false;
   }
    if(!user.match(/^[0-2][0-9]:[0-5][0-9]\s[A-Za-z]{2}/)){
        mostrarPrompt("Invalido", "hora_fPrompt", "red");
        return false;     
      }
  mostrarPrompt("Valido", "hora_fallamodPrompt", "green");
  return true;

}

function validarArraque(){

  var user = document.getElementById("hora_a").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "hora_aPrompt", "red");
   return false;
 }
  if(!user.match(/^[0-2][0-9]:[0-5][0-9]\s[A-Za-z]{2}/)){
        mostrarPrompt("Invalido", "hora_fPrompt", "red");
        return false;     
      }
mostrarPrompt("Valido", "hora_aPrompt", "green");
return true;

}

function validarArranque2(){

  var user = document.getElementById("hora_a2").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "hora_a2Prompt", "red");
   return false;
 }
  if(!user.match(/^[0-2][0-9]:[0-5][0-9]\s[A-Za-z]{2}/)){
        mostrarPrompt("Invalido", "hora_fPrompt", "red");
        return false;     
      }
mostrarPrompt("Valido", "hora_a2Prompt", "green");
return true;

}

function validarArranquemod(){

  var user = document.getElementById("hora_arranquemod").value;

  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "hora_arranquemodPrompt", "red");
   return false;
 }
  if(!user.match(/^[0-2][0-9]:[0-5][0-9]\s[A-Za-z]{2}/)){
        mostrarPrompt("Invalido", "hora_fPrompt", "red");
        return false;     
      }
mostrarPrompt("Valido", "hora_arranquemodPrompt", "green");
return true;

}


function validarHombre(){

  var user = document.getElementById("hora_h").value;

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

  var user = document.getElementById("hora_h2").value;

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


function validar_aceite()
{
  var nombres = document.getElementById("niv_aceite").value;

  if (nombres == 0)
  {
   mostrarPrompt("Campo Requerido", "aceitePrompt", "red");
   return false;
 }
 mostrarPrompt("Valido", "aceitePrompt", "green");
 return true;
}

function valida_fecha_mayor(){

 var split_fecha;

 var fecha=document.getElementById('fecha').value;

 split_fecha = fecha.split("/");

 fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

 var split_fecha2;

 var nextfecha=document.getElementById('nextfecha').value;

 split_fecha2 = nextfecha.split("/");

 nextfecha=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];

 var primera = Date.parse(fecha); //01 de Octubre del 2013
var segunda = Date.parse(nextfecha); //03 de Octubre del 2013

if (primera > segunda) {
  mostrarPrompt("La fecha debe ser mayor a la fecha de la revision", "fecha2Prompt", "red");
  return false;
}
if (primera == segunda){
  mostrarPrompt("La fecha debe ser mayor a la fecha de la revision", "fecha2Prompt", "red");
  return false;
}
else{
  mostrarPrompt("Valido", "fecha2Prompt", "green");
  return true;
}
        //alert("funcion personal "+ci);


      }

      function validarForm()
      {
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!existeCodigo() || !validarCI() || !validarResponsable() || !validarMotivo() ){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;
   || !validarFalla() || !validarDescripcion() || !validarPieza_cambio() || !validarArraque() || !validarHombre() || !validarCosto()
   */
   jsMostrar("salidaR_COR");

   mostrarPrompt("El formulario debe estar completo", "salidaR_COR", "red");

   setTimeout(function()
   {
    jsOcultar("salidaR_COR");
  }, 2000);

   return false;
 } 
 return true;
}

function validarForm2()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if(!existeCodigo2() ||  !validarCI2() || !validarProveedor() || !validarResponsable2() || !validarMotivo2()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;
    || !valida_fecha2() || !validarFalla2() ||  !validarDescripcion2() || !validarPieza_cambio2() || !validarArranque2() || !validarHombre2() || !validarCosto2()
    */
    jsMostrar("salidaR_COR2");

    mostrarPrompt("El formulario debe estar completo", "salidaR_COR2", "red");

    setTimeout(function()
    {
      jsOcultar("salidaR_COR2");
    }, 2000);

    return false;
  } 
  return true;
}



function valida_fechamod(){

  var url='buscar_fecha_igual.php';

  var split_fecha;
  var fecha=document.getElementById('fechamod').value;

  split_fecha = fecha.split("/");

  fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

  var id2=document.getElementById('m_id_corre').value;

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
        var mantenimiento="correctivo";
        $.ajax({
          type:'POST',
          url:url,
          data:'fecha='+fecha+'&id='+id+'&tipo='+tipo+'&id_corre='+id2+'&mant='+mantenimiento,
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
  if( !validarResponsablemod() || !validarMotivomod() || !validarProveedormod() || !valida_fechamod() || !validarFallamod() || !validarObservacionesmod() || !validarArranquemod() || !validarHombremod() || !validarCostomod()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
return false;*/
jsMostrar("salidaM_COR");

mostrarPrompt("El formulario debe estar completo", "salidaM_COR", "red");

setTimeout(function()
{
  jsOcultar("salidaM_COR");
}, 2000);

return false;

} 
return true;
}

function validarForm_SC()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validarResponsablemod() || !validarProveedormod() || !validarMotivomod()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
return false;*/
jsMostrar("salidaM_COR");

mostrarPrompt("El formulario debe estar completo", "salidaM_COR", "red");

setTimeout(function()
{
  jsOcultar("salidaM_COR");
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


document.getElementById("utilizadaER1").disabled=true;


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

    document.getElementById("utilizadaIR1").disabled=true;

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
                 //alert(idr);
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
         //existencia=parseInt(existencia);
     valor=control.value;
         valor=parseInt(valor);
         if (user[i].value == '')
         {
        //alert("¡Existen estilos sin completar!");
        

        mostrarPrompt("Campo Requerido", "utilizadaIRPrompt"+aqui, "red");

        
        return false;
      } 
      else if (valor=='0'){
   mostrarPrompt("La cantidad no puede ser 0", "utilizadaIRPrompt"+aqui, "red");
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
                 //alert(idr);
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
         //existencia=parseInt(existencia);
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
    url:"modifica_correctivo.php",
    data:'id='+id,
    success: function (valores){

     var datos=eval(valores);

     if (datos[15]=='concluido'){
       $('#validaNI').val("0")
       $('#rev_maquina').val("");
       $('#fechapropuesta').val("");
       $('#responsable').val("");
       $('#maquina_id').val("");
       $('#observaciones').val("");
       $('#fecha').val("");
       $('#hora_f').val("");
       $('#hora_a').val("");
       $('#hora_h').val("");
       $('#costo').val("");
       $('#nextfecha').val("");
       $('#repuesto_asoc').hide();
       $('#repuestoPC').val("");
       $('#motivo').val("");
       mostrarPrompt("Ya concluido", "numeroIPrompt", "red");
     }
     else if(datos[15]=='no concluido' && datos[0]==id && datos[8]=="interno"){
      $('#rev_maquina').val(datos[1]);
      $('#fechapropuesta').val(datos[16]);
      $('#responsable').val(datos[2]);
      $('#maquina_id').val(datos[12]);
      $('#observaciones').val(datos[5]);
      $('#fecha').val(datos[3]);
      $('#hora_f').val(datos[4]);
      $('#hora_a').val(datos[7]);
      $('#hora_h').val(datos[9]);
      $('#costo').val(datos[11]);
      $('#nextfecha').val(datos[17]);
      $('#motivo').val(datos[18]);
      $('#validaNI').val("1");
      $.ajax({
        type:"POST",
        url:"buscar_repuestos.php",
        data:'id='+datos[0]+'&tipo='+'correctivo',
        success: function (valores2){
         var datos2=eval(valores2);
         $('#repuestoPB').html(datos2[0]);   
                   //  $('#NB').val("NB-"+datos2[1]);


                 }
               });
      $('#repuesto_asoc').show();

      buscaridmantI();
      document.getElementById("service_interno").checked=true;
      mostrarPrompt("Continuando el mantenimiento", "numeroIPrompt", "green");
    }
    else if (datos[0]==id && datos[8]=="interno"){
      $('#rev_maquina').val(datos[1]);
      $('#fechapropuesta').val(datos[16]);
      $('#responsable').val(datos[2]);
      $('#maquina_id').val(datos[12]);
      $('#motivo').val(datos[18]);
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#hora_f').val("");
      $('#hora_a').val("");
      $('#hora_h').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#validaNI').val("1");
      $('#repuesto_asoc').hide();
      $('#repuestoPC').val("");
      document.getElementById("service_interno").checked=true;
      buscaridmantI();
      mostrarPrompt("Valido", "numeroIPrompt", "green");
    }
    else if(datos[15]=='no concluido' && datos[0]==id && datos[8]=="externo"){
      $('#rev_maquina2').val(datos[1]);
      $('#fechapropuesta2').val(datos[16]);
      $('#maquina_id2').val(datos[12]);
      $('#responsable2').val(datos[2]);
      $('#observaciones2').val(datos[5]);
      $('#fecha2').val(datos[3]);
      $('#hora_f2').val(datos[4]);
      $('#hora_a2').val(datos[7]);
      $('#hora_h2').val(datos[9]);
      $('#costo2').val(datos[11]);
      $('#nextfecha2').val(datos[17]);
      $('#provedor').val(datos[10]);
      $('#motivo2').val(datos[18]);
      $('#validaNE').val("1");
      $('#validaNI').val("0");
      $('#numero_mantE').val(id);
      $('#numero_mantI').val("");
      $('#rev_maquina').val("");
      $('#fechapropuesta').val("");
      $('#responsable').val("");
      $('#maquina_id').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#hora_f').val("");
      $('#hora_a').val("");
      $('#hora_h').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#motivo').val("");
      $('#externo').show();
      $('#interno').hide();
      $.ajax({
        type:"POST",
        url:"buscar_repuestos.php",
        data:'id='+id+'&tipo='+'correctivo',
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
      mostrarPrompt("Continuando el mantenimiento externo", "numeroEPrompt", "green");
    }
    else if(datos[8]=="externo")
    {
      $('#numero_mantE').val(id);
      $('#numero_mantI').val("");
      $('#externo').show();
      $('#interno').hide();
      $('#validaNE').val("1");
      $('#validaNI').val("0");
      $('#rev_maquina2').val(datos[1]);
      $('#fechapropuesta2').val(datos[16]);
      $('#maquina_id2').val(datos[12]);
      $('#responsable2').val(datos[2]);
      $('#motivo2').val(datos[18]);
      $('#rev_maquina').val("");
      $('#fechapropuesta').val("");
      $('#responsable').val("");
      $('#observaciones').val("");
      $('#fecha').val("");
      $('#hora_f').val("");
      $('#hora_a').val("");
      $('#hora_h').val("");
      $('#costo').val("");
      $('#nextfecha').val("");
      $('#provedor').val(datos[10]);
      $('#repuesto_asoc').hide();
      $('#repuesto_asoc2').hide();
      $('#repuestoPC').val("");
      $('#motivo').val("");
      buscaridmantE();
      document.getElementById("service_externo").checked=true;
      mostrarPrompt("Se cambio el registro a externo", "numeroEPrompt", "green");


    }
    else if (user==""){
     $('#validaNI').val("0");
     $('#rev_maquina').val("");
     $('#fechapropuesta').val("");
     $('#responsable').val("");
     $('#maquina_id').val("");
     $('#observaciones').val("");
     $('#fecha').val("");
     $('#hora_f').val("");
     $('#hora_a').val("");
     $('#hora_h').val("");
     $('#costo').val("");
     $('#nextfecha').val("");
     $('#repuesto_asoc').hide();
     $('#repuestoPC').val("");
     $('#motivo').val("");
     mostrarPrompt("Campo Requerido", "numeroIPrompt", "red");
     return false;
   }
   else if(user.length == 0){
     $('#validaNI').val("0");
     $('#rev_maquina').val("");
     $('#fechapropuesta').val("");
     $('#responsable').val("");
     $('#maquina_id').val("");
     $('#observaciones').val("");
     $('#motivo').val("");
     $('#fecha').val("");
     $('#hora_f').val("");
     $('#hora_a').val("");
     $('#hora_h').val("");
     $('#costo').val("");
     $('#nextfecha').val("");
     $('#repuesto_asoc').hide();
     $('#repuestoPC').val("");
     mostrarPrompt("Campo Requerido", "numeroIPrompt", "red");
     return false;
   }

   else{
    $('#validaNI').val("0");
    $('#rev_maquina').val("");
    $('#fechapropuesta').val("");
    $('#responsable').val("");
    $('#maquina_id').val("");
    $('#observaciones').val("");
    $('#fecha').val("");
    $('#hora_f').val("");
    $('#hora_a').val("");
    $('#hora_h').val("");
    $('#costo').val("");
    $('#nextfecha').val("");
    $('#repuesto_asoc').hide();
    $('#repuestoPC').val("");
    $('#motivo').val("");
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
    url:"modifica_correctivo.php",
    data:'id='+id,
    success: function (valores){

     var datos=eval(valores);
     if (datos[15]=='concluido'){
      $('#validaNE').val("0");
      $('#rev_maquina2').val("");
      $('#fechapropuesta2').val("");
      $('#responsable2').val("");
      $('#provedor').val("");
      $('#maquina_id2').val("");
      $('#observaciones2').val("");
      $('#fecha2').val("");
      $('#hora_f2').val("");
      $('#hora_a2').val("");
      $('#hora_h2').val("");
      $('#costo2').val("");
      $('#nextfecha2').val("");
      $('#repuesto_asoc2').hide(); 
      $('#repuestoPC2').val("");
      $('#motivo2').val("");
      mostrarPrompt("Ya concluido", "numeroEPrompt", "red");
    }
    else if(datos[15]=='no concluido' && datos[0]==id && datos[8]=="externo"){
      $('#rev_maquina2').val(datos[1]);
      $('#fechapropuesta2').val(datos[16]);
      $('#maquina_id2').val(datos[12]);
      $('#responsable2').val(datos[2]);
      $('#observaciones2').val(datos[5]);
      $('#fecha2').val(datos[3]);
      $('#hora_f2').val(datos[4]);
      $('#hora_a2').val(datos[7]);
      $('#hora_h2').val(datos[9]);
      $('#costo2').val(datos[11]);
      $('#nextfecha2').val(datos[17]);
      $('#motivo2').val(datos[18]);
      $('#provedor').val(datos[10]);
      $('#validaNE').val("1");
      $('#validaNI').val("0");
      $('#numero_mantE').val(id);

      $('#externo').show();
      $('#interno').hide();

      $.ajax({
        type:"POST",
        url:"buscar_repuestos.php",
        data:'id='+id+'&tipo='+'correctivo',
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
      mostrarPrompt("Continuando el mantenimiento", "numeroEPrompt", "green");
    }
    else if (datos[0]==id && datos[8]=="externo"){
      $('#validaNE').val("0");
      $('#rev_maquina2').val(datos[1]);
      $('#fechapropuesta2').val(datos[16]);
      $('#maquina_id2').val(datos[12]);
      $('#responsable2').val(datos[2]);
      $('#motivo2').val(datos[18]);
      $('#provedor').val(datos[10]);
      $('#validaNE').val("1");
      $('#repuesto_asoc2').hide(); 

      buscaridmantE();
      document.getElementById("service_externo").checked=true;
      mostrarPrompt("Valido", "numeroEPrompt", "green");
    }
    else if(datos[15]=='no concluido' && datos[0]==id && datos[8]=="interno"){
      $('#rev_maquina').val(datos[1]);
      $('#fechapropuesta').val(datos[16]);
      $('#responsable').val(datos[2]);
      $('#maquina_id').val(datos[12]);
      $('#observaciones').val(datos[5]);
      $('#fecha').val(datos[3]);
      $('#hora_f').val(datos[4]);
      $('#hora_a').val(datos[7]);
      $('#hora_h').val(datos[9]);
      $('#costo').val(datos[11]);
      $('#nextfecha').val(datos[17]);
      $('#motivo').val(datos[18]);
      $('#validaNI').val("1");
      $('#numero_mantI').val(id);
      $('#numero_mantE').val("");
      $('#interno').show();
      $('#externo').hide();
      $('#validaNI').val("1");
      $('#validaNE').val("0");
      $('#rev_maquina2').val("");
      $('#fechapropuesta2').val("");
      $('#responsable2').val("");
      $('#provedor').val("");
      $('#observaciones2').val("");
      $('#fecha2').val("");
      $('#hora_f2').val("");
      $('#hora_a2').val("");
      $('#hora_h2').val("");
      $('#costo2').val("");
      $('#motivo2').val("");
      $('#nextfecha2').val("");
      $.ajax({
        type:"POST",
        url:"buscar_repuestos.php",
        data:'id='+datos[0]+'&tipo='+'correctivo',
        success: function (valores2){
         var datos2=eval(valores2);
         $('#repuestoPB').html(datos2[0]);   
                   //  $('#NB').val("NB-"+datos2[1]);


                 }
               });
      $('#repuesto_asoc').show();
      $('#repuesto_asoc2').hide();   
      $('#repuestoPC2').val("");  
      buscaridmantI();
      document.getElementById("service_interno").checked=true;
      mostrarPrompt("Continuando el mantenimiento interno", "numeroIPrompt", "green");
    }
    else if(datos[8]=="interno")
    {
      $('#numero_mantI').val(id);
      $('#numero_mantE').val("");
      $('#interno').show();
      $('#externo').hide();
      $('#validaNI').val("1");
      $('#validaNE').val("0");
      $('#rev_maquina').val(datos[1]);
      $('#fechapropuesta').val(datos[16]);
      $('#maquina_id').val(datos[12]);
      $('#responsable').val(datos[2]);
      $('#motivo').val(datos[18]);
      $('#rev_maquina2').val("");
      $('#fechapropuesta2').val("");
      $('#responsable2').val("");
      $('#provedor').val("");
      $('#repuesto_asoc').hide();
      $('#repuesto_asoc2').hide(); 
      $('#repuestoPC2').val("");
      $('#motivo2').val("");
      buscaridmantI();
      document.getElementById("service_interno").checked=true;
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
      $('#observaciones2').val("");
      $('#fecha2').val("");
      $('#hora_f2').val("");
      $('#hora_a2').val("");
      $('#hora_h2').val("");
      $('#costo2').val("");
      $('#nextfecha2').val("");
      $('#repuesto_asoc2').hide(); 
      $('#repuestoPC2').val("");
      $('#motivo2').val("");
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
      $('#observaciones2').val("");
      $('#fecha2').val("");
      $('#hora_f2').val("");
      $('#hora_a2').val("");
      $('#hora_h2').val("");
      $('#costo2').val("");
      $('#nextfecha2').val("");
      $('#repuesto_asoc2').hide(); 
      $('#repuestoPC2').val("");
      $('#motivo2').val("");
      return false;
    }

    else{
      $('#validaNE').val("0");
      $('#rev_maquina2').val("");
      $('#fechapropuesta2').val("");
      $('#responsable2').val("");
      $('#provedor').val("");
      $('#maquina_id2').val("");
      $('#observaciones2').val("");
      $('#fecha2').val("");
      $('#hora_f2').val("");
      $('#hora_a2').val("");
      $('#hora_h2').val("");
      $('#costo2').val("");
      $('#nextfecha2').val("");
      $('#repuesto_asoc2').hide(); 
      $('#repuestoPC2').val
      $('#motivo2').val("");
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
  var fecha=document.getElementById('nextfecha').value;

  var fecha2=document.getElementById('nextfecha').value;
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




        if (fecha2==""){
         mostrarPrompt("Campo Requerido", "fechaxPrompt", "red");
         return false;
       }
       else if (!fecha2.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
       {
        mostrarPrompt("Invalido", "fechaxPrompt", "red");
        return false;
      }

      else if(primera<segunda){
       mostrarPrompt("fecha menor a la fecha solicitada", "fechaxPrompt", "red");

       return false;
     }

     else if(primera>tercera){
       mostrarPrompt("fecha mayor al dia de hoy", "fechaxPrompt", "red");

       return false;
     }

     else{
       mostrarPrompt("Valido", "fechaxPrompt", "green");

       return true;

     }


   }


   function valida_fechaEj2(){

     var split_fecha;
     var fecha=document.getElementById('nextfecha2').value;
     var fecha2=document.getElementById('nextfecha2').value;
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




        if (fecha2==""){
         mostrarPrompt("Campo Requerido", "fecha2xPrompt", "red");
         return false;
       }
       else if (!fecha2.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
       {
        mostrarPrompt("Invalido", "fecha2xPrompt", "red");
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

   function busca_cantidadP(){
     id=$('#repuestoPB').val();
    $.ajax({
      type:"POST",
      url:"buscar_cantidad.php",
      data:'id='+id+'&tipo='+'correctivo',
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
      data:'id='+id+'&tipo='+'correctivo',
      success: function (valores2){
            // var datos2=eval(valores2);
           //  $('#NB').val("NB-"+datos2[1]);
            $('#repuestoPC2').val(valores2);   

      }
    });
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
  if( !validaNI() || !valida_fechaEj()  || !valida_fecha() || !validarFalla()  || !validarArraque() || !validarHombre() || !validarCosto() || !validarObservaciones() || !validaridrI() || !validar_utilizadaIR1() ){
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
  if( !validaNE() || !valida_fechaEj2() || !valida_fecha2() || !validarFalla2() || !validarArranque2() || !validarHombre2() || !validarCosto2() || !validarObservaciones2() || !validaridrE() || !validar_utilizadaER1()){
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