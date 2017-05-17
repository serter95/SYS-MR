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



//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
  $id=$_REQUEST['id_maq'];


  $sql=pg_query("SELECT * FROM insumos i, numero_bien n WHERE i.id_insumos=".$id." AND i.n_b=n.id_nb AND i.estatus='1' LIMIT 1");

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
   margin-left: 80px;

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
        <h3 >Reporte de Insumo</h3>
    </div>
    
    <div>
        <table border="0" style="border-radius:10px;" align="center">
          <tr>
            <td align="center">
                <br>
                <b>Detalle del Insumo</b>
                <br>
            </td>
        </tr>
      </table>
      <table>
        <tr>
           

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Numero del bien</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" colspan="2"> 
               <label>Nombre</label>
           </td>

        </tr>
        <tr>
       
        <td border="1" align="center">
        <?php echo $array['nb']; ?> 

        </td>
        <td border="1" align="center" colspan="2">

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
        <label>Tipo de Medida</label>
        </td>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Medida</label>
        </td>
         <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Precio Unitario</label>
        </td>
        </tr>
        <tr>
                    
           <td border="1" align="center"> 
            <?php echo $array["tipo_medida"]; ?>
           </td>
           <td border="1"  align="center"> 
            <?php echo $array['medida']; ?>
           </td>
            <td border="1" align="center"> 
            <?php echo $array['precio_unitario']; ?>
           </td>
         </tr>
          <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
        <tr>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Existencia</label>
        </td>
         <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Buenas</label>
        </td>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Dañadas</label>
        </td>
        </tr>
         <tr>
           <td border="1" align="center">

        <?php echo $array['existencia']; ?> 

        </td>

         <td border="1" align="center">

        <?php echo $array['buenas']; ?> 

        </td>
         <td border="1" align="center">

        <?php echo $array['danadas']; ?> 

        </td>
          
       </tr>
       <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
       <tr>
        <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Min Stock</label>
        </td>
         <td border="1" width="200" height="10" class="td_title" align="center"> 
        <label>Max Stock</label>
        </td>
         <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Importe</label>
        </td>
        </tr>
         <tr>
           <td border="1" align="center">

        <?php echo $array['min_stock']; ?> 

        </td>

         <td border="1" align="center">

        <?php echo $array['max_stock']; ?> 

        </td>
          <td border="1" align="center">

        <?php echo $array['importe']; ?> 

        </td>
          
       </tr>
       <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
       <tr>
        <td border="1" width="200" height="10"  class="td_title" align="center" colspan="2"> 
        <label>Ubicación</label>
        </td>
         <td border="1" width="200" height="10"  class="td_title" align="center"> 
        <label>Estante</label>
        </td>
        </tr>
         <tr>
         

         <td border="1" align="center" colspan="2">

        <?php echo $array['ubicacion']; ?> 

        </td>
          <td border="1" align="center">

        <?php echo $array['estante']; ?> 

        </td>
      
          
       </tr>


   </table>
</div>
<!--<table border="0" style="border-radius:10px;" align="center" class="tabledate">
        <tr>
            <td align="center">
                <b>Mantenimiento Preventivo</b>
                <br>
            </td>
        </tr>
    </table>
    <br>
-->
<?php


/*
if ($columnas=='0'){
    ?>
    <div>
       <br>
       
    <table border="0" style="border-radius:10px;" align="center">

       <tr>
           <td border="1"  height="30"> 
               <label>Encargado de la revisión:<u> No </u></label>
           </td>
           <td border="1"> 
               <label>Fecha de revisión: <u> No </u></label>
           </td>
           <td border="1"> 
               <label>Nivel de Aceite: <u> No </u></label>
           </td>

       </tr>

       <tr>
        <td border="1" colspan="3">
            <label>Observaciones: <u> No </u></label>
            <br>
            <br>
        </td>
    </tr>
</table>
<div style="margin-top:100px">
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
</div>
<?php
/*}else{

    ?>
    <div style="position:relative;">
       
       
    <?php
    while($array2=pg_fetch_assoc($sql2)){
        $priv_ac=explode('-', $array2['fecha']);
        $pac1=$priv_ac[0];
        $pac2=$priv_ac[1].'-';
        $pac3=$priv_ac[2].'-';
        $fecha=$pac3.$pac2.$pac1;
        ?>

        <table border="0" style="border-radius:10px;" align="center">

           <tr>
               <td border="1"  height="30"> 
                   <label>Encargado de la revisión:<u> <?php echo $array2['encargado'];?> </u></label>
               </td>
               <td border="1"> 
                   <label>Fecha de revisión: <u> <?php echo $fecha; ?></u></label>
               </td>
               <td border="1"> 
              <label>Tipo de Servicio:<u> <?php echo $array2['tipo_servicio']; ?> </u></label>
               </td>

           </tr>
           <tr>
           <td border="1" height="30" colspan="2">
              <label>Responsable: <u> <?php echo $array2['responsable']; ?></u></label>
           </td>
           <td border="1" >
            <label>Nivel de Aceite: <u> <?php echo $array2['nivel_aceite']; ?></u></label>
           </td>
           </tr>
           <tr>
               <td border="1"  height="30"> 
                   <label>Luces de tablero:<u> <?php echo $array2['luces_tablero'];?> </u></label>
               </td>
               <td border="1"> 
                   <label>Parada de emergencia: <u> <?php echo $array2['parada_emergencia'] ?></u></label>
               </td>
               <td border="1"> 
                   <label>Pulsadores: <u> <?php echo $array2['pulsadores']; ?></u></label>
               </td>

           </tr>
           <tr>
            <td border="1" colspan="3">
                <label>Observaciones: <u> <?php echo $array2['observaciones']; ?></u></label>
                <br>
                <br>
            </td>
        </tr>

    </table>   <br>
    <?php }?> <br><br>
    <div>
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
</div>
<?php }*/ ?> 





</page>