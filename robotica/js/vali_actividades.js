
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

    function letra_num(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 1234567890áéíóúüabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚÜABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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

    function letra_num_car(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " .-,()/1234567890áéíóúüabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚÜABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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

// REGISTRO

function validarCI()
{
    var user = document.getElementById("ci_planif").value;
    var nac = document.getElementById("nacionalidad_planif").value;

    var ci=nac+user;

  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_usuario", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "C.I_usuario", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,9}$/)){
        mostrarPrompt("Invalido", "C.I_usuario", "red");
        return false;
      }

    $.ajax({
      type:"POST",
      url:"veri_ci_planif.php",
      data:"ci="+ci,
      success: function (data){
        
        $('#validar_ci_usu_ajax').val(data);

        var valores = document.getElementById("validar_ci_usu_ajax").value;

        if (valores==0)
        {
          mostrarPrompt("No Existe", "C.I_usuario", "red");
        }
        if (valores==1)
        {
          mostrarPrompt("Existe", "C.I_usuario", "green");
        }

      }
    });

    var valor = document.getElementById("validar_ci_usu_ajax").value;

    if (valor==0)
    {
      return false;
    }
    if (valor==1)
    {
      return true;
    }
}

function validarNAC()
{
  var nac = document.getElementById("nacionalidad_planif").selectedIndex;


  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_usuario", "red");
      return false;
    }
  else
  {
      mostrarPrompt("Ingrese la cedula", "C.I_usuario", "red");
      return true;
  }
}

function validarACTIVIDAD()
{
  var actividad = document.getElementById('nom_act').value;
  var user = document.getElementById("ci_planif").value;    
  var nac = document.getElementById("nacionalidad_planif").value;

  var ci=nac+user;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "actividad", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "actividad", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-z áéíóúüñÁÉÍÓÚÜÑ .,-\/()]+$/)){
        mostrarPrompt("Invalido", "actividad", "red");
        return false;     
      }


    $.ajax({
      type:"POST",
      url:"veri_actividad.php",
      data:"actividad="+actividad+"&ci="+ci,
      success: function(res){

        $('#validar_actividad_ajax').val(res);

        var result = document.getElementById('validar_actividad_ajax').value;

        if (result==1)
          {
            mostrarPrompt("Esta persona ya posee esta actividad", "actividad", "red");
          }
        if (result==0)
          {
            mostrarPrompt("Valido", "actividad", "green");
          }   
      }
    });

    var resul = document.getElementById('validar_actividad_ajax').value;

    if (resul==1)
    {
      return false;
    }
    if (resul==0)
    {
      return true;
    }
}

function validarFECHA()
{
    var nombres = document.getElementById("fecha_act").value;

  if (nombres.length==0)
    {
      mostrarPrompt("Campo Requerido", "fecha_actividad", "red");
          return false;
    }
  if (!nombres.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fecha_actividad", "red");
      return false;
    }

    var hoy = new Date();
    var dia = hoy.getDate();
    var mes = hoy.getMonth()+1;
    var ano = hoy.getFullYear();

    var nom=nombres.split("/");
    var dd=nom[0];
    var mm=nom[1];
    var aa=nom[2];

    if ((mm<mes) || (mm==mes && dd<=dia) || (aa<ano))
    {
      mostrarPrompt("La fecha de la actividad debe ser mayor a la actual", "fecha_actividad", "red");
      return false;
    }

    mostrarPrompt("Valido", "fecha_actividad", "green");
    return true;
}

function validarR_PLANIF()
{
  if(!validarCI() || !validarNAC() || !validarACTIVIDAD() || !validarFECHA())
    {
        jsMostrar("salidaR_PLANIF");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_PLANIF", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_PLANIF");
        }, 2000);
        
        return false;
    } 
}

// FIN DE REGISTRO

// MODIFICACION

function validarCI_M()
{
    var user = document.getElementById("ci_planif_M").value;    
    var nac = document.getElementById("nacionalidad_planif_M").value;

    var ci=nac+user;

  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_usuarioM", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "C.I_usuarioM", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,9}$/)){
        mostrarPrompt("Invalido", "C.I_usuarioM", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_ci_planif.php",
      data:"ci="+ci,
      success: function (data){
        
        $('#validar_ci_usu_ajaxM').val(data);

        //var valores = document.getElementById("validar_ci_usu_ajaxM").value;

        if (data==1)
        {
          mostrarPrompt("Existe", "C.I_usuarioM", "green");
        }
        if (data==0)
        {
          mostrarPrompt("No Existe", "C.I_usuarioM", "red");
        }

      }

    });

    var valor = document.getElementById("validar_ci_usu_ajaxM").value;

    if (valor==1)
    {
      return true;
    }
    if (valor==0)
    {
      return false;
    }
}

