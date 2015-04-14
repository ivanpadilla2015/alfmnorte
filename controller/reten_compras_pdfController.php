<?php
require_once("model/recalculosModel.php");
$rete=new Recalculos;
$lrete=$rete->retencione_tipo($_GET["fe1"], $_GET["fe2"], $_GET["id"], $_GET["tipo"]);
$nomb=$_GET["nom"];
//print_r($lrete);exit;
require_once("view/reten_compras_pdf.phtml");
?>
