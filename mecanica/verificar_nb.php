<?php
  require('seguridad.php');
  require('conexion.php');

  $nb = $_POST['nb'];
  
  if(!empty($nb)) {
    comprobar($nb);
  }
  
  function comprobar($nb)
  {
    $sql="SELECT * FROM numero_bien WHERE nb='".$nb."' AND estatus=1";
    $query=pg_query($sql);
    //$contar=pg_num_rows($query);
    $array=pg_fetch_assoc($query);
   // while ($array=pg_fetch_assoc($query))
    //{
    
      if($array['nb']!=$nb)
      {
        echo $dato=0;
      }
      else
      { 
        echo $dato=1;
      }
    //}
}
?>