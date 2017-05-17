<?php
  require('seguridad.php');
  require('conexion.php');

  $nb = $_POST['nb'];
  $id = $_POST['id'];


  if(!empty($nb)) {
    comprobar($nb,$id);
  }
  
  function comprobar($nb,$id)
  {
    $sql="SELECT * FROM numero_bien WHERE nb='".$nb."' AND estatus=1";
    $query=pg_query($sql);
    $contar=pg_num_rows($query);

    $array=pg_fetch_assoc($query);
   // while ($array=pg_fetch_assoc($query))
    //{

    if ($contar>0)
    {
      if($array['id_nb']!=$id)
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
    
      
    //}
}
?>