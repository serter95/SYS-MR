
<?php
require ('seguridad.php');
require ('conexion.php');

	$id=$_REQUEST['id'];
	
	$sql="SELECT * FROM maquinas WHERE id_maquina='".$id."' AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);
	//$array["id_maquina"];
	$maquina=$array["maquina"];
	$sqlinsu=pg_query("SELECT * FROM insumos WHERE medida='".$maquina."' AND estatus=1 AND taller=1");
	
	while($fila=pg_fetch_assoc($sqlinsu)){
		//$insumo2=$insumo2."<tr><td>".$encontrado2["_insumo"]."</td><td>".$encontrado2["nb"]."</td><td>".$encontrado2["nombre"]."</td></tr>";
		 $encontrado=$encontrado."<option value='".$fila['id_insumos']."'>".$fila['nombre']."</option>";
		}

	
	
	echo ("<option value=''></option>".$encontrado);
?>

