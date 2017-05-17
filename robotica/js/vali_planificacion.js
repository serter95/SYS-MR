
    function solonum(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890";
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

    function solonum1(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = ":1234567890";
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

    function sololetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúüabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚÜABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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

    function letra_num_aula(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 123456789áéíóúüabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚÜABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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
       letras = "-1234567890abcdefghijklmnñopqrstuvwxyzÁÉÍÓÚÜABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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

function validarCODIGO()
{
  var user = document.getElementById("codigo").value;    

    if (user==0){
      mostrarPrompt("Campo Requerido", "Codigo", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "Codigo", "red");
        return false;
      }
    if(!user.match(/^[A-Z]{4}[0-9]{3}-[0-9]{1}$/)){
        mostrarPrompt("Invalido", "Codigo", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_codigo_planif.php",
      data:"codigo="+user,
      success: function (data){

        $('#validar_codigo_ajax').val(data)
        
        if (data==1)
        {
          mostrarPrompt("No Disponible", "Codigo", "red");
        }
        if (data==0)
        {
          mostrarPrompt("Disponible", "Codigo", "green");
        }

      }
    });

    var valor = document.getElementById("validar_codigo_ajax").value;

    if (valor==1)
    {
      return false;
    }
    if (valor==0)
    {
      return true;
    }
}

function validarNOMBRE()
{
  var user=document.getElementById('nombre').value;

  if (user==0){
      mostrarPrompt("Campo Requerido", "Nombre", "red");
      return false;
  }
  if(user.length == 0){
      mostrarPrompt("Campo Requerido", "Nombre", "red");
      return false;
  }
  if(user.match(/^\s/)){
      mostrarPrompt("Invalido", "Nombre", "red");
      return false;
  }

  mostrarPrompt("Valido", "Nombre", "green");
  return true;
}

function validarTRAYECTO()
{
  var user=document.getElementById('trayecto').value;

  if (user==0)
  {
    mostrarPrompt("Campo Requerido", "Trayecto", "red");
    return false;
  }
  else
  {
    mostrarPrompt("Valido", "Trayecto", "green");
    return true;
  }
}

function validarHORAS()
{
  var horas=document.getElementById('hora').value;

  if(horas==0)
  {
    mostrarPrompt("Campo Requerido", "Horas", "red");
    return false;
  }
  if(!horas.match(/^[0-9]{1,2}$/))
  {
    mostrarPrompt("Invalido", "Horas", "red");
    return false;
  }
  if (horas>8)
  {
    mostrarPrompt("Debe ser menor o igual a 8", "Horas", "red");
    return false;
  }
    mostrarPrompt("Valido", "Horas", "green");
    return true;
}

function validarMATERIAS()
{
  if (!validarCODIGO() || !validarNOMBRE() || !validarTRAYECTO() || !validarHORAS())
  {
    jsMostrar("salidaR_MATERIAS");
        
    mostrarPrompt("El formulario debe estar completo", "salidaR_MATERIAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaR_MATERIAS");
    }, 2000);
    
    return false;
  }
}


function validarCODIGO_M()
{
  var id=document.getElementById('id').value;
  var user = document.getElementById("codigo_M").value;    

    if (user==0){
      mostrarPrompt("Campo Requerido", "CodigoM", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodigoM", "red");
        return false;
      }
    if(!user.match(/^[A-Z]{4}[0-9]{3}-[0-9]{1}$/)){
        mostrarPrompt("Invalido", "CodigoM", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_codigo_planif.php",
      data:"codigo="+user+"&id="+id,
      success: function (data){

        $('#validar_codigo_ajax_M').val(data)
        
        if (data==1)
        {
          mostrarPrompt("No Disponible", "CodigoM", "red");
        }
        if (data==0)
        {
          mostrarPrompt("Disponible", "CodigoM", "green");
        }

      }
    });

    var valor = document.getElementById("validar_codigo_ajax_M").value;

    if (valor==1)
    {
      return false;
    }
    if (valor==0)
    {
      return true;
    }
}

function validarNOMBRE_M()
{
  var user=document.getElementById('nombre_M').value;

  if (user==0){
      mostrarPrompt("Campo Requerido", "NombreM", "red");
      return false;
  }
  if(user.length == 0){
      mostrarPrompt("Campo Requerido", "NombreM", "red");
      return false;
  }
  if(user.match(/^\s/)){
      mostrarPrompt("Invalido", "NombreM", "red");
      return false;
  }

  mostrarPrompt("Valido", "NombreM", "green");
  return true;
}

function validarTRAYECTO_M()
{
  var user=document.getElementById('trayecto_M').value;

  if (user==0)
  {
    mostrarPrompt("Campo Requerido", "TrayectoM", "red");
    return false;
  }
  else
  {
    mostrarPrompt("Valido", "TrayectoM", "green");
    return true;
  }
}

function validarHORAS_M()
{
  var horas=document.getElementById('horas_M').value;

  if(horas==0)
  {
    mostrarPrompt("Campo Requerido", "HorasM", "red");
    return false;
  }
  if(!horas.match(/^[0-9]{1,2}$/))
  {
    mostrarPrompt("Invalido", "HorasM", "red");
    return false;
  }
  if (horas>8)
  {
    mostrarPrompt("Debe ser menor o igual a 8", "HorasM", "red");
    return false;
  }
    mostrarPrompt("Valido", "HorasM", "green");
    return true;
}

function validarMATERIAS_M()
{
  if (!validarCODIGO_M() || !validarNOMBRE_M() || !validarTRAYECTO_M() || !validarHORAS_M())
  {
    jsMostrar("salidaM_MATERIAS");
        
    mostrarPrompt("El formulario debe estar completo", "salidaM_MATERIAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_MATERIAS");
    }, 2000);
    
    return false;
  }
}

