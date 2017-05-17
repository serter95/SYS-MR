
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

    function telefono(e){
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

    function letraNum(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " 1234567890abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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
    var user = document.getElementById("ci_per").value;    
    var nac = document.getElementById("nacionalidad").value;

    var ci=nac+user;

	if (nac==0){
    	mostrarPrompt("Seleccione la nacionalidad", "C.I_per", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "C.I_per", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,12}$/)){
        mostrarPrompt("Invalido", "C.I_per", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_ci.php",
      data:"ci="+ci,
      success: function (data){
        
        $('#validar_ci_ajax').val(data);

        var bla = document.getElementById("validar_ci_ajax").value;

      if (bla==0)
	    {
	    	mostrarPrompt("Esta disponible", "C.I_per", "green");
	    }
	    if (bla==1)
	    {
	    	mostrarPrompt("No disponible", "C.I_per", "red");
	    }

      }
    });

    var valor = document.getElementById("validar_ci_ajax").value;

    if (valor==0)
    {
    	return true;
    }
    if (valor==1)
    {
    	return false;
    }
}

function validarNAC()
{
	var nac = document.getElementById("nacionalidad").selectedIndex;


	if (nac==0){
    	mostrarPrompt("Seleccione la nacionalidad", "C.I_per", "red");
        return false;
    }
    
    mostrarPrompt("Campo Requerido", "C.I_per", "red");

    return true;
}

function validarNOM()
{
	var nombres = document.getElementById("nombres_per").value;

	if (nombres.length == 0)
		{
			mostrarPrompt("Campo Requerido", "val_nombres_per", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "val_nombres_per", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?/))
		{
			mostrarPrompt("Invalido", "val_nombres_per", "red");
        	return false;
		}
			mostrarPrompt("Valido", "val_nombres_per", "green");
        	return true;
}

function validarAPE()
{
	var nombres = document.getElementById("apellidos_per").value;

	if (nombres.length == 0)
		{
			mostrarPrompt("Campo Requerido", "val_apellidos_per", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "val_apellidos_per", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?/))
		{
			mostrarPrompt("Invalido", "val_apellidos_per", "red");
        	return false;
		}
			mostrarPrompt("Valido", "val_apellidos_per", "green");
        	return true;
}

function validarG_I()
{
	var nombres = document.getElementById("grado_inst_reg_per").selectedIndex;

	if (nombres==0)
	{
		mostrarPrompt("Seleccione el grado instruccion", "sms_gi", "red");
		
		return false;
	}
	if (nombres>0)
	{
		mostrarPrompt("Valido", "sms_gi", "green");
		return true;
	}
}

function validarESP()
{
	var nombres = document.getElementById("especialidad").value;
	
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "sms_especialidad", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "sms_especialidad", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
		{
			mostrarPrompt("Invalido", "sms_especialidad", "red");
        	return false;
		}
		
			mostrarPrompt("Valido", "sms_especialidad", "green");
        	return true;

}

function validarCARGO()
{
	var nombres = document.getElementById("cargo_per").value;
	
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "cargo", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "cargo", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,25}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,25})?$/))
		{
			mostrarPrompt("Invalido", "cargo", "red");
        	return false;
		}
		
			mostrarPrompt("Valido", "cargo", "green");
        	return true;

}

function validarCORREO ()
{
	var nombres = document.getElementById("correo").value;
	
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "correoE", "red");
        	return false;
		}
	/*if (nombres.match(/^[@][A-Za-z]*[\.][a-z]{2,4}$/))
		{
			mostrarPrompt("Invalido", "correoE", "red");
        	return false;
		}*/	
	if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
		{
			mostrarPrompt("Invalido", "correoE", "red");
        	return false;
		}

	$.ajax({
      type:"POST",
      url:"veri_correo.php",
      data:"correo="+nombres,
      success: function(res){

      	$('#validar_correo_ajax').val(res);

      	var result = document.getElementById('validar_correo_ajax').value;

      	if (result==0)
        	{
        		mostrarPrompt("Esta disponible", "correoE", "green");
        	}
        if (result==1)
        	{
        		mostrarPrompt("No disponible", "correoE", "red");
           	}		
      }
    });

    var resul = document.getElementById('validar_correo_ajax').value;

    	if (resul==0)
        	{
        		return true;
        	}
        if (resul==1)
        	{
        		return false;
        	}
		
	     	return true;
}

