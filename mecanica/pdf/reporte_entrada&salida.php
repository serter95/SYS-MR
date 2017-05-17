<?php 
//setlocale(LC_ALL,"es_ES");
//date_default_timezone_set('UTC');
date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$d=date('d');
$m=date('m');
$y=date('Y');
//$hoy=date('h:i:s A');
$cadconex="host='localhost' port='5432' dbname='maquinas' user='postgres' password='1234'";

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
$conexion = pg_connect($cadconex);
$tipo=$_REQUEST['tipo'];
if($tipo=="salida"){

$datos=pg_query($conexion,"SELECT * FROM insumos i , salida s, numero_bien n WHERE i.id_insumos=s.id_insumos AND i.n_b=n.id_nb AND s.tipo='insumo' AND i.estatus='1' AND s.estatus='1' ORDER BY realizado DESC");
}
else if($tipo=="entrada"){
$datos=pg_query($conexion,"SELECT * FROM insumos i , entrada e,  numero_bien n WHERE i.id_insumos=e.id_insumos AND i.n_b=n.id_nb AND e.tipo='insumo' AND i.estatus='1' AND e.estatus='1' ORDER BY realizado DESC");

}
?>

<style type="text/css">
<!--

.center_header{
    margin-left: 230px; padding: 0;
}
.center{
      margin-left: 380px; padding: 0;

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
    <?php

if($tipo=="salida"){
?>
 <div class="center">
        <h3 >Reporte de Salida de insumos</h3>
    </div>
<?php
}
else if($tipo=="entrada"){
    ?>
 <div class="center">
        <h3 >Reporte de Entrada de insumos</h3>
    </div><?php
}

    ?>
     
    
   
    <table class="tabledate">
         <tr>
            <td border="1" class="td_title" width="100">Codigo</td>
            <td border="1" class="td_title" width="100">Número del Bien</td>
            <td border="1" class="td_title" width="150">Nombre</td>
            <td border="1" class="td_title" width="100">Cant. Entrada</td>
            <td border="1" class="td_title" width="100">Fecha</td>
            <td border="1" class="td_title" width="100">Exist. Actual</td>
            <td border="1" class="td_title" width="250">Responsable</td>
        
        </tr>
<?php



        while($fila=pg_fetch_assoc($datos)){

                    $fecha=explode(' ', $fila['realizado']);
                            $date=$fecha[0];
                            $time=$fecha[1];
                            $meridiano=$fecha[2];

                            $fecha_a=explode('-', $date);
                           //$fecha_a2=explode('-', $array2['realizado']);
                           $ano=$fecha_a[0];
                           $mes=$fecha_a[1].'-';
                           $dia=$fecha_a[2].'-';
                           $fecha=$dia.$mes.$ano;

                           $time_a=explode(':', $time);
                           $hora=$time_a[0].':';
                           $minutos=$time_a[1];

                           $time=$hora.$minutos;

                           $fechac=$fecha." ".$time." ".$meridiano;
            ?>

            <tr>
                <td class="rose" border="1" style="text-align: center;" width="100"><?php echo $fila['codigo_insumo'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['nb'];?></td>
                <td border="1" style="text-align: center;" width="150"><?php echo $fila['nombre'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['cantidad'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fechac;?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['existencia'];?></td>
                <td border="1" style="text-align: center;" width="250"><?php echo $fila['responsable'];?></td>



            </tr>
            <?php   

     
        
        }
?>
    
    

 
</table>
<br>
</page>
