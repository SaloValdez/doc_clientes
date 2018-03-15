<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>cliente</title>

  <link rel="stylesheet" href="./estilos.css">

  <script type="text/javascript" src="./jquery/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="./sweetAlert2.js">

  </script>

    <script type="text/javascript" src="./procesos/js/asistencia.js"></script>

    <script type="text/javascript">
      // function abrirVentana(){
      //   $(".ventana_error").slideDown("slow");
      // }
      // function cerrarVentana(){
      //   $(".ventana_error").slideUp("fast");
      // }

      $(document).ready(function(){
          $("#alert").click(function(){
             swal2("Hola");
          });
      });
    </script>





</head>
<body>
  <input type="button" name="" value="PROBAR" id="alert">
  <div class="ventana_error">


    <div class="ventana_contenido">
      <div class="cerrar"> <a href="javascript:cerrarVentana();">Cerrar X </a></div>
      <h3>Ventana Error</h3>
            <span class="texto"></span>
    </div>
  </div>

<h2><a href="javascript:abrirVentana();">Abrir</a></h2>

  <div class="contenedor">
<!-- FORMULARIO -->
  <div class="contenedor_form">
    <div class="formulario">
      <form action="" id="login-asistencia">
        <input type="text" name="usuario" placeholder="usuario"><br>
        <input type="text" name="contrasena" placeholder="contraseña"><br>
        <input type="submit" name="" value="marcar" id="btnAsistencia">
      </form>
    </div>
  </div>
<!-- FIN FORMULARIO -->

<div class="contenedor_sesion" id="contenedor_sesion">

  <?php
  // include("./clases/conexion.php" ) ;
  // include( "./clases/clase.php" ) ;
  //   include("./procesos/seiones_activos.php");
   ?>



</div>

</div>


</body>
</html>