function validarTLF ()
{
	var nombres = document.getElementById("num_cont").value;
	var cod_tlf = document.getElementById('cod_tlf').value;

	if (cod_tlf==0)
		{
			mostrarPrompt("Seleccione el codigo del telefono", "num_contacto", "red");
        	return false;
		}
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "num_contacto", "red");
        	return false;
		}
	if (!nombres.match(/^[0-9]{7}$/))
		{
			mostrarPrompt("Invalido", "num_contacto", "red");
        	return false;
		}

			mostrarPrompt("Valido", "num_contacto", "green");
        	return true;
}

function validarFECHA ()
{
	var fecha = document.getElementById("fecha_nac").value;

	//alert("fecha"+nombres);

	if (fecha.length==0)
		{
			mostrarPrompt("Campo Requerido", "fecha_nacimiento", "red");
        	return false;
		}
	if (!fecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
		{
			mostrarPrompt("Invalido", "fecha_nacimiento", "red");
        	return false;
		}

	  var fechaActual = new Date()
    var diaActual = fechaActual.getDate();
    var mmActual = fechaActual.getMonth() + 1;
    var yyyyActual = fechaActual.getFullYear();

    FechaNac = fecha.split("/");
    var diaCumple = FechaNac[0];
    var mmCumple = FechaNac[1];
    var yyyyCumple = FechaNac[2];

    //retiramos el primer cero de la izquierda
    if (mmCumple.substr(0,1) == 0) {
    mmCumple= mmCumple.substring(1, 2);
    }

    //retiramos el primer cero de la izquierda
    if (diaCumple.substr(0, 1) == 0) {
    diaCumple = diaCumple.substring(1, 2);
    }

    var edad = yyyyActual - yyyyCumple;
    
    //validamos si el mes de cumpleaños es menor al actual
    //o si el mes de cumpleaños es igual al actual
    //y el dia actual es menor al del nacimiento
    //De ser asi, se resta un año
    if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
    edad--;
    }
    
    //return edad;

    if (edad<17)
    {
        mostrarPrompt("Debe ser mayor de 17 años", "fecha_nacimiento", "red");
        return false;
    }
    if (edad>=75)
    {
        mostrarPrompt("Debe ser menor de 75 años", "fecha_nacimiento", "red");
        return false;
    }

	  mostrarPrompt("Valido", "fecha_nacimiento", "green");
    return true;
}

function validarDEDICACION()
{
  var dedicacion=document.getElementById('dedicacion').value;
  var control=document.getElementById('dedicacion');

  if (control.disabled==true)
  {
    return true;
  }
  else
  {
      if (dedicacion==0)
      {
        mostrarPrompt("Campo Requerido", "Dedicacion", "red");
        return false;
      }
      else
      {
        mostrarPrompt("Valido", "Dedicacion", "green");
        return true;
      }
  }
}

function validarR_PER()
{
	if(!validarCI() || !validarNAC() || !validarNOM() || !validarAPE() || !validarG_I() || !validarESP() 
    || !validarCARGO() || !validarCORREO() || !validarTLF() || !validarFECHA() || !validarDEDICACION())
		{
				jsMostrar("salidaR_PER");
				
				mostrarPrompt("El formulario debe estar completo", "salidaR_PER", "red");
				
				setTimeout(function()
				{
					jsOcultar("salidaR_PER");
				}, 2000);
				
				return false;
		}	
}

