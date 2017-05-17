<?php
session_start(); 
if ($_SESSION["g1tr2sv"] != "SI")
{   
header("Location:../../salir.php");
}
include("../conexion.php");
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');


ob_start();

date_default_timezone_set('America/Caracas');
$hoy=date('h:i:s A');

$fecha = date('d/m/Y');
$fechas = date('d-m-Y');
$hoys=date('h:i A');
$d=date('d');
$m=date('m');
$y=date('Y');

  $id=$_REQUEST['id'];


  $sql=pg_query("SELECT * FROM proyectos WHERE id_proyecto='$id' AND taller=1 AND estatus='1' LIMIT 1");

  $array=pg_fetch_assoc($sql);

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
   .center2{
      margin-left: 150px; padding: 0;

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

    <div class="center2">
        <h4 >REPORTE DE PROYECTO SOCIO -
            <?php
                if ($array['ambito']=='comunitario'){
                    echo "COMUNITARIO";
                }
                else
                {
                    echo "TECNOLÓGICO";
                } 
            ?></h4>
    </div>
    
    <div>
   
      <table>
        <tr>
            <td colspan="2" border="1" width="330" >
                <label><b>Código del Proyecto:</b> <?php echo $array['codigo']; ?></label>
            </td>

            <td colspan="2" border="1"  width="330" > 
                <label><b>Área del Conocimiento:</b> <?php echo $array['pnf']; ?></label>
            </td>
        </tr>
        <tr>
        <td border="1" >
                <label><b>Sección:</b> <?php echo $array['seccion']; ?></label>

        </td>
        <td border="1">
                <label><b>Trayecto:</b>  <?php echo $array['trayecto']; ?></label>
        </td>
        <td border="1" >

                <label><b>Período:</b>  <?php echo $array['periodo']; ?></label>

        </td>
        <td border="1">

                <label><b>Turno:</b> <?php echo $array['regimen']; ?></label>

        </td>
        </tr>
        <tr>
        	<td colspan="4" border="1">
				 <label><b>Título del Proyecto:</b>  <?php echo $array['titulo']; ?></label>
        	</td>
        </tr>
        <tr>
        <td colspan="4" border="1">
        <br>
        </td>
        </tr>
       
        <tr>
        	 <td border="1" colspan="2"> 
                <label><b>Ubicación:  Estado: </b>  <?php echo $array['estado'];?></label>
        </td>
        <td border="1" colspan="2"> 
                <label><b>Municipio:</b>  <?php echo $array['municipio'];?></label>
        </td>

        </tr>
        <tr>
                    
         <td border="1" colspan="2"> 
                <label><b>Parroquia:</b>  <?php echo $array['parroquia'];?></label>
        </td>
        <td border="1" colspan="2"> 
                <label><b>Sector:</b>  <?php echo $array['sector'];?></label>
        </td>
         </tr>
          <tr>
        <td colspan="4" border="1">
        <br>
        </td>
        </tr>
          <tr>
        <td colspan="4" border="1">
        <label><b>Intergrantes del Proyecto:</b> </label>
        </td>
        </tr>
        <tr>
        <td border="1" align="center">
        <label><b>Apellidos y Nombres</b> </label>
        </td>
        <td border="1" align="center">
        	<label><b>Cédula</b> </label>
       	</td>
       	<td border="1" align="center">
        	<label><b>Teléfono</b> </label>
       	</td>
       	<td border="1" align="center">
        	<label><b>e-mail</b> </label>
       	</td>
    	</tr>
        <?php 
        $sqle="SELECT * FROM estudiantes WHERE codpro='".$id."' AND estatus=1";
        $querye=pg_query($sqle);
        while ($arraye=pg_fetch_assoc($querye)) {
        ?>
        <tr>
        <td border="1" align="center">
        <label><?php echo $arraye['apellidos']." ".$arraye['nombres']; ?></label>
        </td>
        <td border="1" align="center">
        	<label><?php echo $arraye['ci']; ?></label>
       	</td>
       	<td border="1" align="center">
        	<label><?php echo $arraye['telefono']; ?></label>
       	</td>
       	<td border="1" align="center">
        	<label><?php echo $arraye['correo']; ?></label>
       	</td>
    	</tr>
        <?php
        }
        ?>
         <tr>
        <td colspan="4" border="1">
        <br>
        </td>
        </tr>
        <tr>
        <td colspan="4" border="1">
        <label><b>Breve descripción del proyecto y Alcances:</b> </label>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <label><?php echo $array['descripcion']; ?> </label>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <br>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <label><b>Integración con la Comunidad:</b> </label>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <label> <?php echo $array['integracion']; ?> </label>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <br>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <label><b>Aportes:</b> </label>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
         <label> <?php echo $array['aportes']; ?> </label>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <br>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
        <label><b>Integración del proyecto con el Plan Nacional Vigente:</b>  </label>
        </td>
        </tr>
         <tr>
        <td colspan="4" border="1">
         <label> <?php echo $array['plan_nacional']; ?> </label>
        </td>
        </tr>
   </table>
</div>




</page>	


<?php 
$content=ob_get_clean();
//$content=ob_get_contents();
//ob_end_clean();


$html2pdf= new HTML2PDF('P', 'A4','es');
//$html2pdf= new HTML2PDF('P', 'A4','fr',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_de_proyecto_codigo_'.$array["codigo"].'_'.$fechas.'.pdf','I');
?>