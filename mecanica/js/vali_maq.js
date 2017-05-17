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
function soloLetras2(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "abcdefghijklmnopqrstuvwxyz";
//       especiales = "8-37-39-46";
especiales=[''];
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

/*    function soloLetras(e){
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
    }*/
    function soloAlfa(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
       //especiales = "8-37-39-46";
       especiales=['8','46','9','45'];


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
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890/";
       //especiales = "8-37-39-46";
       especiales=['8','46','9','45'];


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


 function validarCodigo()
{
  var consulta;
  var consulta1;
  var consulta2;



//comprobamos si se pulsa una tecla



//comprobamos si se pulsa una tecla
$("#codigo").keyup(function(e){

 consulta1=$("#pre_codigo").val();
  consulta2=$("#codigo").val();
  
  consulta=consulta1 + consulta2;
//se realiza la busqueda
$("#resultado").delay().queue(function(n){

  

    $.ajax({
      type:"POST",
      url:"verificar.php",
      data: "b="+consulta,
      dataType: "html",
      //error: function(){
        //alert("error peticion ajax");
      //},
      success: function(data){
        $("#resultado").html(data);
        n();
      }
    });
});

});
    var user = document.getElementById("codigo").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "codePrompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{4}$/)){
        mostrarPrompt("Invalido", "codePrompt", "rgba(5,5,5,0.5)");
        return false;     
      }
       mostrarPrompt("Valido", "codePrompt", "green");
        return true;

}

 function validarCodigoTipoM()
{
  var consulta;
  //comprobamos si se pulsa una tecla

//comprobamos si se pulsa una tecla

 
  consulta= document.getElementById("codeT").value;
//se realiza la busqueda
  

    $.ajax({
      type:"POST",
      url:"buscar_tipo_maq.php",
      data: "code="+consulta,
           
      //error: function(){
        //alert("error peticion ajax");
      //},
      success: function(data){
        $("#vali_codeT").val(data);
       if (data==0){
                 mostrarPrompt("Ya registrado", "codeTPrompt", "red");

       } 
       if (data==1){
                 mostrarPrompt("Valido", "codeTPrompt", "green");

       }
        
      }
    });



    var user = document.getElementById("vali_codeT").value;
    
    if(user==0){
        return false;
      }
    if(user==1){
            return true;
    }

}


function validarCodigoEsmeril()
{
  var consulta;
  var consulta1;
  var consulta2;



//comprobamos si se pulsa una tecla


 


//comprobamos si se pulsa una tecla
$("#codigo").keyup(function(e){

 consulta1=$("#pre_codigo").val();
  consulta2=$("#codigo").val();
  
  consulta=consulta1 + consulta2;
//se realiza la busqueda
$("#resultado_es").delay().queue(function(n){

  

    $.ajax({
      type:"POST",
      url:"verificar.php",
      data: "b="+consulta,
      dataType: "html",
      //error: function(){
        //alert("error peticion ajax");
      //},
      success: function(data){
        $("#resultado_es").html(data);
        n();
      }
    });
});

});
    var user = document.getElementById("codigo").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "codePrompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{4}$/)){
        mostrarPrompt("Invalido", "codePrompt", "rgba(5,5,5,0.5)");
        return false;     
      }
       mostrarPrompt("Valido", "codePrompt", "green");
        return true;

}
function validarCodigoLimadora()
{
  var consulta;
  var consulta1;
  var consulta2;



//comprobamos si se pulsa una tecla


 


//comprobamos si se pulsa una tecla
$("#codigo").keyup(function(e){

 consulta1=$("#pre_codigo").val();
  consulta2=$("#codigo").val();
  
  consulta=consulta1 + consulta2;
//se realiza la busqueda
$("#resultado_li").delay().queue(function(n){

  

    $.ajax({
      type:"POST",
      url:"verificar.php",
      data: "b="+consulta,
      dataType: "html",
      //error: function(){
        //alert("error peticion ajax");
      //},
      success: function(data){
        $("#resultado_li").html(data);
        n();
      }
    });
});

});
    var user = document.getElementById("codigo").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "codePrompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{4}$/)){
        mostrarPrompt("Invalido", "codePrompt", "rgba(5,5,5,0.5)");
        return false;     
      }
       mostrarPrompt("Valido", "codePrompt", "green");
        return true;

}

