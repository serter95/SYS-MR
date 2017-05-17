

    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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

    function letra_num(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 1234567890áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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
// REGISTRO_TIPO_USUARIO
  
  function validarNOM_TIPO_USUARIO()
  {
    var nom = document.getElementById("nombre_tipo").value;
    var nom_tipo = document.getElementById('validar_nom_tipo_usu').value;

    //alert("nombre="+nom);

    if (nom.length==0)
    {
      mostrarPrompt("Campo Requerido", "nombre_tipo_usu", "red");
      return false;
    }
    if (nom.match(/^\s/))
    {
      mostrarPrompt("Invalido", "nombre_tipo_usu", "red");
      return false;
    }

    $.ajax({
      type:"POST",
      url:"nom_tipo_usu.php",
      data:"nom="+nom,
      success: function (data){
        
        $('#validar_nom_tipo_usu').val(data);

        var nombre = document.getElementById('validar_nom_tipo_usu').value;

        if (nombre==1)
        {
          mostrarPrompt("Ya existe", "nombre_tipo_usu", "red");
        }
        if (nombre==0)
        {
          mostrarPrompt("Disponible", "nombre_tipo_usu", "green");
        }
      }
    });

    if (nom_tipo==1)
    {
      return false;
    }
    if (nom_tipo==0)
    {
      return true;
    }

      mostrarPrompt("Valido", "nombre_tipo_usu", "green");
      return true;
  }

function validarR_TIPO()
{
  if(!validarNOM_TIPO_USUARIO())
    {
        jsMostrar("salidaR_TIPO");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_TIPO", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_TIPO");
        }, 2000);
        
        return false;
    } 
}
// FIN REGISTRO_TIPO_USUARIO

// MODIFICAR_TIPO_USUARIO
  
  function validarNOM_TIPO_USUARIO_M()
  {
    var id = document.getElementById("id").value;
    var nom = document.getElementById("nombre_tipoM").value;
    var nom_tipo = document.getElementById('validar_nom_tipo_usuM').value;

    if (nom.length==0)
    {
      mostrarPrompt("Campo Requerido", "nombre_tipo_usuM", "red");
      return false;
    }
    if (nom.match(/^\s/))
    {
      mostrarPrompt("Invalido", "nombre_tipo_usuM", "red");
      return false;
    }

    $.ajax({
      type:"POST",
      url:"nom_tipo_usuarioM.php",
      data:"nom="+nom+"&id="+id,
      success: function (data){
        
        $('#validar_nom_tipo_usuM').val(data);

        var nombre = document.getElementById('validar_nom_tipo_usuM').value;

        if (nombre==1)
        {
          mostrarPrompt("Ya existe", "nombre_tipo_usuM", "red");
        }
        if (nombre==0)
        {
          mostrarPrompt("Disponible", "nombre_tipo_usuM", "green");
        }
      }
    });

    if (nom_tipo==1)
    {
      return false;
    }
    if (nom_tipo==0)
    {
      return true;
    }

      mostrarPrompt("Valido", "nombre_tipo_usuM", "green");
      return true;
  }

function validarM_TIPO()
{
  if(!validarNOM_TIPO_USUARIO_M())
    {
        jsMostrar("salidaM_TIPO");
        
        mostrarPrompt("El formulario debe estar completo", "salidaM_TIPO", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaM_TIPO");
        }, 2000);
        
        return false;
    } 
}
// FIN MODIFICAR_TIPO_USUARIO


// REGISTRO DE USUARIO

function validarCI_USU()
{
    var user = document.getElementById("ci_usu").value;    
    var nac = document.getElementById("nac_usu").value;

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
      url:"veri_ci_usu.php",
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
          mostrarPrompt("Ya esta registrada", "C.I_usuario", "red");
        }
        if (valores==2)
        {
          mostrarPrompt("Disponible", "C.I_usuario", "green");
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
      return false;
    }
    if (valor==2)
    {
      return true;
    }
}

function validarNAC_USU()
{
  var nac = document.getElementById("nac_usu").selectedIndex;


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

function validarNOM_USU()
{
  var nom_usu = document.getElementById("nombre_usuario").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_nom_usu", "red");
        return false;
      }
    if(nom_usu.length <= 4){
         mostrarPrompt("Invalido", "vali_nom_usu", "red");
        return false;
      }
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_nom_usu", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-ñÑ]+((-|_)[0-9A-Za-zñÑ]+)?$/)){
        mostrarPrompt("Invalido", "vali_nom_usu", "red");
        return false;     
      }

      $.ajax({
        type:"POST",
        url:"veri_nom_usu.php",
        data:"nom="+nom_usu,
        success: function (data){
          
          $('#validar_nom_usu_ajax').val(data);

          var valores = document.getElementById("validar_nom_usu_ajax").value;

          if (valores==1)
          {
            mostrarPrompt("Ya existe", "vali_nom_usu", "red");
          }
          if (valores==0)
          {
            mostrarPrompt("Disponible", "vali_nom_usu", "green");
          }

        }
      });

      var valor = document.getElementById("validar_nom_usu_ajax").value;

      if (valor==1)
      {
        return false;
      }
      if (valor==0)
      {
        return true;
      }
}

