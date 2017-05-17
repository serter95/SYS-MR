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
$datos=pg_query("SELECT * FROM herramientas i, numero_bien n WHERE i.n_b=n.id_nb AND i.estatus='1' AND i.taller=2 ORDER BY codigo_herramienta ASC");
//$datos2=pg_query("SELECT codigo_herramienta FROM herramientas WHERE estatus='1' AND taller=2 ORDER BY codigo_insumo ASC");



$columnas=pg_num_fields($datos);


$total_insumos=pg_query("SELECT * FROM herramientas WHERE estatus='1' AND taller=2");
//$totales = pg_num_rows($datos);
$total_insu=pg_num_rows($total_insumos);

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
      margin-left: 430px; padding: 0;

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
        <h3 >Reporte de Herramientas</h3>
    </div>
    
   
    <table class="tabledate">
         <tr>
            <td border="1" class="td_title" width="100">Codigo</td>
            <td border="1" class="td_title" width="100">Número del Bien </td>
            <td border="1" class="td_title" width="150">Nombre</td>
            <td border="1" class="td_title" width="100">Serial</td>
            <td border="1" class="td_title" width="100">Marca</td>
            <td border="1" class="td_title" width="100">Estado</td>
            <td border="1" class="td_title" width="250">Ubicación</td>
        
        </tr>
<?php



        while($fila=pg_fetch_assoc($datos)){
            ?>

            <tr>
                <td class="rose" border="1" style="text-align: center;" width="100"><?php echo $fila['codigo_herramienta'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['nb'];?></td>
                <td border="1" style="text-align: center;" width="150"><?php echo $fila['nombre'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['serial'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['marca'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['estado'];?></td>
                <td border="1" style="text-align: center;" width="250"><?php echo $fila['ubicacion'];?></td>



            </tr>
            <?php   

     
        
        }
?>
    
    

 
</table>
<br>

</page>
