<?php
  require('seguridad.php');
  require('conexion.php');

  $user = $_POST['user'];
  $pass=trim(hash("ripemd160", md5($_REQUEST['pass'])));
  //$pass= $_POST['pass'];
  if(!empty($user)) {
    comprobar($user,$pass);
  }
  
  function comprobar($user,$pass)
  {
  $sql2="SELECT * FROM usuario WHERE nom_usuario='$user' AND contrasena='$pass' AND estatus=1  AND taller=2";
      $query2=pg_query($sql2);
      $num2=pg_num_rows($query2);
    //$contar=pg_num_rows($query);
   
   // while ($array=pg_fetch_assoc($query))
    //{
    
      if($num2!=0)
      {
        echo $dato=1;
      }
      else
      { 
        echo $dato=0;
      }
    //}
}
?>