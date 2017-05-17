<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	# Obtenemos los datos del usuario

	$valores=pg_query("SELECT * FROM insumos i, numero_bien n WHERE i.estatus='1' AND i.id_insumos='".$id."' AND i.n_b=n.id_nb");
	$valores2=pg_fetch_assoc($valores);
	$importe=explode(' ', $valores2['importe']);
                            $valor=$importe[0];
                            $bs=$importe[1];

    $precio=explode(' ', $valores2['precio_unitario']);
                            $valor2=$precio[0];
                            $bs2=$precio[1];
    
	 $nbx=explode('-', $valores2['nb']);
    						if($nbx[0]=="NB"){
                            $nb=$nbx[0]."-";
                            }
                            else{
                            $nb=$nbx[0];
                            }
                            $nbnum=$nbx[1];
                            
	$datos = array(
		0 => $valores2['id_insumos'],
		1 => $valores2['codigo_insumo'],
		2 => $nbnum,
		3 => $valores2['nombre'],
		4 => $valores2['tipo_medida'],
		5 => $valores2['medida'],
		6 => $valor2,
		7 => $valores2['existencia'],
		8 => $valores2['buenas'],
		9 => $valores2['danadas'],
		10 => $valores2['min_stock'],
		11 => $valores2['recambio'],
		12 => $valores2['ubicacion'],
		13 => $valor,
		14 => $valores2['id_nb'],
		15 => $valores2['max_stock'],
		16 => $nb,
    		 );
	echo json_encode($datos);

?>