// FIN DE REGISTRO

// MODIFICACION

function validarCI_M()
{
    var user = document.getElementById("ci_perM").value;    
    var nac = document.getElementById("nac_perM").value;
    var id = document.getElementById("id").value;

    var ci=nac+user;

	if (nac==0){
    	mostrarPrompt("Seleccione la nacionalidad", "C.I_perM", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "C.I_perM", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,12}$/)){
        mostrarPrompt("Invalido", "C.I_perM", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_ciM.php",
      data:"ci="+ci+"&id="+id,
      success: function(data){

      	$('#validar_ci_ajaxM').val(data);

      	var resul = document.getElementById('validar_ci_ajaxM').value;

      	if (resul==0)
        {
        	mostrarPrompt("Esta disponible", "C.I_perM", "green");
  			}
          if (resul==1)
        {
         	mostrarPrompt("No disponible", "C.I_perM", "red");
  			}
      }
    });

    	var resul = document.getElementById('validar_ci_ajaxM').value;

    	if (resul==0)
        	{
        		return true;
        	}
        if (resul==1)
        	{
        		return false;
        	}
}

function validarNAC_M()
{
	var nac = document.getElementById("nac_perM").selectedIndex;


	if (nac==0){
    	mostrarPrompt("Seleccione la nacionalidad", "C.I_perM", "red");
        return false;
    }

    mostrarPrompt("Campo Requerido", "C.I_per", "red");
    return true;
}

function validarNOM_M()
{
	var nombres = document.getElementById("nombres_perM").value;

	if (nombres.length == 0)
		{
			mostrarPrompt("Campo Requerido", "val_nombres_per_M", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "val_nombres_per_M", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?/))
		{
			mostrarPrompt("Invalido", "val_nombres_per_M", "red");
        	return false;
		}
			mostrarPrompt("Valido", "val_nombres_per_M", "green");
        	return true;
}

function validarAPE_M()
{
	var nombres = document.getElementById("apellidos_perM").value;

	if (nombres.length == 0)
		{
			mostrarPrompt("Campo Requerido", "val_apellidos_per_M", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "val_apellidos_per_M", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?/))
		{
			mostrarPrompt("Invalido", "val_apellidos_per_M", "red");
        	return false;
		}
			mostrarPrompt("Valido", "val_apellidos_per_M", "green");
        	return true;
}

function validarG_I_M()
{
	var nombres = document.getElementById("grado_instM").selectedIndex;

	if (nombres==0)
	{
		mostrarPrompt("Seleccione el grado instruccion", "sms_giM", "red");
		
		return false;
	}
	if (nombres>0)
	{
		mostrarPrompt("Valido", "sms_giM", "green");
		return true;
	}
}

function validarESP_M()
{
	var nombres = document.getElementById("especialidadM").value;
	
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "sms_especialidadM", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "sms_especialidadM", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]{1,25}((-|\s{1})[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]{1,25})?/))
		{
			mostrarPrompt("Invalido", "sms_especialidadM", "red");
        	return false;
		}
		
			mostrarPrompt("Valido", "sms_especialidadM", "green");
        	return true;

}

function validarCARGO_M()
{
	var nombres = document.getElementById("cargo_perM").value;
	
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "cargoM", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "cargoM", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]{2,25}((-|\s{1})[a-zA-Z ñáéíóúüÑÁÉÍÓÚÜ]{2,25})?$/))
		{
			mostrarPrompt("Invalido", "cargoM", "red");
        	return false;
		}
		
			mostrarPrompt("Valido", "cargoM", "green");
        	return true;

}