function validarPNF()
{
  var pnf=document.getElementById('pnf').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Pnf", "red");
    return false;
  }
    verificarSeccion()
    mostrarPrompt("Valido", "Pnf", "green");
    return true;
}

function validarSEDE()
{
  var pnf=document.getElementById('sede').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Sede", "red");
    return false;
  }
    verificarSeccion()
    mostrarPrompt("Valido", "Sede", "green");
    return true;
}

function validarANIO()
{
  var pnf=document.getElementById('anio').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Anio", "red");
    return false;
  }
  if (!pnf.match(/^[0-9]{4}$/))
  {
    mostrarPrompt("Invalido", "Anio", "red");
    return false;
  }

  var fecha= new Date()
  var anio=fecha.getFullYear();

  if (pnf<anio)
  {
    mostrarPrompt("Debe ser mayor o igual al actual", "Anio", "red");
    return false;
  }
    verificarSeccion()
    mostrarPrompt("Valido", "Anio", "green");
    return true;
}

function validarTRAYECTO_S()
{
  var pnf=document.getElementById('trayecto_s').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Trayecto_s", "red");
    return false;
  }
    verificarSeccion()
    mostrarPrompt("Valido", "Trayecto_s", "green");
    return true;
}

function validarSECCION()
{
  var pnf=document.getElementById('seccion').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Seccion", "red");
    return false;
  }
  if (!pnf.match(/^[1-9]{1}$/))
  {
    mostrarPrompt("Invalido", "Seccion", "red");
    return false;
  }
    verificarSeccion()
    mostrarPrompt("Valido", "Seccion", "green");
    return true;
}

function verificarSeccion()
{
  var pnf=document.getElementById('pnf').value;
  var sede=document.getElementById('sede').value;
  var anio=document.getElementById('anio').value;
  var trayecto=document.getElementById('trayecto_s').value;
  var seccion=document.getElementById('seccion').value;
    
    $.ajax({
      type:"POST",
      url:"veri_seccion_planif.php",
      data:"pnf="+pnf+"&sede="+sede+"&anio="+anio+"&trayecto="+trayecto+"&seccion="+seccion,
      success: function (data){

        $('#validar_seccion_ajax').val(data);
        //alert(data);
      }
    });
}

function validarSECCIONES()
{
  if (!validarPNF() || !validarSEDE() || !validarANIO() || !validarTRAYECTO_S() || !validarSECCION())
  {
    jsMostrar("salidaR_SECCIONES");
        
    mostrarPrompt("El formulario debe estar completo", "salidaR_SECCIONES", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaR_SECCIONES");
    }, 2000);
    
    return false;
  }
  else
  {
    var valorSeccion=document.getElementById('validar_seccion_ajax').value;
    //alert(valorSeccion);

    if (valorSeccion==1)
    {
      jsMostrar("salidaR_SECCIONES");
      
      mostrarPrompt("La seccion ya existe", "salidaR_SECCIONES", "red");
      
      setTimeout(function()
      {
        jsOcultar("salidaR_SECCIONES");
      }, 2000);

      return false;
    }
  }
}

