<?php
  require('seguridad.php');
  require('conexion.php');

  $codigo= $_POST['codigo'];
  
  if(!empty($codigo)) {
    comprobar($codigo);
  }
  
  function comprobar($codigo)
  {
    $sql="SELECT * FROM maquinas WHERE codigo='".$codigo."' AND estatus=1";
    $query=pg_query($sql);
    //$contar=pg_num_rows($query);
    $array=pg_fetch_assoc($query);
   // while ($array=pg_fetch_assoc($query))
    //{
    
      if($array['codigo']!=$codigo)
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