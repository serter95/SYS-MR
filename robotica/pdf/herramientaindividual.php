<?php 
//setlocale(LC_ALL,"es_ES");
//date_default_timezone_set('UTC');
date_default_timezone_set('America/Caracas');
$hoy=date('h:i:s A');

$fecha = date('d/m/Y');
$fechas = date('d-m-Y');
$hoys=date('h:i A');
$d=date('d');
$m=date('m');
$y=date('Y');


//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";

//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
$id=$_REQUEST['id_maq'];


  $sql=pg_query("SELECT * FROM herramientas i, numero_bien n WHERE i.id_herramienta='".$id."' AND i.n_b=n.id_nb AND i.estatus='1' LIMIT 1");
  
  $array=pg_fetch_assoc($sql);
//$user=$_REQUEST['user'];

  //$sql2=pg_query($conexion,"SELECT * FROM mant_preventivo WHERE maquina_id=".$id." ORDER BY fecha DESC");



  //$columnas=pg_num_rows($sql2);
//  NO COLOCAR BODY DAÑA EL PAGE        
?>

    <style type="text/css">
    <!--

    .center_header{
        margin-left: 230px; padding: 0;
    }
    .center{
      margin-left: 240px; padding: 0;

  }

  .tabledate{
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    margin-left: 20px;
    border: 1px solid #ddd;
    border-collapse: separate !important;
    background-color: transparent;
    border-spacing: 0;
    display: table;
}
.td_title{
    width:100px;
    text-align: center; 
    background-color:#0061C5;
    color:#fff;
}

table.page_header{
    width: 100%;
    border: none;

    margin: 0 auto;
    margin-left: 180px; padding: 0;
    display: inline-block;
}
table.footer_header{
    width: 100%;
    border: none;

    margin: 0 auto;
    margin-left: 250px; padding: 0;

}

#lol{
   margin-left: 100px;

   position: absolute;
}

#fecha{
    margin-left: 680px;
    position: absolute;
}
-->
</style>

<page orientation='P' backtop="22mm" backbottom="14mm" backleft="10mm" backright="10mm" footer="page;">
    <page_header style="margin-bottom:20px;">
    <div id="lol" >
        <img src="upta.jpg" alt="Logo" height="80" width="90" />
    </div>
    <table class="page_header" >
             <?php
       include("membrete.php");
       $bar=membrete();
       echo $bar;
?>

    </table>
    <div id="fecha">
        <?php echo $fecha;?>
    </div>
    </page_header>
    <page_footer>
    <table class="footer_header" >
        <tr>
            <td align="center">
                <span>&copy; Derechos Reservados</span><br>
                <span>Documento generado por el usuario: <?php echo $_SESSION['nom_usuario']; ?></span><br>

            </td>
        </tr>

    </table>
    </page_footer>

    <div class="center">
        <h3 >Reporte de Herramienta</h3>
    </div>
    
    <div>
        <table border="0" style="border-radius:10px;" align="center">
          <tr>
            <td align="center">
                <br>
                <b>Detalle de la herramienta</b>
                <br>
            </td>
        </tr>
      </table>
      <table>
        <tr>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Codigo de la herramienta</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Numero del bien</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
               <label>Nombre</label>
           </td>

        </tr>
        <tr>
        <td border="1" align="center">

        <?php echo $array['codigo_herramienta']; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array['nb']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array['nombre']; ?> 

        </td>
        </tr>
        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
        <tr>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Serial</label>
        </td>
         <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Marca</label>
        </td>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Estado</label>
        </td>
        </tr>
         <tr>
           <td border="1" align="center">

        <?php echo $array['serial']; ?> 

        </td>

         <td border="1" align="center">

        <?php echo $array['marca']; ?> 

        </td>
         <td border="1" align="center">

        <?php echo $array['estado']; ?> 

        </td>
          
       </tr>
       <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
       <tr>
        <td border="1" width="200" height="10"  class="td_title" align="center" colspan="3"> 
        <label>Ubicación</label>
        </td>
       
        </tr>
         <tr>
           <td border="1" align="center" colspan="3">

        <?php echo $array['ubicacion']; ?> 

        </td>

         
          
       </tr>
    


   </table>

   <?php
    if($array['estado']=="En prestamo"){
       $sqlprestamo="SELECT * FROM herramientas h , prestamo p, personal s WHERE h.id_herramienta='".$id."' AND h.id_herramienta=p.id_herramienta AND p.id_personal=s.id AND h.estatus='1' AND p.estatus='1'";
       $queryprestamo=pg_query($sqlprestamo);
       $fila=pg_fetch_assoc($queryprestamo);



                           $fecha_a=explode('-',  $fila['realizado']);
                           //$fecha_a2=explode('-', $array2['realizado']);
                           $ano=$fecha_a[0];
                           $mes=$fecha_a[1].'/';
                           $dia=$fecha_a[2].'/';
                           $fecha=$dia.$mes.$ano;

                           $fecha_a2=explode('-',  $fila['tentativa']);
                           //$fecha_a2=explode('-', $array2['realizado']);
                           $ano2=$fecha_a2[0];
                           $mes2=$fecha_a2[1].'/';
                           $dia2=$fecha_a2[2].'/';
                           $fecha2=$dia2.$mes2.$ano2;

                            $nombre_per=explode(' ', $fila['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $fila['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado=$pri_nom.' '.$prim_ape;
      ?>
           <table border="0" style="border-radius:10px;" align="center">
          <tr>
            <td align="center">
                <br>
                <b>Detalle del Prestamo</b>
                <br>
            </td>
        </tr>
      </table>

        <table align="center">
          <tr>
          <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Encargado</label>
        </td>
        
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Responsables</label>
        </td>
          </tr>
          <tr>
           <td border="1" align="center">

        <?php echo $encargado; ?> 

        </td>

      
         <td border="1" align="center">

        <?php echo $fila['responsable']; ?> 

        </td>
          
       </tr>
       <tr>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Fecha del Prestamo</label>
        </td>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Fecha Tentativa de Devolución</label>
        </td>
       </tr>
       <tr>
          <td border="1" align="center">

        <?php echo $fecha; ?> 

        </td>
         <td border="1" align="center">

        <?php echo $fecha2; ?> 

        </td>

       </tr>
        </table>
      <?php
    }
   ?>
   <br>
   <br>
   <br>
   <br>
   <br>
   <table  align="center">
        <tr>
            <td>
                __________________________________________<br>
            </td>
        </tr>
        <tr>
            <td >
                <div style="margin-left: 100px;">
                    Nombre: <br>
                    CI:
                </div>
            </td>
        </tr>
    </table>
</div>
</page>