<?php 
//setlocale(LC_ALL,"es_ES");
//date_default_timezone_set('UTC');
date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$d=date('d');
$m=date('m');
$y=date('Y');
//$hoy=date('h:i:s A');

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";

//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
$datos=pg_query("SELECT * FROM maquinas m, mant_correctivo p, personal s, numero_bien n WHERE m.id_maquina=p.id_maquina AND m.n_b=n.id_nb AND p.id_personal=s.id  AND m.estatus='1' AND p.estatus='1' AND p.estado<>'en proceso' ORDER BY fecha_ejecucion DESC");
$datos2=pg_query("SELECT costo, fecha_falla FROM mant_correctivo WHERE estatus='1' AND estado<>'en proceso'  ORDER BY fecha_ejecucion DESC");



$columnas=pg_num_fields($datos);


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