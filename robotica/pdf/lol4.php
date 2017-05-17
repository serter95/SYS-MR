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
    $id2=$_REQUEST['id'];
    $sql=pg_query("SELECT * FROM maquinas m, numero_bien n WHERE id_maquina=".$id." AND m.n_b=n.id_nb LIMIT 1");

    $array=pg_fetch_assoc($sql);
$user=$_REQUEST['user'];

    $sql2=pg_query("SELECT * FROM mant_correctivo c, personal p WHERE id_correctivo=".$id2." AND c.id_personal=p.id LIMIT 1");



    $columnas=pg_num_rows($sql2);

/*  NO COLOCAR BODY DAÑA EL PAGE        


$cadconex="host='localhost' port='5432' dbname='maquinas' user='postgres' password='12345'";

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
$conexion = pg_connect($cadconex);

//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
$datos=pg_query($conexion,"SELECT * FROM maquinas WHERE estatus='1' ORDER BY codigo ASC");

//$totales = pg_num_rows($datos);
$columnas=pg_num_fields($datos*/?>

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

<page orientation='P' backtop="22mm" backbottom="14mm" backleft="10mm" backright="10mm" footer="page; heure;">
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
        <h3 >Reporte de Máquina</h3>
    </div>
    
    <div>
        <table border="0" style="border-radius:10px;" align="center">
          <tr>
            <td colspan="3" align="center">
                <br>
                <b>Detalle de la Máquina</b>
                <br>
            </td>
        </tr>
        <tr>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Codigo de la Máquina</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Numero del bien</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
               <label>Máquina</label>
           </td>

        </tr>
        <tr>
        <td border="1" align="center">

        <?php echo $array['codigo']; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array['nb']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array['maquina']; ?> 

        </td>
        </tr>
        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
         <tr>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Estado</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Marca</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
               <label>Modelo</label>
           </td>
        </tr>
<tr>
        <td border="1" align="center">

        <?php echo $array['estado']; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array['marca']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array['modelo']; ?> 

        </td>
        </tr>

     </table>
 </div>

 <?php


 if ($columnas=='0'){
    ?>
    <div>
     <br>

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
}else{

    ?>
    <div>
     <br>
     <table border="0" style="border-radius:10px;" align="center" class="tabledate">
        <tr>
            <td align="center">
                <b>Mantenimiento Correctivo</b>
                <br>
            </td>
        </tr>
    </table>
    <?php
    $array2=pg_fetch_assoc($sql2);
        $priv_ac=explode('-', $array2['fecha_falla']);
        $pac1=$priv_ac[0];
        $pac2=$priv_ac[1].'/';
        $pac3=$priv_ac[2].'/';
        $fecha=$pac3.$pac2.$pac1;

        $fechas=explode('-', $array2['fecha']);
        $fechas1=$fechas[0];
        $fechas2=$fechas[1].'/';
        $fechas3=$fechas[2].'/';
        $fechas=$fechas3.$fechas2.$fechas1;

         $fechae=explode('-', $array2['fecha_ejecucion']);
        $fechae1=$fechae[0];
        $fechae2=$fechae[1].'/';
        $fechae3=$fechae[2].'/';
        $fechae=$fechae3.$fechae2.$fechae1;

        $nombre_per=explode(' ', $array2['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $array2['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;
        ?>

        <table border="0" style="border-radius:10px;" align="center">
            <tr>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Supervisor</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Responsable</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
                <label>Fecha de la Solicitud</label>
           </td>

        </tr>
        <tr>
        <td border="1" align="center">

        <?php echo $encargado_mant; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array2['responsable']; ?> 

        </td>
        <td border="1" align="center">

         <?php echo $fechas; ?> 

        </td>
        </tr>
        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
        <?php if($array2['estado']=="en proceso") { ?>
        <tr>
        <?php if($array2['tipo_servicio']=="externo"){ ?>
            <td width="210" border="1"  colspan="2"  class="td_title" align="center" style="width:0px;"> 
              <label>Tipo de Servicio</label>
            </td>

             <td border="1" width="210"   class="td_title" align="center" > 
                 <label>Proveedor</label>
           </td>
           </tr>
            <tr>
       
        <td border="1" align="center" colspan="2">
       
        <?php echo $array2['tipo_servicio']; ?> 

        </td>

        <td border="1" align="center">

        <?php echo $array2['proveedor']; ?> 

        </td>
        </tr>
           <?php } else {
            ?>

            <td width="210" border="1"  colspan="3"  class="td_title" align="center" style="width:0px;"> 
              <label>Tipo de Servicio</label>
            </td>
            </tr>
             <tr>
     
        <td border="1" align="center" colspan="3">
       
        <?php echo $array2['tipo_servicio']; ?> 

        </td>
        </tr> 
            <?php

            } ?>
         
        
        <?php }
        else {
         ?>
        
        <tr>
            
             <?php if($array2['tipo_servicio']=="externo"){ ?>

             <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
              <label>Fecha de la Ejecución</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
              <label>Tipo de Servicio</label>
            </td>

   

             <td border="1" width="210"   class="td_title" align="center" > 
                 <label>Proveedor</label>
           </td>
           <?php } 

           else{
            ?>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
              <label>Fecha de la Ejecución</label>
            </td>
            
            <td width="210" border="1" colspan="2"   class="td_title" align="center" style="width:0px;"> 
              <label>Tipo de Servicio</label>
            </td>
            <?php
            }

            ?>
        </tr>
        <tr>
        <?php if($array2['tipo_servicio']=="externo"){ ?>

        <td border="1" align="center">

       <?php echo $fechae; ?> 

        </td>
        <td border="1" align="center">
       
        <?php echo $array2['tipo_servicio']; ?> 

        </td>
       

        <td border="1" align="center">

        <?php echo $array2['proveedor']; ?> 

        </td>
           <?php } 

           else{ ?>

            <td border="1" align="center">

       <?php echo $fechae; ?> 

        </td>
        <td border="1" align="center" colspan="2">
       
        <?php echo $array2['tipo_servicio']; ?> 

        </td>
       


           <?php


           }
           ?>
        </tr>


        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
             <tr>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
              <label>Fecha de la falla</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
              <label>Hora de la falla</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
                 <label>Hora del Arranque</label>
           </td>

        </tr>
        <tr>
        <td border="1" align="center">

       <?php echo $fecha; ?> 

        </td>
        <td border="1" align="center">
       
        <?php echo $array2['hora_falla']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array2['horas_arranque']; ?> 

        </td>
        </tr>
        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
        
          <tr>
           <td  border="1" class="td_title" width="210" align="center" style="width:0px;" colspan="2">
             <label>Observaciones</label>
           </td>
           <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
             <label>Costo</label>
           </td>
         </tr>

         <tr>
            <td border="1" colspan="2" align="center">
                <?php echo $array2['observaciones']; ?>
            </td>
            <td border="1" align="center">
                <?php echo $array2['costo']; ?>
            </td>
        </tr>

        <?php } ?>

    </table> 
      <br>
      <br><br>
    <br><br>
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
<?php } ?> 





</page>