function validarCORREO_M ()
{
	var nombres = document.getElementById("correoM").value;
	var id = document.getElementById("id").value;

	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "correoE_M", "red");
        	return false;
		}
	if (nombres.match(/^[@][A-Za-z]*[\.][a-z]{2,4}$/))
		{
			mostrarPrompt("Invalido", "correoE_M", "red");
        	return false;
		}	
	if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
		{
			mostrarPrompt("Invalido", "correoE_M", "red");
        	return false;
		}

	$.ajax({
      type:"POST",
      url:"veri_correoM.php",
      data:"correo="+nombres+"&id="+id,
      success: function(res){

      	$('#validar_correo_ajaxM').val(res);

      	var resul = document.getElementById('validar_correo_ajaxM').value;

    	if (resul==0)
        	{
        		mostrarPrompt("Esta disponible", "correoE_M", "green");
        	}
        if (resul==1)
        	{
        		mostrarPrompt("No disponible", "correoE_M", "red");
        	}

      }
    });

    var resul = document.getElementById('validar_correo_ajaxM').value;

    	if (resul==0)
        	{
        		return true;
        	}
        if (resul==1)
        	{
        		return false;
        	}
			return true;
}

function validarTLF_M ()
{
	var nombres = document.getElementById("num_contM").value;
	var cod_tlf = document.getElementById('cod_tlfM').value;

	if (cod_tlf==0)
		{
			mostrarPrompt("Seleccione el codigo del telefono", "num_contactoM", "red");
        	return false;
		}
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "num_contactoM", "red");
        	return false;
		}
	if (!nombres.match(/^[0-9]{7}$/))
		{
			mostrarPrompt("Invalido", "num_contactoM", "red");
        	return false;
		}

			mostrarPrompt("Valido", "num_contactoM", "green");
        	return true;
}

function validarFECHA_M ()
{

	var fecha = document.getElementById("fecha_nacM").value;

	//alert("fecha"+nombres);

	if (fecha.length==0)
		{
			mostrarPrompt("Campo Requerido", "fecha_nacimientoM", "red");
        	return false;
		}
	if (!fecha.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
		{
			mostrarPrompt("Invalido", "fecha_nacimientoM", "red");
        	return false;
		}

	var fechaActual = new Date()
    var diaActual = fechaActual.getDate();
    var mmActual = fechaActual.getMonth() + 1;
    var yyyyActual = fechaActual.getFullYear();
    
    FechaNac = fecha.split("/");
    var diaCumple = FechaNac[0];
    var mmCumple = FechaNac[1];
    var yyyyCumple = FechaNac[2];

    //retiramos el primer cero de la izquierda
    if (mmCumple.substr(0,1) == 0) {
    mmCumple= mmCumple.substring(1, 2);
    }

    //retiramos el primer cero de la izquierda
    if (diaCumple.substr(0, 1) == 0) {
    diaCumple = diaCumple.substring(1, 2);
    }

    var edad = yyyyActual - yyyyCumple;
    
    //validamos si el mes de cumpleaños es menor al actual
    //o si el mes de cumpleaños es igual al actual
    //y el dia actual es menor al del nacimiento
    //De ser asi, se resta un año
    if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
    edad--;
    }
    
    //return edad;

	if (edad >= 75)
	{
		mostrarPrompt("Debe ser menor de 75 años", "fecha_nacimientoM", "red");
        return false;		
	}
	if (edad < 17)
	{
		mostrarPrompt("Debe ser mayor de 17 años", "fecha_nacimientoM", "red");
       	return false;
	}

	mostrarPrompt("Valido", "fecha_nacimientoM", "green");
    return true;
}

function validarDEDICACION_M()
{
  var dedicacion=document.getElementById('dedicacionM').value;
  var control=document.getElementById('dedicacionM');

  if (control.disabled==true)
  {
    return true;
  }
  else
  {
      if (dedicacion==0)
      {
        mostrarPrompt("Campo Requerido", "DedicacionM", "red");
        return false;
      }
      else
      {
        mostrarPrompt("Valido", "DedicacionM", "green");
        return true;
      }
  }
}

