    $('#btn_cerrar_modH').click(function(){
      $('#validarBloqueProfM').on('hidden.bs.modal', function (e) {
        $('body').addClass('modal-open');
      });
    });

    $('#cerrarModalHorario').click(function(){
      $('#validarBloqueProfM').on('hidden.bs.modal', function (e) {
        $('body').addClass('modal-open');
      });
    });
//  ACADEMICO
    $('#consulta_materias').show();
    $('#registro_materias').hide();
    $('#consulta_secciones').hide();
    $('#registro_secciones').hide();
    $('#consulta_horas').hide();
    $('#registro_horas').hide();
    $('#consulta_disponibilidad').hide();
    $('#registro_disponibilidad').hide();
    $('#consulta_aulas').hide();
    $('#registro_aulas').hide();

    $('#registro_horarios').hide();

    $('#registro_tecnologico').hide();
//  FIN ACADEMICO

//  ADMINISTRATIVO
  $('#r_herramientas').hide();

  $('#agregar_herra').click(function(){
    $('#r_herramientas').show();
    $('#consulta_herra').hide();
  });

    $('#regPersonal').hide();
    $('#registro_planificacion').hide();
    $('#registro_registroDiario').hide()

    $('#proveedor_ext').hide();

    $('#externo').hide();
    $('#interno').hide();

    $('#service_interno').click(function(){
      $('#interno').show();
      $('#externo').hide();
    });

    $('#service_externo').click(function(){
      $('#externo').show();
      $('#interno').hide();
    });

    $('#r_insumos').hide();
    $('#r_salida_insu').hide();


  $('#agregar_insu').click(function(){
    $('#r_insumos').show();
    $('#consulta_insu').hide();
  });

  $('#entrada').hide();
  $('#salida').hide();

  $('#service_entrada').click(function(){
    $('#entrada').show();
    $('#salida').hide();
  });

  $('#service_salida').click(function(){
    $('#salida').show();
    $('#entrada').hide();
  });


$('#tabla_entrada').hide();


  $('#btn_salida').click(function(){
    $('#tabla_salida').show();
    $('#tabla_entrada').hide();
  });

  $('#btn_entrada').click(function(){
    $('#tabla_entrada').show();
    $('#tabla_salida').hide();
  });

  $('#agregar_salida_insu').click(function(){
    $('#r_salida_insu').show();
    $('#consulta_salida_insu').hide();
  });

  $('#ocultarDedicacion').hide( function(){
    document.getElementById('dedicacion').disabled=true;
  });

  $('#ocultarDedicacionM').hide( function(){
    document.getElementById('dedicacionM').disabled=true;
  });

  $('#cargo_per').click(function()
  {
    var cargo=document.getElementById('cargo_per').value;

    if (cargo=='Profesor')
    {
        $('#ocultarDedicacion').show();
        document.getElementById('dedicacion').disabled=false;
    }
    else
    {
        $('#ocultarDedicacion').hide();
        document.getElementById('dedicacion').disabled=true;
    }
  });

  $('#cargo_perM').click(function()
  {
    var cargo=document.getElementById('cargo_perM').value;

    if (cargo=='Profesor')
    {
        $('#ocultarDedicacionM').show();
        document.getElementById('dedicacionM').disabled=false;
    }
    else
    {
        $('#ocultarDedicacionM').hide();
        document.getElementById('dedicacionM').disabled=true;
    }
  });

//  FIN ADMINISTRATIVO

//  CONFIGURACION
    $('#registro_tipo_usu').hide()
    $('#ru').hide();

    function cerrarSesion()
    {
        window.location.href="salir.php";
    }
