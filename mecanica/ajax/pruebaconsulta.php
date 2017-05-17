
<?php

	include("connect.php");

if(empty($_GET['pag']))
	{
		$pag=1;
	}
else
	{
		$pag = $_GET['pag'];}
		$sql="select * from usuarios where estatus=0 ORDER BY username ASC";
		$cursor=mysql_query($sql);
		$num=mysql_num_rows($cursor);
		$pag = (int)$pag;

if(!$num){
?>

<script language="javascript">
alert("No hay registro");
location .href="consultaindex.php";
</script>

<?php } 

else { ?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/Nuevo2.css"></link>
			<title>S+E-M*</title>
			     <link href="js/jquery.dataTables.min.css" rel="stylesheet">
			       <link href="js/dataTables.min.css" rel="stylesheet">
	</head>
<body>
	<wrapper>
		<section id="center" >
	<aside>

<br><br><a href="estudiante.php"><img align="left" height="40px" src="img/cuadro5.png"></img></a> </br>
<br></br><a href="profesor.php"><img align="left" height="40px" src="img/cuadro6.png"></img></a> </br>
</br><br><a href="index_.php"><img align="left" height="40px" src="img/cuadro7.png"></img></a>

	</aside>

		<article  id="recuadro6">
<center>
	<h1 style="font-size:20px">Consulta de los Usuarios</h1>
</br>


<form action="consulta_usu.php" method="get">

	<input name="username" type="text" placeholder="Nombre de usuario" required>
	<input type="image" src="img/icono-busqueda.png" width="25px" heigth="25x" value="Buscar">

</form>		 	 
		</br>
<table width="700px" bgcolor="black" border="1px" id="dataTables-example">
	<thead>
<tr>
 
	<th bgcolor="white" align="center">Usuario</th>

	<th bgcolor="white" align="center">Nombre</th>

	<th bgcolor="white" align="center">Apellido</th>

	<th bgcolor="white" align="center">Edad</th>

	<th bgcolor="white" align="center">Nivel</th>

	<th bgcolor="white" align="center">Acciones</th>
</tr>
</thead>

<?php 


	
	$cursor= mysql_query($sql);
	
while($datos=mysql_fetch_array($cursor)){
?>
<tr>

	 <td bgcolor="white" align="center" > <?php echo $datos['username'] ?></td>

	<td bgcolor="white" align="center" > <?php echo $datos['nombre'] ?> </td>

 	<td bgcolor="white" align="center" > <?php echo $datos['apellido'] ?> </td>

	<td bgcolor="white" align="center"> <?php echo $datos['edad'] ?> </td>

	<td bgcolor="white" align="center"> <?php echo $datos['nivel'] ?></td>

	<td bgcolor="white" align="center" > 

<a href="eliminar_es.php?id=<?php echo $datos['id']?>&username=<?php echo $datos['username']?>"><img title="Eliminar" height="20px" width="20px" src="img/borrar.png"></img></a>
<a href="regi_pre.php?id=<?php echo $datos['id']?>"><img title="Editar" height="20px" width="20px" src="img/editar.png"></img></a>

	</td>
</tr>


		
		<?php
	}}
?>
	</td>
</tr>
</table>
</center>
</article>

</section>

<footer>
	<Address>
  		<center> <h5><br></h5></center>
	</Address>
</footer>

 <script src="js/jquery.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
<script>
     $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
	</wrapper>
</body>
</html>
