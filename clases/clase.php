<?php
require_once "../clases/conexion.php";
class ejemplo  {
      private function conectar(){
        $obj= new conectar();
        $conexion=$obj->conexion();
        return $conexion;
      }

      public function marcarAsistencia($usuario,$contrasena){
          $conexion =  $this->conectar();

          $consultaLogin="SELECT * FROM  login WHERE
                                    usuario_login ='$usuario'
                                    AND
                                    contrasena_login = '$contrasena'";
          $resultadoLogin = mysqli_query($conexion,$consultaLogin) or die ("Error al obtener los registros LOGIN");
          $resLogin =mysqli_fetch_assoc($resultadoLogin);


          if($resLogin>0){ //TODO: =====SI EXISTE EL USUARIO
            // campos de la tabla login
            $idLogin = $resLogin['id_login'];
            $usu = $resLogin['usuario_login'];
            $contrasena = $resLogin['contrasena_login'];
            $horaEntradaLogin = $resLogin['hentrada_login'];
            $horaSalidaLogin = $resLogin['hsalida_login'];
            $grupoLogin = $resLogin['grupo_login'];
            $tipoLogin = $resLogin['id_tipo'];
            $asigLogin = $resLogin['id_asisgnacion'];
            $minTolerancia = $resLogin['mintolerancia_login'];
            $estadoMinTolerancia = $resLogin['esttolerancia_login'];

              // verificar si el grupo esta desactivado
              $estadoGrupo = $this->verificarGrupo('id_grupo',$grupoLogin,'estado_grupo','DESCONECTADO');

              // Verifica si su asistencia esta activo
                $consultaEstado = "SELECT * FROM  estadoSesion WHERE id_login = '$idLogin'";
                $resultadoEstado = mysqli_query($conexion,$consultaEstado) or die ("Error al obtener los registros estado sesio");
                $resEstado =mysqli_fetch_assoc($resultadoEstado);


                $dias = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");
                $hoy = $dias[date('w')];
                // Verifica dia laborable
                $consultaDiaLaborable = "SELECT * FROM  frecuencia AS f INNER JOIN dias AS d  ON  f.id_dias  = d.id_dias  WHERE id_grupo = '$grupoLogin'  AND  nombre_dias = '$hoy'";
                $resultadoDiaLaborable = mysqli_query($conexion,$consultaDiaLaborable) or die ("Error al obtener los registros DIAS LABORABLES");
                $resDiaLaborable =mysqli_fetch_assoc($resultadoDiaLaborable);

                //verifica minutos tolerancia
                $horaLoginEntrada = $horaEntradaLogin;
                $date = new DateTime("0000-00-0 .$horaLoginEntrada.");
                $date->modify('0 hours');
                $date->modify(''.+$minTolerancia.' minute');
                $date->modify('0 second');
                $horaMenosTolerancia = $date->format('H:i:s');
                // echo "hora menos la tolerancia : " . $horaMenosTolerancia;
                $horaActual =$this->horaActual();
                if ($resDiaLaborable > 0) { //TODO: ES DIA LABORABLE
                      if ($estadoGrupo > 0) {
                        // el grupo esta desconectado
                         return 'su grupo esta desconectado';
                      }else{
                        //esta conectado
                            if (!($resEstado>0)) { //TODO: SI NO ESTA ACTIVO
                                  $horaActual =$this->horaActual();

                                  if ($estadoMinTolerancia = "ACTIVADO") {
                                              if ($horaMenosTolerancia > $horaActual ) {
                                                  // si no esta activo inserta la asistencia
                                                  $sesion = $this->insertarSesion('activo',$horaEntradaLogin,$horaSalidaLogin,$horaActual,$idLogin);
                                                  //calculando fecha
                                                  // $fecha_actual = date("d/m/Y");
                                                  $fecha_actual = date("Y/m/d");

                                                  $hsalida = 'sin marcar';
                                                  $observacion = 'obs';
                                                  //inserta control
                                                  $control = $this->insertarControl($fecha_actual,$horaActual,'sin marcar',$observacion,$asigLogin,$idLogin);
                                                  return "ACABA DE INICIAR SESION";

                                              }else{//TODO:  AVISO CUNATOS MINUTOS TARDE LLEGO

                                                  $horasTarde = $this->  RestarHoras($horaMenosTolerancia,$horaActual);

                                                  $hora = $horasTarde;
                                                  list($horas, $minutos, $segundos) = explode(':', $hora);
                                                  $hora_en_minutos = ($horas * 60) + $minutos;
                                                  echo $hora_en_minutos;



                                                return "Usted llego ". $hora_en_minutos ." Min.  tarde. Comuniquese con el Administrador.";
                                              }
                                  }else{
                                      // si no esta activo inserta la asistencia
                                      $sesion = $this->insertarSesion('activo',$horaEntradaLogin,$horaSalidaLogin,$horaActual,$idLogin);
                                      //calculando fecha
                                      // $fecha_actual = date("d/m/Y");
                                      $fecha_actual = date("Y/m/d");

                                      $hsalida = 'sin marcar';
                                      $observacion = 'obs';
                                      //inserta control
                                      $control = $this->insertarControl($fecha_actual,$horaActual,'sin marcar',$observacion,$asigLogin,$idLogin);
                                      return "ACABA DE INICIAR SESION";
                                  }
                            }
                            else{ //TODO:ESTAACTIVO :::OPCION SALIR
                                    $horaActual = $this->horaActual();
                                    //hora salida del grupo
                                    if ($horaActual< $horaSalidaLogin) {
                                          return  'no puede salir antes de ' . $horaSalidaLogin;
                                    }else{
                                          $fecha_actual = date("Y/m/d");
                                          $actualizarControl = "UPDATE control SET horasal_control ='$horaActual'  WHERE fecha_control ='$fecha_actual' AND id_asisgnacion  = '$asigLogin'";
                                          $ejecutar = mysqli_query($conexion,$actualizarControl);

                                          $eliminarSesion = $this->eliminarEstadoSesion($idLogin);
                                            return 'BUENAS NOCHES HASTA MAÑANA';
                                    }
                            }
                      }
                }else {//NO ES DIA LABORABLE
                  return "NO ES DIA LABORABLE";
                }
          }else {
            return "Usted no esta registrado como docente activo. su contraseña y usuaruio incorrecto";
          }
      }