//  FIN CONFIGURACION


        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
            });
        });

        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }

    $("#slideshow").cycle({
      fx:'blindY'
    });

    $('.boton_horas').click(function () {
        return false;
    });

    $('.boton_horasH').click(function () {
        return false;
    });

    $('#boton_submit').click(function () {
        return false;
    });

    $('#boton_submit_M').click(function () {
        return false;
    });

    $('#submit').click(function () {
        return false;
    });

    $('#submitM').click(function () {
        return false;
    });

    $('#estado').click(function(){
      var estado = document.getElementById('estado').value;

      if (estado!='')
      {
          $.ajax({
              type:'POST',
              url:'buscar_municipio.php',
              data:'estado='+estado,
              success: function(valores){
                  var datos=eval(valores);

                  $('#municipio').html(datos[0]);
              }
          });
      }
    });

    $('#estadoM').click(function(){
      var estado = document.getElementById('estadoM').value;

      if (estado!='')
      {
          $.ajax({
              type:'POST',
              url:'buscar_municipio.php',
              data:'estado='+estado,
              success: function(valores){
                  var datos=eval(valores);

                  $('#municipioM').html(datos[0]);
              }
          });
      }
    });

    function bloquearSubmit()
    {
        document.getElementById('boton_submit').disabled=true;
    }

    function validar_bloques (data)
    {
        var arraylunes=[];
        var arraymartes=[];
        var arraymiercoles=[];
        var arrayjueves=[];
        var arrayviernes=[];
        var id_h=[];

        var periodo=document.getElementById('periodo').value;
        var nacionalidad=document.getElementById('nacionalidad').value;
        var ci_disp=document.getElementById('ci_disp').value;

        for (var i = 1; i <= data; i++)
        {
            var j = i-1;

            var lunes=document.getElementById('lunes_'+i).value;
            var martes=document.getElementById('martes_'+i).value;
            var miercoles=document.getElementById('miercoles_'+i).value;
            var jueves=document.getElementById('jueves_'+i).value;
            var viernes=document.getElementById('viernes_'+i).value;
            var horas=document.getElementById('id_'+i).value;

            arraylunes[j]=lunes;
            arraymartes[j]=martes;
            arraymiercoles[j]=miercoles;
            arrayjueves[j]=jueves;
            arrayviernes[j]=viernes;
            id_h[j]=horas;
        };

        window.location.href="registro_disponibilidad.php?id_h="+id_h+"&periodo="+periodo+"&nacionalidad="+nacionalidad+"&ci_disp="+ci_disp+"&ciclo="+data+"&lunes="+arraylunes+"&martes="+arraymartes+"&miercoles="+arraymiercoles+"&jueves="+arrayjueves+"&viernes="+arrayviernes;
    }

    function validar_bloques_M (data)
    {
        var arraylunes=[];
        var arraymartes=[];
        var arraymiercoles=[];
        var arrayjueves=[];
        var arrayviernes=[];
        var id_h=[];
        var id_disponibilidad=[];

        var id_personal=document.getElementById('id_personal_M').value;
        var id_periodo=document.getElementById('id_periodo_M').value;
        var periodo=document.getElementById('periodo_M').value;
        var nacionalidad=document.getElementById('nacionalidad_M').value;
        var ci_disp=document.getElementById('ci_disp_M').value;

        for (var i = 1; i <= data; i++)
        {
            var j = i-1;

            var lunes=document.getElementById('lunes_'+i+'_M').value;
            var martes=document.getElementById('martes_'+i+'_M').value;
            var miercoles=document.getElementById('miercoles_'+i+'_M').value;
            var jueves=document.getElementById('jueves_'+i+'_M').value;
            var viernes=document.getElementById('viernes_'+i+'_M').value;
            var horas=document.getElementById('id_'+i+'_M').value;
            var disponibilidad=document.getElementById('id_disponibilidad_'+i+'_M').value;

            arraylunes[j]=lunes;
            arraymartes[j]=martes;
            arraymiercoles[j]=miercoles;
            arrayjueves[j]=jueves;
            arrayviernes[j]=viernes;
            id_h[j]=horas;
            id_disponibilidad[j]=disponibilidad;
        };

        window.location.href="modifica_disponibilidad.php?id_disponibilidad="+id_disponibilidad+"&id_personal="+id_personal+"&id_periodo="+id_periodo+"&id_h="+id_h+"&periodo="+periodo+"&nacionalidad="+nacionalidad+"&ci_disp="+ci_disp+"&ciclo="+data+"&lunes="+arraylunes+"&martes="+arraymartes+"&miercoles="+arraymiercoles+"&jueves="+arrayjueves+"&viernes="+arrayviernes;
    }

    function color_botones(div)
    {
        var ciclo=document.getElementById('ciclo').value;
        var nacionalidad=document.getElementById('nacionalidad').value;
        var ci_disp=document.getElementById('ci_disp').value;
        var contador=0;
        var horasSemanales=0;
        var ci_prof=nacionalidad+ci_disp;

        if (nacionalidad!=0 && ci_disp!=0)
        {
            if (div!='cambio')
            {
                var capa=document.getElementById(div).value;

                //alert(periodo+' '+ci_prof);
                if (capa==0)
                {
                    //alert("esta azul y debe cambiar a color verde");
                    $('#'+div).removeClass('boton_horas').addClass('seleccionado');
                    $('#'+div).val(1);
                }
                else
                {
                    //alert("esta verde y debe cambiar a color azul");
                    $('#'+div).removeClass('seleccionado').addClass('boton_horas');
                    $('#'+div).val(0);
                }

                for (var i=1; i <= ciclo; i++)
                {
                    var lunes=document.getElementById('lunes_'+i).value;
                    var martes=document.getElementById('martes_'+i).value;
                    var miercoles=document.getElementById('miercoles_'+i).value;
                    var jueves=document.getElementById('jueves_'+i).value;
                    var viernes=document.getElementById('viernes_'+i).value;

                    if (lunes==1)
                    {
                        contador=contador+1;
                    }
                    if (martes==1)
                    {
                        contador=contador+1;
                    }
                    if (miercoles==1)
                    {
                        contador=contador+1;
                    }
                    if (jueves==1)
                    {
                        contador=contador+1;
                    }
                    if (viernes==1)
                    {
                        contador=contador+1;
                    }
                }

                $.ajax({
                    type:'POST',
                    url:'horas_prof.php',
                    data:'ci_profesor='+ci_prof,
                    success: function(valores){
                        var datos=eval(valores);

                        if(datos[0]=='Tiempo Completo/Dedicación Exclusiva')
                        {
                            horasSemanales=16;
                        }
                        if(datos[0]=='Medio Tiempo')
                        {
                            horasSemanales=12;
                        }
                        if(datos[0]=='Tiempo Convencional')
                        {
                            horasSemanales=6;
                        }

                        if (contador==horasSemanales)
                        {
                            $('#alertaDeHorasLlenas').modal({
                                show:true,
                                backdrop:'static'
                            });
                        }
                    }
                });
            }
            else
            {
                for (var i=1; i <= ciclo; i++)
                {
                    var lunes=document.getElementById('lunes_'+i).value;
                    var martes=document.getElementById('martes_'+i).value;
                    var miercoles=document.getElementById('miercoles_'+i).value;
                    var jueves=document.getElementById('jueves_'+i).value;
                    var viernes=document.getElementById('viernes_'+i).value;

                    if (lunes==1)
                    {
                        contador=contador+1;
                    }
                    if (martes==1)
                    {
                        contador=contador+1;
                    }
                    if (miercoles==1)
                    {
                        contador=contador+1;
                    }
                    if (jueves==1)
                    {
                        contador=contador+1;
                    }
                    if (viernes==1)
                    {
                        contador=contador+1;
                    }

                //alert("contador en ciclo => numero de bloques="+contador);

                }

                //alert("contador => numero de bloques="+contador);

                $.ajax({
                    type:'POST',
                    url:'horas_prof.php',
                    data:'ci_profesor='+ci_prof,
                    success: function(valores){
                        var datos=eval(valores);

                        if(datos[0]=='Tiempo Completo/Dedicación Exclusiva')
                        {
                            if (contador==16)
                            {
                                $('#alertaDeHorasLlenas').modal({
                                    show:true,
                                    backdrop:'static'
                                });
                            }
                        }
                        if(datos[0]=='Medio Tiempo')
                        {
                            if (contador==12)
                            {
                                $('#alertaDeHorasLlenas').modal({
                                    show:true,
                                    backdrop:'static'
                                });
                            }
                        }
                        if(datos[0]=='Tiempo Convencional')
                        {
                            if (contador==6)
                            {
                                $('#alertaDeHorasLlenas').modal({
                                    show:true,
                                    backdrop:'static'
                                });
                            }
                        }

                    }
                });
            }
        }
    }

    function color_botones_M(div)
    {
        var ciclo=document.getElementById('ciclo_M').value;
        var nacionalidad=document.getElementById('nacionalidad_M').value;
        var ci_disp=document.getElementById('ci_disp_M').value;
        var contador=0;
        var horasSemanales=0;
        var ci_prof=nacionalidad+ci_disp;

        if (div!='cambio')
        {

            var capa=document.getElementById(div).value;

            //alert(div+' '+capa);

            if (capa==0)
            {
                //alert("esta azul y debe cambiar a color verde");
                $('#'+div).removeClass('boton_horas').addClass('seleccionado');
                $('#'+div).val(1);
            }
            else
            {
                //alert("esta verde y debe cambiar a color azul");
                $('#'+div).removeClass('seleccionado').addClass('boton_horas');
                $('#'+div).val(0);
            }

            for (var i=1; i <= ciclo; i++)
            {
                var lunes=document.getElementById('lunes_'+i+'_M').value;
                var martes=document.getElementById('martes_'+i+'_M').value;
                var miercoles=document.getElementById('miercoles_'+i+'_M').value;
                var jueves=document.getElementById('jueves_'+i+'_M').value;
                var viernes=document.getElementById('viernes_'+i+'_M').value;

                if (lunes==1)
                {
                    contador=contador+1;
                }
                if (martes==1)
                {
                    contador=contador+1;
                }
                if (miercoles==1)
                {
                    contador=contador+1;
                }
                if (jueves==1)
                {
                    contador=contador+1;
                }
                if (viernes==1)
                {
                    contador=contador+1;
                }
            }

            $.ajax({
                type:'POST',
                url:'horas_prof.php',
                data:'ci_profesor='+ci_prof,
                success: function(valores){
                    var datos=eval(valores);

                    if(datos[0]=='Tiempo Completo/Dedicación Exclusiva')
                    {
                        horasSemanales=16;
                    }
                    if(datos[0]=='Medio Tiempo')
                    {
                        horasSemanales=12;
                    }
                    if(datos[0]=='Tiempo Convencional')
                    {
                        horasSemanales=6;
                    }

                    if (contador==horasSemanales)
                    {
                        $('#alertaDeHorasLlenasM').modal({
                            show:true,
                            backdrop:'static'
                        });
                    }
                }
            });
        }
        else
        {
            for (var i=1; i <= ciclo; i++)
            {
                var lunes=document.getElementById('lunes_'+i+'_M').value;
                var martes=document.getElementById('martes_'+i+'_M').value;
                var miercoles=document.getElementById('miercoles_'+i+'_M').value;
                var jueves=document.getElementById('jueves_'+i+'_M').value;
                var viernes=document.getElementById('viernes_'+i+'_M').value;

                if (lunes==1)
                {
                    contador=contador+1;
                }
                if (martes==1)
                {
                    contador=contador+1;
                }
                if (miercoles==1)
                {
                    contador=contador+1;
                }
                if (jueves==1)
                {
                    contador=contador+1;
                }
                if (viernes==1)
                {
                    contador=contador+1;
                }
            }

            $.ajax({
                type:'POST',
                url:'horas_prof.php',
                data:'ci_profesor='+ci_prof,
                success: function(valores){
                    var datos=eval(valores);

                    if(datos[0]=='Tiempo Completo/Dedicación Exclusiva')
                    {
                        if (contador==16)
                        {
                            $('#alertaDeHorasLlenasM').modal({
                                show:true,
                                backdrop:'static'
                            });
                        }
                    }
                    if(datos[0]=='Medio Tiempo')
                    {
                        if (contador==12)
                        {
                            $('#alertaDeHorasLlenasM').modal({
                                show:true,
                                backdrop:'static'
                            });
                        }
                    }
                    if(datos[0]=='Tiempo Convencional')
                    {
                        if (contador==6)
                        {
                            $('#alertaDeHorasLlenasM').modal({
                                show:true,
                                backdrop:'static'
                            });
                        }
                    }
                }
            });
        }
    }

    function color_botonesYvalidarBloque(div)
    {
        $('#capaValidarProf').val(div);

        $('#validarBloqueProf').modal({
            show:true,
            backdrop:'static'
        });

        CedulaProfesorHorario();

        return false;
    }

    function color_botonesYvalidarBloqueM(div)
    {
        $('#capaValidarProfM').val(div);

        $('#validarBloqueProfM').modal({
            show:true,
            backdrop:'static'
        });

        CedulaProfesorHorarioM();

        return false;
    }

    function CedulaProfesorHorario()
    {
        var div=document.getElementById('capaValidarProf').value;
        var periodo=document.getElementById('periodo').value;

        //alert(div);

        $.ajax({
            type:'POST',
            url:'cedulasProfesor.php',
            data:'dia='+div+"&periodo="+periodo,
            success: function(valores){
                var datos=eval(valores);

                $('#ci').html(datos);
                $('#ci2').html(datos);
                $('#ci3').html(datos);

                nom_ape_horarios();
                ValidarBloqueProfe('algo');

            }
        });
    }

    function CedulaProfesorHorarioM()
    {
        var div=document.getElementById('capaValidarProfM').value;
        var periodo=document.getElementById('periodoM').value;

        //alert(div+' '+periodo);

        $.ajax({
            type:'POST',
            url:'cedulasProfesor.php',
            data:'dia='+div+"&periodo="+periodo,
            success: function(valores){
                var datos=eval(valores);

                $('#ciM').html(datos);
                $('#ci2M').html(datos);
                $('#ci3M').html(datos);

                nom_ape_horariosM();
                ValidarBloqueProfeM('algo');

            }
        });
    }

    function ValidarBloqueProfe (parametro) {

        //alert("HOLA");

        var div=document.getElementById('capaValidarProf').value;
        var capa=document.getElementById(div).value;
        var ced=document.getElementById('ci').value;
        var ci2=document.getElementById("ci2").value;
        var ci3=document.getElementById("ci3").value;
        var aula=document.getElementById('aula').value;
        var periodo=document.getElementById('periodo').value;
        var materia=document.getElementById('materia').value;
        var seccion=document.getElementById('seccion').value;

        if (ced==0)
        {
            document.getElementById("ci2").disabled=true;
            $("#ci2").val("");
            $("#nomApe2").val("");
            $("#ci3").val("");
            $("#nomApe3").val("");
        }

        if (ci2==0)
        {
            document.getElementById("ci3").disabled=true;
            $("#ci3").val("");
        }

        if (ced!=0)
        {
            document.getElementById('ci2').disabled=false;

            if (ci2!=0)
            {
                document.getElementById('ci3').disabled=false;

                if (ced==ci2 || ci2==ci3 || ced==ci3)
                {
                    jsMostrar("SeleccionBloque");

                    mostrarPrompt("No puede colocar un profesor 2 veces en el mismo bloque", "SeleccionBloque", "red");

                    document.getElementById('submit').disabled=true;
                }
                else
                {
                    jsOcultar("SeleccionBloque");
                    document.getElementById('submit').disabled=false;
                }

                if (ci3!=0)
                {
                    if (ced==ci2 || ci2==ci3 || ced==ci3)
                    {
                        jsMostrar("SeleccionBloque");

                        mostrarPrompt("No puede colocar un profesor 2 veces en el mismo bloque", "SeleccionBloque", "red");

                        document.getElementById('submit').disabled=true;
                    }
                    else
                    {
                        jsOcultar("SeleccionBloque");
                        document.getElementById('submit').disabled=false;
                    }
                }
            }
        }

        if (parametro=='algo')
        {
            if (ced==0)
            {
                mostrarPrompt("Campo Requerido","CiProfHorario","red");
            }
            else
            {
                mostrarPrompt("Valido","CiProfHorario","green");
            }
        }
        if (parametro=='algo2')
        {
            if (aula==0)
            {
                mostrarPrompt("Campo Requerido","AulaHorario","red")
            }
            else
            {
                mostrarPrompt("Valido","AulaHorario","green")
            }
        }
        if (parametro=='algo3')
        {
            if (materia==0)
            {
                mostrarPrompt("Campo Requerido","CodMatHorario","red")
            }
            else
            {
                mostrarPrompt("Valido","CodMatHorario","green")
            }
        }

        document.getElementById('submit').disabled=true;
        $('#valorAjaxProf').val("");

                if (capa==0)
                {
                    //alert("capa = 0");
                    $('#submit').val("Marcar Bloque");
                }
                else
                {
                    //alert("capa = 1");
                    $('#submit').val("Desmarcar Bloque");
                }

                if (ced!="" && aula!="" && materia!="" && seccion!="")
                {
                    //alert("cedula="+ced+" aula="+aula+" materia="+materia+" seccion="+seccion);

                    $.ajax({
                        type:'POST',
                        url:'disponibilidad_profesor.php',
                        data:'ci='+ced+'&aula='+aula+'&periodo='+periodo+'&div='+div+'&materia='+materia+'&seccion='+seccion,
                        success: function(valores){

                            //$('#valorAjaxProf').val(valores);

                            //var valor=document.getElementById('valorAjaxProf').value;

                            //alert(valor);

                            if (valores==2)
                            {
                                jsMostrar("SeleccionBloque");
                                mostrarPrompt("El Profesor No esta Disponible", "SeleccionBloque", "red");
                            }

                            if (valores==0)
                            {
                                jsMostrar("SeleccionBloque");
                                mostrarPrompt("El aula ya esta ocupada", "SeleccionBloque", "red");
                            }

                            if (valores==1)
                            {
                                if (ci2!=0 || ci3!=0)
                                {
                                    if (ced==ci2 || ced==ci3 || ci2==ci3)
                                    {
                                        document.getElementById('submit').disabled=true;
                                        mostrarPrompt("No puede colocar un profesor 2 veces en el mismo bloque", "SeleccionBloque", "red");
                                    }
                                    else
                                    {
                                        jsOcultar("SeleccionBloque");
                                        document.getElementById('submit').disabled=false;
                                    }
                                }
                                else
                                {
                                    jsOcultar("SeleccionBloque");
                                    document.getElementById('submit').disabled=false;
                                }
                            }
                        }
                    });
                }
    }

    function ValidarBloqueProfeM (parametro) {

        var div=document.getElementById('capaValidarProfM').value;
        var capa=document.getElementById(div+'_M').value;
        var prof=document.getElementById('nomApeM').value;
        var ced=document.getElementById('ciM').value;
        var ci2=document.getElementById("ci2M").value;
        var ci3=document.getElementById("ci3M").value;
        var aula=document.getElementById('aulaM').value;
        var periodo=document.getElementById('periodoM').value;
        var materia=document.getElementById('materiaM').value;
        var seccion=document.getElementById('seccionM').value;

        if (ced==0)
        {
            document.getElementById("ci2M").disabled=true;
            $("#ci2M").val("");
            $("#nomApe2M").val("");
            $("#ci3M").val("");
            $("#nomApe3M").val("");
        }

        if (ci2==0)
        {
            document.getElementById("ci3M").disabled=true;
            $("#ci3M").val("");
        }

        if (ced!=0)
        {
            document.getElementById('ci2M').disabled=false;

            if (ci2!=0)
            {
                document.getElementById('ci3M').disabled=false;

                if (ced==ci2 || ci2==ci3 || ced==ci3)
                {
                    jsMostrar("SeleccionBloqueM");

                    mostrarPrompt("No puede colocar un profesor 2 veces en el mismo bloque", "SeleccionBloqueM", "red");

                    document.getElementById('submitM').disabled=true;
                }
                else
                {
                    jsOcultar("SeleccionBloqueM");
                    document.getElementById('submitM').disabled=false;
                }

                if (ci3!=0)
                {
                    if (ced==ci2 || ci2==ci3 || ced==ci3)
                    {
                        jsMostrar("SeleccionBloqueM");

                        mostrarPrompt("No puede colocar un profesor 2 veces en el mismo bloque", "SeleccionBloqueM", "red");

                        document.getElementById('submitM').disabled=true;
                    }
                    else
                    {
                        jsOcultar("SeleccionBloqueM");
                        document.getElementById('submitM').disabled=false;
                    }
                }
            }
        }

        if (parametro=='algo')
        {
            if (ced==0)
            {
                mostrarPrompt("Campo Requerido","CiProfHorarioM","red")
            }
            else
            {
                mostrarPrompt("Valido","CiProfHorarioM","green")
            }
        }
        if (parametro=='algo2')
        {
            if (aula==0)
            {
                mostrarPrompt("Campo Requerido","AulaHorarioM","red")
            }
            else
            {
                mostrarPrompt("Valido","AulaHorarioM","green")
            }
        }
        if (parametro=='algo3')
        {
            if (materia==0)
            {
                mostrarPrompt("Campo Requerido","CodMatHorarioM","red")
            }
            else
            {
                mostrarPrompt("Valido","CodMatHorarioM","green")
            }
        }

        document.getElementById('submitM').disabled=true;
        $('#valorAjaxProfM').val("");

            if (capa==0)
            {
                $('#submitM').val("Marcar Bloque");
            }
            else
            {
                $('#submitM').val("Desmarcar Bloque");
            }

            if (ced!="" && aula!="" && materia!="" && seccion!="")
            {
                //alert("cedula="+ced+" aula="+aula+" materia="+materia+" seccion="+seccion);

                $.ajax({
                    type:'POST',
                    url:'disponibilidad_profesor.php',
                    data:'ci='+ced+'&aula='+aula+'&periodo='+periodo+'&div='+div+'&materia='+materia+'&seccion='+seccion,
                    success: function(valores){

                        if (valores==2)
                        {
                            jsMostrar("SeleccionBloqueM");
                            mostrarPrompt("El Profesor No esta Disponible", "SeleccionBloqueM", "red");
                        }

                        if (valores==0)
                        {
                            jsMostrar("SeleccionBloqueM");
                            mostrarPrompt("El aula ya esta ocupada", "SeleccionBloqueM", "red");
                        }

                        if (valores==1)
                        {
                            if (ci2!=0 || ci3!=0)
                                {
                                    if (ced==ci2 || ced==ci3 || ci2==ci3)
                                    {
                                        document.getElementById('submitM').disabled=true;
                                        mostrarPrompt("No puede colocar un profesor 2 veces en el mismo bloque", "SeleccionBloqueM", "red");
                                    }
                                    else
                                    {
                                        jsOcultar("SeleccionBloqueM");
                                        document.getElementById('submitM').disabled=false;
                                    }
                                }
                                else
                                {
                                    jsOcultar("SeleccionBloqueM");
                                    document.getElementById('submitM').disabled=false;
                                }
                        }
                    }
                });
            }
    }

    function marcarBloque()
    {
        var div=document.getElementById('capaValidarProf').value;
        var capa=document.getElementById(div).value;
        var materia=document.getElementById('materia').value;
        var aula=document.getElementById('aula').value;
        var ced=document.getElementById('ci').value;
        var ced2=document.getElementById('ci2').value;
        var ced3=document.getElementById('ci3').value;
        var prof=document.getElementById('nomApe').value;
        var prof2=document.getElementById('nomApe2').value;
        var prof3=document.getElementById('nomApe3').value;

        if (ced2=="")
        {
            ced2=0;
        }
        if (ced3=="")
        {
            ced3=0;
        }

        var val=capa.split(" ");
        var p=prof.split(" ");
        var p2=prof2.split(" ");
        var p3=prof3.split(" ");

        if (val[0]==0)
        {
            $('#submit').val("Desmarcar Bloque");
            $('#'+div).removeClass('boton_horasH').addClass('seleccionadoH');
            $('#'+div).val(1+" "+materia+" "+aula+" "+ced+" "+ced2+" "+ced3);

            if (ced2==0)
            {
                $('#'+div).html(p[0]+" "+p[1]+"<br>"+materia+"<br>"+aula);
            }
            if (ced3==0 && ced2!=0)
            {
                $('#'+div).html(p[0]+" "+p[1]+"<br>"+p2[0]+" "+p2[1]+"<br>"+materia+"<br>"+aula);
            }
            if (ced3!=0)
            {
                $('#'+div).html(p[0]+" "+p[1]+"<br>"+p2[0]+" "+p2[1]+"<br>"+p3[0]+" "+p3[1]+"<br>"+materia+"<br>"+aula);
            }
        }
        else
        {
            $('#submit').val("Marcar Bloque");
            $('#'+div).removeClass('seleccionadoH').addClass('boton_horasH');
            $('#'+div).val(0);
            $('#'+div).html("");
        }
    }

    function marcarBloqueM()
    {
        var div=document.getElementById('capaValidarProfM').value;
        var capa=document.getElementById(div+'_M').value;
        var materia=document.getElementById('materiaM').value;
        var aula=document.getElementById('aulaM').value;
        var ced=document.getElementById('ciM').value;
        var ced2=document.getElementById('ci2M').value;
        var ced3=document.getElementById('ci3M').value;
        var prof=document.getElementById('nomApeM').value;
        var prof2=document.getElementById('nomApe2M').value;
        var prof3=document.getElementById('nomApe3M').value;

        if (ced2=="")
        {
            ced2=0;
        }
        if (ced3=="")
        {
            ced3=0;
        }

        var val=capa.split(" ");
        var p=prof.split(" ");
        var p2=prof2.split(" ");
        var p3=prof3.split(" ");

        if (val[0]==0)
        {
            $('#submitM').val("Desmarcar Bloque");
            $('#'+div+'_M').removeClass('boton_horasH').addClass('seleccionadoH');
            $('#'+div+'_M').val(1+" "+materia+" "+aula+" "+ced+" "+ced2+" "+ced3);

            if (ced2==0)
            {
                $('#'+div+'_M').html(p[0]+" "+p[1]+"<br>"+materia+"<br>"+aula);
            }
            if (ced3==0 && ced2!=0)
            {
                $('#'+div+'_M').html(p[0]+" "+p[1]+"<br>"+p2[0]+" "+p2[1]+"<br>"+materia+"<br>"+aula);
            }
            if (ced3!=0)
            {
                $('#'+div+'_M').html(p[0]+" "+p[1]+"<br>"+p2[0]+" "+p2[1]+"<br>"+p3[0]+" "+p3[1]+"<br>"+materia+"<br>"+aula);
            }
        }
        else
        {
            //alert("esta verde y debe cambiar a color azul");
            $('#submitM').val("Marcar Bloque");
            $('#'+div+'_M').removeClass('seleccionadoH').addClass('boton_horasH');
            $('#'+div+'_M').val(0);
            $('#'+div+'_M').html("");
        }
    }

    function valiDiasR (parametro)
    {
        var seccion=document.getElementById('seccion').value;
        var periodo=document.getElementById('periodo').value;
        var ciclo=document.getElementById('ciclo').value;

        if (parametro)
        {
            if (seccion==0)
            {
                mostrarPrompt("Campo Requerido", "SeccionHorario", "red");
            }
            if (periodo==0)
            {
                mostrarPrompt("Campo Requerido", "PeriodoHorario", "red");
            }
            if (seccion!=0)
            {
                mostrarPrompt("Valido", "SeccionHorario", "green");
            }
            if (periodo!=0)
            {
                mostrarPrompt("Valido", "PeriodoHorario", "green");
            }
        }

        //alert(seccion+" -->"+periodo);

        if (seccion!=0 && periodo!=0)
        {
            $.ajax({
                type:'POST',
                url:'verificar_seccion_horario.php',
                data:'seccion='+seccion+'&periodo='+periodo+'&accion=registro',
                success: function(valores){

                    //alert(valores);

                    if (valores==1)
                    {
                        //existe
                        jsMostrar("salidaR_HORARIO");
                        mostrarPrompt("Ya se registro el horario de esta sección", "salidaR_HORARIO", "red");
                        mostrarPrompt("No Disponible", "PeriodoHorario", "red");
                        mostrarPrompt("No Disponible", "SeccionHorario", "red");

                        document.getElementById('boton_submit').disabled=true;

                        for (var i=1; i<=ciclo; i++)
                        {
                            document.getElementById('lunes_'+i).disabled=true;
                            document.getElementById('martes_'+i).disabled=true;
                            document.getElementById('miercoles_'+i).disabled=true;
                            document.getElementById('jueves_'+i).disabled=true;
                            document.getElementById('viernes_'+i).disabled=true;
                        };
                    }
                    if (valores==0)
                    {
                        //disponible
                        jsOcultar("salidaR_HORARIO");
                        mostrarPrompt("Valido", "PeriodoHorario", "green");
                        mostrarPrompt("Valido", "SeccionHorario", "green");
                        document.getElementById('boton_submit').disabled=false;

                        for (var i=1; i<=ciclo; i++)
                        {
                            document.getElementById('lunes_'+i).disabled=false;
                            document.getElementById('martes_'+i).disabled=false;
                            document.getElementById('miercoles_'+i).disabled=false;
                            document.getElementById('jueves_'+i).disabled=false;
                            document.getElementById('viernes_'+i).disabled=false;
                        };
                    }
                }
            });
        }
        else
        {
            document.getElementById('boton_submit').disabled=true;

            for (var i=1; i<=ciclo; i++)
            {
                document.getElementById('lunes_'+i).disabled=true;
                document.getElementById('martes_'+i).disabled=true;
                document.getElementById('miercoles_'+i).disabled=true;
                document.getElementById('jueves_'+i).disabled=true;
                document.getElementById('viernes_'+i).disabled=true;
            };
        }

    }

    function registrar_horario (num)
    {
        var periodo=document.getElementById('periodo').value;
        var seccion=document.getElementById('seccion').value;

        var arraylunes=[];
        var arraymartes=[];
        var arraymiercoles=[];
        var arrayjueves=[];
        var arrayviernes=[];
        var id_h=[];

        for (var i = 1; i <= num; i++)
        {
            var j = i-1;

            var lunes=document.getElementById('lunes_'+i).value;
            var martes=document.getElementById('martes_'+i).value;
            var miercoles=document.getElementById('miercoles_'+i).value;
            var jueves=document.getElementById('jueves_'+i).value;
            var viernes=document.getElementById('viernes_'+i).value;
            var horas=document.getElementById('id_'+i).value;

            arraylunes[j]='lunes_'+i+' '+lunes;
            arraymartes[j]='martes_'+i+' '+martes;
            arraymiercoles[j]='miercoles_'+i+' '+miercoles;
            arrayjueves[j]='jueves_'+i+' '+jueves;
            arrayviernes[j]='viernes_'+i+' '+viernes;
            id_h[j]=horas;
        };

        //alert("lunes="+arraylunes+" "+arraylunes[0]);

        window.location.href="registrar_horas.php?id_h="+id_h+"&periodo="+periodo+"&seccion="+seccion+"&ciclo="+num+"&lunes="+arraylunes+"&martes="+arraymartes+"&miercoles="+arraymiercoles+"&jueves="+arrayjueves+"&viernes="+arrayviernes;
    }

    function registrar_horario_M (num)
    {
        var idPeriodo=document.getElementById('idPeriodo').value;
        var idSeccion=document.getElementById('idSeccion').value;

        var arraylunes=[];
        var arraymartes=[];
        var arraymiercoles=[];
        var arrayjueves=[];
        var arrayviernes=[];
        var id_h=[];

        for (var i = 1; i <= num; i++)
        {
            var j = i-1;

            var lunes=document.getElementById('lunes_'+i+'_M').value;
            var martes=document.getElementById('martes_'+i+'_M').value;
            var miercoles=document.getElementById('miercoles_'+i+'_M').value;
            var jueves=document.getElementById('jueves_'+i+'_M').value;
            var viernes=document.getElementById('viernes_'+i+'_M').value;
            var horas=document.getElementById('id_'+i+'_M').value;

            arraylunes[j]='lunes_'+i+' '+lunes;
            arraymartes[j]='martes_'+i+' '+martes;
            arraymiercoles[j]='miercoles_'+i+' '+miercoles;
            arrayjueves[j]='jueves_'+i+' '+jueves;
            arrayviernes[j]='viernes_'+i+' '+viernes;
            id_h[j]=horas;
        };

        //alert("lunes="+arraylunes+" "+arraylunes[0]);

        window.location.href="modifica_horarios.php?id_h="+id_h+"&idPeriodo="+idPeriodo+"&idSeccion="+idSeccion+"&ciclo="+num+"&lunes="+arraylunes+"&martes="+arraymartes+"&miercoles="+arraymiercoles+"&jueves="+arrayjueves+"&viernes="+arrayviernes;
    }

    function mostrarHorario (data)
    {
        if (data=='materia')
        {
            document.getElementById('materia1').checked=true;

            $('#consulta_materias').show();
            $('#registro_materias').hide();
            $('#consulta_secciones').hide();
            $('#registro_secciones').hide();
            $('#consulta_horas').hide();
            $('#registro_horas').hide();
            $('#consulta_disponibilidad').hide();
            $('#registro_disponibilidad').hide();
            $('#consulta_aulas').hide();
            $('#registro_aulas').hide();
        }
        if (data=='secciones')
        {
            document.getElementById('secciones3').checked=true;

            $('#consulta_materias').hide();
            $('#registro_materias').hide();
            $('#consulta_secciones').show();
            $('#registro_secciones').hide();
            $('#consulta_horas').hide();
            $('#registro_horas').hide();
            $('#consulta_disponibilidad').hide();
            $('#registro_disponibilidad').hide();
            $('#consulta_aulas').hide();
            $('#registro_aulas').hide();
        }
        if (data=='horas')
        {
            document.getElementById('horas2').checked=true;

            $('#consulta_materias').hide();
            $('#registro_materias').hide();
            $('#consulta_secciones').hide();
            $('#registro_secciones').hide();
            $('#consulta_horas').show();
            $('#registro_horas').hide();
            $('#consulta_disponibilidad').hide();
            $('#registro_disponibilidad').hide();
            $('#consulta_aulas').hide();
            $('#registro_aulas').hide();
        }
        if (data=='disponibilidad')
        {
            document.getElementById('disponibilidad4').checked=true;
            document.getElementById('boton_submit').disabled=true;

            $('#consulta_materias').hide();
            $('#registro_materias').hide();
            $('#consulta_secciones').hide();
            $('#registro_secciones').hide();
            $('#consulta_horas').hide();
            $('#registro_horas').hide();
            $('#consulta_disponibilidad').show();
            $('#registro_disponibilidad').hide();
            $('#consulta_aulas').hide();
            $('#registro_aulas').hide();
        }

        if (data=='aulas')
        {
            document.getElementById('aulas5').checked=true;

            $('#consulta_materias').hide();
            $('#registro_materias').hide();
            $('#consulta_secciones').hide();
            $('#registro_secciones').hide();
            $('#consulta_horas').hide();
            $('#registro_horas').hide();
            $('#consulta_disponibilidad').hide();
            $('#registro_disponibilidad').hide();
            $('#consulta_aulas').show();
            $('#registro_aulas').hide();
        }
    }

    function N_usuario(){

        $('#miGestionUsuario').hide();

        $('#ru').show();

    }

    function N_hora(){

        $('#consulta_horas').hide();

        $('#registro_horas').show();

    }

    function N_horario(){

        $('#consulta_horarios').hide();
        $('#registro_horarios').show();

        valiDiasR();
    }

    function N_tecnologico(){

        $('#consulta_tecnologico').hide();

        $('#registro_tecnologico').show();

    }

    function N_seccion(){

        $('#consulta_secciones').hide();

        $('#registro_secciones').show();

    }

    function N_materia(){

        $('#consulta_materias').hide();

        $('#registro_materias').show();
    }

    function N_personal(){

        $('#miGestionPersonal').hide();

        $('#regPersonal').show();

    }

    function N_planificacion(){

        $('#consulta_planificacion').hide();

        $('#registro_planificacion').show();
    }

    function N_diario(){

        $('#consulta_registroDiario').hide();

        $('#registro_registroDiario').show();
    }

    function N_aula()
    {
        $('#consulta_aulas').hide();

        $('#registro_aulas').show();
    }

    function N_disponibilidad(){

        $('#consulta_disponibilidad').hide();

        $('#registro_disponibilidad').show();
    }

    function N_tipo_usuario(){

        $('#consulta_tipo_usuario').hide();

        $('#registro_tipo_usu').show();

    }

    function Otro()
    {
       window.location.href="tipo_usuario.php";
    }

   /* function ajax_get(opcion){

                    $('#slideshow').hide();
                    $('#miPersonal').hide();
                //  CONFIGURACION
                    $('#misUsuarios').hide();
                    $('#miGestionUsuario').hide();
                    $('#ru').hide();
                //  FIN CONFIGURACION
                    $('#centro_principal').show();

          if (window.XMLHttpRequest)
            {
              conexion=new XMLHttpRequest();
            }
          else
            {
              conexion=new ActiveXObject("Microsoft.XMLHTTP");
            }

            conexion.onreadystatechange=function()
            {
              if (conexion.readyState==4 && conexion.status==200)
              {
                document.getElementById("centro_principal").innerHTML=conexion.responseText;
              }
            }

            conexion.open("POST","ajax.php?ajax="+opcion,true);
            conexion.send();
        };*/


        $('#dataTables-example').DataTable({
              responsive: true
        });

        $('#dataTables-example2').DataTable({
              responsive: true
        });

        $('#dataTables-example3').DataTable({
              responsive: true
        });

        $('#dataTables-example4').DataTable({
              responsive: true
        });

        $('#nueva_tabla').DataTable({
              responsive: true
        });

    function detalleUsuario(id){

        var url='detalle_usuario.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_usu='+id,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_usuario').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    };

    function detalleDisponibilidad(id_personal,id_periodo){

        var url='detalle_disponibilidad.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_personal='+id_personal+'&id_periodo='+id_periodo,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_disponibilidad').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    };

    function detalleTipoUsuario(id){

        var url='detalle_tipo_usuario.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_usu='+id,
            success: function(valores){
                datos=eval(valores);

                $('#nombre_tipoD').val(datos[0]);

                 if (datos[1]=='A-0-0-0')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='0-E-0-0')
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='0-0-M-0')
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='0-0-0-I')
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=false;

                    }
                if (datos[1]=='A-E-0-0')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;

                    }
                if (datos[1]=='A-0-M-0')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='A-0-0-I')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='0-E-M-0')
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='0-E-0-I')
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='0-0-M-I')
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='A-E-M-0')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='A-E-0-I')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='A-0-M-I')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='0-E-M-I')
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=false;
                    }
                if (datos[1]=='A-E-M-I')
                    {
                        document.getElementById("pach1D").checked=true;
                        document.getElementById("pach2D").checked=true;
                        document.getElementById("pach3D").checked=true;
                        document.getElementById("pach4D").checked=true;
                        document.getElementById("pach5D").checked=true;

                    }
                if (datos[1]==0)
                    {
                        document.getElementById("pach1D").checked=false;
                        document.getElementById("pach2D").checked=false;
                        document.getElementById("pach3D").checked=false;
                        document.getElementById("pach4D").checked=false;
                        document.getElementById("pach5D").checked=false;
                    }

                    // PROYECTOS

                if (datos[2]=='A-0-0-0')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='0-E-0-0')
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='0-0-M-0')
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='0-0-0-I')
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='A-E-0-0')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='A-0-M-0')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='A-0-0-I')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='0-E-M-0')
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='0-E-0-I')
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='0-0-M-I')
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='A-E-M-0')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='A-E-0-I')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='A-0-M-I')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='0-E-M-I')
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=false;
                    }
                if (datos[2]=='A-E-M-I')
                    {
                        document.getElementById("pacp1D").checked=true;
                        document.getElementById("pacp2D").checked=true;
                        document.getElementById("pacp3D").checked=true;
                        document.getElementById("pacp4D").checked=true;
                        document.getElementById("pacp5D").checked=true;
                    }
                if (datos[2]==0)
                    {
                        document.getElementById("pacp1D").checked=false;
                        document.getElementById("pacp2D").checked=false;
                        document.getElementById("pacp3D").checked=false;
                        document.getElementById("pacp4D").checked=false;
                        document.getElementById("pacp5D").checked=false;
                    }

                    // CONVENIOS

                if (datos[3]=='A-0-0-0')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='0-E-0-0')
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='0-0-M-0')
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='0-0-0-I')
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='A-E-0-0')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='A-0-M-0')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='A-0-0-I')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='0-E-M-0')
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='0-E-0-I')
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='0-0-M-I')
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='A-E-M-0')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='A-E-0-I')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='A-0-M-I')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='0-E-M-I')
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=false;
                    }
                if (datos[3]=='A-E-M-I')
                    {
                        document.getElementById("paconv1D").checked=true;
                        document.getElementById("paconv2D").checked=true;
                        document.getElementById("paconv3D").checked=true;
                        document.getElementById("paconv4D").checked=true;
                        document.getElementById("paconv5D").checked=true;
                    }
                if (datos[3]==0)
                    {
                        document.getElementById("paconv1D").checked=false;
                        document.getElementById("paconv2D").checked=false;
                        document.getElementById("paconv3D").checked=false;
                        document.getElementById("paconv4D").checked=false;
                        document.getElementById("paconv5D").checked=false;

                    }

                // INVENTARIO

                if (datos[4]=='A-0-0-0')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='0-E-0-0')
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='0-0-M-0')
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='0-0-0-I')
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='A-E-0-0')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='A-0-M-0')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='A-0-0-I')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='0-E-M-0')
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='0-E-0-I')
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='0-0-M-I')
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='A-E-M-0')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='A-E-0-I')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='A-0-M-I')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='0-E-M-I')
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=false;
                    }
                if (datos[4]=='A-E-M-I')
                    {
                        document.getElementById("padi1D").checked=true;
                        document.getElementById("padi2D").checked=true;
                        document.getElementById("padi3D").checked=true;
                        document.getElementById("padi4D").checked=true;
                        document.getElementById("padi5D").checked=true;
                    }
                if (datos[4]==0)
                    {
                        document.getElementById("padi1D").checked=false;
                        document.getElementById("padi2D").checked=false;
                        document.getElementById("padi3D").checked=false;
                        document.getElementById("padi4D").checked=false;
                        document.getElementById("padi5D").checked=false;
                    }

                // MAQUINAS

                if (datos[5]=='A-0-0-0')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='0-E-0-0')
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='0-0-M-0')
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='0-0-0-I')
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='A-E-0-0')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='A-0-M-0')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='A-0-0-I')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='0-E-M-0')
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='0-E-0-I')
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='0-0-M-I')
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='A-E-M-0')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='A-E-0-I')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='A-0-M-I')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='0-E-M-I')
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=false;
                    }
                if (datos[5]=='A-E-M-I')
                    {
                        document.getElementById("padm1D").checked=true;
                        document.getElementById("padm2D").checked=true;
                        document.getElementById("padm3D").checked=true;
                        document.getElementById("padm4D").checked=true;
                        document.getElementById("padm5D").checked=true;
                    }
                if (datos[5]==0)
                    {
                        document.getElementById("padm1D").checked=false;
                        document.getElementById("padm2D").checked=false;
                        document.getElementById("padm3D").checked=false;
                        document.getElementById("padm4D").checked=false;
                        document.getElementById("padm5D").checked=false;
                    }

                    // PERSONAL

                if (datos[7]=='A-0-0-0')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='0-E-0-0')
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='0-0-M-0')
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='0-0-0-I')
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='A-E-0-0')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='A-0-M-0')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='A-0-0-I')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='0-E-M-0')
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='0-E-0-I')
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='0-0-M-I')
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='A-E-M-0')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='A-E-0-I')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='A-0-M-I')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='0-E-M-I')
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=false;
                    }
                if (datos[7]=='A-E-M-I')
                    {
                        document.getElementById("padp1D").checked=true;
                        document.getElementById("padp2D").checked=true;
                        document.getElementById("padp3D").checked=true;
                        document.getElementById("padp4D").checked=true;
                        document.getElementById("padp5D").checked=true;
                    }
                if (datos[7]==0)
                    {
                        document.getElementById("padp1D").checked=false;
                        document.getElementById("padp2D").checked=false;
                        document.getElementById("padp3D").checked=false;
                        document.getElementById("padp4D").checked=false;
                        document.getElementById("padp5D").checked=false;
                    }

                // USUARIOS
                document.getElementById("pconusiD").checked=false;
                document.getElementById("pconunoD").checked=false;
                // BASE DE DATOS
                document.getElementById("BDsiD").checked=false;
                document.getElementById("BDnoD").checked=false;
                // AUDITORIA
                document.getElementById("auditoriasiD").checked=false;
                document.getElementById("auditorianoD").checked=false;

                if (datos[8]=='si')
                    {
                        document.getElementById("pconusiD").checked=true;
                    }
                if (datos[8]=='no')
                    {
                        document.getElementById("pconunoD").checked=true;
                    }
                // BASE DE DATOS

                if (datos[9]=='si')
                    {
                        document.getElementById("BDsiD").checked=true;
                    }
                if (datos[9]=='no')
                    {
                        document.getElementById("BDnoD").checked=true;
                    }

                // AUDITORIA

                if (datos[10]=='si')
                    {
                        document.getElementById("auditoriasiD").checked=true;
                    }
                if (datos[10]=='no')
                    {
                        document.getElementById("auditorianoD").checked=true;
                    }

                $('#detalle_tipo_usuario').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    };

    function detallePersonal(id){

        var url='detalle_personal.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){

                $('#detalle_per').html(valores);

                $('#detalle_persona').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    };

    function editar_horario(idSeccion, idPeriodo){

        var url='modificar_horario.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_seccion='+idSeccion+'&id_periodo='+idPeriodo,
            success: function(valores){
                datos=eval(valores);

                var ciclo=document.getElementById('ciclo_M').value;

                //alert("ciclo Original="+ciclo+" ciclo Busqueda="+datos[0]+" periodo="+datos[2]+" dia="+datos[3]+" aula="+datos[4]+" nomApe="+datos[5]+" codigoMateria"+datos[6]);

                for (var i=1; i<=ciclo; i++)
                {
                    $('#lunes_'+i+'_M').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#lunes_'+i+'_M').val(0);
                    $('#lunes_'+i+'_M').html("");

                    $('#martes_'+i+'_M').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#martes_'+i+'_M').val(0);
                    $('#martes_'+i+'_M').html("");

                    $('#miercoles_'+i+'_M').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#miercoles_'+i+'_M').val(0);
                    $('#miercoles_'+i+'_M').html("");

                    $('#jueves_'+i+'_M').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#jueves_'+i+'_M').val(0);
                    $('#jueves_'+i+'_M').html("");

                    $('#viernes_'+i+'_M').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#viernes_'+i+'_M').val(0);
                    $('#viernes_'+i+'_M').html("");
                }

                $('#seccionM').val(datos[1]);
                $('#periodoM').val(datos[2]);
                $('#idSeccion').val(idSeccion);
                $('#idPeriodo').val(idPeriodo);

                for (var i=1; i<=datos[0]; i++)
                {
                    var j=i-1;

                    var nom_ci=datos[5][j].split(" ");

                    if (datos[8][j]==0)
                    {
                       var nom_ci2=[];
                       nom_ci2[2]=0;
                    }
                    else
                    {
                        var nom_ci2=datos[8][j].split(" ");
                    }

                    if (datos[9][j]==0)
                    {
                       var nom_ci3=[];
                       nom_ci3[2]=0;
                    }
                    else
                    {
                        var nom_ci3=datos[9][j].split(" ");
                    }

                    $('#'+datos[3][j]+'_M').removeClass('boton_horasH').addClass('seleccionadoH');
                    $('#'+datos[3][j]+'_M').val(1+" "+datos[6][j]+" "+datos[4][j]+" "+nom_ci[2]+" "+nom_ci2[2]+" "+nom_ci3[2]+" "+datos[7][j]);


                    if (datos[8][j]==0)
                    {
                        $('#'+datos[3][j]+'_M').html(nom_ci[0]+' '+nom_ci[1]+'<br>'+datos[6][j]+'<br>'+datos[4][j]);
                    }
                    if (datos[9][j]==0 && datos[8][j]!=0)
                    {
                        $('#'+datos[3][j]+'_M').html(nom_ci[0]+' '+nom_ci[1]+'<br>'+nom_ci2[0]+' '+nom_ci2[1]+'<br>'+datos[6][j]+'<br>'+datos[4][j]);
                    }
                    if (datos[9][j]!=0 && datos[8][j]!=0)
                    {
                        $('#'+datos[3][j]+'_M').html(nom_ci[0]+' '+nom_ci[1]+'<br>'+nom_ci2[0]+' '+nom_ci2[1]+'<br>'+nom_ci3[0]+' '+nom_ci3[1]+'<br>'+datos[6][j]+'<br>'+datos[4][j]);
                    }

                }

                $('#modif_horario').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function detalleHorario(idSeccion, idPeriodo){

        var url='modificar_horario.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_seccion='+idSeccion+'&id_periodo='+idPeriodo,
            success: function(valores){
                datos=eval(valores);

                var ciclo=document.getElementById('ciclo_D').value;

                //alert("ciclo Original="+ciclo+" ciclo Busqueda="+datos[0]+" periodo="+datos[2]+" dia="+datos[3]+" aula="+datos[4]+" nomApe="+datos[5]+" codigoMateria"+datos[6]);

                for (var i=1; i<=ciclo; i++)
                {
                    $('#lunes_'+i+'_D').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#lunes_'+i+'_D').val(0);
                    $('#lunes_'+i+'_D').html("");

                    $('#martes_'+i+'_D').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#martes_'+i+'_D').val(0);
                    $('#martes_'+i+'_D').html("");

                    $('#miercoles_'+i+'_D').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#miercoles_'+i+'_D').val(0);
                    $('#miercoles_'+i+'_D').html("");

                    $('#jueves_'+i+'_D').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#jueves_'+i+'_D').val(0);
                    $('#jueves_'+i+'_D').html("");

                    $('#viernes_'+i+'_D').removeClass('seleccionadoH').addClass('boton_horasH');
                    $('#viernes_'+i+'_D').val(0);
                    $('#viernes_'+i+'_D').html("");
                }

                $('#seccionD').val(datos[1]);
                $('#periodoD').val(datos[2]);

                for (var i=1; i<=datos[0]; i++)
                {
                    var j=i-1;

                    var nom_ci=datos[5][j].split(" ");

                    if (datos[8][j]==0)
                    {
                       var nom_ci2=[];
                       nom_ci2[2]=0;
                    }
                    else
                    {
                        var nom_ci2=datos[8][j].split(" ");
                    }

                    if (datos[9][j]==0)
                    {
                       var nom_ci3=[];
                       nom_ci3[2]=0;
                    }
                    else
                    {
                        var nom_ci3=datos[9][j].split(" ");
                    }

                    $('#'+datos[3][j]+'_D').removeClass('boton_horasH').addClass('seleccionadoH');

                    if (datos[8][j]==0)
                    {
                        $('#'+datos[3][j]+'_D').html(nom_ci[0]+' '+nom_ci[1]+'<br>'+datos[6][j]+'<br>'+datos[4][j]);
                    }
                    if (datos[9][j]==0 && datos[8][j]!=0)
                    {
                        $('#'+datos[3][j]+'_D').html(nom_ci[0]+' '+nom_ci[1]+'<br>'+nom_ci2[0]+' '+nom_ci2[1]+'<br>'+datos[6][j]+'<br>'+datos[4][j]);
                    }
                    if (datos[9][j]!=0 && datos[8][j]!=0)
                    {
                        $('#'+datos[3][j]+'_D').html(nom_ci[0]+' '+nom_ci[1]+'<br>'+nom_ci2[0]+' '+nom_ci2[1]+'<br>'+nom_ci3[0]+' '+nom_ci3[1]+'<br>'+datos[6][j]+'<br>'+datos[4][j]);
                    }
                }

                $('#modif_horarioD').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_planificacion(id){

        var url='modificar_planificacion.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_pla='+id,
            success: function(valores){
                datos=eval(valores);

                $('#id').val(id);
                $('#nacionalidad_planif_M').val(datos[0])
                $('#ci_planif_M').val(datos[1]);
                $('#nombres_usu_planif_M').val(datos[2]);
                $('#apellidos_usu_planif_M').val(datos[3]);
                $('#nom_act_M').val(datos[4]);
                $('#fecha_act_M').val(datos[5]);
                $('#id_per').val(datos[6]);

                $('#modif_planif').modal({
                    show:true,
                    backdrop:'static'
                });

                $("#fecha_act_M").attr('readonly',true);

                $("#fecha_act_M").datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate: datos[5],
                    useCurrent: true,
                    pickTime: false,
                    showTodayButton: true,
                });

                    return false;
            }
        });
    }

    function editar_disponibilidad(id_persona,id_periodo){

        //alert("persona="+id_persona+" periodo="+id_periodo);

        var url='modificar_disponibilidad.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_persona='+id_persona+"&id_periodo="+id_periodo,
            success: function(valores){
                datos=eval(valores);

                $('#id_personal_M').val(id_persona);
                $('#id_periodo_M').val(id_periodo);
                $('#nacionalidad_M').val(datos[1]);
                $('#ci_disp_M').val(datos[2])
                $('#nom_ape_M').val(datos[3]);
                $('#periodo_M').val(datos[4]);

                for (var i = 1; i <= datos[0]; i++)
                {
                    var j=i-1;

                    // LUNES
                    $('#lunes_'+i+'_M').val(datos[5][j]);
                    if (datos[5][j]==1)
                    {
                        $('#lunes_'+i+'_M').removeClass("boton_horas").addClass("seleccionado");
                        //alert("lunes_"+i+"= "+datos[5][j]+" SELECCIONADO");
                    }
                    if (datos[5][j]==0)
                    {
                        $('#lunes_'+i+'_M').removeClass("seleccionado").addClass("boton_horas");
                        //alert("lunes_"+i+"= "+datos[5][j]+" NO SELECCIONADO");
                    }

                    // MARTES
                    $('#martes_'+i+'_M').val(datos[6][j]);
                    if (datos[6][j]==1)
                    {
                        $('#martes_'+i+'_M').removeClass("boton_horas").addClass("seleccionado");
                    }
                    else
                    {
                        $('#martes_'+i+'_M').removeClass("seleccionado").addClass("boton_horas");
                    }

                    // MIERCOLES
                    $('#miercoles_'+i+'_M').val(datos[7][j]);
                    if (datos[7][j]==1)
                    {
                        $('#miercoles_'+i+'_M').removeClass("boton_horas").addClass("seleccionado");
                    }
                    else
                    {
                        $('#miercoles_'+i+'_M').removeClass("seleccionado").addClass("boton_horas");
                    }

                    // JUEVES
                    $('#jueves_'+i+'_M').val(datos[8][j]);
                    if (datos[8][j]==1)
                    {
                        $('#jueves_'+i+'_M').removeClass("boton_horas").addClass("seleccionado");
                    }
                    else
                    {
                        $('#jueves_'+i+'_M').removeClass("seleccionado").addClass("boton_horas");
                    }

                    // VIERNES
                    $('#viernes_'+i+'_M').val(datos[9][j]);
                    if (datos[9][j]==1)
                    {
                        $('#viernes_'+i+'_M').removeClass("boton_horas").addClass("seleccionado");
                    }
                    else
                    {
                        $('#viernes_'+i+'_M').removeClass("seleccionado").addClass("boton_horas");
                    }

                    $('#id_disponibilidad_'+i+'_M').val(datos[10][j]);
                };

                $('#modif_disp').modal({
                    show:true,
                    backdrop:'static'
                });

                validarPERIODO_M();
                validarCI_M();
                return false;
            }
        });
    }

    function editar_seccion(id){

        var url='modifica_seccion.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                datos=eval(valores);

                $('#id_seccion').val(id);
                $('#anio_M').val(datos[0])
                $('#trayecto_s_M').val(datos[1]);
                $('#seccion_M').val(datos[2]);
                $('#sede_M').val(datos[3]);
                $('#pnf_M').val(datos[4]);

                $('#modif_seccion').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_materia(id){

        var url='modifica_materia.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                datos=eval(valores);

                $('#id').val(id);
                $('#codigo_M').val(datos[0])
                $('#nombre_M').val(datos[1]);
                $('#trayecto_M').val(datos[2]);
                $('#horas_M').val(datos[3]);

                $('#modif_materia').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_tecnologico(id){

        var url='modificar_tecnologico.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                datos=eval(valores);

                $('#id').val(id);
                $('#tituloM').val(datos[0]);
                $('#codigoM').val(datos[1]);
                $('#regimenM').val(datos[2]);
                $('#estadoM').val(datos[3]);
                $('#municipioM').html(datos[42]);
                $('#municipioM').val(datos[4]);
                $('#parroquiaM').val(datos[5]);
                $('#sectorM').val(datos[6]);
                $('#pnfM').val(datos[7]);
                $('#trayectoM').val(datos[8]);
                $('#seccionM').val(datos[9]);
                $('#periodoM').val(datos[10]);
                $('#nacEstM').val(datos[11]);
                $('#ciEstM').val(datos[12]);
                $('#nomEstM').val(datos[13]);
                $('#apeEstM').val(datos[14]);
                $('#codTlfM').val(datos[15]);
                $('#tlfEstM').val(datos[16]);
                $('#correoEstM').val(datos[17]);
                $('#especialidadM').val(datos[18]);
                $('#nacEst2M').val(datos[19]);
                $('#ciEst2M').val(datos[20]);
                $('#nomEst2M').val(datos[21]);
                $('#apeEst2M').val(datos[22]);
                $('#codTlf2M').val(datos[23]);
                $('#tlfEst2M').val(datos[24]);
                $('#correoEst2M').val(datos[25]);
                $('#especialidad2M').val(datos[26]);
                $('#nacEst3M').val(datos[27]);
                $('#ciEst3M').val(datos[28]);
                $('#nomEst3M').val(datos[29]);
                $('#apeEst3M').val(datos[30]);
                $('#codTlf3M').val(datos[31]);
                $('#tlfEst3M').val(datos[32]);
                $('#correoEst3M').val(datos[33]);
                $('#especialidad3M').val(datos[34]);
                $('#descripcionM').val(datos[35]);
                $('#aportesM').val(datos[36]);
                $('#integracionM').val(datos[37]);
                $('#planNacionalM').val(datos[38]);
                $('#idEst1').val(datos[39]);
                $('#idEst2').val(datos[40]);
                $('#idEst3').val(datos[41]);

                if (datos[20]==null)
                {
                    document.getElementById("integrante2M").checked=false;

                    document.getElementById("nacEst2M").disabled=true;
                    document.getElementById("ciEst2M").disabled=true;
                    document.getElementById("nomEst2M").disabled=true;
                    document.getElementById("apeEst2M").disabled=true;
                    document.getElementById("codTlf2M").disabled=true;
                    document.getElementById("tlfEst2M").disabled=true;
                    document.getElementById("correoEst2M").disabled=true;
                    document.getElementById("especialidad2M").disabled=true;
                }
                else
                {
                    document.getElementById("integrante2M").checked=true;
                }

                if(datos[28]==null)
                {
                    document.getElementById("integrante3M").checked=false;

                    document.getElementById("nacEst3M").disabled=true;
                    document.getElementById("ciEst3M").disabled=true;
                    document.getElementById("nomEst3M").disabled=true;
                    document.getElementById("apeEst3M").disabled=true;
                    document.getElementById("codTlf3M").disabled=true;
                    document.getElementById("tlfEst3M").disabled=true;
                    document.getElementById("correoEst3M").disabled=true;
                    document.getElementById("especialidad3M").disabled=true;
                }
                else
                {
                    document.getElementById("integrante3M").checked=true;
                }


                $('#modif_tec').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_registro(id){

        var url='modificar_registro.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                datos=eval(valores);

                $('#id').val(id);
                $('#id_per').val(datos[0]);
                $('#observaciones_M').val(datos[1]);

                $('#modif_observaciones').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_usuario(id){

        var url='modificar_usuario.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_usu='+id,
            success: function(valores){
                datos=eval(valores);

                $('#id').val(datos[0]);
                $('#nac_usuM').val(datos[1]);
                $('#nac_usuM2').val(datos[1]);
                $('#ci_usuM').val(datos[2]);
                $('#nombres_usuM').val(datos[3]);
                $('#apellidos_usuM').val(datos[4]);
                $('#nombre_usuarioM').val(datos[5]);
                $('#tipoM').val(datos[6]);
                $('#preguntaM').val(datos[7]);
                $('#respuestaM').val(datos[8]);

                $('#modif_usuario').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_tipo_usuario(id){

        var url='modificar_tipo_usuario.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id_tipo='+id,
            success: function(valores){
                datos=eval(valores);

                $('#id').val(datos[0]);
                $('#nombre_tipoM').val(datos[1]);

                // HORARIOS

                if (datos[2]=='A-0-0-0')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='0-E-0-0')
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='0-0-M-0')
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='0-0-0-I')
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=false;

                    }
                if (datos[2]=='A-E-0-0')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;

                    }
                if (datos[2]=='A-0-M-0')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='A-0-0-I')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='0-E-M-0')
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='0-E-0-I')
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='0-0-M-I')
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='A-E-M-0')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='A-E-0-I')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='A-0-M-I')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='0-E-M-I')
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=false;
                    }
                if (datos[2]=='A-E-M-I')
                    {
                        document.getElementById("pach1M").checked=true;
                        document.getElementById("pach2M").checked=true;
                        document.getElementById("pach3M").checked=true;
                        document.getElementById("pach4M").checked=true;
                        document.getElementById("pach5M").checked=true;

                    }
                if (datos[2]==0)
                    {
                        document.getElementById("pach1M").checked=false;
                        document.getElementById("pach2M").checked=false;
                        document.getElementById("pach3M").checked=false;
                        document.getElementById("pach4M").checked=false;
                        document.getElementById("pach5M").checked=false;
                    }

                    // PROYECTOS

                if (datos[3]=='A-0-0-0')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='0-E-0-0')
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='0-0-M-0')
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='0-0-0-I')
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='A-E-0-0')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='A-0-M-0')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='A-0-0-I')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='0-E-M-0')
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='0-E-0-I')
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='0-0-M-I')
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='A-E-M-0')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='A-E-0-I')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='A-0-M-I')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='0-E-M-I')
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=false;
                    }
                if (datos[3]=='A-E-M-I')
                    {
                        document.getElementById("pacp1M").checked=true;
                        document.getElementById("pacp2M").checked=true;
                        document.getElementById("pacp3M").checked=true;
                        document.getElementById("pacp4M").checked=true;
                        document.getElementById("pacp5M").checked=true;
                    }
                if (datos[3]==0)
                    {
                        document.getElementById("pacp1M").checked=false;
                        document.getElementById("pacp2M").checked=false;
                        document.getElementById("pacp3M").checked=false;
                        document.getElementById("pacp4M").checked=false;
                        document.getElementById("pacp5M").checked=false;
                    }

                    // CONVENIOS

                if (datos[4]=='A-0-0-0')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='0-E-0-0')
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='0-0-M-0')
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='0-0-0-I')
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='A-E-0-0')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='A-0-M-0')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='A-0-0-I')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='0-E-M-0')
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='0-E-0-I')
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='0-0-M-I')
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='A-E-M-0')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='A-E-0-I')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='A-0-M-I')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='0-E-M-I')
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=false;
                    }
                if (datos[4]=='A-E-M-I')
                    {
                        document.getElementById("paconv1M").checked=true;
                        document.getElementById("paconv2M").checked=true;
                        document.getElementById("paconv3M").checked=true;
                        document.getElementById("paconv4M").checked=true;
                        document.getElementById("paconv5M").checked=true;
                    }
                if (datos[4]==0)
                    {
                        document.getElementById("paconv1M").checked=false;
                        document.getElementById("paconv2M").checked=false;
                        document.getElementById("paconv3M").checked=false;
                        document.getElementById("paconv4M").checked=false;
                        document.getElementById("paconv5M").checked=false;

                    }

                // INVENTARIO

                if (datos[5]=='A-0-0-0')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='0-E-0-0')
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='0-0-M-0')
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='0-0-0-I')
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='A-E-0-0')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='A-0-M-0')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='A-0-0-I')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='0-E-M-0')
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='0-E-0-I')
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='0-0-M-I')
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='A-E-M-0')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='A-E-0-I')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='A-0-M-I')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='0-E-M-I')
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=false;
                    }
                if (datos[5]=='A-E-M-I')
                    {
                        document.getElementById("padi1M").checked=true;
                        document.getElementById("padi2M").checked=true;
                        document.getElementById("padi3M").checked=true;
                        document.getElementById("padi4M").checked=true;
                        document.getElementById("padi5M").checked=true;
                    }
                if (datos[5]==0)
                    {
                        document.getElementById("padi1M").checked=false;
                        document.getElementById("padi2M").checked=false;
                        document.getElementById("padi3M").checked=false;
                        document.getElementById("padi4M").checked=false;
                        document.getElementById("padi5M").checked=false;
                    }

                // MAQUINAS

                if (datos[6]=='A-0-0-0')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='0-E-0-0')
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='0-0-M-0')
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='0-0-0-I')
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='A-E-0-0')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='A-0-M-0')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='A-0-0-I')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='0-E-M-0')
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='0-E-0-I')
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='0-0-M-I')
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='A-E-M-0')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='A-E-0-I')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='A-0-M-I')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='0-E-M-I')
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=false;
                    }
                if (datos[6]=='A-E-M-I')
                    {
                        document.getElementById("padm1M").checked=true;
                        document.getElementById("padm2M").checked=true;
                        document.getElementById("padm3M").checked=true;
                        document.getElementById("padm4M").checked=true;
                        document.getElementById("padm5M").checked=true;
                    }
                if (datos[6]==0)
                    {
                        document.getElementById("padm1M").checked=false;
                        document.getElementById("padm2M").checked=false;
                        document.getElementById("padm3M").checked=false;
                        document.getElementById("padm4M").checked=false;
                        document.getElementById("padm5M").checked=false;
                    }

                    // PERSONAL

                if (datos[8]=='A-0-0-0')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='0-E-0-0')
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='0-0-M-0')
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='0-0-0-I')
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='A-E-0-0')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='A-0-M-0')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='A-0-0-I')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='0-E-M-0')
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='0-E-0-I')
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='0-0-M-I')
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='A-E-M-0')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='A-E-0-I')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='A-0-M-I')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='0-E-M-I')
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=false;
                    }
                if (datos[8]=='A-E-M-I')
                    {
                        document.getElementById("padp1M").checked=true;
                        document.getElementById("padp2M").checked=true;
                        document.getElementById("padp3M").checked=true;
                        document.getElementById("padp4M").checked=true;
                        document.getElementById("padp5M").checked=true;
                    }
                if (datos[8]==0)
                    {
                        document.getElementById("padp1M").checked=false;
                        document.getElementById("padp2M").checked=false;
                        document.getElementById("padp3M").checked=false;
                        document.getElementById("padp4M").checked=false;
                        document.getElementById("padp5M").checked=false;
                    }

                // USUARIOS

                if (datos[9]=='si')
                    {
                        document.getElementById("pconusiM").checked=true;
                    }
                if (datos[9]=='no')
                    {
                        document.getElementById("pconunoM").checked=true;
                    }
                // BASE DE DATOS

                if (datos[10]=='si')
                    {
                        document.getElementById("BDsiM").checked=true;
                    }
                if (datos[10]=='no')
                    {
                        document.getElementById("BDnoM").checked=true;
                    }

                // AUDITORIA

                if (datos[11]=='si')
                    {
                        document.getElementById("auditoriasiM").checked=true;
                    }
                if (datos[11]=='no')
                    {
                        document.getElementById("auditorianoM").checked=true;
                    }

                $('#modif_tipo_usuario').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_convenio(id){

        var url='modifica_convenio.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
               $('#idmod').val(datos[0]);
                $('#titulomod').val(datos[1]);
                $('#ente1mod').val(datos[2]);
                $('#ente2mod').val(datos[3]);
                $('#contratantemod').val(datos[4]);

                $('#contratadomod').val(datos[5]);
                $('#fechaimod').val(datos[6]);
                $('#fechafmod').val(datos[7]);
                $('#clausulasmod').val(datos[8]);


                $('#modif_maquina').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

function detalleConvenio(id){

    var url='detalle_convenio.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'id_convenio='+id,
        success: function(valores){

            $('#detalle').html(valores);

            $('#detalle_convenio').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

  function reportandoConvenio(id){

        $('#aceptar_reporte_convenio').val(id);

        $('#agua_maq').modal({
            show:true,
            backdrop:'static'
        });
    };

    function reporteConvenio(){
        var id= document.getElementById('aceptar_reporte_convenio').value;
        window.open("pdf/reporte_convenio.php?id_maq='"+id+"'","_blank");

    }

     function eliminarConvenio(id){

        $('#aceptar_elim_convenio').val(id);
        $('#elim_pre').modal({
            show:true,
            backdrop:'static'
        });
            confirm_user();
    };

    function eliminar_MaquinaT(){

        var id = document.getElementById('aceptar_elim_maquinaT').value;

      window.location.href="elim_tipo_maquina.php?id_maq="+id;
    };

    function eliminarAula(id){

        $('#aceptar_elim_aula').val(id);

        $('#elim_aula').modal({
            show:true,
            backdrop:'static'
        });
            confirm_user();
    };


    function eliminarSeccion(id){

        $('#aceptar_elim_seccion').val(id);

        $('#elim_seccion').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function eliminarHorario(idSeccion, idPeriodo){

        $('#valorIdSeccion').val(idSeccion);
        $('#valorIdPeriodo').val(idPeriodo);

        $('#elim_horario').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function eliminar_Horario(){

        var idSeccion = document.getElementById('valorIdSeccion').value;
        var idPeriodo = document.getElementById('valorIdPeriodo').value;

        window.location.href="elim_horario.php?idSeccion="+idSeccion+"&idPeriodo="+idPeriodo;
    };

    function eliminar_Aula(){

        var id = document.getElementById('aceptar_elim_aula').value;
        window.location.href="elim_aula.php?id="+id;
    };

     function eliminar_Convenio(){

        var id = document.getElementById('aceptar_elim_convenio').value;

        window.location.href="elim_convenio.php?id="+id;
    };

    function mostrarClausula(id){

        var url='modifica_convenio.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
               $('#id_convenio').val(datos[0]);
             //  $('#id_clauC').val(datos[0]);
                $('#idconvenioClau1').val(datos[0]);
                $('#idconvenioClau2').val(datos[0]);
               $('#titulo_clau').val(datos[1]);
                $('#ente1_clau').val(datos[2]);
               $('#ente2_clau').val(datos[3]);
               $('#contratante_clau').val(datos[4]);
               $('#contratado_clau').val(datos[5]);
               $('#fechai_clau').val(datos[6]);
               $('#fechaf_clau').val(datos[7]);
                $('#c_clausulas').show();
                $('#consulta_insu').hide();

            }
        });

              $.ajax({
            type:'POST',
            url:'buscar_clausulas.php',
            data:'id='+id,
            success: function(valores){


                $('#tbody_consultaClau').html(valores);
                 $('#dataTables-exampleClausulas').DataTable({
              responsive: true
        });
            }
        });

    };


    function editar_clausula(id){

        var url='modifica_clausula.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                 var datos=eval(valores);
                $('#idclausulamod').val(datos[0]);

                $('#clausulamod').val(datos[1]);
                 $('#modif_clausula').modal({
                    show:true,
                    backdrop:'static'
                });

            }
        });
    }

    function editar_aula(id){

        var url='modificar_aula.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                 var datos=eval(valores);

                // alert(id);

                $('#id_aula').val(id);
                $('#nombre_aM').val(datos[0]);

                $('#modif_aula').modal({
                    show:true,
                    backdrop:'static'
                });

                return false;
            }
        });
    }

    function seguirClausula(id){

        var url='modifica_clausula.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                 var datos=eval(valores);
                $('#idclausulamodS').val(datos[0]);

                $('#seguimientomod').val(datos[2]);
                 $('#modif_seguimiento').modal({
                    show:true,
                    backdrop:'static'
                });

            }
        });
    }

    function eliminarClausula(id){

        $('#aceptar_elim_clausula').val(id);
        $('#elim_clau').modal({
            show:true,
            backdrop:'static'
        });
         confirm_user();
    };

     function eliminar_Clausula(){

        var id = document.getElementById('aceptar_elim_clausula').value;

        window.location.href="elim_clausula.php?id="+id;
    };


    function eliminar_Seccion(){

        var id = document.getElementById('aceptar_elim_seccion').value;

        window.location.href="elim_seccion.php?id="+id;
    };

    function editar_configuracionPer(id)
    {
        var url='modificar_cuentaPersonal.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);

                $('#id').val(id);
                $('#nac_usuC').val(datos[0]);
                $('#ci_usuC').val(datos[1]);
                $('#nombres_usuC').val(datos[2]);
                $('#apellidos_usuC').val(datos[3]);
                $('#correoC').val(datos[4]);
                $('#cod_tlfC').val(datos[5])
                $('#num_contC').val(datos[6]);
                $('#fecha_nacC').val(datos[7]);

                $('#modif_configuracionPersonal').modal({
                    show:true,
                    backdrop:'static'
                });

                $("#fecha_nacC").attr('readonly',true);

                $("#fecha_nacC").datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate: datos[7],
                    useCurrent: true,
                    pickTime: false,
                    showTodayButton: true,
                });
                    return false;


            }
        });
    }

    function editar_horas(id)
    {
        var url='modifica_horas.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);

                $('#id_horas').val(id);
                $('#bloque_M').val(datos[0]);
                $('#inicio_M').val(datos[1]);
                $('#hora_entrada_M').val(datos[2]);
                $('#fin_M').val(datos[3]);
                $('#hora_salida_M').val(datos[4]);

                $("#inicio_M").attr('readonly',true);
                $("#fin_M").attr('readonly',true);

                $("#inicio_M").datetimepicker({
                    format: 'hh:mm',
                    defaultTime: datos[1],
                    useCurrent: true,
                    pickTime: true,
                    pickDate: false,
                    showTodayButton: false,
                });

                $("#fin_M").datetimepicker({
                    format: 'hh:mm',
                    defaultTime: datos[3],
                    useCurrent: true,
                    pickTime: true,
                    pickDate: false,
                    showTodayButton: false,
                });

                validarBLOQUE_M();
                validarINICIO_M();

                $('#modif_horas').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    }

    function editar_personal(id){

        var url='modificar_personal.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);

                $('#id').val(id);
                $('#nac_perM').val(datos[0]);
                $('#ci_perM').val(datos[1]);
                $('#nombres_perM').val(datos[2]);
                $('#apellidos_perM').val(datos[3]);

                if (datos[4]=='M')
                {
                    document.getElementById("masculino_M").checked=true;
                }
                if (datos[4]=='F')
                {
                    document.getElementById("femenino_M").checked=true;
                }

                $('#grado_instM').val(datos[5]);
                $('#especialidadM').val(datos[6])
                $('#cargo_perM').val(datos[7]);
                $('#correoM').val(datos[8]);
                $('#cod_tlfM').val(datos[9])
                $('#num_contM').val(datos[10]);
                $('#fecha_nacM').val(datos[11]);

                if (datos[7]=='Profesor')
                {
                    $('#ocultarDedicacionM').show();
                    document.getElementById('dedicacionM').disabled=false;
                }

                $('#dedicacionM').val(datos[12]);

                $('#modif_personal').modal({
                    show:true,
                    backdrop:'static'
                });

                $("#fecha_nacM").attr('readonly',true);

                $("#fecha_nacM").datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate: datos[11],
                    useCurrent: true,
                    pickTime: false,
                    showTodayButton: true,
                });

                return false;
            }
        });
    };


    function eliminarUsuario(id){

        $('#aceptar_elim_usuario').val(id);

        $('#elim_usuario').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function eliminarHoras(id){

        $('#aceptar_elim_horas').val(id);

        $('#elim_horas').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function eliminarMateria(id){

        $('#aceptar_elim_materia').val(id);

        $('#elim_materia').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function eliminarTecnologico(id){

        $('#aceptar_elim_tec').val(id);

        $('#eliminar_tec').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function eliminar_tipo(id){

        $('#id_t_u').val(id);

        $('#confir_t_u').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function eliminarPersonal(id){

        $('#aceptar_elim_personal').val(id);

        $('#elim_personal').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

    function desbloquearUsuario(id)
    {
        $('#aceptar_desbloq_usuario').val(id);

        $('#desbloq_usuario').modal({
            show:true,
            backdrop:'static'
        });
    }

    function desbloquear_Usuario ()
    {
        var id=document.getElementById('aceptar_desbloq_usuario').value;

        window.location.href="desbloq_usuario.php?id_usu="+id;
    }

    function eliminar_Usuario(){

        var id = document.getElementById('aceptar_elim_usuario').value;

        window.location.href="elim_usuario.php?id_usu="+id;
    };

    function eliminar_Materia(){

        var id = document.getElementById('aceptar_elim_materia').value;

        window.location.href="elim_materia.php?id="+id;
    };

    function eliminar_Horas(){

        var id = document.getElementById('aceptar_elim_horas').value;

        window.location.href="elim_horas.php?id="+id;
    };

    function E_T_U()
    {
        var id = document.getElementById('id_t_u').value;

        //alert('id='+id+" CULO");

        window.location.href="elim_tipo_usuario.php?id_tipo="+id;
    };

    function eliminar_Personal(){

        var id = document.getElementById('aceptar_elim_personal').value;

        window.location.href="elim_personal.php?id="+id;
    };

    function estadoPlanificacion(id){

        var url='busqueda_estado.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success:function(valores){
                var datos=eval(valores);

                if (datos[0]=='Concluida')
                {
                    document.getElementById("concluido").checked=true;
                }
                if (datos[0]=='En proceso')
                {
                    document.getElementById("en_proceso").checked=true;
                }
                if (datos[0]=='No concluida')
                {
                    document.getElementById("no_concluido").checked=true;
                }

                $('#id_planif').val(id);

                $('#estado_planif').modal({
                    show:true,
                    backdrop:'static'
                });
            }
        });
    }

    function estadoTecnologico(id){

        var url='busqueda_estado_tec.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success:function(valores){
                var datos=eval(valores);

                if (datos[0]=='Concluido')
                {
                    document.getElementById("concluido_t").checked=true;
                }
                if (datos[0]=='En proceso')
                {
                    document.getElementById("en_proceso_t").checked=true;
                }
                if (datos[0]=='Abandonado')
                {
                    document.getElementById("abandonado").checked=true;
                }

                $('#id_tec').val(id);

                $('#estado_tec').modal({
                    show:true,
                    backdrop:'static'
                });
            }
        });
    }

    function verif_estado(valor)
    {
        //alert(valor);

    document.getElementById("valor").innerHTML = valor;

        $('#valor2').val(valor);

        $('#verif_estado').modal({
            show:true,
            backdrop:'static'
        });
    }

    function verif_estadoC()
    {
        $('#verif_estadoC').modal({
            show:true,
            backdrop:'static'
        });
    }

    function verif_estadoA()
    {
        $('#verif_estadoA').modal({
            show:true,
            backdrop:'static'
        });
    }

    function aceptar()
    {
        var id=document.getElementById('id_planif').value;
        var estado=document.getElementById('valor2').value;

        //alert(id+" "+estado);

        window.location.href="estado_planificacion.php?id_planif="+id+"&estado="+estado;
    }

    function aceptar_concluido()
    {
        var id=document.getElementById('id_tec').value;
        var lugar=document.getElementById('comunitario').value;

        window.location.href="estado_tecnologico.php?estado=Concluido&id_tec="+id+"&comunitario="+lugar;
    }

    function aceptar_abandonado()
    {
        var id=document.getElementById('id_tec').value;
        var lugar=document.getElementById('comunitario').value;

        window.location.href="estado_tecnologico.php?estado=Abandonado&id_tec="+id+"&comunitario="+lugar;
    }

