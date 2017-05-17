<?php

	require('conexion.php'); # PARA FUNCIONAR REQUIERE EL ARCHIVO 'CONEXION.PHP'

	# se toman las variables enviadas desde el formuario

	$nom_usuario=trim($_REQUEST['user_name']);	
	$contrasena=trim(hash("ripemd160", md5($_REQUEST['password'])));
	$area=trim($_REQUEST['area']);

	# se crea la sentencia sql para seleccionar al usuario

	$sql="SELECT * FROM usuario, tipo_usuario, personal WHERE usuario.id_tipo_usuario = tipo_usuario.id_tipo
		AND usuario.id_personal=personal.id AND usuario.nom_usuario='$nom_usuario'
		AND usuario.contrasena='$contrasena' AND usuario.taller='$area' AND usuario.estatus=1 AND
		tipo_usuario.estatus=1 AND personal.estatus=1 LIMIT 1";

	# instrucciones sql para ejecutar la sentcia

	$query=pg_query($sql);
	$num=pg_num_rows($query);

	# si existe una columna con el usuario y contraseña igual


	if ($num==1)
	{
		# convierte los datos en un arreglo
		$array=pg_fetch_array($query);

		if ($array['bloqueo']==1)
		{
			header('Location:../index.php?error=2');
		}
		else
		{
			# inicia sesion
			
			# se evalua el area para redireccionar // REALIZAR TABLA PERSONAL PARA HACER INNER JOIN CON USUARIO

			 if ($area==1) # MECANICA
			 {
			 	if ($array['area']=='Mecanica')
			 	{
			 		
			 		
				 		session_start();

						$id_usu=$array['id_usu'];

						# variables globales

						$_SESSION["g1tr2sv"]="SI"; // autentificado
						$_SESSION['nom_usuario']=$nom_usuario;
						$_SESSION['tipo']=$array['tipo'];
						$_SESSION["area"]=$array["area"];

						header("Location:index.php"); # BUENO Y REDIRECCIONA
				}
				else
				{
					header("Location:../index.php?error_area=1"); # MALO Y MANDA ERROR
				}
			 	
			 }
			 if ($area==2)	# ROBOTICA
			 {
			 	if ($array['area']=='Robotica')
			 	{
				 		session_start();

						$id_usu=$array['id_usu'];

						# variables globales

						$_SESSION["g2tr1sv"]="SI"; // autentificado
						$_SESSION['nom_usuario']=$nom_usuario;
						$_SESSION['tipo']=$array['tipo'];
						$_SESSION["area"]=$array["area"];
		
						header("Location:../robotica");	# BUENO Y REDIRECCIONA
				}
				else
				{
					header("Location:../index.php?error_area=2");	# MALO Y MANDA ERROR
				}
			 	
			 }
		}
	}
	
	# si no existe el usuario
	else 
	{
		//header("Location:../index.php?error=1");	# MALO Y MANDA ERROR
		if ($area=='1'){
			header("Location:../tallermec.php?pagina=1&error=1");
		}
		else{
			header("Location:../labrob.php?pagina=2&error=1");
		}
	}

?>		