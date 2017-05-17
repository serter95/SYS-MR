
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

    function soloPeriodo(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "1234567890-Ii";
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

       function soloCodigo(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ-1234567890";
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

    function letraNum(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 1234567890áéíóúüÁÉÍÓÚÜabcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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

function validarTITULO()
{
  var nombres = document.getElementById("titulo").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Titulo", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Titulo", "red");
          return false;
    }
  if (!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
      mostrarPrompt("Invalido", "Titulo", "red");
          return false;
    }
      mostrarPrompt("Valido", "Titulo", "green");
          return true;
}

function validarCODIGO()
{
    var nombres = document.getElementById("codigo").value;    

    if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Codigo", "red");
          return false;
    }
    if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Codigo", "red");
      return false;
    }
    if (!nombres.match(/^[A-Z]{3,6}-[0-9]{1,4}-[0-9]{1,4}-[0-9]{1,4}$/))
    {
      mostrarPrompt("Invalido", "Codigo", "red");
      return false;
    }

    $.ajax({
      type:"POST",
      url:"veri_cod.php",
      data:"cod="+nombres,
      success: function(res){

        $('#validar_codigo_ajax').val(res);

        var result = document.getElementById('validar_codigo_ajax').value;

        if (result==0)
          {
            mostrarPrompt("Esta disponible", "Codigo", "green");
          }
        if (result==1)
          {
            mostrarPrompt("No disponible", "Codigo", "red");
          }   
      }
    });

    var valor = document.getElementById("validar_codigo_ajax").value;

    if (valor==0)
    {
    	return true;
    }
    if (valor==1)
    {
    	return false;
    }

}

function validarREGIMEN()
{
	var nac = document.getElementById("regimen").selectedIndex;

	if (nac==0){
    	mostrarPrompt("Seleccione el régimen", "Regimen", "red");
        return false;
    }
    
    mostrarPrompt("Valido", "Regimen", "green");

    return true;
}

function validarESTADO()
{
	var nombres = document.getElementById("estado").value;

	if (nombres.length == 0)
		{
			mostrarPrompt("Campo Requerido", "Estado", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "Estado", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
		{
			mostrarPrompt("Invalido", "Estado", "red");
        	return false;
		}
			mostrarPrompt("Valido", "Estado", "green");
        	return true;
}

function validarMUNICIPIO()
{
  var nombres = document.getElementById("municipio").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Municipio", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Municipio", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "Municipio", "red");
          return false;
    }
      mostrarPrompt("Valido", "Municipio", "green");
          return true;
}

function validarPARROQUIA()
{
  var nombres = document.getElementById("parroquia").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Parroquia", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Parroquia", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "Parroquia", "red");
          return false;
    }
      mostrarPrompt("Valido", "Parroquia", "green");
          return true;
}

function validarSECTOR()
{
  var nombres = document.getElementById("sector").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Sector", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Sector", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "Sector", "red");
          return false;
    }
      mostrarPrompt("Valido", "Sector", "green");
          return true;
}

function validarPNF()
{
  var nombres = document.getElementById("pnf").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Pnf", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Pnf", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "Pnf", "red");
          return false;
    }
      mostrarPrompt("Valido", "Pnf", "green");
          return true;
}

function validarTRAYECTO()
{
  var nombres = document.getElementById("trayecto").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Trayecto", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Trayecto", "red");
          return false;
    }
  if (!nombres.match(/^[0-9]{1}$/))
    {
      mostrarPrompt("Invalido", "Trayecto", "red");
          return false;
    }
      mostrarPrompt("Valido", "Trayecto", "green");
          return true;
}

function validarSECCION()
{
  var nombres = document.getElementById("seccion").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Seccion", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Seccion", "red");
          return false;
    }
  if (!nombres.match(/^[1-9]{1}$/))
    {
      mostrarPrompt("Invalido", "Seccion", "red");
          return false;
    }
      mostrarPrompt("Valido", "Seccion", "green");
          return true;
}

