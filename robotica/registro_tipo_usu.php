<?php
	require('seguridad.php');
	require('conexion.php');

#								.....PRIVLEGIOS DE USUARIO.....
	$nombre_tipo=ucfirst(trim($_POST['nombre_tipo']));

	#			............................ACADEMICOS.................................
	
	#  ...HORARIOS...			  ...PROYECTOS...			  ...CONVENIOS...
	$pach1=$_POST['pach1'];		$pacp1=$_POST['pacp1'];		$paconv1=$_POST['paconv1'];
	$pach2=$_POST['pach2'];		$pacp2=$_POST['pacp2'];		$paconv2=$_POST['paconv2'];
	$pach3=$_POST['pach3'];		$pacp3=$_POST['pacp3'];		$paconv3=$_POST['paconv3'];
	$pach4=$_POST['pach4'];		$pacp4=$_POST['pacp4'];		$paconv4=$_POST['paconv4'];
	
	#		    ............................ADMINISTRATIVOS............................

	#  ...INVENTARIO...			    ...MAQUINAS...			  ...ACTIVIDADES...			    ...PERSONAL...
	$padi1=$_POST['padi1'];		$padm1=$_POST['padm1'];		$pada1=$_POST['pada1'];		$padp1=$_POST['padp1'];
	$padi2=$_POST['padi2'];		$padm2=$_POST['padm2'];		$pada2=$_POST['pada2'];		$padp2=$_POST['padp2'];
	$padi3=$_POST['padi3'];		$padm3=$_POST['padm3'];		$pada3=$_POST['pada3'];		$padp3=$_POST['padp3'];
	$padi4=$_POST['padi4'];		$padm4=$_POST['padm4'];		$pada4=$_POST['pada4'];		$padp4=$_POST['padp4'];
	$padi5=$_POST['padi5'];
	#			...........................CONFIGURACION...............................

	#	...USUARIOS...			    ...BD...				...AUDITORIA...
	$priv_usuarios=$_POST['pconu'];	$BD=$_POST['BD'];	$auditoria=$_POST['auditoria'];

	#		.........HORARIOS.............

	if ($pach1=='A') { $priv_horarios=$pach1."-0-0-0"; }
	if ($pach2=='E') { $priv_horarios="0-".$pach2."-0-0"; }
	if ($pach3=='M') { $priv_horarios="0-0-".$pach3."-0"; }
	if ($pach4=='I') { $priv_horarios="0-0-0-".$pach4; }
	if ($pach1=='A' && $pach2=='E') { $priv_horarios=$pach1."-".$pach2."-0-0"; }
	if ($pach1=='A' && $pach3=='M') { $priv_horarios=$pach1."-0-".$pach3."-0"; }
	if ($pach1=='A' && $pach4=='I') { $priv_horarios=$pach1."-0-0-".$pach4; }
	if ($pach2=='E' && $pach3=='M') { $priv_horarios="0-".$pach2."-".$pach3."-0"; }
	if ($pach2=='E' && $pach4=='I') { $priv_horarios="0-".$pach2."-0-".$pach4; }
	if ($pach3=='M' && $pach4=='I') { $priv_horarios="0-0-".$pach3."-".$pach4; }
	if ($pach1=='A' && $pach2=='E' && $pach3=='M') { $priv_horarios=$pach1."-".$pach2."-".$pach3."-0"; }
	if ($pach1=='A' && $pach2=='E' && $pach4=='I') { $priv_horarios=$pach1."-".$pach2."-0-".$pach4; }			
	if ($pach1=='A' && $pach3=='M' && $pach4=='I') { $priv_horarios=$pach1."-0-".$pach3."-".$pach4; }
	if ($pach2=='E' && $pach3=='M' && $pach4=='I') { $priv_horarios="0-".$pach2."-".$pach3."-".$pach4; }
	if ($pach1=='A' && $pach2=='E' && $pach3=='M' && $pach4=='I') { $priv_horarios=$pach1."-".$pach2."-".$pach3."-".$pach4; }
	if ($pach1=='' && $pach2=='' && $pach3=='' && $pach4=='') { $priv_horarios=0; }

	#		..........PROYECTOS...........
	
	if ($pacp1=='A') { $priv_proyectos=$pacp1."-0-0-0"; }
	if ($pacp2=='E') { $priv_proyectos="0-".$pacp2."-0-0"; }
	if ($pacp3=='M') { $priv_proyectos="0-0-".$pacp3."-0"; }
	if ($pacp4=='I') { $priv_proyectos="0-0-0-".$pacp4; }
	if ($pacp1=='A' && $pacp2=='E') { $priv_proyectos=$pacp1."-".$pacp2."-0-0"; }
	if ($pacp1=='A' && $pacp3=='M') { $priv_proyectos=$pacp1."-0-".$pacp3."-0"; }
	if ($pacp1=='A' && $pacp4=='I') { $priv_proyectos=$pacp1."-0-0-".$pacp4; }
	if ($pacp2=='E' && $pacp3=='M') { $priv_proyectos="0-".$pacp2."-".$pacp3."-0"; }
	if ($pacp2=='E' && $pacp4=='I') { $priv_proyectos="0-".$pacp2."-0-".$pacp4; }
	if ($pacp3=='M' && $pacp4=='I') { $priv_proyectos="0-0-".$pacp3."-".$pacp4; }
	if ($pacp1=='A' && $pacp2=='E' && $pacp3=='M') { $priv_proyectos=$pacp1."-".$pacp2."-".$pacp3."-0"; }
	if ($pacp1=='A' && $pacp2=='E' && $pacp4=='I') { $priv_proyectos=$pacp1."-".$pacp2."-0-".$pacp4; }			
	if ($pacp1=='A' && $pacp3=='M' && $pacp4=='I') { $priv_proyectos=$pacp1."-0-".$pacp3."-".$pacp4; }
	if ($pacp2=='E' && $pacp3=='M' && $pacp4=='I') { $priv_proyectos="0-".$pacp2."-".$pacp3."-".$pacp4; }
	if ($pacp1=='A' && $pacp2=='E' && $pacp3=='M' && $pacp4=='I') { $priv_proyectos=$pacp1."-".$pacp2."-".$pacp3."-".$pacp4; }
	if ($pacp1=='' && $pacp2=='' && $pacp3=='' && $pacp4=='') { $priv_proyectos=0; }

	#		..........CONVENIOS...........

	if ($paconv1=='A') { $priv_convenios=$paconv1."-0-0-0"; }
	if ($paconv2=='E') { $priv_convenios="0-".$paconv2."-0-0"; }
	if ($paconv3=='M') { $priv_convenios="0-0-".$paconv3."-0"; }
	if ($paconv4=='I') { $priv_convenios="0-0-0-".$paconv4; }
	if ($paconv1=='A' && $paconv2=='E') { $priv_convenios=$paconv1."-".$paconv2."-0-0"; }
	if ($paconv1=='A' && $paconv3=='M') { $priv_convenios=$paconv1."-0-".$paconv3."-0"; }
	if ($paconv1=='A' && $paconv4=='I') { $priv_convenios=$paconv1."-0-0-".$paconv4; }
	if ($paconv2=='E' && $paconv3=='M') { $priv_convenios="0-".$paconv2."-".$paconv3."-0"; }
	if ($paconv2=='E' && $paconv4=='I') { $priv_convenios="0-".$paconv2."-0-".$paconv4; }
	if ($paconv3=='M' && $paconv4=='I') { $priv_convenios="0-0-".$paconv3."-".$paconv4; }
	if ($paconv1=='A' && $paconv2=='E' && $paconv3=='M') { $priv_convenios=$paconv1."-".$paconv2."-".$paconv3."-0"; }
	if ($paconv1=='A' && $paconv2=='E' && $paconv4=='I') { $priv_convenios=$paconv1."-".$paconv2."-0-".$paconv4; }			
	if ($paconv1=='A' && $paconv3=='M' && $paconv4=='I') { $priv_convenios=$paconv1."-0-".$paconv3."-".$paconv4; }
	if ($paconv2=='E' && $paconv3=='M' && $paconv4=='I') { $priv_convenios="0-".$paconv2."-".$paconv3."-".$paconv4; }
	if ($paconv1=='A' && $paconv2=='E' && $paconv3=='M' && $paconv4=='I') { $priv_convenios=$paconv1."-".$paconv2."-".$paconv3."-".$paconv4; }
	if ($paconv1=='' && $paconv2=='' && $paconv3=='' && $paconv4=='') { $priv_convenios=0; }

	#		.........INVENTARIO..........

	if ($padi1=='A') { $priv_inventario=$padi1."-0-0-0"; }
	if ($padi2=='E') { $priv_inventario="0-".$padi2."-0-0"; }
	if ($padi3=='M') { $priv_inventario="0-0-".$padi3."-0"; }
	if ($padi4=='I') { $priv_inventario="0-0-0-".$padi4; }
	if ($padi1=='A' && $padi2=='E') { $priv_inventario=$padi1."-".$padi2."-0-0"; }
	if ($padi1=='A' && $padi3=='M') { $priv_inventario=$padi1."-0-".$padi3."-0"; }
	if ($padi1=='A' && $padi4=='I') { $priv_inventario=$padi1."-0-0-".$padi4; }
	if ($padi2=='E' && $padi3=='M') { $priv_inventario="0-".$padi2."-".$padi3."-0"; }
	if ($padi2=='E' && $padi4=='I') { $priv_inventario="0-".$padi2."-0-".$padi4; }
	if ($padi3=='M' && $padi4=='I') { $priv_inventario="0-0-".$padi3."-".$padi4; }
	if ($padi1=='A' && $padi2=='E' && $padi3=='M') { $priv_inventario=$padi1."-".$padi2."-".$padi3."-0"; }
	if ($padi1=='A' && $padi2=='E' && $padi4=='I') { $priv_inventario=$padi1."-".$padi2."-0-".$padi4; }			
	if ($padi1=='A' && $padi3=='M' && $padi4=='I') { $priv_inventario=$padi1."-0-".$padi3."-".$padi4; }
	if ($padi2=='E' && $padi3=='M' && $padi4=='I') { $priv_inventario="0-".$padi2."-".$padi3."-".$padi4; }
	if ($padi1=='A' && $padi2=='E' && $padi3=='M' && $padi4=='I') { $priv_inventario=$padi1."-".$padi2."-".$padi3."-".$padi4; }
	if ($padi1=='' && $padi2=='' && $padi3=='' && $padi4=='') { $priv_inventario=0; }

	#		..........MAQUINAS............

	if ($padm1=='A') { $priv_maquinas=$padm1."-0-0-0"; }
	if ($padm2=='E') { $priv_maquinas="0-".$padm2."-0-0"; }
	if ($padm3=='M') { $priv_maquinas="0-0-".$padm3."-0"; }
	if ($padm4=='I') { $priv_maquinas="0-0-0-".$padm4; }
	if ($padm1=='A' && $padm2=='E') { $priv_maquinas=$padm1."-".$padm2."-0-0"; }
	if ($padm1=='A' && $padm3=='M') { $priv_maquinas=$padm1."-0-".$padm3."-0"; }
	if ($padm1=='A' && $padm4=='I') { $priv_maquinas=$padm1."-0-0-".$padm4; }
	if ($padm2=='E' && $padm3=='M') { $priv_maquinas="0-".$padm2."-".$padm3."-0"; }
	if ($padm2=='E' && $padm4=='I') { $priv_maquinas="0-".$padm2."-0-".$padm4; }
	if ($padm3=='M' && $padm4=='I') { $priv_maquinas="0-0-".$padm3."-".$padm4; }
	if ($padm1=='A' && $padm2=='E' && $padm3=='M') { $priv_maquinas=$padm1."-".$padm2."-".$padm3."-0"; }
	if ($padm1=='A' && $padm2=='E' && $padm4=='I') { $priv_maquinas=$padm1."-".$padm2."-0-".$padm4; }			
	if ($padm1=='A' && $padm3=='M' && $padm4=='I') { $priv_maquinas=$padm1."-0-".$padm3."-".$padm4; }
	if ($padm2=='E' && $padm3=='M' && $padm4=='I') { $priv_maquinas="0-".$padm2."-".$padm3."-".$padm4; }
	if ($padm1=='A' && $padm2=='E' && $padm3=='M' && $padm4=='I') { $priv_maquinas=$padm1."-".$padm2."-".$padm3."-".$padm4; }
	if ($padm1=='' && $padm2=='' && $padm3=='' && $padm4=='') { $priv_maquinas=0; }

	#		.........ACTIVIDADES..........

	if ($pada1=='A') { $priv_actividades=$pada1."-0-0-0"; }
	if ($pada2=='E') { $priv_actividades="0-".$pada2."-0-0"; }
	if ($pada3=='M') { $priv_actividades="0-0-".$pada3."-0"; }
	if ($pada4=='I') { $priv_actividades="0-0-0-".$pada4; }
	if ($pada1=='A' && $pada2=='E') { $priv_actividades=$pada1."-".$pada2."-0-0"; }
	if ($pada1=='A' && $pada3=='M') { $priv_actividades=$pada1."-0-".$pada3."-0"; }
	if ($pada1=='A' && $pada4=='I') { $priv_actividades=$pada1."-0-0-".$pada4; }
	if ($pada2=='E' && $pada3=='M') { $priv_actividades="0-".$pada2."-".$pada3."-0"; }
	if ($pada2=='E' && $pada4=='I') { $priv_actividades="0-".$pada2."-0-".$pada4; }
	if ($pada3=='M' && $pada4=='I') { $priv_actividades="0-0-".$pada3."-".$pada4; }
	if ($pada1=='A' && $pada2=='E' && $pada3=='M') { $priv_actividades=$pada1."-".$pada2."-".$pada3."-0"; }
	if ($pada1=='A' && $pada2=='E' && $pada4=='I') { $priv_actividades=$pada1."-".$pada2."-0-".$pada4; }			
	if ($pada1=='A' && $pada3=='M' && $pada4=='I') { $priv_actividades=$pada1."-0-".$pada3."-".$pada4; }
	if ($pada2=='E' && $pada3=='M' && $pada4=='I') { $priv_actividades="0-".$pada2."-".$pada3."-".$pada4; }
	if ($pada1=='A' && $pada2=='E' && $pada3=='M' && $pada4=='I') { $priv_actividades=$pada1."-".$pada2."-".$pada3."-".$pada4; }
	if ($pada1=='' && $pada2=='' && $pada3=='' && $pada4=='') { $priv_actividades=0; }

	#		..........PERSONAL.........

	if ($padp1=='A') { $priv_personal=$padp1."-0-0-0"; }
	if ($padp2=='E') { $priv_personal="0-".$padp2."-0-0"; }
	if ($padp3=='M') { $priv_personal="0-0-".$padp3."-0"; }
	if ($padp4=='I') { $priv_personal="0-0-0-".$padp4; }
	if ($padp1=='A' && $padp2=='E') { $priv_personal=$padp1."-".$padp2."-0-0"; }
	if ($padp1=='A' && $padp3=='M') { $priv_personal=$padp1."-0-".$padp3."-0"; }
	if ($padp1=='A' && $padp4=='I') { $priv_personal=$padp1."-0-0-".$padp4; }
	if ($padp2=='E' && $padp3=='M') { $priv_personal="0-".$padp2."-".$padp3."-0"; }
	if ($padp2=='E' && $padp4=='I') { $priv_personal="0-".$padp2."-0-".$padp4; }
	if ($padp3=='M' && $padp4=='I') { $priv_personal="0-0-".$padp3."-".$padp4; }
	if ($padp1=='A' && $padp2=='E' && $padp3=='M') { $priv_personal=$padp1."-".$padp2."-".$padp3."-0"; }
	if ($padp1=='A' && $padp2=='E' && $padp4=='I') { $priv_personal=$padp1."-".$padp2."-0-".$padp4; }			
	if ($padp1=='A' && $padp3=='M' && $padp4=='I') { $priv_personal=$padp1."-0-".$padp3."-".$padp4; }
	if ($padp2=='E' && $padp3=='M' && $padp4=='I') { $priv_personal="0-".$padp2."-".$padp3."-".$padp4; }
	if ($padp1=='A' && $padp2=='E' && $padp3=='M' && $padp4=='I') { $priv_personal=$padp1."-".$padp2."-".$padp3."-".$padp4; }
	if ($padp1=='' && $padp2=='' && $padp3=='' && $padp4=='') { $priv_personal=0; }


	$sql="INSERT INTO tipo_usuario (tipo, priv_horarios, priv_proyectos, priv_convenios, priv_inventario
		, priv_maquinas, priv_actividades, priv_personal, priv_usuarios, priv_bd, priv_auditoria, estatus, visible, area)
		VALUES ( '$nombre_tipo', '$priv_horarios', '$priv_proyectos', '$priv_convenios', '$priv_inventario', '$priv_maquinas'
		, '$priv_actividades', '$priv_personal', '$priv_usuarios', '$BD', '$auditoria', 1, 1, 'Robotica')";

	#echo $sql;

	pg_query($sql);

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Registro','Tipo de Usuarios','".$_SESSION['nom_usuario']."')");

	header("Location:tipo_usuario.php?registro=tipo_usuario");
?>