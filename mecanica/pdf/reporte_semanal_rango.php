<?php

session_start(); 
if ($_SESSION["g1tr2sv"] != "SI")
{   
header("Location:../../salir.php");
}
include("../conexion.php");
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
//$datos = pg_query ("SELECT * FROM usuario");
//$datos = pg_query ("SELECT * FROM usuario");

  $d=explode('/', $_REQUEST['desde']);

 $desde=$d[2]."-".$d[1]."-".$d[0];

   $h=explode('/', $_REQUEST['hasta']);


$hasta=$h[2]."-".$h[1]."-".$h[0];

$cedula=$_REQUEST['cedula'];

$buscar=pg_query("SELECT * FROM personal WHERE ci='$cedula' AND estatus=1");
$filtro=pg_fetch_assoc($buscar);
$id=$filtro["id"];


$datos=pg_query("SELECT * FROM planificacion_semanal ps, personal p WHERE ps.id_personal='$id' AND p.id='$id' AND ps.estatus=1 AND p.estatus=1 AND ps.fecha BETWEEN  '".$desde."' AND '".$hasta."'");
$datos2=pg_query("SELECT * FROM planificacion_semanal ps, personal p WHERE ps.id_personal='$id' AND p.id='$id' AND ps.estatus=1 AND p.estatus=1 AND ps.fecha BETWEEN  '".$desde."' AND '".$hasta."'");


$columnas=pg_num_rows($datos2);
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

//$hoy = date('d/m/Y');
/*  NO COLOCAR BODY DAÑA EL PAGE        


$cadconex="host='localhost' port='5432' dbname='maquinas' user='postgres' password='12345'";

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
$conexion = pg_connect($cadconex);

//$datos = pg_query ("SELECT * FROM usuario");
//$datos = pg_query ("SELECT * FROM usuario");
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
        margin-left: 60px;
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
        margin-left: 200px;
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

      <div >
      <table>
      <tr>
      <td align="center" width="650">
        <h3 >Reporte de Planificación Semanal</h3>
        <h5> Desde <?php echo $_REQUEST['desde'];?> Hasta <?php echo $_REQUEST['hasta'];?></h5>
    </td>
    </tr>
    </table>
    </div>
    
   
   
      
<?php

    if ($columnas=='0'){
        ?>
         <table class="notabledate" >
        <tr>
                <td border="1" style="text-align: center;">No hay datos disponibles en el rango colocado</td>
              
        </tr>
        </table>
        <?php
    }else{

        ?>
         <table class="tabledate">
           <tr>
            <td border="1" class="td_title" width="200">Actividad</td>
            <td border="1" class="td_title">Fecha</td>
            <td border="1" class="td_title">Encargado</td>
            <td border="1" class="td_title">Estado</td>

        </tr>
       

        <?php


        while($fila=pg_fetch_assoc($datos)){

               $nom=explode(' ', $fila['nombres']);
                          $ape=explode(' ', $fila['apellidos']);

                          $encargado=$nom[0]." ".$ape[0];

        $priv_ac=explode('-', $fila['fecha']);
        $pac1=$priv_ac[0];
        $pac2=$priv_ac[1].'/';
        $pac3=$priv_ac[2].'/';
        $fecha=$pac3.$pac2.$pac1;
            ?>
           
            <tr>
                <td class="rose" border="1" style="text-align: center;" width="200"><?php echo $fila['actividad'];?></td>
                <td border="1" style="text-align: center;"><?php echo $fecha; ?></td>
                <td border="1" style="text-align: center;"><?php echo $encargado; ?></td>
                <td border="1" style="text-align: center;"><?php echo $fila['estado']; ?></td>

            </tr>
            <?php   
        }

    ?>
    </table>
    <?php

    }
        ?>
    


</page>


<?php 

//$content=ob_get_clean();
$content=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');
$html2pdf= new HTML2PDF('P', 'A4','es',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_semanal_rango_'.$d.'-'.$m.'-'.$y.'.pdf','I');
?>