function validarCodigoFresadora()
{
  var consulta;
  var consulta1;
  var consulta2;



//comprobamos si se pulsa una tecla


 


//comprobamos si se pulsa una tecla
$("#codigo").keyup(function(e){

 consulta1=$("#pre_codigo").val();
  consulta2=$("#codigo").val();
  
  consulta=consulta1 + consulta2;
//se realiza la busqueda
$("#resultado_fre").delay().queue(function(n){

  

    $.ajax({
      type:"POST",
      url:"verificar.php",
      data: "b="+consulta,
      dataType: "html",
      //error: function(){
        //alert("error peticion ajax");
      //},
      success: function(data){
        $("#resultado_fre").html(data);
        n();
      }
    });
});

});
    var user = document.getElementById("codigo").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "codePrompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{4}$/)){
        mostrarPrompt("Invalido", "codePrompt", "rgba(5,5,5,0.5)");
        return false;     
      }
       mostrarPrompt("Valido", "codePrompt", "green");
        return true;

}

function validarCodigoTaladro()
{
  var consulta;
  var consulta1;
  var consulta2;



//comprobamos si se pulsa una tecla


 


//comprobamos si se pulsa una tecla
$("#codigo").keyup(function(e){

 consulta1=$("#pre_codigo").val();
  consulta2=$("#codigo").val();
  
  consulta=consulta1 + consulta2;
//se realiza la busqueda
$("#resultado_ta").delay().queue(function(n){

  

    $.ajax({
      type:"POST",
      url:"verificar.php",
      data: "b="+consulta,
      dataType: "html",
      //error: function(){
        //alert("error peticion ajax");
      //},
      success: function(data){
        $("#resultado_ta").html(data);
        n();
      }
    });
});

});
    var user = document.getElementById("codigo").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "codePrompt", "red");
        return false;
      }
    if(!user.match(/^[0-9]{4}$/)){
        mostrarPrompt("Invalido", "codePrompt", "rgba(5,5,5,0.5)");
        return false;     
      }
       mostrarPrompt("Valido", "codePrompt", "green");
        return true;

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
$("#res").delay().queue(function(n){

  

   $.ajax({
      type:"POST",
      url:"verificar_nb.php",
      data:"nb="+consulta,
      success: function (data){
        
        $('#res').val(data);
        n();
      }

    });
});

 var valor = document.getElementById("res").value;
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
       mostrarPrompt("Disponible", "N/BPrompt", "green");
     
      return true;
    }
   

   
     

}

function validarM_N_B()
{
 var id= document.getElementById("m_id_nb").value;
 var user = document.getElementById("MNB").value;
var consulta1 = document.getElementById("pre_nbmod").value;
  var consulta2 = document.getElementById("MNB").value;

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

        if (valor==0)
        {
           mostrarPrompt("Ya registrado", "MN/BPrompt", "red");
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
 
      if (valor==0)
        {
          
          return false;
        }
       if (valor==1)
        {
       
          return true;
        }
   

      

}

$('#btn_error_incompleto').click(function(){
    $('#error_incompleto').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
    
  });
  });

function validarmodform(){
   if( !validarM_N_B() || !validarM_Modelo() || !validarM_Marca()){
        
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                });

        setTimeout(function(){
          $('#error_incompleto').modal('hide');
         $('#error_incompleto').on('hidden.bs.modal', function (e) {
    $('body').addClass('modal-open');
});
        },10000);*/
        
        jsMostrar("salidaM_MAQ");
        
        mostrarPrompt("El formulario debe estar completo", "salidaM_MAQ", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaM_MAQ");
        }, 2000);
        
        return false;
    } 
    return true;  
}

function validarMarca()
{
    var user = document.getElementById("marca").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "marcaPrompt", "red");
        return false;
      }
       if (user.match(/^\s/)){
        mostrarPrompt("Invalido, no se permite un espacio al principio del campo", "marcaPrompt", "red");
        return false;
    }
    if(!user.match(/^[ A-Za-záéíóúñÁÉÍÓÚÑ0-9-.-\/]{3,20}$/)){
        mostrarPrompt("Invalido", "marcaPrompt", "red");
        return false;     
      }
       mostrarPrompt("Valido", "marcaPrompt", "green");
        return true;
}

