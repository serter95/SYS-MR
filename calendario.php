<html>
<head>
<meta charset="utf-8" />
<title>jQuery UI Datepicker - Uso básico</title>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker-es.js"></script>

<script type="text/javascript">
$(function () {

	$.datepicker.setDefaults($.datepicker.regional['es']);

	$("#datepicker").datepicker({
	firstDay: 1,
	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
 	'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá']
	});

});
</script>
</head>

<body background="blue">
Fecha:
<div id="datepicker"></div>
</body>
</html> 