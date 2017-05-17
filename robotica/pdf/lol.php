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

$total_ope=pg_query("SELECT estado FROM maquinas WHERE estatus='1' AND estado='Operativo'");
//$totales = pg_num_rows($datos);
$operativos=pg_num_rows($total_ope);

$total_nope=pg_query("SELECT estado FROM maquinas WHERE estatus='1' AND estado='No Operativo'");

$inoperativos=pg_num_rows($total_nope);

$total_tornos=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Torno'");

$tornos=pg_num_rows($total_tornos);

$total_esmeril=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Esmeril'");

$esmeril=pg_num_rows($total_esmeril);

$total_limadora=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Limadora'");

$limadora=pg_num_rows($total_limadora);

$total_fresadora=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Fresadora'");

$fresadora=pg_num_rows($total_fresadora);

$total_taladro=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Taladro'");

$taladro=pg_num_rows($total_taladro);
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
        margin-left: 240px; padding: 0;
        display: inline-block;
    }
     table.footer_header{
        width: 100%;
        border: none;
        
        margin: 0 auto;
        margin-left: 330px; padding: 0;
        
    }

    #lol{
     margin-left: 100px;

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

<page orientation='P' backtop="22mm" backbottom="14mm" backleft="10mm" backright="10mm" footer="page;">
    <page_header style="margin-bottom:20px;">
    <div id="lol" >
        <img src="upta.jpg" alt="Logo" height="80" width="90" />
    </div>
    <table class="page_header" >
        <tr>
            
            <td align="center">
        <span>República Bolivariana de Venezuela</span><br>
        <span>Ministerio del Poder Popular para la Educación Superior</span><br>
        <span>UPT-Aragua "Federico Brito Figueroa"</span><br>
        <span>Taller de Metalmecanica</span>
            </td>

        </tr>
    
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
        <h3 >Reporte de Maquinas</h3>
    </div>
    
   
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
<br>
<form>
    <fieldset id="fieldset_izquierdo">
        <div style=" text-align: center; background-color:#0061C5; color:#fff;">Cantidad de Máquinas</div>
        <table>
             <tr>
                <td>
                    Nº Total de  Máquinas: <?php echo $total_maq; ?> 
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
</form>
</page>
<!--
<page style="font-size: 14px">
    <span style="font-weight: bold; font-size: 18pt; color: #FF0000; font-family: Times">Bonjour, voici quelques exemples<br></span>
    <br>
    Retours à la ligne autorisés : &lt;br&gt;, &lt;br &gt;, &lt;br/&gt;, &lt;br /&gt; <br />
    <br>
    Barre horizontale &lt;hr&gt;<hr style="height: 4mm; background: #AA5500; border: solid 1mm #0055AA">
    Exemple de lien : <a href="http://html2pdf.fr/" >le site HTML2PDF</a><br>
    <br>
    Image : <img src="./res/logo.gif" alt="Logo" width=150 /><br>
    <br>
    Alignement horizontal des DIVs et TABLEs<br />
    <table style="text-align: center; border: solid 2px red; background: #FFEEEE;width: 40%" align="center"><tr><td style="width: 100%">Test 1</td></tr></table><br />
    <table style="text-align: center; border: solid 2px red; background: #FFEEEE;width: 40%; margin: auto"><tr><td style="width: 100%">Test 2</td></tr></table><br />
    <div style="text-align: center; border: solid 2px red; background: #FFEEEE;width: 40%; margin: auto">Test 3</div><br />
    test de tableau imbriqué :<br>
    <table border="1" bordercolor="#007" bgcolor="#AAAAAA" align="center">
        <tr>
            <td border="1">
                <table style="border: solid 1px #FF0000; background: #FFFFFF; width: 100%; text-align: center">
                    <tr>
                        <th style="border: solid 1px #007700;width: 50%">C1 € «</th>
                        <td style="border: solid 1px #007700;width: 50%">C2 € «</td>
                    </tr>
                    <tr>
                        <td style="border: solid 1px #007700;width: 50%">D1 &euro; &laquo;</td>
                        <th style="border: solid 1px #007700;width: 50%">D2 &euro; &laquo;</th>
                    </tr>
                </table>
            </td>
            <td border="1">A2</td>
            <td border="1">AAAAAAAA</td>
        </tr>
        <tr>
            <td border="1">B1</td>
            <td border="1" rowspan="2">
                <table class="test1">
                    <tr>
                        <td style="border: solid 2px #007700">E1</td>
                        <td style="border: solid 2px #000077; padding: 2mm">
                            <table style="border: solid 1px #445500">
                                <tr>
                                    <td>
                                        <img src="./res/logo.gif" alt="Logo" width=100 />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: solid 2px #770000">F1</td>
                        <td style="border: solid 2px #007777">F2</td>
                    </tr>
                </table>
            </td>
            <td border="1"><barcode type="EAN13" value="45" style="width: 30mm; height: 6mm; font-size: 4mm"></barcode></td>
        </tr>
        <tr>
            <td border="1"><barcode type="C39" value="HTML2PDF" label="none" style="width: 35mm; height: 8mm"></barcode></td>
            <td border="1">A2</td>
        </tr>
    </table>
    <br>
    Exemple avec border et padding : <br>
    <table style="border: solid 5mm #770000; padding: 5mm;" cellspacing="0" >
        <tr>
            <td style="border: solid 3mm #007700; padding: 2mm;"><img src="./res/off.png" alt="" style="width: 20mm"></td>
        </tr>
    </table>
    <img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><img src="./res/off.png" style="width: 10mm;"><br>
    <br>
    <table style="border: solid 1px #440000; width: 150px"  cellspacing="0"><tr><td style="width: 100%">Largeur : 150px</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 150pt"  cellspacing="0"><tr><td style="width: 100%">Largeur : 150pt</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 100mm"  cellspacing="0"><tr><td style="width: 100%">Largeur : 100mm</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 5in"    cellspacing="0"><tr><td style="width: 100%">Largeur : 5in</td></tr></table><br>
    <table style="border: solid 1px #440000; width: 80%"    cellspacing="0"><tr><td style="width: 100%">Largeur : 80% </td></tr></table><br>
</page>-->