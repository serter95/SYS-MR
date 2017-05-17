<?php

function verificar_usuario(){
	//continuar una sesion iniciada
	@session_start();
	//comprobar la existencia del usuario
	//cambialo segun tu nombre de usuario en la bd
	if ($_SESSION['nom_usuario']){
		return true;
	}
}
?>
