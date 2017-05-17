<?php
  require('seguridad.php');
  require('conexion.php');

  $codigo= $_POST['codigo'];
    $tipo=$_POST['tipo'];
  $id=$_POST['id'];

  if(!empty($codigo)) {
    comprobar($codigo,$tipo,$id);
  }
  
  function comprobar($codigo,$tipo,$id)
  {
    if ($tipo=="registro") {
    $sql="SELECT * FROM herramientas WHERE codigo_herramienta='".$codigo."' AND estatus=1 AND taller=1";
    $query=pg_query($sql);
    //$contar=pg_num_rows($query);
    $array=pg_fetch_assoc($query);
   // while ($array=pg_fetch_assoc($query))
    //{
    
      if($array['codigo_herramienta']!=$codigo)
      {
        echo $dato=0;
      }
      else
      { 
        echo $dato=1;
      }
    //}
      }
      elseif ($tipo=="modificacion") {
  # code...
   $sql="SELECT * FROM herramientas WHERE codigo_herramienta='".$codigo."' AND estatus=1 AND taller=1";
    $query=pg_query($sql);
    //$contar=pg_num_rows($query);
    $array=pg_fetch_assoc($query);
     $contar=pg_num_rows($query);
     if ($contar>0)
    {
      if($array['id_herramienta']!=$id)
      {
        echo $dato=0;
      }
      else
      { 
        echo $dato=1;
      }
    }
    else
    {
        echo $dato=1;
    }
    
}
}
?>