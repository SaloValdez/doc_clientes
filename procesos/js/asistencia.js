$(document).ready(function(){
   $('#contenedor_sesion').load('./procesos/sesiones_activos.php');
  // marcarAsistencia();
  // insertar ();
  verificar();
});

function verificar(){
  $('#btnAsistencia').click(function()
  {
  	datos=$('#login-asistencia').serialize();
  	$.ajax({
  		type:"POST",
  		data:datos,
  		url:"./procesos/asistencia.php",
  	}).done(
            function(resp)
            {
              if (resp ==1) {
                alert("cONTRASEÑA INCORRECTA");
              }else if (resp ==2) {
                  alert("NO PUEDE SALIR ANTES");
              }else {
                // alert("comuniquese con el administrador");
                alert(resp);
              }
            }
          )
  });
}


function agregaFrmActualizar(idAlumno){
	$.ajax({
		type:"POST",
		data:"id=" + idAlumno,
		url:"./procesos/docente/obtenDatos.php",
		success:function(r){
			datos=jQuery.parseJSON(r);
			$('#idjuego').val(datos['id_alumno']);
			$('#nombreU').val(datos['nombre_alumno']);
			$('#anioU').val(datos['apellido_alumno']);
			$('#empresaU').val(datos['dni_alumno']);
		}
	});
}




function abrirVentana(){
  $(".ventana_error").slideDown("slow");
}
function cerrarVentana(){
  $(".ventana_error").slideUp("fast");
}