      private function verificarGrupo($idGrupo,$parametroGrupo,$estadoGrupo,$parmEstado){
        $conexion =  $this->conectar();
        $consultaGrupo = "SELECT * FROM  grupo WHERE $idGrupo = '$parametroGrupo' AND $estadoGrupo = '$parmEstado'";
        $resultadoGrupo = mysqli_query($conexion,$consultaGrupo) or die ("Error al obtener los registros estado sesion");
        $resGrupo =mysqli_fetch_assoc($resultadoGrupo);
        return $resGrupo;
      }
      private  function insertarSesion($descripcion,$horaEntradaGrupo,$horaSalidaGrupo,$horaEnEstado,$idLogin){
            $conexion =  $this->conectar();
          $insertarSesion = "INSERT INTO estadoSesion (
                                                        descripcion_estado,
                                                        hegrupo_estado,
                                                        hsgrupo_estado,
                                                        horaent_estado,
                                                        id_login
                                                      )values(
                                                        '$descripcion',
                                                        '$horaEntradaGrupo',
                                                        '$horaSalidaGrupo',
                                                        '$horaEnEstado',
                                                        '$idLogin'
                                                      )";
          $ejecutar = mysqli_query($conexion,$insertarSesion);
             if ($ejecutar) {
             return  "se registro correctamente";
             }else{
             return 'no se registro';
            }
        }
        private  function insertarControl($fechac,$entrada,$salida,$obs,$idAsignacion,$idLogin){
            $conexion =  $this->conectar();
            $insertarControl = "INSERT INTO control (fecha_control,
                                                    horaent_control,
                                                    horasal_control,
                                                    observacion,
                                                    id_asignacion,
                                                    id_login
                                                    )values(
                                                      '$fechac',
                                                      '$entrada',
                                                      '$salida',
                                                      '$obs',
                                                      '$idAsignacion',
                                                      '$idLogin'
                                                    )";
            $ejecutarControl = mysqli_query($conexion,$insertarControl);
          }



    private function eliminarEstadoSesion($usuarioActivo){
      $conexion =  $this->conectar();
      $eliminarSesion = "DELETE FROM estadoSesion WHERE id_login ='$usuarioActivo'";
      $ejecutar = mysqli_query($conexion,$eliminarSesion);
      return $ejecutar;
    }
    private function actualizarControl($fechaActual,$grupo){
    }

    private function horaActual(){
      // calculando hora servidor
      $zona_horario = "-5";  //para madrid  la sona horarioa es GMT+2
      $time  = time();
      $formato  = "H:i:s";
      $hora_local_actual = gmdate($formato,time()+($zona_horario*3600));
      return   $hora_local_actual;
    }

    private function RestarHoras($horaini,$horafin)
    {
        	$horai=substr($horaini,0,2);
        	$mini=substr($horaini,3,2);
        	$segi=substr($horaini,6,2);

        	$horaf=substr($horafin,0,2);
        	$minf=substr($horafin,3,2);
        	$segf=substr($horafin,6,2);

        	$ini=((($horai*60)*60)+($mini*60)+$segi);
        	$fin=((($horaf*60)*60)+($minf*60)+$segf);

        	$dif=$fin-$ini;

        	$difh=floor($dif/3600);
        	$difm=floor(($dif-($difh*3600))/60);
        	$difs=$dif-($difm*60)-($difh*3600);
        	return date("H:i:s",mktime($difh,$difm,$difs));
    }

    public function mostrarSesion(){
        $conexion =  $this->conectar();
        $consultaSesionesActivos ="SELECT CONCAT(per.nombres_per , ' ' , per.apellidos_per) AS 'nombres',
        asig.grupo_asignacion AS 'grupo',est.hegrupo_estado AS 'entrada_grupo' ,per.area_per AS 'area' , per.cargo_per AS 'cargo',est.hsgrupo_estado AS 'salida_grupo',est.horaent_estado AS 'hora_entrada_estado',lo.grupo_login AS 'grupo',lo.grupo_login AS 'idgrupo'
        FROM  estadosesion AS est
        INNER JOIN login AS lo ON est.id_login = lo.id_login
        INNER JOIN asignacion AS asig  ON lo.id_asisgnacion = asig.id_asignacion
        INNER  JOIN personal per ON asig.id_persona = per.id_per";
        $resultadoSesion = mysqli_query($conexion,$consultaSesionesActivos) or die ("Error al obtener los registros sesion");
        // $resSesion =mysqli_fetch_row($resultadoSesion);
        return $resultadoSesion;
    }

    public function mostrarfrecuencia($grupo){
        $conexion =  $this->conectar();
        $consultaFrecuencia ="SELECT  MID(di.nombre_dias,1,3) AS dia FROM frecuencia AS fre  INNER JOIN  dias AS di ON fre.id_dias = di.id_dias  WHERE id_grupo = '$grupo'";
        $resultadoFrecuencia = mysqli_query($conexion,$consultaFrecuencia) or die ("Error al obtener los registros sesion");
        // $resFrecuaencia =mysqli_fetch_assoc($resultadoFrecuencia);
        return $resultadoFrecuencia;
    }
}


$obj = new ejemplo();
$mostrarSesiones =  $obj->mostrarSesion();
// var_dump ($mostrarSesiones);
echo "<BR><BR>";

$obj2 = new ejemplo();
?>

<?php
echo "<BR>====================================<BR>";
  while ($actual =mysqli_fetch_assoc($mostrarSesiones)) {
   ?>
       <article class="sesion" id="hola">
      <h1> <?php echo ' '.$actual['nombres'] ?></h1>
     <p>HORARIO ENTRADA: <span><?php echo $actual['entrada_grupo'] ?></span></p>
     <p>HORARIO SALIDA: <span><?php echo $actual['salida_grupo'] ?></span></p>
     <p>AREA : <span><?php echo $actual['area'] ?></span></p>
     <p>CARGO: <span><?php echo $actual['cargo'] ?></span></p>

     <p>HORA INGRESO: <span><?php echo $actual['hora_entrada_estado'] ?></span></p>
      <?php $mostrarFrecuancia =  $obj2->mostrarfrecuencia($actual['idgrupo']);
      while ($dia=mysqli_fetch_assoc($mostrarFrecuancia)) {
         echo '-'.$dia['dia']. '';
      }
      ?>
     </article>
       <?php
  }
 ?>