//  AUTOCOMPLETADO

    $(function() {

       $('#ci_usu').autocomplete({
           source:'personal_bus.php',
           minLength: 1
        });
    });

    function personal(){

        var url='buscar_personal.php';

        var ci=document.getElementById('ci_usu').value;
        var nac=document.getElementById('nac_usu').value;

        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usu').val(datos[0]);
                $('#apellidos_usu').val(datos[1]);
            }
        });
    };
// FIN AUTOCOMPLETADO

    function personalM(){

        var url='buscar_personal.php';

        var ci=document.getElementById('ci_usuM').value;
        var nac=document.getElementById('nac_usuM').value

        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usuM').val(datos[0]);
                $('#apellidos_usuM').val(datos[1]);
            }
        });
    };
// FIN AUTOCOMPLETADO MODIFICAR

//  AUTOCOMPLETADO PLANIFICACION
    $(function() {
       $('#ci_planif').autocomplete({
           source:'personal_bus.php',
           minLength: 1
        });
    });

    function personal_planif(){

        var url='buscar_personal.php';

        var ci=document.getElementById('ci_planif').value;
        var nac=document.getElementById('nacionalidad_planif').value

        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usu_planif').val(datos[0]);
                $('#apellidos_usu_planif').val(datos[1]);
            }
        });
    };
