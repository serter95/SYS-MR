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

var medida =document.getElementById("medida");
medida.readOnly=true; //añade el atributo solo lectura

  $('#tipo_medida').click(function(){
   medida.readOnly=false;
    
  });

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
         var valor2 = document.getElementById("validar_ci_ajax").value;

    if (valor2==1)
    {
      mostrarPrompt("Valido", "C.I_per", "green");

    }
    if (valor2==0)
    {
      mostrarPrompt("No existe", "C.I_per", "red");
 
    }
        $('#validar_ci_ajax').val(data);
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
         var valor2 = document.getElementById("validar_ci_ajax2").value;

    if (valor2==1)
    {
      mostrarPrompt("Valido", "C.I_per2", "green");

    }
    if (valor2==0)
    {
      mostrarPrompt("No existe", "C.I_per2", "red");
 
    }
        $('#validar_ci_ajax2').val(data);
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

        var fecha=document.getElementById('fecha').value;
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

        $.ajax({
            type:'POST',
            url:url,
             data:'fecha='+fecha+'&id='+id,
            success:function(valores){
                var datos=eval(valores);
                $("#resultado_fecha").val(datos[0]);
                   var valor = document.getElementById("resultado_fecha").value;
                  
                   
      if (valor==""){
         mostrarPrompt("Campo Requerido", "fechaPrompt", "red");
      }

      if (valor=="igual")
    {

       mostrarPrompt("Ya se realizo una revision esta fecha", "fechaPrompt", "red");
   
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

        var fecha=document.getElementById('fecha').value;
        var nextfecha=document.getElementById('nextfecha').value;
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
  if( !existeCodigo() || !validarCI() || !valida_fecha() || !valida_fecha_mayor() || !validar_aceite()){
        $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;
    } 
    return true;
}

 

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
  if( !valida_fechamod() ){
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