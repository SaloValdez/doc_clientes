$(document).ready(function(){
  // $('#contenedor_sesion').load('./procesos/tablaEstado.php');
  // marcarAsistencia();
  // insertar ();
  verificar();
});


function verificar(){
  $('#btnAsistencia').click(function(){
  	datos=$('#login-asistencia').serialize();
  	$.ajax({
  		type:"POST",
  		data:datos,
  		url:"./procesos/asistencia.php",
  		success:function(r){
  			if(r==1){
  				// $('#tablaDatatable').load('tabla.php');
  				alertify.success("Actualizado con exito :D");
  			}else{
  				alertify.error("Fallo al actualizar :(");
  			}
  		}
  	});
  });
}
