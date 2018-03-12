<?php

function RestarHoras($horaini,$horafin)
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


$resto  = RestarHoras('12:00:00','13:00:00');

echo "LA RESTA ES<BR>" . $resto .'<BR><BR><BR><BR>';

echo "<BR><BR><BR><BR> conversion  ";
$hora = "02:13:00";
list($horas, $minutos, $segundos) = explode(':', $hora);
$hora_en_minutos = ($horas * 60) + $minutos;
echo $hora_en_minutos;

echo "<BR><BR><BR><BR> ";



































//   echo   $fecha_actual = date("Y/m/d");
// // echo nombreDia($fecha_actual);
//
// echo $dia  = nombreDia($fecha_actual) ;
// echo "<br><br><br>";
// $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
// // echo "Hoy es ".$dias[date('w')];
// $dia = $dias[date('w')];
//
// if ($dia == 'Lunes' or $dia == 'Miercoles'  or $dia == 'Viernes') {
//     echo "Es dia de clases <br><br>";
//     echo $dia;
// }else{
//     echo 'no es dia de clases <br><br>';
//     echo $dia;
// }





//numero de dia SALOOOOOO
   $fechats = strtotime(date("Y/m/d"));
  $numeroDia = date('w', $fechats);
  echo "Numero dia : " . $numeroDia.'<br><br>';
$numero=0;

 echo "---Buenos días , hoy es ".date('l')  .'';
$hoy = date('l');
if ($hoy =='Friday') {
    echo "<bR>---Hoy es Viernes<br><br><br>";
}


echo "<br>----------------------------<br>";

$string= trim('365');
$arreglo = str_split($string);
$numeroElementos =count($arreglo);
echo "Numero de elementos " . $numeroElementos;

echo "<br>----------------------------<br><br>";


// $diasAsignados = array("5","6","3");



for ($i = 0 ; $i < 3 ;$i++){
    echo 'la posicion num.' . $i . ' es '. $arreglo[$i] . '<br>';
    if ($numeroDia ==$arreglo[$i]) {
     $numero++;
    }
}
if ( $numero >0 ) {
echo "<br> Es dia laborable.";
}else{
  echo "<br> hoy NO ES su dia de trabajo";
}
// echo '<br><br>'. $numero;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="./jquery/jquery-3.3.1.min.js">

    </script>
  </head>
  <body>
    <br><br><br><br>---------------------------------------------!!<br>


  <label><input type="checkbox" name="dias[]" value="salomon" id="Lunes">Lunes</label>
  <label><input type="checkbox" name="dias[]" value="salomon" id="Martes">Martes</label>
  <label><input type="checkbox" name="dias[]" value="salomon" id="Miercoles">Miercoles</label>
  <label><input type="checkbox" name="dias[]" value="salomon" id="Jueves">Jueves</label>
  <label><input type="checkbox" name="dias[]" value="salomon" id="Viernes">Viernes</label>
  <label><input type="checkbox" name="dias[]" value="salomon" id="Sabado">Sabado</label>
  <label><input type="checkbox" name="dias[]" value="salomon" id="Domingo">Domingo</label>



    <br><br> <input type="text" name="dias" value="" id="dias">

  </body>
</html>

<script type="text/javascript">
    $(document).ready(function(){












        $('#lunes').click(function(){
            if ($('#lunes').is(':checked')) {

              var variable =   $('#lunes').val();
                // alert('Esta checado'+ variable);
                $('#dias').val(variable);

            }else{
              // alert('NO Esta checado');
            }
        });

    });
</script>
