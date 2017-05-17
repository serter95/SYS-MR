<?php
session_start(); 
if ($_SESSION["g2tr1sv"] != "SI")
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

if ($m=="01"){
    $mes="Enero";
}
else if ($m=="02"){
    $mes="Febrero";
}
else if ($m=="03"){
    $mes="Marzo";
}
else if ($m=="04"){
    $mes="Abril";
}
else if ($m=="05"){
    $mes="Mayo";
}
else if ($m=="06"){
    $mes="Junio";
}
else if ($m=="07"){
    $mes="Julio";
}
else if ($m=="08"){
    $mes="Agosto";
}
else if ($m=="09"){
    $mes="Septiembre";
}
else if ($m=="10"){
    $mes="Octubre";
}
else if ($m=="11"){
    $mes="Noviembre";
}
else if ($m=="12"){
    $mes="Diciembre";
}



  $id=$_REQUEST['id_maq'];


  $sql=pg_query("SELECT * FROM convenios WHERE id_convenio=".$id." AND estatus='1' LIMIT 1");

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
      margin-left: 300px; padding: 0;

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
        <h4 >CONVENIO</h4>
    </div>
    
    <div>
    CONVENIO DE COLABORACIÓN QUE CELEBRAN POR UNA PARTE <u><?php echo $array['ente1']; ?></u>
    QUE EN LO SUCESIVO SE LE DENOMINARÁ <u><?php echo $array['contratante']; ?></u> Y POR LA OTRA PARTE
    <u><?php echo $array['ente2']; ?></u>, EN LO SUCESIVO <u><?php echo $array['contratado']; ?></u>,
    AL TENOR DE LAS CLÁUSULAS SIGUIENTES:
    
   
      
</div>

 <div class="center2">
        <h4 >CLÁUSULAS</h4>
    </div>
    <div >
        <table>
        <?php



    $sql2="SELECT * FROM clausulas WHERE id_convenio=".$id." AND estatus=1 ORDER BY id_clausula ASC";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {
        $contando+=1;
?>
 <?php $clausula=$arrays['contenido'];
       $clausula=nl2br($clausula);
       ?>
                        <tr>
                            <td width="40" align="center"><?php echo $contando; ?> </td>
                            <td width="600" align="center" ><?php echo $clausula; ?></td>

                        </tr>
                        <tr>
                            <td>
                                <br>
                            </td>
                        </tr>         
                        
                    
<?php
    }
?>
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
$html2pdf -> Output('reporte_de_proyecto_covenio_'.$array["codigo_insumo"].'_'.$fechas.'.pdf','I');
?>