// FIN AUTOCOMPLETADO PLANIFICACION

//  AUTOCOMPLETADO PLANIFICACION MODIFICAR
        /*        $(function() {
                    $('#ci_planif_M').autocomplete({
                        source:'personal_busqueda.php',
                        minLength: 1
                    });
                });
*/
    function personal_planif_M(){

        var url='buscar_personal.php';

        var ci=document.getElementById('ci_planif_M').value;
        var nac=document.getElementById('nacionalidad_planif_M').value

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usu_planif_M').val(datos[0]);
                $('#apellidos_usu_planif_M').val(datos[1]);
            }
        });
    };
// FIN AUTOCOMPLETADO PLANIFICACION MODIFICAR

// AUTOCOMPLETADO DISPONIBILIDAD
    $(function() {
       $('#ci_disp').autocomplete({
           source:'personal_bus.php?disponibilidad=profesor',
           minLength: 1
        });
    });

    function nom_ape_disp(){

        var url='buscar_personal.php';

        var ci=document.getElementById('ci_disp').value;
        var nac=document.getElementById('nacionalidad').value

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                var nom=datos[0].split(" ");
                var ape=datos[1].split(" ");

                var NomApe=nom[0]+" "+ape[0]+" "+datos[2];

                $('#nom_ape').val(NomApe);
            }
        });
    };
