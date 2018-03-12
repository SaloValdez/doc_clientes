
<?php

require_once "clases/conexion_sis.php";
$obj= new conectar_sis();
$conexion=$obj->conexion();

$sql="SELECT id_curso,nombre_curso
from curso";
$result=mysqli_query($conexion,$sql);
?>
<div class="contedor-tabla">
	<table class="table table-hover table-condensed table-bordered" id="iddatatable">
		<thead>
			<tr>
				<td>Nombre Curso</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>
		</thead>
		<tbody >
			<?php
			while ($mostrar=mysqli_fetch_row($result)) {
				?>
				<tr >
					<td><?php echo $mostrar[1] ?></td>
					<td>
						<span class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="agregaFrmActualizarCurso('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-pencil-square-o"></span>
						</span>
					</td>
					<td>
						<span class="btn btn-danger btn-sm" onclick="eliminarDatosCurso('<?php echo $mostrar[0] ?>')">
							<span class="fa fa-trash"></span>
						</span>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript" src="./res/js/formato-datatable.js"></script>
