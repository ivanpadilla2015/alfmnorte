<?php
require_once("model/recalculosModel.php");
$lbr=new Recalculos;
$lban=$lbr->lista_banco();
//print_r($lba);
require_once("view/bancoretenciones.phtml");
?>