function validarM_PER()
{
	if(!validarCI_M() || !validarNAC_M() || !validarNOM_M() || !validarAPE_M() || !validarG_I_M() || 
    !validarESP_M() || !validarCARGO_M() || !validarCORREO_M() || !validarTLF_M() || !validarFECHA_M() || !validarDEDICACION_M())
		{
				jsMostrar("salidaM_PER");
				
				mostrarPrompt("El formulario debe estar completo", "salidaM_PER", "red");
				
				setTimeout(function()
				{
					jsOcultar("salidaM_PER");
				}, 2000);
				
				return false;
		}	
}
// FIN DE MODIFICACION

// CONFIGURACION

function validarCI_C()
{
    var user = document.getElementById("ci_usuC").value;    
    var nac = document.getElementById("nac_usuC").value;
    var id = document.getElementById("id").value;

    var ci=nac+user;

	if (nac==0){
    	mostrarPrompt("Seleccione la nacionalidad", "ci_usu_C", "red");
        return false;
    }
    if(user.length == 0){
         mostrarPrompt("Campo Requerido", "ci_usu_C", "red");
        return false;
      }
    if(!user.match(/^[0-9]{7,9}$/)){
        mostrarPrompt("Invalido", "ci_usu_C", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_ciM.php",
      data:"ci="+ci+"&id="+id,
      success: function(data){

      	$('#validar_ci_usu_ajaxC').val(data);

      	var resul = document.getElementById('validar_ci_usu_ajaxC').value;

    	if (resul==0)
        	{
        		mostrarPrompt("Esta disponible", "ci_usu_C", "green");
			}
        if (resul==1)
        	{
        		mostrarPrompt("No disponible", "ci_usu_C", "red");
			}
      }
    });

    	var resul = document.getElementById('validar_ci_usu_ajaxC').value;

    	if (resul==0)
        	{
        		return true;
        	}
        if (resul==1)
        	{
        		return false;
        	}
}

function validarNAC_C()
{
	var nac = document.getElementById("nac_usuC").selectedIndex;


	if (nac==0){
    	mostrarPrompt("Seleccione la nacionalidad", "ci_usu_C", "red");
        return false;
    }

    mostrarPrompt("Campo Requerido", "ci_usu_C", "red");
    return true;
}

function validarNOM_C()
{
	var nombres = document.getElementById("nombres_usuC").value;

	if (nombres.length == 0)
		{
			mostrarPrompt("Campo Requerido", "nombresC", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "nombresC", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
		{
			mostrarPrompt("Invalido", "nombresC", "red");
        	return false;
		}
			mostrarPrompt("Valido", "nombresC", "green");
        	return true;
}

function validarAPE_C()
{
	var nombres = document.getElementById("apellidos_usuC").value;

	if (nombres.length == 0)
		{
			mostrarPrompt("Campo Requerido", "apellidosC", "red");
        	return false;
		}
	if (nombres.match(/^\s/))
		{
			mostrarPrompt("Invalido", "apellidosC", "red");
        	return false;
		}
	if (!nombres.match(/^[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20}((-|\s{1})[a-zA-ZñáéíóúüÑÁÉÍÓÚÜ]{2,20})?$/))
		{
			mostrarPrompt("Invalido", "apellidosC", "red");
        	return false;
		}
			mostrarPrompt("Valido", "apellidosC", "green");
        	return true;
}

function validarCORREO_C ()
{
	var nombres = document.getElementById("correoC").value;
	var id = document.getElementById("id").value;

	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "correoE_C", "red");
        	return false;
		}
	if (nombres.match(/^[@][A-Za-z]*[\.][a-z]{2,4}$/))
		{
			mostrarPrompt("Invalido", "correoE_C", "red");
        	return false;
		}	
	if (!nombres.match(/^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/))
		{
			mostrarPrompt("Invalido", "correoE_C", "red");
        	return false;
		}

	$.ajax({
      type:"POST",
      url:"veri_correoM.php",
      data:"correo="+nombres+"&id="+id,
      success: function(res){

      	$('#validar_correo_ajaxC').val(res);

      	var resul = document.getElementById('validar_correo_ajaxC').value;

    	if (resul==0)
        	{
        		mostrarPrompt("Esta disponible", "correoE_C", "green");
        	}
        if (resul==1)
        	{
        		mostrarPrompt("No disponible", "correoE_C", "red");
        	}

      }
    });

    var resul = document.getElementById('validar_correo_ajaxC').value;

    	if (resul==0)
        	{
        		return true;
        	}
        if (resul==1)
        	{
        		return false;
        	}
			return true;
}

