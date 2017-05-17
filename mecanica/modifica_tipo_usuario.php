<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id'];
	$nombre_tipo=ucfirst(trim($_POST['nombre_tipoM']));

#                                .....PRIVLEGIOS DE USUARIO.....

	#			............................ACADEMICOS.................................
	
	#  ...HORARIOS...			  ...PROYECTOS...			  ...CONVENIOS...
	$pach1=$_POST['pach1M'];		$pacp1=$_POST['pacp1M'];		$paconv1=$_POST['paconv1M'];
	$pach2=$_POST['pach2M'];		$pacp2=$_POST['pacp2M'];		$paconv2=$_POST['paconv2M'];
	$pach3=$_POST['pach3M'];		$pacp3=$_POST['pacp3M'];		$paconv3=$_POST['paconv3M'];
	$pach4=$_POST['pach4M'];		$pacp4=$_POST['pacp4M'];		$paconv4=$_POST['paconv4M'];
	
	#		    ............................ADMINISTRATIVOS............................

	#  ...INVENTARIO...			    ...MAQUINAS...			  ...ACTIVIDADES...			    ...PERSONAL...
	$padi1=$_POST['padi1M'];		$padm1=$_POST['padm1M'];		$pada1=$_POST['pada1M'];		$padp1=$_POST['padp1M'];
	$padi2=$_POST['padi2M'];		$padm2=$_POST['padm2M'];		$pada2=$_POST['pada2M'];		$padp2=$_POST['padp2M'];
	$padi3=$_POST['padi3M'];		$padm3=$_POST['padm3M'];		$pada3=$_POST['pada3M'];		$padp3=$_POST['padp3M'];
	$padi4=$_POST['padi4M'];		$padm4=$_POST['padm4M'];		$pada4=$_POST['pada4M'];		$padp4=$_POST['padp4M'];
	$padi5=$_POST['padi5M'];
	#			...........................CONFIGURACION...............................

	#	...USUARIOS...			    ...BD...				...AUDITORIA...
	$priv_usuarios=$_POST['pconuM'];	$BD=$_POST['BDM'];	$auditoria=$_POST['auditoriaM'];

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

	$sql="UPDATE tipo_usuario SET tipo='$nombre_tipo', priv_horarios='$priv_horarios', priv_proyectos='$priv_proyectos'
		, priv_convenios='$priv_convenios', priv_inventario='$priv_inventario', priv_maquinas='$priv_maquinas'
		, priv_actividades='$priv_actividades', priv_personal='$priv_personal', priv_usuarios='$priv_usuarios'
		, priv_bd='$BD', priv_auditoria='$auditoria', estatus=1, visible=1, area='Mecanica' WHERE id_tipo='$id'";

	#echo $sql;

	pg_query($sql);

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
		VALUES('$hoy','Modificación','Tipo de Usuario','".$_SESSION['nom_usuario']."',1)");

	header("Location:tipo_usuario.php?modificar=tipo_usuario");

?>