<?php
require_once("model/recalculosModel.php");
$totalr=new Recalculos;
$nrete=$totalr->ver_retenciones($_GET["fe1"], $_GET["fe2"]);
//print_r($lrete);exit;
require_once("view/todas_retenciones.phtml");
?>