<?php
require ('seguridad.php');
require ('conexion.php');

	$id=$_REQUEST['id'];
	$valor=$_REQUEST['valor'];
	$sql="SELECT * FROM clausulas WHERE id_convenio='".$id."' AND contenido='".$valor."' AND estatus=1 ORDER BY id_clausula ASC";
	$query=pg_query($sql);
	


		
	$num=pg_num_rows($query);

  if($num > 0)
  {
    echo 0;
  }		
  else{
    echo 1;
  }							

    #array("modelo"=>$modelo);

?>

