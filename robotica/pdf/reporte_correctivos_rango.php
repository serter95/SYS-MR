<?php
session_start(); 
if ($_SESSION["g2tr1sv"] != "SI")
{   
	header("Location:../../salir.php");
}
include("../conexion.php");

require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once(dirname(__FILE__).'/seguridad.php');

//$fila=pg_fetch_assoc($datos);

ob_start();
?>
<?php
date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$d=date('d');
$m=date('m');
$y=date('Y');
//$hoy=date('h:i:s A');
$d=explode('/', $_REQUEST['desde']);

$desde=$d[2]."-".$d[1]."-".$d[0];

$h=explode('/', $_REQUEST['hasta']);


$hasta=$h[2]."-".$h[1]."-".$h[0];
//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";

//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
$datos=pg_query("SELECT * FROM maquinas m, mant_correctivo p, personal s, numero_bien n WHERE m.id_maquina=p.id_maquina AND m.n_b=n.id_nb AND p.id_personal=s.id  AND m.estatus='1' AND p.estatus='1' AND p.estado<>'en proceso' AND fecha_ejecucion BETWEEN  '".$desde."' AND '".$hasta."' ORDER BY fecha_ejecucion DESC");
$datos2=pg_query("SELECT costo, fecha_ejecucion FROM mant_correctivo WHERE estatus='1' AND estado<>'en proceso' AND fecha_ejecucion BETWEEN  '".$desde."' AND '".$hasta."' ORDER BY fecha_ejecucion DESC");



$columnas=pg_num_rows($datos);


//$hoy = date('d/m/Y');
?>

<style type="text/css">
	<!--

	.center_header{
		margin-left: 230px; padding: 0;
	}
	.center{
		margin-left: 350px; padding: 0;

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
        margin-left: 350px;
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
		margin-left: -200px; padding: 0;
		display: inline-block;
	}
	table.footer_header{
		width: 100%;
		border: none;
		
		margin: 0 auto;
		margin-left: 500px; padding: 0;
		
	}

	#lol{
		margin-left: 100px;

		position: absolute;
	}

	#fecha{
		margin-left: 900px;
		position: absolute;
	}

	#fieldset_izquierdo{
		float: left;
		display: inline-block;
		width: 250px;
		
		position:relative;
		left: 60px;
		
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

<page orientation='L' backtop="22mm" backbottom="14mm" backleft="10mm" backright="10mm" footer="page;">
	<page_header style="margin-bottom:20px;" align="center">
	<div id="lol" >
		<img src="upta.jpg" alt="Logo" height="80" width="90" />
	</div>
    
    <table class="page_header">
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
    <page_footer align="center">
    <!--<table class="footer_header" width="100%" border="1">
        <tr>
        	<td align="center">-->
        		<span>&copy; Derechos Reservados</span><br>
       <!--
            </td>
        </tr>
    
    </table>-->
    </page_footer>
    <br>
    <div class="center">
    	<h3 >Reporte de Mantenimiento Correctivo</h3>
    </div>
    <div  style="margin-left:400px;">
    	<h5 > Desde <?php echo $_REQUEST['desde'];?> Hasta <?php echo $_REQUEST['hasta'];?></h5>
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
    		<td border="1" class="td_title" width="70">Codigo</td>
    		<td border="1" class="td_title" width="100">Número del Bien </td>
    		<td border="1" class="td_title" width="100">Supervisor</td>
    		<td border="1" class="td_title" width="100">Responsable</td>
    		<td border="1" class="td_title" width="70">Hora de la falla</td>
    		<td border="1" class="td_title" width="70">Hora del arranque</td>
    		<td border="1" class="td_title" width="70">Fecha de solicitud</td>
            <td border="1" class="td_title" width="70">Fecha de ejecución</td>
    		<td border="1" class="td_title" width="100">Observaciones</td>
    		<td border="1" class="td_title" width="100">Costo</td>

    		
    		
    	</tr>
    	<?php



    	while($fila=pg_fetch_assoc($datos)){
    		$fecha_a=explode('-', $fila['fecha']);
    		$ano=$fecha_a[0];
    		$mes=$fecha_a[1].'/';
    		$dia=$fecha_a[2].'/';
    		$fecha=$dia.$mes.$ano;

    		$nombre_per=explode(' ', $fila['nombres']); 
    		$pri_nom=$nombre_per[0];

    		$apellido_per=explode(' ', $fila['apellidos']);
    		$prim_ape=$apellido_per[0];

    		$encargado_mant=$pri_nom.' '.$prim_ape;

            $fechaej=explode("-", $fila['fecha_ejecucion']);
            $fechaej=$fechaej[2]."/".$fechaej[1]."/".$fechaej[0];   
    		?>

    		<tr>
    			<td class="rose" border="1" style="text-align: center;" width="70"><?php echo $fila['codigo'];?></td>
    			<td border="1" style="text-align: center;" width="100"><?php echo $fila['nb'];?></td>
    			<td border="1" style="text-align: center;" width="100"><?php echo $encargado_mant; ?></td>
    			<td border="1" style="text-align: center;" width="100"><?php echo $fila['responsable'];?></td>
    			<td border="1" style="text-align: center;" width="70"><?php echo $fila['hora_falla'];?></td>
    			<td border="1" style="text-align: center;" width="70"><?php echo $fila['horas_arranque'];?></td>
    			<td border="1" style="text-align: center;" width="70"><?php echo $fecha; ?></td>
                <td border="1" style="text-align: center;" width="70"><?php echo $fechaej; ?></td>
    			<td border="1" style="text-align: center;" width="100"><?php echo $fila['observaciones'];?></td>
    			<td border="1" style="text-align: center;" width="100"><?php echo $fila['costo'];?></td>



    		</tr>
    		<?php   

    		
    		
    	}
    	?>
    	
    	

    	

    	<?php
    	while($jaja=pg_fetch_assoc($datos2)){
    		$calculo= explode(' ', $jaja['costo']);
    		$valor=$calculo[0];
    		$total += $calculo[0];
       //$valor=$calculo[0];
    	}
    	?>
    	<tr>
    		<td colspan="9" border="1" class="td_title" style="width:0px;" align="center">
    			Costo Total en Bolivares:
    		</td>
    		<td border="1" align="center">
    			<?php echo $total." "."Bs"; ?>
    		</td>
    	</tr>

    	
    </table>
    <?php

    }
        ?>
    <br>

<!--
<form>
    <fieldset id="fieldset_izquierdo">
        <div style=" text-align: center; background-color:#0061C5; color:#fff;">Cantidad de Máquinas</div>
        <table>
             <tr>
                <td>
                    Nº Total de Insumos: <?php echo $total_insu; ?> 
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Máquinas Operativas: <?php echo $operativos; ?> 
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Máquinas Inoperativas: <?php echo $inoperativos; ?>
                </td>
            </tr>
        </table>
    </fieldset>

    <fieldset id="fieldset_derecho">
        <div style=" text-align: center; background-color:#0061C5; color:#fff;">Clasificación de Máquinas</div>

        <table>
            <tr>
                <td>
                    Nº de Tornos: <?php echo $tornos; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Esmeriles: <?php echo $esmeril; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Limadoras: <?php echo $limadora; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Fresadoras: <?php echo $fresadora; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Nº de Taladros: <?php echo $taladro; ?>
                </td>
            </tr>
        </table>    
    </fieldset>
</form>-->
</page>

<?php 
//$content=ob_get_clean();
$content=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');
$html2pdf= new HTML2PDF('L', 'A4','es',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_mantenimiento_correctivos_rango'.$d.'-'.$m.'-'.$y.'.pdf','I');
?>