function validarPERIODO()
{
  var nombres = document.getElementById("periodo").value;

  var p=nombres.split("-");

  if (p[0]<2000)
  {
    mostrarPrompt("Invalido", "Periodo", "red");
      return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Periodo", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Periodo", "red");
          return false;
    }
  if (!nombres.match(/^[0-9]{4}-[I]{1,3}$/))
    {
      mostrarPrompt("Invalido", "Periodo", "red");
          return false;
    }
      mostrarPrompt("Valido", "Periodo", "green");
          return true;
}

// ESTUDIANTE 1

function validarCI1()
{
  var nombres = document.getElementById("ciEst").value;
  var nac = document.getElementById('nacEst').selectedIndex;

  if (nac==0)
  {
    mostrarPrompt("Seleccione la nacionalidad", "Ci1", "red");
    return false;
  }
  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Ci1", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ci1", "red");
      return false;
    }
  if (nombres==0)
  {
    mostrarPrompt("Invalido", "Ci1", "red");
      return false;
  }
  if (!nombres.match(/^[0-9]{7,12}$/))
    {
      mostrarPrompt("Invalido", "Ci1", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ci1", "green");
      return true;
}

function validarNOM1()
{
  var nombres = document.getElementById("nomEst").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Nom1", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Nom1", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Nom1", "red");
      return false;
    }
      mostrarPrompt("Valido", "Nom1", "green");
      return true;
}

function validarAPE1()
{

  var nombres = document.getElementById("apeEst").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Ape1", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ape1", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Ape1", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ape1", "green");
      return true;
}

function validarTLF1()
{

  var nombres = document.getElementById("tlfEst").value;
  var cod=document.getElementById('codTlf').selectedIndex;

  if (cod==0)
  {
    mostrarPrompt("Seleccione el codigo del teléfono", "Tlf1", "red");
    return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Tlf1", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Tlf1", "red");
      return false;
    }
  if (!nombres.match(/^[0-9]{7}$/))
    {
      mostrarPrompt("Invalido", "Tlf1", "red");
      return false;
    }
      mostrarPrompt("Valido", "Tlf1", "green");
      return true;
}

function validarCORREO1()
{

  var nombres = document.getElementById("correoEst").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Correo1", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Correo1", "red");
      return false;
    }
  if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
    {
      mostrarPrompt("Invalido", "Correo1", "red");
      return false;
    }
      mostrarPrompt("Valido", "Correo1", "green");
      return true;
}

function validarESPECIALIDAD1()
{

  var nombres = document.getElementById("especialidad").value;
  
  if (nombres.length==0)
    {
      mostrarPrompt("Campo Requerido", "Especialidad1", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Especialidad1", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
    {
      mostrarPrompt("Invalido", "Especialidad1", "red");
      return false;
    }

     mostrarPrompt("Valido", "Especialidad1", "green");
      return true;
}

// FIN ESTUDIANTE 1
 
// ESTUDIANTE 2

function validarCI2()
{
  var nombres1 = document.getElementById("ciEst").value;
  var nac1 = document.getElementById('nacEst').selectedIndex;

  var ci1=nac1+nombres1;

  var nombres = document.getElementById("ciEst2").value;
  var nac = document.getElementById('nacEst2').selectedIndex;

  var ci=nac+nombres;

  if (nac==0)
  {
    mostrarPrompt("Seleccione la nacionalidad", "Ci2", "red");
    return false;
  }
  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ci2", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ci2", "red");
      return false;
    }
  if (nombres==0)
  {
    mostrarPrompt("Invalido", "Ci2", "red");
      return false;
  }
  if (!nombres.match(/^[0-9]{7,12}$/))
    {
      mostrarPrompt("Invalido", "Ci2", "red");
      return false;
    }
    if (ci==ci1)
    {
      mostrarPrompt("La cedula de identidad ya fue colocada", "Ci2", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ci2", "green");
      return true;
}

function validarNOM2()
{
  var nombres = document.getElementById("nomEst2").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Nom2", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Nom2", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Nom2", "red");
      return false;
    }
      mostrarPrompt("Valido", "Nom2", "green");
      return true;
}

function validarAPE2()
{
  var nombres = document.getElementById("apeEst2").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ape2", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ape2", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Ape2", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ape2", "green");
      return true;
}

