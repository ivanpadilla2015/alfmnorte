<?php
require_once("model/contratosModel.php");
$mov=new Contratos;
$mov1=$mov->ver_contrato();
$lad=$mov->ver_adiciones();
$legr=$mov->ver_opagos();
require_once("view/movimientocontra.phtml");
?>