function validarPNF_M()
{
  var pnf=document.getElementById('pnf_M').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Pnf_M", "red");
    return false;
  }
    verificarSeccion_M()
    mostrarPrompt("Valido", "Pnf_M", "green");
    return true;
}

function validarSEDE_M()
{
  var pnf=document.getElementById('sede_M').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Sede_M", "red");
    return false;
  }
    verificarSeccion_M()
    mostrarPrompt("Valido", "Sede_M", "green");
    return true;
}

function validarANIO_M()
{
  var pnf=document.getElementById('anio_M').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Anio_M", "red");
    return false;
  }
  if (!pnf.match(/^[0-9]{4}$/))
  {
    mostrarPrompt("Invalido", "Anio_M", "red");
    return false;
  }

  var fecha= new Date()
  var anio=fecha.getFullYear();

  if (pnf<anio)
  {
    mostrarPrompt("Debe ser mayor o igual al actual", "Anio_M", "red");
    return false;
  }
    verificarSeccion_M()
    mostrarPrompt("Valido", "Anio_M", "green");
    return true;
}

function validarTRAYECTO_S_M()
{
  var pnf=document.getElementById('trayecto_s_M').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Trayecto_s_M", "red");
    return false;
  }
    verificarSeccion_M()
    mostrarPrompt("Valido", "Trayecto_s_M", "green");
    return true;
}

function validarSECCION_M()
{
  var pnf=document.getElementById('seccion_M').value;

  if (pnf==0)
  {
    mostrarPrompt("Campo Requerido", "Seccion_M", "red");
    return false;
  }
  if (!pnf.match(/^[1-9]{1}$/))
  {
    mostrarPrompt("Invalido", "Seccion_M", "red");
    return false;
  }
    verificarSeccion_M()
    mostrarPrompt("Valido", "Seccion_M", "green");
    return true;
}

function verificarSeccion_M(nuevo)
{
  var pnf=document.getElementById('pnf_M').value;
  var sede=document.getElementById('sede_M').value;
  var anio=document.getElementById('anio_M').value;
  var trayecto=document.getElementById('trayecto_s_M').value;
  var seccion=document.getElementById('seccion_M').value;
  var id=document.getElementById('id_seccion').value;
    
    $.ajax({
      type:"POST",
      url:"veri_seccion_planif.php",
      data:"pnf="+pnf+"&sede="+sede+"&anio="+anio+"&trayecto="+trayecto+"&seccion="+seccion+"&id="+id,
      success: function (data){

        $('#validar_seccion_ajax_M').val(data);
        //alert("ajax=>"+data);
        
        if (nuevo=='nuevo')
        {
          if (data!='')
          {
            //alert("data = a 1 ó a 2");
            validarSECCIONES_M()
          }
        }
      }
    });
}

function validarSECCIONES_M()
{
  var valorSeccion=document.getElementById('validar_seccion_ajax_M').value;
  //alert("La variable es ="+valorSeccion);

  if (!validarPNF_M() || !validarSEDE_M() || !validarANIO_M() || !validarTRAYECTO_S_M() || !validarSECCION_M())
  {
    jsMostrar("salidaM_SECCIONES");
        
    mostrarPrompt("El formulario debe estar completo", "salidaM_SECCIONES", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_SECCIONES");
    }, 2000);
    
    return false;
  }

  if (valorSeccion==1)
  {
    jsMostrar("salidaM_SECCIONES");
    
    mostrarPrompt("La seccion ya existe", "salidaM_SECCIONES", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_SECCIONES");
    }, 2000);

    return false;
  }
  if (valorSeccion==2)
  {
    return true;
  }

  verificarSeccion_M('nuevo');
}

function validarBLOQUE()
{
  var bloque=document.getElementById('bloque').value;

  if (bloque==0)
  {
    mostrarPrompt("Campo Requerido", "Bloque", "red");
    return false;
  }

  $.ajax({
      type:"POST",
      url:"veri_bloque_planif.php",
      data:"bloque="+bloque,
      success: function (data){

        $('#validar_bloque_ajax').val(data);
        
        if (data==1)
        {
          mostrarPrompt("No Disponible", "Bloque", "red");
        }
        if (data==0)
        {
          mostrarPrompt("Disponible", "Bloque", "green");
          bloqueCompleto();
        }
      }
    });

  var valor=document.getElementById('validar_bloque_ajax').value;

  if (valor==1)
  {
    return false;
  }
  if (valor==0)
  {
    bloqueCompleto();
    return true;
  }
}

