<?php 
    function menu()
    {
?>

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
  <div class="desc">
    <select id="contacto" onChange="DameDatos();">
      <option value="0">Seleccione una maquina</option>
      <option value="1">Torno</option>
      <option value="2">Esmeril</option>
      <option value="3">Limadora</option>
      <option value="4">Fresadora</option>
      <option value="5">Taladro</option>
    </select>
  </div>  

  <div id="informacion"><br><div class="info"><p>No hay informacion para mostrar</p></div></div>
                              					
<?php
    }
?>
           