// FIN AUTOCOMPLETADO DISPONIBILIDAD

// MODIFICAR DISPONIBILIDAD

    function nom_ape_disp_M(){

        var url='buscar_personal.php';

        var ci=document.getElementById('ci_disp_M').value;
        var nac=document.getElementById('nacionalidad_M').value

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                var nom=datos[0].split(" ");
                var ape=datos[1].split(" ");

                var NomApe=nom[0]+" "+ape[0];

                $('#nom_ape_M').val(NomApe);
            }
        });
    };
// FIN AUTOCOMPLETADO DISPONIBILIDAD

// MODIFICAR DISPONIBILIDAD

    function nom_ape_horarios(cp,nomApe){

        var url='buscar_personal.php';

        var ced=document.getElementById(cp).value;

        if (ced==0)
        {
            $('#'+nomApe).val("");
        }

        var c=ced.split("-");
        var ci=c[1];
        var nac=c[0]+"-";

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                var nom=datos[0].split(" ");
                var ape=datos[1].split(" ");

                var NomApe=nom[0]+" "+ape[0]+" "+datos[2];

                $('#'+nomApe).val(NomApe);

                ValidarBloqueProfe('algo');
            }
        });
    };

    function nom_ape_horariosM(cp,nomApe){

        var url='buscar_personal.php';

        var ced=document.getElementById(cp).value;

        if (ced==0)
        {
            $('#'+nomApe).val("");
        }

        var c=ced.split("-");
        var ci=c[1];
        var nac=c[0]+"-";

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                var nom=datos[0].split(" ");
                var ape=datos[1].split(" ");

                var NomApe=nom[0]+" "+ape[0]+" "+datos[2];

                $('#'+nomApe).val(NomApe);

                ValidarBloqueProfeM('algo');
            }
        });
    };

    function materia_horarios(){

        var url='buscar_materia.php';

        var mat=document.getElementById('materia').value;



        $.ajax({
            type:'POST',
            url:url,
            data:'mat='+mat,
            success:function(valores){
                var datos=eval(valores);

                $('#nom_materia').val(datos[0]);
                $('#hora').val(datos[1]);

                ValidarBloqueProfe('algo3');
            }
        });
    };

    function materia_horariosM(){

        var url='buscar_materia.php';

        var mat=document.getElementById('materiaM').value;

        $.ajax({
            type:'POST',
            url:url,
            data:'mat='+mat,
            success:function(valores){
                var datos=eval(valores);

                $('#nom_materiaM').val(datos[0]);
                $('#horaM').val(datos[1]);

                ValidarBloqueProfeM('algo3');
            }
        });
    };