function validarTLF2()
{
  var nombres = document.getElementById("tlfEst2").value;
  var cod=document.getElementById('codTlf2').selectedIndex;

  if (cod==0)
  {
    mostrarPrompt("Seleccione el codigo del teléfono", "Tlf2", "red");
    return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Tlf2", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Tlf2", "red");
      return false;
    }
  if (!nombres.match(/^[0-9]{7}$/))
    {
      mostrarPrompt("Invalido", "Tlf2", "red");
      return false;
    }
      mostrarPrompt("Valido", "Tlf2", "green");
      return true;
}

function validarCORREO2()
{
  var nombres = document.getElementById("correoEst2").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Correo2", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Correo2", "red");
      return false;
    }
  if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
    {
      mostrarPrompt("Invalido", "Correo2", "red");
      return false;
    }
      mostrarPrompt("Valido", "Correo2", "green");
      return true;
}

function validarESPECIALIDAD2()
{
  var nombres = document.getElementById("especialidad2").value;
  
  if (nombres.length==0)
    {
      mostrarPrompt("Invalido", "Especialidad2", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Especialidad2", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
    {
      mostrarPrompt("Invalido", "Especialidad2", "red");
      return false;
    }
    
      mostrarPrompt("Valido", "Especialidad2", "green");
      return true;
}

// FIN ESTUDIANTE 2
// ESTUDIANTE 3

function validarCI3()
{
  var nombres1 = document.getElementById("ciEst").value;
  var nac1 = document.getElementById('nacEst').selectedIndex;

  var ci1=nac1+nombres1;

  var nombres2 = document.getElementById("ciEst2").value;
  var nac2 = document.getElementById('nacEst2').selectedIndex;

  var ci2=nac2+nombres2;

  var nombres = document.getElementById("ciEst3").value;
  var nac = document.getElementById('nacEst3').selectedIndex;

  var ci=nac+nombres;

  if (nac==0)
  {
    mostrarPrompt("Seleccione la nacionalidad", "Ci3", "red");
    return false;
  }
  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ci3", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ci3", "red");
      return false;
    }
 if (nombres==0)
  {
    mostrarPrompt("Invalido", "Ci3", "red");
      return false;
  }

  if (!nombres.match(/^[0-9]{7,12}$/))
    {
      mostrarPrompt("Invalido", "Ci3", "red");
      return false;
    }
  if (ci==ci1)
  {
    mostrarPrompt("La cedula de identidad ya fue colocada", "Ci3", "red");
    return false;
  }
  if (ci==ci2)
  {
    mostrarPrompt("La cedula de identidad ya fue colocada", "Ci3", "red");
    return false;
  }
      mostrarPrompt("Valido", "Ci3", "green");
      return true;
}

function validarNOM3()
{
  var nombres = document.getElementById("nomEst3").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Nom3", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Nom3", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Nom3", "red");
      return false;
    }
      mostrarPrompt("Valido", "Nom3", "green");
      return true;
}

function validarAPE3()
{
  var nombres = document.getElementById("apeEst3").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ape3", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ape3", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Ape3", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ape3", "green");
      return true;
}

function validarTLF3()
{
  var nombres = document.getElementById("tlfEst3").value;
  var cod=document.getElementById('codTlf3').selectedIndex;

  if (cod==0)
  {
    mostrarPrompt("Seleccione el codigo del teléfono", "Tlf3", "red");
    return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Tlf3", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Tlf3", "red");
      return false;
    }
  if (!nombres.match(/^[0-9]{7}$/))
    {
      mostrarPrompt("Invalido", "Tlf3", "red");
      return false;
    }
      mostrarPrompt("Valido", "Tlf3", "green");
      return true;
}

function validarCORREO3()
{
  var nombres = document.getElementById("correoEst3").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Correo3", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Correo3", "red");
      return false;
    }
  if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
    {
      mostrarPrompt("Invalido", "Correo3", "red");
      return false;
    }
      mostrarPrompt("Valido", "Correo3", "green");
      return true;
}

