<?php
	require_once "./../../clases/conexion.php";
	require_once "./../../clases/crud.php";
	$obj= new crud();

	$datos=array(
		$_POST['nombreAlumno'],
		$_POST['apellidoAlumno'],
		$_POST['dniAlumno'],
		$_POST['idAlumno']
				);

	echo $obj->actualizar($datos);


 ?>
