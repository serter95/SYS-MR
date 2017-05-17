<?php
require ('seguridad.php');
require ('conexion.php');

	$fecha=$_REQUEST['fecha'];
	$id=$_REQUEST['id'];
	$tipo=$_REQUEST['tipo'];
	$id2=$_REQUEST['id_pre'];
	$id3=$_REQUEST['id_corre'];
	$mant=$_REQUEST['mant'];
if($mant=="preventivo"){
	if($tipo=="registro"){
	$sql="SELECT * FROM mant_preventivo WHERE fecha='".$fecha."' AND maquina_id='".$id."' AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);
	if($array['fecha']==$fecha){
		$datos = array(
			0 => "igual",
					);

	}

	else{
			$datos = array(
			0 => "valido",
					);
	}
	
	echo json_encode($datos);
	}
	elseif ($tipo=="modificacion") {
		$sql="SELECT * FROM mant_preventivo WHERE fecha='".$fecha."' AND maquina_id='".$id."' AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);
     $contar=pg_num_rows($query);
     if ($contar>0)
    {
      if($array['id_preventivo']!=$id2)
      {
         $datos= array(
         	0 => "igual",
         	);
      }
      else
      { 
        $datos = array(
			0 => "valido",
					);
      }
    }
    else
    {
       $datos = array(
			0 => "valido",
					);
    }
    	echo json_encode($datos);
		# code...
	}
}
elseif ($mant=="correctivo") {
		# code...
			if($tipo=="registro"){
	$sql="SELECT * FROM mant_correctivo WHERE fecha='".$fecha."' AND id_maquina='".$id."' AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);
	if($array['fecha_falla']==$fecha){
		$datos = array(
			0 => "igual",
					);

	}

	else{
			$datos = array(
			0 => "valido",
					);
	}


			
	echo json_encode($datos);
	}
	elseif ($tipo=="modificacion") {
	$sql="SELECT * FROM mant_correctivo WHERE fecha='".$fecha."' AND id_maquina='".$id."' AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);
     $contar=pg_num_rows($query);
     if ($contar>0)
    {
      if($array['id_correctivo']!=$id3)
      {
         $datos= array(
         	0 => "igual",
         	);
      }
      else
      { 
        $datos = array(
			0 => "valido",
					);
      }
    }
    else
    {
       $datos = array(
			0 => "valido",
					);
    }
    	echo json_encode($datos);
		# code...
	}
}
?>