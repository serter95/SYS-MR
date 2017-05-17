<?php

include("conexion.php");
include("seguridad.php");

$recibiendo=trim($_REQUEST["codigo"])&&trim($_REQUEST["nombre"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error
?>
	<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>
<?php
header("Location:maquinas.php");
}

else{
$codigo=$_REQUEST["codigo"];
$nombre=$_REQUEST["nombre"];
if (!eregi("^[A-Za-z]{1,4}$",$codigo)){
?>
	<script language="javascript">
		alert("Error en el campo de codigo, Formato Invalido, Solo coloque letras");
		window.location.href="maquinas.php";
	</script>	
<?php
header("Location:maquinas.php");
}

else if (!eregi("^[A-Za-z ]{5,15}$",$nombre)){
?>
	<script language="javascript">
		alert("Error en el campo de nombre, Formato Invalido, Solo coloque letras");
		window.location.href="maquinas.php";
	</script>	
<?php
header("Location:maquinas.php");
}


else{

	echo $codigo=$codigo."-";
		$codigo=ucwords($codigo);
		$nombre=ucwords($nombre);
	echo $sqlx="INSERT INTO tipo_maquina(codigo,nombre)VALUES('".$codigo."','".$nombre."')";
 pg_query($sqlx);
 header("Location:maquinas.php?registrado_maq=si");
}



}

?>