<?php
require_once("model/recalculosModel.php");
$reca=new Recalculos;
$tcon=$reca->ver_allcontratos();
if(isset($_POST["contra"]) and $_POST["contra"]>0)
{
	$rcon=$reca->ver_contratoporid($_POST["contra"]);
	$rad=$reca->las_adiciones($_POST["contra"]);
	$rob=$reca->las_obligaciones($_POST["contra"]);
}
require_once("view/recalcularcontra.phtml");
?>