function validarM_Marca()
{
    var user = document.getElementById("Mmarca").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "MmarcaPrompt", "red");
        return false;
      }
       if (user.match(/^\s/)){
        mostrarPrompt("Invalido, no se permite un espacio al principio del campo", "MmarcaPrompt", "red");
        return false;
    }
    if(!user.match(/^[ A-Za-záéíóúñÁÉÍÓÚÑ0-9-.-\/]{3,20}$/)){
        mostrarPrompt("Invalido", "MmarcaPrompt", "red");
        return false;     
      }
       mostrarPrompt("Valido", "MmarcaPrompt", "green");
        return true;
}


function validarModelo()
{
    var user = document.getElementById("modelo").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "modeloPrompt", "red");
        return false;
      }
       if (user.match(/^\s/)){
        mostrarPrompt("Invalido, no se permite un espacio al principio del campo", "modeloPrompt", "red");
        return false;
    }
    if(!user.match(/^[ A-Za-záéíóúñÁÉÍÓÚÑ0-9-.-\/]{4,20}$/)){
        mostrarPrompt("Invalido", "modeloPrompt", "red");
        return false;     
      }
       mostrarPrompt("Valido", "modeloPrompt", "green");
        return true;
}

function validarM_Modelo()
{
    var user = document.getElementById("Mmodelo").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "m_modeloPrompt", "red");
        return false;
      }
       if (user.match(/^\s/)){
        mostrarPrompt("Invalido, no se permite un espacio al principio del campo", "m_modeloPrompt", "red");
        return false;
    }
    if(!user.match(/^[ A-Za-záéíóúñÁÉÍÓÚÑ0-9-.-\/]{4,20}$/)){
        mostrarPrompt("Invalido", "m_modeloPrompt", "red");
        return false;     
      }
       mostrarPrompt("Valido", "m_modeloPrompt", "green");
        return true;
}



function control(f){
  var ext=['jpg','jpeg','png'];
  var v=f.value.split('.').pop().toLowerCase();
    for(var i=0,n; n=ext[i];i++){
      if(n.toLowerCase()==v)
        return
    }
  var t=f.cloneNode(true);
  t.value='';
  f.parentNode.replaceChild(t,f);
  //alert('extension no valida');
  $('#error_imagen').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
}





function validarUser()
{
    var user = document.getElementById("user").value;
    
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "userPrompt", "red");
        return false;
      }
    if(!user.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ0-9]{5,10}$/)){
        mostrarPrompt("Invalido", "userPrompt", "red");
        return false;     
      }
       mostrarPrompt("Valido", "userPrompt", "green");
        return true;
}
function validarPass()
{
    var password= document.getElementById("password").value;
   
    
    if(password.length == 0){
         mostrarPrompt("Campo Requerido", "passPrompt", "red");
         
        return false;
     
}   
  if(!password.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ0-9]{6,10}$/)){
        mostrarPrompt("", "passPrompt", "red");
        return false;     
      }

      mostrarPrompt("Valido", "passPrompt", "green");
     
        return true;  
          
}

function validarPass2(){
   var pass_c=document.getElementById("password_c").value;
   var pass = document.getElementById("password").value;
   if (pass_c.length == 0) {
         mostrarPrompt("Campo Requerido", "pass2Prompt", "red");
       return false;
} 
  if(!pass_c.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ0-9]{6,10}$/)){
       mostrarPrompt("", "pass2Prompt", "red");
        return false;     
      }
  if (pass!=pass_c){
mostrarPrompt("Las claves introducidas no son iguales", "pass2Prompt", "red");
return false;
}
    
mostrarPrompt("Valido", "pass2Prompt", "green");
return true;
}


function validarCedula()
{
  var cedula = document.getElementById("cedula_user").value;
  
  if(cedula.length == 0){
        mostrarPrompt("Campo Requerido", "cedulaPrompt", "red");
        return false;
  }
  if(!cedula.match(/^[0-9]{7,8}$/)){
     
        return false;     
      }
        mostrarPrompt("Valido", "cedulaPrompt", "green");
        return true;  
    
}

function validarNombre()
{
    var nombre = document.getElementById("nombre_user").value;
    
    if(nombre.length == 0){
       mostrarPrompt("Campo Requerido", "nombrePrompt", "red");
        return false;
      }
    if(!nombre.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ]+\s{1}[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ]+$/)){
     mostrarPrompt("Invalido", "nombrePrompt", "red");
        return false;     
      }
         mostrarPrompt("Valido", "nombrePrompt", "green");
        return true;
}

