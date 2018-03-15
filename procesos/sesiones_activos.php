<?php
require_once "./../clases/conexion.php";
require_once "./../clases/clase.php";


$obj = new ejemplo();
$mostrarSesiones =  $obj->mostrarSesion();
// var_dump ($mostrarSesiones);
$obj2 = new ejemplo();
?>

<?php
  while ($actual =mysqli_fetch_assoc($mostrarSesiones)) {
   ?>

   <article class="cont-asis">
       <h1><?php echo ' '.$actual['nombres'] ?></h1>
       <h5>DNI:<?php echo ' '.$actual['dni'] ?></h5>
       <p>HORARIO ENTRADA: <span><?php echo $actual['entrada_grupo'] ?></span></p>
       <p>HORARIO SALIDA: <span><?php echo $actual['salida_grupo'] ?></span></p>
       <p>AREA : <span><?php echo $actual['area'] ?></span></p>
       <p>CARGO: <span><?php echo $actual['cargo'] ?></span></p>
       <p>HORA ENTRADA SESION : <span><?php echo $actual['hora_entrada_estado'] ?></span></p>
        <?php $mostrarFrecuancia =  $obj2->mostrarfrecuencia($actual['idgrupo']);
        while ($dia=mysqli_fetch_assoc($mostrarFrecuancia)) {
           echo $dia['dia'];
           echo "-";
        }
        ?>
     </article>
       <?php
  }
 ?>