function validarCONTRASENA_USU()
{
  var nom_usu = document.getElementById("contrasena_usuario").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_contrasena", "red");
        return false;
      }
    if(nom_usu.length < 4){
         mostrarPrompt("Invalido", "vali_contrasena", "red");
        return false;
      }
    if(nom_usu.length >= 21){
         mostrarPrompt("Invalida", "vali_contrasena", "red");
        return false;
      }  
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_contrasena", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-z]+$/)){
        mostrarPrompt("Invalido", "vali_contrasena", "red");
        return false;     
      }

    mostrarPrompt("Valido", "vali_contrasena", "green");
    return true;
}

function validarCONTRASENA_USU2()
{
  var nom_usu = document.getElementById("contrasena_usuario").value;
  var nom_usu2 = document.getElementById("contrasena2_usuario").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_contrasena2", "red");
        return false;
      }
    if(nom_usu.length < 4){
         mostrarPrompt("Invalido", "vali_contrasena2", "red");
        return false;
      }
    if(nom_usu.length >= 21){
         mostrarPrompt("Invalida", "vali_contrasena2", "red");
        return false;
      }  
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_contrasena2", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-z]+$/)){
        mostrarPrompt("Invalido", "vali_contrasena2", "red");
        return false;     
      }
    if(nom_usu!=nom_usu2){
        mostrarPrompt("Contraseñas diferentes", "vali_contrasena2", "red");
        return false;     
      }

    mostrarPrompt("Valido", "vali_contrasena2", "green");
    return true;
}

function validarTIPO ()
{
  var tipo = document.getElementById("tipo").value;

    if (tipo==0)
    {
      mostrarPrompt("Seleccione el tipo de usuario", "vali_tipo", "red");
      return false;
    }
    if (tipo=='Otro...')
    {
      Otro();
    }

    mostrarPrompt("Valido", "vali_tipo", "green");
    return true;
}

function validarPREGUNTA()
{
  var actividad = document.getElementById('pregunta').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "vali_pregunta", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_pregunta", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ]+$/)){
        mostrarPrompt("Invalido", "vali_pregunta", "red");
        return false;     
    }

    mostrarPrompt("Valido", "vali_pregunta", "green");
    return true;     
}

function validarRESPUESTA()
{
  var actividad = document.getElementById('respuesta').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "vali_respuesta", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_respuesta", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ]+$/)){
        mostrarPrompt("Invalido", "vali_respuesta", "red");
        return false;     
    }

    mostrarPrompt("Valido", "vali_respuesta", "green");
    return true;     
}

function validarR_USU()
{
  if(!validarCI_USU() || !validarNAC_USU() || !validarNOM_USU() || !validarCONTRASENA_USU() 
    || !validarCONTRASENA_USU2() || !validarTIPO() || !validarPREGUNTA() || !validarRESPUESTA())
    {
        jsMostrar("salidaR_USU");
        
        mostrarPrompt("El formulario debe estar completo", "salidaR_USU", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaR_USU");
        }, 2000);
        
        return false;
    } 
}

// FIN REGISTRO DE USUARIO

// MODIFICACION DE USUARIO

function validarCI_USU_M()
{
    var user = document.getElementById("ci_usuM").value;    
    var nac = document.getElementById("nac_usuM").value;
    var id = document.getElementById("id").value;

    var ci=nac+user;

  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_usuario_M", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "C.I_usuario_M", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,9}$/)){
        mostrarPrompt("Invalido", "C.I_usuario_M", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_ci_usuM.php",
      data:"ci="+ci+"&id="+id,
      success: function (data){
        
        $('#validar_ci_usu_ajaxM').val(data);

        var valores = document.getElementById("validar_ci_usu_ajaxM").value;

        //alert(valores+"ajax");

        if (valores==0)
        {
          mostrarPrompt("Disponible", "C.I_usuario_M", "green");
        }
        if (valores==1)
        {
          mostrarPrompt("Ya esta registrada", "C.I_usuario_M", "red");
        }
        if (valores==2)
        {
          mostrarPrompt("No Existe", "C.I_usuario_M", "red");
        }

      }
    });

      var valor = document.getElementById("validar_ci_usu_ajaxM").value;

      //alert(valor);

      if (valor==0)
      {
        return true;
      }
      if (valor==1)
      {
        return false;
      }
      if (valor==2)
      {
        return false;
      }
}

