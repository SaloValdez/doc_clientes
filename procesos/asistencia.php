<?php
	require_once "../clases/conexion.php";
	require_once "./../clases/clase.php";
	$obj= new ejemplo();

	// $datos=array(
  // $usuario = $_POST['usuario'];
  // $contrasena = $_POST['contrasena'];
	// 	);

  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  // $usuario="ADMIN";
  // $contrasena="ADMIN";
	echo $obj->marcarAsistencia($usuario,$contrasena);

  // $ejemplo = new ejemplo();
  // $var =  $ejemplo-> marcarAsistencia('ADMIN','ADMIN');
  // echo "REsultado :  ". $var;
 ?>