function validarESPECIALIDAD3()
{
  var nombres = document.getElementById("especialidad3").value;
  
  if (nombres.length==0)
    {
      mostrarPrompt("Campo Requerido", "Especialidad3", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Especialidad3", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
    {
      mostrarPrompt("Invalido", "Especialidad3", "red");
      return false;
    }
    
      mostrarPrompt("Valido", "Especialidad3", "green");
      return true;
}

// FIN ESTUDIANTE 3
function validarDESCRIPCION()
{
  var nombres = document.getElementById("descripcion").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "Descripcion", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "Descripcion", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "Descripcion", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "Descripcion", "green");
        return true;
}

function validarAPORTES()
{
  var nombres = document.getElementById("aportes").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "Aportes", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "Aportes", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "Aportes", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "Aportes", "green");
        return true;
}

function validarINTEGRACION()
{
  var nombres = document.getElementById("integracion").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "Integracion", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "Integracion", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "Integracion", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "Integracion", "green");
        return true;
}

function validarPLANNACIONAL()
{
  var nombres = document.getElementById("planNacional").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "PlanNacional", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "PlanNacional", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "PlanNacional", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "PlanNacional", "green");
        return true;
}    

function validarPROYECTO()
{
	if(!validarTITULO() || !validarCODIGO() || !validarREGIMEN() || !validarESTADO() || !validarMUNICIPIO()
    || !validarPARROQUIA() || !validarSECTOR() || !validarPNF() || !validarTRAYECTO() || !validarSECCION()
    || !validarPERIODO() || !validarCI1() || !validarNOM1() || !validarAPE1() || !validarTLF1()
    || !validarCORREO1() || !validarESPECIALIDAD1() || !validarDESCRIPCION() || !validarAPORTES()
    || !validarINTEGRACION() || !validarPLANNACIONAL())
		{
				jsMostrar("salidaR_TECNOLOGICO");
				
				mostrarPrompt("El formulario debe estar completo", "salidaR_TECNOLOGICO", "red");
				
				setTimeout(function()
				{
					jsOcultar("salidaR_TECNOLOGICO");
				}, 2000);
				
				return false;
		}
}

// FIN DE REGISTRO

// MODIFICACION

function validarTITULO_M()
{
  var nombres = document.getElementById("tituloM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "TituloM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "TituloM", "red");
          return false;
    }
  if (!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
      mostrarPrompt("Invalido", "TituloM", "red");
          return false;
    }
      mostrarPrompt("Valido", "TituloM", "green");
          return true;
}

function validarCODIGO_M()
{
    var nombres = document.getElementById("codigoM").value;
    var id = document.getElementById("id").value;   

    if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "CodigoM", "red");
          return false;
    }
    if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodigoM", "red");
      return false;
    }
    if (!nombres.match(/^[A-Z]{3,6}-[0-9]{1,4}-[0-9]{1,4}-[0-9]{1,4}$/))
    {
      mostrarPrompt("Invalido", "CodigoM", "red");
      return false;
    }

    $.ajax({
      type:"POST",
      url:"veri_cod.php",
      data:"cod="+nombres+"&id="+id,
      success: function(res){

        $('#validar_codigo_ajaxM').val(res);

        var result = document.getElementById('validar_codigo_ajaxM').value;

        if (result==0)
          {
            mostrarPrompt("Esta disponible", "CodigoM", "green");
          }
        if (result==1)
          {
            mostrarPrompt("No disponible", "CodigoM", "red");
          }   
      }
    });

    var valor = document.getElementById("validar_codigo_ajaxM").value;

    if (valor==0)
    {
      return true;
    }
    if (valor==1)
    {
      return false;
    }

}

function validarREGIMEN_M()
{
  var nac = document.getElementById("regimenM").selectedIndex;

  if (nac==0){
      mostrarPrompt("Seleccione el régimen", "RegimenM", "red");
        return false;
    }
    
    mostrarPrompt("Valido", "RegimenM", "green");

    return true;
}

function validarESTADO_M()
{
  var nombres = document.getElementById("estadoM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "EstadoM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "EstadoM", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "EstadoM", "red");
          return false;
    }
      mostrarPrompt("Valido", "EstadoM", "green");
          return true;
}

function validarMUNICIPIO_M()
{
  var nombres = document.getElementById("municipioM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "MunicipioM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "MunicipioM", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "MunicipioM", "red");
          return false;
    }
      mostrarPrompt("Valido", "MunicipioM", "green");
          return true;
}

function validarPARROQUIA_M()
{
  var nombres = document.getElementById("parroquiaM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "ParroquiaM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "ParroquiaM", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "ParroquiaM", "red");
          return false;
    }
      mostrarPrompt("Valido", "ParroquiaM", "green");
          return true;
}

