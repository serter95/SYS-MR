<?php

include("seguridad.php");
include("conexion.php");
  // read input stream




    $data = file_get_contents("php://input");
     
    // filtering and decoding code adapted from
        // http://stackoverflow.com/questions/11843115/uploading-canvas-context-as-image-using-ajax-and-php?lq=1
    // Filter out the headers (data:,) part.
    $filteredData=substr($data, strpos($data, ",")+1);
    // Need to decode before saving since the data we received is already base64 encoded
    $decodedData=base64_decode($filteredData);

 	 date_default_timezone_set('America/Caracas');


 	 	 $hoy=date('Y-m-d');
 	 	 $hora=date('h:i A');
 	  	 $buscando=pg_query("SELECT * FROM graficas WHERE fecha BETWEEN '".$hoy."' AND '".$hoy."' ");
 	  	 $num=pg_num_rows($buscando);
         $q=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo'");
        $q2=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='No Operativo'");
        $q=pg_num_rows($q);
        $q2=pg_num_rows($q2);

 	  	 if($num>0){
 	  	 while ($array=pg_fetch_array($buscando)) {
 	  	 	$id=$array['id_grafica'];
 	  	 	}		  	 	

			
			$fic_name = ($id).'.png';			
 	  	 	$sql2=pg_query("UPDATE graficas SET ubicacion = 'graficas/$fic_name', hora ='$hora', operativo='$q', inoperativo='$q2' WHERE id_grafica=$id");

 	  	 	$fp = fopen('./graficas/'.$fic_name, 'wb');
		    $ok = fwrite( $fp, $decodedData);
		    fclose( $fp );
		    if($ok)
		        echo $fic_name;
		    else
		        echo "ERROR";

 	  	 }
 	  	 else{

 	
    $sql="INSERT INTO graficas (fecha,hora,operativo,inoperativo) VALUES ('$hoy','$hora','$q','$q2')";
    	$resultado = pg_query($sql);

 	$slq_img = "SELECT * FROM graficas";
 	$resultado_img = pg_query($slq_img);
 	while ($datos = pg_fetch_array($resultado_img)) {

					$id_g=$datos['id_grafica'];
				}

    // store in server
    $fic_name =$id_g.'.png';

    $sql2=pg_query("UPDATE graficas SET ubicacion = 'graficas/$fic_name' WHERE id_grafica='$id_g'");




    $fp = fopen('./graficas/'.$fic_name, 'wb');
    $ok = fwrite( $fp, $decodedData);
    fclose( $fp );
    if($ok)
        echo $fic_name;
    else
        echo "ERROR";
    }
?>