<?php

require_once("../config/config.php");
require_once("../Model/egresosModel.php");
$bce=new Egresos;
$busce=$bce->buscar_egreso($_POST["negreso"]);
if($busce["numorden"])
{
	$no=$busce["numorden"];
}else
	{
		$no="Sin Relacionar";
	}
if($busce)
{	echo '<script>
		 document.form.id_egre.value='.$busce["id_egreso"].'
		 </script>'; //para pasar el id del egreso al formulario
			 
	echo '<table>
		<tr>
			<td style="color: red;" align="right">Egreso N°</td>
			<td>:'.$busce["numegreso"].'</td>
		</tr>
		<tr>
			<td>Valor </td>
			<td>:'.number_format($busce["valoregre"],2).'</td>
		</tr>
		<tr>
			<td>O. pago</td>
			<td>:'.$no.'</td>
		</tr>
	</table>';
	if($busce["numorden"])
	{
	  echo '<script>
				document.form.num_opago.value='.$busce["numorden"].'
				document.form.id_opago.value='.$busce["id_opago"].'
			</script>';
	}else
		{
	 		 echo '<script>
				document.form.num_opago.value=+0
				document.form.id_opago.value=+0
				</script>';
		}
}else
	{
	  echo '<script>
				document.form.num_opago.value=+0
				document.form.id_opago.value=+0
				document.form.id_egre.value=+0
			</script>';
	}

?>

