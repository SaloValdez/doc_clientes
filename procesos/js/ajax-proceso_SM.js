// $(document).ready(function(){
//   $('#contenedor_sesion').load('./procesos/tablaEstado.php');
//   marcarAsistencia();
//   // insertar ();
//   // actualizar();
// });
//
// function marcarAsistencia(){
// 	// alertify.confirm('Eliminar un juego', '¿Seguro de eliminar este juego pro :(?', function(){
//     $('#btnAsistencia').click(function(){
//           datos=$('#login-asistencia').serialize();
//     		$.ajax({
//     			type:"POST",
//     			data:datos,
//     			url:"./procesos/marcarAsistencia.php",
//     			success:function(r){
//     				if(r==1){
//     					$('#tablaDatatable').load('tabla.php');
//     					alertify.success("Ingreso sesion con exito !");
//     				}else{
//     					alertify.error("No se pudo  iniciar sesion...");
//     				}
//     			}
//     		});
//     	}
//     	, function(){
//
//     	});
//   });
// }
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
// function insertar (){
//   $('#btnAgregarnuevo').click(function(){
//     datos=$('#frmnuevo').serialize();
//
//     $.ajax({
//       type:"POST",
//       data:datos,
//       url:"./procesos/docente/agregar.php",
//       success:function(r){
//         if(r==1){
//           $('#frmnuevo')[0].reset();
//           $('#tablaDatatable').load('tabla.php');
//           alertify.success("agregado con exito :D");
//         }else{
//           alertify.error("Fallo al agregar :(");
//         }
//       }
//     });
//   });
// }
//
// function actualizar(){
//   $('#btnActualizar').click(function(){
//   	datos=$('#frmnuevoU').serialize();
//
//   	$.ajax({
//   		type:"POST",
//   		data:datos,
//   		url:"./procesos/docente/actualizar.php",
//   		success:function(r){
//   			if(r==1){
//   				$('#tablaDatatable').load('tabla.php');
//   				alertify.success("Actualizado con exito :D");
//   			}else{
//   				alertify.error("Fallo al actualizar :(");
//   			}
//   		}
//   	});
//   });
// }
//
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
//
// function eliminarDatos(idAlumno){
// 	alertify.confirm('Eliminar un juego', '¿Seguro de eliminar este juego pro :(?', function(){
//
// 		$.ajax({
// 			type:"POST",
// 			data:"id=" + idAlumno,
// 			url:"./procesos/docente/eliminar.php",
// 			success:function(r){
// 				if(r==1){
// 					$('#tablaDatatable').load('tabla.php');
// 					alertify.success("Eliminado con exito !");
// 				}else{
// 					alertify.error("No se pudo eliminar...");
// 				}
// 			}
// 		});
//
// 	}
// 	, function(){
//
// 	});
// }