function validarSECTOR_M()
{
  var nombres = document.getElementById("sectorM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "SectorM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "SectorM", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "SectorM", "red");
          return false;
    }
      mostrarPrompt("Valido", "SectorM", "green");
          return true;
}

function validarPNF_M()
{
  var nombres = document.getElementById("pnfM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "PnfM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "PnfM", "red");
          return false;
    }
  if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]+$/))
    {
      mostrarPrompt("Invalido", "PnfM", "red");
          return false;
    }
      mostrarPrompt("Valido", "PnfM", "green");
          return true;
}

function validarTRAYECTO_M()
{
  var nombres = document.getElementById("trayectoM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "TrayectoM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "TrayectoM", "red");
          return false;
    }
  if (!nombres.match(/^[0-9]{1}$/))
    {
      mostrarPrompt("Invalido", "TrayectoM", "red");
          return false;
    }
      mostrarPrompt("Valido", "TrayectoM", "green");
          return true;
}

function validarSECCION_M()
{
  var nombres = document.getElementById("seccionM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "SeccionM", "red");
          return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "SeccionM", "red");
          return false;
    }
  if (!nombres.match(/^[1-9]{1}$/))
    {
      mostrarPrompt("Invalido", "SeccionM", "red");
          return false;
    }
      mostrarPrompt("Valido", "SeccionM", "green");
          return true;
}

function validarPERIODO_M()
{
  var nombres = document.getElementById("periodoM").value;

  var p=nombres.split("-");

  if (p[0]<2000)
  {
    mostrarPrompt("Invalido", "PeriodoM", "red");
      return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "PeriodoM", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "PeriodoM", "red");
      return false;
    }
  if (!nombres.match(/^[0-9]{4}-[I]{1,3}$/))
    {
      mostrarPrompt("Invalido", "PeriodoM", "red");
          return false;
    }
      mostrarPrompt("Valido", "PeriodoM", "green");
          return true;
}

// ESTUDIANTE 1

function validarCI1_M()
{
  var nombres = document.getElementById("ciEstM").value;
  var nac = document.getElementById('nacEstM').selectedIndex;

  if (nac==0)
  {
    mostrarPrompt("Seleccione la nacionalidad", "Ci1M", "red");
    return false;
  }
  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Ci1M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ci1M", "red");
      return false;
    }
  if (nombres==0)
  {
    mostrarPrompt("Invalido", "Ci1M", "red");
      return false;
  }
  if (!nombres.match(/^[0-9]{7,12}$/))
    {
      mostrarPrompt("Invalido", "Ci1M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ci1M", "green");
      return true;
}

function validarNOM1_M()
{
  var nombres = document.getElementById("nomEstM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Nom1M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Nom1M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Nom1M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Nom1M", "green");
      return true;
}

function validarAPE1_M()
{

  var nombres = document.getElementById("apeEstM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Ape1M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ape1M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Ape1M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ape1M", "green");
      return true;
}

