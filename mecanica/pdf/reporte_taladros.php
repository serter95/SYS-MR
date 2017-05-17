<?php
session_start(); 
if ($_SESSION["g1tr2sv"] != "SI")
{   
header("Location:../../salir.php");
}
include("../conexion.php");
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

//$cadconex="host='localhost' port='5432' dbname='maquinas' user='postgres' password='12345'";

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
//$conexion = pg_connect($cadconex);

//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");


$datos=pg_query("SELECT * FROM maquinas m, numero_bien n WHERE maquina='Taladro' AND m.n_b=n.id_nb AND estatus='1'");


$columnas=pg_num_rows($datos);
//$columnas=pg_num_fields($datos);

//$fila=pg_fetch_assoc($datos);

ob_start();

  
?>
    <?php 
//setlocale(LC_ALL,"es_ES");
//date_default_timezone_set('UTC');
date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$d=date('d');
$m=date('m');
$y=date('Y');
//$hoy=date('h:i:s A');

$total_maquinas=pg_query("SELECT estado FROM maquinas WHERE estatus='1'");
//$totales = pg_num_rows($datos);
$total_maq=pg_num_rows($total_maquinas);

$total_ope=pg_query("SELECT * FROM maquinas WHERE estatus='1'   AND maquina='Taladro' AND estado='Operativo'");
//$totales = pg_num_rows($datos);
$operativos=pg_num_rows($total_ope);

$total_nope=pg_query("SELECT * FROM maquinas WHERE estatus='1'  AND maquina='Taladro' AND estado='No Operativo'");

$inoperativos=pg_num_rows($total_nope);

$total_taladro=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Taladro'");

$taladro=pg_num_rows($total_taladro);
//$hoy = date('d/m/Y');
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
     .notabledate{
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
        margin-left: 250px;
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
        margin-left: 330px; padding: 0;
        
    }

    #lol{
     margin-left: 80px;

     position: absolute;
    }

    #fecha{
        margin-left: 680px;
        position: absolute;
    }

    #fieldset_izquierdo{
        float: left;
        display: inline-block;
        width: 250px;
      
         position:relative;
        left: 230px;
       
    }

     #fieldset_derecho{
        float: left;
        position:relative;
        left: 370px;
        top: -75px;
        display: inline-block;
        width: 250px;
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
        <?php echo $hoy;?>
    </div>
    </page_header>
    <page_footer>
    <table class="footer_header" >
        <tr>
            <td align="center">
        <span>&copy; Derechos Reservados</span><br>
       
            </td>
        </tr>
    
    </table>
    </page_footer>

      <div class="center">
        <h3 >Reporte de Taladros</h3>
    </div>
    
   
   
      
<?php

    if ($columnas=='0'){
        ?>
         <table class="notabledate" >
        <tr>
                <td border="1" style="text-align: center;">No hay datos disponibles</td>
              
        </tr>
        </table>
        <?php
    }else{

        ?>
         <table class="tabledate">
           <tr>
            <td border="1" class="td_title">Codigo</td>
            <td border="1" class="td_title">Número del Bien </td>
            <td border="1" class="td_title">Máquina </td>
            <td border="1" class="td_title">Marca</td>
            <td border="1" class="td_title">Modelo</td>
            <td border="1" class="td_title">Estado</td>
        </tr>
        <?php


        while($fila=pg_fetch_assoc($datos)){
            ?>

            <tr>
                <td class="rose" border="1" style="text-align: center;"><?php echo $fila['codigo'];?></td>
                <td border="1" style="text-align: center;"><?php echo $fila['nb'];?></td>
                <td border="1" style="text-align: center;"><?php echo $fila['maquina'];?></td>
                <td border="1" style="text-align: center;"><?php echo $fila['marca'];?></td>
                <td border="1" style="text-align: center;"><?php echo $fila['modelo'];?></td>
                <td border="1" style="text-align: center;"><?php echo $fila['estado'];?></td>
            </tr>
            <?php   
        }

    ?>
    </table>
    <?php

    }
        ?>
    

<br>

<?php

    if ($columnas!='0'){
        ?>
<form>
    <fieldset id="fieldset_izquierdo">
        <div style=" text-align: center; background-color:#0061C5; color:#fff;">Cantidad de Máquinas</div>
        <table>
             <tr>
                <td>
                    Nº Total de Fresadoras <?php echo $taladro; ?>
 
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Fresadoras Operativas: <?php echo $operativos; ?> 
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Fresadoras Inoperativas: <?php echo $inoperativos; ?>
                </td>
            </tr>
        </table>
    </fieldset>

  
</form>
</page>
<?php 
}else{
?>
</page>


<?php 
}
//$content=ob_get_clean();
$content=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');
$html2pdf= new HTML2PDF('P', 'A4','es',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_taladros_'.$d.'-'.$m.'-'.$y.'.pdf','I');
?>