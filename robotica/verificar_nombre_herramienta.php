<?php
  require('seguridad.php');
  require('conexion.php');

  $nombre= $_POST['nombre'];
  $tipo=$_POST['tipo'];
  $id=$_POST['id'];



  if(!empty($nombre)) {
    comprobar($nombre,$tipo,$id);
  }
  
  function comprobar($nombre,$tipo,$id)
  {
    if ($tipo=="registro") {
      # code...
  

    $sql="SELECT * FROM  herramienta WHERE nombre='".$nombre."' AND estatus=1 AND taller=2";
    $query=pg_query($sql);
    //$contar=pg_num_rows($query);
    $array=pg_fetch_assoc($query);
   // while ($array=pg_fetch_assoc($query))
    //{
    
      if($array['nombre']!=$nombre)
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
   $sql="SELECT * FROM herramienta WHERE nombre='".$nombre."' AND estatus=1 AND taller=2";
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