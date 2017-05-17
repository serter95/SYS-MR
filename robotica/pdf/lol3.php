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
    $id2=$_REQUEST['id'];
    $sql=pg_query("SELECT * FROM maquinas m, numero_bien n WHERE id_maquina=".$id." AND m.n_b=n.id_nb LIMIT 1");

    $array=pg_fetch_assoc($sql);
$user=$_REQUEST['user'];

    $sql2=pg_query("SELECT * FROM mant_preventivo p, personal s WHERE p.id_preventivo=".$id2." AND p.id_personal=s.id LIMIT 1");

    $sql3=pg_query("SELECT * FROM repuestos WHERE id_preventivo=".$id2." ");

    $columnas=pg_num_rows($sql2);
    $columnas3=pg_num_rows($sql3);
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
     <table border="0" style="border-radius:10px;" align="center" class="tabledate">
        <tr>
            <td align="center">
                <b>Mantenimiento Preventivo</b>
                <br>
            </td>
        </tr>
    </table>
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
}else{

    ?>
    <div>
     <br>
     <table border="0" style="border-radius:10px;" align="center" class="tabledate">
        <tr>
            <td align="center">
                <b>Mantenimiento Preventivo</b>
                <br>
            </td>
        </tr>
    </table>
    <?php
    $array2=pg_fetch_assoc($sql2);
        $priv_ac=explode('-', $array2['fecha']);
        $pac1=$priv_ac[0];
        $pac2=$priv_ac[1].'/';
        $pac3=$priv_ac[2].'/';
        $fecha=$pac3.$pac2.$pac1;


        $fechax1=explode('-', $array2['fecha_ejecucion']);
        $anio1=$fechax1[0];
        $mes1=$fechax1[1].'/';
        $dia1=$fechax1[2].'/';
        $fecha1=$dia1.$mes1.$anio1;

        $fechax2=explode('-', $array2['fecha_siguiente']);
        $anio2=$fechax2[0];
        $mes2=$fechax2[1].'/';
        $dia2=$fechax2[2].'/';
        $fecha2=$dia2.$mes2.$anio2;

    $nombre_per=explode(' ', $array2['nombres']); 
                          $pri_nom=$nombre_per[0];

                          $apellido_per=explode(' ', $array2['apellidos']);
                          $prim_ape=$apellido_per[0];

                          $encargado_mant=$pri_nom.' '.$prim_ape;
        ?>

        <table border="0" style="border-radius:10px;" align="center">
            <tr>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Encargado</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Responsable</label>
            </td>
           <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Fecha De Solicitud</label>
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

        <?php echo $fecha; ?> 

        </td>
        </tr>
        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
        </table>

        <?php 
        if($array2['estado']!='en proceso'){
        ?>

        <table border="0" style="border-radius:10px;" align="center">
             <tr>
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Luces de Tablero</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Parada de Emergencia</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
               <label>Pulsadores</label>
           </td>

        </tr>
        <tr>
        <td border="1" align="center">

        <?php echo $array2['luces_tablero']; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array2['parada_emergencia']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array2['pulsadores']; ?> 

        </td>
        </tr>
        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
        <tr>
              <td border="1" width="210"   class="td_title" align="center" > 
               <label>Nivel de Aceite</label>
           </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Hora Hombre</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
               <label>Costo</label>
           </td>

        </tr>
        <tr>
       <td border="1" align="center">

        <?php echo $array2['nivel_aceite']; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array2['horas_hombre']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array2['costo']; ?> 

        </td>
        </tr>
         <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
        <tr>
              <td border="1" width="210"   class="td_title" align="center" > 
               <label>Estado</label>
           </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Fecha de Ejecución</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
               <label>Fecha del Proximo Mantenimiento</label>
           </td>

        </tr>
        <tr>
       <td border="1" align="center">

        <?php echo $array2['estado']; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $fecha1; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $fecha2; ?> 

        </td>
        </tr>
        <tr>
        <td colspan="3">
        <br>
        </td>
        </tr>
          <tr>
           <td  border="1" class="td_title" width="210" align="center" style="width:0px;" colspan="3">
             <label>Observaciones</label>
           </td>
         </tr>

         <tr>
            <td border="1" colspan="3" align="center">
                <?php echo $array2['observaciones']; ?>
            </td>
        </tr>

    </table> 
    <?php
    }
    ?>
      <br><br>

    <?php
    if ($columnas3!=0){     

        ?>

        <table  border="0" style="border-radius:10px;" align="center">
            <tr>
                <td colspan="2" align="center" border="" width="400">
                <span><b>Repuestos Utilizados</b></span>
                </td>
            </tr>
            <tr>
            <td border="1" align="center" class="td_title">
                <span>Nombre</span>
            </td>
            <td border="1" align="center" class="td_title">
                <span>Cantidad</span>
            </td>
            </tr>
            <?php
             while ($array3=pg_fetch_assoc($sql3)) {
        
                $R1=$array3["repuesto1"];
       
                $CR1=$array3["salida1"];
            

            $valor=$array3["salida1"];
            $total += $array3["salida1"];

        if ($R1!=0){
            $buscarR1=pg_query("SELECT nombre FROM insumos WHERE id_insumos='$R1' AND estatus=1");
            $arrayR1=pg_fetch_assoc($buscarR1);
            $R1=$arrayR1["nombre"];
        }
        
            ?>
            <tr>
            <td border="1" align="center">
            <?php echo $R1; ?>
            </td>
            <td border="1" align="center">
            <?php echo $CR1; ?>
            </td>
            </tr>

            <?php 
        }
            ?>
            <tr>
              <td border="1" class="td_title" style="width:0px;" align="center">
              Cantidad de Total de Repuestos Utilizados:
              </td>
            <td border="1" align="center">
            <?php echo $total; ?>
            </td>
            </tr>

        </table>
        <?php
    }
    ?>

  <br>
    <br>
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