function validarApellido()
{
    var apellido = document.getElementById("apellido_user").value;
    
    if(apellido.length == 0){
       mostrarPrompt("Campo Requerido", "apeliidoPrompt", "red");
        return false;
      }
    if(!apellido.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ]+\s{1}[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ]+$/)){
     mostrarPrompt("Invalido", "apellidoPrompt", "red");
        return false;     
      }
         mostrarPrompt("Valido", "apellidoPrompt", "green");
        return true;
}

function validarDireccion()
{
  var coment = document.getElementById("direccion").value;
  var requerido = 125;
  var resta = requerido - coment.length;
  
  if(resta > 0){
      mostrarPrompt(resta + " Restantes", "direccionPrompt", "blue");
      return false; 
    }
      mostrarPrompt("", "direccionPrompt", "green");
      return true;
}

function validarForm()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validarN_B() || !validarMarca() || !validarModelo()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/

      jsMostrar("salidaR_MAQ");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_MAQ", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_MAQ");
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



function validar_clave(){
var caract_invalido=" ";
var caract_longitud= 6;
var pass = document.user_form.password.value;
var  pass_c = document.user_form.password_c.value;
if (pass == '' || pass_c == ''){
alert('Debes introducir tu clave en los dos campos');
return false;
}
if (document.user_form.password.value.length<caract_longitud){
alert('Tu clave debe constar de ' + caract_longitud + ' caracteres.');
return false;
}
if (document.user_form.password.value.indexOf(caract_invalido)>-1){
alert("Las claves no pueden contener espacios");
return false;
}
else { if (pass!=pass_c){
alert("Las claves introducidas no son iguales");
return false;
}
else{
alert("Contraseña correcta");
return true;
}
}

}

function ocultaCapa(){
  document.getElementById("man").style.display="none";

  //se define la varialble igual a nuestro div

}
function mostrarCapa(){
  document.getElementById("man").style.display="block";

    var apellido = document.getElementById("rev_maquina").value;
    
    if(apellido.length == 0){
       mostrarPrompt("Campo Requerido", "apellidoPrompt", "red");
        return false;
      }
    if(!apellido.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ]+\s{1}[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ]+$/)){
     mostrarPrompt("Invalido", "apellidoPrompt", "red");
        return false;     
      }
         mostrarPrompt("Valido", "apellidoPrompt", "green");
        return true;

   
}

/*function muestra_capa(elemento){
  if(elemento.value=="No Operativa"){
       document.getElementById("man").style.display="block";
   }
  else(elemento.value)
  {

    document.getElementById("man").style.display="none";

       
  }
}*/
function comprobar(){
var consulta;


//comprobamos si se pulsa una tecla
$("#codigo").keyup(function(e){

  consulta=$("#codigo").val();


//se realiza la busqueda
$("#resultado").delay().queue(function(n){

  

    $.ajax({
      type:"POST",
      url:"verificar.php",
      data: "b="+consulta,
      dataType: "html",
      //error: function(){
        //alert("error peticion ajax");
      //},
      success: function(data){
        $("#resultado").html(data);
        n();
      }
    });
});

});
}


//Tipo de Máquina 

function validarCodigoT(){
   var codigo = document.getElementById("codeT").value;
    
    if(codigo.length == 0){
       mostrarPrompt("Campo Requerido", "codeTPrompt", "red");
        return false;
      }
       if(!codigo.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ0-9]{1,4}$/)){
       mostrarPrompt("Invalido", "codeTPrompt", "red");
        return false;     
      }
         mostrarPrompt("Valido", "codeTPrompt", "green");
        return true;

}

function validarNombreT(){
   var nombre = document.getElementById("nombreT").value;
    
    if(nombre.length == 0){
       mostrarPrompt("Campo Requerido", "nombreTPrompt", "red");
        return false;
      }
       if(!nombre.match(/^[a-zA-ZáéíóúñüÁÉÍÓÚÑÜ ]{2,20}$/)){
       mostrarPrompt("Invalido", "nombreTPrompt", "red");
        return false;     
      }
        mostrarPrompt("Valido", "nombreTPrompt", "green");
        return true;

}

function validarForm_TM()
{
  //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
  if( !validarCodigoT() || !validarNombreT() || !validarCodigoTipoM()){
        /*$('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
        return false;*/

      jsMostrar("tipo_maqE");
        
        mostrarPrompt("El formulario debe estar completo", "tipo_maqE", "red");
        
        setTimeout(function()
        {
          jsOcultar("tipo_maqE");
        }, 2000);
        
        return false;
    } 
    return true;
}