function validarTLF_C ()
{
	var nombres = document.getElementById("num_contC").value;
	var cod_tlf = document.getElementById('cod_tlfC').value;

	if (cod_tlf==0)
		{
			mostrarPrompt("Seleccione el codigo del telefono", "num_contactoC", "red");
        	return false;
		}
	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "num_contactoC", "red");
        	return false;
		}
	if (!nombres.match(/^[0-9]{7}$/))
		{
			mostrarPrompt("Invalido", "num_contactoC", "red");
        	return false;
		}

			mostrarPrompt("Valido", "num_contactoC", "green");
        	return true;
}

function validarFECHA_C ()
{

	var nombres = document.getElementById("fecha_nacC").value;

	//alert("fecha"+nombres);

	if (nombres.length==0)
		{
			mostrarPrompt("Campo Requerido", "fecha_nacimientoC", "red");
        	return false;
		}
	if (!nombres.match(/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/))
		{
			mostrarPrompt("Invalido", "fecha_nacimientoC", "red");
        	return false;
		}

	var hoy = new Date();
//	var principio = new Date(hoy.getDate(),hoy.getMonth(),hoy.getFullYear());
//	var fin = new Date(hoy.getDate(),hoy.getMonth(),hoy.getFullYear());

	var mesPrincipal=hoy.getFullYear()-70;
	var mesFinal=hoy.getFullYear()-17;
	
	var especifica = nombres.split('/');
	var ano=especifica[2];

//	alert(mesPrincipal+" "+mesFinal+" "+ano);

	if (ano < mesPrincipal)
	{
		mostrarPrompt("Debe ser menor de 70 años", "fecha_nacimientoC", "red");
        return false;		
	}
	if (ano > mesFinal)
	{
		mostrarPrompt("Debe ser mayor de 17 años", "fecha_nacimientoC", "red");
       	return false;
	}

	mostrarPrompt("Valido", "fecha_nacimientoC", "green");
    return true;
}

function validarCUENTA_PER()
{
	if(!validarCI_C() || !validarNAC_C() || !validarNOM_C() || !validarAPE_C()
		|| !validarCORREO_C() || !validarTLF_C() || !validarFECHA_C() )
		{
				jsMostrar("salidaC_PER");
				
				mostrarPrompt("El formulario debe estar completo", "salidaC_PER", "red");
				
				setTimeout(function()
				{
					jsOcultar("salidaC_PER");
				}, 2000);
				
				return false;
		}	
}

// FIN CONFIGURACION

// CONFIGURACION DE USUARIO

function validarNOM_USU_C()
{
  var nom_usu = document.getElementById("nombre_usuarioC").value;
  var id = document.getElementById("id_usu").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_nom_usu_C", "red");
        return false;
      }
    if(nom_usu.length <= 4){
         mostrarPrompt("Invalido", "vali_nom_usu_C", "red");
        return false;
      }
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_nom_usu_C", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-ñÑ]+((-|_)[0-9A-Za-zñÑ]+)?$/)){
        mostrarPrompt("Invalido", "vali_nom_usu_C", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_nom_usu_M.php",
      data:"nom="+nom_usu+"&id="+id,
      success: function (data){
          
        $('#validar_nom_usu_ajaxC').val(data);
 
        var valores = document.getElementById("validar_nom_usu_ajaxC").value;

        if (valores==1)
        {
          mostrarPrompt("Ya existe", "vali_nom_usu_C", "red");
        }
        if (valores==0)
        {
          mostrarPrompt("Disponible", "vali_nom_usu_C", "green");
        }
        if (valores==2)
        {
          mostrarPrompt("Disponible", "vali_nom_usu_C", "green");
        }

      }
    });

      var valor = document.getElementById("validar_nom_usu_ajaxC").value;

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

