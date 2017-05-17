$(document).ready(function(){

	$("#slideshow").cycle({
			fx:'blindY'
		});

		/* 	blindX
			blindY
			blindZ
			cover
			curtainX
			curtainY
			fade
			fadeZoom
			growX
			growY
			scrollUp
			scrollDown
			scrollLeft
			scrollRight
			scrollHorz
			scrollVert
			shuffle
			slideX
			slideY
			toss
			turnUp
			turnDown
			turnLeft
			turnRight
		*/

		$("#slideshow2").cycle({
			fx:'blindY'
		});

		/* 	blindX
			blindY
			blindZ
			cover
			curtainX
			curtainY
			fade
			fadeZoom
			growX
			growY
			scrollUp
			scrollDown
			scrollLeft
			scrollRight
			scrollHorz
			scrollVert
			shuffle
			slideX
			slideY
			toss
			turnUp
			turnDown
			turnLeft
			turnRight
		*/

	$("#datepicker").datepicker({
		firstDay: 1,
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
	 	'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S\u00e1']
	});

	$('#dialogo').button();

	//Damos formato a la ventana de dialogo
	$('#dialogoformulario').dialog({
		//indica que la ventana se abre de forma automatica
		autoOpen: false,
		//indica si la venta es modal es decir que no permite tocar lo que esta atras
		modal:true,
		//largo
		width: 400,
		//alto
		height: 'auto',	
	});

	$('#dialogo').click(function(){
		$('#dialogoformulario').dialog('open');
	});
	//validacion del formulario con javascript

	/*$('#formajax').validate({
		submitHandler:function(){
			str = $('#formajax').serialize();
			alert(str);
			window.location.href="validacion_usuario.php?datos_usu="+str;
			/*str.open("GET","validacion_usuario.php?datos_usu="+str,true);
            str.send(null);
		},
			event: "blur",
		rules: {
			'user_name': "required",
			'password': "required"
			},
		messages:{
			'user_name': "por favor introduzca un nombre",
			'password': "por favor introduzca su clave"
				},
			
		errorPlacement:function(error,element){
			error.appendTo(element.prev("span").append());
		}

	});*/

	//$("#SignupForsm").formToWizard({ submitButton: 'SaveAccount' });
});


function detalleProyecto(id){

		//alert(id);
        
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

function reportando_Horario(id_seccion,id_periodo,pagina)
	{
        window.open("pdf/reporte_horario.php?id_seccion="+id_seccion+"&id_periodo="+id_periodo+"&pagina="+pagina,"_blank");
    };

function rep_prof(pagina)
{
	var ci=document.getElementById('ced_p').value;
	var periodo=document.getElementById('periodo').value;

	if (ci==0 || periodo==0)
	{
		$('#error').show();
		
		setTimeout(function()
        {
          $("#error").hide();
        }, 2000);
	}
	if (ci!=0 && periodo!=0)
	{
		window.open("pdf/reporte_horario_individual.php?id="+ci+"&periodo="+periodo+"&pagina="+pagina,"_blank");
	}
}