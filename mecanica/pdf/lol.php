<?php 
//setlocale(LC_ALL,"es_ES");
//date_default_timezone_set('UTC');
date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$d=date('d');
$m=date('m');
$y=date('Y');
//$hoy=date('h:i:s A');
$datos=pg_query("SELECT * FROM maquinas m, numero_bien n WHERE m.n_b=n.id_nb AND m.estatus='1' ORDER BY m.codigo ASC");

$total_maquinas=pg_query("SELECT estado FROM maquinas WHERE estatus='1'");
//$totales = pg_num_rows($datos);
$total_maq=pg_num_rows($total_maquinas);

$total_ope=pg_query("SELECT estado FROM maquinas WHERE estatus='1' AND estado='Operativo'");
//$totales = pg_num_rows($datos);
$operativos=pg_num_rows($total_ope);

$total_nope=pg_query("SELECT estado FROM maquinas WHERE estatus='1' AND estado='No Operativo'");

$inoperativos=pg_num_rows($total_nope);

/*$total_tornos=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Torno'");

$tornos=pg_num_rows($total_tornos);

$total_esmeril=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Esmeril'");

$esmeril=pg_num_rows($total_esmeril);

$total_limadora=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Limadora'");

$limadora=pg_num_rows($total_limadora);

$total_fresadora=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Fresadora'");

$fresadora=pg_num_rows($total_fresadora);

$total_taladro=pg_query("SELECT maquina FROM maquinas WHERE estatus='1' AND maquina='Taladro'");

$taladro=pg_num_rows($total_taladro);*/






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
        margin-left: 180px; padding: 0;
        display: inline-block;
    }
     table.footer_header{
        width: 100%;
        border: none;
        
        margin: 0 auto;
        margin-left: 280px; padding: 0;
        
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
        <?php
       include("membrete.php");
       $bar=membrete();
       echo $bar;
?>
    
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
            <td border="1" class="td_title" width="50">Codigo</td>
            <td border="1" class="td_title" width="100">Número del Bien </td>
            <td border="1" class="td_title" width="100">Máquina </td>
            <td border="1" class="td_title" width="180">Marca</td>
            <td border="1" class="td_title" width="100">Modelo</td>
            <td border="1" class="td_title" width="80">Estado</td>
        </tr>
<?php



        while($fila=pg_fetch_assoc($datos)){
            ?>

            <tr>
                <td class="rose" border="1" style="text-align: center;" width="50"><?php echo $fila['codigo'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['nb'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['maquina'];?></td>
                <td border="1" style="text-align: center;" width="180"><?php echo $fila['marca'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['modelo'];?></td>
                <td border="1" style="text-align: center;" width="80"><?php echo $fila['estado'];?></td>
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
             <?php 
                   $con=pg_query("SELECT * FROM tipo_maquina WHERE estatus=1");
                    $row=pg_num_rows($con);
                    while ($array=pg_fetch_assoc($con)) {
                     
                     $nom_maq[]=$array['nombre'];
                    }

                    for ($i=0; $i<$row; $i++){
                      $q=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND maquina='$nom_maq[$i]'");

                    $num1=pg_num_rows($q);
                    //$num_op=$num_op+$num1;

                    $num_oper[]=pg_num_rows($q);
                    //$num_noper[]=pg_num_rows($q2);

                    ?>
                    <tr>
                        <td>
                            Nº de <?php echo $nom_maq[$i]; ?>: <?php echo $num_oper[$i]; ?>
                        </td>
                    </tr>
                    <?php

}
                    ?>
          
        </table>    
    </fieldset>
</form>
</page>
