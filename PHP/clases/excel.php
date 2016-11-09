
<?php
//require ("fpdf181/fpdf.php");
require ("informe.php");
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=export_excel.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Excel de Informes</title>
</head>
<body>
<table id="tabla1" width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr><td colspan="6" bgcolor="skyblue" align="center"> INFORMES</td>
	</tr>
	<tr bgcolor="lime">
	<td><strong>nombre</strong></td>
	<td><strong>localidad</strong></td>
	<td><strong>direccion<strong></td>
	<td><strong>empleado</strong></td>
	<td><strong>porcentaje</strong></td>
	<td><strong>fecha</strong></td>
	<tr>
<?php

$data=informe::TraerTodosLosInformes();

try {
	foreach ($data as $row) 
	{
		$nombre=$row->nombre;
		$localidad=$row->localidad;
		$direccion=$row->direccion;
		$empleado=$row->empleado;
		$porcentaje=$row->porcentaje;
		$fecha=$row->fecha;
?>
		<td><?php echo $nombre; ?></td>
		<td><?php echo $localidad; ?></td>
		<td><?php echo $direccion; ?></td>
		<td><?php echo $empleado; ?></td>
		<td><?php echo $porcentaje; ?></td>
		<td><?php echo $fecha; ?></td>
	</tr>
<?php } } catch (Exception $e) {} ?>
</table>
<form id="form1" name="form1" method="post"action="exportaror_excel.php" >
		<input type="submit" value="Exportar a Excel"/>
	</form>
</body>
</html>




