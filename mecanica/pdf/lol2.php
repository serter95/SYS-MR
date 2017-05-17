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
  $sql=pg_query("SELECT * FROM maquinas m, numero_bien n WHERE id_maquina=".$id." AND m.n_b=n.id_nb LIMIT 1");

  $array=pg_fetch_assoc($sql);
$user=$_REQUEST['user'];

  $sql2=pg_query("SELECT * FROM mant_preventivo WHERE maquina_id=".$id." ORDER BY fecha DESC LIMIT 3");



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

    <br>

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
    <table border="0" style="border-radius:10px;" align="center" class="tabledate">
        <tr>
            <td align="center">
                <b>Mantenimiento Preventivo</b>
                <br>
            </td>
        </tr>
    </table>
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
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Encargado</label>
            </td>

            <td width="210" border="1"   class="td_title" align="center" style="width:0px;"> 
                <label>Responsable</label>
            </td>
             <td border="1" width="210"   class="td_title" align="center" > 
               <label>Nivel de Aceite</label>
           </td>

        </tr>
        <tr>
        <td border="1" align="center">

        <?php echo $array2['encargado']; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array2['responsable']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array2['nivel_aceite']; ?> 

        </td>
        </tr>
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
            <td  border="1" class="td_title" width="210" align="center" style="width:0px;">
                <label>Fecha</label>
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

        <?php echo $fecha; ?> 

        </td>
        <td border="1" align="center">
        <?php echo $array2['horas_hombre']; ?> 

        </td>
        <td border="1" align="center">

        <?php echo $array2['costo']; ?> 

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

    </table>  <br><br>
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
<?php } ?> 





</page>