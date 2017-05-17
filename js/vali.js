    function soloLetras(e){
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

    function nombre_usu(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890-_abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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
    
    function contrasena(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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
  if(!validarUser() || !validarCedula() || !validarApellido() || !validarNombre()){
       alert("Debe completar el formulario");
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