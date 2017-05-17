<?php
	require("conexion.php");
	require("seguridad.php");

	$id=$_POST['id_horas'];
	$bloque=$_POST['bloque_M'];
	$ent=trim($_POST['inicio_M']);
	$he=$_POST['hora_entrada_M'];
	$hs=$_POST['hora_salida_M'];
	$sal=trim($_POST['fin_M']);

	$cero=substr($ent, 0,1);
	$cero1=substr($sal, 0,1);
	
	if($cero=='0')
	{
		$ent=substr($ent, 1);
	}
	if($cero1=='0')
	{
		$sal=substr($sal, 1);
	}

	$entrada=$ent.' '.$he;
	$salida=$sal.' '.$hs;

	$query=pg_query("SELECT * FROM horas WHERE numero_bloque='$bloque' AND taller=1 AND estatus=1");
	$num=pg_num_rows($query);
	$valor=pg_fetch_assoc($query);

	if ($num>0)
	{
		if ($id==$valor['id_horas'])
		{
			if ($bloque>1 && $bloque<=12)
			{
				$num_bloque=$bloque-1;

				$query2=pg_query("SELECT * FROM horas WHERE numero_bloque='$num_bloque' AND taller=1 AND estatus=1");
				$array=pg_fetch_assoc($query2);
				$num2=pg_num_rows($query2);

				if ($num2>0)
				{
					$t=explode(' ', $array['salida']);
					$tiempo=$t[1];
					$tiempo1=$t[0];

					$time=str_replace(":", ".", $tiempo1);
					$tiempo2=floatval($time);

					$ent1=str_replace(":", ".", $ent);
					$ent2=floatval($ent1);

					if ($tiempo=='Am' AND $he=='Am')
					{
						if ($ent2<=$tiempo2)
						{
							#echo "ERROR";
							header('Location:horarios.php?error=horas_menor_M');
						}
						else
						{
							pg_query("UPDATE horas SET entrada='$entrada',salida='$salida'
								,numero_bloque='$bloque' WHERE id_horas='$id'");
								#echo "EXITO";

							date_default_timezone_set('America/Caracas');

				          $hoy=date('Y-m-d h:i:s');

				          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
				              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");

								header('Location:horarios.php?modificar=horas');
						}
					}
					if ($tiempo=='Pm' AND $he=='Pm')
					{
						$ent3=explode(":", $ent);
						$tiempo3=explode(":", $tiempo1);

						if ($ent3[0]=='12')
						{
							$ent4="00.".$ent3[1];
						}
						else
						{
							$ent4=str_replace(":", ".", $ent);
						}

						if ($tiempo3[0]=='12')
						{
							$tiempo4="00.".$tiempo3[1];
						}
						else
						{
							$tiempo4=str_replace(":", ".", $tiempo1);
						}

						$ent5=floatval($ent4);
						$tiempo5=floatval($tiempo4);

						if ($ent5<=$tiempo5)
						{
							#echo "ERROR";
							header('Location:horarios.php?error=horas_menor_M');
						}
						else
						{
							pg_query("UPDATE horas SET entrada='$entrada',salida='$salida'
								,numero_bloque='$bloque' WHERE id_horas='$id'");
								#echo "EXITO";
						date_default_timezone_set('America/Caracas');

				          $hoy=date('Y-m-d h:i:s');

				          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
				              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");

								header('Location:horarios.php?modificar=horas');
						}
					}
					if ($tiempo=='Am' AND $he=='Pm')
					{
						pg_query("UPDATE horas SET entrada='$entrada',salida='$salida'
								,numero_bloque='$bloque' WHERE id_horas='$id'");
						#echo "EXITO";

					date_default_timezone_set('America/Caracas');

			          $hoy=date('Y-m-d h:i:s');

			          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");

						header('Location:horarios.php?modificar=horas');
					}
					if ($tiempo=='Pm' AND $he=='Am')
					{
						#echo "ERROR";
						header('Location:horarios.php?error=horas_distinta_M');
					}
				}
				else
				{
					#echo "ERROR";
					header('Location:horarios.php?error=registro_anterior_M');
				}
			}
			if ($bloque==1)
			{
				pg_query("UPDATE horas SET entrada='$entrada',salida='$salida'
								,numero_bloque='$bloque' WHERE id_horas='$id'");
				#echo "EXITO";

						date_default_timezone_set('America/Caracas');

			          $hoy=date('Y-m-d h:i:s');

			          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");


				header('Location:horarios.php?modificar=horas');
			}	
		}
		else
		{
			#echo "ERROR";
			header('Location:horarios.php?error=horas_M');
		}
	}
	else
	{
		if ($bloque>1 && $bloque<=12)
		{
			$num_bloque=$bloque-1;

			$query2=pg_query("SELECT * FROM horas WHERE numero_bloque='$num_bloque' AND taller=1 AND estatus=1");
			$array=pg_fetch_assoc($query2);
			$num2=pg_num_rows($query2);

			if ($num2>0)
			{
				$t=explode(' ', $array['salida']);
				$tiempo=$t[1];
				$tiempo1=$t[0];

				$time=str_replace(":", ".", $tiempo1);
				$tiempo2=floatval($time);

				$ent1=str_replace(":", ".", $ent);
				$ent2=floatval($ent1);

				if ($tiempo=='Am' AND $he=='Am')
				{
					if ($ent2<=$tiempo2)
					{
						#echo "ERROR";
						header('Location:horarios.php?error=horas_menor_M');
					}
					else
					{
						pg_query("UPDATE horas SET entrada='$entrada',salida='$salida'
								,numero_bloque='$bloque' WHERE id_horas='$id'");
							#echo "EXITO";
						date_default_timezone_set('America/Caracas');

			          $hoy=date('Y-m-d h:i:s');

			          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");


							header('Location:horarios.php?modificar=horas');
					}
				}
				if ($tiempo=='Pm' AND $he=='Pm')
				{
					$ent3=explode(":", $ent);
					$tiempo3=explode(":", $tiempo1);

					if ($ent3[0]=='12')
					{
						$ent4="00.".$ent3[1];
					}
					else
					{
						$ent4=str_replace(":", ".", $ent);
					}

					if ($tiempo3[0]=='12')
					{
						$tiempo4="00.".$tiempo3[1];
					}
					else
					{
						$tiempo4=str_replace(":", ".", $tiempo1);
					}

					$ent5=floatval($ent4);
					$tiempo5=floatval($tiempo4);

					if ($ent5<=$tiempo5)
					{
						#echo "ERROR";
						header('Location:horarios.php?error=horas_menor_M');
					}
					else
					{
						pg_query("UPDATE horas SET entrada='$entrada',salida='$salida'
								,numero_bloque='$bloque' WHERE id_horas='$id'");
							#echo "EXITO";

						date_default_timezone_set('America/Caracas');

			          $hoy=date('Y-m-d h:i:s');

			          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");

							header('Location:horarios.php?modificar=horas');
					}
				}
				if ($tiempo=='Am' AND $he=='Pm')
				{
					pg_query("UPDATE horas SET entrada='$entrada',salida='$salida'
								,numero_bloque='$bloque' WHERE id_horas='$id'");
					#echo "EXITO";

					date_default_timezone_set('America/Caracas');

			          $hoy=date('Y-m-d h:i:s');

			          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");

					header('Location:horarios.php?modificar=horas');
				}
				if ($tiempo=='Pm' AND $he=='Am')
				{
					#echo "ERROR";
					header('Location:horarios.php?error=horas_distinta_M');
				}
			}
			else
			{
				#echo "ERROR";
				header('Location:horarios.php?error=registro_anterior_M');
			}
		}
		if ($bloque==1)
		{
			pg_query("UPDATE horas SET entrada='$entrada',salida='$salida',numero_bloque='$bloque' WHERE id_horas='$id'");
			#echo "EXITO";

						date_default_timezone_set('America/Caracas');

			          $hoy=date('Y-m-d h:i:s');

			          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			              VALUES('$hoy','Modificación','Horas','".$_SESSION['nom_usuario']."',1)");


			header('Location:horarios.php?modificar=horas');
		}
	}
?>
