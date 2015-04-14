<?php
require_once("model/ordenpagoModel.php");
$opr=new opagos;
$opr2=$opr->opagos_pornum($_GET["numop"]);
$op1=$opr->verdeta_porid($opr2["id_opago"]);
$re1=$opr->busreten();
$deta1=$opr->verdeta2($opr2["id_opago"]);
$netpa1=$opr->netopagar2($opr2["id_opago"]);
//print_r($opr2);
if(isset($_POST["editar"]) and $_POST["editar"] = "si")
{
	$opr->edita_opagos($_POST["id_op"]);exit;
}
require_once("view/editar_opago_mostar.phtml");
?>