function validarINICIO()
{
  var inicio=document.getElementById('inicio').value;
  var horario=document.getElementById('hora_entrada').value;

  if (inicio==0)
  {
    mostrarPrompt("Campo Requerido", "Inicio", "red");
    return false;
  }

  if (!inicio.match(/^[0-9]{1,2}:[0-9]{2}$/))
  {
    mostrarPrompt("Invalido", "Inicio", "red");
    return false;
  }

  var horas=inicio.split(":");

  if (horas[0]>12)
  {
    mostrarPrompt("La hora debe ser menor a 13", "Inicio", "red");
    return false;
  }
  if (horas[0]<=0)
  {
    mostrarPrompt("La hora debe ser mayor a 0", "Inicio", "red");
    return false;
  }
  if (horas[1]>59)
  {
    mostrarPrompt("Los segundos deben ser menor a 60", "Inicio", "red");
    return false;
  }
  if (horas[1]<0)
  {
    mostrarPrompt("Los segundos deben ser mayor o igual a 0", "Inicio", "red");
    return false;
  }

  validarFIN()
  mostrarPrompt("Valido", "Inicio", "green");
  return true;
}

function validarFIN()
{
  var inicio=document.getElementById('inicio').value;
  var hora_entrada=document.getElementById('hora_entrada').value;
  var fin=document.getElementById('fin').value;
  var hora_salida=document.getElementById('hora_salida').value;

  var inicio2=inicio.replace(":",".");
  var fin2=fin.replace(":",".");
  
  inicio2=parseFloat(inicio2);
  fin2=parseFloat(fin2);

  if (fin==0)
  {
    mostrarPrompt("Campo Requerido", "Fin", "red");
    return false;
  }

  if (!fin.match(/^[0-9]{1,2}:[0-9]{2}$/))
  {
    mostrarPrompt("Invalido", "Fin", "red");
    return false;
  }

  var horas=fin.split(":");

  if (horas[0]>12)
  {
    mostrarPrompt("La hora debe ser menor a 13", "Fin", "red");
    return false;
  }
  if (horas[0]<=0)
  {
    mostrarPrompt("La hora debe ser mayor a 0", "Fin", "red");
    return false;
  }
  if (horas[1]>59)
  {
    mostrarPrompt("Los segundos deben ser menor a 60", "Fin", "red");
    return false;
  }
  if (horas[1]<0)
  {
    mostrarPrompt("Los segundos deben ser mayor o igual a 0", "Fin", "red");
    return false;
  }

  if(hora_entrada=='Am' && hora_salida=='Am')
  {
    if(inicio2>=fin2)
    {
      mostrarPrompt("La hora Final debe ser mayor que la Inicial", "Fin", "red");
      return false;
    }
  }
  if(hora_entrada=='Pm' && hora_salida=='Pm')
  {
    if(inicio2>=fin2)
    {
      mostrarPrompt("La hora Final debe ser mayor que la Inicial", "Fin", "red");
      return false;
    }
  }
  if(hora_entrada=='Pm' && hora_salida=='Am')
  {
    mostrarPrompt("Si la Inicial es Pm la Final no Puede ser Am", "Fin", "red");
    return false;
  }

  bloqueCompleto()
  mostrarPrompt("Valido", "Fin", "green");
  return true;
}

