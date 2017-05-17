<html lang="es">
<head>
<meta charset="utf-8">
	<title>SYS-M&R</title>
<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
</head>
<body></body>
</html>
<?php
	require('conexion.php');

	function getRandomCode ()
	{
		$cadena="0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
	    
	    $longitud=strlen($cadena)-1;
	    
	    return  substr($cadena, rand(0, $longitud), 1).
	    		substr($cadena, rand(0, $longitud), 1).
	    		substr($cadena, rand(0, $longitud), 1).
	    		substr($cadena, rand(0, $longitud), 1).
	    		substr($cadena, rand(0, $longitud), 1).
	    		substr($cadena, rand(0, $longitud), 1);
	}

	$pass=getRandomCode();

	$buscar=$_POST['buscar'];
	$Email=$_POST['correo'];
	$pagina=$_POST['pagina'];
	$respuesta=trim($_POST['respuesta']);

	$query=pg_query("SELECT * FROM usuario u, personal p WHERE u.id_personal=p.id AND u.estatus=1 AND p.estatus=1
		AND u.taller='$pagina' AND p.correo='$Email'");
	$array=pg_fetch_assoc($query);

	if ($array['respuesta']==$respuesta)
	{
		$Correcta='si';

		if ($buscar=='contrasena')
		{
			$asunto='Contraseña';
			$envio="Contraseña: ".$pass;

			#echo $pass."<br>";

			$passEncrypted=hash("ripemd160", md5($pass));

			pg_query("UPDATE usuario SET contrasena='$passEncrypted' WHERE id_usu='".$array['id_usu']."'");
		}
		if ($buscar=='usuario')
		{
			$asunto='Usuario';
			$envio="Usuario: ".$array['nom_usuario'];
		}
		if ($buscar=='ambas')
		{
			$asunto="Usuario y Contraseña";
			$envio="Contraseña: ".$pass." <br>Usuario: ".$array['nom_usuario'];

			#echo $pass."<br>";

			$passEncrypted=hash("ripemd160", md5($pass));

			pg_query("UPDATE usuario SET contrasena='$passEncrypted' WHERE id_usu='".$array['id_usu']."'");
		}
		
		if ($array['bloqueo']=='1')
		{
			$bloqueada='si';
		}

		$nom=explode(' ', $array['nombres']);
		$ape=explode(' ', $array['apellidos']);

		$mensaje="<h1> Esto no es un Correo Basura</h1>
		<h2>Hola ".$nom[0].".</h2>
		<br><br>Has solicitado tus datos olvidados del SYS-M&R de la UPT-Aragua, Aquí se encuentran:
		<br><br>".$envio."
		<br><br>GRACIAS POR USAR NUESTRO SISTEMA.
		<br><br>Enlace al SYS-M&R: <a>http://sysmr.upta.edu.ve/</a>.
		<br><br>Webmasters: TSU Sergei Terán, TSU Nelson Soto y TSU Vicente Cifuentes.";

###################################################CORREO##################################################
	//Incluimos la clase de PHPMailer
	require "phpmailer/class.phpmailer.php";
	require "phpmailer/class.smtp.php";

 
	$mail = new PHPMailer(); # SE CREA UNA INSTANCIA	
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->SMTPDebug  = 0;
	$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
	$mail->Port = 587;
	//$mail->Timeout=30;
	//Nuestra cuenta
	$mail->Username ='noreply@upta.edu.ve';
	$mail->Password = 'FGaNapHavpmb38d9'; //Su password
	$mail->Host = "correo.upta.edu.ve"; # NOMBRE O DIRECCION DEL HOSTING
	$mail->From = "noreply@upta.edu.ve"; # EMAIL DEL QUE SE ENVIARA EL CORREO
	$mail->FromName = "SYS-M&R"; # NOMBRE DEL CORREO
	$mail->Subject = "Recuperación de ".$asunto; #ASUNTO
	$mail->addAddress($Email, $nom[0]." ".$ape[0]); #CORREO AL CUAL ENVIAR, NOMBRE DEL SUJETO
	$mail->IsHTML(true); # Activar HTML
	$mail->MsgHTML($mensaje); # MENSAJE  ó Alternativa: $mail->Body = $mensaje

	$mail->CharSet = 'UTF-8'; # Activar UTF-8

	if ($mail->Send())
	{
		$enviado=true;
		#echo "MENSAJE ENVIADO";
	}
	else
	{
		$enviado=false;
		#echo "MENSAJE NO ENVIADO ".$mail->ErrorInfo;
	}
###############################################FIN#DE#CORREO###############################################
	
	}
	else
	{

		if($_REQUEST['intento']==0)
		{
			$intento=2;
		}

		if($_REQUEST['intento']==2)
		{
			$intento=3;
		}
		
		if ($_REQUEST['intento']==3)
		{
			$query=pg_query("SELECT * FROM usuario u, personal p WHERE u.id_personal=p.id AND u.taller='$pagina' AND p.correo='$Email'");
			$array=pg_fetch_assoc($query);

			pg_query("UPDATE usuario SET bloqueo=1 WHERE id_personal='".$array['id']."' AND estatus=1");

			$bloqueada='si';
		}

	}

####################################################################################

if ($Correcta=='si' && $bloqueada=='si')
{
?>
	<script type="text/javascript">
		
		//alert("cuenta bloqueada");

		swal({
			title:"¡Su Cuenta a sido Bloqueada!",
			text:"Contacte al Administrador del Sistema",
			type:"warning",
			timer:4000,
			showConfirmButton: false
		},
		function(){
			window.location.href="index.php";
		}
		);
	</script>
<?php
}

if ($Correcta=='si' && $bloqueada!='si')
{
	if ($enviado==true)
	{
?>
	<script type="text/javascript">
		//alert("Respuesta Correcta");
		swal({
			title:"Sus datos han sido enviados a su Correo Electrónico!",
			text:"",
			type:"success",
			timer:4000,
			showConfirmButton: false
			},
			
			function()
			{
				window.location.href="index.php";
			}
	);
	</script>
<?php
	}
	else
	{
?>
	<script type="text/javascript">
	//alert("Respuesta Correcta");
	swal({
		title:"No se pudo enviar el Correo Electrónico!",
		text:"",
		type:"error",
		timer:4000,
		showConfirmButton: false
		},
		
		function()
		{
			window.location.href="index.php";
		}
	);
	</script>
<?php
	}
}

if ($Correcta!='si' && $bloqueada!='si')
{
?>	
	<script type="text/javascript">
	//alert("Respuesta Incorrecta");
	swal({
			title:"La Respuesta es Incorrecta",
			text:"",
			type:"warning",
			timer:4000,
			showConfirmButton: false
		},
		
		function()
		{
			window.location.href="buscarCuentaMec.php?correo=<?php echo $Email; ?>&buscar=<?php echo $buscar; ?>&intento=<?php echo $intento; ?>&pagina=<?php echo $pagina; ?>";
		}
	);
	</script> 
<?php
}

if ($Correcta!='si' && $bloqueada=='si')
{
?>
	<script type="text/javascript">
		
		//alert("cuenta bloqueada");

		swal({
			title:"¡Su Cuenta a sido Bloqueada!",
			text:"Contacte al Administrador del Sistema",
			type:"warning",
			timer:4000,
			showConfirmButton: false
		},
		function(){
			window.location.href="index.php";
		}
		);
	</script>
<?php
}
?>