function validarTLF1_M()
{

  var nombres = document.getElementById("tlfEstM").value;
  var cod=document.getElementById('codTlfM').selectedIndex;

  if (cod==0)
  {
    mostrarPrompt("Seleccione el codigo del teléfono", "Tlf1M", "red");
    return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Tlf1M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Tlf1M", "red");
      return false;
    }
  if (!nombres.match(/^[0-9]{7}$/))
    {
      mostrarPrompt("Invalido", "Tlf1M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Tlf1M", "green");
      return true;
}

function validarCORREO1_M()
{

  var nombres = document.getElementById("correoEstM").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Campo Requerido", "Correo1M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Correo1M", "red");
      return false;
    }
  if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
    {
      mostrarPrompt("Invalido", "Correo1M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Correo1M", "green");
      return true;
}

function validarESPECIALIDAD1_M()
{

  var nombres = document.getElementById("especialidadM").value;
  
  if (nombres.length==0)
    {
      mostrarPrompt("Campo Requerido", "Especialidad1M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Especialidad1M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
    {
      mostrarPrompt("Invalido", "Especialidad1M", "red");
      return false;
    }

     mostrarPrompt("Valido", "Especialidad1M", "green");
      return true;
}

// FIN ESTUDIANTE 1
 
// ESTUDIANTE 2

function validarCI2_M()
{
  var nombres1 = document.getElementById("ciEstM").value;
  var nac1 = document.getElementById('nacEstM').selectedIndex;

  var ci1=nac1+nombres1;

  var nombres = document.getElementById("ciEst2M").value;
  var nac = document.getElementById('nacEst2M').selectedIndex;

  var ci=nac+nombres;

  if (nac==0)
  {
    mostrarPrompt("Seleccione la nacionalidad", "Ci2M", "red");
    return false;
  }
  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ci2M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ci2M", "red");
      return false;
    }
  if (nombres==0)
  {
    mostrarPrompt("Invalido", "Ci2M", "red");
      return false;
  }
  if (!nombres.match(/^[0-9]{7,12}$/))
    {
      mostrarPrompt("Invalido", "Ci2M", "red");
      return false;
    }
    if (ci==ci1)
    {
      mostrarPrompt("La cedula de identidad ya fue colocada", "Ci2M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ci2M", "green");
      return true;
}

function validarNOM2_M()
{
  var nombres = document.getElementById("nomEst2M").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Nom2M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Nom2M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Nom2M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Nom2M", "green");
      return true;
}

function validarAPE2_M()
{
  var nombres = document.getElementById("apeEst2M").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ape2M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ape2M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Ape2M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ape2M", "green");
      return true;
}

function validarTLF2_M()
{
  var nombres = document.getElementById("tlfEst2M").value;
  var cod=document.getElementById('codTlf2M').selectedIndex;

  if (cod==0)
  {
    mostrarPrompt("Seleccione el codigo del teléfono", "Tlf2M", "red");
    return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Tlf2M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Tlf2M", "red");
      return false;
    }
  if (!nombres.match(/^[0-9]{7}$/))
    {
      mostrarPrompt("Invalido", "Tlf2M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Tlf2M", "green");
      return true;
}

function validarCORREO2_M()
{
  var nombres = document.getElementById("correoEst2M").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Correo2M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Correo2M", "red");
      return false;
    }
  if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
    {
      mostrarPrompt("Invalido", "Correo2M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Correo2M", "green");
      return true;
}

function validarESPECIALIDAD2_M()
{
  var nombres = document.getElementById("especialidad2M").value;
  
  if (nombres.length==0)
    {
      mostrarPrompt("Invalido", "Especialidad2M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Especialidad2M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
    {
      mostrarPrompt("Invalido", "Especialidad2M", "red");
      return false;
    }
    
      mostrarPrompt("Valido", "Especialidad2M", "green");
      return true;
}

// FIN ESTUDIANTE 2
// ESTUDIANTE 3

function validarCI3_M()
{
  var nombres1 = document.getElementById("ciEstM").value;
  var nac1 = document.getElementById('nacEstM').value;

  var ci1=nac1+nombres1;

  var nombres2 = document.getElementById("ciEst2M").value;
  var nac2 = document.getElementById('nacEst2M').value;

  var ci2=nac2+nombres2;

  var nombres = document.getElementById("ciEst3M").value;
  var nac = document.getElementById('nacEst3M').value;

  var ci=nac+nombres;

  if (nac==0)
  {
    mostrarPrompt("Seleccione la nacionalidad", "Ci3M", "red");
    return false;
  }
  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ci3M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ci3M", "red");
      return false;
    }
  if (nombres==0)
  {
    mostrarPrompt("Invalido", "Ci3M", "red");
      return false;
  }
  if (!nombres.match(/^[0-9]{7,12}$/))
    {
      mostrarPrompt("Invalido", "Ci3M", "red");
      return false;
    }
  if (ci==ci1)
  {
    mostrarPrompt("La cedula de identidad ya fue colocada", "Ci3M", "red");
    return false;
  }
  if (ci==ci2)
  {
    mostrarPrompt("La cedula de identidad ya fue colocada", "Ci3M", "red");
    return false;
  }
      mostrarPrompt("Valido", "Ci3M", "green");
      return true;
}

function validarNOM3_M()
{
  var nombres = document.getElementById("nomEst3M").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Nom3M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Nom3M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Nom3M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Nom3M", "green");
      return true;
}

function validarAPE3_M()
{
  var nombres = document.getElementById("apeEst3M").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Ape3M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Ape3M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
    {
      mostrarPrompt("Invalido", "Ape3M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Ape3M", "green");
      return true;
}

function validarTLF3_M()
{
  var nombres = document.getElementById("tlfEst3M").value;
  var cod=document.getElementById('codTlf3M').selectedIndex;

  if (cod==0)
  {
    mostrarPrompt("Seleccione el codigo del teléfono", "Tlf3M", "red");
    return false;
  }

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Tlf3M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Tlf3M", "red");
      return false;
    }
  if (!nombres.match(/^[0-9]{7}$/))
    {
      mostrarPrompt("Invalido", "Tlf3M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Tlf3M", "green");
      return true;
}

function validarCORREO3_M()
{
  var nombres = document.getElementById("correoEst3M").value;

  if (nombres.length == 0)
    {
      mostrarPrompt("Invalido", "Correo3M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Correo3M", "red");
      return false;
    }
  if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
    {
      mostrarPrompt("Invalido", "Correo3M", "red");
      return false;
    }
      mostrarPrompt("Valido", "Correo3M", "green");
      return true;
}

function validarESPECIALIDAD3_M()
{
  var nombres = document.getElementById("especialidad3M").value;
  
  if (nombres.length==0)
    {
      mostrarPrompt("Campo Requerido", "Especialidad3M", "red");
      return false;
    }
  if (nombres.match(/^\s/))
    {
      mostrarPrompt("Invalido", "Especialidad3M", "red");
      return false;
    }
  if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
    {
      mostrarPrompt("Invalido", "Especialidad3M", "red");
      return false;
    }
    
      mostrarPrompt("Valido", "Especialidad3M", "green");
      return true;
}

// FIN ESTUDIANTE 3
function validarDESCRIPCION_M()
{
  var nombres = document.getElementById("descripcionM").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "DescripcionM", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "DescripcionM", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "DescripcionM", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "DescripcionM", "green");
        return true;
}

function validarAPORTES_M()
{
  var nombres = document.getElementById("aportesM").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "AportesM", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "AportesM", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "AportesM", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "AportesM", "green");
        return true;
}

function validarINTEGRACION_M()
{
  var nombres = document.getElementById("integracionM").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "IntegracionM", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "IntegracionM", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "IntegracionM", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "IntegracionM", "green");
        return true;
}

function validarPLANNACIONAL_M()
{
  var nombres = document.getElementById("planNacionalM").value;
  
    if(nombres.length == 0)
    {
        mostrarPrompt("Campo Requerido", "PlanNacionalM", "red");
        return false;
    }
    if (nombres.match(/^\s/))
    {
        mostrarPrompt("Invalido", "PlanNacionalM", "red");
        return false;
    }
    if(!nombres.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ -.,()\/]+$/))
    {
        mostrarPrompt("Invalido", "PlanNacionalM", "red");
        return false;     
    }    
        mostrarPrompt("Valido", "PlanNacionalM", "green");
        return true;
}    

function validarPROYECTO_M()
{
  if(!validarTITULO_M() || !validarCODIGO_M() || !validarREGIMEN_M() || !validarESTADO_M() || !validarMUNICIPIO_M()
    || !validarPARROQUIA_M() || !validarSECTOR_M() || !validarPNF_M() || !validarTRAYECTO_M() || !validarSECCION_M()
    || !validarPERIODO_M() || !validarCI1_M() || !validarNOM1_M() || !validarAPE1_M() || !validarTLF1_M()
    || !validarCORREO1_M() || !validarESPECIALIDAD1_M() || !validarDESCRIPCION_M() || !validarAPORTES_M()
    || !validarINTEGRACION_M() || !validarPLANNACIONAL_M())
    {
        jsMostrar("salidaM_TECNOLOGICO");
        
        mostrarPrompt("El formulario debe estar completo", "salidaM_TECNOLOGICO", "red");
        
        setTimeout(function()
        {
          jsOcultar("salidaM_TECNOLOGICO");
        }, 2000);
        
        return false;
    }
}
// FIN MODIFICACION

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