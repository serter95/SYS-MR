<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id_usu'];
	$nom_usu=trim($_POST['nombre_usuarioC']);
	$contrasena=trim(hash("ripemd160", md5($_POST['contrasena_usuarioC'])));
	$contrasena2=trim(hash("ripemd160", md5($_POST['contrasena2_usuarioC'])));
	$pregunta=trim($_POST['preguntaC']);
	$respuesta=trim($_POST['respuestaC']);

	if ($contrasena==$contrasena2)
	{
		pg_query("UPDATE usuario SET nom_usuario='$nom_usu', contrasena='$contrasena', pregunta='$pregunta'
			, respuesta='$respuesta' WHERE id_usu='$id'");

		header('Location:configuracion.php?exito=si');
	}
	else
	{
		header('Location:configuracion.php?exito=no');
	}
?>
	
			