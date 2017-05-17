<?php 
    function menu()
    {
?>

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
  <div class="desc">
    <select id="contacto" onChange="DameDatos();" name="maq">
      <option value="0">Seleccione una maquina</option>
      <?php $buscar1="SELECT nombre FROM tipo_maquina WHERE estatus=1";
            $query1=pg_query($buscar1);
           
             while ($array=pg_fetch_assoc($query1)){
              $id=1;
              $id=$id++;
              ?>

                <option id="<?php echo $array['nombre']; ?>" value="<?php echo $array['nombre']; ?>" > <?php echo $array['nombre']; ?> </option>

            <?php
              }/*
              ?>
     < <option value="1">Torno</option>
      <option value="2">Esmeril</option>
      <option value="3">Limadora</option>
      <option value="4">Fresadora</option>
      <option value="5">Taladro</option>
      <option id="option_otro">Otro</option>
      <?php
      */
      ?>
            <option id="option_otro" value="otro">Otro</option>

    </select>
  </div>  

  <div id="informacion"><br><div class="info"><p>No hay informacion para mostrar</p></div></div>
                              					
<?php 
    }
?>
           