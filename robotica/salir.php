<!-- de aqui no tocar nada-->
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/sweetalert.css"/>
<script type="text/javascript" src="../js/sweetalert.min.js"></script>
</head>
<body></body>
</html>
<?php
session_start();

require("verificar_usuario.php");

if (verificar_usuario()){
	//si el usuario es verificado, se destruye la sesion y volvemos al formulario de ingreso

	session_unset();
	session_destroy();
?>

<script type="text/javascript">
//alert("Sesion finalizada")
swal({
			title:"Sesion finalizada con exito!",
			text:"",
			type:"success",
			timer:1500,
			showConfirmButton: false
		},
function(){
	window.location.href="../index.php";
}
		);
//location.href="../index.php";
</script>
<?php
} else {
	//si el usuario no es verificado vuelve al formulario de ingreso
	header ('Location:../index.php');
}
?>