function bloqueCompleto()
{
  var bloque=document.getElementById('bloque').value;
  var inicio=document.getElementById('inicio').value;
  var hora_entrada=document.getElementById('hora_entrada').value;
  var fin=document.getElementById('fin').value;
  var hora_salida=document.getElementById('hora_salida').value;

    $.ajax({
      type:"POST",
      url:"veri_inicioyfin_planif.php",
      data:"bloque="+bloque+"&inicio="+inicio+"&hora_entrada="+hora_entrada+"&fin="+fin+"&hora_salida="+hora_salida,
      success: function (data){

        $('#validar_completo_ajax').val(data);
        
        if (data==1)
        {
          jsMostrar("salidaR_HORAS");
          mostrarPrompt("Ya Existe", "salidaR_HORAS", "red");
        }
        if (data==2)
        {
          jsMostrar("salidaR_HORAS");
          mostrarPrompt("La Hora de inicio del Bloque que está registrando debe ser mayor a la Hora final del Bloque anterior", "salidaR_HORAS", "red");
        }
        if (data==3)
        {
          jsMostrar("salidaR_HORAS");
          mostrarPrompt("Si la Hora final del Bloque anterior es Pm No puede registrar el Bloque en Am", "salidaR_HORAS", "red");
        }
        if (data==4)
        {
          jsMostrar("salidaR_HORAS");
          mostrarPrompt("El Bloque anterior al seleccionado no existe. Registrelo", "salidaR_HORAS", "red");
        }
        if (data==0)
        {
          jsOcultar("salidaR_HORAS");
        }
      }
    });

    var valor=document.getElementById('validar_completo_ajax').value;

    if (valor>=1 && valor<=4)
    {
      return false;
    }
    if (valor==0)
    {
      return true;
    }
}

function validarBLOQUEDEHORAS()
{
  if (!validarBLOQUE() || !validarINICIO() || !validarFIN() || !bloqueCompleto())
  {
    jsMostrar("salidaR_HORAS");
        
    mostrarPrompt("El formulario debe estar completo", "salidaR_HORAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaR_HORAS");
    });
    
    return false;
  }
}

function validarBLOQUE_M()
{
  var id=document.getElementById('id_horas').value;
  var bloque=document.getElementById('bloque_M').value;

  if (bloque==0)
  {
    mostrarPrompt("Campo Requerido", "Bloque_M", "red");
    return false;
  }

  $.ajax({
      type:"POST",
      url:"veri_bloque_planif.php",
      data:"bloque="+bloque+"&id="+id,
      success: function (data){

        $('#validar_bloque_ajax_M').val(data);
        
        if (data==1)
        {
          mostrarPrompt("No Disponible", "Bloque_M", "red");
        }
        if (data==0)
        {
          mostrarPrompt("Disponible", "Bloque_M", "green");
          bloqueCompleto_M();
        }
      }
    });

  var valor=document.getElementById('validar_bloque_ajax_M').value;

  if (valor==1)
  {
    return false;
  }
  if (valor==0)
  {
    bloqueCompleto_M();
    return true;
  }
}

function validarINICIO_M()
{
  var inicio=document.getElementById('inicio_M').value;
  var horario=document.getElementById('hora_entrada_M').value;

  if (inicio==0)
  {
    mostrarPrompt("Campo Requerido", "Inicio_M", "red");
    return false;
  }

  if (!inicio.match(/^[0-9]{1,2}:[0-9]{2}$/))
  {
    mostrarPrompt("Invalido", "Inicio_M", "red");
    return false;
  }

  var horas=inicio.split(":");

  if (horas[0]>12)
  {
    mostrarPrompt("La hora debe ser menor a 13", "Inicio_M", "red");
    return false;
  }
  if (horas[0]<=0)
  {
    mostrarPrompt("La hora debe ser mayor a 0", "Inicio_M", "red");
    return false;
  }
  if (horas[1]>59)
  {
    mostrarPrompt("Los segundos deben ser menor a 60", "Inicio_M", "red");
    return false;
  }
  if (horas[1]<0)
  {
    mostrarPrompt("Los segundos deben ser mayor o igual a 0", "Inicio_M", "red");
    return false;
  }

  validarFIN_M();
  mostrarPrompt("Valido", "Inicio_M", "green");
  return true;
}

