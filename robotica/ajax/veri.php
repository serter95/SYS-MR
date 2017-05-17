<?php
include("../conexion.php");
/*   
// Que no se nos olvide incluir nuestro fichero con la conexion a la base de datos.  
include("../conexion.php");  
$nick=$_REQUEST['codigo'];  
$sql="SELECT * FROM maquinas WHERE codigo='$nick'";  
$res=pg_query($sql);  
$total=pg_num_rows($res);  
if($total>0)  
{   
  // El usuario existe en la Base de Datos  
  echo "Este nick está ocupado";  
}  
else  
{  
  // Ese nick esta libre  
  echo "Nick libre";  
}  */

	$user = $_POST['b'];
	
	if(!empty($user)) {
		comprobar($user);
	}
	
	function comprobar($b) {
		$pre_codigo=$_REQUEST_['pre_codigo'];
		$codigos=$_REQUEST_['codigo'];
		$codigo="$pre_codigo"."$codigos";
		
		$sql = pg_query("SELECT * FROM maquinas WHERE codigo = '".$codigo."'");
		
		$contar = pg_num_rows($sql);
		
		if($contar == 0){
			echo "<span style='font-weight:bold;color:green;'>Disponible.</span>";
		}else{
			echo "<span style='font-weight:bold;color:red;'>El nombre de usuario ya existe.</span>";
		}
	}	
?>