function validarNAC_USU_M()
{
  var nac = document.getElementById("nac_usuM").selectedIndex;


  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_usuario_M", "red");
        return false;
  }
  {
      mostrarPrompt("Ingrese la cedula", "C.I_usuario_M", "red");
      return true;
  }

}

function validarNOM_USU_M()
{
  var nom_usu = document.getElementById("nombre_usuarioM").value;
  var id = document.getElementById("id").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_nom_usu_M", "red");
        return false;
      }
    if(nom_usu.length <= 4){
         mostrarPrompt("Invalido", "vali_nom_usu_M", "red");
        return false;
      }
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_nom_usu_M", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-ñÑ]+((-|_)[0-9A-Za-zñÑ]+)?$/)){
        mostrarPrompt("Invalido", "vali_nom_usu_M", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_nom_usu_M.php",
      data:"nom="+nom_usu+"&id="+id,
      success: function (data){
          
        $('#validar_nom_usu_ajaxM').val(data);
 
        var valores = document.getElementById("validar_nom_usu_ajaxM").value;

        if (valores==1)
        {
          mostrarPrompt("Ya existe", "vali_nom_usu_M", "red");
        }
        if (valores==0)
        {
          mostrarPrompt("Disponible", "vali_nom_usu_M", "green");
        }
        if (valores==2)
        {
          mostrarPrompt("Disponible", "vali_nom_usu_M", "green");
        }

      }
    });

      var valor = document.getElementById("validar_nom_usu_ajaxM").value;

      if (valor==1)
      {
        return false;
      }
      if (valor==0)
      {
        return true;
      }
      if (valor==2)
      {
        return true;
      }

}

function validarCONTRASENA_USU_M()
{
  var nom_usu = document.getElementById("contrasena_usuarioM").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_contrasena_M", "red");
        return false;
      }
    if(nom_usu.length < 4){
         mostrarPrompt("Invalido", "vali_contrasena_M", "red");
        return false;
      }
    if(nom_usu.length >= 21){
         mostrarPrompt("Invalida", "vali_contrasena_M", "red");
        return false;
      }  
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_contrasena_M", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-z]+$/)){
        mostrarPrompt("Invalido", "vali_contrasena_M", "red");
        return false;     
      }

    mostrarPrompt("Valido", "vali_contrasena_M", "green");
    return true;
}

function validarCONTRASENA_USU2_M()
{
  var nom_usu = document.getElementById("contrasena_usuarioM").value;
  var nom_usu2 = document.getElementById("contrasena2_usuarioM").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_contrasena2_M", "red");
        return false;
      }
    if(nom_usu.length < 4){
         mostrarPrompt("Invalido", "vali_contrasena2_M", "red");
        return false;
      }
    if(nom_usu.length >= 21){
         mostrarPrompt("Invalida", "vali_contrasena2_M", "red");
        return false;
      }  
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_contrasena2_M", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-z]+$/)){
        mostrarPrompt("Invalido", "vali_contrasena2_M", "red");
        return false;     
      }
    if(nom_usu!=nom_usu2){
        mostrarPrompt("Contraseñas diferentes", "vali_contrasena2_M", "red");
        return false;     
      }

    mostrarPrompt("Valido", "vali_contrasena2_M", "green");
    return true;
}

function validarTIPO_M ()
{
  var tipo = document.getElementById("tipoM").value;

    if (tipo==0)
    {
      mostrarPrompt("Seleccione el tipo de usuario", "vali_tipoM", "red");
      return false;
    }
    if (tipo=='Otro...')
    {
      Otro();
    }

    mostrarPrompt("Valido", "vali_tipoM", "green");
    return true;
}

function validarPREGUNTA_M()
{
  var actividad = document.getElementById('preguntaM').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "vali_preguntaM", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_preguntaM", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ]+$/)){
        mostrarPrompt("Invalido", "vali_pregunta", "red");
        return false;     
    }

    mostrarPrompt("Valido", "vali_preguntaM", "green");
    return true;     
}

function validarRESPUESTA_M()
{
  var actividad = document.getElementById('respuestaM').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "vali_respuestaM", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_respuestaM", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ]+$/)){
        mostrarPrompt("Invalido", "vali_respuestaM", "red");
        return false;     
    }

    mostrarPrompt("Valido", "vali_respuestaM", "green");
    return true;     
}

function validarM_USU()
{
  if(!validarCI_USU_M() || !validarNAC_USU_M() || !validarNOM_USU_M() || !validarCONTRASENA_USU_M() 
    || !validarCONTRASENA_USU2_M() || !validarTIPO_M() || !validarPREGUNTA_M() || !validarRESPUESTA_M())
    {
        jsMostrar("salidaM_USU");
        
        mostrarPrompt("El formulario debe estar completo", "salidaM_USU", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaM_USU");
        }, 2000);
        
        return false;
    } 
}

// FIN MODIFICACION DE USUARIO

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