function validarFIN_M()
{
  var inicio=document.getElementById('inicio_M').value;
  var hora_entrada=document.getElementById('hora_entrada_M').value;
  var fin=document.getElementById('fin_M').value;
  var hora_salida=document.getElementById('hora_salida_M').value;

  var inicio2=inicio.replace(":",".");
  var fin2=fin.replace(":",".");
  
  inicio2=parseFloat(inicio2);
  fin2=parseFloat(fin2);

  if (fin==0)
  {
    mostrarPrompt("Campo Requerido", "Fin_M", "red");
    return false;
  }

  if (!fin.match(/^[0-9]{1,2}:[0-9]{2}$/))
  {
    mostrarPrompt("Invalido", "Fin_M", "red");
    return false;
  }

  var horas=fin.split(":");

  if (horas[0]>12)
  {
    mostrarPrompt("La hora debe ser menor a 13", "Fin_M", "red");
    return false;
  }
  if (horas[0]<=0)
  {
    mostrarPrompt("La hora debe ser mayor a 0", "Fin_M", "red");
    return false;
  }
  if (horas[1]>59)
  {
    mostrarPrompt("Los segundos deben ser menor a 60", "Fin_M", "red");
    return false;
  }
  if (horas[1]<0)
  {
    mostrarPrompt("Los segundos deben ser mayor o igual a 0", "Fin_M", "red");
    return false;
  }

  if(hora_entrada=='Am' && hora_salida=='Am')
  {
    if(inicio2>=fin2)
    {
      mostrarPrompt("La hora Final debe ser mayor que la Inicial", "Fin_M", "red");
      return false;
    }
  }
  if(hora_entrada=='Pm' && hora_salida=='Pm')
  {
    if(inicio2>=fin2)
    {
      mostrarPrompt("La hora Final debe ser mayor que la Inicial", "Fin_M", "red");
      return false;
    }
  }
  if(hora_entrada=='Pm' && hora_salida=='Am')
  {
    mostrarPrompt("Si la Inicial es Pm la Final no Puede ser Am", "Fin_M", "red");
    return false;
  }

  bloqueCompleto_M();
  mostrarPrompt("Valido", "Fin_M", "green");
  return true;
}

function bloqueCompleto_M(parametro)
{
  //alert(parametro);

  var id=document.getElementById('id_horas').value;
  var bloque=document.getElementById('bloque_M').value;
  var inicio=document.getElementById('inicio_M').value;
  var hora_entrada=document.getElementById('hora_entrada_M').value;
  var fin=document.getElementById('fin_M').value;
  var hora_salida=document.getElementById('hora_salida_M').value;

  //alert("id "+id+" bloque "+bloque+" inicio "+inicio+" hora_entrada "+hora_entrada+" fin "+fin+" hora_salida "+hora_salida);
    
    $.ajax({
      type:"POST",
      url:"veri_inicioyfin_planifM.php",
      data:"id_horas="+id+"&bloque="+bloque+"&inicio="+inicio+"&hora_entrada="+hora_entrada+"&fin="+fin+"&hora_salida="+hora_salida,
      success: function (data){

        var valor=document.getElementById('validar_completo_ajax_M').value;

        $('#validar_completo_ajax_M').val(data);
        //alert("ajax="+data);

        if (parametro=='devolver')
        {
          if (data!='')
          {
            //alert("valor en parametro vacio, repite");
            validarBLOQUEDEHORAS_M();
          }
        }
      }
    });
}

function validarBLOQUEDEHORAS_M()
{

  if (!validarBLOQUE_M() || !validarINICIO_M() || !validarFIN_M())
  {
    jsMostrar("salidaM_HORAS");
        
    mostrarPrompt("El formulario debe estar completo", "salidaM_HORAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_HORAS");
    }, 2000);
    
    return false;
  }

  var valores=document.getElementById('validar_completo_ajax_M').value;
  //alert("la variable es="+valores);

  if (valores==1)
  {
    jsMostrar("salidaM_HORAS");
    mostrarPrompt("Ya Existe", "salidaM_HORAS", "red");

    setTimeout(function()
    {
      jsOcultar("salidaM_HORAS");
    }, 2000);
    
    return false;
  }

  if (valores==2)
  {
    jsMostrar("salidaM_HORAS");
    mostrarPrompt("La Hora de inicio del Bloque que está registrando debe ser mayor a la Hora final del Bloque anterior", "salidaM_HORAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_HORAS");
    }, 2000);
    
    return false;
  }

  if (valores==3)
  {
    jsMostrar("salidaM_HORAS");
    mostrarPrompt("Si la Hora final del Bloque anterior es Pm No puede registrar el Bloque en Am", "salidaM_HORAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_HORAS");
    }, 2000);
    
    return false;
  }

  if (valores==4)
  {
    jsMostrar("salidaM_HORAS");
    mostrarPrompt("El Bloque anterior al seleccionado no existe. Registrelo", "salidaM_HORAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_HORAS");
    }, 2000);
    
    return false;
  }

  if (valores==5)
  {
    return true;
  }

  bloqueCompleto_M('devolver');
  
}

