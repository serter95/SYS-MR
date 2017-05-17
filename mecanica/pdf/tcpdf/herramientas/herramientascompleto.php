<?php 
//setlocale(LC_ALL,"es_ES");
//date_default_timezone_set('UTC');
date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$d=date('d');
$m=date('m');
$y=date('Y');
//$hoy=date('h:i:s A');
$estante=$_REQUEST["estante"];
//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
$datos=pg_query("SELECT * FROM herramientas i, numero_bien n WHERE i.n_b=n.id_nb AND i.estatus='1' AND i.taller=1 AND i.estante='".$estante."' ");



$columnas=pg_num_fields($datos);


//$total_insumos=pg_query("SELECT * FROM herramientas WHERE estatus='1' AND taller=1");
//$totales = pg_num_rows($datos);
//$total_insu=pg_num_rows($total_insumos);

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
</style>

   
      <div class="center">
        <?php 
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Ln(5);    
        $pdf->Cell(0, 15, "Reporte de Herramientas", 0, 1, 'C', 0, '', 0, True, 'M', 'M');

          $pdf->Ln(5);    
        $pdf->Cell(0, 15, "Número del Estante ".$estante, 0, 1, 'C', 0, '', 0, True, 'M', 'M');
         $pdf->SetFont('helvetica', '', 10);
        ?>

        
    </div>
    
   
    <table class="tabledate">
         <tr>
            <td border="1" class="td_title" width="50">Nº</td>
            <td border="1" class="td_title" width="150">Número del Bien </td>
            <td border="1" class="td_title" width="150">Nombre</td>
            <td border="1" class="td_title" width="70">Serial</td>
            <td border="1" class="td_title" width="70">Cantidad</td>
            <td border="1" class="td_title" width="100">Marca</td>
            <td border="1" class="td_title" width="80">Estado</td>
            <td border="1" class="td_title" width="250">Ubicación</td>
        
        </tr>
<?php

$contar=0;

        while($fila=pg_fetch_assoc($datos)){
             
             $contar=$contar+1;
            ?>


            <tr  nobr = "true">
                <td class="rose" border="1" style="text-align: center;" width="50"><?php echo $contar;?></td>
                <td border="1" style="text-align: center;" width="150"><?php echo $fila['nb'];?></td>
                <td border="1" style="text-align: center;" width="150"><?php echo $fila['nombre'];?></td>
                <td border="1" style="text-align: center;" width="70"><?php echo $fila['serial'];?></td>
                <td border="1" style="text-align: center;" width="70"><?php echo $fila['cantidad'];?></td>
                <td border="1" style="text-align: center;" width="100"><?php echo $fila['marca'];?></td>
                <td border="1" style="text-align: center;" width="80"><?php echo $fila['estado'];?></td>
                <td border="1" style="text-align: center;" width="250"><?php echo $fila['ubicacion'];?></td>



            </tr>
            <?php   

     
        
        }
?>
    
    

 
</table>
