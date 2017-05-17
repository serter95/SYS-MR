<?php 

//Inicio la sesión 
session_start(); 
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["g1tr2sv"] != "SI") // autentificado es distinto de SI
{
	session_unset();
	session_destroy();
?>   	<!--si no existe, envio a la página de autentificacion--> 
<script type="text/javascript">
//alert("Usted no posee los permisos necesarios contacte al administrador del sistema")
window.location.href="../salir.php";
</script> 
<?php   	//ademas salgo de este script 
//   	exit();
}

if ($_SESSION["area"] != "Mecanica") // area == SI
{
	session_unset();
	session_destroy();
?>   	<!--si no existe, envio a la página de autentificacion--> 
<script type="text/javascript">
//alert("Usted no posee los permisos necesarios contacte al administrador del sistema")
window.location.href="../salir.php";
</script> 
<?php   	//ademas salgo de este script 
//   	exit();
}

?>