function validarPERIODO()
{
  document.getElementById('boton_submit').disabled=true;

  var periodo=document.getElementById('periodo').value;

  if (periodo==0)
  {
    mostrarPrompt("Campo Requerido", "Periodo", "red");
    return false;
  }
  else
  {
    validarCI();
    mostrarPrompt("Valido", "Periodo", "green");
    return true;
  }
}

function validarCI()
{
  document.getElementById('boton_submit').disabled=true;

  var nac=document.getElementById('nacionalidad').value;
  var user=document.getElementById('ci_disp').value;
  var periodo=document.getElementById('periodo').value;
  var nomApe=document.getElementById('nom_ape').value;

  var cargo=nomApe.split(' ');

  var ci=nac+user;

    if (periodo==0)
    {
      mostrarPrompt("Campo Requerido", "Periodo", "red");
      return false;
    }
    if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "Ci_disp", "red");
      return false;
    }
    if(user.length == 0){
        mostrarPrompt("Campo Requerido", "Ci_disp", "red");
        return false;
      }
    if (user==0)
    {
      mostrarPrompt("Invalido", "Ci_disp", "red");
      return false;
    }
    if(!user.match(/^[0-9]{6,12}$/)){
        mostrarPrompt("Invalido", "Ci_disp", "red");
        return false;     
      }
    if (cargo[2]!='Profesor')
    {
      mostrarPrompt("No es Profesor", "Ci_disp", "red");
      return false;
    }

      $.ajax({
      type:"POST",
      url:"veri_ciDisp.php",
      data:"ci="+ci+"&periodo="+periodo,
      success: function (data){
        
        if (data==0)
        {
          mostrarPrompt("Esta disponible", "Ci_disp", "green");
          document.getElementById('boton_submit').disabled=false;
        }
        if (data==1)
        {
          mostrarPrompt("No Existe", "Ci_disp", "red");
          document.getElementById('boton_submit').disabled=true;
        }
        if (data==2)
        {
          jsMostrar("salidaR_DISPONIBILIDAD");
          mostrarPrompt("No disponible", "Ci_disp", "red");
          mostrarPrompt("Ya Existe la Disponibilidad de esta Persona", "salidaR_DISPONIBILIDAD", "red");
          document.getElementById('boton_submit').disabled=true;
          
          setTimeout(function()
          {
            jsOcultar("salidaR_DISPONIBILIDAD");
          }, 2000);
        }
        if (data==3)
        {
          mostrarPrompt("Campo Requerido", "Periodo", "red");
          document.getElementById('boton_submit').disabled=true;
        }
      }
    });
}

function validarPERIODO_M()
{
  var periodo=document.getElementById('periodo_M').value;

  if (periodo==0)
  {
    mostrarPrompt("Campo Requerido", "Periodo_M", "red");
    document.getElementById('boton_submit_M').disabled=true;
    return false;
  }
  else
  {
    validarCI_M();
    mostrarPrompt("Valido", "Periodo_M", "green");
    return true;
  }
}

function validarCI_M()
{
  document.getElementById('boton_submit_M').disabled=true;

  var id_periodo=document.getElementById('id_periodo_M').value;
  var id_personal=document.getElementById('id_personal_M').value;
  var nac=document.getElementById('nacionalidad_M').value;
  var user=document.getElementById('ci_disp_M').value;
  var periodo=document.getElementById('periodo_M').value;
  var nomApe=document.getElementById('nom_ape_M').value;

  var cargo=nomApe.split(' ');

  var ci=nac+user;

    if (periodo==0)
    {
      mostrarPrompt("Campo Requerido", "Periodo_M", "red");
      return false;
    }
    if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "Ci_disp_M", "red");
      return false;
    }
    if(user.length == 0){
        mostrarPrompt("Campo Requerido", "Ci_disp_M", "red");
        return false;
      }
    if (user==0)
    {
      mostrarPrompt("Invalido", "Ci_disp_M", "red");
      return false;
    }
    if(!user.match(/^[0-9]{6,12}$/)){
        mostrarPrompt("Invalido", "Ci_disp_M", "red");
        return false;     
      }
    if (cargo[2]!='Profesor')
    {
      mostrarPrompt("No es Profesor", "Ci_disp_M", "red");
      return false;
    }

      $.ajax({
      type:"POST",
      url:"veri_ciDisp.php",
      data:"ci="+ci+"&periodo="+periodo+"&id_periodo="+id_periodo+"&id_personal="+id_personal,
      success: function (data){
        
        if (data==0)
        {
          mostrarPrompt("Esta disponible", "Ci_disp_M", "green");
          document.getElementById('boton_submit_M').disabled=false;
        }
        if (data==1)
        {
          mostrarPrompt("No Existe", "Ci_disp_M", "red");
          document.getElementById('boton_submit_M').disabled=true;
        }
        if (data==2)
        {
          jsMostrar("salidaM_DISPONIBILIDAD");
          mostrarPrompt("No disponible", "Ci_disp_M", "red");
          mostrarPrompt("Ya Existe la Disponibilidad de esta Persona", "salidaM_DISPONIBILIDAD", "red");
          document.getElementById('boton_submit_M').disabled=true;
          
          setTimeout(function()
          {
            jsOcultar("salidaM_DISPONIBILIDAD");
          }, 2000);
        }
        if (data==3)
        {
          mostrarPrompt("Campo Requerido", "Periodo_M", "red");
          document.getElementById('boton_submit_M').disabled=true;
        }
      }
    });
}