// FIN AUTOCOMPLETADO DISPONIBILIDAD


    $(function () {

    var d = new Date();
    var month = d.getMonth();
    var day = d.getDate();
    var year = d.getFullYear();
    var dateNow=new Date(year, month, day);

        $("#fecha_nac").attr('readonly',true);

        $("#fecha_nac").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#fecha_act").attr('readonly',true);

        $("#fecha_act").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });


        $("#fecha").attr('readonly',true);

        $("#fecha").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#nextfecha").attr('readonly',true);

        $("#nextfecha").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#fecha2").attr('readonly',true);

        $("#fecha2").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#nextfecha2").attr('readonly',true);

        $("#nextfecha2").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#fechamod").attr('readonly',true);

        $("#fechamod").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#devolucion").attr('readonly',true);

        $("#devolucion").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#fechai").attr('readonly',true);

        $("#fechai").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

        $("#inicio").attr('readonly',true);

        $("#inicio").datetimepicker({
            format: 'hh:mm',
            useCurrent: false,
            pickTime: true,
            pickDate: false,
            showTodayButton: false,
        });

        $("#fin").attr('readonly',true);

        $("#fin").datetimepicker({
            format: 'hh:mm',
            useCurrent: false,
            pickTime: true,
            pickDate: false,
            showTodayButton: false,
        });
    });

//function todos(){

// TODOS USUARIO

$('#pach5').click(function (){

        if (document.getElementById("pach5").checked)
            {
                document.getElementById("pach1").checked=true;
                document.getElementById("pach2").checked=true;
                document.getElementById("pach3").checked=true;
                document.getElementById("pach4").checked=true;
            }
        else
            {
                document.getElementById("pach1").checked=false;
                document.getElementById("pach2").checked=false;
                document.getElementById("pach3").checked=false;
                document.getElementById("pach4").checked=false;
            }
});

$('#pacp5').click(function(){

        if (document.getElementById("pacp5").checked)
            {
                document.getElementById("pacp1").checked=true;
                document.getElementById("pacp2").checked=true;
                document.getElementById("pacp3").checked=true;
                document.getElementById("pacp4").checked=true;
            }
        else
            {
                document.getElementById("pacp1").checked=false;
                document.getElementById("pacp2").checked=false;
                document.getElementById("pacp3").checked=false;
                document.getElementById("pacp4").checked=false;
            }
});

$('#paconv5').click(function(){

        if (document.getElementById("paconv5").checked)
            {
                document.getElementById("paconv1").checked=true;
                document.getElementById("paconv2").checked=true;
                document.getElementById("paconv3").checked=true;
                document.getElementById("paconv4").checked=true;
            }
        else
            {
                document.getElementById("paconv1").checked=false;
                document.getElementById("paconv2").checked=false;
                document.getElementById("paconv3").checked=false;
                document.getElementById("paconv4").checked=false;
            }
});

$('#padi5').click(function(){

        if (document.getElementById("padi5").checked)
            {
                document.getElementById("padi1").checked=true;
                document.getElementById("padi2").checked=true;
                document.getElementById("padi3").checked=true;
                document.getElementById("padi4").checked=true;
            }
        else
            {
                document.getElementById("padi1").checked=false;
                document.getElementById("padi2").checked=false;
                document.getElementById("padi3").checked=false;
                document.getElementById("padi4").checked=false;
            }
});

$('#padm5').click(function(){

        if (document.getElementById("padm5").checked)
            {
                document.getElementById("padm1").checked=true;
                document.getElementById("padm2").checked=true;
                document.getElementById("padm3").checked=true;
                document.getElementById("padm4").checked=true;
            }
        else
            {
                document.getElementById("padm1").checked=false;
                document.getElementById("padm2").checked=false;
                document.getElementById("padm3").checked=false;
                document.getElementById("padm4").checked=false;
            }
});

$('#pada5').click(function(){

        if (document.getElementById("pada5").checked)
            {
                document.getElementById("pada1").checked=true;
                document.getElementById("pada2").checked=true;
                document.getElementById("pada3").checked=true;
                document.getElementById("pada4").checked=true;
            }
        else
            {
                document.getElementById("pada1").checked=false;
                document.getElementById("pada2").checked=false;
                document.getElementById("pada3").checked=false;
                document.getElementById("pada4").checked=false;
            }
});

$('#padp5').click(function(){

        if (document.getElementById("padp5").checked)
            {
                document.getElementById("padp1").checked=true;
                document.getElementById("padp2").checked=true;
                document.getElementById("padp3").checked=true;
                document.getElementById("padp4").checked=true;
            }
        else
            {
                document.getElementById("padp1").checked=false;
                document.getElementById("padp2").checked=false;
                document.getElementById("padp3").checked=false;
                document.getElementById("padp4").checked=false;
            }
});

// FIN TODOS TIPO USUARIO

// TODOS MODIFICAR USUARIO

$('#pach5M').click(function (){

        if (document.getElementById("pach5M").checked)
            {
                document.getElementById("pach1M").checked=true;
                document.getElementById("pach2M").checked=true;
                document.getElementById("pach3M").checked=true;
                document.getElementById("pach4M").checked=true;
            }
        else
            {
                document.getElementById("pach1M").checked=false;
                document.getElementById("pach2M").checked=false;
                document.getElementById("pach3M").checked=false;
                document.getElementById("pach4M").checked=false;
            }
});

$('#pacp5M').click(function(){

        if (document.getElementById("pacp5M").checked)
            {
                document.getElementById("pacp1M").checked=true;
                document.getElementById("pacp2M").checked=true;
                document.getElementById("pacp3M").checked=true;
                document.getElementById("pacp4M").checked=true;
            }
        else
            {
                document.getElementById("pacp1M").checked=false;
                document.getElementById("pacp2M").checked=false;
                document.getElementById("pacp3M").checked=false;
                document.getElementById("pacp4M").checked=false;
            }
});

$('#paconv5M').click(function(){

        if (document.getElementById("paconv5M").checked)
            {
                document.getElementById("paconv1M").checked=true;
                document.getElementById("paconv2M").checked=true;
                document.getElementById("paconv3M").checked=true;
                document.getElementById("paconv4M").checked=true;
            }
        else
            {
                document.getElementById("paconv1M").checked=false;
                document.getElementById("paconv2M").checked=false;
                document.getElementById("paconv3M").checked=false;
                document.getElementById("paconv4M").checked=false;
            }
});

$('#padi5M').click(function(){

        if (document.getElementById("padi5M").checked)
            {
                document.getElementById("padi1M").checked=true;
                document.getElementById("padi2M").checked=true;
                document.getElementById("padi3M").checked=true;
                document.getElementById("padi4M").checked=true;
            }
        else
            {
                document.getElementById("padi1M").checked=false;
                document.getElementById("padi2M").checked=false;
                document.getElementById("padi3M").checked=false;
                document.getElementById("padi4M").checked=false;
            }
});

$('#padm5M').click(function(){

        if (document.getElementById("padm5M").checked)
            {
                document.getElementById("padm1M").checked=true;
                document.getElementById("padm2M").checked=true;
                document.getElementById("padm3M").checked=true;
                document.getElementById("padm4M").checked=true;
            }
        else
            {
                document.getElementById("padm1M").checked=false;
                document.getElementById("padm2M").checked=false;
                document.getElementById("padm3M").checked=false;
                document.getElementById("padm4M").checked=false;
            }
});

$('#pada5M').click(function(){

        if (document.getElementById("pada5M").checked)
            {
                document.getElementById("pada1M").checked=true;
                document.getElementById("pada2M").checked=true;
                document.getElementById("pada3M").checked=true;
                document.getElementById("pada4M").checked=true;
            }
        else
            {
                document.getElementById("pada1M").checked=false;
                document.getElementById("pada2M").checked=false;
                document.getElementById("pada3M").checked=false;
                document.getElementById("pada4M").checked=false;
            }
});

$('#padp5M').click(function(){

        if (document.getElementById("padp5M").checked)
            {
                document.getElementById("padp1M").checked=true;
                document.getElementById("padp2M").checked=true;
                document.getElementById("padp3M").checked=true;
                document.getElementById("padp4M").checked=true;
            }
        else
            {
                document.getElementById("padp1M").checked=false;
                document.getElementById("padp2M").checked=false;
                document.getElementById("padp3M").checked=false;
                document.getElementById("padp4M").checked=false;
            }
});

// FIN TODOS MODIFICAR TIPO USUARIO

    $('#r_maquina').hide();

    $(document).ready(function(){
      $(".fancybox").fancybox();
    });