function validarNAC_M()
{
  var nac = document.getElementById("nacionalidad_planif_M").selectedIndex;


  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_usuarioM", "red");
      return false;
    }
  else
  {
      mostrarPrompt("Ingrese la cedula", "C.I_usuarioM", "red");
      return true;
  }
}

function validarACTIVIDAD_M()
{
  var actividad = document.getElementById('nom_act_M').value;
  var user = document.getElementById("ci_planif_M").value;    
  var nac = document.getElementById("nacionalidad_planif_M").value;
  var id = document.getElementById("id").value;

  var ci=nac+user;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "actividadM", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "actividadM", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-z áéíóúüñÁÉÍÓÚÜÑ .,-\/()]+$/)){
        mostrarPrompt("Invalido", "actividadM", "red");
        return false;     
      }


    $.ajax({
      type:"POST",
      url:"veri_actividad.php",
      data:"actividad="+actividad+"&ci="+ci+"&id="+id,
      success: function(res){

        $('#validar_actividad_ajaxM').val(res);

        var result = document.getElementById('validar_actividad_ajaxM').value;

        if (result==1)
          {
            mostrarPrompt("Esta persona ya posee esta actividad", "actividadM", "red");
          }
        if (result==0)
          {
            mostrarPrompt("Valido", "actividadM", "green");
          }   
      }
    });

    var resul = document.getElementById('validar_actividad_ajaxM').value;

    if (resul==1)
    {
      return false;
    }
    if (resul==0)
    {
      return true;
    }
}

function validarFECHA_M()
{
  var nombres = document.getElementById("fecha_act_M").value;

  if (nombres.length==0)
    {
      mostrarPrompt("Campo Requerido", "fecha_actividadM", "red");
          return false;
    }
  if (!nombres.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
    {
      mostrarPrompt("Invalido", "fecha_actividadM", "red");
      return false;
    }

    var hoy = new Date();
    var dia = hoy.getDate();
    var mes = hoy.getMonth()+1;
    var ano = hoy.getFullYear();

    var nom=nombres.split("/");
    var dd=nom[0];
    var mm=nom[1];
    var aa=nom[2];

    if ((mm<mes) || (mm==mes && dd<=dia) || (aa<ano))
    {
      mostrarPrompt("La fecha de la actividad debe ser mayor a la actual", "fecha_actividadM", "red");
      return false;
    }

    mostrarPrompt("Valido", "fecha_actividadM", "green");
    return true;
}

function validarM_PLANIF()
{
  if( !validarNAC_M() || !validarCI_M() || !validarACTIVIDAD_M() || !validarFECHA_M())
    {
        jsMostrar("salidaM_PLANIF");
        
        mostrarPrompt("El formulario debe estar completo", "salidaM_PLANIF", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaM_PLANIF");
        }, 2000);
        
        return false;
    } 
}

// FIN DE MODIFICACION

// REGISTRO DIARIO

function validarREGISTRO()
{
  var actividad = document.getElementById('observaciones').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "obs", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "obs", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ\/.,()]+$/)){
        mostrarPrompt("Invalido", "obs", "red");
        return false;     
      }
    
    mostrarPrompt("Valido", "obs", "green");
    return true;
}

function validarR_REGISTRO()
{
  if(!validarREGISTRO())
    {
        jsMostrar("salidaR_DIARIO");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_DIARIO", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_DIARIO");
        }, 2000);
        
        return false;
    } 
}

// FIN REGISTRO DIARIO

// MODIFICAR DIARIO

function validarREGISTRO_M()
{
  var actividad = document.getElementById('observaciones_M').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "obsM", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "obsM", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ\/.,()]+$/)){
        mostrarPrompt("Invalido", "obsM", "red");
        return false;     
      }
    
    mostrarPrompt("Valido", "obsM", "green");
    return true;
}

function validarM_REGISTRO()
{
  if(!validarREGISTRO_M())
    {
        jsMostrar("salidaM_DIARIO");
        
        mostrarPrompt("El formulario debe estar completo", "salidaM_DIARIO", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaM_DIARIO");
        }, 2000);
        
        return false;
    } 
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