<?php
	require('seguridad.php');
	require('conexion.php');
	
	$nac_usu=$_POST['nac_usu'];
	$ci_usu=trim($_POST['ci_usu']);
	$nombres=ucfirst(trim($_POST['nombres_usu']));
	$apellidos=ucfirst(trim($_POST['apellidos_usu']));
	$nom_usuario=trim($_POST['nombre_usuario']);
	$contrasena=trim(hash("ripemd160", md5($_POST['contrasena_usuario'])));
	$contrasena2=trim(hash("ripemd160", md5($_POST['contrasena2_usuario'])));
	$tipo=trim($_POST['tipo']);
	$pregunta=trim($_POST['pregunta']);
	$respuesta=trim($_POST['respuesta']);

	$ci=$nac_usu.$ci_usu;
	
	#echo $nac_usu;

	$sql="SELECT * FROM personal WHERE ci='$ci' AND estatus=1 AND area='Mecanica'";
	$query=pg_query($sql);
	$dato=pg_fetch_assoc($query);
	$id_per=$dato['id'];
	
	$sql_2="SELECT * FROM usuario WHERE taller=1 AND estatus=1";
	$query_2=pg_query($sql_2);
	
	while($array_2=pg_fetch_assoc($query_2))
	{
		$id_usu_per=$array_2['id_personal'];

		if($id_per==$id_usu_per)
		{
			$iguales='si';
		}
	}
	
	if ($iguales!='si')
	{

		$sql="SELECT * FROM usuario WHERE nom_usuario='$nom_usuario' AND taller=1 AND estatus=1 LIMIT 1";
		$query=pg_query($sql);
		$array=pg_fetch_assoc($query);

		if ($array['nom_usuario']!=$nom_usuario)
		{

			if ($contrasena!=$contrasena2)
			{
				header("Location:usuarios.php?error=contrasena");
			}
			else
			{

			$inst="SELECT * FROM tipo_usuario WHERE tipo='$tipo' AND area In ('Mecanica', 'Doble') AND estatus=1";
			$con=pg_query($inst);
			$dato=pg_fetch_assoc($con);
			$id_tipo_usuario=$dato['id_tipo'];
				
			$sql="INSERT INTO usuario (nom_usuario, contrasena, estatus, id_personal, id_tipo_usuario, pregunta, respuesta)
				VALUES ('$nom_usuario', '$contrasena', 1, '$id_per', '$id_tipo_usuario', '$pregunta', '$respuesta')";

				$query=pg_query($sql);

			date_default_timezone_set('America/Caracas');

			$hoy=date('Y-m-d h:i:s');

			pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
				VALUES('$hoy','Registro','Usuarios','".$_SESSION['nom_usuario']."',1)");

				#echo $sql;

				header("Location:usuarios.php?registro=usuario");

				#echo "*BUENO*";
			}
		}
		else
		{
			#echo " *USUARIO MALO* ";
			header("Location:usuarios.php?error=nom_usuario");
		}	
	}
	else
	{
		#echo " *EXISTEN* ";
		header("Location:usuarios.php?error=id_persona");
	}
?>