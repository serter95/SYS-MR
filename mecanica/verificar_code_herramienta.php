<?php
  require('seguridad.php');
  require('conexion.php');

  $codigo = $_REQUEST['codigo'];
  $tipo=$_RESQUEST['tipo'];
  $id=$_RESQUEST['id'];
  
  if(!empty($codigo)) {
    comprobar($codigo);
  }
  
  function comprobar($codigo)
  {
    $sql="SELECT * FROM herramientas WHERE codigo_herramienta='".$codigo."' AND estatus='1' AND taller=1";
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