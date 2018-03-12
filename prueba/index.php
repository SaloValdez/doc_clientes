<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PROBANDO</title>
  </head>
  <body>
    <form id="login-asistencia">
      <input type="text" name="usuario" value="" placeholder="Usuario"><br>
      <input type="text" name="contrasena" value="" placeholder="Contraseña">
      <input type="submit" name="" value="iniciar" id="btnMarcar">
    </form>
  </body>
</html>


<script type="text/javascript">
$(document).ready(function(){
  // $('#contenedor_sesion').load('./procesos/tablaEstado.php');
  marcarAsistencia();
  // insertar ();
  // actualizar();
});

function marcarAsistencia(){
  // alertify.confirm('Eliminar un juego', '¿Seguro de eliminar este juego pro :(?', function(){
    $('#btnMarcar').click(function(){
          datos=$('#login-asistencia').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"marcarAsistencia.php",
          success:function(r){
            if(r==1){
              $('#tablaDatatable').load('tabla.php');
              alertify.success("Ingreso sesion con exito !");
            }else{
              alertify.error("No se pudo  iniciar sesion...");
            }
          }
        });
      }
      , function(){

      });
  });
}
</script>