// MUESTRA EL FORMULARIO DE MAQUINAS

     $('#agregar_maq').click(function(){

        $('#slideshow').hide();
        $('#consulta_maq').hide();

        $('#r_maquina').show();
    });


    function detalleMaquina(id){

    var url='detalle_maquina.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'id_maq='+id,
        success: function(valores){

            $('#detalle').html(valores);

            $('#detalle_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

    function detalleTecnologico(id){

        var url='detalle_tec.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_tecnologico').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    };

    function detallePlanificacion(id){

        var url='detalle_planificacion.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_planificacion').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    };

function editar_maquina(id){

    var url='modifica_maquina.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'id_maq='+id,
        success: function(valores){
            var datos=eval(valores);
            $('#m_id_maq').val(id);
            $('#m_codigo').val(datos[0]);
            $('#MNB').val(datos[1]);
            $('#Mmarca').val(datos[2]);
            $('#Mmodelo').val(datos[3]);
            $('#m_maquina').val(datos[4]);
            $('#m_estado').val(datos[5]);
            $('#m_id_nb').val(datos[6]);
            $('#muestra').attr("src",datos[7]);
                 $('#inputimagen').val(datos[8]);
                 $('#previewcanvas').hide();
                 var f=document.getElementById('foto1');
                 var t=document.getElementById('foto1').cloneNode(true);
                  t.value='';
                  f.parentNode.replaceChild(t,f);
                   var image_no = "imagenes/Sin_Imagen.JPG";
                    var images=document.getElementById("inputimagen").value;

                    if (images==image_no){
                      $('#div_quitar_imagen').hide();
                    }
                    else{
                      $('#div_quitar_imagen').show();
                    }
            /*$('#rev_maquinamod').val(datos[6]);
            $('#fechamod').val(datos[7]);
            $('#niv_aceitemod').val(datos[8]);
            $('#observacionesmod').val(datos[9]);*/
            $('#modif_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

  function editar_configuracion(id){

    var url='modifica_configuracion.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);

                $('#id_usu').val(id);
                $('#nombre_usuarioC').val(datos[0]);
                $('#preguntaC').val(datos[1]);
                $('#respuestaC').val(datos[2]);

                $('#modif_configuracion').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

    function eliminarMaquina(id){

        $('#aceptar_elim_maquina').val(id);

        $('#elim_maq').modal({
            show:true,
            backdrop:'state'
        });

        confirm_user();
    }

    function eliminarMaquinaT(id){

        $('#aceptar_elim_maquinaT').val(id);

        $('#elim_maqT').modal({
            show:true,
            backdrop:'state'
        });

        confirm_user();
    }

    function eliminarDisponibilidad(id_personal,id_periodo){

        $('#aceptar_elim_disponibilidad_personal').val(id_personal);
        $('#aceptar_elim_disponibilidad_periodo').val(id_periodo);

        $('#elim_disp').modal({
            show:true,
            backdrop:'state'
        });

        confirm_user();
    }

    function eliminarPlanificacion(id){

        $('#aceptar_elim_planificacion').val(id);

        $('#elim_planificacion').modal({
            show:true,
            backdrop:'state'
        });

        confirm_user();
    }

    function eliminar_Maquina(){

        var id = document.getElementById('aceptar_elim_maquina').value;

        window.location.href="elim_maquina.php?id_maq="+id;
    };

    function eliminar_Disponibilidad(){

        var id_personal = document.getElementById('aceptar_elim_disponibilidad_personal').value;
        var id_periodo = document.getElementById('aceptar_elim_disponibilidad_periodo').value;

        window.location.href="elim_disponibilidad.php?id_personal="+id_personal+"&id_periodo="+id_periodo;
    };

    function eliminar_Planificacion(){

        var id = document.getElementById('aceptar_elim_planificacion').value;

        window.location.href="elim_planificacion.php?id="+id;
    };

    function eliminar_Tecnologico(){

        var id = document.getElementById('aceptar_elim_tec').value;
        var lugar = document.getElementById('comunitario').value;

        window.location.href="elim_tecnologico.php?id="+id+"&comunitario="+lugar;
    };

// REPORTE MAQUINAS

$('#reporte_maq').click(function(){
$('#rep_maq').modal({
    show:true,
    backdrop: 'static'
});

});

    function reporte_Maquina(){
        window.open("pdf/reporte_maquina.php","_blank");
    };

    function reportando_Horario(){
       var id_seccion=document.getElementById("aceptar_reporte_horario").value;
       var id_periodo=document.getElementById("aceptar_reporte_horario2").value;

        window.open("pdf/reporte_horario.php?id_seccion="+id_seccion+"&id_periodo="+id_periodo,"_blank");
    };

    function reporteHorario(id,id2){
        $('#aceptar_reporte_horario').val(id);
        $('#aceptar_reporte_horario2').val(id2);

        $('#reporte_horario_indv').modal({
            show:true,
            backdrop:'static'
        });
    }

     function reporte_Preventivo(){
        window.open("pdf/reporte_preventivo.php","_blank");
        //window.location.href="html2pdf.php";
    };
     function reporte_Correctivo(){
        window.open("pdf/reporte_correctivo.php","_blank");
        //window.location.href="html2pdf.php";
    };


     function reporte_Herramientas(){
        window.open("pdf/reporte_herramientas.php","_blank");
        //window.location.href="html2pdf.php";
    };

// FIN REPORTE MAQUINAS

// REPORTE PERSONAL
$('#reporte_personal').click(function(){

    $('#rep_per').modal({
        show:true,
        backdrop: 'static'
    });

});

    function reporte_Personal()
    {
        window.open("pdf/reporte_personal.php","_blank");
    };
// FIN REPORTE PERSONAL


// REPORTE PERSONAL
$('#reporte_planificacion').click(function(){

    $('#rep_planif').modal({
        show:true,
        backdrop: 'static'
    });

});

    function reporte_Planificacion()
    {
        window.open("pdf/reporte_planificacion.php","_blank");
    };
// FIN REPORTE PERSONAL





function DameDatos(){
      $.ajax({
        type:"POST",
        url:"registro_maquina2.php",
        data:"contacto="+document.getElementById("contacto").value,

        success: function(respuesta){
    /*  Como era

    if(respuesta.modelo!="0") document.getElementById('informacion').innerHTML='<br>'+respuesta.modelo;
        else document.getElementById('informacion').innerHTML='<br><div class="info"><p>Seleccione una maquina por favor</p></div>';
        */
        if (respuesta!=0)
        {
          $('#informacion').html('<br>'+respuesta);
          DameDatos_maq();
        }
        else
        {
          $('#informacion').html('<br><div class="info"><p>Seleccione una máquina por favor</p></div>');
        }
      }

    });

     }

function DameDatos_maq(){

       $.ajax({
        type:"POST",
        url:"consultando_maquina.php",
        data:"contacto="+document.getElementById("contacto").value,

        success: function(valores){

           $('#codigo').val(valores);

      }
    });
}
        function reportandoMaquina(id){

        $('#aceptar_reporte_maquina').val(id);

        $('#agua_maq').modal({
            show:true,
            backdrop:'static'
        });
    };

    function reporteMaquina(){
        var user= document.getElementById('user_report').value;
        var id= document.getElementById('aceptar_reporte_maquina').value;
          window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");

    }



    //--------------------------vicent




    function eliminarInsumo(id){

        $('#aceptar_elim_insumo').val(id);

        $('#elim_maq').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };


 function editar_insumos(id){

        var url='modifica_insumos.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
                $('#idmod').val(id);
                //$('#codigomod').val(datos[1]);
                $('#MNB').val(datos[2]);
                $('#nombremod').val(datos[3]);
                $('#tipo_medidamod').val(datos[4]);
                $('#medidamod').val(datos[5]);
                $('#preciomod').val(datos[6]);
                $('#existenciamod').val(datos[7]);
                $('#buenasmod').val(datos[8]);
                $('#danadasmod').val(datos[9]);
                $('#minimomod').val(datos[10]);
                $('#recambiomod').val(datos[11]);
                $('#ubicacionmod').val(datos[12]);
                $('#importemod').val(datos[13]);
                $('#m_id_nb').val(datos[14]);
                $('#maximomod').val(datos[15]);
                 $('#pre_nbmod').val(datos[16]);
                 $('#estantemod').val(datos[17]);
                 if (datos[4]=='Maquina'){
                    $('#medida_maquinamod').val(datos[5]);
                    document.getElementById('medidamod').disabled=true;
                    document.getElementById('medida_maquinamod').disabled=false;
                    $('#div_medidaM1').hide();
                    $('#medidamod3').show();
                 }
                 else{
                    document.getElementById('medidamod').disabled=false;
                    document.getElementById('medida_maquinamod').disabled=true;
                    $('#div_medidaM1').show();
                    $('#medidamod3').hide();
                 }

                    if (datos[16]=="S/NB"){
                        $('#MNB').hide();
                        document.getElementById('MNB').disabled=true;
                    }
                    else{
                      $('#MNB').val(datos[2]);
                      $('#MNB').show();
                  document.getElementById('MNB').disabled=false;

                    }
                $('#modif_maquina').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };


    function eliminar_Insumo(){

        var id = document.getElementById('aceptar_elim_insumo').value;

        window.location.href="elim_insumos.php?id="+id;
    };

    function detalleInsumo(id){

        var url='detalle_insumos.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_insumos').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

    //--------------------menter en funciones.js----------------------------------

function editar_preventivo(id){

    var url='modifica_preventivo.php';
    var xd= document.getElementById("ids_mant_mod").value;
    $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            var datos=eval(valores);

            $('#m_id_prev').val(datos[0]);
            $('#rev_maquinamod').val(datos[1]);
            $('#fechamod').val(datos[19]);
            $('#niv_aceitemod').val(datos[3]);
            $('#observacionesmod').val(datos[4]);
            $('#fechamod2').val(datos[2]);
            $('#fecha_next_mod').val(datos[17]);
               $('#motivomod').val(datos[20]);

            if (datos[5]=="No")
            {
                document.getElementById("lucesmod1").checked=true;
            }
            if (datos[5]=="Si")
            {
                document.getElementById("lucesmod2").checked=true;
            }

            if (datos[6]=="No")
            {
                document.getElementById("paradamod1").checked=true;
            }
            if (datos[6]=="Si")
            {
                document.getElementById("paradamod2").checked=true;
            }

            if (datos[7]=="No")
            {
                document.getElementById("pulsadoresmod1").checked=true;
            }
            if(datos[7]=="Si")
            {
            document.getElementById("pulsadoresmod2").checked=true;
            }

            $('#ids_mant_mod').val(datos[8]);
            $('#responsablemod').val(datos[9]);

            if (datos[10]=="interno")
            {
                document.getElementById("tipo_servicio_intmod").checked=true;
                document.getElementById("provedormod").disabled=true;
                $('#proveedor_ext').hide();
            }
            if (datos[10]=="externo")
            {
                document.getElementById("tipo_servicio_extmod").checked=true;
                document.getElementById("provedormod").disabled=false;
                $('#proveedor_ext').show();
            }

            $('#hora_hombremod').val(datos[11]);
            $('#provedormod').val(datos[12]);
            $('#costomod').val(datos[13]);

            if (datos[14]=="No")
            {
                document.getElementById("imprevisto_no").checked=true;
                document.getElementById("fechai").disabled=true;
                document.getElementById("detallei").disabled=true;
                $('#div_fechaimprevisto').hide();
                $('#div_detalleimprevisto').hide();
            }
            if (datos[14]=="Si")
            {
                document.getElementById("imprevisto_si").checked=true;
                document.getElementById("fechai").readOnly=true;
                document.getElementById("detallei").readOnly=true;
                $('#div_fechaimprevisto').show();
                $('#div_detalleimprevisto').show();
            }
            $('#fechai').val(datos[15]);
            $('#detallei').val(datos[16]);
            $('#fechanextmod').val(datos[17]);
            $('#modif_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

function editar_solicitud_preventivo(id){

    var url='modifica_preventivo.php';
    var xd= document.getElementById("ids_mant_mod").value;
    $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            var datos=eval(valores);
            $('#m_id_prev').val(datos[0]);
            $('#rev_maquinamod').val(datos[1]);

             $('#responsablemod').val(datos[9]);
            $('#provedormod').val(datos[12]);
            $('#observacionesmod').val(datos[4]);
            $('#fechamod').val(datos[2]);
            $('#motivomod').val(datos[20]);

            if (datos[10]=="interno")
            {
                document.getElementById("tipo_servicio_intmod").checked=true;
                document.getElementById("provedormod").disabled=true;
                $('#proveedor_ext').hide();
            }
            if (datos[10]=="externo")
            {
                document.getElementById("tipo_servicio_extmod").checked=true;
                document.getElementById("provedormod").disabled=false;
                $('#proveedor_ext').show();
            }

            $('#proveedormod').val(datos[10]);

             $('#modif_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

   function ejecutarPreventivo(id){
    window.open("ejecucion_mant_preventivo.php?numeros_mant="+id+"","_parent");
      //window.opener.buscaNumeroMantI();

    }


function ejecutarCorrectivo(id){
    window.open("ejecucion_mant_correctivo.php?numeros_mant="+id+"","_parent");
      //window.opener.buscaNumeroMantI();

    }

            $('#tipo_servicio_intmod').click(function(){
                $('#proveedor_ext').hide();
                document.getElementById("provedormod").disabled=true;
            });

            $('#tipo_servicio_extmod').click(function(){
                $('#proveedor_ext').show();
                 document.getElementById("provedormod").disabled=false;
            });

 function reportandoPreventivo(id,id2){

        $('#aceptar_reporte_preventivo').val(id);
        $('#aceptar_reporte_preventivo2').val(id2);

        $('#agua_maq').modal({
            show:true,
            backdrop:'static'
        });
    };

    function reportePreventivo(){
        var user= document.getElementById('user_report').value;
        var id= document.getElementById('aceptar_reporte_preventivo').value;
        var id2= document.getElementById('aceptar_reporte_preventivo2').value;
        window.open("pdf/reporte_maquina_preventivo.php?id_maq='"+id+"'&user="+user+"&id='"+id2+"'","_blank");

    }

    function detallePreventivo(id,id2){

    var url='detalle_preventivo.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'id_maq='+id+'&id='+id2,
        success: function(valores){

            $('#detalle').html(valores);

            $('#detalle_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

function eliminarPreventivo(id){

        $('#aceptar_elim_preventivo').val(id);

        $('#elim_maq').modal({
            show:true,
            backdrop:'static'
        });

         confirm_user();
    };

    function eliminar_Preventivo(){

        var id = document.getElementById('aceptar_elim_preventivo').value;

        window.location.href="elim_preventivo.php?id="+id;
    };

//-----------------PREVENTIVO------------------------


    function personal(){

        var url='buscar_personal.php';

        var ci=document.getElementById('ci_usu').value;
        var nac=document.getElementById('nac_usu').value

        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usu').val(datos[0]);
                $('#apellidos_usu').val(datos[1]);
            }
        });
    };

      function maquinas(){

        var url='buscar_maquinas.php';
        var prenb=document.getElementById('pre_nb').value;
        var nb=document.getElementById('NB').value;
        var union=prenb+nb;

        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'nb='+union,
            success:function(valores){
                var datos=eval(valores);

                $('#id_maq').val(datos[0]);
                $('#codigo').val(datos[1]);
            }
        });
    };



    $('#agregar_man').click(function(){
        $('#slideshow').hide();
        $('#consulta_prev').hide();
        $('#r_mant_prev').show();
    });
    $('#r_mant_prev').hide();

function codemaquinas(){

        var url='buscar_codemaquinas.php';
        var code=document.getElementById('codigo').value;
        var code2=document.getElementById('codigo2').value;


        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'code='+code,
            success:function(valores){
                var datos=eval(valores);

                $('#id_maq').val(datos[0]);
                $('#NB').val(datos[1]);
            }
        });

         $.ajax({
            type:'POST',
            url:url,
            data:'code='+code2,
            success:function(valores){
                var datos=eval(valores);

                $('#id_maq2').val(datos[0]);
                $('#NB2').val(datos[1]);
            }
        });
    };

function personal_mant(){

        var url='buscar_personal2.php';

        var ci=document.getElementById('ci_usu').value;
        var nac=document.getElementById('nac_usu').value;
        var ci2=document.getElementById('ci_usu2').value;
        var nac2=document.getElementById('nac_usu2').value


        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usu').val(datos[0]);
                $('#apellidos_usu').val(datos[1]);
                $('#id_per').val(datos[2]);
            }
        });

         $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci2+'&nac='+nac2,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usu2').val(datos[0]);
                $('#apellidos_usu2').val(datos[1]);
                $('#id_per2').val(datos[2]);
            }
        });
    };

