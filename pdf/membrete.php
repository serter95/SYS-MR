<?php

    function membrete($pag)
    {
?>

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
 <tr>
            
            <td align="center" style="font-size:10px;">
        <span>REPÚBLICA BOLIVARIANA DE VENEZUELA</span><br>
        <span>MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN UNIVERSITARIA, CIENCIA Y TECNOLOGÍA</span><br>
        <span><b>UNIVERSIDAD POLITÉCNICA TERRITORIAL DE ARAGUA</b></span><br>
        <span><b>"FEDERICO BRITO FIGUEROA"</b></span><br>
        <?php
          if($pag=='1')
            { 
        ?>
              <span>TALLER DE MECÁNICA</span>
        <?php 
            }

            if($pag=='2')
            {
        ?>
              <span>LABORATORIO DE ROBÓTICA</span>
        <?php
            } 
        ?>
            </td>

        </tr>
                        
                      <!--button type="button" onclick="ajaxget()">Recupera</button-->
<?php
    }
?>