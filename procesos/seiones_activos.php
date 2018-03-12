<?php
require_once "./../clases/conexion.php";
require_once "./../clases/crud.php";

$obj= new ejemplo();

// echo json_encode($obj->obtenDatos($_POST['id']));

$resultado = $obj->mostrarSesion();

$mostrar ='';
while ($actual = mysqli_fetch_row($resultado)) {
 ?>
   <article class="sesion" id="hola">
 <h1>NOMBRE <?php echo ' '.$actual[0] ?></h1>
 <p>Area: <span><?php echo $actual[1] ?></span></p>
  <p>Grupo: <span><?php echo $actual[2] ?></span></p>
  <p>Horario: <span><?php echo $actual[3] ?></span></p>
 <P>Curso:<span class="hora-entrada">sasasa</span> </P>
 </article> -->
   <?php
}


 ?>
