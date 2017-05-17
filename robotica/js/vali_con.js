  function soloLetras(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
  //       especiales = "8-37-39-46";
  especiales=['8','37','46','9'];
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
      especiales=['8','127','9','46'];
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
         especiales=['8','127','9','46'];
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
  especiales=['8','127','9'];
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



        function solonum4(e){
         key = e.keyCode || e.which;
         tecla = String.fromCharCode(key).toLowerCase();
         letras = "1234567890/";

         if(letras.indexOf(tecla)==-1 ){
          return false;
        }
      }

      function validarcoma(e,field){
        key = e.keyCode ? e.keyCode:e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = "1234567890,";

        if(letras.indexOf(tecla)==-1 ){
          return false;
        }
        if (key === 8)
          return true;
        if(field.value!==""){
          if((field.value.indexOf(","))>0){
            if(key>47 && key < 58){
              if(field.value==="")
                return true;
              regexp=/[0-9](1,10)[,][0-9](1,3)$/;
              regexp=/[0-9](2)$/;
              return !(regexp.test(field.value));
            }
          }
        }
        if (key > 47 && key < 58){
          if (field.value === "")
            return true;
          regexp=/[0-9](10)/;
          return !(regexp.test(field.value));
        }

        if(key === 44){
          if (field.value==="")
            return false;
          regexp=/^[0-9]+$/;
          return regexp.test(field.value);
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


    function soloAlfa2(e){
     key = e.keyCode || e.which;
     tecla = String.fromCharCode(key).toLowerCase();
     letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890,.-";
         //especiales = "8-37-39-46";
         especiales=['8','37','46','9','13'];


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



      function existeTitulo(){
       var user = document.getElementById("titulo").value;

       var consulta;

       consulta=$("#titulo").val();
  //var consultax;
  //consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
  var tipo="registro";



  $.ajax({
    type:"POST",
    url:"verificar_titulo_convenio.php",
    data:"titulo="+consulta+"&tipo="+tipo,
    success: function (data){

      $('#res').val(data);


      var valor2 = document.getElementById("res").value;
      var code = document.getElementById("titulo").value;

      if (valor2==1)
      {

       mostrarPrompt("Ya en uso", "tituloPrompt", "red");

     }
     if (valor2==0)
     {
       mostrarPrompt("Valido", "tituloPrompt", "green");

     }
     if (code == ""){
       mostrarPrompt("Campo Requerido", "tituloPrompt", "red");

     }
   }

  });


  var valor = document.getElementById("res").value;
  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "tituloPrompt", "red");
      return false;
    }
  if(user.length == 0){
   mostrarPrompt("Campo Requerido", "tituloPrompt", "red");
   return false;
  }

  if (valor==1)
  {


    return false;
  }
  if (valor==0)
  {


    return true;
  }


  }

  function existeTitulo2(){
   var user = document.getElementById("titulomod").value;
   var id= document.getElementById("idmod").value;
   var consulta;

   consulta=$("#titulomod").val();
  //var consultax;
  //consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);
  var tipo="modificacion";
  //algo=String(algo);

  $.ajax({
    type:"POST",
    url:"verificar_titulo_convenio.php",
    data:"titulo="+consulta+"&id="+id+"&tipo="+tipo,
    success: function (data){

      $('#resMC').val(data);

      var valor2 = document.getElementById("resMC").value;
      var code = document.getElementById("titulomod").value;

      if (valor2==0)
      {

       mostrarPrompt("Ya en uso", "titulomodPrompt", "red");

     }
     if (valor2==1)
     {
       mostrarPrompt("Valido", "titulomodPrompt", "green");

     }
     if (code == ""){
       mostrarPrompt("Campo Requerido", "titulomodPrompt", "red");

     }

   }

  });


  var valor = document.getElementById("resMC").value;
   /*if(user.length == 0){
           mostrarPrompt("Campo Requerido", "CodePrompt", "red");
          return false;
        }*/
        if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "titulomodPrompt", "red");
      return false;
    }
        if(user.length == 0){

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



      

  function validarEnte1(){
    var ubicacion = document.getElementById("ente1").value;
   
    if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "ente1Prompt", "red");
     return false;
   }
    if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "ente1Prompt", "red");
      return false;
    }
   else{
    mostrarPrompt("Valido", "ente1Prompt", "green");
    return true;
  }
  }

  function validarEnte2(){
    var ubicacion = document.getElementById("ente2").value;
   
    if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "ente2Prompt", "red");
     return false;
   }
    if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "ente2Prompt", "red");
      return false;
    }
   else{
    mostrarPrompt("Valido", "ente2Prompt", "green");
    return true;
  }
  }

  function validarEnte1mod(){
    var ubicacion = document.getElementById("ente1mod").value;
   
    if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "ente1modPrompt", "red");
     return false;
   }
    if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "ente1modPrompt", "red");
      return false;
    }
   else{
    mostrarPrompt("Valido", "ente1modPrompt", "green");
    return true;
  }
  }

  function validarEnte2mod(){
    var ubicacion = document.getElementById("ente2mod").value;
        if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "ente2modPrompt", "red");
     return false;
   }
   if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "ente2modPrompt", "red");
      return false;
    }

   else{
    mostrarPrompt("Valido", "ente2modPrompt", "green");
    return true;
  }
  }

  function validarContratante(){
    var ubicacion = document.getElementById("contratante").value;
    
    if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "contratantePrompt", "red");
     return false;
   }
   if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "contratantePrompt", "red");
      return false;
    }
   else{
    mostrarPrompt("Valido", "contratantePrompt", "green");
    return true;
  }
  }

  function validarContratantemod(){
    var ubicacion = document.getElementById("contratantemod").value;
    if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "contratantemodPrompt", "red");
     return false;
   }
    if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "contratantemodPrompt", "red");
      return false;
    }
   
   else{
    mostrarPrompt("Valido", "contratantemodPrompt", "green");
    return true;
  }
  }


  function validarContratado(){
    var ubicacion = document.getElementById("contratado").value;
    
    if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "contratadoPrompt", "red");
     return false;
   }
   if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "contratadoPrompt", "red");
      return false;
    }
   else{
    mostrarPrompt("Valido", "contratadoPrompt", "green");
    return true;
  }
  }

  function validarContratadomod(){
    var ubicacion = document.getElementById("contratadomod").value;
   
    if(ubicacion==""){
     mostrarPrompt("Campo Requerido", "contratadomodPrompt", "red");
     return false;
   }
    if (ubicacion.match(/^\s/))
    {
      mostrarPrompt("Invalido", "contratadomodPrompt", "red");
      return false;
    }
   else{
    mostrarPrompt("Valido", "contratadomodPrompt", "green");
    return true;
  }
  }

  function valida_fecha_mayor(){


    var split_fecha;

    var fecha=document.getElementById('fecha').value;

    split_fecha = fecha.split("/");

    fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

    var split_fecha2;

    var nextfecha=document.getElementById('fecha2').value;

    split_fecha2 = nextfecha.split("/");

    nextfecha=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];
        var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        var dateNext=new Date(year, month, day);

        var tercera = Date.parse(dateNext); 

          //var nextfecha=document.getElementById('nextfecha').value;
   var primera = Date.parse(fecha); //01 de Octubre del 2013
  var segunda = Date.parse(nextfecha); //03 de Octubre del 2013
   var primera = Date.parse(fecha); //01 de Octubre del 2013
  var segunda = Date.parse(nextfecha); //03 de Octubre del 2013
  if(fecha == ""){
    mostrarPrompt("Campo Requerido", "fechaiPrompt", "red");
    return false;
  }
  else if (primera > segunda) {
    mostrarPrompt("La fecha inicio debe ser menor a la fecha final", "fechaiPrompt", "red");
    return false;
  }
  else if (primera == segunda){
    mostrarPrompt("La fecha inicio debe ser menor a la fecha final", "fechaiPrompt", "red");
    return false;
  }
 else if (primera > tercera) {
    mostrarPrompt("La fecha debe ser menor o igual al dia de hoy", "fechaiPrompt", "red");
    return false;
  }  
  else{
    mostrarPrompt("Valido", "fechaiPrompt", "green");
    return true;
  }
          //alert("funcion personal "+ci);

        }
        function valida_fechaf(){
          var fecha=document.getElementById('fecha2').value;

          if(fecha == ""){
            mostrarPrompt("Campo Requerido", "fechafPrompt", "red");
            return false;
          }
          else{
            mostrarPrompt("Valido", "fechafPrompt", "green");
            return true;

          }


        }

        function valida_fecha_mayormod(){

          var fecha=document.getElementById('fechaimod').value;
          var nextfecha=document.getElementById('fechafmod').value;

           var d = new Date();
          var month = d.getMonth();
          var day = d.getDate();
          var year = d.getFullYear();

          var dateNext=new Date(year, month, day);

          var tercera = Date.parse(dateNext); 

  split_fecha = fecha.split("/");

  fecha=split_fecha[2]+"/"+split_fecha[1]+"/"+split_fecha[0];

   split_fecha2 = nextfecha.split("/");

  nextfecha=split_fecha2[2]+"/"+split_fecha2[1]+"/"+split_fecha2[0];

   var primera = Date.parse(fecha); //01 de Octubre del 2013
  var segunda = Date.parse(nextfecha); //03 de Octubre del 2013
  if(fecha == ""){
    mostrarPrompt("Campo Requerido", "fechaimodPrompt", "red");
    return false;
  }
  if (primera > segunda) {
    mostrarPrompt("La fecha inicio debe ser menor a la fecha final", "fechaimodPrompt", "red");
    return false;
  }
  if (primera == segunda){
    mostrarPrompt("La fecha inicio debe ser menor a la fecha final", "fechaimodPrompt", "red");
    return false;
  }
   if(primera>tercera){
    mostrarPrompt("La fecha debe ser menor o igual al dia de hoy", "fechaimodPrompt", "red");
    return false;

            }
  else{
    mostrarPrompt("Valido", "fechaimodPrompt", "green");
    return true;
  }
          //alert("funcion personal "+ci);

        }

        function valida_fechafmod(){
          var fecha=document.getElementById('fechafmod').value;

          if(fecha == ""){
            mostrarPrompt("Campo Requerido", "fechafmodPrompt", "red");
            return false;
          }
          else{
            mostrarPrompt("Valido", "fechafmodPrompt", "green");
            return true;

          }


        }


        function validarClausulas(){
          var ubicacion=document.getElementById('clausulas').value;

          if(ubicacion== ""){
            mostrarPrompt("Campo Requerido", "clausulasPrompt", "red");
            return false;
          }

          else{
            mostrarPrompt("Valido", "clausulasPrompt", "green");
            return true;

          }


        }

        


        function validarForm()
        {
    //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
    if( !existeTitulo() || !validarEnte1() || !validarEnte1() || !validarContratante() || !validarContratado() || !valida_fecha_mayor() || !valida_fechaf() ){
      /*    $('#error_incompleto').modal({
                      show:true,
                      backdrop:'static'
                    }).show(200);*/
  jsMostrar("mensaje_incorrecto");

  mostrarPrompt("El formulario debe estar completo", "mensaje_incorrecto","red");

  setTimeout(function()
  {
    jsOcultar("mensaje_incorrecto");

  }, 2000);
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

      function validarmodform(){
       if(!existeTitulo2() || !validarEnte1mod() || !validarEnte2mod() || !validarContratantemod() || !validarContratadomod() || !valida_fecha_mayormod() || !valida_fechafmod() ){

         jsMostrar("mensaje_incorrectomod");

         mostrarPrompt("El formulario debe estar completo", "mensaje_incorrectomod","red");

         setTimeout(function()
         {
          jsOcultar("mensaje_incorrectomod");

        }, 2000);
         return false;
       } 
       return true; 
     }

     function validarForm_mod()
     {
    //validaCodigo dunciona para todos WTF  aqui iba !validarCodigo() ||
    if( !valida_fechamod()  ){
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



  //clausulas
   $('#r_clausulas').hide();
   $('#c_clausulas').hide();

     $('#agregar_clau').click(function(){
      $('#c_clausulas').hide();
      $('#consulta_insu').hide();
      $('#r_clausulas').show();
    });

    

      $('#linkclausulas').click(function(){
      $('#c_clausulas').show();
      $('#consulta_insu').hide();
      $('#r_clausulas').hide();
    });

  function buscaTituloid(){
    //var user=document.getElementById("titulo_clau").value;
    var id=$('#id_convenio').val();
/*
    if(user=='0'){
         $('#id_convenio').val("");
       $('#ente1_clau').val("");
       $('#ente2_clau').val("");
       $('#contratante_clau').val("");
       $('#contratado_clau').val("");
       $('#fechai_clau').val("");
       $('#fechaf_clau').val("");
      mostrarPrompt("Campo Requerido", "tituloCPrompt", "red");
      return false;
    }*/
   
    $.ajax({
      type:"POST",
      url:"modifica_convenio.php",
      data:'id='+id,
      success: function (valores){
       var datos=eval(valores);
       $('#id_convenio').val(datos[0]);
       $('#ente1_clau').val(datos[2]);
       $('#ente2_clau').val(datos[3]);
       $('#contratante_clau').val(datos[4]);
       $('#contratado_clau').val(datos[5]);
       $('#fechai_clau').val(datos[6]);
       $('#fechaf_clau').val(datos[7]);
     }
   });
    mostrarPrompt("Valido", "tituloCPrompt", "green");
     return true;
    
  }

  function validar_Clausulasmulti(){

  user = document.getElementsByName('clausulas[]');

      for (i=0; i<user.length; i++)
    {

    //  j=i+1;
        var aqui;
          aqui=user[i].id;
         aqui=aqui.split("clausula");
         aqui=aqui[1];
        
         //existencia=parseInt(existencia);

      if (user[i].value == '')
      {
        //alert("¡Existen estilos sin completar!");
        

       mostrarPrompt("Campo Requerido", "clausulasPrompt"+aqui, "red");

        
        return false;
      }
      else if(!user[i].value.match(/^[ a-zA-ZñáéíóúüÑÁÉÍÓÚÜ 0-9,.-]{1,}$/)){
         
         mostrarPrompt("Invalido", "clausulasPrompt"+aqui, "red");
       return false;     
        }
      else if (user[i].value.match(/^\s/))
    {
      mostrarPrompt("Invalido", "clausulasPrompt"+aqui, "red");
      return false;
    }
    
    else{
          
         mostrarPrompt("Valido", "clausulasPrompt"+aqui, "green");
         
        }
        var id=document.getElementById("id_convenio").value;
    $.ajax({
            type:'POST',
            url:"buscando_clausulas.php",
            data:'id='+id+'&valor='+user[i].value,
            success:function(valores){
              
              if (valores==1){

              }
              else{
           mostrarPrompt("Hay una clausula que ya esta registrada", "clausulasPrompt"+aqui, "red");
              return false;
              }
            }
             
        });
    }


       for (i=0; i<user.length; i++) {                        // outer loop uses each item i at 0 through n
             for (j=i+1; j<user.length; j++) {              // inner loop only compares items j at i+1 to n
      if (user[i].value==user[j].value){
        var idr;
                idr=user[j].id;
                idr=idr.split("idR");
               idr=idr[1];
            
       mostrarPrompt("Hay un clausula ya repetida", "clausulasPrompt"+aqui, "red");
        
        return false;
      }

     }
   }
      
    return true;    
 
}

function validarFormC(){
       if(!validar_Clausulasmulti() ){

         jsMostrar("mensaje_incorrectoC");

         mostrarPrompt("El formulario debe estar completo", "mensaje_incorrectoC","red");

         setTimeout(function()
         {
          jsOcultar("mensaje_incorrectoC");

        }, 2000);
         return false;
       } 
       return true; 
     }


function validarClausulasmod(){
          var ubicacion=document.getElementById('clausulamod').value;

          if(ubicacion== ""){
            mostrarPrompt("Campo Requerido", "clausulamodPrompt", "red");
            return false;
          }
          if (ubicacion.match(/^\s/))
            {
              mostrarPrompt("Invalido", "clausulamodPrompt", "red");
              return false;
            }
          else{
            mostrarPrompt("Valido", "clausulamodPrompt", "green");
            return true;

          }


        }

function validarFormCmod(){
       if(!validarClausulasmod() ){

         jsMostrar("mensaje_incorrectoCmod");

         mostrarPrompt("El formulario debe estar completo", "mensaje_incorrectoCmod","red");

         setTimeout(function()
         {
          jsOcultar("mensaje_incorrectoCmod");

        }, 2000);
         return false;
       } 
       return true; 
     }

  function validarSeguimientomod(){
          var seguimiento=document.getElementById('seguimientomod').value;

          if(seguimiento== ""){
            mostrarPrompt("Campo Requerido", "seguimientomodPrompt", "red");
            return false;
          }
          else{
            mostrarPrompt("Valido", "seguimientomodPrompt", "green");
            return true;

          }


        }

  function limitaInputS(input){
    if(input.value < 0){
      input.value=0;
    }
      if (input.value>100){
        input.value=100;
      }
    
  }

  function validarFormSmod(){
       if(!validarSeguimientomod() ){

         jsMostrar("mensaje_incorrectoSmod");

         mostrarPrompt("El formulario debe estar completo", "mensaje_incorrectoSmod","red");

         setTimeout(function()
         {
          jsOcultar("mensaje_incorrectoSmod");

        }, 2000);
         return false;
       } 
       return true; 
     }

     //end clausulas

    var d = new Date();
    var month = d.getMonth();
    var day = d.getDate();
    var year = d.getFullYear();
    var dateNow=new Date(year, month, day);

       $("#fechaimod").attr('readonly',true);

        $("#fechaimod").datetimepicker({
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

          $("#fechafmod").attr('readonly',true);

        $("#fechafmod").datetimepicker({
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });
    