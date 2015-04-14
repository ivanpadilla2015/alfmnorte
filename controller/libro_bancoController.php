<?php
require_once("model/recalculosModel.php");
$lb=new Recalculos;
$lba=$lb->lista_banco();
//print_r($lba);
require_once("view/libro_banco.phtml");
?>