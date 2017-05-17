<?php

	require 'conexion.php';
	require 'seguridad.php';

	$id=$_POST['id_horas'];
	$bloque=$_POST['bloque'];
	$ent=trim($_POST['inicio']);
	$he=$_POST['hora_entrada'];
	$hs=$_POST['hora_salida'];
	$sal=trim($_POST['fin']);

	$entrada=$ent.' '.$he;
	$salida=$sal.' '.$hs;

	$query=pg_query("SELECT * FROM horas WHERE numero_bloque='$bloque' AND taller=2 AND estatus=1");
	$num=pg_num_rows($query);
	$valor=pg_fetch_assoc($query);

		if($num>0)
		{
			if ($id==$valor['id_horas'])
			{
				if ($bloque>1 && $bloque<=12)
				{
					$num_bloque=$bloque-1;

					$query2=pg_query("SELECT * FROM horas WHERE numero_bloque='$num_bloque' AND taller=2 AND estatus=1");
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
								#La Hora de inicio del Bloque que esta registrando debe ser mayor a la Hora final del Bloque anterior
								echo 2;
							}
							else
							{
								echo 5;
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
								#La Hora de inicio del Bloque que esta registrando debe ser mayor a la Hora final del Bloque anterior
								echo 2;
							}
							else
							{
								echo 5;
							}
						}
						if ($tiempo=='Am' AND $he=='Pm')
						{
							echo 5;
						}
						if ($tiempo=='Pm' AND $he=='Am')
						{
							#Si la Hora final del Bloque anterior es Pm No puede registrar el Bloque en Am
							echo 3;
						}
					}
					else
					{
						#El Bloque anterior al seleccionado no existe. Por favor registrelo
						echo 4;
					}
				}
				if ($bloque==1)
				{
					echo 5;
				}	
			}
			else
			{
				#El Bloque de horas ya existe
				echo 1;
			}
		}
		else
		{
			if ($bloque>1 && $bloque<=12)
			{
				$num_bloque=$bloque-1;

				$query2=pg_query("SELECT * FROM horas WHERE numero_bloque='$num_bloque' AND taller=2 AND estatus=1");
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
							#La Hora de inicio del Bloque que esta registrando debe ser mayor a la Hora final del Bloque anterior
							echo 2;
						}
						else
						{
							echo 5;
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
							#La Hora de inicio del Bloque que esta registrando debe ser mayor a la Hora final del Bloque anterior
							echo 2;
						}
						else
						{
							echo 5;
						}
					}
					if ($tiempo=='Am' AND $he=='Pm')
					{
						echo 5;
					}
					if ($tiempo=='Pm' AND $he=='Am')
					{
						#Si la Hora final del Bloque anterior es Pm No puede registrar el Bloque en Am
						echo 3;
					}
				}
				else
				{
					#El Bloque anterior al seleccionado no existe. Por favor registrelo
					echo 4;
				}
			}
			if ($bloque==1)
			{
				echo 5;
			}
		}

?>