//-------------Correctivo-----------

    function detalleCorrectivo(id,id2){

    var url='detalle_correctivo.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'id_maq='+id+'&id='+id2,
        success: function(valores){

            $('#detalle').html(valores);

            $('#detalle_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

function eliminarCorrectivo(id){

        $('#aceptar_elim_correctivo').val(id);

        $('#elim_maq').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };


    function confirm_user(){
          $('#elim_all').modal({
                show:true,
                backdrop:'static',
                keyboard: false

            });
    }

    function validando_usuario_elim(){

        var url='verifica_user_elim.php';

        var user=document.getElementById('username_confirm').value;
        var pass=document.getElementById('password').value

        //alert("funcion personal "+ci);


        $.ajax({
            type:'POST',
            url:url,
            data:'user='+user+'&pass='+pass,
            success:function(data){

                if(data==0){
                    $('#elim_all_error').modal({
                show:true,
                backdrop:'static',
                keyboard: false

            });
                }
                else{

                    $('#elim_all').modal('hide');
                    $('#password').val("");
                }

            }
        });
    };

     function eliminar_Correctivo(){

        var id = document.getElementById('aceptar_elim_correctivo').value;

        window.location.href="elim_correctivo.php?id="+id;
    };

    function editar_correctivo(id){

    var url='modifica_correctivo.php';
    var xd= document.getElementById("ids_mant_mod").value;
    $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            var datos=eval(valores);



            $('#m_id_corre').val(datos[0]);
            $('#rev_maquinamod').val(datos[1]);
            $('#responsablemod').val(datos[2]);
            $('#fechamod').val(datos[3]);
            $('#hora_fallamod').val(datos[4]);
            $('#observacionesmod').val(datos[5]);
            $('#pieza_cambiomod').val(datos[6]);
            $('#hora_arranquemod').val(datos[7]);
            $('#fechaSmod').val(datos[16]);
            $('#fechaEmod').val(datos[17]);
            $('#motivomod').val(datos[18]);

            if (datos[8]=="interno"){
                document.modif_maqs.tipo_servicio_intmodc.checked=true;
                document.getElementById("proveedormod").disabled=true;
                $('#proveedor_ext').hide();
            }

            if (datos[8]=="externo"){
                document.modif_maqs.tipo_servicio_extmodc.checked=true;
                document.getElementById("proveedormod").disabled=false;
                $('#proveedor_ext').show();
            }


            $('#hora_hombremod').val(datos[9]);
            $('#proveedormod').val(datos[10]);
            $('#costomod').val(datos[11]);
            $('#ids_mant_mod').val(datos[12]);


            $('#modif_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });

};

function editar_solicitud_correctivo(id){

    var url='modifica_correctivo.php';
    var xd= document.getElementById("ids_mant_mod").value;
    $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            var datos=eval(valores);
            $('#m_id_corre').val(datos[0]);
            $('#rev_maquinamod').val(datos[1]);
            $('#responsablemod').val(datos[2]);
            $('#fechamod').val(datos[16]);
            $('#motivomod').val(datos[18]);


            if (datos[8]=="interno"){
                document.modif_maqs.tipo_servicio_intmodc.checked=true;
                document.getElementById("proveedormod").disabled=true;
                $('#proveedor_ext').hide();
            }

            if (datos[8]=="externo"){
                document.modif_maqs.tipo_servicio_extmodc.checked=true;
                document.getElementById("proveedormod").disabled=false;
                $('#proveedor_ext').show();
            }



            $('#proveedormod').val(datos[10]);

            $('#modif_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });

};

$('#tipo_servicio_intmodc').click(function(){
                document.getElementById("proveedormod").disabled=true;
                $('#proveedor_ext').hide();
                $('#proveedormod').val("");


    });

$('#tipo_servicio_extmodc').click(function(){
                document.getElementById("proveedormod").disabled=false;
                $('#proveedor_ext').show();

    });

//-----FIN-----Correctivo-----------

//------------insumos--------

function buscar_insumo(){

        var url='buscar_insumos.php';
        var tipo=document.getElementById('tipo').value;
        var codigo=document.getElementById('codigo').value;
        var codigo2=document.getElementById('codigo2').value;


        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'codigo='+codigo+'&tipo='+tipo,
            success:function(valores){
                var datos=eval(valores);

                $('#id_insu').val(datos[0]);

                $('#NB').val(datos[2]);
                $('#descripcion').val(datos[3]);
                $('#existencia').val(datos[4]);
                $('#buenas').val(datos[5]);
                $('#danadas').val(datos[6]);
                $('#minimo').val(datos[7]);
                $('#maximo').val(datos[8]);
            }
        });

          $.ajax({
            type:'POST',
            url:url,
            data:'codigo='+codigo2+'&tipo='+tipo,
            success:function(valores){
                var datos=eval(valores);

                $('#id_insu2').val(datos[0]);

                 $('#NB2').val(datos[2]);
                 $('#descripcion2').val(datos[3]);
                 $('#existencia2').val(datos[4]);
                 $('#buenas2').val(datos[5]);
                 $('#danadas2').val(datos[6]);
                  $('#minimo2').val(datos[7]);
                $('#maximo2').val(datos[8]);
            }
        });
    };

    function reportandoInsumo(id){
        $('#aceptar_reporte_insumo').val(id);

        $('#agua_maq').modal({
            show:true,
            backdrop:'static'
        });
    }

    function reporteInsumo()
    {
        var id=document.getElementById('aceptar_reporte_insumo').value;

        window.open("pdf/reporte_insumo.php?id_maq="+id,"_blank");

    }

     function reporteTecnologico(id){
        $('#aceptar_reporte_proyecto').val(id);

        $('#reporte_proyecto_indv').modal({
            show:true,
            backdrop:'static'
        });
    }

    function reportandoTecnologico()
    {
        var id=document.getElementById('aceptar_reporte_proyecto').value;

        window.open("pdf/reporte_proyecto.php?id="+id,"_blank");
    }

    function reportandoHerramienta(id){
        $('#aceptar_reporte_herramienta').val(id);

        $('#agua_maq').modal({
            show:true,
            backdrop:'static'
        });
    }

    function reporteHerramienta()
    {
        var id=document.getElementById('aceptar_reporte_herramienta').value;

        window.open("pdf/reporte_herramienta.php?id_maq="+id,"_blank");

    }

    function reportandoCorrectivo(id,id2)
    {
        $('#aceptar_reporte_correctivo').val(id);
        $('#aceptar_reporte_correctivo2').val(id2);

        $('#agua_maq').modal({
            show:true,
            backdrop:'static'
        });
    }

    function reporteCorrectivo () {

        var id=document.getElementById('aceptar_reporte_correctivo').value;
        var id2=document.getElementById('aceptar_reporte_correctivo2').value;

        window.open("pdf/reporte_maquina_correctivo.php?id_maq="+id+"&id="+id2,"_blank");
    }
//--FIN-------insumos--------

//-----------------Herramientas--------------

     function personal_herra(){

        var url='buscar_personal2.php';

        var ci=document.getElementById('ci_usu').value;
        var nac=document.getElementById('nac_usu').value;



        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'ci='+ci+'&nac='+nac,
            success:function(valores){
                var datos=eval(valores);

                $('#nombres_usu').val(datos[0]);
                $('#apellidos_usu').val(datos[1]);
                $('#id_per').val(datos[2]);
            }
        });


    };

    function buscar_herramienta(){

        var url='buscar_insumos.php';
        var tipo="herramienta";
        var consulta;

  consulta=$("#codigo").val();

        $.ajax({
            type:'POST',
            url:url,
            data:'codigo='+consulta+'&tipo='+tipo,
            success:function(valores){
                var datos=eval(valores);

                $('#id_herra').val(datos[0]);
                $('#nombre').val(datos[2]);
                $('#NB').val(datos[3]);
            }
        });
    }


  function detalleHerramienta(id){

        var url='detalle_herramientas.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_herramientas').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

function editar_herramientas(id){

        var url='modifica_herramientas.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
                $('#idmod').val(id);
        //        $('#codigomod').val(datos[1]);
                $('#nombremod').val(datos[2]);
                $('#pre_nbmod').val(datos[3]);
                    if (datos[3]=="S/NB"){
                        $('#MNB').hide();
                        document.getElementById('MNB').disabled=true;
                    }
                    else{
                      $('#MNB').val(datos[4]);
                      $('#MNB').show();
                  document.getElementById('MNB').disabled=false;

                    }
                    if (datos[5]=="S/Serial"){
                        $('#pre_serialmod').val("S/Serial");
                         $('#serialmod').hide();
                        document.getElementById('serialmod').disabled=true;
                    }
                    else{
                        $('#serialmod').val(datos[5]);
                          $('#serialmod').show();
                  document.getElementById('serialmod').disabled=false;

                    }
                $('#marcamod').val(datos[6]);
                $('#estadomod').val(datos[7]);
                $('#preciomod').val(datos[8]);
                $('#existenciamod').val(datos[9]);

                $('#tipo_medidamod').val(datos[10]);
                $('#medidamod').val(datos[11]);
                $('#ubicacionmod').val(datos[12]);
                 $('#m_id_nb').val(datos[13]);
                 $('#muestra').attr("src",datos[14]);
                 $('#inputimagen').val(datos[15]);
                 $('#estantemod').val(datos[16]);
                 $('#previewcanvas').hide();
                 var f=document.getElementById('foto1');
                 var t=document.getElementById('foto1').cloneNode(true);
                  t.value='';
                  f.parentNode.replaceChild(t,f);
                   var image_no = "imagenes/herramientas/Sin_Imagen.JPG";
                    var images=document.getElementById("inputimagen").value;

                    if (images==image_no){
                      $('#div_quitar_imagen').hide();
                    }
                    else{
                      $('#div_quitar_imagen').show();
                    }

                $('#modif_maquina').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

    function Devolucion(id){

        var url='modifica_prestamo.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);

               $('#idP').val(datos[0]);
                $('#fechaprestamomod').val(datos[1]);
                $('#encargadomod').val(datos[2]);
                $('#responsablemod').val(datos[3]);
                $('#estadomodP').val(datos[4]);

                if(datos[4]=='Activo')
                {
                    $('#divdevolucion').hide();
                    document.getElementById('devolucion').disabled=true;

                }
                $('#id_herramod').val(datos[5]);


                $('#modif_prestamo').modal({
                    show:true,
                    backdrop:'static'
                });

                $("#fechaprestamomod").attr('readonly',true);

        $("#fechaprestamomod").datetimepicker({
            format: 'DD/MM/YYYY',
            defaultDate: datos[1],
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });


            }
        });
    };




    function eliminarHerramienta(id){

        $('#aceptar_elim_herramienta').val(id);

        $('#elim_maq').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

     function eliminar_Herramienta(){

        var id = document.getElementById('aceptar_elim_herramienta').value;

        window.location.href="elim_herramienta.php?id="+id;
    };

//---FIN---------Herramientas--------------

//------------------prestamos-------------
   function editar_prestamo(id){

        var url='modifica_prestamos.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                var datos=eval(valores);
               $('#idmod').val(datos[0]);
                $('#fechamod').val(datos[1]);
                $('#encargadomod').val(datos[2]);
                $('#responsablemod').val(datos[3]);
                $('#estadomod').val(datos[4]);
                if(datos[4]=='Activo'){
                          $('#divdevolucion').hide();
                    document.getElementById('devolucion').disabled=true;

                }
                $('#id_herramod').val(datos[5]);

                $('#modif_maquina').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

    function detallePrestamo(id,id2){

    var url='detalle_prestamo.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'id_pre='+id+'&id_herra='+id2,
        success: function(valores){

            $('#detalle').html(valores);

            $('#detalle_maquina').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
};

function eliminarPrestamo(id,id2){

        $('#aceptar_elim_prestamo').val(id);
        $('#aceptar_elim_prestamo2').val(id2);
        $('#elim_pre').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

     function eliminar_Prestamo(){

        var id = document.getElementById('aceptar_elim_prestamo').value;
        var id2 = document.getElementById('aceptar_elim_prestamo2').value;

        window.location.href="elim_prestamo.php?id="+id+"&id2="+id2;
    };


//----------------entrada y salida------------------

function detalleEntradaI(id,id2){

        var url='detalle_entrada_i.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id+'&id2='+id2,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_entrada').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

    function detalleEntradaH(id,id2){

        var url='detalle_entrada_h.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id+'&id2='+id2,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_entrada').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

function eliminarEntrada(id){

        $('#aceptar_elim_entrada').val(id);

        $('#elim_ent').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

     function eliminar_Entrada(){

        var id = document.getElementById('aceptar_elim_entrada').value;
        var tipo= document.getElementById('tipo').value;
        window.location.href="elim_entrada.php?id="+id+"&tipo="+tipo;
    };

    function detalleSalidaI(id,id2){

        var url='detalle_salida_i.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id+'&id2='+id2,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_entrada').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

    function detalleSalidaH(id,id2){

        var url='detalle_salida_h.php';

        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id+'&id2='+id2,
            success: function(valores){

                $('#detalle').html(valores);

                $('#detalle_entrada').modal({
                    show:true,
                    backdrop:'static'
                });
                return false;
            }
        });
    };

function eliminarSalida(id){

        $('#aceptar_elim_salida').val(id);

        $('#elim_sal').modal({
            show:true,
            backdrop:'static'
        });

        confirm_user();
    };

     function eliminar_Salida(){

        var id = document.getElementById('aceptar_elim_salida').value;
        var tipo= document.getElementById('tipo').value;
        window.location.href="elim_salida.php?id="+id+"&tipo="+tipo;
    };

//Fin entrada y salida

 function habilitar(val)
 {
    if (val=='2')
    {
        if (document.getElementById('integrante2').checked)
        {
            document.getElementById("nacEst2").disabled=false;
            document.getElementById("ciEst2").disabled=false;
            document.getElementById("nomEst2").disabled=false;
            document.getElementById("apeEst2").disabled=false;
            document.getElementById("codTlf2").disabled=false;
            document.getElementById("tlfEst2").disabled=false;
            document.getElementById("correoEst2").disabled=false;
            document.getElementById("especialidad2").disabled=false;
        }
        else
        {
            document.getElementById("nacEst2").disabled=true;
            document.getElementById("ciEst2").disabled=true;
            document.getElementById("nomEst2").disabled=true;
            document.getElementById("apeEst2").disabled=true;
            document.getElementById("codTlf2").disabled=true;
            document.getElementById("tlfEst2").disabled=true;
            document.getElementById("correoEst2").disabled=true;
            document.getElementById("especialidad2").disabled=true;

            mostrarPrompt(" ", "Ci2", "red");
            mostrarPrompt(" ", "Nom2", "red");
            mostrarPrompt(" ", "Ape2", "red");
            mostrarPrompt(" ", "Tlf2", "red");
            mostrarPrompt(" ", "Correo2", "red");
            mostrarPrompt(" ", "Especialidad2", "red");
        }
    }

    if (val=='3')
    {
        if (document.getElementById('integrante3').checked)
        {
            document.getElementById("nacEst3").disabled=false;
            document.getElementById("ciEst3").disabled=false;
            document.getElementById("nomEst3").disabled=false;
            document.getElementById("apeEst3").disabled=false;
            document.getElementById("codTlf3").disabled=false;
            document.getElementById("tlfEst3").disabled=false;
            document.getElementById("correoEst3").disabled=false;
            document.getElementById("especialidad3").disabled=false;
        }
        else
        {
            document.getElementById("nacEst3").disabled=true;
            document.getElementById("ciEst3").disabled=true;
            document.getElementById("nomEst3").disabled=true;
            document.getElementById("apeEst3").disabled=true;
            document.getElementById("codTlf3").disabled=true;
            document.getElementById("tlfEst3").disabled=true;
            document.getElementById("correoEst3").disabled=true;
            document.getElementById("especialidad3").disabled=true;

            mostrarPrompt(" ", "Ci3", "red");
            mostrarPrompt(" ", "Nom3", "red");
            mostrarPrompt(" ", "Ape3", "red");
            mostrarPrompt(" ", "Tlf3", "red");
            mostrarPrompt(" ", "Correo3", "red");
            mostrarPrompt(" ", "Especialidad3", "red");

        }
    }
 }

 function habilitarM(val)
 {
    if (val=='2')
    {
        if (document.getElementById('integrante2M').checked)
        {
            document.getElementById("nacEst2M").disabled=false;
            document.getElementById("ciEst2M").disabled=false;
            document.getElementById("nomEst2M").disabled=false;
            document.getElementById("apeEst2M").disabled=false;
            document.getElementById("codTlf2M").disabled=false;
            document.getElementById("tlfEst2M").disabled=false;
            document.getElementById("correoEst2M").disabled=false;
            document.getElementById("especialidad2M").disabled=false;
        }
        else
        {
            document.getElementById("nacEst2M").disabled=true;
            document.getElementById("ciEst2M").disabled=true;
            document.getElementById("nomEst2M").disabled=true;
            document.getElementById("apeEst2M").disabled=true;
            document.getElementById("codTlf2M").disabled=true;
            document.getElementById("tlfEst2M").disabled=true;
            document.getElementById("correoEst2M").disabled=true;
            document.getElementById("especialidad2M").disabled=true;

            mostrarPrompt(" ", "Ci2M", "red");
            mostrarPrompt(" ", "Nom2M", "red");
            mostrarPrompt(" ", "Ape2M", "red");
            mostrarPrompt(" ", "Tlf2M", "red");
            mostrarPrompt(" ", "Correo2M", "red");
            mostrarPrompt(" ", "Especialidad2M", "red");
        }
    }

    if (val=='3')
    {
        if (document.getElementById('integrante3M').checked)
        {
            document.getElementById("nacEst3M").disabled=false;
            document.getElementById("ciEst3M").disabled=false;
            document.getElementById("nomEst3M").disabled=false;
            document.getElementById("apeEst3M").disabled=false;
            document.getElementById("codTlf3M").disabled=false;
            document.getElementById("tlfEst3M").disabled=false;
            document.getElementById("correoEst3M").disabled=false;
            document.getElementById("especialidad3M").disabled=false;
        }
        else
        {
            document.getElementById("nacEst3M").disabled=true;
            document.getElementById("ciEst3M").disabled=true;
            document.getElementById("nomEst3M").disabled=true;
            document.getElementById("apeEst3M").disabled=true;
            document.getElementById("codTlf3M").disabled=true;
            document.getElementById("tlfEst3M").disabled=true;
            document.getElementById("correoEst3M").disabled=true;
            document.getElementById("especialidad3M").disabled=true;

            mostrarPrompt(" ", "Ci3M", "red");
            mostrarPrompt(" ", "Nom3M", "red");
            mostrarPrompt(" ", "Ape3M", "red");
            mostrarPrompt(" ", "Tlf3M", "red");
            mostrarPrompt(" ", "Correo3M", "red");
            mostrarPrompt(" ", "Especialidad3M", "red");

        }
    }
 }

 function mostrarPrompt(mensaje, ubicacion, color)
{
        document.getElementById(ubicacion).innerHTML = mensaje;
        document.getElementById(ubicacion).style.color = color;
}
function jsMostrar(id)
{
        document.getElementById(id).style.display = "block";
}

function jsOcultar(id)
{
        document.getElementById(id).style.display = "none";
}


 $('body').find('input').attr("onpaste", function(){

            var opcion = "return false";
            //return parts[1] + +parts[2];
            return opcion;
        });

$('body').find('textarea').attr("onpaste", function(){

    var opcion = "return false";
    //return parts[1] + +parts[2];
    return opcion;
});


window.onload =  $("#carga").hide();