function validarCONTRASENA_USU_C()
{
  var nom_usu = document.getElementById("contrasena_usuarioC").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_contrasena_C", "red");
        return false;
      }
    if(nom_usu.length < 4){
         mostrarPrompt("Invalido", "vali_contrasena_C", "red");
        return false;
      }
    if(nom_usu.length >= 21){
         mostrarPrompt("Invalida", "vali_contrasena_C", "red");
        return false;
      }  
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_contrasena_C", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-z]+$/)){
        mostrarPrompt("Invalido", "vali_contrasena_C", "red");
        return false;     
      }

    mostrarPrompt("Valido", "vali_contrasena_C", "green");
    return true;
}

function validarCONTRASENA_USU2_C()
{
  var nom_usu = document.getElementById("contrasena2_usuarioC").value;
  var nom_usu2 = document.getElementById("contrasena_usuarioC").value;

    if(nom_usu.length == 0){
         mostrarPrompt("Campo Requerido", "vali_contrasena2_C", "red");
        return false;
      }
    if(nom_usu.length < 4){
         mostrarPrompt("Invalido", "vali_contrasena2_C", "red");
        return false;
      }
    if(nom_usu.length >= 21){
         mostrarPrompt("Invalida", "vali_contrasena2_C", "red");
        return false;
      }  
    if (nom_usu.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_contrasena2_C", "red");
        return false;
    }
    if(!nom_usu.match(/^[0-9A-Za-z]+$/)){
        mostrarPrompt("Invalido", "vali_contrasena2_C", "red");
        return false;     
      }
    if(nom_usu2!=nom_usu){
        mostrarPrompt("Contraseñas diferentes", "vali_contrasena2_C", "red");
        return false;     
      }

    mostrarPrompt("Valido", "vali_contrasena2_C", "green");
    return true;
}

function validarPREGUNTA_C()
{
  var actividad = document.getElementById('preguntaC').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "vali_pregunta_C", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_pregunta_C", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ]+$/)){
        mostrarPrompt("Invalido", "vali_pregunta_C", "red");
        return false;     
    }

    mostrarPrompt("Valido", "vali_pregunta_C", "green");
    return true;     
}

function validarRESPUESTA_C()
{
  var actividad = document.getElementById('respuestaC').value;

    if(actividad.length == 0){
         mostrarPrompt("Campo Requerido", "vali_respuesta_C", "red");
        return false;
      }
    if (actividad.match(/^\s/)){
        mostrarPrompt("Invalido", "vali_respuesta_C", "red");
        return false;
    }
    if(!actividad.match(/^[0-9 A-Za-záéíóúüñÁÉÍÓÚÜÑ]+$/)){
        mostrarPrompt("Invalido", "vali_respuesta_C", "red");
        return false;     
    }

    mostrarPrompt("Valido", "vali_respuesta_C", "green");
    return true;     
}

function validarC_CUENTA()
{
	if(!validarNOM_USU_C() || !validarCONTRASENA_USU_C() || !validarCONTRASENA_USU2_C() || !validarPREGUNTA_C()
		|| !validarRESPUESTA_C())
		{
				jsMostrar("salidaC_USU");
				
				mostrarPrompt("El formulario debe estar completo", "salidaC_USU", "red");
				
				setTimeout(function()
				{
					jsOcultar("salidaC_USU");
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