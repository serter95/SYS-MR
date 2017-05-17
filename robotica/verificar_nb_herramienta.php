<?php
  require('seguridad.php');
  require('conexion.php');

  $nb = $_POST['nb'];
  $tipo=$_REQUEST['tipo'];
  $id=$_REQUEST['id'];
  
  if(!empty($nb)) {
    comprobar($nb);
  }
  
  function comprobar($nb)
  {
    $sql="SELECT * FROM herramientas h, numero_bien n WHERE nb='".$nb."' AND h.estatus='1' AND h.n_b=n.id_nb AND h.taller=2";
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
        if ($array['estado']=='En prestamo'){
          echo $dato=2;
        }
        else{
        echo $dato=1;
        }
      }
    //}
}
?>