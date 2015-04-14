<?php
require_once("model/ordenpagoModel.php");
$eopr=new opagos;
$eopr2=$eopr->opagos_pornum($_GET["numop"]);
if($eopr2)
{

	if($eopr2["id_egreso"]>0){
		$numegr=$eopr->opagos_egreso($eopr2["id_egreso"]);//para obtener el egreso
	}
	$eop1=$eopr->verdeta_porid($eopr2["id_opago"]);
	$ere1=$eopr->busreten();
	$edeta1=$eopr->verdeta2($eopr2["id_opago"]);
	$enetpa1=$eopr->netopagar2($eopr2["id_opago"]);
	//print_r($opr2);
	if(isset($_POST["eliminar"]) and $_POST["eliminar"] = "si")
	{
		$eopr->eliminar_opagos($_POST["id_op"], $_POST["id_obli"]);
		//print_r($_POST);
		exit;
	}
	require_once("view/eliminar_opago_mostrar.phtml");
}else
	{
		header("location:".Conectar::ruta()."?accion=eliminar_opago");
	}
?>