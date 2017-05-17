<?php
	require("seguridad.php");
	require("conexion.php");

$id=$_POST['id'];
$nac=$_POST['nac_usuM'];
$ci=trim($_POST['ci_usuM']);
$nom_usuario=trim($_POST['nombre_usuarioM']);
$contrasena=trim(hash("ripemd160", md5($_POST['contrasena_usuarioM'])));
$contrasena2=trim(hash("ripemd160", md5($_POST['contrasena2_usuarioM'])));
$tipo=$_POST['tipoM'];
$pregunta=trim($_POST['preguntaM']);
$respuesta=trim($_POST['respuestaM']);


	$ced=strlen($ci);

	if ($ced==7)
	{
		$cedu="0".$ci;
	}
	else
	{
		$cedu=$ci;
	}

$cedula=$nac.$cedu;

    # comparamos nombre de usuario
	$con="SELECT * FROM personal WHERE ci='$cedula' AND estatus=1 AND area='Mecanica' LIMIT 1";
	$pg=pg_query($con);
	$dato=pg_fetch_assoc($pg);
	$id_personal=$dato['id'];

	$s="SELECT * FROM usuario WHERE estatus=1";
	$c=pg_query($s);
	while ($a=pg_fetch_assoc($c))
	{
		if($id_personal==$a['id_personal'])
		{
			$personal="existe";
		}
	}

	$sql="SELECT * FROM usuario WHERE id_usu='".$id."'";
	$query=pg_query($sql);
	$num=pg_num_rows($query);
	$array=pg_fetch_assoc($query);

	$id_usu_personal=$array['id_personal'];

	if ($personal!='existe')
	{
			if ($nom_usuario==$array['nom_usuario'])
			{
				if ($contrasena!=$contrasena2)
				{
					header("Location:usuarios.php?error=contrasenaM");

					#echo "mismo nombre, contraseñas diferentes";
				}
				else
				{
					$inst="SELECT * FROM tipo_usuario WHERE tipo='$tipo' AND area In ('Mecanica' , 'Doble')";
					$con=pg_query($inst);
					$dato=pg_fetch_assoc($con);
					$id_tipo_usuario=$dato['id_tipo'];

					$sql="UPDATE usuario SET nom_usuario='".$nom_usuario."', contrasena='".$contrasena."', estatus=1
					, id_personal='".$id_personal."', id_tipo_usuario='".$id_tipo_usuario."', pregunta='$pregunta'
					, respuesta='$respuesta' WHERE id_usu='".$id."'";
		
					pg_query($sql);

					date_default_timezone_set('America/Caracas');

					$hoy=date('Y-m-d h:i:s');

					pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
						VALUES('$hoy','Modificación','Usuarios','".$_SESSION['nom_usuario']."',1)");

					#echo $sql." mismo nombre";

					header("Location:usuarios.php?registro=usuarioM");
				}
			}
			else
			{
				$sql2="SELECT * FROM usuario WHERE estatus=1";
				$query2=pg_query($sql2);
				
				while($array2=pg_fetch_assoc($query2))
				{
					if ($nom_usuario==$array2['nom_usuario'])
					{
						$usuario_existe='si';
					}
				}

				if ($usuario_existe!='si')
				{
					if ($contrasena!=$contrasena2)
					{
						header("Location:usuarios.php?error=contrasenaM");
						
						#echo "nombre diferente, contraseñas diferentes";
					}
					else
					{
						$inst="SELECT * FROM tipo_usuario WHERE tipo='$tipo' AND area In ('Mecanica' , 'Doble')";
						$con=pg_query($inst);
						$dato=pg_fetch_assoc($con);
						$id_tipo_usuario=$dato['id_tipo'];

						$sql="UPDATE usuario SET nom_usuario='".$nom_usuario."', contrasena='".$contrasena."', estatus=1
						, id_personal='".$id_personal."', id_tipo_usuario='".$id_tipo_usuario."', pregunta='$pregunta'
						,respuesta='$respuesta' WHERE id_usu='".$id."'";
		
						pg_query($sql);

						date_default_timezone_set('America/Caracas');

						$hoy=date('Y-m-d h:i:s');

						pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
							VALUES('$hoy','Modificación','Usuarios','".$_SESSION['nom_usuario']."',1)");

						#echo $sql." nombre diferente";

						header("Location:usuarios.php?registro=usuarioM");
					}
				}
				else
				{
					header("Location:usuarios.php?error=nom_usuarioM");

					#echo "nombre de usuario no disponible";
				}	
			}
		}

		if ($personal=='existe' && $id_usu_personal==$id_personal)
		{
			$sql="SELECT * FROM usuario WHERE id_usu='".$id."'";
			$query=pg_query($sql);
			$num=pg_num_rows($query);
			$array=pg_fetch_assoc($query);

				if ($nom_usuario==$array['nom_usuario'])
				{
					if ($contrasena!=$contrasena2)
					{
						header("Location:usuarios.php?error=contrasenaM");

						#echo "mismo nombre, contraseñas diferentes";
					}
					else
					{
						$inst="SELECT * FROM tipo_usuario WHERE tipo='$tipo' AND area In ('Mecanica' , 'Doble')";
						$con=pg_query($inst);
						$dato=pg_fetch_assoc($con);
						$id_tipo_usuario=$dato['id_tipo'];

						$sql="UPDATE usuario SET nom_usuario='".$nom_usuario."', contrasena='".$contrasena."', estatus=1
						, id_personal='".$id_personal."', id_tipo_usuario='".$id_tipo_usuario."', pregunta='$pregunta'
						, respuesta='$respuesta' WHERE id_usu='".$id."'";
			
						pg_query($sql);

						date_default_timezone_set('America/Caracas');

						$hoy=date('Y-m-d h:i:s');

						pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
							VALUES('$hoy','Modificación','Usuarios','".$_SESSION['nom_usuario']."',1)");

						#echo $sql." mismo nombre";

						header("Location:usuarios.php?registro=usuarioM");
					}
				}
				else
				{
					$sql2="SELECT * FROM usuario WHERE estatus=1";
					$query2=pg_query($sql2);
					
					while($array2=pg_fetch_assoc($query2))
					{
						if ($nom_usuario==$array2['nom_usuario'])
						{
							$usuario_existe='si';
						}
					}

					if ($usuario_existe!='si')
					{
						if ($contrasena!=$contrasena2)
						{
							header("Location:usuarios.php?error=contrasenaM");
							
							#echo "nombre diferente, contraseñas diferentes";
						}
						else
						{
							$inst="SELECT * FROM tipo_usuario WHERE tipo='$tipo' AND area In ('Mecanica' , 'Doble')";
							$con=pg_query($inst);
							$dato=pg_fetch_assoc($con);
							$id_tipo_usuario=$dato['id_tipo'];

							$sql="UPDATE usuario SET nom_usuario='".$nom_usuario."', contrasena='".$contrasena."', estatus=1
							, id_personal='".$id_personal."', id_tipo_usuario='".$id_tipo_usuario."', pregunta='$pregunta'
							, respuesta='$respuesta' WHERE id_usu='".$id."'";
			
							pg_query($sql);

							date_default_timezone_set('America/Caracas');

							$hoy=date('Y-m-d h:i:s');

							pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
								VALUES('$hoy','Modificación','Usuarios','".$_SESSION['nom_usuario']."',1)");

							#echo $sql." nombre diferente";

							header("Location:usuarios.php?registro=usuarioM");
						}
					}
					else
					{
						header("Location:usuarios.php?error=nom_usuarioM");

						#echo "nombre de usuario no disponible";
					}	
				}
		}
		else
		{
			header('Location:usuarios.php?error=id_personaM');
		}
?>