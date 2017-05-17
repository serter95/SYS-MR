<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_POST['id'];
	$nacionalidad=$_POST['nac_perM'];
	$cedi=trim($_POST['ci_perM']);
	$nombres=ucfirst(trim($_POST['nombres_perM']));
	$apellidos=ucfirst(trim($_POST['apellidos_perM']));
	$sexo=$_POST['sexo_perM'];
	$grado_inst=ucfirst(trim($_POST['grado_instM']));
	$especialidad=ucfirst(trim($_POST['especialidadM']));
	$cargo=ucfirst(trim($_POST['cargo_perM']));
	$correo=trim($_POST['correoM']);
	$cod_tlf=$_POST['cod_tlfM'];
	$tlf=trim($_POST['num_contM']);
	$fecha=trim($_POST['fecha_nacM']);
	$dedicacion=$_POST['dedicacionM'];

	if ($dedicacion=='')
	 {
	 	$dedicacion='No';
	 }

	$longitud=strlen($cedi);

	if ($longitud==7)
	{
		$ci="0"."".$cedi;
	}
	else
	{
		$ci=$cedi;
	}

	$nac_ci=$nacionalidad.$ci;

	$num_cont=$cod_tlf.$tlf;

	$fecha1=explode('/', $fecha);

	$fecha_nac=$fecha1[2]."-".$fecha1[1]."-".$fecha1[0];


	$sql="SELECT * FROM personal WHERE ci='$nac_ci' AND estatus=1 AND area='Mecanica'";
	$query=pg_query($sql);
	$num=pg_num_rows($query);
	$array=pg_fetch_assoc($query);

	$query2=pg_query("SELECT * FROM personal WHERE correo='$correo' AND estatus=1 AND area='Mecanica'");
	$num2=pg_num_rows($query2);
	$array2=pg_fetch_assoc($query2);

	if ($num>0)
	{
		if ($id==$array['id'])
		{

			if ($num2>0)
			{
				if ($id==$array2['id'])
				{
					# UPDATE
					$sql="UPDATE personal SET ci='".$nac_ci."',nombres='".$nombres."',apellidos='".$apellidos."',sexo='".$sexo."',grado_instruccion='".$grado_inst."',especialidad='".$especialidad."',area='Mecanica',cargo='".$cargo."',correo='".$correo."',numero_contacto='".$num_cont."',fecha_nacimiento='".$fecha_nac."',estatus=1,dedicacion='$dedicacion' WHERE id='".$id."'";

					pg_query($sql);

					date_default_timezone_set('America/Caracas');

					$hoy=date('Y-m-d h:i:s');

					pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
						VALUES('$hoy','Modificación','Personal','".$_SESSION['nom_usuario']."','1')");

					header('Location:personal.php?modificacion=si');
				}
				else
				{
					# CORREO EXISTE EN OTRA PERSONA
					header('Location:personal.php?correo=errorM');
				}
			}
			else
			{
				# UPDATE
				$sql="UPDATE personal SET ci='".$nac_ci."',nombres='".$nombres."',apellidos='".$apellidos."',sexo='".$sexo."',grado_instruccion='".$grado_inst."',especialidad='".$especialidad."',area='Mecanica',cargo='".$cargo."',correo='".$correo."',numero_contacto='".$num_cont."',fecha_nacimiento='".$fecha_nac."',estatus=1,dedicacion='$dedicacion' WHERE id='".$id."'";

				pg_query($sql);

				date_default_timezone_set('America/Caracas');

				$hoy=date('Y-m-d h:i:s');

				pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
					VALUES('$hoy','Modificación','Personal','".$_SESSION['nom_usuario']."','1')");

				header('Location:personal.php?modificacion=si');
			}
		}
		else
		{
			# CEDULA EXISTE EN OTRA PERSONA
			header('Location:personal.php?error=ciM');
		}
	}
	else
	{
		if ($num2>0)
		{
			if ($id==$array2['id'])
			{
				# UPDATE
				$sql="UPDATE personal SET ci='".$nac_ci."',nombres='".$nombres."',apellidos='".$apellidos."',sexo='".$sexo."',grado_instruccion='".$grado_inst."',especialidad='".$especialidad."',area='Mecanica',cargo='".$cargo."',correo='".$correo."',numero_contacto='".$num_cont."',fecha_nacimiento='".$fecha_nac."',estatus=1,dedicacion='$dedicacion' WHERE id='".$id."'";

				#echo $sql;
				
				pg_query($sql);

				date_default_timezone_set('America/Caracas');

				$hoy=date('Y-m-d h:i:s');

				pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
					VALUES('$hoy','Modificación','Personal','".$_SESSION['nom_usuario']."','1')");

				header('Location:personal.php?modificacion=si');
			}
			else
			{
				# CORREO EXISTE EN OTRA PERSONA
				header('Location:personal.php?correo=errorM');
			}
		}
		else
		{
			# UPDATE
			$sql="UPDATE personal SET ci='".$nac_ci."',nombres='".$nombres."',apellidos='".$apellidos."',sexo='".$sexo."',grado_instruccion='".$grado_inst."',especialidad='".$especialidad."',area='Mecanica',cargo='".$cargo."',correo='".$correo."',numero_contacto='".$num_cont."',fecha_nacimiento='".$fecha_nac."',estatus=1,dedicacion='$dedicacion' WHERE id='".$id."'";

			#echo $sql;
			
			pg_query($sql);

			date_default_timezone_set('America/Caracas');

			$hoy=date('Y-m-d h:i:s');

			pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
				VALUES('$hoy','Modificación','Personal','".$_SESSION['nom_usuario']."','1')");

			header('Location:personal.php?modificacion=si');
		}
	}

?>