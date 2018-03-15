<?php

	// class crud{
	//
	// 	public function mostrarSesion(){
	// 		$obj= new conectar();
	// 		$conexion=$obj->conexion();
	// 		$sql="SELECT * FROM  estado";
	//
	// 		$resultado = mysqli_query($conexion,$sql) or die ("Error al obtener los registros");
	// 		return $resultado;
	// 	}
	//
	// 	public function marcarAsistencia($usuario,$contrasena){
	// 		$obj= new conectar();
	// 		$conexion=$obj->conexion();
	//
	// 		$sql="SELECT * FROM  login WHERE
	// 															usuario_login ='$usuario'
	// 															AND
	// 															contrasena-login = '$contrasena'";
	//
	// 		$resultado = mysqli_query($conexion,$sql) or die ("Error al obtener los registros");
	// 		$res = mysql_fetch_assoc($resultado);
	// 		if ($res > 0) {
	//
	// 		}
	//
	//
	//
	// 		return $resultado;
	// 	}
	//
	// 	private function insertarSecion($descripcion,$descripcion,$descripcion){
	// 		$obj= new conectar();
	// 		$conexion=$obj->conexion();
	//
	// 		$insertarSesion = "INSERT INTO estado (descripcion_estado,horaent_estado,grupo_estado) values('$descripcion','$descripcion','$descripcion')";
	// 	}
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	// 	public function agregar($datos){
	// 		$obj= new conectar();
	// 		$conexion=$obj->conexion();
	//
	// 		$sql="INSERT into alumno (nombre_alumno,apellido_alumno,dni_alumno)
	// 								values ('$datos[0]',
	// 										'$datos[1]',
	// 										'$datos[2]')";
	// 		return mysqli_query($conexion,$sql);
	// 	}
	//
	// 	// public function listarSesion(){
	// 	// 	$obj= new conectar();
	// 	// 	$conexion=$obj->conexion();
	// 	//
	// 	// 	$sql="SELECT * FROM  estado";
	// 	//
	// 	// 	$result=mysqli_query($conexion,$sql);
	// 	//
	// 	// 	// $datos=array(
	// 	// 	// 	'id_alumno' => $ver[0],
	// 	// 	// 	'nombre_alumno' => $ver[1],
	// 	// 	// 	'apellido_alumno' => $ver[2],
	// 	// 	// 	'dni_alumno' => $ver[3]
	// 	// 	// 	);
	// 	// 	return $result;
	// 	// }
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
	//
		public function obtenDatos($idAlumno){
			$obj= new conectar();
			$conexion=$obj->conexion();

			$sql="SELECT id_alumno,
							nombre_alumno,
							apellido_alumno,
							dni_alumno
					from alumno
					where id_alumno='$idAlumno'";
			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
				'id_alumno' => $ver[0],
				'nombre_alumno' => $ver[1],
				'apellido_alumno' => $ver[2],
				'dni_alumno' => $ver[3]
				);
			return $datos;
		}
	//
		// public function actualizar($datos){
		// 	$obj= new conectar();
		// 	$conexion=$obj->conexion();
    //
		// 	$sql="UPDATE alumno set nombre_alumno='$datos[0]',
		// 								apellido_alumno='$datos[1]',
		// 								dni_alumno='$datos[2]'
		// 				where id_alumno='$datos[3]'";
		// 	return mysqli_query($conexion,$sql);
		// }
	// 	public function eliminar($idAlumno){
	// 		$obj= new conectar();
	// 		$conexion=$obj->conexion();
	//
	// 		$sql="DELETE from alumno where id_Alumno='$idAlumno'";
	// 		return mysqli_query($conexion,$sql);
	// 	}
	// }

 ?>
