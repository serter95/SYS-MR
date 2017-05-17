<?php
	require("seguridad.php");
	require("conexion.php");

	 $nacionalidad=$_POST['nacionalidad'];
	 $cedi=trim($_POST['ci_per']);
	 $nombres=ucfirst(trim($_POST['nombres_per']));
	 $apellidos=ucfirst(trim($_POST['apellidos_per']));
	 $sexo=$_POST['sexo'];
	 $grado_inst=ucfirst(trim($_POST['grado_inst_reg_per']));
	 $especialidad=ucfirst(trim($_POST['especialidad']));
	 $cargo=ucfirst(trim($_POST['cargo_per']));
	 $correo=trim($_POST['correo']);
	 $cod_tlf=$_POST['cod_tlf'];
	 $tlf=trim($_POST['num_cont']);
	 $fecha=trim($_POST['fecha_nac']);
	 $dedicacion=$_POST['dedicacion'];

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

	$nac_ci=$nacionalidad."".$ci;

	$num_cont=$cod_tlf."".$tlf;

	$fecha1=explode('/', $fecha);

	$fecha_nac=$fecha1[2]."-".$fecha1[1]."-".$fecha1[0];

	$sql="SELECT * FROM personal WHERE estatus=1 AND area='Mecanica'";
	$query=pg_query($sql);
	
	while($array=pg_fetch_assoc($query))
	{

		if ($nac_ci!=$array['ci'])
		{
			$com_ci='no';

			if ($correo!=$array['correo'])
			{
				$com_correo='no';
			}
			else
			{
				header('Location:personal.php?correo=error');
			}
		}
		else
		{
			header('Location:personal.php?error=ci');
		}
	}

	#echo $com_correo." ".$com_ci; 

	if ($com_ci=='no')
	{
		if ($com_correo=='no')
		{

			$sql="INSERT INTO personal(ci,nombres,apellidos,sexo,grado_instruccion,especialidad,area,cargo,correo,numero_contacto,fecha_nacimiento,estatus,dedicacion)
				VALUES('$nac_ci','$nombres','$apellidos','$sexo','$grado_inst','$especialidad','Mecanica','$cargo','$correo','$num_cont','$fecha_nac',1,'$dedicacion')";

				echo" ". $sql;
				pg_query($sql);

				date_default_timezone_set('America/Caracas');

				$hoy=date('Y-m-d h:i:s');

				pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
					VALUES('$hoy','Registro','Personal','".$_SESSION['nom_usuario']."',1)");

				header('Location:personal.php?registro=personal');
		}
	}

?>