function validarAULA()
{
  var nombre=document.getElementById('nombre_a').value;

  //alert(nombre);

  if (nombre.length==0)
  {
    mostrarPrompt("Campo Requerido", "NombreAula", "red");
    return false;
  }
  if (nombre.length<2)
  {
    mostrarPrompt("Invalido", "NombreAula", "red");
    return false;
  }

  if (nombre.match(/^\s/))
  {
    mostrarPrompt("Invalido", "NombreAula", "red");
    return false;
  }

  if (!nombre.match(/^[a-zA-z áéíóúüñÁÉÍÓÚÜÑ 1-9]/))
  {
    mostrarPrompt("Invalido", "NombreAula", "red");
    return false;
  }

  $.ajax({
      type:"POST",
      url:"veri_aula.php",
      data:"nombre="+nombre,
      success: function (data){

        $('#aula_ajax').val(data);

        if (data==1)
        {
           mostrarPrompt("El aula ya existe", "NombreAula", "red");
        }
        if (data==0)
        {
           mostrarPrompt("Valido", "NombreAula", "green");
        }
      }
    });

  var valor=document.getElementById('aula_ajax').value;

  if (valor==1)
  {
    return false;
  }
  if (valor==0)
  {
    return true;
  }
}

function validarR_AULA()
{
  if (!validarAULA())
  {
    jsMostrar("salidaR_AULAS");
        
    mostrarPrompt("El formulario debe estar completo", "salidaR_AULAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaR_AULAS");
    }, 2000);
    
    return false;
  }
}

function validarAULA_M()
{
  var nombre=document.getElementById('nombre_aM').value;
  var id=document.getElementById('id_aula').value;

  //alert(nombre);

  if (nombre.length==0)
  {
    mostrarPrompt("Campo Requerido", "NombreAulaM", "red");
    return false;
  }
  if (nombre.length<2)
  {
    mostrarPrompt("Invalido", "NombreAulaM", "red");
    return false;
  }

  if (nombre.match(/^\s/))
  {
    mostrarPrompt("Invalido", "NombreAulaM", "red");
    return false;
  }

  if (!nombre.match(/^[a-zA-z áéíóúüñÁÉÍÓÚÜÑ 1-9]/))
  {
    mostrarPrompt("Invalido", "NombreAulaM", "red");
    return false;
  }

  $.ajax({
      type:"POST",
      url:"veri_aula.php",
      data:"nombre="+nombre+"&id="+id,
      success: function (data){

        $('#aula_ajaxM').val(data);

        if (data==1)
        {
           mostrarPrompt("El aula ya existe", "NombreAulaM", "red");
        }
        if (data==0)
        {
           mostrarPrompt("Valido", "NombreAulaM", "green");
        }
      }
    });

  var valor=document.getElementById('aula_ajaxM').value;

  if (valor==1)
  {
    return false;
  }
  if (valor==0)
  {
    return true;
  }
}

function validarM_AULA()
{
  if (!validarAULA_M())
  {
    jsMostrar("salidaM_AULAS");
        
    mostrarPrompt("El formulario debe estar completo", "salidaM_AULAS", "red");
    
    setTimeout(function()
    {
      jsOcultar("salidaM_AULAS");
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